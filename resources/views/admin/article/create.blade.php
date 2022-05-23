@extends('layouts.app')

@section('title')
    Nouveau Article
@endsection

@section('page-css')
    <style>
        table#preInvoice td {
            margin: .4rem auto;
        }

    </style>
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Article',
        'breadcrumbs' => [
            ['text' => 'Articles', 'link' => route('admin.articles.index')],
            ['text' => 'Nouveau', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Factures',
            'link' => route('admin.articles.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => true,
        ],
    ])
@endsection

@section('content')
    <form preSaveInvoiceUrl="{{ route('admin.article.preSaveInvoiceArticle') }}"
        preSaveArticleUrl="{{ route('admin.article.preSaveArticle') }}" id="addArticleForm"
        action="{{ route('admin.articles.store') }}" class="row" method="POST">

        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mt-1">
                            <label class="text-bold-400 text-dark" for="article_type">Type D'Article</label>
                            <select name="article_type" id="article_type" class="form-control">
                            </select>
                            <div class="invalid-feedback">
                                le champ de type d'article ne peut pas être vide
                            </div>
                        </div>
                        <div class="col-sm-6 mt-1">
                            <label class="text-bold-400 text-dark" for="category_id">Famille</label>
                            <select name="category_id" class="form-control" id="category_id">
                                <option value="">Choisir</option>
                                @foreach ($catArticles as $catArticle)
                                    <option value="{{ $catArticle->id }}">{{ $catArticle->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 col-md-4 mt-1">
                            <label class="text-bold-400 text-dark" for="designation">Designation d'article</label>
                            <input type="text" class="form-control" placeholder="Designation" id="designation"
                                name="designation">
                        </div>
                        <div class="col-sm-6 col-md-4 mt-1">
                            <label class="text-center text-bold-400 text-dark" for="quantity_type">Type</label>
                            <div class="d-flex">
                                <select class="form-control" id="quantity_type" name="quantity_type">
                                    <option value="">Choisir</option>
                                    @foreach (\App\Models\Articles::UNITS as $key => $value)
                                        @if ($key == 'pcs')
                                            @continue
                                        @endif
                                        <option @if ($key == 'cageot') selected @endif
                                            value="{{ $value }}">{{ $key }}</option>
                                    @endforeach
                                </select>
                                <input type="number" class="form-control" id="quantity_type_value"
                                    name="quantity_type_value" placeholder="0">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 mt-1">
                            <label class="text-bold-400 text-dark" for="contenance">Contenance</label>
                            <input type="number" placeholder="0" class="form-control" id="contenance" name="contenance">
                        </div>
                        <div class="col-sm-6 col-md-4 mt-1">
                            <label class="text-bold-400 text-dark" for="quantity_bottle">Quantité Bouitelle</label>
                            <input type="number" class="form-control" placeholder="Qtt Bouteille" id="quantity_bottle"
                                name="quantity_bottle">
                        </div>
                        <div class="col-sm-6 col-md-4 mt-1">
                            <label class="text-bold-400 text-dark" for="unity">Unite</label>
                            <select id="unity" name="unity" class="form-control">
                                @foreach (\App\Models\Articles::UNITS as $key => $value)
                                    <option @if ($key == 'pcs') selected @endif value="{{ $value }}">
                                        {{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 col-md-4 mt-1">
                            <label class="text-bold-400 text-dark" for="unit_price">Prix Unitaire</label>
                            <input type="text" class="form-control" id="unit_price" name="unit_price" placeholder="0">
                        </div>
                        <div class="col-12">
                            <div class="card bg-light rounded mt-1">
                                <div class="card-body pt-0">
                                    <div class="row" style="margin-top: .3rem">
                                        <div class="col-sm-5 mt-1 mt-md-0 col-md">
                                            <div class="">
                                                <label style="margin-bottom: .3rem" class="text-bold-400 text-dark"
                                                    for="buying_price">Prix
                                                    D'Achat</label>
                                                <input type="text" id="buying_price" name="buying_price"
                                                    class="w-100" placeholder="0 Ariary">
                                            </div>
                                        </div>
                                        <div class="col-sm-5 mt-1 mt-md-0 col-md">
                                            <div class="">
                                                <label style="margin-bottom: .3rem" class="text-bold-400 text-dark"
                                                    for="wholesale_price">Prix De
                                                    Gros
                                                </label>
                                                <input type="text" class="w-100" id="wholesale_price"
                                                    name="wholesale_price" placeholder="0 Ariary">
                                            </div>
                                        </div>
                                        <div class="col-sm-5 mt-1 mt-md-0 col-md">
                                            <div class="">
                                                <label style="margin-bottom: .3rem" class="text-bold-400 text-dark"
                                                    for="detail_price">Prix
                                                    Détail</label>
                                                <input type="text" class="w-100" id="detail_price"
                                                    name="detail_price" placeholder="0 Ariary">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" id="addArticle" class="btn float-right btn-primary">
                                <span class="material-icons">add</span>
                                Ajouter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="ajaxPreArticleTable"></div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-capitalize">Information du fournisseur</h5>
                    <select name="supplier_id" id="supplier_id" class="form-control">
                        <option value="">Fournisseur</option>
                        @forelse ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">
                                {{ $supplier->code }}-{{ Str::upper($supplier->identification) }}
                            </option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="text-capitalize font-weight-bold">Facture</h5>
                    <div id="ajaxPreInvoice">
                        <p class="card-text">La désignation, nombre de bouteille et le total se trouve dans cette zone.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="form-group">
        <!-- Modal error-->
        <div class="modal fade text-left" id="modalMessage" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger white">
                        <h4 class="modal-title white" id="myModalLabel10">Messages</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="printErrors">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-outline-danger d-none">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal success-->
        <div class="modal fade text-left" id="modalSuccess" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success white">
                        <h4 class="modal-title white" >Messages</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">D'ACCORD</button>
                        <button type="button" class="btn btn-outline-danger d-none">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        class Article {
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
            checkBottleQuantity(quantityTypeVal, contentace) {
                let result = 0;
                if (quantity_bottle > 0 && contentace > 0) {
                    result = quantity_bottle * contentace
                }

                return result;
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
    </script>
    <script>
        const article = new Article();

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
                    const article_type = $("#article_type").val(item.article_type);
                    const category_id = $("#category_id").val(item.category_id);
                    const designation = $("#designation").val(item.designation);
                    const quantity_type = $("#quantity_type").val(item.quantity_type);
                    const quantity_type_value = $("#quantity_type_value").val(item.quantity_type_value);
                    const quantity_bottle = $("#quantity_bottle").val(item.quantity_bottle);
                    const contenance = $("#contenance").val(item.contenance);
                    const unity = $("#unity").val(item.unity);
                    const unit_price = $("#unit_price").val(item.unit_price);
                    const buying_price = $("#buying_price").val(item.buying_price);
                    const wholesale_price = $("#wholesale_price").val(item.wholesale_price);
                    const detail_price = $("#detail_price").val(item.detail_price);

                    $("#addArticle").html(`<span class="material-icons">save</span> Enregister`);
                }
                //console.log(article.items);
                //console.log(item);
            })
        });
    </script>
@endsection
