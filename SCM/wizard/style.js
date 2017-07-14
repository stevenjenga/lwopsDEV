/*

Text[...]=[title,text]

Style[...]=[TitleColor,TextColor,TitleBgColor,TextBgColor,TitleBgImag,TextBgImag,TitleTextAlign,TextTextAlign, TitleFontFace, TextFontFace, TipPosition, StickyStyle, TitleFontSize, TextFontSize, Width, Height, BorderSize, PadTextArea, CoordinateX , CoordinateY, TransitionNumber, TransitionDuration, TransparencyLevel ,ShadowType, ShadowColor]
*/

var FiltersEnabled = 1 // if your not going to use transitions or filters in any of the tips set this to 0

//**************************** wizard Step 2 **************************************************
var Step_2 = new Array();
Step_2[0]=["Smart Chart Maker","Server name or IP "]
Step_2[1]=["Smart Chart Maker","The user name should have Only a select permission on the used database "]
Step_2[2]=["Smart Chart Maker","Password and user name are used to connect to the MySQL database so they must be correct."]
Step_2[3]=["Smart Chart Maker","This menu get populated after connected to the database. It should contain all databases which this user name has access to ."]
Step_2[4]=["Smart Chart Maker","Select the data source type of the chart"]
//*************************** wizard step 3 ****************************************************
var Step_3 = new Array();
Step_3[0] = ["Smart Chart Maker","Select the table(s) which contain the fields of both X and Y axis , for example if you want to display employee names on  X axis then you should select employees table in this step, same for Y axis . Please note that some times the fields of both X and Y axis can exist in the same table, in this case only one table should be selected ."];
//*************************** wizard step 3 sql ****************************************************
var Step_3_sql = new Array();
Step_3_sql[0] = ["Smart Chart Maker","The SQL statement used to create the Sql.<br/><b>Note:</b> avoid using 'order by' because it will be Done visually in a next step."];
//*************************** wizard step 4 ****************************************************
var Step_4 = new Array();
Step_4[0] = ["Smart Chart Maker","Select the fields that you would like to be shown in the chart in both "];
//*************************** wizard step 5 ****************************************************
var Step_5 = new Array();
Step_5[0] = ["Smart Chart Maker","You can group records in the report, the tool supports unlimited grouping levels"];
//*************************** wizard step 6 ****************************************************
var Step_6 = new Array();
Step_6[0] = ["Smart Chart Maker","You can sort records by up to five fields, in either ascending or descending order."];
//*************************** wizard step 7 ****************************************************
var Step_7 = new Array();

Step_7[0] = [ "Smart Chart Maker","How would you like to lay out your report?"];
//*************************** wizard step 8 ****************************************************
var Step_8 = new Array();

Step_8[0] = ["Smart Chart Maker","This is a list of the available Cascading Style Sheet (CSS) styles , pick the one you want to be used in the report ."];
Step_8[1] = ["Smart Chart Maker","You can create a new cascade style sheet (CSS) style but that is NOT  recommended unless you have a good knowledge of cascade style sheets"];
Step_8[2] = ["Smart Chart Maker","You can edit the details of the selected Cascade style sheet (CSS) style  but that is NOT recommended unless you have a good knowledge of cascade style sheets"];
//*************************** wizard step 9 ****************************************************
var Step_9 = new Array();

Step_9[0] = ["Smart Chart Maker","Report Title"];
Step_9[1] = ["Smart Chart Maker","Report Footer. It could contain HTML tags."];
Step_9[2] = ["Smart Chart Maker","Report Header. It could contain HTML tags"];
Step_9[3] = ["Smart Chart Maker","This name will be used to save the report on the server."];
Step_9[4] = ["Smart Chart Maker","This the max number of records that could be displayed in one page. 'Next' and 'Previous' links will be shown in your report to navigate between pages."];
//************************************************************************
var Step_s = new Array();

