@extends('layouts.app')

@section('title')
    {{ $user->full_name }}
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Profile',
        'breadcrumbs' => [
            ['text' => 'Profile', 'link' => route('admin.profile.index')],
            ['text' => 'Editer', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'show' => false,
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
                </div>

                <form enctype="multipart/form-data" class="form needs-validation" novalidate
                    action="{{ route('admin.profile.update') }}" method="POST">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="form-group col-sm-6 col-xl-4 mb-2">
                                <label for="name">Nom</label>
                                <input type="text" id="name" class="form-control border-primary" placeholder="Nom"
                                    name="name" value="{{ $user->name }}" required>
                                <div class="invalid-feedback">
                                    Le champ nom est obligatoire.
                                </div>
                            </div>
                            <div class="form-group col-sm-6 col-xl-4 mb-2">
                                <label for="surname">Prénom</label>
                                <input type="text" id="surname" value="{{ $user->surname }}"
                                    class="form-control border-primary" placeholder="Prénom" name="surname" required>
                                <div class="invalid-feedback">
                                    Le champ prenom est obligatoire.
                                </div>
                            </div>
                            <div class="form-group col-sm-6 col-xl-4 mb-2">
                                <label for="identity_number">Carte d'identité nationale</label>
                                <input type="text" id="identity_number" class="form-control border-primary"
                                    placeholder="Carte d'identité nationale" value="{{ $user->identity_number }}"
                                    name="identity_number" required>
                                <div class="invalid-feedback">
                                    Le champ carte d'identité est obligatoire.
                                </div>
                            </div>
                            <div class="form-group col-sm-6 mb-2">
                                <label for="birth_date">Date De naissance</label>
                                <input type="date" id="birth_date" class="form-control" value="{{ $user->birth_date }}"
                                    name="birth_date" data-toggle="tooltip" data-trigger="hover" data-placement="top"
                                    data-title="Date Opened" required>
                                <div class="invalid-feedback">
                                    Le champ date de naissance est obligatoire.
                                </div>
                            </div>
                           
                            <div class="form-group col-sm-6 mb-2">
                                <label for="permission_access">Status</label>
                                <select id="permission_access" name="status" required class="form-control border-primary">
                                    <option value="" disabled="">Choisir</option>
                                    <option @if ($user->status == 0) selected @endif value="0">Passif</option>
                                    <option @if ($user->status == 1) selected @endif value="1">Actif</option>
                                </select>
                                <div class="invalid-feedback">
                                    Choisir le status de l'utilisateur
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 mb-2">
                                <label for="email">Email</label>
                                <input class="form-control border-primary" value="{{ $user->email }}" required
                                    type="email" name="email" placeholder="email" id="email">
                                <div class="invalid-feedback">
                                    Entrer l'email
                                </div>
                            </div>
                            <div class="form-group col-md-6 mb-2">
                                <label for="phone">Numéro De Téléphone</label>
                                <input class="form-control border-primary" value="{{ $user->phone }}" required
                                    type="phone" name="phone" placeholder="phone" id="phone">
                                <div class="invalid-feedback">
                                    Entrer le numero de téléphone
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 mb-2">
                                <label for="address">Adresse</label>
                                <div class="position-relative has-icon-left">
                                    <textarea id="address" rows="2" required class="form-control" name="address" placeholder="notes">{{ $user->address }}</textarea>
                                    <div class="form-control-position">
                                        <i class=" ft-map-pin"></i>
                                    </div>
                                    <div class="invalid-feedback">
                                        Entrer l'adresse
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8 mb-2">
                                <label for="note">Notes</label>
                                <div class="position-relative has-icon-left">
                                    <textarea id="note" rows="2" class="form-control" name="note" placeholder="notes">{{ $user->note }}</textarea>
                                    <div class="form-control-position">
                                        <i class="ft-file"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group col-12 mb-2">
                                    <label>Photo De Profile</label>
                                    <label id="projectinput8" class="file center-block">
                                        <input type="file" id="file" name="image"
                                            class="form-control form-control-file">
                                        <span class="file-custom"></span>
                                    </label>
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
