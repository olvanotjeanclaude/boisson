@if (count($invoices))
    <div>
        <table id="invoiceTable">
            <thead>
                <tr>
                    <th style="width: 180px">Désignation</th>
                    <th>Qté</th>
                    <th>PU</th>
                    <th style="text-align: right">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($invoices["datas"] as $data)
                    <tr>
                        <td>
                            {{ Str::title($data->saleable->designation) }}
                        </td>
                        <td>
                            {{ $data->quantity }}
                        </td>
                        <td>
                            {{ round($data->pricing) }}
                        </td>
                        <td style="text-align: right">
                            {{ $data->sub_amount }}
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
            <br>
            <tfoot>
                @isset($amount)
                    <tr>
                        <td colspan="1">
                            <h6 style="text-align: right">Total :</h6>
                        </td>
                        <td colspan="3">
                            <h6> &nbsp; {{ formatPrice(abs($amount)) }}</h6>
                        </td>
                    </tr>
                @endisset

                @if (request()->get('filter_type') == 'tout')
                    @isset($paid)
                        <tr>
                            <td colspan="1">
                                <h6 style="text-align: right">Paye :</h6>
                            </td>
                            <td colspan="3">
                                <h6> &nbsp; {{ formatPrice(abs($paid)) }}</h6>
                            </td>
                        </tr>
                    @endisset
                    @isset($checkout)
                        <tr>
                            <td colspan="1">
                                <h6 style="text-align: right">Sortie De Caisse :</h6>
                            </td>
                            <td colspan="3">
                                <h6> &nbsp; {{ formatPrice(abs($checkout)) }}</h6>
                            </td>
                        </tr>
                    @endisset
                    @isset($rest)
                        <tr>
                            <td colspan="1">
                                <h6 style="text-align: right">Rest :</h6>
                            </td>
                            <td colspan="3">
                                <h6> &nbsp; {{ formatPrice(abs($rest)) }}</h6>
                            </td>
                        </tr>
                    @endisset
                    @isset($caisse)
                        <tr>
                            <td colspan="1">
                                <h6 style="text-align: right">Caisse :</h6>
                            </td>
                            <td colspan="3">
                                <h6> &nbsp; {{ formatPrice(abs($caisse)) }}</h6>
                            </td>
                        </tr>
                    @endisset
                @endif
                <br>
                @isset($recaps)
                    @foreach ($recaps as $recap => $total)
                        <tr>
                            <td colspan="1">
                                <h6 style="text-align: right">{{ $recap }} :</h6>
                            </td>
                            <td colspan="3">
                                <h6> &nbsp; {{ $total }}</h6>
                            </td>
                        </tr>
                    @endforeach
                @endisset

            </tfoot>
        </table>
        <h4 style="margin-top: 15px">Merci beaucoup !</h4>
        <br>
        <h6 class="print-text">Imprimé le {{ format_date_time(now()->toDateTimeString()) }}</h6>
    </div>
@else
    <div class="card">
        <div class="cad-body ml-1 pt-2">
            PAS DE DONEE
        </div>
    </div>
@endif
