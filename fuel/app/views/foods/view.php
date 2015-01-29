<h2>Viewing <span class='muted'>#<?php echo $food->id; ?></span></h2>

<p>
	<strong>Name:</strong>
	<?php echo $food->name; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $food->deleted_at; ?></p>
<p>
	<strong>Deleted:</strong>
	<?php echo $food->deleted; ?></p>

<?php echo Html::anchor('foods/edit/'.$food->id, 'Edit'); ?> |
<?php echo Html::anchor('foods', 'Back'); ?>