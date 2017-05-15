</head>
<body>
<div class="page__bd">
    <div class="weui-cell" style="">
        <div id="showIOSDialog2" class="weui-cell__hd" style="position: relative;margin-right: 10px; ">
            <img src="http://wx.qlogo.cn/mmopen/apPRibXRhibwSBels4eUSiachQRSia2S5fykkk8jxPGGibo4AdwibkMKeEv4LXOVWzmib9ETq1w8hKH6vHPo5DzMtcZJtFLyz87dY3l/0" style="width: 100px;display: block;border-radius:50%;">
        </div>
        <div class="weui-cell__bd">
            <p style="">&nbsp;&nbsp;&nbsp;&nbsp;--徐博恒</p>
        </div>
    </div>
    <article class="weui-article">
        <h1><?php echo $detail['place']; ?></h1>
            <p>
                <?php
                if ($detail['destination'] != '') {
                    $t = '到'+$detail['destination'];
                } else {
                    $t = '';
                }
                echo $detail['nickname'].'有个包裹在'.$detail['place'].'，希望有人能在'.$detail['kuaidiTime'].'前帮他领取，你能帮帮他吗？你可以在'.$detail['getTime'].'把包裹送'.$t.'给他'; 
                ?>
            </p>
    </article>
    <div class="js_dialog" id="iosDialog1" style="opacity: 0;display:none">
        <div class="weui-mask"></div>
        <div class="weui-dialog">
            <div class="weui-dialog__hd"><img src="http://wx.qlogo.cn/mmopen/apPRibXRhibwSBels4eUSiachQRSia2S5fykkk8jxPGGibo4AdwibkMKeEv4LXOVWzmib9ETq1w8hKH6vHPo5DzMtcZJtFLyz87dY3l/0" style="width: 100px;display: block;border-radius:50%; margin:0 auto;"></div>
            <div class="weui-dialog__bd">徐博恒</div>
            <div style="list-style-type: none;" class="weui-dialog__bd"><li>完成任务：15</li>
            <li>受到帮助：3</li></div>
            <div class="weui-dialog__ft">
                <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_default" onclick="$(this).parents('.js_dialog').fadeOut(200);">了解了</a>
                <a href="javascript:;" class="weui-dialog__btn weui-dialog__btn_primary">联系他</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" class="dialog js_show">
$(function(){
    var $iosDialog2 = $('#iosDialog1');
        
    $('#showIOSDialog2').on('click', function(){
        $iosDialog2.attr('style','opacity: 1;');
    });

});</script>