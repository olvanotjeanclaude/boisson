@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
@endsection

@section('title')
    Liste de tarif Fournisseur
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Tarif Fournisseurs',
        'breadcrumbs' => [
            ['text' => 'Tarif Fournisseurs', 'link' => route('admin.tarif-fournisseurs.index')],
            ['text' => 'List', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Nouveau',
            'link' => route('admin.tarif-fournisseurs.create'),
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
                        <h4 class="card-title"> Tarif Fournisseurs</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <button type="button" id="deleteIcheckBtn" data-target="#deleteAllModal" data-toggle="modal"
                                data-url="{{ route('admin.articles.destroy', ['article' => 'item']) }}"
                                class="btn delete-btn d-none btn-danger btn-sm text-capitalize">
                                <span class="material-icons">
                                    delete
                                </span>
                                Supprimer
                            </button>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <!-- Invoices List table -->
                            <div class="table-responsive">
                                <table
                                    class="table datatable table-striped table-hover table-white-space table-bordered  no-wrap icheck table-middle">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Founrisseur</th>
                                            <th>Article</th>
                                            <th>Prix D'Achat</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($tarifs as $tarif)
                                            <tr id="row_{{ $tarif->id }}">
                                                <td>{{ $tarif->supplier->identification }}</td>
                                                <td>{{ $tarif->product->designation }}</td>
                                                <td>{{ formatPrice($tarif->buying_price) }}</td>
                                                <td>
                                                    <span class="dropdown">
                                                        <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="true"
                                                            class="btn btn-primary dropdown-toggle dropdown-menu-right"><i
                                                                class="ft-settings"></i></button>
                                                        <span aria-labelledby="btnSearchDrop2"
                                                            class="dropdown-menu mt-1 dropdown-menu-right">
                                                            <a href="{{ route('admin.tarif-fournisseurs.edit', $tarif['id']) }}"
                                                                class="dropdown-item"><i class="la la-pencil"></i>
                                                                Editer
                                                            </a>

                                                            <a data-id="{{ $tarif['id'] }}"
                                                                data-url="{{ route('admin.tarif-fournisseurs.destroy', $tarif['id']) }}"
                                                                class="dropdown-item delete-btn"><i class="la la-trash"></i>
                                                                Supprimer</a>
                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!--/ Invoices table -->
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
        loadDatatable();
    </script>
@endsection
