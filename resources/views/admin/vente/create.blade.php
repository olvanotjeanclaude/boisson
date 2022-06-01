@extends('layouts.app')

@section('title')
    Nouveau Vente
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
        'page' => 'Vente',
        'breadcrumbs' => [
            ['text' => 'Ventes', 'link' => route('admin.ventes.index')],
            ['text' => 'Nouveau', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Factures',
            'link' => route('admin.ventes.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => false,
        ],
    ])
@endsection

@section('content')
    <form preSaveInvoiceUrl="{{ route('admin.ventes.preSaveVente') }}"
        preSaveArticleUrl="{{ route('admin.ventes.preSaveInvoiceVente') }}" action="{{ route('admin.ventes.store') }}"
        class="row" id="addVenteForm" method="POST">

        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-capitalize font-weight-bold">Information du client</h5>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="form-group">
                                    <div class="input-group">
                                        <h5 class="mr-2">Nouveau Client?</h5>
                                        <div class="d-inline-block custom-control custom-radio mr-1">
                                            <input type="radio" name="newCustomer" value="1"
                                                class="newCustomer custom-control-input" id="yes">
                                            <label class="custom-control-label" for="yes">Oui</label>
                                        </div>
                                        <div class="d-inline-block custom-control custom-radio">
                                            <input checked type="radio" value="0" name="newCustomer"
                                                class="newCustomer custom-control-input" id="no">
                                            <label class="custom-control-label" for="no">Non</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <select name="customer_id" id="customer_id" class="form-control">
                                <option value="" selected>Client</option>
                                @forelse ($customers as $customer)
                                    <option value="{{ $customer->id }}">
                                        {{ $customer->code }}-{{ Str::upper($customer->identification) }}
                                    </option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="col-12 d-none" id="newCustomerBlock">
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="customer_identification">Identification</label>
                                        <input type="text" id="customer_identification" class="form-control border-primary"
                                            placeholder="identification" name="customer_identification">
                                    </div>
                                </div>
                                {{-- <div class="col-md">
                                    <div class="form-group">
                                        <label for="customer_code">Code</label>
                                        <input type="text" id="customer_code" class="form-control border-primary"
                                            placeholder="   code" name="customer_code">
                                    </div>
                                </div> --}}
                                <div class="col-sm">
                                    <div class="form-group">
                                        <label for="customer_phone">Téléphone</label>
                                        <input type="tel" id="customer_phone" class="form-control border-primary"
                                            placeholder="Numéro De Téléphone" name="customer_phone">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mt-1">
                            <label class="text-bold-400 text-dark" for="article_id">Designation d'article</label>
                            <select name="article_id" class="form-control" id="article_id">
                                <option value="">Choisir</option>
                                @foreach ($articles as $article)
                                    <option value="{{ $article->id }}">
                                        {{ Str::upper($article->reference . '-' . $article->designation) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mt-1">
                            <label class="text-bold-400 text-dark" for="consignation_id">Consignation</label>
                            <select name="consignation_id" class="form-control" id="consignation_id">
                                <option value="">Choisir</option>
                                @foreach ($consignations as $consignation)
                                    <option value="{{ $consignation->id }}">
                                        {{ Str::upper($consignation->reference . '-' . $consignation->designation) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 mt-1">
                            <label class="text-center text-bold-400 text-dark" for="package_type">Emballage
                            </label>
                            <div class="d-flex">
                                <select class="form-control" id="package_type" name="package_type">
                                    <option value="">Choisir</option>
                                    @foreach (\App\Models\Articles::UNITS as $key => $value)
                                        <option value="{{ $value }}">{{ $key }}</option>
                                    @endforeach
                                </select>
                                <input type="number" class="form-control" id="package_type_value"
                                    name="package_type_value" placeholder="0">
                            </div>
                        </div>
                        <div class="col-sm mt-1">
                            <label class="text-bold-400 text-dark" for="package_contenance">Contenance</label>
                            <input type="number" placeholder="0" class="form-control" id="package_contenance"
                                name="package_contenance">
                        </div>
                        <div class="col-sm mt-1">
                            <label class="text-bold-400 text-dark" for="quantity_bottle">Bouteille</label>
                            <input type="number" placeholder="0" class="form-control" id="quantity_bottle"
                                name="quantity_bottle">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group mt-1">
                                <div class="custom-control custom-switch">
                                    <input class="custom-control-input" id="withDeconsignation" name="withDeconsignation"
                                        type="checkbox">
                                    <span class="custom-control-track"></span>
                                    <label class="custom-control-label" for="withDeconsignation">Le client a-t-il apporté un
                                        emballage ?</label>
                                </div>
                            </div>
                            <div class="row d-none" id="deconsignationContainer">
                                <div class="col-12 ">
                                    <label class="text-bold-400 text-dark" for="deconsignation_id">deconsignation</label>
                                    <select name="deconsignation_id" class="form-control" id="deconsignation_id">
                                        <option value="">Choisir</option>
                                        @foreach ($deconsignations as $deconsignation)
                                            <option value="{{ $deconsignation->id }}">
                                                {{ $deconsignation->reference . '-' . Str::upper($deconsignation->designation) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-6 mt-1">
                                    <label class="text-center text-bold-400 text-dark" for="received_package_type">Emballage
                                        Reçu</label>
                                    <div class="d-flex">
                                        <select class="form-control" id="received_package_type"
                                            name="received_package_type">
                                            <option value="">Choisir</option>
                                            @foreach (\App\Models\Articles::UNITS as $key => $value)
                                                <option value="{{ $value }}">{{ $key }}</option>
                                            @endforeach
                                        </select>
                                        <input type="number" class="form-control" id="received_package_type_value"
                                            name="received_package_type_value" placeholder="0">
                                    </div>
                                </div>
                                <div class="col-sm mt-1">
                                    <label class="text-bold-400 text-dark"
                                        for="received_package_contenance">Contenance</label>
                                    <input type="number" placeholder="0" class="form-control"
                                        id="received_package_contenance" name="received_package_contenance">
                                </div>
                                <div class="col-sm mt-1">
                                    <label class="text-bold-400 text-dark" for="Qtt">Bouteille reçu</label>
                                    <input type="number" placeholder="0" class="form-control" id="Qtt"
                                        name="received_bottle">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" id="addArticle" class="btn float-right my-1 btn-primary">
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
                    <div class="col-sm mt-1">
                        <label class="text-bold-400 text-dark" for="Qtt">Note</label>
                        <textarea name="note" id="note" class="form-control" rows="2"></textarea>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="text-capitalize font-weight-bold">Facture</h5>
                    <div id="ajaxPreInvoice">
                        <p class="card-text">La désignation, nombre de bouteille et le total se trouve dans cette
                            zone.
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
                        <h4 class="modal-title white">Messages</h4>
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

@section('page-js')
    <script src="{{ asset('app-assets/js/custom/Achat.js') }}"></script>
    {{-- <script src="{{ asset('app-assets/js/custom/articleController.js') }}"></script> --}}
@endsection


@section('script')
    <script>
        const article = new Achat("#addVenteForm");
        article.initForm();

        $(document).ready(function() {
            $(article.formId).bind("submit", async function(e) {
                e.preventDefault();

                console.log(article);

                const venteForm = $(this);
                const data = venteForm.serializeArray();
                const item = article.serializeItem(data);
                const customer_id = $("#customer_id").val();
                console.log(article);
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

                if (article.preSaveInvoiceUrl) {
                    await axios.post(article.preSaveInvoiceUrl, article.getItems()).then((response) => {
                    
                        $("#ajaxPreInvoice").html(response.data);
                    })
                }

                article.items["customer_id"] = customer_id;
                venteForm[0].reset();

                $("#customer_id").val(customer_id)
                //console.log(article.items)
            });
        })

        $(document).ready(function() {
            $(".newCustomer").click(handleCustomerContainer);
            $("#withDeconsignation").click(handleWithDeconsignation)

        })

        function handleCustomerContainer() {
            const value = $(this).val();
            if (value == "" || value == "1") {
                $("#customer_id").addClass("d-none");
                $("#newCustomerBlock").removeClass("d-none");
            } else {
                $("#customer_id").removeClass("d-none");
                $("#newCustomerBlock").addClass("d-none");
            }
        }

        function handleWithDeconsignation() {
            $("#deconsignationContainer").toggleClass("d-none");
        }
    </script>
@endsection
