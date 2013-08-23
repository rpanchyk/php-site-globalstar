<div id="content_left">
  <h3>{TITLE}</h3>
 {SEND_RESULT}
  <form method="post" action="{ACTION}">
  <div id="form">
    <div id="fields">
      <label for="inputname">Имя:</label>
      <input type="text" name="sender_name" maxlength="256" />
      <br />
      <label for="inputmail">E-mail:</label>
      <input type="text" name="sender_mail" maxlength="256" />
      <br />
      <label for="inputmessage">Сообщение:</label>
      <textarea name="message" cols="28" rows="5"></textarea>
    </div>
    <div id="send">
	  <input type="hidden" name="subject" value="{SUBJECT}" />
	  <input type="hidden" name="shw" value="cnt" />
      <input type="image" name="doSend" src="{THEME}/images/send.gif" value="Send" />
    </div>
  </div>
  </form>
	<h3>Наш адрес</h3>
	<ul>
	  <li>г. Киев</li>
	  <li>ул. Драгоманова, 9</li>
	  <li>Тел.: 1234 123 23 45</li>
	  <li>Факс: 1234 123 23 45</li>
	  <li><a href="mailto:info@aqualive.com">info@aqualive.com</a></li>
	</ul>
</div>
