<style>
		body{
		min-height: 100%;
		font-family: "メイリオ", Meiryo, "ＭＳ Ｐゴシック", "Helvetica Neue", Verdana, arial, helvetica, clean, sans-serif;
		font-size: 14px;
		}
		a{
			color: #883ced;
		}
		a:hover{
			color: #af4cf0;
		}

	</style>
<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "index" ); ?>'><?php echo Html::anchor('dashboad/index','Index');?></li>
	<li class='<?php echo Arr::get($subnav, "add" ); ?>'><?php echo Html::anchor('dashboad/add','Add');?></li>

</ul>

<?php echo \Form::open('dashboad/add'); ?>

<h1><?php echo Asset::img('elephant.gif'); ?>今日、なに食べた？<?php echo Asset::img('elephant.gif'); ?></h1>
<div class="">
	<div class="form-group">
		<?php echo \Form::label('料理名', 'food_name'); ?>
		<?php echo \Form::input('food_name', '', array("class" => "form-control")); ?>
	</div>
	<div class="form-group">
		<?php echo \Form::label('おかね', 'price'); ?>
		<?php echo \Form::input('price', '', array("class" => "form-control")); ?>
	</div>
	<div class="form-group">
		<?php echo \Form::label('カロリー', 'calorie'); ?>
		<?php echo \Form::input('calorie', '', array("class" => "form-control")); ?>
	</div>
	<div class="form-group time">
		<?php echo \Form::label('時間', 'ate_at'); ?>
		<?php echo \Form::input('ate_at', '', array("class" => "form-control")); ?>
	</div>
	<button type="submit" class="btn btn-primary">add</button>
</div>

<?php echo \Form::close(); ?>
<script>
<!--
jQuery(document).ready(function($) {
var tp_opt = {
timeFormat : 'HH:mm',
showMeridian:false,
showSeconds:false,
disableFocus : true,
showInputs : false,
template : 'dropdown',
appendWidgetTo : 'body',
showSeconds : true,
defaultTime : false
}
$('.time').on('click', '#form_ate_at', function(){
  $(this).timepicker({showMeridian:false});
});
});
-->
</script>
