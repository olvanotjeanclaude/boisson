import { loadDatatable, loadDatatableAjax } from "../Datatables/default.js";
import bootstrapValidation from "./bootstrap-validation.js";
import { loadSelect2 } from "./library.js";

export default function pageOnLoad(){
    bootstrapValidation();
    loadSelect2();
    loadDatatable();
    loadDatatableAjax();
}