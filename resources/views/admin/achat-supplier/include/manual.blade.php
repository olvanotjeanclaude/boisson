<form novalidate class="needs-validation" action="{{ route('admin.achat-fournisseurs.store') }}" method="POST">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-8 mt-1 col-article">
                    <label class="text-bold-400 text-dark" for="article_reference">Articles</label>
                    <select name="article_reference" required class="select2 form-control articleBySupplier"
                        id="article_reference">
                        <option value=''>Choisir</option>
                        @foreach ($articles as $article)
                            <option value='{{ $article->reference }}'
                                @if ($article->reference == old('article_reference')) selected @endif>{{ $article->designation }}
                            </option>
                        @endforeach
                        @foreach ($emballages as $emballage)
                            <option value='{{ $emballage->reference }}'
                                @if ($article->reference == old('article_reference')) selected @endif>{{ $emballage->designation }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Selectionnez l'article
                    </div>
                </div>

                <div class="col-sm-4 mt-1">
                    <label class="text-bold-400 text-dark" for="quantity">
                        Quantité
                    </label>
                    <input type="number" step="0.01" placeholder="0" class="form-control" required id="quantity"
                        name="quantity" value="{{ old('quantity') }}">
                    <div class="invalid-feedback">
                        Entrer le nombre de bouteille
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" id="addArticle" class="btn float-right my-1 btn-primary">
                        <span class="material-icons">add</span>
                        Ajouter
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>