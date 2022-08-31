@extends('layouts.app')

@section('title')
    Vente Payment
@endsection

@section('page-css')
    @include('includes.invoice-css')
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Vente',
        'breadcrumbs' => [
            ['text' => 'Facture', 'link' => route('admin.ventes.index')],
            ['text' => 'Payment', 'link' => '#'],
        ],
        'actionBtn' => [
            'text' => 'Nouvelle Vente',
            'link' => route('admin.ventes.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => auth()->user()->can('create', \App\Models\Sale::class),
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
        @if (getUserPermission() != 'facturation')
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.sale.paymentStore', $invoice->number) }}" class="needs-validation"
                            novalidate method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-5 mt-1">
                                    <div class="form-group">
                                        <label class="text-bold-400 text-dark" for="payment_type">
                                            Payer Par
                                        </label>
                                        <select name="payment_type" class="form-control" required id="payment_type">
                                            <option value=''>Choisir</option>
                                            @forelse (\App\Models\DocumentAchat::PAYMENT_TYPES as $key => $val)
                                                <option value="{{ $key }}"
                                                    @if ($key == $invoice->payment_type) selected @endif>{{ $val }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                        <div class="invalid-feedback">
                                            Selectionnez le type de payment
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm mt-1">
                                    <div class="form-group">
                                        <label class="text-bold-400 text-dark" for="checkout">
                                            Sortie De Caisse
                                        </label>
                                        <input type="number" step="0.001" required id="checkout"
                                            value="{{ $invoice->checkout ?? 0 }}" name="checkout" class="form-control"
                                            placeholder="0 Ariary">
                                    </div>
                                </div>
                                <div class="col-sm mt-1">
                                    <div class="form-group">
                                        <label class="text-bold-400 text-dark" for="paid">
                                            Entrée De Caisse
                                        </label>
                                        <input type="number" step="0.001" required id="paid"
                                            value="{{ $invoice->paid ?? 0 }}" name="paid" class="form-control"
                                            placeholder="0 Ariary">
                                        <div class="invalid-feedback">
                                            Entrer le montant
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8 mt-1">
                                    <div class="form-group">
                                        <label class="text-bold-400 text-dark" for="comment">
                                            Commentaire
                                        </label>
                                        <textarea name="comment" id="comment" class="form-control" rows="3">{{ $invoice->comment }}</textarea>
                                    </div>
                                </div>
                                {{-- <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label class="text-bold-400 text-dark" for="rest">
                                            Reste À Payer
                                        </label>
                                        <h4 class=""><span id="rest">{{ $invoice->rest }}</span> Ar
                                        </h4>
                                    </div>
                                </div> --}}

                                @if ($invoice->paid != $invoice->sales->sum('sub_amount'))
                                    <div class="col-12">
                                        <button type="submit"
                                            class="btn form-control my-1 border-top text-white btn-secondary">
                                            <i class="la la-save"></i>
                                            Payer
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-5 d-flex justify-content-end">
            <div>
                @if (getUserPermission() == 'facturation')
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between">
                            <button class="print btn btn-warning btn-lg  printData mb-2">Imprimer</button>
                            <a href="{{ route('admin.print.sale.terminate', $invoice->number) }}"
                                class="ml-2 btn btn-success btn-lg  mb-2">Terminer</a>
                        </div>
                    </div>
                @endif

                <div id="invoice-POS" class="p-1">

                    <center id="top" class="mb-2">
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
                                            <p class="itemtext">{{ $sale->saleable->price }}</p>
                                        </td>
                                        <td class="tableitem">
                                            <p class="itemtext" style="font-weight: bold;text-align:right">
                                                {{ formatPrice($sale->sub_amount) }}</p>
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
