//customer js
var oPage = {
	init:function() {
		$('#mag-form').validate({
			rules:{
				mag_eng_name:{
				 	required:true,
				 	minlength:2
				},
				mag_tamil_title:{
					required:true,
				 	minlength:2
				},
				mag_tamil_desc:{
					required:true,
				 	minlength:2
				},
				mag_tamil_cover:{
					required:true
				},

			}
		});
	},
	initStatusClick:function() {
		$('.update-user-status').on('click', function(e){
			e.preventDefault();
			oPage.updateStatus(this);
		});
	},
	save:function() {
		if($('#mag-form').valid()) {
			$('#mag-form').submit();
		}
	},
	delete:function(url) {
		$.getJSON(url, function(response) {
			alert(response.msg);
			if(response.status) {
				oPage.tableRedraw();
			}
		});
	},
	initDataTable:function() {
		$('#magsList').DataTable({
			"bProcessing": true,
			"bLengthChange": false,
	        "bServerSide": true,
	        "sServerMethod": "POST",
	        "sAjaxSource": base_url+"admin/get-records",
	        "fnDrawCallback": function () {
	        	oConfig.cbox();
						$('.delete').on('click', function(e){
							e.preventDefault();
							var k=confirm("Are you sure you want to delete this?");
							if(k) {
								var url = $(this).prop('href');
								oPage.delete(url);
							}
							return false;
						});

	        },
	        "columnDefs": [{
				"targets": 5,
				"orderable": false
			}],
	        "info":false,
		});
	},
	tableRedraw:function() {
		var oUser = $('#magsList').dataTable();
		oUser.fnDraw();
	},
	updateStatus:function(oElement) {
		var params = {};
		var sURL = $(oElement).href();
			params['status'] = $(oElement).data('status');
		$.getJSON(sURL,params, function(response){
			alert(response.msg);
			oPage.tableRedraw();
		});
	}
};

$(document).ready(function(){
	oPage.init();
	oPage.initDataTable();
	//configs
	$('#saveMag').click(function(e){
		e.preventDefault();
		oPage.save();
	});


});
