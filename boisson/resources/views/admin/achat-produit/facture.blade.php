<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Facture | {{ Str::ucfirst($supplier->identification) }}</title>
    @include('includes.invoice-css')
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
                <div class="info">
                    <p>N<sup><span>&#176;</span></sup> {{ $invoice->number }} <br>
                        Date : {{ format_date_time($invoice->received_at) }} <br><br>
                        Fournisseur : {{ Str::ucfirst($supplier->identification) }}<br>
                        Adresse : {{ $supplier->address }}<br>
                        Téléphone : {{ $supplier->phone }}<br>
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

                    @forelse ($orders as $order)
                        <tr class="service">
                            <td class="tableitem">
                                <p class="itemtext designation">{{ Str::title($order->product->designation) }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext" style="text-align: center">{{ $order->quantity }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">{{ $order->product->price }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext" style="font-weight: bold;text-align:right">
                                    {{ formatPrice($order->sub_amount) }}</p>
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
