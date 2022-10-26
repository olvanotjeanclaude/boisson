@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
@endsection

@section('title')
    Etat D'Emballages
@endsection

@section('page-css')
    <style>
        .input-group-text {
            text-align: center;
            min-width: 65px;
        }

        .card-header {
            padding: 10px !important;
        }

        table input[type='search'] {
            background: #eee;
        }
    </style>
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Etat Emballages',
        'breadcrumbs' => [
            ['text' => 'Etat Emballages', 'link' => route('admin.etat-emballages.index')],
            ['text' => 'Liste', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Nouveau Achat',
            'link' => route('admin.achat-fournisseurs.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => currentUser()->can('enter_stock'),
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
                <h3 class="card-title"> Etat D'Emballages</h3>
                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                </div>
            </div>

            <div class="card-content collapse show">
                <div class="card-body mt-2">
                    <h5>Total Trouvé: {{ $emballages->count() }}</h5>
                    <div class="bg-dark d-non    p-1">
                        <form action="{{ route('admin.etat-emballages.index') }}" method="GET">
                            <div class="row">
                                <div class="col-6 col-sm">
                                    <input type="date" value="{{ request('start_date') ?? $between[0] }}"
                                        class="form-control h-100 bg-white" name="start_date">
                                </div>
                                <div class="col-6 col-sm">
                                    <input type="date" value="{{ request('end_date') ?? $between[1] }}"
                                        class="form-control h-100 bg-white" name="end_date">
                                </div>
                                <div class="col-6 col-sm-4">
                                    <input type="text" value="{{ request()->get('chercher') ?? old('chercher') }}"
                                        name="chercher" placeholder="Reference Ou Designation..." style=""
                                        class="bg-white form-control">
                                </div>
                                <div class="col-sm">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-secondary">
                                            <i class="la la-filter"></i>
                                            Filtrer
                                        </button>
                                        <a target="_blink"
                                            href="{{ route('admin.etat-emballages.printReport', [
                                                'start_date' => request('start_date') ?? $between[0],
                                                'end_date' => request('end_date') ?? $between[1],
                                                'filter_type' => request()->get('filter_type'),
                                                'chercher' => request()->get('chercher'),
                                            ]) }}"
                                            class="btn btn-light">
                                            <i class="la la-print"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive" style="max-height:450px">
                        <table class="table table-striped">
                            <thead class="bg-light">
                                <tr>
                                    <th>Ref</th>
                                    <th>Designation</th>
                                    <th>Entrées</th>
                                    <th>Sortie</th>
                                    <th>Consignation</th>
                                    <th>Deconsignation</th>
                                    <th>En Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($emballages as $emballage)
                                    <tr>
                                        <td>{{ $emballage->reference }}</td>
                                        <td>{{ $emballage->designation }}</td>
                                        <td>{{ $emballage->sum_entry }}</td>
                                        <td>{{ $emballage->sum_out }}</td>
                                        <td>{{ $emballage->sum_consignation }}</td>
                                        <td>{{ $emballage->sum_deconsignation }}</td>
                                        <td>{{ $emballage->final }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            Aucun résultat à afficher!
                                        </td>
                                    </tr>
                                @endforelse
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