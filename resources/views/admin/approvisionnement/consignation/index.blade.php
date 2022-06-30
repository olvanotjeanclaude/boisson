@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
@endsection

@section('title')
    Liste de Emballages
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Emballages',
        'breadcrumbs' => [
            ['text' => 'Produits', 'link' => '#'],
            ['text' => 'Emballage', 'link' => route('admin.approvisionnement.emballages.index')],
            ['text' => 'List', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Nouveau',
            'link' => route('admin.approvisionnement.emballages.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => auth()->user()->can('create', \App\Models\Emballage::class),
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
                        <h4 class="card-title"> Liste D'Emballages</h4>
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
                            {{-- <a href="{{ route('admin.factures.index') }}"
                                class="btn btn-secondary btn-sm text-capitalize">
                                <span class="material-icons">
                                    inventory
                                </span>
                                toutes les factures
                            </a> --}}
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
                                            {{-- <th><input type="checkbox" class="input-chk-all"></th> --}}
                                            <th>Ref</th>
                                            <th>Designation</th>
                                            <th>Prix</th>
                                            <th>Fam</th>
                                            @can('update', $consignations->first())
                                                <th>Action</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($consignations as $consignation)
                                            <tr id="row_{{ $consignation->id }}">
                                                {{-- <td>
                                                    <input type="checkbox" data-id="{{ $consignation['id'] }}"
                                                        class="input-chk">
                                                </td> --}}
                                                <td>{{ $consignation->reference }}</td>
                                                <td>{{ $consignation->designation }}</td>
                                                <td>{{ formatPrice($consignation->price) }}</td>
                                                <td>{{ $consignation->category->name ?? '-' }}</td>
                                                @can('update', $consignation)
                                                    <td>
                                                        <a href="{{ route('admin.approvisionnement.emballages.edit', $consignation->id) }}"
                                                            class="btn btn-info">
                                                            Editer
                                                        </a>
                                                        <button class="btn btn-danger delete-btn"
                                                            data-url="{{ route('admin.approvisionnement.emballages.destroy', $consignation->id) }}"
                                                            data-id="{{ $consignation->id }}">Supprimer</button>
                                                    </td>
                                                @endcan
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
