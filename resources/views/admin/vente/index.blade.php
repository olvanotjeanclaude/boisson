@extends('layouts.app')

@section('vendor')
    @include('includes.datatable.css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/forms/icheck/custom.css') }}">
@endsection


@section('title')
    Liste De vente
@endsection

@section('content-header')
    @include('includes.content-header', [
        'page' => 'ventes',
        'breadcrumbs' => [
            ['text' => 'Vente', 'link' => route('admin.ventes.index')],
            ['text' => 'List', 'link' => route('admin.index')],
        ],
        'actionBtn' => [
            'text' => 'Nouvelle Vente',
            'link' => route('admin.ventes.create'),
            'icon' => '<span class="material-icons">add</span>',
            'show' => currentUser()->can('make sale'),
        ],
    ])
@endsection

@section('content')
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

    <!-- Material Data Tables -->
    <section id="material-datatables">
        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-header">
                        <h4 class="card-title"> Liste De vente</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <button type="button" id="deleteIcheckBtn" data-target="#deleteAllModal" data-toggle="modal"
                                data-url="{{ route('admin.ventes.destroy', ['vente' => 'item']) }}"
                                class="btn delete-btn d-none btn-danger btn-sm text-capitalize">
                                <span class="material-icons">
                                    delete
                                </span>
                                Supprimer
                            </button>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <!-- Invoices List table -->
                            <div class="table-data">
                                @include('admin.vente.includes.seach-form')
                                <div class="table-responsive" id="table-container">
                                    <table style="width: 100%;" data-columns="{{ $columns }}"
                                        class="table table-hover text-nowrap table-sm ajaxTable table-striped"
                                        data-src="{{ route('admin.ventes.ajaxGetData') }}">
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
                                        <tbody id="fetchRow" class="text-uppercase">
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            {{-- @include('includes.datatable.table', [
                                'dataUrl' => route('admin.ventes.ajaxPostData'),
                            ]) --}}
                            <!--/ Invoices table -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('includes.delete-modal')
@endsection

@section('page-js')
    @include('includes.datatable.js')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            const src = $(".ajaxTable").data("src");
            let start_date = $("#start_date").val();
            let end_date = $("#end_date").val();
            let search = $("#search").val();

            getData(src);

            $("#filterForm").submit(async function(e) {
                e.preventDefault();
                start_date = $("#start_date").val();
                end_date = $("#end_date").val();
                search = $("#search").val();

                if (src) {
                    await getData(src, {
                        between: [start_date, end_date],
                        search
                    });
                }
            })

            $(".search-action").click(function() {
                let url = $(this).data("url");

                if (url) {
                    url = new URL(url);
                    url.searchParams.set("start_date", start_date);
                    url.searchParams.set("end_date", end_date);
                    url.searchParams.set("search", search);

                    $(this).attr("href", url);

                    window.open(url);
                }
            })
        })

        function getData(url, params) {
            axios.get(url, {
                    params
                })
                .then((response) => {
                    const datas = response.data;
                    const all = datas?.all?.data ?? datas?.all ?? [];

                    const columns = datas.columns;
                    let tbody = "";

                    if (all.length > 0) {
                        for (const data of all) {
                            let row = "<tr>";
                            columns.forEach(col => {
                                row += `<td>${data[col["data"]]??''}</td>`;
                            });
                            row += "</tr>";

                            tbody += row;
                        }
                        $("#table-container").attr("style","min-height:400px");
                    }
                    else{
                        $("#table-container").removeAttr("style");
                        tbody = `<tr>
                             <td  colspan="${columns.length}">Aucune donnée disponible</td>
                            </tr>`;
                    }

                    $("#fetchRow").html(tbody);
                })
                .catch((error) => {
                    console.log(error);
                })
        }
    </script>
@endsection
