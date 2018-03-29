$(document).ready(function() {	

// Common Variables
	var windowHeight = window.innerHeight;
	var windowWidth = document.body.clientWidth;
	var documentHeight = document.body.clientHeight;
	var navHeight = $('.navbar.navbar-expand-lg.navbar-fixed-top').height();
	
	// Make the body min height the same size as the window height 	
	$("body#admin_page_login").css({minHeight:windowHeight});
	
	// Make the logout link and icon look as one
	$('li.logOutLink a').hover(function() {
		console.log('here');
		$('li.logOutLink a').css({color : '#c1cad2'});
	}, function() {
		$('li.logOutLink a').css({color : '#525252'});
	});
	
	// Tooltips Initialization
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip();
	});
	
	// Animations initialization
	new WOW().init();
	
	// Initialize datetimepicker
	$('.datetimepicker').pickadate({
		// Escape any “rule” characters with an exclamation mark (!).
		format: 'mm/dd/yyyy',
		formatSubmit: 'yyyy/mm/dd',
	});

	// Bring up remove transactions button when
	// a transaction is selected
	$('body').on('change', 'input[name^="removeTransaction"]', function(e) {
		// Make sure that the remove button starts under
		// the navigation
		$('.removeTransBtn').css({top: (navHeight + 50) + 'px'});
		if($('input[name^="removeTransaction"]:checked').length > 0) {
			$('.removeTransBtn').addClass('animated slideInDown').removeClass('invisible slideOutUp');
		} else {
			$('.removeTransBtn').removeClass('slideInDown').addClass('slideOutUp');
		}
	});
	
	// Copy all of the selected transactions to be removed,
	// to the delete transactions modal
	$('body').on('click', '.removeTransBtn', function(e) {
		$('input[name^="removeTransaction"]:checked').each(function() {
			var parentView = $(this).parent().parent().parent().parent().clone();
			$(parentView).removeClass('col-md-4 col-sm-6 col-xs-6').addClass('col-6');
			$(parentView).prependTo('form#removeTransForm');
		});
	});
	
	// Bring up delete bank modal when button is clicked
	$('body').on('click', '.removeBank', function(e) {
		e.preventDefault();
		remove_bank($(this).attr('href').slice(1));
	});
	
	// Bring up delete bank modal when button is clicked
	$('body').on('click', '.removeBankUser', function(e) {
		e.preventDefault();
		remove_bank_user($(this).attr('href').slice(1));
	});
	
	//Change page if bank is changed when transaction type is transfer
	$("body").on("change", ".bankSelect, .transferAccountType", function(e) {
		var transactionType = $(".transactionSelect").val();
		var bankValue = $(".bankSelect option:selected");
		var transferValue = $(".transferAccountType option:selected");
		var sendToValues = $('.addtTransferForm .sendToUserSelect option, .addtTransferForm .sendToUserSelect option');
		var sendFromValues = $('.addtTransferForm .sendFromUserSelect option, .addtTransferForm .sendFromUserSelect option');

		// Make the blank option selected
		$('.addtTransferForm .firstOption').attr('selected', true);
		
		// Remove all users from select if any present
		$('.addtTransferForm .sendToUserSelect .userOption').remove();
		
		// Bring up the checking and savings for the selected bank
		// and make all other accounts hidden and disabled
		$(sendFromValues).each(function() {
			if($(this).val() == $(bankValue).val() + 'c' || $(this).val() == $(bankValue).val() + 's') {
				$(this).removeAttr('disabled')
					.removeClass("hidden")
					.show();
			} else {
				$(this).removeAttr('disabled')
					.addClass("hidden")
					.hide();
			}
		});
		
		$(sendToValues).each(function() {
			if($(this).val() == $(bankValue).val() + 'c' || $(this).val() == $(bankValue).val() + 's') {
				$(this).removeAttr('disabled')
					.removeClass("hidden")
					.show();
			} else {
				$(this).attr('disabled', true)
					.addClass("hidden")
					.hide();
			}
		});
		
		// If transfer type is to a user
		// Then get the users that have an account with that bank
		// and make the send from account the users share amount
		if($(transferValue).val() == 'user') {
			get_users($(bankValue).val());
			$('.addtTransferForm .sendToUserSelect .firstOption')
				.text('---- Select A User To Send To ----')
				.attr({'selected':true, 'disabled': true})
				.show();
			$('.addtTransferForm .sendFromUserSelect .firstOption')
				.attr({'selected':true, 'disabled': true})
				.show();

			$(sendToValues).each(function() {
				if($(this).hasClass('accountOption')) {
					$(this).hide()
						.attr('disabled', true);
				} else if($(this).hasClass('userOption')) {
					$(this).show()
						.removeAttr('disabled');
				}
			});
			
			$(sendFromValues).each(function() {
				if($(this).val() == $(bankValue).val() + 'c' || $(this).val() == $(bankValue).val() + 's') {
					$(this).attr('disabled', true)
						.hide();
				} else if($(this).val() == $(bankValue).val() + 'm') {
					$(this).removeAttr('disabled')
						.show();
				}
			});
			
		} else if($(transferValue).val() == 'account') {
			$('.addtTransferForm .sendToUserSelect .firstOption')
				.text('---- Select Account To Send To ----')
				.attr({'selected':true, 'disabled': true})
				.show();
			$('.addtTransferForm .sendFromUserSelect .firstOption')
				.attr({'selected':true, 'disabled': true})
				.show();
				
			$(sendToValues).each(function() {
				if($(this).hasClass('accountOption') && ($(this).val() == $(bankValue).val() + 'c' || $(this).val() == $(bankValue).val() + 's')) {
					$(this).show()
						.removeAttr('disabled');
				} else {
					$(this).attr('disabled', true)
						.hide();
				}
			});
			
			$(sendFromValues).each(function() {
				if($(this).val() == $(bankValue).val() + 'c' || $(this).val() == $(bankValue).val() + 's') {
					$(this).removeAttr('disabled')
						.show();
				} else if($(this).val() == $(bankValue).val() + 'm') {
					$(this).attr('disabled', true)
						.hide();
				}
			});
		}
	});
	
	// Bring up pictures to see before deleting or bring up all pictures
	$("body").on("change", ".transactionSelect", function(e) {
		var addtFormGroups = $(".alternateFormGroups");
		var transactionType = $(".transactionSelect").val();

		$(addtFormGroups).slideUp().find('select').attr('disabled', true);
		
		if(transactionType == "Transfer") {
			$('.receiptForm').slideUp();
			$('.addtTransferForm').slideDown().find('select').removeAttr('disabled');
		} else if(transactionType == "Withdrawl") {
			$('.receiptForm').slideDown();
			$('.addtWithdrawlForm').slideDown().find('select').removeAttr('disabled');
		} else if(transactionType == "Deposit") {
			$('.receiptForm').slideDown();
			$('.addtDepositForm').slideDown().find('select').removeAttr('disabled');
		} else if(transactionType == "Purchase") {
			$('.receiptForm').slideDown();
			$('.addtDepositForm, .addtTransferForm, .addtWithdrawlForm').find('select').removeAttr('disabled');
		}
	});
		
	//Show transaction photo in Magnific Popup plugins
	// $('a.transImg').magnificPopup({
		// type:'image'
	// });
	
	// Call function for preview when uploading new images
	$("[name='profile_img']").change(function () {
		imagePreview(this);
	});
	
	// Remove redirect message after 8 seconds
	if($('#return_messages ul li').length > 0) {
		setTimeout(function() {
			$('#return_messages').fadeOut();
		}, 8000);
	}
});

// Ajax request for user accounts for selected bank
function get_users(bank_id) {
	$.ajax({
	  method: "GET",
	  url: "/account/" + bank_id + "/bank"
	})
	
	.fail(function() {
		alert( "Error: nothing returned");		
	})
	.done(function(data) {
		if($(".sendToUserSelect .userOption").length > 0) {
			$(".sendToUserSelect .userOption").removed();
			$(data).appendTo($(".sendToUserSelect"));
		} else {
			$(data).appendTo($(".sendToUserSelect"));
		}
	});
}

// Ajax request for user accounts for selected bank
function remove_bank(bank_id) {
	$.ajax({
	  method: "GET",
	  url: "/bank/" + bank_id + "/remove"
	})
	
	.fail(function() {
		alert( "Error: nothing returned");		
	})
	.done(function(data) {
		if($('.modal.removeBankModal').length > 0) {
			$('.modal.removeBankModal').remove();
		}
		
		$(data).appendTo('#app');
		$('.modal.removeBankModal').modal('show');
	});
}

// Ajax request for user accounts for selected bank
function remove_bank_user(bank_user_id) {
	$.ajax({
	  method: "GET",
	  url: "/account/" + bank_user_id + "/remove"
	})
	
	.fail(function() {
		alert( "Error: nothing returned");		
	})
	.done(function(data) {
		if($('.modal.removeUserAccountModal').length > 0) {
			$('.modal.removeUserAccountModal').remove();
		}
		
		$(data).appendTo('#app');
		$('.modal.removeUserAccountModal').modal('show');
	});
}

// Preview images before being uploaded on images page and new location page
function imagePreview(input) {
    if (input.files && input.files[0]) {
		var reader = new FileReader();
		$('.imgPreview').remove();
		
		reader.onload = function (e) {
			$('<img class="imgPreview mx-auto" src="' + e.target.result + '" width="450" height="300"/>').prependTo($('.view.overlay'));
			$('.profile_img_submit').show();
		}
		reader.readAsDataURL(input.files[0]);
    }
}

