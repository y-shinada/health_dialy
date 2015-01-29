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
		.btn.btn-primary{color:#ffffff!important;background-color:#883ced;background-repeat:repeat-x;background-image:-khtml-gradient(linear, left top, left bottom, from(#fd6ef7), to(#883ced));background-image:-moz-linear-gradient(top, #fd6ef7, #883ced);background-image:-ms-linear-gradient(top, #fd6ef7, #883ced);background-image:-webkit-gradient(linear, left top, left bottom, color-stop(0%, #fd6ef7), color-stop(100%, #883ced));background-image:-webkit-linear-gradient(top, #fd6ef7, #883ced);background-image:-o-linear-gradient(top, #fd6ef7, #883ced);background-image:linear-gradient(top, #fd6ef7, #883ced);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#fd6ef7', endColorstr='#883ced', GradientType=0);text-shadow:0 -1px 0 rgba(0, 0, 0, 0.25);border-color:#883ced #883ced #003f81;border-color:rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);}
		body { margin: 0px 0px 40px 0px; }
	</style>
<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "index"); ?>'><?php echo Html::anchor('dashboad/index', 'Index'); ?></li>
	<li class='<?php echo Arr::get($subnav, "add"); ?>'><?php echo Html::anchor('dashboad/add', 'Add'); ?></li>

</ul>
<p>Index</p>
	<header>
		<div class="container">
			<div id="logo"></div>
		</div>
	</header>