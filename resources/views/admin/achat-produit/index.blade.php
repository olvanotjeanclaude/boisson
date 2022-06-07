@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
@endsection

@section('title')
    Liste D'Achat Produits
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Achat Produits',
        'breadcrumbs' => [
            ['text' => 'Achat Produits', 'link' => route('admin.achat-produits.index')],
            ['text' => 'List', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Faire Achat',
            'link' => route('admin.achat-produits.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => true,
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @if (session('success'))
                @include('component.alert', [
                    'type' => 'success',
                    'message' => session('success'),
                ])
            @endif
        </div>
    </div>

    <!-- Material Data Tables -->
    <section id="material-datatables">
        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <h4 class="card-title"> Liste D'articles</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <button type="button" id="deleteIcheckBtn" data-target="#deleteAllModal" data-toggle="modal"
                                data-url="{{ route('admin.articles.destroy', ['article' => 'item']) }}"
                                class="btn delete-btn d-none btn-danger btn-sm text-capitalize">
                                <span class="material-icons">
                                    delete
                                </span>
                                Supprimer
                            </button>
                            <a href="{{ route('admin.factures.index') }}"
                                class="btn btn-secondary btn-sm text-capitalize">
                                <span class="material-icons">
                                    inventory
                                </span>
                                toutes les factures
                            </a>
                            <div class="d-none">
                                <span class="dropdown">
                                    <button id="btnSearchDrop1" type="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true"
                                        class="btn btn-warning btn-sm dropdown-toggle dropdown-menu-right"><i
                                            class="ft-download-cloud white"></i></button>
                                    <span aria-labelledby="btnSearchDrop1" class="dropdown-menu mt-1 dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="la la-calendar"></i> Due Date</a>
                                        <a href="#" class="dropdown-item"><i class="la la-random"></i> Priority </a>
                                        <a href="#" class="dropdown-item"><i class="la la-bar-chart"></i> Balance Due</a>
                                        <a href="#" class="dropdown-item"><i class="la la-user"></i> Assign to</a>
                                    </span>
                                </span>
                                <button class="btn btn-success btn-sm"><i class="ft-settings white"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <!-- Invoices List table -->
                            <div class="table-responsive">
                                <table
                                    class="table datatable table-striped table-hover table-white-space table-bordered  no-wrap icheck table-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th><input type="checkbox" class="input-chk-all"></th>
                                            <th>Ref</th>
                                            <th>Designation</th>
                                            <th>Type d'article</th>
                                            <th>Fam</th>
                                            <th>Qtt BTL| Cag</th>
                                            <th>unité</th>
                                            <th>PU</th>
                                            <th>Prix gros</th>
                                            <th>Prix Détail</th>
                                            {{-- <th>Montant</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($articles as $article)
                                            <tr class='text-nowrap' id="row_{{ $article['id'] }}">
                                                <td><input type="checkbox" data-id="{{ $article['id'] }}"
                                                        class="input-chk">
                                                </td>

                                                <td>
                                                    <a href="{{ route('admin.articles.show', $article['id']) }}"
                                                        class="text-bold-600">
                                                        {{ $article['reference'] }}
                                                    </a>
                                                </td>
                                                <td>{{ $article['designation'] ?? '-' }}</td>
                                                <td>{{ array_search($article['article_type'], $articleTypes) ?? '-' }}
                                                </td>
                                                <td>{{ array_search($article['category_id'], $articleCategories) ?? '-' }}
                                                </td>
                                                <td> {{ $article['quantity_bottle'] != 0 ? $article['quantity_bottle'] . ' Btl' : $article['quantity_type_value'] . ' Cag' }}
                                                </td>
                                                <td>{{ array_search($article['unity'], $units) ?? '-' }}</td>
                                                <td>{{ $article['unit_price'] ?? '-' }}</td>
                                                <td>{{ $article['wholesale_price'] ?? '-' }}</td>
                                                <td>{{ $article['detail_price'] ?? '-' }}</td>
                                                @php
                                                    $deconsignation = \App\Models\Articles::ARTICLE_TYPES['deconsignation'];
                                                @endphp
                                                {{-- <td>
                                                    {{ $article['article_type'] == $deconsignation ? '-' : '' }}
                                                    {{ number_format($article['sub_amount'], 2, ',', ' ') ?? '0' }} Ar
                                                </td> --}}
                                                <td>
                                                    <span class="dropdown">
                                                        <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="true"
                                                            class="btn btn-primary dropdown-toggle dropdown-menu-right"><i
                                                                class="ft-settings"></i></button>
                                                        <span aria-labelledby="btnSearchDrop2"
                                                            class="dropdown-menu mt-1 dropdown-menu-right">
                                                            <a href="{{ route('admin.articles.show', $article['id']) }}"
                                                                class="dropdown-item"><i
                                                                    class="la la-eye"></i>Voir</a>
                                                            <a href="{{ route('admin.articles.edit', $article['id']) }}"
                                                                class="dropdown-item"><i class="la la-pencil"></i>
                                                                Editer</a>
                                                            <a href="#" class="dropdown-item"><i
                                                                    class="la la-print"></i> Factures</a>
                                                            <a data-id="{{ $article['id'] }}"
                                                                data-url="{{ route('admin.articles.destroy', $article['id']) }}"
                                                                class="dropdown-item delete-btn"><i
                                                                    class="la la-trash"></i> Supprimer</a>
                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><input type="checkbox" class="input-chk-all"></th>
                                            <th>Ref</th>
                                            <th>Type d'article</th>
                                            <th>Fam</th>
                                            <th>Designation</th>
                                            <th>Qtt BTL</th>
                                            <th>unité</th>
                                            <th>PU</th>
                                            <th>Prix gros</th>
                                            <th>Prix Détail</th>
                                            {{-- <th>Montant</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!--/ Invoices table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('includes.delete-modal')
@endsection

@section('page-js')
   @include("includes.datatable.js")
@endsection

@section('script')
    <script>
        loadDatatable();
    </script>
@endsection
