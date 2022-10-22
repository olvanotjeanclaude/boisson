@extends('layouts.invoice')

@section('title')
    Ticket De Vente | {{ $invoice->number }}
@endsection

@section('invoice-title')
    Ticket De Vente
@endsection

@section('css')
    <style>
        td {
            padding: 3px;
        }

        .label {
            font-weight: bold;
            text-align: right;
            width: 100px;
        }
        .price{
            font-weight: bold;
            font-size: 1.2rem
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
        @php
            $customer = $invoice->customer;
        @endphp
        <span>
            <b>Client : </b> {{ $customer ? $customer->identification : '' }}
        </span>
        <br>
    </div>
@endsection


@section('table')
    <table id="invoiceTable">
        <thead>
            <tr>
                <th style="width: 150px">Désignation</th>
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
                            {{ $data->pricing }}
                        </td>
                        <td style="text-align: right">
                            {{ $data->sub_amount }}
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
            <td class="price">{{ formatPrice($amount, 'Ar') }}</td>
        </tr>
        <tr>
            <td class="label">Ou :</td>
            <td class="price">{{ formatPrice($amount * 5, 'Fmg') }}</td>
        </tr>
        <tr>
            <td class="label">{{ $paid > 0 ? 'Payé' : 'Avoir' }} :</td>
            <td class="price">{{ formatPrice($paid, 'Ar') }}</td>
        </tr>

        @if ($reste > 0)
            <tr>
                <td class="label">Credit :</td>
                <td class="price">{{ formatPrice($reste, 'Ar') }}</td>
            </tr>
        @endif
    </table>
@endsection
