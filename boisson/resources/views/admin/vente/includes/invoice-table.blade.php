@extends('layouts.invoice_table_template')

@section('prix-title')
    Prix
@endsection
@section('invoice-title')
    Document Vente
@endsection
@section('header')
    <p>
        @if ($invoice->range)
            Ticket : {{ $invoice->range }} <br>
        @endif
        Reference : {{ $invoice->number }} <br>
        Date : {{ format_date_time($invoice->received_at) }} <br>
        Client : {{ Str::ucfirst($invoice->customer->identification) }}<br>
        Adresse : {{ $invoice->customer->address }}<br>
        Téléphone : {{ $invoice->customer->phone }}<br>
        Caisse : {{ Str::upper($invoice->user ? $invoice->user->full_name : '') }}
    </p>
@endsection
@section('tbody')
    @forelse ($invoice->sales as $sale)
        @isset($sale->saleable)
            <tr class="service">
                <td style="width: 200px">{{ $sale->saleable->designation }} </td>
                <td class="">{{ $sale->quantity }}</td>
                <td>{{formatPrice( $sale->pricing )}}</td>
                <td class="text-right">{{ formatPrice($sale->sub_amount) }}</td>
            </tr>
        @endisset
    @empty
    @endforelse
@endsection

@section('footer')
    <p class="m-0">Total: {{ formatPrice($amount) }}</p>
    <p class="m-0">Total En Fmg: {{ formatPrice($amount * 5, 'Fmg') }}</p>
    <p class="m-0">{{ $paid > 0 ? 'Payé' : 'Avoir' }}: {{ formatPrice($paid) }}</p>
    @if ($reste > 0)
        <p class="m-0">Credit: {{ formatPrice($reste) }}</p>
    @endif
@endsection
