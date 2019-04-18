@extends('templates.admin.layout')

@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Ajouter un Produit <a href="{{route('produits.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Revenir </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form method="post" action="{{ route('produits.store') }}" data-parsley-validate class="form-horizontal form-label-left">

                        <div class="form-group{{ $errors->has('code_produit') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code_produit">Code Produit <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{ Request::old('code_produit') ?: '' }}" id="code_produit" name="code_produit" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('code_produit'))
                                <span class="help-block">{{ $errors->first('code_produit') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('des_produit') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="des_produit">Description<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{ Request::old('des_produit') ?: '' }}" id="des_produit" name="des_produit" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('des_produit'))
                                <span class="help-block">{{ $errors->first('des_produit') }}</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('u_mesure') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="u_mesure">U_Mesure<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" id="u_mesure" name="u_mesure">
                                <option selected disabled hidden>Choisir l'unite de mesure</option>
                                    @if(count($u_mesures))
                                        @foreach($u_mesures as $row)
                                            <option value="{{$row->id}}">{{$row->code}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('u_mesure'))
                                <span class="help-block">{{ $errors->first('u_mesure') }}</span>
                                @endif
                            </div>
                        </div>
                        
                        

                        <div class="form-group{{ $errors->has('prix_unit_ht') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prix_unit_ht">Prix_Unit_HT <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="{{ Request::old('prix_unit_ht') ?: '' }}" id="prix_unit_ht" name="prix_unit_ht" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('prix_unit_ht'))
                                <span class="help-block">{{ $errors->first('prix_unit_ht') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tva_id') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tva_id">Tva<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" id="tva_id" name="tva_id">
                                <option selected disabled hidden>Choisir Tva</option>
                                    @if(count($tvas))
                                        @foreach($tvas as $row)
                                            <option value="{{$row->id}}">{{$row->designation}}%</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('tva_id'))
                                <span class="help-block">{{ $errors->first('tva_id') }}</span>
                                @endif
                            </div>
                        </div>
                    
                        <div class="ln_solid"></div>

                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <input type="hidden" name="_token" value="{{ Session::token() }}">
                                <button type="submit" class="btn btn-success">Ajouter Produit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop