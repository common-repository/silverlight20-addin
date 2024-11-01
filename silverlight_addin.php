<?php
/*
Plugin Name: Silverlight2.0 Addin
Plugin URI: http://bitflow.info/online/?page_id=6
Description: An addin to host any silverlight2.0 application
Version: 0.9
Author: Jürgen Oberngruber
Author URI: http://www.bitflow.info/
*/

//[silverlight: url.xap, widht, height]

define("SILVERLIGHT_META_START", "[silverlight:");
define("SILVERLIGHT_META_END", "]");
define("SILVERLIGHT_TARGET", "<div id=\"silverlightControlHost\"><object data=\"data:application/x-silverlight,\" type=\"application/x-silverlight-2-b1\" width=\"###WIDTH###\" height=\"###HEIGHT###\"><param name=\"source\" value=\"###URL###\"/><param name=\"background\" value=\"white\" /><a href=\"http://go.microsoft.com/fwlink/?LinkID=108182\" style=\"text-decoration: none;\"><img src=\"http://go.microsoft.com/fwlink/?LinkId=108181\" alt=\"Get Microsoft Silverlight\" style=\"border-style: none\"/></a></object><iframe style='visibility:hidden;height:0;width:0;border:0px'></iframe></div>");

function silverlight_the_content($content)
{
	$found_pos = strpos($content, SILVERLIGHT_META_START);
	if(!$found_pos) return ($content);
	
	$embedded = substr($content, 0, $found_pos);
	$meta = explode(",", trim(substr($content, $found_pos+strlen(SILVERLIGHT_META_START), (strpos($content, SILVERLIGHT_META_END) - ($found_pos+strlen(SILVERLIGHT_META_START))))));

	$output = $embedded . SILVERLIGHT_TARGET;
	$url = trim($meta[0]);
	$width = trim($meta[1]);
	$height = trim($meta[2]);
	if(!strpos($content, "http://")) $url = get_option('silverlight_standard_location') . $url;
	if(strlen($width) <= 0) $width = get_option('silverlight_standard_width');
	if(strlen($height) <= 0) $height = get_option('silverlight_standard_height');
	$output = str_replace("###URL###",  $url, $output);
	$output = str_replace("###WIDTH###", $width, $output);
	$output = str_replace("###HEIGHT###", $height, $output);
	$output .= "<br />" . substr($content, strpos($content, SILVERLIGHT_META_END)+1);
    return ($output);
}

function silverlight_wp_head()
{
	echo "<style type=\"text/css\">\n<!-- Silverlight2.0-Addin -->\nhtml,body{height:100%;overflow:auto;}\nbody{padding:0;margin: 0;}\n#silverlightControlHost{height:100%;}\n</style>";
}

add_action('wp_head', 'silverlight_wp_head');
add_filter('the_content', 'silverlight_the_content');

/* ADMIN */

$silverlight_standard_location = get_option('silverlight_standard_location');
$silverlight_standard_width = get_option('silverlight_standard_width');


if ('insert' == $_POST['action'])
{
        update_option("silverlight_standard_location", $_POST['silverlight_standard_location']);
        update_option("silverlight_standard_width", $_POST['silverlight_standard_width']);
        update_option("silverlight_standard_height", $_POST['silverlight_standard_height']);
}

function silverlight_option_page()
{
?>

<!-- Start Optionen im Adminbereich (xhtml, außerhalb PHP) -->
        <div class="wrap">
          <h2>Silverlight2.0 Addin Options</h2>
          <form name="form1" method="post" action="<?=$location ?>">
          		<table border="0" cellpadding="0" cellspacing="15"">
                	<tr>
                    	<td width="230px"><strong><label>Standard Root Location</label>: </strong></p></td>
                        <td><input name="silverlight_standard_location" value="<?=get_option("silverlight_standard_location");?>" type="text" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="200px"><strong><label>Standard Width</label>: </strong></p></td>
                        <td><input name="silverlight_standard_width" value="<?=get_option("silverlight_standard_width");?>" type="text" /></td>
                    </tr>
                    
                    <tr>
                    	<td width="200px"><strong><label>Standard Height</label>: </strong></p></td>
                        <td><input name="silverlight_standard_height" value="<?=get_option("silverlight_standard_height");?>" type="text" /></td>
                    </tr>
                    
                    <tr>
                    	<td colspan="2"><input name="action" value="insert" type="hidden" /></td>
                    </tr>
                </table>
                <p><div class="submit"><input type="submit" name="Update" value="Update Silverlight2.0 Addin"  style="font-weight:bold;" /></div></p>
          </form>
        </div>

<?php
}

function silverlight_admin_menu()
{
	add_option("silverlight_standard_location","./");
	add_option("silverlight_standard_width","400");
	add_option("silverlight_standard_height","300");
	add_options_page('Silverlight2.0-Addin', 'Silverlight2.0-Addin', 9, __FILE__, 'silverlight_option_page'); 
}

add_action('admin_menu', 'silverlight_admin_menu');

?>