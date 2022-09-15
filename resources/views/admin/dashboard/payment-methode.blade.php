<div class="card">
    <div class="card-header bg-dark">
        <h3 class="text-white">Payment</h3>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-body p-0">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="base-paid" data-toggle="tab" aria-controls="paid" href="#paid"
                            aria-expanded="true">Entrée De Caisse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="base-checkout" data-toggle="tab" aria-controls="checkout"
                            href="#checkout" aria-expanded="false">Sortie De Caisse</a>
                    </li>
                    <li class="nav-item">
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="paid" aria-expanded="true"
                        aria-labelledby="base-paid">
                        <ul class="list-group">
                            @foreach ($paymentTypes as $payName => $value)
                                @if ($value['paid'])
                                    <a href="#" class="list-group-item list-group-item-action">
                                        {{ $payName }}
                                        <span class="badge badge-primary badge-pill float-right">
                                            {{ formatPrice($value['paid']) }}
                                        </span>
                                    </a>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-pane" id="checkout" aria-labelledby="base-checkout">
                        <ul class="list-group">
                            @foreach ($paymentTypes as $payName => $value)
                                @if ($value['checkout'])
                                    <a href="#" class="list-group-item list-group-item-action">
                                        {{ $payName }}
                                        <span class="badge badge-primary badge-pill float-right">
                                            {{ formatPrice($value['checkout']) }}
                                        </span>
                                    </a>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @if (count($paymentTypes))
        @else
            Aucune donnée à afficher
        @endif
    </div>
</div>