// //User form error check function
	// function userErrorCheck() {
		// var errors = 0;
		// var errorMsg = "";
		// var errorModal;
		// var username = $(".newUsername");
		// var password = $(".newPassword");
		// var firstname = $(".newFirstname");
		// var lastname = $(".newLastname");

		// if(username.val() == "" || username.val() == null) {
			// errors++;
			// errorMsg += "<li class='errorItem'>" + errors + ". " + "Username Cannot Be Empty</li>";
			// username.addClass("error_border");
		// } if(password.val() == null || password.val() == "") {
			// errors++;
			// errorMsg += "<li class='errorItem'>" + errors + ". " + "Password Cannot Be Empty</li>";
			// password.addClass("error_border");
		// } if(firstname.val() == null || firstname.val() == ""){
			// errors++;
			// errorMsg += "<li class='errorItem'>" + errors + ". " + "First Name Cannot Be Empty</li>";
			// firstname.addClass("error_border");
		// } if(lastname.val() == null || lastname.val() == ""){
			// errors++;
			// errorMsg += "<li class='errorItem'>" + errors + ". " + "Last Name Cannot Be Empty</li>";
			// lastname.addClass("error_border");
		// }
		
		// $("#return_messages ul").empty();
		// $("#return_messages ul").append(errorMsg);
		// if(errors > 0) {
			// event.preventDefault();
		// } else {
			// return true;
		// }
	// }
	
// //Check for errors function
	// // var errors;
	// // function errorCheck(regName, regAdd, regPhone, regEmail, numAdults, adultName, youthName, childName) {
		// // event.preventDefault();
		// // var errors = 0;
		// // $("#errors_modal_contentP").empty();
		// // $("#registration_modal input").removeClass("error_border");
		// // var phoneRegrex = /^([0-9]{3})?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
		// // var errorMsg = "";

		// // if(regName == "" || regName == null){
			// // errors++;
			// // errorMsg += errors + ". Registers name cannot be blank.<br/>";
			// // $("#name").addClass("error_border");
		// // }
		// // if(regAdd == "" || regAdd == null){
			// // errors++;
			// // errorMsg += errors + ". Registers address cannot be blank.<br/>";
			// // $("#address").addClass("error_border");
		// // }
		// // if(regPhone == "" || regPhone == null){
			// // errors++;
			// // errorMsg += errors + ". Registers phone number cannot be blank.<br/>";
			// // $("#phone").addClass("error_border");
		// // }
		// // if(!regPhone.match(phoneRegrex) && regPhone != "") {
			// // errors++;
			// // errorMsg += errors + ". Please enter phone number in this format XXX-XXX-XXXX.<br/>";
			// // $("#phone").addClass("error_border");
		// // }
		// // if(regEmail == "" || regEmail == null){
			// // errors++;
			// // errorMsg += errors + ". Registers email cannot be blank.<br/>";
			// // $("#email").addClass("error_border");
		// // }

		// // for(var i = 0; i < adultName.length; i++) {
			// // if($(adultName[i]).val() == "") {
				// // errors++;
				// // errorMsg += errors + ". Adult name cannot be blank.<br/>";
				// // $(adultName[i]).addClass("error_border");
			// // }
		// // }
		
		// // for(var i = 0; i < youthName.length; i++) {
			// // if($(youthName[i]).val() == "") {
				// // errors++;
				// // errorMsg += errors + ". Youth's' cannot be blank.<br/>";
				// // $($(youthName[i])).addClass("error_border");
			// // }
		// // }

		// // for(var i = 0; i < childName.length; i++) {
			// // if($(childName[i]).val() == "") {
				// // errors++;
				// // errorMsg += errors + ". Childs name cannot be blank.<br/>";
				// // $($(childName[i])).addClass("error_border");
			// // }
		// // }
		
		// // if(numAdults < 1)
		// // {
			// // errors++;
			// // errorMsg += errors + ". At least 1 adult needs to be added.<br/>";
			// // $("#attending_adult").addClass("error_border");
		// // }
		// // $("#errors_modal_contentP").append(errorMsg);
	// // return errors;	
	// // }

	// function nameCheck(firstname, lastname) {
		// var errors = 0;
		// var first_name = firstname.val();
		// var last_name = lastname.val();
		// if(first_name == "") {
			// firstname.addClass("error_border");
			// errors++;
		// } 
		// if(first_name != "") {
			// firstname.addClass("good_border").removeClass("error_border");
			// errors++;
		// } 
		// if(last_name == "") {
			// lastname.addClass("error_border");
			// errors++;
		// }
		// if(last_name != "") {
			// lastname.addClass("good_border").removeClass("error_border");
			// errors++;
		// }
		// return errors;
	// }

	// function usernameCheck(username) {
		// var errors = 0;
		// var username_check = username.val();
		// if(username_check == "") {
			// username.addClass("error_border");
			// errors++;
		// } 
		// else if(username_check.length <= 5) {
			// username.addClass("error_border").css({color:"red"});
			// errors++;
		// }
		// else {
			// username.css({color:"green"}).addClass("good_border").removeClass("error_border");
		// }
		// return errors;
	// }

	// function passwordCheck(password) {
		// var errors = 0;
		// var password_check = password.val();
		// if(password_check.length < 7 || password_check.length > 15) {
			// password.addClass("error_border");
			// errors++;
		// }
		// else {
			// password.css({color:"green"}).addClass("good_border").removeClass("error_border");
		// }
		// return errors;
	// }
