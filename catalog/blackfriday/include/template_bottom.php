<div class="madvantages">
	<div class="shadowadv_top"></div>
		<div class="madvantages_title">
			<div class="madvantages_title_wr">
				<h2>Наши</h2>
				<span>Преимущества</span>
			</div>
		</div>
		<div class="madvantages_list">
			<a href="" class="madvantages_list_1">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/advantag1.jpg"/>
			</a>
			<a href="" class="madvantages_list_2">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/advantag2.jpg"/>
			</a>
			<a href="" class="madvantages_list_3">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/advantag3.jpg"/>
			</a>
		</div>
	<div class="shadowadv_bottom"></div>	
</div>
<a name="email_send"></a>
<div class="wrap_email_send">
	<span class="email_send">Хотите узнавать о наших скидках первыми?</span>
	<div class="email_send_form">
		<?=$success_mess_email_send?>
		
		<form action="#email_send" method="post">
			<input type="text" name="emailsend" placeholder="Введите E-mail"/>
			<input type="submit" name="emailsend_btn" value=""/>
		</form>
	</div>
</div>

<div class="wrap_interest">
	<div class="interest_top_line"></div>
	<div class="interest_title">
		Вас также могут<br>
		заинтересовать
	</div>
	<div class="interest_items">
		<a href="" class="interest_item_1">
			<img src="<?=SITE_TEMPLATE_PATH?>/images/interest_item1.jpg"/>
		</a>
		<a href="" class="interest_item_2">
			<img src="<?=SITE_TEMPLATE_PATH?>/images/interest_item2.jpg"/>
		</a>
		<a href="" class="interest_item_3">
			<img src="<?=SITE_TEMPLATE_PATH?>/images/interest_item3.jpg"/>
		</a>
	</div>
</div>

<div class="wrap_feed_back">
	<div class="interest_top_line"></div>
	<div class="feed_back_title">
		
			<span>Остались вопросы?</span>
			<span>Закажите обратный звонок</span>
		
	</div>
	<a href="" name="feed_back"></a>
	<div class="feed_back_form">
		<? echo $success_mess; ?>
		<?=($name_empt || $phone_empt || $comment_empt)?"<span class='error_mess'>Заполните все поля</span>":"";?>
		<form action="#feed_back" method="post">
		
			<div class="f_b_input"><span>Имя и фамилия</span>
				<input type="text" name="name" value="<?=($name_empt || $phone_empt || $comment_empt)?$_POST["name"]:"";?>" placeholder="" class="<?=($name_empt)?"b_r":"";?>"/>
			</div>
			<div class="f_b_input"><span>Телефон</span>
				<input type="text" name="phone" value="<?=($name_empt || $phone_empt || $comment_empt)?$_POST["phone"]:"";?>" placeholder="+7" class="<?=($phone_empt)?"b_r":"";?>"/>
			</div>
			<div class="f_b_input_text"><span>Комментарий</span>
				<textarea name="comment" class="<?=($comment_empt)?"b_r":"";?>"><?=($name_empt || $phone_empt || $comment_empt)?$_POST["comment"]:"";?></textarea>
			</div>
			
			<input type="submit" class="emailsend_btn_2" value=""/>
		</form>
		
	</div>
</div>