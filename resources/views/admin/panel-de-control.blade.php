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

    <title>Panel de control | CONOCER</title>

    <link
        rel="shortcut icon"
        href="https://framework-gb.cdn.gob.mx/gm/v3/assets/images/favicon.ico"
    >

    <link
        rel="stylesheet"
        href="{{ asset('admin.css') }}"
    >
</head>

<body class="admin-page">

    <header class="admin-header">

        <div class="admin-container admin-header__inner">

            <a
                href="{{ route('admin.panel') }}"
                class="admin-brand"
            >
                <strong>CONOCER</strong>

                <span>
                    Panel de administración
                </span>
            </a>

            <div class="admin-user">

                <div class="admin-user__info">
                    <span>
                        Sesión iniciada como
                    </span>

                    <strong>
                        {{ auth()->user()->name }}
                    </strong>
                </div>

                <form
                    method="POST"
                    action="{{ route('admin.logout') }}"
                >
                    @csrf

                    <button
                        type="submit"
                        class="button button--outline-light"
                    >
                        Cerrar sesión
                    </button>
                </form>

            </div>

        </div>

    </header>

    <main class="admin-main">

        <div class="admin-container">

            <div class="admin-heading">

                <div>
                    <p class="admin-eyebrow">
                        Administración
                    </p>

                    <h1>
                        Panel de control
                    </h1>

                    <p>
                        Administra los registros del
                        Registro Nacional de Personas con
                        Competencias Certificadas.
                    </p>
                </div>

                <a
                    href="{{ route('admin.panel', ['create' => 1]) }}"
                    class="button button--primary"
                >
                    + Crear registro
                </a>

            </div>

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
                    <strong>
                        Revisa la información:
                    </strong>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($creating || $editingCertification)

                <section class="admin-card admin-form-card">

                    <div class="admin-card__header">

                        <div>
                            <h2>
                                @if ($editingCertification)
                                    Editar registro
                                @else
                                    Crear nuevo registro
                                @endif
                            </h2>

                            <p>
                                Los campos marcados con * son obligatorios.
                            </p>
                        </div>

                        <a
                            href="{{ route('admin.panel') }}"
                            class="button button--secondary"
                        >
                            Cancelar
                        </a>

                    </div>

                    <form
                        method="POST"
                        action="{{
                            $editingCertification
                                ? route(
                                    'admin.certifications.update',
                                    $editingCertification
                                )
                                : route(
                                    'admin.certifications.store'
                                )
                        }}"
                        class="admin-record-form"
                    >
                        @csrf

                        @if ($editingCertification)
                            @method('PUT')
                        @endif

                        <div class="admin-form-grid">

                            <div class="form-group">
                                <label for="curp">
                                    CURP
                                </label>

                                <input
                                    type="text"
                                    id="curp"
                                    name="curp"
                                    maxlength="18"
                                    value="{{
                                        old(
                                            'curp',
                                            $editingCertification?->curp
                                        )
                                    }}"
                                    autocomplete="off"
                                    data-uppercase
                                >

                                <small>
                                    Se utiliza para la búsqueda pública
                                    y no aparece en la tabla de resultados.
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="folio">
                                    Folio *
                                </label>

                                <input
                                    type="text"
                                    id="folio"
                                    name="folio"
                                    maxlength="50"
                                    value="{{
                                        old(
                                            'folio',
                                            $editingCertification?->folio
                                        )
                                    }}"
                                    required
                                    autocomplete="off"
                                    data-uppercase
                                >
                            </div>

                            <div class="form-group">
                                <label for="tipo">
                                    Tipo *
                                </label>

                                <input
                                    type="text"
                                    id="tipo"
                                    name="tipo"
                                    maxlength="30"
                                    value="{{
                                        old(
                                            'tipo',
                                            $editingCertification?->tipo
                                        )
                                    }}"
                                    required
                                    data-uppercase
                                >
                            </div>

                            <div class="form-group">
                                <label for="codigo">
                                    Código *
                                </label>

                                <input
                                    type="text"
                                    id="codigo"
                                    name="codigo"
                                    maxlength="80"
                                    value="{{
                                        old(
                                            'codigo',
                                            $editingCertification?->codigo
                                        )
                                    }}"
                                    required
                                    data-uppercase
                                >
                            </div>

                            <div class="form-group admin-form-grid__full">
                                <label for="titulo">
                                    Título *
                                </label>

                                <input
                                    type="text"
                                    id="titulo"
                                    name="titulo"
                                    maxlength="255"
                                    value="{{
                                        old(
                                            'titulo',
                                            $editingCertification?->titulo
                                        )
                                    }}"
                                    required
                                >
                            </div>

                            <div class="form-group admin-form-grid__full">
                                <label for="entidad">
                                    Entidad de certificación y evaluación *
                                </label>

                                <textarea
                                    id="entidad"
                                    name="entidad"
                                    maxlength="500"
                                    rows="3"
                                    required
                                >{{ old(
                                    'entidad',
                                    $editingCertification?->entidad
                                ) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="siglas">
                                    Siglas
                                </label>

                                <input
                                    type="text"
                                    id="siglas"
                                    name="siglas"
                                    maxlength="80"
                                    value="{{
                                        old(
                                            'siglas',
                                            $editingCertification?->siglas
                                        )
                                    }}"
                                    data-uppercase
                                >
                            </div>

                            <div class="form-group">
                                <label for="evaluador">
                                    Evaluador / Centro de evaluación
                                </label>

                                <textarea
                                    id="evaluador"
                                    name="evaluador"
                                    maxlength="500"
                                    rows="3"
                                >{{ old(
                                    'evaluador',
                                    $editingCertification?->evaluador
                                ) }}</textarea>
                            </div>

                        </div>

                        <div class="admin-form-actions">

                            <a
                                href="{{ route('admin.panel') }}"
                                class="button button--secondary"
                            >
                                Cancelar
                            </a>

                            <button
                                type="submit"
                                class="button button--primary"
                            >
                                @if ($editingCertification)
                                    Guardar cambios
                                @else
                                    Crear registro
                                @endif
                            </button>

                        </div>

                    </form>

                </section>

            @endif

            <section class="admin-card">

                <div class="admin-card__header">

                    <div>
                        <h2>
                            Registros
                        </h2>

                        <p>
                            Busca por UUID, CURP, folio, código,
                            título, entidad, siglas o evaluador.
                        </p>
                    </div>

                </div>

                <form
                    method="GET"
                    action="{{ route('admin.panel') }}"
                    class="admin-search"
                >
                    <div class="admin-search__field">

                        <svg
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <circle
                                cx="11"
                                cy="11"
                                r="7"
                            ></circle>

                            <path
                                d="m20 20-4-4"
                            ></path>
                        </svg>

                        <input
                            type="search"
                            name="q"
                            value="{{ $search }}"
                            placeholder="Buscar registros..."
                            maxlength="255"
                            autocomplete="off"
                            aria-label="Buscar registros"
                        >

                    </div>

                    <button
                        type="submit"
                        class="button button--primary"
                    >
                        Buscar
                    </button>

                    @if ($search !== '')
                        <a
                            href="{{ route('admin.panel') }}"
                            class="button button--secondary"
                        >
                            Limpiar
                        </a>
                    @endif

                </form>

                <div class="admin-table-wrapper">

                    <table class="admin-table">

                        <thead>
                            <tr>
                                <th>UUID</th>
                                <th>Folio</th>
                                <th>Tipo</th>
                                <th>Código</th>
                                <th>Título</th>
                                <th>Entidad</th>
                                <th>Siglas</th>
                                <th>Evaluador</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($certifications as $certification)

                                <tr>
                                    <td class="admin-table__uuid">
                                        {{ $certification->uuid }}
                                    </td>

                                    <td>
                                        {{ $certification->folio }}
                                    </td>

                                    <td>
                                        {{ $certification->tipo }}
                                    </td>

                                    <td>
                                        {{ $certification->codigo }}
                                    </td>

                                    <td>
                                        {{ $certification->titulo }}
                                    </td>

                                    <td>
                                        {{ $certification->entidad }}
                                    </td>

                                    <td>
                                        {{ $certification->siglas }}
                                    </td>

                                    <td>
                                        {{ $certification->evaluador }}
                                    </td>

                                    <td>
                                        <div class="admin-actions">

                                            <a
                                                href="{{
                                                    route(
                                                        'admin.panel',
                                                        [
                                                            'edit' => $certification->uuid,
                                                        ]
                                                    )
                                                }}"
                                                class="button button--small button--edit"
                                            >
                                                Editar
                                            </a>

                                            <form
                                                method="POST"
                                                action="{{
                                                    route(
                                                        'admin.certifications.destroy',
                                                        $certification
                                                    )
                                                }}"
                                                data-confirm-delete
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="button button--small button--danger"
                                                >
                                                    Eliminar
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td
                                        colspan="9"
                                        class="admin-table__empty"
                                    >
                                        No se encontraron registros.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="admin-pagination">

                    <span>
                        Página
                        {{ $certifications->currentPage() }}
                        de
                        {{ $certifications->lastPage() }}
                    </span>

                    <span>
                        {{ $certifications->total() }}
                        registro(s)
                    </span>

                    <div class="admin-pagination__buttons">

                        @if ($certifications->onFirstPage())
                            <span class="pagination-button is-disabled">
                                Anterior
                            </span>
                        @else
                            <a
                                href="{{ $certifications->previousPageUrl() }}"
                                class="pagination-button"
                            >
                                Anterior
                            </a>
                        @endif

                        @if ($certifications->hasMorePages())
                            <a
                                href="{{ $certifications->nextPageUrl() }}"
                                class="pagination-button"
                            >
                                Siguiente
                            </a>
                        @else
                            <span class="pagination-button is-disabled">
                                Siguiente
                            </span>
                        @endif

                    </div>

                </div>

            </section>

        </div>

    </main>

    <script
        src="{{ asset('admin.js') }}"
        defer
    ></script>

</body>
</html>