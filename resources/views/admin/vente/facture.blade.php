@extends('layouts.invoice')

@section('title')
    Ticket De Vente | {{ $invoice->number }}
@endsection

@section('invoice-title')
    Ticket De Vente
@endsection

@section('css')
    <style>
        td{
            padding: 3px;
        }
        .label {
            font-weight: bold;
            text-align: right;
            width: 100px;
        }
    </style>
@endsection
@section('header')
    <div class="header-info">
        <span>
            <b>Facture N<sup>0</sup></b> {{ $invoice->number }}
        </span>
        <br>
        <span>
            <b>Date :</b> {{ format_date($invoice->received_at) }}
        </span>
        <br>
        <span>
            <b>Caisse :</b> {{ Str::upper($invoice->user ? $invoice->user->full_name : '') }}
        </span>
        <br>
        @php
            $customer = $invoice->customer;
        @endphp
        <span>
            <b>Client : </b> {{ $customer ? $customer->identification : '' }}
        </span>
        <br>
        <span>
            <b>Adresse :</b> {{ $customer ? $customer->address : '' }}
        </span>
        <br>
        <span>
            <b>Téléphone :</b> {{ $customer ? $customer->phone : '' }}
        </span>
    </div>
@endsection


@section('table')
    <table id="invoiceTable">
        <thead>
            <tr>
                <th style="min-width: 100px">Désignation</th>
                <th style="min-width: 30px">Qté</th>
                <th>PU</th>
                <th style="text-align: right">Montant</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->sales as $data)
                @if ($data->saleable)
                    <tr>
                        <td>
                            {{ Str::title($data->saleable->designation) }}
                        </td>
                        <td>
                            {{ $data->quantity }}
                        </td>
                        <td>
                            {{ round($data->saleable->buying_price) }}
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
    <table>
        <tr>
            <td class="label">Total :</td>
            <td>{{  formatPrice(abs($amount), 'Ariary') }}</td>
        </tr>
        <tr>
            <td class="label">Ou :</td>
            <td>{{  formatPrice(abs($amount*5), 'Fmg') }}</td>
        </tr>
        <tr>
            <td class="label">Payé :</td>
            <td>{{  formatPrice(abs($paid), 'Ariary') }}</td>
        </tr>
        <tr>
            <td class="label">Credit :</td>
            <td>{{  formatPrice(abs($reste), 'Ariary') }}</td>
        </tr>
    </table>
@endsection
