<?php
	defined('SYSTEM_CONTROL') or die (header('location: ../wizard'));
	$_SESSION['srm_f62014_page_key'] = "data_source";// set current page
	require_once 'activePages.php'; // require navigation handler
	require_once 'helpers/safeValue.php';
	/*
		step_3
		tables_relations.php
		tables_filters.php
	*/

	// --------------- step_3 ---------------------------
	$db = clean_input($db);
	$result = $dbHandler->query("show tables from `$db`"); // query selected database
	$tables = array(); // set result in $table array
	foreach($result as $key => $value)
	{
		$tables[]= $value[0];
	}
	// ------------------------------------------------- 
	
	// --------------- relationships --------------------
	$relationships = (isset($_SESSION['srm_f62014_relationships'])) ? $_SESSION['srm_f62014_relationships'] : ''; // get relation from session
	// --------------------------------------------------

	// --------------------- filters ----------------------
	$filters = (isset($_SESSION['srm_f62014_tables_filters'])) ? $_SESSION['srm_f62014_tables_filters'] : ''; // get filters from session
	// ----------------------------------------------------
?>
<!--
<html>
	<head>
		<title>Select table</title>
	</head>
	<body>
-->
	<div id="tabs" class="container col-xs-12"><!-- -->
		<!-- Nav tabs nav nav-tabs -->
		<ul class="" style="font-size: 12px;">
			<li class="active"><a id="tables-nav" href="#tables" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span> Tables</a></li>
			<li><a id="rel-nav" href="#rel" data-toggle="tab"><span class="glyphicon glyphicon-link"></span> Relationships</a></li>
			<li><a id="filters-nav" href="#filters" data-toggle="tab"><span class="glyphicon glyphicon-filter"></span> Filters</a></li>
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
			<div class="tab-pane active" id="tables">
				
				<form action="<?php echo($_SERVER['PHP_SELF']);?>" method="post" onsubmit="return false;">
					<div class="row">
						<div class="col-xs-1"></div>
						<div id="error-container" class="col-xs-10">
							<!-- .alert -->
						</div>
						<div class="col-xs-1"></div>
					</div><!-- .row (error) -->
					
					<div class="row">
						<div class="col-xs-1"></div>
						<div class="form-group col-xs-10">
							<label for="selectTable">Select table</label>
							<div class="left-inner-addon">
								<i class="glyphicon glyphicon-pushpin"></i>
								<select id="selectTable" name="selectTable" size="<?php echo count($tables);?>" class="form-control" multiple style="height: 100px;">
									<?php
										foreach($tables as $val)
										{
											if ( in_array($val, $_SESSION["srm_f62014_table"])) echo"<option selected>$val</option>";
											else echo "<option>$val</option>";
										}
									?>
								</select>
							</div>
						</div>
						<div class="help-container col-xs-1">
							<a href="" id="stHelp" onClick="return false;">
								<img src="designLayer/images/help.png" width="15" height="15" border="0">
							</a>
						</div>
					</div>	<!-- .row (selectTable) -->
					
					<div class="row" style="position: relative;top: -10px;">
						<div class="col-xs-8"></div>
						<div class="col-xs-3">
							<button name="select-tables" class="btn btn-primary btn-block btn-xs" style="font-size: 12px;" id="select-tables">Select</button/> 
						</div>
						<div class="col-xs-1" id="pointer"></div>
					</div>	<!-- .row (select btn) -->
					
					
					<div class="row no-side-margin">
						<div class="col-xs-1"></div>
						<div class="alert alert-info col-xs-10">
							** Hold &quot;Ctrl&quot; and click to select more than one table &nbsp;&nbsp;&nbsp;(Recommended only for Related Tables)
						</div>
						<div class="col-xs-1"></div>
					</div>	<!-- .row (info) -->
					
					
					
				</form>
			</div><!-- end of first tab -->
			
			<div class="tab-pane" id="rel">
				
				<form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" name="myform" onsubmit="return false;">
				
					<div class="row">
						<div class="col-xs-1"></div>
						<div id="rel-error-container" class="col-xs-10">
							<!-- .alert -->
						</div>
						<div class="col-xs-1"></div>
					</div><!-- .row (error) -->
					
					<div class="row">
						<div class="col-xs-1" ></div>
						<div class="form-group col-xs-5">
							<label for="left_table">Left Table</label>
							<div class="left-inner-addon">
								<i class="glyphicon glyphicon-pushpin"></i>
								<select name="left_table" id="left_table" class="form-control"></select>
							</div>
						</div>
						<div class="form-group col-xs-5">
							<label for="left_field">Left Field</label>
							<div class="left-inner-addon">
								<i class="glyphicon glyphicon-pushpin"></i>                              
								<select name="left_field" class="form-control"  id="left_field"></select>
							</div>
						</div>
						<div class="help-container col-xs-1">
							<a href="" id="lRelHelp" onClick="return false;">
								<img src="designLayer/images/help.png" width="15" height="15" border="0">
							</a>
						</div>
					</div><!-- .row ( select rel left table, field) -->
						
						
					<div class="row">
						<div class="col-xs-1" ></div>
						<div class="form-group col-xs-5">
							<label for="right_table">Right Table</label>
							<div class="left-inner-addon">
								<i class="glyphicon glyphicon-pushpin"></i>
								<select name="right_table" id="right_table"  class="form-control"></select>
							</div>
						</div>
						<div class="form-group col-xs-5">
							<label for="right_field">Right Field</label>
							<div class="left-inner-addon">
								<i class="glyphicon glyphicon-pushpin"></i>
								<select name="right_field" class="form-control" id="right_field"></select>  
							</div>
						</div>
						<div class="help-container col-xs-1">
							<a href="" id="rRelHelp" onClick="return false;" >
								<img src="designLayer/images/help.png" width="15" height="15" border="0">
							</a>
						</div>
					</div><!-- .row ( select rel right table, field) -->
						
					
					
					<div class="row">
						<div class="col-xs-1"></div>
						<div class="col-xs-2">
							<button name="btn_add" class="btn btn-primary btn-block btn-xs" style="font-size: 12px;" id="btn_add">Add</button/> 
						</div>
						<div class="help-container-btn-xs col-xs-1">
							<a href="" id="addHelp" onClick="return false;">
								<img src="designLayer/images/help.png" width="15" height="15" border="0">
							</a>
						</div>
						<div class="col-xs-2">
							<button name="btn_remove" class="btn btn-primary btn-block btn-xs" id="btn_remove" style="margin-left: -55px;font-size: 12px;">Remove</button/> 
						</div>
						<div class="help-container-btn-sm col-xs-1">
							<a href="" id="rmHelp" onClick="return false;">
								<img src="designLayer/images/help.png" width="15" height="15" border="0">
							</a>
						</div>
						<div class="col-xs-7"></div>
					</div><!-- .row (add, remove btn) -->
					
					
					
					
					<div class="row" style="margin-top: 5px;">
						<div class="col-xs-1" ></div>
						<div class="form-group col-xs-10">
							<div class="left-inner-addon">
								<i class="glyphicon glyphicon-pushpin"></i>
								<select name="relationships" class="form-control" size="3" id="relationships" style="height: 90px;" multiple>
									<?php 
										if($relationships !== "" && is_array($relationships))
											foreach($relationships as $key => $val) echo "<option value='$val'>$val</option>";
									?>
								</select>
							</div>
						</div>
						<div class="col-xs-1"></div>
					</div><!-- .row ( selected relationships ) -->	
					
				</form>
			</div><!-- end of second tab -->
			
			
			<div class="tab-pane" id="filters">
			
				
				<form action="<?php echo($_SERVER['PHP_SELF']); ?>" method="post" name="myform" onsubmit="return false;">
					<!-- Tables Filters -->

					<div class="row">
						<div class="form-group col-xs-4">
							<label for="filter_left_table">Table</label>
							<div class="left-inner-addon">
								<i class="glyphicon glyphicon-pushpin"></i>
								<select name="filter_left_table" id="filter_left_table" class="form-control" size="10" style="height: 230px;">
									<!-- 245px onChange="select_all();myform.submit();" -->
								</select>
							</div>
						</div><!-- table to get filters from -->
						
						
						<div class="row col-xs-8">
							<div class="form-group col-xs-6 padding-left-xs">
								<label for="filter_left_field">Field</label>
								<div class="left-inner-addon">
									<i class="glyphicon glyphicon-pushpin"></i>
									<select name="filter_left_field" id="filter_left_field" class="form-control"></select>  
								</div>
							</div><!-- field for filter -->
							<div class="form-group col-xs-6 padding-left-xs">
								<label for="filterTypes">Filters</label>
								<div class="left-inner-addon">
									<i class="glyphicon glyphicon-filter"></i>
									<select name="filterTypes" id="filterTypes" class="form-control" ></select>
								</div>
							</div>
						</div><!-- filter type -->
						
						<div class="row col-xs-8">
							<div class="form-group col-xs-12 padding-left-xs" id="filterValueContainer"></div>
						</div><!-- add input or two for filter value -->
						
						<!--  if( $type == 2)  -->
						<div class="row col-xs-8" id="filters-date-info"></div><!-- alert is date -->
						
						<div class="row col-xs-8">
							<div class="col-xs-3 padding-left-xs">
							<button name="filters_btn_add" class="btn btn-primary btn-block btn-xs" style="font-size: 12px;" id="filters_btn_add">Add</button/> 
							</div>
							<div class="col-xs-3 padding-left-xs" style="position:relative;left: -15px;">
							<button name="filters_btn_remove" class="btn btn-primary btn-block btn-xs" style="font-size: 12px;" id="filters_btn_remove"><!-- remove_rel(); -->
								Remove</button/> 
							</div>
							<div class="col-xs-6"></div>
						</div><!-- add, remove filters -->
						
						
						<div class="row col-xs-8" style="margin-top: 5px;">
							<div class="form-group col-xs-12 padding-left-xs">
								<div class="left-inner-addon">
									<i class="glyphicon glyphicon-pushpin"></i>
									<select name="tables_filters" size="3" class="form-control" id="tables_filters" style="height:90px;" multiple >
									<?php
										if($filters !== "" && is_array($filters))
										{
											foreach($filters as $key => $val) echo "<option value='$val'>$val</option>";
										}
									?>
									</select>
								</div>
							</div>
						</div><!-- select filters -->
					</div><!-- .row ( filter container ) -->								  
					  
				</form>
			
			</div>
		</div>
		<div class="row">
			<div class="col-xs-1"></div>
			<div class="col-xs-4">
				<button name="btn_back" id="btn_back" class="btn btn-sunny btn-block">
					<span class="icon glyphicon glyphicon-backward"></span><span class="separator"></span> Back
				</button>
			</div>
			<div class="col-xs-2"></div>
			<div class="col-xs-4">
				<button name="continue" id="btn_cont" class="btn btn-sunny btn-block" >
					<span class="icon glyphicon glyphicon-forward"></span><span class="separator"></span> Next
				</button>
			</div>
			<div class="col-xs-1"></div>
		</div><!-- .row (navigation buttons) -->
		
	</div>
		<!-- to complete index tags -->
		</div>
		
	</div>
