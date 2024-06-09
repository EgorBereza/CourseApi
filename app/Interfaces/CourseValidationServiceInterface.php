<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface CourseValidationServiceInterface
{
    public function validateCreateCourse(Request $request);
    
    public function validateUpdateCourse(Request $request);
}
