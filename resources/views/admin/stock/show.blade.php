@extends('layouts.app')

@section('title')
    {{ Str::title($article->designation) }}
@endsection

@section('page-css')
    <style>
        .card-row:nth-child(odd) {
            /* background: lightgray; */
        }

    </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-callout.css') }}">
@endsection
@section('content-header')
    @include('includes.content-header', [
        'page' => 'Articles',
        'breadcrumbs' => [
            ['text' => 'Articles', 'link' => route('admin.articles.index')],
            ['text' => 'Detail', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'show' => true,
            'icon' => '<span class="material-icons">edit</span>',
            'text' => 'Editer',
            'link' => route('admin.articles.edit', $article->id),
        ],
    ])
@endsection

@section('content')
    <h3 class="mb-2">Detail d'article <b><u>{{ Str::title($article->designation) }}</u></b></h3>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row card-row">
                        <div class="col-6 col-sm-3 mt-1">
                            <div class="">
                                <label class="text-bold-400 text-dark" for="article_type">Type D'Article</label>
                                <p class="card-text mt-1">{{ $article->product_type }}</p>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3 mt-1">
                            <div class="">
                                <label class="text-bold-400 text-dark" for="category_id">Famille</label>
                                <p class="card-text mt-1">{{ $article->category ? $article->category->name : '' }}</p>
                            </div>

                        </div>
                        <div class="col-6 col-sm-3 mt-1">
                            <div>
                                <label class="text-bold-400 text-dark" for="designation">Designation d'article</label>
                                <p class="card-text mt-1">{{ $article->designation }}</p>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3 mt-1">
                            <div>
                                <label class="text-center text-bold-400 text-dark" for="quantity_type">Type</label>
                                <p class="card-text mt-1">{{ $article->product_quantity_type }}</p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row card-row">
                        <div class="col-6 col-sm-3 mt-1">
                            <div class="text-capitalize">
                                <label class="text-center text-bold-400 text-dark" for="quantity_type_value">qtt de
                                    Cag ou cart</label>
                                <p class="card-text mt-1">{{ $article->quantity_type_value }}</p>
                            </div>
                        </div>
                        <div class="col-6 col-sm-3 mt-1">
                            <label class="text-bold-400 text-dark" for="contenance">Contenance</label>
                            <p class="card-text mt-1">{{ $article->contenance }}</p>
                        </div>
                        <div class="col-6 col-sm-3 mt-1">
                            <label class="text-bold-400 text-dark" for="quantity_bottle">Quantité Bouitelle</label>
                            <p class="card-text mt-1">{{ $article->quantity_bottle }}</p>
                        </div>
                        <div class="col-6 col-sm-3 mt-1">
                            <label class="text-bold-400 text-dark" for="unity">Unite</label>
                            <p class="card-text mt-1">{{ $article->product_unity }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row card-row">
                        <div class="col-6 col-sm-3 mt-1">
                            <label class="text-bold-400 text-dark" for="unit_price">Prix Unitaire</label>
                            <p class="card-text mt-1">{{ $article->unit_price }}</p>
                        </div>
                        <div class="col-6 col-sm-3 mt-1">
                            <label class="text-bold-400 text-dark" for="unit_price">Prix d'achat</label>
                            <p class="card-text mt-1">{{ $article->buying_price }}</p>
                        </div>
                        <div class="col-6 col-sm-3 mt-1">
                            <label class="text-bold-400 text-dark">Prix de gros</label>
                            <p class="card-text mt-1">{{ $article->wholesale_price }}</p>
                        </div>
                        <div class="col-6 col-sm-3 mt-1">
                            <label class="text-bold-400 text-dark">Prix Détail</label>
                            <p class="card-text mt-1">{{ $article->detail_price }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md">
            @php
                $supplier = $article->supplier;
            @endphp
            @if ($supplier)
                <div class="card">

                    <div class="card-body">
                        <h4 class=" font-weight-bold">Information Du Fournisseur</h4>

                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="card-title text-bold-600">Nom</h6>
                            </div>
                            <div class="col-md-6">
                                <p> {{ $supplier->name }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="card-title text-bold-600">Identification</h6>
                            </div>
                            <div class="col-md-6">
                                <p> {{ $supplier->identification }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="card-title text-bold-600">Code</h6>
                            </div>
                            <div class="col-md-6">
                                <p> {{ $supplier->code }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="card-title text-bold-600">Téléphone</h6>
                            </div>
                            <div class="col-md-6">
                                <p> {{ $supplier->phone }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="card-title text-bold-600">E-mail</h6>
                            </div>
                            <div class="col-md-6">
                                <p> {{ $supplier->email ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="card-title text-bold-600">Adresse</h6>
                            </div>
                            <div class="col-md-6">
                                <p> {{ $supplier->address ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="bs-callout-info callout-border-left  p-1">
        <strong>Autre Information</strong>
        <ul>
            <li>
                cet article est ajouté par <a href="{{ route('admin.utlisateurs.edit', $article->user_id) }}"
                    class="text-capitalize">{{ $article->user->full_name }}</a> le
                {{ format_date_time($article->created_at) }}.
            </li>
            <li>
                <span class=" text-bold-500">Dernière mise à jour:</span>
                @if ($article->user_update)
                    <span>modifie par
                        <a href="{{ route('admin.utlisateurs.edit', $article->user_id) }}"
                            class="text-capitalize">{{ $article->user_update->full_name }}</a> le
                        {{ format_date_time($article->updated_at) }}</span>
                @else
                    <span> {{ format_date_time($article->updated_at) }}</span>
                @endif
            </li>
        </ul>
    </div>
@endsection
