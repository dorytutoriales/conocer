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

const resultsBody =
  document.getElementById('results-body');

const emptyState =
  document.getElementById('empty-state');


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
   FUNCIÓN PARA OBTENER FILAS REALES
========================================================= */

function getResultRows() {

  if (!resultsBody) {
    return [];
  }


  return Array.from(
    resultsBody.querySelectorAll(
      'tr:not(.placeholder-row)'
    )
  );

}


/* =========================================================
   CONTROLAR FILA VACÍA
========================================================= */

function updatePlaceholder() {

  if (!resultsBody) {
    return;
  }


  const placeholder =
    resultsBody.querySelector(
      '.placeholder-row'
    );


  const rows =
    getResultRows();


  if (!placeholder) {
    return;
  }


  /*
   * Si existen resultados reales,
   * ocultamos la fila vacía.
   */

  placeholder.hidden =
    rows.length > 0;

}


/* =========================================================
   FILTRAR RESULTADOS
========================================================= */

if (
  searchForm &&
  searchInput &&
  resultsBody
) {

  searchForm.addEventListener(
    'submit',
    (event) => {

      event.preventDefault();


      const query =
        searchInput.value
          .trim()
          .toUpperCase();


      const rows =
        getResultRows();


      let visibleRows = 0;


      rows.forEach((row) => {

        const rowText =
          row.textContent
            .trim()
            .toUpperCase();


        const matches =
          query === '' ||
          rowText.includes(query);


        row.hidden =
          !matches;


        if (matches) {
          visibleRows += 1;
        }

      });


      /*
       * La captura de referencia deja la tabla vacía
       * cuando todavía no existen datos.
       *
       * Por eso solo mostramos "No se encontraron
       * resultados" cuando realmente existen filas
       * y ninguna coincide.
       */

      if (emptyState) {

        if (
          rows.length > 0 &&
          query !== '' &&
          visibleRows === 0
        ) {

          emptyState.hidden =
            false;

        } else {

          emptyState.hidden =
            true;

        }

      }


      updatePlaceholder();

    }
  );

}


/* =========================================================
   ACTUALIZAR PLACEHOLDER AL INICIAR
========================================================= */

updatePlaceholder();


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