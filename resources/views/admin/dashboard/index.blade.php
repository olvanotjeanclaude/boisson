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
            'text' => 'Nouvelle Vente',
            'link' => route('admin.ventes.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => currentUser()->can('make sale'),
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
        <br>
        <div class="col-12">
            @include('admin.dashboard.recap-vente')
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            @include('admin.dashboard.payment-methode')
        </div>
        <div class="col-md-6">
            <div class="card bg-primary">
                <div class="card-body">
                    <h4 class="text-white">Total</h4>
                    <div class="badge badge-pill badge-white  badge-square">
                        <h3 class="text-white">{{ formatPrice($solds->sum("sub_amount")) }}
                        </h3>
                    </div>
                </div>
            </div>
            @include('admin.dashboard.recap-emballage')
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-md">
            @include('admin.dashboard.sale')
        </div>
    </div> --}}
@endsection

@section('page-js')
    @include('includes.datatable.js')
@endsection

@section('script')
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
