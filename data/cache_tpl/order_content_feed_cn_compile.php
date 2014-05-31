<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="<?php echo content('info');?>">
<meta name="keywords" content="<?php echo content('keywords');?>">
<title><?php echo content('title');?>_<?php echo cateinfo('cate_title_seo');?>_<?php echo webinfo('web_name');?></title>
<link href="<?php cmspath('template');?>/images/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php cmspath('template');?>/images/jquery.js"></script>
<script type="text/javascript" src="<?php cmspath('template');?>/images/nav.js"></script>
</head>
<body>
<?php $this->display('head',1,1);?>

<div class="contain">
	<div class="ct_left">
	
		<div class="div_list">
			<div class="div_list_body">
				
				<h2 class="title"><span>关于我们</span></h2>
				<div class="al_list_ct" style="height:auto">
					<?php $tree=get_tpl_list_nav();?>
					<div id="category_tree">
			<?php 
 $fun_return=$tree;if(isset($fun_return)&&is_array($fun_return)){
foreach($fun_return as $nav){?>
    <dl>
     <dt><a class="<?php echo $nav['class'];?>" href="<?php echo $nav['url'];?>" <?php echo $nav['target'];?> title="<?php echo $nav['cate_name'];?>"><?php echo $nav['cate_name'];?></a></dt>
	 
     <dd id="nav_16">
	 <ul>
	 <?php 
 $fun_return=$nav['child'];if(isset($fun_return)&&is_array($fun_return)){
foreach($fun_return as $v){?>
	  	 <li><a class="<?php echo $v['class'];?>" href="<?php echo $v['url'];?>"><?php echo $v['cate_name'];?>(<?php echo $v['content_num'];?>)</a></li>
     <?php 
}
}?>
     </ul>
	 </dd>
   </dl>
   <?php 
}
}?>
   
   </div><!--分页导航-->
					
					
				</div>
				
				
			</div>
		</div><!--区域-->
		
		<div class="div_list">
			<div class="div_list_body">
				<h2 class="title"><span>联系方式</span></h2>
				<div class="div_list_ct">
					<div class="contact" style="height:auto">
						<?php echo get_block_content('contact_us');?>
					</div>
				</div>
			</div>
		</div><!--区域-->
		
		
		
	</div><!--左边-->
	<div class="ct_right">
		
		<div class="div_list">
			<div class="div_list_body">
				<h2 class="title"><span>当前位置:&nbsp;<?php position(); ?></span></h2>
				<div class="content_ct">
					<div class="content_ct2">
						
						<?php echo get_form('9');?>
				<div class="clear"></div>
						
						
					</div>
				</div>
			</div>
		</div>
		
		<div class="div_list">
			<div class="div_list_body">
				<h2 class="title"><span>推荐产品</span></h2>
				<div class="div_list_ct">
					<?php $tj_pr=get_tpl_cate_content($tpl_id='3',$limit='0,4',$order_type='',$filter='',$pic='no',$order='',$lang='');?>
					<ul class="tj_pr_list" id="colee1">
					<?php 
 $fun_return=$tj_pr['contents'];if(isset($fun_return)&&is_array($fun_return)){
foreach($fun_return as $v){?>
						<li>
							<p><a href="<?php echo $v['url'];?>"><img src="<?php echo $v['thumb_pic'];?>" border="0" alt="<?php echo $v['title'];?>" /></a></p>
							<p class="tj_title"><a href="<?php echo $v['url'];?>" title="<?php echo $v['title'];?>"><?php echo $v['title'];?></a></p>
						</li>
					<?php 
}
}?>	
					</ul>
					<div class="clear"></div>
				</div>
			</div>
		</div><!--区域-->
		
		
	</div><!--右边-->
	<div class="clear"></div>
</div>



<?php $this->display('foot',1,1);?>
</body>
</html>