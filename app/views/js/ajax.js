/* Send form from AJAX */
const forms_ajax = document.querySelectorAll(".FormAjax");

forms_ajax.forEach(forms => {

    forms.addEventListener("submit", function (e) {

        e.preventDefault();

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Quieres realizar la acción solicitada",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, realizar',
            cancelButtonText: 'No, cancelar'
        }).then((result) => {
            if (result.isConfirmed) {

                let data = new FormData(this);
                let method = this.getAttribute("method");
                let action = this.getAttribute("action");

                let headings = new Headers();

                let config = {
                    method: method,
                    headers: headings,
                    mode: 'cors',
                    cache: 'no-cache',
                    body: data
                };

                fetch(action, config)
                    .then(answer => answer.json())
                    .then(answer => {
                        return alert_ajax(answer);
                    });
            }
        });

    });

});



function alert_ajax(alert) {
    if (alert.type == "simple") {

        Swal.fire({
            icon: alert.icono,
            title: alert.title,
            text: alert.text,
            confirmButtonText: 'Aceptar'
        });

    } else if (alert.type == "reload") {

        Swal.fire({
            icon: alert.icono,
            title: alert.title,
            text: alert.text,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            }
        });

    } else if (alert.type == "clear") {

        Swal.fire({
            icon: alert.icono,
            title: alert.title,
            text: alert.text,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector(".FormAjax").reset();
            }
        });

    } else if (alert.type == "redirection") {
        window.location.href = alert.url;
    }
}



/* Boton cerrar sesion */
let btn_exit = document.getElementById("btn_exit");

btn_exit.addEventListener("click", function (e) {

    e.preventDefault();

    Swal.fire({
        title: '¿Quieres salir del sistema?',
        text: "La sesión actual se cerrará y saldrás del sistema",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, salir',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let url = btn_exit.getAttribute("href");
            window.location.href = url;
        }
    });

});