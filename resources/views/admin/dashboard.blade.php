@extends('templates.admin.layout') @section('content')
<!-- page content -->
<div class="">
	<div role="main">
		<!-- top tiles -->
		<div class="row tile_count">
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				<span class="count_top"><i class="fa fa-user"></i> Total Contrats</span>
				<div class="count">{{$marches_total}}</div>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				<span class="count_top"><i class="fa fa-user"></i> Total BCS </span>
				<div class="count">{{$bcs_total}}</div>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				<span class="count_top"><i class="fa fa-user"></i> Total BLS</span>
				<div class="count">{{$bls_total}}</div>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				<span class="count_top"><i class="fa fa-user"></i> Total Factures</span>
				<div class="count">{{$factures_total}}</div>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				<span class="count_top"><i class="fa fa-user"></i> Total Chèques</span>
				<div class="count">{{$cheques_total}}</div>
			</div>
			<div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
				<span class="count_top"><i class="fa fa-user"></i> Total Produits</span>
				<div class="count">{{$produits_total}}</div>
			</div>
		</div>
		<!-- /top tiles -->
	</div>

	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2> Contrat <a href="{{route('dashboard.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Nouveau Contrat </a></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<table id="datatable-buttons" class="table table-striped table-bordered bc">
						<thead>
							<tr>
								<th>N° Contrat</th>
								<th>Date Contrat</th>
								<th>Détails</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>N° Contrat</th>
								<th>Date Contrat</th>
								<th>Détails</th>
							</tr>
						</tfoot>
						<tbody>
							@if(count($marches)) @foreach ($marches as $row)
							<tr>
								<td>{{$row->num_marche}}</td>
								<td>{{date('d-m-Y', strtotime($row->date_marche))}}</td>
								<td>
									<a href="{{ route('dashboard.show', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="" title="Details"></i> Details </a>
								</td>
							</tr>
							@endforeach @endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


@stop