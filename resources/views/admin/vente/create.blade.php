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
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-7">
            <form novalidate class="needs-validation" action="{{ route('admin.ventes.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mt-1">
                                <label class="text-bold-400 text-dark" for="article_type">Type D'Article</label>
                                <select required name="article_type" id="article_type" class="form-control">
                                    @forelse ($articleTypes as $key => $type)
                                        <option value="{{ $key }}">{{ $type }}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <div class="invalid-feedback">
                                    le champ de type d'article ne peut pas être vide
                                </div>
                            </div>
                        </div>

                        <div id="withDeconsignationContainer">
                            <div class="row" id="articleContainer">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-sm-8 mt-1 col-article">
                                            <label class="text-bold-400 text-dark" for="article_reference">Articles</label>
                                            <select name="article_reference"  class="form-control select2"
                                                id="article_reference">
                                                <option value=''>Choisir</option>
                                                @foreach ($articles as $article)
                                                    <option value="{{ $article->reference }}">
                                                        {{ $article->designation }}</option>
                                                @endforeach
                                                @foreach ($packages as $package)
                                                    <option value="{{ $package->reference }}">
                                                       {{ $package->designation }}
                                                    </option>
                                                @endforeach

                                            </select>
                                            <div class="invalid-feedback">
                                                Selectionnez l'article
                                            </div>
                                        </div>

                                        <div class="col-sm-4 mt-1">
                                            <label class="text-bold-400 text-dark" for="quantity">
                                                Quantité
                                            </label>
                                            <input type="number"  placeholder="0" class="form-control"
                                                id="quantity" name="quantity">
                                            <div class="invalid-feedback">
                                                Entrer le nombre de bouteille
                                            </div>
                                        </div>

                                        <div class="col-sm-8 mt-1">
                                            <label class="text-bold-400 text-dark" for="consignation_id">
                                                Consignation
                                            </label>
                                            <select name="consignation_id"  class="form-control select2 text-capitalize"
                                                id="consignation_id">
                                                <option value="">Choisir</option>
                                                @forelse ($consignations as $consignation)
                                                    <option value="{{ $consignation->reference }}">
                                                       {{ $consignation->designation }}
                                                    </option>
                                                @empty
                                                @endforelse
                                            </select>
                                            <div class="invalid-feedback">
                                                Selectionnez la consignation d'article
                                            </div>
                                        </div>
                                        <div class="col-sm-4 mt-1">
                                            <label class="text-bold-400 text-dark" for="consigned_bottle">
                                                Quantité
                                            </label>
                                            <input type="number" placeholder="0" disabled class="form-control"
                                                id="consigned_bottle" name="consigned_bottle">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mt-1">
                                        <div class="custom-control custom-switch">
                                            <input class="custom-control-input" checked id="withBottle" name="withBottle"
                                                type="checkbox">
                                            <span class="custom-control-track"></span>
                                            <label class="custom-control-label" for="withBottle">Le client a-t-il apporté un
                                                emballage ?
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="deconsignationBox">
                                <div class="col-sm-8">
                                    <label class="text-bold-400 text-dark" for="deconsignation_id">
                                        Deconsignation
                                    </label>
                                    <select name="deconsignation_id"  class="form-control select2 text-capitalize"
                                        id="deconsignation_id">
                                        <option value="">Choisir</option>
                                        @forelse ($consignations as $consignation)
                                            <option value="{{ $consignation->reference }}">
                                               {{ $consignation->designation }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="text-bold-400 text-dark" for="received_bottle">
                                            Quantité
                                        </label>
                                        <input type="number"  placeholder="0" class="form-control"
                                            id="received_bottle" name="received_bottle">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="noConsignation" class="d-none">
                            <div class="row">
                                <div class="col-sm-8 mt-1 col-article">
                                    <label class="text-bold-400 text-dark" for="no_consign_ref_id">Articles</label>
                                    <select name="no_consign_ref_id"  class="form-control select2" id="no_consign_ref_id">
                                        <option value=''>Choisir</option>
                                        @foreach ($articles as $article)
                                            <option value="{{ $article->reference }}">
                                                {{ $article->designation }}</option>
                                        @endforeach
                                        @foreach ($packages as $package)
                                            <option value="{{ $package->reference }}">
                                               {{ $package->designation }}
                                            </option>
                                        @endforeach

                                    </select>
                                    <div class="invalid-feedback">
                                        Selectionnez l'article
                                    </div>
                                </div>

                                <div class="col-sm-4 mt-1">
                                    <label class="text-bold-400 text-dark" for="no_consign_quantity">
                                        Quantité
                                    </label>
                                    <input type="number"  placeholder="0" class="form-control"
                                        id="no_consign_quantity" name="no_consign_quantity">
                                    <div class="invalid-feedback">
                                        Entrer le nombre de bouteille
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
            </form>

            <div class="card d-none" id="paymentAndFactureContainer">
                <form action="{{ route('admin.ventes.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="saveData" value="saveData" id="">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="input-group">
                                    <h5 class="mr-2">Nouveau Client?</h5>
                                    <div class="d-inline-block custom-control custom-radio mr-1">
                                        <input type="radio" name="newCustomer" value="1"
                                            class="newCustomer custom-control-input" id="yes">
                                        <label class="custom-control-label" for="yes">Oui</label>
                                    </div>
                                    <div class="d-inline-block custom-control custom-radio">
                                        <input checked type="radio" value="0" name="newCustomer"
                                            class="newCustomer custom-control-input" id="no">
                                        <label class="custom-control-label" for="no">Non</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label class="text-bold-400 text-dark" for="received_at">
                                        Date
                                    </label>
                                    <input type="date" value="{{ date('Y-m-d') }}" class="form-control"
                                        id="received_at" name="received_at">
                                </div>
                            </div>
                            <div class="col-12">
                                <div id="customerBlock" class="">
                                    <select name="customer_id" id="customer_id" class="select2 form-control">
                                        <option value="" selected>Client</option>
                                        @forelse ($customers as $customer)
                                            <option value="{{ $customer->id }}">
                                                {{ $customer->code }}-{{ Str::upper($customer->identification) }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 mt-1 d-none" id="newCustomerBlock">
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="customer_identification">Identification</label>
                                            <input type="text" id="customer_identification"
                                                class="form-control border-primary" placeholder="identification"
                                                name="customer_identification">
                                        </div>
                                    </div>

                                    <div class="col-sm">
                                        <div class="form-group">
                                            <label for="customer_phone">Téléphone</label>
                                            <input type="tel" id="customer_phone" class="form-control border-primary"
                                                placeholder="Numéro De Téléphone" name="customer_phone">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 mt-1">
                                <div class="form-group">
                                    <label for="comment">Commentaire</label>
                                    <textarea name="comment" id="comment" class="form-control" placeholder="Note"></textarea>
                                </div>
                            </div>
                            <div class="col-md-5 d-flex align-items-center">
                                <button type="submit" class="btn form-control my-1 border-top text-white btn-secondary">
                                    <i class="la la-save"></i>
                                    Enregistrer
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-capitalize text-right font-weight-bold">Ticket De Vente</h4>
                    @if (count($preInvoices))
                        <div class="table-responsive">
                            <table class="table p-0 table-sm text-nowrap table-bordered table-striped table-hover">
                                <thead>
                                    <tr class="p-0">
                                        <th>Designation</th>
                                        <th>Prix</th>
                                        <th>Qtt</th>
                                        <th>Sous Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($preInvoices as $preInvoice)
                                        <tr>
                                            <td class="pl-1 py-0 text-capitalize">
                                                {{ $preInvoice->saleable->designation }}
                                            </td>
                                            <td class="pl-1 py-0">
                                                {{ $preInvoice->saleable->price }}
                                                Ar
                                            </td>
                                            <td class="pl-1 py-0">{{ $preInvoice->quantity }}</td>
                                            <td class="pl-1 py-0">
                                                {{ formatPrice($preInvoice->sub_amount) }}
                                            </td>
                                            <td class="pl-1 py-0">
                                                <form method="POST"
                                                    action="{{ route('admin.ventes.destroy', $preInvoice->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit"
                                                        class="btn btn-outline-accent-1 remove-article">
                                                        <span class="material-icons text-danger">
                                                            remove_circle
                                                        </span>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex mt-1 flex-column align-items-end">
                            <span id="amountToPay" data-amount="{{ $amount }}"></span>
                            <span> {{ number_format($amount, 2, ',', ' ') ?? '0' }} Ar</span>
                            <span> {{ number_format($amount * 5, 2, ',', ' ') ?? '0' }} Fmg</span>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-actions float-right">
                                    <button type="button" id="cancelBtn" class="btn btn-warning d-none mr-1">
                                        <i class="ft-x"></i> Anuller
                                    </button>
                                    <button type="button" id="validFacture" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> Enregister
                                    </button>
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="card-text">La désignation, nombre de bouteille et le total se trouve dans cette
                            zone.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    {{-- <script src="{{ asset('app-assets/js/custom/articleController.js') }}"></script> --}}
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $("#article_type").change(function() {
                // $(".form-control").prop("required", false);
                $(".invalid-feedback").text("");

                if ($(this).val() == "1") {
                    // validArticle();
                    console.log("article");
                    $("#articleContainer, #withDeconsignationContainer").removeClass("d-none");
                } else if ($(this).val() == "3") {
                    // validDeconsignation();
                    $("#withDeconsignationContainer").removeClass("d-none");

                    $("#withBottle").prop("checked", true);
                    $("#withBottle").prop("disabled", true);
                    $("#noConsignation, #articleContainer").addClass("d-none");
                } else {
                    // validConsignation();
                    $("#noConsignation").removeClass("d-none");

                    $("#withDeconsignationContainer, #articleContainer").addClass("d-none");
                }
            })


            $(".newCustomer").click(function() {
                if ($(this).val() == "1") {
                    $("#newCustomerBlock").removeClass("d-none");
                    $("#customerBlock").addClass("d-none");
                } else {
                    $("#customerBlock").removeClass("d-none");
                    $("#newCustomerBlock").addClass("d-none");
                }
            })

            $("#withBottle").change(function() {
                if ($(this).prop("checked")) {
                    $("#deconsignationBox").removeClass("d-none");
                    // $("#deconsignationBox .form-control").prop("required", true);
                } else {
                    // $("#deconsignationBox .form-control").prop("required", false);
                    $("#deconsignationBox").addClass("d-none");
                    $("#consigned_bottle").val($("#quantity").val());
                    $("#received_bottle").val(0);
                }
            })

            $("#quantity, #received_bottle").keyup(function() {
                const quantity = $("#quantity").val();
                $("#consigned_bottle").val(quantity);
            });

            $("#validFacture").click(function() {
                $("#addArticle").addClass("d-none");
                $("#paymentAndFactureContainer").removeClass("d-none");
                $(this).removeClass("btn-secondary").addClass("btn-primary");
                $("#cancelBtn").removeClass("d-none");
                $(this).addClass("d-none");
            })

            $("#cancelBtn").click(function() {
                $("#addArticle").removeClass("d-none");
                $("#paymentAndFactureContainer").addClass("d-none");
                $("#validFacture").addClass("btn-secondary").removeClass("btn-primary d-none");
                $(this).addClass("d-none");
            })
        })

        function validArticle() {
            $("#articleContainer .form-control").prop("required", true);
            $("#articleContainer").removeClass("d-none");
            $("#noConsignation .form-control").prop("required", false);
        }

        function validConsignation() {
            $("#noConsignation .form-control").prop("required", true);
            $("#noConsignation").removeClass("d-none");

            $("#withDeconsignationContainer, #articleContainer").addClass("d-none");
        }

        function validDeconsignation() {
            $("#deconsignationBox .form-control").prop("required", true);
            $("#withDeconsignationContainer").removeClass("d-none");

            $("#withBottle").prop("checked", true);
            $("#withBottle").prop("disabled", true);
            $("#noConsignation, #articleContainer").addClass("d-none");
        }
    </script>
@endsection
