@extends('Layout')

@section('titre')
    Gestion [#classe]
@endsection

@section('contenu')
<h2 class="mb-2 page-title">Gestion [#classe]</h2>
{{--     Modale ajout     --}}
<div class="modal fade ajouter"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter [#classe]</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <form action="{{ url('[#classe]/insert') }}" method="POST">
                @csrf
                <div class="modal-body">
                    [#Champ]
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
                    <h5 class="modal-title" id="exampleModalLabel">Modifier [#classe]</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="editForm" action="{{ url('[#classe]/modifier') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id[#classe]" id="id[#classe]">
                        [#ChampModal]
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
                [#liste]

            </table>
                       <style>
                svg{
                    width: 40px;
                }
            </style>
            <div class="d-flex justify-content-center">{{ $[#classe]s->onEachSide(1)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
        
        [#script]

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
