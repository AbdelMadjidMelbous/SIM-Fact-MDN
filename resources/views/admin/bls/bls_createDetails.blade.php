@extends('templates.admin.layout') @section('content')


<div class="" role="main">
	<div class="">
		<div class="row">
			<div class="col-md-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>Bon de livraison N° : {{$bl->num_bl}} </h2>
						<div class="clearfix"></div>
					</div>

					<div class="row">
						<div class="x_content">
							<form method="post" action="{{ route('bls.storeDetails') }}" data-parsley-validate class="form-horizontal form-label-left">
								<input type="hidden" name="bl_id" id="bl_id" value="{{$bl->id}}" />
								<table id="" class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Code_Produit</th>
											<th>Produit</th>
											<th>Quantité demandé</th>
											<th>Reste à livrer</th>
											<th>Quantité livré</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>Code_Produit</th>
											<th>Produit</th>
											<th>Quantité demandé</th>
											<th>Reste à livrer</th>
											<th>Quantité livré</th>
										</tr>
									</tfoot>
									<tbody>
										@foreach ($bc_details as $row)
										<input type="hidden" name="produit_id[]" id="produit_id" value="{{$row->produit->id}}" />
										<input type="hidden" name="bc_detail_id[]" id="bc_detail_id" value="{{$row->id}}" />
										<tr>
											<td>{{$row->produit->code_produit}}</td>
											<td>{{$row->produit->des_produit}}</td>
											<td>{{$row->quantite_com}}</td>
											<td>{{$row->quantite_rest}}</td>

											<td>
												<div>
													<input type="number" min="0" max="{{$row->quantite_rest}}" id="quantite_livr" name="quantite_livr[]" class="form-control"
													 placeholder="Entrer la quantité"> @if($errors->has('quantite_livr'))
													<span class="help-block">{{ $errors->first('quantite_livr') }}</span> @endif
													<p class="error text-center alert alert-danger hidden"></p>
												</div>
											</td>
										</tr>
										@endforeach

									</tbody>
								</table>
								<div class="ln_solid"></div>



								<div class="form-group">
									<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-9">
										<input type="hidden" name="_token" value="{{ Session::token() }}">
										<button type="submit" class="btn btn-success">Terminer</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>
</div>
@stop