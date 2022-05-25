@extends('layouts.app')

@section('vendor')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/material-vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/custom.css') }}">
@endsection

@section('title')
    Liste D'Articles
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Articles',
        'breadcrumbs' => [
            ['text' => 'Article', 'link' => route('admin.articles.index')],
            ['text' => 'List', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Nouveau Article',
            'link' => route('admin.articles.create'),
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
                            <button class="btn btn-secondary btn-sm text-capitalize">
                                <span class="material-icons">
                                    inventory
                                </span>
                                toutes les factures
                            </button>
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
                                    class="table datatable table-striped table-hover table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
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
                                            <tr class='text-nowrap' id="article_{{ $article['row_id'] }}">
                                                <td><input type="checkbox" class="input-chk"></td>
                                                <td>{{ $article['reference'] }}</td>
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
                                                            <a href="{{ route('admin.articles.show',$article['id']) }}" class="dropdown-item"><i
                                                                    class="la la-eye"></i>Voir</a>
                                                            <a href="{{  route('admin.articles.edit',$article['id']) }}" class="dropdown-item"><i
                                                                    class="la la-pencil"></i> Editer</a>
                                                            <a href="#" class="dropdown-item"><i
                                                                    class="la la-print"></i> Factures</a>
                                                            <a data-url="{{  route('admin.articles.destroy',$article['id']) }}" class="dropdown-item"><i
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
    <!-- Material Data Tables -->
    <div class="row mt-1">
        <div class="col-12 d-flex justify-content-center">

        </div>
    </div>
    @include('includes.delete-modal')
@endsection

@section('page-js')
    <script src="{{ asset('app-assets/vendors/js/tables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/icheck/icheck.min.js') }}"></script>
    {{-- <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}"></script> --}}
@endsection

@section('script')
    <script>
        loadDatatable();
    </script>
@endsection
