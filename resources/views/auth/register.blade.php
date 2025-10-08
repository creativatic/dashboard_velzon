<!doctype html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <title>Registrarse | Sistema Registro Seven Hierro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Registro de usuarios - Sistema Seven Hierro" name="description" />
    <meta content="BHC Proyectos y Mantenimientos" name="author" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

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
</head>

<body>
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-overlay"></div>

        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row g-0">

                                <!-- Imagen / texto lateral -->
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4 auth-one-bg h-100">
                                        <div class="bg-overlay"></div>
                                        <div class="position-relative h-100 d-flex flex-column">
                                            <div class="mb-4">
                                                <a href="{{ url('/') }}" class="d-block">
                                                    <img src="{{ asset('assets/images/logo-light.png') }}" alt="Logo" height="18">
                                                </a>
                                            </div>
                                            <div class="mt-auto">
                                                <div class="mb-3">
                                                    <i class="ri-double-quotes-l display-4 text-success"></i>
                                                </div>
                                                <div class="text-white-50 fst-italic">
                                                    <p class="fs-15">“Un sistema más ágil, seguro y adaptado a nuestras operaciones.”</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Formulario de registro -->
                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <div>
                                            <h5 class="text-primary">Sistema Registro Seven Hierro</h5>
                                            <p class="text-muted">Crea tu cuenta para continuar</p>
                                        </div>

                                        <div class="mt-4">
                                            <form method="POST" action="{{ route('register') }}" novalidate>
                                                @csrf

                                                {{-- Nombre --}}
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nombre completo</label>
                                                    <input type="text" name="name" id="name"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        placeholder="Ingresa tu nombre completo"
                                                        value="{{ old('name') }}" required autofocus>
                                                    @error('name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                {{-- Correo --}}
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Correo electrónico</label>
                                                    <input type="email" name="email" id="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        placeholder="Ingresa tu correo" value="{{ old('email') }}" required>
                                                    @error('email')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                {{-- Contraseña --}}
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Contraseña</label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" name="password" id="password"
                                                            class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                                                            placeholder="Ingresa tu contraseña" required autocomplete="new-password">
                                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                            type="button" id="password-addon">
                                                            <i class="ri-eye-fill align-middle"></i>
                                                        </button>
                                                        @error('password')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                {{-- Confirmar Contraseña --}}
                                                <div class="mb-3">
                                                    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                                        class="form-control" placeholder="Repite tu contraseña" required>
                                                </div>

                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit">Registrarme</button>
                                                </div>
                                            </form>

                                            <div class="mt-4 text-center">
                                                <p class="mb-0">
                                                    ¿Ya tienes una cuenta?
                                                    <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-underline">Inicia sesión</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center text-white-50">
                            <p class="mb-0">
                                &copy; <script>document.write(new Date().getFullYear())</script>
                                Seven Hierro - Sistema desarrollado por <span class="text-success fw-semibold">BHC</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- JS -->
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/pages/password-addon.init.js') }}"></script>
</body>
</html>