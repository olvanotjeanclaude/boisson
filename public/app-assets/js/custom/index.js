$(document).ready(function() {
    $(document).on("click", ".delete-btn", deleteItem)

    $("button#confirmDelete").click(confirmeDeleteItem)

    $("#confirmDeleteAllBtn").click(deleteAllItem)

    if ($("table.icheck input").length) {
        icheckConfig();
    }
    
    $(".select2").select2();
});