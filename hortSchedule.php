<?php
	if(isset($_GET['ptOid'])){
		$ptOid = $_GET['ptOid'];
		$ganttPath = "functions/get_hort_schedule_data.php?ptOid=".$ptOid;
		//echo $ganttPath."<br>";
	}
	else {
		$ganttPath = "functions/get_hort_schedule_data.php";
	}
?>
<!DOCTYPE html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<title>Hort Schedule</title>
		<script src="codebase/dhtmlxgantt.js"></script>   
		<link href="codebase/dhtmlxgantt.css" rel="stylesheet"> 
	<style type="text/css">
		html, body{ height:100%; width:95%; padding:0px; margin:0px; overflow: hidden;}
	</style>

	<style>
		.weekend{ background: #ff0739 !important;}
	</style>
	
</head>

<body>
<!-- 
	<input type="radio" id="scale1" name="scale" value="1" checked /><label for="scale1">Day scale</label><br>
	<input type="radio" id="scale2" name="scale" value="2" /><label for="scale2">Week scale</label><br>
	<input type="radio" id="scale3" name="scale" value="3" /><label for="scale3">Month scale</label><br>
	<input type="radio" id="scale4" name="scale" value="4" /><label for="scale4">Year scale</label><br>
-->
	<div id="ganttObj"  style="width:100%; height:100%;  margin:10px; background-color:white;"></div>
	
	<script type="text/javascript">
		function setScaleConfig(value){
			switch (value) {
				case "1":
					gantt.config.scale_unit = "day";
					gantt.config.step = 1;
					gantt.config.date_scale = "%d %M";
					gantt.config.subscales = [];
					gantt.config.scale_height = 27;
					gantt.templates.date_scale = null;
					break;
				case "2":
					var weekScaleTemplate = function(date){
						var dateToStr = gantt.date.date_to_str("%d %M");
						var endDate = gantt.date.add(gantt.date.add(date, 1, "week"), -1, "day");
						return dateToStr(date) + " - " + dateToStr(endDate);
					};

					gantt.config.scale_unit = "week";
					gantt.config.step = 1;
					gantt.templates.date_scale = weekScaleTemplate;
					gantt.config.subscales = [
						{unit:"day", step:1, date:"%D" }
					];
					gantt.config.scale_height = 50;
					break;
				case "3":
					gantt.config.scale_unit = "month";
					gantt.config.date_scale = "%F, %Y";
					gantt.config.subscales = [
						{unit:"day", step:1, date:"%j, %D" }
					];
					gantt.config.scale_height = 50;
					gantt.templates.date_scale = null;
					break;
				case "4":
					gantt.config.scale_unit = "year";
					gantt.config.step = 1;
					gantt.config.date_scale = "%Y";
					gantt.config.min_column_width = 50;

					gantt.config.scale_height = 90;
					gantt.templates.date_scale = null;

					
					gantt.config.subscales = [
						{unit:"month", step:1, date:"%M" }
					];
					break;
			}
		}
		gantt.config.xml_date = "%Y-%m-%d";
		gantt.config.readonly = true;
		
		<!-- set col labels -->
gantt.config.columns =  [
    {name:"text",       label:"Task name",  align: "right", width:110, tree:true },
    {name:"start_date", label:"Start time",   align: "right", width:80 },
    {name:"duration",   label:"Duration",  align: "right", width:70 }
];
		<!-- set date range -->
		gantt.config.start_date = new Date(2016, 12, 31);
		gantt.config.end_date = new Date(2018, 12, 31);
		
		setScaleConfig('4');
		gantt.config.scale_height = 44;
		
		<!-- gantt.config.scale_unit = "day";  -->
		<!-- gantt.config.date_scale = "%M %d" -->
		

		
		<!-- ??????? -->
		var scale_day = 0;
		gantt.templates.date_scale = function(date) {
			var d = gantt.date.date_to_str("%F %d");
			return "<strong>Day " + (scale_day++) + "</strong><br/>" + d(date);
		};
		
		
		<!-- highlight weekends -->
		gantt.templates.scale_cell_class = function(date){
			if(date.getDay()==0||date.getDay()==6){
				return "weekend";
			}
		};
		console.log("Here");
		gantt.templates.task_cell_class = function(item,date){
			if(date.getDay()==0||date.getDay()==6){ 
				return "weekend" ;
			}
		};

		gantt.init("ganttObj");
		gantt.load("<?php echo $ganttPath;?>");
		
		var func = function(e) {
			e = e || window.event;
			var el = e.target || e.srcElement;
			var value = el.value;
			setScaleConfig(value);
			gantt.render();
		};

		var els = document.getElementsByName("scale");
		for (var i = 0; i < els.length; i++) {
			els[i].onclick = func;
		}
		// gantt.attachEvent("onTaskLoading", function(task){
		// if(task.id == 1||task.parent==1){ return true;}//displays just the task with id=1 and its children 
		// return false; //hides other tasks
		// });
		var dp = new gantt.dataProcessor("functions/update_hort_schedule_data.php");
		dp.init(gantt);
	</script>
	
</body>