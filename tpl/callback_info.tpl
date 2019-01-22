					<tr>
						<td id="%statusColor%">
							%id%
						</td>
						<td id="%statusColor%">
							%date%
						</td>
						<td id="%statusColor%">
							%phone%
						</td>
						<td id="%statusColor%">
							<select name="status" id="%id%" onchange="selectCallbackStatus(%id%);">
								<option value="0" %selected_added%>Оформлен</option>
								<option value="1" %selected_done%>Выполнен</option>
							</select>
						</td>
					</tr>