@extends('templates.admin.layout') @section('content')
<div class="">
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Ajouter un Bon de commande <a href="{{route('bcs.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Revenir </a></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<br />

					<form method="post" action="{{ route('bcs.store') }}" data-parsley-validate class="form-horizontal form-label-left">

						<div class="form-group{{ $errors->has('marche_id') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="marche_id">Contrat <span class="required">*</span>
                                                  </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<select class="form-control" id="marche_id" name="marche_id">
                                                      <option selected disabled hidden>Choisir Contrat</option>
                                                          @if(count($marches))
                                                              @foreach($marches as $row)
                                                                  <option value="{{$row->id}}">{{date('Y', strtotime($row->date_marche))}}</option>
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
								<input value="{{ Request::old('num_bc') ?: '' }}" id="num_bc" name="num_bc" class="form-control col-md-7 col-xs-12">								@if ($errors->has('num_bc'))
								<span class="help-block">{{ $errors->first('num_bc') }}</span> @endif
							</div>
						</div>

						<div class="form-group{{ $errors->has('date_bc') ? ' has-error' : '' }}">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="date_bc">Date BC <span class="required">*</span>
                                                  </label>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input type="text" value="{{ Request::old('date_bc') ?: '' }}" id="date_bc" name="date_bc" class="form-control col-md-7 col-xs-12">								@if ($errors->has('date_bc'))
								<span class="help-block">{{ $errors->first('date_bc') }}</span> @endif
							</div>
						</div>

						<!--<div class="form-group{{ $errors->has('bimestre') ? ' has-error' : '' }}">
                                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bimestre">Bimestre <span class="required">*</span>
                                                  </label>
                                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                                      <input type="text" value="{{ Request::old('bimestre') ?: '' }}" id="bimestre" name="bimestre" class="form-control col-md-7 col-xs-12">
                                                      @if ($errors->has('bimestre'))
                                                      <span class="help-block">{{ $errors->first('bimestre') }}</span>
                                                      @endif
                                                  </div>
                                              </div>-->

						<div class="ln_solid"></div>

						<div class="form-group">
							<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
								<input type="hidden" name="_token" value="{{ Session::token() }}">
								<button type="submit" class="btn btn-success">Suivant</button>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
</div>
@stop