@extends('layouts.app')

@section('title')
    {{ $supplier->name }}
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Fournisseurs',
        'breadcrumbs' => [
            ['text' => 'Fournisseurs', 'link' => route('admin.fournisseurs.index')],
            ['text' => 'Editer', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'show' => false,
        ],
    ])
@endsection

@section('content')
    <section>
        <div class="row">
            <div class="col-md-12">
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
                        <h4 class="card-title" id="from-actions-bottom-right">À Propos De L'Fournisseur</h4>
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
                            <form novalidate action="{{ route('admin.fournisseurs.update', $supplier->id) }}" method="POST"
                                class="needs-validation form form-horizontal striped-rows form-bordered">
                                @csrf
                                @method('put')
                                <div class="form-body">
                                    <h4 class="form-section"><i class="ft-user"></i>Informations Générales</h4>
                                   
                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control" for="identification">Identification</label>
                                        <div class="col-md-9">
                                            <input type="text" id="identification" value="{{ $supplier->identification }}"
                                                class="form-control" required placeholder="Identification"
                                                name="identification">
                                            <div class="invalid-feedback">
                                                Le champ identification est obligatoire.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control" for="phone">Numéro De Téléphone</label>
                                        <div class="col-md-9">
                                            <input type="phone" id="phone" value="{{ $supplier->phone }}" required
                                                class="form-control" placeholder="Telephone" name="phone">
                                            <div class="invalid-feedback">
                                                Le numéro de téléphone est obligatoire.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control" for="email">E-mail</label>
                                        <div class="col-md-9">
                                            <input type="text" id="email" value="{{ $supplier->email }}"
                                                class="form-control" placeholder="E-mail" name="email">
                                        </div>
                                    </div>

                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control" for="address">Adresse</label>
                                        <div class="col-md-9">
                                            <input type="text" value="{{ $supplier->address }}" id="address"
                                                class="form-control" placeholder="Adresse" name="address">
                                        </div>
                                    </div>

                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control" for="bank_number">Numéro De Compte
                                            Bancaire</label>
                                        <div class="col-md-9">
                                            <input type="text" id="bank_number" value="{{ $supplier->bank_number }}"
                                                class="form-control" placeholder="Compte Bancaire" name="bank_number">
                                        </div>
                                    </div>

                                    <div class="form-group row mx-auto last">
                                        <label class="col-md-3 label-control" for="note">Note</label>
                                        <div class="col-md-9">
                                            <textarea id="note" rows="3" name="note" class="form-control" placeholder="note">{{ $supplier->note }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions mb-2">
                                    <button type="submit" class="btn float-right btn-primary">
                                        <i class="la la-save"></i> Sauvegarder
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
