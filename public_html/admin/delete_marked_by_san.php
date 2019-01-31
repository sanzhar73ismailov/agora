<?

//session_start();

define ('IN_ADMIN', 1);
define ('IN_SITE', 1);

include_once ('../includes/global.php');
include_once ('../includes/class_formchecker.php');
include_once ('../includes/class_custom_field.php');
include_once ('../includes/class_user.php');
include_once ('../includes/class_fees.php');
include_once ('../includes/class_item.php');
include_once ('../includes/functions_item.php');
include_once ('../includes/functions_login.php');

    $item = new item();
	$item->setts = &$setts;
	$item->layout = &$layout;
	$item->relative_path = '../'; /* declared because we are in the admin */
	$sql_select_marked_deleted = $db->query("SELECT auction_id FROM " . DB_PREFIX . "auctions WHERE deleted=1");

	$delete_ids = null;

	while ($deleted_details = $db->fetch_array($sql_select_marked_deleted))
	{
		$delete_ids[] = $deleted_details['auction_id'];
	}

	$delete_array = $db->implode_array($delete_ids);

	$item->delete($delete_array, 0, true, true);
	$nb_deleted = count($delete_ids);
	if($nb_deleted > 0){
		echo "Удалено $nb_deleted аукционов\n";
	}
	
?>