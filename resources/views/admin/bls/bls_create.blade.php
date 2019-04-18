@extends('templates.admin.layout') @section('content')
<div class="">
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Ajouter un Bon de livraison <a href="{{route('bls.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Revenir </a></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<br />

					<form method="post" action="{{ route('bls.store') }}" data-parsley-validate class="form-horizontal form-label-left">


						<div class="form-group{{ $errors->has('marche_id') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="marche_id">Contrat<span class="required">*</span>
                                                  </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" id="marche_id" name="marche_id">
                                                      <option selected disabled hidden>Choisir le Contrat</option>
                                                          @if(count($marches))
                                                              @foreach($marches as $row)
                                                                  <option value="{{$row->id}}">{{date('Y', strtotime($row->date_marche))}}</option>
                                                              @endforeach
                                                          @endif
                                                      </select> @if ($errors->has('marche_id'))
								<span class="help-block">{{ $errors->first('marche_id') }}</span> @endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('bc_id') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="bc_id">BC<span class="required">*</span>
                                                  </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" id="bc_id" name="bc_id">
                                                      <option selected disabled hidden>Choisir le BC</option>
                                                         
                                                      </select> @if ($errors->has('bc_id'))
								<span class="help-block">{{ $errors->first('bc_id') }}</span> @endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('num_bl') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="num_bl">Numero BL <span>*</span>
                                                  </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input value="{{ Request::old('num_bl') ?: '' }}" id="num_bl" name="num_bl" class="form-control col-md-7 col-xs-12">								@if ($errors->has('num_bl'))
								<span class="help-block">{{ $errors->first('num_bl') }}</span> @endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('num_fact') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="num_fact">Numero Facture Associé <span>*</span>
                                                  </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input value="{{ Request::old('num_fact') ?: '' }}" id="num_fact" name="num_fact" class="form-control col-md-7 col-xs-12">								@if ($errors->has('num_bl'))
								<span class="help-block">{{ $errors->first('num_fact') }}</span> @endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('region_id') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="region">Region<span class="required">*</span>
                                                  </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" id="region_id" name="region_id">
                                                      <option selected disabled hidden>Region</option>
                                                          @if(count($regions))
                                                              @foreach($regions as $row)
                                                                  <option value="{{$row->id}}">{{$row->des_region}}</option>
                                                              @endforeach
                                                          @endif
                                                      </select> @if ($errors->has('region_id'))
								<span class="help-block">{{ $errors->first('region_id') }}</span> @endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('lieu_livr_id') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="lieu_livr">Lieu de livraison<span class="required">*</span>
                                                  </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" id="lieu_livr_id" name="lieu_livr_id">
                                                      <option selected disabled hidden>Lieu de livraison</option>
                                                          
                                                      </select> @if ($errors->has('lieu_livr_id'))
								<span class="help-block">{{ $errors->first('lieu_livr_id') }}</span> @endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('date_bl') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_bl">Date BL <span class="required">*</span>
                                                  </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" value="{{ Request::old('date_bl') ?: '' }}" id="date_bl" name="date_bl" class="form-control col-md-7 col-xs-12">								@if ($errors->has('date_bl'))
								<span class="help-block">{{ $errors->first('date_bl') }}</span> @endif
							</div>
						</div>

						<!--<div class="form-group{{ $errors->has('nom_chauffeur') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_chauffeur">Nom Chauffeur <span class="required"></span>
                                                  </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" value="{{ Request::old('nom_chauffeur') ?: '' }}" id="nom_chauffeur" name="nom_chauffeur" class="form-control col-md-7 col-xs-12">								@if ($errors->has('nom_chauffeur'))
								<span class="help-block">{{ $errors->first('nom_chauffeur') }}</span> @endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('matricule_camion') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="matricule_camion">Matricule Camion <span class="required"></span>
                                                  </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" value="{{ Request::old('matricule_camion') ?: '' }}" id="matricule_camion" name="matricule_camion" class="form-control col-md-7 col-xs-12">								@if ($errors->has('matricule_camion'))
								<span class="help-block">{{ $errors->first('matricule_camion') }}</span> @endif
							</div>
						</div>-->

						<div class="ln_solid"></div>



						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<input type="hidden" name="_token" value="{{ Session::token() }}">
								<button type="submit" class="btn btn-success"> Suivant <i class="fa fa-chevron-right"></i></button>
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
<!-- Bootstrap Datepicker -->
<script src="{{asset('admin/js/bootstrap-datepicker.js')}}"></script>
<script>
	$('#region_id').change(function(){
    $('#lieu_livr_id').empty();
    var region_id = document.getElementById("region_id").value;
    var bc_id = document.getElementById("bc_id").value;

    // send ajax request
    $.ajax({
        type: 'get',
        url:"{{route('bls.getLieux')}}",
        data: {
            'region_id': region_id,
            'bc_id': bc_id
        },
        success: function(data) {
            var options = '';
            // you might want an empty option, so you could do
            // var options = '<option value=""></option>';

            // assuming that your data is being return as json
            $.each(data, function(i, item) {
                // loop through the json and create an option for each result
                $('#lieu_livr_id').append('<option value="' + item.id + '">' + item.des_lieu + '</option>');
            });
    

        }
    });
    
                
    });

</script>
<script>
	$('#marche_id').change(function(){
    $('#bc_id').empty();
    var marche_id = document.getElementById("marche_id").value;

    // send ajax request
    $.ajax({
        type: 'get',
        url:"{{route('bls.getBcs')}}",
        data: {
            'marche_id': marche_id,
        },
        success: function(data) {
            var options = '';
            // you might want an empty option, so you could do
            // var options = '<option value=""></option>';

            // assuming that your data is being return as json
            $.each(data, function(i, item) {
                // loop through the json and create an option for each result
                $('#bc_id').append('<option value="' + item.id + '">' + item.num_bc + '</option>');
            });
    

        }
    });
    
                
    });

</script>


<script type="text/javascript">
	$(function () {
                $('#date_bl').datepicker({
                    format: "dd/mm/yyyy"
                });
            });

</script>

@stop