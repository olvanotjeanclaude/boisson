@extends('layouts.invoice')

@section('title')
    Ticket De Vente | {{ $invoice->number }}
@endsection

@section('invoice-title')
    Ticket N<sup>0</sup> {{ $invoice->range }}
@endsection

@section('css')
    <style>
        #invoice-container {
            /* font-size: .9rem; */
        }

        .label {
            font-weight: bold;
            text-align: right;
        }

        .price {
            font-size: 1.2rem
        }

        .quantity {
            text-align: center
        }

        .invoice-title {
            margin-top: 15px;
        }

        .title {
            display: none;
        }

        .text-center {
            text-align: center;
        }
    </style>
@endsection

@section('top')
    @php
        $customer = $invoice->customer;
    @endphp
    <h2 style="margin-top: 20px">{{ $customer ? $customer->identification : "client n'existe pas" }}</h2>
@endsection
@section('header')
    <div class="header-info">
        <span>
            <b>Reference :</b> {{ $invoice->number }}
        </span>
        <br>
        <span>
            <b>Date :</b> {{ format_date($invoice->received_at) }}
        </span>
        <br>
    </div>
@endsection


@section('table')
    <table id="invoiceTable">
        <thead>
            <tr>
                <th>Désignation</th>
                <th>Qté</th>
                <th>PU</th>
                <th style="text-align: right">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->sales as $data)
                @if ($data->saleable)
                    <tr>
                        <td>
                            {{ Str::title($data->saleable->designation) }}
                        </td>
                        <td class="quantity">
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
            <td class="label">Total facture:</td>
            <td class="price">{{ formatPrice($amount, 'Ar') }}</td>
        </tr>
        <tr>
            <td class="label">Ou :</td>
            <td class="price" style="font-weight: bold">
                {{ formatPrice($amount * 5, 'Fmg') }}
            </td>
        </tr>
        {{-- <tr>
            <td class="label">{{ $paid > 0 ? 'Payé' : 'Avoir' }} :</td>
            <td class="price">{{ formatPrice($paid, 'Ar') }}</td>
        </tr> --}}

        @if ($reste > 0)
            <tr>
                <td class="label">Credit :</td>
                <td class="price">{{ formatPrice($reste, 'Ar') }}</td>
            </tr>
        @endif
    </table>
@endsection
