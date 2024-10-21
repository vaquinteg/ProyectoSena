<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid bg-dark">
      <a href="home.php"> <img src="imagen/Logo.png" alt="logo" height="150" class="bg-dark"> </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">  
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Almacén</a>
            <ul class="dropdown-menu bg-body border-3" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="registrodemonturas.php">Registrar montura</a></li>
              
            </ul>
          </li>
          <li class="nav-item dropdown">  
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Ventas</a>
            <ul class="dropdown-menu bg-body border-3" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="Cotizacion.php">Cotización</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">  
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Información</a>
            <ul class="dropdown-menu bg-body border-3" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="crear_usuario.php">Nuevo usuario</a></li>
			 <!-- Se quitó nueva marca y se incluyó en proveedor -->
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="crear_paciente.php">Nuevo paciente</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="Nuevoproveedor.php">Nueva marca</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="subir_formula.php">Nueva fórmula</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="actualizar_estado_venta.php">Actualizar estado de venta de gafas</a></li>
            </ul>
          </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php" id="cerrar_sesion">Cerrar sesión</a>
            </li>
            
        </ul>
      </div>
    </div>
  </nav>