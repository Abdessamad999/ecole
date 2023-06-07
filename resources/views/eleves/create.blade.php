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
                        <form action="{{route('eleves.store')}}" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">email</label>
                                    <input type="email" name="email" class="form-control">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">date_naissance</label>
                                    <input type="date" name="date_naissance" class="form-control">
                                    @error('date_naissance')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="col">
                                    <label for="title">nom</label>
                                    <input type="text" name="nom" class="form-control">
                                    @error('nom')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">prenom</label>
                                    <input type="text" name="prenom" class="form-control">
                                    @error('prenom')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <div>

                                        <label for="contactChoice1">genre :</label>
                                        <input type="radio" id="contactChoice2" name="genre" value="Homme">
                                        <label for="contactChoice2">Homme</label>
                                        <input type="radio" id="contactChoice3" name="genre" value="Femme">
                                        <label for="contactChoice3">Femme</label>
                                      </div>
                                    @error('genre')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            

                                <div class="col">
                                    <label for="title">adresse</label>
                                    <input type="text" name="adresse" class="form-control">
                                    @error('adresse')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-4">
                                <label for="title">ville</label>
                                <input type="text" name="ville" class="form-control">
                                @error('ville')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                
                            </div>
                            <div class="col-4">
                                <label for="title">code_postal</label>
                                <input type="text" name="code_postal" class="form-control">
                                @error('code_postal')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
    
    
                            <div class="col-4">
                                <label for="title">telephone</label>
                                <input type="text" name="telephone" class="form-control">
                                @error('telephone')
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