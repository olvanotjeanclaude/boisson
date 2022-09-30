<div class="row mt-2">
    <div class="col-6 col-md">
        <div class="card">
            <div class="card-body bg-success">
                <h4 class="text-white">En Caisse</h4>
                <div class="badge badge-pill badge-white  badge-square">
                    <h3 class="text-white">{{ formatPrice($recettes['sum_caisse']) }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md">
        <div class="card">
            <div class="card-body bg-secondary">
                <h4 class="text-white">Reçu</h4>
                <div class="badge badge-pill badge-white  badge-square">
                    <h3 class="text-white">{{ formatPrice($recettes['sum_paid']) }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md">
        <div class="card">
            <div class="card-body bg-danger">
                <h4 class="text-white">Sortie De Caisse</h4>
                <div class="badge badge-pill badge-white  badge-square">
                    <h3 class="text-white">{{ formatPrice($solds->sum("sub_amount")) }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md">
        <div class="card">
            <div class="card-body bg-warning">
                <h4 class="text-white">Credit</h4>
                <div class="badge badge-pill badge-white  badge-square">
                    <h3 class="text-white">{{ formatPrice($recettes['sum_rest']) }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
