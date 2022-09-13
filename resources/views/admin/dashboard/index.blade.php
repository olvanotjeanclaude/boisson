@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/custom.css') }}">
@endsection

@section('title')
    Dashboard
@endsection

@section('page-css')
    @include('includes.invoice-style')
    <style>
        input.form-control {
            border: none;
        }

        .input-group-text {
            text-align: center;
            min-width: 65px;
        }

        .card-header {
            padding: 10px !important;
        }

        table input[type='search'] {
            background: #eee;
        }
    </style>
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Dashboard',
        'breadcrumbs' => [['text' => 'Recapilatif', 'link' => '#']],
        'actionBtn' => [
            'text' => 'Nouveau Vente',
            'link' => route('admin.ventes.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => true,
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @if (session('success'))
                @include('component.alert', [
                    'type' => 'success',
                    'message' => session('success'),
                ])
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @include('admin.dashboard.filter-component')
        </div>

        <div class="col-xl-8 mt-1">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3 class="text-white">Recapulatif De Vente</h3>
                </div>
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card  bg-success">
                                            <div class="card-body bg-secondary">
                                                <h4 class="text-white">Reçu</h4>
                                                <div class="badge badge-pill badge-white  badge-square">
                                                    <h3 class="text-white">{{ formatPrice($recettes['sum_paid']) }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card  bg-success">
                                            <div class="card-body bg-danger">
                                                <h4 class="text-white">Sortie De Caisse</h4>
                                                <div class="badge badge-pill badge-white  badge-square">
                                                    <h3 class="text-white">{{ formatPrice($recettes['sum_checkout']) }}
                                                    </h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card  bg-success">
                                            <div class="card-body bg-success">
                                                <h4 class="text-white">En Caisse</h4>
                                                <div class="badge badge-pill badge-white  badge-square">
                                                    <h3 class="text-white">{{ formatPrice($recettes['sum_caisse']) }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card  bg-success">
                                            <div class="card-body bg-warning">
                                                <h4 class="text-white">Credit</h4>
                                                <div class="badge badge-pill badge-white  badge-square">
                                                    <h3 class="text-white">{{ formatPrice($recettes['sum_rest']) }}</h3>
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

            <div class="card">
                <div class="card-header bg-secondary">
                    <h3 class="text-white">Recapulatif D'Emballages</h3>
                </div>
                <div class="row px-1">
                    @foreach ($recaps as $recap => $total)
                        <div class="col-sm-4 mt-1">
                            <div class="card border">
                                <div class="card-header">
                                    <h4 class="card-title text-center">{{ $recap }}</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body text-center">
                                        <div class="badge badge-pill badge-secondary badge-square">
                                            {{ $total }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- @include('admin.dashboard.saleAndPayDetail') --}}
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-header bg-dark">
                    <h3 class="text-white">Payment Reçu</h3>
                </div>
                <div class="card-body">
                    @if (count($paymentTypes))
                        <ul class="list-group">
                            @foreach ($paymentTypes as $payName => $value)
                                <a href="#" class="list-group-item list-group-item-action">
                                    {{ $payName }}
                                    <span class="badge badge-primary badge-pill float-right">
                                        {{ $value }}
                                    </span>
                                </a>
                            @endforeach
                        </ul>
                    @else
                        Aucune donnée à afficher
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-dark d-flex justify-content-between">
                    <h3 class="text-white">Facture</h3>
                    @if (count($solds))
                        <a target="_blink"
                            href="{{ route('admin.dashboard.printReport', [
                                'start_date' => $between[0],
                                'end_date' => $between[1],
                                'filter_type' => request()->get('filter_type'),
                            ]) }}"
                            class="btn btn-light">
                            Imprimer
                        </a>
                    @endif
                </div>

                <div style="max-height:350px" class="overflow-auto">
                    <div class="card-body">
                        @if (count($solds))
                            @include('layouts.invoice_table', [
                                'invoices' => [
                                    'datas' => $solds,
                                    'type' => 'saleable',
                                ],
                                'amount' => $recettes['sum_amount'],
                                'rest' => $recettes['sum_rest'],
                                'checkout' => $recettes['sum_checkout'],
                                'paid' => $recettes['sum_paid'],
                                'caisse' => $recettes['sum_caisse'],
                            ])
                        @else
                            Aucune donnée à afficher
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('includes.delete-modal')
@endsection

@section('page-js')
    @include('includes.datatable.js')
@endsection

@section('script')
    {}
    <script>
        loadDatatable(".datatable", ['copy', 'csv', 'excel', 'pdf']);
        $(document).ready(function() {
            $("#filterInvoice").change(function() {
                const startDate = $(".start_date").val();
                const endDate = $(".end_date").val();

                if (startDate && endDate) {
                    $("#filterArticleForm").submit();
                }

            })
        })
    </script>
@endsection
