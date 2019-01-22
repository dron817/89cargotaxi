			<div class="forms">
				<form name="reg" method="post" action="index.php">
				<p class="mesage red">%err_msg%</p>
				<table>
					<tr>
						<td>
						</td>
						<td colspan="3">
							<h1>Регистрация</h1>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td colspan="3">
							Уже есть аккаунт? <a href="%adress%?route=lk">Войти</a>
						</td>
					</tr>
					<tr>
						<td>
							E-mail*
						</td>
						<td>
							<input type="email" name="login" required="required"/>
						</td>
					</tr>
					<tr>
						<td>
							Ф. И. О.*
						</td>
						<td>
							<input type="text" name="FIO" required="required"/>
						</td>
					</tr>
					<tr>
						<td>
							Телефон*
						</td>
						<td>
							<input type="text" name="phone" required="required"/>
						</td>
					</tr>
					<tr>
						<td>
							Второй телефон
						</td>
						<td>
							<input type="text" name="second-phone"/>
						</td>
					</tr>
					<tr>
						<td>
							Организация
						</td>
						<td>
							<input type="text" name="organization" id="long"/>
						</td>
					</tr>
					<tr>
						<td>
							Страна*
						</td>
						<td>
						<div class="city-select">
							<select name="country" required="required" onchange="selectRegion();"><option selected disabled value=''>Выбор страны</option>
