<div class="row">
    <div class="col-6 col-sm">
        <input type="date" value="{{ $between[0] }}" class="form-control h-100 bg-white"
            name="start_date">
    </div>
    <div class="col-6 col-sm">
        <input type="date" value="{{ $between[1] }}" class="form-control h-100 bg-white"
            name="end_date">
    </div>
    <div class="col-sm">
        <select name="filter_type" class="bg-white form-control" id="filterArticle">
            <option value="tout">Tout</option>
            <option value="article">Article</option>
            <option value="bouteille">bouteille</option>
            <option value="sortie">Sortie</option>
        </select>
    </div>
    <div class="col-sm">
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-secondary">Filtrer</button>
            <a {{-- target="_blink"
                href="{{ route('admin.stocks.printReport', [
                    'start_date' => $between[0],
                    'end_date' => $between[1],
                    'filter_type' => request()->get('filter_type'),
                    'chercher' => request()->get('chercher'),
                ]) }}" --}} class="btn btn-light">
                Imprimer
            </a>
        </div>
    </div>
</div>