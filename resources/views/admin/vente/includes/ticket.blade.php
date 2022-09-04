<div class="card">
    <div class="card-body">
        <h4 class="text-capitalize text-right font-weight-bold">Ticket De Vente</h4>
        @if (count($preInvoices))
            <div class="table-responsive">
                <table class="table p-0 table-sm text-nowrap table-bordered table-striped table-hover">
                    <thead>
                        <tr class="p-0">
                            <th>Designation</th>
                            <th>Prix</th>
                            <th>Qtt</th>
                            <th>Sous Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($preInvoices as $preInvoice)
                            <tr>
                                <td class="pl-1 py-0 text-capitalize">
                                    {{ $preInvoice->saleable->designation }}
                                </td>
                                <td class="pl-1 py-0">
                                    {{ $preInvoice->saleable->price }}
                                    Ar
                                </td>
                                <td class="pl-1 py-0">{{ $preInvoice->quantity }}</td>
                                <td class="pl-1 py-0">
                                    {{ formatPrice($preInvoice->sub_amount) }}
                                </td>
                                <td class="pl-1 py-0">
                                    <form method="POST"
                                        action="{{ route('admin.ventes.destroy', $preInvoice->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit"
                                            class="btn btn-outline-accent-1 remove-article">
                                            <span class="material-icons text-danger">
                                                remove_circle
                                            </span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex mt-1 flex-column align-items-end">
                <span id="amountToPay" data-amount="{{ $amount }}"></span>
                <span> {{ number_format($amount, 2, ',', ' ') ?? '0' }} Ar</span>
                <span> {{ number_format($amount * 5, 2, ',', ' ') ?? '0' }} Fmg</span>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-actions float-right">
                        <button type="button" id="cancelBtn" class="btn btn-warning d-none mr-1">
                            <i class="ft-x"></i> Anuller
                        </button>
                        <button type="button" id="validFacture" class="btn btn-primary">
                            <i class="la la-check-square-o"></i> Enregister
                        </button>
                    </div>
                </div>
            </div>
        @else
            <p class="card-text">La désignation, nombre de bouteille et le total se trouve dans cette
                zone.
            </p>
        @endif
    </div>
</div>