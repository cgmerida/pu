<script>
    function mySwall(title, btn_txt, method, body, url){
        swal.fire({
            title: title,
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: btn_txt,
            showLoaderOnConfirm: true,
            preConfirm: (name) => {
                body.name = name;
                return fetch(url, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content')
                    },
                    method: method,
                    credentials: "same-origin",
                    body: JSON.stringify(body)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                        console.log(response);
                    }
                    return response.json()
                })
                .catch(error => {
                    swal.showValidationMessage(`fallo la petición: ${error}`)
                })
            },
            allowOutsideClick: () => !swal.isLoading()
        })
        .then((result) => {
            if (result.value) {
                if (result.value.status == 'exito'){
                    searchDatatable();
                    swal.fire(result.value.status, result.value.message,'success')
                }
            }
        })
    }

    function mySwall(title, btn_txt, method, body, url){
        swal.fire({
            title: title,
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: btn_txt,
            showLoaderOnConfirm: true,
            preConfirm: (name) => {
                body.name = name;
                return fetch(url, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content')
                    },
                    method: method,
                    credentials: "same-origin",
                    body: JSON.stringify(body)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                        console.log(response);
                    }
                    return response.json()
                })
                .catch(error => {
                    swal.showValidationMessage(`fallo la petición: ${error}`)
                })
            },
            allowOutsideClick: () => !swal.isLoading()
        })
        .then((result) => {
            if (result.value) {
                if (result.value.status == 'exito'){
                    searchDatatable();
                    swal.fire(result.value.status, result.value.message,'success')
                }
            }
        })
    }

    function myRadioSwall(title, btn_txt, method, body, url){
        swal.fire({
            title: title,
            input: 'radio',
            inputOptions: {
                'true': 'Si',
                'false': 'No'
            },
            showCancelButton: true,
            confirmButtonText: btn_txt,
            showLoaderOnConfirm: true,
            inputValidator: (value) => {
                return !value && 'Tienes que elegir una opcion!'
            },
            preConfirm: (option) => {
                body.option = option;
                return fetch(url, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content')
                    },
                    method: method,
                    credentials: "same-origin",
                    body: JSON.stringify(body)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                        console.log(response);
                    }
                    return response.json()
                })
                .catch(error => {
                    swal.showValidationMessage(`fallo la petición: ${error}`)
                })
            },
            allowOutsideClick: () => !swal.isLoading()
        })
        .then((result) => {
            if (result.value) {
                if (result.value.status == 'exito'){
                    searchDatatable();
                    swal.fire(result.value.status, result.value.message,'success')
                }
            }
        })
    }

    function deleteCandidate(url) {
        swal.fire({
            title: "¿Estás Seguro?",
            text: "¿Estás seguro de querer continuar?",
            type: "error",
            showCancelButton: true,
            confirmButtonClass: "btn btn-outline-danger",
            cancelButtonClass: "btn btn-outline-primary",
            confirmButtonText: "Si, estoy seguro",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true
        }).then(res => {
            if (res.value) {
                return fetch(url, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'post',
                    credentials: "same-origin",
                    body: JSON.stringify({
                        _method: "DELETE",
                    })}
                )
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(response.statusText)
                console.log(response);
            }
            return response.json();
        })
        .then(result => {
            if (result.status == 'exito'){
                searchDatatable();
                swal.fire(result.status, result.message,'success')
            }
        })
        .catch(error => {
            swal.showValidationMessage(`fallo la petición: ${error}`)
        })
    }
</script>