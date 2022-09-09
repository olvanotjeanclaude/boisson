@if (count($invoices))
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
                    @yield('header')
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


                    @forelse ($invoices["datas"] as $data)
                        <tr class="service">
                            <td class="tableitem">
                                <p class="itemtext designation">{{ $data->saleable->designation }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext" style="text-align: center">{{ $data->quantity }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext">{{ $data->pricing }}</p>
                            </td>
                            <td class="tableitem">
                                <p class="itemtext" style="font-weight: bold;text-align:right">
                                    {{ formatPrice($data->sub_amount) }}</p>
                            </td>
                        </tr>
                    @empty
                    @endforelse

                    <tr class="tabletitle">
                        <td></td>
                        <td></td>
                        <td class="Rate">
                            <h2>Total:</h2>
                        </td>
                        <td class="payment">
                            <h2 class="pricing">{{ formatPrice($paid) }}</h2>
                        </td>
                    </tr>

                    @isset($checkout)
                        <tr class="tabletitle">
                            <td></td>
                            <td></td>
                            <td class="Rate">
                                <h2>Sorti:</h2>
                            </td>
                            <td class="payment">
                                <h2 class="pricing">{{ formatPrice($checkout) }}</h2>
                            </td>
                        </tr>
                    @endisset
                    <tr class="tabletitle">
                        <td></td>
                        <td></td>
                        <td class="Rate">
                            <h2>Reste:</h2>
                        </td>
                        <td class="payment">
                            <h2 class="pricing">{{ formatPrice(abs($rest)) }}</h2>
                        </td>
                    </tr>
                    @isset($caisse)
                        <tr class="tabletitle">
                            <td></td>
                            <td></td>
                            <td class="Rate">
                                <h2>Caisse:</h2>
                            </td>
                            <td class="payment">
                                <h2 class="pricing">{{ formatPrice($caisse) }}</h2>
                            </td>
                        </tr>
                    @endisset
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
