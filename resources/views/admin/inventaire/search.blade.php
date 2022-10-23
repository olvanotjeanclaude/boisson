<form action="{{ route('admin.stocks.index') }}" method="GET">
    <div class="row">
        <div class="col-6 col-sm">
            <input type="date" value="{{ request('start_date') ?? $between[0] }}"
                class="form-control h-100 bg-white" name="start_date">
        </div>
        <div class="col-6 col-sm">
            <input type="date" value="{{ request('end_date') ?? $between[1] }}"
                class="form-control h-100 bg-white" name="end_date">
        </div>
        <div class="col-6 col-sm">
            <select name="filter_type" class="bg-white form-control h-100" id="filterArticle">
                <option @if (request('filter_type') == 'tout') selected @endif value="tout">Tout
                </option>
                <option @if (request('filter_type') == 'article') selected @endif value="article">Article
                </option>
                <option @if (request('filter_type') == 'emballage') selected @endif value="emballage">
                    Emballage</option>
            </select>
        </div>
        <div class="col-6 col-sm-4">
            <input type="text" value="{{ request()->get('chercher') ?? old('chercher') }}"
                name="chercher" placeholder="Reference Ou Designation..." style=""
                class="bg-white form-control">
        </div>
        <div class="col-sm">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-secondary">Filtrer</button>
                <a target="_blink"
                    href="{{ route('admin.stocks.printReport', [
                        'start_date' => request('start_date') ?? $between[0],
                        'end_date' => request('end_date') ?? $between[1],
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