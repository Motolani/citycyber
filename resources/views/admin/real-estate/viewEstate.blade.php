@extends('admin.layout')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">

                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">View Real Estate</li>
                    </ol>
                </div>
                <h4 class="page-title">View Real Estate</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">


                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                <tr>
                                    {{-- <th>View More</th> --}}
                                    <th></th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>type</th>
                                    <th>Address</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if(isset($real_estates))
                                    @foreach($real_estates as $user)
                                        <tr>
                                            <td>
                                                <a href="{{route('editrealestate',$user->id)}}" class="btn btn-primary btn-sm phils" ><span class="uil-edit"></span></a>

                                                <form method="post" action="{{route('deleterealestate',$user->id)}}">
                                                    @csrf
                                                    @method('delete') 
                                                    <input type="hidden" name="id" value="{{$user->id}}">
                                                    <button name="submit" onclick="return confirm('Are you sure?')" value="delete" class="btn btn-danger btn-sm"><span class="uil-trash"></span></button>
                                                </form>
                                            </td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->phone_number}}</td>
                                            <td>
                                                {{$user->email}}
                                            </td>
                                            <td>{{$user->type}}</td>
                                            <td>
                                                {{$user->address}}
                                            </td>
                                        </tr>
                                    @endforeach

                                @endif
                                </tbody>
                            </table>
                        </div> <!-- end preview-->

                    </div> <!-- end tab-content-->

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <!-- end row-->
@endsection