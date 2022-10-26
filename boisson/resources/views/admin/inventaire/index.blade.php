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
                    @include('includes.ajax-table.table', [
                        'dataSrc' => route('admin.inventaires.ajaxGetData'),
                        'inputPlaceholder' => 'Reference Ou Designation',
                        'printUrl' => route('admin.inventaires.print'),
                        'downloadUrl' =>route('admin.inventaires.download'),
                    ])
                    {{-- @include('includes.datatable.table', [
                        'dataUrl' => route('admin.inventaires.ajaxPostData'),
                    ]) --}}
                </div>
            </div>
        </div>
    </section>

   @include('admin.inventaire.check-stock-modal')
@endsection


@section('page-js')
    @include('includes.datatable.js')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            loadDatatableAjax();

            $("#checkStock").submit(function(e) {
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
        })
    </script>
@endsection
