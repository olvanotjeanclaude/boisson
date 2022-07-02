@extends('layouts.app')

@section('title')
    Mot De Passe
@endsection

@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-callout.css') }}">
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Mot De Passe',
        'breadcrumbs' => [
            ['text' => 'Mot De Passe', 'link' => route('admin.utilisateurs.index')],
            ['text' => 'List', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'nouvel utilisateur',
            'link' => route('admin.utilisateurs.create'),
            'icon' => '<span class="material-icons">person_add</span>',
            'show' =>false,
        ],
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h4 class="card-title" id="from-actions-bottom-right">Changement De Mot De Passe</h4>
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
        <div class="card-content collpase show">
            <div class="card-body">

                <div class="card-text">
                    @if (session('error'))
                        @include('component.alert', [
                            'type' => 'danger',
                            'message' => session('error'),
                        ])
                    @endif
                    @if (session('success'))
                        @include('component.alert', [
                            'type' => 'success',
                            'message' => session('success'),
                        ])
                    @endif
                </div>

                <form enctype="multipart/form-data" class="form needs-validation" novalidate
                    action="{{ route('admin.password.update') }}" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="form-group col-sm mb-2">
                                <label for="password">Mot De Passe</label>
                                <input type="password" id="password" class="form-control border-primary"
                                    placeholder="Mot De Passe" name="password" required>
                                <div class="invalid-feedback">
                                    Mot de passe est obligatoire.
                                </div>
                            </div>
                            <div class="form-group col-sm mb-2">
                                <label for="re_password">Confirmation Mot Passe</label>
                                <input type="password" id="re_password" class="form-control border-primary"
                                    placeholder="Confirmation Mot De Passe" name="re_password" required>
                                <div class="invalid-feedback">
                                    Le champ confirmation de mot de passe est obligatoire.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions text-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="la la-check-square-o"></i>
                            Sauvegarder
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
