
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
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Request Funds</li>
                    </ol>
                </div>
                <h4 class="page-title">Request Extra funds</h4>
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
                    <div class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <form method = "POST" action = "{{route('cash.request')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3 mt-3">
                                            <label class="form-label">Send Request to</label>
                                            <select class="form-control select2" name="destination" id="destination" data-toggle="select2" required>
                                                <option value="am">Area Manager</option>
                                                <option value="cashier">Cashier</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 mt-3" id="cashier-block" style="display: none;">
                                            <label class="form-label">Select Cashier</label>
                                            <select class="form-control select2" name="cashier" data-toggle="select2" id="cashier" required>
                                                @if(isset($cashiers))
                                                    @foreach($cashiers as  $cashier)
                                                        <option value="{{$cashier->id}}">{{$cashier->user->firstname}} </option>
                                                    @endforeach
                                                @endif
                                            </select>

                                        </div>
                                        <div class="mb-3 mt-4">
                                            <label class="form-label">Amount to Request</label>
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
    <script>
        $('#destination').on('change', function() {
            if(this.value == 'cashier') {
                $("#cashier-block").show();
            }
            else{
                $("#cashier-block").hide();
            }
        });
    </script>
@endsection







