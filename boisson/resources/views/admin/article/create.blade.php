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
    <script src="{{ asset('app-assets/js/custom/articleController.js') }}"></script>
@endsection
