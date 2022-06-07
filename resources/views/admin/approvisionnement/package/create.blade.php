@extends('layouts.app')

@section('title')
    Nouveau Packet
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Packages',
        'breadcrumbs' => [
            ['text' => 'Produits', 'link' => "#"],
            ['text' => 'Packages', 'link' => route('admin.approvisionnement.packages.index')],
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
    <div class="container">
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
        <div class="card">
            <div class="card-content collpase show">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.approvisionnement.packages.store') }}"
                        class="form form-horizontal striped-rows form-bordered needs-validation" novalidate>
                        @csrf
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-clipboard"></i> Nouveau Packet</h4>

                            <div class="form-group row mx-auto">
                                <label class="col-md-3 label-control" for="product_id">Articles</label>
                                <div class="col-md-9">
                                    <select name="product_id" class="form-control" required id="product_id">
                                        <option value="">Choisir</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->designation }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Selectionneez l'article
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mx-auto">
                                <label class="col-md-3 label-control" for="category_id">Famille D'article</label>
                                <div class="col-md-9">
                                    <select name="category_id" class="form-control" required id="category_id">
                                        <option value="">Choisir</option>
                                        @foreach ($catArticles as $catArticle)
                                            <option value="{{ $catArticle->id }}">{{ $catArticle->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Selectionneez la famille d'article
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mx-auto">
                                <label class="col-md-3 label-control" for="designation">Designation</label>
                                <div class="col-md-9">
                                    <input type="text" required id="designation" class="form-control"
                                        placeholder="Nom d’article" name="designation">
                                    <div class="invalid-feedback">
                                        Entrer la designation
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mx-auto">
                                <label class="col-md-3 label-control" for="contenance">Contenance</label>
                                <div class="col-md-9">
                                    <input type="number" required id="contenance" class="form-control"
                                        placeholder="Contenance" name="contenance">
                                    <div class="invalid-feedback">
                                        Entrer la contenance
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mx-auto">
                                <label class="col-md-3 label-control" for="price">Prix De vente</label>
                                <div class="col-md-9">
                                    <input type="number" id="price" step="0.001" required class="form-control"
                                        placeholder="Prix de vente" name="price">
                                    <div class="invalid-feedback">
                                        Entrer le prix de vente
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row mx-auto last">
                                <label class="col-md-3 label-control" for="note">Note</label>
                                <div class="col-md-9">
                                    <textarea id="note" rows="3" class="form-control" name="note" placeholder="Note"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions mb-2">
                            <button type="submit" class="btn btn-primary float-right">
                                <i class="la la-check-square-o"></i> Enregister
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
