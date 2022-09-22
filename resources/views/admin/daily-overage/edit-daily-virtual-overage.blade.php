
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
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Update Daily Overage</li>
                    </ol>
                </div>
                <h4 class="page-title ">Update Daily Overage</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->


        <div class="col-12" id = "h_div" style = "align-content:right, float:right">
            <div class="card">
                <div class="card-body" >
                    <h4 class="header-title" style = "">Daily Overage
                    </h4>           
                    <p class="text-muted font-14">
                        Here you can update daily overage 
                    </p>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">

                            <form method = "POST" action ="{{url('update-daily-overage/'.$overage->id)}}">
                                @csrf
                                  <div class="row">
                                    <div class="col-md-4 mb-3 mb-3 ">
                                        <label for="branch ">Branch Office</label>
                                        <span class="text-primary">
                                            <p><b>{{$getOffice->name}}</b></p>
                                           </span>
                                          
                                        </div> 
    
                                        <div class="col-md-4 mb-3 ">
                                         <label for="cashier">Cashier Name</label>
                                         <span class="text-primary">
                                         <p><b>{{Auth::user()->firstname}}</b></p>
                                        </span>
                                     </div>
                                  </div>
                                <div class="row ">
                                    <div class="col-md-6 mb-3 mb-3">
                                        <label for="card number">Game Type</label>
                                        <select  name="game_name" class="form-select form-control" >
                                            @foreach($gameName  as $row)
                                            @if($row->name == $overage->game_name)
                                                <option value="{{$row->name }}" selected>{{$row->name}}</option>
                                            @else
                                                <option value="{{$row->name }}">{{$row->name}}</option>
                                            @endif
                                            
                                            @endforeach 
                                          </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="card number">Amount(<b>&#8358;</b>)</label>
                                            <input type="number"  name="amount"  min="0" value="{{$overage->amount}}" class="form-control" placeholder="please enter the game name" autocomplete="off">
                                        
                                        </div>
                                    </div> 

                                       
                                        <div class=" row border p-2">
                                               <label for="dateRange" class="mb-3 text-primary">virtual overage date  in a week</label>
                                                
                                               <label for="date" class="col-sm-2 col-form-label">Date</label>
                                                <div class="col-sm-8 mb-3 mb-3">
                                                <input type="text" class="form-control" name="date" id="fromdate" value="{{date('Y-m-d', strtotime($overage->date))}}" class="form-control" placeholder="please select date" autocomplete="off">
                                                </div>
                                        </div> 
                                    </div>

                                    <div class="col-md-12 mb-3 mt-3">
                                    <div class="col-md-4 offset-md-8">
                                        <a href="{{url('/daily-overage-index')}}" class="btn btn-outline-primary float-right">Back </a>
                                        <button type="submit" class="btn btn-primary">Update Daily Overage</button>
                                    </div>
                            </form>
                        </div> <!-- end preview-->
                    </div> <!-- end tab-content-->
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection

@section('script')
<script type="text/javascript"> 
$(document).ready(function () {
                $('#fromdate').datepicker({
                    autoclose:true,
                    format: "yyyy/mm/dd"
                });

                $('#topdate').datepicker({
                    autoclose:true,
                    format: "yyyy/mm/dd"
                });
            });
 </script>
@endsection








