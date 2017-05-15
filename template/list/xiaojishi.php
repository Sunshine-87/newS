</head>
	<body>
		<div class="weui-panel__bd" style="padding-bottom:53px;padding-top:50px;">
			<?php
				foreach ($jishi as $jishi) {
			?>
				<a href="index.php?c=xiaojishi&m=detail&id=<?php echo $jishi['id'] ?>" class="weui-media-box weui-media-box_appmsg">
					<div class="weui-media-box__hd">
						<img class="weui-media-box__thumb" src="<?php echo $jishi['imageUrl'] ?>" alt="">
					</div>
					<div class="weui-media-box__bd">
						<h4 class="weui-media-box__title"><?php echo $jishi['title'] ?></h4>
						<p class="weui-media-box__desc"><?php echo $jishi['content']; if ($jishi['long']) {
							echo '...';
						} ?></p>
					</div>
				</a>
			<?php
				}
			?>
		</div>