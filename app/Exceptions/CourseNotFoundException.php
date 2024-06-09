<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class CourseNotFoundException extends Exception
{
    protected $message;

    public function __construct(string $message)
    {
        parent::__construct($message);
    }

    public function render(): JsonResponse
    {
        return response()->json(['message' => $this->message], 404);
    }
}
