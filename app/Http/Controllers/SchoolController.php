<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\StoreSchoolRequest;
use App\Http\Requests\Update\UpdateSchoolRequest;
use App\Models\School;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class SchoolController extends Controller
{
    /**
     * @return View|Model|LengthAwarePaginator
     */
    public function index(): View|Model|LengthAwarePaginator
    {
        $data = School::orderBy('id')
            ->paginate(10);

        return view('school.index', [
            'data' => $data,
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('school.create_edit');
    }

    /**
     * @param StoreSchoolRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSchoolRequest $request): RedirectResponse
    {
        School::create($request->validated());

        return to_route('school.index')
            ->with('toastr', [
                'success',
                'Yeni kayıt başarılı bir şekilde eklendi.',
            ]);
    }

    /**
     * @param School $school
     * @return View
     */
    public function show(School $school): View
    {
        return view('school.show', [
            'data' => $school,
        ]);
    }

    /**
     * @param School $school
     * @return View
     */
    public function edit(School $school): View
    {
        return view('school.create_edit', [
            'data' => $school,
        ]);
    }

    /**
     * @param Request $request
     * @param School $school
     * @return RedirectResponse
     */
    public function update(UpdateSchoolRequest $request, School $school): RedirectResponse
    {
        $school->update($request->validated());

        return to_route('school.edit', $school->id)
            ->with('toastr', [
                'success',
                'Kayıt başarılı bir şekilde güncellendi.',
            ]);
    }

    /**
     * @param School $school
     * @return JsonResponse
     */
    public function destroy(School $school): JsonResponse
    {
        $school->delete();

        return response()->json(1);
    }
}
