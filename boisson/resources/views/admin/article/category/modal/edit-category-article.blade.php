<div class="modal fade text-left" id="editCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel10"
    aria-hidden="true">
    <form class="modal-dialog modal-dialog-centered needs-validation" novalidate action="{{ route('admin.category-articles.update',$catArticle->id) }}"
        method="POST" role="document">
        @csrf
        @method("put")
        <div class="modal-content">
            <div class="modal-header bg-info py-1 white">
                <h4 class="modal-title white text-capitalize">modification de la catégorie d'articles</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row mx-auto">
                    <label for="name">Nom de catégorie</label>
                    <input type="text" id="name" class="form-control" value="{{ $catArticle->name }}" required placeholder="Nom"
                        name="name">
                    <div class="invalid-feedback">
                        Le champ nom de catégorie est obligatoire.
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-success text-white">
                    <i class="la la-save"></i> Sauvegarder
                </button>
            </div>
        </div>
    </form>
</div>
