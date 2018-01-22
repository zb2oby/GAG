jQuery(document).ready(function($) {
	$('.jours').click(function(event) {
		timeStamp = $(event.currentTarget).data('debut')*1000;

		var date = new Date(timeStamp);
		var day = (date.getDate() < 10 ? '0' : '') + date.getDate(); //adding leading 0 if date less than 10 for the required dd format
		var month = (date.getMonth() < 9 ? '0' : '') + (date.getMonth() + 1); //adding leading 0 if month less than 10 for mm format. Used less than 9 because javascriptmonths are 0 based.
		var year = date.getFullYear(); //full year in yyyy format

		var hours = ((date.getHours() % 12 || 12) < 10 ? '0' : '') + (date.getHours() % 12 || 12); //converting 24h to 12h and using 12 instead of 0. also appending 0 if hour less than 10 for the required hh format
		var minutes = (date.getMinutes() < 10 ? '0' : '') + date.getMinutes(); //adding 0 if minute less than 10 for the required mm format
		var meridiem = (date.getHours() >= 12) ? 'pm' : 'am'; //setting meridiem if hours24 greater than 12
		var formattedDate = year + '-' + month + '-' + day;
		
		$('#newExpo').css('display', 'block');
		$('#newExpo').find('#dateDebut').val(formattedDate);
		$('.overlay').show();

	});
});