Step_s[0] = ["Smart Chart Maker","Select the function which you want to apply"];
Step_s[1] = ["Smart Chart Maker","Select the column on which you want to apply the function. it should be a numerical column"];
Step_s[2] = ["Smart Chart Maker","GROUP BY specifies that all sets of values selected are grouped together according to their unique values in the value list. This produces a summary table with one entry per group of records. For example, to calculate the average salary for male and female employees your options should be : <br/>  Function = Average <br/> Affected column =Salary <br/>  Group by column = Gender"];


//******************************* tables relations ********************************************
var tables_relations = new Array();

tables_relations[0] = ["Smart Chart Maker","Select the two related tables"];
tables_relations[1] = ["Smart Chart Maker","Select the primary key and the foreign key of the relation"];
tables_relations[2] = ["Smart Chart Maker","Click to add a relation "];
tables_relations[3] = ["Smart Chart Maker","Select the relation which you like to remove then click to remove it"];

//*************************************************************************************************
var New_Style = new Array();

New_Style[0] = ["Smart Chart Maker","Enter style name. Spaces are not allowed"];
New_Style[1] = ["Smart Chart Maker","Enter style content in this area using CSS. Please do not change classes names nor classes order "];
//*************************************************************************************************
var Chart2 = new Array();
//apply this if only on records that have a unique value // in chart2 Use ( check box )
Chart2[0] = ["Smart Chart Maker", "apply this if only on records that have a unique value"];

//*************************************************************************************************
var Tabs = new Array();
// new help setting
// General
Tabs["graph_title"] = ["Smart Chart Maker", "This title will be displayed on the chart"];
Tabs["graph_title_position"] = ["Smart Chart Maker", "Position of the title (top, bottom, left, right)"];
Tabs["graph_title_colour"] = ["Smart Chart Maker", "Font colour of the title"];

Tabs["width"] = ["Smart Chart Maker", "Width of the chart"];
Tabs["height"] = ["Smart Chart Maker", "height of the chart"];
Tabs["graph_padding"] = ["Smart Chart Maker", "Space between the graph area and the container image. (title and labels should appear in this space) "];

Tabs["stroke_colour"] = ["Smart Chart Maker", "Colour of the chart lines, for example if the chart is a bar chart then it is border colour of each bar (the fill colour of each bar is set in the previous step)"];
Tabs["stroke_width"] = ["Smart Chart Maker", "Thickness of chart lines, for example for bar charts it is border thickness of each bar, 0 disables line drawing"];

Tabs["back_colour"] = ["Smart Chart Maker", "The background colour of the chart"];
Tabs["back_round"] = ["Smart Chart Maker", "Radius of rounded background edge (to make rounded corners)"];
Tabs["back_stroke_width"] = ["Smart Chart Maker", "Thickness of chart border"];
Tabs["back_stroke_colour"] = ["Smart Chart Maker", "Colour of the chart border in case you want to get a coloured border  "];
// ----------------------------------------------------
// axes
Tabs["show_divisions"] = ["Smart Chart Maker", "Enables axis division points"];
Tabs["show_subdivisions"] = ["Smart Chart Maker", "Enables axis subdivisions"];

Tabs["axis_colour"] = ["Smart Chart Maker", "Colour of axis both horizontal and vertical"];
Tabs["axis_stroke_width"] = ["Smart Chart Maker", "Thickness of axis both horizontal and vertical"];
Tabs["axis_font"] = ["Smart Chart Maker", "Font of axis division  "];
Tabs["axis_font_size"] = ["Smart Chart Maker", "Font size of Axis division "];

Tabs["axis_text_angle_v"] = ["Smart Chart Maker", "Angle of vertical axis text (in case you want an inclined text) "];
Tabs["axis_text_angle_h"] = ["Smart Chart Maker", "Angle of horizontal axis text (in case you want an inclined text)"];

Tabs["axis_text_position"] = ["Smart Chart Maker", "Position of axis text for horizontal and vertical axis relative to grid area (inside or outside)"];
Tabs["axis_text_colour"] = ["Smart Chart Maker", "Font colour of  axis division text"];


