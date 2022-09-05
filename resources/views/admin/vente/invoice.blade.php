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
        <div class="col-md-5 d-flex justify-content-end">
            <div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        @can('print', \App\Models\DocumentVente::class)
                        @endcan

                        <a target="_blank" href="{{ route('admin.print.sale.preview', $invoice->number) }}"
                            class="ml-2 btn btn-info btn-lg  mb-2">
                            Imprimer
                        </a>

                        @if ($invoice->status == App\helper\Invoice::STATUS['no_printed'])
                            <a href="{{ route('admin.print.sale.terminate', $invoice->number) }}"
                                class="ml-2 btn btn-success btn-lg  mb-2">
                                Enregistrer
                            </a>
                            <a href="{{ route('admin.print.sale.cancel', $invoice->number) }}"
                                class="ml-2 btn btn-danger btn-lg  mb-2">
                                Annuler
                            </a>
                        @endif
                        {{-- {{ $invoice }} --}}
                        @can('cancel', $invoice)
                        @endcan


                        @can('terminate', \App\Models\DocumentVente::class)
                        @endcan
                    </div>
                </div>


                @include('admin.vente.includes.invoice-table', [
                    "invoice" => $invoice,
                    'sales' => $invoice->sales,
                    'reste' => $rest,
                    "paid" =>$paid
                ])
            </div>

            <!--End Invoice-->
        </div>
    </div>
@endsection
