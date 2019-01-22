<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
<script type="text/javascript" src="jquery-1.12.1.min.js"></script>
	%refreshscript%
	%scripts%
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="main.css" />
	<title>CarGoTaxi - Грузоперевозки</title>
</head>
<body>
	<div id="wrapper">
		<a href="#x" class="overlay" id="win1"></a>
		<div class="popup">
			<div class="forms">
				<form name="auth" method="post" action="index.php">
				<table>
					<tr>
						<td colspan="3">
							<h1>Введите номер телефона и мы вам перезвоним</h1>
						</td>
					</tr>
					<tr>
						<td>
							Ваш номер телефона
						</td>
						<td>
							<input name="callbackphone" type="text" required="required" value="%callbackphone%"/>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td>
							<input name="callback" class="y-btn" type="submit" value="Позвонить"/>
						</td>
					</tr>
					<tr>
						<td colspan="3">
							Ваш номер не будет использоваться для рассылок без вашего ведома или спама
						</td>
					</tr>
				</table>
				</form>
			</div>
			<a class="close"title="Закрыть" href="#close"></a>
		</div>
		<div class="callborder">
		</div>
		<div class="callborder2">
		</div>
		<a href="#win1" id="win_pop"><div class="callback">
		</div></a>
		<div id="header">
			<ul class="nav">
				<li><a href="%adress%"><img src="img/logo.png" alt="CarGoTaxi"></a></li>
				<li><a>Доставка</a>
					<ul class="subs">
						<li><a href="?route=order/express">Экспресс</a></li>
						<li><a href="?route=order/assembled">Сборный груз</a></li>
						<li><a href="?route=order/econom">Эконом</a></li>
						<li><a href="?route=order/calc">Расчёт стоимости</a></li>
					</ul>
				</li>
				<li><a>Информация</a>
					<ul class="subs">
						<li><a href="?route=info/rules">Правила оказания услуг</a></li>
						<li><a href="?route=info/taboo">Запрещённые грузы</a></li>
						<li><a href="?route=info/packing">Упаковка грузов</a></li>
						<li><a href="?route=info/express">Экспресс-доставка</a></li>
						<li><a href="?route=info/assembled">Сборные грузы</a></li>
					</ul>
				</li>
				<li><a href="?route=info/about">О компании</a></li>
				<li><a href="?route=info/contact">Контакты</a></li>
				<li><a href="?route=lk">Личный кабинет</a></li>
			</ul>
		</div>
		<div id="content">
		<div class="notifications">
		%notifications%
		</div>
%content%
		</div>
		<div class="bottom">
		<table>
		<tr>
			<td>
				<div id="logo-bot"></div>
				<div id="call">8(3452) 717-911</div>
				<div id="mail"><a href="mailto::webmaster@89cargotaxi.ru">webmaster@89cargotaxi.ru</a></div>
				<div id="adress">г.Тюмень</br>ул.Станислава Карнацевича,1</div>
				<div id="copyright"><b>CarGoTaxi</br>2009-2017</b></div>
			</td>
			<td style="vertical-align: bottom">
				<!-- Yandex.Metrika informer --> <a href="https://metrika.yandex.ru/stat/?id=41361079&amp;from=informer" target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/41361079/3_0_FFD95BFF_FDB93BFF_0_pageviews" style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" /></a> <!-- /Yandex.Metrika informer --> <!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter41361079 = new Ya.Metrika({ id:41361079, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/41361079" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
			</td>
		</tr>
		</table>
		</div>
</body>
		