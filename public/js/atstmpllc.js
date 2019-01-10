$(document).ready(function() {	

	$.ajaxSetup({
		headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')	},
		cache: false
	});
	
	// Common Variables
	var windowHeight = window.innerHeight;
	var windowWidth = document.body.clientWidth;
	var documentHeight = document.body.clientHeight;
	var navHeight = $('.navbar.navbar-expand-lg.navbar-fixed-top').height();
	
	// Animations initialization
	new WOW().init();
	
	// Initialize MDB select
	$('.mdb-select').material_select();
	
	// Initialize datetimepicker
	// $('.datetimepicker').pickadate({
	// 	// Escape any “rule” characters with an exclamation mark (!).
	// 	format: 'mm/dd/yyyy',
	// 	formatSubmit: 'yyyy/mm/dd',
	// 	min: new Date(1970,1,01),
	// });
	
	// Initialize timepicker
	$('.timepicker').pickatime({
		// 12 or 24 hour 
		twelvehour: true,
		autoclose: true,
		default: '18:00',
	});
	
	// Dropdown Init
	$('.dropdown-toggle').dropdown();
	
	// // SideNav Scrollbar Initialization
	// var sideNavScrollbar = document.querySelector('.custom-scrollbar');
	// Ps.initialize(sideNavScrollbar);
	// // SideNav Button Initialization
	// $(".button-collapse").sideNav({
		// edge: 'left', // Choose the horizontal origin
		// closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
	// });
	
	// Make the body min height the same size as the window height 	
	$("body#admin_page_login").css({minHeight:windowHeight});
	
	// Make the logout link and icon look as one
	$('li.logOutLink a').hover(function() {
		console.log('here');
		$('li.logOutLink a').css({color : '#c1cad2'});
	}, function() {
		$('li.logOutLink a').css({color : '#525252'});
	});

	// Bring up remove transactions button when
	// a transaction is selected
	$('body').on('change', 'input[name^="removeTransaction"]', function(e) {
		// Make sure that the remove button starts under
		// the navigation
		$('.removeTransBtn').css({top: (navHeight + 50) + 'px'});
		
		// Remove any cloned transactions already in delete modal
		$('#transaction_delete_modal .modal-body form div.col-6').remove();
		
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
	
// Tooltips Initialization
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

// MDB Lightbox Init
$(function () {
	$("#mdb-lightbox-ui").load("/addons/mdb-lightbox-ui.html");
});