Tabs["label_v"] = ["Smart Chart Maker", "Vertical axis label"];
Tabs["label_h"] = ["Smart Chart Maker", "Horizontal axis label"];
Tabs["label_colour"] = ["Smart Chart Maker", "Labels font colour "];
Tabs["label_font"] = ["Smart Chart Maker", "font of labels "];
Tabs["label_font_size"] = ["Smart Chart Maker", "Labels font size"];
Tabs["label_font_weight"] = ["Smart Chart Maker", "Labels font weight"];

//Tabs["show_grid"] = ["Smart Chart Maker", "Grid on/off option"];
Tabs["show_grid_v"] = ["Smart Chart Maker", "Show vertical grid lines "];
Tabs["show_grid_h"] = ["Smart Chart Maker", "Show horizontal grid lines"];

Tabs["grid_colour"] = ["Smart Chart Maker", "Colour of grid lines"];
//-------------------------------------------------------------------
// scale
Tabs["axis_min_v"] = ["Smart Chart Maker", "Minimum extent of Y-axis"];
Tabs["axis_max_v"] = ["Smart Chart Maker", "Maximum extent of Y-axis"];
Tabs["grid_division_v"] = ["Smart Chart Maker", "Grid interval on Y-axis"];
Tabs["subdivision_v"] = ["Smart Chart Maker", "Subdivision grid interval on Y-axis"];

Tabs["axis_min_h"] = ["Smart Chart Maker", "Minimum extent of X-axis"];
Tabs["axis_max_h"] = ["Smart Chart Maker", "Maximum extent of X-axis"];
Tabs["grid_division_h"] = ["Smart Chart Maker", "Grid interval on X-axis"];
Tabs["subdivision_h"] = ["Smart Chart Maker", "Subdivision grid interval on X-axis"];
// scale (specification)
// bar, 3D bar, horizontal (custom, stacked, grouped)
Tabs["bar_space"] = ["Smart Chart Maker", "Space between bars"];
Tabs["show_bar_labels"] = ["Smart Chart Maker", "Displays the value of each bar directly above it"];
Tabs["bar_label_font_size"] = ["Smart Chart Maker", "Size of bar label font"];
Tabs["bar_label_colour"] = ["Smart Chart Maker", "Colour of bar label text"];
Tabs["units_label"] = ["Smart Chart Maker", "Units shown after value in bar label, for example  pounds, cm, calories, $, or any other units "];
Tabs["units_before_label"] = ["Smart Chart Maker", "Units shown before value in bar label, for example  pounds, cm, calories,$ ,or any other units"];

Tabs["group_space"] = ["Smart Chart Maker", "Space between bars of group"];

