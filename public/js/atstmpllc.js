$(document).ready(function() {	

//Common Variables
	var windowHeight = window.innerHeight;
	var windowWidth = document.body.clientWidth;
	var documentHeight = document.body.clientHeight;
	
//Make the body min height the same size as the window height 	
	$("body#admin_page_login").css({minHeight:windowHeight});

//Show gif images while ajax is loading
	$(document).ajaxStart(function(){
		$("#loading_image").fadeIn("slow");
	});
	$(document).ajaxComplete(function(){
		$("#loading_image").fadeOut("slow");
		$("#confirmed_modal").fadeIn();
		setTimeout(function()
		{
			$("#confirmed_modal, #overlay_PhillyPage").fadeOut();
			$("#confirmed_modal p").remove();
		}, 7000);
	});

	//Change page if bank is changed when transaction type is transfer
		$("body").on("change", ".bankSelect, .transferAccountType", function(e) {
			var transactionType = $(".transactionSelect").val();
			var bankValue = $(".bankSelect").val();
			var transferValue = $(".transferAccountType").val();
			
			if(bankValue != null) {
				if(transactionType == "Transfer") {
					if(typeof transferValue != "undefined" && transferValue) {
						window.open("transactions.php?new_transaction&transfer&bank="+bankValue+"&type="+transferValue, "_self");
					} else {
						window.open("transactions.php?new_transaction&transfer&bank="+bankValue, "_self");
					}
				}
			}
		});
	
	//Bring up pictures to see before deleting or bring up all pictures
		$("body").on("change", ".transactionSelect", function(e) {
			var transactionType = $(".transactionSelect").val();

			if(transactionType == "Transfer") {
				window.open("transactions.php?new_transaction&transfer", "_self");
			} else if(transactionType == "Withdrawl") {
				window.open("transactions.php?new_transaction&withdrawl", "_self");
			} else if(transactionType == "Deposit") {
				window.open("transactions.php?new_transaction&deposit", "_self");
			} else if(transactionType == "Purchase") {
				window.open("transactions.php?new_transaction", "_self");
			}
		});
		
	//Show transaction photo in colorbox plugins
		$('a.transImg').magnificPopup({type:'image'});
});

//Transaction form error check function
	function transErrorCheck() {
		var errors = 0;
		var errorMsg = "";
		var errorModal;
		var transactionAmount = $(".transAmount");
		var transferType = $(".transferAccountType");
		var bank = $(".bankSelect");

		if(transactionAmount.val() == "") {
			errors++;
			errorMsg += "<li class='errorItem'>" + errors + ". " + "Transaction Amount Cannot Be Empty</li>";
			transactionAmount.addClass("error_border");
		} if(transferType.length > 0) {
			if(transferType.val() == null || transferType.val() == "blank") {
				errors++;
				errorMsg += "<li class='errorItem'>" + errors + ". " + "Transfer Type Needs To Be Selected</li>";
				transferType.addClass("error_border");
			}
		} if(bank.val() == null || bank.val() == "blank"){
			errors++;
			errorMsg += "<li class='errorItem'>" + errors + ". " + "A Bank To Be Selected</li>";
			bank.addClass("error_border");
		}
		
		$("#return_messages ul").empty();
		$("#return_messages ul").append(errorMsg);
		if(errors > 0) {
			event.preventDefault();			
		} else {
			return true;
		}
	}
	
//User form error check function
	function userErrorCheck() {
		var errors = 0;
		var errorMsg = "";
		var errorModal;
		var username = $(".newUsername");
		var password = $(".newPassword");
		var firstname = $(".newFirstname");
		var lastname = $(".newLastname");

		if(username.val() == "" || username.val() == null) {
			errors++;
			errorMsg += "<li class='errorItem'>" + errors + ". " + "Username Cannot Be Empty</li>";
			username.addClass("error_border");
		} if(password.val() == null || password.val() == "") {
			errors++;
			errorMsg += "<li class='errorItem'>" + errors + ". " + "Password Cannot Be Empty</li>";
			password.addClass("error_border");
		} if(firstname.val() == null || firstname.val() == ""){
			errors++;
			errorMsg += "<li class='errorItem'>" + errors + ". " + "First Name Cannot Be Empty</li>";
			firstname.addClass("error_border");
		} if(lastname.val() == null || lastname.val() == ""){
			errors++;
			errorMsg += "<li class='errorItem'>" + errors + ". " + "Last Name Cannot Be Empty</li>";
			lastname.addClass("error_border");
		}
		
		$("#return_messages ul").empty();
		$("#return_messages ul").append(errorMsg);
		if(errors > 0) {
			event.preventDefault();
		} else {
			return true;
		}
	}
	
//Check for errors function
	// var errors;
	// function errorCheck(regName, regAdd, regPhone, regEmail, numAdults, adultName, youthName, childName) {
		// event.preventDefault();
		// var errors = 0;
		// $("#errors_modal_contentP").empty();
		// $("#registration_modal input").removeClass("error_border");
		// var phoneRegrex = /^([0-9]{3})?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
		// var errorMsg = "";

		// if(regName == "" || regName == null){
			// errors++;
			// errorMsg += errors + ". Registers name cannot be blank.<br/>";
			// $("#name").addClass("error_border");
		// }
		// if(regAdd == "" || regAdd == null){
			// errors++;
			// errorMsg += errors + ". Registers address cannot be blank.<br/>";
			// $("#address").addClass("error_border");
		// }
		// if(regPhone == "" || regPhone == null){
			// errors++;
			// errorMsg += errors + ". Registers phone number cannot be blank.<br/>";
			// $("#phone").addClass("error_border");
		// }
		// if(!regPhone.match(phoneRegrex) && regPhone != "") {
			// errors++;
			// errorMsg += errors + ". Please enter phone number in this format XXX-XXX-XXXX.<br/>";
			// $("#phone").addClass("error_border");
		// }
		// if(regEmail == "" || regEmail == null){
			// errors++;
			// errorMsg += errors + ". Registers email cannot be blank.<br/>";
			// $("#email").addClass("error_border");
		// }

		// for(var i = 0; i < adultName.length; i++) {
			// if($(adultName[i]).val() == "") {
				// errors++;
				// errorMsg += errors + ". Adult name cannot be blank.<br/>";
				// $(adultName[i]).addClass("error_border");
			// }
		// }
		
		// for(var i = 0; i < youthName.length; i++) {
			// if($(youthName[i]).val() == "") {
				// errors++;
				// errorMsg += errors + ". Youth's' cannot be blank.<br/>";
				// $($(youthName[i])).addClass("error_border");
			// }
		// }

		// for(var i = 0; i < childName.length; i++) {
			// if($(childName[i]).val() == "") {
				// errors++;
				// errorMsg += errors + ". Childs name cannot be blank.<br/>";
				// $($(childName[i])).addClass("error_border");
			// }
		// }
		
		// if(numAdults < 1)
		// {
			// errors++;
			// errorMsg += errors + ". At least 1 adult needs to be added.<br/>";
			// $("#attending_adult").addClass("error_border");
		// }
		// $("#errors_modal_contentP").append(errorMsg);
	// return errors;	
	// }

	function nameCheck(firstname, lastname) {
		var errors = 0;
		var first_name = firstname.val();
		var last_name = lastname.val();
		if(first_name == "") {
			firstname.addClass("error_border");
			errors++;
		} 
		if(first_name != "") {
			firstname.addClass("good_border").removeClass("error_border");
			errors++;
		} 
		if(last_name == "") {
			lastname.addClass("error_border");
			errors++;
		}
		if(last_name != "") {
			lastname.addClass("good_border").removeClass("error_border");
			errors++;
		}
		return errors;
	}

	function usernameCheck(username) {
		var errors = 0;
		var username_check = username.val();
		if(username_check == "") {
			username.addClass("error_border");
			errors++;
		} 
		else if(username_check.length <= 5) {
			username.addClass("error_border").css({color:"red"});
			errors++;
		}
		else {
			username.css({color:"green"}).addClass("good_border").removeClass("error_border");
		}
		return errors;
	}

	function passwordCheck(password) {
		var errors = 0;
		var password_check = password.val();
		if(password_check.length < 7 || password_check.length > 15) {
			password.addClass("error_border");
			errors++;
		}
		else {
			password.css({color:"green"}).addClass("good_border").removeClass("error_border");
		}
		return errors;
	}
//Remove overlay
	function removeOverlay() {
		event.preventDefault();
		$("#overlay_adminPage, #overlay_PhillyPage, #modal_adminPage, #modal_confirm_delete, #modal_confirm_reg_delete, .edit_admin_user_div").fadeOut();
		$(".modal_adminPage_header").animate({margin:"5% 0%", padding:"5% 0%"});
		$("#hotel_directions, #directions4, #directions3, #directions2, #directions1").fadeOut();
	}

//Check fields for registration
	function checkRegistration(name, address, email, phone, adultsNames, numAdults, youthsNames, numYouth, childrenNames, numChildren, shirtSizes, girly_tees, totalDue)
	{
		$('input').removeClass('error_border');
		var errorCount = 0;
		var errorMsg = "";
		var email_regrex = /^[\w]{1,}(\.\w{1,})?@([\w]{1,}\.)?([\w]{1,}\.)([a-zA-Z]{1,})$/g;

		if(firstname == "")
		{
			errorCount++;
			errorMsg += errorCount+". First Name cannot be empty.<br/>";
			$('input#firstname').addClass('error_border');
		}

		if(firstname !== "")
		{
			if(!fname_regrex.test(firstname))
			{
				errorCount++;
				errorMsg += errorCount+". First Name can only contain letters and the following special characters (- and \').<br/>";
				$('input#firstname').addClass('error_border');
			}
		}

		if(lastname == "")
		{
			errorCount++;
			errorMsg += errorCount+". Last Name cannot be empty.<br/>";
			$('input#lastname').addClass('error_border');
		}

		if(lastname !== "")
		{
			if(!lname_regrex.test(lastname))
			{
				errorCount++;
				errorMsg += errorCount+". Last Name can only contain letters and the following special characters (- and \').<br/>";
				$('input#lastname').addClass('error_border');
			}
		}

		if(email == "")
		{
			errorCount++;
			errorMsg += errorCount+". Email address cannot be empty<br/>";
			$('input#email').addClass('error_border');
		}

		if((email != "") && (!email_regrex.test(email)))
		{
			errorCount++;
			errorMsg += errorCount+". Incorrect format for an email. Ex: john.doe@gmail.com or johndoe@school.college.edu<br/>";
			$('input#email').addClass('error_border');
		}

		if((college != "") && (!college_regrex.test(college)))
		{
			errorCount++;
			errorMsg += errorCount+". College cannot contain numbers or special characters.<br/>";
			$('input#college').addClass('error_border');
		}

		if((highschool != "") && (!highschool_regrex.test(highschool)))
		{
			errorCount++;
			errorMsg += errorCount+". Highschool cannot contain numbers or special characters.<br/>";
			$('input#highschool').addClass('error_border');
		}

		if(height != "")
		{
			if(!height_regrex.test(height_check))
			{
				errorCount++;
				errorMsg += errorCount+". Height should be in the format of #\'##.<br/>";
				$('input#height').addClass('error_border');
			}		
		}	

		if(weight != 0)
		{
			if(weight < 1)
			{
				errorCount++;
				errorMsg += errorCount+". Weight cannot be empty or less than zero.<br/>";
				$('input#weight').addClass('error_border');
			}

			if(weight > 799)
			{
				errorCount++;
				errorMsg += errorCount+". Weight max is 799.<br/>";
				$('input#weight').addClass('error_border');
			}
		}

		if((nickname != "") && (!nname_regrex.test(nickname)))
		{
			errorCount++;
			errorMsg += errorCount+". Nickname can only contain letters and the following special characters (- and \').<br/>";
			$('input#nickname').addClass('error_border');
		}

	$(".alert_modal_content").append(errorMsg);
	console.log(errorCount);
	return errorCount;
	}