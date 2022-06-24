@extends('layouts.app')

@section('title')
    Nouveau Achat Produit
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
        'page' => 'Achat Produits',
        'breadcrumbs' => [
            ['text' => 'Achat Produits', 'link' => route('admin.achat-produits.index')],
            ['text' => 'List', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Faire Achat',
            'link' => route('admin.achat-produits.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => true,
        ],
    ])
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-7">
            <form novalidate class="needs-validation" action="{{ route('admin.achat-produits.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mt-1">
                                <label class="text-bold-400 text-dark" for="supplier_id">Fournisseur</label>
                                <select required name="supplier_id" id="supplier_id" required class="form-control">
                                    <option value="">Choisir</option>
                                    @forelse ($suppliers as  $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->identification }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <div class="invalid-feedback">
                                    le champ de type d'article ne peut pas être vide
                                </div>
                            </div>

                            <div class="col-12 mt-1">
                                <label class="text-bold-400 text-dark" for="article_type">Type D'Article</label>
                                <select required name="article_type" id="article_type" class="form-control">
                                    @forelse ($articleTypes as $key => $type)
                                        <option value="{{ $key }}">{{ $type }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <div class="invalid-feedback">
                                    le champ de type d'article ne peut pas être vide
                                </div>
                            </div>
                        </div>

                        <div id="withDeconsignationContainer">
                            <div class="row" id="articleContainer">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-8 mt-1 col-article">
                                            <label class="text-bold-400 text-dark" for="article_reference">Articles</label>
                                            <select name="article_reference" class="form-control articleBySupplier"
                                                id="article_reference">
                                                <option value=''>Choisir</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Selectionnez l'article
                                            </div>
                                        </div>

                                        <div class="col-sm-4 mt-1">
                                            <label class="text-bold-400 text-dark" for="quantity">
                                                Quantité
                                            </label>
                                            <input type="number" placeholder="0" class="form-control" id="quantity"
                                                name="quantity">
                                            <div class="invalid-feedback">
                                                Entrer le nombre de bouteiller
                                            </div>
                                        </div>

                                        <div class="col-sm-8 mt-1">
                                            <label class="text-bold-400 text-dark" for="consignation_id">
                                                Consignation
                                            </label>
                                            <select name="consignation_id" class="form-control emballages text-capitalize"
                                                id="consignation_id">
                                                <option value="">Choisir</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Selectionnez la consignation d'article
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mt-1">
                                            <label class="text-bold-400 text-dark" for="consigned_bottle">
                                                Quantité
                                            </label>
                                            <input type="number" placeholder="0" disabled class="form-control"
                                                id="consigned_bottle" name="consigned_bottle">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mt-1">
                                        <div class="custom-control custom-switch">
                                            <input class="custom-control-input" checked id="withBottle" name="withBottle"
                                                type="checkbox">
                                            <span class="custom-control-track"></span>
                                            <label class="custom-control-label" for="withBottle">Le client a-t-il apporté un
                                                emballage ?
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="deconsignationBox">
                                <div class="col-sm-8">
                                    <label class="text-bold-400 text-dark" for="deconsignation_id">
                                        Deconsignatio
                                    </label>
                                    <select name="deconsignation_id" class="form-control emballages text-capitalize"
                                        id="deconsignation_id">
                                        <option value="">Choisir</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="text-bold-400 text-dark" for="received_bottle">
                                            Quantité
                                        </label>
                                        <input type="number" placeholder="0" class="form-control" id="received_bottle"
                                            name="received_bottle">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="noConsignation" class="d-none">
                            <div class="row">
                                <div class="col-sm-8 mt-1 col-article">
                                    <label class="text-bold-400 text-dark" for="no_consign_ref_id">Articles</label>
                                    <select name="no_consign_ref_id" class="form-control articleBySupplier"
                                        id="no_consign_ref_id">
                                        <option value=''>Choisir</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Selectionnez l'article
                                    </div>
                                </div>

                                <div class="col-sm-4 mt-1">
                                    <label class="text-bold-400 text-dark" for="no_consign_quantity">
                                        Quantité
                                    </label>
                                    <input type="number" placeholder="0" class="form-control" id="no_consign_quantity"
                                        name="no_consign_quantity">
                                    <div class="invalid-feedback">
                                        Entrer le nombre de bouteille
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
            </form>

            <div class="card d-none" id="paymentAndFactureContainer">
                <form action="{{ route('admin.achat-produits.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="saveData" value="saveData" id="">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="text-bold-400 text-dark" for="received_at">
                                        Date
                                    </label>
                                    <input type="date" value="{{ date('Y-m-d') }}" class="form-control"
                                        id="received_at" name="received_at">
                                </div>
                            </div>

                            <div class="col-md-7 mt-1">
                                <div class="form-group">
                                    <label for="comment">Commentaire</label>
                                    <textarea name="comment" id="comment" class="form-control" placeholder="Note"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn form-control my-1 border-top text-white btn-secondary">
                                    <i class="la la-save"></i>
                                    Enregistrer
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-capitalize text-right font-weight-bold">Ticket D'Achat</h4>
                    @if (count($preInvoices))
                        <div class="table-responsive">
                            <table class="table p-0 table-sm text-nowrap table-bordered table-striped table-hover">
                                <thead>
                                    <tr class="p-0">
                                        <th>Designation</th>
                                        <th>Prix</th>
                                        <th>Qtt</th>
                                        <th>Sous Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($preInvoices as $preInvoice)
                                        @php
                                            $pricing = $preInvoice->supplier_price;
                                        @endphp
                                        @if ($pricing)
                                            <tr>
                                                <td class="pl-1 py-0 text-capitalize">
                                                    {{ $preInvoice->product->designation }}
                                                </td>
                                                <td class="pl-1 py-0">
                                                    {{ $pricing->buying_price }}
                                                    Ar
                                                </td>
                                                <td class="pl-1 py-0">{{ $preInvoice->quantity }}</td>
                                                <td class="pl-1 py-0">
                                                    {{ formatPrice($preInvoice->sub_amount) }}
                                                </td>
                                                <td class="pl-1 py-0">
                                                    <form method="POST"
                                                        action="{{ route('admin.achat-produits.destroy', $preInvoice->id) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit"
                                                            class="btn btn-outline-accent-1 remove-article">
                                                            <span class="material-icons text-danger">
                                                                remove_circle
                                                            </span>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex mt-1 flex-column align-items-end">
                            <span id="amountToPay" data-amount="{{ $amount }}"></span>
                            <span> {{ number_format($amount, 2, ',', ' ') ?? '0' }} Ar</span>
                            <span> {{ number_format($amount * 5, 2, ',', ' ') ?? '0' }} Fmg</span>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-actions float-right">
                                    <button type="button" id="cancelBtn" class="btn btn-warning d-none mr-1">
                                        <i class="ft-x"></i> Anuller
                                    </button>
                                    <button type="button" id="validFacture" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Enregister
                                    </button>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="card-text">La désignation, nombre de bouteille et le total se trouve dans cette
                            zone.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    {{-- <script src="{{ asset('app-assets/js/custom/articleController.js') }}"></script> --}}
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $("#article_type").change(function() {
                // $(".form-control").prop("required", false);
                $(".invalid-feedback").text("");

                if ($(this).val() == "1") {
                    // validArticle();
                    $("#articleContainer").removeClass("d-none");
                } else if ($(this).val() == "3") {
                    // validDeconsignation();
                    $("#withDeconsignationContainer").removeClass("d-none");

                    $("#withBottle").prop("checked", true);
                    $("#withBottle").prop("disabled", true);
                    $("#noConsignation, #articleContainer").addClass("d-none");
                } else {
                    // validConsignation();
                    $("#noConsignation").removeClass("d-none");

                    $("#withDeconsignationContainer, #articleContainer").addClass("d-none");
                }
            })

            $("#withBottle").change(function() {
                if ($(this).prop("checked")) {
                    $("#deconsignationBox").removeClass("d-none");
                } else {
                    $("#deconsignationBox").addClass("d-none");
                    $("#consigned_bottle").val($("#quantity").val());
                    $("#received_bottle").val(0);
                }
            })

            $("#quantity, #received_bottle").keyup(function() {
                const quantity = $("#quantity").val();
                $("#consigned_bottle").val(quantity);
            });

            $("#validFacture").click(function() {
                $("#addArticle").addClass("d-none");
                $("#paymentAndFactureContainer").removeClass("d-none");
                $(this).removeClass("btn-secondary").addClass("btn-primary");
                $("#cancelBtn").removeClass("d-none");
                $(this).addClass("d-none");
            })

            $("#cancelBtn").click(function() {
                $("#addArticle").removeClass("d-none");
                $("#paymentAndFactureContainer").addClass("d-none");
                $("#validFacture").addClass("btn-secondary").removeClass("btn-primary d-none");
                $(this).addClass("d-none");
            })

            $("#supplier_id").change(getArticleBySupplier);
        })

        function getArticleBySupplier() {
            const suplier_id = $(this).val();
            let articleOptions = "<option value=''>Choisir</option>";
            let emballageOptions = "<option value=''>Choisir</option>";

            $(".articleBySupplier, .emballages").html(articleOptions);

            if (suplier_id) {
                const url = `/api/supplier/${suplier_id}/articles`;
                axios.get(url)
                    .then((response) => {
                        const articles = response.data.articles;
                        const emballages = response.data.emballages;

                        if (articles.length) {
                            articles.forEach(article => {
                                articleOptions +=
                                    `<option value="${article.reference}">${article.designation}</option>`;
                            });
                            $(".articleBySupplier").html(articleOptions);
                        }

                        if (emballages.length) {
                            emballages.forEach(emballage => {
                                emballageOptions +=
                                    `<option value="${emballage.reference}">${emballage.designation}</option>`;
                            });
                            console.log(emballageOptions);
                            $(".emballages").html(emballageOptions);
                        }
                    })
            }
        }

        function validArticle() {
            $("#articleContainer .form-control").prop("required", true);
            $("#articleContainer").removeClass("d-none");
            $("#noConsignation .form-control").prop("required", false);
        }

        function validConsignation() {
            $("#noConsignation .form-control").prop("required", true);
            $("#noConsignation").removeClass("d-none");

            $("#withDeconsignationContainer, #articleContainer").addClass("d-none");
        }

        function validDeconsignation() {
            $("#deconsignationBox .form-control").prop("required", true);
            $("#withDeconsignationContainer").removeClass("d-none");

            $("#withBottle").prop("checked", true);
            $("#withBottle").prop("disabled", true);
            $("#noConsignation, #articleContainer").addClass("d-none");
        }
    </script>
@endsection
