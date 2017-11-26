$(document).ready(function(){
	var validator = $('#login').validate({
		rules:{
			email:{
				required:true,
				email:true
			},
			password:{
				required:true,
				minLenght:5
			}
		}
	});

	$(document).on('submit', '#login', function() {
		if($('#login').valid())
			return true;
		return false;
	});
});