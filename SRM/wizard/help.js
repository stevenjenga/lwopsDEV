//**************************** wizard Step 2 **************************************************
var step_2 = new Array();
step_2["host"]=["Smart Report Maker","Server name or IP address "];
step_2["user"]=["Smart Report Maker","The user name should have only a “select” permission, any additional permissions are neither recommended nor required"];
step_2["pass"]=["Smart Report Maker","The password of the username that you intend to use to connect to your database "];
step_2["database"]=["Smart Report Maker","the database that you intend to use to create your report."];
step_2["dataSource"]=["Smart Report Maker","table(s) or a SQL query  "];
//*************************** wizard step 3 ****************************************************
var step_3 = new Array();
step_3["selectTables"] = ["Smart Report Maker","Choose the table(s) you require for your Report.  You can select Multiple tables by holding the CTRL' key while selecting your tables"];
step_3["rightRelation"] = ["Smart Report Maker","Select the forign key "];
step_3["leftRelation"] = ["Smart Report Maker","Select the parent table, and its primary key "];
step_3["addRelation"] = ["Smart Report Maker","Click to add a relation "];
step_3["removeRelation"] = ["Smart Report Maker","Select the relation which you want to remove"];
//*************************** wizard step 3 sql ****************************************************
var step_3_sql = new Array();
step_3_sql["sql"] = ["Smart Report Maker","The SQL statement used to create the report.<br /> <b>Note:</b> avoid using 'order by' because it will be Done visually in a next step."];
step_3_sql["views"] = ["Smart Report Maker","You can load the SQL query from an existing view ."];
//*************************** wizard step 4 ****************************************************
var step_4 = new Array();
step_4["selectFields"] = ["Smart Report Maker","Select The columns that you intend to use in your report (Required )"];
step_4["statisticalFunction"] = ["Smart Report Maker","Select the function which you want to apply"];
step_4["statisticalColumn"] = ["Smart Report Maker","the column on which you want to apply the selected aggregation function. ( it should  have a numeric data type)"];
step_4["statisticalGroupbyColumn"] = ["Smart Report Maker","The 'group by' column. <br/> For example, if you want to generate a report  for  the average salary of male and female employees, “Function”  should be AVG'  Affected column should be 'Salary', Grouped by  'Gender'."];
//*************************** wizard step 5 ****************************************************
var step_5 = new Array();
step_5["groupBy"] = ["Smart Report Maker","For example, you can group your customers by country in order to get the customer details for each country"];
step_5["sortBy"] = ["Smart Report Maker","Sorting data according to any specific column(s) in ascending OR descending order."];
//*************************** wizard step 6 ****************************************************
var step_6 = new Array();
step_6["layout"] = [ "Smart Report Maker","The appearance of your report is very customizable. You can select both the layout and style of your report "];
step_6["style"] = ["Smart Report Maker","This is a list of the available themes"];

step_6["adminUsername"] = ["Smart Report Maker","With Smart Report Maker, you can prevent unauthorized access to generated reports by checking the 'Password Protect Generated Report' option and then adding an Admin User name and password .Each username and password protects one report, so each report should have a user name and password. You can also choose to disable the password protection function for some reports."];
step_6["adminPass"] = ["Smart Report Maker","With Smart Report Maker, you can prevent unauthorized access to generated reports by checking the 'Password Protect Generated Report' option and then adding an Admin User name and password .Each username and password protects one report, so each report should have a user name and password. You can also choose to disable the password protection function for some reports."];
step_6["memberTable"] = ["Smart Report Maker","This feature allows your member’s stored usernames and passwords to access the generated report. Simply Select the table that contain the login information of your members "];
step_6["memberUsername"] = ["Smart Report Maker","Select the column that contain the usename information of your members"];
step_6["memberPass"] = ["Smart Report Maker","Select the column that contain the passwords   of your members"];
step_6["memberPassHashType"] = ["Smart Report Maker","If the passwords of your members are encrypted, please select the PHP function.  This will allow for the encryption process."];
step_6["adminEmail"] = ["Smart Report Maker","Since the members login info is already exists in your database and cannot be edited, Smart Report Maker will not be able to reset the password of any member, instead it will send an email notification to the database administrator if any member request a password change (provided you have enabled this feature)"];

step_6["reportTitle"] = ["Smart Report Maker","It Will be displayed at the header of the report"];
step_6["reportFooter"] = ["Smart Report Maker","Report Footer. It could contain HTML tags."];
step_6["reportHeader"] = ["Smart Report Maker","Report Header. It could contain HTML tags"];
step_6["reportName"] = ["Smart Report Maker","Report name."];
    step_6["recordPerPage"] = ["Smart Report Maker","Max number of records that could be displayed in one page. 'Next' and 'Previous' links will be shown in your report to navigate between pages."];

// ----------------------------------------------------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------------------------------------------------------
// this function to make help system
function help(arr_item, id)
{
	// this attribute is bootstrap popover requirements
	$(id).attr('data-toggle', 'popover');
	
	var title = arr_item[0]; // title
	var content = arr_item[1]; // help msg
	
	// here set up all config about popover bootstrap
	$(id).popover({
		trigger: 'hover',
		container: 'body',
		placement: 'right',
		title: title,
		content: content,
		html: true
	});
}
// here execute the help function for every help icon
help(step_2["host"], "#hostHelp");
help(step_2["user"], "#userHelp");
help(step_2["pass"], "#passHelp");
help(step_2["database"], "#dbHelp");
help(step_2["dataSource"], "#dsHelp");

help(step_3["selectTables"], "#stHelp");
help(step_3["rightRelation"], "#rRelHelp");
help(step_3["leftRelation"], "#lRelHelp");
help(step_3["addRelation"], "#addHelp");
help(step_3["removeRelation"], "#rmHelp");

help(step_3_sql["sql"], "#sqlHelp");
help(step_3_sql["views"], "#viewsHelp");

help(step_4["selectFields"], "#sfHelp");
help(step_4["statisticalFunction"], "#statisticalFuncHelp");
help(step_4["statisticalColumn"], "#statisticalColHelp");
help(step_4["statisticalGroupbyColumn"], "#statisticalGroHelp");

help(step_5["groupBy"], "#groupbyHelp");
help(step_5["sortBy"], "#sortHelp");

help(step_6["layout"], "#layoutHelp");
help(step_6["style"], "#styleHelp");
help(step_6["adminUsername"], "#adminUserHelp");
help(step_6["adminPass"], "#adminPassHelp");
help(step_6["memberTable"], "#memberTableHelp");
help(step_6["memberUsername"], "#memberUserHelp");
help(step_6["memberPass"], "#memberPassHelp");
help(step_6["memberPassHashType"], "#memberPassHashTypeHelp");
help(step_6["adminEmail"], "#adminEmailHelp");
help(step_6["reportTitle"], "#rTitleHelp");
help(step_6["reportFooter"], "#rFooterHelp");
help(step_6["reportHeader"], "#rHeaderHelp");
help(step_6["reportName"], "#rNameHelp");
help(step_6["recordPerPage"], "#rPPHelp");