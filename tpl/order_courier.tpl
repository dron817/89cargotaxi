					<tr>
						<td id="%statusColor%">
							<a href="?route=lk/order/%n%">%n%</a>
						</td>
						<td id="%statusColor%">
							%date%
						</td>
						<td id="%statusColor%">
							%way%
						</td>
						<td id="%statusColor%">
							%weight%
						</td>	
						<td id="%statusColor%">
							%price%
						</td>
						<td id="%statusColor%">
							<select name="status" id="%n%" onchange="selectStatus(%n%);">
								<option value="1" %selected_order%>Оформлен</option>
								<option value="2" %selected_accepted%>Принят</option>
								<option value="3" %selected_inway%>В пути</option>
								<option value="4" %selected_done%>Доставлен</option>
								<option value="0" %selected_cancel%>Отклонён</option>
							</select>
						</td>
					</tr>