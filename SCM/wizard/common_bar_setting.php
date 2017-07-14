<div class="group-container-body">
	<label for="bar_space">bars space</label>
	<input name="bar_space" id="bar_space" type="text"  value="<?php default_value('bar_space'); ?>"/>
	<a href="" onmouseover="stm(Tabs['bar_space'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
</div>
<div class="group-container-body">
	<label for="show_bar_labels">show bar labels</label>
	<select name="show_bar_labels" id="show_bar_labels">
		<?php default_value('show_bar_labels'); ?>
	</select>
	<a href="" onmouseover="stm(Tabs['show_bar_labels'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
</div>
<div class="group-container-body">
	<label for="bar_label_font_size">bar label size</label>
	<input name="bar_label_font_size" id="bar_label_font_size" type="text" value="<?php default_value('bar_label_font_size'); ?>"/>
	<a href="" onmouseover="stm(Tabs['bar_label_font_size'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
</div>
<div class="group-container-body">
	<label for="bar_label_colour">bar label color</label>
	<input name="bar_label_colour" id="bar_label_colour" type="text" value="<?php default_value('bar_label_colour'); ?>" class="color {hash:true}"/>
	<a href="" onmouseover="stm(Tabs['bar_label_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
</div>
<div class="group-container-body">
	<label for="units_label">units after labels</label>
	<input name="units_label" id="units_label" type="text" value="<?php default_value('units_label'); ?>"/>
	<a href="" onmouseover="stm(Tabs['units_label'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
</div>
<div class="group-container-body">
	<label for="units_before_label">units before labels</label>
	<input name="units_before_label" id="units_before_label" type="text" value="<?php default_value('units_before_label'); ?>"/>
	<a href="" onmouseover="stm(Tabs['units_before_label'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
</div>