$(function() {$('input.datepicker').datepicker({changeMonth: true, changeYear: true, showButtonPanel: true, yearRange: "1900:+0"});});
$.datepicker.regional[""].dateFormat = 'yy-mm-dd';
$.datepicker.setDefaults($.datepicker.regional['']);



$( "#register" ).validate({
	rules: {
		patID: {
		required: true
		},
		terms: {
		required: true
		},
		DOS: {
		required: true,
		dateISO: true
		},
		DOB: {
		required: true,
		dateISO: true
		}

  }
});

$( "#register2" ).validate({
	rules: {
		email: {
		required: true,
		email: true
		},
		email2: {
		required: true,
		equalTo: "#email"
		},
		password: {
		required: true,
		rangelength: [8,32]
		},
		password2: {
		required: true,
		equalTo: "#password"
		},
		fname: {
		required: true
		},
		lname: {
		required: true
		}

  	}
});




$( "#reset-request" ).validate({
	rules: {
		email: {
		required: true,
		email: true
		}

  }
});

$( "#reset" ).validate({
	rules: {
		email: {
		required: true,
		email: true
		},
		code: {
		required: true
		},
		password: {
		required: true,
		rangelength: [8,32]
		},
		password2: {
		required: true,
		equalTo: "#password"
		}

  	}

});
