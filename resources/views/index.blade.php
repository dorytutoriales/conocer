<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">

  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0"
  >

  <title>CONOCER | RENAP</title>

  <link
    rel="shortcut icon"
    href="https://framework-gb.cdn.gob.mx/gm/v3/assets/images/favicon.ico"
  >

  <link
    rel="preconnect"
    href="https://fonts.googleapis.com"
  >

  <link
    rel="preconnect"
    href="https://fonts.gstatic.com"
    crossorigin
  >

  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap"
    rel="stylesheet"
  >

  <link
    rel="stylesheet"
    href="index.css"
  >
</head>


<body>

  <!-- =====================================================
       HEADER
  ====================================================== -->

  <header class="site-header">

    <nav
      class="gov-navbar"
      aria-label="Navegación Gobierno de México"
    >

      <div class="site-container gov-navbar__inner">

        <a
          class="gov-navbar__brand"
          href="https://www.gob.mx/"
          target="_blank"
          rel="noopener"
        >

          <img
            src="https://framework-gb.cdn.gob.mx/gobmx/img/logo_blanco.svg"
            alt="Gobierno de México"
          >

        </a>


        <button
          class="menu-toggle"
          type="button"
          data-toggle-target="gov-menu"
          aria-expanded="false"
          aria-controls="gov-menu"
        >

          <span class="sr-only">
            Abrir navegación
          </span>

          <span></span>
          <span></span>
          <span></span>

        </button>


        <div
          class="gov-navbar__menu"
          id="gov-menu"
        >

          <a href="https://www.gob.mx/tramites">
            Trámites
          </a>

          <a href="https://www.gob.mx/gobierno">
            Gobierno
          </a>

          <a
            class="search-link"
            href="https://www.gob.mx/busqueda"
            aria-label="Búsqueda"
          >

            <span
              class="search-icon"
              aria-hidden="true"
            ></span>

          </a>

        </div>

      </div>

    </nav>


    <nav
      class="sub-navbar"
      aria-label="Navegación CONOCER"
    >

      <div class="site-container sub-navbar__inner">

        <a
          class="sub-navbar__brand"
          href="https://conocer.gob.mx/"
        >
          CONOCER
        </a>


        <button
          class="menu-toggle menu-toggle--light"
          type="button"
          data-toggle-target="conocer-menu"
          aria-expanded="false"
          aria-controls="conocer-menu"
        >

          <span class="sr-only">
            Abrir navegación CONOCER
          </span>

          <span></span>
          <span></span>
          <span></span>

        </button>


        <div
          class="sub-navbar__menu"
          id="conocer-menu"
        >

          <a href="#renac">
            RENAC
          </a>

          <a href="#renec">
            RENEC
          </a>

        </div>

      </div>

    </nav>

  </header>


  <main class="page-content">

    <div class="site-container">


      <div class="title-container">

        <h1 class="page-title">
          RENAP - REGISTRO NACIONAL DE PERSONAS CON
          <br>
          COMPETENCIAS CERTIFICADAS
        </h1>

      </div>


      <section
        class="legal-text"
        aria-label="Información del RENAP"
      >

        <p>
          REGLAS Generales y criterios para la integración y operación del
          Sistema Nacional de Competencias. Artículo 83. El CONOCER diseñará,
          organizará y operará el Registro Nacional de Personas con Competencias
          Certificadas de manera independiente o conjunta con otras instancias
          de los niveles de gobierno Federal, Estatal y/o Municipal, según lo
          defina el propio CONOCER.
        </p>


        <p>
          El Registro Nacional de Personas con Competencias Certificadas, podrá
          ser consultado por todo el público en general de manera gratuita, y
          tendrá como objetivo fundamental integrar una base de datos con
          información sobre las personas que han obtenido uno o más Certificados
          de Competencia, con base en Estándares de Competencia inscritos en el
          Registro Nacional de Estándares de Competencia.
        </p>


        <p>
          Además, este Registro podrá servir para que las personas con
          competencias certificadas, puedan voluntariamente ingresar sus datos
          personales, para facilitar su localización, en caso de que
          organizaciones sindicales, empresas, sector académico, sector social
          o público, o alguna otra institución pública o privada, requieran
          personal con competencias certificadas en determinada Función
          Individual.
        </p>


        <p>
          Los datos personales recabados serán protegidos y serán incorporados
          y tratados en el Sistema de datos personales del RENAP con fundamento
          en las reglas generales y criterios para integración y operación del
          Sistema Nacional de Competencias y cuya finalidad es integrar una base
          de datos con información sobre las personas que han obtenido uno o más
          Certificados de Competencia, con base en Estándares de Competencia
          inscritos en el Registro Nacional de Estándares de Competencia, el
          cual fue registrado en el Listado de sistemas de Datos Personales ante
          el Instituto Federal de Acceso a la información Pública
          (www.ifai.org.mx) y podrán ser trasmitidos a sujetos obligados o
          dependencias y entidades con la finalidad del uso en facultades
          propias de las mismas. Además de otras trasmisiones previstas en Ley.
          La Unidad Administrativa responsable del Sistema es el Consejo
          Nacional de Normalización y Certificación de Competencias Laborales y
          la dirección donde el usuario podrá ejercer los derechos de acceso y
          corrección ante la misma es Av. Barranca del Muerto 275 Col. San José
          Insurgentes CP. 03900, México D.F. Lo anterior se informa en
          cumplimiento del Decimoséptimo de los lineamientos de protección de
          Datos Personales, publicados en el Diario Oficial de la Federación el
          30 de septiembre de 2005.
        </p>

      </section>


      <section
        class="renap-panel"
        id="renap"
      >

        <div class="renap-banner">

          Registro Nacional de personas con competencias certificadas

        </div>


        <p class="renap-description">

          En el Registro Nacional de Personas con Competencias Certificadas se
          encuentran todas aquellas personas que han obtenido un certificado de
          competencia emitido por el CONOCER y respaldado por los propios
          empresarios y trabajadores de los distintos sectores del país.

        </p>


        <form
          class="search-form"
          id="search-form"
          data-search-url="{{ route('certifications.search') }}"
        >

          <div class="search-field">

            <span
              class="renap-search-icon"
              aria-hidden="true"
            ></span>


            <label for="search-input">
              CURP / Folio
            </label>


            <input
              type="text"
              id="search-input"
              name="search"
              autocomplete="off"
              aria-label="Buscar por CURP o Folio"
              maxlength="50"
              required
            >

          </div>


          <button
            type="submit"
            class="btn-search"
            id="search-button"
          >
            Buscar
          </button>

        </form>


        <div class="results-panel">


          <div class="table-wrapper">

            <table class="renap-table">

              <colgroup>

                <col class="col-folio">
                <col class="col-tipo">
                <col class="col-codigo">
                <col class="col-titulo">
                <col class="col-entidad">
                <col class="col-siglas">
                <col class="col-evaluador">

              </colgroup>


              <thead>

                <tr>

                  <th>
                    Folio
                  </th>

                  <th>
                    Tipo
                  </th>

                  <th>
                    Código
                  </th>

                  <th>
                    Título
                  </th>

                  <th>
                    Entidad de certificación y
                    <br>
                    Evaluación
                  </th>

                  <th>
                    Siglas
                  </th>

                  <th>
                    Evaluador Centro de
                    <br>
                    evaluación
                  </th>

                </tr>

              </thead>


              <tbody id="results-body">

                <tr class="placeholder-row">

                  <td colspan="7">
                    &nbsp;
                  </td>

                </tr>

              </tbody>

            </table>

          </div>


          <p
            class="empty-state"
            id="empty-state"
            hidden
          >
            No se encontraron resultados.
          </p>


          <div class="paginator">

            <span class="paginator__total">
              Total de elementos por página: 30
            </span>


            <span class="paginator__page">
              1 de 1
            </span>


            <div class="paginator__actions">

              <button
                type="button"
                disabled
                aria-label="Primera página"
              >
                <span aria-hidden="true">
                  |‹
                </span>
              </button>


              <button
                type="button"
                disabled
                aria-label="Página anterior"
              >
                <span aria-hidden="true">
                  ‹
                </span>
              </button>


              <button
                type="button"
                disabled
                aria-label="Página siguiente"
              >
                <span aria-hidden="true">
                  ›
                </span>
              </button>


              <button
                type="button"
                disabled
                aria-label="Última página"
              >
                <span aria-hidden="true">
                  ›|
                </span>
              </button>

            </div>

          </div>

        </div>

      </section>

    </div>

  </main>


  <footer class="main-footer">

    <div class="site-container footer-grid">


      <div class="footer-column footer-logo">

        <img
          src="https://framework-gb.cdn.gob.mx/gobmx/img/logo_blanco.svg"
          alt="Gobierno de México"
        >

      </div>


      <div class="footer-column">

        <h3>
          Enlaces
        </h3>

        <ul>

          <li>
            <a
              href="https://data.buengobierno.gob.mx/"
              target="_blank"
              rel="noopener"
            >
              Datos abiertos de la SABG
            </a>
          </li>

          <li>
            <a
              href="http://www.ordenjuridico.gob.mx"
              target="_blank"
              rel="noopener"
            >
              Marco Jurídico
            </a>
          </li>

          <li>
            <a
              href="https://consultapublicamx.plataformadetransparencia.org.mx/vut-web/faces/view/consultaPublica.xhtml#inicio"
              target="_blank"
              rel="noopener"
            >
              Plataforma Nacional de Transparencia
            </a>
          </li>

          <li>
            <a
              href="https://transparencia.gob.mx"
              target="_blank"
              rel="noopener"
            >
              Transparencia para el pueblo
            </a>
          </li>

          <li>
            <a
              href="https://alertadores.buengobierno.gob.mx/"
              target="_blank"
              rel="noopener"
            >
              Alerta
            </a>
          </li>

        </ul>

      </div>


      <div class="footer-column">

        <h3>
          ¿Qué es gob.mx?
        </h3>

        <p>

          Es el portal único de trámites, información y participación ciudadana.

          <a href="https://www.gob.mx/que-es-gobmx">
            Leer más
          </a>

        </p>


        <ul>

          <li>
            <a
              href="https://datos.gob.mx"
              target="_blank"
              rel="noopener"
            >
              Portal de datos abiertos
            </a>
          </li>

          <li>
            <a
              href="https://www.gob.mx/accesibilidad"
              target="_blank"
              rel="noopener"
            >
              Declaración de accesibilidad
            </a>
          </li>

          <li>
            <a
              href="https://www.gob.mx/terminos"
              target="_blank"
              rel="noopener"
            >
              Términos y Condiciones
            </a>
          </li>

        </ul>

      </div>


      <div class="footer-column footer-social">

        <h3>

          <a
            href="https://sidec.buengobierno.gob.mx/#!/"
            target="_blank"
            rel="noopener"
            class="footer-underlined"
          >
            Denuncia contra servidores públicos
          </a>

        </h3>


        <p class="follow-title">
          Síguenos en
        </p>


        <div class="social-links">

          <a
            href="https://www.facebook.com/gobmexico"
            target="_blank"
            rel="noopener"
            aria-label="Facebook"
          >

            <img
              src="https://framework-gb.cdn.gob.mx/landing/img/facebook.png"
              alt="Facebook"
            >

          </a>


          <a
            href="https://twitter.com/GobiernoMX"
            target="_blank"
            rel="noopener"
            aria-label="Twitter"
          >

            <img
              src="https://framework-gb.cdn.gob.mx/landing/img/twitter.png"
              alt="Twitter"
            >

          </a>


          <a
            href="https://www.instagram.com/gobmexico/"
            target="_blank"
            rel="noopener"
            aria-label="Instagram"
          >

            <img
              src="https://framework-gb.cdn.gob.mx/landing/img/instagram.png"
              alt="Instagram"
            >

          </a>


          <a
            href="https://www.youtube.com/@gobiernodemexico"
            target="_blank"
            rel="noopener"
            aria-label="YouTube"
          >

            <img
              src="https://framework-gb.cdn.gob.mx/landing/img/youtube.png"
              alt="YouTube"
            >

          </a>

        </div>


        <a
          class="phone-logo"
          href="tel:+079"
          aria-label="Llamar al 079"
        >

          <img
            src="https://framework-gb.cdn.gob.mx/gobmx/img/079.png"
            alt="079"
          >

        </a>

      </div>

    </div>

  </footer>


  <!-- =====================================================
       ANIMACIÓN DE CARGA
  ====================================================== -->

  <div
    class="loading-overlay"
    id="loading-overlay"
    hidden
    aria-hidden="true"
  >

    <div
      class="loading-content"
      role="status"
      aria-live="polite"
    >

      <div
        class="renap-loader"
        aria-hidden="true"
      >

        <span class="renap-loader__dot renap-loader__dot--1"></span>
        <span class="renap-loader__dot renap-loader__dot--2"></span>
        <span class="renap-loader__dot renap-loader__dot--3"></span>

        <span class="renap-loader__center"></span>

      </div>

      <p>
        Cargando ....
      </p>

    </div>

  </div>


  <script src="index.js"></script>

</body>

</html>