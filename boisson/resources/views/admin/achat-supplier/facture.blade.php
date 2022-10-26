@extends('layouts.invoice')

@section('title')
    Facture
@endsection

@section('invoice-title')
    Bon D'Entrée
@endsection

@section('header')
    <div class="header-info">
        <span>
            <b>Date :</b> {{ format_date($entry->date) }}
        </span>
        <br>
        <span>
            <b>Magasinier :</b> {{ Str::upper($entry->user ? $entry->user->full_name : 'Inconnu') }}
        </span>
        <br>
        <span>
            <b>Facture N<sup>0</sup></b> {{ $entry->invoice_number }}
        </span>
        <br>
        <span>
            <b>Reference Facture :</b> {{ $entry->reference_facture }}
        </span>
        <br>
        <span>
            <b>Fournisseur :</b> {{ Str::ucfirst($supplier ? $supplier->identification : 'Introuvable') }}
        </span>
        <br>
        <span>
            <b>Adresse :</b> {{ $supplier ? $supplier->address : 'Introuvable' }}
        </span>
        <br>
        <span>
            <b>Téléphone :</b> {{ $supplier ? $supplier->phone : 'Introuvable' }}
        </span>
    </div>
@endsection


@section('table')
    <table id="invoiceTable">
        <thead>
            <tr>
                <th style="min-width: 100px">Désignation</th>
                <th style="min-width: 30px">Qté</th>
                <th>PA</th>
                <th style="text-align: right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                @if ($data->stockable)
                    <tr>
                        <td>
                            {{ Str::title($data->stockable->designation) }}
                        </td>
                        <td>
                            {{ $data->entry }}
                        </td>
                        <td>
                            {{ ($data->stockable->buying_price) }}
                        </td>
                        <td style="text-align: right">
                            {{ ($data->sub_amount) }}
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
@endsection

@section('footer')
<p class="m-0"><b>Total : </b>{{ formatPrice(abs($amount), 'Ariary') }}</p>
<p class="m-0"><b>Total en Fmg : </b>{{ formatPrice(abs($amount*5), 'Fmg') }}</p>
<p class="m-0"><b>Nombre d'article :</b> {{ count($datas) }}</p>
@endsection