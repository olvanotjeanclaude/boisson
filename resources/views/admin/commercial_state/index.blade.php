@extends('layouts.app')

@section('vendor')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/custom.css') }}">
@endsection

@section('title')
    Etat Commerciale
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Etat Commericiale',
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

    <!-- Material Data Tables -->
    <section id="material-datatables">
        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <h4 class="card-title"> Etat Commerciale</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            {{-- <a href="{{ route('admin.factures.index') }}"
                                class="btn btn-secondary btn-sm text-capitalize">
                                <span class="material-icons">
                                    inventory
                                </span>
                                toutes les factures
                            </a> --}}
                            <div class="">
                                <span class="dropdown">
                                    <button id="btnSearchDrop1" type="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true"
                                        class="btn btn-warning btn-sm dropdown-toggle dropdown-menu-right"><i
                                            class="ft-download-cloud white"></i></button>
                                    <span aria-labelledby="btnSearchDrop1" class="dropdown-menu mt-1 dropdown-menu-right">
                                        <a href="{{ route('admin.commercialState.index', ['filtrerPar' => 'jour']) }}"
                                            class="dropdown-item ml-1">Jour</a>
                                        <a href="{{ route('admin.commercialState.index', ['filtrerPar' => 'hebdomadaire']) }}"
                                            class="dropdown-item ml-1">Hebdomadaire </a>
                                        <a href="{{ route('admin.commercialState.index', ['filtrerPar' => 'mois']) }}"
                                            class="dropdown-item ml-1">Mensuel</a>
                                        <a href="{{ route('admin.commercialState.index', ['filtrerPar' => 'annuel']) }}"
                                            class="dropdown-item ml-1">Annuel</a>
                                    </span>
                                </span>
                                <button class="btn btn-success btn-sm"><i class="ft-settings white"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <!-- Invoices List table -->
                            @if (count($states))
                                <div class="table-responsive">
                                    <table
                                        class="table datatable table-striped table-hover table-white-space table-bordered  no-wrap icheck table-middle">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>{{ $type }}</th>
                                                <th>Quantity</th>
                                                <th>Entrée (Ariary)</th>
                                                <th>Sorti (Ariary)</th>
                                                <th>Reste (Ariary)</th>
                                                <th>Caisse</th>
                                                <th>Voir</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($states as $state)
                                                <tr>
                                                    <td>{{ $state->formated_date ?? ($state->week_days ?? ($state->formated_month_of_year ?? ($state->year ?? ''))) }}
                                                    </td>
                                                    <td>{{ $state->sum_quantity }}</td>
                                                    <td>{{ formatPrice($state->paid) }}</td>
                                                    <td>{{ formatPrice($state->sum_checkout) }}</td>
                                                    <td>{{ formatPrice($state->rest) }}</td>
                                                    <td>{{ formatPrice($state->amount_received) }}</td>
                                                    <td>
                                                        <a class="btn btn-info" href="{{ $state->url }}">
                                                            <i class="la la-eye"></i>
                                                            Voir
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-danger">
                                    Aucune donnée à afficher
                                </div>
                            @endif

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
