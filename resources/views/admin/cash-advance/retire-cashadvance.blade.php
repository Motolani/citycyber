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
                        <li class="breadcrumb-item active" style = "display:none" id = "headerShow">Request Cash Advance</li>
                    </ol>
                </div>
                <h4 class="page-title">Retire Cash Advance</h4>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-3" id = "first_cardB" ></div>
        <div class="col-6" id = "h_div" style = "align-content:right, float:right">
            <div class="card">
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="card-body" >
                    <h4 class="header-title" style = "">
                        Here you can retire Cash Advance
                    </h4>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="typeahead-preview">
                            <form method = "POST" enctype="multipart/form-data" action = "{{route('cash-advance-retire.store')}}">
                                @csrf
                                <div class="row">
                                
                                    <input type="hidden" name = "cash_advance_id" class="form-control"  value="{{$data->id}}">
                                    
                                    <div class="mb-3">
                                        <label for="example-email" class="form-label">Staff Name </label>
                                        <input type="text" name = "staff_name" class="form-control" data-provide="typeahead" id="the-basics" value="{{$data->staff_name}}" disabled>
                                        
                                    </div>

                                    <div class="mb-3">
                                        <label for="example-email" class="form-label">Branch </label>
                                        <input type="text" name = "staff_name" class="form-control" data-provide="typeahead" id="the-basics" value="{{$data->office_branch}}" disabled>
                                        
                                    </div>
                                    
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label required">Amount</label>
                                            <input type="text" name = "amount" class="form-control" data-provide="typeahead" id="the-basics" value="{{$data->amount}}" disabled>
                                        </div>
                                    </div> 

                                    <div class="mb-3">
                                        <label for="example-email" class="form-label">Expense category </label>
                                        <input type='text' name='expense_category' class="form-control" data-provide="typeahead" value="{{$data->category_name}}" disabled/>
                                    </div>

                                    <div class="col-lg-12 mt-3 mt-lg-0">
                                        <div class="mb-3">
                                            <label class="form-label required">Description</label>
                                            <textarea required name= "description" class="form-control" placeholder="Description">
                                            </textarea>
                                        </div>
                                    </div> 

                                    <div class="col-lg-12 mt-3 mt-lg-0">
                                        <div class="mb-3">
                                            <input name="file" type="file" class="custom-file-input" > 
                                            <br>
                                            <span id="fileHelp" class="form-text text-muted">Please upload a valid image file. Size of image should not be more than 2MB.</span>
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
    
@endsection


@section('script')

@endsection
                
                
                
                
                
                
                
                
