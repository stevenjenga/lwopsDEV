<div class="group-container">
	<div class="group-container-header"><span>&nbsp;&nbsp;Label&nbsp;&nbsp;</span></div>
	<div class="group-container-body">
		<label for="label_h">horizontal label</label>
		<input name="label_h" id="label_h" type="text" value="<?php default_value('label_h', false, false); ?>"/>
		<a href="" onmouseover="stm(Tabs['label_h'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="label_v">vertical label</label>
		<input name="label_v" id="label_v" type="text" value="<?php default_value('label_v', false, false); ?>" />
		<a href="" onmouseover="stm(Tabs['label_v'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="label_font">text font</label>
		<select name="label_font" id="label_font">
			<?php default_value('label_font', false, false); ?>
		</select>
		<a href="" onmouseover="stm(Tabs['label_font'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>	
	<div class="group-container-body">
		<label for="label_colour">font color</label>
		<input name="label_colour" id="label_colour" type="text" class="color {hash:true}" value="<?php default_value('label_colour', false, false); ?>"/>
		<a href="" onmouseover="stm(Tabs['label_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="label_font_size">font size</label>
		<input name="label_font_size" id="label_font_size" type="text" value="<?php default_value('label_font_size', false, false); ?>"/>
		<a href="" onmouseover="stm(Tabs['label_font_size'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="label_font_weight">font weight</label>
		<select name="label_font_weight" id="label_font_weight">
			<?php default_value('label_font_weight', false, false); ?>
		</select>
		<a href="" onmouseover="stm(Tabs['label_font_weight'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
</div>	

<div class="group-container">
	<div class="group-container-header"><span>&nbsp;&nbsp;Axes properties&nbsp;&nbsp;</span></div>
	<div class="group-container-body">
		<label for="show_divisions">divisions</label>
		<select name="show_divisions" id="show_divisions">
			<?php default_value('show_divisions'); ?>
		</select>
		<a href="" onmouseover="stm(Tabs['show_divisions'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="show_subdivisions">subdivisions</label>
		<select name="show_subdivisions" id="show_subdivisions">
			<?php default_value('show_subdivisions'); ?>
		</select>
		<a href="" onmouseover="stm(Tabs['show_subdivisions'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="axis_colour">axis color</label>
		<input name="axis_colour" id="axis_colour" type="text" value="<?php default_value('axis_colour'); ?>" class="color {hash:true}" />
		<a href="" onmouseover="stm(Tabs['axis_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="axis_stroke_width">axis width</label>
		<input name="axis_stroke_width" id="axis_stroke_width" type="text"  value="<?php default_value('axis_stroke_width'); ?>" />
		<a href="" onmouseover="stm(Tabs['axis_stroke_width'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="axis_font">axis text font</label>
		<select name="axis_font" id="axis_font">
			<?php default_value('axis_font'); ?>
		</select>
		<a href="" onmouseover="stm(Tabs['axis_font'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="axis_font_size">axis font size</label>
		<input name="axis_font_size" id="axis_font_size" type="text" value="<?php default_value('axis_font_size'); ?>"/>
		<a href="" onmouseover="stm(Tabs['axis_font_size'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="axis_text_position">text position</label>
		<select name="axis_text_position" id="axis_text_position">
			<?php default_value('axis_text_position'); ?>
		</select>
		<a href="" onmouseover="stm(Tabs['axis_text_position'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="axis_text_colour">font color</label>
		<input name="axis_text_colour" id="axis_text_colour" type="text" value="<?php default_value('axis_text_colour'); ?>" class="color {hash:true}" />
		<a href="" onmouseover="stm(Tabs['axis_text_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
</div>

<div class="group-container">
	<div class="group-container-header"><span>&nbsp;&nbsp;text angle&nbsp;&nbsp;</span></div>
	<div class="group-container-body">
		<label for="axis_text_angle_h">horizontal</label>
		<input name="axis_text_angle_h" id="axis_text_angle_h" type="text" value="<?php default_value('axis_text_angle_h'); ?>" class="angle-deg" />
		<span id="by_axis_text_angle_h" class="angle-desc">example</span>
		<a href="" onmouseover="stm(Tabs['axis_text_angle_h'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="axis_text_angle_v">vertical</label>
		<input name="axis_text_angle_v" id="axis_text_angle_v" type="text" value="<?php default_value('axis_text_angle_v'); ?>" class="angle-deg" />
		<span id="by_axis_text_angle_v" class="angle-desc">example</span>
		<a href="" onmouseover="stm(Tabs['axis_text_angle_v'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
</div>

<div class="group-container">
	<div class="group-container-header"><span>&nbsp;&nbsp;Grid properties&nbsp;&nbsp;</span></div>
	<div class="group-container-body">
		<label for="show_grid_h">horizontal grid</label>
		<select name="show_grid_h" id="show_grid_h">
			<?php default_value('show_grid_h'); ?>
		</select>
		<a href="" onmouseover="stm(Tabs['show_grid_h'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="show_grid_v">vertical grid</label>
		<select name="show_grid_v" id="show_grid_v">
			<?php default_value('show_grid_v'); ?>
		</select>
		<a href="" onmouseover="stm(Tabs['show_grid_v'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="grid_colour">grid color</label>
		<input name="grid_colour" id="grid_colour" type="text" value="<?php default_value('grid_colour'); ?>" class="color {hash:true}"/>
		<a href="" onmouseover="stm(Tabs['grid_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
</div>
