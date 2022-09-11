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
        <div class="card mb-0">
            <div class="card-header">
                <h3 class="card-title"> Inventaire D'articles</h3>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    @can('viewAny', \App\Models\SupplierOrders::class)
                        <a href="{{ route('admin.achat-produits.index') }}" class="btn btn-secondary btn-sm text-capitalize">
                            Achat Produits
                        </a>
                    @endcan
                    <a href="{{ route('admin.ventes.index') }}" class="btn btn-secondary btn-sm text-capitalize">
                        Ventes
                    </a>
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
                                    @forelse ($articles as $article)
                                        <option value="{{ $article->reference }}">
                                            {{ Str::upper($article->designation) }}
                                        </option>
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
                    <div class="table-responsive">
                        <table
                            class="table datatable table-striped table-hover table-white-space table-bordered  no-wrap icheck table-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Ref</th>
                                    <th>Designation</th>
                                    <th>Quantité</th>
                                    <th>Ecart</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventories as $inventory)
                                    <tr>
                                        <td>{!! $inventory->status_html !!}</td>
                                        <td>{{ format_date($inventory->date) }}</td>
                                        <td>{{ $inventory->article_reference }}</td>
                                        <td>{{ Str::upper($inventory->article->designation) }}</td>
                                        <td>{{ $inventory->real_quantity }}</td>
                                        <td>{{ $inventory->difference }}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('admin.inventaires.getAdjustStockForm', $inventory->id) }}">
                                                <i class="la la-eye"></i>
                                                Voir
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">D'Accord</button>
                        <span id="adjustStock"></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('page-js')
    @include('includes.datatable.js')
@endsection

@section('script')
    <script>
        loadDatatable(".datatable", ['copy', 'csv', 'excel', 'pdf']);

        $(document).ready(function() {
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

            // $(document).on("click","#submitAjustment",function(){
            //     $("#checkStock").trigger("submit");
            // })
        })
    </script>
@endsection
