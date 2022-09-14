<div class="card">
    <div class="card-header bg-secondary">
        <h3 class="text-white">Recapulatif D'Emballages</h3>
    </div>
    <div class="d-flex flex-wrap justify-content-center">
        @foreach ($recaps as $recap => $total)
            <div class="border m-1 p-1">
                <h4 class="card-title">{{ $recap }}</h4>
                <div class="text-center">
                    <div class="badge badge-pill  badge-secondary badge-square">
                        {{ $total }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
