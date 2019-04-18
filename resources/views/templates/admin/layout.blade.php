<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>{{$title or "SIM-FACT MDN"}}</title>

	<link rel="shortcut icon" type="image/png" href="{{asset('admin/images/logo-groupe-sim.png')}}" />
	<!-- Bootstrap -->
	<link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="{{asset('admin/css/font-awesome.min.css')}}" rel="stylesheet">
	<!-- NProgress -->
	<link href="{{asset('admin/css/nprogress.css')}}" rel="stylesheet">
	<!-- iCheck -->
	<link href="{{asset('admin/css/green.css')}}" rel="stylesheet">
	<!-- bootstrap-progressbar -->
	<link href="{{asset('admin/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
	<!-- JQVMap -->
	<link href="{{asset('admin/css/jqvmap.min.css')}}" rel="stylesheet" />
	<!-- Custom Theme Style -->
	<link href="{{asset('admin/css/custom.min.css')}}" rel="stylesheet">
	<!-- Datatables -->
	<link href="{{asset('admin/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('admin/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('admin/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('admin/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('admin/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
	<style>
		.modal {}

		.vertical-alignment-helper {
			display: table;
			height: 100%;
			width: 100%;
		}

		.vertical-align-center {
			/* To center vertically */
			display: table-cell;
			vertical-align: middle;
		}

		.modal-content {
			/* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
			width: inherit;
			height: inherit;
			/* To center horizontally */
			margin: 0 auto;
		}

		.error {
			color: #ff0000;
			font-size: 12px;
			margin-top: 5px;
			margin-bottom: 0;
		}

		.inputTxtError {
			border: 1px solid #ff0000;
			color: #0e0e0e;
		}
	</style>
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">
					<div class="navbar nav_title" style="border: 0;">
						<a href="#" class="site_title"><i class="fa fa-tasks"></i> <span>SIM-FACT MDN</span></a>
					</div>
					<!--<div class="navbar" style="border: 0;">
                        <img src="{{asset('admin/images/logo-groupe-sim.png')}}" alt="...">
                    </div>-->

					<div class="clearfix"></div>

					<!-- menu profile quick info -->
					<div class="profile">
						<div class="profile_pic">
							<img src="{{asset('admin/images/logo-groupe-sim.png')}}" width="222" height="150" alt="Logo SIM" class="">
						</div>
					</div>
					<!-- /menu profile quick info -->
					<div class="clearfix"></div>
					<br />

					<!-- sidebar menu -->
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
						<div class="menu_section">
							<ul class="nav side-menu">
								<li><a href="{{route('dashboard.index')}}"><i class="fa fa-home"></i> Accueil </a></li>
								<li><a href="{{route('produits.index')}}"><i class="fa fa-shopping-cart"></i>Produits</a></li>
								<li><a href="{{route('bcs.index')}}"><i class="fa fa-edit"></i> Bon de Commandes </a></li>
								<li><a href="{{route('bls.index')}}"><i class="fa fa-edit"></i> Bon de Livraisons </a></li>
								<li><a href="{{route('factures.index')}}"><i class="fa fa-exchange"></i> Factures </a></li>
								<li><a href="{{route('cheques.index')}}"><i class="fa fa-exchange"></i> Cheques </a></li>

								<li><a><i class="fa fa-cog"></i> Reglages <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu">
										<li><a href="{{route('users.index')}}"><i class="fa fa-users"></i> Utilisateurs </a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
					<!-- /sidebar menu -->

					<!-- /menu footer buttons 
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                     /menu footer buttons -->
				</div>
			</div>

			<!-- top navigation -->
			<div class="top_nav">
				<div class="nav_menu">
					<nav>
						<div class="nav toggle">
							<a id="menu_toggle"><i class="fa fa-bars"></i></a>
						</div>


						<ul class="nav navbar-nav navbar-right">
							<li class="">
								<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user"></i> {{ Auth::user()->name }}
                                    <span class=" fa fa-angle-down"></span>
                                </a>
								<ul class="dropdown-menu dropdown-usermenu pull-right">
									<li><a href="{{route('logout')}}"><i class="fa fa-sign-out pull-right"></i> Se Déconnecter</a></li>
								</ul>
							</li>

						</ul>
					</nav>
				</div>
			</div>
			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main">
				@include('templates.admin.partials.alerts') @yield('content')
			</div>
			<!-- /page content -->

			<!-- footer content -->
			<footer>
				<div class="pull-right">
					SimFactMdn - Par Abdelmadjid MELBOUS
				</div>
				<div class="clearfix"></div>
			</footer>
			<!-- /footer content -->
		</div>
	</div>


	<!-- jQuery -->
	<script src="{{asset('admin/js/jquery.min.js')}}"></script>
	<script src="{{asset('admin/js/jquery.dataTables.min.js')}}"></script>
	<!-- Bootstrap -->
	<script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
	<!-- bootstrap-daterangepicker -->
	<script src="{{asset('admin/js/moment.min.js')}}"></script>
	<script src="{{asset('admin/js/daterangepicker.js')}}"></script>
	<!-- FastClick -->
	<script src="{{asset('admin/js/fastclick.js')}}"></script>
	<!-- NProgress -->
	<script src="{{asset('admin/js/nprogress.js')}}"></script>
	<!-- iCheck -->
	<script src="{{asset('admin/js/icheck.min.js')}}"></script>
	<!-- Datatables -->
	<script src="{{asset('admin/js/dataTables.bootstrap.min.js')}}"></script>
	<script src="{{asset('admin/js/dataTables.buttons.min.js')}}"></script>
	<script src="{{asset('admin/js/buttons.bootstrap.min.js')}}"></script>
	<script src="{{asset('admin/js/buttons.flash.min.js')}}"></script>
	<script src="{{asset('admin/js/buttons.html5.min.js')}}"></script>
	<script src="{{asset('admin/js/buttons.print.min.js')}}"></script>
	<script src="{{asset('admin/js/dataTables.fixedHeader.min.js')}}"></script>
	<script src="{{asset('admin/js/dataTables.keyTable.min.js')}}"></script>
	<script src="{{asset('admin/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('admin/js/responsive.bootstrap.js')}}"></script>
	<script src="{{asset('admin/js/dataTables.scroller.min.js')}}"></script>
	<script src="{{asset('admin/js/jszip.min.js')}}"></script>
	<script src="{{asset('admin/js/pdfmake.min.js')}}"></script>
	<script src="{{asset('admin/js/vfs_fonts.js')}}"></script>

	<!-- jQuery Smart Wizard -->
	<script src="{{asset('admin/js/jquery.smartWizard.js?newversion')}}"></script>

	<!-- Custom Theme Scripts -->
	<script src="{{asset('admin/js/custom.min.js')}}"></script>
	<!-- Bootstrap Datepicker -->
	<script src="{{asset('admin/js/bootstrap-datepicker.js')}}"></script>

	<!-- Datatables -->
	<script>
		$(document).ready(function() {
            var handleDataTableButtons = function() {
                if ($('table.bc').length) {
                    $('table.bc').DataTable({
                        dom: "Bfrtip",
                        buttons: [
                        {
                            extend: "copy",
                            className: "btn-sm"
                        },
                        {
                            extend: "csv",
                            className: "btn-sm"
                        },
                        {
                            extend: "excel",
                            className: "btn-sm"
                        },
                        {
                            extend: "pdfHtml5",
                            className: "btn-sm"
                        },
                        {
                            extend: "print",
                            className: "btn-sm"
                        },
                        ],
                        responsive: true
                    });
                }
				if ($('table.fact').length) {
                    $('table.fact').DataTable({
                        dom: "Bfrtip",
                        buttons: [],
                        responsive: true
                    });
                }
            };

            TableManageButtons = function() {
                "use strict";
                return {
                    init: function() {
                        handleDataTableButtons();
                    }
                };
            }();

            $('#datatable').dataTable();

            $('#datatable-keytable').DataTable({
                keys: true
            });

            $('#datatable-responsive').DataTable();

            $('#datatable-scroller').DataTable({
                ajax: "js/datatables/json/scroller-demo.json",
                deferRender: true,
                scrollY: 380,
                scrollCollapse: true,
                scroller: true
            });

            $('#datatable-fixed-header').DataTable({
                fixedHeader: true
            });

            var $datatable = $('#datatable-checkbox');

            $datatable.dataTable({
                'order': [[ 1, 'asc' ]],
                'columnDefs': [
                { orderable: false, targets: [0] }
                ]
            });
            $datatable.on('draw.dt', function() {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_flat-green'
                });
            });

            TableManageButtons.init();
        });
	</script>

	<!-- /Datatables -->
	<script type="text/javascript">
		$(function () {                
                $('#date_bc').datepicker({
                    format: "dd/mm/yyyy"
                });
				$('#date_cheque').datepicker({
                    format: "dd/mm/yyyy"
                });
            });
	</script>

</body>

</html>