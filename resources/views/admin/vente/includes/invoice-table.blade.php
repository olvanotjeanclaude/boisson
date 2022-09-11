@if ($invoice && $invoice->customer)
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
                                <p class="itemtext" style="text-align: right">{{ $sale->quantity }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext" style="text-align: right">{{ round($sale->pricing) }}</p>
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

                    <tr class="tabletitle">
                        <td></td>
                        <td></td>
                        <td class="Rate">
                            <h2>Payé:</h2>
                        </td>
                        <td class="payment">
                            <h2 class="pricing">{{ formatPrice($paid) }}</h2>
                        </td>
                    </tr>

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
    @else
    <div class="card">
        <div class="cad-body ml-1 pt-2">
            PAS DE DONEE
        </div>
    </div>
@endif
