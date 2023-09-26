<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\StoreStudentRequest;
use App\Http\Requests\Update\UpdateStudentRequest;
use App\Models\School;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StudentController extends Controller
{

    private object $schools;
    protected $studentService;


    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;

        $this->schools =  School::orderBy('id')
            ->get();
    }


    /**
     * @return View
     */
    public function index(): View
    {
        $data = $this->studentService
            ->listStudent();

        return view('student.index', [
            'data' => $data,
        ]);
    }

    /**
     * @return View
     */
    public function create():View
    {
        return view('student.create_edit',[
            'selectedData' => [
                'schools' => $this->schools,
            ],
        ]);
    }

    /**
     * @param StoreStudentRequest $request
     * @return RedirectResponse
     */
    public function store(StoreStudentRequest $request): RedirectResponse
    {
        $this->studentService->createStudent($request->validated());

        return to_route('student.index')
            ->with('toastr', [
                'success',
                'Yeni kayıt başarılı bir şekilde eklendi.',
            ]);
    }


    /**
     * @param Student $student
     * @return View
     */
    public function show(Student $student): View
    {
        return view('student.show', [
            'data' => $student,
        ]);
    }

    /**
     * @param Student $student
     * @return View
     */
    public function edit(Student $student): View
    {
        return view('student.create_edit', [
            'data' => $student,
            'selectedData' => [
                'schools' => $this->schools,
            ],
        ]);
    }

    /**
     * @param UpdateStudentRequest $request
     * @param Student $student
     * @return RedirectResponse
     */
    public function update(UpdateStudentRequest $request, Student $student): RedirectResponse
    {

        $this->studentService->updateStudent($request->validated(), $student);

        return to_route('student.edit', $student->id)
            ->with('toastr', [
                'success',
                'Kayıt başarılı bir şekilde güncellendi.',
            ]);
    }

    /**
     * @param Student $student
     * @return JsonResponse
     */
    public function destroy(Student $student): JsonResponse
    {
        $this->studentService->destroyStudent($student);

        return response()->json(1);
    }

}
