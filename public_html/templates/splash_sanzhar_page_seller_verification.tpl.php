<?
// ################################################################
// # PHP Pro Bid v6.02 ##
// #-------------------------------------------------------------##
// # Copyright �2007 PHP Pro Software LTD. All rights reserved. ##
// #-------------------------------------------------------------##
// ################################################################
if (! defined ( 'INCLUDED' )) {
	die ( "Access Denied" );
}
?>
<?
/*
 * Шаблон сделан на основании splash_page_seller_verification.tpl.php
 * поля массива user_verif_details: 
 * verification_fee - сумма взноса (например 360) 
 * currency - тип валюты 
 * verification_recurring - период повторной оплаты в днях (напр.30 дней) 
 * seller_verif_last_payment - дата последней оплаты в timestamp 
 * seller_verif_next_payment - дата последующей оплаты в timestamp 
 * sendto_email - email админа, куда посылать деньги
 * Чтобы вывести все значения: <? print_r($user_verif_details); ?>
 */
?>
<table width="80%" border="0" cellpadding="5" cellspacing="0"
	class="errormessage" align="center">
	<tr>
		<td class="contentfont">
			<h5 style="margin-bottom: 5px;">Чтобы разместить товары вам необходимо призвести оплату</h5>
      	Размер оплаты - <b><?=$user_verif_details["verification_fee"];?> <?=$user_verif_details["currency"];?></b><br />
      	Это вам дает возможность выставлять неограниченное количество лотов в течение <b><?=$user_verif_details["verification_recurring"];?> дней</b>.<br /><br />


			<h3 style="margin-bottom: 5px;">Прозвести оплату можно одним из следующих способов:</h3>
			
					<p>
					<b>1. Киви кошелек</b><br/> 
					Пополнив свой кошелек, вы заходите в свой личный кабинет и оттуда нажимаете "Перевести", 
					затем нажимаете "На другой кошелек" и вводите этот номер телефона: +77772649235, затем вводите вышеуказанную сумму, 
					выберите KZT и нажмите "Оплатить". <br/> 
					[ Детали смотрите здесь: <a target="_blank" href="https://qiwi.com/">https://qiwi.com/</a> ]
					</p>
	
					<p>
					<b>2. Kaspi кошелек</b><br/>
					Пополнить просто.<br/>
					1.Найдите ближайший терминал Kaspi (более 4 000 по всему Казахстану).<br/> 
					2.Введите мобильный +7 (777) 264-92-35 и эту дату рождения: 01/09/1961, то есть 1 сентября, 1961 года.<br/> 
					3.Внесите вышеуказанную сумму.<br/> 
					[ Детали смотрите здесь: <a target="_blank" href="https://kaspi.kz/pay?ref=tabPayments">https://kaspi.kz/pay?ref=tabPayments</a> ]
					</p>
					
				   <p>
				   <b>Как сообщить об оплате </b><br/>
				   Необходимо прислать сообщение на электронный адрес  <a href="mailto:<?=$user_verif_details["sendto_email"];?>"><?=$user_verif_details["sendto_email"];?></a>
				   или через страницу <a target="_blank" href="content_pages.php?page=contact_us">Связаться с нами</a>, 
				    сообщая следующую информацию:<br/> 
					а) номер транзакции<br/> 
					б) имя пользователя (логин)<br/> 
					в) номер сотового телефона владельца кошелька<br/>
					г) сканкопию чека из терминала, если оплатили через Kaspi кошелек<br/>
				   </p>
		
		
		</td>
		<tr>
		<td class="contentfont">
		<br/><br/><br/>
		<h5 style="margin-bottom: 5px;">Информация по платежам</h5>
		<? if ($user_verif_details["seller_verif_last_payment"] > 0) { ?>
            Дата последнего платёжа: <?= date("d-m-Y H:i:s", $user_verif_details["seller_verif_last_payment"]);?><br />
            <? } ?>
            <? if ($user_verif_details["seller_verif_next_payment"] > 0) { ?>
            Дата окончания возможности выставления лотов: <?=date("d-m-Y H:i:s", $user_verif_details["seller_verif_next_payment"]);?><br />
            <? } ?>
		</td>
		</tr>
	</tr>
</table>

