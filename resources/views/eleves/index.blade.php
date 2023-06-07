@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
List eleves
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
List_eleves
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <br>
            <div class="card-body">
                @if(session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                           <strong>{{ session()->get('success') }}</strong>
                                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                               <span aria-hidden="true">&times;</span>
                                           </button>
                                </div>
                            @endif
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <form action="{{ route('eleves.trie') }}" method="GET">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="nom">trie par :</label>
                                        <select name="colonne" class="form-control select-input placeholder-active">
                                            <option value="nom">Nom</option>
                                            <option value="prenom">Prénom</option>
                                            <option value="date_naissance">Date de naissance</option>
                                            <option value="genre">Genre</option>
                                            <option value="adresse">Adresse</option>
                                            <option value="ville">Ville</option>
                                            <option value="code_postal">Code postal</option>
                                            <option value="telephone">Téléphone</option>
                                            <option value="email">E-mail</option>
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="nom">votre choix :</label>
                                        <select name="ordre" class="form-control select-input">
                                            <option value="asc">croissant</option>
                                            <option value="desc">decroissant</option>
                                        </select>
                                        <button type="submit"
                                            class="btn btn-success btn-sm nextBtn btn-lg pull-right">Trier</button>
                            </form>
                        </div>
                        <div class="col-4">
                            <form action="{{ route('cours.filter') }}" method="GET">
                                <label for="nom">Filtrer par nom :</label>
                                <input type="text" name="nom" id="nom" value="{{old('nom')}}" class="form-control ">
                                <button type="submit" class="btn btn-success btn-sm nextBtn btn-lg pull-right">Filtrer</button>
                            </form>  
                        </div>
                    </div>
                    <a href="{{route('eleves.create')}}" class="btn btn-success btn-sm" role="button"
                        aria-pressed="true">Ajouter un eleves</a><br><br>
                    <div class="table-responsive">
                        <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                            data-page-length="50" style="text-align: center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Date de naissance</th>
                                    <th>email</th>
                                    <th>genre</th>
                                    <th>Téléphone</th>
                                    <th>ville</th>
                                    <th>code_postal</th>
                                    <th>Adresse</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($eleves as $eleve)
                                <tr>
                                    <?php $i++; ?>
                                    <td>{{ $i }}</td>
                                    <td>{{$eleve->nom}}</td>
                                    <td>{{$eleve->prenom}}</td>
                                    <td>{{$eleve->date_naissance}}</td>
                                    <td>{{$eleve->email}}</td>
                                    <td>{{$eleve->genre}}</td>
                                    <td>{{$eleve->telephone}}</td>
                                    <td>{{$eleve->ville}}</td>
                                    <td>{{$eleve->code_postal}}</td>
                                    <td>{{$eleve->adresse}}</td>
                                    <td>
                                        <a href="{{ route('eleves.edit', $eleve->id ?? '') }}"
                                            class="btn btn-info btn-sm" role="button" aria-pressed="true"><i
                                                class="fa fa-edit"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete_eleve{{ $eleve->id }}" title='Delete'><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="delete_eleve{{$eleve->id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form action="{{route('eleves.destroy', $eleve->id)}}" method="post">
                                            {{method_field('delete')}}
                                            {{csrf_field()}}
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                        id="exampleModalLabel">Delete_eleve</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p> etes vous sur de vouloir supprimer</p>
                                                    <input type="hidden" name="id" value="{{$eleve->id}}">
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">supprimer</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endforeach
                        </table>
                    </div>
                </div>
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