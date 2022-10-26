import pageOnLoad from "./App/page-on-load.js";
import { confirmeDeleteItem, deleteAllItem, deleteItem } from "./App/dataController.js";

$(document).ready(function () {
    pageOnLoad();
    
    $(".main-menu-content").removeClass("d-none");

    $(document).on("click", ".delete-btn", deleteItem)

    $("button#confirmDelete").click(confirmeDeleteItem)

    $("#confirmDeleteAllBtn").click(deleteAllItem)

    $("input[type='number']").attr("step", "0.01");
});