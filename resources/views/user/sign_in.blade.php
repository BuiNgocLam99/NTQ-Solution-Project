@extends('layouts.app')

@section('title')
Sign In | Velzon
@endsection

@section('content')
<div class="spinner-container">
    <div class="spinner-border spinner" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="auth-page-wrapper pt-5">
    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <div>
                            <a href="index.html" class="d-inline-block auth-logo">
                                <img src="assets/images/logo-light.png" alt="" height="20">
                            </a>
                        </div>
                        <p class="mt-3 fs-15 fw-medium">Premium Admin & Dashboard Template</p>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4 card-bg-fill">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Welcome Back !</h5>
                                <p class="text-muted">Sign in to continue to Velzon.</p>
                            </div>
                            <div class="p-2 mt-4">
                                <form id="myForm">
                                    @csrf
                                    
                                    <div class="mb-3">
                                        <div id="error_message" class="text-danger"></div>                                    
                                    </div>  
                                    
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter email">
                                        <span id="email_error" class="text-danger"></span>
                                    </div>

                                    <div class="mb-3">
                                        <div class="float-end">
                                            <a href="{{ route('user.forgot-password') }}" class="text-muted">Forgot password?</a>
                                        </div>
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 password-input" name="password" placeholder="Enter password" id="password-input">
                                            <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            <span id="password_error" class="text-danger"></span>
                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember_me" id="auth-remember-check">
                                        <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-primary w-100" type="submit">Sign In</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <div class="signin-other-title">
                                            <h5 class="fs-13 mb-4 title">Sign In with</h5>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-facebook-fill fs-16"></i></button>
                                            <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-google-fill fs-16"></i></button>
                                            <button type="button" class="btn btn-dark btn-icon waves-effect waves-light"><i class="ri-github-fill fs-16"></i></button>
                                            <button type="button" class="btn btn-info btn-icon waves-effect waves-light"><i class="ri-twitter-fill fs-16"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="mt-4 text-center">
                        <p class="mb-0">Don't have an account ? <a href="{{ route('user.sign-up') }}" class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">&copy;
                            <script>document.write(new Date().getFullYear())</script> Velzon. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->
</div>
<script>
    $(document).ready(function(){
        $(".spinner-container").hide();

        $('#myForm').submit(function(e){

            e.preventDefault();

            $(".spinner-container").show();

            var formData = new FormData(this);

            var fieldNames = [...formData.keys()];

            var filteredFieldNames = fieldNames.filter(function(fieldName) {
                return fieldName !== '_token';
            });

            $.each(filteredFieldNames, function(key, value) {
                $('span[id="' + value + '_error"]').text('');
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('user.submit-sign-in') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.spinner').show();
                },
                success: function(response){
                    if(response.error_message){
                        return $('#error_message').text(response.error_message);
                    }
                    window.location.assign(response.url);
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
                    $(".spinner-container").hide();
                }
            })
        })
    })
</script>
@endsection

@push('scripts')
    <!-- particles js -->
    <script src="assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="assets/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="assets/js/pages/password-addon.init.js"></script>
    <!-- validation init -->
    <script src="assets/js/pages/form-validation.init.js"></script>
    <!-- password create init -->
    <script src="assets/js/pages/passowrd-create.init.js"></script>
@endpush