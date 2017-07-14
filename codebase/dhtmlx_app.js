/* global myDataProcessor, myGrid, myLayout, monthNames */

function isNumeric(n) {}

function betweeb0and100(value, row_id, column_index) {
    columnNbr = column_index + 1;
    if (parseFloat(value) > 100) {
        myGrid.setCellTextStyle(row_id, column_index, "background-color:red;");
        dhtmlx.alert({
            type: "alert-error",
            text: "Value of column " + columnNbr + " must be LESS than 100!!",
            title: "Error!",
            ok: "Close"
        });
        return false;
    }
    if (parseFloat(value) <= 0) {
        myGrid.setCellTextStyle(row_id, column_index, "background-color:red;");
        dhtmlx.alert({
            type: "alert-error",
            text: "Value of column " + columnNbr + " must be GREATER than 0!!",
            title: "Error!",
            ok: "Close"
        });
        return false;
    }
}

function not_empty(value, row_id, column_index) {
    if (value == "") {
        myGrid.setCellTextStyle(row_id, column_index, "background-color:red;");
        dhtmlx.alert({
            type: "alert-error",
            text: "This value(s) must be entered, cannot be empty",
            title: "Error!",
            ok: "Close"
        });
        return false;
    }
    return true;
}

function greaterThanZero(value, row_id, column_index) {
    if (value > 0) {
        return true;
    } else {
        myGrid.setCellTextStyle(row_id, column_index, "background-color:red;");
        dhtmlx.alert({
            type: "alert-error",
            text: "This value["+value+"] must be > 0",
            title: "Error!",
            ok: "Close"
        });
        return false;
    }
}

function greaterThan1000(value, row_id, column_index) {
    if (value > 999.99) {
        return true;
    } else {
        myGrid.setCellTextStyle(row_id, column_index, "background-color:red;");
        dhtmlx.alert({
            type: "alert-error",
            text: "This value(s) must be > KES999.99",
            title: "Error!",
            ok: "Close"
        });
        return false;
    }
}

function greaterThan100(value, row_id, column_index) {
    if (value > 99.99) {
        return true;
    } else {
        myGrid.setCellTextStyle(row_id, column_index, "background-color:red;");
        dhtmlx.alert({
            type: "alert-error",
            text: "This value(s) must be > KES99.99",
            title: "Error!",
            ok: "Close"
        });
        return false;
    }
}

function disableActiveFlg(value, row_id, column_index) {
    /*
     Prevents user from turning Active on or off.
     Must use the Terminate Employee grid to turn Active off
     */
    if (value == 0) {
        myGrid.cells(row_id, 6).setValue("0");
        return true;
    } else {
        myGrid.cells(row_id, 6).setValue("1");
        return true;
    }
}

function get_currentDate_by_obj(d) {
    /*
     #@ d given date object
     return an object that content both normal date format and Named date format
     */
    var now = new Date(d);
    var day = ("0" + now.getDate()).slice(-2);
    var month = now.getMonth() + 1;
    var month3 = now.getMonth();

    var month2 = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = (month) + "/" + (day) + "/" + now.getFullYear();
    var normalDate = now.getFullYear() + "/" + month2 + "/" + day;
    var namedDate = monthNames[month3] + " " + day + " " + now.getFullYear();
    return {'date1': normalDate, 'date2': namedDate};
}


function get_currentDate_Arr() {
    /*
     return an object that content current day, month and year
     */
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = (now.getMonth() + 1);
    var month2 = now.getMonth();
    var today = (month) + "/" + (day) + "/" + now.getFullYear();
    return {'day': day, 'month': month, 'year': now.getFullYear(), 'actualMonth': month2};
}


function get_currentDateStr() {
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = (month) + "." + (day) + "." + now.getFullYear();
    console.log(today);
    return today;
}

function get_currentDatetimeStr() {
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear()+'-'+(month)+'-'+(day)+' 12:00';
    console.log(today);
    return today;
}

function initMyGridLight() {
    myGrid = myLayout.cells("a").attachGrid('gridbox');
    myGrid.setImagePath("codebase/imgs/");
    myGrid.setDateFormat("%M.%d.%Y");
    myGrid.enableAutoWidth(true);
    myGrid.enableEditEvents(true, false, true);
    
    myGrid.attachEvent("onBeforeSorting", function(ind,type,direction){
        console.log("onBeforeSorting event fired..."+ind+" - "+type+" - "+direction);
        return false;
    });    
    return myGrid;
}

//function updateDbData() {
//    myDataProcessor.sendData();
//    myGrid.clearAndLoad("functions/" + xmlFile);
//}
function initMyCalendar(dataXmlFile) {
    var aCalendar = new dhtmlXCalendarObject("box");
    aCalendar.setSensitiveRange("2017-01-01", new Date());
    aCalendar.attachEvent("onClick", function (d) {
        document.getElementById("box").value = get_currentDate_by_obj(d).date2;
        myGrid.clearAll();
        myGrid.load("functions/" + dataXmlFile + "?date=" + get_currentDate_by_obj(d).date1, function () {  //loading data to the grid
            myGrid.forEachRow(function (id) {});

        });
    });
    aCalendar.attachEvent("onHide", function (d) {});
}

function initMydataProcessor(updtDataXmlFile, updateMode) {
    console.log("updtDataXmlFile=" + updtDataXmlFile + " - updateMode=" + updateMode + "- getDataXmlFile=" + getDataXmlFile);
    aDataProcessor = new dataProcessor("functions/" + updtDataXmlFile);
    aDataProcessor.attachEvent("onRowMark", function (id) {
        if (this.is_invalid(id) === "invalid")
            return false;
        return true;
    });
    aDataProcessor.defineAction("updated", updateSucessMsgPopup);
    aDataProcessor.defineAction("inserted", insertSucessMsgPopup);
    aDataProcessor.defineAction("error", errorMsgPopup);
    aDataProcessor.setTransactionMode("GET", false);
    if (updateMode === 0) {
        aDataProcessor.setUpdateMode("off");
        console.log("update OFF");
    }    
    aDataProcessor.attachEvent("onAfterUpdate", function(id, action, tid, response){
//        myGrid.clearAndLoad("functions/"+getDataXmlFile);
        reloadGrid(getDataXmlFile, updtDataXmlFile);
        
    })    
    return aDataProcessor;
}
function reloadGrid(getDataXmlFile,updtDataXmlFile){
    myGrid.clearAndLoad("functions/"+getDataXmlFile);
    myDataProcessor = initMydataProcessor(updtDataXmlFile, 0);
    myDataProcessor.init(myGrid);
}
function initMyGridNew(dataXmlFile) {
    console.log("getDataXmlFile => " + dataXmlFile);
    getDataXmlFile = dataXmlFile;
    myGrid = myLayout.cells("a").attachGrid('gridbox');
    myGrid.setImagePath("codebase/imgs/");
    myGrid.setDateFormat("%M.%d.%Y");
    myGrid.enableAutoWidth(true);
    myGrid.enableEditEvents(true, false, true);

//    myGrid.attachEvent("onXLS", function () {
//        document.getElementById("a_1").style.display = "block";
//    });
//    myGrid.attachEvent("onXLE", function () {
//        document.getElementById("a_1").style.display = "none";
//    });
//    myGrid.attachEvent("onXLS", function () {
//        document.getElementById('cover').style.display = 'block';
//    });
//    myGrid.attachEvent("onXLE", function () {
//        document.getElementById('cover').style.display = 'none';
//    });
   
    myGrid.init();
    myGrid.enableSmartRendering(true, 50);
    myGrid.load("functions/" + getDataXmlFile);
    return myGrid;
}

