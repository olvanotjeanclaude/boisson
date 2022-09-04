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

<div class="row">
    <div class="col-12">
        <div class="form-group mt-1">
            <div class="custom-control custom-switch">
                <input class="custom-control-input" checked id="withBottle" name="withBottle" type="checkbox">
                <span class="custom-control-track"></span>
                <label class="custom-control-label" for="withBottle">Le client a-t-il
                    apporté un
                    emballage ?
                </label>
            </div>
        </div>
    </div>
</div>


<div id="deconsignationBox">
    <div class="row">
        <div class="col-sm-8">
            <label class="text-bold-400 text-dark">
                Deconsignation (Simple)
            </label>
            <select name="tab1Deco[row_1][reference]" class="form-control select2 text-capitalize">
                <option value="">Choisir</option>
                @forelse ($consignations as $consignation)
                    <option @if ($consignation->reference == old('tab1Deco.row_1.reference')) selected @endif value="{{ $consignation->reference }}">
                        {{ $consignation->designation }}
                    </option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="text-bold-400 text-dark">
                    Quantité
                </label>
                <input type="number" placeholder="0" value="{{ old('tab1Deco.row_1.quantity') }}"
                    class="form-control" name="tab1Deco[row_1][quantity]">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <label class="text-bold-400 text-dark">
                Deconsignation (Gros)
            </label>
            <select name="tab1Deco[row_2][reference]" class="form-control select2 text-capitalize">
                <option value="">Choisir</option>
                @forelse ($consignations as $consignation)
                    <option @if ($consignation->reference == old('tab1Deco.row_2.reference')) selected @endif value="{{ $consignation->reference }}">
                        {{ $consignation->designation }}
                    </option>
                @empty
                @endforelse
            </select>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="text-bold-400 text-dark">
                    Quantité
                </label>
                <input type="number" placeholder="0"
                    value="{{ old('tab1Deco.row_2.quantity') ?? '' }}" class="form-control"
                    name="tab1Deco[row_2][quantity]">
            </div>
        </div>
    </div>
</div>
