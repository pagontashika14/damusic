(function(){
	if (localStorage['api_token']) {
		var token = localStorage['api_token'];
		$.ajax({
			url: '/api/user',
			data: {api_token: token},
			success: function(data){
				sessionStorage['user_id'] = data.id;
				sessionStorage['user_name'] = data.name;
				$('#navbar-user').attr('href','profiles');
				$('#navbar-username').html(data.name);
			},
			error: function(error) {
				console.log('--error--');
				console.log(error);
			}
		});
	}
})();