<div class="table-data">
    @include("includes.ajax-table.search-form")
    <div class="table-responsive" id="table-container">
        <table style="width: 100%;" data-columns="{{ $columns }}"
            class="table table-hover text-nowrap ajaxTable table-striped" data-src="{{ $dataSrc }}">
            <thead class="bg-light">
                <tr>
                    @foreach (json_decode($columns, true) as $column)
                        <th  @isset($column['style']) style="{{ $column['style'] }}" @endif>
                                @if (isset($column['title']))
                                    {{ Str::title($column['title']) }}
                                @else
                                    {{ str_replace('_', ' ', Str::title($column['data'])) }}
                                @endif
                            </th>
                    @endforeach
                </tr>
            </thead>
            <tbody id="fetchRow" class="text-uppercase">
            </tbody>
        </table>
        <div id="paginationContainer">
            
        </div>
    </div>
</div>
