<?php
error_reporting(0);
session_start();

// Verifica si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si los datos de inicio de sesión son correctos
    $correo_correcto = "usuario@example.com"; // Correo correcto
    $contrasena_correcta = "contraseña123"; // Contraseña correcta

    if ($_POST["correo"] == $correo_correcto && $_POST["contrasena"] == $contrasena_correcta) {
        // Inicio de sesión exitoso, establece la variable de sesión y redirige a la página deseada
        $_SESSION['Correo'] = $correo_correcto;
        header("Location: index.php"); // Redirige al panel de administrador
        exit();
    } else {
        // Datos de inicio de sesión incorrectos
        $mensaje_error = 'Acceso denegado';
    }
}

// Verificar si la sesión está establecida
if (isset($_SESSION['Correo'])) {
    // Obtener el correo electrónico de la sesión
    $actualsesion = $_SESSION['Correo'];
} else {
    
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="initial-scale=1.0">
    <title>VisionTech</title>
    <link rel="icon" href="../../img/Logo Negativo1.png" type="image/png">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link rel="stylesheet" href="../../css/styles.css">
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>

    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="nav-left navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="bak-nav sidebar-brand d-flex align-items-center justify-content-center" href="index2.php">
                <div class="sidebar-brand-icon rotate-n-15">
                </div>
                <div class="logo-nav  sidebar-brand-text mx-3"><img src="../../img/logo-nav.png" alt=""></div>
            </a>

            <hr class="sidebar-divider my-0">

            <!-- <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="material-icons-outlined"></i>
                    <span>Dashboard</span></a>
            </li> -->

            <hr class="sidebar-divider">

            <div class="sidebar-heading">
                EMPLEADOS
            </div>

            <li class="nav-item">
                <a class="nav-link collapsed" href="producto_registrar2.php">
                    <span class="material-icons">pattern</span>
                    <span class="nav-tex" >Productos</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="cliente_registrar2.php">
                    <span class="material-icons">pattern</span>
                    <span>Clientes</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="venta_registrar2.php">
                    <span class="material-icons">pattern</span>
                    <span>Ventas</span>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="compras_registrar.php">
                    <span class="material-icons">pattern</span>
                    <span>Compras</span>
                </a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="historias_registrar2.php">
                    <span class="material-icons">pattern</span>
                    <span>Historia Clinica</span>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="categorias_registrar.php">
                    <span class="material-icons">pattern</span>
                    <span>Categorias</span>
                </a>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="marcas_registrar.php">
                    <span class="material-icons">pattern</span>
                    <span>Marcas</span>
                </a>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="materiales_registrar.php">
                    <span class="material-icons">pattern</span>
                    <span>Materiales</span>
                </a>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="empleado_registrar.php">
                    <span class="material-icons">pattern</span>
                    <span>Empleados</span>
                </a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="generar_informes2.php">
                    <span class="material-icons">pattern</span>
                    <span>Informes</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                PERFIL
            </div>
            <li class="nav-item">
                <a class="nav-link collapsed" href="usuariosindex2.php">
                    <span class="material-icons">people</span>
                    <span>Información del Perfil</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../../includes/_sesion/cerrarSesion.php">
                    <span class="material-icons">logout</span>
                    <span>Salir</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0"></button>
            </div>
        </ul>
        <!-- EMPIEZA EL NAVBAR -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="bak-nav navbar navbar-expand navbar-dark  topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <span class="material-icons">search</span>
                                </button>
                            </div>
                        </div>
                    </form> -->
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            </a>
                            <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $actualsesion ?> </span>
                                <span class="material-icons">account_circle</span>
                            </a>
                        </li>
                    </ul>
                </nav>