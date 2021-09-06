<div class="col-12" style = "align-content:right, float:right">
    <div class="card">
        <div class="card-body" >
            <h4 class="header-title">Transaction History</h4>
            <div class="tab-content">
                <div class="tab-pane show active" id="typeahead-preview">
                    <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                        <tr>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Sent By</th>
                            <th>Received By</th>
                            <th>Date</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(isset($history))
                            @foreach($history as $item)
                                <tr>
                                    <td>{{$item->amount}}</td>
                                    <td>{{$item->type}}</td>
                                    <td>{{!isset($item->sender) ? "" : $item->sender-getFullName()}}</td>
                                    <td>{{!isset($item->recipient) ? "" : $item->recipient-getFullName()}}</td>
                                    <td>{{$item->created_at}}</td>
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