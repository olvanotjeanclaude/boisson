<div class="card">
    <div class="card-header bg-dark">
        <form action="{{ route('admin.dashboard.detail') }}" method="GET">
            <div class="row">
                <div class="col-6  col-xl-2">
                    <input type="date" value="{{ $between[0] }}" class="form-control h-100 bg-white" name="start_date">
                </div>
                <div class="col-6  col-xl-2">
                    <input type="date" value="{{ $between[1] }}" class="form-control h-100 bg-white"
                        name="end_date">
                </div>
                <div class="mt-1 mt-lg-0 col-sm-7 col-md-4 col-xl-3">
                    <input type="text" value="{{ request()->get('chercher') }}" name="chercher"
                        placeholder="Reference Ou Designation..." style="" class="bg-white form-control">
                </div>
                <div class="mt-1 mt-lg-0 col-sm-5 col-md-4  col-xl">
                    <select name="filter_type" class="bg-white form-control h-100" id="filterArticle">
                        @foreach (\App\helper\Filter::TYPES as $key => $value)
                            <option @if ($key == request()->get('filter_type')) selected @endif value="{{ $key }}">
                                {{ Str::title($value) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-1 mt-lg-0 col-12 col-md-4  col-xl">
                    <div class="btn-group float-right" role="group">
                        <button type="submit" class="btn btn-secondary">Filtrer</button>
                        <a target="_blink"
                            href="{{ route('admin.dashboard.printReport', [
                                'start_date' => $between[0],
                                'end_date' => $between[1],
                                'filter_type' => request()->get('filter_type'),
                                'chercher' => request()->get('chercher'),
                            ]) }}"
                            class="btn btn-light">
                            <i class="la la-print"></i>
                        </a>
                        <a target="_blink"
                            href="{{ route('admin.dashboard.exportExcel', [
                                'start_date' => $between[0],
                                'end_date' => $between[1],
                                'filter_type' => request()->get('filter_type'),
                                'chercher' => request()->get('chercher'),
                            ]) }}"
                            class="btn btn-success">
                            <i class="la la-download"></i>
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        @if (count($solds))
            <div class=" overflow-auto" style="max-height: 475px">
                <div class="table-responsive">
                    <table class="table table-striped small">
                        <thead>
                            <tr>
                                <th>Désignation</th>
                                <th>Quantité</th>
                                <th>Prix Unitaire</th>
                                <th>Date</th>
                                <th>Montant</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($solds as $data)
                                <tr>
                                    <td>
                                        {{ $data->designation }}
                                    </td>
                                    <td>
                                        {{ $data->quantity }}
                                    </td>
                                    <td>
                                        {{ formatPrice($data->pricing) }}
                                    </td>
                                    <td>
                                        {{ format_date($data->received_at) }}
                                    </td>
                                    <td>
                                        {{ formatPrice($data->sub_amount) }}
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <h5 style="margin-top: 8px" class="text-right">Total: {{ formatPrice($recettes['sum_amount']) }}</h5>
            <h5 style="margin-top: 8px" class="text-right">Total En Fmg:
                {{ formatPrice($recettes['sum_amount'] * 5, 'Fmg') }}
            </h5>
        @else
            Aucune donnée à afficher
        @endif
    </div>
</div>
