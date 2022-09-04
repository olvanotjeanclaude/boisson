<form action="{{ route('admin.ventes.store') }}" method="POST">
    @csrf
    <input type="hidden" name="saveData" value="saveData" id="">
    <div class="card-body">
        <div class="row">
            <div class="col-md-7">
                <div class="input-group">
                    <h5 class="mr-2">Nouveau Client?</h5>
                    <div class="d-inline-block custom-control custom-radio mr-1">
                        <input type="radio" name="newCustomer" value="1" class="newCustomer custom-control-input"
                            id="yes">
                        <label class="custom-control-label" for="yes">Oui</label>
                    </div>
                    <div class="d-inline-block custom-control custom-radio">
                        <input checked type="radio" value="0" name="newCustomer"
                            class="newCustomer custom-control-input" id="no">
                        <label class="custom-control-label" for="no">Non</label>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <label class="text-bold-400 text-dark" for="received_at">
                        Date
                    </label>
                    <input type="date" value="{{ date('Y-m-d') }}" class="form-control" id="received_at"
                        name="received_at">
                </div>
            </div>
            <div class="col-12">
                <div id="customerBlock" class="">
                    <select name="customer_id" id="customer_id" class="select2 form-control">
                        <option value="" selected>Client</option>
                        @forelse ($customers as $customer)
                            <option value="{{ $customer->id }}">
                                {{ $customer->code }}-{{ Str::upper($customer->identification) }}
                            </option>
                        @empty
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="col-12 mt-1 d-none" id="newCustomerBlock">
                <div class="row">
                    <div class="col-sm">
                        <div class="form-group">
                            <label for="customer_identification">Identification</label>
                            <input type="text" id="customer_identification" class="form-control border-primary"
                                placeholder="identification" name="customer_identification">
                        </div>
                    </div>

                    <div class="col-sm">
                        <div class="form-group">
                            <label for="customer_phone">Téléphone</label>
                            <input type="tel" id="customer_phone" class="form-control border-primary"
                                placeholder="Numéro De Téléphone" name="customer_phone">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7 mt-1">
                <div class="form-group">
                    <label for="comment">Commentaire</label>
                    <textarea name="comment" id="comment" class="form-control" placeholder="Note"></textarea>
                </div>
            </div>
            <div class="col-md-5 d-flex align-items-center">
                <button type="submit" class="btn form-control my-1 border-top text-white btn-secondary">
                    <i class="la la-save"></i>
                    Enregistrer
                </button>
            </div>
        </div>
    </div>
</form>
