/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//	DAIRY OPS GRIDS
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function DairyCowNameGrid(){
    myLayout.cells("a").setText('DAIRY COW NAMES');
    loadPageMenu(myLayout);
    myGrid = myLayout.cells("a").attachGrid('gridbox');
    myGrid.setImagePath("codebase/imgs/");
    myGrid.load("functions/get_dairycowname_xml.php");

    myGrid.setHeader("Cow Name");
    myGrid.setColTypes("ed");
    myGrid.setInitWidths("100");
    myGrid.setColAlign("center");
    myGrid.setDateFormat("%m/%d/%Y");

}
//<div id="combo_zone2" style="width:230px;"></div>

function dairyProductionGrid() {
    myLayout.cells("a").setText('DAIRY PRODUCTION  |  <input id="box" type="text" value="" placeholder="Datepicker">  |  <input type="button" name="addNewDairyProdBtn" value=" Enter New " onclick="addNewDairyProduction();">   |  <input type="button" name="dairyProductionUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    setDatePickerDateToToday();
    myGrid = initMyGridNew("get_dairyproduction_data_xml.php");

//    myCombo = new dhtmlXCombo("combo_zone2");
//    myCombo.load("functions/get_dairycow_names_data_xml.php", function(){
//            // callback
//    });
//    myCombo = new dhtmlXCombo({
//            parent: "comboPicker",
//            width: 230,
//            filter: "functions/get_dairycow_names_data_xml.php",
//            filter_cache: true,
//            name: "comboBox"
//    });

    var myCalendar = new dhtmlXCalendarObject("box");
    myCalendar.setSensitiveRange("2016-12-23", new Date());
    myCalendar.attachEvent("onClick", function (d) {
        document.getElementById("box").value = get_currentDate_by_obj(d).date2;
        myGrid.clearAll();
        myGrid.load("functions/get_dairyproduction_data_xml.php?date=" + get_currentDate_by_obj(d).date1, function () {  //loading data to the grid
            myGrid.forEachRow(function (id) {});
        });

    });
    myCalendar.attachEvent("onHide", function (d) {});

    myDataProcessor = initMydataProcessor("update_dairyproduction_data.php", 0)
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty); 
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(4, not_empty);
    myDataProcessor.init(myGrid);
}

function dairySalesGrid() {
    myLayout.cells("a").setText('DAIRY SALES  | <input id="box" type="text" value="" placeholder="Datepicker"> | <input type="button" name="addNewDairyProdBtn" value=" Enter New " onClick="addNewDairySales();"> | <input type="button" name="fishSalesUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);
    setDatePickerDateToToday();    
    myGrid = initMyGridNew("get_dairysales_data_xml.php");
    var myCalendar = new dhtmlXCalendarObject("box");
    myCalendar.setSensitiveRange("2017-01-01", new Date());
    myCalendar.attachEvent("onClick", function (d) {
        document.getElementById("box").value = get_currentDate_by_obj(d).date2;
        myGrid.clearAll();
        myGrid.load("functions/get_dairysales_data_xml.php?date=" + get_currentDate_by_obj(d).date1, function () {  //loading data to the grid
            myGrid.forEachRow(function (id) {});
        });

    });
    myCalendar.attachEvent("onHide", function (d) {});

    myDataProcessor = initMydataProcessor("update_dairysales_data.php", 0)
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(2, greaterThanZero); 
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(3, greaterThanZero); 
    myDataProcessor.init(myGrid);
}

function dairyCoorporativeGrid(){
    myLayout.cells("a").setText('KIAMBA DAIRY MONTHLY STATEMENT  |  <input type="button" name="addNewDairyStatementBtn" value=" Enter New " onClick="addNewDairyStatement();"> | <input type="button" name="dairyStatementUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);   
    myGrid = initMyGridNew("get_coorporative_data_xml.php");

    myDataProcessor = initMydataProcessor("update_dairy_coorp_data.php", 0)
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(1, greaterThanZero);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(2, greaterThanZero); 
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(3, greaterThanZero); 
    myDataProcessor.setVerificator(5, not_empty);
    myDataProcessor.setVerificator(5, greaterThanZero); 
    myDataProcessor.setVerificator(6, not_empty);
    myDataProcessor.setVerificator(6, greaterThanZero);  
    myDataProcessor.setVerificator(11, not_empty);
    myDataProcessor.setVerificator(11, greaterThanZero); 
    myDataProcessor.setVerificator(12, not_empty);
    myDataProcessor.setVerificator(12, greaterThanZero);     
    myDataProcessor.init(myGrid);
}

function addNewDairyStatement(){
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID,['',0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0.00,0,0],0);
    myGrid.setRowColor(rowID,"00ff66");    
}
