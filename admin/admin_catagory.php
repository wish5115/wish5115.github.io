<?php
/**
 * $Author: BEESCMS $
 * ============================================================================
 * 网站地址: http://www.beescms.com
 * 您只能在不用于商业目的的前提下对程序代码进行修改和使用；
 * 不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
*/

define('IN_CMS','true');
include('init.php');
$action=isset($_REQUEST['action'])?fl_html(fl_value($_REQUEST['action'])):'catagory';
$lang=isset($_REQUEST['lang'])?fl_html(fl_value($_REQUEST['lang'])):get_lang_main();
if(file_exists(DATA_PATH.$lang.'_info.php')){include(DATA_PATH.$lang.'_info.php');}//语言网站配置$_confing
$parent=isset($_REQUEST['parent'])?$_REQUEST['parent']:0;

//栏目列表
if($action=='catagory'){
	$file_path=DATA_PATH.'cache_cate/cate_list_'.$lang.'.php';
	if(file_exists($file_path)){
		include($file_path);
	}
	$GLOBALS['cache']->cache_category($parent,$lang);
	//更新栏目列表
	$sql="select c.id,c.list_num,c.cate_pic1,c.cate_pic2,c.cate_pic3,c.cate_content,c.temp_id,c.cate_channel,c.is_content,c.cate_url,c.cate_is_open,c.cate_html,c.cate_nav,c.cate_fold_name,c.cate_order,c.cate_hide,c.cate_tpl,c.cate_name,c.lang,c.cate_parent,COUNT(s.id) as haschild from ".DB_PRE."category as c left join ".DB_PRE."category as s on c.id=s.cate_parent where c.lang='".$lang."' group by c.id order by c.cate_order,c.id desc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	$str="<?php\n\$cate_list=".var_export($rel,true).";\n?>";
	$file=DATA_PATH.'cache_cate/cate_list_'.$lang.'.php';
	creat_inc($file,$str);
	//create_nav_xml($lang);
	$GLOBALS['cache']->cache_category_all();
	include('template/admin_catagory.html');
}
//添加顶级栏目界面
elseif($action=='category_add'){
	if(!check_purview('cate_create')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	if(file_exists(DATA_PATH."cache_channel/cache_channel_all.php")){include(DATA_PATH."cache_channel/cache_channel_all.php");}
	$rel = $mysql->fetch_asc("select channel_mark,id from ".DB_PRE."channel where is_disable!=1 order by channel_order limit 0,1");
	$channel_mark = $rel[0]['channel_mark'];
	include('template/admin_catagory_add.html');
}

//添加单页栏目界面
elseif($action == 'add_alone_cate'){
	if(!check_purview('cate_create')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	include('template/admin_catagory_alone_add.html');
}

//添加表单栏目界面
elseif($action == 'add_order_cate'){
	if(!check_purview('cate_create')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	include('template/admin_catagory_order_add.html');
}

//处理添加的顶级栏目
elseif($action=='add'){
	if(!check_purview('cate_create')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$cate_hide    = intval($_POST['cate_hide']);
	$cate_is_open = intval($_POST['cate_is_open']);
	$cate_channel = intval($_POST['cate_channel']);
	$cate_name    = $_POST['cate_name'];
	$cate_fold_name = $_POST['cate_fold_name'];
	$cate_order = intval($_POST['cate_order']);
	$cate_nav = $_POST['cate_nav'];
	$cate_html = intval($_POST['cate_html']);
	$cate_tpl = intval($_POST['cate_tpl']);
	$cate_url = $_POST['cate_url'];
	$cate_tpl_list = $_POST['cate_tpl_list'];
	$cate_tpl_content = $_POST['cate_tpl_content'];
	$cate_title_seo = $_POST['cate_title_seo'];
	$cate_key_seo = $_POST['cate_key_seo'];
	$cate_info_seo = $_POST['cate_info_seo'];
	$add_category = $_POST['add_category'];
	$form_id = intval($_POST['order']);
	$custom_url = $_POST['custom_url'];
	$cate_pic1 = $_POST['cate_pic1'];//栏目图片
	$cate_pic2 = $_POST['cate_pic2'];//栏目图片
	$cate_pic3 = $_POST['cate_pic3'];
	$cate_content = $_POST['cate_content'];//栏目内容
	$temp_id=intval($_POST['temp_id']);//模板标示ID
	$list_num=intval($_POST['list_num']);//列表数量，不能为空
	$nav_show = intval($_POST['nav_show']);//自定义导航显示
	
	if(!isset($add_category)){
		msg('<span style="color:red">请从表单提交</span>','admin_catagory.php?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
	}
	if(empty($cate_channel)||!isset($cate_channel)){
		msg('<span style="color:red">内容模型不能为空,请选择内容模型</span>');
	}
	if(empty($cate_name)){
		msg('<span style="color:red">栏目名称不能为空</span>');
	}
	if(empty($cate_fold_name)){
		msg('<span style="color:red">栏目目录名称不能为空</span>');
	}
	if(empty($list_num)){
		msg('<span style="color:red">列表页数量不能为空</span>');
	}
	//$cate_parent=isset($GLOBALS['cate_parent'])?$GLOBALS['parent']:0;
	/*
	if($parent!=0){
		$p_fold=$GLOBALS['mysql']->fetch_array('select cate_fold_name from '.DB_PRE.'category where id='.$parent);
		if($p_fold==""){
			msg('<span style="color:red">父级栏目不存在</span>','admin_catagory.php?lang='.$lang);
		}
		$cate_fold_name=$p_fold[0]['cate_fold_name'].'/'.$cate_fold_name;
	}
	*/
	$cate_fold_name = str_replace(' ','-',trim($cate_fold_name));//过滤生成空格
	$cate_nav=empty($cate_nav)?'':implode(',',$cate_nav);
	$cate_order=isset($cate_order)?intval($cate_order):0;
	$cate_html=empty($cate_html)?1:$cate_html;
	if(strlen($cate_order)>60){msg('<span style="color:red">【排列顺序】太长,请缩短</span>');}
	//if(strlen($cate_title_seo)>250){msg('<span style="color:red">【栏目标题(SEO)】太长,请缩短</span>');}
	//if(strlen($cate_key_seo)>250){msg('<span style="color:red">【栏目关键字(SEO)】太长,请缩短</span>');}
	//if(strlen($cate_info_seo)>250){msg('<span style="color:red">【栏目描述(SEO)】太长,请缩短</span>');}
	//模板标示是否重复
	if(!empty($temp_id)){
		$is_temp_id=$mysql->fetch_asc('select id from '.DB_PRE.'category where temp_id='.$temp_id." and lang='".$lang."'");
		if($is_temp_id){msg('<span style="color:red">【已经存在模板标示ID，请更改！】</span>');}
	}
	
	//栏目目录名是否重复,仿制生成覆盖
	$rel_fold_name = $GLOBALS['mysql']->fetch_asc("SELECT id FROM ".DB_PRE."category WHERE cate_fold_name='".$cate_fold_name."'");
	if(!empty($rel_fold_name[0])){
		unset($rel_fold_name);
		msg('<span style="color:red">已经存在相同的栏目目录名，请修改</span>');
	}
	
	$cate_fold_name=$cate_fold_name;
	$sql="insert into ".DB_PRE."category (cate_name,cate_mb_is,cate_hide,cate_channel,cate_fold_name,cate_order,cate_tpl,cate_tpl_list,cate_tpl_content,cate_title_seo,cate_key_seo,cate_info_seo,lang,cate_parent,cate_html,cate_nav,cate_url,cate_is_open,form_id,custom_url,cate_pic1,cate_pic2,cate_pic3,cate_content,temp_id,list_num,nav_show) values ('".$cate_name."',0,".$cate_hide.",".$cate_channel.",'".$cate_fold_name."',".$cate_order.",".$cate_tpl.",'".$cate_tpl_list."','".$cate_tpl_content."','".$cate_title_seo."','".$cate_key_seo."','".$cate_info_seo."','".$lang."',".$parent.",".$cate_html.",'".$cate_nav."','".$cate_url."',".$cate_is_open.",".$form_id.",'".$custom_url."','".$cate_pic1."','".$cate_pic2."','".$cate_pic3."','".$cate_content."',".$temp_id.",".$list_num.",'".$nav_show."')";
	$GLOBALS['mysql']->query($sql);
	//栏目缓存
	$GLOBALS['cache']->cache_category($parent,$lang);
	cache_channel_category($lang);
	//更新栏目列表
	$sql="select c.id,c.list_num,c.nav_show,c.cate_pic1,c.cate_pic2,c.cate_pic3,c.cate_content,c.temp_id,c.custom_url,c.cate_channel,c.is_content,c.cate_url,c.cate_is_open,c.cate_html,c.cate_nav,c.cate_fold_name,c.cate_order,c.cate_hide,c.cate_tpl,c.cate_name,c.lang,c.cate_parent,COUNT(s.id) as haschild from ".DB_PRE."category as c left join ".DB_PRE."category as s on c.id=s.cate_parent where c.lang='".$lang."' group by c.id order by c.cate_order,c.id desc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	$str="<?php\n\$cate_list=".var_export($rel,true).";\n?>";
	$file=DATA_PATH.'cache_cate/cate_list_'.$lang.'.php';
	creat_inc($file,$str);
	//create_nav_xml($lang);
	$GLOBALS['cache']->cache_category_all();
	msg('栏目添加成功','?action=catagory&lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//更新栏目缓存
elseif($action=='cache_cate'){
	$GLOBALS['cache']->cache_category_all();
	$GLOBALS['cache']->cache_category($parent,$lang);
	$GLOBALS['cache']->cache_category_child(0,$lang);
	cache_channel_category($lang);
	//更新栏目列表
	$sql="select c.id,c.list_num,c.nav_show,c.cate_pic1,c.cate_pic2,c.cate_pic3,c.cate_content,c.temp_id,c.custom_url,c.cate_channel,c.cate_fold_name,c.cate_nav,c.cate_is_open,c.cate_html,c.cate_url,c.cate_order,c.cate_hide,c.cate_tpl,c.cate_name,c.lang,c.cate_parent,c.is_content,COUNT(s.id) as haschild from ".DB_PRE."category as c left join ".DB_PRE."category as s on c.id=s.cate_parent where c.lang='".$lang."' group by c.id order by c.cate_order,c.id desc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	$str="<?php\n\$cate_list=".var_export($rel,true).";\n?>";
	$file=DATA_PATH.'cache_cate/cate_list_'.$lang.'.php';
	creat_inc($file,$str);
	//create_nav_xml($lang);
		msg('栏目缓存更新完成');
}


//添加下级栏目界面
elseif($action=='child'){
	if(!check_purview('cate_create')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$channel_id=intval($_GET['channel_id']);
	if(empty($channel_id)){err('<span style="color:red">参数传递错误,请重新操作</span>');}
	if(file_exists(DATA_PATH.'cache_channel/cache_channel_all.php')){include(DATA_PATH."cache_channel/cache_channel_all.php");}
	if(!empty($channel)){
		foreach($channel as $k=>$v){
			if($v['id']==$channel_id){
				$mark=$v['channel_mark'];
			}
		}
	}
	$sql="select cate_name from ".DB_PRE."category where id=".$parent;
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	include('template/admin_category_child.html');
}


//修改顶级栏目界面
elseif($action=='xg'){
   if(!check_purview('cate_edit')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id = intval($_GET['id']);
	if(!isset($id) || $id==0){
		msg('<span style="color:red">参数传递错误</span>','admin_catagory.php?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
	}
	$sql="select*from ".DB_PRE."category where id=".$id;
	$arr=$mysql->fetch_asc($sql);
	if(file_exists(DATA_PATH.'cache_channel/cache_channel_all.php')){include(DATA_PATH."cache_channel/cache_channel_all.php");}
	include('template/admin_category_xg.html');
}


//处理顶级栏目修改
elseif($action=='save_xg'){
	if(!check_purview('cate_edit')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$cate_hide    = intval($_POST['cate_hide']);
	$cate_is_open = intval($_POST['cate_is_open']);
	$cate_channel = intval($_POST['cate_channel']);
	$cate_name    = $_POST['cate_name'];
	$cate_fold_name = $_POST['cate_fold_name'];
	$cate_order = intval($_POST['cate_order']);
	$cate_nav = $_POST['cate_nav'];
	$cate_html = intval($_POST['cate_html']);
	$cate_tpl = intval($_POST['cate_tpl']);
	$cate_url = $_POST['cate_url'];
	$cate_tpl_list = $_POST['cate_tpl_list'];
	$cate_tpl_content = $_POST['cate_tpl_content'];
	$cate_title_seo = $_POST['cate_title_seo'];
	$cate_key_seo = $_POST['cate_key_seo'];
	$cate_info_seo = $_POST['cate_info_seo'];
	$xg_category = $_POST['xg_category'];
	$id = intval($_POST['id']);
	$form_id = intval($_POST['order']);
	$cate_pic1 = $_POST['cate_pic1'];//栏目图片
	$cate_pic2 = $_POST['cate_pic2'];//栏目图片
	$cate_pic3 = $_POST['cate_pic3'];
	$cate_content = $_POST['cate_content'];//栏目内容
	$temp_id = intval($_POST['temp_id']);
	$list_num=intval($_POST['list_num']);
	$nav_show = intval($_POST['nav_show']);//自定义显示导航

	if(!isset($xg_category)){
		msg('<span style="color:red">请从表单提交</span>','admin_catagory.php?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
	}
	if(!isset($id) || $id==0){
		msg('<span style="color:red">参数传递错误</span>','admin_catagory.php?nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
	}
	if(empty($cate_name)){
		msg('<span style="color:red">栏目名称不能为空</span>');
	}
	if(empty($cate_fold_name)){
		msg('<span style="color:red">栏目目录名称不能为空</span>');
	}
	if(empty($list_num)){msg('<span style="color:red">列表页数量不能为空</span>');}
	$cate_nav=empty($cate_nav)?'':implode(',',$cate_nav);
	$cate_html=empty($cate_html)?1:$cate_html;

	//if(strlen($cate_order)>60){msg('<span style="color:red">【排列顺序】太长,请缩短</span>');}
	//if(strlen($cate_title_seo)>250){msg('<span style="color:red">【栏目标题(SEO)】太长,请缩短</span>');}
	//if(strlen($cate_key_seo)>250){msg('<span style="color:red">【栏目关键字(SEO)】太长,请缩短</span>');}
	//if(strlen($cate_info_seo)>250){msg('<span style="color:red">【栏目描述(SEO)】太长,请缩短</span>');}
	//模板标示是否重复
	if(!empty($temp_id)){
		$is_temp_id=$mysql->fetch_asc('select id from '.DB_PRE.'category where temp_id='.$temp_id." and lang='".$lang."' and id!=".$id);
		if($is_temp_id){msg('<span style="color:red">【已经存在模板标示ID，请更改！】</span>');}
	}
	
	
	$cate_fold_name = str_replace(' ','-',trim($cate_fold_name));//过滤生成空格
	//栏目目录名是否重复,仿制生成覆盖
	$rel_fold_name = $GLOBALS['mysql']->fetch_asc("SELECT id FROM ".DB_PRE."category WHERE cate_fold_name='".$cate_fold_name."' AND id!=".$id);
	if(!empty($rel_fold_name[0])){
		unset($rel_fold_name);
		msg('<span style="color:red">已经存在相同的栏目目录名，请修改</span>');
	}
	
	
	$sql="update ".DB_PRE."category set cate_name='".$cate_name."',cate_fold_name='".$cate_fold_name."',cate_mb_is=0,cate_hide=".$cate_hide.",cate_channel=".$cate_channel.",cate_order=".$cate_order.",cate_tpl=".$cate_tpl.",cate_tpl_index='',cate_tpl_list='".$cate_tpl_list."',cate_tpl_content='".$cate_tpl_content."',cate_title_seo='".$cate_title_seo."',cate_key_seo='".$cate_key_seo."',cate_info_seo='".$cate_info_seo."',cate_nav='".$cate_nav."',cate_html=".$cate_html.",cate_url='".$cate_url."',cate_is_open=".$cate_is_open.",form_id=".$form_id.",cate_pic1='".$cate_pic1."',cate_pic2='".$cate_pic2."',cate_pic3='".$cate_pic3."',cate_content='".$cate_content."',temp_id=".$temp_id.",list_num=".$list_num.",nav_show='".$nav_show."' where id=".$id." and lang='".$lang."'";
	$GLOBALS['mysql']->query($sql);
	$GLOBALS['cache']->cache_category($parent,$lang);
	//更新栏目列表
	$sql="select c.id,c.list_num,c.nav_show,c.cate_pic1,c.cate_pic2,c.cate_pic3,c.cate_content,c.temp_id,c.custom_url,c.cate_channel,c.is_content,c.cate_url,c.cate_is_open,c.cate_html,c.cate_nav,c.cate_fold_name,c.cate_order,c.cate_hide,c.cate_tpl,c.cate_name,c.lang,c.cate_parent,COUNT(s.id) as haschild from ".DB_PRE."category as c left join ".DB_PRE."category as s on c.id=s.cate_parent where c.lang='".$lang."' group by c.id order by c.cate_order,c.id desc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	$str="<?php\n\$cate_list=".var_export($rel,true).";\n?>";
	$file=DATA_PATH.'cache_cate/cate_list_'.$lang.'.php';
	creat_inc($file,$str);
	//create_nav_xml($lang);
	$GLOBALS['cache']->cache_category_all();
	msg('栏目修改成功','?lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}


//删除栏目
elseif($action=='del'){
   if(!check_purview('cate_del')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$id=intval($_GET['id']);
	//判断是否有内容
	$has_content=$GLOBALS['mysql']->fetch_rows("select id from ".DB_PRE."maintb where category=".$id);
	if($has_content){msg('<span style="color:red">请先删除该栏目下的内容</span>');}
	del_cate_child($id,$lang);
	$GLOBALS['mysql']->query('delete from '.DB_PRE.'category where cate_parent='.$id." and lang='".$lang."'");
	$GLOBALS['mysql']->query('delete from '.DB_PRE.'category where id='.$id." and lang='".$lang."'");
	if(file_exists(DATA_PATH.'cache_cate/cache_category'.$parent.'_'.$lang.'.php')){
				unlink(DATA_PATH.'cache_cate/cache_category'.$parent.'_'.$lang.'.php');
			}
	$GLOBALS['cache']->cache_category($parent,$lang);
	$GLOBALS['cache']->cache_category_child(0,$lang);
	//更新栏目列表
	$sql="select c.id,c.list_num,c.nav_show,c.cate_pic1,c.cate_pic2,c.cate_pic3,c.cate_content,c.temp_id,c.custom_url,c.cate_channel,c.is_content,c.cate_url,c.cate_is_open,c.cate_nav,c.cate_html,c.cate_fold_name,c.cate_hide,c.cate_tpl,c.cate_order,c.cate_name,c.lang,c.cate_parent,COUNT(s.id) as haschild from ".DB_PRE."category as c left join ".DB_PRE."category as s on c.id=s.cate_parent where c.lang='".$lang."' group by c.id order by c.cate_order,c.id desc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	$str="<?php\n\$cate_list=".var_export($rel,true).";\n?>";
	$file=DATA_PATH.'cache_cate/cate_list_'.$lang.'.php';
	creat_inc($file,$str);
	//create_nav_xml($lang);
	$GLOBALS['cache']->cache_category_all();
	msg("成功删除栏目【id:{$id}】",'admin_catagory.php?lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
}

//移动栏目
elseif($action=='move_cate'){
	if(!check_purview('cate_move')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$cate=intval($_GET['cate']);
	if(file_exists(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php')){
		include(DATA_PATH.'cache_cate/cate_list_'.$lang.'.php');
	}
	if(!empty($cate_list)){
		foreach($cate_list as $k=>$v){
			if($cate==$v['id']){$cate_name=$v['cate_name'];unset($cate_list[$k]);}
			//break;
		}
	}
	include('template/admin_category_move.html');
}


//处理移动的栏目
elseif($action=='save_move'){
	if(!check_purview('cate_move')){msg('<span style="color:red">操作失败,你的权限不足!</span>');}
	$cate=intval($_POST['cate']);
	if(empty($cate)){err('<span style="color:red">参数传递错误,请重新操作</span>');}
	//判断栏目是否有下级，存在下级栏目不能移动
	$sql = "select count(id) as num from ".DB_PRE."category where cate_parent=".$cate;
	$is_child = $GLOBALS['mysql']->fetch_asc($sql);
	if($is_child[0]['num']){msg('<span style="color:red">操作失败！请先删除或移动该栏目的下级栏目！</span>');}
	$parent_ago=$GLOBALS['mysql']->get_row("select cate_parent from ".DB_PRE."category where id=".$cate);
	$sql="update ".DB_PRE."category set cate_parent={$parent} where id={$cate}";
	$GLOBALS['mysql']->query($sql);
	
	//更新栏目列表
	$sql="select c.id,c.list_num,c.nav_show,c.cate_pic1,c.cate_pic2,c.cate_pic3,c.cate_content,c.temp_id,c.custom_url,c.cate_channel,c.is_content,c.cate_url,c.cate_is_open,c.cate_nav,c.cate_html,c.cate_fold_name,c.cate_hide,c.cate_tpl,c.cate_order,c.cate_name,c.lang,c.cate_parent,COUNT(s.id) as haschild from ".DB_PRE."category as c left join ".DB_PRE."category as s on c.id=s.cate_parent where c.lang='".$lang."' group by c.id order by c.cate_order,c.id desc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	$str="<?php\n\$cate_list=".var_export($rel,true).";\n?>";
	$file=DATA_PATH.'cache_cate/cate_list_'.$lang.'.php';
	creat_inc($file,$str);
	//create_nav_xml($lang);
	$GLOBALS['cache']->cache_category_all();
	$GLOBALS['cache']->cache_category($parent_ago,$lang);
	$GLOBALS['cache']->cache_category($parent,$lang);
	
	msg('栏目移动成功','?lang='.$lang.'&nav='.$admin_nav.'&admin_p_nav='.$admin_p_nav);
	
}
//ajax修改排序
elseif($action=='ajax_order'){
	$id=intval($_POST['id']);
	$order_id=intval($_POST['order_id']);
	if(empty($id)){die('参数错误');}
	$sql="update ".DB_PRE."category set cate_order='".$order_id."' where id=".$id;
	$GLOBALS['mysql']->query($sql);
	//更新栏目列表
	$sql="select c.id,c.list_num,c.nav_show,c.cate_pic1,c.cate_pic2,c.cate_pic3,c.cate_content,c.temp_id,c.custom_url,c.cate_channel,c.is_content,c.cate_url,c.cate_is_open,c.cate_nav,c.cate_html,c.cate_fold_name,c.cate_hide,c.cate_tpl,c.cate_order,c.cate_name,c.lang,c.cate_parent,COUNT(s.id) as haschild from ".DB_PRE."category as c left join ".DB_PRE."category as s on c.id=s.cate_parent where c.lang='".$lang."' group by c.id order by c.cate_order,c.id desc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	$str="<?php\n\$cate_list=".var_export($rel,true).";\n?>";
	$file=DATA_PATH.'cache_cate/cate_list_'.$lang.'.php';
	creat_inc($file,$str);
	
	$GLOBALS['cache']->cache_category_all();
}
//ajax修改模板id
elseif($action=='ajax_tpl'){
	$id=intval($_POST['id']);
	$order_id=intval($_POST['order_id']);
	if(empty($id)){die('参数错误');}
	//是否存在同样的标示
	if(!empty($order_id)){
		$is_temp_id=$mysql->fetch_asc('select count(id) as n from '.DB_PRE.'category where temp_id='.$order_id." and lang='".$lang."' and id!=".$id);
		if($is_temp_id[0]['n']){die('1');}
	}
	
	$sql="update ".DB_PRE."category set temp_id=".$order_id." where id=".$id;
	$GLOBALS['mysql']->query($sql);
	//更新栏目列表
	$sql="select c.id,c.list_num,c.nav_show,c.cate_pic1,c.cate_pic2,c.cate_pic3,c.cate_content,c.temp_id,c.custom_url,c.cate_channel,c.is_content,c.cate_url,c.cate_is_open,c.cate_nav,c.cate_html,c.cate_fold_name,c.cate_hide,c.cate_tpl,c.cate_order,c.cate_name,c.lang,c.cate_parent,COUNT(s.id) as haschild from ".DB_PRE."category as c left join ".DB_PRE."category as s on c.id=s.cate_parent where c.lang='".$lang."' group by c.id order by c.cate_order,c.id desc";
	$rel=$GLOBALS['mysql']->fetch_asc($sql);
	$str="<?php\n\$cate_list=".var_export($rel,true).";\n?>";
	$file=DATA_PATH.'cache_cate/cate_list_'.$lang.'.php';
	creat_inc($file,$str);
	
	$GLOBALS['cache']->cache_category_all();
}

echo PW;
?>
