<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\StoreStudentRequest;
use App\Http\Requests\Update\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\School;
use App\Models\Student;
use App\Services\StudentService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use ApiResponse;
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $data = $this->studentService
            ->listStudent();

        return $this->successResponse(
            data: StudentResource::collection($data)
        );
    }

    /**
     * @param StoreStudentRequest $request
     * @return JsonResponse
     */
    public function store(StoreStudentRequest $request): JsonResponse
    {
        $data = $this->studentService->createStudent($request->validated());

        return $this->successResponse(
            message:'Yeni kayıt başarılı bir şekilde eklendi.',
            data: new StudentResource($data)
        );
    }

    /**
     * @param string $id
     * @return JsonResponse
     */
    public function show(Student $student): JsonResponse
    {
        return $this->successResponse(
            data: new StudentResource($student)
        );
    }

    /**
     * @param UpdateStudentRequest $request
     * @param Student $student
     * @return JsonResponse
     */
    public function update(UpdateStudentRequest $request, Student $student): JsonResponse
    {
        $data = $this->studentService->updateStudent($request->validated(), $student);
        return $this->successResponse(
            message:'Kayıt başarılı bir şekilde güncellendi.',
            data: new StudentResource($data),
        );
    }

    /**
     * @param Student $student
     * @return JsonResponse
     */
    public function destroy(Student $student): JsonResponse
    {
        $this->studentService->destroyStudent($student);

        return $this->successResponse(
            statusCode: 204
        );
    }
}
