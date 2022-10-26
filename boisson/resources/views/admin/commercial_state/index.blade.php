@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/custom.css') }}">
@endsection

@section('title')
    Etat Commerciale
@endsection

@section('page-css')
    @include('includes.invoice-css')
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
    </style>
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Etat Commerciale',
        'breadcrumbs' => [
            ['text' => 'Etat Commerciale', 'link' => route('admin.commercialState.index')],
            ['text' => 'List', 'link' => route('admin.commercialState.index')],
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
            <div class="row">
                <div class="col-sm">
                    <div class="input-group bg-white p-0 m-0">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-dark text-white">Debut</span>
                        </div>
                        <input type="date" class="form-control" name="start_date">
                    </div>
                </div>
                <div class="col-sm mt-2 mt-sm-0 d-flex">
                    <div class="input-group bg-white p-0 m-0">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-dark text-white">Fin</span>
                        </div>
                        <input type="date" class="form-control small" name="end_date">
                    </div>
                </div>

                <div class="col-sm-3">
                    <button type="submit" class="btn btn-outline-dark mt-1 mt-sm-0 w-100 h-100">Filtrer</button>
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-header bg-secondary">
                    <h3 class="text-white">Recapulatif De Vente</h3>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    @php
                                        $recaps = ['Entrée' => 10, 'Vendu' => 20, 'Bouteille Consigné' => 30, 'Bouteille Deconsigné' => 25];
                                    @endphp
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
                            <div class="col-md-4">
                                <div class="card  bg-success">
                                    <div class="card-body bg-secondary">
                                        <h1 class="text-white">Vendu</h1>
                                        <div class="badge badge-pill badge-white  badge-square">
                                            <h3 class="text-white">1 000 000 Fmg</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="card  bg-success">
                                    <div class="card-body bg-success">
                                        <h1 class="text-white">En Caisse</h1>
                                        <div class="badge badge-pill badge-white  badge-square">
                                            <h3>1 000 000 Fmg</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                                        <th>Reste</th>
                                                        <th>Reçu</th>
                                                    </tr>
                                                </thead>
                                                <tbody>


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
                <a href="{{ route('admin.factures.index') }}" class="btn btn-secondary  text-capitalize">
                    <span class="material-icons">
                        inventory
                    </span>
                    toutes les factures
                </a>
            </div>

            <div class="card">
                <div class="card-header bg-dark">
                    <h3 class="text-white">Payment</h3>
                </div>
                <ul class="list-group">
                    @foreach ($paymentTypes as $payType)
                        <a href="#" class="list-group-item list-group-item-action">
                            {{ $payType }}
                            <span class="badge badge-primary badge-pill float-right">5</span>
                        </a>
                    @endforeach
                </ul>
            </div>
            <div class="card">
                <div class="card-header bg-dark d-flex justify-content-between">
                    <h3 class="text-white">Facture</h3>
                    <button type="button" class="btn btn-light">Imprimer</button>
                </div>
                @php
                    $invoice = \App\Models\DocumentVente::first();
                @endphp
                @include('admin.vente.includes.invoice-table', [
                    'invoice' => $invoice,
                    'sales' => $invoice->sales,
                    'reste' => 0,
                    'paid' => 0,
                    'amount' => 0,
                ])
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
