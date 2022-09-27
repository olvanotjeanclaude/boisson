@extends('layouts.app')

@section('title')
    Facture | {{ $entry->invoice_number }}
@endsection

@section('page-css')
    @include('includes.invoice-css')
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Factures',
        'breadcrumbs' => [
            ['text' => 'Facture', 'link' => route('admin.achat-fournisseurs.index')],
            ['text' => 'voir', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => "Nouveau Bon D'Entrée",
            'link' => route('admin.achat-fournisseurs.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => true,
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @include('includes.error')
            @include('includes.success')
        </div>
    </div>

    <div class="row">
        <div class="col-md-10">
            <div>
                <div class="row">
                    <div class="col-12 d-flex">

                        <a target="_blank" href="{{ route('admin.achat-fournisseurs.print', $entry->invoice_number) }}"
                            class="btn btn-info btn-lg  mb-2">
                            Imprimer
                        </a>

                        @can('cancel-doc-vente')
                            <form method="POST" action="{{ route('admin.achat-fournisseurs.cancel', $entry->invoice_number) }}">
                                @method('delete')
                                @csrf
                                <button class="ml-2 btn btn-danger btn-lg  mb-2">
                                    Annuler
                                </button>
                                </a>
                            @endcan
                    </div>
                </div>

                <div class="d-flex justify-content-md-start justify-content-center">
                    @if ($entry)
                        @include('admin.achat-supplier.invoice', [
                            'datas' => $entries,
                            'entry' => $entry,
                            'amount' => $amount,
                            'supplier' => $supplier,
                        ])
                    @else
                        <div class="card">
                            <div class="card-body text-danger">
                                Pas de document a afficher!
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!--End Invoice-->
        </div>
    </div>
@endsection
