$(document).ready(function () {
	let data = {
		action: 'action-name',
		otherData: myObject.someData
	};

	$.post(myObject.ajaxurl, data, function (response) { 
		// Что то делаем с ответом сервера (переменной response)
	 })
});