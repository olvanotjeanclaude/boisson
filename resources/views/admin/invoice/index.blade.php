@extends('layouts.app')

@section('vendor')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/custom.css') }}">
@endsection

@section('title')
    Tous Les Factures
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Factures',
        'breadcrumbs' => [
            ['text' => 'Facture', 'link' => route('admin.articles.index')],
            ['text' => 'List', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Nouveau Article',
            'link' => route('admin.articles.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => false,
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
                        <h4 class="card-title"> Factures</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <div class="d-non">
                                <button type="button" id="deleteIcheckBtn" data-target="#deleteAllModal" data-toggle="modal"
                                    data-url=""
                                    class="btn delete-btn d-none btn-danger btn-sm text-capitalize">
                                    <span class="material-icons">
                                        delete
                                    </span>
                                    Supprimer
                                </button>
                                <span class="dropdown">
                                    <button id="btnSearchDrop1" type="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true"
                                        class="btn btn-warning btn-sm dropdown-toggle dropdown-menu-right"><i
                                            class="ft-download-cloud white"></i></button>
                                    <span aria-labelledby="btnSearchDrop1" class="dropdown-menu mt-1 dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="la la-calendar"></i> Due Date</a>
                                        <a href="#" class="dropdown-item"><i class="la la-random"></i> Priority </a>
                                        <a href="#" class="dropdown-item"><i class="la la-bar-chart"></i> Balance Due</a>
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
                                            <th><input type="checkbox" class="input-chk-all"></th>
                                            <th>Status</th>
                                            <th>Numero</th>
                                            <th>Date D'ajout</th>
                                            <th>ajouté par</th>
                                            <th>Total Article</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($invoices as $item)
                                            @php
                                                $invoice = $item[0];
                                            @endphp
                                            <tr class='text-nowrap' id="row_{{ $invoice['number'] }}">
                                                <td>
                                                    <input type="checkbox" data-id="{{ $invoice['number'] }}"
                                                        class="input-chk">
                                                </td>
                                                <td>{!! $invoice->is_valid_badge !!}</td>
                                                <td>
                                                    <a class="text-bold-600"
                                                        href="{{ route('admin.factures.show', $invoice->number) }}">
                                                        {{ $invoice->number }}
                                                    </a>
                                                </td>
                                                <td>{{ format_date_time($invoice->created_at) }}</td>
                                                <td>{{ $invoice->user->full_name }}</td>
                                                <td>{{ $invoice->articles()->count() }}</td>
                                                <td>
                                                    <span class="dropdown">
                                                        <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="true"
                                                            class="btn btn-primary dropdown-toggle dropdown-menu-right"><i
                                                                class="ft-settings"></i></button>
                                                        <span aria-labelledby="btnSearchDrop2"
                                                            class="dropdown-menu mt-1 dropdown-menu-right">
                                                            <a href="{{ route('admin.factures.show', $invoice['number']) }}"
                                                                class="dropdown-item"><i
                                                                    class="la la-eye"></i>Voir</a>
                                                            <a href="{{ route('admin.factures.edit', $invoice['id']) }}"
                                                                class="dropdown-item"><i class="la la-pencil"></i>
                                                                Editer</a>
                                                            <a href="#" class="dropdown-item"><i
                                                                    class="la la-print"></i> Factures</a>
                                                            <a data-id="{{ $invoice['id'] }}"
                                                                data-url="{{ route('admin.factures.destroy', $invoice['id']) }}"
                                                                class="dropdown-item delete-btn"><i
                                                                    class="la la-trash"></i> Supprimer</a>
                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><input type="checkbox" class="input-chk-all"></th>
                                            <th>Status</th>
                                            <th>Numero</th>
                                            <th>Date D'ajout</th>
                                            <th>ajouté par</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
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
