<div class="card d-none">
    <div class="card-content">
        <div class="row">
            <div class="col-12">
                <div class="card mb-0">
                    <div class="card-content collapse show">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable table-striped table-hover table-bordered">
                                    <thead class="bg-light">
                                        <tr class="text-capitalize">
                                            <th>Désignation</th>
                                            <th>Quantité</th>
                                            <th>Payment</th>
                                            <th>Reçu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($saleAndPaymentDetails as $sale)
                                            <tr>
                                                <td>{{ $sale->designation ?? '-' }}</td>
                                                <td>{{ $sale->sum_quantity ?? '-' }}</td>
                                                <td>{{ join(',', $sale->payment_names) ?? '-' }}</td>
                                                <td>{{ formatPrice($sale->sum_paid) ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>