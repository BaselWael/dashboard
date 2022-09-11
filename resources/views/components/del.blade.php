<!-- Modal -->
<div wire:ignore.self class="modal fade" id="delModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-lg " role="document">
        <div class="modal-content">
            <form action=""wire:submit.prevent="destory">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">حذف:  {{$del_name}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>هل انت متأكذ من حذف :</p>
                    <p>{{$del_name}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">خروج</button>
                    <button type="submit" class="btn btn-danger">حذف</button>
                </div>
            </form>

        </div>
    </div>
</div>
