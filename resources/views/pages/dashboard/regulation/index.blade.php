@extends('layouts.dashboard')

@section('title', 'Peraturan')

@push('style')
    @include('style.datatable')
@endpush

@section('content')

    <div class="content-header">
        <div class="d-flex justify-content-between">
            <h5>Data</h5>
            {{-- button add with modal --}}
            <a href="{{ route('peraturan.create') }}"
                class="btn d-sm-block d-md-block d-lg-block d-xl-block d-none btn-primary mb-2">
                Tambah Peraturan
            </a>
        </div>
        <a href="#" class="btn d-md-none d-lg-none d-xl-none d-block btn-primary mb-2">
            Tambah Peraturan
        </a>
    </div>


    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="data-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Judul</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($regulations as $regulation)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $regulation->title }}</td>
                            <th>{{ $regulation->date }}</th>
                            <th>{{ strtoupper(str_replace('_', ' ', $regulation->status)) }}</th>
                            <td>
                                @if ($regulation->status != 'analisa_evaluasi')
                                    <button type="button" class="btn btn-success btn-update-data"
                                        data-id="{{ $regulation->id }}" data-toggle="modal"
                                        data-target="#updateStatusModal">
                                        Update Status
                                    </button>

                                    {{-- Button Modal Update Status --}}
                                    {{-- <form action="{{ route('peraturan.update-status', $regulation->id) }}" method="post"
                                        class="delete-form d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" class="btn btn-success btn-update-data">Update
                                            Status</button>
                                    </form> --}}
                                @endif

                                <a href="{{ route('peraturan.show', $regulation->id) }}"
                                    class="btn btn-primary btn">Detail</a>
                                <a href="{{ route('peraturan.edit', $regulation->id) }}"
                                    class="btn btn-primary btn">Edit</a>
                                <form action="{{ route('peraturan.destroy', $regulation->id) }}" method="post"
                                    class="delete-form d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-danger btn-delete-data">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
            </table>
        </div>
    </div>

    <!-- Modal Update Status -->
    <div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog" aria-labelledby="updateStatusModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStatusModalLabel">Update Status Peraturan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateStatusForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="status">Pilih Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="pengusulan">Perencanaan</option>
                                <option value="penyusunan_pembahasan">Penyusunan Pembahasan</option>
                                <option value="partisipasi_publik">Partisipasi Publik</option>
                                <option value="persetujuan_pimpinan">Persetujuan Pimpinan</option>
                                <option value="penyelarasan">Penyelarasan</option>
                                <option value="penetapan">Penetapan</option>
                                <option value="pengundangan_peraturan">Pengundangan Peraturan</option>
                                <option value="penyusunan_informasi">Penyusunan Informasi</option>
                                <option value="penyebarluasan">Penyebarluasan</option>
                                <option value="laporan_proses">Laporan Proses</option>
                                <option value="analisa_evaluasi">Analisa Evaluasi</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="submitStatusUpdate">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('script')
    @include('scripts.datatable')

    <script>
        $(function() {
            let table = $("#data-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            }).buttons().container().appendTo('#data-table_wrapper .col-md-6:eq(0)');

            // Open modal and set action URL
            $('.btn-update-data').on('click', function() {
                let regulationId = $(this).data('id');
                let url = "{{ route('peraturan.update-status', ':id') }}";
                url = url.replace(':id', regulationId);

                $('#updateStatusForm').attr('action', url); // Set form action
            });

            // Submit form via AJAX
            $('#submitStatusUpdate').on('click', function() {
                $.ajax({
                    url: $('#updateStatusForm').attr('action'),
                    method: 'PUT',
                    data: $('#updateStatusForm').serialize(),
                    success: function(response) {
                        $('#updateStatusModal').modal('hide');
                        Swal.fire('Berhasil!', 'Status peraturan berhasil diperbarui',
                            'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        Swal.fire('Error!', 'Gagal memperbarui status', 'error');
                    }
                });
            });

            $('.btn-delete-data').on('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).closest('form').submit();
                    }
                })
            })

            // $('.btn-update-data').on('click', function(e) {
            //     e.preventDefault();
            //     Swal.fire({
            //         title: 'Apakah anda yakin?',
            //         text: "Status peraturan yang diubah tidak dapat dikembalikan!",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'Ya, Hapus!'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             $(this).closest('form').submit();
            //         }
            //     })
            // })
        });
    </script>
@endpush
