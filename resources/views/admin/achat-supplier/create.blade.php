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
        <div class="col-12">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" id="base-pill1" data-toggle="pill" href="#pill1" aria-expanded="true">Manuel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="base-pill2" data-toggle="pill" href="#pill2"
                        aria-expanded="false">Automatique</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="tab-content px-1 pt-1">
                <div role="tabpanel" class="tab-pane active" id="pill1" aria-expanded="true" aria-labelledby="base-pill1">
                    <div class="row">
                        <div class="col-md-7">
                            @include('admin.achat-supplier.include.manual')
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
                                        <p class="card-text">La désignation, nombre de bouteille et le total se trouve dans
                                            cette
                                            zone.
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="pill2"
                    aria-labelledby="base-pill2">
                  @include('admin.achat-supplier.include.auto')
                </div>
            </div>
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
