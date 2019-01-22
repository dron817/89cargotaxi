					<tr>
						<td id="%statusColor%">
							%id%
						</td>
						<td id="%statusColor%">
							%login%
						</td>
						<td id="%statusColor%">
							%regdate%
						</td>
						<td id="%statusColor%">
							%social%
						</td>
						<td id="%statusColor%">
							%n_orders%
						</td>
						<td id="%statusColor%">
							<select name="status" id="%id%" onchange="selectPowerGroup(%id%);">
								<option value="0" %selected_user%>Клиент</option>
								<option value="1" %selected_courier%>Курьер</option>
								<option value="2" %selected_admin%>Администратор</option>
							</select>
						</td>
						<td id="%statusColor%">
							<a href="?deleteUser=%id%">Удалить</a>
						</td>
					</tr>