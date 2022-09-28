@extends('layouts.invoice_table_template')

@section('prix-title')
    Prix
@endsection
@section('invoice-title')
    Document Vente
@endsection
@section('header')
    <p>N<sup><span>&#176;</span></sup> {{ $invoice->number }} <br>
        Date : {{ format_date_time($invoice->received_at) }} <br>
        Client : {{ Str::ucfirst($invoice->customer->identification) }}<br>
        Adresse : {{ $invoice->customer->address }}<br>
        Téléphone : {{ $invoice->customer->phone }}<br>
    </p>
@endsection
@section('tbody')
    @forelse ($invoice->sales as $sale)
        @isset($sale->saleable)
            <tr class="service">
                <td>{{ $sale->saleable->designation }} </td>
                <td>{{ $sale->quantity }}</td>
                <td>{{ round($sale->pricing) }}</td>
                <td class="text-right">{{ round($sale->sub_amount) }}</td>
            </tr>
        @endisset
    @empty
    @endforelse
@endsection

@section('footer')
    <p class="m-0">Total: {{ formatPrice($amount) }}</p>
    <p class="m-0">Total En Fmg: {{ formatPrice($amount * 5, 'Fmg') }}</p>
    <p class="m-0">Payé: {{ formatPrice($paid) }}</p>
    <p class="m-0">Credit: {{ formatPrice($reste) }}</p>
@endsection
