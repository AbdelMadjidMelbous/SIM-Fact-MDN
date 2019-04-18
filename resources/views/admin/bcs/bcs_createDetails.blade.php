@extends('templates.admin.layout') @section('content')
<div class="">
	<div class="clearfix"></div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2>Details du Bon de commande </h2>
					<ul class="nav navbar-right panel_toolbox" style="min-width:0;">
						<li><button class="btn btn-primary"><a href="{{route('bcs.detail', ['id' => $bc_id])}}" style="color:white;"> Terminer </a> </button>
						</li>
					</ul>
					<div class="clearfix"></div>

				</div>
				<div class="x_content">
					<div class="form-group row add">
						<input type="hidden" name="bc_id" id="bc_id" value="{{$bc_id}}" />
						<input type="hidden" name="num_bc" id="num_bc" value="{{$num_bc}}" />
						<div class="col-md-2">
							<label></label>
							<h4 style="font-weight:700;">Ajouter un detail :</h4>
						</div>
						<div class="col-md-2">
							<label for="region">Region :</label>
							<select class="form-control" id="region_id" name="region_id">
                                <option value="" selected disabled hidden>Choisir la region</option>
                                    @if(count($regions))
                                        @foreach($regions as $row)
                                            <option value="{{$row->id}},{{$row->code_region}}">{{$row->des_region}}</option>
                                        @endforeach
                                    @endif
                                </select>
							<p class="error text-center alert alert-danger hidden"></p>
						</div>
						<div class="col-md-2">
							<label for="Lieu_livr">Lieu de livraison :</label>
							<select class="form-control" id="lieu_livr_id" name="lieu_livr_id">
                                <option value="" selected disabled hidden>Choisir le lieu</option>
                                    
                                </select>
							<p class="error text-center alert alert-danger hidden"></p>
						</div>
						<div class="col-md-2">
							<label for="Produit">Produit :</label>
							<select class="form-control" id="produit_id" name="produit_id">
                                <option value="" selected disabled hidden>Choisir un produit</option>
                                    @if(count($produits))
                                        @foreach($produits as $row)
                                            <option value="{{$row->id}},{{$row->des_produit}}">{{$row->des_produit}}</option>
                                        @endforeach
                                    @endif
                                </select>
							<p class="error text-center alert alert-danger hidden"></p>
						</div>
						<div class="col-md-2">
							<label for="quantite_demande">Quantite demandé :</label>
							<input value="{{ Request::old('quantite_com') ?: '' }}" id="quantite_com" name="quantite_com" class="form-control" placeholder="Entrer la quantité"
							 required>
							<p class="error text-center alert alert-danger hidden"></p>
						</div>
						<div class="col-md-2">
							<br>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<button class="btn btn-primary" type="submit" id="add">
                                    <span class="glyphicon glyphicon-plus"></span> Ajouter
                                </button>
						</div>
					</div>



					<div class="clearfix"></div>
					<br>
					<!-- add-details -->
					<table id="table" class="table table-striped table-bordered bc">
						<thead>
							<tr>

								<th>Region</th>
								<th>Lieu de Livraison</th>
								<th>Produit</th>
								<th>Quantité demandé</th>
								<th>Modification</th>
							</tr>
						</thead>

						<tbody>
							@if (count($bc_details)) @foreach ($bc_details as $row)
							<tr>
								<td>{{$row->lieu_livr->region->code_region}}</td>
								<td>{{$row->lieu_livr->des_lieu}}</td>
								<td>{{$row->produit->des_produit}}</td>
								<td>{{$row->quantite_com}}</td>
								<td>
									<button class='btn btn-danger' data-toggle="modal" data-target="#modal-delete-{{ $row->id }}"><span class='glyphicon glyphicon-trash'></span> Supprimer</button>
								</td>
							</tr>
							<!-- Modal delete -->
							<div class="modal fade" id="modal-delete-{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel"
							 aria-hidden="true">
								<div class="vertical-alignment-helper">
									<div class="modal-dialog vertical-align-center">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Fermer</span>

                                                </button>
												<h4 class="modal-title" id="confirmDeleteLabel">Supprimer Bc Detail</h4>

											</div>
											<div class="modal-body">
												<p>êtes-vous sûr de supprimer ce detail ?</p>
											</div>
											<div class="modal-footer">
												<form method="POST" action="{{ route('bcs.destroyDetail', $row->id) }}">
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

							@endforeach @endif
						</tbody>
					</table>
					<div class="ln_solid"></div>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- jQuery -->
<script src="{{asset('admin/js/jquery.min.js')}}"></script>
<script>
	$("#add").click(function() {
    resetErrors();
    var region = document.getElementById("region_id").value;
    var split = region.split(",");
    var region_id = split[0];
    var region_des = split[1];
    var lieu = document.getElementById("lieu_livr_id").value;
    var split = lieu.split(",");
    var lieu_id = split[0];
    var lieu_des = split[1];
    var produit = document.getElementById("produit_id").value;
    var split = produit.split(",");
    var produit_id = split[0];
    var produit_des = split[1];
    $.ajax({
        type: 'post',
        url: "{{route('bcs.storeDetails')}}",
        data: {
            '_token': $('input[name=_token]').val(),
            'bc_id': $('input[name=bc_id]').val(),
            'num_bc': $('input[name=num_bc]').val(),    
            'region_id': region_id,
            'lieu_livr_id': lieu_id,
            'produit_id': produit_id,
            'quantite_com' :$('input[name=quantite_com]').val()
        },
        success: function(data) {
            //window.log(data)
            if ((data.errors)) {
                //console.log(data.errors)
                //$('.error').removeClass('hidden');
                //$('.error').text(data.errors.region_id);
                $.each(data.errors, function(i, v) {
	                //console.log(i + " => " + v); // view in console for error messages
                      var msg = '<label class="error" for="'+i+'">'+v+'</label>';
                      $('input[name="' + i + '"], select[name="' + i + '"]').addClass('inputTxtError').after(msg);
                  });
            } else {
                $('.error').remove();
                $('#table').prepend("<tr><td>" + region_des + "</td><td>" + lieu_des + "</td><td>" + produit_des + "</td><td>" + data.quantite_com + "</td><td><button class='btn btn-danger'><span class='glyphicon glyphicon-trash'></span> Supprimer </button></td></tr>");
            }
        },
    });
    //$('#name').val('');
});
function resetErrors() {
    $('div input, div select').removeClass('inputTxtError');
    $('label.error').remove();
}

</script>
<script>
	$('#region_id').change(function(){
    $('#lieu_livr_id').empty();
    var region = document.getElementById("region_id").value;
    var split = region.split(",");
    var region_id = split[0];
    //var $select = $(this); // the select menu that was changed
    //var regiontID = $select.val();

    // send ajax request
    $.ajax({
        type: 'get',
        url:"{{route('bcs.getLieux')}}",
        data: {
            'region_id': region_id
        },
        success: function(data) {

            var options = '';
            // you might want an empty option, so you could do
            // var options = '<option value=""></option>';

            // assuming that your data is being return as json
            $.each(data, function(i, item) {
                // loop through the json and create an option for each result
                $('#lieu_livr_id').append('<option value="' + item.id + ',' + item.des_lieu + '">' + item.des_lieu + '</option>');
            });
    

        }
    });
    
                
    });

</script>
@stop