@extends('layouts.app')

@section('title')
    Vente Payment
@endsection

@section('page-css')
    @include('includes.invoice-css')
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Vente',
        'breadcrumbs' => [
            ['text' => 'Ventes', 'link' => route('admin.ventes.index')],
            ['text' => 'Payment', 'link' => '#'],
        ],
        'actionBtn' => [
            'text' => 'Nouvelle Vente',
            'link' => route('admin.ventes.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => true,
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
        @if (getUserPermission() != 'facturation')
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.sale.paymentStore', $invoice->number) }}" class="needs-validation"
                            novalidate method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-5 mt-1">
                                    <div class="form-group">
                                        <label class="text-bold-400 text-dark" for="payment_type">
                                            Payer Par
                                        </label>
                                        <select name="payment_type" class="form-control" required id="payment_type">
                                            <option value=''>Choisir</option>
                                            @forelse (\App\Models\DocumentAchat::PAYMENT_TYPES as $key => $val)
                                                <option value="{{ $key }}"
                                                    @if ($key == $invoice->payment_type) selected @endif>{{ $val }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                        <div class="invalid-feedback">
                                            Selectionnez le type de payment
                                        </div>
                                    </div>
                                </div>

                                @if ($rest > 0)
                                    <div class="col-sm mt-1">
                                        <div class="form-group">
                                            <label class="text-bold-400 text-dark" for="paid">
                                                Entrée De Caisse
                                            </label>
                                            <input type="number" step="0.001" id="paid" value="{{ $rest }}"
                                                name="paid" class="form-control" placeholder="0 Ariary">
                                            <div class="invalid-feedback">
                                                Entrer le montant
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-sm mt-1">
                                        <div class="form-group">
                                            <label class="text-bold-400 text-dark" for="checkout">
                                                Avoir
                                            </label>
                                            <input type="number" step="0.001" id="checkout" value="{{ abs($rest) }}"
                                                name="checkout" class="form-control" placeholder="0 Ariary">
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-8 mt-1">
                                    <div class="form-group">
                                        <label class="text-bold-400 text-dark" for="comment">
                                            Commentaire
                                        </label>
                                        <textarea name="comment" id="comment" class="form-control" rows="3">{{ $invoice->comment }}</textarea>
                                    </div>
                                </div>

                                @if ($rest != 0)
                                    <div class="col-12">
                                        <button type="submit"
                                            class="btn form-control my-1 border-top text-white btn-secondary">
                                            <i class="la la-save"></i>
                                            Payer
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-5 d-flex justify-content-end">
            <div>
                @if (getUserPermission() == 'facturation')
                    <div class="row">
                        <div class="col-12 d-flex justify-content-between">
                            <button class="print btn btn-warning btn-lg  printData mb-2">Imprimer</button>
                            <a href="{{ route('admin.print.sale.terminate', $invoice->number) }}"
                                class="ml-2 btn btn-success btn-lg  mb-2">Terminer</a>
                        </div>
                    </div>
                @endif

                @include('admin.vente.includes.invoice-table', [
                    'invoice' => $invoice,
                    'sales' => $invoice->sales,
                    'reste' => $rest,
                    'paid' => $paid,
                    'amount' => $amount,
                ])
            </div>

            <!--End Invoice-->
        </div>
    </div>
@endsection
