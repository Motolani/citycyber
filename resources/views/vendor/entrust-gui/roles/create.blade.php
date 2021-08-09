@extends(Config::get('entrust-gui.layout'))

@section('heading', 'Create Role')

@section('content')

<div class="row">
<div class="col-12">
<div class="page-title-box">
<div class="page-title-right">
<ol class="breadcrumb m-0">
<li class="breadcrumb-item active" style = "display:none" id = "headerShow">Roles</li>
</ol>
</div>
<h4 class="page-title">Create Roles</h4>
</div>
</div>
</div>

<form action="{{ route('entrust-gui::roles.store') }}" method="post" role="form">
@include('entrust-gui::roles.partials.form')
<button type="submit" class="btn btn-labeled btn-primary mt-3"><span class="btn-label"><i class="fa fa-plus"></i></span>{{ trans('entrust-gui::button.create') }}</button>
<a class="btn btn-labeled btn-default" href="{{ route('entrust-gui::roles.index') }}">
<span class="btn-label"><i class="fa fa-chevron-left"></i></span>{{ trans('entrust-gui::button.cancel') }}
</a>
</form>
@endsection
