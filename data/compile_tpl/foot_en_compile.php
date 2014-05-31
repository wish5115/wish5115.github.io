
<div class="foot">
 <div class="foot_nav">
  <div class="foot_nav_left">
  <div class="foot_nav_right">
  <?php 
 $fun_return=nav_bottom();if(isset($fun_return)&&is_array($fun_return)){
foreach($fun_return as $v){?>
  <a href="<?php echo $v['url'];?>" title="<?php echo $v['cate_name'];?>"><?php echo $v['cate_name'];?></a>|
  <?php 
}
}?>
  </div>
  </div>
 </div>
 <?php $address=webinfo('web_address');?>
 <?php $phone=webinfo('web_phone');?>
 <?php $mail=webinfo('web_mail');?>
 <p><?php if($address){?>Address：<?php echo $address;?><?php }?><?php if($phone){?>&nbsp;&nbsp;TEL：<?php echo $phone;?><?php }?><?php if($mail){?>&nbsp;&nbsp;E-MAIL：<?php echo $mail;?><?php }?></p>
 <p><?php echo webinfo('web_powerby');?></p>
 <p>powerd by <a href="http://www.beescms.com" target="_blank">BEESCMS</a></p>
</div><!--页脚-->
<?php echo webinfo('web_yinxiao');?>
<?php $this->display('kefu',1,1);?>