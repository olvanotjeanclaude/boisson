@extends('layouts.app')

@section('title')
    {{ $supplier->name }}
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Fournisseurs',
        'breadcrumbs' => [
            ['text' => 'Fournisseurs', 'link' => route('admin.fournisseurs.index')],
            ['text' => 'Detail', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'show' => true,
            'icon' => '<span class="material-icons">edit</span>',
            'text' => 'Editer',
            "link" =>route('admin.fournisseurs.edit',$supplier->id)
        ],
    ])
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-7">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <h6 class="card-title text-bold-600">Identification</h6>
                        </div>
                        <div class="col-sm">
                            <p> {{ $supplier->identification }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <h6 class="card-title text-bold-600">Code</h6>
                        </div>
                        <div class="col-sm">
                            <p> {{ $supplier->code }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <h6 class="card-title text-bold-600">Téléphone</h6>
                        </div>
                        <div class="col-sm">
                            <p> {{ $supplier->phone }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <h6 class="card-title text-bold-600">E-mail</h6>
                        </div>
                        <div class="col-sm">
                            <p> {{ $supplier->email ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <h6 class="card-title text-bold-600">Adresse</h6>
                        </div>
                        <div class="col-sm">
                            <p> {{ $supplier->address ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <h6 class="card-title text-bold-600">Note</h6>
                        </div>
                        <div class="col-sm">
                            <p> {{ $supplier->note ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <h6 class="card-title text-bold-600">Compte Bancaire</h6>
                        </div>
                        <div class="col-sm">
                            <p> {{ $supplier->bank_number ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <h6 class="card-title text-bold-600">Créateur</h6>
                        </div>
                        <div class="col-sm">
                            <p> {{ $supplier->user ? $supplier->user->full_name : '-' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <h6 class="card-title text-bold-600">Date De Création</h6>
                        </div>
                        <div class="col-sm">
                            <p> {{ format_date_time($supplier->created_at) ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <h6 class="card-title text-bold-600">Date De Modification</h6>
                        </div>
                        <div class="col-sm">
                            <p> {{ format_date_time($supplier->updated_at) ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
