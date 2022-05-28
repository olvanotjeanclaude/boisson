<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-striped table-bordered table-hover  small">
                <thead class="bg-light">
                    <tr>
                        <th>Type d'article</th>
                        <th>Fam</th>
                        <th>Designation</th>
                        <th>Type</th>
                        <th>Qtt Type</th>
                        <th>Qtt BTL</th>
                        <th>Cont</th>
                        <th>unité</th>
                        <th>PU</th>
                        <th>PA</th>
                        <th>Prix gros</th>
                        <th>Prix Détail</th>
                        <th>Montant</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($articleRequests as $article)
                        <tr class='text-nowrap' id="article_{{ $article['row_id'] }}">
                            <td>{{ array_search($article['article_type'], $articleTypes) ?? '-' }}</td>
                            <td>{{ array_search($article['category_id'], $articleCategories) ?? '-' }}</td>
                            <td>{{ $article['designation'] ?? '-' }}</td>
                            <td>{{ array_search($article['quantity_type'], $units) ?? '-' }}</td>
                            <td>{{ $article['quantity_type_value'] ?? '-' }}</td>
                            <td>{{ $article['quantity_bottle'] ?? '-' }}</td>
                            <td>{{ $article['contenance'] ?? '-' }}</td>
                            <td>{{ array_search($article['unity'], $units) ?? '-' }}</td>
                            <td>{{ $article['unit_price'] ?? '-' }}</td>
                            <td>{{ $article['buying_price'] ?? '-' }}</td>
                            <td>{{ $article['wholesale_price'] ?? '-' }}</td>
                            <td>{{ $article['detail_price'] ?? '-' }}</td>
                            @php
                                $deconsignation = \App\Models\Articles::ARTICLE_TYPES['deconsignation'];
                            @endphp
                            <td>
                                {{ $article['article_type'] == $deconsignation ? '-' : '' }}
                                {{ number_format($article['sub_amount'], 2, ',', ' ') ?? '0' }} Ar
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a class="remove-article" data-row_id="{{ $article['row_id'] }}">
                                        <span class="material-icons text-danger">
                                            remove_circle
                                        </span>
                                    </a>
                                    <a class="ml-1 edit-article" data-row_id="{{ $article['row_id'] }}">
                                        <span class="material-icons text-primary">
                                            edit
                                        </span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
