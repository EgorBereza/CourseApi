<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class CourseValidationException extends Exception
{
    protected $errors;

    public function __construct(array $errors)
    {
        parent::__construct('Validation Error');
        $this->errors = $errors;
    }

    public function render(): JsonResponse
    {
        return response()->json(['message' => $this->errors], 422);
    }
}
