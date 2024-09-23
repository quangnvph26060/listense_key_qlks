@extends('layouts.master')

@section('content')
    <div class="container">
        <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                                                              <div class="container-fluid">
                                                                                <button
                                                                                  class="navbar-toggler"
                                                                                  type="button"
                                                                                  data-bs-toggle="collapse"
                                                                                  data-bs-target="#navbarNav"
                                                                                  aria-controls="navbarNav"
                                                                                  aria-expanded="false"
                                                                                  aria-label="Toggle navigation"
                                                                                >
                                                                                  <span class="navbar-toggler-icon"></span>
                                                                                </button>
                                                                                <div class="collapse navbar-collapse" id="navbarNav">
                                                                                  <ul class="navbar-nav">
                                                                                    <li class="nav-item">
                                                                                      <a class="nav-link active" aria-current="page" href="#"
                                                                                        >Home</a
                                                                                      >
                                                                                    </li>
                                                                                    <li class="nav-item">
                                                                                      <a class="nav-link" href="#">Features</a>
                                                                                    </li>
                                                                                    <li class="nav-item">
                                                                                      <a class="nav-link" href="#">Pricing</a>
                                                                                    </li>
                                                                                    <li class="nav-item">
                                                                                      <a class="nav-link disabled">Disabled</a>
                                                                                    </li>
                                                                                  </ul>
                                                                                </div>
                                                                              </div>
                                                                            </nav> -->
        <div class="logout p-2 d-flex justify-content-between">
            <a href="{{ route('logout') }}" class="btn btn-outline-danger">Đăng xuất</a>
            <button type="button" class="btn btn-primary btn-add">Thêm
                mới</button>
        </div>
    </div>

    <main>
        <div class="container">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h2 class="card-title">{{ $title }}</h2>
                    <div class="card-tools d-flex align-items-center">
                        <div class="input-group input-group-sm" style="width: 200px">
                            <input type="text" name="table_search" class="form-control float-right searchInput"
                                placeholder="Search" />
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-hover text-center" id="data-table">
                        <thead>
                            <tr>
                                <th scope="col">Code</th>
                                <th scope="col">Url</th>
                                <th scope="col">User</th>
                                <th scope="col">Email</th>
                                <th scope="col">Product</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">


                        </tbody>
                    </table>

                    <div id="pagination">
                    </div>

                </div>
            </div>
        </div>
    </main>

    <!-- Modal Add/Update -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span>Thêm mới/Listense Key</span> <strong
                            class="key"></strong>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="form">
                        @csrf
                        <input type="hidden" name="_method" id="method" value="POST">
                        <input type="hidden" name="id" id="recordId">
                        <div class="row">
                            <div class="form-group mb-3 col-md-6">
                                <label for="code" class="form-label">Code</label>
                                <input type="text" name="code" class="form-control" id="code"
                                    placeholder="Nhập mã">
                            </div>
                            <div class="form-group mb-3 col-md-6">
                                <label for="url" class="form-label">Url</label>
                                <input type="text" name="url" class="form-control" id="url"
                                    placeholder="Nhập đường dẫn">
                            </div>
                            <div class="form-group mb-3 col-md-6">
                                <label for="user" class="form-label">User</label>
                                <input type="text" name="user" class="form-control" id="user"
                                    placeholder="Nhập người dùng">
                            </div>
                            <div class="form-group mb-3 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" class="form-control" id="email"
                                    placeholder="Nhập email">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('back_end/public/assets/js/dataTable.js') }}"></script>

    <script>
        $(document).ready(function() {

            const apiUrl = "{{ route('home') }}";
            initDataFetch(apiUrl);

            $("#form").on('submit', function(e) {
                e.preventDefault();

                const method = $('#method').val();
                const url = method === 'PUT' ? "{{ route('listense-key.update', ':id') }}".replace(':id', $(
                    '#recordId').val()) : "{{ route('listense-key.store') }}";

                $.ajax({
                    url: url,
                    type: method,
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status) {
                            $("#form")[0].reset();
                            $('#code').removeClass('is-invalid');
                            initDataFetch(apiUrl);
                            $("#modal").modal('hide');
                            showSwalMessage('success', response.message);
                        } else {
                            $('#code').addClass('is-invalid');
                            showSwalMessage('error', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });


            $(document).on('click', '.btn-edit', function() {
                const id = $(this).data('id');

                $.ajax({
                    url: "{{ route('listense-key.edit', ':id') }}".replace(':id', id),
                    type: 'GET',
                    success: function(response) {
                        $('#code').val(response.data.code);
                        $('#url').val(response.data.url);
                        $('#user').val(response.data.user);
                        $('#email').val(response.data.email);
                        $('.key').text(response.data.code);
                        $('#recordId').val(id);
                        $('#method').val('PUT'); // Đặt phương thức thành PUT
                        $('#exampleModalLabel').siblings('span').text(
                            'Cập nhật Listense Key'); // Đặt tiêu đề là "Cập nhật"
                        $('#modal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $(document).on('click', '.btn-add', function() {
                $('#form')[0].reset();
                $('#method').val('POST'); // Đặt phương thức thành POST
                $('.key').text(''); // Xóa key
                $('#exampleModalLabel').siblings('span').text('Thêm Listense Key'); // Đặt lại tiêu đề là "Thêm mới"
                $('#modal').modal('show');
            });

            $(document).on('click', '.btn-delete', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Bạn chắc chắn chứ?',
                    text: "Bạn sẽ không thể khôi phục dữ liệu lại được nữa!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có, xóa nó đi!',
                    cancelButtonText: 'Hủy!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('listense-key.destroy', ':id') }}".replace(':id',
                                id),
                            type: 'DELETE',
                            success: function(response) {
                                if (response.status) {
                                    initDataFetch(apiUrl);
                                    showSwalMessage('success', response.message);
                                } else {
                                    showSwalMessage('error', response.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(xhr.responseText);
                            }
                        });
                    }
                })
            })
        });
    </script>
@endpush
