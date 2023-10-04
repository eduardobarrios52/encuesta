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
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
	<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

	<!-- Specific Page Vendor CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />

	<!-- Theme CSS -->
	<link rel="stylesheet" href="assets/stylesheets/theme.css" />

	<!-- Skin CSS -->
	<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

	<!-- Theme Custom CSS -->
	<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

	<!-- Head Libs -->
	<script src="assets/vendor/modernizr/modernizr.js"></script>

</head>

<body>
	<section class="body">

		<!-- start: header -->
		<header class="header">
			<div class="logo-container">
				<a href="../" class="logo">
					<img src="assets/images/logo.png" height="35" alt="Porto Admin" />
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
							<img src="assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
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
					<h2>Líneas Telefónicas</h2>


				</header>

				<!-- start: page -->
				<div class="row">
					<div class="col-lg-12">
						<section class="panel">
							<header class="panel-heading">
								<div class="panel-actions">
									<a href="#" class="fa fa-caret-down"></a>
									<a href="#" class="fa fa-times"></a>
								</div>

								<h2 class="panel-title">Gestión de Líneas Telefónicas</h2>
							</header>
							<div class="panel-body">

								<button id="btnAdd" class="btn btn-success">Añadir</button>
								<table id="tableLineas" class="table table-striped table-bordered">
									<!-- The table structure will be managed by DataTables -->
								</table>



							</div>
						</section>






					</div>
				</div>






				<!-- end: page -->
			</section>
		</div>

		<div class="modal fade" id="lineaModal" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title" id="lineaModalTitle"></h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">

						<form id="lineaForm">
							<input type="hidden" name="ID_Linea" id="ID_Linea">
							<div class="form-group">
								<label for="Numero_Telefonico">Número Telefónico:</label>
								<input type="text" class="form-control" id="Numero_Telefonico" name="Numero_Telefonico" required>
							</div>
							<div class="form-group">
								<label for="Tipo_Linea">Tipo de Línea:</label>
								<input type="text" class="form-control" id="Tipo_Linea" name="Tipo_Linea" required>
							</div>
							<div class="form-group">
								<label for="Fecha_Activacion">Fecha de Activación:</label>
								<input type="date" class="form-control" id="Fecha_Activacion" name="Fecha_Activacion" readonly>
							</div>
							<div class="form-group">
								<label for="Fecha_Desactivacion">Fecha de Desactivación:</label>
								<input type="date" class="form-control" id="Fecha_Desactivacion" name="Fecha_Desactivacion" readonly>
							</div>
							<div class="form-group">
								<label for="ID_Usuario">ID de Usuario:</label>
								<input type="number" class="form-control" id="ID_Usuario" name="ID_Usuario" required>
							</div>
							<div class="form-group">
								<label for="Operador">Operador:</label>
								<input type="text" class="form-control" id="Operador" name="Operador" required>
							</div>
							<div class="form-group">
								<label for="Plan_Contratado">Plan Contratado:</label>
								<input type="text" class="form-control" id="Plan_Contratado" name="Plan_Contratado">
							</div>
							<div class="form-group">
								<label for="Estado_Linea">Estado de Línea:</label>
								<input type="text" class="form-control" id="Estado_Linea" name="Estado_Linea" readonly required>
							</div>
							<div class="form-group">
								<label for="Comentarios">Comentarios:</label>
								<textarea class="form-control" id="Comentarios" name="Comentarios"></textarea>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="btnSave">Guardar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					</div>
				</div>
			</div>
		</div>
		<!-- FIN MODAL -->


	</section>

	<!-- Vendor -->
	<script src="assets/vendor/jquery/jquery.js"></script>
	<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
	<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
	<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
	<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

	<!-- Specific Page Vendor -->
	<script src="assets/vendor/jquery-autosize/jquery.autosize.js"></script>
	<script src="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>

	<!-- Theme Base, Components and Settings -->
	<script src="assets/javascripts/theme.js"></script>

	<!-- Theme Custom -->
	<script src="assets/javascripts/theme.custom.js"></script>

	<!-- Theme Initialization Files -->
	<script src="assets/javascripts/theme.init.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>

	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

	<script>
		$(document).ready(function() {

			// Abrir el modal para añadir
			$('#btnAdd').click(function() {
				$('#lineaForm')[0].reset(); // Resetea el formulario
				$('#lineaModalTitle').text("Añadir nueva línea");
				$('#lineaModal').modal('show');
				$('#ID_Linea').val('');
				$('#Estado_Linea').val('Activo');
				var now = new Date();
				var day = ("0" + now.getDate()).slice(-2);
				var month = ("0" + (now.getMonth() + 1)).slice(-2);
				var today = now.getFullYear() + "-" + (month) + "-" + (day);

				$('#Fecha_Activacion').val(today);

			});
			////editar
			// Abrir el modal para editar
			$(document).on('click', '.btnEdit', function() {
				var data = table.row($(this).parents('tr')).data();
				// Rellenamos el formulario con los datos de la fila seleccionada
				for (var key in data) {
					$('#lineaForm').find('input[name="' + key + '"], textarea[name="' + key + '"]').val(data[key]);
				}
				$('#lineaModalTitle').text("Editar línea");
				$('#lineaModal').modal('show');
			});


			// Guardar (añadir/editar) registro
			$('#btnSave').click(function() {
				$.ajax({
					url: "savelineas.php",
					type: "POST",
					data: $('#lineaForm').serialize(), // Enviamos todos los datos del formulario
					success: function(response) {
						alert(response);
						$('#lineaModal').modal('hide');
						table.ajax.reload(); // Refresca la tabla
					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert("Error al guardar.");
					}
				});
			});


			//eliminar
			$(document).on('click', '.btnDelete', function() {
				var data = table.row($(this).parents('tr')).data();
				if (confirm("¿Estás seguro de que quieres eliminar esta línea?")) {
					$.ajax({
						url: "deletelineas.php",
						type: "POST",
						data: {
							ID_Linea: data.ID_Linea
						},
						success: function(response) {
							alert(response);
							table.ajax.reload(); // Refresca la tabla
						},
						error: function(jqXHR, textStatus, errorThrown) {
							alert("Error al eliminar.");
						}
					});
				}
			});

			var table = $('#tableLineas').DataTable({
				ajax: {
					url: 'getlineas.php',
					dataSrc: 'data'
				},
				columns: [{
						title: "ID_Linea",
						data: "ID_Linea"
					},
					{
						title: "Número Telefónico",
						data: "Numero_Telefonico"
					},
					{
						title: "Tipo de Línea",
						data: "Tipo_Linea"
					},
					{
						title: "Fecha de Activación",
						data: "Fecha_Activacion"
					},
					{
						title: "Fecha de Desactivación",
						data: "Fecha_Desactivacion"
					},
					{
						title: "ID Usuario",
						data: "ID_Usuario"
					},
					{
						title: "Operador",
						data: "Operador"
					},
					{
						title: "Plan Contratado",
						data: "Plan_Contratado"
					},
					{
						title: "Estado de Línea",
						data: "Estado_Linea"
					},
					{
						title: "Comentarios",
						data: "Comentarios"
					},
					{
						title: "Acciones",
						render: function(data, type, row) {
							return '<button class="btnEdit btn btn-warning">Editar</button><button class="btnDelete btn btn-danger">Eliminar</button>';
						}
					}
				]
			});

			// El resto del código para añadir, editar, eliminar...
		});
	</script>

</body>

</html>