/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//	HORTICULTURE OPS GRIDS
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function hortProduceDetailsGrid(){
    myLayout.cells("a").setText('HORTICULTURE PRODUCE DETAIL \n\
                                | <input type="button" name="addNewHortProduceBtn" value="Add New" onclick="addNewHortProduce();">  \n\
                                | <input type="button" name="hortProduceUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);   
    myGrid = initMyGridNew("get_hort_produce_detail_data_xml.php");

       
    myDataProcessor = initMydataProcessor("update_hort_produce_detail_data.php", 0)
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(3, not_empty);
    myDataProcessor.setVerificator(4, not_empty);
    myDataProcessor.setVerificator(5, not_empty);
    myDataProcessor.setVerificator(6, not_empty);
    myDataProcessor.setVerificator(7, not_empty);    
    
    myDataProcessor.init(myGrid);
}

function addNewHortProduceDetail() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', '', '', '', '', '', ''], 0);
    myGrid.setRowColor(rowID, "00ff66");
}

function hortSellingUnitsGrid(){
    myLayout.cells("a").setText('HORTICULTURE SELLING UNITS \n\
                                | <input type="button" name="addNewHortSellingUnitsBtn" value="Add New" onclick="addNewSellingUnits();">  \n\
                                | <input type="button" name="hortSellingUnitsBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);   
    myGrid = initMyGridNew("get_hort_selling_units_data_xml.php");

       
    myDataProcessor = initMydataProcessor("update_hort_selling_units_data.php", 0)
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.init(myGrid);
}
function addNewSellingUnits() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', ''], 0);
    myGrid.setRowColor(rowID, "00ff66");
}

function hortProduceBrandsGrid(){
    myLayout.cells("a").setText('HORTICULTURE PRODUCE BRANDS \n\
                                | <input type="button" name="addNewHortProduceBrandBtn" value="Add New" onclick="addNewHortProduceBrand();">  \n\
                                | <input type="button" name="hortProduceBrandUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);   
    myGrid = initMyGridNew("get_hort_produce_brand_data_xml.php");

       
    myDataProcessor = initMydataProcessor("update_hort_produce_brand_data.php", 0)
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.setVerificator(1, not_empty);
    myDataProcessor.setVerificator(2, not_empty);
    myDataProcessor.setVerificator(2, greaterThanZero);
    myDataProcessor.setVerificator(3, not_empty);
    
    myDataProcessor.init(myGrid);
}
function addNewHortProduceBrand() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, ['', ''], 0);
    myGrid.setRowColor(rowID, "00ff66");
}

function hortProduceParentGrid(){
    console.log('HEREXXXX');
    myLayout.cells("a").setText('HORTICULTURE PRODUCE TYPES \n\
                                | <input type="button" name="addNewHortProduceTypeBtn" value="Add New" onclick="addNewProduceType();">  \n\
                                | <input type="button" name="hortProduceTypeUpdtBtn" value="Update Changes" onclick="myDataProcessor.sendData();">');
    loadPageMenu(myLayout);   
    myGrid = initMyGridNew("get_hort_produce_type_data_xml.php");

       
    myDataProcessor = initMydataProcessor("update_hort_produce_type_data.php", 0)
    myDataProcessor.setVerificator(0, not_empty);
    myDataProcessor.init(myGrid);
}
function addNewProduceType() {
    var rowID = (new Date()).valueOf();
    myGrid.addRow(rowID, [''], 0);
    myGrid.setRowColor(rowID, "00ff66");
}