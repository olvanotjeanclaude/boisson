<div class="row">
    {{-- <div class="col mb-1">
        <input type="search" name="filter" class="form-control" placeholder="Ecrire quelque chose..." id="filter">
    </div> --}}
</div>
<div class="table-responsive">
    <table style="width: 100%" data-columns="{{ $columns }}" data-url="{{ $dataUrl }}"
        class="table table-hover table-sm  ajax-datatable table-striped"
        @isset($tableId) id="{{ $tableId }}" @endisset>
        <thead class="bg-light">
            <tr>
                @foreach (json_decode($columns, true) as $column)
                    <th @isset($column['style']) style="{{ $column['style'] }}" @endif>
                        @if (isset($column['title']))
                            {{ Str::title($column['title']) }}
                        @else
                            {{ str_replace('_', ' ', Str::title($column['data'])) }}
                        @endif
                        </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
