@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
@endsection

@section('title')
    Inventaires
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Inventaires',
        'breadcrumbs' => [
            ['text' => 'Inventaire', 'link' => route('admin.inventaires.index')],
            ['text' => 'List', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Nouvelle Vente',
            'link' => route('admin.ventes.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => false,
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
                <h3 class="card-title"> Inventaire D'articles</h3>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    @can('view stock')
                        <a href="{{ route('admin.stocks.index') }}" class="btn btn-secondary btn-sm text-capitalize">
                            Stock
                        </a>
                    @endcan

                    @can('make sale')
                        <a href="{{ route('admin.ventes.index') }}" class="btn btn-secondary btn-sm text-capitalize">
                            Ventes
                        </a>
                    @endcan
                </div>
            </div>
            <div class="card-content collapse show">
                <form action="{{ route('admin.inventaires.checkStock') }}" id="checkStock" novalidate
                    class="needs-validation">
                    <div class="row mx-1">
                        <div class="col-sm-6 col-xl-4">
                            <div class="input-group">
                                <select required name="article_reference" id="article_reference"
                                    class="select2 form-control">
                                    @forelse ($stocks as $stock)
                                        @isset($stock->designation)
                                            <option value="{{ $stock->reference }}">
                                                {{ Str::upper($stock->designation) }}
                                            </option>
                                        @endisset
                                    @empty
                                    @endforelse
                                </select>
                                <div class="invalid-feedback">
                                    Choisir l'article
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5 col-xl-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Qtt</span>
                                </div>
                                <input type="number" value="" id="real_quantity" name="real_quantity"
                                    placeholder="Quantité Reelle" min="0" class="form-control text-dark" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer la quantité reele
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5 col-xl-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Date</span>
                                </div>
                                <input type="date" id="date" value="{{ date('Y-m-d') }}" name="date"
                                    class="form-control" style="padding: 7px" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer la date
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="mt-1">
                                <button type="submit" class="btn btn-lg btn-dark">
                                    Verifier
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="card-body">
                    <div class="bg-dark d-none" style="">
                        <form id="filterInventory" action="{{ route('admin.stocks.index') }}" style="padding: 2px"
                            method="GET">
                            <div class="row">
                                <div class="col-6 col-sm">
                                    <input type="date" value="{{ $between[0] }}" class="form-control h-100 bg-white"
                                        name="start_date">
                                </div>
                                <div class="col-6 col-sm">
                                    <input type="date" value="{{ $between[1] }}" class="form-control h-100 bg-white"
                                        name="end_date">
                                </div>
                                <div class="col-sm">
                                    <select name="filter_type" class="bg-white form-control" id="filterArticle">
                                        <option value="tout">Tout</option>
                                        <option value="article">Article</option>
                                        <option value="bouteille">bouteille</option>
                                        <option value="sortie">Sortie</option>
                                    </select>
                                </div>
                                <div class="col-sm">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-secondary">Filtrer</button>
                                        <a {{-- target="_blink"
                                            href="{{ route('admin.stocks.printReport', [
                                                'start_date' => $between[0],
                                                'end_date' => $between[1],
                                                'filter_type' => request()->get('filter_type'),
                                                'chercher' => request()->get('chercher'),
                                            ]) }}" --}} class="btn btn-light">
                                            Imprimer
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

        
                    <div class="card">
                        <div class="card-body">
                            <table style="width: 100%" data-columns="{{ $columns }}" 
                            class="table table-hover table-sm   table-striped"
                            @isset($tableId) id="{{ $tableId }}" @endisset>
                            <thead class="bg-light">
                                <tr>
                                    @foreach (json_decode($columns, true) as $column)
                                        <th @isset($column['style']) style="{{ $column['style'] }}" @endif>
                                            @if (isset($column['title']))
                                                {{ Str::title($column['title']) }}
                                            @else
                                                {{ str_replace('_', ' ', Str::title($column['data'])) }}
                                            @endif
                                            </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody id="fetchData">
                            </tbody>
                        </table>
                        </div>
                    </div>

                      {{-- @include('includes.datatable.table', [
                        'dataUrl' => route('admin.inventaires.ajaxPostData'),
                    ]) --}}
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade text-left" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel10"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.inventaires.adjustStockRequest') }}" class="needs-validation" novalidate
                method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-secondary white">
                        <h4 class="modal-title white" id="myModalLabel10">Messages</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary"
                            data-dismiss="modal">D'Accord</button>
                        <span id="adjustStock"></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- @include('admin.inventaire.out-form', [
    'articles' => $articles,
    'emballages' => $emballages,
]) --}}

@section('page-js')
    @include('includes.datatable.js')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            loadDatatableAjax();

            $("#checkStock").submit(function(e) {
                // $("input").val("");
                $("")
                e.preventDefault();

                const url = $(this).attr("action");
                const article_reference = $("#article_reference").val();
                const date = $("#date").val();
                const real_quantity = $("#real_quantity").val();
                const data = new FormData(this)

                if (url && article_reference && date && real_quantity) {
                    axios.post(url, data)
                        .then(function(response) {
                            const data = response.data;
                            // console.log(data)
                            let html = "<ul class='list-unstyled'>";
                            if (data.messages.length) {
                                data.messages.forEach(function(message) {
                                    html += `<li>${message}</li>`;
                                })
                            }
                            html += "</ul>";
                            $("#stockModal .modal-body").html(html);
                            $("#stockModal #adjustStock").html(data.submitAjustmentBtn)
                            $("#stockModal").modal("show");
                        })
                        .catch(function(res) {
                            console.log(res)
                        })
                }
            })

            $("#filterInventory").submit(function(e) {
                e.preventDefault();
                const start_date = $("#filterInventory input[name='start_date']").val();
                const end_date = $("#filterInventory input[name='end_date']").val();
                const filter_type = $("#filterInventory select").val();
                console.log(start_date, end_date, filter_type);
            })
            
        })
    </script>
@endsection
