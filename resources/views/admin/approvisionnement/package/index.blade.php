@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
@endsection

@section('title')
    Liste de packages
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Packages',
        'breadcrumbs' => [
            ['text' => 'Produits', 'link' => '#'],
            ['text' => 'Packages', 'link' => route('admin.approvisionnement.packages.index')],
            ['text' => 'List', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Nouveau',
            'link' => route('admin.approvisionnement.packages.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => auth()->user()->can('create', \App\Models\Package::class),
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
                        <h4 class="card-title"> Liste De packages</h4>
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
                                            <th><input type="checkbox" class="input-chk-all"></th>
                                            <th>Ref</th>
                                            <th>Designation</th>
                                            <th>Contenance</th>
                                            <th>Prix De Gros</th>
                                            <th>Fam</th>
                                            @can('update', $packages->first())
                                                <th>Action</th>
                                            @endcan
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($packages as $package)
                                            <tr id="row_{{ $package->id }}">
                                                <td>
                                                    <input type="checkbox" data-id="{{ $package['id'] }}"
                                                        class="input-chk">
                                                </td>
                                                <td>{{ $package->reference }}</td>
                                                <td>{{ $package->designation }}</td>
                                                <td>{{ $package->contenance }}</td>
                                                <td>{{ $package->price }}</td>
                                                <td>{{ $package->category->name ?? '-' }}</td>
                                                @can('update', $package)
                                                    <td>
                                                        <a href="{{ route('admin.approvisionnement.packages.edit', $package->id) }}"
                                                            class="btn btn-info">
                                                            Editer
                                                        </a>
                                                        <button class="btn btn-danger delete-btn"
                                                            data-url="{{ route('admin.approvisionnement.packages.destroy', $package->id) }}"
                                                            data-id="{{ $package->id }}">Supprimer</button>
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
