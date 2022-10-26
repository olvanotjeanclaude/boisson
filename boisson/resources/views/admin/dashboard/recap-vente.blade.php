<div class="row mt-2">
    <div class="col-sm-6 col-md">
        <div class="card">
            <div class="card-body bg-success">
                <h4 class="text-white">Soldes En Caisse</h4>
                <div class="badge badge-pill badge-white  badge-square">
                    <h3 class="text-white">{{ formatPrice($recettes['sum_caisse']) }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md">
        <div class="card">
            <div class="card-body bg-secondary">
                <h4 class="text-white">Total de vente</h4>
                <div class="badge badge-pill badge-white  badge-square">
                    <h3 class="text-white">{{ formatPrice($recettes['sum_paid']) }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md">
        <div class="card">
            <div class="card-body bg-danger">
                <h4 class="text-white">Avoir</h4>
                <div class="badge badge-pill badge-white  badge-square">
                    <h3 class="text-white">{{ formatPrice($recettes["sum_checkout"]) }}
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md">
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
