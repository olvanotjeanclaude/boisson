@if (count($invoices))
    <div>
        <table id="invoiceTable">
            <thead>
                <tr>
                    <th>Désignation</th>
                    <th style="padding:0 10px">Qté</th>
                    <th style="text-align: right">Montant</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($invoices["datas"] as $data)
                    @isset($data->saleable)
                        <tr>
                            <td>
                                {{ Str::title($data->saleable->designation) }}
                            </td>
                            <td class="number-bold" style="text-align:center">
                                {{ $data->quantity }}
                            </td>
                            <td class="number-bold" style="text-align: right">
                                {{ $data->sub_amount }}
                            </td>
                        </tr>
                    @endisset
                @empty
                @endforelse
            </tbody>
        </table>
        <br>
        <table>
            <tbody>
                @isset($amount)
                    <tr>
                        <td colspan="1">
                            <p style="text-align: right">Total facture :</p>
                        </td>
                        <td colspan="3">
                            <p> &nbsp; {{ formatPrice(($amount)) }}</p>
                        </td>
                    </tr>
                @endisset

                @php
                    $routeName = Route::currentRouteName();
                @endphp

                @if ($routeName == 'admin.print.sale.preview' ||
                    request()->get('filter_type') == '' ||
                    request()->get('filter_type') == 'tout')
                    @isset($paid)
                        <tr>
                            <td colspan="1">
                                <p style="text-align: right">Total De Vente :</p>
                            </td>
                            <td colspan="3">
                                <p> &nbsp; {{ formatPrice($paid) }}</p>
                            </td>
                        </tr>
                    @endisset
                    @isset($rest)
                        <tr>
                            <td colspan="1">
                                <p style="text-align: right">credit :</p>
                            </td>
                            <td colspan="3">
                                <p> &nbsp; {{ formatPrice($rest) }}</p>
                            </td>
                        </tr>
                    @endisset
                @endif

                @if (request()->get('filter_type') == 'tout' || request()->get('filter_type') == null)
                    @isset($checkout)
                        <tr>
                            <td colspan="1">
                                <p style="text-align: right">Avoir :</p>
                            </td>
                            <td colspan="3">
                                <p> &nbsp; {{ formatPrice($checkout) }}</p>
                            </td>
                        </tr>
                    @endisset
                    @isset($caisse)
                        <tr>
                            <td colspan="1">
                                <p style="text-align: right">Solde En Caisse :</p>
                            </td>
                            <td colspan="3">
                                <p> &nbsp; {{ formatPrice(($caisse)) }}</p>
                            </td>
                        </tr>
                    @endisset
                @endif
                <br>
                @isset($recaps)
                    @foreach ($recaps as $recap => $total)
                        <tr>
                            <td colspan="1">
                                <p style="text-align: right">{{ $recap }} :</p>
                            </td>
                            <td colspan="3">
                                <p> &nbsp; {{ $total }}</p>
                            </td>
                        </tr>
                    @endforeach
                @endisset
            </tbody>
        </table>
    </div>
@else
    <div class="card">
        <div class="cad-body ml-1 pt-2">
            PAS DE DONEE
        </div>
    </div>
@endif
