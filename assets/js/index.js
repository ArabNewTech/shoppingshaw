var color_picker = null;
var input_block = null;
var input_block_counter = [0];
$(document).ready(function(){
	color_picker = $(".copy-fields").html();
    input_block = $(".copy-fields-block").html();
    //here first get the contents of the div with name class copy-fields and add it to after "after-add-more" div   class.
    $(".add-more").click(function(){ 
    	  $(".after-add-more").after(color_picker);
    });
         
    //here it will remove the current value of the remove button which has been pressed
    $("body").on("click",".remove",function(){ 
        $(this).parents(".control-group").remove();
    });
         
    //here first get the contents of the div with name class copy-fields and add it to after "after-add-more" div class.
        
    $(".add-more-block").click(function(){
        num = input_block_counter[input_block_counter.length-1];
           
        $("#add-block ").before(input_block);
    });
         
    $("body").on("click",".remove-block",function(){ 
        $(this).parents(".r-block").remove();
    });
         
    //  $('#multi-select' ).hierarchySelect({
    //     hierarchy: true,
    // });
    $('.multi-select' ).hierarchySelect({
        hierarchy: true,
    });  
         

});
//////////////////////////////////////////////////////////////////
$(function () {
		                              $('.color-picker-rgb').colorpicker({
		                                  color: '#cccccc',
		                                  format: 'rgba'
		                              });
		                            });
/////////////////////////////////////////////////////////////////////////



var counter = {};
var templates = {};

increment = function(element_id , position_id)
{
	template = $("#"+element_id).clone();
	$("#"+element_id).after()
	if (!isset(counter[element_id])) {
		counter[element_id] = 0
	}
	counter[element_id]++;
	templates[element_id] = template;
	new_template  = changeAllInputs(template , element_id , counter[element_id]);
	$("#"+position_id).before(new_template);
	plugin.multiSelect();
}

changeAllInputs = function(template , new_names , counter)
{
	inputs = $(template).find('input');
	inputs.each(function(index, el) {
		name = $(this).attr('name');
		$(this).attr('name', name+"-"+counter);
	});
	console.log(template.find(".entire-remove"));
	template.find(".entire-remove").append(plugin.removeTemplate());
	return template;
}
/**
* check if the value is undefiend
* @param {String} value the value to check
*/
isset = function(value)
{
	if (typeof value === "undefined") {
		return false;
	}
	return true;
}

Plugins = function ()
{
	this.multiSelect = function()
	{
		console.log('test');
		$('.multi-select' ).hierarchySelect({
            hierarchy: true,
        });
	}
	this.removeTemplate = function()
	{
		temp = "<div class=\"col-md-2\">\n"+
				"<div class=\"input-group-btn\"> \n"+                               
                    "<button class=\"btn btn-danger remove-block\" type=\"button\"><i class=\"glyphicon glyphicon-remove\"></i> </button>\n"+
                "</div>\n"+
                "</div>";
        return temp;
	}
	this.hiddenTemplate = function(name, value)
	{
		temp = "<input type='hidden' name='"+name+"' value='"+value+"'/>";
	}
}
plugin = new Plugins();