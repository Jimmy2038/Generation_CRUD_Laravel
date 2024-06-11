@extends('Layout')

@section('titre')
    Gestion penalite_equipe
@endsection

@section('contenu')
<h2 class="mb-2 page-title">Gestion penalite_equipe</h2>
{{--     Modale ajout     --}}
<div class="modal fade ajouter"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter penalite_equipe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="{{ url('penalite_equipe/insert') }}" method="POST">
                @csrf
                <div class="modal-body">
                                  <div class="form-group ">
                    <label for="equipe">Choix équipe</label>
                    <select class="form-control" name="equipe">
                        @foreach($equipes as $row)
                            <option value="{{$row->id}}">{{$row->equipe}}</option>
                        @endforeach
                    </select>
                    @error('equipe')
                    <div class="invalid-feedbpack">{{ $message }}</div>
                    @enderror
                </div>
              <div class="form-group ">
                    <label for="etape">Choix étape</label>
                    <select class="form-control" name="etape">
                        @foreach($etapes as $row)
                            <option value="{{$row->id}}">{{$row->etape}}</option>
                        @endforeach
                    </select>
                    @error('etape')
                    <div class="invalid-feedbpack">{{ $message }}</div>
                    @enderror
                </div>
<div class="form-group">
    <label for="penalite">Penalite</label>
    <input type="text" class="form-control @error('penalite') is-invalid @enderror" id="penalite" name="penalite" placeholder="hh:mm:ss">
    @error('penalite')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

                </div>
                
                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save </button>
                </div>
            </form>
        </div>
    </div>
</div>
    <hr>

    {{--     Modale modification     --}}

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier penalite_equipe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" action="{{ url('penalite_equipe/modifier') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="idpenalite_equipe" id="idpenalite_equipe">
                                      <div class="form-group ">
                    <label for="equipe">Choix équipe</label>
                    <select class="form-control" name="equipemodal">
                        @foreach($equipes as $row)
                            <option value="{{$row->id}}">{{$row->equipe}}</option>
                        @endforeach
                    </select>
                    @error('equipemodal')
                    <div class="invalid-feedbpack">{{ $message }}</div>
                    @enderror
                </div>
              <div class="form-group ">
                    <label for="etape">Choix étape</label>
                    <select class="form-control" name="etapemodal">
                        @foreach($etapes as $row)
                            <option value="{{$row->id}}">{{$row->etape}}</option>
                        @endforeach
                    </select>
                    @error('etapemodal')
                    <div class="invalid-feedbpack">{{ $message }}</div>
                    @enderror
                </div>
<div class="form-group">
    <label for="penalite_modal">Penalite</label>
    <input type="text" id="penalite_modal" class="form-control @error('penalitemodal') is-invalid @enderror" id="penalitemodal" name="penalitemodal" placeholder="hh:mm:ss">
    @error('penalitemodal')
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
                <a href="./#" data-toggle="modal" data-target=".ajouter">
                    <button type="button" class="btn mb-2 btn-success" style="float: right;">
                        New <span class="fe fe-16 fe-plus"></span>
                    </button>
                </a>
                <thead>
    <tr>
        <th>idpenalite_equipe</th>
        <th>Choix équipe</th>
        <th>Choix étape</th>
        <th>Penalite</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
@foreach($penalite_equipes as $row)
    <tr>
        <td>{{$row->id}}</td>
        <td>{{$row->equipe}}</td>
        <td>{{$row->etape}}</td>
        <td>{{$row->penalite}}</td>
        <td>
            <button class="btn btn-primary"
                    onclick="openModal('{{$row->id}}', '{{$row->equipe}}', '{{$row->etape}}', '{{$row->penalite}}')"><i class="fe fe-edit-2"></i></button>
            <button class="btn btn-danger"><a href="{{ url('penalite_equipe/delete/'.$row->id) }}"><i class="fe fe-trash-2"></i></a></button>
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
            <div class="d-flex justify-content-center">{{ $penalite_equipes->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
        
        <script>
function openModal(idpenalite_equipe, equipe, etape, penalite) {
    document.getElementById('idpenalite_equipe').value = idpenalite_equipe;
    document.getElementById('equipe_modal').value = equipe;
    document.getElementById('etape_modal').value = etape;
    document.getElementById('penalite_modal').value = penalite;
    $('#exampleModal').modal('show');
}
</script>


    @if(session('modifier'))
        <script>
            $(document).ready(function (){
                $('#exampleModal').modal('show');
            });
        </script>
    @endif
    
    @if(session('ajouter'))
        <script>
            $(document).ready(function (){
                $('.ajouter').modal('show');
            });
        </script>
    @endif
@endsection
