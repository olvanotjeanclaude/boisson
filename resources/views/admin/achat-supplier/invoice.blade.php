@extends('layouts.invoice_table_template')

@section('prix-title')
    PA
@endsection
@section('invoice-title')
    Bon D'Entrée
@endsection
@section('header')
    <div class="d-flex flex-column">
        <span>
            <b>Facture N<sup>0</sup></b> {{ $entry->invoice_number }}
        </span>
        <span>
            <b>Magasinier :</b> {{ Str::upper($entry->user ? $entry->user->full_name : 'Inconnu') }}
        </span>
        <span>
            <b>Reference Facture :</b> {{ $entry->reference_facture }}
        </span>
        <span>
            <b>Date :</b> {{ format_date($entry->date) }}
        </span>
        <span>
            <b>Fournisseur :</b> {{ Str::ucfirst($supplier ? $supplier->identification : 'Introuvable') }}
        </span>
        <span>
            <b>Adresse :</b> {{ $supplier ? $supplier->address : 'Introuvable' }}
        </span>
        <span>
            <b> Téléphone :</b> {{ $supplier ? $supplier->phone : 'Introuvable' }}
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
                    {{ $data->entry }}
                </td>
                <td>
                    {{ round($data->stockable->buying_price) }}
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
    <p class="m-0"><b>Total en Fmg : </b>{{ formatPrice(abs($amount*5), 'Fmg') }}</p>
    <p class="m-0"><b>Nombre d'article :</b> {{ count($datas) }}</p>
@endsection
