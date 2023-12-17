<form id="form-update" action="{{ route('brands.update', $brand->id) }}" method="post" enctype="multipart/form-data">
    @method('POST')
    @csrf
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <div class="mb-2">
                        <label for="exampleInputEmail1" class="form-label">Nama Brand</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                            value="{{ $brand->name }}" aria-describedby="textHelp">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Gambar brand</label>
                        <input type="file" class="form-control" id="img" name="img">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <img id="brand-image" class="card-img-top"
                        src="data:image/jpeg;base64,{{ base64_encode($brand->image_brand) }}">
                </div>
            </div>
        </div>
    </div>

    <button type="button" id="btn-update"class="btn btn-secondary m-1" onclick="updateBrand()">Ubah Brand</button>
    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Keluar</button>

</form>
