<div class="table-responsive">
    <table style="width: 100%" data-columns="{{ $columns }}" data-url="{{ $dataUrl }}"
        class="table table-hover table-sm  ajax-datatable table-striped">
        <thead class="bg-light">
            <tr>
                @foreach (json_decode($columns, true) as $column)
                    <td>
                        {{ Str::title($column['data']) }}
                    </td>
                @endforeach
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
