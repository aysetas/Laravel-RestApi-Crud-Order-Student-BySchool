<?php

namespace App\Services;

use App\Models\Student;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentService
{

    /**
     * @return LengthAwarePaginator
     */
    public function listStudent(): LengthAwarePaginator
    {
       return Student::orderBy('id')
           ->paginate(10);
    }

    /**
     * @param array $studentData
     * @return Student
     */
    public function createStudent(array $studentData): Student
    {
        return Student::create($studentData);
    }

    /**
     * @param array $studentData
     * @param Student $student
     * @return Student
     */
    public function updateStudent(array $studentData, Student $student): Student
    {
        $student->update($studentData);

        return $student;
    }

    /**
     * @param Student $student
     * @return bool|null
     */
    public function destroyStudent(Student $student): bool
    {
       return $student->delete($student);
    }

}
