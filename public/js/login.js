$(document).ready(function(){

	var email    = "";
	var password = "";
	// === Email Validations ===
	$("#login-email").focusout(function(){
		var email_store = $.trim($("#login-email").val());
		if(email_store.length == ""){
			$("#login-email").addClass("border-red");
			$("#login-email").removeClass("border-green");
			$(".login-email-error").html("Email is required!");
			email = "";
		}else{
			$("#login-email").addClass("border-green");
			$("#login-email").removeClass("border-red");
			$(".login-email-error").html("");
			email = email_store;
		}
	})//close email validations

    // === Password Validations ===
	$("#login-password").focusout(function(){
		var password_store = $.trim($("#login-password").val());
		if(password_store.length == ""){
			$("#login-password").addClass("border-red");
			$("#login-password").removeClass("border-green");
			$(".login-password-error").html("Password is required!");
			password = "";
		}else{
			$("#login-password").addClass("border-green");
			$("#login-password").removeClass("border-red");
			$(".login-password-error").html("");
			password = password_store;
		}
});//Password validation close


	// === Submit the login form ===
	$("#login-submit").click(function(){
		if(email.length == ""){
		    $("#login-email").addClass("border-red");
			$("#login-email").removeClass("border-green");
			$(".login-email-error").html("Email is required!");
			email = "";	
		}
		if(password.length == ""){
		    $("#login-password").addClass("border-red");
			$("#login-password").removeClass("border-green");
			$(".login-password-error").html("Password is required!");
			password = "";	
		}
		if(password.length != "" && email.length != ""){
			$.ajax({
				type : 'POST',
				url  : 'ajax/login.php?login_form=true',
				data : $("#login-submit-form").serialize(),
				dataType : "JSON",
				success : function(feedback){
					if(feedback['error'] == 'success'){
						$(".login-error").html("");
						$("#login-password").addClass("border-green");
						$("#login-email").addClass("border-green");
						$("#login-password").removeClass("border-red");
						$("#login-email").removeClass("border-red");
						$(".login-error").addClass("login-progress");
						setTimeout(function(){
                          location = feedback['msg'];
						},2000);
						
					}else if(feedback['error'] == 'no_password'){
						$("#login-password").addClass("border-red");
						$("#login-password").removeClass("border-green");
						$(".login-error").html(feedback['msg']);
					}else if(feedback['error'] == 'no_email'){
						$("#login-email").removeClass("border-green");
						$("#login-email").addClass("border-red");
						$(".login-error").html(feedback['msg']);
					}
				}
			})
		}
	})

});