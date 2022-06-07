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
        'page' => 'Achat Produits',
        'breadcrumbs' => [
            ['text' => 'Achat Produits', 'link' => route('admin.achat-produits.index')],
            ['text' => 'List', 'link' => route('admin.index')],
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
        action="{{ route('admin.articles.store') }}" class="row needs-validation" novalidate method="POST">

        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mt-1">
                            <label class="text-bold-400 text-dark" for="article_type">Type D'Article</label>
                            <select name="article_type" id="article_type" class="form-control" required>
                                <option value="">Choisir</option>
                                <option value="1">Article</option>
                                <option value="2">Emballage</option>
                                <option value="3">Groupe D'Article</option>
                            </select>
                            <div class="invalid-feedback">
                                le champ de type d'article ne peut pas être vide
                            </div>
                        </div>
                        <div class="col-sm-6 mt-1">
                            <label class="text-bold-400 text-dark" for="category_id">Famille</label>
                            <select name="category_id" class="form-control" required id="category_id">
                                <option value="">Choisir</option>
                                @foreach ($catArticles as $catArticle)
                                    <option value="{{ $catArticle->id }}">{{ $catArticle->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Selectionnez la famille d'article
                            </div>
                        </div>
                        <div class="col-12 mt-1">
                            <label class="text-bold-400 text-dark" for="article_id">Articles</label>
                            <select name="article_id" class="form-control" required id="article_id">
                                <option value=''>Choisir</option>
                            </select>
                            <div class="invalid-feedback">
                                Selectionnez l'article
                            </div>
                        </div>

                        {{-- <div class="col-md-3 mt-1">
                            <label class="text-bold-400 text-dark" for="price">Prix De Vente</label>
                            <input type="number" placeholder="0" class="form-control" id="price" name="price" readonly>
                        </div> --}}

                        <div class="col-12 mt-1">
                            <label class="text-bold-400 text-dark" for="quantity">Quantité A Acheter</label>
                            <input type="number" class="form-control" placeholder="Qtt" required id="quantity"
                                name="quantity" required>
                            <div class="invalid-feedback">
                                Entrer la quantité à acheter
                            </div>
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
                                                <input type="number" required step="0.001" id="buying_price"
                                                    name="buying_price" class="form-control bg-white" placeholder="0 Ariary">
                                                <div class="invalid-feedback">
                                                    Entrer le prix d'achat
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 mt-1 mt-md-0 col-md">
                                            <div class="">
                                                <label style="margin-bottom: .3rem" class="text-bold-400 text-dark"
                                                    for="sub_amount">Prix
                                                    Sous total
                                                </label>
                                                <input type="number" step="0.001" disabled  class="form-control bg-white"
                                                    id="sub_amount" name="sub_amount" placeholder="0 Ariary">
                                            </div>
                                        </div>
                                        <div class="col-sm-5 mt-1 mt-md-0 col-md">
                                            <div class="">
                                                <label style="margin-bottom: .3rem" class="text-bold-400 text-dark"
                                                    for="total_paid">
                                                    Payé/dépense
                                                </label>
                                                <input type="number" step="0.001"  class="form-control bg-white" required id="total_paid"
                                                    name="total_paid" placeholder="0 Ariary">
                                                    <div class="invalid-feedback">
                                                        Entrer le montant
                                                     </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="float-right">
                                <label class="text-bold-400 text-dark" for="debt">Reste À Payer</label>
                                <br>
                                <input type="number" step="0.001" name="debt" id="debt" value="0" placeholder="0 Ariary"
                                    disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-1">
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
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#article_type").change(async function() {
                const articleType = $(this).val();
                if (articleType) {
                    const response = await axios.get(`/api/get-articles/${articleType}`, {
                            articleType
                        })
                        .then(response => {
                            let options = "<option value=''>Choisir</option>";
                            const data = response.data;
                            if (data.length) {
                                data.forEach(option => {
                                    options +=
                                        `<option value='${option.reference}'>
                                            ${option.reference}-${option.designation}
                                        </option>`;
                                });
                            }

                            $("#article_id").html(options);
                        })
                        .catch(error => {
                            console.log(error);
                            return error;
                        });
                } else {
                    $("#article_id").html("<option value=''>Choisir</option>");
                    alert("Selectionnez le type d'article")
                }
            })
        })

        $("#buying_price, #quantity, #total_paid").keyup(function() {
            const buying_price = $("#buying_price").val();
            const quantity = $("#quantity").val();
            const total_paid = $("#total_paid").val();

            const sub_amount = buying_price * quantity;

            $("#sub_amount").val(buying_price * quantity);
            $("#debt").val(sub_amount - total_paid);
        });
    </script>
@endsection
