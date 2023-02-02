@extends('layouts.invoice_table_template')

@section('prix-title')
    PA
@endsection

@section('invoice-title')
    Bon D'Entrée
@endsection

@section('extraTH')
    <th></th>
@endsection

@section('tbody')
    @foreach ($preInvoices as $data)
        @if ($data->stockable)
            <tr>
                <td class="text-capitalize">
                    {{ $data->stockable->designation }}
                </td>
                <td>{{ formatPrice($data->entry) }}</td>
                <td>
                    {{ formatPrice($data->stockable->buying_price) }}
                </td>
                <td class="text-right">
                    {{ formatPrice($data->sub_amount) }}
                </td>
                <td class="pl-1 py-0">
                    <form method="POST" action="{{ route('admin.achat-fournisseurs.destroy', $data->id) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="close" aria-label="Close">
                            <span aria-hidden="true" class="text-danger">&times;</span>
                        </button>
                    </form>
                </td>
            </tr>
        @endif
    @endforeach
    <tr>
        <td style="border: none" colspan="2" class="text-right">
            <b>Total : </b>
        </td>
        <td style="border: none" class="text-right" colspan="3">
            {{ formatPrice(abs($amount), 'Ariary') }}
        </td>
    </tr>
    <tr>
        <td style="border: none" colspan="2" class="text-right">
            <b>Total En Fmg: </b>
        </td>
        <td style="border: none" class="text-right" colspan="3">
            {{ formatPrice(abs($amount * 5), 'Fmg') }}
        </td>
    </tr>
@endsection