@extends('templates.admin.layout') @section('content')
<div class="" role="main">
	<div class="">
		<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title">
						<h2> Cheque <a href="{{route('cheques.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Revenir </a></h2>
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
											<h4 class="modal-title" id="confirmDeleteLabel">Supprimer Chèque</h4>

										</div>
										<div class="modal-body">
											<p>êtes-vous sûr de supprimer ce Chèque ?</p>
										</div>
										<div class="modal-footer">
											<form method="POST" action="{{ route('cheques.destroy', $cheque->id) }}">
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
										<i class="fa fa-globe"></i> Cheque N°:{{$cheque->num_cheque}}
										<small class="pull-right">Date: {{date('d-m-y',strtotime($cheque->date_cheque))}}</small>
									</h1>
								</div>
								<!-- /.col -->
							</div>
						</section>
					</div>
					<table id="datatable-buttons" class="table table-striped table-bordered">
						<tbody>
							<tr class="success">
								<th colspan="4" class="text-center"> Montant du Cheque </th>
								<th>{{number_format($cheque->montant,2,',',' ')}}</th>
							</tr>
						</tbody>
					</table>


					<table id="datatable-buttons" class="table table-striped table-bordered">
						<thead>
							<tr class="warning">
								<th>N° Facture</th>
								<th>N° BL</th>
								<th>N° BC</th>
								<th>Region</th>
								<th>Lieu de livraison</th>
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
								<td>{{date('d-m-Y', strtotime($row->date_fact))}}</td>
								<td class="success">{{number_format($row->total_ttc,2,',',' ')}}</td>
								<td>
									<a href="{{ route('factures.show', ['id' => $row->id]) }}" class="btn btn-info btn-xs"><i class="" title="Details"></i> Details </a>
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