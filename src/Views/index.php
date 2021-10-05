<!DOCTYPE html>
<html lang="es">
<head>
	<title><?=$this->data['titulo'];?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS: -->

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="resource/libraries/bootstrap-4.6.0-dist/css/bootstrap.min.css">

    <!-- Fonts - Font Awesome core CSS -->
    <link rel="stylesheet" type="text/css" href="resource/fonts/fontawesome-free/all.css">

    <!-- Tipografia -->
    <link rel="stylesheet" type="text/css" href="resource/fonts/webfonts/loadfonts.css">

    <!-- DataTables core CSS -->
    <link rel="stylesheet" type="text/css" href="resource/libraries/DataTables/datatables.min.css">

    <!-- Estilos personalizados para las plantillas -->
	<link rel="stylesheet" type="text/css" href="resource/libraries/bootstrap-4.6.0-dist/custom-bootstrap.css">

    <!-- SCRIPTS: -->

    <!-- jQuery library -->
    <script type="text/javascript" src="resource/libraries/jquery-3.6.0/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="resource/libraries/popper-1.16.1/umd/popper.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="resource/libraries/bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>

    <!-- Chart core JavaScript -->
    <script type="text/javascript" src="resource/libraries/chart-3.5.1/dist/chart.min.js"></script>

    <!-- DataTables core JavaScript -->
    <script type="text/javascript" src="resource/libraries/DataTables/datatables.min.js"></script>

    <!-- Jquery-validate core JavaScript -->
    <script type="text/javascript" src="resource/libraries/jquery-validation-1.19.3/dist/jquery.validate.min.js"></script>
    <script type="text/javascript" src="resource/libraries/jquery-validation-1.19.3/dist/additional-methods.min.js"></script>
</head>
<body>
    <!-- ENCABEZADO: -->
    <header>
        <!-- SPINNER DE CARGA DE PÁGINA. -->
        <div id="spinner">
            <div class="spinner-grow text-muted"></div>
            <div class="spinner-grow text-primary"></div>
            <div class="spinner-grow text-success"></div>
            <div class="spinner-grow text-info"></div>
            <div class="spinner-grow text-warning"></div>
            <div class="spinner-grow text-danger"></div>
            <div class="spinner-grow text-secondary"></div>
            <div class="spinner-grow text-dark"></div>
            <div class="spinner-grow text-light"></div>
        </div>

        <div class="container">
            <h1 class="text-primary text-center"> <?=$this->data['titulo'];?> </h1>
            <hr class="bg-primary">
        </div>
    </header>

    <!-- CUERPO PRINCIPAL: -->
    <?=$main;?>

	<!-- PIE DE PÁGINA: -->
    <footer class="bg-primary">
        <div class="container">
            <p class="text-center">Copyright &copy; 2021 - Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>
