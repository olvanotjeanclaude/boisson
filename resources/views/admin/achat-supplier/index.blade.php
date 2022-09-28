@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
@endsection

@section('title')
    Bon De Commande
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Achat Fournisseur',
        'breadcrumbs' => [
            ['text' => "Bon D'Entrée", 'link' => route('admin.achat-fournisseurs.index')],
            ['text' => 'Liste', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Nouveau Achat Fournisseur',
            'link' => route('admin.achat-fournisseurs.create'),
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
                        <h4 class="card-title">Bon D'Entrées</h4>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable table-striped table-hover text-nowrap  material-table">
                                    <thead>
                                        <tr>
                                            <th>Fournisseur</th>
                                            <th>Facture</th>
                                            <th>Ref Facture</th>
                                            <th>Magasinier</th>
                                            <th>Total</th>
                                            <th>Date</th>
                                            <th>Date Système</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($entries as $entry)
                                            <tr>
                                                <td>{{ $entry->supplier ? $entry->supplier->identification : 'Introuvable' }}
                                                </td>
                                                <td>{{ $entry->invoice_number }}</td>
                                                <td>{{ Str::upper($entry->reference_facture) }}</td>
                                                <td>{{ $entry->user ? Str::title($entry->user->full_name) : 'Introuvable' }}
                                                </td>
                                                <td>{{ $entry->sum_article }}</td>
                                                <td>{{ format_date($entry->date) }}</td>
                                                <td>{{ format_date_time($entry->created_at) }}</td>
                                                <td>
                                                    <span class="dropdown">
                                                        <button id="btnSearchDrop2" type="button" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="true"
                                                            class="btn btn-primary dropdown-toggle dropdown-menu-right"><i
                                                                class="ft-settings"></i></button>
                                                        <span aria-labelledby="btnSearchDrop2"
                                                            class="dropdown-menu mt-1 dropdown-menu-right">
                                                            <a href="{{ route('admin.achat-fournisseurs.show', $entry->invoice_number) }}"
                                                                class="dropdown-item"><i class="la la-eye"></i>Facture</a>
                                                            <a target="_blank"
                                                                href="{{ route('admin.achat-fournisseurs.print', $entry->invoice_number) }}"
                                                                class="dropdown-item"><i class="la la-print"></i>
                                                                Imprimer</a>
                                                            <form
                                                                action="{{ route('admin.achat-fournisseurs.cancel', $entry->invoice_number) }}"
                                                                method="POST">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit" class="dropdown-item">
                                                                    <i class="la la-trash"></i>
                                                                    Anuller
                                                                </button>
                                                            </form>
    
                                                        </span>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
        loadDatatable();
    </script>
@endsection
