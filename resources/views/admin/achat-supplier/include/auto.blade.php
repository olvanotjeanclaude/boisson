<div class="card">
    <div class="card-body">
        <div class="card-body">
            <div class="card-text">
                <p>
                    La quantité que vous entrez dans le champ affectera tout le stock. Par exemple, si vous entrez 10
                    quantités, tout le stock sera plus 10. Ou si vous sélectionnez quelque article, seul l'article que
                    vous
                    avez entré sera affecté.
                </p>
                {{-- <p>
                    Si l'article n'a pas de prix d'achat, le champ prix d'achat sera obligatoire.
                </p> --}}
            </div>

            <form novalidate action="{{ route('admin.achat-fournisseurs.saveAutoStock') }}" method="POST"
                class="needs-validation form form-horizontal striped-rows form-bordered">
                @csrf
                <div class="form-body">
                    <div class="form-group row mx-auto">
                        <label class="col-md-3 label-control" for="article_reference">Articles</label>
                        <div class="col-md-9">
                            <select name="article_references[]" multiple class="select2 form-control"
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
                            <div class="invalid-feedback">
                                Le champ quantité est obligatoire.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mx-auto">
                        <label class="col-md-3 label-control" for="entry">Quantité</label>
                        <div class="col-md-9">
                            <input type="text" id="entry" class="form-control" value="{{ old('entry') }}"
                                required placeholder="Quantité" name="entry">
                            <div class="invalid-feedback">
                                Le champ quantité est obligatoire.
                            </div>
                        </div>
                    </div>
                    {{-- <div class="form-group row mx-auto">
                        <label class="col-md-3 label-control text-capitalize" for="buying_price">Prix d'achat</label>
                        <div class="col-md-9">
                            <input type="text" id="buying_price" value="{{ old('buying_price') }}"
                                class="form-control" placeholder="Prix d'achat" name="buying_price">
                            <div class="invalid-feedback">
                                Le champ prix d'achat est obligatoire.
                            </div>
                        </div>
                    </div> --}}
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="la la-save"></i> Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
