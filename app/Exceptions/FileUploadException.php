<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FileUploadException extends Exception
{
    protected array $context = [];
    protected string $userMessage = 'An error occurred while uploading the file.';
    protected int $statusCode = 400;

    /**
     * Create a new exception instance.
     */
    public function __construct(
        string $message = "",
        int $code = 0,
        ?\Throwable $previous = null,
        array $context = [],
        ?string $userMessage = null,
        ?int $statusCode = null
    ) {
        $this->context = $context;

        if ($userMessage !== null) {
            $this->userMessage = $userMessage;
        }

        if ($statusCode !== null) {
            $this->statusCode = $statusCode;
        }

        parent::__construct($message, $code, $previous);
    }

    /**
     * Get the context data for the exception.
     */
    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * Get the user-friendly error message.
     */
    public function getUserMessage(): string
    {
        return $this->userMessage;
    }

    /**
     * Get the HTTP status code for the response.
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): ?JsonResponse
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'success' => false,
                'message' => $this->getUserMessage(),
                'error' => $this->getMessage(),
                'code' => $this->getCode(),
            ], $this->getStatusCode());
        }

        return null;
    }
}
