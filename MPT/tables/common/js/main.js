function columns_control(table, columnsPerPage, pagerContainer, AllowColsPagination, numrows, gfunc, isRowPagination)
{
	
	var columnsNumber = $('#'+table+' thead tr th').length;
	columnsNumber--;
	var numberOfNav = Math.ceil(columnsNumber/columnsPerPage);
	var colNum = 0;
	$('#'+table+' thead tr th').each(function(){
		$(this).addClass('col-num'+colNum);
		colNum++;
	});
	colNum = 0;
	var trNum = 0;
	$('#'+table+' tbody tr').each(function(){
		$(this).addClass('tr'+trNum);
		$('.tr'+trNum+' td').each(function(){
			$(this).addClass('col-num'+colNum);
			colNum++;
		});
		colNum = 0;
		trNum++;
	});

	// that's to make size of all cell seem good
	if(columnsPerPage <= 4 || columnsNumber <= 4)
	{
		if(columnsPerPage === 1 || columnsNumber === 1)
		{
			$('#'+table+' thead tr th').each(function(){
				$(this).css('width', '50%');
			});
		}
		else if(columnsPerPage === 2 || columnsNumber === 2)
		{
			$('#'+table+' thead tr th').each(function(){
				$(this).css('width', '33%');
			});
		}
		else if(columnsPerPage === 3 || columnsNumber === 3)
		{
			$('#'+table+' thead tr th').each(function(){
				$(this).css('width', '25%');
			});
		}
		else if(columnsPerPage === 4 || columnsNumber === 4)
		{
			$('#'+table+' thead tr th').each(function(){
				$(this).css('width', '20%');
			});
		}
	}
	/*
	else
	{
		$('#'+table+' thead tr th').each(function(){
			$(this).css('width', (Math.ceil(100/columnsPerPage)+'%'));
		});
	}
	*/
	
	create_total(table,numrows, gfunc);
	if(AllowColsPagination === 1)
	{
		for(var x = columnsNumber; x > columnsPerPage; x--)
		{
			$('.col-num'+x).css('display', 'none');
			var z = 0;
			$('ul li input:checkbox').each(function() {
				if(z === (x-1)) $(this).prop('checked', false);
				z++;
			});
		}
		if(isRowPagination != true)
		{
			$('#'+pagerContainer).append('<ul id="pagination-system-for-columns" class="pagination"></ul>');
			// make first arrow
			$('#pagination-system-for-columns').append('<li id="page-for-columnsX_0"><a href="#">&lt;&lt;</a></li>');
			for(i = 0; i < numberOfNav; i++)
			{   
				if(i == 0){
					$('#pagination-system-for-columns').append('<li id="page-for-columns_'+i+'" class="active"><a href="#">'+(i+1)+'</a></li>');
				}else{
					$('#pagination-system-for-columns').append('<li id="page-for-columns_'+i+'"><a href="#">'+(i+1)+'</a></li>');
				}
			}
			// make last arrow
			$('#pagination-system-for-columns').append('<li id="page-for-columnsX_'+(numberOfNav-1)+'"><a href="#">&gt;&gt;</a></li>');
			// we make first disable by default because we in first page by default
			$("#page-for-columnsX_0").addClass('disabled');
			// if we have only one page we will diabled last arrow too.
			if(numberOfNav === 1) $("#pagination-system-for-columns ul li").last().addClass('disabled');
			page_system(numberOfNav, columnsPerPage, table);
		}
	}
}
	
function page_system(numberOfNav, columnsPerPage, table)
{
    $('#pagination-system-for-columns li').each(function(){
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
                $("#page-for-columnsX_0").addClass('disabled');
                $("#page-for-columns_0").addClass('active');
            }
            // here we make last arrow disabled when we click on numberOfNav button
            if(pageNum >= numberOfNav-1){
                pageNum = numberOfNav-1;
                $("#page-for-columnsX_"+pageNum).addClass('disabled');
                $("#page-for-columns_"+pageNum).addClass('active');
            }
			$('#'+table+' thead tr th').each(function(){
				if(!$(this).hasClass('col-num0'))
				{
					$(this).css('display', 'none');
				}
			});
			$('#'+table+' tbody tr td').each(function(){
				if(!$(this).hasClass('col-num0'))
				{
					$(this).css('display', 'none');
				}
			});
			$('ul li input:checkbox').each(function() {
				$(this).prop('checked', false);
			});
			for(var z = ((columnsPerPage*pageNum)+1); z <= ((columnsPerPage*pageNum) + columnsPerPage); z++)
			{
				//if(z === columnsPerPage*pageNum) continue;
				var x = 0;
				$('ul li input:checkbox').each(function() {
					if(x === (z-1)) $(this).prop('checked', true);
					x++;
				});
				$('.col-num'+z).css('display', 'table-cell');
			}
        });
    });
}
var tableTotalsArray = new Array();
function create_total(table, numrows, gfunc)
{
	gfunc = gfunc.toLowerCase();
	gfunc = gfunc.trim();
	total = 0;
	totalHtml = '';
	numrowsX = $('tbody tr').length;
	name = '';
	if(numrows == numrowsX) name = "Grand total";
	else name = "Total per page";
	$('#'+table+' tbody').append('<tr id="total-for-table-cols" class="grand-total-row"></tr>');
	numCols = $('#'+table+' thead tr th').length;
	$('#total-for-table-cols').append('<td id="grand-total" class="col-num0" headers="pivot-table-mediaTableCol-0">'+name+'</td>');
	tableTotalsArray[0] = name;
	for(var x = 1; x < numCols; x++)
	{
		numberOfTdInEachColumn = 0;
		total = 0;
		maxORminArr = new Array();
		$('#'+table+' tbody tr .col-num'+x).each(function(){
			cellValue = $(this).text();
			if(cellValue === '')
				cellValue = 0;
			if(gfunc == 'sum' || gfunc == 'count' || gfunc == 'avg') total += parseFloat(cellValue);
			if(gfunc == 'max' || gfunc == 'min') maxORminArr[numberOfTdInEachColumn] = parseFloat(cellValue);
			numberOfTdInEachColumn++;
		});
		if(gfunc == 'avg') total = (total/numberOfTdInEachColumn);
		if(gfunc == 'max') total = math_max_in_array(maxORminArr);
		if(gfunc == 'min') total = math_min_in_array(maxORminArr);
		
		$('#total-for-table-cols').append('<td class="col-num'+x+'" style="text-align: center;" headers="pivot-table-mediaTableCol-'+x+'">'+total+'</td>');
		tableTotalsArray[x] = total;
	}
}

function math_max_in_array(array)
{
	maxNum = array[0];
	for(x = 0; x < array.length; x++) maxNum = Math.max(maxNum, array[x]);
	return maxNum;
}

function math_min_in_array(array)
{
	minNum = array[0];
	for(x = 0; x < array.length; x++) minNum = Math.min(minNum, array[x]);
	return minNum;
}

