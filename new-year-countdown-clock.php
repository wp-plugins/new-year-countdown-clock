<?php
/*
Plugin Name: New Year Countdown Clock
Description: New Year countdown clock showing days and hours until Christamas day. Select from several designs, sizes, animations and backgrounds 
Author: enclick
Version: 1.1
Author URI: http://mycountdown.org
Plugin URI: http://mycountdown.org/wordpress-countdown-clock-plugin/
*/



function new_year_countdown_clock_init() 
{

     if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
    	   return; 

    function new_year_countdown_clock_control() 
    {

        $newoptions = get_option('new_year_countdown_clock');
    	$options = $newoptions;
	$options_flag=0;

	$file_location = dirname(__FILE__)."/group_list.ser"; 
	if ($fd = fopen($file_location,'r')){
		$group_list_ser = fread($fd,filesize($file_location));
		fclose($fd);
	}
	$group_list = array();
	$group_list = unserialize($group_list_ser);


	$file_location = dirname(__FILE__)."/countdown_list.ser"; 
	if ($fd = fopen($file_location,'r')){
		$countdown_list_ser = fread($fd,filesize($file_location));
		fclose($fd);
	}
	$countdown_list = unserialize($countdown_list_ser);

    	if ( empty($newoptions) )
	{
	   $options_flag=1;
      	   $newoptions = array(
	   	'title'=>'New Year Countdown',
           	'transparentflag'=>'0', 
           	'group' => 'Holiday',
           	'countdown' => 'New Year',
           	'text1' => '',
           	'text2' => '',
           	'background' => '-1',
           	'event_day' => '12',
           	'event_month' => '11',
           	'event_year' => '2010',
           	'size' => '150',
           	'typeflag' => '3015',
           	'text_color' => '#FFFFFF',
           	'border_color' => '#963939',
           	'background_color' => '#000000',
           	'timezone' => 'GMT'
	   );
	}

	if ( $_POST['new-year-countdown-clock-submit'] ) {

	     $options_flag=1;
              $newoptions['title'] = strip_tags(stripslashes($_POST['new-year-countdown-clock-title']));
              $newoptions['titleflag'] = strip_tags(stripslashes($_POST['new-year-countdown-clock-titleflag']));
              $newoptions['transparentflag'] = strip_tags(stripslashes($_POST['new-year-countdown-clock-transparentflag']));
              $newoptions['group'] = strip_tags(stripslashes($_POST['new-year-countdown-clock-group']));
              $newoptions['countdown'] = strip_tags(stripslashes($_POST['new-year-countdown-clock-countdown']));
              $newoptions['text1'] = strip_tags(stripslashes($_POST['new-year-countdown-clock-text1']));
              $newoptions['text2'] = strip_tags(stripslashes($_POST['new-year-countdown-clock-text2']));
              $newoptions['background'] = strip_tags(stripslashes($_POST['new-year-countdown-clock-background']));
              $newoptions['event_day'] = strip_tags(stripslashes($_POST['new-year-countdown-clock-event-day']));
              $newoptions['event_month'] = strip_tags(stripslashes($_POST['new-year-countdown-clock-event-month']));
              $newoptions['event_year'] = strip_tags(stripslashes($_POST['new-year-countdown-clock-event-year']));
              $newoptions['size'] = strip_tags(stripslashes($_POST['new-year-countdown-clock-size']));
              $newoptions['type'] = strip_tags(stripslashes($_POST['new-year-countdown-clock-type']));
              $newoptions['typeflag'] = strip_tags(stripslashes($_POST['new-year-countdown-clock-typeflag']));
              $newoptions['text_color'] = strip_tags(stripslashes($_POST['new-year-countdown-clock-text-color']));
              $newoptions['border_color'] = strip_tags(stripslashes($_POST['new-year-countdown-clock-border-color']));
              $newoptions['background_color'] = strip_tags(stripslashes($_POST['new-year-countdown-clock-background-color']));
              $newoptions['timezone'] = strip_tags(stripslashes($_POST['new-year-countdown-clock-timezone']));
        }


      	if ( $options_flag ==1 ) {
              $options = $newoptions;
              update_option('new_year_countdown_clock', $options);
      	}


      	// Extract value from vars

      	$title = htmlspecialchars($options['title'], ENT_QUOTES);
      	$titleflag = htmlspecialchars($options['titleflag'], ENT_QUOTES);
      	$transparent_flag = htmlspecialchars($options['transparentflag'], ENT_QUOTES);
      	$group = htmlspecialchars($options['group'], ENT_QUOTES);
      	$countdown = htmlspecialchars($options['countdown'], ENT_QUOTES);
      	$text1 = htmlspecialchars($options['text1'], ENT_QUOTES);
      	$text2 = htmlspecialchars($options['text2'], ENT_QUOTES);
      	$background = htmlspecialchars($options['background'], ENT_QUOTES);
      	$event_day = htmlspecialchars($options['event_day'], ENT_QUOTES);
      	$event_month = htmlspecialchars($options['event_month'], ENT_QUOTES);
      	$event_year = htmlspecialchars($options['event_year'], ENT_QUOTES);
      	$size = htmlspecialchars($options['size'], ENT_QUOTES);
      	$typeflag = htmlspecialchars($options['typeflag'], ENT_QUOTES);
      	$text_color = htmlspecialchars($options['text_color'], ENT_QUOTES);
      	$border_color = htmlspecialchars($options['border_color'], ENT_QUOTES);
      	$background_color = htmlspecialchars($options['background_color'], ENT_QUOTES);
      	$timezone = htmlspecialchars($options['timezone'], ENT_QUOTES);

      	echo '<ul><li style="text-align:center;list-style: none;"><label for="new-year-countdown-clock-title">New Year Countdown Clock<br> by <a href="http://mycountdown.org">mycountdown.org</a></label></li>';

       	// Get group

       	echo '<label for="new-year-countdown-clock-group">'.
               '<input type="hidden" id="new-year-countdown-clock-group" name="new-year-countdown-clock-group" value="Holiday">';
      	echo '</label>';


       	// Get countdown

       	echo '<label for="new-year-countdown-clock-countdown">'.
               '<input type="hidden" id="new-year-countdown-clock-countdown" name="new-year-countdown-clock-countdown" value="New Year">';
      	echo '</label>';


	$text1 = $countdown;
	$text2 = "Happy " . $countdown;

	// Event Name 
      	echo '<label for="new-year-countdown-clock-text1">';
        echo '<input type="hidden" id="new-year-countdown-clock-text1" name="new-year-countdown-clock-text1" value="'. $text1 .'">';
      	echo '</label>';

      	// Event Message
      	echo '<label for="new-year-countdown-clock-text2">';
        echo '<input id="new-year-countdown-clock-text2" type="hidden" name="new-year-countdown-clock-text2" value="'. $text2 .'">';
      	echo '</label>';

      	// Set clock type
      	echo '<li style="list-style: none;"><label for="new-year-countdown-clock-typeflag">'.'Clock Type:&nbsp;';
       	echo '<select id="new-year-countdown-clock-typeflag" name="new-year-countdown-clock-typeflag"  style="width:145px" >';
      	nycdc_print_type_list($typeflag);
      	echo '</select></label>';
      	echo '</li>';


       	// Get background

 	if ($typeflag > "3011" )
        {
		$inm_background_files = $countdown_list[$group][$countdown]['nm_background_files'];
		echo '<li style="list-style: none;"><label for="new-year-countdown-clock-background">Background :';
		echo '<select id="new-year-countdown-clock-background" name="new-year-countdown-clock-background" style="width:60%">';
		  if($background == 1) $check_selected = " SELECTED ";
                echo '<option value="1" '. $check_selected .'>default</option>';

                $inmj=1;
              	if  ($typeflag < "3014")
              	  while ($inmj <= $inm_background_files){
                          $jnmj = $inmj+2;
			  $check_selected = "";
			  if($jnmj == $background) $check_selected = " SELECTED ";
                           	   echo "\n<option value=\"$jnmj\" $check_selected >Picture $inmj</option>";
                          $inmj++;
                  }

		  $flash_files = array(-1=> "stars",-2=> "balloons",-3=> "hearts",-4=> "confetti",-5=>"star trails",-6=> "sun-rays");
		  foreach ($flash_files as $kki => $vvi)
		  {		
		  	$check_selected = "";
			 if($kki == $background) $check_selected = " SELECTED ";
			 echo "\n";
                  	echo '<option value="'.$kki.'" '.$check_selected.'">' .$vvi.'</option>';
		  }

      		  echo '</select></label></li>';
        }



      	// Set Clock size
	echo "\n";
      	echo '<li style="list-style: none;text-align:bottom"><label for="new-year-countdown-clock-size">'.'Clock Size: &nbsp;'.
         '<select id="new-year-countdown-clock-size" name="new-year-countdown-clock-size"  style="width:75px">';
      	nycdc_print_thesize_list($size);
      	echo '</select></label></li>';


      	// Set Text Clock color
      	echo '<li style="list-style: none;"><label for="new-year-countdown-clock-text-color">'.'Text Color: &nbsp;';
       	echo '<select id="new-year-countdown-clock-text-color" name="new-year-countdown-clock-text-color"  style="width:75px" >';
      	nycdc_print_textcolor_list($text_color);
      	echo '</select></label>';
      	echo '</li>';


      	// Set Background Clock color
      	echo '<li style="list-style: none;"><label for="new-year-countdown-clock-background-color">'.'Background Color:&nbsp;';
       	echo '<select id="new-year-countdown-clock-background-color" name="new-year-countdown-clock-background-color"  style="width:75px" >';
      	nycdc_print_backgroundcolor_list($background_color);
      	echo '</select></label>';
      	echo '</li>';

print "<br> TZ: " . $timezone;
      	// Set TIMEZONE
      	echo '<li style="list-style: none;"><label for="new-year-countdown-clock-timezone">'.'Timezone:&nbsp;';
       	echo '<select id="new-year-countdown-clock-timezone" name="new-year-countdown-clock-timezone"  style="width:150px" >';
      	nycdc_print_timezone($timezone);
      	echo '</select></label>';
      	echo '</li>';


	//   Transparent option

	$transparent_checked = "";
	if ($transparent_flag =="1")
	   $transparent_checked = "CHECKED";

	echo "\n";
        echo '<li style="list-style: none;"><label for="new-year-countdown-clock-transparentflag"> Transparent: 
	<input type="checkbox" id="new-year-countdown-clock-transparentflag" name="new-year-countdown-clock-transparentflag" value=1 '.$transparent_checked.' /> 
	</label></li>';

      	// Hidden "OK" button
      	echo '<label for="new-year-countdown-clock-submit">';
      	echo '<input id="new-year-countdown-clock-submit" name="new-year-countdown-clock-submit" type="hidden" value="Ok" />';
      	echo '</label>';


	//	Title header option	
	if($countdown)
		$title = UCWords($countdown) . " Countdown";
	elseif($group)
		$title = $group . " Countdown";

        echo '<label for="new-year-countdown-clock-title"> <input type="hidden" id="new-year-countdown-clock-title" name="new-year-countdown-clock-title" value="'.$title.'" /> </label>';



	$title_checked = "";
	if ($titleflag =="1")
	   $title_checked = "CHECKED";

	echo "\n";
        echo '<li style="list-style: none;"><label for="new-year-countdown-clock-titleflag"> Countdown Title: 
	<input type="checkbox" id="new-year-countdown-clock-titleflag" name="new-year-countdown-clock-titleflag" value=1 '.$title_checked.' /> 
	</label></li>';

	echo "\n";
        echo '<li style="list-style: none;font-size:9px;text-align:right;margin:20px 0px 0px 0px">*Save after each selection</li>';
	echo '</ul>';


    }


    /////////////////////////////////////////////////////////////////////////////////////////////////////
    //
    //	OUTPUT CLOCK WIDGET
    //
    /////////////////////////////////////////////////////////////////////////////////////////////////////

     function new_year_countdown_clock($args) 
     {

	// Get values 
      	extract($args);

      	$options = get_option('new_year_countdown_clock');

	// Get Title,Location,Size,

      	$title = htmlspecialchars($options['title'], ENT_QUOTES);
      	$titleflag = htmlspecialchars($options['titleflag'], ENT_QUOTES);
      	$transparentflag = htmlspecialchars($options['transparentflag'], ENT_QUOTES);
      	$group = htmlspecialchars($options['group'], ENT_QUOTES);
      	$countdown = htmlspecialchars($options['countdown'], ENT_QUOTES);
      	$text1 = htmlspecialchars($options['text1'], ENT_QUOTES);
      	$text2 = htmlspecialchars($options['text2'], ENT_QUOTES);
      	$background = htmlspecialchars($options['background'], ENT_QUOTES);
      	$event_day = htmlspecialchars($options['event_day'], ENT_QUOTES);
      	$event_month = htmlspecialchars($options['event_month'], ENT_QUOTES);
      	$event_year = htmlspecialchars($options['event_year'], ENT_QUOTES);
      	$size = htmlspecialchars($options['size'], ENT_QUOTES);
      	$type = htmlspecialchars($options['type'], ENT_QUOTES);
      	$typeflag = htmlspecialchars($options['typeflag'], ENT_QUOTES);
      	$text_color = htmlspecialchars($options['text_color'], ENT_QUOTES);
      	$border_color = htmlspecialchars($options['border_color'], ENT_QUOTES);
      	$background_color = htmlspecialchars($options['background_color'], ENT_QUOTES);
      	$timezone = htmlspecialchars($options['timezone'], ENT_QUOTES);

	$new_countdown_date = $event_year ."-" . $event_month . "-" . $event_day;

	if(empty($event_day) || empty($event_month) || empty($event_year) )
		$event_time = date('U',time()+3600*24*300);
	else{
		$dateTimeZoneUTC = new DateTimeZone("UTC");
        	$new_dateTimeUTC = new DateTime($new_countdown_date, $dateTimeZoneUTC);
 		$event_time =   $new_dateTimeUTC->format('U') ;
	}


	echo $before_widget; 




	// Output title
	echo $before_title . $title . $after_title; 


	// Output Clock


	$target_url= "http://mycountdown.org/$group/";
   	$target_url .= $countdown ."/";
	$target_url = str_replace(" ", "_", $target_url);

	$target_url .= $countdown ."/";
	$group = str_replace(" ", "+", $group);
	$countdown= str_replace(" ", "+", $countdown);
	$group_code = strtolower($group);

	$widget_call_string = 'http://mycountdown.org/wp_countdown-clock.php?group='.$group_code;
	$widget_call_string .= '&countdown='.$countdown;
	$widget_call_string .= '&widget_number='.$typeflag;
	$widget_call_string .= '&text1='.$text1;
	$widget_call_string .= '&text2='.$text2;

	if(empty($timezone))
		$timezone= "UTC";

	$widget_call_string .= '&timezone='.$timezone;

	$lgroup = strtolower($group);
	if($lgroup == "special+day" || $lgroup == "my+countdown" || $lgroup == "event")
		  $widget_call_string .= '&event_time='.$event_time;

	$widget_call_string .= '&img='.$background;

	#	IMG

	$transparent_string = "&hbg=0";
	if($transparentflag == 1){
     	     $transparent_string = "&hbg=1";
     	     $background_color="";
	}

	if($titleflag != 1){
	      $noscript_start = "<noscript>";
	      $noscript_end = "</noscript>";
	}


	echo'<!-New Year Countdown Clock widget - HTML code - mycountdown.org --><div align="center" style="margin:15px 0px 0px 0px">';

	echo $noscript_start . '<div align="center" style="width:140px;border:1px solid #ccc;background:'.$background_color.' ;color:'.$text_color.' ;font-weight:bold">';
	echo '<a style="padding:2px 1px;margin:2px 1px;font-size:12px;line-height:16px;font-family:arial;text-decoration:none;color:'.$text_color. ' ;" href="'.$target_url.'">';
	echo '<img src="http://mycountdown.org/images/countries/'.$group_code.'.png" border=0 style="border:0;margin:0;padding:0">&nbsp;&nbsp;'.$title.'</a></div>' . $noscript_end;

	$text_color = str_replace("#","",$text_color);
	$background_color = str_replace("#","",$background_color);
	$border_color = str_replace("#","",$border_color);

	$widget_call_string .= '&cp3_Hex='.$border_color.'&cp2_Hex='.$background_color.'&cp1_Hex='.$text_color. $transparent_string . $ampm_string. '&fwdt='.$size;


	echo '<script type="text/javascript" src="'.$widget_call_string . '"></script></div><!-end of code-->';




	echo $after_widget;


    }
  
    register_sidebar_widget('New Year Countdown Clock', 'new_year_countdown_clock');
    register_widget_control('New Year Countdown Clock', 'new_year_countdown_clock_control', 245, 300);


}


add_action('plugins_loaded', 'new_year_countdown_clock_init');


// This function print for selector clock color list

include("functions.php");


?>