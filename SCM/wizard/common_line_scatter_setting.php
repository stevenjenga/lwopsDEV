<div class="group-container">
	<div class="group-container-header"><span>&nbsp;&nbsp;Marker&nbsp;&nbsp;</span></div>
	<div class="group-container-body">
		<label for="marker_size">marker size</label>
		<input name="marker_size" id="marker_size" type="text" value="<?php default_value('marker_size'); ?>"/>
		<a href="" onmouseover="stm(Tabs['marker_size'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="marker_type">marker type</label>
		<select name="marker_type" id="marker_type">
			<?php default_value('marker_type'); ?>
		</select>
		<a href="" onmouseover="stm(Tabs['marker_type'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="marker_colour">marker colour</label>
		<input name="marker_colour" id="marker_colour" type="text" value="<?php default_value('marker_colour'); ?>" class="color {hash:true}" />
		<a href="" onmouseover="stm(Tabs['marker_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="marker_stroke_width">border width</label>
		<input name="marker_stroke_width" id="marker_stroke_width" type="text" value="<?php default_value('marker_stroke_width'); ?>"/>
		<a href="" onmouseover="stm(Tabs['marker_stroke_width'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="marker_stroke_colour">border color</label>
		<input name="marker_stroke_colour" id="marker_stroke_colour" type="text" value="<?php default_value('marker_stroke_colour'); ?>" class="color {hash:true}"/>
		<a href="" onmouseover="stm(Tabs['marker_stroke_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
</div>
