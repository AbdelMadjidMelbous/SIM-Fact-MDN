@extends('templates.admin.layout') @section('content')
<div class="">

	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Bons de Commande <a href="{{route('bcs.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Nouveau Bon </a></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<table id="datatable-buttons" class="table table-striped table-bordered bc">
						<thead>
							<tr>
								<th>N° BC</th>
								<th>N° Contrat</th>
								<th>Date BC</th>
								<th>Total Qt</th>
								<th>Etat</th>
								<th>Detail</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>N° BC</th>
								<th>N° Contrat</th>
								<th>Date BC</th>
								<th>Total Qt</th>
								<th>Etat</th>
								<th>Detail</th>
							</tr>
						</tfoot>
						<tbody>
							@if(count($bcs)) @foreach ($bcs as $row)
							<tr>
								<td>{{$row->num_bc}}</td>
								<td>{{$row->marche->num_marche}}</td>
								<td>{{date('d-m-Y', strtotime($row->date_bc))}}</td>
								<td>{{$row->getTotalQuantity()}}</td>
								<td>@php echo ($row['valide']? '<span class="label label-success">Terminé</span>' : '<span class="label label-primary">En cours</span>')
									@endphp
								</td>
								<td>
									<a href="{{ route('bcs.detail', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="" title="Details"></i> Details </a>
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