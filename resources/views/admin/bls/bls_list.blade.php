@extends('templates.admin.layout')

@section('content')
<div class="">

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Bons de Livraison <a href="{{route('bls.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Nouveau Bon </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="datatable-buttons" class="table table-striped table-bordered bc">
                        <thead>
                            <tr>
                                <th>N° BL</th>
                                <th>N° BC</th>
                                <th>Region</th>
                                <th>Lieu de livraison</th>
                                <th>Date BL</th>                             
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>N° BL</th>
                                <th>N° BC</th>
                                <th>Region</th>
                                <th>Lieu de livraison</th>
                                <th>Date BL</th>                             
                                <th>Detail</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @if(count($bls))
                            @foreach ($bls as $row)
                            <tr>
                                <td>{{$row->num_bl}}</td>
                                <td>{{$row->bc->num_bc}}</td>
                                <td>{{$row->lieu_livr->region->code_region}}</td>
                                <td>{{$row->lieu_livr->des_lieu}}</td>
                                <td>{{date('d-m-Y', strtotime($row->date_bl))}}</td>
                                <td>
                                    <a href="{{ route('bls.detail', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="" title="Details"></i> Details </a> 
                                </td>
                            </tr>
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