Tabs["show_bar_totals"] = ["Smart Chart Maker", "Displays the total value for the bar in a label above the bar"];
Tabs["bar_total_font_size"] = ["Smart Chart Maker", "FontSize of bar total label "];
Tabs["bar_total_colour"] = ["Smart Chart Maker", "Font Colour of bar total label"];
// line, scatter
// marker
Tabs["marker_size"] = ["Smart Chart Maker", "Size of  points on the line or scattered graph"];
Tabs["marker_type"] = ["Smart Chart Maker", "Shape of points on the line or scattered graph(the available marker shapes are circle, square, triangle, cross, x, pentagon, diamond, hexagon, octagon, asterisk, star, threestar, fourstar and eightstar)"];
Tabs["marker_colour"] = ["Smart Chart Maker", "Colour of of points on the line or scattered graph"];
Tabs["marker_stroke_width"] = ["Smart Chart Maker", "Thickness of of points on the line or scattered graph"];
Tabs["marker_stroke_colour"] = ["Smart Chart Maker", " Border colour of Colour of points on the line or scattered graph"];
// individual settings -- Line
Tabs["line_stroke_width"] = ["Smart Chart Maker", "Thickness of graph line"];
Tabs["line_dash"] = ["Smart Chart Maker", "Enables line dash pattern"];
Tabs["fill_under"] = ["Smart Chart Maker", "If true, the area under the line is filled with colour or gradient"];
Tabs["fill_opacity"] = ["Smart Chart Maker", "Opacity of the filled area"];
// individual settings -- Scatter
Tabs["best_fit"] = ["Smart Chart Maker", "Set to straight to draw a best-fit line through the data points"];
Tabs["best_fit_colour"] = ["Smart Chart Maker", "Colour of the best-fit line"];
Tabs["best_fit_width"] = ["Smart Chart Maker", "Width of the best-fit line in pixels"];
Tabs["best_fit_dash"] = ["Smart Chart Maker", "Dash pattern for the best-fit line"];
//---------------------------------------------------------
// Pie Graph, pie 3D Graph
Tabs["aspect_ratio"] = ["Smart Chart Maker", "Ratio of height/width (or auto to fill area)"];
Tabs["sort"] = ["Smart Chart Maker", "Sorts the pie slices, largest first"];
Tabs["reverse"] = ["Smart Chart Maker", "Slices are drawn anti-clockwise instead of clockwise"];
Tabs["start_angle"] = ["Smart Chart Maker", "Angle in degrees to start the first slice at"];
Tabs["show_labels"] = ["Smart Chart Maker", "Slice labelling on/off option"];
Tabs["show_label_key"] = ["Smart Chart Maker", "Display slice index or name"];
Tabs["show_label_amount"] = ["Smart Chart Maker", "Display slice value"];
Tabs["pie_units_label"] = ["Smart Chart Maker", "Units shown after value in label, for example  pounds, cm, calories,$ ,or any other units"];
Tabs["pie_units_before_label"] = ["Smart Chart Maker", "Units shown before value in label, for example  pounds, cm, calories,$,or any other units"];
Tabs["show_label_percent"] = ["Smart Chart Maker", "Display slice percentage"];
Tabs["label_percent_decimals"] = ["Smart Chart Maker", "Number of decimal places in percentage"];
Tabs["pie_label_colour"] = ["Smart Chart Maker", "Colour of label text"];
Tabs["label_back_colour"] = ["Smart Chart Maker", "Label background colour"];
Tabs["pie_label_font"] = ["Smart Chart Maker", "Font for labels"];
Tabs["pie_label_font_size"] = ["Smart Chart Maker", "Label font size"];
Tabs["pie_label_font_weight"] = ["Smart Chart Maker", "Label font weight"];
Tabs["label_fade_in_speed"] = ["Smart Chart Maker", "Speed to fade in labels (0-100, 0 disables)"];
Tabs["label_fade_out_speed"] = ["Smart Chart Maker", "Speed to fade out labels, if fading in is enabled"];
// just for 3D
Tabs["depth"] = ["Smart Chart Maker", "Depth of the pie slice"];
// ---------------------------------------------------------
// Legend
Tabs["legend_title"] = ["Smart Chart Maker", "Title for legend"];
Tabs["legend_title_colour"] = ["Smart Chart Maker", "Font Colour of legend title"];
Tabs["legend_title_font"] = ["Smart Chart Maker", "Font of legend title"];
Tabs["legend_title_font_size"] = ["Smart Chart Maker", "Font size of legend title"];
Tabs["legend_title_font_weight"] = ["Smart Chart Maker", "Font weight of legend title"];

Tabs["legend_position"] = ["Smart Chart Maker", "Position of the legend"];
Tabs["legend_padding"] = ["Smart Chart Maker", "Amount of spacing between entries in legend"];
Tabs["legend_entry_width"] = ["Smart Chart Maker", "Width of legend entry box"];
Tabs["legend_entry_height"] = ["Smart Chart Maker", "Height of legend entry box"];

Tabs["legend_font"] = ["Smart Chart Maker", "Font for legend entries"];
Tabs["legend_font_size"] = ["Smart Chart Maker", "Font size for legend entries"];
Tabs["legend_font_weight"] = ["Smart Chart Maker", "Font weight for legend entries"];

