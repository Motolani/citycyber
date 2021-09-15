<div class="row">
    @foreach($office->photos as $photo)
        <div class="col-4">
            <img src="{{url($photo->path)}}" class="img-thumbnail" />
            <a class="btn btn-sm" href="{{route('setAsDefault',[$photo->id])}}" > Set as Default</a>
        </div>
    @endforeach
</div>