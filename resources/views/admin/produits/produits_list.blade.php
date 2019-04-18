@extends('templates.admin.layout')

@section('content')
<div class="">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Produits <a href="{{route('produits.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Nouveau Produit </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Description</th> 
                                <!--<th>Type</th>-->                             
                                <th>U_Mesure</th>
                                <th>Prix_U_HT</th>
                                <th>Taux Tva</th>
                                <th>Prix_U_TTC</th>
                                <th>Modification</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>Code</th>
                            <th>Description</th> 
                            <!--<th>Type</th>-->                  
                            <th>U_Mesure</th>
                            <th>Prix_U_HT</th>
                            <th>Taux Tva</th>
                            <th>Prix_U_TTC</th>
                            <th>Modification</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if(count($produits))
                            @foreach ($produits as $row)
                            <tr>
                                <td>{{$row->code_produit}}</td>
                                <td>{{$row->des_produit}}</td>
                                <td>{{$row->unite_mesure->code}}</td>
                                <td>{{number_format($row->prix_unit_ht,2)}}</td>
                                <td>{{$row->tva->designation}}%</td>
                                <td>{{number_format($row->prix_unit_ttc,2)}}</td>
                                <td>
                                    <a href="{{ route('produits.edit', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" title="Edit"></i> </a>
                                    <a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-delete-{{ $row->id }}" ><i class="fa fa-trash-o" title="Delete"></i></a>
                                </td>
                            </tr>
                            <!-- Modal -->
                                <div class="modal fade" id="modal-delete-{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                                <div class="vertical-alignment-helper">
                                    <div class="modal-dialog vertical-align-center">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span>

                                                </button>
                                                <h4 class="modal-title" id="confirmDeleteLabel">Supprimer Produit</h4>

                                            </div>
                                            <div class="modal-body">
                                                <p>êtes-vous sûr de supprimer ce produit ?</p>
                                            </div>
                                            <div class="modal-footer">
                                            <form method="POST" action="{{ route('produits.destroy', $row->id) }}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="_method" value="DELETE">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                                    <button type="submit" class="btn btn-primary">Confirmer</button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            <!-- Modal end -->
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                
  
            </div>
        </div>
    </div>
</div>
@stop