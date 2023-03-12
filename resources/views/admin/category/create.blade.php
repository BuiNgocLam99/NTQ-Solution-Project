@extends('admin.layouts.app')

@section('title')
    Category Add
@endsection

@section('content')
    <div class="spinner-overlay" id="spinner">
        <div class="spinner"></div>
    </div>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category
                        <small>Add</small>
                    </h1>
                    <div id="message"></div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        <form id="myForm" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Category Name</label>
                                <input class="form-control" name="name" placeholder="Please Enter Category Name" />
                                <span id="name_error" class="text-danger"></span>
                            </div>
                            <div class="form-group">
                                <label>Category Description</label>
                                <input class="form-control" name="description"
                                    placeholder="Please Enter Category Description" />
                                <span id="description_error" class="text-danger"></span>
                            </div>
                            <button type="submit" class="btn btn-default">Create</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
    </div>

    <script>
        $(document).ready(function(){

        $('#myForm').submit(function(e){
            e.preventDefault();

            $("#spinner").show();

            var formData = new FormData(this);

            var fieldNames = [...formData.keys()];

            var filteredFieldNames = fieldNames.filter(function(fieldName) {
                return fieldName !== '_token';
            });

            $.each(filteredFieldNames, function(key, value) {
                $('span[id="' + value + '_error"]').text('');
            });

            $.ajax({
                url: "{{ route('admin.category.store') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response.success_message){
                        $('#message').addClass('alert alert-success').text(response.success_message);
                    }
                },
                error: function(reject){
                    var response = $.parseJSON(reject.responseText);
                    $('span[id*="_error"]').each(function() {
                        $(this).text('');
                    });
                    $.each(response.errors, function(key, val){
                        $("#" + key + "_error").text(val[0]);
                    })
                },
                complete: function() {
                    $("#spinner").hide();
                }
            })
        })
    })
    </script>
@endsection
