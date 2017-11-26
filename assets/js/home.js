var oPage = {
  init:function() {
    if($('.search').length > 0) {
			$('.search').autocomplete({
				minLength: 3,
				source: function( request, response ) {
					$.ajax({
						url:base_url+"home/search-auto-complete",
						data:request,
						delay: 600,
						dataType:"json",
						type:'post',
						success: function(result) {
							response(result);
						}
					});
				},
				select:function(event, ui){
					window.location.href=base_url+ui.item.mag_file_path;
				}
			}).data("ui-autocomplete")._renderItem = function (ul, item) {
				var html = '<h5>'+
							'<strong>'+item.mag_eng_name+'</strong>&nbsp;'+
							'<small>'+item.mag_tamil_title+'</small>'+
							'</h5>';

				return $("<li></li>")
					.data("item.autocomplete", item)
					.append(html)
					.appendTo(ul);
			};
		}

    $('.searchBtn').click(function(e) {
      e.preventDefault();
      $('.search').autocomplete("search", $('#search').val());
    });
  }
};


$(document).ready(function(){
  oPage.init();

});
