<?php
define("DIRECTACESS", "true");
require_once('../../shared/shared.php');
require_once 'config.php';

$strRealPath = realpath('index.php');
$delimiter = DIRECTORY_SEPARATOR;
$arrOfPath = explode($delimiter , $strRealPath);
$_SESSION["PT_Login_Folder_name"] = '?from=table&path='.$arrOfPath[count($arrOfPath)-2];
if($protected == true) 

{	if($login->is_loggedin() == false)
		header('location: ../../wizard/login.php?from=table&path='.$arrOfPath[count($arrOfPath)-2]);
}

if($recordPerPage === 0)
	$recordPerPage = 5;
if($AllowColsPagination !== true)
	$columnPerPage = 0;
else if($columnPerPage === 0 && $AllowColsPagination === true)
	$columnPerPage = 5;

$columns_naming = (isset($Calias) && $Calias !== '') ? $Calias : $Cfield;
$columns_naming .= " per " . $Gcol;
$rows_naming =  (isset($Ralias) && $Ralias !== '') ? $Ralias : $Rfield;
$rows_naming .= " per " . $Gcol;

if(isset($maintainance_email) && $maintainance_email !== '' && filter_var($maintainance_email, FILTER_VALIDATE_EMAIL) 	&& isset($_GET["debug_mode_6"]) && $_GET["debug_mode_6"] == "1701")
	$allowLog = true;
else 
	$allowLog = false;
require_once '../common/bll/csinglep.php';
require_once '../common/bll/Mobile_Detect.php';
$detect = new Mobile_Detect;



// style handling
$style = (isset($_SESSION['css'])) ? $_SESSION['css'] : '../common/blue-theme.css';

// for records pagination 
$numrows = $CsingleP->num_records;
$__numRows = $numrows;
// make rows pagination
$recordPerPage = $CsingleP->records_pagination();
// for columns pagination
$warningmsg = $CsingleP->return_maxCols_warning();
$columnPerPage = $CsingleP->columns_pagination();

// for pagination part 
if(isset($_POST['pageNum']))
{
    // check if AllowRowsPagination is true to make pagination system
    if($AllowRowsPagination)
    { 
        $pageNum = intval(preg_replace("#[^0-9]#", "", $_POST['pageNum']));
        // start from equal to `pag number` multiple `record per page`
        $startFrom = intval($pageNum*$recordPerPage);
        // end after number of records >> $recordPerPage
        $endAfter = $recordPerPage;
        $limitLogic = array($startFrom, $endAfter);
        // here draw new table Grid 
        echo $CsingleP->print_html_tableBody($limitLogic);
    }
    else echo 'false';
    exit();
}

$colPagClass = '';
if ($detect->isMobile())
{
	$colPagClass = ' hidden-xs';
	//in mobile force columns pagination
	$columnPerPage = $CsingleP->columns_pagination(true);
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<title>Pivot Table</title>
          <meta name="robots" content="noindex, nofollow">
        <meta name="googlebot" content="noindex" />
	<link href="../common/alertify/themes/alertify.default.css" rel="stylesheet" type="text/css" />
	<link href="../common/alertify/themes/alertify.core.css" rel="stylesheet" type="text/css" />
	<link href="../common/bootstrap/css/bootstrapmodified.css" rel="stylesheet" type="text/css" />
	<link href="../common/style.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $style; ?>" rel="stylesheet" type="text/css" id="stylelink" />
	<style>
		.alert{
			font-size: 14px;
		}
		.alert > div{
			margin: 5px;
		}
		#pager{
			z-index:-1;
		}
		.mediaTableMenu{
			z-index:1000;
		}
		.header{
			position: absolute;top: -12px;text-align:center;width: 100%;
		}
		#logo-container{
			position: relative;z-index: 1000;width: 300px;margin: 0px auto;
		}
		
		#logo-cs
		{
			position: relative;
			top: 5px;
			width: 245px;
			height: 49px
		}
		
		@media (max-width: 992px)
		{
			#logo-cs
			{
				width: 200px;
				height: 40px;
				position: relative;
				left: 15px;
			}
		}	
		@media (max-width: 767px)
		{
			#logo-cs
			{
				width: 200px;
				height: 40px;
				position: relative;
				float: left;
			}
			#logo-container{
				float: left;
				width: 200px;
			}
		}		
		
	</style>
	<script src="../common/js/main.js"></script>
