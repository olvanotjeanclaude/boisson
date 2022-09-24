@extends('layouts.app')

@section('title')
    {{ Str::upper($article->designation) }} | Sortie De Stock
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'Inventaires',
        'breadcrumbs' => [
            ['text' => 'Inventaires', 'link' => route('admin.inventaires.index')],
            ['text' => 'Validation De Sortie', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'show' => false,
        ],
    ])
@endsection

@section('content')
    <section>
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
        <div class="row">
            <div class="col-sm-7">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <h4 class="card-title text-white">Information De Sorti De Stock</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mt-1 font-weight-bold">
                                Designation d'Article
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control text-capitalize text-dark" readonly
                                    value="{{ $article->designation }}" id="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-1 font-weight-bold">
                                Reference
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control text-dark" readonly
                                    value="{{ $article->reference }}" id="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-1 text-capitalize font-weight-bold">
                                Quantité à sortir
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control text-dark" readonly
                                    value="{{ $inventory->out }}" id="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-1 font-weight-bold">
                                Status
                            </div>
                            <div class="col-md">
                                <input type="text" class="form-control text-dark" readonly
                                    value="{{ $inventory->status_text }}" id="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-1 font-weight-bold">
                                Date
                            </div>
                            <div class="col-md">
                                <input type="date" class="form-control text-dark" readonly value="{{ $inventory->date }}"
                                    id="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-1 font-weight-bold">
                                Motif
                            </div>
                            <div class="col-md">
                                <textarea name="" id="" class="form-control" readonly>{{ trim($inventory->motif) }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-1 font-weight-bold">
                                Demmandé Par
                            </div>
                            <div class="col-md">
                                <input class="form-control"
                                    value="{{ $inventory->user ? Str::upper($inventory->user->full_name) : '' }}"
                                    readonly />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            @can('valid inventory')
                <div class="col-sm-5">
                    <div class="card">
                        <div class="card-body">
                            <form novalidate action="{{ route('admin.inventaires.validStockOut', $inventory->id) }}"
                                method="POST" class="needs-validation form form-horizontal striped-rows form-bordered">
                                @csrf
                                <div class="col-12 mt-1">
                                    <label class="text-bold-400 text-dark" for="status">Status</label>
                                    <select required name="status" id="status" required class="form-control">
                                        <option value="">Choisir</option>
                                        @forelse (\App\Models\Inventory::STATUS_TEXT as $key => $status)
                                            <option value="{{ \App\Models\Inventory::STATUS[$key] }}"
                                                @if ($inventory->status == \App\Models\Inventory::STATUS[$key]) selected @endif>
                                                {{ $status }}
                                            </option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <div class="invalid-feedback">
                                        Veuillez selectionner le status
                                    </div>
                                </div>

                                <div class="mt-2  d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-save"></i> Ajuster
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            @endcan
        </div>
    </section>
@endsection
