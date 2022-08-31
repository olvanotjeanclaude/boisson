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

              
                <div id="invoice-POS" class="p-1">

                    <center id="" class="mb-2">
                        {{-- <div class="logo"></div> --}}
                        <div class="info">
                            <h2>{{ getAppName() }}</h2>
                        </div>
                        <!--End Info-->
                    </center>
                    <!--End InvoiceTop-->
            
                    <div id="mid" class="mb-2">
                        <div class="info">
                            <div class="info">
                                <p>N<sup><span>&#176;</span></sup> {{ $invoice->number }} <br>
                                    Date : {{ format_date_time($invoice->received_at) }} <br><br>
                                    Client : {{ Str::ucfirst($invoice->customer->identification) }}<br>
                                    Adresse : {{ $invoice->customer->address }}<br>
                                    Téléphone : {{ $invoice->customer->phone }}<br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!--End Invoice Mid-->
            
                    <div id="bot">
            
                        <div id="table">
                            <table>
                                <tr class="tabletitle">
                                    <td class="item">
                                        <h2 style="padding-left: 5px; text-align:left">Désignation</h2>
                                    </td>
                                    <td class="Hours">
                                        <h2>Qté</h2>
                                    </td>
                                    <td class="Rate">
                                        <h2>PU</h2>
                                    </td>
                                    <td class="Rate">
                                        <h2>Total</h2>
                                    </td>
                                </tr>
            
                                @forelse ($invoice->sales as $sale)
                                    <tr class="service">
                                        <td class="tableitem">
                                            <p class="itemtext designation">{{ $sale->saleable->designation }}</p>
                                        </td>
                                        <td class="tableitem">
                                            <p class="itemtext" style="text-align: center">{{ $sale->quantity }}</p>
                                        </td>
                                        <td class="tableitem">
                                            <p class="itemtext">{{ ($sale->saleable->price) }}</p>
                                        </td>
                                        <td class="tableitem">
                                            <p class="itemtext" style="font-weight: bold;text-align:right">{{ formatPrice($sale->sub_amount) }}</p>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
            
                                <tr class="tabletitle">
                                    <td></td>
                                    <td></td>
                                    <td class="Rate">
                                        <h2>Total: </h2>
                                    </td>
                                    <td class="payment">
                                        <input type="hidden" value="{{ $amount }}" id="amount">
                                        <h2 class="pricing">{{ formatPrice($amount) }}</h2>
                                    </td>
                                </tr>
            
                                <tr class="tabletitle">
                                    <td></td>
                                    <td></td>
                                    <td class="Rate">
                                        {{-- <h2></h2> --}}
                                    </td>
                                    <td class="payment">
                                        <h2 class="pricing">{{ formatPrice($amount * 5, 'Fmg') }}</h2>
                                    </td>
                                </tr>
            
                                @php
                                    $reste = $amount - $invoice->paid;
                                @endphp
                                <tr class="tabletitle">
                                    <td></td>
                                    <td></td>
                                    <td class="Rate">
                                        <h2>Reste:</h2>
                                    </td>
                                    <td class="payment">
                                        <h2 class="pricing">{{ formatPrice($reste) }}</h2>
                                    </td>
                                </tr>
            
                            </table>
                        </div>
                        <!--End Table-->
            
                        <div id="legalcopy">
                            <p class="legal"><strong>Merci beaucoup!</strong>
                            </p>
                        </div>
            
                    </div>
                    <!--End InvoiceBot-->
                </div>
            </div>

            <!--End Invoice-->
        </div>
    </div>
@endsection

