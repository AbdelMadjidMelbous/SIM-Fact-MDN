@extends('templates.admin.layout') @section('content')


<div class="" role="main">
	<div class="">
		<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>{{$region->des_region}} <a href="{{route('bcs.detail', ['id' => $bc->id])}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Revenir </a></h2>
						<div class="clearfix"></div>
					</div>

					<div class="row">
						<div class="x_content">
							@php $i=0; @endphp @foreach ($lieu_livrs as $lieu_livr)
							<div class="row">
								<div class="col-md-12">
									<div class="x_panel">
										<div class="x_title">
											<h2>{{$lieu_livr->des_lieu}}</h2>
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
													@if($TotalComLieux[$i] != 0)
													<tr class="warning">
														<th colspan="2" class="text-center"> Total </th>
														<th>{{$TotalComLieux[$i]}}</th>
														<th>{{$TotalLivrLieux[$i]}}</th>
														<th>{{$TotalComLieux[$i] - $TotalLivrLieux[$i]}}</th>
													</tr>
													<tr class="success">
														<th colspan="2" class="text-center"> Pourcentage </th>
														<th>100 %</th>
														<th>{{number_format(($TotalLivrLieux[$i] / $TotalComLieux[$i])*100 , 2, '.', ',')}} %</th>
														<th>{{number_format((($TotalComLieux[$i] - $TotalLivrLieux[$i]) / $TotalComLieux[$i])*100 , 2, '.', ',')}} %
														</th>
													</tr>
													@endif
												</tfoot>
												<tbody>
													@foreach ($produits as $produit) @foreach ($bc_details as $row) @if ($row->lieu_livr_id === $lieu_livr->id) @if ($row->produit_id
													=== $produit->id)

													<tr>
														<td>{{$produit->code_produit}}</td>
														<td>{{$produit->des_produit}}</td>
														<td>{{$row->quantite_com}}</td>
														<td>{{$row->quantite_livr}}</td>
														<td>{{$row->quantite_rest}}</td>


													</tr>

													@endif @endif @endforeach @endforeach

												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							@php $i++; @endphp @endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop