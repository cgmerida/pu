import * as $ from "jquery";
import swal from "sweetalert2";

window.swal = swal;

export default (function() {
    $(document).on("click", "form.delete button", function(e) {
        var _this = $(this);
        e.preventDefault();
        swal({
            title: "¿Estás Seguro?", // Opération Dangereuse
            text: "¿Estás seguro de querer continuar?", // Êtes-vous sûr de continuer ?
            type: "error",
            showCancelButton: true,
            confirmButtonColor: "null",
            cancelButtonColor: "null",
            confirmButtonClass: "btn btn-outline-danger",
            cancelButtonClass: "btn btn-outline-primary",
            confirmButtonText: "Si, estoy seguro", // Oui, sûr
            cancelButtonText: "Cancelar" // Annuler
        }).then(res => {
            if (res.value) {
                _this.closest("form").submit();
            }
        });
    });
})();
