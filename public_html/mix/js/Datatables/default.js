import ajaxConfig from "./ajax-config.js";
import buttons from "./buttons.js";

export function loadDatatable(element = ".datatable", buttons =  ['copy', 'csv', 'excel', 'pdf']) {
    if ($(element).length) {
        const configs = {
            ordering: false,
        };

        if (buttons.length > 0) {
            configs.dom = 'Bfrtip';
            configs.buttons = buttons;
        }

        return $(element).DataTable(configs);
    }
}

export  function loadDatatableAjax(tableElement = ".ajax-datatable", method = "post",parameters={}) {
    const url = $(`table${tableElement}`).data("url");
    const table = $(`table${tableElement}`);
    const columns = $(`table${tableElement}`).data("columns");
    const currentRoute = $(`table${tableElement}`).data("route");

    if (table.length && url && columns) {
        // console.log(columns)
        // return;
        const datatable = table.DataTable({
           ...ajaxConfig,
            ajax: {
                url: url,
                type: method,
                data: function (params) {
                    params._token = $('meta[name="csrf-token"]').attr('content');
                    params.searchInput = $("input[type='search']").val();
                    params.currentRoute = currentRoute;
                    params.data = parameters;
                }
            },
            buttons: buttons(columns),
        });

        return datatable;
    }
}