<div class="card d-none" id="paymentAndFactureContainer">
    <form action="{{ route('admin.achat-fournisseurs.store') }}" class="needs-validation" novalidate method="POST">
        @csrf
        <input type="hidden" name="saveData" value="saveData" id="">
        <div class="card-body">
            <div class="row">
                <div class="col-12 mt-1">
                    <label class="text-bold-400 text-dark" for="supplier_id">Fournisseur</label>
                    <select required name="supplier_id" id="supplier_id" required class="select2 form-control">
                        <option value="">Choisir</option>
                        @forelse ($suppliers as  $supplier)
                            <option value="{{ $supplier->id }}" @if ($supplier->id == old('supplier_id')) selected @endif>
                                {{ $supplier->identification }}</option>
                        @empty
                        @endforelse
                    </select>
                    <div class="invalid-feedback">
                        le fournisseur ne peut pas être vide
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="text-bold-400 text-dark" for="reference_facture">
                            Reference De Facture
                        </label>
                        <input type="text" value="{{ old('reference_facture') }}" required class="form-control"
                            id="reference_facture" name="reference_facture">
                            <div class="invalid-feedback">
                                Reference de facture ne peut pas être vide
                            </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="text-bold-400 text-dark" for="date">
                            Date
                        </label>
                        <input type="date" value="{{ old('date') ?? date('Y-m-d') }}" required class="form-control"
                            id="date" name="date">
                        <div class="invalid-feedback">
                            Date ne peut pas être vide
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-1">
                    <div class="form-group">
                        <label for="comment">Commentaire</label>
                        <textarea name="comment" id="comment" class="form-control" placeholder="Note">{{ old('comment') }}</textarea>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn form-control my-1 border-top text-white btn-secondary">
                        <i class="la la-save"></i>
                        Valider
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
