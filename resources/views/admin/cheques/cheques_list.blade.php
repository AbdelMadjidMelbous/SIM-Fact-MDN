@extends('templates.admin.layout') @section('content')
<div class="">

	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2> Cheques <a href="{{route('cheques.create')}}" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Nouveau Cheque </a></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<table id="datatable-buttons" class="table table-striped table-bordered bc">
						<thead>
							<tr>
								<th>N° Cheque</th>
								<th>Date Cheque</th>
								<th>Montant </th>
								<th>Detail</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th>N° Cheque</th>
								<th>Date Cheque</th>
								<th>Montant </th>
								<th>Detail</th>
							</tr>
						</tfoot>
						<tbody>
							@if(count($cheques)) @foreach ($cheques as $row)
							<tr>
								<td>{{$row->num_cheque}}</td>
								<td>{{date('d-m-Y', strtotime($row->date_cheque))}}</td>
								<td>{{number_format($row->montant,2,',',' ')}}</td>
								<td>
									<a href="{{ route('cheques.show', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="" title="Details"></i> Details </a>
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