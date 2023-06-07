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
                        
                        <form method="POST" action="{{ route('enseignants.update', $enseignant->id) }}">
                            @csrf
                            @method('PUT')
                            <h1>Modifier l'enseignant {{ $enseignant->nom }} {{ $enseignant->prenom }}</h1>
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">nom</label>
                                    <input type="text" name="nom" class="form-control"value="{{ $enseignant->nom }}">
                                    @error('nom')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div> 
                                <div class="col">
                                    <label for="title">prenom</label>
                                    <input type="text" name="prenom" class="form-control" value="{{ $enseignant->prenom}}">
                                    @error('prenom')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="email">email</label>
                                    <input type="text" name="email" class="form-control" value="{{ $enseignant->email }}">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="telephone">telephone</label>
                                    <input type="text" name="telephone" class="form-control" value="{{ $enseignant->telephone }}">
                                    @error('telephone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div>
                                        <label for="adresse">adresse :</label>
                                        <input type="text"  class="form-control"name="adresse" value="{{ $enseignant->adresse}}">
                                      </div>
                                    @error('adresse')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="date_naissance">date_naissance</label>
                                    <input type="text" name="date_naissance" class="form-control" value="{{$enseignant->date_naissance}}">
                                    @error('date_naissance')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="matiere_id">Matière enseignée</label>
                                    

                                        <select id="matiere_id" class="form-control @error('matiere_id') is-invalid @enderror" name="matiere_id" required>
                                            @foreach($matieres as $matiere)
                                                <option value="{{ $matiere->id }}" @if($matiere->id == $enseignant->matiere_id) selected @endif>{{ $matiere->nom }}</option>
                                            @endforeach
                                       </select>
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