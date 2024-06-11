@extends('Layout')

@section('contenu')
    <div class="card shadow col-md-6">
        <div class="card-body">
            <form action="{{ url('essai/insert') }}" method="POST">
                @csrf
                <div class="form-group">
    <label for="designation">Designation</label>
    <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" placeholder="Votre designation">
    @error('designation')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <hr>

    {{--     Modale modification     --}}

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier essai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" action="{{ url('essai/modifier') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="idessai" id="idessai">
                        <div class="form-group">
    <label for="designation_modal">Designation</label>
    <input type="text" id="designation_modal" class="form-control @error('designationmodal') is-invalid @enderror" id="designationmodal" name="designationmodal" placeholder="Votre designation">
    @error('designationmodal')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
    <tr>
        <th>idessai</th>
        <th>Designation</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
@foreach($essais as $row)
    <tr>
        <td>{{$row->idessai}}</td>
        <td>{{$row->designation}}</td>
        <td>
            <button class="btn btn-primary"
                    onclick="openModal('{{$row->idessai}}', '{{$row->designation}}')"><i class="fe fe-edit-2"></i></button>
            <button class="btn btn-danger"><a href="{{ url('essai/delete/'.$row->idessai) }}"><i class="fe fe-trash-2"></i></a></button>
        </td>
    </tr>
@endforeach
</tbody>


            </table>
                       <style>
                svg{
                    width: 40px;
                }
            </style>
            <div class="d-flex justify-content-center">{{ $essais->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

        <script>
function openModal(idessai, designation) {
    document.getElementById('idessai').value = idessai;
    document.getElementById('designation_modal').value = designation;
    $('#exampleModal').modal('show');
}
</script>

@endsection
