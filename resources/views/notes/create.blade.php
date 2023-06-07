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
                        <form action="{{route('notes.store')}}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label for="eleve_id">Élève</label>
                                    <select name="eleve_id" id="eleve_id" class="form-control">
                                        @foreach($eleves as $eleve)
                                            <option value="{{ $eleve->id }}">{{ $eleve->nom }} {{ $eleve->prenom }}</option>
                                        @endforeach
                                    </select>
                                    @error('eleve_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="matiere_id">Matière</label>
                                    <select name="matiere_id" id="matiere_id" class="form-control">
                                        @foreach($matieres as $matiere)
                                             <option value="{{ $matiere->id }}">{{ $matiere->nom }}</option>
                                        @endforeach
                                   </select>
                                    @error('matiere_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label for="note">Note</label>
                                    <input type="text" name="note" id="note" class="form-control">
                                    @error('note')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" class="form-control">
                                    @error('date')
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






