@extends('layouts.invoice')

@section('title')
    Historique de vente {{ getDateBetween($between) }}
@endsection

@section('top')
    <h2 style="margin-bottom: 5px"> Historique de vente</h2>
    @if (request()->get('filter_type'))
        <h3>Type : {{App\helper\Filter::TYPES[request()->get('filter_type')]?? "" }} </h3>
    @endif
    @if (request()->get('chercher'))
        <h3>Mot Clé : {{ request()->get('chercher') }}</h3>
    @endif
@endsection

@section('header')
    <span>
        <b>Date : </b>
        {{ getDateBetween($between) }}
    </span>
    <span>
        <b>Caissier:</b>
        {{ Str::upper(auth()->user()->surname) }}
    </span>
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
