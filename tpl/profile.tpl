			<div class="forms">
				<form name="reg" method="post" action="index.php">
				<table>
					<tr>
						<td>
						</td>
						<td colspan="3">
							Редактирование профиля
						</td>
					</tr>
					<tr>
						<td>
							Ф. И. О.*
						</td>
						<td>
							<input type="text" name="FIO" required="required" value="%FIO%"/>
						</td>
					</tr>
					<tr>
						<td>
							Телефон*
						</td>
						<td>
							<input type="text" name="phone" required="required" value="%phone%"/>
						</td>
					</tr>
					<tr>
						<td>
							Второй телефон
						</td>
						<td>
							<input type="text" name="second-phone" value="%second-phone%"/>
						</td>
					</tr>
					<tr>
						<td>
							Аккаунт vk.com
						</td>
						<td>
							<input type="text" name="vk_link" value='%vk_link%'/>
						</td>
					</tr>
					<tr>
						<td>
							Аккаунт facebook
						</td>
						<td>
							<input type="text" name="facebook_link" value='%facebook_link%'/>
						</td>
					</tr>
					<tr>
						<td>
							Организация
						</td>
						<td>
							<input type="text" name="organization" id="long" value="%organization%"/>
						</td>
					</tr>
					<tr>
						<td>
							Страна*
						</td>
						<td>
						<div class="city-select">
							<select required="required" name="country" onchange="selectRegion();"> <option selected disabled value="">Выбор страны</option>
								%counries_options%		
							</select>
						</div>
						</td>
					</tr>
					<tr>
						<td>
							Регион*
						</td>
						<td>
						<div class="city-select">
							<select required="required" name="region" onchange="selectCity();">
								<option label="Выберите страну" selected="true" disabled value="">
								%regions_options%
							</select>
						</div>
						</td>
					</tr>
					<tr>
						<td>
							Город*
						</td>
						<td>
						<div class="city-select">
							<select required="required" name="city" onchange="getIndex();">
								<option label="Выберите регион" selected="true" disabled value="">
								%cities_options%
							</select>
						</div>
						</td>
					</tr>
					<tr>
						<td>
							Адрес*
						</td>
						<td>
							<input type="text" name="adress" required="required" id="long" value="%urseadress%"/>
						</td>
					</tr>
					<tr>
						<td>
							Почтовый индекс*
						</td>
						<td>
							<input type="text" name="index" required="required" id="short" value="%index%"/>
						</td>
					</tr>
					<tr>
						<td>
							Старый пароль
						</td>
						<td>
							<input type="password" name="oldpassword" class="regpass" id="short"/>
						</td>
					<tr>
						<td>
							Новый пароль
						</td>
						<td>
							<input type="password" name="newpassword" class="regpass" id="short"/>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td>
							%message%</br><input name="editUser" class="y-btn" type="submit" value="Сохранить"/>
						</td>
					</tr>
				</table>
				</form>
			</div>