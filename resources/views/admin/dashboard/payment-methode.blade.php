<div class="card">
    <div class="card-header bg-dark">
        <h3 class="text-white">Payment Reçu</h3>
    </div>
    <div class="card-body">
        @if (count($paymentTypes))
            <ul class="list-group">
                @foreach ($paymentTypes as $payName => $value)
                    <a href="#" class="list-group-item list-group-item-action">
                        {{ $payName }}
                        <span class="badge badge-primary badge-pill float-right">
                            {{ $value }}
                        </span>
                    </a>
                @endforeach
            </ul>
        @else
            Aucune donnée à afficher
        @endif
    </div>
</div>