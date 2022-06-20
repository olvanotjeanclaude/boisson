@extends('layouts.app')

@section('vendor')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/material-vendors.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
@endsection

@section('title')
    Liste De Clients
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
            'show' => true,
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
                            <table class="table datatable table- text-nowrap  material-table">
                                <thead>
                                    <tr>
                                        <th>Catégorie</th>
                                        <th>Date De Création</th>
                                        <th>ajouté par</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($catArticles as $category)
                                        <tr id="row_{{ $category->id }}">
                                            <td>{{ $category->name }}</td>
                                            <td>{{ format_date_time($category->created_at) }}</td>
                                            <td>{{ $category->user->id != auth()->user()->id ? $category->user->full_name : 'Moi' }}
                                            </td>
                                            <td>
                                                <button
                                                    data-url="{{ route('admin.category-articles.edit', $category->id) }}"
                                                    class="btn btn-info edit-category" data-id="{{ $category->id }}">
                                                    Editer
                                                </button>
                                                <button class="btn btn-danger delete-btn"
                                                    data-url="{{ route('admin.category-articles.destroy', $category->id) }}"
                                                    data-id="{{ $category->id }}">Supprimer</button>
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
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
    <script src="{{ asset('app-assets/vendors/js/tables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
@endsection

@section('script')
    <script>
        loadDatatable();
        $(".edit-category").click(function() {
            const url = $(this).data("url");
            const modalId = $(this).data("modalID");

            if (url) {
                axios.get(url)
                    .then((response) => {
                        $("#ajax-response").html(response.data);
                        $("#editCategory").modal("show");
                    })
                    .catch((response) => {
                        alert("error occured");
                    })
            }
        })
    </script>
@endsection