function testGrid() {
    myGrid = myLayout.cells("a").attachGrid('gridbox');
    myGrid.setImagePath("codebase/imgs/");
    myGrid.setHeader("Sales,Book Title,Author,Price,In Store,Shipping,Bestseller,Date of Publication");
    myGrid.setInitWidths("80,150,120,80,80,80,80,100");
    myGrid.setColAlign("right,left,left,right,center,left,center,center");
    myGrid.setColTypes("dyn,ed,txt,price,ch,coro,ch,ro");
    myGrid.setColSorting("int,str,str,int,str,str,str,date");
    myGrid.enableAutoWidth(true);
    myGrid.init();
    myGrid.load("functions/get_test_data_xml.php") // used just for demo purposes
    //
    myDataProcessor = new dataProcessor("functions/update_test_data.php"); // lock feed url
    myDataProcessor.setTransactionMode("GET", false);
    myDataProcessor.init(myGrid); // link dataprocessor to the grid
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	BEGIN: EMPLOYEE MENU GRIDS
//
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function loadEditEmployeeGrid() {
    myLayout.cells("a").setText('EMPLOYEE ROLL  |  <input type="button" name="employeeEditBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    myGrid = initMyGridNew("get_emp_data_xml.php");
    myDataProcessor = initMydataProcessor("update_emp_data.php", 0);
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(4, not_empty);
    myDataProcessor.setVerificator(5, not_empty);
    myDataProcessor.setVerificator(6, disableActiveFlg);
    myDataProcessor.setVerificator(7, not_empty);
    myDataProcessor.setVerificator(8, not_empty);
    myDataProcessor.init(myGrid);
}

function loadEditEmployeeRoleGrid(){
    myLayout.cells("a").setText('EMPLOYEE ROLE  |  <input type="button" name="employeeRoleUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    myGrid = initMyGridNew("get_emp_role_data_xml.php");
    myDataProcessor = initMydataProcessor("update_emp_role_data.php", 0);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.init(myGrid);    
}
function loadNewHireForm(){
    loadView('1C');
    myLayout.cells("a").setText('NEW EMPLOYEE ONBOARDING');
    formData = [
	{type: "settings", position: "label-left", labelWidth: 90, inputWidth: 150},
	{type: "fieldset", label: "Employee ID Data", inputWidth: 340, width: "auto", blockOffset: 20, offsetLeft: "10", list: [
		{type: "settings", position: "label-left", labelWidth: 80, inputWidth: 150},
		{type: "block", width: "auto", blockOffset: 20, list: [
			{type: "input", label: "First Name", value: "XXX", inputWidth: "140", name: "firstName", required: true},
			{type: "calendar", label: "DOB", value: "", labelAlign: "center", inputWidth: 75, name: "DOB", required: true},
			{type: "combo", label: "Marital Status", labelAlign: "left", inputWidth: 75, name: "maritalStatus", required: true, options: [
				{text: "Married", value: "M"},
				{text: "Single", value: "S"}
			]},
			{type: "newcolumn"},
			{type: "input", label: "Initial", value: "x", inputWidth: "20", offsetLeft: "10", name: "midInitial"},
			{type: "input", label: "Mobile", value: "072555112", offsetLeft: "10", name: "mobileNbr", required: true},
			{type: "input", label: "Nationl ID", value: "XXX", offsetLeft: "10", name: "nationalID", required: true},                        
			{type: "newcolumn"},
			{type: "input", label: "Last Name", value: "XXX", inputWidth: "150", name: "lastName", required: true},
			{type: "combo", label: "Gender", labelAlign: "left", inputWidth: 75, offsetLeft: "10", required: true, options: [
				{text: "Male", value: "M"},
				{text: "Female", value: "F"}
			], name: "gender"}
		]}
	]},
	{type: "fieldset", label: "Spouse Data", inputWidth: 340, width: "auto", blockOffset: 20, offsetLeft: "10", list: [
		{type: "settings", position: "label-left", labelWidth: 80, inputWidth: 130},
		{type: "block", width: "auto", blockOffset: 20, list: [
			{type: "input", label: "First Name", value: "SSS", inputWidth: "150", name: "spouseFirstNm"},
			{type: "newcolumn"},
			{type: "input", label: "Last Name", value: "SSS", inputWidth: "150", offsetLeft: "10", name: "spouseLastNm"},
			{type: "newcolumn"},
			{type: "input", label: "Mobile", value: "0728881212", inputWidth: "150", offsetLeft: "10", name: "spouseMobNbr"}
		]}
	]},
	{type: "fieldset", label: "Employment History", inputWidth: 340, width: "auto", blockOffset: 20, offsetLeft: "10", list: [
		{type: "settings", position: "label-left", labelWidth: 80, inputWidth: 130},
		{type: "block", width: "auto", blockOffset: 20, name: "Employment History", list: [
			{type: "input", label: "Previous Employer", value: "XXX", labelWidth: "100", inputWidth: "400", name: "prevEmployerName", required: true},
			{type: "input", label: "Tel Nbr", value: "0729991212", labelWidth: "70", inputWidth: "150", offsetLeft: "30", name: "prevEmployerTelNbr", required: true},
			{type: "calendar", label: "Start Date", value: "", labelWidth: "70", inputWidth: "75", offsetLeft: "30", name: "prevEmployerStartDt", required: true},
			{type: "input", label: "Reason for Leaving", value: "XXXX XXXX XXXX", labelWidth: "70", inputWidth: "400", offsetLeft: "30", name: "prevEmployerLeavingReason", required: true},
			{type: "newcolumn"},
			{type: "input", label: "Location", value: "XXX", labelWidth: "60", inputWidth: "150", offsetLeft: "10", name: "prevEmployerLocation", required: true},
			{type: "input", label: "Work Done", value: "XXX", labelWidth: "60", inputWidth: "150", offsetLeft: "10", name: "workDoneAtPrevEmployer", required: true},
			{type: "calendar", label: "End Date", value: "", labelWidth: "60", inputWidth: "75", offsetLeft: "10", name: "prevEmployerEndDt", required: true}
		]}
	]},
	{type: "fieldset", label: "Next of Kin", inputWidth: 340, width: "auto", blockOffset: 20, offsetLeft: "10", list: [
                {type: "settings", position: "label-left", labelWidth: 80, inputWidth: 130},
                {type: "block", width: "auto", blockOffset: 20, name: "Employment History", list: [                    
                    {type: "input", label: "First Name", value: "XXX", inputWidth: "150", name: "nxtOfKinFirstNm", required: true},
                    {type: "input", label: "Tel Nbr", value: "0736661212", inputWidth: "150", name: "nxtOfKinMobileNbr", required: true},
                    {type: "newcolumn"},
                    {type: "input", label: "Last Name", value: "XXX", inputWidth: "150", offsetLeft: "10", name: "nxtOfKinLastNm", required: true},
                    {type: "input", label: "Residence", value: "XXX", inputWidth: "150", offsetLeft: "10", name: "nxtOfKinResidence", required: true},
                    {type: "newcolumn"},
                    {type: "combo", label: "Relationship", labelAlign: "left", inputWidth: "75", offsetLeft: "10", required: true, options: [
                            {text: "Brother", value: "B"},
                            {text: "Sister", value: "S"},
                            {text: "Father", value: "F"},
                            {text: "Mother", value: "M"}
                    ], name: "nxtOfKinRelationship"},
                    {type: "input", label: "Place of Work", value: "XXX", inputWidth: "150", offsetLeft: "10", name: "nxtOfKinPlaceOfWork", required: true}
                ]}   
	]},
	{type: "fieldset", label: "Compensation", inputWidth: 340, width: "auto", blockOffset: 20, offsetLeft: "10", list: [
		{type: "settings", position: "label-left", labelWidth: 80, inputWidth: 130},
                {type: "block", width: "auto", blockOffset: 20, name: "Employment History", list: [                                    
                    {type: "combo", label: "Employment Type", value: "", inputWidth: "140", labelWidth: "110", connector: "functions/get_emp_employement_type_options.php", name: "employmentType", required: true},
                    {type: "input", label: "Starting Salary", value: "", inputWidth: "90", labelWidth: "40", offsetLeft: "10", validate: "[0-9]+", name: "startingSalary", required: true, labelWidth: "130"},
                    {type: "calendar", label: "Effective Date", value: "", inputWidth: "75", labelWidth: "110", name: "startDt", tooltip: "The date employment starts", required: true},
                    {type: "combo", label: "Resident?", value: "", inputWidth: "75", labelWidth: "110", offsetLeft: "10", required: true, options: [
                            {text: "Yes", value: "1"},
                            {text: "No", value: "0"}
                    ], name: "residentFlg"},
                    {type: "checkbox", label: "Deduct NSSF?", value: "", offsetLeft: "10", labelWidth: "130", name: "NSSFdeductionFlg", labelAlign: "right"},
                    {type: "combo", label: "Hiring Dept.", value: "", inputWidth: "150", offsetLeft: "10", connector: "functions/get_lineOfBusiness_options.php", name: "lineOfBusinessOid", required: true, labelWidth: "130"},                    
                    {type: "newcolumn"},
                    {type: "combo", label: "Role", value: "", inputWidth: "150", offsetLeft: "10", connector: "functions/get_emp_employement_role_options.php", name: "employeeRole", required: true, labelWidth: "130"},
                    {type: "combo", label: "Salary Frequency", value: "", inputWidth: "130", labelWidth: "130", offsetLeft: "10", connector: "functions/get_salary_freq_type_options.php", name: "salaryFrequency", required: true},
                    {type: "checkbox", label: "ePayment?", value: "", inputWidth: "130", offsetLeft: "10", labelWidth: "130", name: "ePayment", labelAlign: "right"},
                    {type: "combo", label: "Deduct Electricity?", value: "", inputWidth: "75", offsetLeft: "10", required: true, options: [
                            {text: "Yes", value: "1"},
                            {text: "No", value: "0"}
                    ], name: "elecDeductionFlg", labelWidth: "130"},
                    {type: "checkbox", label: "Deduct Medical?", value: "", inputWidth: "150", offsetLeft: "10", labelWidth: "130", name: "medicalDeductionFlg", labelAlign: "right"},
                    {type: "newcolumn"}
                ]}
	]},
	{type: "label", label: "Print, complete and have the employee sign the form for our records.", value: "", name: "processDescription1", labelWidth: "500", offsetLeft: "10"},
	{type: "button", value: "Save", name: "submit", offsetLeft: "10"}
    ]
    myForm = myLayout.cells("a").attachForm(formData);
    //myForm.load("functions/get_new_hire_data_xml.php", function(){}); 
    myForm.attachEvent("onButtonClick", function(id){
        if (id == "submit") {
            console.log('submitted');
            myForm.send("functions/save_new_hire_data.php", function(loader, response){
                console.log(response);
                if(response == ''){
                    dhtmlx.message.position = "top";
                    dhtmlx.message("Employee HIRED!!");
                    dhtmlx.message({ 
                            type:"error", 
                            text:"Attendance has been inserted for the new employee <br> YOU MUST CONFIRM <br> employee attended on all days from hire date." 
                    })                    
                    loadInitialLayout();
                } 
                else {
                    dhtmlx.alert({
                        type: "alert-error",
                        text: "NEW HIRE FAILED - REDO!!<br>"+response,
                        title: "Error!",
                        ok: "OK"
                    });                    
                }
            });
        }
    }); 
    loadPageMenu(myLayout);
}

function loadTerminateEmployeeForm(empOid,empType) {
    loadView('2U');
    loadBasicTerminationForm(empOid,empType);
}

function loadBasicTerminationForm(empOid,empType){
    console.log('empOid = '+empOid);
    console.log('empType = '+empType);
    myLayout.cells("a").setText('EMPLOYEE TERMINATION'); 
    myLayout.cells("a").setWidth(620);
    myLayout.cells("b").setText('PAYSLIP');
    basicTerminationFormData = [
	{type: "fieldset", label: "Employee", inputWidth: "auto", width: 610, blockOffset: 10, offsetLeft: "5", list: [
		{type: "settings", position: "label-left", labelWidth: 80, inputWidth: 130},
		{type: "input", label: "Employee Name", value: "", labelAlign: "right", name: "fname", labelWidth: "120", labelLeft: "1", readonly: true},
		{type: "input", label: "National ID", value: "", labelAlign: "right", name: "natID", labelWidth: "120", labelLeft: "1", readonly: true},
		{type: "newcolumn"},
		{type: "input", label: "", value: "", labelAlign: "right", name: "mname", labelWidth: "10", labelLeft: "5", offsetLeft: "5", inputWidth: "30", readonly: true},
		{type: "newcolumn"},
		{type: "input", label: "", value: "", labelAlign: "right", name: "lname", labelWidth: "85", offsetLeft: "5", readonly: true}
	]},
	{type: "fieldset", label: "Termination Details", inputWidth: "auto", width: 610, blockOffset: 20, offsetLeft: "5", list: [
		{type: "settings", position: "label-left", labelWidth: 80, inputWidth: 130},
		{type: "calendar", label: "Termination Date", value: "", labelAlign: "right", name: "tDate", labelWidth: "150", labelLeft: "5", required: true},
		{type: "combo", label: "Reason", name: "terminationReason", connector: "functions/get_emp_termination_reasons_options.php", labelAlign: "right", labelWidth: "150", labelLeft: "5", required: true},
		{type: "input", label: "Termination Comments", value: "", labelWidth: "150", inputWidth: "390", name: "terminationComments", rows: "6", labelAlign: "right", required: true},
		{type: "input", value: "", name: "empOid", hidden: true, readonly: true}              
	]},
	{type: "fieldset", label: "Gratuity", inputWidth: "auto", width: 610, blockOffset: 20, offsetLeft: "5", list: [
		{type: "settings", position: "label-left", labelWidth: 80, inputWidth: 130},
		{type: "input", label: "Gratuity Amount", value: 0, labelAlign: "right", name: "gratuityAmt", labelWidth: "130", labelLeft: "1", readonly: false, numberFormat:["0,000.00",",","."]},
		{type: "input", label: "Gratuity Comments", value: "", labelWidth: "130", inputWidth: "390", name: "gratuityComments", rows: "4", labelAlign: "right", required: false},
                {type: "button", value: "GENERATE Paylsip", name: "generatePayslip", offsetLeft: "313"}
                
	]},
    	{type: "label", label: "NOTE: THE SYSTEM ASSUMES THAT ALL PREVIOUS PERIODS HAVE BEEN PAID", value: "", name: "processDescription"}
    ];   
    console.log('XXX2');
    basicTerminationForm = myLayout.cells("a").attachForm(basicTerminationFormData);
    console.log('XXX3');
    basicTerminationForm.load("functions/load_emp_termination_data_xml.php?empOid="+empOid+"&empType="+empType, function(){}); 
    console.log('XXX4');
    attachBasicTerminationFormEvents(empOid,empType);
    console.log('XXX5');
    loadPageMenu(myLayout);    
}

function attachBasicTerminationFormEvents(empOid,empType){
    
    var terminationDateCalendar = basicTerminationForm.getCalendar("tDate");
    terminationDateCalendar.attachEvent("onClick",function(date){
        console.log('Termination date changed');
        console.log('date='+date);
        terminationDateCalendarChanged = true;                                                         
    });
    
    basicTerminationForm.attachEvent("onButtonClick", function(id){
        console.log('id='+id);
        if (id == "generatePayslip") {
            console.log('tDate='+basicTerminationForm.getItemValue("tDate")); 
            console.log('terminationDateCalendarChanged='+terminationDateCalendarChanged); 
            if (basicTerminationForm.getItemValue("tDate") === null){
                dhtmlx.alert({
                    type: "alert-error",
                    text: "Termination Date must be selected",
                    title: "Error!",
                    ok: "OK"
                }) 
                return false;
            }
            if (basicTerminationForm.getItemValue("terminationComments").length < 30){
                dhtmlx.alert({
                    type: "alert-error",
                    text: "Termination Comments must be provided (at leaset 30 characters)",
                    title: "Error!",
                    ok: "OK"
                }) 
                return false;
            } 
            if (basicTerminationForm.getItemValue("terminationReason").length === 0){
                dhtmlx.alert({
                    type: "alert-error",
                    text: "Termination Reason must be selected",
                    title: "Error!",
                    ok: "OK"
                }) 
                return false;
            } 
            
            tDate = basicTerminationForm.getItemValue("tDate", true);
            gratuityAmt = basicTerminationForm.getItemValue("gratuityAmt");
            terminationComments = basicTerminationForm.getItemValue("terminationComments");
            gratuityComments = basicTerminationForm.getItemValue("gratuityComments");
            terminationReason = basicTerminationForm.getItemValue("terminationReason");
            
            basicTerminationForm.send("functions/load_emp_termination_data_xml.php?empOid="+empOid+"&generatePayslip="+"1&validateTerminationDt="+1+"&tDate="+tDate+"&empType="+empType+"&gratuityAmt="+gratuityAmt+"&terminationComments="+terminationComments+"&gratuityComments="+gratuityComments, function (loader, response) {
                console.log(response);
                var found = response.search(/ERROR/i);
                console.log('found = '+found);
                if (found === -1) {
                    terminationDateCalendarChanged = false;  
                    generateTerminationPayslip(empOid,empType,tDate,gratuityAmt);
                } else {
                    dhtmlx.alert({
                        type: "alert-error",
                        text: "GENERATE PAYSLIP FAILED!!<br>" + response,
                        title: "Error!",
                        ok: "OK"
                    });
                    return false;
                }
            });            
        }
    });     
}

function generateTerminationPayslip(empOid,empType,terminationDate,gratuityAmt){
    console.log('generatePayslip selected');  
    console.log('empOid='+empOid);
    console.log('empType='+empType);
    console.log('terminationDate='+terminationDate);
    console.log('gratuityAmt='+gratuityAmt);
    loadTerminationPayslipForm(empOid,empType,terminationDate,gratuityAmt);
    loadPageMenu(myLayout);  
}

function loadTerminationPayslipForm(empOid,empType,terminationDate,gratuityAmt){
    switch (empType){
        case "S":
            loadFteTerminationPayslipForm(empOid,empType,terminationDate,gratuityAmt);
            break; 
        case "C":
            loadCasualTerminationPayslipForm(empOid,empType,terminationDate,gratuityAmt);
            break;            
        case "F":
            break;            
        default:
            break;
    }    
}

function loadFteTerminationPayslipForm(empOid,empType,terminationDate,gratuityAmt){
    myLayout.cells("b").setText('FTE TERMINATION PAYSLIP');
    fteTerminationPayslipFormData = [
	{type: "fieldset", label: "Pending Income", inputWidth: "auto", width: 820, blockOffset: 20, offsetLeft: "10", list: [
		{type: "settings", position: "label-left", labelWidth: 80, inputWidth: 130},
		{type: "input", label: "Current Salary", value: "", labelAlign: "right", name: "salary", labelWidth: "80", labelLeft: "5", inputWidth: "90", readonly: true, numberFormat:["0,000.00",",","."]},
		{type: "newcolumn"},
		{type: "input", label: "Daily Pay", name: "dailyPay", labelAlign: "right", labelWidth: "80", labelLeft: "5", readonly: true, inputWidth: "80", offsetLeft: "5", numberFormat:["0,000.00",",","."]},               
		{type: "input", label: "Days Worked", value: "", name: "daysPending", labelAlign: "right", labelWidth: "80", labelLeft: "5", readonly: true, inputWidth: "80", offsetLeft: "5"},                                
		{type: "input", label: "Pay", value: "", name: "totalPay", labelAlign: "right", labelWidth: "80", labelLeft: "5", readonly: true, inputWidth: "80", offsetLeft: "5", numberFormat:["0,000.00",",","."]},
		{type: "newcolumn"},
		{type: "input", label: "Hourly Rate", value: "", name: "hourlyRate", labelAlign: "right", labelWidth: "80", labelLeft: "5", readonly: true, inputWidth: "80", offsetLeft: "5", numberFormat:["0,000.00",",","."]},
		{type: "input", label: "Parttime Hrs", value: "", name: "parttimeHrsPending", labelAlign: "right", labelWidth: "80", labelLeft: "5", readonly: true, inputWidth: "80", offsetLeft: "5"},
		{type: "input", label: "Parttime Pay", value: "", name: "totParttimePay", labelAlign: "right", labelWidth: "80", labelLeft: "5", readonly: true, inputWidth: "80", offsetLeft: "5", numberFormat:["0,000.00",",","."]},
		{type: "input", label: "GROSS PAY", value: "", name: "grossPay", labelAlign: "right", labelWidth: "90", readonly: true, inputWidth: "80", offsetLeft: "240", numberFormat:["KES 0,000.00",",","."]}
	]},
	{type: "fieldset", label: "Pending Deductions", inputWidth: "auto", width: 820, blockOffset: 20, offsetLeft: "10", list: [
		{type: "settings", position: "label-left", labelWidth: 80, inputWidth: 130},
		{type: "input", label: "Days Absent", value: "", labelAlign: "right", name: "daysAbsent", labelWidth: "80", labelAlign: "right", labelLeft: "5", readonly: true, inputWidth: "40"},
		{type: "input", label: "Deduction", value: "", name: "daysAbsentDeduction", labelWidth: "80", labelAlign: "right", readonly: true, inputWidth: "80", numberFormat:["0,000.00",",","."]},
		{type: "newcolumn"},
		{type: "input", label: "Medical", name: "medicalDeduction", labelAlign: "right", labelWidth: "80", labelLeft: "5", readonly: true, inputWidth: "80", offsetLeft: "5", numberFormat:["0,000.00",",","."]},
		{type: "input", label: "NSSF", value: "", name: "NSSFdeduction", labelAlign: "right", labelWidth: "80", labelLeft: "5", readonly: true, inputWidth: "80", offsetLeft: "5", numberFormat:["0,000.00",",","."]},
		{type: "input", label: "Loans", value: "", name: "loanDeduction", labelAlign: "right", labelWidth: "80", labelLeft: "5", readonly: true, inputWidth: "80", offsetLeft: "5", numberFormat:["0,000.00",",","."]},
		{type: "newcolumn"},
		{type: "input", label: "Other", value: "", name: "otherDeductions", labelAlign: "right", labelWidth: "80", labelLeft: "5", inputWidth: "80", readonly: true, offsetLeft: "5", numberFormat:["0,000.00",",","."]},
		{type: "input", label: "Purchases", value: "", name: "purchasesDeduction", labelAlign: "right", labelWidth: "80", labelLeft: "5", readonly: true, inputWidth: "80", offsetLeft: "5", numberFormat:["0,000.00",",","."]},
		{type: "input", value: "", name: "payslipOid", hidden: true, readonly: true},
		{type: "input", label: "Elec", value: "", name: "elecDeduction", labelAlign: "right", labelWidth: "80", labelLeft: "5", readonly: true, inputWidth: "80", offsetLeft: "5", numberFormat:["0,000.00",",","."]},                
		{type: "input", label: "TOTAL DEDUCTIONS", value: "", name: "totalDeductions", labelAlign: "right", labelWidth: "120", labelLeft: "5", readonly: true, inputWidth: "90", offsetLeft: "210", numberFormat:["KES 0,000.00",",","."]},
	]},
	{type: "fieldset", label: "NET PAY", inputWidth: "auto", width: 820, blockOffset: 20, offsetLeft: "10", list: [
		{type: "settings", position: "label-left", labelWidth: 80, inputWidth: 130},
		{type: "input", label: "Gratuity", name: "gratuityAmt", labelAlign: "right", labelWidth: "90", labelLeft: "2", readonly: true, inputWidth: "80", offsetLeft: "5", numberFormat:["KES 0,000.00",",","."]},
		{type: "input", value: gratuityComments, name: "gratuityComments", hidden: true, readonly: true},
                {type: "input", value: terminationComments, name: "terminationComments", hidden: true, readonly: true},
                {type: "input", value: empType, name: "empType", hidden: true, readonly: true},
                {type: "input", value: terminationReason, name: "terminationReason", hidden: true, readonly: true},
                {type: "input", value: terminationDate, name: "terminationDate", hidden: true, readonly: true},
                {type: "newcolumn"},
		{type: "input", label: "NET PAY DUE", value: "", name: "netPayDue", labelAlign: "right", labelWidth: "100", labelLeft: "5", readonly: true, inputWidth: "80", offsetLeft: "392", numberFormat:["KES 0,000.00",",","."]}
	]},       
	{type: "label", label: "Print, complete and have the employee sign a termination form for our records.", value: "", name: "processDescription"},
	{type: "button", value: "Submit Termination", name: "submit", offsetLeft: "600"}
    ];    
    fteTerminationPayslipForm = myLayout.cells("b").attachForm(fteTerminationPayslipFormData);
    fteTerminationPayslipForm.load("functions/load_emp_termination_data_xml.php?empOid="+empOid+"&generatePayslip="+"1&tDate="+terminationDate+"&empType="+empType+"&gratuityAmt="+gratuityAmt, function(loader, response){});   
    attachFteTerminationFormEvents(empOid,empType);
}

function loadCasualTerminationPayslipForm(empOid,empType,terminationDate,gratuityAmt){
    console.log('Loading casuals termination paylip');
    myLayout.cells("b").setText('CASUAL EMPLOYEE TERMINATION PAYSLIP');
    casualTerminationPayslipFormData = [
	{type: "fieldset", label: "Pending Income", inputWidth: "auto", width: 850, blockOffset: 20, offsetLeft: "5", list: [
		{type: "settings", position: "label-left", labelWidth: 80, inputWidth: 130},
		{type: "input", label: "Daily Pay", name: "dailyRate", labelAlign: "right", labelWidth: "70", labelLeft: "2", readonly: true, inputWidth: "80", offsetLeft: "5", numberFormat:["0,000.00",",","."]},
		{type: "input", label: "Hourly Rate", value: "", labelAlign: "right", name: "hourlyRate", labelWidth: "70", labelLeft: "5", readonly: true, inputWidth: "80", offsetLeft: "5", numberFormat:["0,000.00",",","."]},
		{type: "newcolumn"},
		{type: "input", label: "Tea Weight", value: "", labelAlign: "right", name: "totalTeaWeight", labelWidth: "80", labelLeft: "2", inputWidth: "40", readonly: true, offsetLeft: "5"},
		{type: "input", label: "Tea Pay Rate", value: "", labelAlign: "right", name: "teaPayRate", labelWidth: "80", labelLeft: "2", readonly: true, inputWidth: "80", offsetLeft: "5", numberFormat:["0,000.00",",","."]},
		{type: "input", label: "Tea Pay", value: "", labelAlign: "right", name: "teaPay", labelWidth: "80", labelLeft: "2", readonly: true, inputWidth: "80", offsetLeft: "5", numberFormat:["0,000.00",",","."]},
		{type: "newcolumn"},
		{type: "input", label: "Parttime Hrs", value: "", labelAlign: "right", name: "totalParttimeHrs", labelWidth: "80", labelLeft: "2", readonly: true, inputWidth: "40", offsetLeft: "0"},
		{type: "input", label: "Parttime Pay", value: "", labelAlign: "right", name: "totParttimePay", labelWidth: "80", labelLeft: "2", readonly: true, inputWidth: "80", offsetLeft: "0", numberFormat:["0,000.00",",","."]},
		{type: "hidden", label: "New Input", value: "", name: "spacer1"},
		{type: "newcolumn"},
		{type: "input", label: "Other Work Hrs", value: "", labelAlign: "right", name: "otherHoursWorked", labelWidth: "90", labelLeft: "2", readonly: true, inputWidth: "40", offsetLeft: "5"},
		{type: "input", label: "Other Work Pay", value: "", labelAlign: "right", name: "otherworkPay", labelWidth: "90", labelLeft: "2", readonly: true, inputWidth: "80", offsetLeft: "5", numberFormat:["0,000.00",",","."]},
		{type: "newcolumn"},
		{type: "input", label: "GROSS INCOME", value: "", labelAlign: "right", name: "grossIncome", labelWidth: "110", readonly: true, inputWidth: "80", offsetLeft: "600", numberFormat:["KES 0,000.00",",","."]}
	]},
	{type: "fieldset", label: "Pending Deductions", inputWidth: "auto", width: 850, blockOffset: 20, offsetLeft: "5", list: [
		{type: "settings", position: "label-left", labelWidth: 80, inputWidth: 130},
		{type: "input", label: "Medical", name: "medicalDeduction", labelAlign: "right", labelWidth: "70", labelLeft: "2", readonly: true, inputWidth: "80", offsetLeft: "5", numberFormat:["0,000.00",",","."]},
		{type: "input", label: "NSSF", value: "", name: "NSSFdeduction", labelAlign: "right", labelWidth: "70", labelLeft: "2", readonly: true, inputWidth: "80", offsetLeft: "5", numberFormat:["0,000.00",",","."]},
		{type: "newcolumn"},
		{type: "input", label: "Elec", value: "", name: "elecDeduction", labelAlign: "right", labelWidth: "80", labelLeft: "2", inputWidth: "80", readonly: true, offsetLeft: "5", numberFormat:["0,000.00",",","."]},
		{type: "input", label: "Purchases", value: "", name: "purchasesDeduction", labelAlign: "right", labelWidth: "80", labelLeft: "2", readonly: true, inputWidth: "80", offsetLeft: "5", numberFormat:["0,000.00",",","."]},
		{type: "newcolumn"},
		{type: "input", label: "Other", value: "", name: "otherDeductions", labelAlign: "right", labelWidth: "60", labelLeft: "2", inputWidth: "80", readonly: true, offsetLeft: "5", numberFormat:["0,000.00",",","."]},
                {type: "newcolumn"},
		{type: "input", label: "TOTAL DEDUCTIONS", value: "", name: "totalDeductions", labelAlign: "right", labelWidth: "100", labelLeft: "2", readonly: true, inputWidth: "90", offsetLeft: "600", numberFormat:["KES 0,000.00",",","."]},
		{type: "input", value: "", name: "payslipOid", hidden: true, readonly: true}
	]},
	{type: "fieldset", label: "NET PAY", inputWidth: "auto", width: 850, blockOffset: 20, offsetLeft: "10", list: [
		{type: "settings", position: "label-left", labelWidth: 80, inputWidth: 130},
		{type: "input", label: "Gratuity", name: "gratuityAmt", value: "", labelAlign: "right", labelWidth: "80", labelLeft: "2", readonly: true, inputWidth: "80", offsetLeft: "5", numberFormat:["0,000.00",",","."]},
		{type: "input", value: gratuityComments, name: "gratuityComments", hidden: true, readonly: true},
                {type: "input", value: terminationComments, name: "terminationComments", hidden: true, readonly: true},
                {type: "input", value: empType, name: "empType", hidden: true, readonly: true},
                {type: "input", value: terminationReason, name: "terminationReason", hidden: true, readonly: true},
                {type: "input", value: terminationDate, name: "terminationDate", hidden: true, readonly: true},
                {type: "input", value: empOid, name: "terminationDate", hidden: true, readonly: true},
                {type: "newcolumn"},
		{type: "input", label: "NET PAY DUE", value: "", name: "netPayDue", labelAlign: "right", labelWidth: "100", labelLeft: "5", readonly: true, inputWidth: "90", offsetLeft: "430", numberFormat:["KES 0,000.00",",","."]}
	]},    
	{type: "label", label: "Print, complete and have the employee sign a termination form for our records.", value: "", name: "processDescription"},
	{type: "button", value: "Submit Termination", name: "submit", offsetLeft: "700"}
    ];    
    casualTerminationPayslipForm = myLayout.cells("b").attachForm(casualTerminationPayslipFormData);
    casualTerminationPayslipForm.load("functions/load_emp_termination_data_xml.php?empOid="+empOid+"&generatePayslip="+"1&tDate="+terminationDate+"&empType="+empType+"&gratuityAmt="+gratuityAmt, function(loader, response){});   
    attachCasualTerminationFormEvents(empOid,empType);    
}
function attachFteTerminationFormEvents(empOid,empType){
    fteTerminationPayslipForm.attachEvent("onButtonClick", function (id) {
        if (id == "submit") {
            console.log('submitted');
            if (terminationDateCalendarChanged) return requestPayslipGeneration();
            fteTerminationPayslipForm.send("functions/save_emp_termination_details.php", function (loader, response) {
                console.log(response);
                if (response == '') {
                    dhtmlx.message.position = "top";
                    dhtmlx.message("FTE Employee TERMINATED!!");
                    loadInitialLayout();
                } else {
                    dhtmlx.alert({
                        type: "alert-error",
                        text: "TERMINATION FAILED - REDO!! " + response,
                        title: "Error!",
                        ok: "OK"
                    });
                }
            });
        }
    });     
}

function attachCasualTerminationFormEvents(empOid,empType){
    casualTerminationPayslipForm.attachEvent("onButtonClick", function (id) {
        if (id == "submit") {
            console.log('submitted');
            if (terminationDateCalendarChanged) return requestPayslipGeneration();
            executeTermination(casualTerminationPayslipForm);
//            casualTerminationPayslipForm.send("functions/save_emp_termination_details.php", function (loader, response) {
//                console.log(response);
//                if (response == '') {
//                    dhtmlx.message.position = "top";
//                    dhtmlx.message("CASUAL Employee TERMINATED!!");
//                    loadInitialLayout();
//                } else {
//                    dhtmlx.alert({
//                        type: "alert-error",
//                        text: "TERMINATION FAILED - REDO!! " + response,
//                        title: "Error!",
//                        ok: "OK"
//                    });
//                }
//            });
        }
    });      
}

function executeTermination(theForm){
    theForm.send("functions/save_emp_termination_details.php", function (loader, response) {
        console.log(response);
        if (response == '') {
            dhtmlx.message.position = "top";
            dhtmlx.message("Employee TERMINATED!!");
            loadInitialLayout();
        } else {
            dhtmlx.alert({
                type: "alert-error",
                text: "TERMINATION FAILED - REDO!! <br>" + response,
                title: "Error!",
                ok: "OK"
            });
        }
    });    
}
function requestPayslipGeneration(){
    console.log("terminationDateCalendarChanged="+terminationDateCalendarChanged);
    dhtmlx.alert({
        type: "alert-error",
        text: "Termination date changed. Click on [GEnerate Payslip] before submitting.",
        title: "Error!",
        ok: "OK"
    }); 
    return false;
}

function employeePartTimeDataGrid() {
    myLayout.cells("a").setText('PART TIME WORK  |  <input id="box" type="text" value="" placeholder="Datepicker">  |  <input type="button" name="parttimeUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    setDatePickerDateToToday();

    myGrid = initMyGridNew("get_partTime_data_xml.php");

    myDataProcessor = initMydataProcessor("update_partTime_data.php", 0);
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(5, not_empty);
    myDataProcessor.setVerificator(6, not_empty);
    myDataProcessor.setVerificator(7, not_empty);
    myDataProcessor.init(myGrid);

    var myCalendar = new dhtmlXCalendarObject("box");
    myCalendar.setSensitiveRange("2016-12-23", new Date());
    myCalendar.attachEvent("onClick", function (d) {
        document.getElementById("box").value = get_currentDate_by_obj(d).date2;
        myGrid.clearAll();
        myGrid.load("functions/get_partTime_data_xml.php?date=" + get_currentDate_by_obj(d).date1, function () {  //loading data to the grid
            myGrid.forEachRow(function (id) {});

        });

    });
}

function otherWorkDataGrid() {
    myLayout.cells("a").setText('OTHER ASSIGNED WORK  (CASUALS ONLY)|  <input id="box" type="text" value="" placeholder="Datepicker">  |  <input type="button" name="otherWorkUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    setDatePickerDateToToday();

    myGrid = initMyGridNew("get_otherWork_data_xml.php");
    myGrid.attachHeader("&nbsp;,#combo_filter,&nbsp;,&nbsp;,#combo_filter,&nbsp;");

    initMyCalendar("get_otherWork_data_xml.php");

    myDataProcessor = initMydataProcessor("update_otherWork_xml.php", 0);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(5, not_empty);
    myDataProcessor.setVerificator(6, not_empty);
    myDataProcessor.setVerificator(7, not_empty);
    myDataProcessor.init(myGrid);
}

function employeeSalaryGrid() {
    myLayout.cells("a").setText('SALARIES | <input type="button" name="some_name" value=" Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    myGrid = initMyGridLight();
    myGrid.load("functions/get_salary_data_xml.php");
    getDataXmlFile = "get_salary_data_xml.php";
    myGrid.init();
    myGrid.attachHeader("#combo_filter,&nbsp;,#combo_filter,&nbsp;,#rspan,&nbsp;,#rspan,&nbsp;");

    var myCalendar = new dhtmlXCalendarObject("box");
    myCalendar.setSensitiveRange("2017-01-01", new Date());

    myGrid.attachEvent("onDhxCalendarCreated", function (mycalendar) {
        var currentdate = new Date();
        myCalendar.setSensitiveRange("2017-01-01", new Date());
    });

    myGrid.attachEvent("onEditCell", function (stage, rId, cInd, nValue, oValue) {
        if (stage == 2) {
            if (cInd == 6) {
                console.log(stage);
                console.log(rId);
                console.log(cInd);
                console.log(nValue);
                console.log(oValue);
                if (nValue != oValue) {
                    console.log("value missmatch");
                    myGrid.cells(rId, 9).setValue("1");
                }
            }
        }
        return true;
    });

    myCalendar.attachEvent("onClick", function (d) {
        document.getElementById("box").value = get_currentDate_by_obj(d).date2;

        myGrid.clearAll();
        myGrid.load("functions/get_salary_data_xml.php?date=" + get_currentDate_by_obj(d).date1, function () {  //loading data to the grid
            myGrid.forEachRow(function (id) {
                console.log("salaryGrid: id=", id);
                var d1 = new Date();
                var d2 = new Date(d);
                if (d1 < d2) {
                    myGrid.cells(id, 3).setDisabled(true);
                } else {
                    myGrid.cells(id, 3).setDisabled(false);
                }
            });
        });

    });

    myDataProcessor = initMydataProcessor("update_salary_data.php", 0);
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(4, not_empty);
    myDataProcessor.setVerificator(5, not_empty);
    myDataProcessor.setVerificator(6, not_empty);
    myDataProcessor.enableDebug(true);
    myDataProcessor.init(myGrid);
}

function employeeOtherDeductionsGrid(){
    myLayout.cells("a").setText('OTHER DEDUCTIONS | <input type="button" name="addNewEmployeeDeductionBtn" value="Enter New Deduction" onclick="addNewEmployeeDeduction();">  |  <input type="button" name="employeeDeductionUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    myGrid = initMyGridNew("get_emp_deduction_data_xml.php");

    myDataProcessor = initMydataProcessor("update_emp_deduction_data.php", 0);
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(2, greaterThan100);    
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(4, not_empty); 
    myDataProcessor.init(myGrid);    
}

function fteLoanGrid() {
    myLayout.cells("a").setText('EMPLOYEE LOANS (FTE) | <input type="button" name="addNewEmployeeLoanBtn" value=" Enter New Loan " onclick="addNewEmployeeLoan();">  |  <input type="button" name="employeeLoanUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    myGrid = initMyGridNew("get_employeeLoan_data_xml.php");

    myDataProcessor = initMydataProcessor("update_employeeLoan_data.php", 0);
    aDataProcessor.defineAction("loanAdded", updateSucessMsgPopup);
    myDataProcessor.init(myGrid);
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(3, greaterThan1000);
    myDataProcessor.setVerificator(4, not_empty);   
    myDataProcessor.setVerificator(6, not_empty);
    myDataProcessor.setVerificator(7, not_empty);
    myDataProcessor.setVerificator(7, greaterThan100);
}

function makeOfflineLoanPmtForm(loanPmtOid, loanOid, loanNbr, installmentAmt, currentBalance){
    formData = [
                    {type: "settings", position: "label-left", labelWidth: 100, inputWidth: 120},
                    {type: "block", inputWidth: "auto", offsetTop: 12, list: [
                        {type: "input", label: "Loan Nbr:", name: "loanNbr", value: loanNbr, labelWidth: 150, labelAlign: "right", readonly: true}, 
                        {type: "input", label: "Current Loan Balance:", name: "currentLoanBal", value: currentBalance, labelWidth: 150, labelAlign: "right", readonly: true},
                        {type: "input", label: "Installment Amount Due:",  name: "installmentAmtDue", value: installmentAmt, labelWidth: 150, labelAlign: "right", readonly: true},
                        {type: "input", label: "Amount Recieved",  name: "amountPaid", value: "0.0", labelWidth: 150, labelAlign: "right", required: true},
                        {type: "button", value: "Make Payment", name: "submit", offsetLeft: 70, offsetTop: 14},
                        {type: "input", value: loanPmtOid, name: "loanPmtOid", readonly: true, hidden: true, required: true},
                        {type: "input", value: "OFFLINE", name: "paymentType", readonly: true, hidden: true, required: true},                        
                        {type: "input", value: loanOid, name: "loanOid", readonly: true, hidden: true, required: true}
                    ]}
                ];
    myForm = myLayout.cells("a").attachForm(formData);
    myForm.attachEvent("onButtonClick", function(id){
        if (id == "submit") {
            console.log('currentBalance = '+currentBalance);
            myForm.send("functions/save_offline_loan_pmt.php", function(loader, response){
                console.log('response = '+response);
                if(response == ''){
                    dhtmlx.message.position = "top";
                    dhtmlx.message("OFFLINE loan payment accepted...");
                    loadView('1C');
                    loadEditEmployeeGrid();
                } 
                else {
                    dhtmlx.alert({
                        type: "alert-error",
                        text: "OFFLINE LOAN PAYMENT FAILED - "+response,
                        title: "Error!",
                        ok: "OK"
                    });                    
                }
            });
        }
    });    
}

function employeeOfflineLoanPmtsGrid(loanPmtOid) {
    console.log('loanPmtOid = ' + loanPmtOid);
    myLayout.cells("a").setText('OFFLINE EMPLOYEE LOAN PAYMENTS ');
    loadPageMenu(myLayout);
    myGrid = initMyGridNew("get_employeeLoan_pmts_xml.php?loanPmtOid=" + loanPmtOid);
}

function makePayslipLoanPmtForm(loanPmtOid, loanOid, loanNbr, installmentAmt, currentBalance, empType){
    formData = [
                    {type: "settings", position: "label-left", labelWidth: 100, inputWidth: 120},
                    {type: "block", inputWidth: "auto", offsetTop: 12, list: [
                        {type: "combo", label: "Select Payslip", labelWidth: "100", name: "payslipNbr", connector: "functions/get_payslip_nbrs_options.php?employeeType="+empType, labelAlign: "right", labelLeft: "5", required: true, readonly: true},		
                        {type: "input", label: "Loan Nbr:", name: "loanNbr", value: loanNbr, labelWidth: 150, labelAlign: "right", readonly: true}, 
                        {type: "input", label: "Current Loan Balance:", name: "currentLoanBal", value: currentBalance, labelWidth: 150, labelAlign: "right", readonly: true},
                        {type: "input", label: "Installment Amount Due:",  name: "amountPaid", value: installmentAmt, labelWidth: 150, labelAlign: "right", readonly: true},
                        {type: "button", value: "Make Payment", name: "submit", offsetLeft: 70, offsetTop: 14},
                        {type: "input", value: "PAYSLIP", name: "paymentType", readonly: true, hidden: true, required: true},
                        {type: "input", value: loanPmtOid, name: "loanPmtOid", readonly: true, hidden: true, required: true},
                        {type: "input", value: loanOid, name: "loanOid", readonly: true, hidden: true, required: true}
                    ]}
                ];
    myForm = myLayout.cells("a").attachForm(formData);
    myForm.attachEvent("onButtonClick", function(id){
        if (id == "submit") {
            console.log('currentBalance = '+currentBalance);
            myForm.send("functions/save_offline_loan_pmt.php", function(loader, response){
                console.log('response = '+response);
                if(response == ''){
                    dhtmlx.message.position = "top";
                    dhtmlx.message("PAYSLIP loan payment accepted...");
                    loadView('1C');
                    loadEditEmployeeGrid();
                } 
                else {
                    dhtmlx.alert({
                        type: "alert-error",
                        text: "PAYSLIP LOAN PAYMENT FAILED - "+response,
                        title: "Error!",
                        ok: "OK"
                    });                    
                }
            });
        }
    }); 
}

function employeeLoanPmtsScheduleGrid() {
    myLayout.cells("a").setText('EMPLOYEE LOAN PAYMENTS SCHEDULE ');
    loadPageMenu(myLayout);
    myGrid = initMyGridNew("get_employeeLoan_pmts_schedule_xml.php");
    myGrid.attachHeader("#combo_filter,#combo_filter,#combo_filter,&nbsp;,&nbsp;,&nbsp;,&nbsp;");
}

function employeePurchaseGrid() {
    myLayout.cells("a").setText('EMPLOYEE PURCHASES  (Must be paid off at every pay cycle)| <input id="box" type="text" value="" placeholder="Datepicker"> | <input type="button" name="addEmployeePurchaseBtn" value=" Enter New Purchase " onclick="addNewEmployeePurchase();">  |  <input type="button" name="employeePurchaseUdptBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);

    setDatePickerDateToToday();

    myGrid = initMyGridNew("get_employeePurchases_data_xml.php?payingForPurchase=0");

    initMyCalendar("get_employeePurchases_data_xml.php");

    myDataProcessor = initMydataProcessor("update_employeePurchases_data_xml.php", 0);
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(4, not_empty);
    myDataProcessor.setVerificator(5, not_empty);
    myDataProcessor.attachEvent("onBeforeDataSending", function(row_id, state, data){
        console.log('row_id = '+row_id);
        
        paidFlg = myGrid.cellById(row_id, 8).getValue();
        
        console.log('paidFlg = '+paidFlg); 
        
        if (paidFlg == 1){
            dhtmlx.alert({
                type: "alert-error",
                text: "You cannot update this purchase - already paid for!",
                title: "Error!",
                ok: "OK"
            });
            return false;
        }   
        return true;
    });    
    myDataProcessor.init(myGrid);
}
function validatePurchaseUpdts(){
    
    myDataProcessor.sendData();
}
function salaryExpenseAllocationGrid(employeeType) {
    myLayout.cells("a").setText(employeeType + ' SALARY EXPENSE ALLOCATION  | <input type="button" name="addNewSalaryAllocationBtn" value=" Enter New Allocation " onclick="addNewSalaryAllocation();">  |  <input type="button" name="salaryAllocationUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    setDatePickerDateToToday();

    myGrid = initMyGridNew("get_salaryExpenseAllocation_data_xml.php?employeeType=" + employeeType);

    myDataProcessor = initMydataProcessor("update_salaryExpenseAllocation_data.php?employeeType=" + employeeType, 0);
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(3, greaterThanZero); 
    myDataProcessor.setVerificator(4, not_empty);   
    myDataProcessor.init(myGrid);
}

function employeeResidencyGrid(){
    myLayout.cells("a").setText('RESIDENCY REGISTER  |  <input type="button" name="addNewEmployeeResidencyBtn" value=" Enter New " onclick="addNewEmployeeResidency();">   |  <input type="button" name="employeeResidencyUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
//    myGrid = initMyGridNew("get_emp_residency_data_xml.php");

    getDataXmlFile = "get_emp_residency_data_xml.php";
    myGrid = myLayout.cells("a").attachGrid('gridbox');
    myGrid.setImagePath("codebase/imgs/");
    myGrid.setDateFormat("%M.%d.%Y");
    myGrid.enableAutoWidth(true);
    myGrid.enableEditEvents(true, false, true);
    myGrid.init();
    myGrid.enableSmartRendering(true, 50);
    myGrid.load("functions/" + getDataXmlFile);
    
    myDataProcessor = initMydataProcessor("update_emp_residency_data.php", 0);
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);  
    myDataProcessor.setVerificator(3, not_empty); 
    myDataProcessor.setVerificator(3, greaterThanZero); 
    myDataProcessor.init(myGrid);
}

function loadAttendanceGrid() {
    myLayout.cells("a").setText('ATTENDANCE REGISTER | <input id="box" type="text" value="">');
    loadPageMenu(myLayout);
    myGrid = initMyGridNew("get_attendance_data_xml.php");

    myDataProcessor = initMydataProcessor("update_attendance_data.php", 1);
    myDataProcessor.init(myGrid);

    var myCalendar = new dhtmlXCalendarObject("box");

    myCalendar.setSensitiveRange("2016-12-22", new Date());
    myCalendar.attachEvent("onClick", function (d) {
        document.getElementById("box").value = get_currentDate_by_obj(d).date2;
        myGrid.clearAll();
        myGrid.load("functions/get_attendance_data_xml.php?date=" + get_currentDate_by_obj(d).date1, function () {
            myGrid.forEachRow(function (id) {});
        });
    });

    myCalendar.attachEvent("onHide", function (d) {});
}

function customerSetupGrid() {
    myLayout.cells("a").setText('CUSTOMER LIST |   <input type="button" name="addNewCustomerBtn" value=" Enter New " onclick="addCustomerNew();">   |  <input type="button" name="customerSetupUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    myGrid = initMyGridNew("get_customer_data_xml.php");

    myDataProcessor = initMydataProcessor("update_customer_data.php", 0)
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(4, not_empty);
    myDataProcessor.setVerificator(5, not_empty);

    myDataProcessor.init(myGrid);
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// START: MUSHROOM RELATED GRIDS
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function mushroomProductionGrid() {
    myLayout.cells("a").setText('MUSHROOM PRODUCTION  |  <input id="box" type="text" value="" placeholder="Datepicker"> | <input type="button" name="addMushroomProdBtn" value=" Add New" onclick="addMushroomProdNew();">   |  <input type="button" name="mushroomProductionUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    setDatePickerDateToToday();
    myGrid = initMyGridNew("get_mushroom_prod_data_xml.php");

    var myCalendar = new dhtmlXCalendarObject("box");
    myCalendar.setSensitiveRange("2017-01-01", new Date());
    myCalendar.attachEvent("onClick", function (d) {
        document.getElementById("box").value = get_currentDate_by_obj(d).date2;
        myGrid.clearAll();
        myGrid.load("functions/get_mushroom_prod_data_xml.php?date=" + get_currentDate_by_obj(d).date1, function () {});

    });
    myCalendar.attachEvent("onHide", function (d) {});

    myDataProcessor = initMydataProcessor("update_mushroom_prod_data.php", 0);
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(1, greaterThanZero);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(2, greaterThanZero);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(3, greaterThanZero);

    myDataProcessor.init(myGrid);
}

function mushroomSalesGrid() {
    myLayout.cells("a").setText('MUSHROOM SALES  |  <input id="box" type="text" value="" placeholder="Datepicker">  | <input type="button" name="addNewMushroomSaleBtn" value=" Enter New " onClick="addNewMushroomSale();"> | <input type="button" name="fishSalesUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    setDatePickerDateToToday();
    myGrid = initMyGridNew("get_mushroom_sales_data_xml.php");

    var myCalendar = new dhtmlXCalendarObject("box");
    myCalendar.setSensitiveRange("2017-01-01", new Date());
    myCalendar.attachEvent("onClick", function (d) {
        document.getElementById("box").value = get_currentDate_by_obj(d).date2;
        myGrid.clearAll();
        myGrid.load("functions/get_mushroom_sales_data_xml.php?date=" + get_currentDate_by_obj(d).date1, function () {  //loading data to the grid
            myGrid.forEachRow(function (id) {});
        });

    });
    myCalendar.attachEvent("onHide", function (d) {});

    myDataProcessor = initMydataProcessor("update_mushroom_sales_data.php", 0);
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(2, greaterThanZero);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(3, greaterThanZero);
    myDataProcessor.init(myGrid);
}

function setMonthPicker() {}

function fishSalesGrid() {
    myLayout.cells("a").setText('FISH SALES  | <input id="box" type="text" value="" placeholder="Datepicker">  | <input type="button" name="addNewFishSaleBtn" value=" Add New " onclick="addNewFishSale();"> | <input type="button" name="fishSalesUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    myGrid = initMyGridNew("get_fish_sales_data_xml.php");
    setDatePickerDateToToday();
    var myCalendar = new dhtmlXCalendarObject("box");
    myCalendar.setSensitiveRange("2017-01-01", new Date());
    myCalendar.attachEvent("onClick", function (d) {
        document.getElementById("box").value = get_currentDate_by_obj(d).date2;
        myGrid.clearAll();
        myGrid.load("functions/get_fish_sales_data_xml.php?date=" + get_currentDate_by_obj(d).date1, function () {  //loading data to the grid
            myGrid.forEachRow(function (id) {});
        });
    });
//    myCalendar.attachEvent("onHide", function (d) {});

    myDataProcessor = initMydataProcessor("update_fish_sales_data.php", 0);
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(3, greaterThanZero);
    myDataProcessor.setVerificator(4, not_empty);
    myDataProcessor.setVerificator(4, greaterThanZero);
    myDataProcessor.init(myGrid);
}

function horticultureSalesGrid() {
    myLayout.cells("a").setText('HORTICULTURE SALES  | <input id="box" type="text" value="" placeholder="Datepicker"> |  <input type="button" name="addNewHorticultureBtn" value=" Add New " onclick="addNewHorticultureSale();"> | <input type="button" name="horticultureSalesUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    setDatePickerDateToToday();
    myGrid = initMyGridNew("get_hort_sales_data_xml.php");

    var myCalendar = new dhtmlXCalendarObject("box");
    myCalendar.setSensitiveRange("2017-01-01", new Date());
    myCalendar.attachEvent("onClick", function (d) {
        document.getElementById("box").value = get_currentDate_by_obj(d).date2;
        myGrid.clearAll();
        myGrid.load("functions/get_hort_sales_data_xml.php?date=" + get_currentDate_by_obj(d).date1, function () {
            myGrid.forEachRow(function (id) {});
        });
    });
    myCalendar.attachEvent("onHide", function (d) {});

    myDataProcessor = initMydataProcessor("update_hort_sales_data.php", 0);
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(4, not_empty);
    myDataProcessor.setVerificator(4, greaterThanZero);
    myDataProcessor.setVerificator(5, not_empty);
    myDataProcessor.setVerificator(6, not_empty);
    myDataProcessor.setVerificator(6, greaterThanZero);
    myDataProcessor.init(myGrid);
}


function EmployeeTypeGrid() {
    myLayout.cells("a").setText('EMPLOYEE TYPES');
    loadPageMenu(myLayout);
    myGrid = myLayout.cells("a").attachGrid('gridbox');
    myGrid.setImagePath("codebase/imgs/");
    myGrid.load("functions/get_employee_type_xml.php");

    myGrid.setHeader("Employee Type");
    myGrid.setColTypes("ed");
    myGrid.setInitWidths("100");
    myGrid.setColAlign("center");
    myGrid.setDateFormat("%m/%d/%Y");

}
function SalaryTypeGrid() {
    myLayout.cells("a").setText('SALARY TYPES');
    loadPageMenu(myLayout);
    myGrid = myLayout.cells("a").attachGrid('gridbox');
    myGrid.setImagePath("codebase/imgs/");
    myGrid.load("functions/get_salary_type_xml.php");

    myGrid.setHeader("Employee Type");
    myGrid.setColTypes("ed");
    myGrid.setInitWidths("100");
    myGrid.setColAlign("center");
    myGrid.setDateFormat("%m/%d/%Y");

}
function FishTypeGrid() {
    myLayout.cells("a").setText('FISH TYPES');
    loadPageMenu(myLayout);
    myGrid = myLayout.cells("a").attachGrid('gridbox');
    myGrid.setImagePath("codebase/imgs/");
    myGrid.load("functions/get_fish_type_xml.php");

    myGrid.setHeader("Fish Type");
    myGrid.setColTypes("ed");
    myGrid.setInitWidths("100");
    myGrid.setColAlign("center");
    myGrid.setDateFormat("%m/%d/%Y");

}

function LineOfBusinessGrid() {
    myLayout.cells("a").setText('LINES of BUSINESS (DEPARTMENTS)');
    loadPageMenu(myLayout);
    myGrid = myLayout.cells("a").attachGrid('gridbox');
    myGrid.setImagePath("codebase/imgs/");
    myGrid.load("functions/get_lineofbusiness_xml.php");

    myGrid.setHeader("Line Of Business");
    myGrid.setColTypes("ed");
    myGrid.setInitWidths("100");
    myGrid.setColAlign("center");
    myGrid.setDateFormat("%m/%d/%Y");

}
function OpsMonthGrid() {
    myLayout.cells("a").setText('OPERATIONS MONTHS');
    loadPageMenu(myLayout);
    myGrid = myLayout.cells("a").attachGrid('gridbox');
    myGrid.setImagePath("codebase/imgs/");
    myGrid.load("functions/get_opsmonth_xml.php");

    myGrid.setHeader("Month");
    myGrid.setColTypes("ed");
    myGrid.setInitWidths("100");
    myGrid.setColAlign("center");
    myGrid.setDateFormat("%m/%d/%Y");

}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	BEGIN: TEA GRIDS
//
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function teaPickingGrid() {
    myLayout.cells("a").setText('TEA PICKING  |<input id="box" type="text" value="" placeholder="Datepicker"> | <input type="button" name="teaPickingUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    setDatePickerDateToToday();
    myGrid = initMyGridNew("get_teapickinggrid_data_xml.php");

    myDataProcessor = initMydataProcessor("update_teapickinggrid_data.php", 0);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.init(myGrid);

    var myCalendar = new dhtmlXCalendarObject("box");
    myCalendar.setSensitiveRange("2016-12-23", new Date());
    myCalendar.attachEvent("onClick", function (d) {
        document.getElementById("box").value = get_currentDate_by_obj(d).date2;
        myGrid.clearAll();
        myGrid.load("functions/get_teapickinggrid_data_xml.php?date=" + get_currentDate_by_obj(d).date1, function () {
            myGrid.forEachRow(function (id) {});
        });

    });
    myCalendar.attachEvent("onHide", function (d) {});
}

function teaBonusGrid() {
    myLayout.cells("a").setText('TEA BONUS  |  <input type="button" name="addNewExpenseBtn" value="Enter New" onclick="addNewTeaBonus();">  |  <input type="button" name="teaPickingBonusUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    myGrid = initMyGridNew("get_teabonusgrid_data_xml.php");
    myDataProcessor = initMydataProcessor("update_teabonusgrid_data.php", 0);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(1, greaterThanZero);
    myDataProcessor.init(myGrid);
}

function teaFactoryPurchaseGrid() {
    myLayout.cells("a").setText('TEA FACTORY PURCHASES | <input type="button" name="addteaFactoryPurchaseBtn" value="New Purchase" onclick="addNewteaFactoryPurchase();">  | <input type="button" name="teaFactoryPurchaseUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    xmlFile = "get_teafactorypurchases_data_xml.php";
    myGrid = initMyGridNew(xmlFile);
    myDataProcessor = initMydataProcessor("update_teafactorypurchases_data.php", 0);
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(2, greaterThanZero);
    myDataProcessor.setVerificator(4, not_empty);
    myDataProcessor.setVerificator(4, greaterThanZero);
    myDataProcessor.init(myGrid);
}

function teaPruningGrid() {
    myLayout.cells("a").setText('TEA PRUNING  |  <input id="box" type="text" value="" placeholder="Datepicker"> | <input type="button" name="addNewTeaPruningBtn" value=" Enter New Pruning " onclick="addNewTeaPruning();">  |  <input type="button" name="teaPruningUpdtBtn" value=" Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    setDatePickerDateToToday();

    myGrid = initMyGridNew("get_teaPruning_data_xml.php");

    myGridCalendar = new dhtmlXCalendarObject("box");
    myGridCalendar.setSensitiveRange("2017-01-01", new Date());
    myGridCalendar.attachEvent("onClick", function (d) {
        document.getElementById("box").value = get_currentDate_by_obj(d).date2;
        myGrid.clearAll();
        myGrid.load("functions/get_teaPruning_data_xml.php?date=" + get_currentDate_by_obj(d).date1, function () {  //loading data to the grid
            myGrid.forEachRow(function (id) {});
        });
    });
    myGridCalendar.attachEvent("onHide", function (d) {});

    myDataProcessor = new dataProcessor("functions/update_teaPruning.php");
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(4, not_empty);

    myDataProcessor.attachEvent("onRowMark", function (id) {
        if (this.is_invalid(id) == "invalid")
            return false;
        return true;
    });

    myDataProcessor.setTransactionMode("GET", false);
    myDataProcessor.setUpdateMode("off");
    myDataProcessor.init(myGrid);
}

function teaPickingRateGrid() {
    myLayout.cells("a").setText('TEA PICKING PAY RATES  | <input type="button" name="addNewTeaPickingBtn" value="Enter New Rate" onclick="addNewTeaPickingRate();">   |  <input type="button" name="teaPickingUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);

    myGrid = initMyGridNew("get_teapickingrate_data_xml.php");

    myDataProcessor = initMydataProcessor("update_teapickingrate_data.php", 0);
    myDataProcessor.init(myGrid);
}

function teaBlocksGrid() {
    myLayout.cells("a").setText('TEA BLOCKS');
    loadPageMenu(myLayout);

    myGrid = initMyGridNew("get_teablock_data_xml.php");

    myDataProcessor = initMydataProcessor("update_teablock_data.php", 1);
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(4, not_empty);
    myDataProcessor.setVerificator(5, not_empty);
    myDataProcessor.init(myGrid);
}

function teaPruningRateGrid() {
    myLayout.cells("a").setText('TEA PRUNING PAY RATES  | <input type="button" name="addNewTeaPruningBtn" value="Enter New Rate" onclick="addNewTeaPruningRate();">   |  <input type="button" name="teaPruningUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);

    myGrid = initMyGridNew("get_teapruningrate_data_xml.php");

    myDataProcessor = initMydataProcessor("update_teapruningrate_data.php", 0);
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(0, greaterThanZero);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.init(myGrid);
}

function teaFactoryRateGrid() {
    myLayout.cells("a").setText('TEA FACTORY RATES  | <input type="button" name="addNewFactoryRateBtn" value="Add New Rate" onclick="addNewFactoryRate();">  |  <input type="button" name="factoryRateUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    setDatePickerDateToToday();
    myGrid = initMyGridNew("get_teaFactoryRate_data_xml.php");

    myDataProcessor = initMydataProcessor("update_teaFactoryRate_data.php", 0);
    myDataProcessor.setVerificator(0, greaterThanZero);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.init(myGrid);

}

function teaFactoryDeliveryForm(){
    formData = [
	{type: "fieldset", label: "", inputWidth: "auto", width: 1050, blockOffset: 10, offsetLeft: "5", list: [
                {type: "settings", position: "label-left", labelWidth: 120, inputWidth: 120},
                {type: "input", label: "TICKET NO.", labelWidth: "80", value: "", name: "ticketNbr", required: true, labelAlign: "right", validate: "ValidInteger"},                
                {type: "combo", label: "Vehicle NO.", labelWidth: "80", name: "vehicleOid", connector: "functions/get_vehicleNbr_options.php", labelAlign: "right", labelLeft: "5", required: true, readonly: true},		
                {type: "newcolumn"},
                {type: "input", label: "CONSEC_1", value: "", name: "consecNbr1", required: true, labelAlign: "right", validate: "ValidInteger"},
                {type: "input", label: "CONSEC_2", value: "", name: "consecNbr2", required: true, labelAlign: "right", validate: "ValidInteger"},
                {type: "newcolumn"},
                {type: "calendar", name: "entryDateTm", label: "ENTRY DateTime", value: get_currentDatetimeStr(), dateFormat: "%Y-%m-%d %H:%i", enableTime: true, required: true, calendarPosition: "right", labelAlign: "right"},
                {type: "calendar", name: "exitDateTm", label: "EXIT DateTime", value: get_currentDatetimeStr(), dateFormat: "%Y-%m-%d %H:%i", enableTime: true, required: true, calendarPosition: "right", labelAlign: "right"},
                {type: "newcolumn"},
                {type: "input", label: "1ST WEIGHT", value: "", name: "firstWght", required: true, validate: "ValidNumeric", tooltip: "weight on entry into factory", labelAlign: "right"},
                {type: "input", label: "2ND WIEGHT", value: "", name: "secondWght", tooltip: "weight on exit from factory", required: true, validate: "ValidNumeric", labelAlign: "right"},
                {type: "input", label: "DEL NO.", value: "", name: "delNo", required: true, labelAlign: "right", validate: "ValidInteger"},
                {type: "button", label: "", offsetLeft: "172", value: "Submit", name: "submit"}
	]}
    ];
    myLayout.cells("a").setText('TEA FACTORY DELIVERY SLIP');
    myForm = myLayout.cells("a").attachForm(formData);
    myForm.enableLiveValidation(true);
    
    myForm.attachEvent("onButtonClick", function(id){
        if (id == "submit") {
            myForm.send("functions/save_tea_factory_delivery.php", function(loader, response){
                console.log('response = '+response);
                if(response == ''){
                    dhtmlx.message.position = "top";
                    dhtmlx.message("Tea Factory delivery accepted...");
                    loadView('1C');
                    teaFactoryDeliveryGrid();
                } 
                else {
                    dhtmlx.alert({
                        type: "alert-error",
                        text: "Tea Factory delivery FAILED - "+response,
                        title: "Error!",
                        ok: "OK"
                    });                    
                }
            });
        }
    });
}
function teaFactoryDeliveryGrid() {
    myLayout.cells("a").setText('TEA FACTORY DELIVERIES  | <input id="box" type="text" value="" placeholder="Datepicker"> | <input type="button" name="addNewFactoryDeliveryBtn" value=" Enter New Delivery " onclick="teaFactoryDeliveryForm();">  |  <input type="button" name="factoryDeliveryUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    setDatePickerDateToToday();
    myGrid = initMyGridNew("get_factoryDelivery_data_xml.php");
    var myCalendar = new dhtmlXCalendarObject("box");
    myCalendar.setSensitiveRange("2016-12-23", new Date());
    myCalendar.attachEvent("onClick", function (d) {
        myGrid.clearAll();
        myGrid.load("functions/get_factoryDelivery_data_xml.php?date=" + myCalendar.getFormatedDate("%Y-%m-%d"), function () {});
    });
    myCalendar.attachEvent("onHide", function (d) {});

    myDataProcessor = initMydataProcessor("update_factoryDelivery_data.php", 0)
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(4, not_empty);
    myDataProcessor.setVerificator(4, greaterThanZero);
    myDataProcessor.setVerificator(4, not_empty);
    myDataProcessor.setVerificator(5, not_empty);
    myDataProcessor.setVerificator(6, not_empty);
    myDataProcessor.setVerificator(7, not_empty);
    myDataProcessor.setVerificator(7, greaterThanZero);
    myDataProcessor.setVerificator(10, not_empty);

    myDataProcessor.init(myGrid);
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	START: EXPENSEEXPENSE GRIDS
//
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function expenseCaptureGrid() {
    myLayout.cells("a").setText('GENERAL EXPENSES  |  <input id="box" type="text" value="" placeholder="Datepicker">  |  <input type="button" name="addNewExpenseBtn" value=" Enter New Expense " onclick="addNewExpense();">  |  <input type="button" name="expenseUpdtBtn" value=" Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    setDatePickerDateToToday();
    myGrid = initMyGridNew("get_expense_data_xml.php");

    var myCalendar = new dhtmlXCalendarObject("box");
    myCalendar.setSensitiveRange("2017-01-01", new Date());
    myCalendar.attachEvent("onClick", function (d) {
        document.getElementById("box").value = get_currentDate_by_obj(d).date2;

        myGrid.clearAll();
        myGrid.load("functions/get_expense_data_xml.php?date=" + get_currentDate_by_obj(d).date1, function () {  //loading data to the grid
            myGrid.forEachRow(function (id) {});
        });

    });
    myDataProcessor = initMydataProcessor("update_expense_data.php", 0);
    myDataProcessor.init(myGrid);
}  

function expenseActivityGrid() {
    myLayout.cells("a").setText('EXPENSE ACTIVITY');
    loadPageMenu(myLayout);
    myGrid = initMyGridNew("get_expenseactivity_data_xml.php");

    myDataProcessor = initMydataProcessor("update_expenseactivity_data.php", 0);
    myDataProcessor.init(myGrid);
}

function vehicleExpenseCaptureGrid() {
    myLayout.cells("a").setText('VEHICLE EXPENSES  | <input id="box" type="text" value="" placeholder="Datepicker"> | <input type="button" name="addNewVehicleExpenseBtn" value=" Enter New Expense " onclick="addNewVehicleExpense();">  |  <input type="button" name="vehicleExpenseUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    setDatePickerDateToToday();
    myGrid = initMyGridNew("get_vehicle_expense_data_xml.php");
    
    var myCalendar = new dhtmlXCalendarObject("box");
    myCalendar.setSensitiveRange("2017-01-01", new Date());
    myCalendar.attachEvent("onClick", function (d) {
        document.getElementById("box").value = get_currentDate_by_obj(d).date2;
        myGrid.clearAll();
        myGrid.load("functions/get_vehicle_expense_data_xml.php?date=" + get_currentDate_by_obj(d).date1, function () {  //loading data to the grid
            myGrid.forEachRow(function (id) {});
        });

    });
    myDataProcessor = initMydataProcessor("update_vehicle_expense_data.php", 0);
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(4, not_empty);
    myDataProcessor.setVerificator(4, greaterThanZero);  
    myDataProcessor.setVerificator(5, not_empty);
    myDataProcessor.init(myGrid);    
}

function hortProduceGrid(){
    
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//	HELPERS
//
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function setDatePickerDateToToday() {
    var getCurDateArr = get_currentDate_Arr();
    $('#box').val(monthNames[getCurDateArr.actualMonth] + " " + getCurDateArr.day + " " + getCurDateArr.year);
}

function setDatePickerDate() {
    var getCurDateArr = get_currentDate_Arr();
    $('#box').val(monthNames[getCurDateArr.actualMonth] + " " + getCurDateArr.day + " " + getCurDateArr.year);
}

function loadView(view) {
    myLayout.unload();
    myLayout = null;
                        
    myLayout = new dhtmlXLayoutObject({
        parent: "layoutObj",
        pattern: view
    });
}

function loadInitialLayout() {
    if (myLayout == null) {
        myLayout = new dhtmlXLayoutObject({
                    parent: "layoutObj",
                    pattern: '1C'
        });        
    }
    loadEditEmployeeGrid();
}

function loadPageMenu(aLayout) {
    myMenu = aLayout.attachMenu({
        icons_path: "dhtmlxMenu/common/imgs/",
        xml: "dhtmlxMenu/common/dhxmenu.xml"
    });
    myMenu.attachEvent("onClick", function (id, zoneId, cas) {
        console.log("id = "+id);
        switch (id){
            case "employee_master_roll":
                loadView('1C');
                loadEditEmployeeGrid();
                break; 
            case "employee_residency":
                loadView('1C');
                employeeResidencyGrid();
                break;         
            case "onboard_new_employee":
                loadView('1C');
                loadNewHireForm();
                break;
            case "attendance_mgmt":
                loadView('1C');
                loadAttendanceGrid();
                break; 
            case "parttime_mgmt":
                loadView('1C');
                employeePartTimeDataGrid();
                break; 
            case "other_work":
                loadView('1C');
                otherWorkDataGrid();
                break; 
            case "customer_new":
                loadView('1C');
                customerSetupGrid();
                break; 
            case "dairyProduction_mgmt":
                loadView('1C');
                dairyProductionGrid();
                break; 
            case "dairySales_mgmt":
                loadView('1C');
                dairySalesGrid();
                break; 
            case "dairyCorporative_mgmt":
                loadView('1C');
                dairyCoorporativeGrid();
                break;
            case "mushroomSales_mgmt":
                loadView('1C');
                mushroomSalesGrid();
                break; 
            case "mushroomProduction_mgmt":
                loadView('1C');
                mushroomProductionGrid();
                break; 
            case "fishSales_mgmt":
                loadView('1C');
                fishSalesGrid();
                break; 
            case "horticulture_mgmt":
                loadView('1C');
                horticultureSalesGrid();
                break; 
            case "salary_list":
                loadView('1C');
                employeeSalaryGrid();
                break; 
            case "employee_type":
                loadView('1C');
                EmployeeTypeGrid();
                break; 
            case "salary_type":
                loadView('1C');
                SalaryTypeGrid();
                break; 
            case "fish_type":
                loadView('1C');
                FishTypeGrid();
                break; 
            case "lineofbusiness":
                loadView('1C');
                LineOfBusinessGrid();
                break; 
            case "cowname":
                loadView('1C');
                DairyCowNameGrid();
                break; 
            case "opsmonth":
                loadView('1C');
                OpsMonthGrid();
                break; 
            case "teapickingrate":
                loadView('1C');
                teaPickingRateGrid();
                break; 
            case "teablock":
                loadView('1C');
                teaBlocksGrid();
                break; 
            case "teapruningrate":
                loadView('1C');
                teaPruningRateGrid();
                break; 
            case "teafactoryrate":
                loadView('1C');
                teaFactoryRateGrid();
                break; 
            case "expenseactivity":
                loadView('1C');
                expenseActivityGrid();
                break; 
            case "teaPicking_mgmt":
                loadView('1C');
                teaPickingGrid();
                break; 
            case "teaPruning_mgmt":
                loadView('1C');
                teaPruningGrid();
                break; 
            case "tea_bonus":
                loadView('1C');
                teaBonusGrid();
                break; 
            case "tea_factory_purchases":
                loadView('1C');
                teaFactoryPurchaseGrid();
                break; 
            case "expense_capture":
                loadView('1C');
                expenseCaptureGrid();
                break; 
            case "electricity_expense_capture":
                loadView('1C');
                elecExpenseCaptureGrid();
                break; 
            case "vehicle_expense_capture":
                loadView('1C');
                vehicleExpenseCaptureGrid();
                break; 
            case "elecExpenseAllocation":
                loadView('1C');
                elecExpenseAllocationGrid();
                break; 
            case "vehicleExpenseAllocation":
                loadView('1C');
                vehicleExpenseAllocationGrid();            
                break; 
            case "casuals_deductions":
                loadView('1C');
                employeeOtherDeductionsGrid();
                break;
            case "fte_loan":
                loadView('1C');
                fteLoanGrid();
                break;            
            case "make_loan_payments":
                loadView('1C');
                employeeOfflineLoanPmtsGrid(0);
                break; 
            case "loan_payments_schedule":
                loadView('1C');
                employeeLoanPmtsScheduleGrid();
                break; 
            case "factory_delivery":
                loadView('1C');
                teaFactoryDeliveryGrid();
                //teaFactoryDeliveryForm();
                break; 
            case "salary_expense_allocation":
                loadView('1C');
                salaryExpenseAllocationGrid('CASUALS');
                break; 
            case "employee_purchases":
                loadView('1C');
                employeePurchaseGrid();
                break; 
            case "other_dept_income":
                loadView('1C');
                otherDeptIncomeGrid();
                break;                 
            case "fish_PandL":
                loadView('1C');
                PandLincomeGrid('FISH');
                break; 
            case "tea_PandL":
                loadView('1C');
                PandLincomeGrid('TEA');
                break; 
            case "dairy_PandL":
                loadView('1C');
                PandLincomeGrid('DAIRY');
                break;    
            case "mushroom_PandL":
                loadView('1C');
                PandLincomeGrid('MUSHROOM');
                break;            
            case "hort_greenHse_PandL":
                loadView('1C');
                PandLincomeGrid('HORTICULTURE-GREENHOUSE');
                break; 
            case "hort_njogu_PandL":
                loadView('1C');
                PandLincomeGrid('HORTICULTURE-NJOGU');
                break; 
            case "hort_karanja_PandL":
                loadView('1C');
                PandLincomeGrid('HORTICULTURE-KARANJA');
                break; 
            case "hort_other_PandL":
                loadView('1C');
                PandLincomeGrid('HORTICULTURE');
                break; 
            case "attendance_rpt":
                loadView('2U');
                attendanceReportGrid();
                break;  
            case "roles_rpt":
                loadView('1C');
                rolesReportGrid();
                break;           
            case "tea_picked_rpt":
                loadView('2U');
                teaPickedReportGrid();
                break;//monthly_factory_statement
            case "monthly_factory_statement":
                loadView('2U');
                monthlyTeaDeliveryStatementReportGrid();
                break;                
            case "expense_by_dept":
                loadView('1C');
                expenseByDeptReportGrid();
                break;
            case "sales_by_cust":
                loadView('1C');
                salesByCustomerReportGrid();
                break;    
            case "sales_by_dept":
                loadView('1C');
                genericReportGrid("SALES_BY_DEPT");
                break;             
            case "hort_produce":
                loadView('1C');
                hortProduceParentGrid();
                break;                  
            case "hort_sellingUnits":
                loadView('1C');
                hortSellingUnitsGrid();
                break;
            case "hort_produce_details":
                loadView('1C');
                hortProduceDetailsGrid();
                break;
            case "hort_produce_brands":
                loadView('1C');
                hortProduceBrandsGrid();
                break; 
            case "version":
                versionPopup();
                break;             
            default:
                break;
        }
    });
}

function doOnLoad() {
    //layout1();
    loadInitialLayout();
}

function addNewPartTime(row_id, rowIndex) {
    var rowID = (new Date()).valueOf();
    console.log('row_id = ' + row_id);
    console.log('rowIndex = ' + rowIndex);
    startTm = myGrid.cellById(row_id, 2).getValue();
    hours = myGrid.cellById(row_id, 4).getValue();
    console.log('previous hours = ' + hours);
    if (hours === "0") {
        dhtmlx.alert({
            type: "alert-error",
            text: "Previous parttime hours = 0 - No need to add additional row",
            title: "Error!",
            ok: "OK"
        });
        return;
    }

    dateValue = myGrid.cellById(row_id, 0).getValue();
    employeeNameValue = myGrid.cellById(row_id, 1).getValue();
    startTm = myGrid.cellById(row_id, 3).getValue();
    employeeOid = myGrid.cellById(row_id, 10).getValue();
    attendanceOid = myGrid.cellById(row_id, 11).getValue();
    console.log('dateValue = ' + dateValue);
    console.log('employeeNameValue = ' + employeeNameValue);
    console.log('employeeOid = ' + employeeOid);
    console.log('attendanceOid = ' + attendanceOid);
    myGrid.addRow(rowID, [dateValue, employeeNameValue, '', '', '', 'Enter description of work done....', '', '', 'none', '', employeeOid, attendanceOid], rowIndex);
    myGrid.setRowColor(rowID, "ffff66");
}

function addNewOtherWork(row_id, rowIndex) {
    var rowID = (new Date()).valueOf();
    console.log('row_id = ' + row_id);
    console.log('rowIndex = ' + rowIndex);
    hours = myGrid.cellById(row_id, 4).getValue();
    console.log('previous hours = ' + hours);
    if (hours === "0") {
        dhtmlx.alert({
            type: "alert-error",
            text: "Previous Other Work Assigned hours = 0 - No need to add additional row",
            title: "Error!",
            ok: "OK"
        });
        return;
    }
    dateValue = myGrid.cellById(row_id, 0).getValue();
    employeeNameValue = myGrid.cellById(row_id, 1).getValue();
    attendanceOid = myGrid.cellById(row_id, 9).getValue();
    console.log('dateValue = ' + dateValue);
    console.log('employeeNameValue = ' + employeeNameValue);
    console.log('attendanceOid = ' + attendanceOid);
    myGrid.addRow(rowID, [dateValue, employeeNameValue, '', '', '', 'TBD', '', '', '', attendanceOid], rowIndex);
    myGrid.setRowColor(rowID, "ffff66");
}

function addNewTeaPickedBlock(row_id, rowIndex) {
    var rowID = (new Date()).valueOf();
    currentWeight = myGrid.cellById(row_id, 3).getValue();
    if (currentWeight < 1) {
        dhtmlx.alert({
            type: "alert-error",
            text: "You must enter weight in the current block before adding weight in another new block",
            title: "Error!",
            ok: "Close"
        });
        return;
    }
    console.log('row_id = ' + row_id);
    console.log('rowIndex = ' + rowIndex);
    dateValue = myGrid.cellById(row_id, 0).getValue();
    employeeNameValue = myGrid.cellById(row_id, 1).getValue();
    attendanceOid = myGrid.cellById(row_id, 5).getValue();
    console.log('dateValue = ' + dateValue);
    console.log('employeeNameValue = ' + employeeNameValue);
    console.log('attendanceOid = ' + attendanceOid);
    myGrid.addRow(rowID, [dateValue, employeeNameValue, '', '', '', attendanceOid], rowIndex);
    myGrid.setRowColor(rowID, "ffff66");
}

function terminateEmployeeBtn(row_id, rowIndex){
    console.log('empOid = ' + row_id);
    if (myGrid.cellById(row_id, 11).getValue() == 1) {
        dhtmlx.alert({
            type: "alert-error",
            text: "Selected employee already terminated",
            title: "Error!",
            ok: "Close"
        });
        return;
    }
    empType = myGrid.cellById(row_id, 13).getValue();
    loadTerminateEmployeeForm(row_id,empType);
}

function addNewMushroomSale() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '', '', 0.00, 0.00], 0);
    myGrid.setRowColor(rowID, "ffff66");
}
function addNewFactoryDelivery() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '1', ''], 0);
    myGrid.setRowColor(rowID, "ffff66");
}

function addNewSalaryAllocation() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '', '', '', ''], 0);
    myGrid.setRowColor(rowID, "ffff66");
}

function addNewEmployeeResidency(){
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '', '150.00'], 0);
    myGrid.setRowColor(rowID, "ffff66");   
}

function addNewEmployeePurchase() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '', '', 'PC', '', '', '0.00', '0.00'], 0);
    myGrid.setRowColor(rowID, "ffff66");
}

function addMushroomProdNew() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '', '', ''], 0);
    myGrid.setRowColor(rowID, "ffff66");
}

function addNewFishSale() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '', '', '', 0.00, 0.00], 0);
    myGrid.setRowColor(rowID, "ffff66");
}

function addNewHorticultureSale() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '', '', '', '', '', 0.00, 0.00], 0);
    myGrid.setRowColor(rowID, "ffff66");
}

function addEexpenseSalesNew() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '', '', '', '', ''], 0);
    myGrid.setRowColor(rowID, "ffff66");
}

function addDairyCoorpoNew() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '', '', '', '', '', '', '', '0.00', '0.00', '0.00'], 0);
    myGrid.setRowColor(rowID, "ffff66");

}

