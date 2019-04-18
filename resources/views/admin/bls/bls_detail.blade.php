@extends('templates.admin.layout') @section('content')
<div class="" role="main">
	<div class="">
		<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Bon de livraison <a href="{{route('bls.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Revenir </a></h2>
						<ul class="nav navbar-right panel_toolbox" style="min-width:0;">
							<li><button class="btn btn-primary"><a href="{{route('factures.show', ['id' => $bl->fact_id])}}" style="color:white;"><i class="fa fa-edit"></i>  Voir Facture </a></button>
							</li>
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
											<h4 class="modal-title" id="confirmDeleteLabel">Supprimer Bon de livraison</h4>

										</div>
										<div class="modal-body">
											<p>êtes-vous sûr de supprimer ce Bon de livraison ?</p>
										</div>
										<div class="modal-footer">
											<form method="POST" action="{{ route('bls.destroy', $bl->id) }}">
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
										<i class="fa fa-globe"></i> Bon de Livraison N°:{{$bl->num_bl}}
										<small class="pull-right">Date: {{date('d-m-y',strtotime($bl->date_bl))}}</small>
									</h1>
								</div>
								<!-- /.col -->
							</div>
							<!-- info row -->
							<div class="row invoice-info">
								<div class="col-sm-3 invoice-col">
									Region :
									<address>
										<strong>{{$bl->lieu_livr->region->des_region}}</strong>
										<!--<br>Ministère de la Défence
                                          <br>Nationale
                                          <br>Tél: 
                                          <br>Email: -->
									</address>
								</div>
								<!-- /.col -->
								<div class="col-sm-3 invoice-col">
									Lieu de Livraison :
									<address>
										<strong>{{$bl->lieu_livr->des_lieu}}</strong>
										<!--<br>Zone Industrielle de Ain Romana
                                          <br>BP 51 Bis 09210 Mouzaîa - BLIDA
                                          <br>Tél: +213 (0) 25 24 79 79
                                          <br>Fax: +213 (0) 25 24 78 59-->
									</address>
								</div>
								<!-- /.col -->
								<div class="col-sm-3 invoice-col">
									<b>Contrat N°: </b> {{$bl->bc->marche->num_marche}}
									<br>
									<b>Date du Contrat : </b> {{date('d-m-y',strtotime($bl->bc->marche->date_marche))}}
									<br>
								</div>
								<div class="col-sm-3 invoice-col">
									<b>BC N°: </b> {{$bl->bc->num_bc}}
									<br>
									<b>Date du BC : </b> {{date('d-m-y',strtotime($bl->bc->date_bc))}}
									<br>
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->
						</section>
					</div>
					<!-- Table row -->
					<div class="row">
						<div class="x_content">
							<table id="" class="table table-striped table-bordered">
								<thead>
									<tr>
										<th>Code Produit</th>
										<th>Designation du Produit</th>
										<th>U.R</th>
										<th>Quantite</th>
										<th>P.Unitaire</th>
										<th>Moontant HT</th>
										<th>Modification</th </tr>
								</thead>
								<tfoot>
									<tr>
										<th>Code Produit</th>
										<th>Designation du Produit</th>
										<th>U.R</th>
										<th>Quantite</th>
										<th>P.Unitaire</th>
										<th>Moontant HT</th>
										<th>Modification</th>
									</tr>
								</tfoot>
								<tbody>
									@foreach ($bl_details as $row)
									<tr>
										<td>{{$row->produit->code_produit}}</td>
										<td>{{$row->produit->des_produit}}</td>
										<td>{{$row->produit->unite_mesure->code}}</td>
										<td>{{($row->quantite_livr)*1000}}</td>
										<td>{{number_format($row->produit->prix_unit_ht,2)}}</td>
										<td>{{number_format((($row->quantite_livr)*1000) * ($row->produit->prix_unit_ht),2,',',' ')}}</td>
										<td>
											<a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-edit-{{ $row->id }}"><i class="fa fa-pencil" title="Edit"></i> Modifier </a>
											<a href="#" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#modal-delete-{{ $row->id }}"><i class="fa fa-trash-o" title="Delete"></i> Supprimer </a>
										</td>
									</tr>
									<!-- Modal edit -->
									<div class="modal fade" id="modal-edit-{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
										<div class="vertical-alignment-helper">
											<div class="modal-dialog vertical-align-center">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span>

                                                </button>
														<h4 class="modal-title" id="confirmDeleteLabel">Modifier Bl detail</h4>

													</div>
													<div class="modal-body">
														<form method="POST" action="{{ route('bls.update',['id' => $row->id]) }}">
															<div>
																<label for="quantite_livr">Quantite livré (Tonne) :</label>
																<input value="{{ $row->quantite_livr }}" id="quantite_livr" name="quantite_livr" class="form-control" placeholder="Entrer la quantité"
																 required>
																<p class="error text-center alert alert-danger hidden"></p>
															</div>
													</div>
													<div class="modal-footer">

														<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<input type="hidden" name="_method" value="PUT">
														<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
														<button type="submit" class="btn btn-primary">Confirmer</button>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- Modal edit end -->

									<!-- Modal delete -->
									<div class="modal fade" id="modal-delete-{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel"
									 aria-hidden="true">
										<div class="vertical-alignment-helper">
											<div class="modal-dialog vertical-align-center">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span>

                                                </button>
														<h4 class="modal-title" id="confirmDeleteLabel">Supprimer Bl detail</h4>

													</div>
													<div class="modal-body">
														<p>êtes-vous sûr de supprimer cette ligne ?</p>
													</div>
													<div class="modal-footer">
														<form method="POST" action="{{ route('bls.destroyDetail', $row->id) }}">
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
									<!-- Modal delete end -->

									@endforeach

								</tbody>
							</table>
						</div>

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
@stop