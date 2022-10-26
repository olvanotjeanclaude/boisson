@extends('layouts.invoice')

@section('title')
    Historique d'emballage
    @if ($between[0] == $between[1])
        {{ format_date($between[0]) }}
    @else
        {{ format_date($between[0]) }}-{{ format_date($between[1]) }}
    @endif
@endsection


@section('header')
    <h4 class="invoice-title">ÉTAT D'EMBALLAGE</h4>
    <h5>Date : @if ($between[0] == $between[1])
            {{ format_date($between[0]) }}
        @else
            {{ format_date($between[0]) }}-{{ format_date($between[1]) }}
        @endif
    </h5>
    @if (request()->get('chercher'))
        <h5>Mot Clé : {{ request()->get('chercher') }}</h5>
    @endif
    <h5>Utilisateur : {{ Str::upper(auth()->user()->full_name) }}</h5>
@endsection

@section('table')
    @if (count($emballages))
        <div>
            <table id="invoiceTable">
                <thead>
                    <tr>
                        <th style="width:100px">Désign<sup>0</sup></th>
                        <th>Ent</th>
                        <th>Sor</th>
                        <th>Con</th>
                        <th>Dec</th>
                        <th style="text-align: right">Sto</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($emballages as $emballage)
                        <tr>
                            <td>{{ $emballage->designation }}</td>
                            <td>{{ $emballage->sum_entry }}</td>
                            <td>{{ $emballage->sum_out }}</td>
                            <td>{{ $emballage->sum_consignation }}</td>
                            <td>{{ $emballage->sum_deconsignation }}</td>
                            <td>{{ $emballage->final }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">
                                Aucun résultat à afficher!
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <br>
            <table>
                <tr>
                    <th style="text-align: right">Entrée :</th>
                    <td> {{ $emballages->sum('sum_entry') }}</td>
                </tr>
                <tr>
                    <th style="text-align: right">Sortie :</th>
                    <td> {{ $emballages->sum('sum_out') }}</td>
                </tr>
                <tr>
                    <th style="text-align: right">Consignation :</th>
                    <td> {{ $emballages->sum('sum_consignation') }}</td>
                </tr>
                <tr>
                    <th style="text-align: right">Deconsignation :</th>
                    <td> {{ $emballages->sum('sum_deconsignation') }}</td>
                </tr>
                <tr>
                    <th style="text-align: right">En Stock :</th>
                    <td> {{ $emballages->sum('final') }}</td>
                </tr>
            </table>
        </div>
    @else
        <div class="card">
            <div class="cad-body ml-1 pt-2">
                PAS DE DONEE
            </div>
        </div>
    @endif
@endsection
