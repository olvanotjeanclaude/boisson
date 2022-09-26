@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
@endsection

@section('title')
    Bon De Commande
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Achat Fournisseur',
        'breadcrumbs' => [
            ['text' => "Bon D'Entrée", 'link' => route('admin.achat-fournisseurs.index')],
            ['text' => 'Liste', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Nouveau Achat Fournisseur',
            'link' => route('admin.achat-fournisseurs.create'),
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
                        <h4 class="card-title">Bon D'Entrée</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <table class="table datatable  text-nowrap  material-table">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>désignation</th>
                                        <th>Prix D'Achat</th>
                                        <th>Quantité</th>
                                        <th>Date</th>
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
    </section>  
@endsection

@section('page-js')
    @include('includes.datatable.js')
@endsection

@section('script')
    <script>
        loadDatatable();
    </script>
@endsection
