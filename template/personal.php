<style type="text/css">
	.head-img {
	    position: absolute;
	    top: 0.35rem;
	    left: 0.62rem;
	    width: 1.43rem;
	    height: 1.43rem;
	    padding: 0.04rem;
	    border-radius: 1rem;
	    background-color: #fff;
	}
</style>
</head>
<body>
	<div class="weui-cell" style="background: url(image/head_back.png) no-repeat;">
        <div class="weui-cell__hd" style="position: relative;margin-right: 10px; ">
            <img src="<?php echo $head_photo ?>" style="width: 100px;display: block;border-radius:50%;">
        </div>
        <div class="weui-cell__bd">
            <p style="color: white">&nbsp;&nbsp;&nbsp;&nbsp;--<?php echo $nickname ?></p>
        </div>
    </div>
    <div class="weui-cells__title"></div>
    <div class="weui-cells">
        <div class="weui-cell weui-cell_access">
            <div class="weui-cell__bd">
                <span style="vertical-align: middle">我的求助</span>
            </div>
            <div class="weui-cell__ft"></div>
        </div>
        <div class="weui-cell weui-cell_access">
            <div class="weui-cell__bd">
                <span style="vertical-align: middle">我的任务</span>
            </div>
            <div class="weui-cell__ft"></div>
        </div>
        
    </div>
    <div class="weui-cells__title"></div>
    <div class="weui-cells">
    	<div class="weui-cell weui-cell_access">
            <div class="weui-cell__bd">
                <span style="vertical-align: middle">站內信</span>
                <?php if ($unread != 0) { ?>
                <span class="weui-badge" style="margin-left: 5px;"><?php echo $unread; ?></span>
                <?php } ?>
            </div>
            <div class="weui-cell__ft"></div>

            
        </div>
        <div class="weui-cell weui-cell_access">
            <div class="weui-cell__bd">
                <span style="vertical-align: middle">我的余额</span>
                <?php if ($unread != 0) { ?>
                <span class="weui-badge" style="margin-left: 5px;"><?php echo $unread; ?></span>
                <?php } ?>
            </div>
            <div class="weui-cell__ft"></div>
        </div>
        <div class="weui-cell weui-cell_access">
            <div class="weui-cell__bd">
                <span style="vertical-align: middle">我的资料</span>
            </div>
            <div class="weui-cell__ft"></div>
        </div>
    </div>