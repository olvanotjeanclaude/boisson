<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Facture | {{ $invoice->clientOrSupplier['value'] }}</title>

    <style>
        html,
        * {
            font-family: 'Courier New', sans-serif, Courier, monospace
        }

        @media print {
            .page-break {
                display: block;
                page-break-before: always;
            }
        }

        #invoice-POS {
            padding: 1.5mm;
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
            font-size: 1.5em;
        }

        #invoice-POS h3 {
            font-size: 1.2em;
            font-weight: 300;
            line-height: 2em;
        }

        #invoice-POS p {
            font-size: .9em;
            line-height: 1.2em;
        }

        #invoice-POS #top,
        #invoice-POS #mid,
        #invoice-POS #bot {
            /* Targets all id with 'col-' */
            border-bottom: 1px solid #EEE;
        }

        #invoice-POS #mid {
            min-height: 10px;
        }

        #invoice-POS #bot {
            min-height: 50px;
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
            font-size: .5em;
            background: #EEE;
        }

        #invoice-POS .service {
            border-bottom: 1px solid #EEE;
        }

        #invoice-POS .item {
            width: 40mm;
        }

        #invoice-POS .itemtext {
            font-size: .8em;
            text-transform: capitalize;
        }

        #invoice-POS #legalcopy {
            margin-top: 5mm;
        }
    </style>

    <script>
        window.console = window.console || function(t) {};
    </script>



    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>


</head>

<body translate="no">


    <div id="invoice-POS">

        <center id="top">
            {{-- <div class="logo"></div> --}}
            <div class="info">
                <h2>{{ getAppName() }}</h2>
            </div>
            <!--End Info-->
        </center>
        <!--End InvoiceTop-->

        <div id="mid">
            <div class="info">
                <h2 class="font-weight-bold"></h2>
                <p>N<sup><span>&#176;</span></sup> {{ $invoice->number }} <br>
                    Date : {{ format_date_time($invoice->date) }} <br><br>
                    {{ $invoice->clientOrSupplier['label'] }} :
                    {{ Str::ucfirst($invoice->clientOrSupplier['value']) }}</br>
                    Adresse : {{ $invoice->address }}</br>
                    Téléphone : {{ $invoice->phone }}</br>
                </p>
            </div>
        </div>
        <!--End Invoice Mid-->

        <div id="bot">

            <div id="table">
                <table>
                    <tr class="tabletitle">
                        <td class="item">
                            <h2>Désignation</h2>
                        </td>
                        <td class="Hours">
                            <h2>Qté</h2>
                        </td>
                        <td class="Rate">
                            <h2>Total</h2>
                        </td>
                    </tr>

                    @forelse ($invoice->items as $item)
                        <tr class="service">
                            <td class="tableitem">
                                <p class="itemtext">{{ $item['designation'] }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">{{ $item['quantity'] }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">{{ $item['price'] }}</p>
                            </td>
                        </tr>
                    @empty
                    @endforelse

                    <tr class="tabletitle">
                        <td></td>
                        <td class="Rate">
                            <h2>Total:</h2>
                        </td>
                        <td class="payment">
                            <input type="hidden" value="{{ $invoice->amount }}" id="amount">
                            <h2>{{ formatPrice($invoice->amount) }}</h2>
                        </td>
                    </tr>

                    <tr class="tabletitle">
                        <td></td>
                        <td class="Rate">
                            <h2></h2>
                        </td>
                        <td class="payment">
                            <h2>{{ formatPrice($invoice->amount * 5, 'Fmg') }}</h2>
                        </td>
                    </tr>

                    <tr class="tabletitle">
                        <td></td>
                        <td class="Rate">
                            <h2>Reste:</h2>
                        </td>
                        <td class="payment">
                            <h2>{{ formatPrice($invoice->rest) }}</h2>
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
    <!--End Invoice-->
</body>

</html>
