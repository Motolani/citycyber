<div class="row">
    @foreach($office->photos as $photo)
        <div class="col-4">
            <img src="{{url($photo->path)}}" class="img-thumbnail" />
            <a class="btn btn-sm btn-outline-primary pull-left mt-1" href="{{route('setAsDefault',[$photo->id])}}" > Set as Default</a>
            <a class="btn btn-sm pull-right btn-danger mt-1" href="{{route('photo.delete',[$photo->id])}}" > Delete </a>
        </div>
    @endforeach
</div>