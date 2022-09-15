@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/custom.css') }}">
@endsection


@section('title')
    Liste De ventes
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'ventes',
        'breadcrumbs' => [
            ['text' => 'Vente', 'link' => route('admin.ventes.index')],
            ['text' => 'List', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Nouvelle Vente',
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

    <!-- Material Data Tables -->
    <section id="material-datatables">
        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <h4 class="card-title"> Liste De ventes</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <button type="button" id="deleteIcheckBtn" data-target="#deleteAllModal" data-toggle="modal"
                                data-url="{{ route('admin.ventes.destroy', ['vente' => 'item']) }}"
                                class="btn delete-btn d-none btn-danger btn-sm text-capitalize">
                                <span class="material-icons">
                                    delete
                                </span>
                                Supprimer
                            </button>
                            {{-- <a href="{{ route('admin.factures.index') }}"
                                class="btn btn-secondary btn-sm text-capitalize">
                                <span class="material-icons">
                                    inventory
                                </span>
                                toutes les factures
                            </a> --}}
                            <div class="d-none">
                                <span class="dropdown">
                                    <button id="btnSearchDrop1" type="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true"
                                        class="btn btn-warning btn-sm dropdown-toggle dropdown-menu-right"><i
                                            class="ft-download-cloud white"></i></button>
                                    <span aria-labelledby="btnSearchDrop1" class="dropdown-menu mt-1 dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="la la-calendar"></i> Due Date</a>
                                        <a href="#" class="dropdown-item"><i class="la la-random"></i> Priority </a>
                                        <a href="#" class="dropdown-item"><i class="la la-bar-chart"></i> Balance
                                            Due</a>
                                        <a href="#" class="dropdown-item"><i class="la la-user"></i> Assign to</a>
                                    </span>
                                </span>
                                <button class="btn btn-success btn-sm"><i class="ft-settings white"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <!-- Invoices List table -->
                             <p class="loa">Chargement...</p>
                             <div class="table-responsive">
                                <table
                                    class="table datatable table-striped table-hover table-white-space table-bordered  no-wrap icheck table-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Status</th>
                                            <th>Numero</th>
                                            <th>Client</th>
                                            <th>Code du Client</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($docSales as $sale)
                                            <tr id="row_{{ $sale->number }}">
                                                <td>{!! $sale->status_html !!}</td>
                                                <td>{{ $sale->number }}</td>
                                                <td>{{ Str::upper($sale->customer->identification) }}</td>
                                                <td>{{ $sale->customer->cl_code }}</td>
                                                <td>{{ format_date_time($sale->received_at) }}</td>

                                                <td>
                                                    <span class="dropdown">
                                                        <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="true"
                                                            class="btn btn-primary dropdown-toggle dropdown-menu-right"><i
                                                                class="ft-settings"></i></button>
                                                        <span aria-labelledby="btnSearchDrop2"
                                                            class="dropdown-menu mt-1 dropdown-menu-right">
                                                            {{-- <a href="{{ route('admin.achat-produits.show', $invoice['id']) }}"
                                                            class="dropdown-item"><i
                                                                class="la la-eye"></i>Voir</a> --}}
                                                            {{-- <a href="{{ route('admin.achat-produits.edit', $sale['id']) }}"
                                                            class="dropdown-item"><i class="la la-pencil"></i>
                                                            Editer</a> --}}
                                                            <a href="{{ route('admin.print.sale.download', $sale->number) }}"
                                                                class="dropdown-item">
                                                                <i class="la la-download"></i>
                                                                Telecharger
                                                            </a>
                                                            <a href="{{ route('admin.print.sale', $sale->number) }}"
                                                                class="dropdown-item">
                                                                <i class="la la-print"></i>
                                                                Factures
                                                            </a>
                                                            @can('makePayment', \App\Models\DocumentVente::class)
                                                                <a href="{{ route('admin.sale.paymentForm', $sale->number) }}"
                                                                    class="dropdown-item">
                                                                    <i class="la la-credit-card"></i>
                                                                    Payment
                                                                </a>
                                                            @endcan

                                                            @can('delete', $sale)
                                                                <a data-id="{{ $sale['number'] }}"
                                                                    data-url="{{ route('admin.ventes.destroy', ['vente' => $sale['number'], 'invoice' => true]) }}"
                                                                    class="dropdown-item delete-btn"><i class="la la-trash"></i>
                                                                    Supprimer
                                                                </a>
                                                            @endcan

                                                        </span>
                                                    </span>
                                                </td>

                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!--/ Invoices table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