<option value="1">Россия</option><option value="3">Беларусь</option><option value="2">Украина</option><option value="4">Казахстан</option><option value="97">Китай</option><option value="19">Австралия</option><option value="20">Австрия</option><option value="5">Азербайджан</option><option value="21">Албания</option><option value="22">Алжир</option><option value="23">Американское Самоа</option><option value="24">Ангилья</option><option value="25">Ангола</option><option value="26">Андорра</option><option value="27">Антигуа и Барбуда</option><option value="28">Аргентина</option><option value="6">Армения</option><option value="29">Аруба</option><option value="30">Афганистан</option><option value="31">Багамы</option><option value="32">Бангладеш</option><option value="33">Барбадос</option><option value="34">Бахрейн</option><option value="3">Беларусь</option><option value="35">Белиз</option><option value="36">Бельгия</option><option value="37">Бенин</option><option value="38">Бермуды</option><option value="39">Болгария</option><option value="40">Боливия</option><option value="41">Босния и Герцеговина</option><option value="42">Ботсвана</option><option value="43">Бразилия</option><option value="44">Бруней-Даруссалам</option><option value="45">Буркина-Фасо</option><option value="46">Бурунди</option><option value="47">Бутан</option><option value="48">Вануату</option><option value="49">Великобритания</option><option value="50">Венгрия</option><option value="51">Венесуэла</option><option value="52">Виргинские острова, Британские</option><option value="53">Виргинские острова, США</option><option value="54">Восточный Тимор</option><option value="55">Вьетнам</option><option value="56">Габон</option><option value="57">Гаити</option><option value="58">Гайана</option><option value="59">Гамбия</option><option value="60">Гана</option><option value="61">Гваделупа</option><option value="62">Гватемала</option><option value="63">Гвинея</option><option value="64">Гвинея-Бисау</option><option value="65">Германия</option><option value="66">Гибралтар</option><option value="67">Гондурас</option><option value="68">Гонконг</option><option value="69">Гренада</option><option value="70">Гренландия</option><option value="71">Греция</option><option value="7">Грузия</option><option value="72">Гуам</option><option value="73">Дания</option><option value="231">Джибути</option><option value="74">Доминика</option><option value="75">Доминиканская Республика</option><option value="76">Египет</option><option value="77">Замбия</option><option value="78">Западная Сахара</option><option value="79">Зимбабве</option><option value="8">Израиль</option><option value="80">Индия</option><option value="81">Индонезия</option><option value="82">Иордания</option><option value="83">Ирак</option><option value="84">Иран</option><option value="85">Ирландия</option><option value="86">Исландия</option><option value="87">Испания</option><option value="88">Италия</option><option value="89">Йемен</option><option value="90">Кабо-Верде</option><option value="4">Казахстан</option><option value="91">Камбоджа</option><option value="92">Камерун</option><option value="10">Канада</option><option value="93">Катар</option><option value="94">Кения</option><option value="95">Кипр</option><option value="96">Кирибати</option><option value="97">Китай</option><option value="98">Колумбия</option><option value="99">Коморы</option><option value="100">Конго</option><option value="101">Конго, демократическая республика</option><option value="102">Коста-Рика</option><option value="103">Кот д`Ивуар</option><option value="104">Куба</option><option value="105">Кувейт</option><option value="11">Кыргызстан</option><option value="106">Лаос</option><option value="12">Латвия</option><option value="107">Лесото</option><option value="108">Либерия</option><option value="109">Ливан</option><option value="110">Ливийская Арабская Джамахирия</option><option value="13">Литва</option><option value="111">Лихтенштейн</option><option value="112">Люксембург</option><option value="113">Маврикий</option><option value="114">Мавритания</option><option value="115">Мадагаскар</option><option value="116">Макао</option><option value="117">Македония</option><option value="118">Малави</option><option value="119">Малайзия</option><option value="120">Мали</option><option value="121">Мальдивы</option><option value="122">Мальта</option><option value="123">Марокко</option><option value="124">Мартиника</option><option value="125">Маршалловы Острова</option><option value="126">Мексика</option><option value="127">Микронезия, федеративные штаты</option><option value="128">Мозамбик</option><option value="15">Молдова</option><option value="129">Монако</option><option value="130">Монголия</option><option value="131">Монтсеррат</option><option value="132">Мьянма</option><option value="133">Намибия</option><option value="134">Науру</option><option value="135">Непал</option><option value="136">Нигер</option><option value="137">Нигерия</option><option value="138">Нидерландские Антилы</option><option value="139">Нидерланды</option><option value="140">Никарагуа</option><option value="141">Ниуэ</option><option value="142">Новая Зеландия</option><option value="143">Новая Каледония</option><option value="144">Норвегия</option><option value="145">Объединенные Арабские Эмираты</option><option value="146">Оман</option><option value="147">Остров Мэн</option><option value="148">Остров Норфолк</option><option value="149">Острова Кайман</option><option value="150">Острова Кука</option><option value="151">Острова Теркс и Кайкос</option><option value="152">Пакистан</option><option value="153">Палау</option><option value="154">Палестинская автономия</option><option value="155">Панама</option><option value="156">Папуа - Новая Гвинея</option><option value="157">Парагвай</option><option value="158">Перу</option><option value="159">Питкерн</option><option value="160">Польша</option><option value="161">Португалия</option><option value="162">Пуэрто-Рико</option><option value="163">Реюньон</option><option value="1">Россия</option><option value="164">Руанда</option><option value="165">Румыния</option><option value="166">Сальвадор</option><option value="167">Самоа</option><option value="168">Сан-Марино</option><option value="169">Сан-Томе и Принсипи</option><option value="170">Саудовская Аравия</option><option value="171">Свазиленд</option><option value="172">Святая Елена</option><option value="173">Северная Корея</option><option value="174">Северные Марианские острова</option><option value="175">Сейшелы</option><option value="176">Сенегал</option><option value="177">Сент-Винсент</option><option value="178">Сент-Китс и Невис</option><option value="179">Сент-Люсия</option><option value="180">Сент-Пьер и Микелон</option><option value="181">Сербия</option><option value="182">Сингапур</option><option value="183">Сирийская Арабская Республика</option><option value="184">Словакия</option><option value="185">Словения</option><option value="186">Соломоновы Острова</option><option value="187">Сомали</option><option value="188">Судан</option><option value="189">Суринам</option><option value="9">США</option><option value="190">Сьерра-Леоне</option><option value="16">Таджикистан</option><option value="191">Таиланд</option><option value="192">Тайвань</option><option value="193">Танзания</option><option value="194">Того</option><option value="195">Токелау</option><option value="196">Тонга</option><option value="197">Тринидад и Тобаго</option><option value="198">Тувалу</option><option value="199">Тунис</option><option value="17">Туркмения</option><option value="200">Турция</option><option value="201">Уганда</option><option value="18">Узбекистан</option><option value="2">Украина</option><option value="202">Уоллис и Футуна</option><option value="203">Уругвай</option><option value="204">Фарерские острова</option><option value="205">Фиджи</option><option value="206">Филиппины</option><option value="207">Финляндия</option><option value="208">Фолклендские острова</option><option value="209">Франция</option><option value="210">Французская Гвиана</option><option value="211">Французская Полинезия</option><option value="212">Хорватия</option><option value="213">Центрально-Африканская Республика</option><option value="214">Чад</option><option value="230">Черногория</option><option value="215">Чехия</option><option value="216">Чили</option><option value="217">Швейцария</option><option value="218">Швеция</option><option value="219">Шпицберген и Ян Майен</option><option value="220">Шри-Ланка</option><option value="221">Эквадор</option><option value="222">Экваториальная Гвинея</option><option value="223">Эритрея</option><option value="14">Эстония</option><option value="224">Эфиопия</option><option value="226">Южная Корея</option><option value="227">Южно-Африканская Республика</option><option value="228">Ямайка</option><option value="229">Япония</option>
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
							<select name="region" required="required" onchange="selectCity();">
								<option label="Выберите страну" selected="true"  value='' disabled></option>
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
							<select name="city" required="required" onchange="getIndex();">
								<option label="Выберите регион" selected="true"  value='' disabled></option>
							</select>
						</div>
						</td>
					</tr>
					<tr>
						<td>
							Адрес*
						</td>
						<td>
							<input type="text" name="adress" required="required" id="long" />
						</td>
					</tr>
					<tr>
						<td>
							Почтовый индекс*
						</td>
						<td>
							<input type="text" name="index" required="required" id="short" />
						</td>
					</tr>
					<tr>
						<td>
							Пароль*
						</td>
						<td>
							<input type="password" name="password" required="required" class="regpass" id="short"/>
						</td>
					</tr>
					<tr>
						<td>
						</td>
					
						<td>
							<div class="g-recaptcha" data-sitekey="6Lc_SQ0UAAAAACP6wXMLk_gIdS0ScLIW1f2vfm8K"></div>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td>
							<input name="reg" class="y-btn" type="submit" value="Регистрация"/>
						</td>
					</tr>
				</table>
				</form>
			</div>