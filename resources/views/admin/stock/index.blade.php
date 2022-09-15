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
            <div class="col-md-8 col-xl-9">
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
                        </div>
                    </div>
                  
                    <div class="card-content collapse show">
                        <div class="card-body mt-2">
                            <div class="table-responsive">
                                <table data-columns="{{ $collumns }}" data-url="{{ route('admin.stocks.getData') }}"
                                    class="table datatable ajax-datatable table-striped table-hover table-white-space table-bordered  no-wrap icheck table-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Ref</th>
                                            <th>Type</th>
                                            <th>Designation</th>
                                            <th>Entrées</th>
                                            <th>Vendu</th>
                                            {{-- <th>Montant</th> --}}
                                            <th>En Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($stocks as $stock)
                                            @isset($stock->designation)
                                                <tr>
                                                    <td>{{ $stock->article_ref }}</td>
                                                    <td>{{ Str::upper($stock->type ?? '-') }}</td>
                                                    <td>{{ Str::upper($stock->designation) }}</td>
                                                    <td>{{ $stock->sum_entry }}</td>
                                                    <td>{{ $stock->sum_out }}</td>
                                                    <td>{{ $stock->final }}</td>
                                                </tr>
                                            @endisset
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-xl-3">
                <form action="{{ route('admin.stocks.index') }}" method="get">
                    <div class="form-group">
                        <div class="input-group bg-white p-0 m-0">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-white">Debut</span>
                            </div>
                            <input type="date" value="{{ $between[0] }}" class="form-control" name="start_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group bg-white p-0 m-0">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-dark text-white">Fin</span>
                            </div>
                            <input type="date" value="{{ $between[1] }}" class="form-control small" name="end_date">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-dark mt-1 mt-sm-0 w-100 h-100">Filtrer</button>
                    </div>
                </form>

                <form novalidate class="needs-validation" action="{{ route('admin.stocks.store') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="text-bold-400 text-dark mb-1" for="article_reference">Articles</label>
                                <select name="article_reference" required class="select2 form-control articleBySupplier"
                                    id="article_reference">
                                    <option value=''>Choisir</option>
                                    @foreach ($articles as $article)
                                        <option value="{{ $article->reference }}">{{ $article->designation }}</option>
                                    @endforeach
                                    @foreach ($emballages as $emballage)
                                        <option value="{{ $emballage->reference }}">{{ $emballage->designation }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Selectionnez l'article
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="text-bold-400 text-dark" for="quantity">
                                    Quantité
                                </label>
                                <input type="number" placeholder="0" class="form-control" required id="quantity"
                                    name="quantity">
                                <div class="invalid-feedback">
                                    Entrer le nombre de bouteille
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" id="addArticle" class="btn float-right my-1 btn-primary">
                                        <span class="material-icons">add</span>
                                        Ajouter
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
                            <input type="number" class="form-control" name="min_stock_day" min="1" required>
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
    @include('includes.delete-modal')
@endsection

@section('page-js')
    @include('includes.datatable.js')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            loadDatatableAjax();
        })
    </script>
@endsection
