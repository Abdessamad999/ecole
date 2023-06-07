@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    List emplois du temps
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    List emplois du temps
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
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
                                <form action="{{ route('emplois_du_temps.trie') }}" method="GET">
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="nom">trie par :</label>
                                            <select name="colonne" class="form-control select-input placeholder-active">
                                                <option value="intitule">intitule</option>
                                                <option value="horaire_debut">horaire_debut</option>
                                                <option value="horaire_fin">horaire_fin</option>
                                                <option value="jour">jour</option>
                                                <option value="salle">salle</option>
                                                <option value="enseignant_id">nom de enseignant</option>
                                                <option value="matiere_id">le nom de matier </option>
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
                                <form action="{{ route('emplois-du-temps.filter') }}" method="GET">
                                    <label for="intitule">Filtrer par le intitule de emplois du temps :</label>
                                    <input type="text" name="intitule" id="intitule" class="form-control ">
                                    <button type="submit" class="btn btn-success btn-sm nextBtn btn-lg pull-right">Filtrer</button>
                                </form> 
                            </div>
                        </div>
                                <a href="{{route('emplois_du_temps.create')}}" class="btn btn-success btn-sm" role="button"  aria-pressed="true">Ajouter un emplois_du_temps</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>	
                                            <th>#</th>
                                            <th>intitule</th>
                                            <th>Jour</th>
                                            <th>salle</th>
                                            <th>Heure Debut</th>
                                            <th>Heure Fin</th>
                                            <th>le nom et prenom d'Enseignant</th>
                                            <th>le nom de matier</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            @foreach($emplois_du_temps as $emploi_du_temps)
                                                <tr>
                                                <?php $i++; ?>
                                            <td>{{ $i }}</td> 
                                            <td>{{ $emploi_du_temps->intitule }}</td>
                                            <td>{{ $emploi_du_temps->jour }}</td>
                                            <td>{{ $emploi_du_temps->horaire_debut }}</td>
                                            <td>{{ $emploi_du_temps->horaire_fin }}</td>
                                            <td>{{ $emploi_du_temps->salle }}</td>
                                            <td>{{ $emploi_du_temps->enseignant_nom }} {{ $emploi_du_temps->enseignant_prenom }}</td>
                                            <td>{{ $emploi_du_temps->matiere_nom }}</td>

                                                <td>
                                                    <a href="{{route('emplois_du_temps.edit',$emploi_du_temps->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_emploi_du_temps{{ $emploi_du_temps->id }}" title='Delete'><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="delete_emploi_du_temps{{$emploi_du_temps->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('emplois_du_temps.destroy',$emploi_du_temps->id)}}" method="post">
                                                        {{method_field('delete')}}
                                                        {{csrf_field()}}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">supprimer emploi_du_temps</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p> etes vous sur de vouloir supprimer</p>
                                                            <input type="hidden" name="id"  value="{{$emploi_du_temps->id}}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                        class="btn btn-danger">supprimer</button>
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
