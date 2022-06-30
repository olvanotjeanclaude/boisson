@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
@endsection

@section('title')
    Liste D'Articles
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Produits',
        'breadcrumbs' => [
            ['text' => 'Produits', 'link' => '#'],
            ['text' => 'Articles', 'link' => route('admin.approvisionnement.articles.index')],
            ['text' => 'Liste', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Nouveau Article',
            'link' => route('admin.approvisionnement.articles.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => auth()->user()->can('create', \App\Models\Product::class),
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
                            {{-- <a href="{{ route('admin.factures.index') }}"
                                class="btn btn-secondary btn-sm text-capitalize">
                                <span class="material-icons">
                                    inventory
                                </span>
                                toutes les factures
                            </a> --}}
                            <div class="d-none">
                                <span class="dropdown">
                                    <button id="btnSearchDrop1" type="button" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="true"
                                        class="btn btn-warning btn-sm dropdown-toggle dropdown-menu-right"><i
                                            class="ft-download-cloud white"></i></button>
                                    <span aria-labelledby="btnSearchDrop1" class="dropdown-menu mt-1 dropdown-menu-right">
                                        <a href="#" class="dropdown-item"><i class="la la-calendar"></i> Due Date</a>
                                        <a href="#" class="dropdown-item"><i class="la la-random"></i> Priority </a>
                                        <a href="#" class="dropdown-item"><i class="la la-bar-chart"></i> Balance
                                            Due</a>
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
                                            {{-- <th><input type="checkbox" class="input-chk-all"></th> --}}
                                            <th>Ref</th>
                                            <th>Designation</th>
                                            <th>Prix</th>
                                            <th>Fam</th>
                                            @can('update', $products->first())
                                                <th>Action</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products as $product)
                                            <tr id="row_{{ $product->id }}">
                                                {{-- <td>
                                                    <input type="checkbox" data-id="{{ $product['id'] }}"
                                                        class="input-chk">
                                                </td> --}}
                                                <td>{{ $product->reference }}</td>
                                                <td>{{ $product->designation }}</td>
                                                <td>{{ formatPrice($product->price) }}</td>
                                                <td>{{ $product->category->name }}</td>
                                                @can('update', $product)
                                                    <td>
                                                        <a href="{{ route('admin.approvisionnement.articles.edit', $product->id) }}"
                                                            class="btn btn-info">
                                                            Editer
                                                        </a>
                                                        <button class="btn btn-danger delete-btn"
                                                            data-url="{{ route('admin.approvisionnement.articles.destroy', $product->id) }}"
                                                            data-id="{{ $product->id }}">Supprimer</button>
                                                    </td>
                                                @endcan
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
