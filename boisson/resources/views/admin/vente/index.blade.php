@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/custom.css') }}">
@endsection


@section('title')
    JOURNAL DE CAISSE
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'ventes',
        'breadcrumbs' => [
            ['text' => 'Vente', 'link' => route('admin.ventes.index')],
            ['text' => 'Liste', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Nouvelle Vente',
            'link' => route('admin.ventes.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => currentUser()->can('make sale'),
        ],
        // "backButtonUrl" => route('admin.ventes.index')
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
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <!-- Invoices List table -->
                            @include('includes.ajax-table.table', [
                                'dataSrc' => route('admin.ventes.ajaxGetData'),
                                'inputPlaceholder' => 'Reference No Ou Client',
                                'printUrl' => route('admin.sale.print'),
                                'downloadUrl' => route('admin.sale.download'),
                            ])
                            <!--/ Invoices table -->
                        </div>
                    </div>
                    <div class="card-footer">
                        <div id="summary"></div>
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
    <script src="{{asset('mix/js/App/custom-ajax-table.js')}}" type="module"></script>

@endsection
