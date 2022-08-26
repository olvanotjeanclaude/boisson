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
        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <h3 class="card-title"> Inventaire D'articles</h3>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
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
                        <form action="{{ route('admin.inventaires.checkStock') }}" id="checkStock" novalidate
                            class="needs-validation">
                            <div class="row m-1">
                                <div class="col-sm-6 col-xl-4">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Article</span>
                                        </div>
                                        <select required name="article_id" id="article_id" class="form-control">
                                            <option value="">Choisir</option>
                                            <option value="1">TAVOANGY</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Type d'article ne peut pas être vide
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-5 col-xl-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Qtt</span>
                                        </div>
                                        <input type="number" value="" name="real_quantity"
                                            placeholder="Quantité Reelle d'article" min="0"
                                            class="form-control text-dark" required>
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
                                        <input type="date" value="{{date('Y-m-d')}}" name="date" class="form-control"
                                            style="padding: 7px" required>
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
                                            <th>Qté Ajouté </th>
                                            <th>Ecart</th>
                                            <th>Motif</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
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

        $(document).ready(function() {
            let data = {};

            $("#checkStock").submit(function(e) {
                e.preventDefault();
                const url = $(this).attr("action");
                const data = new FormData(this)
             
                if (url) {
                    axios.post(url, data)
                        .then(function(response) {
                            console.log(response.data)
                        })
                        .catch(function(res) {
                            console.log(res)
                        })
                }
            })
        })
    </script>
@endsection
