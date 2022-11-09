@extends('layouts.invoice')

@section('title')
    Historique de vente {{ format_date($between[0]) }}-{{ format_date($between[1]) }}
@endsection


@section('header')
    <h4 class="invoice-title"> Historique de vente</h4>
    <h5>Date : {{ format_date($between[0]) }}-{{ format_date($between[1]) }}</h5>
    @if (request()->get('filter_type'))
        <h5>Type : {{App\helper\Filter::TYPES[request()->get('filter_type')]?? "" }} </h5>
    @endif
    @if (request()->get('chercher'))
        <h5>Mot Clé : {{ request()->get('chercher') }}</h5>
    @endif
    <h5>Caissier: {{ Str::upper(auth()->user()->full_name) }}</h5>
@endsection

@section('table')
    @include('layouts.invoice_table', [
        'invoices' => [
            'datas' => $solds,
            'type' => 'saleable',
        ],
        'amount' => $recettes['sum_amount'],
        'rest' => $recettes['sum_rest'],
        'checkout' => $recettes['sum_checkout'],
        'paid' => $recettes['sum_paid'],
        'caisse' => $recettes['sum_caisse'],
        'recaps' => $recaps,
    ])
@endsection
