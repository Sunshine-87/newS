</head>
    <body>
        <div class="weui-panel__bd" style="padding-bottom:53px;padding-top:50px;">
            <?php
                foreach ($qiubangzhu as $qiubangzhu) {
            ?>
                <a href="index.php?c=qiubangzhu&m=detail&id=<?php echo $qiubangzhu['id'] ?>" class="weui-cell weui-cell_access weui-cell_link">
                    <div class="weui-media-box weui-media-box_text">
                        <h4 class="weui-media-box__title"><?php echo $qiubangzhu['title'] ?></h4>
                        <p class="weui-media-box__desc"><?php echo $qiubangzhu['content']; if ($qiubangzhu['long']) {echo '...';} ?></p>
                    </div>
                </a>
            <?php
                }
            ?>
            
            
        </div>