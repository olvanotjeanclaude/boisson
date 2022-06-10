@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
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
                            <button type="button" id="deleteIcheckBtn" data-target="#deleteAllModal" data-toggle="modal"
                                data-url="{{ route('admin.articles.destroy', ['article' => 'item']) }}"
                                class="btn delete-btn d-none btn-danger btn-sm text-capitalize">
                                <span class="material-icons">
                                    delete
                                </span>
                                Supprimer
                            </button>
                            <a href="{{ route('admin.achat-produits.index') }}"
                                class="btn btn-secondary btn-sm text-capitalize">
                                <span class="material-icons">
                                    inventory
                                </span>
                                Achat Produits
                            </a>
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
                                            <th>Ref</th>
                                            <th>Designation</th>
                                            <th>Type</th>
                                            <th>Fam</th>
                                            <th>Qtt</th>
                                            <th>PU (Ariary)</th>
                                            <th>Prix (Ariary)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($stocks as $stock)
                                            @php
                                                $article = $stock->stockable;
                                            @endphp
                                            <tr>
                                                <td>{{ $article->reference }}</td>
                                                <td>{{ $article->designation }}</td>
                                                <td>{{ $stock->article_type }}</td>
                                                <td>{{ $article->category->name }}</td>
                                                <td>{{ $stock->quantity }}</td>
                                                <td>{{ formatPrice($stock->buying_price) }}</td>
                                                <td>{{ formatPrice($article->price) }}</td>
                                                <td>
                                                    <span class="dropdown">
                                                        <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="true"
                                                            class="btn btn-primary dropdown-toggle dropdown-menu-right"><i
                                                                class="ft-settings"></i></button>
                                                        <span aria-labelledby="btnSearchDrop2"
                                                            class="dropdown-menu mt-1 dropdown-menu-right">
                                                            {{-- <a href="{{ route('admin.achat-produits.show', $invoice['id']) }}"
                                                                class="dropdown-item"><i
                                                                    class="la la-eye"></i>Voir</a> --}}
                                                            <a href="{{ route('admin.stocks.edit', $stock['id']) }}"
                                                                class="dropdown-item"><i class="la la-pencil"></i>
                                                                Editer
                                                            </a>
                                                           
                                                            <a data-id="{{ $stock['id'] }}"
                                                                data-url="{{ route('admin.stocks.destroy', $stock['id']) }}"
                                                                class="dropdown-item delete-btn"><i
                                                                    class="la la-trash"></i> Supprimer</a>
                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
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
    @include('includes.datatable.js')
@endsection

@section('script')
    <script>
        loadDatatable();
    </script>
@endsection
