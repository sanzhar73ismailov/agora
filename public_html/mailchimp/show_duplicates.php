<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Show <?php echo $_REQUEST["table"]; ?></title>
</head>
<body>
<h2><a href="index.php">Обратно на форму</a></h2>
<?php include 'config.php'; ?>
<?php include 'functions.php'; ?>

<a href="show_duplicates.php?submit=1">Просмотреть дубликаты</a><p/>
<a href="show_duplicates.php?submit=1&markdelete=1">Пометить дубликаты удаленными</a>


<?php
$query =  "select 
a.owner_id, u.username,a.name,
max(a.auction_id) as max_auction_id,
group_concat(a.auction_id) as auction_list,
count(*) as num
from probid_auctions a
inner join auction_media_view m on (a.auction_id=m.auction_id) 
inner join probid_users u on (a.owner_id=u.user_id)
where closed=0 and is_relisted_item=1 
group by
a.name,
a.description,
a.picpath,
a.quantity,
a.auction_type,
a.start_price,
a.reserve_price,
a.buyout_price,
a.bid_increment_amount,
a.duration,
a.country,
a.zip_code,
a.shipping_method,
a.shipping_int,
a.payment_methods,
a.category_id,
a.active,
a.payment_status,
a.start_time_old,
a.end_time_old,
a.nb_bids,
a.max_bid,
a.owner_id,
a.hpfeat,
a.catfeat,
a.bold,
a.hl,
a.hidden_bidding,
a.currency,
a.auction_swapped,
a.postage_amount,
a.insurance_amount,
a.type_service,
a.enable_swap,
a.direct_payment_paid,
a.addl_category_id,
a.live_pm_amount,
a.live_pm_date,
a.live_pm_processor,
a.shipping_details,
a.hpfeat_desc,
a.reserve_offer,
a.reserve_offer_winner_id,
a.list_in,
a.close_in_progress,
a.bid_in_progress,
a.bank_details,
a.direct_payment,
a.apply_tax,
a.auto_relist_bids,
a.end_time_type,
a.approved,
a.count_in_progress,
a.listing_type,
a.is_offer,
a.offer_min,
a.offer_max,
a.creation_in_progress,
a.state,
a.start_time_type,
a.retract_in_progress,
a.is_draft,
a.nb_offers,
a.item_weight,
a.fb_decrement_amount,
a.fb_decrement_interval,
a.fb_next_decrement,
a.fb_current_bid,
a.bulk_list,
a.bulk_id,
a.disable_sniping,
m.media_url
having num >1
order by num desc
";


if(isset($_REQUEST["submit"])){

   //$table = $_REQUEST["table"];
	//маркируем дубликаты на удаление
	if(isset($_REQUEST["markdelete"])){
		$result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());
	
		if($result){
		// Выводим результаты в html
		echo "<table border='1'>\n";
		while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
			echo "\t<tr>\n";
			$max_id = $line['max_auction_id'];
			$auction_list = $line['auction_list'];
			$queryToMarkDelete = "UPDATE probid_auctions set deleted=1, closed=1 where auction_id in ($auction_list) AND auction_id != $max_id";
			
			echo "\t</tr>\n";
			$resultUpdate = mysql_query($queryToMarkDelete) or die('обновление не удалось: ' . mysql_error());
			if(!$resultUpdate )
			{
			  die('Could not update data: ' . mysql_error());
			}
			echo "<td>$max_id</td><td>$auction_list</td><td>Updated data successfully</td><td>$resultUpdate</td>";
			
		}
		echo "</table>\n";
		
		echo "==========================\n";

		// Освобождаем память от результата
		mysql_free_result($result);
	}else{
		echo "Проблема с починкой таблицы<br/>\n";
	}
	
	}
    
if(1==1) {
echo "<h1>Аукционы-дубликаты</h1>";
	$result = mysql_query($query) or die('Запрос не удался: ' . mysql_error());
	
	if($result){
		// Выводим результаты в html
		echo "<table border='1'>\n";
		while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
			echo "\t<tr>\n";
			foreach ($line as $col_value) {
				echo "\t\t<td>$col_value</td>\n";
			}
			echo "\t</tr>\n";
		}
		echo "</table>\n";
		
		echo "==========================\n";

		// Освобождаем память от результата
		mysql_free_result($result);
	}else{
		echo "Проблема с починкой таблицы<br/>\n";
	}

}else{
	echo "Откуда приехали?<br/>\n";
}
}

?>

</body>
</html>
