<form action="{{ route('admin.index') }}" method="GET">
    <div class="row">
        <div class="mb-1 col-sm-6 col-md-4 col-lg-3 mt-sm-0">
            <div class="input-group bg-white p-0 m-0">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-dark text-white">Debut</span>
                </div>
                <input type="date" value="{{ $between[0] }}" class="form-control" id="start_date" name="start_date">
            </div>
        </div>
        <div class="mb-1 col-sm-6 col-md-4 col-lg-3 mt-sm-0">
            <div class="input-group bg-white p-0 m-0">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-dark text-white">Fin</span>
                </div>
                <input type="date" value="{{ $between[1] }}" class="form-control small" id="end_date"
                    name="end_date">
            </div>
        </div>

        <div class="col-sm-4 col-md-4 col-lg-3  mt-sm-0">
            <select name="filter_type" class="form-control bg-white" style="padding: 4px" id="filterArticle">
                @foreach (\App\helper\Filter::TYPES as $value)
                    <option @if ($value == request()->get('filter_type')) selected @endif value="{{ $value }}">
                        {{ Str::title($value) }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-12  col-sm-4 col-md mt-1 mt-sm-0">
            <button type="submit" class="btn  btn-outline-dark w-100">Filtrer</button>
        </div>
    </div>
</form>
