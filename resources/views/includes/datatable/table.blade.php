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
                    <td>
                        @if (isset($column['title']))
                            {{ Str::title($column['title']) }}
                        @else
                            {{ str_replace('_', ' ', Str::title($column['data'])) }}
                        @endif
                    </td>
                @endforeach
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
