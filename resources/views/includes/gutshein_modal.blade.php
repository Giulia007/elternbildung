<div class="modal fade" id="voucherModal" tabindex="-1" role="dialog" aria-labelledby="voucherModal"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gutshein">Gutshein</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Schließen">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form method="POST" action="{{ route('voucher_check') }}">
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Bitte gib hier deinen Gutschein ein"
                               name="voucher_code" aria-label="Gutshein">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Einreichen</button>
                </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
            </div>
        </div>
    </div>
</div>