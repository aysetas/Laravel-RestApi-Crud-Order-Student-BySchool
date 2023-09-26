@extends('layouts.master')
@section('subheader','Öğrenci')
@section('title','Öğrenci')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div id="kt_content_container" class="container-xxl position-relative">
            @if ($errors->any())

                    <!-- Alert -->
                <div class="alert alert-dismissible bg-light-danger border border-danger d-flex flex-column flex-sm-row w-100 p-5 mb-10">

                    <div class="d-flex flex-column pe-0 pe-sm-5">
                        <span class="fw-bold fs-2 text-danger mb-2">Hata:</span>
                        @foreach($errors->all() as $error)
                            <span class="h5">{!! $error !!}</span>
                        @endforeach
                    </div>

                    <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto align-self-center" data-bs-dismiss="alert">
                        <i class="bi bi-x fs-1 text-danger"></i>
                    </button>
                </div>
            @else
            @endif
            <!-- Content Block -->
            <div class="no-footer">
                <form class="form" method="post" action="{{ isset($data) ? route('student.update', $data->id) : route('student.store') }}" autocomplete="off">
                    @csrf
                    @isset($data)
                        @method('PUT')
                    @endisset
                    <div class="card card-flush mb-10">

                        <div class="card-body">

                            <div class="row d-flex flex-row">
                                <div class="form-group col-md-6 fv-row">
                                    <label for="name" class="d-flex align-items-center fs-6 fw-semibold mb-2 required">
                                        <span>Öğrenci Adı Soyadı:</span>
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control form-control-solid" placeholder="Okul Adı" value="{{ old('name', isset($data) ? $data->name : '') }}" required>
                                </div>
                                <div class="form-group col-md-6 mb-5">
                                    <label for="branch_id" class="fs-6 fw-semibold mb-2">Okul Adı:</label>
                                    <div class="input-group">
                                        <select class="form-select form-select-solid" data-control="select2" data-placeholder="Seçim Yapın" name="school_id" id="school_id">
                                            <option></option>
                                            @foreach($selectedData['schools'] as $key => $row)
                                                <option value="{{ $row->id }}" @if( old('school_id', isset($data) ? $data->school_id : '')  == $row->id) selected @endif>{{ $row->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Button -->
                            <div class="card-footer d-flex justify-content-end p-0 pt-10">
                                <button type="submit" class="btn btn-primary mr-2 create-edit-button">{{ isset($data) ? 'Güncelle' : 'Ekle' }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
