@extends('layouts.app')

@section('title')
    Nouveau Vente
@endsection

@section('page-css')
    <style>
        table#preInvoice td {
            margin: .4rem auto;
        }

        label {
            margin-bottom: 7px;
        }
    </style>
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
                        <input type="hidden" id="actionType" value="{{ old('article_type') ?? 'avec-consignation' }}"
                            name="article_type">
                        <div class="card-body">
                            <ul class="nav nav-pills">
                                <li class="nav-item">
                                    <a class="nav-link action {{ old('article_type') == 'avec-consignation' ? 'active' : '' }}"
                                        id="base-pill1" data-action="avec-consignation" data-toggle="pill" href="#pill1"
                                        aria-expanded="true">Article Avec Consignation</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link action {{ old('article_type') == 'deconsignation' ? 'active' : '' }}"
                                        id="base-pill2" data-toggle="pill" data-action="deconsignation" href="#pill2"
                                        aria-expanded="false">Deconsignation</a>
                                </li>
                            </ul>
                            <div class="tab-content px-1 pt-1">
                                <div role="tabpanel"
                                    class="tab-pane {{ old('article_type') == 'avec-consignation' ? 'active' : '' }}"
                                    id="pill1" aria-expanded="true" aria-labelledby="base-pill1">
                                    @include('admin.vente.includes.consignation-form')
                                </div>
                                <div class="tab-pane {{ old('article_type') == 'deconsignation' ? 'active' : '' }}"
                                    id="pill2" aria-labelledby="base-pill2">
                                    @include('admin.vente.includes.deconsignation-form')
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
                payment-facture
            </div>
        </div>

        <div class="col-md-5">
            @include('admin.vente.includes.ticket')
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
    </script>
@endsection
