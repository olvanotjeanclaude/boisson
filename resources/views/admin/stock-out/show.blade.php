@extends('layouts.app')

@section('title')
    Sorti Stock | {{ $stock->invoice_number }}
@endsection

@section('page-css')
    @include('includes.invoice-css')
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Bon de sortie',
        'breadcrumbs' => [
            ['text' => 'Bon de sortie', 'link' => route('admin.sorti-stocks.index')],
            ['text' => 'Validation De Sortie', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'show' => false,
        ],
    ])
@endsection


@section('content')
    <div class="row">
        <div class="col-12">
            @include('includes.error')
            @include('includes.success')
        </div>
    </div>

    <div class="row">
        <div class="col-md-10">
            <div>
                <div class="row">
                    <div class="col-12 d-flex flex-wrap">
                        <a target="_blank" href="{{ route('admin.sorti-stocks.print', $stock->invoice_number) }}"
                            class="btn btn-info btn-lg  mb-2">
                            <i class="la la-print"></i>
                            Imprimer
                        </a>
                        <a href="{{ route('admin.sorti-stocks.download', $stock->invoice_number) }}"
                            class="btn btn-dark btn-lg ml-1 mb-2">
                            <i class="la la-download"></i>
                            Telecharger
                        </a>
                        @if ($stock->status != App\Models\Stock::STATUS['accepted'])
                            <form action="{{ route('admin.sorti-stocks.validStockOut', $stock->invoice_number) }}"
                                method="post">
                                @csrf
                                <button type="submit" class="btn btn-success btn-lg ml-1 mb-2">
                                    <i class="la la-check"></i>
                                    Accepter
                                </button>
                            </form>
                        @endif

                        @if ($stock->status != App\Models\Stock::STATUS['canceled'])
                            <form method="POST" action="{{ route('admin.sorti-stocks.cancel', $stock->invoice_number) }}">
                                @csrf
                                <button  class="btn btn-danger btn-lg ml-1 mb-2" type="submit">
                                    <i class="la la-close"></i>
                                    Annuler
                                </button>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="d-flex justify-content-md-start justify-content-center">
                    @if ($stock)
                        @include('admin.stock-out.invoice', [
                            'datas' => $stocks,
                            'amount' => $stocks->sum('sub_amount'),
                        ])
                    @else
                        <div class="card">
                            <div class="card-body text-danger">
                                Pas de document a afficher!
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!--End Invoice-->
        </div>
    </div>
@endsection
