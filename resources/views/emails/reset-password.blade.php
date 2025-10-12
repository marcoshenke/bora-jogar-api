<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recuperação de Senha</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: #f8f9fa; padding: 20px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { background: #fff; padding: 30px; border: 1px solid #e9ecef; }
        .footer { background: #f8f9fa; padding: 20px; text-align: center; border-radius: 0 0 8px 8px; font-size: 14px; color: #6c757d; }
        .btn { display: inline-block; padding: 12px 24px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .btn:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Recuperação de Senha</h2>
        </div>
        <div class="content">
            <p>Olá!</p>
            <p>Você solicitou uma recuperação de senha para sua conta.</p>
            <p>Clique no botão abaixo para redefinir sua senha:</p>
            <p style="text-align: center;">
                <a href="{{ $url }}" class="btn">Redefinir Senha</a>
            </p>
            <p>Ou copie e cole este link no seu navegador:</p>
            <p style="word-break: break-all; background: #f8f9fa; padding: 10px; border-radius: 4px;">{{ $url }}</p>
            <p><strong>Este link expira em 24 horas.</strong></p>
            <p>Se você não solicitou esta recuperação de senha, ignore este email.</p>
        </div>
        <div class="footer">
            <p>Este é um email automático, não responda.</p>
        </div>
    </div>
</body>
</html>
