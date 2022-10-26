@extends('layouts.app')

@section('title')
    Detail du factures
@endsection

@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-callout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/invoice.css') }}">
@endsection
@section('content-header')
    @include('includes.content-header', [
        'page' => 'Factures',
        'breadcrumbs' => [
            ['text' => 'Factures', 'link' => route('admin.factures.index')],
            ['text' => 'Detail', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'show' => true,
            'icon' => '<span class="material-icons">add</span>',
            'text' => 'Nouveu Article',
            'link' => route('admin.articles.create'),
        ],
    ])
@endsection

@section('content')
    <!-- BEGIN: Content-->
    <section class="card">
        <div class="card-body">
            <!-- Invoice Company Details -->
            <div id="invoice-company-details" class="row">
                <div class="col-md-6 col-sm-12 text-center text-md-left">
                    <div class="media">
                        <img src="../../../app-assets/images/logo/logo-80x80.png" alt="company logo"
                            class="" />
                        <div class="media-body">
                            <ul class="ml-2 px-0 list-unstyled">
                                <ul class="px-0 list-unstyled">
                                    <li class="text-bold-800">{{ $supplier->name }}</li>
                                    <li>{{ $supplier->identification }}</li>
                                    <li>{{ $supplier->email }}</li>
                                    <li>{{ $supplier->phone }}</li>
                                    <li>{{ $supplier->address ?? 'Adresse' }}</li>
                                </ul>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 text-center text-md-right">
                    <h2>Factures</h2>
                    <p class="pb-3">N<sup>0</sup> {{ $invoice->number }}</p>
                    <ul class="px-0 list-unstyled">
                        <li>Montant</li>
                        <li class="lead text-bold-800">{{ $pricing->formatPrice() }}</li>
                    </ul>
                </div>
            </div>
            <!--/ Invoice Company Details -->

            <!-- Invoice Customer Details -->
            <div id="invoice-customer-details" class="row pt-2">
                <div class="col-sm-12 text-center text-md-right">
                    <p><span class="text-muted">Date De Facturation : </span>{{ format_date($invoice->created_at) }}
                    </p>
                    <p><span class="text-muted">Terme :</span> Payment</p>
                </div>
            </div>
            <!--/ Invoice Customer Details -->

            <!-- Invoice Items Details -->
            <div id="invoice-items-details" class="pt-2">
                <div class="row">
                    <div class="table-responsive col-sm-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-right">#</th>
                                    <th class="text-right">Description</th>
                                    <th class="text-right">qtt cag/cart</th>
                                    <th class="text-right">Qtt bll</th>
                                    <th class="text-right">contenance</th>
                                    <th class="text-right">Unite</th>
                                    <th class="text-right">PU</th>
                                    <th class="text-right">Montant</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $deconsignation = \App\Models\Articles::ARTICLE_TYPES['deconsignation'];
                                @endphp
                                @forelse ($pricing->getItems() as $article)
                                    <tr>
                                        <th scope="row">{{ $article->reference }}</th>
                                        <td>
                                            <p>{{ $article->designation }}</p>
                                            {{-- <p class="text-muted">{{ $article->note ?? '0' }}</p> --}}
                                        </td>
                                        <td>{{ $article->quantity_type_value }}</td>
                                        <td class="text-right">{{ $article->quantity_bottle ?? '0' }}</td>
                                        <td class="text-right">{{ $article->contenance ?? '0' }}</td>
                                        <td>{{ array_search($article['unity'], \App\Models\Articles::UNITS) ?? '-' }}</td>
                                        <td class="text-right">{{ $article->unit_price ?? '-' }}</td>
                                        <td class="text-right">
                                            {{ $article['article_type'] == $deconsignation ? '-' : '' }}
                                            {{ formatPrice($article->sub_amount) }}
                                        </td>
                                    </tr>
                                @empty
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Invoice Footer -->
            <div id="invoice-footer">
                <div class="row">
                    <div class="col-md-7 col-sm-12">
                        <h6>Terme & Condition</h6>
                        <p>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Repudiandae, vel?
                        </p>
                    </div>
                    <div class="col-md-5 col-sm-12 text-center">
                        <button type="button" class="btn btn-info btn-lg my-1">
                            <i class="la la-print"></i>
                            Imprimer
                        </button>
                    </div>
                </div>
            </div>
            <!--/ Invoice Footer -->

        </div>
    </section>
    <!-- END: Content-->
@endsection
