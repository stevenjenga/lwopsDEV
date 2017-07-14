// link to alertify CSS files
$('<link href="alertify/themes/alertify.default.css" type="text/css" rel="stylesheet" />').appendTo('head');
$('<link href="alertify/themes/alertify.core.css" type="text/css" rel="stylesheet" />').appendTo('head');
// link to alertify JS file
$('<script src="alertify/lib/alertify.min.js"></script>').appendTo('head');

function alert_msg(id, message)
{	
	switch (id)
	{
		case 1: // if id = 1; it will be just notice message
			alertify.log(message);
			break;
		case 2: // if id = 2; it will be error message
			alertify.error(message);
			break;
		case 3: // if id = 3; it will be success message
			alertify.success(message);
			break;
		default: // by default it will be notice message
		alertify.log(message);
	}
}

function alert_default_msg(id, arr_msg_index)
{
	
	var log_msg = 'Notice'; // notice message
	var error_msg = 'Error'; // error message
	var success_msg = 'Successfully'; // success message
	
	// if you need to make more than one success_msg or error_msg or log_msg for example
	arr_msg_index = (typeof arr_msg_index !== 'undefined') ? arr_msg_index : 'null';
	var arr_msg = new Array('Notice1', 'error1', 'success1', 'Notice2', 'error2', 'success2');
	
	
	switch (id)
	{
		case 1: // if id = 1; it will be just notice message
			if(arr_msg_index === 'null') alertify.log(log_msg);
			else alertify.log(arr_msg[arr_msg_index]);
			break;
		case 2: // if id = 2; it will be error message
			if(arr_msg_index === 'null') alertify.error(error_msg);
			else alertify.error(arr_msg[arr_msg_index]);
			break;
		case 3: // if id = 3; it will be success message
			if(arr_msg_index === 'null') alertify.success(success_msg);
			else alertify.success(arr_msg[arr_msg_index]);
			break;
		default: // by default it will be notice message
			if(arr_msg_index === 'null') alertify.log(log_msg);
			else alertify.log(arr_msg[arr_msg_index]);
	}

}