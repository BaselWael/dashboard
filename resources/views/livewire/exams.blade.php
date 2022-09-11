<div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12 align-right">
                <button wire:click.prefetch='create' class="btn btn-primary" data-toggle="modal"
                    data-target="#exampleModal">اضافه اختبار</button>
            </div>
        </div>
        @include('livewire.exams.create-update')


    </div>
    <div class="container d-flex justify-content-center mt-50 mb-50 mt-2 bg-light" style="background-color:#ffffff!important">
        <div class="row">
            @foreach ($data as $item)
                <div class="col-sm-12 col-md-6 col-lg-4 mt-2 mb-2">


                    <div class="card">
                        <div class="card-body">
                            <div class="card-img-actions"
                            style="  display: flex;
                            justify-content: center;">

                                @if ($item->img)
                                    @php
                                        $img = explode('public/', $item->img)[1];
                                    @endphp
                                        <img src="{{ asset('storage') . '/' . $img }}"style="width: 200px; height: 150px;">
                                @else
                                    <img src="{{ asset('images/exam.png') }}" style="width: 200px; height: 150px;">
                                @endif
                            </div>
                        </div>

                        <div class="card-body bg-light text-center">
                            <div class="mb-2">
                                <h6 class="font-weight-semibold mb-2">
                                    <a href="#" class="text-default mb-2" data-abc="true">{{ $item->name }}</a>
                                </h6>

                                <button class="btn btn-sm btn-success" wire:click="edit({{$item}})" data-toggle="modal"
                                data-target="#exampleModal"><span class="fal fa-pen font-3"> </span></button>
                                <button class="btn btn-sm btn-danger"data-toggle="modal"
                                data-target="#delModal" wire:click="del({{$item}})"><span class="fal fa-trash font-3"> </span></button>
                            </div>

                            {{-- <h3 class="mb-0 font-weight-semibold">$250.99</h3> --}}

                            {{-- <div>
                            <i class="fa fa-star star"></i>
                            <i class="fa fa-star star"></i>
                            <i class="fa fa-star star"></i>
                            <i class="fa fa-star star"></i>
                        </div> --}}

                            {{-- <div class="text-muted mb-3">34 reviews</div> --}}

                            {{-- <button type="button" class="btn bg-cart"><i class="fa fa-cart-plus mr-2"></i> Add to
                            cart</button> --}}


                        </div>
                    </div>




                </div>
            @endforeach
            {{ $data->links() }}

        </div>
    </div>

</div>
