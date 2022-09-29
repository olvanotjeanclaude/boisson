@extends('layouts.invoice_table_template')

@section('prix-title')
    Prix
@endsection
@section('invoice-title')
    Bon De Sorti
@endsection
@section('header')
    <div class="d-flex flex-column">
        <span>
            <b>Facture N<sup>0</sup></b> {{ $stock->invoice_number }}
        </span>
        <span>
            <b>Magasinier :</b> {{ Str::upper($stock->user ? $stock->user->full_name : 'Inconnu') }}
        </span>
        <span>
            <b>Motif :</b> {{ Str::upper($stock->comment) }}
        </span>
        <span>
            <b>Date :</b> {{ format_date($stock->date) }}
        </span>
    </div>
@endsection
@section('tbody')
    @foreach ($datas as $data)
        @if ($data->stockable)
            <tr>
                <td>
                    {{ Str::title($data->stockable->designation) }}
                </td>
                <td>
                    {{ $data->out }}
                </td>
                <td>
                    {{ round($data->stockable->price) }}
                </td>
                <td style="text-align: right">
                    {{ round($data->sub_amount) }}
                </td>
            </tr>
        @endif
    @endforeach
@endsection

@section('footer')
    <p class="m-0"><b>Total : </b>{{ formatPrice(abs($amount), 'Ariary') }}</p>
@endsection
