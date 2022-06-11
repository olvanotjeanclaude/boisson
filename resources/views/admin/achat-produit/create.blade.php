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
            ['text' => 'Nouveau', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Factures',
            'link' => route('admin.achat-produits.index'),
            'icon' => '<span class="material-icons">print</span>',
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
        <div class="col-12">
            @if (session('success'))
                @include('component.alert', [
                    'type' => 'success',
                    'message' => session('success'),
                ])
            @endif
        </div>
    </div>

    <div class="row mb-5">
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

                            <div class="col-12 mt-1">
                                <label class="text-bold-400 text-dark" for="quantity">Quantité </label>
                                <input type="number" class="form-control" placeholder="Qtt" required id="quantity"
                                    name="quantity" required>
                                <div class="invalid-feedback">
                                    Entrer la quantité
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
            </form>
            <form action="{{ route('admin.achat-produits.store') }}" class="needs-validation" novalidate method="POST">
                @csrf
                <div class="card d-none" id="paymentAndFactureContainer">
                    <input type="hidden" name="saveData" value="saveData" id="">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 mt-1">
                                <label class="text-bold-400 text-dark" for="supplier_id">Fournisseur</label>
                                <select name="supplier_id" required id="supplier_id" class="form-control">
                                    <option value="">Fournisseur</option>
                                    @forelse ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">
                                            {{ $supplier->code }}-{{ Str::upper($supplier->identification) }}
                                        </option>
                                    @empty
                                    @endforelse
                                </select>
                                <div class="invalid-feedback">
                                    Selectionner le fournisseur
                                </div>
                            </div>
                            <div class="col-sm-6 mt-1">
                                <div class="form-group">
                                    <label class="text-bold-400 text-dark" for="received_at">
                                        Date De Payment
                                    </label>
                                    <input type="date" id="received_at" name="received_at" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6 mt-1">
                                <div class="form-group">
                                    <label class="text-bold-400 text-dark" for="payment_type">Type De Payment</label>
                                    <select name="payment_type" class="form-control" required id="payment_type">
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
                            <div class="col-sm-6 mt-1">
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

                            <div class="col-md-8 mt-1">
                                <div class="form-group">
                                    <label class="text-bold-400 text-dark" for="comment">
                                        Commentaire
                                    </label>
                                    <textarea name="comment" id="comment" class="form-control" rows="1"></textarea>
                                </div>
                            </div>
                            <div class="col-md-4 mt-1">
                                <div class="form-group">
                                    <label class="text-bold-400 text-dark" for="rest">
                                        Reste À Payer
                                    </label>
                                    <h4 class=""><span id="rest">0.00</span> Ariary</h4>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" id="saveData"
                                    class="btn form-control my-1 border-top text-white btn-secondary">
                                    <i class="la la-save"></i>
                                    Enregistrer
                                </button>
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
                                            <td class="pl-1 py-0 text-capitalize">
                                                {{ $preInvoice->stockable->designation }}</td>
                                            <td class="pl-1 py-0">{{ $preInvoice->buying_price }}
                                                Ar</td>
                                            <td class="pl-1 py-0">{{ $preInvoice->quantity }}</td>
                                            <td class="pl-1 py-0">
                                                {{ number_format($preInvoice->pre_sub_amount, 2, ',', ' ') ?? '0' }} Ar
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
                            <span id="amountToPay" data-amount="{{ $amount }}"></span>
                            <span> {{ number_format($amount, 2, ',', ' ') ?? '0' }} Ariary</span>
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
                        <p class="card-text">La désignation, nombre de bouteille et le total se trouve dans cette zone.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-js')
    <script src="{{ asset('app-assets/js/custom/articleController.js') }}"></script>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#buying_price, #quantity, #total_paid").keyup(function() {
                const buying_price = $("#buying_price").val();
                const quantity = $("#quantity").val();
                const total_paid = $("#total_paid").val();

                const sub_amount = buying_price * quantity;

                $("#sub_amount").val(buying_price * quantity);
                $("#debt").val(sub_amount - total_paid);
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

            $("#paid").keyup(function() {
                const paid = $(this).val();
                let rest = "0.00";
                let amount = $("#amountToPay").data("amount");

                if (paid && amount) {
                    rest = amount - paid;
                }

                $("#rest").html(rest);
            })
        })
    </script>
@endsection
