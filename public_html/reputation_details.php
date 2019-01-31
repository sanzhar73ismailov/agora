<?
#################################################################
## PHP Pro Bid v6.06															##
##-------------------------------------------------------------##
## Copyright ©2007 PHP Pro Software LTD. All rights reserved.	##
##-------------------------------------------------------------##
#################################################################

session_start();

define ('IN_SITE', 1);

include_once ('includes/global.php');
include_once ('includes/class_formchecker.php');
include_once ('includes/class_custom_field.php');
include_once ('includes/class_item.php');
include_once ('includes/class_reputation.php');

(string) $message_content = null;

$reputation = new reputation();

$custom_header = $template->process('empty_header.tpl.php');
$template->set('custom_header', $custom_header);

$custom_footer = $template->process('empty_footer.tpl.php');
$template->set('custom_footer', $custom_footer);

$user_details = $db->get_sql_row("SELECT username, enable_aboutme_page, aboutme_page_content, shop_account_id, shop_active FROM
	" . DB_PREFIX . "users WHERE user_id='" . $_REQUEST['user_id'] . "'");




$query_ts = "SELECT r.*, a.auction_id AS aucid, a.name AS aucname, f.user_id AS fuser_id, f.username AS fusername FROM " . DB_PREFIX . "reputation r
		INNER JOIN " . DB_PREFIX . "auctions a ON r.auction_id=a.auction_id 
		INNER JOIN " . DB_PREFIX . "users f ON r.from_id=f.user_id 
		WHERE reputation_id='" . $_REQUEST['reputation_id'] . "'";

$reputation_details = $db->get_sql_row($query_ts);

$custom_fld = new custom_field();

$custom_fld->new_table = false;
$custom_fld->field_colspan = 1;
$page_handle = $reputation->cf_page_handle($reputation_details);
//$custom_sections_table = $custom_fld->display_sections($user_details, $page_handle, true, $_REQUEST['reputation_id']); //removed by Sanzhar 24.09.2013
$custom_sections_table = '<strong>'.MSG_AUCTION_ID.': '. $reputation_details['aucid'] . '</strong><p>'; // added by Sanzhar 24.09.2013
$custom_sections_table .= '<strong>'.MSG_ITEM_TITLE.': '. $reputation_details['aucname'] . '</strong><p>'; // added by Sanzhar 24.09.2013
$custom_sections_table .= '<strong>'.MSG_USER.': '. $reputation_details['fusername'] . '</strong><p>'; // added by Sanzhar 24.09.2013
$custom_sections_table .= $reputation_details['reputation_content']; // added by Sanzhar 24.09.2013

$message_content =
   '<table width="100%" border="0" cellspacing="2" cellpadding="3" class="border"> '.
   '	<tr> '.
   '		<td class="c4" colspan="2"><strong>' . MSG_REPUTATION_DETAILS . '</strong></td> '.
   '	</tr> '.
   '<tr><td>' .
	$custom_sections_table .
	'</td></tr>' .
	'</table>';

$template->set('message_content', $message_content);

$template_output .= $template->process('single_message.tpl.php');

echo $template_output;

?>