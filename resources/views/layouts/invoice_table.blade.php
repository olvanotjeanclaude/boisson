@if (count($invoices))
    <table id="invoiceTable">
        <thead>
            <tr>
                <th>Désignation</th>
                <th>Qté</th>
                <th>PU</th>
                <th style="min-width: 100px">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($invoices["datas"] as $data)
                <tr>
                    <td>
                        {{ $data->saleable->designation }}
                    </td>
                    <td>
                        {{ $data->quantity }}
                    </td>
                    <td>
                        {{ round($data->pricing) }}
                    </td>
                    <td>
                        {{ formatPrice($data->sub_amount) }}
                    </td>
                </tr>
            @empty
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <h6 style="margin-top: 8px">Total:</h6>
                </td>
                <td>
                    <h6 style="margin-top: 8px">{{ formatPrice($amount) }}</h6>
                </td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td>
                    <h6>Paye:</h6>
                </td>
                <td>
                    <h6>{{ formatPrice(abs($paid)) }}</h6>
                </td>
            </tr>

            @isset($checkout)
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <h6>Sorti:</h6>
                    </td>
                    <td>
                        <h6>{{ formatPrice($checkout) }}</h6>
                    </td>
                </tr>
            @endisset
            <tr>
                <td></td>
                <td></td>
                <td>
                    <h6>Reste:</h6>
                </td>
                <td>
                    <h6>{{ formatPrice(abs($rest)) }}</h6>
                </td>
            </tr>
            @isset($caisse)
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <h6>Caisse:</h6>
                    </td>
                    <td>
                        <h6>{{ formatPrice($caisse) }}</h6>
                    </td>
                </tr>
            @endisset
        </tfoot>
    </table>
    <h5>Merci beaucoup !</h5>
    <h6 class="print-text">Imprimé le {{format_date_time(now()->toDateTimeString())}}</h6>
@else
    <div class="card">
        <div class="cad-body ml-1 pt-2">
            PAS DE DONEE
        </div>
    </div>
@endif
