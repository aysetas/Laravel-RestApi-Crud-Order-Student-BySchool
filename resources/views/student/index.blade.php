@extends('layouts.master')
@section('subheader','Okul')
@section('title','Okul')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div id="kt_content_container" class="container-xxl position-relative">
            <!-- Table -->
            <div class="g-5 gx-xxl-8">

                <!-- Table - Top Block -->
                <div class="card">

                    <!-- Table - Content Block -->
                    <div class="card-body pt-3">
                        <div class="card-toolbar d-flex justify-content-end responsive-active-header" >
                            <a href="{{ route('student.create') }}" class="btn btn-light-success btn-icon-success create-new log-ticket-button">
                                <i class="fas fa-plus icon-2x"></i>
                                <span class="fw-bold fs-5">Öğrenci Ekle</span>
                            </a>
                        </div>
                        <!-- Table -->
                        <div class="table-responsive table-sticky-header">

                            <table class="table table-hover table-row-dashed table-striped table-row-gray-300 align-middle gs-4 gy-4">
                                <!-- Table - Header -->
                                <thead>
                                <tr class="fs-6 fw-bold text-muted" >
                                    <th class="min-w-40px">#</th>
                                    <th class="min-w-200px">Öğrenci Adı</th>
                                    <th class="min-w-200px">Okul Adı</th>
                                    <th class="min-w-100px text-end">İşlemler</th>
                                </tr>
                                </thead>

                                <!-- Table - Body -->
                                <tbody>

                                @php
                                    $firstItemNumber = $data->firstItem();
                                @endphp

                                @foreach($data as $key => $value)
                                    <tr>
                                        <td class="w-40px">
                                            <span class="text-dark fw-bold mb-1 fs-6">{{ $firstItemNumber++ }}</span>
                                        </td>

                                        <td class="w-200px">
                                            <span class="text-dark fw-bold mb-1 fs-6">{{ $value->name }}</span>
                                        </td>
                                        <td class="w-200px">
                                            <span class="text-dark fw-bold mb-1 fs-6">{{ optional($value->school)->name ?? '-' }}</span>
                                        </td>
                                        <!-- Action Buttons -->
                                        <td class="text-end w-100px">
                                            <a href="{{ route('student.edit', $value->id) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 bg-secondary" data-bs-toggle="tooltip" data-bs-placement="left" title="Düzenle">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <a href="{{route('student.destroy',$value->id)}}" class="delete-confirm btn btn-icon btn-bg-light btn-active-color-danger btn-sm  bg-secondary" data-bs-toggle="tooltip" data-bs-placement="right" title="Sil">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <a href="{{route('student.show',$value->id)}}" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm  bg-secondary" data-bs-toggle="tooltip" data-bs-placement="right" title="Sil">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>

                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="js-pagination d-flex border-top-1 align-items-center justify-content-center my-3">
                            {{ $data->links() }}
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $('.delete-confirm').click(function (e) {
            e.preventDefault();
            let url = $(this).attr('href');
          Swal.fire({
                title: 'Silmek için emin misin?',
                text: "Bu öğeyi silmek istediğine emin misin?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Evet, Sil!',
                cancelButtonText: 'Hayır, Silme!',
                reverseButtons: true
            }).then(function (result) {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (data) {
                            Swal.fire(
                                'Silindi!',
                                'İlgili içerik başarıyla silindi!',
                                'success'
                            );
                            setTimeout(function () {
                                location.reload();
                            }, 2000);

                        },
                        error: function () {
                            Swal.fire(
                                'Hata!',
                                'Silme işlemi sırasında bir hata oluştu!',
                                'error'
                            );
                        }
                    });
                } else if (result.dismiss === 'cancel') {
                    Swal.fire(
                        'İptal edildi!',
                        'Silme işlemi iptal edildi!',
                        'warning'
                    );
                }
            });
        });
    </script>
@endsection

