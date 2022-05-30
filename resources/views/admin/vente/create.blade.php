@extends('layouts.app')

@section('title')
    Nouveau Vente
@endsection

@section('page-css')
    <style>
        table#preInvoice td {
            margin: .4rem auto;
        }

    </style>
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Vente',
        'breadcrumbs' => [
            ['text' => 'Ventes', 'link' => route('admin.ventes.index')],
            ['text' => 'Nouveau', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Factures',
            'link' => route('admin.ventes.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => false,
        ],
    ])
@endsection

@section('content')
    <form preSaveInvoiceUrl="{{ route('admin.ventes.preSaveVente') }}"
        preSaveArticleUrl="{{ route('admin.ventes.preSaveInvoiceVente') }}" action="{{ route('admin.ventes.store') }}"
        class="row" method="POST">

        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mt-1">
                            <label class="text-bold-400 text-dark" for="article_id">Designation d'article</label>
                            <select name="article_id" class="form-control" id="article_id">
                                <option value="">Choisir</option>
                                @foreach ($articles as $article)
                                    <option value="{{ $article->id }}">
                                        {{ Str::upper($article->reference . '-' . $article->designation) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mt-1 consignation-container">
                            <label class="text-bold-400 text-dark" for="consignation_id">Consignation</label>
                            <select name="consignation_id" class="form-control" id="consignation_id">
                                <option value="">Choisir</option>
                                @foreach ($consignations as $consignation)
                                    <option value="{{ $consignation->id }}">
                                        {{ Str::upper($consignation->reference . '-' . $consignation->designation) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6 mt-1">
                            <label class="text-center text-bold-400 text-dark" for="package_type">Emballage
                            </label>
                            <div class="d-flex">
                                <select class="form-control" id="package_type" name="package_type">
                                    <option value="">Choisir</option>
                                    @foreach (\App\Models\Articles::UNITS as $key => $value)
                                        <option value="{{ $value }}">{{ $key }}</option>
                                    @endforeach
                                </select>
                                <input type="number" class="form-control" id="package_type_value"
                                    name="package_type_value" placeholder="0">
                            </div>
                        </div>
                        <div class="col-sm mt-1">
                            <label class="text-bold-400 text-dark" for="package_contenance">Contenance</label>
                            <input type="number" placeholder="0" class="form-control" id="package_contenance"
                                name="package_contenance">
                        </div>
                        <div class="col-sm mt-1">
                            <label class="text-bold-400 text-dark" for="Qtt">Bouteille</label>
                            <input type="number" placeholder="0" class="form-control" id="Qtt" name="received_bottle">
                        </div>
                    </div>

                    

                    <div class="row">
                        <div class="col-12">
                            <label for="" class="mt-1">Le client a-t-il apporté l'emballage ?</label>
                            <div class="">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="d-inline-block custom-control custom-radio mr-1">
                                            <input type="radio" name="is_with_package" value="1"
                                                class="is_with_package custom-control-input" id="yes">
                                            <label class="custom-control-label" for="yes">Oui</label>
                                        </div>
                                        <div class="d-inline-block custom-control custom-radio">
                                            <input checked type="radio" value="0" name="is_with_package"
                                                class="is_with_package custom-control-input" id="no">
                                            <label class="custom-control-label" for="no">Non</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 d-none deconsignation-container">
                            <div class="row">
                                <div class="col-12 mt-1">
                                    <label class="text-bold-400 text-dark" for="deconsignation_id">deconsignation</label>
                                    <select name="deconsignation_id" class="form-control" id="deconsignation_id">
                                        <option value="">Choisir</option>
                                        @foreach ($deconsignations as $deconsignation)
                                            <option value="{{ $deconsignation->id }}">
                                                {{ $deconsignation->reference . '-' . Str::upper($deconsignation->designation) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-sm-6 mt-1">
                                    <label class="text-center text-bold-400 text-dark" for="package_type">Emballage
                                        Reçu</label>
                                    <div class="d-flex">
                                        <select class="form-control" id="package_type" name="package_type">
                                            <option value="">Choisir</option>
                                            @foreach (\App\Models\Articles::UNITS as $key => $value)
                                                <option value="{{ $value }}">{{ $key }}</option>
                                            @endforeach
                                        </select>
                                        <input type="number" class="form-control" id="package_type_value"
                                            name="package_type_value" placeholder="0">
                                    </div>
                                </div>
                                <div class="col-sm mt-1">
                                    <label class="text-bold-400 text-dark" for="package_contenance">Contenance</label>
                                    <input type="number" placeholder="0" class="form-control" id="package_contenance"
                                        name="package_contenance">
                                </div>
                                <div class="col-sm mt-1">
                                    <label class="text-bold-400 text-dark" for="Qtt">Bouteille reçu</label>
                                    <input type="number" placeholder="0" class="form-control" id="Qtt"
                                        name="received_bottle">
                                </div>
                            </div>
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
            <div id="ajaxPreArticleTable"></div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-capitalize">Information du client</h5>
                    <select name="supplier_id" id="supplier_id" class="form-control">
                        <option value="">Client</option>
                        @forelse ($customers as $customer)
                            <option value="{{ $customer->id }}">
                                {{ $customer->code }}-{{ Str::upper($customer->identification) }}
                            </option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="text-capitalize font-weight-bold">Facture</h5>
                    <div id="ajaxPreInvoice">
                        <p class="card-text">La désignation, nombre de bouteille et le total se trouve dans cette zone.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="form-group">
        <!-- Modal error-->
        <div class="modal fade text-left" id="modalMessage" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger white">
                        <h4 class="modal-title white" id="myModalLabel10">Messages</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="printErrors">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-outline-danger d-none">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal success-->
        <div class="modal fade text-left" id="modalSuccess" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success white">
                        <h4 class="modal-title white">Messages</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">D'ACCORD</button>
                        <button type="button" class="btn btn-outline-danger d-none">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $(".is_with_package").click(function() {
                const value = $(this).val();

                if (value == "" || value == "1") {
                    $(".deconsignation-container").removeClass("d-none");
                } else {

                    $(".deconsignation-container").addClass("d-none");
                }
            })
        })
    </script>
@endsection
