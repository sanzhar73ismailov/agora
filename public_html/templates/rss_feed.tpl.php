<?
// ################################################################
// # PHP Pro Bid v6.00 ##
// #-------------------------------------------------------------##
// # Copyright �2007 PHP Pro Software LTD. All rights reserved. ##
// #-------------------------------------------------------------##
// ################################################################
if (! defined ( 'INCLUDED' )) {
	die ( "Access Denied" );
}
?>
<?=$header_message;?>

<br>
<table width="100%" border="0" align="center" cellpadding="3"
	cellspacing="2">
	<tr class="contentfont">
		<td valign="top"><p>
            
            RSS каналы позволят Вам просматривать заголовки аукционов <?=$setts['sitename']; ?> через мобильные устройства или 
            сервисы подписок на RSS каналы, такие как Google RSS Reader, Yandex rss reader, Yahoo rss reader и др. При нажатии на RSS ссылку Вы увидите XML код в 
            своем браузере и ссылку на подписку прямо через браузер, без использования сторонних служб 
            (недостаток использования браузера заключается в том, что при переустановке системы Вы можете потерять подписку). 
           
            		
			<p />Также Вы можете скопировать RSS ссылку и вставить в специальную программу RSS reader или мобильное устройство и 
            быть вкурсе всех новостей  <?=$setts['sitename']; ?>! 
           
           </td>
		<td valign="top"><table width="100%" border="0" align="center"
				cellpadding="3" cellspacing="2" class="border">
				<tr class="contentfont">
					<td valign="top" class="c3"><b>Выберите RSS Readers</b></td>
				</tr>
				<tr>
					<td class="c1" nowrap><p style="font-size: xx-small">
							<a href="http://www.rssreader.com/" target="blank">RSS Reader</a>
							&mdash; Windows; freeware<br> <a href="http://www.awasu.com/"
								target="blank">Awasu</a> &mdash; Windows; free for personal use<br>
							<!--  <a href="http://www.feedreader.com/" target="_blank">Feedreader</a> &mdash; Windows; freeware<br>  -->
							<a href="http://www.sharpreader.com/" target="blank">SharpReader</a>
							&mdash; Windows; freeware<br> <a href="http://my.yahoo.com/"
								target="_blank">My Yahoo!</a> &mdash; Web-based; free<br> <a
								href="http://reader.rocketinfo.com/desktop/" target="_blank">Rocket
								RSS Reader</a> &mdash; Web-based; free<br> <a
								href="http://www.pluck.com/" target="_blank">Pluck Reader</a>
							&mdash; Web-based; free
						</p></td>
				</tr>
			</table></td>
	</tr>
	<tr class="contentfont">
		<td valign="top" colspan="2"><blockquote>
				<p>
					<b>Недавно размещенные лоты</b><br> <a href="rss.php?feed=1"><img
						src="images/rss.gif" border="0" alt="" align="absmiddle"></a> <a
						href="http://add.my.yahoo.com/rss?url=<?=SITE_PATH;?>rss.php?feed=1"><img
						src="images/myyahoo.gif" border="0" alt="" align="absmiddle"></a>
					<a href="<?=SITE_PATH;?>rss.php?feed=1">
               <?=SITE_PATH;?>rss.php?feed=1</a>
				</p>
				<p>
					<b>Скоро закрывающиеся лоты</b><br> <a href="rss.php?feed=2"><img
						src="images/rss.gif" border="0" alt="" align="absmiddle"></a> <a
						href="http://add.my.yahoo.com/rss?url=<?=SITE_PATH;?>rss.php?feed=2"><img
						src="images/myyahoo.gif" border="0" alt="" align="absmiddle"></a>
					<a href="<?=SITE_PATH;?>rss.php?feed=2">
               <?=SITE_PATH;?>rss.php?feed=2</a>
				</p>
				<p>
					<b>Приоритетные лоты</b><br> <a href="rss.php?feed=3"><img
						src="images/rss.gif" border="0" alt="" align="absmiddle"></a> <a
						href="http://add.my.yahoo.com/rss?url=<?=SITE_PATH;?>rss.php?feed=3"><img
						src="images/myyahoo.gif" border="0" alt="" align="absmiddle"></a>
					<a href="<?=SITE_PATH;?>rss.php?feed=3">
               <?=SITE_PATH;?>rss.php?feed=3</a>
				</p>
				<p>
					<b>Особо ценные лоты</b><br> <a href="rss.php?feed=4"><img
						src="images/rss.gif" border="0" alt="" align="absmiddle"></a> <a
						href="http://add.my.yahoo.com/rss?url=<?=SITE_PATH;?>rss.php?feed=4"><img
						src="images/myyahoo.gif" border="0" alt="" align="absmiddle"></a>
					<a href="<?=SITE_PATH;?>rss.php?feed=4">
               <?=SITE_PATH;?>rss.php?feed=4</a>
				</p>
				<p>
					<b>Очень дорогие лоты</b><br> <a href="rss.php?feed=5"><img
						src="images/rss.gif" border="0" alt="" align="absmiddle"></a> <a
						href="http://add.my.yahoo.com/rss?url=<?=SITE_PATH;?>rss.php?feed=5"><img
						src="images/myyahoo.gif" border="0" alt="" align="absmiddle"></a>
					<a href="<?=SITE_PATH;?>rss.php?feed=5">
               <?=SITE_PATH;?>rss.php?feed=5</a>
				</p>
				<p>
					<b>Лоты от $10</b><br> <a href="rss.php?feed=6"><img
						src="images/rss.gif" border="0" alt="" align="absmiddle"></a> <a
						href="http://add.my.yahoo.com/rss?url=<?=SITE_PATH;?>rss.php?feed=6"><img
						src="images/myyahoo.gif" border="0" alt="" align="absmiddle"></a>
					<a href="<?=SITE_PATH;?>rss.php?feed=6">
               <?=SITE_PATH;?>rss.php?feed=6</a>
				</p>
				<p>
					<b>Лоты, где ставок больше 10</b><br> <a href="rss.php?feed=7"><img
						src="images/rss.gif" border="0" alt="" align="absmiddle"></a> <a
						href="http://add.my.yahoo.com/rss?url=<?=SITE_PATH;?>rss.php?feed=7"><img
						src="images/myyahoo.gif" border="0" alt="" align="absmiddle"></a>
					<a href="<?=SITE_PATH;?>rss.php?feed=7">
               <?=SITE_PATH;?>rss.php?feed=7</a>
				</p>
				<p>
					<b>Лоты, где ставок больше 25</b><br> <a href="rss.php?feed=8"><img
						src="images/rss.gif" border="0" alt="" align="absmiddle"></a> <a
						href="http://add.my.yahoo.com/rss?url=<?=SITE_PATH;?>rss.php?feed=8"><img
						src="images/myyahoo.gif" border="0" alt="" align="absmiddle"></a>
					<a href="<?=SITE_PATH;?>rss.php?feed=8">
               <?=SITE_PATH;?>rss.php?feed=8</a>
				</p>
				<p>
					<b>Лоты с опцией ВЫКУПИТЬ СЕЙЧАС</b><br> <a href="rss.php?feed=9"><img
						src="images/rss.gif" border="0" alt="" align="absmiddle"></a> <a
						href="http://add.my.yahoo.com/rss?url=<?=SITE_PATH;?>rss.php?feed=9"><img
						src="images/myyahoo.gif" border="0" alt="" align="absmiddle"></a>
					<a href="<?=SITE_PATH;?>rss.php?feed=9">
               <?=SITE_PATH;?>rss.php?feed=9</a>
				</p>
			</blockquote></td>
	</tr>
</table>
