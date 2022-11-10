<form action="{{ route('admin.sorti-stocks.store', ['action' => 'save']) }}" method="POST">
    @csrf
    <input type="hidden" name="saveData" value="saveData" id="">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label class="text-bold-400 text-dark" for="date">
                        Date
                    </label>
                    <input type="date" placeholder="0" value="{{ old('date') ?? date('Y-m-d') }}"
                        class="form-control" required id="date" name="date">
                    <div class="invalid-feedback">
                        Entrer le date
                    </div>
                </div>
                <div class="form-group">
                    <label class="text-bold-400 text-dark" for="comment">
                        comment
                    </label>
                    <textarea name="comment" placeholder="Ecrire..." class="form-control" id="comment" required>{{ old('comment') }}</textarea>
                    <div class="invalid-feedback">
                        Entrer le motif
                    </div>
                </div>
            </div>

            <div class="col-12">
                <button type="submit" class="btn form-control my-1 border-top text-white btn-secondary">
                    <i class="la la-save"></i>
                    Enregistrer
                </button>
            </div>
        </div>
    </div>
</form>
