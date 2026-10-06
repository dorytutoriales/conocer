'use strict';


/* =========================================================
   MENÚS RESPONSIVOS
========================================================= */

const menuButtons =
  document.querySelectorAll('[data-toggle-target]');


menuButtons.forEach((button) => {

  button.addEventListener('click', () => {

    const targetId =
      button.dataset.toggleTarget;

    const menu =
      document.getElementById(targetId);


    if (!menu) {
      return;
    }


    const isOpen =
      menu.classList.toggle('is-open');


    button.setAttribute(
      'aria-expanded',
      String(isOpen)
    );

  });

});


/* =========================================================
   CERRAR MENÚ AL HACER CLIC EN UN ENLACE
========================================================= */

document
  .querySelectorAll(
    '.gov-navbar__menu a, .sub-navbar__menu a'
  )
  .forEach((link) => {

    link.addEventListener('click', () => {

      document
        .querySelectorAll(
          '.gov-navbar__menu, .sub-navbar__menu'
        )
        .forEach((menu) => {

          menu.classList.remove('is-open');

        });


      menuButtons.forEach((button) => {

        button.setAttribute(
          'aria-expanded',
          'false'
        );

      });

    });

  });


/* =========================================================
   BUSCADOR RENAP
========================================================= */

const searchForm =
  document.getElementById('search-form');

const searchInput =
  document.getElementById('search-input');

const searchButton =
  document.getElementById('search-button');

const resultsBody =
  document.getElementById('results-body');

const emptyState =
  document.getElementById('empty-state');

const loadingOverlay =
  document.getElementById('loading-overlay');

let isSearching = false;


/* =========================================================
   MAYÚSCULAS AUTOMÁTICAS
========================================================= */

if (searchInput) {

  searchInput.addEventListener('input', () => {

    searchInput.value =
      searchInput.value.toUpperCase();

  });

}


/* =========================================================
   ESPERA
========================================================= */

function wait(milliseconds) {

  return new Promise((resolve) => {

    window.setTimeout(
      resolve,
      milliseconds
    );

  });

}


/* =========================================================
   ACTIVAR / DESACTIVAR CARGA
========================================================= */

function setLoading(isLoading) {

  if (loadingOverlay) {

    loadingOverlay.hidden =
      !isLoading;

    loadingOverlay.setAttribute(
      'aria-hidden',
      String(!isLoading)
    );

  }


  if (searchButton) {

    searchButton.disabled =
      isLoading;

  }


  document.body.classList.toggle(
    'is-loading',
    isLoading
  );

}


/* =========================================================
   CREAR FILA VACÍA
========================================================= */

function createPlaceholderRow() {

  const row =
    document.createElement('tr');

  row.className =
    'placeholder-row';


  const cell =
    document.createElement('td');

  cell.colSpan = 7;
  cell.innerHTML = '&nbsp;';


  row.appendChild(cell);

  return row;

}


/* =========================================================
   MOSTRAR MENSAJE
========================================================= */

function showMessage(message) {

  if (!resultsBody) {
    return;
  }


  resultsBody.replaceChildren(
    createPlaceholderRow()
  );


  if (emptyState) {

    emptyState.textContent =
      message;

    emptyState.hidden =
      false;

  }

}


/* =========================================================
   MOSTRAR RESULTADOS
========================================================= */

function renderResults(records) {

  if (!resultsBody) {
    return;
  }


  resultsBody.replaceChildren();


  if (
    !Array.isArray(records) ||
    records.length === 0
  ) {

    resultsBody.appendChild(
      createPlaceholderRow()
    );


    if (emptyState) {

      emptyState.textContent =
        'No se encontraron resultados.';

      emptyState.hidden =
        false;

    }


    return;

  }


  if (emptyState) {

    emptyState.hidden =
      true;

  }


  const columns = [
    'folio',
    'tipo',
    'codigo',
    'titulo',
    'entidad',
    'siglas',
    'evaluador',
  ];


  records.forEach((record) => {

    const row =
      document.createElement('tr');


    columns.forEach((column) => {

      const cell =
        document.createElement('td');


      cell.textContent =
        record[column] ?? '';


      row.appendChild(cell);

    });


    resultsBody.appendChild(row);

  });

}


/* =========================================================
   EXTRAER ERROR DEL SERVIDOR
========================================================= */

async function getErrorMessage(response) {

  try {

    const payload =
      await response.json();


    if (
      payload.errors &&
      typeof payload.errors === 'object'
    ) {

      const firstError =
        Object.values(
          payload.errors
        )
          .flat()
          .find(Boolean);


      if (firstError) {
        return firstError;
      }

    }


    if (payload.message) {
      return payload.message;
    }

  } catch (error) {

    return 'No se pudo realizar la búsqueda.';

  }


  return 'No se pudo realizar la búsqueda.';

}


/* =========================================================
   BUSCAR
========================================================= */

if (
  searchForm &&
  searchInput &&
  resultsBody
) {

  searchForm.addEventListener(
    'submit',
    async (event) => {

      event.preventDefault();


      if (isSearching) {
        return;
      }


      const query =
        searchInput.value
          .trim()
          .toUpperCase();


      if (query === '') {

        searchInput.focus();

        return;

      }


      const searchUrl =
        searchForm.dataset.searchUrl;


      if (!searchUrl) {

        showMessage(
          'No se pudo iniciar la búsqueda.'
        );

        return;

      }


      isSearching = true;

      const startedAt =
        performance.now();


      setLoading(true);


      if (emptyState) {

        emptyState.hidden =
          true;

      }


      try {

        const url =
          new URL(
            searchUrl,
            window.location.origin
          );


        url.searchParams.set(
          'q',
          query
        );


        const response =
          await fetch(
            url.toString(),
            {
              method: 'GET',

              headers: {
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
              },

              credentials: 'same-origin',
            }
          );


        if (!response.ok) {

          const message =
            await getErrorMessage(
              response
            );


          throw new Error(message);

        }


        const payload =
          await response.json();


        renderResults(
          payload.data ?? []
        );

      } catch (error) {

        showMessage(
          error instanceof Error
            ? error.message
            : 'No se pudo realizar la búsqueda.'
        );

      } finally {

        const elapsed =
          performance.now() -
          startedAt;


        const remaining =
          Math.max(
            0,
            800 - elapsed
          );


        if (remaining > 0) {

          await wait(remaining);

        }


        setLoading(false);

        isSearching = false;

      }

    }
  );

}


/* =========================================================
   CERRAR MENÚ AL CAMBIAR TAMAÑO
========================================================= */

window.addEventListener(
  'resize',
  () => {

    if (window.innerWidth > 900) {

      document
        .querySelectorAll(
          '.gov-navbar__menu, .sub-navbar__menu'
        )
        .forEach((menu) => {

          menu.classList.remove(
            'is-open'
          );

        });


      menuButtons.forEach((button) => {

        button.setAttribute(
          'aria-expanded',
          'false'
        );

      });

    }

  }
);


/* =========================================================
   ESCAPE CIERRA LOS MENÚS
========================================================= */

document.addEventListener(
  'keydown',
  (event) => {

    if (event.key !== 'Escape') {
      return;
    }


    document
      .querySelectorAll(
        '.gov-navbar__menu, .sub-navbar__menu'
      )
      .forEach((menu) => {

        menu.classList.remove(
          'is-open'
        );

      });


    menuButtons.forEach((button) => {

      button.setAttribute(
        'aria-expanded',
        'false'
      );

    });

  }
);