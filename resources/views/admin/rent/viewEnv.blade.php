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

                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">View Environmental Bills</li>
                    </ol>
                </div>
                <h4 class="page-title">View Environmental Bills</h4>
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
                                    <th></th>
                                    <th>Date Paid</th>
                                    <th>Amount Paid</th>
                                    <th>Duration</th>
                                    <th>Renewal Date</th>
                                    <th>Offices</th>
                                </tr>
                                </thead>

                                <tbody>
                                @if(isset($environments))
                                    @foreach($environments as $user)
                                        <tr>
                                            <td>
                                                <a href="{{route('editEnv',$user->id)}}" class="btn btn-primary btn-sm phils" ><span class="uil-edit"></span></a>

                                                <form method="post" action="{{route('deleteEnv',$user->id)}}">
                                                    @csrf
                                                    @method('delete') 
                                                    <input type="hidden" name="id" value="{{$user->id}}">
                                                    <button name="submit" onclick="return confirm('Are you sure?')" value="delete" class="btn btn-danger btn-sm"><span class="uil-trash"></span></button>
                                                </form>
                                            </td>
                                            <td>{{$user->date_paid}}</td>
                                            <td>{{$user->amount_paid}}</td>
                                            <td>{{$user->duration}}</td>
                                            <td>{{$user->renewal_date}}</td>
                                            {{-- <td>
                                                @php
                                                    $leg= count($user->offices);
                                                    
                                                    if($leg==4){
                                                    $ms=  $user->offices[0]->name.", ".$user->offices[1]->name.", ".$user->offices[2]->name.", ".$user->offices[3]->name;
                                                
                                                    }elseif($leg==3){
                                                        $ms=  $user->offices[0]->name.", ".$user->offices[1]->name.", ".$user->offices[2]->name;
                                                    }elseif($leg==2){
                                                        $ms=  $user->offices[0]->name.", ".$user->offices[1]->name;
                                                    }elseif($leg==1){
                                                        $ms=  $user->offices[0]->name;
                                                    }elseif($leg==0){
                                                        $ms= "No office";
                                                    }
                                                @endphp
                                                {{$ms}}
                                            </td> --}}
                                            <td>{{$user->offices}}</td>
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