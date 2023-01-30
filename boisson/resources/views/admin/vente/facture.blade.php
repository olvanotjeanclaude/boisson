@extends('layouts.invoice')

@section('title')
    Ticket De Vente | {{ $invoice->number }}
@endsection

@section('invoice-title')
    Ticket N<sup>0</sup> {{ $invoice->range }}
@endsection

@section('top')
    <h2>
        {{ Str::upper($invoice->customer?->identification) ?? "client n'existe pas" }}
    </h2>
@endsection

@section('header')
    <span>
        <b>Date :</b> {{ format_date($invoice->received_at) }}
    </span>
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
                        <td class="number-bold">
                            {{ $data->quantity }}
                        </td>
                        <td class="number">
                            {{ $data->pricing }}
                        </td>
                        <td class="number" style="text-align: right">
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
            <td class="price">
                {{ formatPrice($amount * 5, 'Fmg') }}
            </td>

        </tr>

        @if ($paid > 0)
            <tr>
                <td class="label">PAYE :</td>
                <td class="price">{{ formatPrice($paid, 'Ar') }}</td>
            </tr>
        @endif

        @if ($reste > 0)
            <tr>
                <td class="label">RESTE A PAYE :</td>
                <td class="price">{{ formatPrice($reste, 'Ar') }}</td>
            </tr>
        @endif
    </table>
@endsection
