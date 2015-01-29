<h2>Viewing <span class='muted'>#<?php echo $timeline->id; ?></span></h2>

<p>
	<strong>User id:</strong>
	<?php echo $timeline->user_id; ?></p>
<p>
	<strong>Food id:</strong>
	<?php echo $timeline->food_id; ?></p>
<p>
	<strong>Ate at:</strong>
	<?php echo $timeline->ate_at; ?></p>
<p>
	<strong>Calorie:</strong>
	<?php echo $timeline->calorie; ?></p>
<p>
	<strong>Price:</strong>
	<?php echo $timeline->price; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $timeline->deleted_at; ?></p>
<p>
	<strong>Deleted:</strong>
	<?php echo $timeline->deleted; ?></p>

<?php echo Html::anchor('timelines/edit/'.$timeline->id, 'Edit'); ?> |
<?php echo Html::anchor('timelines', 'Back'); ?>