function addNewDairyProduction() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '', '', ''], 0);
    myGrid.setRowColor(rowID, "ffff66");
}

function addNewDairySales() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '', '', '0.00'], 0);
    myGrid.setRowColor(rowID, "ffff66");
}

function addNewExpense() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '', '', '', '', 0.0, ''], 0);
    myGrid.setRowColor(rowID, "ffff66");
}

function addNewVehicleExpense() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '', '', '', '0.0', ''], 0);
    myGrid.setRowColor(rowID, "ffff66");
}

function addNewEmployeeLoan() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '', '', 0.0, '', '', '', 0.0], 0);
    myGrid.setRowColor(rowID, "ffff66");
}
//
function addNewEmployeeDeduction() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '', 0.0, 'Personal loan', 0, ''], 0);
    myGrid.setRowColor(rowID, "ffff66");
}

function addCustomerNew() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '', '', '', ''], 0);
    myGrid.setRowColor(rowID, "ffff66");
}

function addNewTeaPickingRate() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, [0.0, get_currentDateStr(), ''], 0);
    myGrid.setRowColor(rowID, "ffff66");
}
function addNewTeaPruning() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, [myGridCalendar.getDate(true), '', '', '', ''], '');
    myGrid.setRowColor(rowID, "ffff66");
}
function addNewTeaPruningRate() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['0.0', '', ''], '');
    myGrid.setRowColor(rowID, "ffff66");
}
function addNewTeaBonus() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '0'], 0);
    myGrid.setRowColor(rowID, "ffff66");
}
function addNewteaFactoryPurchase() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '', '', '', '0.0', '0.0'], 0);
    myGrid.setRowColor(rowID, "ffff66");
}
function addNewFactoryRate() {
    console.log("Here");
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['0.0', '', ''], 0);
    myGrid.setRowColor(rowID, "ffff66");
}
function expenseactivityNew() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, [''], 0);
    myGrid.setRowColor(rowID, "ffff66");
}


