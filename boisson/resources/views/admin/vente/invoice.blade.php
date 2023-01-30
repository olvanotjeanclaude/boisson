@extends('layouts.app')

@section('title')
    Facture Vente
@endsection

@section('page-css')
    @include('includes.invoice-css')
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Factures',
        'breadcrumbs' => [
            ['text' => 'Facture', 'link' => route('admin.ventes.index')],
            ['text' => 'Validation Et Impression', 'link' => route('admin.index')],
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
            @include('includes.error')
            @include('includes.success')
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3 col-xl-2">
            <div class="d-flex flex-row flex-wrap justify-content-center flex-sm-column">
                <a href="{{ route('admin.ventes.index') }}"
                    class="ml-1 btn btn-dark btn-lg  mb-2">
                    <i class="la la-arrow-left"></i>
                    Retour
                </a>

                <a href="{{ route('admin.sale.paymentForm', $invoice->number) }}"
                    class="ml-1 btn btn-primary btn-lg  mb-2">
                    <i class=" la la-credit-card"></i>
                    Payment
                </a>

                <a target="_blank" href="{{ route('admin.print.sale.preview', $invoice->number) }}"
                    class="ml-1 btn btn-info btn-lg  mb-2">
                    <i class=" la la-print"></i>
                    Imprimer
                </a>

                @if ($invoice->status == App\helper\Invoice::STATUS['no_printed'])
                    <a href="{{ route('admin.print.sale.terminate', $invoice->number) }}"
                        class="ml-1 btn btn-success btn-lg  mb-2">
                        <i class=" la la-save"></i>
                        Enregistrer
                    </a>
                @endif

                @can('cancel-doc-vente', $invoice)
                    <a href="{{ route('admin.print.sale.cancel', $invoice->number) }}"
                        class="ml-1 btn btn-danger btn-lg  mb-2">
                        <i class=" la la-close"></i>
                        Annuler
                    </a>
                @endcan
            </div>
        </div>

        <div class="col-sm col-md col-lg-6 col-xl-5">
            @if ($invoice)
                @include('admin.vente.includes.invoice-table', [
                    'invoice' => $invoice,
                    'sales' => $invoice->sales,
                    'reste' => $rest,
                    'paid' => $paid,
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
@endsection
