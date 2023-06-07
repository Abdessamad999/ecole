@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
ajouter cours
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
ajouter cours
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form method="POST" action="{{ route('cours.store') }}">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label for="nom">Nom du cours:</label>
                                    <input type="text" class="form-control" id="nom" name="nom">
                                    @error('nom')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="enseignant_id">Enseignant:</label>
                                    <select class="form-control" id="enseignant_id" name="enseignant_id">
                                        @foreach($enseignants as $enseignant)
                                        <option value="{{ $enseignant->id }}">{{ $enseignant->nom }} {{
                                            $enseignant->prenom }}</option>
                                        @endforeach
                                    </select>
                                    @error('enseignant_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="matiere_id">Matière:</label>
                                    <select class="form-control" id="matiere_id" name="matiere_id">
                                        @foreach($matieres as $matiere)
                                        <option value="{{ $matiere->id }}">{{ $matiere->nom }}</option>
                                        @endforeach
                                    </select>
                                    @error('matiere_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="salle">Salle:</label>
                                    <input type="text" class="form-control" id="salle" name="salle">
                                    @error('salle')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="jour">Jour</label>
                                    <select class="form-control" id="jour" name="jour" required>
                                        <option value="Lundi">Lundi</option>
                                        <option value="Mardi">Mardi</option>
                                        <option value="Mercredi">Mercredi</option>
                                        <option value="Jeudi">Jeudi</option>
                                        <option value="Vendredi">Vendredi</option>
                                        <option value="Samedi">Samedi</option>
                                        <option value="Dimanche">Dimanche</option>
                                    </select>
                                    @error('jour')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="heure_debut">Heure de début:</label>
                                    <input type="time" class="form-control" id="heure_debut" name="heure_debut">
                                    @error('heure_debut')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="heure_fin">Heure de fin:</label>
                                    <input type="time" class="form-control" id="heure_fin" name="heure_fin">
                                    @error('heure_fin')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="col">
                                    <label for="titre">titre:</label>
                                    <input type="text" class="form-control" id="titre" name="titre">
                                    @error('titre')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="description">description :</label>
                                    <input type="text" class="form-control" id="description" name="description">
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <br>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">Next</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- row closed -->
    @endsection
    @section('js')
    @toastr_js
    @toastr_render
    @endsection