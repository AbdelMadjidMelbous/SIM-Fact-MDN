@extends('templates.admin.layout') @section('content')
<div class="" role="main">
	<div class="">
		<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title">
						<h2> Facture <a href="{{route('factures.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Revenir </a></h2>
						<ul class="nav navbar-right panel_toolbox" style="min-width:0;">
							@if ($facture->cheque_id)
							<li><button class="btn btn-primary"><a href="{{route('cheques.show', ['id' => $facture->cheque_id])}}" style="color:white;"><i class="fa fa-edit"></i>  Voir Cheque </a></button>
							</li>
							@endif
							<li><button class="btn btn-primary"><a href="{{route('bls.detail', ['id' => $facture->bl->id])}}" style="color:white;"><i class="fa fa-edit"></i>  Voir BL </a></button>
							</li>
						</ul>
						<div class="clearfix"></div>
					</div>

					<div class="x_content">

						<section class="content invoice">
							<!-- title row -->
							<div class="row">
								<div class="col-xs-12 invoice-header">
									<h1>
										<i class="fa fa-globe"></i> Facture N°:{{$facture->num_fact}}
										<small class="pull-right">Date: {{date('d-m-y',strtotime($facture->date_fact))}}</small>
									</h1>
								</div>
								<!-- /.col -->
							</div>
							<!-- info row -->
							<div class="row invoice-info">
								<div class="col-sm-3 invoice-col">
									Region :
									<address>
										<strong>{{$facture->lieu_livr->region->des_region}}</strong>
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
										<strong>{{$facture->lieu_livr->des_lieu}}</strong>
										<!--<br>Zone Industrielle de Ain Romana
                                          <br>BP 51 Bis 09210 Mouzaîa - factureIDA-
                                <br>Tél: +213 (0) 25 24 79 79
                                          <br>Fax: +213 (0) 25 24 78 59-->
									</address>
								</div>
								<!-- /.col -->
								<div class="col-sm-3 invoice-col">
									<b>Contrat N°: </b> {{$facture->bl->bc->marche->num_marche}}
									<br>
									<b>Date du Contrat : </b> {{date('d-m-y',strtotime($facture->bl->bc->marche->date_marche))}}
									<br>
								</div>
								<div class="col-sm-3 invoice-col">
									<b>BL N°: </b> {{$facture->bl->num_bl}}
									<br>
									<b>Date du BL : </b> {{date('d-m-y',strtotime($facture->bl->date_bl))}}
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
									<tr class="warning">
										<th>Code Produit</th>
										<th>Designation du Produit</th>
										<th>Quantite en Kg</th>
										<th>P.Unitaire</th>
										<th>Montant HT</th>
									</tr>
								</thead>

								<tbody>
									@foreach ($bl_details as $row)
									<tr>
										<td>{{$row->produit->code_produit}}</td>
										<td>{{$row->produit->des_produit}}</td>
										<td>{{($row->quantite_livr)*1000}}</td>
										<td>{{number_format($row->produit->prix_unit_ht,2)}}</td>
										<td>{{number_format((($row->quantite_livr)*1000) * ($row->produit->prix_unit_ht),2,',',' ')}}</td>
									</tr>

									@endforeach

								</tbody>
								<tfoot>
									<tr class="success">
										<th colspan="4" class="text-center"> Montant Total HT</th>
										<th>{{number_format($facture->total_ht,2,',',' ')}}</th>
									</tr>
									<tr class="danger">
										<th colspan="4" class="text-center"> Montant Total Tva</th>
										<th>{{number_format($facture->montant_tva,2,',',' ')}}</th>
									</tr>
									<tr class="warning">
										<th colspan="4" class="text-center"> Montant Total TTC</th>
										<th>{{number_format($facture->total_ttc,2,',',' ')}}</th>
									</tr>
								</tfoot>
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