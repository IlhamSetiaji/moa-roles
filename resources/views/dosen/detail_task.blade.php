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
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            #
                                                        </th>
                                                        <th>Nama Mahasiswa</th>
                                                        <th>Nama Tugas</th>
                                                        <th>Status</th>
                                                        <th>Grade</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($menteeTasks as $key => $item)
                                                    <tr>
                                                        <td>
                                                            {{ $key+1 }}
                                                        </td>
                                                        <td>
                                                            {{ $item->users->name }}
                                                        </td>
                                                        <td>
                                                            {{ $item->tasks->name }}
                                                        </td>
                                                        <td>
                                                            {{ $item->status }}
                                                        </td>
                                                        <td>
                                                            {{ $item->grade }}
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-primary" href="{{ url('dosen/'.$item->id.'/'.$item->users->id.'/show-files') }}">Lihat List Files</a>
                                                            <a class="btn btn-success" href="#" data-toggle="modal"
                                                                data-target="#modalUpdateGrade{{ $item->id }}">Beri Penilaian</a>
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
    @include('dosen.modal.update_grade')
@include('stisla.script')
</body>

</html>
