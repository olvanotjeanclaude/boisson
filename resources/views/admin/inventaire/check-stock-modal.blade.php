<div class="modal fade text-left" id="stockModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel10"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('admin.inventaires.adjustStockRequest') }}" class="needs-validation" novalidate
            method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header bg-secondary white">
                    <h4 class="modal-title white" id="myModalLabel10">Messages</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">D'Accord</button>
                    <span id="adjustStock"></span>
                </div>
            </div>
        </form>
    </div>
</div>
