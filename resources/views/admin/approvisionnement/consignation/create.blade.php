@extends('layouts.app')

@section('title')
    Nouveau Emballage
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
        'page' => 'Produits',
        'breadcrumbs' => [
            ['text' => 'Produits', 'link' => '#'],
            ['text' => 'Emballages', 'link' => route('admin.approvisionnement.emballages.index')],
            ['text' => 'Nouveau', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Factures',
            'link' => route('admin.articles.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => false,
        ],
    ])
@endsection

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            @include('component.alert', [
                'type' => 'success',
                'message' => session('success'),
            ])
        @endif
        <div class="card">
            <div class="card-content collpase show">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.approvisionnement.emballages.store') }}"
                        class="form form-horizontal striped-rows form-bordered needs-validation" novalidate>
                        @csrf
                        <div class="form-body">
                            <h4 class="form-section"><i class="la la-clipboard"></i> Nouveau Emballage</h4>

                            <div class="form-group row mx-auto">
                                <label class="col-md-3 label-control" for="designation">Designation</label>
                                <div class="col-md-9">
                                    <input type="text" required id="designation" class="form-control"
                                        placeholder="Nom d’article" name="designation">
                                    <div class="invalid-feedback">
                                        Entrer la designation
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mx-auto">
                                <label class="col-md-3 label-control" for="price">Prix unitaire de vente</label>
                                <div class="col-md-9">
                                    <input type="number" id="price" step="0.001" required class="form-control"
                                        placeholder="Prix de vente" name="price">
                                    <div class="invalid-feedback">
                                        Entrer le prix de vente
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group row mx-auto">
                                <label class="col-md-3 label-control" for="buying_price">Prix D'achat</label>
                                <div class="col-md-9">
                                    <input type="number" id="buying_price" step="0.001" required class="form-control"
                                        placeholder="Prix d'achat" name="buying_price">
                                    <div class="invalid-feedback">
                                        Entrer le prix d'achat
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row mx-auto last">
                                <label class="col-md-3 label-control" for="note">Note</label>
                                <div class="col-md-9">
                                    <textarea id="note" rows="3" class="form-control" name="note" placeholder="Note"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions mb-2">
                            <button type="submit" class="btn btn-primary float-right">
                                <i class="la la-check-square-o"></i> Enregister
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('script')
    <script>
        $(document).ready(function() {
            $(".simpleOrGroup").click(function() {
                if ($(this).val() == "1") {
                    $("#content_id_containter").addClass("d-none");
                    $("#quantityContainer").addClass("d-none");
                    $("#quantity").val(1).prop("required", false);
                } else {
                    $("#content_id_containter").removeClass("d-none");
                    $("#quantityContainer").removeClass("d-none");
                    $("#quantity").prop("required", true);
                }
            })
        })
    </script>
@endsection --}}