function checkAll() {
    /*
     Checked row for pertucular cell and id
     */
    mygrid.setCheckedRows(3, 1);
}

function eXcell_myPrice(cell) { //the eXcell name is defined here
    if (cell) { 	// the default pattern
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
        eXcell_ed.call(this); //uses methods of the "ed" type
    }
    this.setValue = function (val) {
        var cVal = two_decimal(val);
        /* actual data processing */
        this.setCValue("<span class='kes_color'>KES </span><span>" + cVal + "</span>", cVal);
    }
    this.getValue = function () {       	/* getting the value */
        return this.cell.childNodes[1].innerHTML;
    }
}
/* nests all other methods from the base class */
eXcell_myPrice.prototype = new eXcell;
function two_decimal(num) {
    var num = parseFloat(num);
    var n = num.toFixed(2);
    return n;
}

function eXcell_kenyaCurrency(cell) { //the eXcell name is defined here
    if (cell) { 	// the default pattern
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
        eXcell_ed.call(this); //uses methods of the "ed" type
    }
    this.setValue = function (val) {
        var cVal = two_decimal(val);
        /* actual data processing */
        this.setCValue("<b><span class='kes_color'>KES </span></b><span>" + cVal + "</span>", cVal);
    }
    this.getValue = function () {       	/* getting the value */
        return this.cell.childNodes[1].innerHTML;
    }
}
eXcell_kenyaCurrency.prototype = new eXcell;

