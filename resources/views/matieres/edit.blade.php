@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    Edit matiere
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    Edit matiere
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
        <h1>Modifier le nom de {{ $matiere->nom}} </h1>
        <form action="{{route('matieres.update', $matiere->id)}}" method="post">
            {{method_field('patch')}}
            @csrf
            <div class="form-row">
                <div class="col">  
                    <label for="title">nom</label>
                    <input type="email" name="nom" value="{{ $matiere->nom}}" class="form-control">
                    @error('nom')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col">
                    <label for="title">description</label>
                    <input type="text" name="description" value="{{$matiere->description}}" class="form-control">
                    @error('description')
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
