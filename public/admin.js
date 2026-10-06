'use strict';

/* =========================================================
   MOSTRAR / OCULTAR CONTRASEÑA
========================================================= */

document
    .querySelectorAll('[data-password-toggle]')
    .forEach((button) => {
        button.addEventListener('click', () => {
            const inputId =
                button.getAttribute('aria-controls');

            const input =
                document.getElementById(inputId);

            if (!input) {
                return;
            }

            const showIcon =
                button.querySelector(
                    '.password-icon--show'
                );

            const hideIcon =
                button.querySelector(
                    '.password-icon--hide'
                );

            const passwordIsVisible =
                input.type === 'text';

            input.type =
                passwordIsVisible
                    ? 'password'
                    : 'text';

            button.setAttribute(
                'aria-label',
                passwordIsVisible
                    ? 'Mostrar contraseña'
                    : 'Ocultar contraseña'
            );

            if (showIcon) {
                showIcon.hidden =
                    !passwordIsVisible;
            }

            if (hideIcon) {
                hideIcon.hidden =
                    passwordIsVisible;
            }
        });
    });


/* =========================================================
   CAMPOS EN MAYÚSCULAS
========================================================= */

document
    .querySelectorAll('[data-uppercase]')
    .forEach((input) => {
        input.addEventListener('input', () => {
            input.value =
                input.value.toUpperCase();
        });
    });


/* =========================================================
   CONFIRMACIÓN DE ELIMINACIÓN
========================================================= */

document
    .querySelectorAll('[data-confirm-delete]')
    .forEach((form) => {
        form.addEventListener(
            'submit',
            (event) => {
                const confirmed =
                    window.confirm(
                        '¿Estás seguro de que deseas eliminar este registro? Esta acción no se puede deshacer.'
                    );

                if (!confirmed) {
                    event.preventDefault();
                }
            }
        );
    });