@extends('layouts.master')
@section('subheader','Okul')
@section('title','Okul')

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
                <form class="form" method="post" action="{{ isset($data) ? route('school.update', $data->id) : route('school.store') }}" autocomplete="off">
                    @csrf
                    @isset($data)
                        @method('PUT')
                    @endisset
                    <div class="card card-flush mb-10">

                        <div class="card-body">
                                <div class="form-group col-md-6 fv-row">
                                    <label for="name" class="d-flex align-items-center fs-6 fw-semibold mb-2 required">
                                        <span>Okul Adı:</span>
                                    </label>
                                    <input type="text" name="name" id="name" class="form-control form-control-solid" placeholder="Okul Adı" value="{{ old('name', isset($data) ? $data->name : '') }}" required>
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
