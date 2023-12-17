<form action="{{ route('articles.store') }}" id="formInsert" method="POST" enctype="multipart/form-data">
    @method('POST')
    @csrf

    <div class="mb-2">
        <label for="exampleInputEmail1" class="form-label">Nama Artikel</label>
        <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="textHelp">
    </div>

    <div class="mb-2">
        <label for="releaseDate" class="form-label">Tanggal Rilis</label>
        <input type="date" name="release_date" class="form-control" id="releaseDate">
    </div>

    <div class="mb-2">
        <label for="retailPrice" class="form-label">Harga Beli (Retail)</label>
        <input type="number" name="retail_price" class="form-control" id="retailPrice" step="0.01">
    </div>

    <div class="mb-2">
        <label for="resellPrice" class="form-label">Harga Jual (Resell)</label>
        <input type="number" name="resell_price" class="form-control" id="resellPrice" step="0.01">
    </div>

    <div class="mb-2">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea name="description" class="form-control" id="description" rows="3"></textarea>
    </div>

    <div class="mb-2">
        <label for="brandId" class="form-label">Nama Brand</label>
        <select name="brands_id" class="form-select" id="brandId">
            @foreach ($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>
</form>
