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
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif
    <div class="row">
        <div class="col-sm-6 col-lg-7">
            <form id="addArticleForm" action="{{ route('admin.achat-produits.store') }}" class="needs-validation"
                novalidate method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 mt-1">
                                <label class="text-bold-400 text-dark" for="article_type">Type D'Article</label>
                                <select name="article_type" id="article_type" class="form-control" required>
                                    <option value="">Choisir</option>
                                    @forelse (\App\Models\Stock::ARTICLE_TYPES as $key => $type)
                                        <option value="{{ $key }}">{{ $type }}</option>
                                    @empty
                                    @endforelse
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
                                <label class="text-bold-400 text-dark" for="article_reference">Articles</label>
                                <select name="article_reference" class="form-control" required id="article_reference">
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
                                            <div class="col-sm mt-1 mt-md-0 col-md">
                                                <div class="">
                                                    <label style="margin-bottom: .3rem" class="text-bold-400 text-dark"
                                                        for="buying_price">Prix
                                                        D'Achat</label>
                                                    <input type="number" required step="0.001" id="buying_price"
                                                        name="buying_price" class="form-control bg-white"
                                                        placeholder="0 Ariary">
                                                    <div class="invalid-feedback">
                                                        Entrer le prix d'achat
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm mt-1 mt-md-0 col-md">
                                                <div class="">
                                                    <label style="margin-bottom: .3rem" class="text-bold-400 text-dark"
                                                        for="sub_amount">Prix
                                                        Sous total
                                                    </label>
                                                    <input type="number" step="0.001" disabled class="form-control bg-white"
                                                        id="sub_amount" placeholder="0 Ariary">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="col-12">
                                <div class="float-right">
                                    <label class="text-bold-400 text-dark" for="debt">Reste À Payer</label>
                                    <br>
                                    <input type="number" step="0.001" name="debt" id="debt" value="0" placeholder="0 Ariary"
                                        disabled>
                                </div>
                            </div> --}}
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
                <div class="card d-none">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm mt-1">
                                <div class="form-group">
                                    <label class="text-bold-400 text-dark" for="payment_type">Type De Payment</label>
                                    <select name="payment_type" class="form-control" id="payment_type">
                                        <option value=''>Choisir</option>
                                        @forelse (\App\Models\DocumentAchat::PAYMENT_TYPES as $key => $val)
                                            <option value="{{ $key }}">{{ $val }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <div class="invalid-feedback">
                                        Selectionnez le type de payment
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm mt-1">
                                <div class="form-group">
                                    <label class="text-bold-400 text-dark" for="paid">
                                        Payé/dépense
                                    </label>
                                    <input type="number" step="0.001" id="paid" name="paid" class="form-control"
                                        placeholder="0 Ariary">
                                    <div class="invalid-feedback">
                                        Entrer le prix d'achat
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm mt-1">
                                <div class="form-group">
                                    <label class="text-bold-400 text-dark" for="rest">
                                        Reste À Payer
                                    </label>
                                    <input type="number" step="0.001" id="rest" disabled name="rest" class="form-control"
                                        placeholder="0 Ariary">
                                    <div class="invalid-feedback">
                                        Entrer le prix d'achat
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-sm-6 col-lg-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-capitalize text-right font-weight-bold">Facture D'Achat Fournisseur</h4>
                    @if (count($preInvoices))
                        <div class="row d-none">
                            @foreach ($preInvoices as $preInvoice)
                                <div class="col-5 bg-danger">
                                    {{ $preInvoice->stockable->designation }}
                                </div>
                                <div class="col">
                                   {{  $preInvoice->buying_price }} Ar
                                </div>
                                <div class="col">
                                   {{  $preInvoice->quantity }}
                                </div>
                                <div class="col">
                                 {{ number_format($preInvoice->pre_sub_amount, 2, ',', ' ') ?? '0' }} Ar
                                </div>
                                <div class="col">
                                    12345
                                </div>
                            @endforeach
                        </div>
                        <div class="table-responsive d-non">
                            <table class="table p-0 table-sm text-nowrap table-bordered table-striped table-hover">
                                <thead>
                                    <tr class="p-0">
                                        <th>Designation</th>
                                        <th>PA</th>
                                        <th>Qtt</th>
                                        <th>Sous Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($preInvoices as $preInvoice)
                                        <tr>
                                            <td class="pl-1 py-0 text-capitalize">{{ $preInvoice->stockable->designation }}</td>
                                            <td class="pl-1 py-0">{{ $preInvoice->buying_price }}
                                                Ar</td>
                                            <td class="pl-1 py-0">{{ $preInvoice->quantity }}</td>
                                            <td class="pl-1 py-0">{{ number_format($preInvoice->pre_sub_amount, 2, ',', ' ') ?? '0' }} Ar
                                            </td>
                                            <td class="pl-1 py-0">
                                                <form method="POST"
                                                    action="{{ route('admin.achat-produits.destroy', $preInvoice->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-outline-accent-1 remove-article">
                                                        <span class="material-icons text-danger">
                                                            remove_circle
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex mt-1 flex-column align-items-end">
                            <span> {{ number_format($amount, 2, ',', ' ') ?? '0' }} Ariary</span>
                            <span> {{ number_format($amount * 5, 2, ',', ' ') ?? '0' }} Ariary</span>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="button" id="validFacture"
                                    class="btn form-control my-1 border-top text-white btn-secondary">
                                    <i class="la la-save"></i>
                                    Enregistrer
                                </button>
                            </div>
                        </div>
                    @else
                        <p class="card-text">La désignation, nombre de bouteille et le total se trouve dans cette zone.
                        </p>
                    @endif
                </div>
            </div>
            <div class="card d-none">
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
        </div>
    </div>

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

                            $("#article_reference").html(options);
                        })
                        .catch(error => {
                            console.log(error);
                            return error;
                        });
                } else {
                    $("#article_reference").html("<option value=''>Choisir</option>");
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
