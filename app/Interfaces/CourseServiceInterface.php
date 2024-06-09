<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface CourseServiceInterface
{
    public function getAllCourses();

    public function getCourseById(int $id);

    public function createCourse(Request $request);

    public function updateCourse(Request $request,int $id);
    
    public function deleteCourse(int $id);
}
