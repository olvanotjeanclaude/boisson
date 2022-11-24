@extends('layouts.app')

@section('title')
    Liste des utilisateurs
@endsection

@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-callout.css') }}">
    <style>
        .profil-image {
            margin: 10px;
            vertical-align: middle;
            width: 80px;
            height: 80px;
            border-radius: 50%;
        }
    </style>
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Utilisateurs',
        'breadcrumbs' => [
            ['text' => 'Utilisateurs', 'link' => route('admin.utilisateurs.index')],
            ['text' => 'List', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'nouvel utilisateur',
            'link' => route('admin.utilisateurs.create'),
            'icon' => '<span class="material-icons">person_add</span>',
            'show' => currentUser()->expiration_date == null,
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

        @forelse ($users as $user)
            <div class="col-sm-6 col-md-4 col-xl-3">
                <div class="card" id="row_{{ $user->id }}">
                    <div class="d-flex justify-content-center">
                        <img alt="Card image cap" class="profil-image" src="{{ get_file($user->image) }}">
                    </div>

                    <div class="card-body border-top">
                        <h4 class="card-title text-capitalize">{{ $user->full_name }}</h4>
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="card-text text-uppercase mb-0 font-weight-bold text-dark">
                                {{ $user->permission_access }}</p>
                            @if ($user->status == 0)
                                <span class="badge badge-pill badge-danger">Passif</span>
                            @elseif ($user->status == 1)
                                <span class="badge badge-pill badge-success">Actif</span>
                            @endif
                        </div>
                        <p class="mt-2">{{ $user->email }}</p>
                    </div>
                    <div class="card-actions d-flex mt-2 justify-content-center">
                        {{-- <a class="btn btn-primary" href="{{ route('admin.utilisateurs.show', $user->id) }}">Voir</a> --}}

                        <a class="btn btn-info"
                            href="{{ route('admin.utilisateurs.edit', ['utilisateur' => $user->id]) }}">Editer</a>
                        <button data-id="{{ $user->id }}" parent-id="#user-container" class="btn btn-danger delete-btn"
                            data-url="{{ route('admin.utilisateurs.destroy', $user->id) }}">
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
        @empty
            @include('includes.empty-data-message')
        @endforelse
    </div>
    <div class="row mt-1">
        <div class="col-12 d-flex justify-content-center">
            <div> {{ $users->links() }}</div>
        </div>
    </div>
    @include('includes.delete-modal')
@endsection
