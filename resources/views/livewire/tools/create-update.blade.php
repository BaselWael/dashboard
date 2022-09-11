<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-lg " role="document">
        <div class="modal-content">
            <form action=""wire:submit.prevent="submit">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">اضافه سؤال</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">اسم الأداه</label>
                            <input type="text" class="form-control" wire:model="tool">
                            @error('tool')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                        @if (!$tools_id)
                        <div class="row">
                            <div class="col-md-12">
                                <a class="btn btn-primary btn-sm mt-3"
                                    wire:click="addChoices({{ $i }})">+</a>
                            </div>
                        </div>
                        @endif

                        <div class="row">
                            @foreach ($answers as $key => $ans)
                                <div class="col-md-6 mt-2">
                                    <div class="form-check form-check-inline">
                                        <input type="text" class="form-control"
                                            wire:model="answers_added.{{ $ans }}">
                                        @error('answers_added.{{ $ans }}')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">خروج</button>
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </form>

        </div>
    </div>
</div>
