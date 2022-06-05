@if (count($preInvoices))
    <table class="overflow-auto w-100" id="preInvoice">
        <thead class="border-bottom">
            <tr class="">
                <th>Designation</th>
                <th>Qtt*Prix</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($preInvoices as $preInvoice)
            <tr id="vente_{{ $preInvoice['row_id'] }}"
                class="border-bottom row_{{ $preInvoice['row_id'] }}">
                <td> {{ Str::ucfirst($preInvoice['designation']) }}</td>
                <td>
                    {{ $preInvoice['total'] != 0 ? $preInvoice['total'] . '*' : '' }}{{ $preInvoice['sub_amount'] }}
                </td>

                <td class="d-flex justify-content-between align-items-center flex-nowrap">
                    <span class="badge badge-dark center">
                        {{-- {{ $preInvoice['type'] == 3 ? '-' : '' }} --}}
                        {{ number_format($preInvoice['sub_amount'], 2, ',', ' ') }} Ariary
                    </span>
                    {{-- <a class="remove-vente" data-row_id="{{ $preInvoice['row_id'] }}">
                        <span class="material-icons text-danger">
                            close
                        </span>
                    </a> --}}
                </td>
            </tr>
        @endforeach
            <tr id="allTotal" class=" text-bold-600 text-primary border-top font-size-large">
                <td>Total</td>
                <td></td>
                <td>
                    <span>{{ number_format($totalPrice, 2, ',', ' ') }} Ar</span>
                    <br>
                    <span>
                        {{ number_format($totalPrice * 5, 2, ',', ' ') }} Fmg
                    </span>
                </td>
            </tr>
        </tbody>
    </table>

    <button type="button" id="validFacture" class="btn form-control my-1 border-top text-white btn-secondary">
        <i class="la la-save"></i>
        Enregistrer
    </button>
@else
    <p class="card-text">La désignation, nombre de bouteille et le total se trouve dans cette zone.
    </p>
@endif
