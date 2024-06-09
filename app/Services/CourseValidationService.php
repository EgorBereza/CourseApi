<?php

namespace App\Services;

use App\Interfaces\CourseValidationServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CourseValidationService implements CourseValidationServiceInterface
{
    public function validateCreateCourse(Request $request)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:Published,Pending',
            'is_premium' => 'required|boolean',
        ];

        return $this->validateCourse($request, $rules);
    }

    public function validateUpdateCourse(Request $request)
    {
        $rules = [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:Published,Pending',
            'is_premium' => 'sometimes|required|boolean',
        ];

        return $this->validateCourse($request, $rules);
    }

    private function validateCourse(Request $request, array $rules)
    {
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}
