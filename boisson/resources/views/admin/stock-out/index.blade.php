@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
@endsection

@section('title')
    Sortie De Stock
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Stocks',
        'breadcrumbs' => [
            ['text' => 'Sorti Stocks', 'link' => route('admin.sorti-stocks.index')],
            ['text' => 'Liste', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Nouveau Sorti',
            'link' => route('admin.sorti-stocks.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => true,
            // "type" =>"modalBtn",
            // "modalTarget" =>"modalStock"
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
                <h3 class="card-title">Bon de sortie</h3>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <button type="button" id="deleteIcheckBtn" data-target="#deleteAllModal" data-toggle="modal"
                        data-url="{{ route('admin.articles.destroy', ['article' => 'item']) }}"
                        class="btn d-none delete-btn  btn-danger btn-sm text-capitalize">
                        <span class="material-icons">
                            delete
                        </span>
                        Supprimer
                    </button>
                    @can('view all')
                        <button type="button" data-target="#settingModal" data-toggle="modal"
                            class="btn  btn-info btn-sm text-capitalize">
                            Minimum Date
                        </button>
                    @endcan

                    @can('enter_stock')
                        <a href="{{ route('admin.achat-fournisseurs.create') }}" class="btn btn-primary btn-sm text-capitalize">
                            Nouveau Bon d'entrée
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
                <div class="card-body mt-2">
                    <div class="table-responsive">
                        <table style="width: 100%" class="table datatable table-hover table-sm table-striped">
                            <thead class="bg-light">
                                <tr>
                                    <th>Status</th>
                                    <th>Magasinier</th>
                                    <th>Numero</th>
                                    <th>Designation</th>
                                    <th>Qte</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stockOuts as $out)
                                    @isset($out->stockable)
                                        <tr>
                                            <td>{!! $out->status_html !!}</td>
                                            <td>{{ $out->user ? Str::title($out->user->full_name) : 'Introuvable' }}
                                            </td>
                                            <td>{{ $out->invoice_number }}</td>
                                            <td>{{ $out->stockable->designation }}</td>
                                            <td>{{ $out->out }}</td>
                                            <td>{{ format_date($out->date) }}</td>
                                            <td>
                                                <span class="dropdown">
                                                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="true"
                                                        class="btn btn-primary dropdown-toggle dropdown-menu-right"><i
                                                            class="ft-settings"></i></button>
                                                    <span aria-labelledby="btnSearchDrop2"
                                                        class="dropdown-menu mt-1 dropdown-menu-right">
                                                        <a href="{{ route('admin.sorti-stocks.show', $out['invoice_number']) }}"
                                                            class="dropdown-item"><i class="la la-eye"></i>
                                                            Voir
                                                        </a>
                                                        <a href="{{ route('admin.sorti-stocks.download', $out->invoice_number) }}"
                                                            class="dropdown-item">
                                                            <i class="la la-download"></i>
                                                            Telecharger
                                                        </a>
                                                        <a href="{{ route('admin.sorti-stocks.print', $out->invoice_number) }}"
                                                            target="_blank" class="dropdown-item">
                                                            <i class="la la-print"></i>
                                                            Imprimer
                                                        </a>
                                                        @if ($out->status != App\Models\Stock::STATUS['canceled'])
                                                            <form method="POST"
                                                                action="{{ route('admin.sorti-stocks.cancel', $out->invoice_number) }}">
                                                                @csrf
                                                                <button class="dropdown-item" type="submit">
                                                                    <i class="la la-close"></i>
                                                                    Annuler
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </span>
                                                </span>
                                            </td>
                                        </tr>
                                    @endisset
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page-js')
    @include('includes.datatable.js')
@endsection

@section('script')
    <script>
        loadDatatable(".datatable", ['copy', 'csv', 'excel', 'pdf']);
    </script>
@endsection