</head>
<body>
	
	<?php $navbar->print_navbar(basename(__DIR__)); ?>

	<?php if (!$detect->isMobile()) { ?>
		<div class="header">
			<div id="logo-container">
				<img src="../common/img/app-logo.png" class="app-logo" id="logo-cs" />
			</div>			
		</div>
	<?php }else{ ?>		
		<div class="header">
			<div id="logo-container"><img src="../common/img/app-logo.png" class="app-logo" id="logo-cs"/></div>
		</div>
	<?php } ?>

	<div class="container">
	
		<ul class="options-form">
			<li style="margin-left:20px;">
			<label>Change theme</label>
				<select id="colourselector" name="colour" onchange="changeScheme();" style="width:200px;">
					<option value="../common/orange-theme.css">Orange</option>
					<option value="../common/red-theme.css">Red</option>
					<option value="../common/default-theme.css">Default</option>
					<option value="../common/blue-theme.css">Blue</option>
				</select>
			</li>
			
			<div class="clear"></div>
		</ul>
		
		
		<?php echo $warningmsg; ?>
		<!-- $columnPerPage < $maxColumns && $columnPerPage < $numcols -->
		<?php if($AllowColsPagination === true)
		{
		echo
			'<div class="alert alert-dismissable'.$colPagClass.'" id="alertColPag" style="padding-top: 0px;padding-bottom: 0px;background: #FBFBF9;border: 1px solid #dfdfdf;">
				<button style="float:right;position: relative;top: 5px;" type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<span style="float: left;position: relative;top: 26px;margin: 1px 2px 9px 7px;" id="tooltiptop" data-toggle="tooltip" title="('.$columns_naming.') columns pagination" class="btn btn-primary glyphicon glyphicon-info-sign"> </span>
				<div id="colpager"></div>
			</div>';
		}
		?>
		
		<div class="table-warp">			
			<table class="mediaTable" id="pivot-table">
				<thead>
					
						<?php
							// check if levels = single or double
                            // if single we have only one header
							if($Levels === 'single') $CsingleP->print_html_tableHeader();                           
						?>
					
				</thead>
				<tbody>
					<?php
						// here we make limit logic for first page
                        $limit = array(0, $recordPerPage);
                        if($AllowRowsPagination === false) $limit = false;
                        // check if levels = single or double
						if($Levels === 'single') $CsingleP->print_html_tableBody($limit);
					?>
					
				</tbody>
			</table>
                    
		</div>
		<div id='pager'></div>	
	</div>
	<script src="../common/js/jquery-1.9.1.js"></script>
   	<script src="../common/js/jquery.mediaTable.js"></script>
   	<script src="../common/alertify/lib/alertify.min.js"></script>
	<script src="../common/bootstrap/js/bootstrap.js"></script>
   	<script>
		function changeScheme()
		{ 
			var selectedStyle = $('#colourselector').val();
			$('#stylelink').attr('href', selectedStyle);
			$.ajax({
				url: '../common/style.php',
				type: 'post',
				data: 'css='+selectedStyle,
				success: function(data){
					// console.log(data);
				}
			});
		}
        // this function to remove all table rows except thead
   		function rmAllExceptHeader()
        {
            $('tbody tr').each(function() {
                $(this).remove();
            });
        }
        // add new records when we got it from ajax and put it in table rows
        function addNewRecords(tablerows)
        {
            $('tbody').append(tablerows);
            $('tbody').css({opacity: '0'});
            $('tbody').animate(
            {opacity : '0.1'},'fast',
                function(){$('tbody').animate({opacity : '0.4'},'fast',
                    function(){$('tbody').animate({opacity : '0.8'},'fast',
                        function(){$('tbody').animate({opacity : '1.0'},'fast');
                        });
                    }); 
                });
        }
        // here we set onmousedown event for each button of pagination system 1 2 3 4 ... 
   		function page(lastPage){
            $('#pagination li').each(function(){
                $(this).mousedown(function(){
                    // active button when we click on it
                    $(this).addClass('active');
                    // remove active from other buttons
                    $(this).siblings().removeClass();
                    // then we get page number start from 0
                    var id = $(this).attr('id').trim();
                    var arr = id.split("_");
                    var pageNum = arr[1];
                    // here we make first arrow disabled when we click on 1 button
                    if(pageNum <= 0){
                        pageNum = 0;
                        $("#pageX_0").addClass('disabled');
                        $("#page_0").addClass('active');
                    }
                    // here we make last arrow disabled when we click on lastpage button
                    if(pageNum >= lastPage-1){
                    	pageNum = lastPage-1;
                        $("#pageX_"+pageNum).addClass('disabled');
                        $("#page_"+pageNum).addClass('active');
                    }

                    $.ajax({
                        url: 'index.php',
                        type: 'post',
                        data: 'pageNum='+pageNum,
                        success: function(data){
                        	rmAllExceptHeader();
							
                            // here renew functionality of display for column but it doesn't work if we have two table header
                        	$('th').each(function() {
				                $(this).css('display', 'table-cell');
				            });
							
				            $('ul li input:checkbox').each(function() {
				                $(this).prop('checked', true);
				            });
                        	addNewRecords(data);
							
                        	var active;
                        	$('#pagination-system-for-columns li').each(function(){

                        		if($(this).hasClass('active')) active = $(this);
                        	});

							//$('#colpager ul').remove();
							
                            gfunc = <?php echo '"'.$Gfunc.'"'; ?>;
							columnPerPage = <?php echo $columnPerPage;?>;
							numrows = <?php echo $numrows;?>;
							AllowColsPagination = <?php if($AllowColsPagination){ echo 1;}else{ echo 0;}?>;
							columns_control('pivot-table', columnPerPage, 'colpager', AllowColsPagination, numrows, gfunc, true);
							active.mousedown();
                        }
                    }).error(function(){alert('error');});
                });
            });
        }
        $(document).ready(function(){
			// handle current style 
			<?php if(isset($_SESSION['css'])){ ?>$('#colourselector').val("<?php echo $_SESSION['css']; ?>");<?php }else{ ?>
			$('#colourselector').val("../common/blue-theme.css");<?php } ?>
		
			var AllowRowsPagination = <?php if($AllowRowsPagination){ echo 1;}else{ echo 0;}?>;
			//alert(AllowRowsPagination);
            //data = 'lastitem_recordperpage' else if = 'false' it's mean allowpaggination = false .. we don't need pagination
            if(AllowRowsPagination === 1)
            {
                var lastItem = <?php echo $__numRows; ?>;
                // rows per page
                var rpp = <?php echo $recordPerPage; ?>;
                //last page
                var lastPage = Math.ceil(lastItem/rpp);
				$('#pager').append('<span style="float: left;position: relative;top: 20px;margin: 1px;margin-right: 2px;" id="tooltipbottom" data-toggle="tooltip" title="(<?php echo $rows_naming; ?>) rows pagination" class="btn btn-primary glyphicon glyphicon-info-sign"> </span>');
                // tooltip for pagination
				$('#tooltipbottom').tooltip();
				$('#pager').append('<ul id="pagination" class="pagination"></ul>');
                // make first arrow
                $('#pagination').append('<li id="pageX_0"><a href="#">&lt;&lt;</a></li>');
                for(i = 0; i < lastPage; i++)
                {   
                    if(i == 0){
                    $('#pagination').append('<li id="page_'+i+'" class="active"><a href="#">'+(i+1)+'</a></li>');
					}else{
						$('#pagination').append('<li id="page_'+i+'"><a href="#">'+(i+1)+'</a></li>');
					}
                }
                // make last arrow
                $('#pagination').append('<li id="pageX_'+(lastPage-1)+'"><a href="#">&gt;&gt;</a></li>');
                // we make first disable by default because we in first page by default
                $("#pageX_0").addClass('disabled');
                // if we have only one page we will diabled last arrow too.
                if(lastPage === 1) $("li").last().addClass('disabled');
                page(lastPage);
            }
			// Functional Script: this activate/deactivate MediaTable
			$('#pivot-table').mediaTable();
			// tooltip for pagination
			$('#tooltiptop').tooltip();
			// to set columns pagination 
			var gfunc = <?php echo '"'.$Gfunc.'"'; ?>;
			var columnPerPage = <?php echo $columnPerPage;?>;
			var numrows = <?php echo $numrows;?>;
			var AllowColsPagination = <?php if($AllowColsPagination){ echo 1;}else{ echo 0;}?>;
			columns_control('pivot-table', columnPerPage, 'colpager', AllowColsPagination, numrows, gfunc);
			
			//if ($('#pivot-table').width() > 1200) $('#pivot-table').wrap('<div class="table-responsive"></div>');
			$('#pivot-table').wrap('<div class="table-responsive"></div>');
			
			$('td, th').each(function(){
				if($(this).attr('headers') !== 'pivot-table-mediaTableCol-0')
					$(this).css('text-align', 'center');
			});
			
			$('.mediaTableMenu > ul').css('min-width', '110px');
			$('.mediaTableMenu > ul').prepend("<li><div style='margin: 5px;z-index: 1000;'><button id='select-all' class='btn btn-default' style='position: absolute;top: 30px;right: 5px;display: none;width: 100px;height: 25px;padding: 2px;'>Select All</button>&nbsp;&nbsp;<button id='deselect-all' class='btn btn-default' style='position: absolute;top: 30px;right: 5px;width: 100px;height: 25px;padding: 2px;'>Deselect All</button></div></li>");
			
			$('#select-all').mousedown(function(){
				var x = 1;
				$('ul li input:checkbox').each(function() {
					$(this).prop('checked', true);
					$('.col-num'+x).css('display', 'table-cell');
					x++;
				});
				$(this).css('display', 'none');
				$('#deselect-all').css('display', 'block');
			});
			
			$('#deselect-all').mousedown(function(){
				var x = 1;
				$('ul li input:checkbox').each(function() {
					$(this).prop('checked', false);
					$('.col-num'+x).css('display', 'none');
					x++;
				});
				$(this).css('display', 'none');
				$('#select-all').css('display', 'block');
			});
			
			jQuery(function($) { 
				$.extend({
				    form: function(url, data, method) {
				        if (method == null) method = 'POST';
				        if (data == null) data = {};

				        var form = $('<form>').attr({
				            method: method,
				            action: url
				         }).css({
				            display: 'none'
				         });

				        var addData = function(name, data) {
				            if ($.isArray(data)) {
				                for (var i = 0; i < data.length; i++) {
				                    var value = data[i];
				                    addData(name + '[]', value);
				                }
				            } else if (typeof data === 'object') {
				                for (var key in data) {
				                    if (data.hasOwnProperty(key)) {
				                        addData(name + '[' + key + ']', data[key]);
				                    }
				                }
				            } else if (data != null) {
				                form.append($('<input>').attr({
				                  type: 'hidden',
				                  name: String(name),
				                  value: String(data)
				                }));
				            }
				        };

				        for (var key in data) {
				            if (data.hasOwnProperty(key)) {
				                addData(key, data[key]);
				            }
				        }

				        return form.appendTo('body');
				    }
				});
			});

			
			$('#php-to-excel').mousedown(function(){
				var val = $('#colourselector').val();
				var style = 'blue';
				if(val === '../common/orange-theme.css')
					style = 'orange';
				else if(val === '../common/red-theme.css')
					style = 'red';
				else if(val === '../common/blue-theme.css')
					style = 'blue';
				else if(val === '../common/default-theme.css')
					style = 'default';
				console.log(tableTotalsArray);
				$.form(
					"../common/phptoexcel.php",
					{ 
						location: '<?php echo str_replace($delimiter, '0_X_SLASH_X_0', getcwd()); ?>',
			   			func: "<?php echo $Gfunc; ?>",
			   			style: style
			   		},
			   		"POST"
		   		).submit();
			});

        });
   	</script>	
</body>
</html>
<?php send_log_info(); ?>