</div>
</div>
	<script>
			var tablesInfo = new Array(); // this will hold tables info like columns and type
			var tables = <?php if(isset($_SESSION["srm_f62014_table"])) echo 'new Array("' . implode('", "', $_SESSION["srm_f62014_table"]) . '")';
							else echo "''";?>;// selected tables
			var s_relationships = <?php if(isset($_SESSION["srm_f62014_relationships"])) echo 'new Array("' . implode('", "', $_SESSION["srm_f62014_relationships"]) . '")';
							else echo "''";?>;// selected relationship
			// array of all filters type
			var allFilters = {
				"Equal": "=",
				"Greater than": ">",
				"Less than": "<",
				"Greater than or Equal": "<=",
				"Less than or Equal": ">=",
				"Between": "Between",
				"Like": "Like" ,
				"NOT Like": "NOT Like" ,
				"Not Equal": "!=" ,
				"Begin with": "Like1" ,
				"End With": "Like2",
				"Contain": "Like3"
			};
			
			$(document).ready(function(){
				// step_3 
				$("#tabs").tabs();
				getTablesInfo(tables); // relation select
				
				 // make continue btn disabled if there is no tables selected before or now or there is relationship required
				if(tables === "") $("#btn_cont").prop("disabled", true);
				if(tables !== "" && tables.length > 1 && s_relationships === "") $("#btn_cont").prop("disabled", true);
				if(tables === "" || (tables !== "" && tables.length < 2))
				{
					$("#rel-nav").prop("disabled", true);
					$("#btn_add").prop("disabled", true);
					$("#rel-nav").css("display", "none");
				}
				// set images in header
				$("#page-header").empty();
				$("#page-header").append('<div id="img-container"><img src="designLayer/images/select.jpg" width="70" height="70"/></div>');
				$("#page-header").append('<div id="text-container"><h4>Select table(s)</h4>Please select table or related tables</div>');
				// set images in header
				$("#tables-nav").click(function(){
				
					$("#page-header").empty();
					$("#page-header").append('<div id="img-container"><img src="designLayer/images/select.jpg" width="70" height="70"/></div>');
					$("#page-header").append('<div id="text-container"><h4>Select table(s)</h4>Please select table or related tables</div>');
					
				});	
				
				$("#selectTable").mousedown(function(){
					// alertify.error("Don't forget to click Select after choosing tables");
					if($("#pointer-x").length <= 0)
					{
						$("#pointer").append("<span id='pointer-x' class='glyphicon glyphicon-arrow-left'> </span>");
						animatePointerX();
					}
				});
				
				// set selected tables
				$("#select-tables").mousedown(function(){
					var selectedTables = $("#selectTable").val();
					if(selectedTables !== null)
					{
						$.ajax({
							url: "server/step_3.php",
							type: "post",
							data: "selected_tables="+selectedTables.join(),
							success: function(data){
								$("#error-container").empty();
								$("#tables_filters option").remove();
								$("#relationships option").remove();
								$("#pointer-x").stop();
								$("#pointer-x").remove();
								if(data === "success1"){	// no rel
									// 1 #filters
									getTablesInfo(selectedTables);
									$("#btn_cont").prop("disabled", false);
									$("#rel-nav").prop("disabled", true);
									$("#btn_add").prop("disabled", true);
									$("#rel-nav").hide();
									tables = selectedTables;
									$("#filters-nav").trigger("click");
									
								}else if(data === "success2"){	// rel
									// 1 #rel
									getTablesInfo(selectedTables);
									$("#btn_cont").prop("disabled", true);
									$("#rel-nav").prop("disabled", false);
									$("#btn_add").prop("disabled", false);
									$("#rel-nav").show();
									tables = selectedTables;
									$("#rel-nav").trigger("click");
									// 2 filters
									
								}else{
									$("#error-container").append("<div class='alert alert-danger'>* please select a table</div>");
								}
							},
							error: function(){
							}
						});
					}else{
						$("#error-container").empty();
						$("#error-container").append("<div class='alert alert-danger'>* please select a table</div>");
					}
				});
				
				
				//-------------------------------------------------------------------------------------------------------------	
						
				
				//----------------------------------------------- relationships -----------------------------------------------	
				// set images in header
				$("#rel-nav").click(function(){
					if(tables !== "" && tables.length > 1)
					{
						$("#page-header").empty();
						$("#page-header").append('<div id="img-container"><img src="designLayer/images/rel.jpg" width="70" height="70"/></div>');
						$("#page-header").append('<div id="text-container"><h4>Tables Relations</h4>Please Enter valid relationships</div>');
					}else{
						e.preventDefault();
						$("#tables-nav").click();
						alertify.error("Please select tables before this step");
						return;
					}
				});

				$("#btn_add").mousedown(function(){
					// check is everything required set before add new relation
					if(tables !== "" && tables.length > 1)
					{
						var left_table = $("#left_table").val(); 
						var right_table = $("#right_table").val(); 		 
						var left_field = $("#left_field").val(); 		 
						var right_field = $("#right_field").val(); 		 		 		 

						if(("`"+left_table+"`.`"+left_field+"`") === ("`"+right_table+"`.`"+right_field+"`"))
						{
							alertify.error('Not valid relationship!');
							return;
						}
						
						var newRels =  "`"+left_table+"`.`"+left_field+"` = `"+right_table+"`.`"+right_field+"`";
						
						var relationships = new Array();
						var count = 0;
						$("#relationships option").each(function()
						{
							relationships[count] = $(this).text();
						});
						
						//check if this relation exists
						if(relationships !== null && relationships !== "" && $.isArray(relationships))
						{
							for (i = 0; i < relationships.length; i++)
							{
								if(relationships[i].trim() === newRels)
								{
									alertify.error('Relation could not be duplicated!');
									return;
								}
							}
						}
						
						$("#btn_cont").prop("disabled", false);
						
						var newOption = "<option value='`"+left_table+"`.`"+left_field+"` = `"+right_table+"`.`"+right_field+"`'>`"+left_table+"`.`"+left_field+"` = `"+right_table+"`.`"+right_field+"`</option>";
							
						$("#relationships").append(newOption);
					}
				});
				
				
				$("#btn_remove").mousedown(function(){
					$("#relationships option:selected").remove();
					if($("#relationships option").length === 0) $("#btn_cont").prop("disabled", true);
				});
				
				//-------------------------------------------------------------------------------------------------------------

				//----------------------------------------------- filters -----------------------------------------------					
				// set images in header
				$("#filters-nav").click(function(e){
					if(tables !== '')
					{
						$("#page-header").empty();
						$("#page-header").append('<div id="img-container"><img src="designLayer/images/filter.png" width="70" height="70"/></div>');
						$("#page-header").append('<div id="text-container"><h4>Filter Data</h4>Please Enter valid Filter value</div>');
					}else{
						e.preventDefault();
						$("#tables-nav").click();
						alertify.error("Please select tables before this step");
						return;
					}
				});
				

				$("#filters_btn_add").mousedown(function(){
					if(tables !== "")
					{
						var table = $("#filter_left_table").val();
						var field = $("#filter_left_field").val();
						var type = tablesInfo[table][field]; // get type of column
						
						var filterType = $("#filterTypes").val(); // get filter type
						
						// check if type of column char or text or numeric or ..
						if(type.search('char') !== -1 || type.search('text') !== -1 || type.search('int') !== -1 || type.search('decimal') !== -1 
							|| type.search('double') !== -1 || type.search('float') !== -1 || type.search('date') !== -1 || type.search('time') !== -1
							|| type.search('year') !== -1 || type.search('bit') !== -1 || type.search('bool') !== -1)
						{
							var filterValue = $("#filter_value").val().trim();
							var filterValue1 = "";
							// check if empty
							if (filterValue.length == 0 || filterValue === "" || filterValue === null || typeof filterValue === "undefined")
							{	
								alertify.error("Please enter a value.");
								return false;
							}
							// check if filter type between and empty
							if(filterType === "Between")
							{
								filterValue1 = $("#filter_value1").val().trim();
								if (filterValue1.length == 0 || filterValue1 === "" || filterValue1 === null || typeof filterValue1 === "undefined")
								{	
									alertify.error("Please enter a value.");
									return false;
								}
							}			
							// check if numeric
							if(type.search('int') !== -1 || type.search('decimal') !== -1 || type.search('double') !== -1
									|| type.search('float') !== -1)
							{
								if(!$.isNumeric(filterValue))
								{
									alertify.error("Please check - non numeric value!");
									return;
								}
								if(filterType === "Between" && !$.isNumeric(filterValue1))
								{
									alertify.error("Please check - non numeric value!");
									return;
								}
							}
							// check if date or time or year
							if(type.search('date') !== -1 || type.search('time') !== -1 || type.search('year') !== -1)
							{
								if(!isDate(filterValue))
								{
									alertify.error("date format is wrong")
									return false;
								}
								if(filterType === "Between" && !isDate(filterValue1))
								{
									alertify.error("date format is wrong")
									return false;
								}
							}
							// prepare new filter statement
							var statementOne = filterValue;
							var statementTwo = filterValue1;
							var filterTypeValue = allFilters[filterType];
							var statementAndFilterTypeValue = getValidFilterStatement(statementOne, statementTwo, type, filterType, filterTypeValue);
							var statement = statementAndFilterTypeValue[0];
							var filterTypeValue = statementAndFilterTypeValue[1];
							var option = "`"+table+"`.`"+field+"` <-> "+filterTypeValue+" "+statement;
							
							var filters = new Array();
							var count = 0;
							$("#tables_filters option").each(function()
							{
								filters[count] = $(this).text();
							});
							
							//check if this filters exists
							if(filters !== null && filters !== "" && $.isArray(filters))
							{
								for (i = 0; i < filters.length; i++)
								{
									if(filters[i].trim() === option)
									{
										alertify.error('Filter could not be duplicated!');
										return;
									}
								}
							}
							// then add new filter statement
							$("#tables_filters").append("<option value='" + option + "'>" + option + "</option>");
							
						}
					}else{
						alertify.error("Please add tables to be enable to add filters.");
					}
				});
				
				$("#filters_btn_remove").mousedown(function(){
					$("#tables_filters option:selected").remove();
				});
				
				// ---------------------------------------------------------------------------------------------------------------
				// -------------------------------------------------- General & Common -------------------------------------------
				
				$("#btn_cont").mousedown(function(){
					if(tables !== "" && $.isArray(tables))
					{
						$("#relationships option").prop("selected", true);
						var relationships = $("#relationships").val();
						
						if(tables.length > 1 && (relationships === null || relationships === ""
							|| relationships === "null" || typeof relationships === "undefined")) 
						{
								$("#btn_cont").prop("disabled", true);
								$("#rel-nav").trigger("click");
								$("#rel-error-container").empty();
								$("#rel-error-container").append("<div class='alert alert-danger'>* Please specify relations between tables.</div>");
								SwitchStatusError();
								return;
						}
						
						$("#tables_filters option").prop("selected", true);
						var filters = $("#tables_filters").val();
						
						var relAjax = (relationships !== null) ? relationships.join() : null;
						var filterAjax = (filters !== null) ? filters.join() : null;
						$.ajax({
							url: "server/step_3.php",
							type: "post",
							data: "relationships="+relAjax+"&filters="+filterAjax,
							success: function(data){
								$("#rel-error-container").empty();
								if(data === "success"){
									nextToPage("2");
									SwitchStatusDone();
								}else if(data === "error"){
									$("#rel-nav").trigger("click");
									$("#rel-error-container").append("<div class='alert alert-danger'>* Please specify relations between tables.</div>");
									SwitchStatusError();
								}else alertify.error("error");
							}
						});
					}else{
						$("#btn_cont").prop("disabled", true);
						return;
					}
				});
				
				$("#btn_back").mousedown(function(){
					backToPage("0");
				});
				
				
					
				
				// --------------------------------------------------------------------------------------------------------------------
			});
			// ------------------------------------------------- function ------------------------------------------------------------
			// ------------------------------------------------------------------------------------------------------------------------
			// this function get tables info like columns and column type
			function getTablesInfo(selectedTables)
            {
				if(selectedTables !== ""){
					$.ajax({
						url: "server/tablesInfo.php",
						type: "post",
						data: "tablesInfo=tablesInfo",
						dataType: "json",
						success: function(data){
							tablesInfo = new Array();
							for(var i = 0; i < selectedTables.length; i++)
							{
								var tableName = selectedTables[i];
								tablesInfo[tableName] = data[tableName];
							}
							
							setTablesInfo("left_table");
							setTablesInfo("right_table");
							setColumnsInfo("right_table", "right_field");
							setColumnsInfo("left_table", "left_field");
							
							setTablesInfo("filter_left_table");
							setColumnsInfo("filter_left_table", "filter_left_field");
							getDataType("filter_left_table", "filter_left_field", "filterTypes", "filterValueContainer", "filters_btn_add");
						}
					});
				}
            }
			// here set retrieved tables to current id
			function setTablesInfo(id)
			{
				id = "#"+id;
				$(id).empty();
				for (var key in tablesInfo) $(id).append('<option value="'+key+'">'+key+'</option>');
				$(id+" option:first").prop("selected", true);
			}
			// here set retrieved columns to current id
			function setColumnsInfo(tableId, id){
				tableId = "#"+tableId;
				id = "#"+id;
				$(tableId).change(function(){
					$(id).empty();
					var value = tablesInfo[$(this).val()];
					// for(var i = 0; i < value.length; i++) $(id).append('<option value="'+value[i][0]+'">'+value[i][0]+'</option>');
					for (var key in value) $(id).append('<option value="'+key+'">'+key+'</option>');
					$(id).trigger("change");
				});
				$(tableId).trigger("change");
			}
			// --------------------------------------------------------------------------------------------------------------------------
			// get data type for columns to set filter types
			function getDataType(tableId, fieldId, filtersId, filterValueId, btnAddId)
			{
				if(tablesInfo !== "" && $.isArray(tablesInfo))
				{
					tableId = "#"+tableId;
					fieldId = "#"+fieldId;
					filtersId = "#"+filtersId;
					filterValueId = "#"+filterValueId;
					btnAddId = "#"+btnAddId;
					
					$(fieldId).change(function(){
					
						var table = $(tableId).val();
						var field = $(fieldId).val();
						var type = tablesInfo[table][field];
						
						$(tableId).height(230);
						$("#filters-date-info").empty();
						
						if(type.search('char') !== -1 || type.search('text') !== -1)
						{
							// HasValue
							var filters = [
								"Equal",
								"Like",
								"NOT Like",
								"Not Equal",
								"Begin with",
								"End With",
								"Contain" 
							];
							// type=0;
						}
						else if(type.search('int') !== -1 || type.search('decimal') !== -1 || type.search('double') !== -1
								|| type.search('float') !== -1)
						{
							// IsNumeric
							var filters = [
								"Equal",
								"Greater than",
								"Less than",
								"Greater than or Equal",
								"Less than or Equal",
								"Between",
								"Not Equal"
							];
							// $type=1;
						}
						else if(type.search('date') !== -1 || type.search('time') !== -1 || type.search('year') !== -1)
						{
							// Validate
							var filters = [
								"Equal",
								"Greater than",
								"Less than",
								"Greater than or Equal",
								"Less than or Equal",
								"Between"
							];
							
							$("#filters-date-info").append('<div class="col-xs-12 alert alert-info alert-fixed-width">'+
								'The date formate must be YYYY-MM-DD'+
								'</div>');
								
							$(tableId).height(300);
							// $type=2;
						}
						else if(type.search('bit') !== -1 || type.search('bool') !== -1)
						{
							// $type=1;
							// HasValue
							var filters = [ "Equal" ];
							
						}
						else
						{
							var filters = new Array();
							$(filterValueId).empty();
							$(filterValueId).append("<div class='alert alert-danger'>Field with data type "+ type +" can not be filtered!</div>");
							$(btnAddId).prop("disabled", true);
						}
						
						
						
						$(filtersId).empty();
						if($.isArray(filters))
						{
							for(var i = 0;i < filters.length; i++){
								$(filtersId).append('<option value="'+ filters[i] +'">'+ filters[i] +'</option>');
							}
						}
						
						$(filtersId).trigger("change");
					});
					
					$(fieldId).trigger("change");
					
					// set on change event to filters type to detect what kind of validation and appearance we use
					$(filtersId).change(function(){
						var table = $(tableId).val();
						var field = $(fieldId).val();
						var type = tablesInfo[table][field];
						
						var filterType = $(filtersId).val();
						var setFilterValueSpace = true;
						
						var beforeFilterField = "<label for='filter_value'>Filter value</label><div class='left-inner-addon'><i class='glyphicon glyphicon-edit'></i>";
						var filterField = "<input type='text' class='form-control' name='filter_value' id='filter_value'>";
						var afterFilterField = "</div>";
						if(filterType === "Between") 
						{
							beforeFilterField = "<div class='row' style='margin: 0px;'>Filter value</div>";
							filterField =  "<div class='left-inner-addon col-xs-5' style='padding: 0px;'>"+
												"<i class='glyphicon glyphicon-edit'></i>"+
												"<input type='text' class='form-control' name='filter_value' id='filter_value'>"+
											"</div>"+
											"<div class='col-xs-2' style='text-align: center;position: relative;left: -2px; top: 5px;font-size: 12px;'>AND</div>"+
											"<div class='left-inner-addon col-xs-5' style='padding: 0px;'>"+
												"<i class='glyphicon glyphicon-edit'></i>"+
												"<input type='text' class='form-control' name='filter_value1' id='filter_value1'>"+
											"</div>";
							afterFilterField = "";
						}else if(filterType === "" || filterType === null || typeof filterType === "undefined"){
							setFilterValueSpace = false;
						}else if(type.search('bit') !== -1 || type.search('bool') !== -1)
						{
						
							filterField =  "<select	name='filter_value' class='form-control' id='filter_value'>"+
												"<option value='true' selected>True</option>"+
												"<option value='false' selected>False</option>"+
											"<\select>";
						}
						
						if(setFilterValueSpace)
						{
							$(filterValueId).empty();
							$(filterValueId).append(beforeFilterField + filterField + afterFilterField);
						}
					});
					
					$(filtersId).trigger("change");
				}
			}
			// to detect is field date or not
			function isDate(String)
			{
				if(String.match(/^[0-9]{4}\-(0[1-9]|1[012])\-(0[1-9]|[12][0-9]|3[01])/)) return true;
				else return false;
			}
			// return valid filter statement
			function getValidFilterStatement(statementOne, statementTwo, type, filterType, filterTypeValue)
			{
				statementOne = statementOne.trim();
				statementTwo = statementTwo.trim();
				var isTypeOfLike = false;
				
				if(filterTypeValue === "Like3") // contain
				{
					statementOne = '"%'+statementOne+'%"';
					isTypeOfLike = true;
				}
				else if(filterTypeValue === "Like2") // end with
				{	
					statementOne = '"%'+statementOne+'"';
					isTypeOfLike = true;
				}
				else if(filterTypeValue === "Like1") // begin with
				{
					statementOne = '"'+statementOne+'%"';
					isTypeOfLike = true;
				}
				
				if(isTypeOfLike)
				{
					filterTypeValue = "Like";
					// $("#filterTypes").val("Like");
				}else if(type.search('int') === -1 && type.search('decimal') === -1 && type.search('double') === -1 && type.search('float') === -1)
					statementOne = '"'+statementOne+'"';
				else
					statementOne = statementOne;
				
				
				if(filterType === "Between" && filterType === filterTypeValue && statementTwo !== "")
				{
					if(type.search('int') === -1 && type.search('decimal') === -1 && type.search('double') === -1 && type.search('float') === -1)
						statementOne += ' and "'+statementTwo+'"';
					else statementOne += " and "+statementTwo;
				}
				var statement = statementOne;
				return [statement, filterTypeValue];
			}
			
			function animatePointerX()
			{
				$( "#pointer-x" ).animate({ left: "+=10" }, 1000, function() {
					$( "#pointer-x" ).animate({ left: "-=10" }, 1000, function() {
						animatePointerX();
					});
				});
			}
			
	</script>
<!-- end index tags -->
<!--
	</body>
</html>
-->
