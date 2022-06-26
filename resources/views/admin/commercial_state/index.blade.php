@extends('layouts.app')

@section('vendor')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
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
                            <div class="table-responsive">
                                <table
                                    class="table datatable table-striped table-hover table-white-space table-bordered  no-wrap icheck table-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Ref</th>
                                            <th>Designation</th>
                                            <th>Quantity</th>
                                            <th>Prix</th>
                                            <th>Total (Ariary)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($states as $state)
                                            <tr>
                                                <td>{{ format_date($state->received_at) }}</td>
                                                <td>{{ $state->article_type }}</td>
                                                <td>{{ $state->saleable->reference }}</td>
                                                <td>{{ $state->saleable->designation }}</td>
                                                <td>{{ $state->sum_sale }}</td>
                                                <td>{{ formatPrice($state->saleable->price) }}</td>
                                                <td>{{ formatPrice($state->amount) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mt-2 mb-5">
                                <div class="col-12">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td><b>Total En Ariary</b></td>
                                                <td><span class="font-weight-bold">{{ formatPrice($total) }}</span></td>
                                            </tr>
                                            <tr>
                                                <td><b>Total En Fmg</b></td>
                                                <td><span class="font-weight-bold">{{ formatPrice($total * 5) }}</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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
    <script src="{{ asset('app-assets/vendors/js/tables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    {{-- <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}"></script> --}}
@endsection

@section('script')
    <script>
        loadDatatable();
    </script>
@endsection