// //Remove overlay
	// function removeOverlay() {
		// event.preventDefault();
		// $("#overlay_adminPage, #overlay_PhillyPage, #modal_adminPage, #modal_confirm_delete, #modal_confirm_reg_delete, .edit_admin_user_div").fadeOut();
		// $(".modal_adminPage_header").animate({margin:"5% 0%", padding:"5% 0%"});
		// $("#hotel_directions, #directions4, #directions3, #directions2, #directions1").fadeOut();
	// }

// //Check fields for registration
	// function checkRegistration(name, address, email, phone, adultsNames, numAdults, youthsNames, numYouth, childrenNames, numChildren, shirtSizes, girly_tees, totalDue)
	// {
		// $('input').removeClass('error_border');
		// var errorCount = 0;
		// var errorMsg = "";
		// var email_regrex = /^[\w]{1,}(\.\w{1,})?@([\w]{1,}\.)?([\w]{1,}\.)([a-zA-Z]{1,})$/g;

		// if(firstname == "")
		// {
			// errorCount++;
			// errorMsg += errorCount+". First Name cannot be empty.<br/>";
			// $('input#firstname').addClass('error_border');
		// }

		// if(firstname !== "")
		// {
			// if(!fname_regrex.test(firstname))
			// {
				// errorCount++;
				// errorMsg += errorCount+". First Name can only contain letters and the following special characters (- and \').<br/>";
				// $('input#firstname').addClass('error_border');
			// }
		// }

		// if(lastname == "")
		// {
			// errorCount++;
			// errorMsg += errorCount+". Last Name cannot be empty.<br/>";
			// $('input#lastname').addClass('error_border');
		// }

		// if(lastname !== "")
		// {
			// if(!lname_regrex.test(lastname))
			// {
				// errorCount++;
				// errorMsg += errorCount+". Last Name can only contain letters and the following special characters (- and \').<br/>";
				// $('input#lastname').addClass('error_border');
			// }
		// }

		// if(email == "")
		// {
			// errorCount++;
			// errorMsg += errorCount+". Email address cannot be empty<br/>";
			// $('input#email').addClass('error_border');
		// }

		// if((email != "") && (!email_regrex.test(email)))
		// {
			// errorCount++;
			// errorMsg += errorCount+". Incorrect format for an email. Ex: john.doe@gmail.com or johndoe@school.college.edu<br/>";
			// $('input#email').addClass('error_border');
		// }

		// if((college != "") && (!college_regrex.test(college)))
		// {
			// errorCount++;
			// errorMsg += errorCount+". College cannot contain numbers or special characters.<br/>";
			// $('input#college').addClass('error_border');
		// }

		// if((highschool != "") && (!highschool_regrex.test(highschool)))
		// {
			// errorCount++;
			// errorMsg += errorCount+". Highschool cannot contain numbers or special characters.<br/>";
			// $('input#highschool').addClass('error_border');
		// }

		// if(height != "")
		// {
			// if(!height_regrex.test(height_check))
			// {
				// errorCount++;
				// errorMsg += errorCount+". Height should be in the format of #\'##.<br/>";
				// $('input#height').addClass('error_border');
			// }		
		// }	

		// if(weight != 0)
		// {
			// if(weight < 1)
			// {
				// errorCount++;
				// errorMsg += errorCount+". Weight cannot be empty or less than zero.<br/>";
				// $('input#weight').addClass('error_border');
			// }

			// if(weight > 799)
			// {
				// errorCount++;
				// errorMsg += errorCount+". Weight max is 799.<br/>";
				// $('input#weight').addClass('error_border');
			// }
		// }

		// if((nickname != "") && (!nname_regrex.test(nickname)))
		// {
			// errorCount++;
			// errorMsg += errorCount+". Nickname can only contain letters and the following special characters (- and \').<br/>";
			// $('input#nickname').addClass('error_border');
		// }

	// $(".alert_modal_content").append(errorMsg);
	// console.log(errorCount);
	// return errorCount;
	// }