@extends('layouts.invoice_table_template')

@section('prix-title')
    Prix
@endsection

@section('invoice-title')
    Ticket De Vente
@endsection

@section('extraTH')
    <th></th>
@endsection

@section('tbody')
    @foreach ($preInvoices as $preInvoice)
        @if ($preInvoice->saleable)
            <tr>
                <td class="text-capitalize" style="width: 200px">
                    {{ $preInvoice->saleable->designation }}
                </td>
                <td>{{ $preInvoice->quantity }} </td>
                <td style="width: 50px">
                    {{ round($preInvoice->pricing) }}
                </td>
                <td style="width: auto" class="text-right">
                    {{ ($preInvoice->sub_amount) }}
                </td>
                <td style="width: 50px">
                    <form method="POST" action="{{ route('admin.ventes.destroy', $preInvoice->id) }}">
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

@section('footer')
    {{-- <p class="m-0"><b>Total : </b>{{ formatPrice(abs($amount), 'Ariary') }}</p>
    <p class="m-0"><b>Total En Fmg : </b>{{ formatPrice(abs($amount * 5), 'Ariary') }}</p> --}}
@endsection

