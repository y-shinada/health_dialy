<h2>Listing <span class='muted'>Timelines</span></h2>
<br>
<?php if ($timelines): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>User id</th>
			<th>Food id</th>
			<th>Ate at</th>
			<th>Calorie</th>
			<th>Price</th>
			<th>Deleted at</th>
			<th>Deleted</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($timelines as $item): ?>		<tr>

			<td><?php echo $item->user_id; ?></td>
			<td><?php echo $item->food_id; ?></td>
			<td><?php echo $item->ate_at; ?></td>
			<td><?php echo $item->calorie; ?></td>
			<td><?php echo $item->price; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td><?php echo $item->deleted; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('timelines/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('timelines/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('timelines/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Timelines.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('timelines/create', 'Add new Timeline', array('class' => 'btn btn-success')); ?>

</p>
