<div class="card">
    <div class="card-header bg-dark">
        <form action="{{ route('admin.index') }}" method="GET">
            <input type="hidden" value="{{ $between[0] }}" class="form-control" name="start_date">
            <input type="hidden" value="{{ $between[1] }}" class="form-control" name="end_date">
            <div class="row">
                <div class="col-6">
                    <input type="text" value="{{ request()->get('chercher') }}" name="chercher"
                        placeholder="Reference Ou Designation..." style="" class="bg-white form-control">
                </div>
                <div class="col">
                    <select name="filter_type" class="bg-white form-control" id="filterArticle">
                        @foreach (\App\helper\Filter::TYPES as $value)
                        @if ($value=="sorti")
                            @continue
                        @endif
                            <option @if ($value == request()->get('filter_type')) selected @endif value="{{ $value }}">
                                {{ Str::title($value) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <div class="d-flex mt-1 mt-sm-0">
                        <button type="submit" class="btn btn-secondary">Filtrer</button>
                        <a target="_blink"
                            href="{{ route('admin.dashboard.printReport', [
                                'start_date' => $between[0],
                                'end_date' => $between[1],
                                'filter_type' => request()->get('filter_type'),
                                'chercher' => request()->get('chercher'),
                            ]) }}"
                            class="btn btn-light">
                            Imprimer
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        @if (count($solds))
            <div class=" overflow-auto" style="max-height: 270px">
                <div class="table-responsive">
                    <table class="table table-striped small">
                        <thead>
                            <tr>
                                <th>Désignation</th>
                                <th>Qté</th>
                                <th>PU</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($solds as $data)
                                <tr>
                                    <td>
                                        {{ $data->saleable->designation }}
                                    </td>
                                    <td>
                                        {{ $data->quantity }}
                                    </td>
                                    <td>
                                        {{ round($data->pricing) }}
                                    </td>
                                    <td>
                                        {{ formatPrice($data->sub_amount) }}
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                        @if (count($solds))
                            <tfoot>
                                <tr>
                                    <td colspan="1">
                                        <h5 style="margin-top: 8px" class="text-right">Total:</h5>
                                    </td>
                                    <td colspan="3">
                                        <h5 style="margin-top: 8px">{{ formatPrice($recettes['sum_amount']) }}</h5>
                                    </td>
                                </tr>
                            </tfoot>
                        @endif
                    </table>
                </div>
                {{-- @if (count($solds) == 'ok')
                @include('layouts.invoice_table', [
                    'invoices' => [
                        'datas' => $solds,
                        'type' => 'saleable',
                    ],
                    'amount' => $recettes['sum_amount'],
                    'rest' => $recettes['sum_rest'],
                    'checkout' => $recettes['sum_checkout'],
                    'paid' => $recettes['sum_paid'],
                    'caisse' => $recettes['sum_caisse'],
                ])
            @else
                Aucune donnée à afficher
            @endif --}}
            </div>
        @else
            Aucune donnée à afficher
        @endif
    </div>
</div>
