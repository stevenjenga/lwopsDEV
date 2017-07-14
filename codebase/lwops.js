const VERSION = 'v4.1.0';
var myLayout, myMenu, myGrid, myGridCalendar, payPeriodGrid,  myDataProcessor, payPeriodDataProcessor, dhxComponent;
var myCombo, arrayOfRowIds, logMsg, pAndLmonthGrid, savedRowID, myPop, getDataXmlFile;
var selectedMonthsArray = new Array(0,0,0,0,0,0,0,0,0,0,0,0);
var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var basicTerminationFormData, casualTerminationPayslipFormData, fteTerminationPayslipFormData ;
var basicTerminationForm, casualTerminationPayslipForm, fteTerminationPayslipForm;
var terminationDateCalendarChanged = false;
var terminationReason, terminationComments, gratuityComments;
var excelFileName;

function initMyGridDisableSorting(dataXmlFile) {
    console.log("getDataXmlFile => " + dataXmlFile);
    getDataXmlFile = dataXmlFile;
    myGrid = myLayout.cells("a").attachGrid('gridbox');
    myGrid.setImagePath("codebase/imgs/");
    myGrid.setDateFormat("%M.%d.%Y");
    myGrid.enableAutoWidth(true);
    myGrid.enableEditEvents(true, false, true);

    myGrid.attachEvent("onBeforeSorting", function(ind,type,direction){
        console.log("onBeforeSorting event fired..."+ind+" - "+type+" - "+direction);
        return false;
    });        

    myGrid.init();
    myGrid.enableSmartRendering(true, 50);
    myGrid.load("functions/" + getDataXmlFile);
    return myGrid;
}
function initMyGridSpecial(getDataXmlFile,cell){
	console.log("cell = "+ cell);
	myGrid = myLayout.cells(cell).attachGrid('gridbox');
	myGrid.setImagePath("skins/web/imgs/dhxgrid_web/");
			
	myGrid.setDateFormat("%M.%d.%Y");
	myGrid.enableAutoWidth(true);
	myGrid.enableEditEvents(true,false, true);
	console.log("getDataXmlFile => "+getDataXmlFile);
	myGrid.load("functions/"+getDataXmlFile);
	console.log("grid loaded...");
        myGrid.init();
	return myGrid;
}

function setDatePickerDateToToday(){
	var getCurDateArr = get_currentDate_Arr();
	$('#box').val(monthNames[getCurDateArr.actualMonth]+" "+getCurDateArr.day+" "+  getCurDateArr.year);					
}

function displayPayPeriodGrid(view){
    payPeriodGrid = myLayout.cells(view).attachGrid();
    payPeriodGrid.setImagePath("codebase/imgs/");
    payPeriodGrid.setDateFormat("%M.%d.%Y");
    payPeriodGrid.load("functions/get_OpsBiWeeklyCalendar_data_xml.php");

    payPeriodGrid.attachEvent("onCheck", function(rId,cInd,state){
            console.log("OnCheck event......");
            payPeriodGrid.setRowTextNormal(savedRowID);
            payPeriodGrid.setRowTextBold(rId);
            savedRowID = rId;
    });
    payPeriodGrid.init();
}

function displayPayMonthGrid(view){
    payMonthGrid = myLayout.cells(view).attachGrid();
    payMonthGrid.setImagePath("codebase/imgs/");
    payMonthGrid.setDateFormat("%M.%d.%Y");
    payMonthGrid.load("functions/get_OpsMonthlyCalendar_data_xml.php");

    payMonthGrid.attachEvent("onCheck", function(rId,cInd,state){
            console.log("OnCheck event......");
            payMonthGrid.setRowTextNormal(savedRowID);
            payMonthGrid.setRowTextBold(rId);
            savedRowID = rId;
    });
    payMonthGrid.init();
}

function initMyGridX(getDataXmlFile,cell,preventSort){
    console.log("initMyGridX()");
    console.log("cell = " + cell);
    myGrid = myLayout.cells(cell).attachGrid('gridbox');
    myGrid.setImagePath("skins/web/imgs/dhxgrid_web/");

    myGrid.setDateFormat("%M.%d.%Y");
    myGrid.enableAutoWidth(true);
    myGrid.enableEditEvents(true, false, true);
    if (preventSort) {
        myGrid.attachEvent("onBeforeSorting", function (ind, type, direction) {
            console.log("onBeforeSorting event fired..." + ind + " - " + type + " - " + direction);
            return false;
        });
    }
    console.log("getDataXmlFile => " + getDataXmlFile);
    myGrid.load("functions/" + getDataXmlFile);
    console.log("grid loaded...");
    myGrid.init();
    return myGrid;
}

function exportToExcel(){
	console.log("codebase/grid-excel-php/generate.php?filename="+excelFileName);
	myGrid.toExcel("codebase/grid-excel-php/generate.php?filename="+excelFileName);
}

function eXcell_kenyaCurrencyRedro(cell) { 
    if (cell) { 	
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
        eXcell_ro.call(this); 
    }
    this.setValue = function (val) {
        var cVal = two_decimal(val);
        this.setCValue("<b><span class='kes_red'>KES </span></b><span>" + cVal + "</span>", cVal);
    }
    this.getValue = function () {       	
        return this.cell.childNodes[1].innerHTML;
    }
}
eXcell_kenyaCurrencyRedro.prototype = new eXcell;

function eXcell_kenyaCurrencyro(cell){ 
	if (cell){ 	
		this.cell = cell;
		this.grid = this.cell.parentNode.grid;
		eXcell_ro.call(this); 
	}
	this.setValue=function(val){
		var cVal= two_decimal(val);
		/* actual data processing */
		this.setCValue("<b><span class='kes_color'>KES </span></b><span>"+cVal+"</span>",cVal);                                        
	}
	this.getValue=function(){       	
		return this.cell.childNodes[1].innerHTML;
	}
}
eXcell_kenyaCurrencyro.prototype = new eXcell;

function eXcell_dbDeleteRowBtn(cell) {  // the eXcell name is defined here
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
        this.setCValue("<input type='button' value='Delete' onclick='dbDeleteRow(" + row_id + "," + rowIndex + ")'>");
    }
}
eXcell_dbDeleteRowBtn.prototype = new eXcell;
function dbDeleteRow(row_id, rowIndex){
    console.log('dbDeleteRow(() row_id = ' + row_id);
    myGrid.deleteRow(row_id);
    return;
}
function eXcell_acheckro(cell){ // the eXcell name is defined here
    if (cell){            // the default pattern, just copy it
        this.cell = cell;
        this.grid = this.cell.parentNode.grid;
    }
    this.edit = function(){} //read-only cell doesn't have edit method
    // the cell is read-only, so it's always in the disabled state
    this.isDisabled = function(){ return true; } 
    this.setValue=function(val){
        if(val == 1){
            val = "<span title='&nbsp;No' align:right' style='height:8px; width:8px; background:green; display:inline-block;'></span> Yes";
        }
        else {
            val = "<span title='&nbsp;No' style='height:8px; width:8px; background:red; display:inline-block;'></span> No";            
        }
        
        this.setCValue(val); 
    }
}
eXcell_acheckro.prototype = new eXcell;// nests all other methods from the base class

