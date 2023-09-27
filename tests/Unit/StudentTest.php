<?php

namespace Tests\Unit;

use App\Models\School;
use App\Models\Student;
use App\Services\StudentService;
use Tests\TestCase;


class StudentTest extends TestCase
{
    protected $school;
    protected $student;
    protected $order;

    public function setUp(): void
    {
        parent::setUp();
        $this->order = fake()->numberBetween(1, 9);
        $this->school = School::inRandomOrder()->first();
        $this->student = Student::factory()->create();
    }

    /** @test */
    public function it_can_create_a_student()
    {
        $data = [
            'name' => fake()->name,
            'school_id' => $this->school->id,
            'order' => $this->order,
        ];

        $studentService = new StudentService();
        $student = $studentService->createStudent($data);

        $this->assertInstanceOf(Student::class, $student);
        $this->assertEquals($data['name'], $student->name);
        $this->assertEquals($data['school_id'], $student->school_id);
        $this->assertEquals($data['order'], $student->order);
    }

    /** @test */
    public function it_can_update_the_student()
    {
        $data = [
            'name' => fake()->name,
            'school_id' => $this->school->id,
            'order' => $this->order,
        ];

        $studentService = new StudentService();
        $updateData = $studentService->updateStudent($data, $this->student);

        $this->assertInstanceOf(Student::class, $updateData);
        $this->assertEquals($data['name'], $this->student->name);
        $this->assertEquals($data['school_id'], $this->student->school_id);
        $this->assertEquals($data['order'], $this->student->order);
    }

    /** @test */
    public function it_can_delete_the_student()
    {
        $studentService = new StudentService();
        $delete = $studentService->destroyStudent($this->student);
        $this->assertTrue($delete);
    }

    /** @test */
    public function it_can_command_reorder_students_by_school()
    {
        $this->artisan('reorder:students')
            ->expectsOutput('Öğrencilerin okul sıraları yeniden düzenlendi.')
            ->assertExitCode(0);
    }
}
