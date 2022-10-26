@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
@endsection

@section('title')
    Categorie d'articles
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Article',
        'breadcrumbs' => [
            ['text' => 'Articles', 'link' => route('admin.articles.index')],
            ['text' => 'Catégories', 'link' => route('admin.category-articles.index')],
            ['text' => 'List', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Nouveau catégorie',
            'link' => route('admin.clients.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => auth()->user()->can('create article'),
            'type' => 'modalBtn',
            'modalTarget' => 'addCategory',
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

            @if ($errors->has('name'))
                @include('component.alert', [
                    'type' => 'danger',
                    'message' => $errors->first('name'),
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
                        <h4 class="card-title">Liste de catégories</h4>
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
                            <div class=" overflow-auto">
                                <table style="width: 100%" data-columns="{{ $columns }}"
                                    data-url="{{ route('admin.category-articles.ajaxPostData') }}"
                                    class="table table-hover table-sm  ajax-datatable table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 45%">Catégorie</th>
                                            <th style="width: 25%">Date De Création</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="ajax-response"></div>

    @include('admin.article.category.modal.add-category-article')
    @include('includes.delete-modal')
@endsection

@section('page-js')
    @include('includes.datatable.js')
@endsection

@section('script')
    <script src="{{asset('mix/js/article-category.js')}}"></script>
@endsection
