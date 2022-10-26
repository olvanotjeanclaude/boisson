@extends('layouts.app')

@section('title')
    {{ $pricingSuplier->product->designation }}
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Tarif Fournisseurs',
        'breadcrumbs' => [
            ['text' => 'Tarif Fournisseurs', 'link' => route('admin.tarif-fournisseurs.index')],
            ['text' => 'Editer', 'link' => route('admin.index')],
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
                    <form method="POST" action="{{ route('admin.tarif-fournisseurs.update', $pricingSuplier->id) }}"
                        class="form form-horizontal striped-rows form-bordered needs-validation" novalidate>
                        @csrf
                        @method('put')
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-clipboard"></i>Nouveau Tarif Fournisseur</h4>

                            <div class="form-group row mx-auto">
                                <label class="col-md-3 label-control" for="supplier_id">Fournisseur</label>
                                <div class="col-md-9">
                                    <select name="supplier_id" class="form-control select2" required id="supplier_id">
                                        <option value="">Choisir</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}"
                                                @if ($supplier->id == $pricingSuplier->supplier_id) selected @endif>
                                                {{ $supplier->identification }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Selectionneez le fournisseur
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mx-auto">
                                <label class="col-md-3 label-control" for="article_reference">Articles</label>
                                <div class="col-md-9">
                                    <select name="article_reference" class="form-control select2" required
                                        id="article_reference">
                                        <option value="">Choisir</option>
                                        @foreach ($products as $product)
                                            <option @if($product->reference==$pricingSuplier->article_reference) selected @endif value="{{ $product->reference }}">{{ $product->designation }}</option>
                                        @endforeach

                                        @foreach ($emballages as $emballage)
                                            <option @if($product->reference==$pricingSuplier->article_reference) selected @endif value="{{ $emballage->reference }}">
                                                {{ Str::upper($emballage->designation) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Selectionneez l'article
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mx-auto">
                                <label class="col-md-3 label-control" for="buying_price">Prix D'Achat</label>
                                <div class="col-md-9">
                                    <input type="number" id="buying_price" step="0.001" required class="form-control"
                                        placeholder="Prix d'achat" value="{{ $pricingSuplier->buying_price }}"
                                        name="buying_price">
                                    <div class="invalid-feedback">
                                        Entrer le prix de vente
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mx-auto last">
                                <label class="col-md-3 label-control" for="note">Note</label>
                                <div class="col-md-9">
                                    <textarea id="note" rows="3" class="form-control" name="note" placeholder="Note">{{ $pricingSuplier->note }}</textarea>
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
