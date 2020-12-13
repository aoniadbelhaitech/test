<?php

namespace Tests\Feature;

use App\Models\Period;
use App\Models\Student;
use App\Models\Teacher;
use Faker\Factory;
use Illuminate\Support\Facades\Config;


use Tests\TestCase;

class BasicTest extends TestCase
{

    public function testGetAllStudents()
    {
        $token = Config::get('test.apiToken');
        $headers['Accept'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token;
        $response = $this->get('/api/students', $headers);
        $response->assertStatus(200);
    }

    public function testGetAllTeachers()
    {
        $token = Config::get('test.apiToken');
        $headers['Accept'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token;
        $response = $this->get('/api/teachers', $headers);
        $response->assertStatus(200);
    }

    public function testGetAllPeriods()
    {
        $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiZDVkOTBhYmRiY2Y1ZDU3NzQ3MGVlNDJkZTA3NzMxZDYyMjQwODViNmU5MGFhMzI2ODNlNTYzN2NjNjE2ZmIwNDAwMDkyY2ViY2IxM2QzOGIiLCJpYXQiOiIxNjA3ODM1NTg0LjA4MjgxNSIsIm5iZiI6IjE2MDc4MzU1ODQuMDgyODE5IiwiZXhwIjoiMTYzOTM3MTU4NC4wNzA0MDAiLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.YoJ30duHwzQQs2LfwLsmhfQG_mO1z-fIxIpepOM-vpcwbi080rkCmsWybTJyaRGkut2Hr53Hl1F6858KTQQdzprccXdv9RUhlk80P2NKOcaZ5BeA1rVUxFsvJbEtuxiKi8iGYLlViA-YtL-Xw7cxDYrcTIXg3Y98AvxDd8XjlWnGJ0vdPjVzLcrRqXo1-Q78xLOUHu_NJ9BRRd5ERlL_YfuVZvIUFdq6Rr0i-CKZcGxtmXhdV_pZTMAWjEoEyrBBtJFOAHgHXkDOMzYwo9lsO2_M4N8EO5tnNlkF4oZiBp44vZNTgEsP4v0UPPjm1669fATXqXcQiz-XUodNvIi711E86j0HN_pc3EGt01LE3YXriwrKRPhjFG4hxlxsnwQeskl8G6fDVhAo4F19GA4A6vPWBT_-qx749iT9l068LuqIx5i8Ynfy6r8fvb49Zfmv7zcMoJI-7Lq40D67Y4PDbKZvr1fw7keMq6qIwkwT_S32cqdZJmRpDOngOMY0EBF3dfyd3NChyGqrDuorGee2YSdxCehu6CvwR46-PT18uEz_gc-POYiqfpWEW_2vUd-GNPJ_GpsD3UFM0gxC0Ehh5LFg6PPcwK98-503PqUhhGFNn6SRQH_tDSTOYTHy6uvPd4twb8MG_sUhcFvN5UrSbwgCXiGbQdZTIFVFna-LAd4';
        $headers['Accept'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token;
        $response = $this->get('/api/periods', $headers);
        $response->assertStatus(200);
    }

    public function testInsertStudentWithCorrectData()
    {
        $token = Config::get('test.apiToken');
        $headers['Accept'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token;
        $faker = Factory::create();
        $data['name'] = $faker->name;
        $data['username'] = $faker->userName;
        $data['email'] = $faker->unique()->email;
        $data['password'] = $faker->password;
        $data['grade'] = $faker->numberBetween(0, 12);
        $response = $this->postJson('/api/students/', $data, $headers);
        $response->assertStatus(201);
    }

    public function testUpdateStudentWithCorrectData()
    {
        $token = Config::get('test.apiToken');
        $headers['Accept'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token;
        $student = Student::factory()->create();
        $faker = Factory::create();
        $data['name'] = $faker->name;
        $data['grade'] = $faker->numberBetween(0, 12);
        $response = $this->putJson("/api/students/{$student->id}", $data, $headers);
        $response->assertStatus(200);
    }

    public function testDeleteStudent()
    {
        $token = Config::get('test.apiToken');
        $headers['Accept'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token;
        $student = Student::factory()->create();
        $response = $this->deleteJson("/api/students/{$student->id}", [], $headers);
        $response->assertStatus(204);
    }

    public function testInsertTeacherWithCorrectData()
    {
        $token = Config::get('test.apiToken');
        $headers['Accept'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token;
        $faker = Factory::create();
        $data['name'] = $faker->name;
        $data['username'] = $faker->userName;
        $data['email'] = $faker->unique()->email;
        $data['password'] = $faker->password;
        $response = $this->postJson('/api/teachers/', $data, $headers);
        $response->assertStatus(201);
    }

    public function testUpdateTeacherWithCorrectData()
    {
        $token = Config::get('test.apiToken');
        $headers['Accept'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token;
        $model = Teacher::factory()->create();
        $faker = Factory::create();
        $data['name'] = $faker->name;
        $response = $this->putJson("/api/teachers/{$model->id}", $data, $headers);
        $response->assertStatus(200);
    }

    public function testDeleteTeacher()
    {
        $token = Config::get('test.apiToken');
        $headers['Accept'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token;
        $model = Teacher::factory()->create();
        $response = $this->deleteJson("/api/teachers/{$model->id}", [], $headers);
        $response->assertStatus(204);
    }

    public function testInsertPeriodWithCorrectData()
    {
        $token = Config::get('test.apiToken');
        $headers['Accept'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token;
        $teacher = Teacher::factory()->create();
        $student = Student::factory()->create();
        $faker = Factory::create();
        $data['name'] = $faker->name;
        $data['teacher_id'] = $teacher->id;
        $data['student_id'] = $student->id;
        $response = $this->postJson('/api/periods/', $data, $headers);
        $response->assertStatus(201);
        $response->assertJson(['error' => false, 'code' => 201, 'result' => ['teacher_id' => $teacher->id]]);
    }

    public function testUpdatePeriodWithCorrectData()
    {
        $token = Config::get('test.apiToken');
        $headers['Accept'] = 'application/json';
        $headers['Authorization'] = 'Bearer ' . $token;
        $teacher = Teacher::factory()->create();
        $student = Student::factory()->create();
        $period = Period::factory()->create();
        $faker = Factory::create();
        $data['name'] = $faker->name;
        $data['teacher_id'] = $teacher->id;
        $data['student_id'] = $student->id;
        $response = $this->putJson("/api/periods/{$period->id}", $data, $headers);
        $response->assertStatus(200);
        $response->assertJson(['error' => false, 'code' => 200, 'result' => ['teacher_id' => $teacher->id]]);
    }
}
