@extends('layouts.app')

@section('title')
    Nouveau Vente
@endsection

@section('page-css')
    @include('includes.invoice-css')
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Vente',
        'breadcrumbs' => [
            ['text' => 'Ventes', 'link' => route('admin.ventes.index')],
            ['text' => 'Nouveau', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Factures',
            'link' => route('admin.ventes.create'),
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
            <div class="card">
                <div class="card-content">
                    <form novalidate class="needs-validation" action="{{ route('admin.ventes.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8 mt-1 col-article">
                                    <label class="text-bold-400 label-control text-dark" for="article_reference">Articles</label>
                                    <select name="article_reference" required class="form-control select2" id="article_reference">
                                        <option value=''>Choisir</option>
                                        @foreach ($articles as $article)
                                            <option @if ($article->reference == old('article_reference')) selected @endif value="{{ $article->reference }}">
                                                {{ $article->designation }}</option>
                                        @endforeach
                                        @foreach ($consignations as $article)
                                            <option @if ($article->reference == old('article_reference')) selected @endif value="{{ $article->reference }}">
                                                {{ $article->designation }}</option>
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
                                    <input type="number" step="0.01" required placeholder="0" min="1" value="{{ old('quantity') }}" class="form-control"
                                        id="quantity" name="quantity">
                                    <div class="invalid-feedback">
                                        Entrer le nombre de bouteille
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="addArticle" class="btn float-right m-1 btn-primary">
                            <span class="material-icons">add</span>
                            Ajouter
                        </button>
                    </form>
                </div>
            </div>

            <div class="card d-none" id="paymentAndFactureContainer">
                @include('admin.vente.includes.payment-facture')
            </div>
        </div>

        <div class="col-md-5">
            @if (count($preInvoices))
                <div class="card overflow-auto pb-2" style="max-height: 530px">
                    <div class="card-body">
                        @include('admin.vente.includes.ticket')
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
        if (!$(".action").hasClass('active')) {
            $(".action").first().addClass("active");
        }

        if (!$(".tab-pane").hasClass('active')) {
            $(".tab-pane").first().addClass("active");
        }

        $("#withBottle").change(function() {
            if ($(this).prop("checked")) {
                $("#deconsignationBox").removeClass("d-none");
            } else {
                $("#deconsignationBox").addClass("d-none");
            }
        })

        $(".action").click(function() {
            $("#actionType").val($(this).data("action"));
        })

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

        $(".newCustomer").click(function() {
            if ($(this).val() == "1") {
                $("#newCustomerBlock").removeClass("d-none");
                $("#customerBlock").addClass("d-none");
            } else {
                $("#customerBlock").removeClass("d-none");
                $("#newCustomerBlock").addClass("d-none");
            }
        })
    </script>
@endsection
