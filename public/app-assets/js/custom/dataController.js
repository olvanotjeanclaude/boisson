function loadDatatable(element = ".datatable", buttons = []) {
    if ($(element).length) {
        const configs = {
            ordering: false,
        };

        if (buttons.length > 0) {
            configs.dom= 'Bfrtip';
            configs.buttons = buttons;
        }
      
        $(element).DataTable(configs);
    }
}

function deleteItem() {
    const url = $(this).data("url");
    const id = $(this).data("id");

    if (url && id) {
        $("#confirmDelete").attr("data-url", url);
        $("#confirmDelete").attr("row-id", id);
        $("#deleteModal").modal("show");
    }
}

function confirmeDeleteItem() {
    $(this).html(`<i class="la la-refresh spinner"></i>`);
    const url = $(this).attr("data-url");
    const rowId = $(this).attr("row-id");

    if (url && rowId) {
        axios.delete(url)
            .then((response) => {
                const data = response.data;
                if (data.type == "success") {
                    $("#deleteModal").modal("hide");
                    alertSnackbar(data.success);
                    $(`#row_${rowId}`).remove();

                    if (data.reload) {
                        setTimeout(function () {
                            window.location.reload();
                        }, 3000);
                    }
                }
                //console.log(data);
            });
        $(this).html("oui");
    }
}

async function deleteAllItem() {
    const checkedIds = $('table.icheck input:checkbox:checked').map(function () {
        return $(this).data("id");
    }).get();
    const url = $("#deleteIcheckBtn").data("url");

    if (checkedIds.length && url) {
        const response = await axios.delete(url, {
            data: checkedIds
        }).then(response => response.data).catch(response => console.log(response));

        if (response.success) {
            $("#deleteIcheckBtn").addClass("d-none");
            checkedIds.forEach(rowId => {
                $(`table.icheck #row_${rowId}`).remove();
            });
            alertSnackbar(response.success);
        } else {
            alertSnackbar(response.error);
        }
    }
    $("#deleteAllModal").modal("hide");
}

function alertSnackbar(message) {
    $(".snackbar-body").text(message);
    $(".snackbar-toggler").trigger("click")
}

function icheckConfig() {
    // Checkbox & Radio 1
    $('.icheck input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
    });

    //TODO:AJ: Improve check uncheck all func
    var checkAll = $('input.input-chk-all');
    var checkboxes = $('input.input-chk');


    checkAll.on('ifChecked ifUnchecked', function (event) {
        if (event.type == 'ifChecked') {
            $("#deleteIcheckBtn").removeClass("d-none");
            checkboxes.iCheck('check');
        } else {
            $("#deleteIcheckBtn").addClass("d-none");
            checkboxes.iCheck('uncheck');
        }
    });

    checkboxes.on('ifChanged', function (event) {
        if (checkboxes.filter(':checked').length == checkboxes.length) {
            checkAll.prop('checked', 'checked');
        } else {
            checkAll.removeProp('checked');
        }
        checkAll.iCheck('update');
    });

    checkboxes.on("ifChanged", function (event) {
        const checkedLength = $('table.icheck input.input-chk:checkbox:checked').length;
        toggleCheckbox(checkedLength);
    })
}

function toggleCheckbox(statusOk) {
    if (statusOk) {
        $("#deleteIcheckBtn").removeClass("d-none");
    } else {
        $("#deleteIcheckBtn").addClass("d-none");
    }
}