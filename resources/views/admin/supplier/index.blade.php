@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
@endsection

@section('title')
    Liste De Fournisseurs
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Fournisseur',
        'breadcrumbs' => [
            ['text' => 'Fournisseur', 'link' => route('admin.fournisseurs.index')],
            ['text' => 'List', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Nouveau Fournisseur',
            'link' => route('admin.fournisseurs.create'),
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
                        <h4 class="card-title"> Liste De Fournisseurs</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                {{-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> --}}
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                {{-- <li><a data-action="close"><i class="ft-x"></i></a></li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('includes.datatable.table', [
                                'dataUrl' => route('admin.fournisseurs.ajaxPostData'),
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Material Data Tables -->
    <div class="row mt-1">
        <div class="col-12 d-flex justify-content-center">

        </div>
    </div>
    @include('includes.delete-modal')
@endsection

@section('page-js')
    @include('includes.datatable.js')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            loadDatatableAjax();
        })
    </script>
@endsection
