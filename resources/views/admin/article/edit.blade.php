@extends('layouts.app')

@section('title')
    {{ Str::title($article->designation) }}
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
            ['text' => 'Editer', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Articles',
            'link' => route('admin.articles.show',$article->id),
            'icon' => '<span class="material-icons">visibility</span>',
            'show' => true,
        ],
    ])
@endsection

@section('content')
    <form preSaveInvoiceUrl="{{ route('admin.article.preSaveInvoiceArticle') }}"
        preSaveArticleUrl="{{ route('admin.article.preSaveArticle') }}" id="addArticleForm"
        action="{{ route('admin.articles.update', $article->id) }}" class="row" method="POST">
        @csrf
        @method("put")
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 mt-1">
                            <label class="text-bold-400 text-dark" for="article_type">Type D'Article</label>
                            <select name="article_type" id="article_type" class="form-control">
                                @foreach (\App\Models\Articles::ARTICLE_TYPES as $key => $value)
                                    <option @if ($article->article_type == $value) selected @endif value="{{ $value }}">
                                        {{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 mt-1">
                            <label class="text-bold-400 text-dark" for="category_id">Famille</label>
                            <select name="category_id" class="form-control" id="category_id">
                                <option value="">Choisir</option>
                                @foreach ($catArticles as $catArticle)
                                    <option @if ($catArticles->contains($article->category_id)) selected @endif
                                        value="{{ $catArticle->id }}">{{ $catArticle->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 col-md-4 mt-1">
                            <label class="text-bold-400 text-dark" for="designation">Designation d'article</label>
                            <input type="text" class="form-control" value="{{ $article->designation }}"
                                placeholder="Designation" id="designation" name="designation">
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
                                        <option @if ($article->quantity_type == $value) selected @endif
                                            value="{{ $value }}">{{ $key }}</option>
                                    @endforeach
                                </select>
                                <input type="number" class="form-control" id="quantity_type_value"
                                    name="quantity_type_value" placeholder="0"
                                    value="{{ $article->quantity_type_value }}">
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 mt-1">
                            <label class="text-bold-400 text-dark" for="contenance">Contenance</label>
                            <input type="number" placeholder="0" value="{{ $article->contenance }}"
                                class="form-control" id="contenance" name="contenance">
                        </div>
                        <div class="col-sm-6 col-md-4 mt-1">
                            <label class="text-bold-400 text-dark" for="quantity_bottle">Quantité Bouitelle</label>
                            <input type="number" class="form-control" value="{{ $article->quantity_bottle }}"
                                placeholder="Qtt Bouteille" id="quantity_bottle" name="quantity_bottle">
                        </div>
                        <div class="col-sm-6 col-md-4 mt-1">
                            <label class="text-bold-400 text-dark" for="unity">Unite</label>
                            <select id="unity" name="unity" class="form-control">
                                @foreach (\App\Models\Articles::UNITS as $key => $value)
                                    <option @if ($article->unity == $value) selected @endif value="{{ $value }}">
                                        {{ $key }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 col-md-4 mt-1">
                            <label class="text-bold-400 text-dark" for="unit_price">Prix Unitaire</label>
                            <input type="text" class="form-control" id="unit_price" value="{{ $article->unit_price }}"
                                name="unit_price" placeholder="0">
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
                                                <input type="text" value="{{ $article->buying_price }}" id="buying_price"
                                                    name="buying_price" class="w-100" placeholder="0 Ariary">
                                            </div>
                                        </div>
                                        <div class="col-sm-5 mt-1 mt-md-0 col-md">
                                            <div class="">
                                                <label style="margin-bottom: .3rem" class="text-bold-400 text-dark"
                                                    for="wholesale_price">Prix De
                                                    Gros
                                                </label>
                                                <input type="text" class="w-100"
                                                    value="{{ $article->wholesale_price }}" id="wholesale_price"
                                                    name="wholesale_price" placeholder="0 Ariary">
                                            </div>
                                        </div>
                                        <div class="col-sm-5 mt-1 mt-md-0 col-md">
                                            <div class="">
                                                <label style="margin-bottom: .3rem" class="text-bold-400 text-dark"
                                                    for="detail_price">Prix
                                                    Détail</label>
                                                <input type="text" value="{{ $article->detail_price }}"
                                                    class="w-100" id="detail_price" name="detail_price"
                                                    placeholder="0 Ariary">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-capitalize">Information du fournisseur</h5>
                    <select name="supplier_id" id="supplier_id" class="form-control">
                        <option value="">Fournisseur </option>
                        @forelse ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" @if ($supplier->id==$article->supplier_id) selected @endif>
                                {{ $supplier->code }}-{{ Str::upper($supplier->identification) }}
                            </option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <button type="submit" id="addArticle" class="btn text-capitalize float-right btn-primary">
                <span class="material-icons">save</span>
                mettre à jour
            </button>
        </div>
    </form>
@endsection
