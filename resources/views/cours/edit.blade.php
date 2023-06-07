@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
ajouter eleve
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
ajouter eleve
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
                        
                        <form method="POST" action="{{ route('cours.update', $cours->id) }}">
                            @csrf
                            @method('PUT')
                            <h1>Modifier cours {{$cours->nom }}</h1>
                            <div class="form-row">
                                <div class="col">
                                    <label for="nom">Nom du cours:</label>
                                    <input type="text" class="form-control" id="nom" name="nom" value="{{ $cours->nom }}">
                                    @error('nom')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div> 
                                <div class="col">
                                    <label for="matiere_id">Matière :</label>
                                    <select name="matiere_id" id="matiere_id" class="form-control selectpicker">
                                       @foreach($matieres as $matiere)
                                        <option value="{{ $matiere->id }}" {{ $cours->matiere_id == $matiere->id ? 'selected' : '' }}>{{ $matiere->nom }}</option>
                                        @endforeach
                                    </select>
                                    @error('matiere_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="enseignant_id">Enseignant :</label>
                                    <select name="enseignant_id" id="enseignant_id" class="form-control">
                                        @foreach($enseignants as $enseignant)
                                            <option value="{{ $enseignant->id }}" {{ $cours->enseignant_id == $enseignant->id ? 'selected' : '' }}>{{ $enseignant->nom }} {{ $enseignant->prenom }}</option>
                                        @endforeach
                                    </select>
                                    @error('enseignant_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="salle">Salle:</label>
                                    <input type="text" class="form-control" id="salle" name="salle" value="{{ $cours->salle }}">
                                    @error('salle')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div>
                                       
                                </div>
                                <div class="col d-flex justify-content-between">
                                    <div>
                                        <label for="jour">Jour :</label>
                                        <select name="jour" id="jour" class="form-control">
                                           <option value="lundi" {{ $cours->jour == 'lundi' ? 'selected' : '' }}>Lundi</option>
                                           <option value="mardi" {{ $cours->jour == 'mardi' ? 'selected' : '' }}>Mardi</option>
                                           <option value="mercredi" {{ $cours->jour == 'mercredi' ? 'selected' : '' }}>Mercredi</option>
                                           <option value="jeudi" {{ $cours->jour == 'jeudi' ? 'selected' : '' }}>Jeudi</option>
                                           <option value="vendredi" {{ $cours->jour == 'vendredi' ? 'selected' : '' }}>Vendredi</option>
                                           <option value="samedi" {{ $cours->jour == 'samedi' ? 'selected' : '' }}>Samedi</option>
                                           <option value="dimanche" {{ $cours->jour == 'dimanche' ? 'selected' : '' }}>Dimanche</option>
                                        </select>
                                    @error('jour')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    </div>
                                    <div>
                                    <label for="heure_debut">Heure de début:</label>
                                    <input type="time" class="form-control" id="heure_debut" name="heure_debut" value="{{ $cours->heure_debut }}">
                                    @error('heure_debut')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="heure_fin">Heure de fin:</label>
                                    <input type="time" class="form-control" id="heure_fin" name="heure_fin" value="{{ $cours->heure_fin }}">
                                    @error('heure_fin')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <label for="description">description :</label>
                                    <input type="text" class="form-control" id="description" name="description" value="{{ $cours->description }}">
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                </div>
                                <div class="col">
                                  
                                </div>
                                <div class="col">
                                    <label for="titre">titre:</label>
                                    <input type="text" class="form-control" id="titre" name="titre" value="{{ $cours->titre }}">
                                    @error('titre')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
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