@extends('Layout')

@section('titre')
    Gestion maison
@endsection

@section('contenu')
<h2 class="mb-2 page-title">Gestion maison</h2>
    <div class="card shadow col-md-6">
        <div class="card-body">
            <form action="{{ url('maison/insert') }}" method="POST">
                @csrf
                <div class="form-group">
    <label for="designation">Designation</label>
    <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" placeholder="Votre designation">
    @error('designation')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="description">Description</label>
    <input type="text" class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Votre description">
    @error('description')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="surface">Surface</label>
    <input type="text" class="form-control @error('surface') is-invalid @enderror" id="surface" name="surface" placeholder="Entrer un surface">
    @error('surface')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="duree">Duree</label>
    <input type="text" class="form-control @error('duree') is-invalid @enderror" id="duree" name="duree" placeholder="Entrer le duree">
    @error('duree')
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
                    <h5 class="modal-title" id="exampleModalLabel">Modifier maison</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" action="{{ url('maison/modifier') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="idmaison" id="idmaison">
                        <div class="form-group">
    <label for="designation_modal">Designation</label>
    <input type="text" id="designation_modal" class="form-control @error('designationmodal') is-invalid @enderror" id="designationmodal" name="designationmodal" placeholder="Votre designation">
    @error('designationmodal')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="description_modal">Description</label>
    <input type="text" id="description_modal" class="form-control @error('descriptionmodal') is-invalid @enderror" id="descriptionmodal" name="descriptionmodal" placeholder="Votre description">
    @error('descriptionmodal')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="surface_modal">Surface</label>
    <input type="text" id="surface_modal" class="form-control @error('surfacemodal') is-invalid @enderror" id="surfacemodal" name="surfacemodal" placeholder="Entrer un surface">
    @error('surfacemodal')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="duree_modal">Duree</label>
    <input type="text" id="duree_modal" class="form-control @error('dureemodal') is-invalid @enderror" id="dureemodal" name="dureemodal" placeholder="Entrer le duree">
    @error('dureemodal')
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
        <th>idmaison</th>
        <th>Designation</th>
        <th>Description</th>
        <th>Surface</th>
        <th>Duree</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
@foreach($maisons as $row)
    <tr>
        <td>{{$row->id}}</td>
        <td>{{$row->designation}}</td>
        <td>{{$row->description}}</td>
        <td>{{$row->surface}}</td>
        <td>{{$row->duree}}</td>
        <td>
            <button class="btn btn-primary"
                    onclick="openModal('{{$row->id}}', '{{$row->designation}}', '{{$row->description}}', '{{$row->surface}}', '{{$row->duree}}')"><i class="fe fe-edit-2"></i></button>
            <button class="btn btn-danger"><a href="{{ url('maison/delete/'.$row->id) }}"><i class="fe fe-trash-2"></i></a></button>
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
            <div class="d-flex justify-content-center">{{ $maisons->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

        <script>
function openModal(idmaison, designation, description, surface, duree) {
    document.getElementById('idmaison').value = idmaison;
    document.getElementById('designation_modal').value = designation;
    document.getElementById('description_modal').value = description;
    document.getElementById('surface_modal').value = surface;
    document.getElementById('duree_modal').value = duree;
    $('#exampleModal').modal('show');
}
</script>

@endsection
