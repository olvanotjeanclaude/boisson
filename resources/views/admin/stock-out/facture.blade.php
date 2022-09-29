@extends('layouts.invoice')

@section('title')
    Bon De Sorti No {{ $stock->invoice_number }}
@endsection

@section('invoice-title')
    Bon De Sorti
@endsection

@section('header')
    <div class="header-info">
        <span>
            <b>Facture N<sup>0</sup></b> {{ $stock->invoice_number }}
        </span>
        <br>
        <span>
            <b>Magasinier :</b> {{ Str::upper($stock->user ? $stock->user->full_name : 'Inconnu') }}
        </span>
        <br>
        <span>
            <b>Motif :</b> {{ $stock->comment }}
        </span>
        <br>
        <span>
            <b>Date :</b> {{ format_date($stock->date) }}
        </span>
        <br>
    </div>
@endsection


@section('table')
    <table id="invoiceTable">
        <thead>
            <tr>
                <th style="width: 160px;">Désignation</th>
                <th>Qté</th>
                <th>PU</th>
                <th style="text-align: right">Montant</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $data)
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
        </tbody>
    </table>
@endsection

@section('footer')
    <p class="mt-1"><b>Total : </b>{{ formatPrice($stocks->sum('sub_amount'), 'Ariary') }}</p>
@endsection
