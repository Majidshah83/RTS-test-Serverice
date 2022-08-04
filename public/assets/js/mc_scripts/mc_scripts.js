$(document).ready(function(){

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////// START => DEFINE CUSTOM VALIDATORS /////////////////////////////////////////////

     // (1) => Alphanumeric
     $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[\w ]+$/i.test(value);
    }, "Letters, numbers only please");

    // (2) => Email Address
    $.validator.addMethod("validate_email", function(value, element) {
        return this.optional( element ) || /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@(?:\S{1,63})$/.test( value );
    }, 'Please enter a valid email address.');

    // (3) => Mobile Number
    jQuery.validator.addMethod("validate_mobile_number", function(value, element) {
        return this.optional( element ) || /^[0-9+']*$/.test( value );
    }, 'Please enter a valid contact number.');

    //////////////////////////////////// NEW METHODS ////////////////////////////////////

    // validate_titles
    jQuery.validator.addMethod("validate_titles", function(value, element) {
        return this.optional( element ) || /^[a-zA-Z0-9\s-+,.#&?()']*$/.test(value);
    }, "Allowed characters are: Alphanumeric and special character -+,.#&?()'");

    // validate_password
    jQuery.validator.addMethod("validate_password", function(value, element) {
        return this.optional( element ) || /^[a-zA-Z0-9\s-()]*$/.test(value);
    }, "Allowed characters are: Alphanumeric and special character -()");

    // validate_grade
    jQuery.validator.addMethod("validate_grade", function(value, element) {
        return this.optional( element ) || /^[a-zA-Z0-9\s-+_,.#&?%/()']*$/.test(value);
    }, "Allowed characters are: Alphanumeric and special character -+_.#&?%/()'");

    // validate_textareas
    jQuery.validator.addMethod("validate_textareas", function(value, element) {
        return this.optional( element ) || /^[a-zA-Z0-9\s-().,]*$/.test(value);
    }, "Allowed characters are: Alphanumeric and special character -().,");

    // combined_address
    jQuery.validator.addMethod("combined_address", function(value, element) {
        return this.optional( element ) || /^[a-zA-Z0-9\s-().,']*$/.test(value);
    }, "Allowed characters are: Alphanumeric and special character -().,'");

    // validate_url_slug
    jQuery.validator.addMethod("validate_url_slug", function(value, element) {
        return this.optional( element ) || /^[a-zA-Z0-9\s-]*$/.test(value);
    }, "Allowed characters are: Alphanumeric and special character -");

    $.validator.addMethod("max_len", function (value, element, len){
        return value == "" || value.length <= len;
     });

    // pharmacy_validate_titles
    jQuery.validator.addMethod("pharmacy_validate_titles", function(value, element) {
        return this.optional( element ) || /^[a-zA-Z0-9\s-(),]*$/.test(value);
    }, "Allowed characters are: Alphanumeric and special character -()'");

     // pharmacy_validate_description
     jQuery.validator.addMethod("pharmacy_validate_description", function(value, element) {
        return this.optional( element ) || /^[a-zA-Z0-9\s-(),]*$/.test(value);
    }, "Allowed characters are: Alphanumeric and special character -()'");

    // pharmacy_contact_numbers
     jQuery.validator.addMethod("pharmacy_contact_numbers", function(value, element) {
        return this.optional( element ) || /^[0-9\s-()+ ]*$/.test(value);
    }, "Allowed characters are: Alphanumeric and special character -()'");

      // pharmacy_validate_social_media_urls
      jQuery.validator.addMethod("pharmacy_validate_social_media_urls", function(value, element){
        return this.optional( element ) || /^[a-zA-Z0-9\s-()/:,.]*$/.test(value);
    }, "Allowed characters are: Alphanumeric and special character -()'");


    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
      }, 'File size must be less than {0} bytes');

    ///////////////////////////////////////////// END => DEFINE CUSTOM VALIDATORS /////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

}); // $(document).ready(function()

/////////////////// START => VALIDATION FUNCTIONS ///////////////////

$(document).ready(function(){

    // Login Page Validate Event
    $('#mc-login-sbt-btn').click(function(){

        var is_valid = validate_login_form();
        // alert(is_valid);

        if( is_valid == true ){

            $('#mc-login-form')[0].submit();

        } else if( is_valid == false ){

            return false;

        } // if( is_valid == true )

    }); // click => $('#mc-login-sbt-btn').click(function()

    // Forgot Password Page Validate Event
    $('#mc-forgot-password-sbt-btn').click(function(){

        var is_valid = validate_forgot_password_form();
        // alert(is_valid);

        if( is_valid == true ){

            $('#mc-forgot-password-form')[0].submit();

        } else if( is_valid == false ){

            return false;

        } // if( is_valid == true )

    }); // click => $('#mc-forgot-password-sbt-btn').click(function()

    // Reset Password Page Validate Event
    $('#mc-reset-password-sbt-btn').click(function(){

        var is_valid = validate_reset_password_form();
        // alert(is_valid);

        if( is_valid == true ){

            $('#mc-reset-password-form')[0].submit();

        } else if( is_valid == false ){

            return false;

        } // if( is_valid == true )

    }); // click => $('#mc-reset-password-sbt-btn').click(function()

    // Register Page Validate Event
    $('#mc-register-sbt-btn').click(function(){

        let is_valid = validate_register_form();
        // alert(is_valid);
        console.log('register')
        if( is_valid == true ){

            $('#mc-register-form')[0].submit();

        } else if( is_valid == false ){

            return false;

        } // if( is_valid == true )

    }); // click => $('#mc-register-sbt-btn').click(function()

    // Complaint Page Validate Event
    $('#mc-complaint-sbt-btn').click(function(){

        /*
        var is_valid = validate_complaint_form();
        // alert(is_valid);

        if( is_valid == true ){

            // $('#mc-complaint-form')[0].submit();

            return true;

        } else if( is_valid == false ){

            return false;

        } // if( is_valid == true )
        */

    }); // click => $('#mc-register-sbt-btn').click(function()

       // Complaint Page Validate Event
       $('#contact_us_submit_btn').click(function(){

        var is_valid = validate_contact_us_form();
        // alert(is_valid);

        if( is_valid == true ){

            //$('#contact_us_frm')[0].submit();
            return true;

        } else if( is_valid == false ){

            return false;

        } // if( is_valid == true )

    }); // $('#contact_us_submit_btn').click(function(){



}); // ready

