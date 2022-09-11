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
                    @if (!$question_id)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault1"wire:click="choices" wire:model='q_choices'>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    اختيارات متعدده
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="flexRadioDefault"
                                    id="flexRadioDefault2" wire:click="imgg" wire:model="q_img">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    صوره
                                </label>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <label for="">الأختبار</label>
                            <select class="form-control" name="" id="" wire:model="exam_id">
                                <option>اختار الأختبار</option>
                                @foreach ($exams as $exam)
                                    <option value="{{ $exam->id }}">{{ $exam->name }}</option>
                                @endforeach
                            </select>
                            @error('exam_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">السؤال</label>
                            <input type="text" class="form-control" wire:model="question">
                            @error('question')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    @if ($q_choices)
                    @if (!$question_id)
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
                                        <input type="checkbox" class="form-check-input"
                                            wire:change='closecheck({{ $ans }})'
                                            wire:model="checks.{{ $ans }}">
                                        <input type="text" class="form-control"
                                            wire:model="answers_added.{{ $ans }}">
                                        @error('answers_added.{{ $ans }}')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @else
                    @endif
                    @if ($q_img)
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">شسشس</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    @else
                    @endif


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">خروج</button>
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </form>

        </div>
    </div>
</div>
