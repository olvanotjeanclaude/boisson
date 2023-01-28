@extends('layouts.invoice')

@section('title')
    Facture
@endsection

@section('top')
   <h2>Bon D'Entrée</h2>
@endsection

@section('header')
        <span>
            <b>Date :</b> {{ format_date($entry->date) }}
        </span>
        <span>
            <b>Magasinier :</b> {{ Str::upper($entry->user ? $entry->user->full_name : 'Inconnu') }}
        </span>
        <span>
            <b>Facture N<sup>0</sup></b> {{ $entry->invoice_number }}
        </span>
        <span>
            <b>Reference Facture :</b> {{ $entry->reference_facture }}
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