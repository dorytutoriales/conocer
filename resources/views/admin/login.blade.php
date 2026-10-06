<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="robots"
        content="noindex, nofollow"
    >

    <title>Administración | CONOCER</title>

    <link
        rel="shortcut icon"
        href="https://framework-gb.cdn.gob.mx/gm/v3/assets/images/favicon.ico"
    >

    <link
        rel="stylesheet"
        href="{{ asset('admin.css') }}"
    >
</head>

<body class="admin-login-page">

    <main class="login-wrapper">

        <section
            class="login-card"
            aria-labelledby="login-title"
        >

            <div class="login-brand">
                <div class="login-brand__mark">
                    CONOCER
                </div>

                <p>
                    Panel de administración
                </p>
            </div>

            <h1 id="login-title">
                Iniciar sesión
            </h1>

            <p class="login-description">
                Ingresa tus credenciales para acceder
                al panel de administración.
            </p>

            @if (session('success'))
                <div
                    class="alert alert--success"
                    role="status"
                >
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div
                    class="alert alert--error"
                    role="alert"
                >
                    {{ $errors->first() }}
                </div>
            @endif

            <form
                method="POST"
                action="{{ route('admin.login.store') }}"
                class="login-form"
            >
                @csrf

                <div class="form-group">
                    <label for="username">
                        Usuario
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="{{ old('username') }}"
                        maxlength="100"
                        autocomplete="username"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label for="password">
                        Contraseña
                    </label>

                    <div class="password-field">

                        <input
                            type="password"
                            id="password"
                            name="password"
                            maxlength="255"
                            autocomplete="current-password"
                            required
                        >

                        <button
                            type="button"
                            class="password-toggle"
                            data-password-toggle
                            aria-label="Mostrar contraseña"
                            aria-controls="password"
                        >

                            <svg
                                class="password-icon password-icon--show"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    d="M2 12s3.5-6 10-6 10 6 10 6-3.5 6-10 6S2 12 2 12Z"
                                ></path>

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="3"
                                ></circle>
                            </svg>

                            <svg
                                class="password-icon password-icon--hide"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                                hidden
                            >
                                <path
                                    d="m3 3 18 18"
                                ></path>

                                <path
                                    d="M10.7 5.1A10.6 10.6 0 0 1 12 5c6.5 0 10 7 10 7a18.6 18.6 0 0 1-3 3.8"
                                ></path>

                                <path
                                    d="M6.6 6.6C3.7 8.5 2 12 2 12s3.5 7 10 7a9.8 9.8 0 0 0 4.1-.9"
                                ></path>
                            </svg>

                        </button>

                    </div>
                </div>

                <button
                    type="submit"
                    class="button button--primary button--full"
                >
                    Iniciar sesión
                </button>

            </form>

            <a
                href="{{ route('home') }}"
                class="login-back"
            >
                ← Regresar al sitio
            </a>

        </section>

    </main>

    <script
        src="{{ asset('admin.js') }}"
        defer
    ></script>

</body>
</html>