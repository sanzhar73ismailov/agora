<?
#################################################################
## PHP Pro Bid v6.11															##
##-------------------------------------------------------------##
## Copyright �2007 PHP Pro Software LTD. All rights reserved.	##
##-------------------------------------------------------------##
#################################################################

session_start();

define ('IN_SITE', 1);

include_once ('includes/global.php');
include_once ('includes/class_fees.php');

include_once ('a_logger/logger.php'); // logger of sanzhar 04.04.2016
Logger::$PATH = dirname(__FILE__) . "/a_logs";// . "\logs";
$LOGGER = Logger::getLogger("pp_paypal.php", null, TO_LOG);
$LOGGER->log("START pp_paypal.php LOGGING");

/* code of Sanzhar start*/
$custom=104613;
$fee_table=6;
$active_pg = 'PayPal';
$payment_gross=360;
$txn_id="txn_id_123";
$payment_currency="KZT";
$process_fee = new fees();
$process_fee->setts = &$setts;
$process_fee->callback_process($custom, $fee_table, $active_pg, $payment_gross, $txn_id, $payment_currency);
/* code of Sanzhar end */

/*

(string) $active_pg = 'PayPal';
(string) $error_output = null;

$pg_enabled = $db->get_sql_field("SELECT checked FROM " . DB_PREFIX . "payment_gateways WHERE
	name='" . $active_pg . "' LIMIT 0,1", "checked");

if (!$pg_enabled) { die(GMSG_NOT_AUTHORIZED); }

$req = 'cmd=_notify-validate';

foreach ($_POST as $key => $value)
{
	$value = urlencode(stripslashes($value));
	$req .= '&' . $key . '=' . $value;
}

$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";

$fp = fsockopen ('www.paypal.com', 80, $errno, $errstr, 30);
//$fp = fsockopen('ssl://www.sandbox.paypal.com',443,$err_num,$err_str,30);

$payment_status = $_POST['payment_status'];
$payment_gross = $_POST['mc_gross'];
$payment_currency = $_POST['mc_currency'];
$txn_id = $_POST['txn_id'];

list($custom, $fee_table) = explode('TBL',$_POST['custom']);

if (!$fp)
{
	$error_output = $errstr . ' (' . $errno . ')';
}
else
{
	fputs ($fp, $header . $req);

	while (!feof($fp))
	{
		$res = fgets ($fp, 1024);

		if (strcmp ($res, "VERIFIED") == 0 && $payment_status == "Completed")
		{
			$process_fee = new fees();
			$process_fee->setts = &$setts;

			$process_fee->callback_process($custom, $fee_table, $active_pg, $payment_gross, $txn_id, $payment_currency);
			
		}
	}
	fclose ($fp);
}
*/

?>