function eXcell_litres(cell) { //the eXcell name is defined here
    if (cell) { 	// the default pattern
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
        eXcell_ed.call(this); //uses methods of the "ed" type
    }
    this.setValue = function (val) {
        var cVal = one_decimal(val);
        /* actual data processing */
        this.setCValue("<span>" + cVal + "</span><b><span class='kes_color'> Litres</span></b>", cVal);
    }
    this.getValue = function () {       	/* getting the value */
        return this.cell.childNodes[1].innerHTML;
    }
}
eXcell_litres.prototype = new eXcell;

function eXcell_kgWeight(cell) { //the eXcell name is defined here
    if (cell) { 	// the default pattern
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
        eXcell_ed.call(this); //uses methods of the "ed" type
    }
    this.setValue = function (val) {
        var cVal = one_decimal(val);
        /* actual data processing */
        this.setCValue(cVal + "<b><span class='kes_color'> Kg</span></b><span></span>", cVal);
    }
    this.getValue = function () {       	/* getting the value */
        return this.cell.childNodes[1].innerHTML;
    }
}
eXcell_kgWeight.prototype = new eXcell;

function eXcell_addParttimeBtn(cell) {  // the eXcell name is defined here
    if (cell) {                  // the default pattern, just copy it
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
    }
    this.edit = function () {}   // read-only cell doesn't have edit method
    // the cell is read-only, so it's always in the disabled state
    this.isDisabled = function () {
        return true;
    }
    this.setValue = function (val) {
        var row_id = this.cell.parentNode.idd;     // gets the id of the related row
        var rowIndex = myGrid.getRowIndex(row_id);
        this.setCValue("<input type='button' value='+' onclick='addNewPartTime(" + row_id + "," + rowIndex + ")'>");
    }
}
eXcell_addParttimeBtn.prototype = new eXcell; // nests all other methods from the base class

