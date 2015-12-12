<div class="wrap_feed_back">
<!--	<div class="interest_top_line"></div>-->
	<div class="feed_back_title">
			<span>Не можете определиться с выбором?</span>
			<span class="feed_back_title_desc">Оставь контакты, мы поможем с выбором подарка! </span>
			<span class="feed_back_title_desc_min">... a вы не тратите время в очередях супермаркетов</span>
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