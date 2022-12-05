@extends('layouts.app')

@section('title')
    Mon Profile
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Profile',
        'breadcrumbs' => [
            ['text' => 'Profile', 'link' => route('admin.profile.index')],
        ],
        'actionBtn' => [
            'show' => false,
        ],
    ])
@endsection

@section('content')
    <div class="col-12">
        @if (session('success'))
            @include('component.alert', [
                'type' => 'success',
                'message' => session('success'),
            ])
        @endif
    </div>
    <div class="card">
        <div class="card-header bg-transparent d-flex justify-content-end">
            <a href="{{ route('admin.profile.edit') }}" class="btn  btn-info">
                <i class="la la-edit"></i>
                Editer
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                    <div class="profile-image">
                        <img class="img img-fluid" src="{{ get_file($user->image) }}" alt="Profile Image">
                    </div>
                    <div class="mt-2">
                        @if ($user->status == 0)
                            <span class="badge badge-pill badge-danger">Passif</span>
                        @elseif ($user->status == 1)
                            <span class="badge badge-pill badge-success">Actif</span>
                        @endif
                    </div>
                    <hr>
                    <div class="mt-2">
                        <h6 class="text-capitalize">Permission</h6>
                        <p class="text-muted">{{ Str::title($user->permission_access) }}</p>
                    </div>
                    <hr>
                    <div class="mt-2">
                        <h6 class="text-capitalize">Date de création</h6>
                        <p class="text-muted">
                            {{ format_date($user->created_at) }}
                        </p>
                    </div>

                    @if ($user->expiration_date)
                        <div class="mt-2">
                            <h6 class="text-capitalize">Date D'Expiration</h6>
                            <p class="text-muted">
                                {{ format_date($user->expiration_date) }}
                            </p>
                        </div>
                    @endif
                </div>

                <div class="col-md-8 col-lg-9">
                    <section>
                        <h4 class="text-capitalize">
                            {{ Str::upper($user->full_name) }}
                        </h4>
                        <p class="text-muted small">
                            {{ $user->description }}
                        </p>
                    </section>

                    <hr>

                    <section>
                        <div class="row my-2">
                            <h6 class="text-info ml-1">INFORMATIONS DE CONTACT</h6>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>Telephone : </p>
                            </div>
                            <div class="col">
                                <p>
                                    <a href="{{ $user->phone }}">{{ $user->phone }}</a>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6 class="text-capitalize">Email : </h6>
                            </div>
                            <div class="col">
                                <p>{{ $user->email }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6 class="text-capitalize">Adresse : </h6>
                            </div>
                            <div class="col">
                                <p>{{ $user->address }}</p>
                            </div>
                        </div>
                    </section>

                    <hr>

                    <section>
                        <div class="row my-2">
                            <h6 class="text-info ml-1">INFORMATIONS DE BASE</h6>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6 class="text-capitalize">Date De Naissance : </h6>
                            </div>
                            <div class="col">
                                <p>{{ format_date($user->birth_date) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <h6 class="text-capitalize">numéro d'identité : </h6>
                            </div>
                            <div class="col">
                                <p>{{ $user->identity_number }}</p>
                            </div>
                        </div>
                    </section>

                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection
