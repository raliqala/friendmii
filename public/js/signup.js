$(document).ready(function(){
	var name     = "";
	var email    = "";
	var password = "";
	var confirm  = "";
	var name_reg = /^[a-z ]+$/i;
    var email_reg = /^[a-z]+[0-9a-zA-Z_\.]*@[a-z_]+\.[a-z]+$/;
    var password_reg = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]{8,}$/;
	 // === Name Validations === 
	$("#name").focusout(function(){
	var store = $.trim($("#name").val());
	if(store.length == ""){
	$(".name-error").html("Name is required!");
	$("#name").addClass("border-red");
	$("#name").removeClass("border-green");
	name = "";
	}else if(name_reg.test(store)){
	$(".name-error").html("");
	$("#name").addClass("border-green");
	$("#name").removeClass("border-red");
	name = store;	
	}else{
	$(".name-error").html("Integer is not allowed!");
	$("#name").addClass("border-red");
	$("#name").removeClass("border-green");
	name = "";	
	}

	})	//Close Name Validations

	// * === Email Validation === *
	$("#email").focusout(function(){
		var email_store = $.trim($("#email").val());
        if(email_store.length == ""){
        $(".email-error").html("Email is required!");
	    $("#email").addClass("border-red");
	    $("#email").removeClass("border-green");
	    email = "";	
        }else if(email_reg.test(email_store)){
        	$.ajax({
                type : 'POST',
                url  : 'ajax/signup.php',
                dataType : 'JSON',
                beforeSend : function(){
                $(".email-error").html('<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>');
                },
                data : {'check_email' : email_store},
                success : function(feedback){
                	setTimeout(function(){
                    if(feedback['error'] == 'email_success'){
                		$(".email-error").html("<div class='text-success'><i class='fa fa-check-circle'></i> available</div>");
	                    $("#email").addClass("border-green");
	                    $("#email").removeClass("border-red");
	                    email = email_store;
                	}else if(feedback['error'] == 'email_fail'){
                		$(".email-error").html("Sorry this email is already exist!");
	                    $("#email").addClass("border-red");
	                    $("#email").removeClass("border-green");
	                    email = "";
                	}
                	},3000);
                	
                }
        	});
        }else{
        $(".email-error").html("Invalid Email Formate!");
	    $("#email").addClass("border-red");
	    $("#email").removeClass("border-green");
	    email = "";
        }
	})//Close Email Validations

	// Validate Password 
	$("#password").focusout(function(){
    var password_store = $.trim($("#password").val());
    if(password_store.length == ""){
    	$(".password-error").html("Password is required!");
    	$("#password").addClass("border-red");
	    $("#password").removeClass("border-green");
	    password = "";
    }else if(password_reg.test(password_store)){
        $(".password-error").html("<div class='text-success'><i class='fa fa-check-circle'></i> Your Password Is Strong!</div>");
    	$("#password").addClass("border-green");
	    $("#password").removeClass("border-red");
	    password = password_store;
    }else{
    	$(".password-error").html("8 characters or longer. Combine upper and lowercase letters and numbers");
    	$("#password").addClass("border-red");
	    $("#password").removeClass("border-green");
	    password = "";
    }
	})//Close Password Validations

	// Validate Confirm Password
	$("#confirm").focusout(function(){
     var confirm_store = $.trim($("#confirm").val());
     if(confirm_store.length == ""){
     $(".confirm-error").html("Confirm Password is required!");
     $("#confirm").addClass("border-red");
	 $("#confirm").removeClass("border-green");
	 confirm = "";	
     } else if(confirm_store != password){
     $(".confirm-error").html("Password is not matched!");
     $("#confirm").addClass("border-red");
	 $("#confirm").removeClass("border-green");
	 confirm = "";
     }else{
     $(".confirm-error").html("");
     $("#confirm").addClass("border-green");
	 $("#confirm").removeClass("border-red");
	 confirm = confirm_store;
     }
	})//Close Confirm Password
    
    // * === Submit the form === *
	$("#submit").click(function(){
    if(name.length == ""){
    $(".name-error").html("Name is required!");
	$("#name").addClass("border-red");
	$("#name").removeClass("border-green");
	name = "";	
    }

    if(email.length == ""){
    $(".email-error").html("Email is required!");
	$("#email").addClass("border-red");
	$("#email").removeClass("border-green");
	email = "";	
    }

    if(password.length == ""){
    $(".password-error").html("Password is required!");
	$("#password").addClass("border-red");
	$("#password").removeClass("border-green");
	password = "";	
    }

    if(confirm.length == ""){
    $(".confirm-error").html("Confirm Password is required!");
	$("#confirm").addClass("border-red");
	$("#confirm").removeClass("border-green");
	confirm = "";	
    }
    if(name.length != "" && email.length != "" && password.length != "" && confirm.length != ""){
    	$.ajax({
    		type : 'POST',
    		url  : 'ajax/signup.php?signup=true',
    		data : $("#signup_submit").serialize(),
    		dataType : 'JSON',
    		beforeSend : function(){
            $(".form-btn").attr("disabled", true);
            $(".form-btn").html("Wait........");
            $(".show-progress").addClass('progress')
    		},
    		success : function(feedback){
    			setTimeout(function(){
               if(feedback['error'] == "success"){
    			location = feedback.msg;	
    			}
    			},3000)
    		}
    	})
    }
	})

})