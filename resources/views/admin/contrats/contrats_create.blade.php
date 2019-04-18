@extends('templates.admin.layout') @section('content')
<div class="">
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Ajouter un Contrat <a href="{{route('dashboard.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Revenir </a></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<br />
					<form method="post" action="{{ route('dashboard.store') }}" data-parsley-validate class="form-horizontal form-label-left">

						<div class="form-group{{ $errors->has('num_marche') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="num_marche">Numero Contrat <span>*</span>
                                                  </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input value="{{ Request::old('num_marche') ?: '' }}" id="num_marche" name="num_marche" class="form-control col-md-7 col-xs-12">								@if ($errors->has('num_marche'))
								<span class="help-block">{{ $errors->first('num_marche') }}</span> @endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('date_marche') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_marche">Date Contrat <span class="required">*</span>
                                                  </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" value="{{ Request::old('date_marche') ?: '' }}" id="date_marche" name="date_marche" class="form-control col-md-7 col-xs-12">								@if ($errors->has('date_marche'))
								<span class="help-block">{{ $errors->first('date_marche') }}</span> @endif
							</div>
						</div>

						<div class="ln_solid"></div>

						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<input type="hidden" name="_token" value="{{ Session::token() }}">
								<button type="submit" class="btn btn-success">Ajouter Contrat</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- jQuery -->
<script src="{{asset('admin/js/jquery.min.js')}}"></script>
<!-- Bootstrap Datepicker -->
<script src="{{asset('admin/js/bootstrap-datepicker.js')}}"></script>

<script type="text/javascript">
	$(function () {
                $('#date_marche').datepicker({
                    format: "dd/mm/yyyy"
                });
            });

</script>
@stop