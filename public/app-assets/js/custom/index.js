function loadDatatable(element = ".datatable") {
    if ($(element).length) {
        $(element).DataTable({
            "ordering": false
        });
    }
}