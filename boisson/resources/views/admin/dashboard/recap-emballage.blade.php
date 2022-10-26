<div class="card">
    <div class="card-header bg-secondary">
        <div class="row">
            <div class="col-sm d-flex align-items-center">
                <h3 class="text-white">Recapulatifs</h3>
            </div>
            <div class="col-sm">
                <div class="btn-group mt-1 mt-sm-0">
                    <a href="{{ route('admin.dashboard.detail', [
                        'start_date' => $between[0],
                        'end_date' => $between[1],
                    ]) }}"
                        class="btn btn-light">
                        <i class="la la-eye"></i>
                        Voir
                    </a>
                    <a target="_blink"
                        href="{{ route('admin.dashboard.printReport', [
                            'start_date' => $between[0],
                            'end_date' => $between[1],
                            'filter_type' => request()->get('filter_type'),
                            'chercher' => request()->get('chercher'),
                        ]) }}"
                        class="btn btn-light">
                        <i class="la la-print"></i>
                        Imprimer
                    </a>
                    <a 
                    href="{{ route('admin.dashboard.exportExcel', [
                        'start_date' => $between[0],
                        'end_date' => $between[1],
                        'filter_type' => request()->get('filter_type'),
                        'chercher' => request()->get('chercher'),
                    ]) }}"
                        class="btn btn-light">
                        <i class="la la-download"></i>
                        Telecharger
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-start flex-wrap">
        @foreach ($recaps as $recap => $total)
            <div class="border m-1 p-1" style="min-width: 140px">
                <h4 class="card-title text-center">{{ $recap }}</h4>
                <div class="text-center">
                    <div class="badge badge-pill  badge-secondary badge-square">
                        {{ $total }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
