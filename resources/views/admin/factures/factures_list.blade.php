@extends('templates.admin.layout') @section('content')
<div class="">

	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2> Factures </h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<table id="datatable-buttons" class="table table-striped table-bordered bc">
						<thead>
							<tr class="warning">
								<th>N° Facture</th>
								<th>N° BL</th>
								<th>N° BC</th>
								<th>Region</th>
								<th>Lieu de livraison</th>
								<th>Valide</th>
								<th>Date Facture</th>
								<th>Montant Total TTC</th>
								<th>Detail</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>N° Facture</th>
								<th>N° BL</th>
								<th>N° BC</th>
								<th>Region</th>
								<th>Lieu de livraison</th>
								<th>Valide</th>
								<th>Date Facture</th>
								<th>Montant Total TTC</th>
								<th>Detail</th>
							</tr>
						</tfoot>
						<tbody>
							@if(count($factures)) @foreach ($factures as $row)
							<tr>
								<td>{{$row->num_fact}}</td>
								<td>{{$row->num_bl}}</td>
								<td>{{$row->bl->bc->num_bc}}</td>
								<td>{{$row->lieu_livr->region->code_region}}</td>
								<td>{{$row->lieu_livr->des_lieu}}</td>
								<td>@php echo ($row['cheque_id']? '<span class="label label-success">Valide</span>' : '<span class="label label-danger">Non valide</span>')
									@endphp
								</td>
								<td>{{date('d-m-Y', strtotime($row->date_fact))}}</td>
								<td class="success">{{number_format($row->total_ttc,2,',',' ')}}</td>
								<td>
									<a href="{{ route('factures.show', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="" title="Details"></i> Details </a>
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