@foreach ($tasks as $item)
<div class="modal fade" role="dialog" id="modalDeleteTask{{ $item->id }}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin ingin menghapus tugas {{ $item->name }}?</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="{{ url('dosen/classes/'.$item->id.'/delete-task') }}" class="btn btn-danger">Delete task</a>
                </div>
        </div>
    </div>
</div>
@endforeach
