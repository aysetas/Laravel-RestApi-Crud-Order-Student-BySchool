@extends('layouts.master')
@section('subheader','Öğrenci')
@section('title','Öğrenci')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div id="kt_content_container" class="container-xxl position-relative">
            <div class="card card-custom gutter-b">
                <!--begin::Body-->
                <div class="card-body pt-8">
                    <!--begin::Contact-->
                    <div class="pt-6 pb-8 col-md-12">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">Öğrenci:</span>
                            <span class="text-muted">{{ $data->name }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">Okul Adı:</span>
                            <span class="text-muted">{{ optional($data->school)->name ?? '-' }}</span>
                        </div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Card-->
            </div>
        </div>
@endsection

