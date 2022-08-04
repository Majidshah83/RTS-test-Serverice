jQuery(document).ready(function() { 

	jQuery('.validate_frm').formValidation(); // end 	#add_edit_emergency_contact_frm		

	jQuery('#profile_frm').formValidation({
	    fields: {
	        upload_avatar: {
	            validators: {
	                file: {
	                    extension: 'jpeg,jpg,png',
                        type: 'image/jpeg,image/png',
                        //maxSize: 2097152,   // 2048 * 1024
                        message: 'The selected file is not valid'
	                }
	            }
	        }
	    }
	}); // end 	#add_edit_emergency_contact_frm		

	jQuery('.validate_frm_images').formValidation({
	    fields: {
	        theme_thumb_1: {
	            validators: {
	                file: {
	                    extension: 'jpeg,jpg,png',
                        type: 'image/jpeg,image/png',
                        //maxSize: 2097152,   // 2048 * 1024
                        message: 'The selected file is not valid'
	                }
	            }
	        },
	        theme_thumb_2: {
	            validators: {
	                file: {
	                    extension: 'jpeg,jpg,png',
                        type: 'image/jpeg,image/png',
                        //maxSize: 2097152,   // 2048 * 1024
                        message: 'The selected file is not valid'
	                }
	            }
	        },
	        theme_preview_thumb: {
	            validators: {
	                file: {
	                    extension: 'jpeg,jpg,png',
                        type: 'image/jpeg,image/png',
                        //maxSize: 2097152,   // 2048 * 1024
                        message: 'The selected file is not valid'
	                }
	            }
	        }
	    }
	}); // end 	#validate_frm_images		
						
});
