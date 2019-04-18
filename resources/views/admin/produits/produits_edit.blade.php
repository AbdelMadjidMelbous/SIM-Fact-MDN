@extends('templates.admin.layout')

@section('content')
<div class="">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Modifier Produit <a href="{{route('produits.index')}}" class="btn btn-info btn-xs"><i class="fa fa-chevron-left"></i> Revenir </a></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form method="post" action="{{ route('produits.update', ['id' => $produit->id]) }}" data-parsley-validate class="form-horizontal form-label-left">

                        <div class="form-group{{ $errors->has('code_produit') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code_produit">produit Code <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" value="{{$produit->code_produit}}" id="code_produit" name="code_produit" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('code_produit'))
                                <span class="help-block">{{ $errors->first('code_produit') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('des_produit') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="des_produit">prix_unit_ht<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" value="{{$produit->des_produit}}" id="des_produit" name="des_produit" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('des_produit'))
                                <span class="help-block">{{ $errors->first('des_produit') }}</span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group{{ $errors->has('u_mesure') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="u_mesure">U_Mesure <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" id="u_mesure" name="u_mesure">
                                    @if(count($u_mesures))
                                    @foreach($u_mesures as $row)
                                    <option value="{{$row->id}}" {{$row->id == $produit->u_mesure ? 'selected="selected"' : ''}}>{{$row->code}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('u_mesure'))
                                <span class="help-block">{{ $errors->first('u_mesure') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('prix_unit_ht') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Prix_Unit_HT <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="{{$produit->prix_unit_ht}}" id="prix_unit_ht" name="prix_unit_ht" class="form-control col-md-7 col-xs-12">
                                @if ($errors->has('prix_unit_ht'))
                                <span class="help-block">{{ $errors->first('prix_unit_ht') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('tva_id') ? ' has-error' : '' }}">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tva_id">Tva <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control" id="tva_id" name="tva_id">
                                    @if(count($tvas))
                                    @foreach($tvas as $row)
                                    <option value="{{$row->id}}" {{$row->id == $produit->tva_id ? 'selected="selected"' : ''}}>{{$row->designation}}</option>
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
                                <input name="_method" type="hidden" value="PUT">
                                <button type="submit" class="btn btn-success">Sauvgarder les changements</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop