<div class="row" id="articleConsignation">
    <div class="col-12">
        <div class="row">
            <div class="col-sm-8 mt-1 col-article">
                <label class="text-bold-400 label-control text-dark" for="article_reference">Articles</label>
                <select name="article_reference" class="form-control select2" id="article_reference">
                    <option value=''>Choisir</option>
                    @foreach ($articles as $article)
                        <option @if ($article->reference == old('article_reference')) selected @endif value="{{ $article->reference }}">
                            {{ $article->designation }}</option>
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
                <input type="number" placeholder="0" min="1" value="{{ old('quantity') }}" class="form-control"
                    id="quantity" name="quantity">
                <div class="invalid-feedback">
                    Entrer le nombre de bouteille
                </div>
            </div>
        </div>
    </div>
</div>

{{-- @include('vente.includes.with-emballage') --}}