// Start => function validate_login_form()
function validate_login_form(){

    var validator = $('#mc-login-form').validate({

        rules: {

            email_address: {

                required: true,
                maxlength: 100,
                validate_email: true

            },

            password: {

                required: true,
                maxlength: 50

            }

        },

        submitHandler: function(form) {
            // mc_submit_crud();
        }

    });

    return validator.form();

} // End => function validate_login_form()

// Start => function validate_forgot_password_form()
function validate_forgot_password_form(){

    var validator = $('#mc-forgot-password-form').validate({

        rules: {

            email_address: {

                required: true,
                maxlength: 100,
                validate_email: true

            }

        },

        submitHandler: function(form) {
            // mc_submit_crud();
        }

    });

    return validator.form();

} // End => function validate_forgot_password_form()

// Start => function validate_reset_password_form()
function validate_reset_password_form(){

    var validator = $('#mc-reset-password-form').validate({

        rules: {

            email_address: {

                required: true,
                maxlength: 100,
                validate_email: true

            },
            password: {

                required: true,
                maxlength: 100

            },

            password_confirmation: {

                required: true,
                maxlength: 100,
                equalTo: "#password",

            }

        },

        submitHandler: function(form) {
            // mc_submit_crud();
        }

    });

    return validator.form();

} // End => function validate_reset_password_form()

// Start => function validate_register_form()
function validate_register_form(){

    var validator = $('#mc-register-form').validate({

        rules: {

            first_name: {

                required: true,
                maxlength: 50,
                validate_titles: true

            },

            last_name: {

                required: true,
                maxlength: 50,
                validate_titles: true

            },

            gender: {

                required: true

            },

            day: {

                required: true

            },

            month: {

                required: true

            },

            year: {

                required: true

            },

            contact_no: {
                required: true,
                validate_titles: true

            },

            nhs_no: {

                validate_titles: true

            },

            address_1: {

                validate_titles: true

            },

            address: {

                required: true,
                validate_titles: true

            },

            address_2: {

                validate_titles: true

            },

            address_3: {

                validate_titles: true

            },

            town: {

                required: true,
                validate_titles: true

            },

            county: {

                validate_titles: true

            },

            postcode: {

                required: true,
                validate_titles: true

            },

            email_address: {

                required: true,
                maxlength: 100,
                validate_email: true

            },

            password: {

                required: true,
                maxlength: 50

            },

            password_confirmation: {

                required: true,
                maxlength: 50,
                equalTo: "#password"

            },

            i_agree: {

                required: true

            }

        },

        submitHandler: function(form) {
            // mc_submit_crud();
        }

    });

    return validator.form();

} // End => function validate_register_form()

// Start => function validate_complaint_form()
function validate_complaint_form(){

    var validator = $('#mc-complaint-form').validate({

        rules: {

            first_name: {

                required: true,
                maxlength: 100,
                validate_titles: true

            },

            last_name: {

                required: true,
                maxlength: 100,
                validate_titles: true

            },

            email_address: {

                required: true,
                maxlength: 100,
                validate_email: true

            },

            phone_number:{
                validate_titles: true
            },

            message:{
                maxlength: 700,
            }

        },

        submitHandler: function(form) {
            // mc_submit_crud();
        }

    });

    return validator.form();

} // End => function validate_complaint_form()


// Start => function validate_contact_us_form()
function validate_contact_us_form(){

    var validator = $('#contact_us_frm').validate({

        rules: {

            name: {

                required: true,
                maxlength: 100,
                validate_titles: true

            },

            first_name: {

                required: true,
                maxlength: 100,
                validate_titles: true

            },

            last_name: {

                required: true,
                maxlength: 100,
                validate_titles: true

            },

            email_address: {

                required: true,
                maxlength: 100,
                validate_email: true

            },

            contact_no: {
                required: true,
                validate_titles: true
            },

            message: {
                required: true,
                maxlength: 700,

            },

        },

        submitHandler: function(form) {
            // mc_submit_crud();
        }

    });

    return validator.form();

} // End => function validate_contact_us_form()


function validateById(id = '') {
    switch (id) {
        case "mc-register-form":
            return validate_register_form();

        case "mc-login-form":
            return validate_login_form();

        case "mc-forgot-password-form":
            return validate_forgot_password_form();

        case "mc-reset-password-form":
            return validate_reset_password_form();

        case "mc-edit-profile-form":
            return true;

        default:
            return true;
    }
}
