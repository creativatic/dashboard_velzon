<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>

    <meta charset="utf-8" />
    <title>Sign In | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="{{ asset('js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom Css-->
    <link href="{{ asset('css/custom.min.css') }}" rel="stylesheet" type="text/css" />

    {{-- ✅ MODIFICACIÓN CLAVE: Definimos la clase para usar tu nueva imagen --}}
    <style>
        /* Definimos un estilo para la clase que maneja el fondo lateral */
        .auth-one-bg {
            /* Apunta a tu nueva imagen dentro del directorio public */
            background-image: url("{{ asset('images/bhc-one-bg.jpg') }}"); 
            background-size: cover;
            background-position: center;
            /* Si deseas el fondo negro, asegúrate de añadir o mantener: */
            background-color: #000000 !important; 
        }

        /* Si quieres asegurar que el texto sea blanco sobre el fondo oscuro */
        .p-lg-5.p-4.auth-one-bg.h-100 {
            color: #ffffff !important; 
        }
        .carousel-inner .carousel-item p, .ri-double-quotes-l {
             color: #ffffff !important; 
        }
    </style>

    <style>
        /* Sobrescribe la clase auth-one-bg que se usa en el panel lateral del login */
        .auth-one-bg {
            /* Ruta a la imagen: C:\laragon\www\ventas_seven\public\images\bhc-one-bg.jpg */
            background-image: url("{{ asset('images/bhc-one-bg.jpg') }}") !important; 
            background-size: cover !important;
            background-position: center !important;
            
            /* Opcional: Si quieres un color de fondo plano detrás de la imagen (o si la imagen falla) */
            background-color: #000000 !important; 
        }
    </style>

    <style>
    /* Fondo general del login */
    .auth-page-wrapper.auth-bg-cover {
        background: #b80000 !important; /* rojo fuerte */
    }

    /* Si existe una imagen o capa superpuesta, eliminala o hazla transparente */
    .auth-page-wrapper .bg-overlay {
        background-color: rgba(0, 0, 0, 0) !important;
    }
    </style>


</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    {{-- ✅ Este DIV ahora usará el background-image definido arriba --}}
                                    <div class="p-lg-5 p-4 auth-one-bg h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <a href="index.html" class="d-block">
                                                    <img src="assets/images/logo-light.png" alt="" height="18">
                                                </a>
                                            </div>
                                            <div class="mt-auto">

                                                <div id="qoutescarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-indicators">
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                        <button type="button" data-bs-target="#qoutescarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                    </div>
                                                    <div class="carousel-inner text-center text-white-50 pb-5">
                                                        <div class="carousel-item active">
                                                            <p class="fs-15 fst-italic">“  Garantizamos la operatividad de los sistemas informáticos y de comunicación en entornos mineros de alta exigencia.  ”</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">“  A través de un soporte TI eficiente, fortalecemos la trazabilidad, monitoreo y control de las operaciones mineras de hierro.  ”</p>
                                                        </div>
                                                        <div class="carousel-item">
                                                            <p class="fs-15 fst-italic">“  La innovación tecnológica es un pilar fundamental para asegurar operaciones sostenibles en la extracción y procesamiento del hierro.  ”</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end carousel -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <div>
                                            <h5 class="text-primary">Sistema Registro Seven Hierro</h5>
                                        </div>

                                        <div class="mt-4">
                                            <form action="{{ route('login.store') }}" method="POST">
                                                @csrf

                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Correo</label>
                                                    <input type="text" name="email" class="form-control" id="email" placeholder="Ingresa tu correo" required autofocus>
                                                </div>

                                                <div class="mb-3">
                                                    <div class="float-end">
                                                        <a href="{{ route('password.request') }}" class="text-muted">¿Olvidó su contraseña?</a>
                                                    </div>
                                                    <label class="form-label" for="password-input">Contraseña</label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" name="password" class="form-control pe-5" placeholder="Ingresa tu contraseña" id="password-input" required>
                                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon">
                                                            <i class="ri-eye-fill align-middle"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="auth-remember-check">
                                                    <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                                </div>

                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit">Iniciar sesión</button>
                                                </div>
                                            </form>

                                             <!--
                                            <div class="mt-5 text-center">
                                                <p class="mb-0">
                                                    ¿No tienes una cuenta registrada?
                                                    <a href="{{ route('register') }}" class="fw-semibold text-primary text-decoration-underline">Signup</a>
                                                </p>
                                            </div>
                                            -->
                            
                                        </div>

                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0">&copy;
                                <script>document.write(new Date().getFullYear())</script> © Sistema desarrollado por el área de <strong>TI BHC</strong>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <!-- Bootstrap Bundle -->
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Simplebar -->
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <!-- Waves -->
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
    <!-- Feather Icons -->
    <script src="{{ asset('libs/feather-icons/feather.min.js') }}"></script>
    <!-- Lord Icon -->
    <script src="{{ asset('js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <!-- Plugins -->
    <script src="{{ asset('js/plugins.js') }}"></script>
    <!-- password-addon init -->
    <script src="assets/js/pages/password-addon.init.js"></script>
</body>

</html>