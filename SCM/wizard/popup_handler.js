var Style = '1';
// this function to make new help system
function stm(arr_item, style, element)
{
	// this attribute is bootstrap popover requirements
	$(element).attr('data-toggle', 'popover');
	
	var title = arr_item[0]; // title
	var content = arr_item[1]; // help msg
	
	// here set up all config about popover bootstrap
	$(element).popover({
		trigger: 'hover',
		container: 'body',
		placement: 'right',
		title: title,
		content: content
	});	
	// then show/display it to user
	$(element).popover('show');

}