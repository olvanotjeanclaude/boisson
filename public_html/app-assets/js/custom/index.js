$(document).ready(function() {
    $(".main-menu-content").removeClass("d-none");
    
    $(document).on("click", ".delete-btn", deleteItem)

    $("button#confirmDelete").click(confirmeDeleteItem)

    $("#confirmDeleteAllBtn").click(deleteAllItem)

    if ($("table.icheck input").length) {
        icheckConfig();
    }

    $("input[type='number']").attr("step","0.01");
    
    $(".select2").select2();
});