@extends('layouts.invoice')

@section('title')
    Facture
@endsection


@section('header')
    {{-- <h5>Date : {{ format_date($between[0]) }}-{{ format_date($between[1]) }}</h5>
    <h5>Type : {{ request()->get('filter_type') }} </h5>
    <h5>Mot Clé : {{ request()->get('chercher') }}</h5> --}}
    <p>Caissier: {{ Str::upper(auth()->user()->full_name) }}</p>
    <p>Ticket N<sup><span>&#176;</span></sup> {{ $invoice->number }} <br>
        Date : {{ format_date_time($invoice->received_at) }} <br><br>
        Client : {{ Str::ucfirst($invoice->customer->identification) }}<br>
        Adresse : {{ $invoice->customer->address }}<br>
        Téléphone : {{ $invoice->customer->phone }}<br>
    </p>
@endsection

@section('table')
    @include('layouts.invoice_table', [
        'invoices' => [
            'datas' =>  $invoice->sales,
            'type' => 'saleable',
        ],
        'amount' => $amount,
        'rest' => $reste,
        'paid' => $paid,
    ])
@endsection