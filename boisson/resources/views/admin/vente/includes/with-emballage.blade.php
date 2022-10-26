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