function eXcell_addOtherWorkBtn(cell) {  // the eXcell name is defined here
    if (cell) {                  // the default pattern, just copy it
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
    }
    this.edit = function () {}   // read-only cell doesn't have edit method
    // the cell is read-only, so it's always in the disabled state
    this.isDisabled = function () {
        return true;
    }
    this.setValue = function (val) {
        var row_id = this.cell.parentNode.idd;     // gets the id of the related row
        var rowIndex = myGrid.getRowIndex(row_id);
        this.setCValue("<input type='button' value='+' onclick='addNewOtherWork(" + row_id + "," + rowIndex + ")'>");
    }
}
eXcell_addOtherWorkBtn.prototype = new eXcell; // nests all other methods from the base class

function eXcell_addTeaPickedBlockBtn(cell) {  // the eXcell name is defined here
    if (cell) {                  // the default pattern, just copy it
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
    }
    this.edit = function () {}   // read-only cell doesn't have edit method
    // the cell is read-only, so it's always in the disabled state
    this.isDisabled = function () {
        return true;
    }
    this.setValue = function (val) {
        var row_id = this.cell.parentNode.idd;     // gets the id of the related row
        var rowIndex = myGrid.getRowIndex(row_id);
        this.setCValue("<input type='button' value='+' onclick='addNewTeaPickedBlock(" + row_id + "," + rowIndex + ")'>");
    }
}
eXcell_addTeaPickedBlockBtn.prototype = new eXcell; // nests all other methods from the base class

