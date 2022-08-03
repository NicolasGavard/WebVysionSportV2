$(".tab-wizard").steps({
	headerTag: "h5",
	bodyTag: "section",
	transitionEffect: "fade",
	titleTemplate: '<span class="step">#index#</span> #title#',
	labels: {
		finish: "Submit"
	},
	onStepChanged: function (event, currentIndex, priorIndex) {
		$('.steps .current').prevAll().addClass('disabled');
	},
	onFinished: function (event, currentIndex) {
		$('#success-modal').modal('show');
	}
});
$(function() {
  var form= $('#registerForm');

	form.validate({
		// errorPlacement: function errorPlacement(error, element) { element.before(error); },
		rules : {
			confirmPassword: {
				equalTo: "#password"
			},
			gender: {
				required:true
			}
			// for lastname & firstname 
			// regexp: /^[a-zA-Z\s]+$/,
			// message: 'The last name can only consist of alphabetical and space'

			// for a date
			// date: {
			// 	format: 'YYYY/MM/DD',
			// 	message: 'The birthday is not valid'
			// }

			// stringLength: {
			// 	max: 200,
			// 	message: 'The bio must be less than 200 characters'
			// }
		},
		messages : {
			email : "Merci de saisir votre email",
			username : "Merci de saisir votre nom d'utilisateur",
			password: "Merci de saisir votre mot de passe",
			confirmPassword: {
				required: "Merci de saisir votre mot de passe de confirmation",
				equalTo: "Les mots de passe doivent être les mêmes"
			},
			personname : "Merci de saisir votre nom",
			personfirstname : "Merci de saisir votre prénom",
			gender: {
				required: "Merci de choisir une valeur",
			},
			cbusage : "Merci de confirmer votre acceptation"
		}
	});

	$('#registerForm')
	.steps({
		headerTag: "h5",
		bodyTag: "section",
		transitionEffect: "fade",
		titleTemplate: '<span class="step">#index#</span> <span class="info">#title#</span>',
		labels: {
			// finish: "Submit",
			finish: "Envoyer",
			// next: "Next",
			next: "Suivant",
			// previous: "Previous",
			previous: "Précédent",
		},
		onStepChanged: function(event, currentIndex, priorIndex) {
			if (currentIndex == 3) {
				$('#confemail').text($('#email').val());
				$('#confusername').text($('#username').val());
				$('#confpersonname').text($('#personname').val());
				$('#confpersonfirstname').text($('#personfirstname').val());
				$('#confformula').text($('#formula option:selected').text());
			}
		},
		// Triggered when clicking the Previous/Next buttons
		onStepChanging: function(e, currentIndex, newIndex) {
			if (newIndex < currentIndex) return true;
			form.validate().settings.ignore = ":disabled,:hidden";
			return form.valid();
		},
		onFinishing: function (event, currentIndex)
    {
			form.validate().settings.ignore = ":disabled";
			return form.valid();
		},
		onFinished: function(event, currentIndex) {
			$('#success-modal-btn').trigger('click');
		}
	})
});