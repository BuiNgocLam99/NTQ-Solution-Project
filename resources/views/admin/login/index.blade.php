<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">

    <title>Admin </title>

    <!-- Bootstrap Core CSS -->
    <link href="/admin/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/admin/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/admin/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- my custom -->
    <link href="/admin/css/myCustom.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <div class="spinner-overlay" id="spinner">
        <div class="spinner"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <span id="error_message" class="text-danger"></span>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="panel-body">
                        <form id="myForm" method="POST">
                            @csrf
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" autofocus>
                                    <span class="text-danger" id="email_error"></span>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password">
                                    <span class="text-danger" id="password_error"></span>
                                </div>
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="/admin/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/admin/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/admin/dist/js/sb-admin-2.js"></script>

    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myForm').submit(function(e) {
                e.preventDefault();
                
                $('#spinner').show();
                
                var formData = new FormData(this);

                var fieldNames = [...formData.keys()];

                var filteredFieldNames = fieldNames.filter(function(fieldName) {
                    return fieldName !== '_token';
                });

                $.each(filteredFieldNames, function(key, value) {
                    $('span[id="' + value + '_error"]').text('');
                });

                $.ajax({
                    url: "{{ route('admin.auth.check-login') }}",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success_message) {
                            window.location.assign(response.success_message);
                        }
                        $('#error_message').text(response.error_message)
                    },
                    error: function(reject) {
                        var response = $.parseJSON(reject.responseText);
                        $('span[id*="_error"]').each(function() {
                            $(this).text('');
                        });
                        $.each(response.errors, function(key, val) {
                            $("#" + key + "_error").text(val[0]);
                        })
                    },
                    complete: function() {
                        $('#spinner').hide();
                    }
                })
            })
        })
    </script>

</body>

</html>
