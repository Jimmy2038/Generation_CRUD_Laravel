@extends('Layout')

@section('titre')
    Gestion maison_traveau
@endsection

@section('contenu')
<h2 class="mb-2 page-title">Gestion maison_traveau</h2>
    <div class="card shadow col-md-6">
        <div class="card-body">
            <form action="{{ url('maison_traveau/insert') }}" method="POST">
                @csrf
                <div class="form-group">
    <label for="designation">Designation</label>
    <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" placeholder="Votre designation">
    @error('designation')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
              <div class="form-group col-md-6">
                    <label for="id_traveau">>id_traveau</label>
                    <select class="form-control" name="id_traveau">
                        @foreach($id_traveaus as $row)
                            <option value="{{$row->idid_traveau>}}">{{$row->id_traveau}}</option>
                        @endforeach
                    </select>
                    @error('id_traveau')
                    <div class="invalid-feedbpack">{{ $message }}</div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Modifier maison_traveau</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" action="{{ url('maison_traveau/modifier') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="idmaison_traveau" id="idmaison_traveau">
                        <div class="form-group">
    <label for="designation_modal">Designation</label>
    <input type="text" id="designation_modal" class="form-control @error('designationmodal') is-invalid @enderror" id="designationmodal" name="designationmodal" placeholder="Votre designation">
    @error('designationmodal')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
              <div class="form-group col-md-6">
                    <label for="id_traveau">id_traveau</label>
                    <select class="form-control" name="id_traveaumodal">
                        @foreach($id_traveaus as $row)
                            <option value="{{$row->idid_traveau>}}">{{$row->id_traveau}}</option>
                        @endforeach
                    </select>
                    @error('id_traveaumodal')
                    <div class="invalid-feedbpack">{{ $message }}</div>
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
        <th>idmaison_traveau</th>
        <th>Designation</th>
        <th>id_traveau</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
@foreach($maison_traveaus as $row)
    <tr>
        <td>{{$row->id}}</td>
        <td>{{$row->designation}}</td>
        <td>{{$row->id_traveau}}</td>
        <td>
            <button class="btn btn-primary"
                    onclick="openModal('{{$row->id}}', '{{$row->designation}}', '{{$row->id_traveau}}')"><i class="fe fe-edit-2"></i></button>
            <button class="btn btn-danger"><a href="{{ url('maison_traveau/delete/'.$row->id) }}"><i class="fe fe-trash-2"></i></a></button>
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
            <div class="d-flex justify-content-center">{{ $maison_traveaus->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

        <script>
function openModal(idmaison_traveau, designation, id_traveau) {
    document.getElementById('idmaison_traveau').value = idmaison_traveau;
    document.getElementById('designation_modal').value = designation;
    document.getElementById('id_traveau_modal').value = id_traveau;
    $('#exampleModal').modal('show');
}
</script>

@endsection
