<!DOCTYPE html>
<html lang="en">

@include('stisla.head')

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            @include('stisla.navbar')
            @include('stisla.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    @if (session('status'))
                    <div class="alert alert-warning alert-dismissible show fade">
                        <div class="alert-body">
                            <button class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                            {{ session('status') }}
                        </div>
                    </div>
                    @endif
                    <div class="section-header">
                        <h1>Halaman Dosen</h1>
                    </div>

                    <div class="section-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Data Tugas</h4>
                                        <a href="#" class="btn btn-icon icon-left btn-success ml-auto" data-toggle="modal"
                                        data-target="#modalCreateTask"><i class="fas fa-plus"></i> Tambah Tugas</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            #
                                                        </th>
                                                        <th>Nama Tugas</th>
                                                        <th>Deskripsi</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($tasks as $key => $item)
                                                    <tr>
                                                        <td>
                                                            {{ $key+1 }}
                                                        </td>
                                                        <td>
                                                            {{ $item->name }}
                                                        </td>
                                                        <td>
                                                            {{ $item->description }}
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-warning" href="#" data-toggle="modal"
                                                                data-target="#modalEditTask{{ $item->id }}">Edit</a>
                                                            <a class="btn btn-danger" href="#" data-toggle="modal"
                                                            data-target="#modalDeleteTask{{ $item->id }}">Delete</a>
                                                            <a href="{{ url('dosen/'.$item->id.'/task') }}" class="btn btn-primary">Lihat detail tugas</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            @include('stisla.footer')
        </div>
    </div>
    @include('dosen.modal.create_task')
    @include('dosen.modal.edit_task')
    @include('dosen.modal.delete_task')
@include('stisla.script')
</body>

</html>
