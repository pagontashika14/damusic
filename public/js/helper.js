function GetHightestRole(roles){
	var maxrole = roles[0];
	roles.forEach(function(role){
		if (maxrole.order>role.order) {
			maxrole = role;
		}
	})
	return maxrole;
}