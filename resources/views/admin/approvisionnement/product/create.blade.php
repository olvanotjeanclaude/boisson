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
        'page' => 'Produits',
        'breadcrumbs' => [
            ['text' => 'Produits', 'link' => '#'],
            ['text' => 'Articles', 'link' => route('admin.approvisionnement.articles.index')],
            ['text' => 'Nouveau', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Factures',
            'link' => route('admin.articles.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => false,
        ],
    ])
@endsection

@section('content')
    <div class="col-md-11 mx-auto">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            @include('component.alert', [
                'type' => 'success',
                'message' => session('success'),
            ])
        @endif

        <form method="POST" action="{{ route('admin.approvisionnement.articles.store') }}"
            class="form form-horizontal striped-rows form-bordered needs-validation" novalidate>
            @csrf
            <div class="row">
                <div class="col-12">
                    <h4 class="form-section"><i class="la la-clipboard"></i> Nouveau Article</h4>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-sm-6 col-lg-5">
                                            <div class="form-grou">
                                                <label class="label-control" for="designation">Designation</label>
                                                <input type="text" id="designation" required class="form-control"
                                                    placeholder="Nom d’article" value="{{ old('designation') }}"
                                                    name="designation">
                                                <div class="invalid-feedback">
                                                    Entrer la designation
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-4">
                                            <label class="label-control" for="category_id">Famille</label>
                                            <select name="category_id" class="form-control" required id="category_id">
                                                <option value="">Choisir</option>
                                                @foreach ($catArticles as $catArticle)
                                                    <option @if ($catArticle->id == old('category_id')) selected @endif
                                                        value="{{ $catArticle->id }}">
                                                        {{ Str::upper($catArticle->name) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Selectionneez la famille d'article
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-3">
                                            <label class="label-control" for="unity">Unité</label>
                                            <select name="unity" class="form-control" required id="unity">
                                                <option value="">Choisir</option>
                                                @foreach (\App\Models\Articles::UNITS as $key => $val)
                                                    <option @if ($key == old('unity')) selected @endif
                                                        value="{{ $key }}">{{ ucfirst($val) }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Selectionneez l'unité
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-lg-6">
                                            <label class="label-control" for="package_type">Colisage D'Article</label>
                                            <select name="package_type" class="form-control" required id="package_type">
                                                <option value="">Choisir</option>
                                                @foreach (\App\Models\Articles::PackageTypes() as $key => $value)
                                                    <option @if ($key == old('package_type')) selected @endif
                                                        value="{{ $key }}">{{ ucfirst($value) }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Selectionneez la colisage d'article
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-lg-6">
                                            <div class="">
                                                <label class="label-control" for="contenance">Contenance</label>
                                                <input type="number" value="{{ old('contenance') }}" id="contenance"
                                                    class="form-control" placeholder="Contenance" name="contenance">
                                                <div class="invalid-feedback">
                                                    Entrer la contenance
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <div class="form-group">
                                                <label class="label-control" for="note">Note</label>
                                                <textarea id="note" rows="3" class="form-control" name="note" placeholder="Note">{{ old('note') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2 float-right">
                        <i class="la la-check-square-o"></i> Enregister
                    </button>
                </div>

                <div class="col-md-5">
                    <div class="card">
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-6 col-md-12 col-lg-6">
                                            <label class="label-control" for="wholesale_price">Prix De Gros</label>
                                            <input step="0.001" type="number" value="{{ old('wholesale_price') }}"
                                                id="wholesale_price" required class="form-control"
                                                placeholder="Prix De Gros" name="wholesale_price">
                                            <div class="invalid-feedback">
                                                Entrer le prix de gros
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-12 col-lg-6">
                                            <label class="label-control" for="price">Prix Unitaire</label>
                                            <input step="0.01" type="number" value="{{ old('price') }}" id="price"
                                                required class="form-control" placeholder="Prix de vente" name="price">
                                            <div class="invalid-feedback">
                                                Entrer le prix de vente
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="label-control" for="condition">Conditionnement</label>
                                            <input type="number" value="{{ old('condition') }}" id="condition"
                                                class="form-control" placeholder="Conditionnement" name="condition">
                                            <div class="invalid-feedback">
                                                Entrer le conditionnement
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-content collpase show">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="col-12">
                                        <label class="label" for="simple_package">Consignation Simple</label>
                                        <select name="simple_package" class="form-control" id="simple_package">
                                            <option value="">Choisir</option>
                                            @foreach ($emballages as $emballage)
                                                <option @if ($emballage->id == old('simple_package')) selected @endif
                                                    value="{{ $emballage->id }}">
                                                    {{ Str::upper($emballage->designation) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label class="label-control" for="big_package">Consignation De Gros</label>
                                        <select name="big_package" class="form-control" id="big_package">
                                            <option value="">Choisir</option>
                                            @foreach ($emballages as $emballage)
                                                <option @if ($emballage->id == old('big_package')) selected @endif
                                                    value="{{ $emballage->id }}">
                                                    {{ Str::upper($emballage->designation) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
