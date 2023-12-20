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
use OpenApi\Annotations as OA;


class StudentController extends Controller
{
    use ApiResponse;


    public function __construct(public StudentService $studentService) {}

    /**
     * @OA\Get(
     *     path="/api/students",
     *     tags={"Students"},
     *     summary="List Students",
     *     security={
     *           {"X-Api-Key": {}}
     *       },
     *     @OA\Response(
     *         response="200",
     *         description="Öğrencileri listeler.",
     *         @OA\JsonContent()
     *     ),
     * )
     */
    public function index(): JsonResponse
    {
        try {
            $data = $this->studentService
                ->listStudent();

            return $this->successResponse(
                data: StudentResource::collection($data)
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                message: 'Kayıt listelenirken bir hata oluştu.',
                statusCode: 500
            );
        }
    }
    /**
     * @OA\Post(
     *      path="/api/students",
     *      operationId="store",
     *      tags={"Students"},
     *      summary="Save Student",
     *      description="Öğrencileri veritabanına kaydeder",
     *      security={
     *           {"X-Api-Key": {}}
     *       },
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "school_id"},
     *            @OA\Property(
     *              property="name",
     *              type="string",
     *              format="string",
     *              example="Ayşe TAŞ"
     *              ),
     *            @OA\Property(
     *              property="school_id",
     *              type="integer",
     *              format="integer",
     *              example="3"
     *              ),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(
     *                property="status",
     *                type="integer",
     *                 example=""
     *                 ),
     *             @OA\Property(
     *                property="data",
     *               type="object"
     *               )
     *          )
     *       )
     *  )
     *
     * @param StoreStudentRequest $request
     * @return JsonResponse
     */
    public function store(StoreStudentRequest $request): JsonResponse
    {
        try {
            $data = $this->studentService->createStudent($request->validated());

            return $this->successResponse(
                message: 'Yeni kayıt başarılı bir şekilde eklendi.',
                data: new StudentResource($data)
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                message: 'Kayıt eklenirken bir hata oluştu.',
                statusCode: 500
            );
        }
    }

    /**
     * @OA\Get(
     *    path="/api/students/{id}",
     *    operationId="show",
     *    tags={"Students"},
     *    summary="Show Student",
     *    description="Öğrencinin bilgilerini görüntüler",
     *   security={
     *          {"X-Api-Key": {}}
     *      },
     *    @OA\Parameter(
     *            name="id",
     *            in="path",
     *            description="Id of Student",
     *            required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent(
     *          @OA\Property(
     *                property="status_code",
     *                type="integer",
     *                 example="200"
     *              ),
     *          @OA\Property(
     *               property="data",
     *               type="object"
     *              )
     *           ),
     *        )
     *       )
     *  )
     * @param string $id
     * @return JsonResponse
     */
    public function show(Student $student): JsonResponse
    {
        try {
            return $this->successResponse(
                data: new StudentResource($student)
            );
        }catch (\Exception $e){
            return $this->errorResponse(
                message: 'Kayıt görüntülemede bir hata oluştu.',
                statusCode: 500
            );
        }

    }

    /**
     * @OA\Put(
     *     path="/api/students/{id}",
     *     operationId="update",
     *     tags={"Students"},
     *     summary="Update Student",
     *     description="Öğrencinin bilgilerini günceller.",
     *     security={
     *           {"X-Api-Key": {}}
     *     },
     *     @OA\Parameter(
     *              name="id",
     *              in="path",
     *              description="Id of Student",
     *              required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *        required=true,
     *        @OA\JsonContent(
     *            required={"name", "school_id"},
     *             @OA\Property(
     *                  property="name",
     *                  type="string",
     *                  format="string",
     *                  example="Test Student Name"
     *                ),
     *             @OA\Property(
     *                  property="school_id",
     *                  type="integer",
     *                  format="integer",
     *                   example="2"
     *              ),
     *        ),
     *     ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(
     *                  property="status_code",
     *                  type="integer",
     *                  example="200"
     *                  ),
     *             @OA\Property(property="data",type="object")
     *          )
     *       )
     *  )
     * @param UpdateStudentRequest $request
     * @param Student $student
     * @return JsonResponse
     */
    public function update(UpdateStudentRequest $request, Student $student): JsonResponse
    {
        try {
            $data = $this->studentService->updateStudent($request->validated(), $student);
            return $this->successResponse(
                message:'Kayıt başarılı bir şekilde güncellendi.',
                data: new StudentResource($data),
            );
        }catch (\Exception $e){
            return $this->errorResponse(
                message: 'Kayıt güncelenirken bir hata oluştu.',
                statusCode: 500
            );
        }

    }

    /**
     * @OA\Delete(
     *    path="/api/students/{id}",
     *    operationId="destroy",
     *    tags={"Students"},
     *    summary="Delete Student",
     *    description="Öğrenci bilgisini siler",
     *    security={
     *           {"X-Api-Key": {}}
     *     },
     *    @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id of Student",
     *          required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *         @OA\Property(
     *            property="status_code",
     *            type="integer",
     *            example="200"
     *            ),
     *         @OA\Property(
     *             property="data",
     *             type="object"
     *           )
     *          ),
     *       )
     *      )
     *  )
     * @param Student $student
     * @return JsonResponse
     */
    public function destroy(Student $student): JsonResponse
    {
        try {
            $this->studentService->destroyStudent($student);

            return $this->successResponse(
                statusCode: 204
            );
        } catch (\Exception $e) {
            return $this->errorResponse(
                message: 'Kayıt silinirken bir hata oluştu.'.$e->getMessage(),
                statusCode: 500
            );
        }
    }
}

