@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/custom.css') }}">
@endsection

@section('title')
    Vente | {{ $between[0] }}-{{ $between[1] }}
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
            'text' => 'Nouvelle Sortie',
            'link' => route('admin.ventes.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => currentUser()->can('make sale'),
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-md">
            @include('admin.dashboard.sale')
        </div>
    </div>
@endsection

@section('page-js')
    @include('includes.datatable.js')
@endsection

@section('script')
    <script>
        loadDatatable(".datatable", ['copy', 'csv', 'excel', 'pdf']);
    </script>
@endsection
