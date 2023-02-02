@extends('layouts.invoice')

@section('title')
    Facture
@endsection

@section('invoice-title')
    Ticket N<sup>0</sup> {{ $entry->range }}
@endsection

@section('top')
    <h2>Bon D'Entrée</h2>
@endsection

@section('header')
    <span>
        <b>Date :</b> {{ format_date($entry->date) }}
    </span>
    <span>
        <b>Magasinier :</b> {{ Str::upper($entry->user ? $entry->user->surname : 'Inconnu') }}
    </span>
    <span>
        <b>Fournisseur :</b> {{ Str::ucfirst($supplier ? $supplier->identification : 'Introuvable') }}
    </span>
    <span>
        <b>Adresse :</b> {{ $supplier ? $supplier->address : 'Introuvable' }}
    </span>
    <span>
        <b>Téléphone :</b> {{ $supplier ? $supplier->phone : 'Introuvable' }}
    </span>
@endsection


@section('table')
    <table id="invoiceTable">
        <thead>
            <tr>
                <th>Désignation</th>
                <th style="min-width: 30px">Qté</th>
                <th style="min-width:50px;">PA</th>
                <th style="text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                @if ($data->stockable)
                    <tr>
                        <td>
                            {{ Str::title($data->stockable->designation) }}
                        </td>
                        <td class="number-bold">
                            {{ formatPrice($data->entry, '') }}
                        </td>
                        <td>
                            {{ formatPrice($data->stockable->buying_price, '') }}
                        </td>
                        <td style="text-align: right">
                            {{ formatPrice($data->sub_amount, '') }}
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
            <td class="price">{{ formatPrice(abs($amount), 'Ariary') }}</td>
        </tr>
        <tr>
            <td class="label">Total en Fmg :</td>
            <td class="price">{{ formatPrice(abs($amount * 5), 'Fmg') }}</td>
        </tr>
        <tr>
            <td class="label">Nombre d'article :</td>
            <td class="price">{{ count($datas) }}</td>
        </tr>
    </table>
@endsection
