@extends('layouts.app')

@section('title')
    Vente Payment
@endsection

@section('page-css')
    <link rel="stylesheet" href="{{ asset('/assets/css/invoice.css') }}">
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Vente',
        'breadcrumbs' => [
            ['text' => 'Facture', 'link' => route('admin.ventes.index')],
            ['text' => 'Payment', 'link' => '#'],
        ],
        'actionBtn' => [
            'text' => 'Nouveau Vente',
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
                                            Caisse
                                        </label>
                                        <input type="number" step="0.001" id="checkout" value="{{ $invoice->checkout??0 }}"
                                            name="checkout" class="form-control" placeholder="0 Ariary">
                                    </div>
                                </div>
                                <div class="col-sm mt-1">
                                    <div class="form-group">
                                        <label class="text-bold-400 text-dark" for="paid">
                                            Payé/dépense
                                        </label>
                                        <input type="number" step="0.001" required id="paid" value="{{ $invoice->paid }}"
                                            name="paid" class="form-control" placeholder="0 Ariary">
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
                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label class="text-bold-400 text-dark" for="rest">
                                            Reste À Payer
                                        </label>
                                        <h4 class=""><span id="rest">{{ $amount - $invoice->paid }}</span> Ariary
                                        </h4>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button type="submit"
                                        class="btn form-control my-1 border-top text-white btn-secondary">
                                        <i class="la la-save"></i>
                                        Payer
                                    </button>
                                </div>
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

                <div id="invoice-POS" class="printScreen">

                    <center id="top">
                        <div class="logo"></div>
                        <div class="info mt-1">
                            <h2>Mon Magasin</h2>
                        </div>
                        <!--End Info-->
                    </center>
                    <!--End InvoiceTop-->

                    <div id="mid">
                        <div class="info">
                            <h2 class="font-weight-bold"></h2>
                            <p>N<sup><span>&#176;</span></sup> {{ $invoice->number }} <br>
                                Date : {{ format_date_time($invoice->received_at) }} <br><br>
                                Client : {{ Str::ucfirst($invoice->customer->identification) }}</br>
                                Adresse : {{ $invoice->customer->address }}</br>
                                Téléphone : {{ $invoice->customer->phone }}</br>
                            </p>
                        </div>
                    </div>
                    <!--End Invoice Mid-->

                    <div id="bot">

                        <div id="table">
                            <table>
                                <tr class="tabletitle">
                                    <td class="item">
                                        <h2>Designation</h2>
                                    </td>
                                    <td class="Hours">
                                        <h2>Qté</h2>
                                    </td>
                                    <td class="Rate">
                                        <h2>Sous Total</h2>
                                    </td>
                                </tr>

                                @forelse ($invoice->sales as $sale)
                                    <tr class="service">
                                        <td class="tableitem">
                                            <p class="itemtext">{{ $sale->saleable->designation }}</p>
                                        </td>
                                        <td class="tableitem">
                                            <p class="itemtext">{{ $sale->quantity }}</p>
                                        </td>
                                        <td class="tableitem">
                                            <p class="itemtext">{{ formatPrice($sale->sub_amount) }}</p>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse

                                <tr class="tabletitle">
                                    <td></td>
                                    <td class="Rate">
                                        <h2>Total</h2>
                                    </td>
                                    <td class="payment">
                                        <input type="hidden" value="{{ $amount }}" id="amount">
                                        <h2>{{ formatPrice($amount) }}</h2>
                                    </td>
                                </tr>

                                <tr class="tabletitle">
                                    <td></td>
                                    <td class="Rate">
                                        <h2>Total En Fmg</h2>
                                    </td>
                                    <td class="payment">
                                        <h2>{{ formatPrice($amount * 5, 'Fmg') }}</h2>
                                    </td>
                                </tr>
                                
                               
                            </table>
                        </div>
                        <!--End Table-->

                        <div id="legalcopy">
                            <p class="legal"><strong>Merci beaucoup!</strong></p>
                        </div>

                    </div>
                    <!--End InvoiceBot-->
                </div>
            </div>

            <!--End Invoice-->
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#paid").keyup(function() {
                const paid = $(this).val();
                const amount = $("#amount").val();
                if (paid) {
                    $("#rest").text(amount - paid);
                } else {
                    $("#rest").text("0.00");
                }
            });

            $(".printData").click(function() {
                w = window.open();
                w.document.write($('.printScreen').html());
                w.print();
                w.close();
            })
        })

        var beforePrint = function() {
            alert('Functionality to run before printing.');
        };

        var afterPrint = function() {
            alert('Functionality to run after printing');
        };

        if (window.matchMedia) {
            var mediaQueryList = window.matchMedia('print');

            mediaQueryList.addListener(function(mql) {
                //alert($(mediaQueryList).html());
                if (mql.matches) {
                    beforePrint();
                } else {
                    afterPrint();
                }
            });
        }

        window.onbeforeprint = beforePrint;
        window.onafterprint = afterPrint;
    </script>
@endsection
