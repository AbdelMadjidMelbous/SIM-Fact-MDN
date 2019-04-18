@extends('templates.admin.layout') @section('content')
<style>
	input[type=number]::-webkit-inner-spin-button,
	input[type=number]::-webkit-outer-spin-button {
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		margin: 0;
	}
</style>

<div class="">
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Ajouter un Cheque <a href="{{route('cheques.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Revenir </a></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<br />

					<form method="post" action="{{ route('cheques.store') }}" data-parsley-validate class="form-horizontal form-label-left">

						<div class="form-group{{ $errors->has('num_cheque') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="num_cheque">N° Chèque <span>*</span>
                                                  </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input value="{{ Request::old('num_cheque') ?: '' }}" id="num_cheque" name="num_cheque" class="form-control col-md-7 col-xs-12">								@if ($errors->has('num_cheque'))
								<span class="help-block">{{ $errors->first('num_cheque') }}</span> @endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('date_cheque') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_cheque">Date Chèque <span class="required">*</span>
                                                  </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" value="{{ Request::old('date_cheque') ?: '' }}" id="date_cheque" name="date_cheque" class="form-control col-md-7 col-xs-12">								@if ($errors->has('date_cheque'))
								<span class="help-block">{{ $errors->first('date_cheque') }}</span> @endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('montant') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="montant">Montant du Chèque <span class="required">*</span>
                                                  </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input value="{{ Request::old('montant') ?: '' }}" id="montant" name="montant" class="form-control col-md-7 col-xs-12">								@if ($errors->has('montant'))
								<span class="help-block">{{ $errors->first('montant') }}</span> @endif
							</div>
						</div>

						<div class="ln_solid"></div>


						<h3>Selectionner les factures concernés :</h3>
						<div class="table-responsive">
							<table class="table table-striped jambo_table bulk_action fact">
								<thead>
									<tr class="headings">
										<th>

										</th>
										<th class="column-title">N° Facture </th>
										<th class="column-title">N° BL</th>
										<th class="column-title">N° BC</th>
										<th class="column-title">Region</th>
										<th class="column-title">Lieu de livraison</th>
										<th class="column-title">Date Facture</th>
										<th class="column-title">Montant Total TTC</th>

									</tr>
								</thead>

								<tbody>
									@if(count($factures)) @foreach ($factures as $row)
									<tr class="even pointer">
										<td class="a-center ">
											<input type="checkbox" id="fact_id" name="fact_id[]" value="{{$row->id}}" data-total="{{$row->total_ttc}}" class="flat">
										</td>
										<td>{{$row->num_fact}}</td>
										<td>{{$row->num_bl}}</td>
										<td>{{$row->bl->bc->num_bc}}</td>
										<td>{{$row->lieu_livr->region->code_region}}</td>
										<td>{{$row->lieu_livr->des_lieu}}</td>
										<td>{{date('d-m-Y', strtotime($row->date_fact))}}</td>
										<td>{{number_format($row->total_ttc,2,',',' ')}}</td>
									</tr>
									@endforeach @endif
								</tbody>
							</table>
						</div>
						<div class="ln_solid"></div>
						<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Total Factures :</span>
                        </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="number" min="0" max="" id="fact_total" name="fact_total" value="" onkeydown="return false;">
							</div>
						</div>
						<div class="ln_solid"></div>

						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-6">
								<input type="hidden" name="_token" value="{{ Session::token() }}">
								<button type="submit" class="btn btn-success">Ajouter</button>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- jQuery -->
<script src="{{asset('admin/js/jquery.min.js')}}"></script>

<script>
	$(function(){
  var $totalAmount = 0;
  $('input[name="fact_id[]"]').on('ifChecked',function(){
		$tot = parseInt($(this).data("total"),10);
		//console.log('checked');
		if ($tot){
		$totalAmount += $tot;
		$("#fact_total").val($totalAmount);
		var temp = document.getElementById("fact_total");
	    temp.setAttribute("value",$totalAmount);
	  		//console.log($totalAmount);
		}
  });
  $('input[name="fact_id[]"]').on('ifUnchecked',function(){
	  $tot = parseInt($(this).data("total"),10);
		//console.log('checked');
		if ($tot){
		$totalAmount -= $tot;
		$("#fact_total").val($totalAmount);
		var temp = document.getElementById("fact_total");
	    temp.setAttribute("value",$totalAmount);
		//console.log($totalAmount);
		}
  });
  $('#montant').change(function(){
	  var temp = document.getElementById("fact_total");
	  var maxValue = document.getElementById("montant").value;
	  temp.setAttribute("max",maxValue);
  });
});	
/*$(document).on("focusin", "#fact_total", function() {
   $(this).prop('readonly', true);  
});

$(document).on("focusout", "#fact_total", function() {
   $(this).prop('readonly', false); 
});*/

</script>
@stop