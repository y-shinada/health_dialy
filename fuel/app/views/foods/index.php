<h2>Listing <span class='muted'>Foods</span></h2>
<br>
<?php if ($foods): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Name</th>
			<th>Deleted at</th>
			<th>Deleted</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($foods as $item): ?>		<tr>

			<td><?php echo $item->name; ?></td>
			<td><?php echo $item->deleted_at; ?></td>
			<td><?php echo $item->deleted; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('foods/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('foods/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('foods/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Foods.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('foods/create', 'Add new Food', array('class' => 'btn btn-success')); ?>

</p>
