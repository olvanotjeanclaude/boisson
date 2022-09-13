@extends('layouts.invoice')

@section('title')
    Historique de vente {{ format_date($between[0]) }}-{{ format_date($between[1]) }}
@endsection


@section('header')
    <h5>Historique de vente ({{ Str::title(request()->get('filter_type')) }})
        {{ format_date($between[0]) }}-{{ format_date($between[1]) }}</h5>
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
    ])
@endsection
