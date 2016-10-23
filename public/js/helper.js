function GetHightestRole(roles){
	var maxrole = roles[0];
	roles.forEach(function(role){
		if (maxrole.order>role.order) {
			maxrole = role;
		}
	})
	return maxrole;
}

function Nts(num,length = 2){
	var l = num.toString().length;
	if (l < length) {
		var s = '';
		for (var i = 0; i < length - l; i++) {
			s += '0';
		}
		s += num;
		return s;
	}
	return String(num);
}