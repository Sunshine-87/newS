</head>
    <body>
        <div class="weui-panel__bd" style="padding-bottom:53px;padding-top:50px;">
            <?php
                foreach ($kuaidi as $kuaidi) {
            ?>
                <a href="index.php?c=lingkuaidi&m=detail&id=<?php echo $kuaidi['id'] ?>" class="weui-cell weui-cell_access weui-cell_link">
                    <div class="weui-media-box weui-media-box_text">
                        <h4 class="weui-media-box__title"><?php echo $kuaidi['place'] ?></h4>
                        <p class="weui-media-box__desc"><?php echo '截止时间：'.$kuaidi['kuaidiTime'] ?></p>
                    </div>
                </a>
            <?php
                }
            ?>
            
            
        </div>