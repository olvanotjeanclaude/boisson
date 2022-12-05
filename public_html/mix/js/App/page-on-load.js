import { loadDatatable, loadDatatableAjax } from "../Datatables/default.js";
import bootstrapValidation from "./bootstrap-validation.js";
import { loadSelect2 } from "./library.js";

export default function pageOnLoad() {
    bootstrapValidation();
    loadSelect2();
    loadDatatable();
    loadDatatableAjax();
    goBackControl();
}

function goBackControl() {
    // if (document.referrer.indexOf(window.location.host) !== -1) {
    //     $(".goBack").removeClass("d-none");
    // }
    // else {
    //     $(".goBack").addClass("d-none");
    // }

    $("#logout").on("click", function () {
        const form = $(this).closest("form");

        if (form) {
            form.submit();
        }
    })

    $(".goBack").on("click", function () {
        if (document.referrer.indexOf(window.location.host) !== -1) {
            window.history.go(-1);
        }
        else {
            window.location.href = '/';
        }
    })
}