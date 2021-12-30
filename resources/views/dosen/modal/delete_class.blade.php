@foreach ($masterClasses as $item)
<div class="modal fade" role="dialog" id="modalDeleteClass{{ $item->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Class</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus kelas {{ $item->name }}?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="{{ url('dosen/'.$item->id.'/delete-class') }}" class="btn btn-danger">Delete class</a>
                </div>
        </div>
    </div>
</div>
@endforeach
