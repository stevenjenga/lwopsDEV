
function help_msg(pageName)
{
	if(pageName === 'signup')
	{
		// sign up
		$('#username').popover({
			trigger: 'focus',
			content: "Just use uppercase, lowercase letters and underscore. Username at least 5 characters."
		});
		$('#password').popover({
			trigger: 'focus',
			content: "You must use at least letters and numbers anything else optional except space and slashes. Password at least 8 characters."
		});
		$('#confirmPassword').popover({
			trigger: 'focus',
			content: "This field must much the field above."
		});
	}
	
	if(pageName === 'forgetPass')
	{
		// forget password
		$('#retrievePass').popover({
			trigger: 'focus',
			content: "Please enter the email address registered to your pivot-table account."
		});
	}

	
	if(pageName === 'changePass')
	{
		// change password
		$('#newPass').popover({
			trigger: 'focus',
			content: "You must use at least letters and numbers anything else optional except space and slashes. Password at least 8 characters."
		});
		$('#confirmNewPassword').popover({
			trigger: 'focus',
			content: "This field must much the field above."
		});
	}

	if(pageName === 'setconfig')
	{
		// dbHost
		$('#dbHostPopover').popover({ // database host
			trigger: 'hover',
			content: "In this section, you should enter the connection parameters for the database you intend to use when generating your Pivot table.  Please note that only the 'Select' permission is required for the user name. Additional permissions are neither recommended nor required"
		});
		// ---------------------------------------------------------------
		// General inforamtion
		$('#tableNamePop').popover({ // table name
			trigger: 'hover',
			content: "Name of the pivot table."
		});
		$('#protectedPop').popover({ // protected
			trigger: 'hover',
			content: "This option means whether or not you want your generated pivot table to be password protected.  Please note that if you choose to make your pivot table password protected, then only the software administrator/owner (the one who has the access to log in) will be able to access it. When the user with access logs in to access the pivot table, they will be able to see the 'Manage tables' icon, by which all other pivot tables are accessible and they can also create new pivot tables ."
		});
		$('#isNumericPop').popover({ // is numeric
			trigger: 'hover',
			content: "This option means whether or not your pivot table will display numerical values."
		});
		// ---------------------------------------------------------------
		// columns information
		$('#colsTablePop').popover({ // columns table
			trigger: 'hover',
			content: "In this section you need to define what should appear in the 'Column labels' area – these are the headers of the pivot table.   Please select the name of the database table  that stores the data you want to list in the headers"
		});
		$('#colsFieldPop').popover({ // columns field
			trigger: 'hover',
			content: "In this section you need to define what should appear in the 'Column labels' area – these are the headers of the pivot table.   Please select the name of the database column  that stores the data you want to list in the headers."
		});
		$('#colsAliasPop').popover({ // columns alias
			trigger: 'hover',
			content: "Other names you might want to give to your columns instead of their original SQL names (Optional)."
		});
		$('#colsFuncPop').popover({ // columns function
			trigger: 'hover',
			content: "If the selected columns store date values, you will have the option to select to display the month or the year from those date values. If no option is selected, the complete date should appear in the pivot table."
		});
		// ---------------------------------------------------------------
		// rows information
		$('#rowsTablePop').popover({ // rows table
			trigger: 'hover',
			content: "In this section you need to define what should appear in the 'Row labels' area – these are the row headers of the pivot table.  Please select the name of the database table  that stores the data you want to list in the row headers"
		});
		$('#rowFieldPop').popover({ // rows field
			trigger: 'hover',
			content: "In this section you need to define what should appear in the 'Row labels' area – these are the row headers of the pivot table.  Please select the name of the database column  that stores the data you want to list in the row headers."
		});
		$('#rowsAliasPop').popover({ // rows alais
			trigger: 'hover',
			content: "Other names you might want to give to your row headers instead of their original SQL names (Optional)"
		});
		// ---------------------------------------------------------------
		// grid information
		$('#gridTablePop').popover({ // grid table
			trigger: 'hover',
			content: "In this section you need to define what should appear in the 'Values' area- these are the main body of the pivot table.  Please select the name of the database table  that stores the data that you want to list in the body of your pivot table."
		});
		$('#gridFieldPop').popover({ // grid field
			trigger: 'hover',
			content: "In this section you need to define what should appear in the 'Values' area- these are the main body of the pivot table.  Please select the name of the database column that stores the data that you want to list in the body of your pivot table.."
		});
		$('#gridFuncPop').popover({ // grid function
			trigger: 'hover',
			content: "The MySQL Pivot table generator gives you the ability to list data exactly as they are in your database or to further process them with a mathematical function. For example, you can create a pivot table for the average sales per department.."
		});
		// ---------------------------------------------------------------
		// relsHelp
		$('#relsHelp').popover({ // relationship
			trigger: 'hover',
			content: "This section should be used to define table relationships if your data is stored in separate tables. You shouldn't see this section at all if the MySQL Table in the 'Column Labels', 'Row Labels' and  'Values ' area is the same table. "
		});
		// ---------------------------------------------------------------
		// rows pagination
		$('#arpPop').popover({ // allow rows pagination
			trigger: 'hover',
			content: "This option enables you to split your pivot table into several pages and easily navigate between them.  Pagination shouldn't be used unless you have a really huge number of columns or rows."
		});
		$('#rppPop').popover({ // record per page
			trigger: 'hover',
			content: "Number of records on each page."
		});
		$('#mrppPop').popover({ // max records per page
			trigger: 'hover',
			content: "max records per page."
		});
		// ---------------------------------------------------------------
		// columns pagination
		$('#acpPop').popover({ // allow columns pagination
			trigger: 'hover',
			content: "This option enables you to split your pivot table into several pages and easily navigate between them. <br/> Pagination shouldn't be used unless you have a really huge number of columns or rows."
		});
		$('#cppPop').popover({ // columns per page
			trigger: 'hover',
			content: "Number of records on each page."
		});
		$('#mcPop').popover({ // Max columns
			trigger: 'hover',
			content: "Max columns."
		});
		// ---------------------------------------------------------------
				
	}
	
		
}

