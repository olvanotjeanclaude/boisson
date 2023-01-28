@extends('layouts.invoice')

@section('title')
    JOURNAL DE CAISSE
@endsection

@section('top')
    <h2>JOURNAL DE CAISSE</h2>
@endsection

@section('header')
    <span>
        <b>Date : </b>
        {{ getDateBetween($datas['between']) }}
    </span>
    <span>
        <b>Utilisateur : </b>
        {{ Str::title(currentUser()->full_name) }}
    </span>
@endsection


@section('table')
    <table id="invoiceTable">
        <thead>
            <tr>
                <th style="text-align: center">Ticket N<sup>0</sup></th>
                {{-- <th>Status</th> --}}
                <th>Client</th>
                <th>Payé</th>
                <th>Avoir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas['all'] as $data)
                <tr>
                    <td style="text-align: center">{{ $data->rang }}</td>
                    {{-- <td>{!! $data->status !!}</td> --}}
                    <td>{{ $data->cl_name }}</td>
                    <td>{{ getNumberDecimal($data->sum_paid) }}</td>
                    <td>{{ getNumberDecimal($data->sum_checkout) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('footer')
    <table style="width:100%">
        <tr>
            <td class="label">Total facture :</td>
            <td class="price">{{ formatPrice($datas['amount'], 'Ar') }}</td>
        </tr>
        <tr>
            <td class="label">Avoir :</td>
            <td class="price">{{ formatPrice($datas['checkout'], 'Ar') }}</td>
        </tr>
        <tr>
            <td class="label">Credit :</td>
            <td class="price">{{ formatPrice($datas['reste'], 'Ar') }}</td>
        </tr>
    </table>
@endsection
