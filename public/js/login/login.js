function Login(name,pass){
	this.name = name;
	this.pass = pass;

	var _self = this;

	this.login = function(callback){
		$.ajax({
			url: '/api/login',
			type: 'POST',
			data: {
				email: _self.name,
				password: _self.pass
			},
		})
		.done(function(result) {
			callback(true,result);
		})
		.fail(function(result) {
			callback(false,result);
		})
		.always(function() {
			
		});
	}
}