class Achat {
    constructor(formId = "#addArticleForm") {
        this.row_id = 0;
        this.formId = formId;
        this.items = [];
        this.action = {
            name: "create",
        };
        this.preInvoices = [];
        this.articleTypes = ["article", "consignation", "deconsignation"];
        this.units = ["pcs", "cageot", "carton"];
    }
    initForm() {
        $("#article_type").html(this.getArticleTypeOptionHtml());
        this.preSaveArticleUrl = $(this.formId).attr("preSaveArticleUrl");
        this.preSaveInvoiceUrl = $(this.formId).attr("preSaveInvoiceUrl");
        this.url = $(this.formId).attr("action");
    }
    addItem(item) {
        this.row_id++;
        item.row_id = this.row_id;
        this.items.push(item);
    }
    removeItem(itemId) {
        this.items = this.items.filter((article) => article.row_id != itemId);
    }
    editItem(rowId) {
        const article = this.items.filter((article) => article.row_id == rowId)[0];
        if (article) {
            this.action = {
                name: "update",
                rowId: article.row_id
            };
        }

        return article;
    }
    updateItem(rowId, newItem) {
        // console.log(rowId);
        const article = this.items.filter((article) => article.row_id == rowId)[0];
        const position = this.items.indexOf(article)

        if (position != -1) {
            newItem.row_id = rowId;
            this.items[position] = newItem;
        }

        this.action.name = "create";
    }
    serializeItem(serializedArray) {
        const item = {};
        if (serializedArray.length > 0) {
            serializedArray.forEach(current => {
                item[current.name] = current.value;
            });
        }
        return item;
    }
    validate(item) {
        return axios.post(this.url, item)
            .then((response) => response.data)
            .catch(response => {
                alert("Erreur inconnue!")
            })
    }
    printErrors(serverErrors) {
        let errorHtml = "";
        if (serverErrors.length) {
            errorHtml += "<ul>";
            serverErrors.forEach(errors => {
                errors.forEach(error => {
                    errorHtml += `<li class="text-danger">${error}</li>`;
                });
            });
            errorHtml += "</ul>"
        }
        return errorHtml;
    }
    getItems() {
        return this.items;
    }
    getArticleTypeOptionHtml() {
        // let optionsHtml = "<option value=''>Choisir</option>";
        let optionsHtml = "";
        if (this.articleTypes.length > 0) {
            this.articleTypes.forEach((articleType, index) => {
                optionsHtml += `<option value='${index+1}'>${articleType}</option>`;
            });

            return optionsHtml;
        }
    }
}