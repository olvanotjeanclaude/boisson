@extends('layouts.invoice')

@section('title')
    JOURNAL D'INVENTAIRE
@endsection

@section('invoice-title')
    JOURNAL D'INVENTAIRE
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
                <th>Status</th>
                <th>Date</th>
                <th>Designation</th>
                <th>Ecart</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas['all'] as $data)
            <tr>
                <td>{!!  $data->status !!}</td>
                <td>{{ $data->date }}</td>
                <td>{{ $data->designation }}</td>
                <td>{{ $data->difference }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection