@extends('templates.admin.layout')

@section('content')
<div class="">
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Confirmer la suppression <a href="{{route('produits.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Revenir </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p>êtes-vous sûr de supprimer <strong>{{$produit->des_produit}}</strong>?</p>

                    <form method="POST" action="{{ route('produits.destroy', ['id' => $produit->id]) }}">
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger">Oui,Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop