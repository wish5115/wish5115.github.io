<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="BEESCMS企业网站管理系统">
<meta name="keywords" content="">
<title>BEESCMS</title>
<link href="http://wish5115.gh/template/default_en/images/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://wish5115.gh/template/default_en/images/jquery.js"></script>
</head>
<body>
<div class="head_login" id="user_login">
<form name="form1" action="http://wish5115.gh/member.php" method="post">
<label>User name:</label><input type="text" id="ajax_user" name="user" style="width:100px" />
<label>Password:</label><input type="password" id="ajax_password" name="password" style="width:100px" />
<label>Code:</label><input type="text" name="code" id="ajax_code" style="width:50px" /><img src="http://wish5115.gh/includes/code.php" name="code" border="0" id="code" style="display:block; float:left;cursor:pointer; margin-left:5px; display:inline"/>
<input type="hidden" id="ajax_lang" value="en" name="lang" /><input type="button" style="border:0; margin-left:5px; display:inline; padding:0" src="http://wish5115.gh/template/default_en/images/login_input2.gif" name="go" id="ajax_login" />
<label><a href="http://wish5115.gh/member/member.php?action=regist&lang=en">Regist</a></label>
</form>
<div class="clear"></div>
</div><!--登录-->
<script type="text/javascript">
$(document).ready(function(){
	$('#code').click(function(){
	$(this).attr('src','http://wish5115.gh/includes/code.php?tag='+new Date().getTime());
	});
	$.ajax({
			type:"POST",
			url:"http://wish5115.gh/member.php",
			data:"action=is_ajax_login&lang="+"en",
			dataType:"json",
			success:function(data){
				if(data.login==1){
					$('#user_login').html(data.info);
				}
			}	
	});
	$('#ajax_login').click(function(){
		$.ajax({
			type:"POST",
			url:"http://wish5115.gh/member.php",
			data:"action=ajax_login&lang="+$('#ajax_lang').val()+"&password="+$('#ajax_password').val()+"&user="+$('#ajax_user').val()+"&code="+$('#ajax_code').val(),
			dataType:"json",
			success:function(data){
				if(data.login==1){
					$('#user_login').html(data.info);
				}else{
					alert(data.info);
				}
			}
		});
	});
	
});
</script>

<div class="contain">
<div class="head">
 <div class="head_top"><a href="#">Contact Us</a><a href="#">Add To Favorites</a><a href="http://wish5115.gh/" >简体中文</a><a href="http://wish5115.gh/index.php?lang=en" class="focus">English</a></div>
 <div class="head_logo">
  <div class="logo"></div>
  <div class="nav">
  <div class="nav_right">
   <ul>
    <li class="nav_left"></li>
	<li class="focus"><a href="http://wish5115.gh/index.php?lang=en">Home</a></li>
		<li class=""><a href="http://wish5115.gh/article/article.php?id=18"  title="News">News</a></li>
		<li class=""><a href="http://wish5115.gh/product/product.php?id=19"  title="Product">Product</a></li>
		<li class=""><a href="http://wish5115.gh/job/job.php?id=21"  title="Job">Job</a></li>
		<li class=""><a href="http://wish5115.gh/down/down.php?id=20"  title="Down">Down</a></li>
		<li class=""><a href="http://wish5115.gh/alone/alone.php?id=22"  title="About Us">About Us</a></li>
	   </ul>
   </div>
   <div class="clear"></div>
  </div>
 </div><!--导航-->
</div>
</div><!--顶部-->
<div class="flash">
<script language='javascript'>
linkarr = new Array();
picarr = new Array();
textarr = new Array();
var swf_width=950;
var swf_height=200;
var files = "";
var links = "";
var texts = "";
//这里设置调用标记
linkarr[1] = "http://www.beescms.com";
picarr[1]  = "/upload/img/20121208/201212082315546094.gif";
linkarr[2] = "http://www.beescms.com";
picarr[2]  = "/upload/img/20121208/201212082315531698.gif";
for(i=1;i<picarr.length;i++){
  if(files=="") files = picarr[i];
  else files += "|"+picarr[i];
}
for(i=1;i<linkarr.length;i++){
  if(links=="") links = linkarr[i];
  else links += "|"+linkarr[i];
}
for(i=1;i<textarr.length;i++){
  if(texts=="") texts = textarr[i];
  else texts += "|"+textarr[i];
}
document.write('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="'+ swf_width +'" height="'+ swf_height +'">');
document.write('<param name="movie" value="/data/flash_ad/ad_1/bcastr.swf"><param name="quality" value="high">');
document.write('<param name="menu" value="false"><param name=wmode value="opaque">');
document.write('<param name="FlashVars" value="bcastr_file='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'">');
document.write('<embed src="/data/flash_ad/ad_1/bcastr.swf" wmode="opaque" FlashVars="bcastr_file='+files+'&bcastr_link='+links+'&bcastr_title='+texts+'& menu="false" quality="high" width="'+ swf_width +'" height="'+ swf_height +'" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />'); document.write('</object>'); 
</script></div><!--幻灯--><div class="contain" style="margin-top:8px;">
 <div class="main_left">
  <h2 class="title"><span class="search_icon">Search</span></h2>
  <div class="search">
  <form name="form1" action="http://wish5115.gh/search/search.php?lang=en" method="post" style="margin-top:5px;">
  <input name="key" style="width:100px; display:block; float:left; height:20px; line-height:19px;"/><input type="submit" name="submit" value="Search" style="border:1px solid #CC3300; background:#FF9900; color:#FFFFFF; margin-left:5px; padding:2px 0;" />
  </form>
  </div><!--搜索-->
  <h2 class="title" style="margin-top:15px;"><span class="link_icon">Contact</span></h2>
  <div class="link">
   </div>
  <h2 class="title"><span class="pr_icon">Product navigation</span></h2>
  <ul class="pr_nav">
  	  </ul>
 </div><!--左边-->
 <div class="main_right">
  <h2 class="title2"><span>About Us</span></h2>
  <div class="us"></div>
  <div class="index_pr_list">
   <div class="list_top">
    <div class="list_btn">
	<div class="dl_list">
			<dl>
	<dt><div class="img_top"><div class="img_btn"><a href="http://wish5115.gh/product/show_product.php?id=31"  title="Tai Ming Two-tail axis automatic lathe tool"><img src="http://wish5115.gh/upload/img/20121208/201212082353104864_thumb.jpeg" border="0" height="90" width="90" alt="Tai Ming Two-tail axis automatic lathe tool" /></a></div></div></dt>
	<dd class="title"><a href="http://wish5115.gh/product/show_product.php?id=31"  title="Tai Ming Two-tail axis automatic lathe tool">Tai Ming Two-tail axis automatic lathe tool</a></dd>
	<dd class="info">
	Taiwan&#39;s quality!!
	Japan shinko tapping new clutch(patent) great torque!
	spindle oil-free device!

	Hardware for the wholesale production:such as electronics,communications,computers,machinery,lighting,(cars,motorcycles)parts,St...</dd>
	</dl>
		<dl>
	<dt><div class="img_top"><div class="img_btn"><a href="http://wish5115.gh/product/show_product.php?id=30"  title="RSF-3 Universal Knife grinder "><img src="http://wish5115.gh/upload/img/20121208/201212082352344008_thumb.jpeg" border="0" height="90" width="90" alt="RSF-3 Universal Knife grinder " /></a></div></div></dt>
	<dd class="title"><a href="http://wish5115.gh/product/show_product.php?id=30"  title="RSF-3 Universal Knife grinder ">RSF-3 Universal Knife grinder </a></dd>
	<dd class="info"></dd>
	</dl>
		<dl>
	<dt><div class="img_top"><div class="img_btn"><a href="http://wish5115.gh/product/show_product.php?id=29"  title="RSF-7 Universal Knife grinder "><img src="http://wish5115.gh/upload/img/20121208/201212082351546777_thumb.jpeg" border="0" height="90" width="90" alt="RSF-7 Universal Knife grinder " /></a></div></div></dt>
	<dd class="title"><a href="http://wish5115.gh/product/show_product.php?id=29"  title="RSF-7 Universal Knife grinder ">RSF-7 Universal Knife grinder </a></dd>
	<dd class="info"></dd>
	</dl>
		<dl>
	<dt><div class="img_top"><div class="img_btn"><a href="http://wish5115.gh/product/show_product.php?id=28"  title="Two-tail axis automatic lathe tool"><img src="http://wish5115.gh/upload/img/20121208/20121208235124_thumb.gif" border="0" height="90" width="90" alt="Two-tail axis automatic lathe tool" /></a></div></div></dt>
	<dd class="title"><a href="http://wish5115.gh/product/show_product.php?id=28"  title="Two-tail axis automatic lathe tool">Two-tail axis automatic lathe tool</a></dd>
	<dd class="info">
	Hardware for the wholesale production:such as electronics,communications,computers,machinery,lighting,(cars,motorcycles)parts ,Stationery,clocks and watches,toys,plastics and other industries axle parts stamping,riveting Nut,nuts and all ...</dd>
	</dl>
		<dl>
	<dt><div class="img_top"><div class="img_btn"><a href="http://wish5115.gh/product/show_product.php?id=27"  title="TY-45L CNC lathe"><img src="http://wish5115.gh/upload/img/20121208/201212082347169606_thumb.jpeg" border="0" height="90" width="90" alt="TY-45L CNC lathe" /></a></div></div></dt>
	<dd class="title"><a href="http://wish5115.gh/product/show_product.php?id=27"  title="TY-45L CNC lathe">TY-45L CNC lathe</a></dd>
	<dd class="info">
	Name: CNC CNC lathe
	Type: Inclined bed rail line
	Model: TY-45L
	Brand: Taiwan Yu-Seiki
	Control system: preparation with customer needs
</dd>
	</dl>
		<dl>
	<dt><div class="img_top"><div class="img_btn"><a href="http://wish5115.gh/product/show_product.php?id=26"  title="VMC-1580 three-axis vertical machining hard track"><img src="http://wish5115.gh/upload/img/20121208/201212082346359518_thumb.jpeg" border="0" height="90" width="90" alt="VMC-1580 three-axis vertical machining hard track" /></a></div></div></dt>
	<dd class="title"><a href="http://wish5115.gh/product/show_product.php?id=26"  title="VMC-1580 three-axis vertical machining hard track">VMC-1580 three-axis vertical machining hard track</a></dd>
	<dd class="info">
	Type: Hard-axis vertical machining center rail
	1580 Model: VMC-1580
	Brand: Taiwan Yu-Seiki
	Product precision: Positioning Accuracy &plusmn; 0.005/300mm
	Control system: preparation with customer needs 
</dd>
	</dl>
		<dl>
	<dt><div class="img_top"><div class="img_btn"><a href="http://wish5115.gh/product/show_product.php?id=25"  title="VMC-1060L Vertical Machining hard-wire"><img src="http://wish5115.gh/upload/img/20121208/201212082345475149_thumb.jpeg" border="0" height="90" width="90" alt="VMC-1060L Vertical Machining hard-wire" /></a></div></div></dt>
	<dd class="title"><a href="http://wish5115.gh/product/show_product.php?id=25"  title="VMC-1060L Vertical Machining hard-wire">VMC-1060L Vertical Machining hard-wire</a></dd>
	<dd class="info">
	Type: Hard-wire a vertical machining center
	10600 Model: VMC-1060L
	Brand: Taiwan Yu-Seiki
	Product precision: Positioning Accuracy &plusmn; 0.005/300mm
	Control system: preparation with customer needs 
</dd>
	</dl>
		</div>
	<div class="clear"></div>
	<p style="text-align:right">
	<a href="product/product.php?id=19" style="padding-right:50px;">More>></a>
	</p>
	</div>
   </div>
  </div>
 </div><!--右边-->
 <div class="clear"></div>
</div><!--主体-->
<div class="index_link">
<h2 class="title2" style="border:none"><span>Links</span></h2>
<ul>
</ul>
<div class="clear"></div>
</div><!--友情-->

<div class="foot">
 <div class="foot_nav">
  <div class="foot_nav_left">
  <div class="foot_nav_right">
    <a href="http://wish5115.gh/sitemap/sitemap.php?lang=en" title="Site Map">Site Map</a>|
    <a href="http://wish5115.gh/book/book.php?lang=en" title="Guestbook">Guestbook</a>|
    </div>
  </div>
 </div>
    <p></p>
 <p></p>
 <p>powerd by <a href="http://www.beescms.com" target="_blank">BEESCMS</a></p>
</div><!--页脚-->
    <style type="text/css">
        /*浮动QQ在线客服*/
        .kf_contain{z-index:99; width:143px; right:0; top:100px; position:absolute}
        .kf_contain .kf_list{ width:142px; margin:0 auto; }
		.kf_contain .kf_list .kf_top{width:143px;background:url(http://wish5115.gh/template/default_en/images/kf_top.gif) no-repeat left top; height:119px;}
        .kf_list h2{background:url(http://wish5115.gh/template/default_en/images/kf_bg.png) no-repeat left top; height:18px; width:100px; text-align:center; line-height:18px; font-size:12px; font-weight:normal; color:#fff;margin-bottom:8px; margin-top:8px;}
		.kf_top .kf_time{margin-left:40px; padding-top:35px;}
		.kf_top .kf_time p{height:23px; line-height:23px; overflow:hidden; text-align:center}
		.kf_contain .kf_list .kf_body{padding-top:5px; background:url(http://wish5115.gh/template/default_en/images/kf_center.gif) repeat-y left top;padding-bottom:10px;overflow:hidden; text-align:center}
       
		.kf_body .kf_body_div{margin-left:40px; }
        .kf_contain .kf_list .kf_body ul{padding:0; width:133px; background-color:#FFFFFF; border:#FFFFFF 1px solid}
        .kf_contain .kf_list .kf_body li{font-size:9pt; list-style-type:none; height:25px; padding-right:5px; clear:both; display:block;}
        .kf_contain .kf_list .kf_body li span{line-height:25px; margin-left:10px;  display:block; vertical-align:middle}
		.kf_contain .kf_list .kf_body li span.lf{float:left}
		.kf_contain .kf_list .kf_body li span.lr{float:right}
		.kf_contain .kf_list  .kf_btm{height:32px; width:143px; background:url(http://wish5115.gh/template/default_en/images/kf_btm.gif) no-repeat left top;}
		.on_kf{width:32px; height:118px; float:right}
        /*浮动QQ在线客服*/
    </style>
    <form id="form1" runat="server">
    <div>
	<div  class="kf_contain" id="kf_contain">
		<div class="on_kf" id="on" onmouseover="kf_on();"><img src="http://wish5115.gh/template/default_en/images/kf_on.gif"  border="0" alt="客服"/></div>
        <div >
            <div class="kf_list" id="off" onmouseout="kf_off();" onmousemove="kf_on();">
				<div class="kf_top">
					<div class="kf_time">
						<h2>Working time</h2>
						<p>Monday to Sunday</p>
						<p>9:00 - 23:00</p>
					</div>
				</div>
                <div class="kf_body">
				<div class="kf_body_div">
					<h2>Online customer</h2>
										                        <p>
						<span class="lf">
                           <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=2429256177&site=qq&menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:2429256177:4" alt="点击这里给我发消息" title="点击这里给我发消息"></a>
						   </span>
						   <span class="lf">销售客服</span>
                        <p>
											
																																														</div>
                </div><!--中间-->
				<div class="kf_btm"></div><!--底部-->
            </div>
        </div>
    </div>
	</div>
    </form>


<script type="text/javascript">
    var tips;
    var theTop = 100/*这是默认高度,越大越往下*/;
    var old = theTop;
	var $on_e= document.getElementById("on");
	var	$off_e=document.getElementById("off");
    function initFloatTips() {
        document.getElementById("off").style.display = "none";
        tips = document.getElementById("kf_contain");
        moveTips();
    };
    function moveTips() {
        var sped = 50;
        if (window.innerHeight) {
            pos = window.pageYOffset
        }
        else if (document.documentElement && document.documentElement.scrollTop) {
            pos = document.documentElement.scrollTop
        }
        else if (document.body) {
            pos = document.body.scrollTop;
        }
        pos = pos - tips.offsetTop + theTop;
        pos = tips.offsetTop + pos / 10;
        if (pos < theTop) pos = theTop;
        if (pos != old) {
            tips.style.top = pos + "px";
            sped = 10;
        }
        old = pos;
        setTimeout(moveTips, sped);
    }
    initFloatTips();
	function kf_on(){
		$on_e.style.display = "none";
		$off_e.style.display = "block";
	}
	function kf_off(){
		$on_e.style.display = "block";
		$off_e.style.display = "none";
	}
</script>
</body>
</html>