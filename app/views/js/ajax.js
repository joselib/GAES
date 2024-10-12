/* send form by AJAX */
const form_ajax=document.querySelectorAll(".FormAjax");

form_ajax.forEach(form => {

    form.addEventListener("submit",function(e){
        
        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to perform the requested action",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, perform',
            cancelButtonText: 'No, cancel'
        }).then((result) => {
            if (result.isConfirmed){

                let data = new FormData(this);
                let method=this.getAttribute("method");
                let action=this.getAttribute("action");

                let headers= new Headers();

                let config={
                    method: method,
                    headers: headers,
                    mode: 'cors',
                    cache: 'no-cache',
                    body: data
                };

                fetch(action,config)
                .then(reply => reply.json())
                .then(reply =>{ 
                    return alert_ajax(reply);
                });
            }
        });

    });

});


function alert_ajax(alert) {
    if (alert.tipo == "simple") {

        Swal.fire({
            icon: alert.icono,
            title: alert.titulo,
            text: alert.texto,
            confirmButtonText: 'Acept'
        });

    } else if (alert.tipo == "recargar") {

        Swal.fire({
            icon: alert.icono,
            title: alert.titulo,
            text: alert.texto,
            confirmButtonText: 'Acept'
        }).then((result) => {
            if (result.isConfirmed) {
                location.reload();
            }
        });

    } else if (alert.tipo == "limpiar") {

        Swal.fire({
            icon: alert.icono,
            title: alert.titulo,
            text: alert.texto,
            confirmButtonText: 'Acept'
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector(".FormularioAjax").reset();
            }
        });

    } else if (alert.tipo == "redireccionar") {
        window.location.href = alert.url;
    }
}
