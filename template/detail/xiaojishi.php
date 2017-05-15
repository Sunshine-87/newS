</head>
<body>
<div class="page__bd">
    <article class="weui-article">
        <h1><?php echo $detail['title']; ?></h1>
            <p>
                <?php echo $detail['content']; ?>
            </p>
            <?php
        	if (!empty($detail['image'])) {
        		echo "<p>";
	        		foreach ($detail['image'] as $imageurl) {
	                	echo '<img width="300px" src="'.$imageurl.'" alt="">';
	            	}
            	echo "</p>";
        	}
            ?>
    </article>
</div>