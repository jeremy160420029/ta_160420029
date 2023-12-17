<div class="modal-body">
    @foreach ($imageDetail as $id)
        <img id="brand-image" class="card-img-top img-fluid" style="max-width: 100%;"
            src="data:image/jpeg;base64,{{ base64_encode($id->image_data) }}">
        <br><br>
        <h3 style="text-align: center;">{{ $id->all_prediction }}</h3>
    @endforeach
</div>
