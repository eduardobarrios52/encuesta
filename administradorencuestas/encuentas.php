<!doctype html>
<html class="fixed">

<head>
	<!-- Basic -->
	<meta charset="UTF-8">
	<title>Lineas Telefónicas</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

	<meta name="keywords" content="HTML5 Admin Template" />
	<meta name="description" content="Porto Admin - Responsive HTML5 Template">
	<meta name="author" content="okler.net">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<!-- Web Fonts  -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

	<!-- Vendor CSS -->
	<link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" href="../assets/vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="../assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

	<!-- Specific Page Vendor CSS -->
	<link rel="stylesheet" href="../assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />

	<!-- Theme CSS -->
	<link rel="stylesheet" href="../assets/stylesheets/theme.css" />

	<!-- Skin CSS -->
	<link rel="stylesheet" href="../assets/stylesheets/skins/default.css" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="../assets/stylesheets/theme-custom.css">

	<!-- Head Libs -->
	<script src="../assets/vendor/modernizr/modernizr.js"></script>


</head>

<body>
	<section class="body">

		<!-- start: header -->
		<header class="header">
			<div class="logo-container">
				<a href="../" class="logo">
					<img src="../assets/images/logo.png" height="35" alt="Porto Admin" />
				</a>
				<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
					<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
				</div>
			</div>

			<!-- start: search & user box -->
			<div class="header-right">




				<span class="separator"></span>

				<div id="userbox" class="userbox">
					<a href="#" data-toggle="dropdown">
						<figure class="profile-picture">
							<img src="../assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
						</figure>
						<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
							<span class="name">Usuario</span>

						</div>

						<i class="fa custom-caret"></i>
					</a>

					<div class="dropdown-menu">
						<ul class="list-unstyled">
							<li class="divider"></li>

							<li>
								<a role="menuitem" tabindex="-1" href="pages-signin.html"><i class="fa fa-power-off"></i> Logout</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- end: search & user box -->
		</header>
		<!-- end: header -->

		<div class="inner-wrapper">
			<!-- start: sidebar -->
			<aside id="sidebar-left" class="sidebar-left">

				<div class="sidebar-header">
					<div class="sidebar-title">
						Navigation
					</div>
					<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>

				<div class="nano">
					<div class="nano-content">
						<nav id="menu" class="nav-main" role="navigation">
							<ul class="nav nav-main">
								<li class="nav-parent nav-expanded nav-active">
									<a>
										<i class="fa fa-list-alt" aria-hidden="true"></i>
										<span>Lineas Telefonicas</span>
									</a>
									<ul class="nav nav-children">
										<li>
											<a href="lineas.php">
												Lineas Telefonicas
											</a>
										</li>

									</ul>
								</li>





							</ul>
						</nav>



						<hr class="separator" />

					</div>

				</div>

			</aside>
			<!-- end: sidebar -->
			<section role="main" class="content-body">
				<header class="page-header">
					<h2>Administrar encuestas</h2>

					<div class="right-wrapper pull-right">
						<ol class="breadcrumbs">
							<li>
								<a href="index.html">
									<i class="fa fa-home"></i>
								</a>
							</li>
							<li><span></span></li>
							<li><span>Administrar encuestas</span></li>
						</ol>

						<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
					</div>
				</header>

				<div class="row">
					<div class="col-lg-12">

						<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>

								<h2 class="panel-title">Encuestas</h2>
							</header>
							<div class="panel-body">
								<form id="form_nominas" class="form-horizontal form-bordered" action="#">
									<div class="row justify-content-md-center">
										<div class="show-grid">
											<div class="col-md-12 col-md-offset-3">
												<div class="form-group row">
													<div class="col-md-12" style="text-align: center;">
														<label style="font-size: 22px; font-family: revert; padding: 0 0 15px 0; font-weight: bold;">
															ENCUESTAS DEL DEPTO.
														</label>
													</div>
												</div>
												<div class="form-group row">
													<div class="col-md-2" style="text-align: center;">
														<button type="button" class="mb-xs mt-xs mr-xs btn btn-info" onclick="generarlink();"><i class="fa fa-external-link"></i>Link</button>
													</div>
													<div class="col-md-6" style="text-align: center;">
														<select id="tipencuestas" class="form-control">
															<option value='0'>Seleccione la Encuesta...</option>
															<?php

															if (!isset($_SESSION)) {

																session_start();
															}
															$index = explode('/', $_SERVER['PHP_SELF']);
															$path = $_SERVER['DOCUMENT_ROOT'] . '/' . $index[1];
															require_once $path . '/src/controller/connectControllerMysql.php';

															use Src\Controller\ConnectControllerMysql;

															$connectarMysql = new ConnectControllerMysql('encuestas');
															$encuestas = $connectarMysql->executeSQL("SELECT H.H_CVE_ENC, H.NOMBRE FROM H_ENC H WHERE H.STATUS = 'A' ", 0);

															if ($encuestas) {

																if (is_array($encuestas)) {

																	foreach ($encuestas as $item) {

																		echo '<option value="' . $item->H_CVE_ENC . '">' . utf8_encode($item->NOMBRE) . '</option>';
																	}
																} else {

																	echo '<option value="' . $encuestas->H_CVE_ENC . '">' . utf8_encode($encuestas->NOMBRE) . '</option>';
																}
															}
															?>
														</select>
													</div>
													<div class="col-md-4" style="text-align: center;">
														<div class="row">
															<button type="button" class="mb-xs mt-xs mr-xs btn btn-success" onclick="agregarEncuesta();"><i class="fa fa-plus"></i>Agregar</button>
														</div>
														<div class="row" style="margin-top: 5px;">
															<button type="button" class="mb-xs mt-xs mr-xs btn btn-warning class-test" onclick="editarEncuesta();" style="display: none;"><i class="fa fa-pencil-square-o"></i>Editar</button>
														</div>
														<div class="row" style="margin-top: 5px;">
															<button type="button" class="mb-xs mt-xs mr-xs btn btn-danger class-test" onclick="eliminarEncuesta();" style="display: none;"><i class="fa fa-trash-o"></i>Eliminar</button>
														</div>
													</div>
													<a class="mb-xs mt-xs mr-xs modal-basic btn btn-default" href="#modalBasic" id="ModalEncuesta" style="display: none;"></a>
													<div id="modalBasic" class="modal-block modal-block-success mfp-hide">
														<section class="panel">
															<header class="panel-heading">
																<h2 class="panel-title" id="title-modal-enc"></h2>
															</header>
															<div class="panel-body" id="body-modal-enc">
															</div>
															<footer class="panel-footer">
																<div class="row">
																	<div class="col-md-11 text-right" id="div-modal-footer">
																	</div>
																</div>
															</footer>
														</section>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</section>

						<section class="panel" id="panel-encuestas">
							<div class="chart chart-md" id="flotPie"></div>
						</section>
					</div>
				</div>
			</section>
		</div>
	</section>

	<!-- Vendor -->
	<script src="../assets/vendor/jquery/jquery.js"></script>
	<script src="../assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.js"></script>
	<script src="../assets/vendor/nanoscroller/nanoscroller.js"></script>
	<script src="../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="../assets/vendor/magnific-popup/magnific-popup.js"></script>
	<script src="../assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

	<!-- Specific Page Vendor -->
	<script src="../assets/vendor/jquery-autosize/jquery.autosize.js"></script>
	<script src="../assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>

	<!-- Theme Base, Components and Settings -->
	<script src="../assets/javascripts/theme.js"></script>

	<!-- Theme Custom -->
	<script src="../assets/javascripts/theme.custom.js"></script>

	<!-- Theme Initialization Files -->
	<script src="../assets/javascripts/theme.init.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
	<!--
	<script src="../assets/js/main.js"></script>
	<script src="../assets/js/pnotify.custom.js"></script>
	<script src="../assets/js/magnific-popup.js"></script>
	<script src="../assets/js/examples.advanced.form.js"></script>
	<script src="../assets/js/examples.modals.js"></script>
	
														-->
	<script src="../vendor/select2/select2.js"></script>
	<script src="../assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
	<script src="../assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
	<script src="../assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
	<script src="../assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
	<script src="../assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
	<script src="../assets/vendor/fuelux/js/spinner.js"></script>
	<script src="../assets/vendor/dropzone/dropzone.js"></script>
	<script src="../assets/vendor/bootstrap-markdown/js/markdown.js"></script>
	<script src="../assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
	<script src="../assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
	<script src="../assets/vendor/codemirror/lib/codemirror.js"></script>
	<script src="../assets/vendor/codemirror/addon/selection/active-line.js"></script>
	<script src="../assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
	<script src="../assets/vendor/codemirror/mode/javascript/javascript.js"></script>
	<script src="../assets/vendor/codemirror/mode/xml/xml.js"></script>
	<script src="../assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
	<script src="../assets/vendor/codemirror/mode/css/css.js"></script>
	<script src="../assets/vendor/summernote/summernote.js"></script>
	<script src="../assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
	<script src="../assets/vendor/ios7-switch/ios7-switch.js"></script>
	<script src="../assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
	<script src="../assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
	<script src="../assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>

	<script src="../assets/vendor/jquery-appear/jquery.appear.js"></script>
	<script src="../assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
	<script src="../assets/vendor/flot/jquery.flot.js"></script>
	<script src="../assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
	<script src="../assets/vendor/flot/jquery.flot.pie.js"></script>
	<script src="../assets/vendor/flot/jquery.flot.categories.js"></script>
	<script src="../assets/vendor/flot/jquery.flot.resize.js"></script>
	<script src="../assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>

	<script src="../assets/vendor/pnotify/pnotify.custom.js"></script>


	<script src="../assets/javascripts/theme.js"></script>


	<script src="../assets/javascripts/theme.custom.js"></script>


	<script src="../assets/javascripts/theme.init.js"></script>


	<script src="../assets/javascripts/forms/examples.advanced.form.js"></script>
	<script src="../assets/javascripts/ui-elements/examples.modals.js"></script>
	<script src="../assets/javascripts/ui-elements/examples.charts.js"></script>

	<script>
		let arrayResponse = [];

		$(document).ready(function() {

			$('#tipencuestas').select2();

			$('#tipencuestas').unbind('change');
			$('#tipencuestas').change(function() {

				if ($('#tipencuestas').val() != 0) {

					$('.class-test').css('display', 'inline-block');
				} else {

					$('.class-test').css('display', 'none');
				}

				$('.loader').css('display', 'block');

				$('#panel-encuestas').html('<header class="panel-heading">' +
					'<div class="panel-actions">' +
					'<a href="#" class="fa fa-caret-down"></a>' +
					'</div>' +
					'<h2 class="panel-title">Preguntas</h2>' +
					'</header>' +
					'<div class="panel-body">' +
					'<div class="table-responsive" id="div-table-preguntas">' +
					'</div>' +
					'</div>');

				reloadTable($('#tipencuestas').val());
			});
		});

		function generarlink() {

			if ($('#tipencuestas').val() != 0) {

				$('.loader').css('display', 'block');

				$.ajax({
					url: 'getlink.php',
					type: 'POST',
					data: {
						test: $('#tipencuestas').val()
					},
					dataType: 'json',
					error: function(err) {

						$.magnificPopup.close();

						$('.loader').css('display', 'none');

						new PNotify({
							title: 'Error',
							text: 'Error en el servidor',
							type: 'error'
						});

						console.log(err);
					},
					success: function(respuesta) {

						if (respuesta.CODE == 200) {

							$('#title-modal-enc').html('URL de la Encuesta');
							$('#body-modal-enc').html('<form id="test-form" class="form-horizontal mb-lg">' +
								'<div class="form-group mt-lg">' +
								'<div class="col-sm-10">' +
								'<input type="text" name="urlTest" id="urlTest" class="form-control" value="' + respuesta.URL + '" disabled readonly style="text-overflow: ellipsis;"/>' +
								'<input type="hidden" id="inputHidden"/>' +
								'</div>' +
								'<div class="col-sm-2" style="top: -5px;">' +
								'<button type="button" class="mb-xs mt-xs mr-xs btn btn-info" id="copyURL"><i class="fa fa-copy" style="color: #fff;"></i>Copiar</button>' +
								'</div>' +
								'</div>' +
								'</form>');

							$('#div-modal-footer').html('<button class="btn btn-default modal-dismiss">Cancelar</button>');

							$('#copyURL').unbind('click');
							$('#copyURL').click(function() {

								var $temp = $('<input>');

								$('#modalBasic').append($temp);

								$temp.val($.trim($('#urlTest').val())).select();

								document.execCommand('copy');

								$temp.remove();
							});

							$('#ModalEncuesta').click();

							$('.loader').css('display', 'none');
						} else {

							new PNotify({
								title: 'Advertencia',
								text: 'Ingrese los parámetros correctamente',
								type: 'warning'
							});

							$('.loader').css('display', 'none');
						}
					}
				});
			} else {

				new PNotify({
					title: 'Advertencia',
					text: 'Seleccione una encuesta',
					type: 'warning'
				});
			}
		}

		function eliminarEncuesta() {

			$('#title-modal-enc').html('Eliminar Encuesta');
			$('#body-modal-enc').html('<div class="modal-wrapper">' +
				'<div class="modal-icon">' +
				'<i class="fa fa-question-circle"></i>' +
				'</div>' +
				'<div class="modal-text">' +
				'<h4>¿Deseas eliminar el elemento?</h4>' +
				'<p>Las preguntas y respuestas ligadas a la encuesta también serán eliminadas</p>' +
				'</div>' +
				'<div class="modal-text">' +
				'<label class="col-sm-12 control-label" style="color: red;" id="labelError"></label>' +
				'</div>' +
				'</div>');

			$('#div-modal-footer').html('<button class="btn btn-primary modal-confirm-enc">Confirmar</button>' +
				'<button class="btn btn-default modal-dismiss">Cancelar</button>');

			$('#ModalEncuesta').click();

			$('.modal-confirm-enc').unbind('click');
			$('.modal-confirm-enc').click(function(e) {

				if ($('#tipencuestas').val() > 0) {

					$('.loader').css('display', 'block');

					$.ajax({
						url: 'eliminarencuesta.php',
						type: 'POST',
						data: {
							id: $('#tipencuestas').val()
						},
						dataType: 'json',
						error: function(err) {

							$.magnificPopup.close();

							$('.loader').css('display', 'none');

							new PNotify({
								title: 'Error',
								text: 'Error en el servidor',
								type: 'error'
							});

							console.log(err);
						},
						success: function(respuesta) {

							$.magnificPopup.close();

							if (respuesta != false) {

								if (respuesta == 200) {

									new PNotify({
										title: 'Success!!!',
										text: 'Se registro correctamente',
										type: 'success'
									});

									reloadEncuesta();
								} else {

									new PNotify({
										title: 'Advertencia',
										text: 'Revise los datos',
										type: 'error'
									});
								}
							} else {

								new PNotify({
									title: 'Advertencia',
									text: 'Revise los datos',
									type: 'warning'
								});
							}
						}
					});
				}
			});
		}

		function editarEncuesta() {

			$('#title-modal-enc').html('Editar Encuesta');
			$('#body-modal-enc').html('<form id="test-form" class="form-horizontal mb-lg">' +
				'<div class="form-group mt-lg">' +
				'<label class="col-sm-3 control-label">Encuesta</label>' +
				'<div class="col-sm-9">' +
				'<input type="text" name="test" id="test" class="form-control" placeholder="Nombre de Encuesta" required/>' +
				'</div>' +
				'</div>' +
				'</form>');

			$('#test').val($.trim($('#tipencuestas option:selected').text()));

			$('#div-modal-footer').html('<button class="btn btn-primary modal-confirm-enc">Confirmar</button>' +
				'<button class="btn btn-default modal-dismiss">Cancelar</button>');

			$('#ModalEncuesta').click();

			$('.modal-confirm-enc').unbind('click');
			$('.modal-confirm-enc').click(function(e) {

				if ($.trim($('#test').val()) != '') {

					$('.loader').css('display', 'block');

					$.ajax({
						url: 'editarencuesta.php',
						type: 'POST',
						data: {
							test: $.trim($('#test').val()),
							id: $('#tipencuestas').val()
						},
						dataType: 'json',
						error: function(err) {

							$.magnificPopup.close();

							$('.loader').css('display', 'none');

							new PNotify({
								title: 'Error',
								text: 'Error en el servidor',
								type: 'error'
							});

							console.log(err);
						},
						success: function(respuesta) {

							$.magnificPopup.close();

							if (respuesta != false) {

								if (respuesta == 200) {

									new PNotify({
										title: 'Success!!!',
										text: 'Se registro correctamente',
										type: 'success'
									});

									reloadEncuesta();
								} else {

									new PNotify({
										title: 'Advertencia',
										text: 'Revise los datos',
										type: 'error'
									});
								}
							} else {

								new PNotify({
									title: 'Advertencia',
									text: 'Revise los datos',
									type: 'warning'
								});
							}
						}
					});
				} else {

					$.magnificPopup.close();

					$('.loader').css('display', 'none');

					new PNotify({
						title: 'Advertencia',
						text: 'Ingrese el nombre de la encuesta',
						type: 'warning'
					});
				}
			});

		}

		function agregarEncuesta() {

			$('#title-modal-enc').html('Agregar Encuesta');
			$('#body-modal-enc').html('<form id="test-form" class="form-horizontal mb-lg">' +
				'<div class="form-group mt-lg">' +
				'<label class="col-sm-3 control-label">Encuesta</label>' +
				'<div class="col-sm-9">' +
				'<input type="text" name="test" id="test" class="form-control" placeholder="Nombre de Encuesta" required/>' +
				'</div>' +
				'</div>' +
				'</form>');

			$('#div-modal-footer').html('<button class="btn btn-primary modal-confirm-enc">Confirmar</button>' +
				'<button class="btn btn-default modal-dismiss">Cancelar</button>');

			$('#ModalEncuesta').click();

			$('.modal-confirm-enc').unbind('click');
			$('.modal-confirm-enc').click(function(e) {

				if ($.trim($('#test').val()) != '') {

					$('.loader').css('display', 'block');

					$.ajax({
						url: 'agregarencuesta.php',
						type: 'POST',
						data: {
							test: $.trim($('#test').val())
						},
						dataType: 'json',
						error: function(err) {

							$.magnificPopup.close();

							$('.loader').css('display', 'none');

							new PNotify({
								title: 'Error',
								text: 'Error en el servidor',
								type: 'error'
							});

							console.log(err);
						},
						success: function(respuesta) {

							$.magnificPopup.close();

							if (respuesta != false) {

								if (respuesta == 200) {

									new PNotify({
										title: 'Success!!!',
										text: 'Se registro correctamente',
										type: 'success'
									});

									reloadEncuesta();
								} else {

									new PNotify({
										title: 'Advertencia',
										text: 'Revise los datos',
										type: 'error'
									});
								}
							} else {

								new PNotify({
									title: 'Advertencia',
									text: 'Revise los datos',
									type: 'warning'
								});
							}
						}
					});
				} else {

					$.magnificPopup.close();

					$('.loader').css('display', 'none');

					new PNotify({
						title: 'Advertencia',
						text: 'Ingrese el nombre de la encuesta',
						type: 'warning'
					});
				}
			});
		}

		function agregarPregunta(idenc) {

			$('.loader').css('display', 'block');

			$('#title-modal-enc').html('Agregar Pregunta');
			$('#body-modal-enc').html('<form id="test-form" class="form-horizontal mb-lg">' +
				'<div class="form-group mt-lg">' +
				'<label class="col-sm-3 control-label">Pregunta</label>' +
				'<div class="col-sm-9">' +
				'<input type="text" name="question" id="question" class="form-control" placeholder="Nombre de la Pregunta" required/>' +
				'</div>' +
				'</div>' +
				'<div class="form-group mt-lg">' +
				'<label class="col-sm-3 control-label">Tipo de respuesta</label>' +
				'<div class="col-sm-9">' +
				'<select id="tiprespuesta" class="form-control">' +
				'</select>' +
				'</div>' +
				'</div>' +
				'<div class="form-group mt-lg" id="form-resp">' +
				'</div>' +
				'<div class="form-group mt-lg" id="opcion-respuesta">' +
				'</div>' +
				'<div class="form-group mt-lg">' +
				'<label class="col-sm-12 control-label" style="color: red;" id="labelError"></label>' +
				'</div>' +
				'</form>');

			$('#div-modal-footer').html('<button class="btn btn-primary modal-confirm-enc">Confirmar</button>' +
				'<button class="btn btn-default modal-dismiss">Cancelar</button>');

			$.ajax({
				url: 'gettipsrespuestas.php',
				type: 'GET',
				dataType: 'json',
				error: function(err) {

					$('.loader').css('display', 'none');

					new PNotify({
						title: 'Error',
						text: 'Error en el servidor',
						type: 'error'
					});

					console.log(err);
				},
				success: function(respuesta) {

					if (respuesta != false) {

						$('#tiprespuesta').html('<option value="0">Tipos de respuestas...</option>');

						respuesta.forEach(element => {

							$('#tiprespuesta').append('<option value="' + element.CLAVE + '">' + element.DESCR + '</option>');
						});
					}

					$('.loader').css('display', 'none');
				}
			});

			$('#ModalEncuesta').click();

			$('#tiprespuesta').unbind('change');
			$('#tiprespuesta').change(function() {

				arrayResponse = [];

				$('#labelError').text('');

				$('.loader').css('display', 'block');

				$.ajax({
					url: 'gettiprespuesta.php',
					type: 'POST',
					data: {
						response: $('#tiprespuesta').val()
					},
					dataType: 'json',
					error: function(err) {

						$('.loader').css('display', 'none');

						new PNotify({
							title: 'Error',
							text: 'Error en el servidor',
							type: 'error'
						});

						console.log(err);
					},
					success: function(respuesta) {

						$('#form-resp').html('');

						if (respuesta != false) {

							if (respuesta == 400) {

								$('#opcion-respuesta').html('');

								new PNotify({
									title: 'Advertencia',
									text: 'Revise los parámetros ingresados',
									type: 'warning'
								});
							} else {

								$('#opcion-respuesta').html(respuesta);

								$('#form-resp').html('<label class="col-sm-3 control-label">Formas de respuesta</label>' +
									'<div class="col-sm-9">' +
									'<select id="formrespuesta" class="form-control">' +
									'<option value="0">Ver respuesta como...</option>' +
									'<option value="1">Lineal</option>' +
									'<option value="2">Lista</option>' +
									'</select>' +
									'</div>');
							}
						} else {

							$('#opcion-respuesta').html('');

							if ($('#tiprespuesta').val() != 2) {

								new PNotify({
									title: 'Advertencia',
									text: 'Error en los parámetros',
									type: 'warning'
								});
							}
						}

						$('.loader').css('display', 'none');
					}
				});
			});

			$('.modal-confirm-enc').unbind('click');
			$('.modal-confirm-enc').click(function(e) {

				if ($.trim($('#question').val()) != '') {

					$('#labelError').text('');

					$('.loader').css('display', 'block');

					$.ajax({
						url: 'agregarpregunta.php',
						type: 'POST',
						data: {
							tipo: $('#tiprespuesta').val(),
							responses: arrayResponse,
							question: $('#question').val(),
							test: idenc,
							formresp: $('#formrespuesta').val()
						},
						dataType: 'json',
						error: function(err) {

							$('.loader').css('display', 'none');

							$('#labelError').text('Error en el servidor');

							console.log(err);
						},
						success: function(respuesta) {

							if (respuesta != false) {

								if (respuesta == 400) {

									$('#labelError').text('Revise los parámetros ingresados');

									$('.loader').css('display', 'none');
								} else {

									$.magnificPopup.close();

									new PNotify({
										title: 'Success!!!',
										text: 'Se registro correctamente',
										type: 'success'
									});

									setTimeout(function() {
										reloadTable(idenc);
									}, 2000);
								}
							} else {

								$('#labelError').text('Error en los parámetros');

								$('.loader').css('display', 'none');
							}
						}
					});
				} else {

					$('#labelError').text('Ingrese el nombre de la pregunta');
				}
			});
		}

		function agregarRespuesta(tipo) {

			$('#labelError').text('');

			const flagArray = $('#tbody-respuestas').attr('data-id');

			if (tipo == 3) {

				$('#tbody-respuestas').append('<tr id="tr-response-' + flagArray + '">' +
					'<td id="td-textresponse-' + flagArray + '"> <input type="text" name="respuesta" id="response" class="form-control" placeholder="Respuesta..."/> </td>' +
					'<td id="td-valueresponse-' + flagArray + '"> <input type="text" name="valorrespuesta" id="valueresponse" class="form-control" placeholder="Valor de la respuesta..."/> </td>' +
					'<td id="td-editresponse-' + flagArray + '"> <button type="button" class="mb-xs mt-xs mr-xs btn btn-success" id="addResponse"><i class="fa fa-check" style="color: #fff;"></i>Ok</button> </td>' +
					'</tr>');

				$('#addResponse').unbind('click');
				$('#addResponse').click(function() {

					const textresponse = $('#response').val();
					const valueresponse = $('#valueresponse').val();

					if ($.trim(textresponse) == '' || $.trim(valueresponse) == '') {

						$('#labelError').text('Ingrese los valores completos');
					} else {

						arrayResponse.push({
							id: ('response-' + flagArray),
							response: textresponse,
							value: valueresponse
						});

						$('#td-textresponse-' + flagArray).html(textresponse);
						$('#td-valueresponse-' + flagArray).html(valueresponse);
						$('#td-editresponse-' + flagArray).html('<i class="fa fa-trash-o" style="color: red;" id="deleteResponse-' + flagArray + '"></i>');

						$('#deleteResponse-' + flagArray).unbind('click');
						$('#deleteResponse-' + flagArray).click(function() {

							if (arrayResponse.find(idres => idres.id === ('response-' + flagArray))) {

								const object_find = arrayResponse.findIndex(idres => idres.id === ('response-' + flagArray));

								arrayResponse.splice(object_find, 1);

								$('#tr-response-' + flagArray).remove();
							}
						});

						$('#tbody-respuestas').attr('data-id', parseInt(flagArray) + 1);

						$('#labelError').text('');
					}
				});
			} else {

				$('#tbody-respuestas').append('<tr id="tr-response-' + flagArray + '">' +
					'<td id="td-textresponse-' + flagArray + '"> <input type="text" name="respuesta" id="response" class="form-control" placeholder="Respuesta..."/> </td>' +
					'<td id="td-editresponse-' + flagArray + '"> <button type="button" class="mb-xs mt-xs mr-xs btn btn-success" id="addResponse"><i class="fa fa-check" style="color: #fff;"></i>Ok</button> </td>' +
					'</tr>');

				$('#addResponse').unbind('click');
				$('#addResponse').click(function() {

					const idreponse = flagArray;
					const textresponse = $('#response').val();

					if ($.trim(textresponse) == '') {

						$('#labelError').text('Ingrese los valores completos');
					} else {

						arrayResponse.push({
							id: ('response-' + flagArray),
							response: textresponse
						});

						$('#td-textresponse-' + flagArray).html(textresponse);
						$('#td-editresponse-' + flagArray).html('<i class="fa fa-trash-o" style="color: red;" id="deleteResponse-' + flagArray + '" ></i>');

						$('#deleteResponse-' + flagArray).unbind('click');
						$('#deleteResponse-' + flagArray).click(function() {

							if (arrayResponse.find(idres => idres.id === ('response-' + flagArray))) {

								const object_find = arrayResponse.findIndex(idres => idres.id === ('response-' + flagArray));

								arrayResponse.splice(object_find, 1);

								$('#tr-response-' + flagArray).remove();
							}
						});

						$('#tbody-respuestas').attr('data-id', parseInt(flagArray) + 1);

						$('#labelError').text('');
					}
				});
			}
		}

		function operationQuesResp(tipo, operacion, data) {

			if (tipo == 1) {

				if (operacion == 1) {

					$('#title-modal-enc').html('Editar Pregunta');
					$('#body-modal-enc').html('<form id="test-form" class="form-horizontal mb-lg">' +
						'<div class="form-group mt-lg">' +
						'<label class="col-sm-3 control-label">Pregunta</label>' +
						'<div class="col-sm-9">' +
						'<input type="text" name="question" id="question" class="form-control" placeholder="Nombre de la Pregunta" required/>' +
						'</div>' +
						'</div>' +
						'<div class="form-group mt-lg">' +
						'<label class="col-sm-12 control-label" style="color: red;" id="labelError"></label>' +
						'</div>' +
						'</form>');

					$('#div-modal-footer').html('<button class="btn btn-primary modal-confirm-enc">Confirmar</button>' +
						'<button class="btn btn-default modal-dismiss">Cancelar</button>');

					$('#question').val($('#tr-preg-' + data + ' td')[1].innerHTML);

					$('#ModalEncuesta').click();

					$('.modal-confirm-enc').unbind('click');
					$('.modal-confirm-enc').click(function(e) {

						if ($.trim($('#question').val()) != '') {

							$('#labelError').text('');

							$('.loader').css('display', 'block');

							$.ajax({
								url: 'editarpregunta.php',
								type: 'POST',
								data: {
									question: $('#question').val(),
									id: data
								},
								dataType: 'json',
								error: function(err) {

									$('.loader').css('display', 'none');

									$('#labelError').text('Error en el servidor');

									console.log(err);
								},
								success: function(respuesta) {

									if (respuesta != false) {

										if (respuesta.code == 200) {

											$.magnificPopup.close();

											new PNotify({
												title: 'Success!!!',
												text: 'Se modifico correctamente',
												type: 'success'
											});

											setTimeout(function() {
												reloadTable(respuesta.test);
											}, 2000);
										} else {

											$('#labelError').text('Revise los parámetros ingresados');

											$('.loader').css('display', 'none');
										}
									} else {

										$('#labelError').text('Error en los parámetros');

										$('.loader').css('display', 'none');
									}
								}
							});
						} else {

							$('#labelError').text('Ingrese el nombre de la pregunta');
						}
					});
				} else if (operacion == 2) {

					$('#title-modal-enc').html('Eliminar Pregunta');
					$('#body-modal-enc').html('<div class="modal-wrapper">' +
						'<div class="modal-icon">' +
						'<i class="fa fa-question-circle"></i>' +
						'</div>' +
						'<div class="modal-text">' +
						'<h4>¿Deseas eliminar el elemento?</h4>' +
						'<p>Las respuestas ligadas a la pregunta también serán eliminadas</p>' +
						'</div>' +
						'<div class="modal-text">' +
						'<label class="col-sm-12 control-label" style="color: red;" id="labelError"></label>' +
						'</div>' +
						'</div>');

					$('#div-modal-footer').html('<button class="btn btn-primary modal-confirm-enc">Confirmar</button>' +
						'<button class="btn btn-default modal-dismiss">Cancelar</button>');

					$('#ModalEncuesta').click();

					$('.modal-confirm-enc').unbind('click');
					$('.modal-confirm-enc').click(function(e) {

						$('#labelError').text('');

						$('.loader').css('display', 'block');

						$.ajax({
							url: 'eliminarpregunta.php',
							type: 'POST',
							data: {
								id: data
							},
							dataType: 'json',
							error: function(err) {

								$('.loader').css('display', 'none');

								$('#labelError').text('Error en el servidor');

								console.log(err);
							},
							success: function(respuesta) {

								if (respuesta != false) {

									if (respuesta.code == 200) {

										$.magnificPopup.close();

										new PNotify({
											title: 'Success!!!',
											text: 'Se eliminó correctamente',
											type: 'success'
										});

										setTimeout(function() {
											reloadTable(respuesta.test);
										}, 2000);
									} else {

										$('#labelError').text('Revise los parámetros ingresados');

										$('.loader').css('display', 'none');
									}
								} else {

									$('#labelError').text('Error en los parámetros');

									$('.loader').css('display', 'none');
								}
							}
						});
					});
				} else {

					$('#title-modal-enc').html('Gráfica');
					$('#body-modal-enc').html('<div class="chart chart-md" id="flotPie"></div>' +
						'<div class="modal-text">' +
						'<label class="col-sm-12 control-label" style="color: red;" id="labelError"></label>' +
						'</div>');

					$('#div-modal-footer').html('<button class="btn btn-default modal-dismiss">Cancelar</button>');

					$('#ModalEncuesta').click();

					$('.loader').css('display', 'block');

					$.ajax({
						url: 'getGrafica.php',
						type: 'POST',
						data: {
							id: data
						},
						dataType: 'json',
						error: function(err) {

							$('.loader').css('display', 'none');

							$('#labelError').text('Error en el servidor');

							console.log(err);
						},
						success: function(respuesta) {

							if (respuesta != false) {

								$('#title-modal-enc').append(': ' + respuesta.question);

								//$('#div-modal-footer').append(' <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary"> <a download="Grafica.jpg" href="" onclick="download_canvas(this);"><i class="fa fa-download" aria-hidden="true" style="color: white;"></i></a> </button>');

								if (respuesta.code == 200) {

									$('.loader').css('display', 'none');

									var flotPieData = [];

									respuesta.response.forEach(element => {

										flotPieData.push({
											label: element.RESP,
											data: [
												[1, element.PORCENTAJE]
											],
											color: 'rgba(' + Math.floor(Math.random() * 255) + ', ' + Math.floor(Math.random() * 255) + ', ' + Math.floor(Math.random() * 255) + ')'
										});
									});

									var plot = $.plot('#flotPie', flotPieData, {
										series: {
											pie: {
												show: true,
												combine: {
													color: '#999',
													threshold: 0.1
												}
											}
										},
										legend: {
											show: false
										},
										grid: {
											hoverable: true,
											clickable: true
										}
									});
								} else if (respuesta.code == 401) {

									$('#labelError').text('No hay respuestas para esta pregunta');

									$('.loader').css('display', 'none');
								} else {

									$('#labelError').text('Revise los parámetros ingresados');

									$('.loader').css('display', 'none');
								}
							} else {

								$('#labelError').text('Error en los parámetros');

								$('.loader').css('display', 'none');
							}
						}
					});
				}
			} else {

				if (operacion == 1) {

					$('#title-modal-enc').html('Editar Respuesta');

					if ($('#tr-resp-' + data).attr('data-type') == 3) {

						$('#body-modal-enc').html('<form id="test-form" class="form-horizontal mb-lg">' +
							'<div class="form-group mt-lg">' +
							'<label class="col-sm-2 control-label">Respuesta</label>' +
							'<div class="col-sm-5">' +
							'<input type="text" name="response" id="responsedetails" class="form-control" placeholder="Respuesta..." required/>' +
							'</div>' +
							'<label class="col-sm-2 control-label">Valor</label>' +
							'<div class="col-sm-3">' +
							'<input type="text" name="valorreponse" id="valorreponse" class="form-control" placeholder="Valor..." required/>' +
							'</div>' +
							'</div>' +
							'<div class="form-group mt-lg">' +
							'<label class="col-sm-12 control-label" style="color: red;" id="labelError"></label>' +
							'</div>' +
							'</form>');
					} else {

						$('#body-modal-enc').html('<form id="test-form" class="form-horizontal mb-lg">' +
							'<div class="form-group mt-lg">' +
							'<label class="col-sm-3 control-label">Respuesta</label>' +
							'<div class="col-sm-10">' +
							'<input type="text" name="response" id="responsedetails" class="form-control" placeholder="Respuesta..." required/>' +
							'</div>' +
							'</div>' +
							'<div class="form-group mt-lg">' +
							'<label class="col-sm-12 control-label" style="color: red;" id="labelError"></label>' +
							'</div>' +
							'</form>');
					}

					$('#div-modal-footer').html('<button class="btn btn-primary modal-confirm-enc">Confirmar</button>' +
						'<button class="btn btn-default modal-dismiss">Cancelar</button>');

					$('#responsedetails').val($.trim($('#tr-resp-' + data + ' td')[0].innerHTML));
					$('#valorreponse').val($.trim($('#tr-resp-' + data + ' td')[1].innerHTML));

					$('#ModalEncuesta').click();

					$('.modal-confirm-enc').unbind('click');
					$('.modal-confirm-enc').click(function(e) {

						if (($('#tr-resp-' + data).attr('data-type') == 3 && ($.trim($('#responsedetails').val()) != '' && $.trim($('#valorreponse').val()) != '')) || ($('#tr-resp-' + data).attr('data-type') != 3 && ($.trim($('#responsedetails').val()) != ''))) {

							$('.loader').css('display', 'block');

							$('#labelError').text('');

							const params = (($('#tr-resp-' + data).attr('data-type') == 3) ? {
								response: $('#responsedetails').val(),
								type: $('#tr-resp-' + data).attr('data-type'),
								valor: $('#valorreponse').val(),
								id: data
							} : {
								response: $('#responsedetails').val(),
								type: $('#tr-resp-' + data).attr('data-type'),
								id: data
							});

							$.ajax({
								url: 'editarrespuesta.php',
								type: 'POST',
								data: params,
								dataType: 'json',
								error: function(err) {

									$('.loader').css('display', 'none');

									$('#labelError').text('Error en el servidor');

									console.log(err);
								},
								success: function(respuesta) {

									if (respuesta != false) {

										if (respuesta.code == 200) {

											$.magnificPopup.close();

											new PNotify({
												title: 'Success!!!',
												text: 'Se modifico correctamente',
												type: 'success'
											});

											setTimeout(function() {
												reloadTable(respuesta.test);
											}, 2000);
										} else {

											$('#labelError').text('Revise los parámetros ingresados');

											$('.loader').css('display', 'none');
										}
									} else {

										$('#labelError').text('Error en los parámetros');

										$('.loader').css('display', 'none');
									}
								}
							});
						} else {

							$('#labelError').text('Ingrese el nombre de la respuesta o el valor');
						}
					});
				} else if (operacion == 2) {

					$('#title-modal-enc').html('Eliminar Respuesta');
					$('#body-modal-enc').html('<div class="modal-wrapper">' +
						'<div class="modal-icon">' +
						'<i class="fa fa-question-circle"></i>' +
						'</div>' +
						'<div class="modal-text">' +
						'<h4>¿Deseas eliminar el elemento?</h4>' +
						'</div>' +
						'<div class="modal-text">' +
						'<label class="col-sm-12 control-label" style="color: red;" id="labelError"></label>' +
						'</div>' +
						'</div>');

					$('#div-modal-footer').html('<button class="btn btn-primary modal-confirm-enc">Confirmar</button>' +
						'<button class="btn btn-default modal-dismiss">Cancelar</button>');

					$('#ModalEncuesta').click();

					$('.modal-confirm-enc').unbind('click');
					$('.modal-confirm-enc').click(function(e) {

						$('#labelError').text('');

						$('.loader').css('display', 'block');

						$.ajax({
							url: 'eliminarrespuesta.php',
							type: 'POST',
							data: {
								id: data
							},
							dataType: 'json',
							error: function(err) {

								$('.loader').css('display', 'none');

								$('#labelError').text('Error en el servidor');

								console.log(err);
							},
							success: function(respuesta) {

								if (respuesta != false) {

									if (respuesta.code == 200) {

										$.magnificPopup.close();

										new PNotify({
											title: 'Success!!!',
											text: 'Se eliminó correctamente',
											type: 'success'
										});

										setTimeout(function() {
											reloadTable(respuesta.test);
										}, 2000);
									} else {

										$('#labelError').text('Revise los parámetros ingresados');

										$('.loader').css('display', 'none');
									}
								} else {

									$('#labelError').text('Error en los parámetros');

									$('.loader').css('display', 'none');
								}
							}
						});
					});
				} else {

					$('#title-modal-enc').html('Agregar Respuesta');

					if ($('#th-resp-' + data).attr('data-type') == 3) {

						$('#body-modal-enc').html('<form id="test-form" class="form-horizontal mb-lg">' +
							'<div class="form-group mt-lg">' +
							'<label class="col-sm-2 control-label">Respuesta</label>' +
							'<div class="col-sm-5">' +
							'<input type="text" name="response" id="responsedetails" class="form-control" placeholder="Respuesta..." required/>' +
							'</div>' +
							'<label class="col-sm-2 control-label">Valor</label>' +
							'<div class="col-sm-3">' +
							'<input type="text" name="valorreponse" id="valorreponse" class="form-control" placeholder="Valor..." required/>' +
							'</div>' +
							'</div>' +
							'<div class="form-group mt-lg">' +
							'<label class="col-sm-12 control-label" style="color: red;" id="labelError"></label>' +
							'</div>' +
							'</form>');
					} else {

						$('#body-modal-enc').html('<form id="test-form" class="form-horizontal mb-lg">' +
							'<div class="form-group mt-lg">' +
							'<label class="col-sm-3 control-label">Respuesta</label>' +
							'<div class="col-sm-10">' +
							'<input type="text" name="response" id="responsedetails" class="form-control" placeholder="Respuesta..." required/>' +
							'</div>' +
							'</div>' +
							'<div class="form-group mt-lg">' +
							'<label class="col-sm-12 control-label" style="color: red;" id="labelError"></label>' +
							'</div>' +
							'</form>');
					}

					$('#div-modal-footer').html('<button class="btn btn-primary modal-confirm-enc">Confirmar</button>' +
						'<button class="btn btn-default modal-dismiss">Cancelar</button>');

					$('#ModalEncuesta').click();

					$('.modal-confirm-enc').unbind('click');
					$('.modal-confirm-enc').click(function(e) {

						if (($('#th-resp-' + data).attr('data-type') == 3 && ($.trim($('#responsedetails').val()) != '' && $.trim($('#valorreponse').val()) != '')) || ($('#th-resp-' + data).attr('data-type') != 3 && ($.trim($('#responsedetails').val()) != ''))) {

							$('#labelError').text('');

							$('.loader').css('display', 'block');

							const params = (($('#th-resp-' + data).attr('data-type') == 3) ? {
								response: $('#responsedetails').val(),
								type: $('#th-resp-' + data).attr('data-type'),
								valor: $('#valorreponse').val(),
								id: data
							} : {
								response: $('#responsedetails').val(),
								type: $('#th-resp-' + data).attr('data-type'),
								id: data
							});

							$.ajax({
								url: 'agregarrespuesta.php',
								type: 'POST',
								data: params,
								dataType: 'json',
								error: function(err) {

									$('.loader').css('display', 'none');

									$('#labelError').text('Error en el servidor');

									console.log(err);
								},
								success: function(respuesta) {

									if (respuesta != false) {

										if (respuesta.code == 200) {

											$.magnificPopup.close();

											new PNotify({
												title: 'Success!!!',
												text: 'Se modifico correctamente',
												type: 'success'
											});

											setTimeout(function() {
												reloadTable(respuesta.test);
											}, 2000);
										} else {

											$('#labelError').text('Revise los parámetros ingresados');

											$('.loader').css('display', 'none');
										}
									} else {

										$('#labelError').text('Error en los parámetros');

										$('.loader').css('display', 'none');
									}
								}
							});
						} else {

							$('#labelError').text('Ingrese el nombre de la respuesta o el valor');
						}
					});
				}
			}
		}

		function reloadTable(dataID) {

			$('#div-table-preguntas').html('<table class="table table-striped mb-none" id="table-preguntas">' +
				'<thead>' +
				'<tr>' +
				'<th>Pregunta</th>' +
				'<th>Tipo</th>' +
				'<th>Forma</th>' +
				'<th> <button type="button" class="mb-xs mt-xs mr-xs btn btn-success" onclick="agregarPregunta(' + dataID + ');"><i class="fa fa-plus"></i>Agregar</button> </th>' +
				'</tr>' +
				'</thead>' +
				'<tbody id="tbody-preguntas">' +
				'</tbody>' +
				'</table>');

			if (dataID != 0) {

				$.ajax({
					url: 'getpreguntas.php',
					type: 'POST',
					data: {
						test: dataID
					},
					dataType: 'json',
					error: function(err) {

						$('.loader').css('display', 'none');

						new PNotify({
							title: 'Error',
							text: 'Error en el servidor',
							type: 'error'
						});

						console.log(err);
					},
					success: function(respuesta) {

						$('.loader').css('display', 'none');

						if (respuesta != false) {

							if (respuesta != 400) {

								let objResponses = [];

								respuesta.forEach(element => {

									$('#tbody-preguntas').append('<tr id="tr-preg-' + element.H_CVE_PREG + '" data-id="' + element.H_CVE_PREG + '">' +
										'<td>' + element.NOMBRE + '</td>' +
										'<td>' + element.TIPO + '</td>' +
										'<td>' + element.FORMA + '</td>' +
										'<td> <i class="fa fa-trash-o" style="color: red;" onclick="operationQuesResp(1, 2, ' + element.H_CVE_PREG + ');"></i> <i class="fa fa-edit" style="color: orange;" onclick="operationQuesResp(1, 1, ' + element.H_CVE_PREG + ');"></i> ' + ((element.TIPO != 'ABIERTA') ? '<i class="fa fa-bar-chart-o" style="color: blue;" onclick="operationQuesResp(1, 3, ' + element.H_CVE_PREG + ');"></i>' : '') + ' </td>' +
										'</tr>');

									objResponses.push({
										id: element.H_CVE_PREG,
										responses: element.RESPONSES,
										tipo: element.TIPO
									});
								});

								var $table = $('#table-preguntas');

								// format function for row details
								var fnFormatDetails = function(datatable, tr, tipquestion, objResponses) {
									var data = datatable.fnGetData(tr);

									let dataResp = objResponses.find(idres => idres.id == tipquestion);

									let detailsData = '';

									if (dataResp.responses) {

										if (dataResp.responses.length > 0) {

											dataResp.responses.forEach(element2 => {

												detailsData = detailsData + '<tr id="tr-resp-' + element2.H_D_PREG + '" data-type="' + ((dataResp.tipo == 'OPCION MULTIPLE') ? 1 : 3) + '">' +
													'<td>' + element2.RESP + '</td>' +
													'<td>' + element2.VALOR + '</td>' +
													'<td> <i class="fa fa-trash-o" style="color: red;" onclick="operationQuesResp(2, 2, ' + element2.H_D_PREG + ');"></i> <i class="fa fa-edit" style="color: orange;" onclick="operationQuesResp(2, 1, ' + element2.H_D_PREG + ');"></i> </td>' +
													'</tr>';
											});
										}
									}

									return ['<table class="table mb-none">',
										'<thead>',
										'<tr id="th-resp-' + tipquestion + '" data-type="' + ((dataResp.tipo == 'OPCION MULTIPLE') ? 1 : 3) + '">',
										'<th>Respuestas</th>',
										'<th>Valor</th>',
										((dataResp.tipo == 'ABIERTA') ? '<th> </th>' : '<th> <i class="fa fa-plus-square-o" style="color: green;" onclick="operationQuesResp(2, 3, ' + tipquestion + ');"></i> </th>'),
										'</tr>',
										'</thead>',
										'<tbody id="tbody-respuestas">',
										detailsData,
										'</tbody>',
										'</table>'
									].join('');
								};

								// insert the expand/collapse column
								var th = document.createElement('th');
								var td = document.createElement('td');
								td.innerHTML = '<i data-toggle class="fa fa-plus-square-o text-primary h5 m-none" style="cursor: pointer;"></i>';
								td.className = "text-center";

								$table
									.find('thead tr').each(function() {
										this.insertBefore(th, this.childNodes[0]);
									});

								$table
									.find('tbody tr').each(function() {
										this.insertBefore(td.cloneNode(true), this.childNodes[0]);
									});

								var datatable = $table.dataTable({
									aoColumnDefs: [{
										bSortable: false,
										aTargets: [0, -1]
									}],
									aaSorting: [
										[1, 'asc']
									]
								});

								// add a listener
								$table.on('click', 'i[data-toggle]', function() {
									var $this = $(this),
										tr = $(this).closest('tr').get(0);

									let dataid = $(this).closest('tr').attr('data-id');

									if (datatable.fnIsOpen(tr)) {

										$this.removeClass('fa-minus-square-o').addClass('fa-plus-square-o');
										datatable.fnClose(tr);
									} else {

										$this.removeClass('fa-plus-square-o').addClass('fa-minus-square-o');
										datatable.fnOpen(tr, fnFormatDetails(datatable, tr, dataid, objResponses), 'details');
									}
								});
							} else {

								new PNotify({
									title: 'Advertencia',
									text: 'Revise los datos',
									type: 'warning'
								});
							}
						} else {

							new PNotify({
								title: 'Advertencia',
								text: 'Esta encuesta no cuenta con preguntas',
								type: 'warning'
							});
						}
					}
				});
			} else {

				$('.loader').css('display', 'none');
			}
		}

		function reloadEncuesta() {

			$.ajax({
				url: 'getencuestas.php',
				type: 'GET',
				dataType: 'json',
				error: function(err2) {

					$('.loader').css('display', 'none');

					new PNotify({
						title: 'Error',
						text: 'Error en el servidor',
						type: 'error'
					});

					console.log(err2);
				},
				success: function(respuesta2) {

					$('#tipencuestas').html('<option value="0">Seleccione la Encuesta...</option>');

					respuesta2.forEach(element => {

						$('#tipencuestas').append('<option value="' + element.H_CVE_ENC + '">' + element.NOMBRE + '</option>');
					});

					$('#tipencuestas').val(0);
					$('.select2-chosen').text($('#tipencuestas option:selected').text());

					$('#panel-encuestas').html('');

					$('.loader').css('display', 'none');
				}
			});
		}

		/*download_canvas = function(el) {
			var canvas = $('.flot-base');
			var image = canvas[0].toDataURL('image/jpg');
			el.href = image;
		};*/
	</script>

</body>

</html>