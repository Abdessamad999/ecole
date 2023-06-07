@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    Edit Teacher
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    Edit_Teacher
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
                         @section('content')
                         <div class="container">
                             <h1>Modifier un élève</h1>
                             <form method="POST" action="{{ route('emplois_du_temps.update', $emplois_du_temps->id) }}">
                                 @csrf
                                 @method('PUT')
                                 <div class="form-row">
                                                          <div class="col">
                                                              <label for="intitule" >Intitulé</label>
                                                              <input type="text" id="intitule" name="intitule" value="{{ $emplois_du_temps->intitule }}" class="form-control"><br>
                                                              @error('intitule')
                                                              <div class="alert alert-danger">{{ $message }}</div>
                                                              @enderror
                                                          </div>
                                                          <div class="col">
                                                              <label for="horaire_debut">Horaire de début :</label>
                                                              <input id="horaire_debut" type="time" class="form-control" name="horaire_debut" value="{{ $emplois_du_temps->horaire_debut }}">
                                                              @error('horaire_debut')
                                                              <div class="alert alert-danger">{{ $message }}</div>
                                                              @enderror
                                                          </div>
                                 </div>
                                 <div class="form-row">
                                                          <div class="col">
                                                              <label for="horaire_fin">Horaire de fin :</label>
                                                              <input id="horaire_fin" type="time" class="form-control " name="horaire_fin" value="{{ $emplois_du_temps->horaire_fin }}">
                                                              @error('horaire_fin')
                                                              <div class="alert alert-danger">{{ $message }}</div>
                                                              @enderror
                                                          </div>
                                                          <div class="col">
                                                              <label for="jour">Jour :</label>
                                                              <select name="jour" id="jour" class="form-control">
                                                                                       <option value="">-- Choisissez un jour --</option>
                                                                                       <option value="Lundi" {{ $emplois_du_temps->jour == 'Lundi' ? 'selected' : '' }}>Lundi</option>
                                                                                       <option value="Mardi" {{ $emplois_du_temps->jour == 'Mardi' ? 'selected' : '' }}>Mardi</option>
                                                                                       <option value="Mercredi" {{ $emplois_du_temps->jour == 'Mercredi' ? 'selected' : '' }}>Mercredi</option>
                                                                                       <option value="Jeudi" {{ $emplois_du_temps->jour == 'Jeudi' ? 'selected' : '' }}>Jeudi</option>
                                                                                       <option value="Vendredi" {{ $emplois_du_temps->jour == 'Vendredi' ? 'selected' : '' }}>Vendredi</option>
                                                                                       <option value="Samedi" {{ $emplois_du_temps->jour == 'Samedi' ? 'selected' : '' }}>Samedi</option>
                                                                                       <option value="Dimanche" {{ $emplois_du_temps->jour == 'Dimanche' ? 'selected' : '' }}>Dimanche</option>
                                                              </select>
                                                              @error('jour')
                                                              <div class="alert alert-danger">{{ $message }}</div>
                                                              @enderror
                                                          </div>
                                 </div>
                                 <div class="form-row">
                                                          <div class="col">
                                                              <label for="salle">Salle :</label>
                                                              <input id="salle" type="text" class="form-control" name="salle" value="{{  $emplois_du_temps->salle}}" >
                                                              @error('salle')
                                                              <div class="alert alert-danger">{{ $message }}</div>
                                                              @enderror
                                                          </div>
                                                          <div class="col">
                                                              <label for="enseignant_id">Enseignant:</label>
                                                              <select id="enseignant_id" name="enseignant_id"  class="form-control">
                                                                                       @foreach($enseignants as $enseignant)
                                                                                                                <option value="{{ $enseignant->id }}" {{ $emplois_du_temps->enseignant_id == $enseignant->id ? 'selected' : '' }}>{{ $enseignant->nom }} {{ $enseignant->prenom }}</option>
                                                                                       @endforeach
                                                              </select>
                                                              @error('enseignant_id')
                                                              <div class="alert alert-danger">{{ $message }}</div>
                                                              @enderror
                                                          </div>
                                                          <div class="col">
                                                              <label for="matiere_id">Matière:</label>
                                                              <select id="matiere_id" name="matiere_id"  class="form-control">
                                                                                    @foreach($matieres as $matiere)
                                                                                       <option value="{{ $matiere->id }}" {{ $emplois_du_temps->matiere_id == $matiere->id ? 'selected' : '' }}>{{ $matiere->nom }}</option>
                                                                                     @endforeach
                                                              </select>
                                                              @error('matiere_id')
                                                              <div class="alert alert-danger">{{ $message }}</div>
                                                              @enderror
                                                          </div>
                                 </div>
                                 
                                 <button type="submit" class="btn btn-success btn-sm nextBtn btn-lg pull-right">modifier</button>
                             </form>
                        </div>

                      </div>
                    </div>
                 </div>
           </div>
        </div>
    </div>
@endsection
