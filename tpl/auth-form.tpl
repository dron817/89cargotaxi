			<div class="banner userbanner">
				<div id="container">
					<h1>Для зарегистрированных клиентов</h1>
					<h3>- наличие адресной книги, оформление накладной займет 7 секунд;</br>- онлайн отслеживание состояния доставки по многим критериям;</br>- удобная привязка отправлений;</br>- своевременное получение новостей;</h3>
				</div>
			</div>
			<div class="forms">
				<form name="auth" method="post" action="index.php">
				<table>
					<tr>
						<td>
						</td>
						<td colspan="3">
							Для доступа к личному кабинету необходима авторизация
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td colspan="3">
							%message%
						</td>
					</tr>
					<tr>
						<td>
							E-mail
						</td>
						<td>
							<input name="login" type="email" required="required"/>
						</td>
					</tr>
					<tr>
						<td>
							Пароль
						</td>
						<td>
							<input name="password" type="password" required="required" class="regpass" id="short"/>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td>
							<input name="auth" class="y-btn" type="submit" value="Вход"/>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td colspan="3">
							Ещё нет аккаунта? <a href="%adress%?route=reg">Зарегистрироваться</a>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td colspan="3">
							<a href="%adress%?route=forgetpass">Забыли пароль?</a>
						</td>
					</tr>
				</table>
				</form>
			</div>