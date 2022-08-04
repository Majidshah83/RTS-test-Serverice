jQuery(document).ready(function() {

	// Shift branch by clicking a link
	$('.shift_branch_link').click(function(){
		
		var p_branch_id = $(this).attr('data-shift-to-branch-id');
		
		$.ajax({
		url: SURL + 'pharmacy/shift-branch',
		type: "POST",
		data: {'branch_id': p_branch_id},
		success: function(data){
			location.reload();
		} // success

	  }); // $.ajax
		
	});

	$('#p_branch_id').change(function(){

		

		var p_branch_id = $(this).val();

		

		$.ajax({

		url: SURL + 'pharmacy/shift-branch',

		type: "POST",

		data: {'branch_id': p_branch_id},

		success: function(data){

			location.reload();

		} // success



	  }); // $.ajax

		

	});



	$('#p_branch_id_booking').change(function(){

		

		var p_branch_id = $(this).val();

		

		$.ajax({

		url: SURL + 'pharmacy/shift-branch',

		type: "POST",

		data: {'branch_id': p_branch_id},

		success: function(data){

			location.reload();

		} // success



	  }); // $.ajax

		

	});



	//Auto Login/ Register/ EPS form

	$('.auto_process').click(function(){

		

		data_type = $(this).attr('data-type');

		auto_id = Math.floor((Math.random() * 10000) + 1)

		form_id = 'frm_auto_'+auto_id;

		pid = $('#pid').val();

		b_id = '';

		

		if($('#br_id').length)

			b_id = $('#br_id').val();

			

		if(data_type == 'logout')

			var frm_action = PATIENT_PHARMAFOCUS_SURL+'logout';

		if(data_type == 'login')

			var frm_action = PATIENT_PHARMAFOCUS_SURL+'login';

		else if (data_type == 'register')

			var frm_action = PATIENT_PHARMAFOCUS_SURL+'register';

		else if (data_type == 'repeat-prescription')

			var frm_action = PATIENT_PHARMAFOCUS_SURL+'repeat-prescription';

		else if (data_type == 'eps')

			var frm_action = PATIENT_PHARMAFOCUS_SURL+'eps';

		

		$("div#auto_frm").html(

			

			$("<form/>", {

				action: frm_action,

				method: 'POST',

				id: form_id

			}).append(

				$("<input/>", {

					type: 'hidden',

					name: 's_p_id',

					readonly: 'readonly',

					value: pid

				}), // Creating Input Element With Attribute.

			

				$("<input/>", {

					type: 'hidden',

					readonly: 'readonly',

					name: 's_b_id',

					value: b_id

				}), 



				$("<input/>", {

					type: 'submit',

					id: 'auto_submit_'+auto_id,

					value: '1'

				})

			))		

			$('#auto_submit_'+auto_id).click();

	})



});



function verify_email(form_id){



	// Verify if the form is Validated

	$('#'+form_id).formValidation('validate');

	var isValidForm = $('#'+form_id).data('formValidation').isValid();



	if(isValidForm == true){



		// Check Email Exists

		var email_address = $('#email_address').val();

		var user_id = $('#user_id').val();



		var selected_branch_id = $('#branch_id').val();



		if(email_address !=''){

			  

			$.ajax({

				url: SURL + 'register/email-exist',

				type: "POST",

				data: {'email': email_address, 'user_id': user_id, 'selected_branch_id' : selected_branch_id},

				success: function(data){

				  var obj = JSON.parse(data);

				  

				  if(obj.exist == 1){

					

					$("#error_msg").html("Email you entered already exist please use another one!");

					$("#error_msg").css({"color":"#a94442"});

					$( "#email_address" ).focus();



				  } else {

					

					$("#error_msg").html("");

					$( "form#"+form_id )[0].submit();

				 }

				  

				} // success



			}); // $.ajax



	  	} // if(is_valid_form == true)



	} // end if

	   

} // function verify_email()



function set_cookie_info(){

	document.cookie = "parkroad_cookie_info=1; expires=Thu, 18 Dec 2036 12:00:00 UTC; path=/";

	

	$('#cookie_info').addClass('hide');

	$('#cookie_info').addClass('hidden');

	$('#cookie_info').addClass('d-none');

}	