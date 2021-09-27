
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">

                    <li class="breadcrumb-item active" style="display:none" id="headerShow">Create Staff</li>
                </ol>
            </div>
            <h4 class="page-title">Staff Form Preview</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12" id="h_div" style="align-content:right, float:right">
        <div class="card">
            <div class="card-body">

                <!-- company Information Starts -->
                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false"
                           class="nav-link active">
                            PERSONAL INFORMATION
                        </a>
                    </li>
                </ul>
                <div id="personalPreview" class="row"></div>


                <!--company Information Starts -->
                <ul class="nav nav-tabs nav-bordered mb-3">
                    <li class="nav-item">
                        <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false"
                           class="nav-link active">
                            COMPANY INFORMATION
                        </a>
                    </li>
                </ul> <!-- end nav-->
                <div id="companyPreview" class="row"></div>


                <!-- Work Experiences Begin -->
                <ul class="nav nav-tabs nav-bordered mb-3">
                        <li class="nav-item">
                            <a href="#typeahead-preview" data-bs-toggle="tab" aria-expanded="false"
                               class="nav-link active">
                                Work Experience
                            </a>
                        </li>
                    </ul>
                <div id="experiencePreview" class="row"></div>

                    <div class="row" style="margin-top:10px">
                        <div class="row" style="margin-top:30px">
                            <div style="justify-content:flex-start; display: flex" class="col-lg-6 pull-left">
                                <button class="btn btn-primary" name="back" type="button" value="Back" id="submit">Back</button>
                            </div>
                            <div style="justify-content:flex-end; display: flex;" class="col-lg-6 pull-right">
                                <button class="btn btn-primary" name="proceed" value="Submit"
                                        id="submit">Submit</button>
                            </div>
                        </div>
                    </div>
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>


<script>
    $(function () {

        let url = "{{url('api/get-states')}}";
        console.log('mymessage' + url);
        $.ajax({
            url: url,
            type: 'get',
            data: { level: '1' },

            success: function (data) {

                console.log('thisadata', data);
                $.each(data, function (key, states) {
                    console.log("CountryState", states);
                    let option = `<option value="${states.name}"> ${states.name}</option>`;
                    $("#state").append(option);
                });

                //Change the text of the default "loading" option.
                //$('#addons-select').removeClass('d-none').addClass('d-block')
                //$('#addon-loader').removeClass('d-block').addClass('d-none');
                //$('#submit').removeClass('d-none').addClass('d-block');


                console.log("response", data);
            },
            error: function (xhr, err) {
                var responseTitle = $(xhr.responseText).filter('title').get(0);
                alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err));
            }

        });


        $('#state').change(function () {
            let selectedState = $(this).val();
            console.log("thisIsMySelectedState", selectedState)

            //        alert("The paragraph was clicked.");


            if (selectedState !== '') {
                //$('#addon-loader').removeClass('d-none').addClass('d-block');
                //$('#submit').removeClass('d-block').addClass('d-none');
                // getAddon(code);


                let url = "{{url('api/get-lga')}}";
                console.log('mymessage' + url);
                $.ajax({
                    url: url,
                    type: 'post',
                    data: { state: selectedState },

                    success: function (data) {
                        // $('#addons option:not(:first)').remove();
                        console.log('thisadata', data);
                        $.each(data, function (key, lga) {
                            console.log("CountryState", lga);
                            let option = `<option value="${lga}"> ${lga}</option>`;
                            $("#lgas").append(option);
                        });


                    },
                    error: function (xhr, err) {
                        var responseTitle = $(xhr.responseText).filter('title').get(0);
                        alert($(responseTitle).text() + "\n" + formatErrorMessage(xhr, err));
                    }

                });
            }
            else {
                $('#addon-loader').removeClass('d-block').addClass('d-none');
                $('#addons option:not(:first)').remove();

                $('#addons-select').removeClass('d-block').addClass('d-none')
                $('#submit').removeClass('d-block').addClass('d-none');
            }

        });




        function formatErrorMessage(jqXHR, exception) {

            if (jqXHR.status === 0) {
                return ('Not connected.\nPlease verify your network connection.');
            } else if (jqXHR.status == 404) {
                return ('The requested page not found. [404]');
            } else if (jqXHR.status == 500) {
                return ('Internal Server Error [500].');
            } else if (exception === 'parsererror') {
                return ('Requested JSON parse failed.');
            } else if (exception === 'timeout') {
                return ('Time out error.');
            } else if (exception === 'abort') {
                return ('resource request aborted.');
            } else {
                return ('Uncaught Error.\n' + jqXHR.responseText);
            }
        }
    });
</script>
