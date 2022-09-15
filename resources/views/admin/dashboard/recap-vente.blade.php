<div class="card">
    <div class="card-header bg-secondary">
        <h3 class="text-white">Recapulatif De Vente</h3>
    </div>
    <div class="card mb-0 overflow-auto" style="max-height:300px">
        <div class="card-body">
            <div class="card bg-success">
                <div class="card-body bg-success">
                    <h4 class="text-white">En Caisse</h4>
                    <div class="badge badge-pill badge-white  badge-square">
                        <h3 class="text-white">{{ formatPrice($recettes['sum_caisse']) }}</h3>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body bg-secondary">
                    <h4 class="text-white">Reçu</h4>
                    <div class="badge badge-pill badge-white  badge-square">
                        <h3 class="text-white">{{ formatPrice($recettes['sum_paid']) }}</h3>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body bg-danger">
                    <h4 class="text-white">Sortie De Caisse</h4>
                    <div class="badge badge-pill badge-white  badge-square">
                        <h3 class="text-white">{{ formatPrice($recettes['sum_checkout']) }}
                        </h3>
                    </div>
                </div>
            </div>
            <div class="card  bg-success">
                <div class="card-body bg-warning">
                    <h4 class="text-white">Credit</h4>
                    <div class="badge badge-pill badge-white  badge-square">
                        <h3 class="text-white">{{ formatPrice($recettes['sum_rest']) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>