Tabs["legend_colour"] = ["Smart Chart Maker", "Colour of legend entries text"];
Tabs["legend_back_colour"] = ["Smart Chart Maker", "Colour of legend background"];
Tabs["legend_round"] = ["Smart Chart Maker", "Radius of rounded corners for legend border"];
Tabs["legend_stroke_colour"] = ["Smart Chart Maker", "Colour of legend border"];
Tabs["legend_stroke_width"] = ["Smart Chart Maker", "Thickness of legend border"];
Tabs["legend_shadow_opacity"] = ["Smart Chart Maker", "How dark the shadow is (100% = black, none = no shadow)"];

Tabs["legend_text_side"] = ["Smart Chart Maker", "Which side of the entry box the text should be on (left or right)"];
Tabs["legend_draggable"] = ["Smart Chart Maker", "Makes the legend draggable with the mouse"];
Tabs["legend_autohide"] = ["Smart Chart Maker", "Makes the legend hide when the cursor is over it"];
//----------------------------------------------------------------------
// tool tip
Tabs["show_tooltips"] = ["Smart Chart Maker", "Enables display of tooltips over graph markers"];

Tabs["tooltip_font"] = ["Smart Chart Maker", "Font for tooltips"];
Tabs["tooltip_font_size"] = ["Smart Chart Maker", "Tooltip font size"];
Tabs["tooltip_font_weight"] = ["Smart Chart Maker", "Tooltip font weight"];

Tabs["tooltip_colour"] = ["Smart Chart Maker", "Tooltip text/border colour"];
Tabs["tooltip_stroke_width"] = ["Smart Chart Maker", "Tooltip border thickness"];
Tabs["tooltip_round"] = ["Smart Chart Maker", "Radius of rounded tooltip corner"];
Tabs["tooltip_back_colour"] = ["Smart Chart Maker", "Tooltip rectangle background colour"];

Tabs["tooltip_padding"] = ["Smart Chart Maker", "Tooltip rectangle padding"];
Tabs["tooltip_shadow_opacity"] = ["Smart Chart Maker", "Opacity of tooltip shadow (none-100%, none disables shadow)"];
//-----------------------------------------------------------------------

//*************************************************************************************************

/*Style[0]=["white","black","#000099","#E8E8FF","","","","","","","","","","",200,"",2,2,10,10,51,1,0,"",""]
Style[1]=["white","black","#000099","#E8E8FF","","","","","","","center","","","",200,"",2,2,10,10,"","","","",""]
Style[2]=["white","black","#000099","#E8E8FF","","","","","","","left","","","",200,"",2,2,10,10,"","","","",""]
Style[3]=["white","black","#000099","#E8E8FF","","","","","","","float","","","",200,"",2,2,10,10,"","","","",""]
Style[4]=["white","black","#000099","#E8E8FF","","","","","","","fixed","","","",200,"",2,2,1,1,"","","","",""]
Style[5]=["white","black","#000099","#E8E8FF","","","","","","","","sticky","","",200,"",2,2,10,10,"","","","",""]
Style[6]=["white","black","#000099","#E8E8FF","","","","","","","","keep","","",200,"",2,2,10,10,"","","","",""]
Style[7]=["white","black","#000099","#E8E8FF","","","","","","","","","","",200,"",2,2,40,10,"","","","",""]
Style[8]=["white","black","#000099","#E8E8FF","","","","","","","","","","",200,"",2,2,10,50,"","","","",""]
*/
Style=["white","black","orange","#E8E8FF","","","","","","","","","","",200,"",2,2,10,10,24,0.5,75,"simple","gray"]
/*
Style[10]=["white","black","black","white","","","right","","Impact","cursive","center","",3,5,200,150,5,20,10,0,50,1,80,"complex","gray"]
Style[11]=["white","black","#000099","#E8E8FF","","","","","","","","","","",200,"",2,2,10,10,51,0.5,45,"simple","gray"]
Style[12]=["white","black","#000099","#E8E8FF","","","","","","","","","","",200,"",2,2,10,10,"","","","",""]
*/
