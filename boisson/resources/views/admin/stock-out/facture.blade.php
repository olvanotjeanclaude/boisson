@extends('layouts.invoice')

@section('title')
    Bon de sortie No {{ $stock->invoice_number }}
@endsection

@section('invoice-title')
    Bon de sortie
@endsection

@section('header')
    <div class="header-info">
        <span>
            <b>Facture N<sup>0</sup></b> {{ $stock->invoice_number }}
        </span>
        <span>
            <b>Magasinier :</b> {{ Str::upper($stock->user ? $stock->user->full_name : 'Inconnu') }}
        </span>
        <span>
            <b>Motif :</b> {{ $stock->comment }}
        </span>
        <span>
            <b>Date :</b> {{ format_date($stock->date) }}
        </span>
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
                        <td class="number">
                            {{ formatPrice($data->out,"") }}
                        </td>
                        <td class="number">
                            {{ formatPrice($data->stockable->price,"") }}
                        </td>
                        <td class="number" style="text-align: right">
                            {{ formatPrice($data->sub_amount,"") }}
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endsection

@section('footer')
    <table style="width:100%">
        <tr>
            <td class="label">Total :</td>
            <td class="price">{{  formatPrice($stocks->sum('sub_amount'), 'Ariary') }}</td>
        </tr>
        <tr>
            <td class="label">Total en Fmg :</td>
            <td class="price">{{  formatPrice($stocks->sum('sub_amount') * 5, 'Fmg')}}</td>
        </tr>
    </table>
@endsection
