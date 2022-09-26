@extends('layouts.app')

@section('title')
    Nouveau Bon D'Entrée
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
        'page' => 'Achat Fournisseur',
        'breadcrumbs' => [
            ['text' => "Bon D'Entrée", 'link' => route('admin.achat-fournisseurs.index')],
            ['text' => 'Nouveau', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Nouveau Achat Fournisseur',
            'link' => route('admin.achat-fournisseurs.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => false,
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
            <form novalidate class="needs-validation" action="{{ route('admin.achat-fournisseurs.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mt-1">
                                <label class="text-bold-400 text-dark" for="supplier_id">Fournisseur</label>
                                <select required name="supplier_id" id="supplier_id" required class="select2 form-control">
                                    <option value="">Choisir</option>
                                    @forelse ($suppliers as  $supplier)
                                        <option @if ($firstAchat && $firstAchat->supplier_id == $supplier->id) selected @endif
                                            value="{{ $supplier->id }}">{{ $supplier->identification }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <div class="invalid-feedback">
                                    le fournisseur ne peut pas être vide
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-8 mt-1 col-article">
                                <label class="text-bold-400 text-dark" for="article_reference">Articles</label>
                                <select name="article_reference" required class="select2 form-control articleBySupplier"
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
                                <input type="number" placeholder="0" class="form-control" required id="quantity"
                                    name="quantity">
                                <div class="invalid-feedback">
                                    Entrer le nombre de bouteille
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
                                    <input type="date" value="{{ date('Y-m-d') }}" class="form-control" id="received_at"
                                        name="received_at">
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
                                    Valider
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
                                        <td>Designation</td>
                                        <td>Prix</td>
                                        <td>Qtt</td>
                                        <td>Sous Total</td>
                                        <td></td>
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
                                                    {{ $preInvoice->stockable->designation }}
                                                </td>
                                                <td class="pl-1 py-0">
                                                    {{ $pricing->buying_price }}
                                                    Ar
                                                </td>
                                                <td class="pl-1 py-0">{{ $preInvoice->entry }}</td>
                                                <td class="pl-1 py-0">
                                                    {{ formatPrice($preInvoice->sub_amount) }}
                                                </td>
                                                <td class="pl-1 py-0">
                                                    <form method="POST"
                                                        action="{{ route('admin.achat-fournisseurs.destroy', $preInvoice->id) }}">
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
            $("#supplier_id").change(getArticleBySupplier);
            $("#supplier_id").trigger("change");
        })

        function getArticleBySupplier() {
            const suplier_id = $(this).val();
            let articleOptions = "<option value=''>Choisir</option>";

            $(".articleBySupplier").html(articleOptions);

            if (suplier_id) {
                const url = `/api/supplier/${suplier_id}/articles`;
                axios.get(url)
                    .then((response) => {
                        const articles = response.data;

                        if (articles.length) {
                            articles.forEach(article => {
                                articleOptions +=
                                    `<option value="${article.reference}">${article.designation}</option>`;
                            });
                            $(".articleBySupplier").html(articleOptions);
                        }
                    })
            }
        }
    </script>
@endsection
