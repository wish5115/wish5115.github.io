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
if(file_exists(DATA_PATH."cache_channel/cache_channel_all.php")){include(DATA_PATH."cache_channel/cache_channel_all.php");}
if(file_exists(DATA_PATH."cache_form/form.php")){include(DATA_PATH."cache_form/form.php");}
include('template/admin_main.html');
echo PW;
?>