function eXcell_makeOfflineLoanPmtBtn(cell) {  // the eXcell name is defined here
    if (cell) {                  // the default pattern, just copy it
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
    }
    this.edit = function () {}   // read-only cell doesn't have edit method
    // the cell is read-only, so it's always in the disabled state
    this.isDisabled = function () {
        return true;
    }
    this.setValue = function (val) {
        var row_id = this.cell.parentNode.idd;     // gets the id of the related row
        var rowIndex = myGrid.getRowIndex(row_id);
        this.setCValue("<input type='button' value='Make a Payment' onclick='makeOfflineLoanPmt(" + row_id + "," + rowIndex + ")'>");
    }
}
eXcell_makeOfflineLoanPmtBtn.prototype = new eXcell;

function makeOfflineLoanPmt(row_id, rowIndex) {
    console.log('row_id = ' + row_id);
    
    loanNbr = myGrid.cellById(row_id, 1).getValue();
    installmentAmt = myGrid.cellById(row_id, 2).getValue();
    currentBalance = myGrid.cellById(row_id, 3).getValue();
    paid = myGrid.cellById(row_id, 4).getValue();
    loanOid = myGrid.cellById(row_id, 8).getValue();
    empType = myGrid.cellById(row_id, 9).getValue();
    console.log('paid = ' + paid);
    if (paid == 1) {
        dhtmlx.alert({
            type: "alert-error",
            text: "Selected loan installment (payment) as already been made",
            title: "Error!",
            ok: "Close"
        });
        return;
    } else {
        console.log('row_id = ' + row_id);
        makeOfflineLoanPmtForm(row_id, loanOid, loanNbr, installmentAmt, currentBalance, empType);
    }
}

