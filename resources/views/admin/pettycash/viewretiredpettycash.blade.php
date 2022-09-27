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
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow"></li>
                    </ol>
                </div>
                <h4 class="page-title">View Retired PettyCash</h4>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-3" id = "first_cardB" ></div>
        <div class="col-12" id = "h_div" style = "align-content:right, float:right">
            <div class="card">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="card-body" >
                    <h4 class="header-title" style = "">
                        Here you can see retired Petty Cash
                    </h4>
                    <br><br>
                    <div class="tab-content">
                        <div class="tab-pane show active" id="buttons-table-preview">
                            <table id="datatable-buttons" class="table data-table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Pettycash Expense</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th></th>
                                        
                                    </tr>
                                </thead>
    
    
                                <tbody>
                                    @if(isset($retires))
                                    @foreach($retires as $data)
                                    <tr>
                                        <td>{{$data->created_at}}</td>
                                        <td>{{$data->pettycash}}</td>
                                        <td>{{$data->description}}</td>
                                        <td>₦ {{$data->amount}}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div> 
            </div> 
        </div> 
    </div>
    
@endsection
