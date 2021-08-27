<div class="col-12" id = "h_div" style = "align-content:right, float:right">
    <div class="card">
        <div class="card-body" >
            <div class="tab-content">
                <div class="tab-pane show active" id="typeahead-preview">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Date</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(isset($history))
                            @foreach($history as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->amount}}</td>
                                    <td>{{$item->type}}</td>
                                    <td>{{$item->created_at->diffForHumans()}}</td>
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