@extends('layouts.invoice')

@section('title')
    Historique de Stock {{ format_date($between[0]) }}-{{ format_date($between[1]) }}
@endsection


@section('header')
    <h4 class="invoice-title">ÉTAT DE STOCK</h4>
    <h5>Date : {{ format_date($between[0]) }}-{{ format_date($between[1]) }}</h5>
    @if (request()->get('filter_type'))
        <h5>Type : {{ request()->get('filter_type') }} </h5>
    @endif
    @if (request()->get('chercher'))
        <h5>Mot Clé : {{ request()->get('chercher') }}</h5>
    @endif
    <h5>Utilisateur : {{ Str::upper(auth()->user()->full_name) }}</h5>
@endsection

@section('table')
    @if (count($stocks))
        <div>
            <table id="invoiceTable">
                <thead>
                    <tr>
                        <th style="width: 160px">Désignation</th>
                        <th>Type</th>
                        <th style="text-align: right">Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($stocks as $data)
                        <tr>
                            <td>
                                {{ Str::title($data->designation) }}
                            </td>
                            <td>
                                {{ Str::title($data->type) }}
                            </td>
                            <td style="text-align:right">
                                {{ $data->final }}
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
            <h4 class="caption">Total : {{ $sum_quantity }} </h4>

            @section('footer')
                <h5>Merci beaucoup !</h5>
                <br>
                <h6 class="print-text">Imprimé le {{ format_date_time(now()->toDateTimeString()) }}</h6>
            @endsection
        </div>
    @else
        <div class="card">
            <div class="cad-body ml-1 pt-2">
                PAS DE DONEE
            </div>
        </div>
    @endif
@endsection
