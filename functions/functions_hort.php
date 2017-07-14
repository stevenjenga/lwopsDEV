<?php
require_once('functions.php');
global $db, $logger;

function getProduceDetailData(){
    $data = Array(
        "variety" => $_GET["c2"],
        "directPlanting" => $_GET["c3"],
        "nurseryDuration" => $_GET["c4"],
        "avgMaturityDays" => $_GET["c5"],
        "harvestDurationDays" => $_GET["c6"]
    );
    if (isset($_GET['c0'])) {
        $data['horticultureProduceParentoid'] = $_GET['c0'];
    }
    if (isset($_GET['c1'])) {
        $data['brand'] = $_GET['c1'];
    } 
    return $data;    
}

function update_produceDetail($rowId) {
    global $db;
    global $logger;
    try {
        $logger->debug("update_produceDetail() ", $_GET);
        $data = getProduceDetailData();
        $db->where('oid', $rowId);
        $db->update('HorticultureProduceDetail', $data);
        $logger->debug("update_produceType() ", $db->getLastQuery());
        if ($db->getLastErrno() === 0)
            return array('updated', $rowId, $rowId, "SUCCESS!!");
        else
            return array('error', $rowId, $rowId, $db->getLastError());
    } catch (Exception $e) {
        $logger->debug("update_produceType()", ['ERROR:' => $e]);
        return array('error', 0, 0, $e->getMessage());
    }        
}

function add_produceDetail() {
    global $db;
    global $logger;
    try {
        $logger->debug("add_produceDetail() ", $_GET);

        $data = getProduceDetailData();

        $id = $db->insert('HorticultureProduceDetail', $data);
        $logger->debug("add_produceType()", $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('inserted', $id, $id, "SUCCESS!!");
        } else {
            return array('error', $id, $id, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("add_produceType()", ['ERROR:' => $e]);
        return array('error', 0, 0, $e->getMessage());
    }        
}
//SELLING UNITS
function getProduceSellingUnitData() {
    $data = Array(
        "unit" => $_GET["c0"],
        "description" => $_GET["c1"]
    );
    return $data;    
}
function update_sellingUnit($rowId) {
    global $db;
    global $logger;
    try {
        $logger->debug("update_sellingUnit() ", $_GET);
        $data = getProduceSellingUnitData();
        $db->where('unit', $rowId);
        $db->update('HorticultureSellUnit', $data);
        $logger->debug("update_sellingUnit() ", $db->getLastQuery());
        if ($db->getLastErrno() === 0)
            return array('updated', $rowId, $rowId, "SUCCESS!!");
        else
            return array('error', $rowId, $rowId, $db->getLastError());
    } catch (Exception $e) {
        $logger->debug("update_sellingUnit()", ['ERROR:' => $e]);
        return array('error', 0, 0, $e->getMessage());
    }        
}

function add_sellingUnit() {
    global $db;
    global $logger;
    try {
        $logger->debug("add_sellingUnit() ", $_GET);

        $data = getProduceSellingUnitData();

        $id = $db->insert('HorticultureSellUnit', $data);
        $logger->debug("add_sellingUnit()", $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('inserted', $id, $id, "SUCCESS!!");
        } else {
            return array('error', $id, $id, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("add_sellingUnit()", ['ERROR:' => $e]);
        return array('error', 0, 0, $e->getMessage());
    }        
}

//BRANDS
function getProduceBrandsData() {
    $data = Array(
        "name" => $_GET["c0"]
    );
    return $data;    
}
function update_produceBrand($rowId) {
    return array('error', 0, 0, 'Contact system admin to update produce brands....');
}

function add_produceBrand() {
    global $db;
    global $logger;
    try {
        $logger->debug("add_produceBrand() ", $_GET);
        $data = getProduceBrandsData();
        $id = $db->insert('HorticultureProduceBrand', $data);
        $logger->debug("add_produceBrand()", $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('inserted', $id, $id, "SUCCESS!!");
        } else {
            return array('error', $id, $id, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("add_produceBrand()", ['ERROR:' => $e]);
        return array('error', 0, 0, $e->getMessage());
    }        
}

//PARENT
function getProduceParentData() {
    $data = Array(
        "name" => $_GET["c0"]
    );
    return $data;    
}
function update_produceParent($rowId) {
    global $db;
    global $logger;
    try {
        $logger->debug("update_employeePurchases() ", $_GET);
        $data = getProduceParentData();
        $db->where('oid', $rowId);
        $db->update('HorticultureProduceParent', $data);
        $logger->debug("update_produceParent() ", $db->getLastQuery());
        if ($db->getLastErrno() === 0)
            return array('updated', $rowId, $rowId, "SUCCESS!!");
        else
            return array('error', $rowId, $rowId, $db->getLastError());
    } catch (Exception $e) {
        $logger->debug("update_produceParent()", ['ERROR:' => $e]);
        return array('error', 0, 0, $e->getMessage());
    }  
}

function add_produceParent() {
    global $db;
    global $logger;
    try {
        $logger->debug("add_produceParent() ", $_GET);
        $data = getProduceParentData();
        $id = $db->insert('HorticultureProduceParent', $data);
        $logger->debug("add_produceParent()", $db->getLastQuery());
        if ($db->getLastErrno() === 0) {
            return array('inserted', $id, $id, "SUCCESS!!");
        } else {
            return array('error', $id, $id, $db->getLastError());
        }
    } catch (Exception $e) {
        $logger->debug("add_produceParent()", ['ERROR:' => $e]);
        return array('error', 0, 0, $e->getMessage());
    }        
}