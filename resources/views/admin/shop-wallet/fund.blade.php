
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
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Create Shop Wallet</li>
                    </ol>
                </div>
                <h4 class="page-title">Fund {{$shop->office->name    }} Shop Wallet</h4>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="row">
            <div class="col-sm-5">
                <div class="card tilebox-one">
                    <div class="card-body">
                        <i class="dripicons-jewel float-end text-muted"></i>
                        <h6 class="text-muted text-uppercase mt-0">Balance</h6>
                        <h2 class="m-b-20">₦<span>{{$shop->balance}}</span></h2>
                    </div> <!-- end card-body-->
                </div> <!--end card-->
            </div><!-- end col -->
        </div>

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
                        Fund your Shop Wallet
                    </h4>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <form method = "POST" action = "/shop-wallet/fund/{{$shop->id}}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3 mt-4">
                                            <label class="form-label">Amount to Fund</label>
                                            <input type="text" name= "amount" class="form-control" placeholder="200" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mt-3 mt-lg-0">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
@endsection

@section('script')
@endsection







