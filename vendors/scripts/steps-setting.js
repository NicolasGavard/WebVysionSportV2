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

$(".tab-wizard2").steps({
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
		$('.steps .current').prevAll().addClass('disabled');
		if (currentIndex == 3) {
			$('#confemail').text($('#email').val());
			$('#confusername').text($('#username').val());
			$('#confpersonname').text($('#personname').val());
			$('#confpersonfirstname').text($('#personfirstname').val());
			$('#confformula').text($('#formula option:selected').text());
		}
	},
	onFinished: function(event, currentIndex) {
		$('#success-modal-btn').trigger('click');
	}
});