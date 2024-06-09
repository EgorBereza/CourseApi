<?php

namespace App\Services;

use App\Exceptions\CourseNotFoundException;
use App\Exceptions\CourseValidationException;
use App\Interfaces\CourseServiceInterface;
use App\Interfaces\CourseValidationServiceInterface;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CourseService implements CourseServiceInterface
{
    protected CourseValidationServiceInterface $validationService;

    public function __construct(CourseValidationServiceInterface $validationService)
    {
        $this->validationService = $validationService;
    }

    public function getAllCourses()
    {
        return Course::all();
    }

    public function getCourseById(int $id)
    {
        $course = Course::find($id);

        if (!$course) {
            throw new CourseNotFoundException(config('messages.course.not_found'));
        }

        return $course;
    }

    public function createCourse(Request $request)
    {
        try {
            $validatedData = $this->validationService->validateCreateCourse($request);
            return Course::create($validatedData);
        } 
        catch (ValidationException $e) {
            throw new CourseValidationException($e->errors());
        }
    }

    public function updateCourse(Request $request, int $id)
    {
        $course = Course::find($id);

        if (!$course) {
            throw new CourseNotFoundException(config('messages.course.not_found'));
        }

        try {
            $validatedData = $this->validationService->validateUpdateCourse($request);
            $course->update($validatedData);
            return $course;
        } 
        catch (ValidationException $e) {
            throw new CourseValidationException($e->errors());
        }
    }

    public function deleteCourse(int $id)
    {
        $course = Course::find($id);

        if (!$course) {
            throw new CourseNotFoundException(config('messages.course.not_found'));
        }

        $course->delete();
        return $course;
    }
}
