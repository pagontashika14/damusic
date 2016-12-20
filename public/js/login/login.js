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
			success: function(result) {
				callback(true,result);
			},
			error: function(result) {
				callback(false,result);
			}
		});
	}
}