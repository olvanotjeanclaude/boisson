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
                        <h3 class="card-title"> Liste D'articles</h3>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <button type="button" id="deleteIcheckBtn" data-target="#deleteAllModal" data-toggle="modal"
                                data-url="{{ route('admin.articles.destroy', ['article' => 'item']) }}"
                                class="btn d-none delete-btn  btn-danger btn-sm text-capitalize">
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
                        <form action="{{ route('admin.stocks.index') }}" method="get">
                            <div class="col-11 col-sm-7 col-md-10">
                                <div class="d-flex justify-content-start align-items-center">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Debut</span>
                                        </div>
                                        <input type="date" value="{{ $between[0] }}" name="start_date"
                                            class="form-control bg-light" placeholder="Username" aria-label="Username">
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Fin</span>
                                        </div>
                                        <input type="date" value="{{ $between[1] }}" name="end_date"
                                            class="form-control bg-light" placeholder="Username" aria-label="Username">
                                    </div>

                                    <div class="ml-2" style="margin-top: 10px">
                                        <button type="submit" class="btn btn-sm btn-outline-dark">
                                            Filtrer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="card-body">
                            <ul class="nav nav-justified nav-tabs" id="justifiedTab" role="tablist">
                                <li class="nav-item">
                                    <a aria-controls="default" aria-selected="true" class="nav-link active"
                                        data-toggle="tab" href="#default" id="default-tab" role="tab">Produits &
                                        Packages</a>
                                </li>
                                <li class="nav-item">
                                    <a aria-controls="bottle" aria-selected="false" class="nav-link" data-toggle="tab"
                                        href="#bottle" id="bottle-tab" role="tab">Bouteille</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="justifiedTabContent">
                                <div aria-labelledby="default-tab" class="tab-pane fade show active" id="default"
                                    role="tabpanel">
                                    <!-- Invoices List table -->
                                    <div class="table-responsive">
                                        <table
                                            class="table datatable table-striped table-hover table-white-space table-bordered  no-wrap icheck table-middle">
                                            <thead class="bg-light">
                                                <tr>
                                                    {{-- <th>Date</th> --}}
                                                    <th>Ref</th>
                                                    <th>Designation</th>
                                                    <th>Entrées</th>
                                                    <th>Vendu</th>
                                                    {{-- <th>Montant</th> --}}
                                                    <th>En Stock</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($stocks as $stock)
                                                    <tr>
                                                        {{-- <td>{{ format_date($stock->date) }}</td> --}}
                                                        <td>{{ $stock->article_reference }}</td>
                                                        <td>{{ Str::upper($stock->designation) }}</td>
                                                        <td>{{ $stock->sum_entry }}</td>
                                                        <td>{{ $stock->sum_out }}</td>
                                                        {{-- <td>{{ formatPrice($stock->amount) }}</td> --}}
                                                        <td>{{ $stock->final }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--/ Invoices table -->
                                </div>

                                <div aria-labelledby="bottle-tab" class="tab-pane fade" id="bottle" role="tabpanel">
                                    <div class="table-responsive">
                                        <table
                                            class="table datatable table-striped table-hover table-white-space table-bordered  no-wrap icheck table-middle">
                                            <thead class="bg-light">
                                                <tr>
                                                    {{-- <th>Date</th> --}}
                                                    <th>Ref</th>
                                                    <th>Designation</th>
                                                    <th>Quantite</th>
                                                    <th>Etat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($bottles as $bottle)
                                                    <tr>
                                                        <td>{{ $bottle->article_reference }}</td>
                                                        <td>{{ $bottle->designation }}</td>
                                                        <td>{{ $bottle->sum_bottle }}</td>
                                                        <td>{{ $bottle->isWithEmballage ? 'Deconsigné' : 'Consigné' }}</td>
                                                    </tr>
                                                @empty
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
