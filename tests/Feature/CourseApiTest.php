<?php

namespace Tests\Feature;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function testListAllCourses()
    {
        Course::factory()->count(5)->create();

        $this->getJson('/api/courses')
             ->assertStatus(200)
             ->assertJsonCount(5);
    }

    /** @test */
    public function testShowCourse()
    {
        $course = Course::factory()->create();

        $this->getJson('/api/courses/' . $course->id)
             ->assertStatus(200)
             ->assertJson($course->toArray());
    }

    /** @test */
    public function testCreateCourse()
    {
        $courseData = [
            'title' => 'Test Course',
            'description' => 'Test Description',
            'status' => 'Pending',
            'is_premium' => true,
        ];

        $this->postJson('/api/courses', $courseData)
             ->assertStatus(201);

        $this->assertDatabaseHas('courses', $courseData);
    }

    /** @test */
    public function testUpdateCourse()
    {
        $course = Course::factory()->create();

        $updateData = [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'status' => 'Published',
            'is_premium' => false,
        ];

        $this->putJson('/api/courses/' . $course->id, $updateData)
             ->assertStatus(200);

        $this->assertDatabaseHas('courses', $updateData);
    }

    /** @test */
    public function testDeleteCourse()
    {
        $course = Course::factory()->create();

        $this->deleteJson('/api/courses/' . $course->id)
             ->assertStatus(200);

        $this->assertSoftDeleted('courses', ['id' => $course->id]);
    }

        /** @test */
    public function testCreateCourseValidationErrors()
    {
        $courseData = [
            'title' => '',
            'description' => '',
            'status' => 'InvalidStatus',
            'is_premium' => 'notBoolean',
        ];

        $this->postJson('/api/courses', $courseData)
             ->assertStatus(422);
    }

    /** @test */
    public function testUpdateCourseValidationErrors()
    {
        $course = Course::factory()->create();

            $updateData = [
                'title' => '',
                'description' => '',
                'status' => 'InvalidStatus',
                'is_premium' => 'notBoolean',
            ];

            $this->putJson('/api/courses/' . $course->id, $updateData)
                 ->assertStatus(422);
    }

        /** @test */
    public function testShowCourseNotFound()
    {
        $this->getJson('/api/courses/999999')
             ->assertStatus(404)
             ->assertJson(['message' => config('messages.course.not_found')]);
    }

    /** @test */
    public function testUpdateCourseNotFound()
    {
        $updateData = [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'status' => 'Published',
            'is_premium' => false,
        ];

        $this->putJson('/api/courses/999999', $updateData)
             ->assertStatus(404)
             ->assertJson(['message' => config('messages.course.not_found')]);
    }

    /** @test */
    public function testDeleteCourseNotFound()
    {
        $this->deleteJson('/api/courses/999999')
             ->assertStatus(404)
             ->assertJson(['message' => config('messages.course.not_found')]);
    }

}
