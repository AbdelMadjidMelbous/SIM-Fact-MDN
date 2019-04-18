@extends('templates.admin.layout') @section('content')
<div class="" role="main">
	<div class="">
		<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Bon de commande <a href="{{route('bcs.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Revenir </a></h2>
						<ul class="nav navbar-right panel_toolbox" style="min-width:0;">
							<li><button class="btn btn-primary" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-edit"></i>  Modifier  </button>
							</li>
							<li><button class="btn btn-primary"><a href="{{route('bcs.createDetails', ['id' => $bc->id])}}" style="color:white;"><i class="fa fa-edit"></i>  Modifier Details </a></button>
							</li>
							<li><button class="btn btn-danger" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-trash-o"></i>  Supprimer </button>
							</li>
						</ul>
						<!-- Modal delete -->
						<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
							<div class="vertical-alignment-helper">
								<div class="modal-dialog vertical-align-center">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span>

                                                </button>
											<h4 class="modal-title" id="confirmDeleteLabel">Supprimer Bon de commande</h4>

										</div>
										<div class="modal-body">
											<p>êtes-vous sûr de supprimer ce Bon de commande ?</p>
										</div>
										<div class="modal-footer">
											<form method="POST" action="{{ route('bcs.destroy', $bc->id) }}">
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
						<!-- Modal edit -->
						<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
							<div class="vertical-alignment-helper">
								<div class="modal-dialog vertical-align-center">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span>

                                                </button>
											<h4 class="modal-title" id="confirmDeleteLabel">Modifier BC - Infos générales</h4>

										</div>
										<div class="modal-body">
											<form method="POST" action="{{ route('bcs.update',['id' => $bc->id]) }}" class="form-horizontal form-label-left">
												<div class="form-group{{ $errors->has('marche_id') ? ' has-error' : '' }}">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="marche_id">Contrat <span class="required">*</span>
                                                  </label>
													<div class="col-md-6 col-sm-6 col-xs-12">
														<select class="form-control" id="marche_id" name="marche_id">
                                                      <option selected disabled hidden>Choisir Contrat</option>
                                                          @if(count($marches))
                                                              @foreach($marches as $row)
                                                                  <option value="{{$row->id}}"{{$row->id == $bc->marche_id ? 'selected="selected"' : ''}}>{{date('Y', strtotime($row->date_marche))}}</option>
                                                              @endforeach
                                                          @endif
                                                      </select> @if ($errors->has('marche_id'))
														<span class="help-block">{{ $errors->first('marche_id') }}</span> @endif
													</div>
												</div>


												<div class="form-group{{ $errors->has('num_bc') ? ' has-error' : '' }}">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="num_bc">Numero BC <span>*</span>
                                                  </label>
													<div class="col-md-6 col-sm-6 col-xs-12">
														<input value="{{$bc->num_bc}}" id="num_bc" name="num_bc" class="form-control col-md-7 col-xs-12"> @if ($errors->has('num_bc'))
														<span class="help-block">{{ $errors->first('num_bc') }}</span> @endif
													</div>
												</div>

												<div class="form-group{{ $errors->has('date_bc') ? ' has-error' : '' }}">
													<label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_bc">Date BC <span class="required">*</span>
                                                  </label>
													<div class="col-md-6 col-sm-6 col-xs-12">
														<input type="text" value="{{date('d-m-Y', strtotime($bc->date_bc))}}" id="date_bc" name="date_bc" class="form-control col-md-7 col-xs-12">														@if ($errors->has('date_bc'))
														<span class="help-block">{{ $errors->first('date_bc') }}</span> @endif
													</div>
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

						<div class="clearfix"></div>
					</div>

					<div class="x_content">

						<section class="content invoice">
							<!-- title row -->
							<div class="row">
								<div class="col-xs-12 invoice-header">
									<h1>
										<i class="fa fa-globe"></i> Bon de Commande N°:{{$bc->num_bc}}
										<small class="pull-right">Date: {{date('d-m-y',strtotime($bc->date_bc))}}</small>
									</h1>
								</div>
								<!-- /.col -->
							</div>
							<!-- info row -->
							<div class="row invoice-info">
								<div class="col-sm-4 invoice-col">
									De
									<address>
										<strong>MDN.</strong>
										<br>Ministère de la Défence
										<br>Nationale
										<br>Tél:
										<br>Email:
									</address>
								</div>
								<!-- /.col -->
								<div class="col-sm-4 invoice-col">
									A
									<address>
										<strong>SIM AGRO SPA</strong>
										<br>Zone Industrielle de Ain Romana
										<br>BP 51 Bis 09210 Mouzaîa - BLIDA
										<br>Tél: +213 (0) 25 24 79 79
										<br>Fax: +213 (0) 25 24 78 59
									</address>
								</div>
								<!-- /.col -->
								<div class="col-sm-4 invoice-col">
									<b>Marche N°: </b> {{$bc->marche->num_marche}}
									<br>
									<b>Marche Date:</b> {{date('d-m-y',strtotime($bc->marche->date_marche))}}
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
							@php $i=0; @endphp @foreach ($regions as $region)
							<div class="row">
								<div class="col-md-12">
									<div class="x_panel">
										<div class="x_title">
											<h2>{{$region->des_region}}</h2>
											<a href="{{route('bcs.regionDetails',['id' => $region->id,'bc_id' => $bc->id])}}" class="btn btn-info btn-xs" style="float: right;"><i class="fa"></i> Détails </a>
											<div class="clearfix"></div>
										</div>

										<div class="x_content">
											<table id="" class="table table-striped table-bordered">
												<thead>
													<tr class="warning">
														<th>Code_Produit</th>
														<th>Produit</th>
														<th>Quantité demandé</th>
														<th>Quantité livré</th>
														<th>Quantité resté</th>
													</tr>
												</thead>
												<tfoot>
													<tr class="warning">
														<th colspan="2" class="text-center"> Total </th>
														<th>{{$TotalComRegions[$i]}}</th>
														<th>{{$TotalLivrRegions[$i]}}</th>
														<th>{{$TotalComRegions[$i] - $TotalLivrRegions[$i]}}</th>
													</tr>
													<tr class="success">
														<th colspan="2" class="text-center"> Pourcentage </th>
														@if($TotalComRegions[$i] != 0)
														<th>100 %</th>
														<th>{{number_format(($TotalLivrRegions[$i] / $TotalComRegions[$i])*100 , 2, '.', ',')}} %</th>
														<th>{{number_format((($TotalComRegions[$i] - $TotalLivrRegions[$i]) / $TotalComRegions[$i])*100 , 2, '.', ',')}}
															%
														</th>
														@else
														<th>100 %</th>
														<th>{{number_format(0, 2, '.', ',')}} %</th>
														<th>{{number_format(0, 2, '.', ',')}} %
														</th>
														@endif
													</tr>
												</tfoot>
												<tbody>
													@foreach ($produits as $produit) @php $total_com = 0; $total_livr = 0; $total_rest = 0; @endphp @foreach ($bc_details as
													$row) @if ($row->lieu_livr->region_id === $region->id) @if ($row->produit_id === $produit->id) @php $total_com
													+= $row->quantite_com; $total_livr += $row->quantite_livr; $total_rest += $row->quantite_rest; @endphp @endif
													@endif @endforeach

													<tr>
														<td>{{$produit->code_produit}}</td>
														<td>{{$produit->des_produit}}</td>
														<td>{{$total_com}}</td>
														<td>{{$total_livr}}</td>
														<td>{{$total_rest}}</td>


													</tr>
													@endforeach

												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							@php $i++; @endphp @endforeach
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