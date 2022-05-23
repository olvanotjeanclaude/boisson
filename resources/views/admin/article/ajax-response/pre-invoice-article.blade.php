@if (count($preInvoices))
    <table class="overflow-auto w-100" id="preInvoice">
        <thead class="border-bottom">
            <tr class="">
                <th>Designation</th>
                <th>Btl/Cg</th>
                <th>Montant</th>
            </tr>
        </thead>
        @foreach ($preInvoices as $preInvoice)
        <tbody>
            <tr id="article_invoice_{{ $preInvoice['row_id'] }}" class="border-bottom">
                <td> {{ Str::ucfirst($preInvoice['designation']) }}</td>
                <td>
                    {{ $preInvoice['quantity_bottle'] != 0 ? $preInvoice['quantity_bottle'] : $preInvoice['quantity_type_value'] }}
                </td>
                @php
                    $deconsignation = \App\Models\Articles::ARTICLE_TYPES['deconsignation'];
                @endphp
                <td class="d-flex justify-content-between align-items-center flex-nowrap">
                    <span class="badge badge-dark center">
                        {{ $preInvoice['article_type'] == $deconsignation ? '-' : '' }}
                        {{ number_format($preInvoice['sub_amount'], 2, ',', ' ') }} Ariary
                    </span>
                    <a class="remove-article" data-row_id="{{ $preInvoice['row_id'] }}">
                        <span class="material-icons text-danger">
                            close
                        </span>
                    </a>
                </td>
            </tr>
        </tbody>
        @endforeach
        <tr id="allTotal" class=" text-bold-600 text-primary border-top font-size-large">
            <td>Total</td>
            <td></td>
            <td>
                <span>{{ number_format($amount, 2, ',', ' ') }} Ar</span>
                <br>
                <span>
                    {{ number_format($amount * 5, 2, ',', ' ') }} Fmg
                </span>
            </td>
        </tr>
    </table>

    <button type="button" id="validFacture" class="btn form-control my-1 border-top text-white btn-secondary">
        <i class="la la-save"></i>
        Enregistrer
    </button>
@else
    <p class="card-text">La désignation, nombre de bouteille et le total se trouve dans cette zone.
    </p>
@endif
