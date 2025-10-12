<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PasswordResetController extends Controller
{
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'Email não encontrado.'], 404);
        }

        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        $url = config('app.frontend_url') . "/reset-password?token={$token}&email=" . urlencode($request->email);


        try {
            Mail::to($request->email)->send(new ResetPassword($url));

            $response = ['message' => 'Link de recuperação enviado para seu email.'];
            if (config('app.debug')) {
                $response['debug_info'] = [
                    'reset_link' => $url,
                    'email_logged_to' => storage_path('logs/laravel.log')
                ];
            }

            return response()->json($response);

        } catch (\Exception $e) {
            \Log::error('Erro ao enviar email de recuperação: ' . $e->getMessage());

            return response()->json([
                'message' => 'Erro ao enviar email. Tente novamente mais tarde.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return response()->json(['message' => 'Token inválido ou expirado.'], 422);
        }

        // Verificar se o token não expirou (24 horas)
        if (Carbon::parse($record->created_at)->addHours(24)->isPast()) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return response()->json(['message' => 'Token expirado. Solicite um novo link.'], 422);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $user->password = Hash::make($request->password);
        $user->save();

        // Limpar o token usado
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return response()->json(['message' => 'Senha alterada com sucesso.']);
    }

    public function verifyToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return response()->json(['message' => 'Token inválido.'], 422);
        }

        // Verificar se o token não expirou
        if (Carbon::parse($record->created_at)->addHours(24)->isPast()) {
            return response()->json(['message' => 'Token expirado.'], 422);
        }

        return response()->json(['message' => 'Token válido.']);
    }
}
