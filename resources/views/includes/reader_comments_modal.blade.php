<div class="modal fade" id="modalReaderXs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Meine Kommentare</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                @forelse($comments_only as $comment)
                    <div class="col-sm-12">
                        <div class="row mb-2">
                            <div class="col-8">
                                <div class="reader_name">
                                    {{ $comment->user->name }}
                                </div>
                            </div>
                            <div class="col-4 pr-2">
                                <div class="private_note_date">{{ $comment->created_at->format('d.m.Y') }}</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="private_note_text"> {{ $comment->comment }}</div>
                        </div>
                        <div class="row">
                            <div class="selection_popover col-sm-5">
                                <a href="#" role="button" class="btn  popover-test"
                                   title="My Selection on Article" data-toggle="popover" data-content=" {{ $comment->selection }} ">
                                    Quotation
                                </a>
                            </div>
                        </div>

                        @if(!$loop->last)
                            <hr class="comm_hr">
                        @endif
                    </div>
                @empty
                    Noch keine Kommentare, erstelle einen Kommentar indem du einen Testteil markierst und auf die Sprechblase klickst.
                @endforelse

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Schließen</button>
            </div>
        </div>
    </div>
</div>

{{--pop-over--}}
<script>
    $(function () {
        $('[data-toggle="popover"]').popover()
    })
</script>