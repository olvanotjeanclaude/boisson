@extends('layouts.app')

@section('title')
    Facture Vente
@endsection

@section('page-css')
    <style>
        @media print {
            .page-break {
                display: block;
                page-break-before: always;
            }
        }

        #invoice-POS {
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
            padding: 2mm;
            margin: 0 auto;
            width: 80mm;
            background: #FFF;
        }

        #invoice-POS ::selection {
            background: #f31544;
            color: #FFF;
        }

        #invoice-POS ::moz-selection {
            background: #f31544;
            color: #FFF;
        }

        #invoice-POS h1 {
            font-size: 1.5em;
            color: #222;
        }

        #invoice-POS h2 {
            font-size: .9em;
        }

        #invoice-POS h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        #invoice-POS p {
            font-size: .7em;
            color: #666;
            line-height: 1.2em;
        }

        #invoice-POS #top,
        #invoice-POS #mid,
        #invoice-POS #bot {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
        }

        #invoice-POS #top {
            min-height: 100px;
        }

        #invoice-POS #mid {
            min-height: 80px;
        }

        #invoice-POS #bot {
            min-height: 50px;
        }

        #invoice-POS #top .logo {
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
            background-size: 60px 60px;
        }

        #invoice-POS .clientlogo {
            float: left;
            height: 60px;
            width: 60px;
            background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
            background-size: 60px 60px;
            border-radius: 50px;
        }

        #invoice-POS .info {
            display: block;
            margin-left: 0;
        }

        #invoice-POS .title {
            float: right;
        }

        #invoice-POS .title p {
            text-align: right;
        }

        #invoice-POS table {
            width: 100%;
            border-collapse: collapse;
        }

        #invoice-POS .tabletitle {
            font-size: .85em;
            background: #EEE;
        }

        #invoice-POS .service {
            border-bottom: 1px solid #EEE;
        }

        #invoice-POS .item {
            width: 24mm;
        }

        #invoice-POS .itemtext {
            font-size: .75em;
            margin-bottom: 0;
            margin: .3rem;
        }

        #invoice-POS #legalcopy {
            margin-top: 5mm;
        }
    </style>
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Factures',
        'breadcrumbs' => [
            ['text' => 'Facture', 'link' => route('admin.ventes.index')],
            ['text' => 'Validation Et Impression', 'link' => route('admin.index')],
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
                        <form action="{{ route('admin.achat-produits.store') }}" class="needs-validation" novalidate
                            method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 mt-1">
                                    <div class="form-group">
                                        <label class="text-bold-400 text-dark" for="payment_type">Type De
                                            Payment</label>
                                        <select name="payment_type" class="form-control" required id="payment_type">
                                            <option value=''>Choisir</option>
                                            @forelse (\App\Models\DocumentAchat::PAYMENT_TYPES as $key => $val)
                                                <option value="{{ $key }}">{{ $val }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        <div class="invalid-feedback">
                                            Selectionnez le type de payment
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 mt-1">
                                    <div class="form-group">
                                        <label class="text-bold-400 text-dark" for="paid">
                                            Payé/dépense
                                        </label>
                                        <input type="number" step="0.001" id="paid" name="paid" class="form-control"
                                            placeholder="0 Ariary">
                                        <div class="invalid-feedback">
                                            Entrer le prix d'achat
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8 mt-1">
                                    <div class="form-group">
                                        <label class="text-bold-400 text-dark" for="comment">
                                            Commentaire
                                        </label>
                                        <textarea name="comment" id="comment" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-1">
                                    <div class="form-group">
                                        <label class="text-bold-400 text-dark" for="rest">
                                            Reste À Payer
                                        </label>
                                        <h4 class=""><span id="rest">{{ $amount }}</span> Ariary</h4>
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
                            <a href="{{ route('admin.print.sale.terminate',$invoice->number) }}"
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
                            <p>N<sup><span>&#176;</span></sup>  {{ $invoice->number }} <br>
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
                                        <h2></h2>
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
