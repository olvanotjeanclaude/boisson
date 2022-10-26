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
            'show' => auth()->user()->can('create emballage'),
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
                            @include('includes.datatable.table', [
                                'dataUrl' => route('admin.approvisionnement.emballages.ajaxPostData'),
                            ])
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