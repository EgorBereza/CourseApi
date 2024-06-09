<?php

namespace App\Http\Controllers;

use App\Interfaces\CourseServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Courses API",
 *     version="1.0.0",
 *     description="API documentation for Courses"
 * )
 */
class CourseController extends Controller
{
    protected CourseServiceInterface $courseService;

    public function __construct(CourseServiceInterface $courseService)
    {
        $this->courseService = $courseService;
    }

    /**
     * @OA\Get(
     *     path="/api/courses",
     *     summary="Get list of courses",
     *     @OA\Response(
     *         response=200,
     *         description="A list of courses"
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json($this->courseService->getAllCourses(), 200);
    }

    /**
     * @OA\Get(
     *     path="/api/courses/{id}",
     *     summary="Get a course by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A course"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Course not found"
     *     )
     * )
     */
    public function show(int $id): JsonResponse
    {
        $course = $this->courseService->getCourseById($id);
        
        return response()->json($course, 200);
    }

    /**
     * @OA\Post(
     *     path="/api/courses",
     *     summary="Create a new course",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Course Title"),
     *             @OA\Property(property="description", type="string", example="Course Description"),
     *             @OA\Property(property="status", type="string", enum={"Published", "Pending"}),
     *             @OA\Property(property="is_premium", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Course created successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        $this->courseService->createCourse($request);

        return response()->json(['message' => config('messages.course.created')], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/courses/{id}",
     *     summary="Update a course",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Updated Course Title"),
     *             @OA\Property(property="description", type="string", example="Updated Course Description"),
     *             @OA\Property(property="status", type="string", enum={"Published", "Pending"}),
     *             @OA\Property(property="is_premium", type="boolean", example=false)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Course updated successfully"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Course not found"
     *     )
     * )
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $this->courseService->updateCourse($request, $id);

        return response()->json(['message' => config('messages.course.updated')], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/courses/{id}",
     *     summary="Delete a course",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Course deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Course not found"
     *     )
     * )
     */
    public function delete(int $id): JsonResponse
    {
        $this->courseService->deleteCourse($id);

        return response()->json(['message' => config('messages.course.deleted')], 200);
    }
}
