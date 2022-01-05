@foreach ($menteeTasks as $item)
<div class="modal fade" role="dialog" id="modalUpdateGrade{{ $item->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form id="createRecord" action="{{ url('dosen/'.$item->id.'/'.$item->users->id.'/update-grade') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Beri Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="form-label">Nama Siswa</label>
                        <input type="text" class="form-control" id="name"
                            value='{{ $item->users->name }}' readonly>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Nama Tugas</label>
                        <input type="text" class="form-control" id="name"
                            value="{{ $item->tasks->name }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Nilai</label>
                        <input type="number" min="0" class="form-control" id="name" name="grade">
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
