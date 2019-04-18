@extends('templates.admin.layout') @section('content')
<div class="" role="main">
	<div class="">
		<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title">
						<h2> Contrat <a href="{{route('dashboard.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Revenir </a></h2>
						<ul class="nav navbar-right panel_toolbox" style="min-width:0;">
							<li><button class="btn btn-danger" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-trash-o"></i>  Supprimer </button>
							</li>
						</ul>
						<!-- Modal -->
						<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
							<div class="vertical-alignment-helper">
								<div class="modal-dialog vertical-align-center">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span>

                                                </button>
											<h4 class="modal-title" id="confirmDeleteLabel">Supprimer Contrat</h4>

										</div>
										<div class="modal-body">
											<p>êtes-vous sûr de supprimer ce Contrat ?</p>
										</div>
										<div class="modal-footer">
											<form method="POST" action="{{ route('dashboard.destroy', $contrat->id) }}">
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

						<div class="clearfix"></div>
					</div>

					<div class="x_content">

						<section class="content invoice">
							<!-- title row -->
							<div class="row">
								<div class="col-xs-12 invoice-header">
									<h1>
										<i class="fa fa-globe"></i> Contrat N°:{{$contrat->num_marche}}
										<small class="pull-right">Date: {{date('d-m-y',strtotime($contrat->date_marche))}}</small>
									</h1>
								</div>
								<!-- /.col -->
							</div>
						</section>
					</div>
					<table id="datatable-buttons" class="table table-striped table-bordered">
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
					<!-- /.col -->
				</div>
				<!-- /.row -->
				<!-- this row will not appear when printing -->
				<!--<div class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Imprimer</button>
                          <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                        </div>
                      </div>-->
			</div>

		</div>
	</div>
</div>
</div>
</div>
@stop