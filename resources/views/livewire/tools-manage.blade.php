<div>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12 align-right">
                <button wire:click.prefetch='create' class="btn btn-primary" data-toggle="modal"
                    data-target="#exampleModal">اضافه</button>
            </div>
        </div>
        @include('livewire.tools.create-update')


    </div>
    <div class="container justify-content-center mt-50 mb-50 mt-3 bg-light"
        style="width:90%;background-color:#ffffff!important">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">الاداه</th>
                        <th scope="col">عدد الاختيارات بداخلها</th>
                        <th scope="col">التحكم</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <th scope="row">{{$loop->index}}</th>

                        <td>{{$item->name}}</td>
                        <td>{{count($item->content)}}</td>
                        <td>
                            <button class="btn btn-sm btn-success"data-toggle="modal"
                            data-target="#exampleModal" wire:click="edit({{$item}})"><span class="fal fa-pen font-3"> </span></button>
                            <button class="btn btn-sm btn-danger"data-toggle="modal"
                            data-target="#delModal" wire:click="del({{$item}})"><span class="fal fa-trash font-3"> </span></button>
                            {{-- <button class="btn btn-sm btn-primary"><span class="fal fa-eye font-3"> </span></button> --}}
                        </td>
                    </tr>
                    @endforeach
                    @include('components.del')

                </tbody>
            </table>
            {{ $data->links() }}

        </div>
    </div>
</div>
