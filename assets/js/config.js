var oConfig = {
	init:function() {
        oConfig.cbox(); 
        $('.datepicker').datepicker({
            changeMonth:true,
            changeYear:true,
            yearRange:'1975:2020',
            dateFormat:'yy-mm-dd'//dd-mm-yy
        }); 
	},
    cbox:function() {        
        $('a.pop-up-dialog').colorbox({
            overlayClose:false,
           /* escKey:false,*/
            arrowKey:false,
            onComplete:function(){               
            }
        });
    },
    progressCbox:function(){        
        var loadingMessage = '<img src="'+base_url+'assets/images/loading.gif" />';
        var htmlmsg = '<div class="panel panel-primary" style="width:350px;">'+
                    '<div class="panel-heading"><h3 class="panel-title">In Progress</h3></div>'+
                    '<div class="panel-body" align="center">'+loadingMessage+'</div>'+
                '</div>';
        $.colorbox({
            html:htmlmsg,
            escKey:false,           
            closeButton:false,
            overlayClose:false,
            transition:"none", 
            fadeOut:0,
            maxWidth:"500px",
            maxHeight:"200px"
        });
        return false;

    },
    closeCbox:function(){
        parent.$.colorbox.close();
    },

};

var oContainer = {
    _data:[],
    set:function(oParam) {
        this._data = oParam;
    },
    get:function() {
        return this._data;
    }
};

$(document).ready(function(){
    oConfig.init();
    $.each($.validator.methods, function (key, value) {
        $.validator.methods[key] = function () {           
            if(arguments.length > 0) {
                arguments[0] = $.trim(arguments[0]);
            }
            return value.apply(this, arguments);
        };
    });
});
