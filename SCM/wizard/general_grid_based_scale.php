<?php
	function extend_default_value($id)
	{
		global $chartType;
		if($chartType == "6" || $chartType == "7" || $chartType == "8") default_value($id, true, false);
		else default_value($id);
	}
?>
<div class="group-container">
	<div class="group-container-header"><span>&nbsp;&nbsp;Vertical axis&nbsp;&nbsp;</span></div>
	<div class="group-container-body">
		<label for="axis_min_v">min value</label>
		<input name="axis_min_v" id="axis_min_v" type="text" value="<?php extend_default_value('axis_min_v'); ?>"/>
		<a href="" onmouseover="stm(Tabs['axis_min_v'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="axis_max_v">max value</label>
		<input name="axis_max_v" id="axis_max_v" value="<?php extend_default_value('axis_max_v'); ?>" type="text"/>
		<a href="" onmouseover="stm(Tabs['axis_max_v'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="grid_division_v">division value</label>
		<input name="grid_division_v" id="grid_division_v" type="text" value="<?php extend_default_value('grid_division_v'); ?>"/>
		<a href="" onmouseover="stm(Tabs['grid_division_v'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body" id="subdivision_v_container" style="display: none;">
		<label for="subdivision_v">subdivision value</label>
		<input name="subdivision_v" id="subdivision_v" type="text" value="<?php extend_default_value('subdivision_v'); ?>"/>
		<a href="" onmouseover="stm(Tabs['subdivision_v'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
</div>
<div class="group-container">
	<div class="group-container-header"><span>&nbsp;&nbsp;Horizontal axis&nbsp;&nbsp;</span></div>
	<div class="group-container-body">
		<label for="axis_min_h">min value</label>
		<input name="axis_min_h" id="axis_min_h" type="text" value="<?php extend_default_value('axis_min_h'); ?>"/>
		<a href="" onmouseover="stm(Tabs['axis_min_h'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="axis_max_h">max value</label>
		<input name="axis_max_h" id="axis_max_h" type="text" value="<?php extend_default_value('axis_max_h'); ?>"/>
		<a href="" onmouseover="stm(Tabs['axis_max_h'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="grid_division_h">division value</label>
		<input name="grid_division_h" id="grid_division_h" type="text" value="<?php extend_default_value('grid_division_h'); ?>"/>
		<a href="" onmouseover="stm(Tabs['grid_division_h'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body" id="subdivision_h_container" style="display: none;">
		<label for="subdivision_h">subdivision value</label>
		<input name="subdivision_h" id="subdivision_h" type="text" value="<?php extend_default_value('subdivision_h'); ?>"/>
		<a href="" onmouseover="stm(Tabs['subdivision_h'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
</div>

	<?php if($chartType == '10'){ // line 
			require_once 'common_line_scatter_setting.php';
		?>
		<div class="group-container">
			<div class="group-container-header"><span>&nbsp;&nbsp;Line&nbsp;&nbsp;</span></div>
			<div class="group-container-body">
				<label for="line_stroke_width">line width</label>
				<input name="line_stroke_width" id="line_stroke_width" type="text" value="<?php default_value('line_stroke_width'); ?>"/>
				<a href="" onmouseover="stm(Tabs['line_stroke_width'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
			</div>
			<div class="group-container-body">
				<label for="line_dash">line dash</label>
				<select name="line_dash" id="line_dash">
					<?php default_value('line_dash'); ?>
				</select>
				<a href="" onmouseover="stm(Tabs['line_dash'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
			</div>
			<div class="group-container-body">
				<label for="fill_under">fill under line</label>
				<select name="fill_under" id="fill_under">
					<?php default_value('fill_under'); ?>
				</select>
				<a href="" onmouseover="stm(Tabs['fill_under'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
			</div>
			<div class="group-container-body">
				<label for="fill_opacity">fill opacity</label>
				<select name="fill_opacity" id="fill_opacity">
					<?php default_value('fill_opacity'); ?>
				</select>
				<a href="" onmouseover="stm(Tabs['fill_opacity'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
			</div>
		</div>
	<?php }else if($chartType == '9'){ // scatter 
		require_once 'common_line_scatter_setting.php';
	?>
		<div class="group-container">
		<div class="group-container-header"><span>&nbsp;&nbsp;scatter&nbsp;&nbsp;</span></div>
			<div class="group-container-body">
				<label for="best_fit">best fit</label>
				<select name="best_fit" id="best_fit">
					<?php default_value('best_fit'); ?>
				</select>
				<a href="" onmouseover="stm(Tabs['best_fit'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
			</div>
			<div class="group-container-body">
				<label for="best_fit_colour">best fit color</label>
				<input name="best_fit_colour" id="best_fit_colour" type="text" value="<?php default_value('best_fit_colour'); ?>" class="color {hash:true}" />
				<a href="" onmouseover="stm(Tabs['best_fit_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
			</div>
			<div class="group-container-body">
				<label for="best_fit_width">best fit width</label>
				<input name="best_fit_width" id="best_fit_width" type="text" value="<?php default_value('best_fit_width'); ?>"/>
				<a href="" onmouseover="stm(Tabs['best_fit_width'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
			</div>
			<div class="group-container-body">
				<label for="best_fit_dash">best fit dash</label>
				<select name="best_fit_dash" id="best_fit_dash">
					<?php default_value('best_fit_dash'); ?>
				</select>
				<a href="" onmouseover="stm(Tabs['best_fit_dash'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
			</div>
		</div>
	<?php } else { ?>
<div class="group-container">
	<div class="group-container-header"><span>&nbsp;&nbsp;Advanced properties&nbsp;&nbsp;</span></div>
	<?php if($chartType == '5' || $chartType == '6'){ // bar || grouped || horizontal 
		require_once 'common_bar_setting.php';
	}else if($chartType == '4' || $chartType == '7'){ // stacked || horizontal stacked 
		require_once 'common_bar_setting.php';
	?>
		<div class="group-container-body">
			<label for="show_bar_totals">show bars total</label>
			<select name="show_bar_totals" id="show_bar_totals">
				<?php default_value('show_bar_totals'); ?>
			</select>
			<a href="" onmouseover="stm(Tabs['show_bar_totals'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
		</div>
		<div class="group-container-body">
			<label for="bar_total_font_size">bar total size</label>
			<input name="bar_total_font_size" id="bar_total_font_size" type="text" value="<?php default_value('bar_total_font_size'); ?>"/>
			<a href="" onmouseover="stm(Tabs['bar_total_font_size'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
		</div>
		<div class="group-container-body">
			<label for="bar_total_colour">bar total color</label>
			<input name="bar_total_colour" id="bar_total_colour" type="text" value="<?php default_value('bar_total_colour'); ?>" class="color {hash:true}"/>
			<a href="" onmouseover="stm(Tabs['bar_total_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
		</div>		
	<?php }else if($chartType == '8'){ // horizontal grouped ?>
		<div class="group-container-body">
			<label for="group_space">group space</label>
			<input name="group_space" id="group_space" type="text" value="<?php default_value('group_space'); ?>"/>
			<a href="" onmouseover="stm(Tabs['group_space'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
		</div>
	<?php 
		require_once 'common_bar_setting.php';
		}else if($chartType == '3'){ // 3d bar ?>
		<div class="group-container-body">
			<label for="bar_space">bars space</label>
			<input name="bar_space" id="bar_space" type="text" value="<?php default_value('bar_space'); ?>"/>
			<a href="" onmouseover="stm(Tabs['bar_space'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
		</div>
	<?php } ?>
</div>
<?php } ?>