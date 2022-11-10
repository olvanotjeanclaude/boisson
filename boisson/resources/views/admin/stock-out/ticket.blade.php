@extends('layouts.invoice_table_template')

@section('prix-title')
    Prix
@endsection

@section('invoice-title')
    Ticket De Sorti
@endsection

@section('extraTH')
    <th></th>
@endsection

@section('tbody')
    @foreach ($preInvoices as $preInvoice)
        @if ($preInvoice->stockable)
            <tr>
                <td class="text-capitalize" style="width: 200px">
                    {{ $preInvoice->stockable->designation }}
                </td>
                <td>{{ getNumberDecimal($preInvoice->out) }} </td>
                <td style="width: 50px">
                    {{ getNumberDecimal($preInvoice->stockable->price) }}
                </td>
                <td style="width: auto" class="text-right">
                    {{ getNumberDecimal($preInvoice->sub_amount) }}
                </td>
                <td style="width: 50px">
                    <form method="POST" action="{{ route('admin.sorti-stocks.destroy', $preInvoice->id) }}">
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
@endsection

@section('footer')
    <table style="width: 100%">
        <tbody style="">
            <tr>
                <td style="border: none; width:60%;" class="text-right">
                    <b>Total : </b>
                </td>
                <td style="border: none" class="text-right">
                    {{ formatPrice($amount, 'Ariary') }}
                </td>
            </tr>
            <tr>
                <td style="border: none; width:60%;" class="text-right">
                    <b>Total En Fmg: </b>
                </td>
                <td style="border: none" class="text-right">
                    {{ formatPrice($amount * 5, 'Fmg') }}
                </td>
            </tr>
        </tbody>
    </table>
@endsection
