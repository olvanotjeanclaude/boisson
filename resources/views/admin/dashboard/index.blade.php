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
        'breadcrumbs' => [
            ['text' => 'Recapilatif', 'link' => "#"],
        ],
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
        <div class="col-xl-8">
            <form action="{{ route('admin.index') }}" method="GET">
                <div class="row">
                    <div class="col-sm">
                        <div class="input-group bg-white p-0 m-0">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-white">Debut</span>
                            </div>
                            <input type="date" value="{{ $between[0] }}" class="form-control" name="start_date">
                        </div>
                    </div>
                    <div class="col-sm mt-2 mt-sm-0 d-flex">
                        <div class="input-group bg-white p-0 m-0">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-white">Fin</span>
                            </div>
                            <input type="date" value="{{ $between[1] }}" class="form-control small" name="end_date">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-outline-dark mt-1 mt-sm-0 w-100 h-100">Filtrer</button>
                    </div>
                </div>
            </form>
            <hr>
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3 class="text-white">Recapulatif De Vente</h3>
                </div>
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="row">
                                    @foreach ($recaps as $recap => $total)
                                        <div class="col-sm-6">
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
                            <div class="col-md">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="card  bg-success">
                                            <div class="card-body bg-secondary">
                                                <h4 class="text-white">Reçu</h4>
                                                <div class="badge badge-pill badge-white  badge-square">
                                                    <h3 class="text-white">{{ formatPrice($recettes['sum_paid']) }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="card  bg-success">
                                            <div class="card-body bg-danger">
                                                <h4 class="text-white">Sortie De Caisse</h4>
                                                <div class="badge badge-pill badge-white  badge-square">
                                                    <h3 class="text-white">{{ formatPrice($recettes['sum_checkout']) }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card  bg-success">
                                    <div class="card-body bg-success">
                                        <h4 class="text-white">En Caisse</h4>
                                        <div class="badge badge-pill badge-white  badge-square">
                                            <h3 class="text-white">{{ formatPrice($recettes['sum_caisse']) }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-0">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table datatable table-striped table-hover table-bordered">
                                                <thead class="bg-light">
                                                    <tr class="text-capitalize">
                                                        <th>Désignation</th>
                                                        <th>Quantité</th>
                                                        <th>Payment</th>
                                                        <th>Reçu</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($saleAndPaymentDetails as $sale)
                                                        <tr>
                                                            <td>{{ $sale->designation ?? '-' }}</td>
                                                            <td>{{ $sale->sum_quantity ?? '-' }}</td>
                                                            <td>{{ join(',', $sale->payment_names) ?? '-' }}</td>
                                                            <td>{{ formatPrice($sale->sum_paid) ?? '-' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="mb-2">
                <a href="{{ route('admin.ventes.index') }}" class="btn btn-secondary  text-capitalize">
                    <span class="material-icons">
                        inventory
                    </span>
                    toutes les ventes
                </a>
            </div>

            <div class="card">
                <div class="card-header bg-dark">
                    <h3 class="text-white">Payment Reçu</h3>
                </div>
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
            </div>

            <div class="card">
                <div class="card-header bg-dark d-flex justify-content-between">
                    <h3 class="text-white">Facture</h3>
                    <a target="_blink" href="{{ route('admin.dashboard.printReport', ['start_date' => $between[0], 'end_date' => $between[1]]) }}"
                        class="btn btn-light">
                        Imprimer
                    </a>
                </div>

                <div style="max-height:570px" class="overflow-auto">
                    <div class="card-body">
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
    <script>
        loadDatatable(".datatable", ['copy', 'csv', 'excel', 'pdf']);
    </script>
@endsection
