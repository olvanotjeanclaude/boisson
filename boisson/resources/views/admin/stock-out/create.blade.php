@extends('layouts.app')

@section('title')
    Nouveau Stock
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
        'page' => 'Stocks',
        'breadcrumbs' => [
            ['text' => 'Stocks', 'link' => route('admin.stocks.index')],
            ['text' => 'List', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Nouveu Stock',
            'link' => route('admin.stocks.create'),
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
            <form novalidate class="needs-validation" action="{{ route('admin.sorti-stocks.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label class="text-bold-400 text-dark mb-1" for="article_reference">Articles</label>
                            <select name="article_reference" required class="select2 form-control" id="article_reference">
                                <option value=''>Choisir</option>
                                @foreach ($articles as $article)
                                    <option @if ($article->reference == old('article_reference')) selected @endif
                                        value="{{ $article->reference }}">{{ $article->designation }}</option>
                                @endforeach
                                @foreach ($emballages as $emballage)
                                    <option @if ($emballage->reference == old('article_reference')) selected @endif
                                        value="{{ $emballage->reference }}">{{ $emballage->designation }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Selectionnez l'article
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="text-bold-400 text-dark" for="out">
                                Quantité
                            </label>
                            <input type="number" placeholder="Quantité" value="{{ old('out') }}" class="form-control" required
                                id="out" name="out">
                            <div class="invalid-feedback">
                                Entrer le quantité
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="text-bold-400 text-dark" for="date">
                                Date
                            </label>
                            <input type="date" placeholder="0" value="{{ old('date') ?? date('Y-m-d') }}"
                                class="form-control" required id="date" name="date">
                            <div class="invalid-feedback">
                                Entrer le date
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="text-bold-400 text-dark" for="comment">
                                comment
                            </label>
                            <textarea name="comment" placeholder="Ecrire..." class="form-control" id="comment" required>{{ old('comment') }}</textarea>
                            <div class="invalid-feedback">
                                Entrer le motif
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
        </div>
    </div>
@endsection
