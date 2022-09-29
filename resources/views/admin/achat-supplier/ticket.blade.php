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
                <td class="text-capitalize" style="width: 200px">
                    {{ $data->stockable->designation }}
                </td>
                <td>{{ $data->entry }}</td>
                <td style="width: 50px">
                    {{ round($data->stockable->buying_price) }}
                </td>
                <td class="text-right">
                    {{ $data->sub_amount }}
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
            {{ formatPrice(abs($amount * 5), 'Ariary') }}
        </td>
    </tr>
@endsection

@section('footer')
    {{-- <p class="m-0"><b>Total : </b>{{ formatPrice(abs($amount), 'Ariary') }}</p>
    <p class="m-0"><b>Total En Fmg : </b>{{ formatPrice(abs($amount * 5), 'Ariary') }}</p> --}}
@endsection
