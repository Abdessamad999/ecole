@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
ajouter EMPLOIS DU TEMPS
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
ajouter EMPLOIS DU TEMPS
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
                        <form action="{{route('emplois_du_temps.store')}}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label for="intitule">Intitulé :</label>
                                    <input type="text" name="intitule" id="intitule" class="form-control">

                                    @error('intitule')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="horaire_debut">Horaire de début :</label>
                                    <input type="time" name="horaire_debut" id="horaire_debut" class="form-control">
                                    @error('horaire_debut')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="horaire_fin">Horaire de fin :</label>
                                    <input type="time" name="horaire_fin" id="horaire_fin" class="form-control">
                                    @error('horaire_fin')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="jour">Jour</label>
                                    <select class="form-control" id="jour" name="jour">
                                        <option value="">-- Choisissez un jour --</option>
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
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="salle">Salle</label>
                                    <input type="text" class="form-control" id="salle" name="salle">

                                    @error('salle')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="enseignant_id">Enseignant :</label>
                                    <select name="enseignant_id" id="enseignant_id" class="form-control" required>
                                        @foreach($enseignants as $enseignant)
                                        <option value="{{ $enseignant->id }}">{{ $enseignant->nom }} {{
                                            $enseignant->prenom
                                            }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="matiere_id">Matière :</label>
                                    <select name="matiere_id" id="matiere_id" class="form-control" required>
                                        @foreach($matieres as $matiere)
                                        <option value="{{ $matiere->id }}">{{ $matiere->nom }}</option>
                                        @endforeach
                                    </select>
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