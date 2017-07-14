<div class="group-container">
	<div class="group-container-header"><span>&nbsp;&nbsp;Appearance&nbsp;&nbsp;</span></div>
	<div class="group-container-body">
		<label for="aspect_ratio">aspect ratio</label>
		<input name="aspect_ratio" id="aspect_ratio" type="text" value="<?php default_value('aspect_ratio', false, true); ?>" />
		<a href="" onmouseover="stm(Tabs['aspect_ratio'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="sort">sort</label>
		<select name="sort" id="sort">
			<?php default_value('sort', false,  true); ?>
		</select>
		<a href="" onmouseover="stm(Tabs['sort'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="reverse">reverse</label>
		<select name="reverse" id="reverse">
			<?php default_value('reverse', false,  true); ?>
		</select>
		<a href="" onmouseover="stm(Tabs['reverse'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="start_angle">start angle</label>
		<input name="start_angle" id="start_angle" type="text" value="<?php default_value('start_angle', false,  true); ?>"/>
		<a href="" onmouseover="stm(Tabs['start_angle'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<?php if($chartType == '1') { ?>
	<div class="group-container-body">
		<label for="depth">depth</label>
		<input name="depth" id="depth" type="text" value="<?php default_value('depth'); ?>"/>
		<a href="" onmouseover="stm(Tabs['depth'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<?php } ?>
</div>
<div class="group-container">
	<div class="group-container-header"><span>&nbsp;&nbsp;label&nbsp;&nbsp;</span></div>
	<div class="group-container-body">
		<label for="show_labels">show label</label>
		<select name="show_labels" id="show_labels">
			<?php default_value('show_labels', false,  true); ?>
		</select>
		<a href="" onmouseover="stm(Tabs['show_labels'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="show_label_key">show label key</label>
		<select name="show_label_key" id="show_label_key">
			<?php default_value('show_label_key', false,  true); ?>
		</select>
		<a href="" onmouseover="stm(Tabs['show_label_key'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="show_label_amount">show amount</label>
		<select name="show_label_amount" id="show_label_amount">
			<?php default_value('show_label_amount', false,  true); ?>
		</select>
		<a href="" onmouseover="stm(Tabs['show_label_amount'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="units_label">units after label</label>
		<input name="units_label" id="units_label" type="text" value="<?php default_value('units_label', false,  true); ?>"/>
		<a href="" onmouseover="stm(Tabs['pie_units_label'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="units_before_label">units before label</label>
		<input name="units_before_label" id="units_before_label" type="text" value="<?php default_value('units_before_label', false,  true); ?>"/>
		<a href="" onmouseover="stm(Tabs['pie_units_before_label'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="show_label_percent">show percent</label>
		<select name="show_label_percent" id="show_label_percent">
			<?php default_value('show_label_percent', false,  true); ?>
		</select>
		<a href="" onmouseover="stm(Tabs['show_label_percent'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="label_percent_decimals">percent decimals</label>
		<input name="label_percent_decimals" id="label_percent_decimals" type="text" value="<?php default_value('label_percent_decimals', false,  true); ?>"/>
		<a href="" onmouseover="stm(Tabs['label_percent_decimals'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="label_colour">label color</label>
		<input name="label_colour" id="label_colour" type="text" value="<?php default_value('label_colour', false,  true); ?>" class="color {hash:true}" />
		<a href="" onmouseover="stm(Tabs['pie_label_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="label_back_colour">background color</label>
		<input name="label_back_colour" id="label_back_colour" type="text" value="<?php default_value('label_back_colour', false,  true); ?>" class="color {hash:true}" />
		<a href="" onmouseover="stm(Tabs['label_back_colour'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="label_font">label font</label>
		<select name="label_font" id="label_font">
			<?php default_value('label_font', false,  true); ?>
		</select>
		<a href="" onmouseover="stm(Tabs['pie_label_font'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="label_font_size">label font size</label>
		<input name="label_font_size" id="label_font_size" type="text" value="<?php default_value('label_font_size', false,  true); ?>"/>
		<a href="" onmouseover="stm(Tabs['pie_label_font_size'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="label_font_weight">font bold</label>
		<select name="label_font_weight" id="label_font_weight">
			<?php default_value('label_font_weight', false,  true); ?>
		</select>
		<a href="" onmouseover="stm(Tabs['pie_label_font_weight'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="label_fade_in_speed">fade in speed</label>
		<input name="label_fade_in_speed" id="label_fade_in_speed" type="text" value="<?php default_value('label_fade_in_speed', false,  true); ?>"/>
		<a href="" onmouseover="stm(Tabs['label_fade_in_speed'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	<div class="group-container-body">
		<label for="label_fade_out_speed">fade out speed</label>
		<input name="label_fade_out_speed" id="label_fade_out_speed" type="text" value="<?php default_value('label_fade_out_speed', false,  true); ?>"/>
		<a href="" onmouseover="stm(Tabs['label_fade_out_speed'],Style, this);" onclick="return false;" onmouseout=""><img src="images/Help.png" border="0"/></a>
	</div>
	
</div>