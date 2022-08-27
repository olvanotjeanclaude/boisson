@extends('layouts.app')

@section('title')
    {{ Str::upper($article->designation) }} | Ajustement d'inventaire
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Inventaires',
        'breadcrumbs' => [
            ['text' => 'Inventaires', 'link' => route('admin.inventaires.index')],
            ['text' => 'Nouveau', 'link' => route('admin.index')],
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
                        <h4 class="card-title" id="from-actions-bottom-right">Formulaire D'Ajustement De Stock</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collpase show">
                        <div class="card-body">
                            <form novalidate action="{{ route('admin.inventaires.adjustStock') }}" method="POST"
                                class="needs-validation form form-horizontal striped-rows form-bordered">
                                @csrf
                                <div class="form-body">
                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control" for="article_ref">
                                            Articles
                                        </label>
                                        <div class="col-md-9">
                                            <input type="hidden" name="article_ref" value="{{ $article->reference }}"
                                                id="">
                                            <input type="text" id="text"
                                                value="{{ Str::upper($article->designation) }}" readonly
                                                class="form-control">
                                            <div class="invalid-feedback">
                                                Article est obligatoire.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control" for="date">Date</label>
                                        <div class="col-md-9">
                                            <input type="date" id="date" value="{{ request()->get('date') }}"
                                                required class="form-control" name="date" readonly>
                                            <div class="invalid-feedback">
                                                Date est obligatoire.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mx-auto">
                                        <label class="col-md-3 label-control" for="real_quantity">Quantité Réelle</label>
                                        <div class="col-md-9">
                                            <input type="number" id="real_quantity" required class="form-control"
                                                name="real_quantity">
                                            <div class="invalid-feedback">
                                                Quantité réelle est obligatoire.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mx-auto last">
                                        <label class="col-md-3 label-control" for="note">Note</label>
                                        <div class="col-md-9">
                                            <textarea id="note" rows="3" name="note" class="form-control" placeholder="note"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-save"></i> Ajuster
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
