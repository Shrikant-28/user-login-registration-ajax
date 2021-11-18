@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="frmDesign">
                    @include('partials.alert')
                    <form class="register-form " method="post">
                        @csrf
                        <input type="hidden" name="checkRequest" value="">
                        <fieldset>
                            <legend>
                                Registration
                                <button class="btn btn-default btnClose float-right" type="button"><i class="fa fa-times"></i></button>
                            </legend>

                            <div class="">
                                <label for="name">Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" maxlength="50" minlength="1" required>
                                <span class="error errorName"></span>
                            </div>

                            <div class="mt-2">
                                <label for="phonenumber">Phone Number<span class="text-danger">*</span></label>
                                <input type="text" name="phone_number" id="phonenumber" class="form-control" placeholder="Enter Phone Number" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"  required>
                                <span class="error errorPhoneNumber"></span>
                            </div>

                            <div class="mt-2">
                                <label>Gender</label>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="male">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="Male"> Male
                                    </label>
                                    <label class="form-check-label ml-2" for="female">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="Female"> Female
                                    </label>
                                </div>
                            </div>

                            <div class="mt-1">
                                <label for="city">City</label>
                                {{-- <select class="form-control chosen-select" >
                                    <option value="0">--Select--</option>
                                    <option value="Nagpur">Nagpur</option>
                                    <option value="Nagpur">Pune</option>
                                    <option value="Mumbai">Mumbai</option>
                                </select> --}}

                                <select class="selectpicker form-control" data-live-search="true" name="city" id="city">
                                    <option value="0" >--Select--</option>
                                    <option value="Nagpur" data-tokens="Nagpur">Nagpur</option>
                                    <option value="Pune" data-tokens="Pune">Pune</option>
                                    <option value="Mumbai" data-tokens="Mumbai">Mumbai</option>
                                </select>

                            </div>

                            <div class="mt-3 captha-box">
                                <div id="captcha"></div>
                            </div>
                            <button class="btn btn-default mt-2 btn-sm" type="button" onclick="createCaptcha()">Not Readable? &nbsp;<i class="fa fa-refresh" aria-hidden="true"></i></button>

                            <div class="">
                                <label for="cpatchaTextBox">Captha<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Captcha" name="captcha_input" id="cpatchaTextBox" maxlength="8"/>
                                <span class="error errorCaptcha"></span>
                            </div>

                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="signup_for_letters" id="signup_for_letters">
                                <label class="form-check-label" for="signup_for_letters">
                                    Signup for News Letter
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="agree_to_tc" name="agree_to_tc" required>
                                <label class="form-check-label" for="agree_to_tc">
                                    Agree to T & C<span class="text-danger">*</span>
                                </label><br>
                                <span class="error errorAgreeToTc"></span>
                            </div>

                            <div class="mt-3">
                                <button type="button" class="btn btn-primary" id="btnRegister">Register</button>
                            </div>

                        </fieldset>
                    </form>

                    <div class="form-group mt-4">
                        <label for="">Already Register? <a href="{{route('login')}}">Login</a></label>
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

            $(".btnClose").click(function(){
                window.location = `${APP_URL}/login`;
            })

            function resetRegisterForm(){
                $("#name").val('');
                $("#phonenumber").val('');
                $("input[name=gender]").prop('checked',false);
                // $("#city").trigger('change').val(0);
                $('#city').selectpicker('val', '0');
                $("#signup_for_letters").prop('checked',false);
                $("#agree_to_tc").prop('checked',false);
                $(".userId").text("");
                $(".errorCaptcha").text("");
                $("#cpatchaTextBox").val("");

            }

            function validateRegisterForm(){
                $isValid = 1;
                $(".errorName").text("");
                $(".errorPhoneNumber").text("");
                $(".errorAgreeToTc").text("");

                if($("#name").val().trim().length == 0){
                    $(".errorName").text("Please Enter Name");
                    $isValid = 0;
                }

                if($("#name").val().length > 50){
                    $(".errorName").text("Name is greater than 50 characters");
                    $isValid = 0;
                }

                if($("#phonenumber").val().trim().length == 0){
                    $(".errorPhoneNumber").text("Please Enter Phone Number");
                    $isValid = 0;
                }

                var phonenumber = /^\d{10}$/;
                if($("#phonenumber").val().length > 0 && ($("#phonenumber").val().length != 10 || !($("#phonenumber").val().match(phonenumber)))){
                    $(".errorPhoneNumber").text("Phone Number must be 10-Digit");
                    $isValid = 0;
                }

                if($("#agree_to_tc").prop('checked') == false){
                    $(".errorAgreeToTc").text("Please agree Terms & Conditions");
                    $isValid = 0;
                }

                if($("#cpatchaTextBox").val().trim().length == 0){
                    $(".errorCaptcha").text("Please Enter above Text");
                    createCaptcha();
                    $isValid = 0;
                }

                return $isValid;
            }

            $('#btnRegister').click(function () {
                $('input[name=captcha]').remove();
                if(validateRegisterForm() && validateCaptcha()){
                    // $('.register-form').append(
                    //     '<input type="hidden" name="captcha" value="' + code + '">'
                    // );
                    $.ajax({
                        type: "post",
                        url: "{{ route('register') }}",
                        data: $(".register-form").serialize() ,
                        dataType: "json",
                        beforeSend: function () {
                            $('#loader').removeClass('hidden')
                        },
                        success: function (response) {
                            createCaptcha();
                            $('#loader').addClass('hidden');

                            $("#success-alert").fadeTo(2000, 700).slideUp(700, function() {
                                $("#success-alert").slideUp(700);
                            });

                            if(response.status){
                                resetRegisterForm();
                                var str = `
                                <strong>Congratulations! </strong> You have registered successfully.
                                Your ID is ${response.user_id}
                                `;
                                $("#success-alert").addClass('alert-success').removeClass('alert-danger');
                                $(".alert-string").html(str);
                            }else{
                                $("#success-alert").addClass('alert-danger').removeClass('alert-success');
                                var str = `
                                <strong>Failed! </strong> ${response.error}
                                `;
                                $(".alert-string").html(str);
                            }
                        },
                        complete: function () {
                            $('#loader').addClass('hidden')
                        },
                    });
                }
            });
        })
    </script>
    @endsection
@endsection
