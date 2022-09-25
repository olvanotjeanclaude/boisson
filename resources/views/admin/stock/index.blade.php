@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
@endsection

@section('title')
    Etat Du Stock
@endsection

@section('page-css')
    <style>
        .input-group-text {
            text-align: center;
            min-width: 65px;
        }

        .card-header {
            padding: 10px !important;
        }

        table input[type='search'] {
            background: #eee;
        }
    </style>
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Stocks',
        'breadcrumbs' => [
            ['text' => 'Stocks', 'link' => route('admin.stocks.index')],
            ['text' => 'Liste', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Nouveau Stock',
            'link' => route('admin.stocks.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => false,
            // "type" =>"modalBtn",
            // "modalTarget" =>"modalStock"
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @include('includes.error')
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
                    <button type="button" data-target="#settingModal" data-toggle="modal"
                        class="btn  btn-info btn-sm text-capitalize">
                        Minimum Date
                    </button>
                    {{-- @can('viewAny', \App\Models\SupplierOrders::class)
                        <a href="{{ route('admin.achat-produits.index') }}"
                            class="btn btn-secondary btn-sm text-capitalize">
                            Achat Produits
                        </a>
                    @endcan --}}
                    <a href="{{ route('admin.ventes.index') }}" class="btn btn-secondary btn-sm text-capitalize">
                        Ventes
                    </a>
                    <button type="button" data-toggle="modal" data-target="#modalStock"
                        class="btn float-right btn-sm ml-1 btn-primary">
                        <span class="material-icons">add</span>
                        Nouveau Stock
                    </button>
                </div>
            </div>

            <div class="card-content collapse show">
                <div class="card-body mt-2">
                    <div class="bg-dark p-1">
                        <form action="{{ route('admin.stocks.index') }}" method="GET">
                            <div class="row">
                                <div class="col-6 col-sm">
                                    <input type="date" value="{{ request('start_date') ?? $between[0] }}"
                                        class="form-control h-100 bg-white" name="start_date">
                                </div>
                                <div class="col-6 col-sm">
                                    <input type="date" value="{{ request('end_date') ?? $between[1] }}"
                                        class="form-control h-100 bg-white" name="end_date">
                                </div>
                                <div class="col-6 col-sm">
                                    <select name="filter_type" class="bg-white form-control h-100" id="filterArticle">
                                        @foreach (\App\helper\Filter::TYPES as $value)
                                            <option @if ($value == request()->get('filter_type')) selected @endif
                                                value="{{ $value }}">
                                                {{ Str::title($value) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-sm-4">
                                    <input type="text" value="{{ request()->get('chercher') ?? old('chercher') }}"
                                        name="chercher" placeholder="Reference Ou Designation..." style=""
                                        class="bg-white form-control">
                                </div>
                                <div class="col-sm">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-secondary">Filtrer</button>
                                        <a target="_blink"
                                            href="{{ route('admin.stocks.printReport', [
                                                'start_date' => request('start_date') ?? $between[0],
                                                'end_date' => request('end_date') ?? $between[1],
                                                'filter_type' => request()->get('filter_type'),
                                                'chercher' => request()->get('chercher'),
                                            ]) }}"
                                            class="btn btn-light">
                                            Imprimer
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive" style="max-height:450px">
                        <table class="table table-striped">
                            <thead class="bg-light">
                                <tr>
                                    <th>Ref</th>
                                    <th>Type</th>
                                    <th>Designation</th>
                                    <th>Entrées</th>
                                    {{-- <th>Sorti</th> --}}
                                    <th>Vendu</th>
                                    {{-- <th>Emballage?</th> --}}
                                    {{-- <th>Montant</th> --}}
                                    <th>En Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stocks as $stock)
                                    @isset($stock->designation)
                                        <tr>
                                            <td>{{ $stock->article_ref }}</td>
                                            <td>
                                                {{ Str::upper($stock->type) }}
                                            </td>
                                            <td>{{ Str::upper($stock->designation) }}</td>
                                            <td>{{ $stock->sum_entry }}</td>
                                            {{-- <td>{{ $stock->sum_stock_out }}</td> --}}
                                            <td>{{ $stock->sum_out }}</td>
                                            <td>{{ $stock->final }}</td>
                                        </tr>
                                    @endisset
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade text-left" id="settingModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel10"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.settings.update') }}" novalidate class="needs-validation" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-secondary white">
                        <h4 class="modal-title white">Configuration Du Stock</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Nombre minimum de jours de stock par défaut</h5>
                        <div class="form-group">
                            <label for="surname">Nombre De Jour</label>
                            <input type="number" value="{{ \App\Models\Stock::minDateNumber() }}" class="form-control"
                                name="min_stock_day" min="1" required>
                            <div class="invalid-feedback">
                                Entre une nombre valide
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary"
                            data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn  btn-outline-dark">Valider</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @include('admin.stock.modal-create', [
        'articles' => $articles,
        'emballages' => $emballages,
    ])
@endsection

@section('page-js')
    @include('includes.datatable.js')
@endsection

@section('script')
    <script>
        loadDatatable(".datatable", ['copy', 'csv', 'excel', 'pdf']);
    </script>
@endsection