function eXcell_makePayslipLoanPmtBtn(cell) {  // the eXcell name is defined here
    if (cell) {                  // the default pattern, just copy it
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
    }
    this.edit = function () {}   // read-only cell doesn't have edit method
    // the cell is read-only, so it's always in the disabled state
    this.isDisabled = function () {
        return true;
    }
    this.setValue = function (val) {
        var row_id = this.cell.parentNode.idd;     // gets the id of the related row
        var rowIndex = myGrid.getRowIndex(row_id);
        this.setCValue("<input type='button' value='Make a Payment' onclick='makePayslipLoanPmt(" + row_id + "," + rowIndex + ")'>");
    }
}
eXcell_makePayslipLoanPmtBtn.prototype = new eXcell;

function makePayslipLoanPmt(row_id, rowIndex) {
    console.log('row_id = ' + row_id);
    
    loanNbr = myGrid.cellById(row_id, 1).getValue();
    installmentAmt = myGrid.cellById(row_id, 2).getValue();
    currentBalance = myGrid.cellById(row_id, 3).getValue();
    paid = myGrid.cellById(row_id, 4).getValue();
    loanOid = myGrid.cellById(row_id, 8).getValue();
    empType = myGrid.cellById(row_id, 9).getValue();
    console.log('paid = ' + paid);
    console.log('row_id = ' + row_id);
    makePayslipLoanPmtForm(row_id, loanOid, loanNbr, installmentAmt, currentBalance, empType);
}

function eXcell_terminateEmployeeBtn(cell) {  // the eXcell name is defined here
    if (cell) {                  // the default pattern, just copy it
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
    }
    this.edit = function () {}   // read-only cell doesn't have edit method
    // the cell is read-only, so it's always in the disabled state
    this.isDisabled = function () {
        return true;
    }
    this.setValue = function (val) {
        var row_id = this.cell.parentNode.idd;     // gets the id of the related row
        var rowIndex = myGrid.getRowIndex(row_id);
        this.setCValue("<input type='button' value='Terminate' onclick='terminateEmployeeBtn(" + row_id + "," + rowIndex + ")'>");
    }
}
eXcell_terminateEmployeeBtn.prototype = new eXcell;

function eXcell_lockTerminationPayslipBtn(cell) {  // the eXcell name is defined here
    if (cell) {                  // the default pattern, just copy it
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
    }
    this.edit = function () {}   // read-only cell doesn't have edit method
    // the cell is read-only, so it's always in the disabled state
    this.isDisabled = function () {
        return true;
    }
    this.setValue = function (val) {
        var row_id = this.cell.parentNode.idd;     // gets the id of the related row
        var rowIndex = myGrid.getRowIndex(row_id);
        this.setCValue("<input type='button' value='Lock Payslip' onclick='lockTerminationPayslip(" + row_id + "," + rowIndex + ")'>");
    }
}
eXcell_lockTerminationPayslipBtn.prototype = new eXcell;

function lockTerminationPayslip(row_id, rowIndex){
    console.log('row_id = ' + row_id);
    console.log('rowIndex = ' + rowIndex);
}

function eXcell_payForPurchasesBtn(cell) {  // the eXcell name is defined here
    if (cell) {                  // the default pattern, just copy it
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
    }
    this.edit = function () {}   // read-only cell doesn't have edit method
    // the cell is read-only, so it's always in the disabled state
    this.isDisabled = function () {
        return true;
    }
    this.setValue = function (val) {
        var row_id = this.cell.parentNode.idd;     // gets the id of the related row
        var rowIndex = myGrid.getRowIndex(row_id);
        this.setCValue("<input type='button' value='Pay with Payslip' onclick='payForPurchasesBtn(" + row_id + "," + rowIndex + ")'>");
    }
}
eXcell_payForPurchasesBtn.prototype = new eXcell;

function payForPurchasesBtn(row_id, rowIndex){
    paidFlg = myGrid.cellById(row_id, 10).getValue();
    console.log('paidFlg = ' + paidFlg);
    if (paidFlg == 1) {
        dhtmlx.alert({
            type: "alert-error",
            text: "Selected purchase already paid for.",
            title: "Error!",
            ok: "Close"
        });
        return;
    }
    empType = myGrid.cellById(row_id, 10).getValue();
    loadPayforPurchasesForm(row_id, empType);
}

function loadPayforPurchasesForm(row_id, empType){
    console.log('purchaseOid = '+row_id);
    console.log('empType = '+empType);
    loadView('1C');
    myLayout.cells("a").setText('EMPLOYEE TERMINATION');
    
    formData = [
	{type: "fieldset", label: "Purchase Payment", inputWidth: "auto", width: "auto", blockOffset: 10, offsetLeft: "10", list: [
		{type: "settings", position: "label-left", labelWidth: 50, inputWidth: 130},
		{type: "input", label: "Amount Due", value: "", labelWidth: "100", name: "amount", labelAlign: "right", required: true, readonly: true},
		{type: "combo", label: "Select Payslip", labelWidth: "100", name: "payslipNbr", connector: "functions/get_payslip_nbrs_options.php?employeeType="+empType, labelAlign: "right", labelLeft: "5", required: true, readonly: true},
		{type: "input", value: "", name: "purchaseOid", readonly: true, hidden: true, required: true}, 
                {type: "input", value: "", name: "empType", readonly: true, hidden: true, required: true}
	]},
	{type: "button", value: "Pay", name: "submit", offsetLeft: "10"}
    ];
    myForm = myLayout.cells("a").attachForm(formData);
    myForm.load("functions/get_employeePurchases_data_xml.php?payingForPurchase=1&oid="+row_id, function(){}); 
    myForm.attachEvent("onButtonClick", function(id){
        if (id == "submit") {
            console.log('submitted');
            myForm.send("functions/save_emp_purchase_pmt_details.php", function(loader, response){
                console.log(response);
                if(response == ''){
                    dhtmlx.message.position = "top";
                    dhtmlx.message("Payment Accepted.....");
                    loadInitialLayout();
                } 
                else {
                    dhtmlx.alert({
                        type: "alert-error",
                        text: "PAYMENT FAILED - REDO!!",
                        title: "Error!",
                        ok: "OK"
                    });                    
                }
            });
        }
    }); 
    loadPageMenu(myLayout);    
}

function dbDeleteRow(row_id, rowIndex){
    console.log('dbDeleteRow(() row_id = ' + row_id);
    myGrid.deleteRow(row_id);
    return;
}

function two_decimal(num) {
    var num = parseFloat(num);
    var n = num.toFixed(2);
    return n;
}

function one_decimal(num) {
    var num = parseFloat(num);
    var n = num.toFixed(1);
    return n;
}

function updateSucessMsgPopup(response) {
    dhtmlx.message.position = "top";
    dhtmlx.message("Changes successfully UPDATED!");
    console.log(response);
    return true;
}

function insertSucessMsgPopup(response) {
    dhtmlx.message.position = "top";
    dhtmlx.message("New record successfully INSERTED!");
    console.log(response);
    return true;
}

function errorMsgPopup(response) {
    console.log("error");
    console.log(response);
    dhtmlx.alert({
        type: "alert-error",
        text: response.firstChild.nodeValue,
        title: "Error!",
        ok: "OK"
    });
    return true;
 }

function versionPopup(){
    dhtmlx.alert("<b>Ladywood Operations System.</b> <br> Version "+VERSION);
}