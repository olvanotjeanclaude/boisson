@extends('layouts.app')

@section('title')
    Nouveau Bon D'Entrée
@endsection


@section('page-css')
    @include('includes.invoice-css')
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
                            <div class="col-sm-8 mt-1 col-article">
                                <label class="text-bold-400 text-dark" for="article_reference">Articles</label>
                                <select name="article_reference" required class="select2 form-control articleBySupplier"
                                    id="article_reference">
                                    <option value=''>Choisir</option>
                                    @foreach ($articles as $article)
                                        <option value='{{ $article->reference }}'
                                            @if ($article->reference == old('article_reference')) selected @endif>{{ $article->designation }}
                                        </option>
                                    @endforeach
                                    @foreach ($emballages as $emballage)
                                        <option value='{{ $emballage->reference }}'
                                            @if ($article->reference == old('article_reference')) selected @endif>{{ $emballage->designation }}
                                        </option>
                                    @endforeach
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
                                    name="quantity" value="{{ old('quantity') }}">
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

            @include('admin.achat-supplier.confirm-order')
        </div>

        <div class="col-md-5">
            @if (count($preInvoices))
                <div class="card">
                    <div class="card-body">
                        @include('admin.achat-supplier.ticket', [
                            'preInvoices' => $preInvoices,
                            'amount' => $amount,
                        ])
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="float-right">
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
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">La désignation, nombre de bouteille et le total se trouve dans cette
                            zone.
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
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
        })
    </script>
@endsection
