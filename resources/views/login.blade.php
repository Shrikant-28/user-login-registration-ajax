@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row ">
            <div class="col-md-5 mx-auto">
                <div class="frmDesign">
                    @include('partials.alert')
                    <form  class="login-form" method="post">
                        @csrf
                        <fieldset>
                            <legend>
                                Login
                            </legend>

                            <div class="form-group">
                                <label for="phone_number">Phone Number<span class="text-danger">*</span></label>
                                <input type="text"  class="form-control" name="phone_number" id="phone_number" class="form-control" placeholder="Enter Phone Number" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  required>
                                <span class="error errorPhoneNumber"></span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password<span class="text-danger">*</span></label>
                                <input type="password"  class="form-control" name="password" id="password" class="form-control" placeholder="Enter Password" required>
                                <span class="error errorPassword"></span>
                            </div>

                            <div class="mt-3 captha-box">
                                <div id="captcha"></div>
                            </div>
                            <button class="btn btn-default mt-2 btn-sm" type="button" onclick="createCaptcha()">Not Readable? &nbsp;
                                <i class="fa fa-refresh" aria-hidden="true"></i>
                            </button>

                            <div class="form-group">
                                <label for="cpatchaTextBox">Captha<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Captcha" name="captcha_input" id="cpatchaTextBox" maxlength="8"/>
                                <span class="error errorCaptcha"></span>
                            </div>

                            <div class="form-group">
                                <button type="button" class="btn btn-primary btnLogin">Login</button>
                            </div>

                        </fieldset>
                    </form>
                    <div class="form-group mt-4">
                        <label for="">New User? <a href="{{route('register')}}">Register</a></label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('jsExtend')
    <script src="{{asset('assets/bootstrap/js/custom.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            createCaptcha();

            function resetLoginForm(){
                $("#phone_number").val("");
                $("#password").val("");
                $("#cpatchaTextBox").val("");
                createCaptcha();
            }

            function validateLoginForm(){
                $isValid = 1;
                $(".errorName").text("");
                $(".errorPhoneNumber").text("");
                $(".errorAgreeToTc").text("");

                if($("#phone_number").val().trim().length == 0){
                    $(".errorPhoneNumber").text("Please Enter Phone Number");
                    $isValid = 0;
                }

                var phonenumber = /^\d{10}$/;
                if($("#phone_number").val().length > 0 && ($("#phone_number").val().length != 10 || !($("#phone_number").val().match(phonenumber)))){
                    $(".errorPhoneNumber").text("Phone Number must be 10-Digit");
                    $isValid = 0;
                }

                if($("#password").val().length <= 0){
                    $(".errorPassword").text("Please Enter Password");
                    $isValid = 0;
                }

                if($("#cpatchaTextBox").val().trim().length == 0){
                    $(".errorCaptcha").text("Please Enter above Text");
                    createCaptcha();
                    $isValid = 0;
                }

                return $isValid;
            }

            $(".btnLogin").click(function() {
                if(validateLoginForm() && validateCaptcha()){
                    $.ajax({
                        type: "POST",
                        url: `${APP_URL}/login`,
                        data: $(".login-form").serialize(),
                        dataType: "json",
                        beforeSend: function () {
                            $('#loader').removeClass('hidden')
                        },
                        success: function (response) {
                            resetLoginForm();
                            $("#success-alert").fadeTo(2000, 700).slideUp(700, function() {
                                $("#success-alert").slideUp(700);
                            });
                            if(response.status){
                                window.location = `${APP_URL}/dashboard`;
                            }else{
                                var str = ` <strong>Failed! </strong> ${response.error} `;
                                $("#success-alert").addClass('alert-danger').removeClass('alert-sucess');
                                $(".alert-string").html(str);
                            }
                        },
                        statusCode: {
                            401: function(response) {
                                // unauthorised
                                if( response.responseText.status == false ){
                                    var str = ` <strong>Failed! </strong> ${response.responseText.error} `;
                                    $("#success-alert").addClass('alert-danger').removeClass('alert-sucess');
                                    $(".alert-string").html(str);
                                }
                            }
                        },
                        complete: function (response) {
                            $('#loader').addClass('hidden')
                        }
                    });
                }
            });

        });

        </script>
    @endsection
@endsection
