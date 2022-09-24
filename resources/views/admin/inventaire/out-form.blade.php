<div class="modal fade text-left" id="stockOutForm" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.inventaires.storeOut') }}" class="needs-validation" novalidate method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-secondary white">
                    <h4 class="modal-title white">Nouveau Sorti</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="text-bold-400 text-dark mb-1" for="article_reference">Articles</label>
                        <select name="article_reference" required class="form-control select2" id="articleRefOut">
                            <option value=''>Choisir</option>
                            @foreach ($articles as $article)
                                <option @if ($article->reference == old('article_reference')) selected @endif
                                    value="{{ $article->reference }}">{{ $article->designation }}
                                </option>
                            @endforeach
                            @foreach ($emballages as $emballage)
                                <option @if ($emballage->reference == old('article_reference')) selected @endif
                                    value="{{ $emballage->reference }}">{{ $emballage->designation }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Selectionnez l'article
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-bold-400 text-dark" for="quantity">
                            Quantité
                        </label>
                        <input type="number" placeholder="0" value="{{ old('quantity') }}" class="form-control"
                            required id="quantity" name="quantity">
                        <div class="invalid-feedback">
                            Entrer le nombre de bouteille
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="text-bold-400 text-dark" for="motif">
                            Motif
                        </label>
                        <textarea name="motif" id="motif" rows="" class="form-control" required>{{ old('motif') }}</textarea>
                        <div class="invalid-feedback">
                            Entrer le motif
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">D'Accord</button>
                    <button type="submit" class="btn text-white btn-primary">Enregister</button>
                </div>
            </div>
        </form>
    </div>
</div>
