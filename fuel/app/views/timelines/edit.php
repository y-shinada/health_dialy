<h2>Editing <span class='muted'>Timeline</span></h2>
<br>

<?php echo render('timelines/_form'); ?>
<p>
	<?php echo Html::anchor('timelines/view/'.$timeline->id, 'View'); ?> |
	<?php echo Html::anchor('timelines', 'Back'); ?></p>
