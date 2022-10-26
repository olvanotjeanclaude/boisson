@extends('layouts.invoice')

@section('title')
   JOURNAL DE CAISSE
@endsection

@section('invoice-title')
   JOURNAL DE CAISSE
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

        .price {
            font-weight: bold;
            font-size: 1.2rem
        }
    </style>
@endsection
@section('header')
    <div class="header-info">
        <span>
            <b>Date : </b>
            @php
                $between = $datas['between'];
            @endphp
            @if ($between[0] == $between[1])
                {{ format_date($between[0]) }}
            @else
                {{ format_date($between[0]) }} - {{ format_date($between[1]) }}
            @endif
        </span>
        <br>
        <span>
            <b>Utilisateur : </b>
            {{ Str::title(currentUser()->full_name) }}
        </span>
        <br>
    </div>
@endsection


@section('table')
    <table id="invoiceTable">
        <thead>
            <tr>
                <th>Ticket N<sup>0</sup></th>
                <th>Status</th>
                <th>Client</th>
                <th>Payé</th>
                <th>Avoir</th>
                {{-- <th>Montant</th> --}}
                {{-- <th>Reste</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($datas['all'] as $data)
                <tr>
                    <td>{{ $data->doc_number }}</td>
                    <td>{!! $data->status !!}</td>
                    <td>{{ $data->cl_name }}</td>
                    <td>{{ getNumberDecimal($data->sum_paid) }}</td>
                    <td>{{ getNumberDecimal($data->sum_checkout) }}</td>
                    {{-- <td>{{ getNumberDecimal($data->rest) }}</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('footer')
    <table>
        <tr>
            <td class="label">Total :</td>
            <td class="price">{{ formatPrice($datas['amount'], 'Ar') }}</td>
        </tr>
        <tr>
            <td class="label">Ou :</td>
            <td class="price">{{ formatPrice($datas['amount'] * 5, 'Fmg') }}</td>
        </tr>
        <tr>
            <td class="label">Payé :</td>
            <td class="price">{{ formatPrice($datas['paid'], 'Ar') }}</td>
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
