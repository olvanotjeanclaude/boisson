<h3> Historique de vente</h3>
<h5>Date : {{ format_date($between[0]) }}-{{ format_date($between[1]) }}</h5>
@if (request()->get('filter_type'))
    <h5>Type : {{ request()->get('filter_type') }} </h5>
@endif
@if (request()->get('chercher'))
    <h5>Mot Clé : {{ request()->get('chercher') }}</h5>
@endif
<h5>Caissier: {{ Str::upper(auth()->user()->full_name) }}</h5>

<br>

@if (count($solds))
    <table>
        <thead>
            <tr>
                <th>Désignation</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Montant</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($solds as $data)
                <tr>
                    <td>
                        {{ $data->saleable->designation }}
                    </td>
                    <td>
                        {{ $data->quantity }}
                    </td>
                    <td>
                        {{ formatPrice($data->pricing) }}
                    </td>
                    <td>
                        {{ formatPrice($data->sub_amount) }}
                    </td>
                    <td>{{ format_date($data->received_at) }}</td>
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>

    <h5 style="margin-top: 8px" class="text-right">Total: {{ formatPrice($recettes['sum_amount']) }}</h5>
    <h5 style="margin-top: 8px" class="text-right">Total En Fmg: {{ formatPrice($recettes['sum_amount'] * 5, 'Fmg') }}
    </h5>
@else
    Aucune donnée à afficher
@endif
