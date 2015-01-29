<h2>Editing <span class='muted'>Food</span></h2>
<br>

<?php echo render('foods/_form'); ?>
<p>
	<?php echo Html::anchor('foods/view/'.$food->id, 'View'); ?> |
	<?php echo Html::anchor('foods', 'Back'); ?></p>
