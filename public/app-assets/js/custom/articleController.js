const article = new Achat();

$(document).ready(function() {
    article.initForm();

    $(document).on("click", "#validFacture", async function() {
        const allItems = article.getItems();

        await axios.post(article.url, {
                allItems,
                submited: true
            })
            .then((response) => {
                if (response.data.success) {
                    const html = `
                            <p class="card-text">La désignation, nombre de bouteille et le total se trouve dans cette zone.
                            </p>
                            `;
                    $("#ajaxPreArticleTable tbody").html("");
                    $("#ajaxPreInvoice").html(html);
                    $("#modalSuccess .modal-body").text(response.data.message);
                    article.items = [];
                    $("#modalSuccess").modal("show");
                }
                // console.log(response);
            })
            .catch((response) => {
                console.log(response);
            });

    });

    $("#quantity_type_value, #contenance").keyup(function() {
        const quantity_type_value = parseInt($("#quantity_type_value").val());
        const contenance = parseInt($("#contenance").val());

        if (quantity_type_value > 0 && contenance > 0) {
            $("#quantity_bottle").val(quantity_type_value * contenance);
        }
    });

    $(article.formId).bind("submit", async function(e) {
        e.preventDefault();
        const articleForm = $(this);
        const data = articleForm.serializeArray();
        const item = article.serializeItem(data);
        const supplier_id = $("#supplier_id").val();

        const validation = await article.validate(item);

        if (validation && validation.isErrorExist && Object.keys(validation.errors).length) {
            //console.log(validation);
            let errorHtml = article.printErrors(Object.values(validation.errors));
            $("#printErrors").html(errorHtml);
            $("#modalMessage").modal("show");
            return false;
        }

        if (article.action.name == "create") {
            $("#addArticle").html(`<span class="material-icons">add</span> Ajouter`);
            article.addItem(item);
        } else if (article.action.name == "update" && article.action.rowId) {
            article.updateItem(article.action.rowId, item);
            $("#addArticle").html(`<span class="material-icons">add</span> Ajouter`);
        }

        if (article.preSaveArticleUrl) {
            await axios.post(article.preSaveArticleUrl, article.getItems()).then((response) => {
                $("#ajaxPreArticleTable").html(response.data);
            })
        }

        if (article.preSaveInvoiceUrl) {
            await axios.post(article.preSaveInvoiceUrl, article.getItems()).then((response) => {
                $("#ajaxPreInvoice").html(response.data);
            })
        }

        article.items["supplier_id"] = supplier_id;
        articleForm[0].reset();

        $("#supplier_id").val(supplier_id)
            //console.log(article.items)
    });

    $(document).on("click", ".remove-article", async function() {
        const rowId = $(this).data("row_id");
        article.removeItem(rowId);
        await axios.post(article.preSaveInvoiceUrl, article.getItems()).then((response) => {
            $("#ajaxPreInvoice").html(response.data);
        })
        $(`#article_${rowId}`).remove();
    })

    $(document).on("click", ".edit-article", function() {
        const rowId = $(this).data("row_id");
        const item = article.editItem(rowId);

        if (item) {
            $("#article_type").val(item.article_type);
            $("#category_id").val(item.category_id);
            $("#designation").val(item.designation);
            $("#quantity_type").val(item.quantity_type);
            $("#quantity_type_value").val(item.quantity_type_value);
            $("#quantity_bottle").val(item.quantity_bottle);
            $("#contenance").val(item.contenance);
            $("#unity").val(item.unity);
            $("#unit_price").val(item.unit_price);
            $("#buying_price").val(item.buying_price);
            $("#wholesale_price").val(item.wholesale_price);
            $("#detail_price").val(item.detail_price);

            $("#addArticle").html(`<span class="material-icons">save</span> Enregister`);
        }
        //console.log(article.items);
        //console.log(item);
    })
});