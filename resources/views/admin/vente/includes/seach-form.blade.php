<div class="bg-dark" style="padding: 5px 1px">
    <form action="" id="filterForm" method="GET">
        <div class="row">
            <div class="col-6 col-sm">
                <input type="date" value="{{ date('Y-m-d') }}" class="form-control h-100 bg-white" id="start_date"
                    name="start_date">
            </div>
            <div class="col-6 col-sm">
                <input type="date" value="{{ date('Y-m-d') }}" class="form-control h-100 bg-white" id="end_date"
                    name="end_date">
            </div>
            <div class="col-12 col-sm-4">
                <input type="text" value="{{ request()->get('chercher') ?? old('chercher') }}" name="chercher"
                    placeholder="Reference Ou Client..." style="" id="search" class="bg-white form-control">
            </div>
            <div class="col-sm">
                <div class="btn-group float-right" role="group">
                    <button type="submit" id="filter" class="btn btn-secondary">
                        <i class="la la-filter"></i>
                        Filtrer
                    </button>
                    <button id="print" data-url="{{route('admin.sale.print')}}" class="search-action btn btn-light">
                        <i class="la la-print"></i>
                    </button>
                    <button id="download"  data-url="{{route('admin.sale.download')}}" class="search-action btn btn-success">
                        <i class="la la-download"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
