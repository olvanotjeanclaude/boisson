@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
@endsection

@section('title')
    Etat Du Stock
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Stocks',
        'breadcrumbs' => [
            ['text' => 'Stocks', 'link' => route('admin.stocks.index')],
            ['text' => 'List', 'link' => route('admin.index')],
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
                            @can('viewAny', \App\Models\SupplierOrders::class)
                                <a href="{{ route('admin.achat-produits.index') }}"
                                    class="btn btn-secondary btn-sm text-capitalize">
                                    Achat Produits
                                </a>
                            @endcan
                            <a href="{{ route('admin.ventes.index') }}" class="btn btn-secondary btn-sm text-capitalize">
                                Ventes
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
                                            <th>Date</th>
                                            <th>Ref</th>
                                            <th>Designation</th>
                                            <th>Stock initial</th>
                                            <th>Entrées</th>
                                            <th>Vendu</th>
                                            <th>En Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stocks as $stock)
                                            <tr>
                                                <td>{{ format_date($stock->date) }}</td>
                                                <td>{{ $stock->stockable->reference }}</td>
                                                <td>{{ $stock->stockable->designation }}</td>
                                                <td>{{ $stock->initial }}</td>
                                                <td>{{ $stock->entry }}</td>
                                                <td>{{ $stock->out }}</td>
                                                <td>{{ $stock->final }}</td>
                                            </tr>
                                        @endforeach
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
        loadDatatable(".datatable", ['copy', 'csv', 'excel', 'pdf']);
    </script>
@endsection