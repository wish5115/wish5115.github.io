<!--#include file="../inc/access.asp"  -->
<!-- #include file="inc/functions.asp" -->
<!-- #include file="../inc/x_to_html/index_to_html.asp" -->
<!-- #include file="../inc/x_to_html/blog_index_to_html.asp" -->
<!-- #include file="../inc/x_to_html/blog_class_list_to_html.asp" -->
<!-- #include file="../inc/x_to_html/album_index_to_html.asp" -->
<!-- #include file="../inc/x_to_html/blank_index_to_html.asp" -->
<!-- #include file="../inc/x_to_html/post_index_to_html.asp" -->
<!-- #include file="../inc/x_to_html/search_index_to_asp.asp" -->
<!-- #include file="../inc/x_to_html/article_to_html.asp" -->
<!-- #include file="../inc/x_to_html/album_content_to_html.asp" -->
	<%
Call header()
%>


	<table cellpadding='3' cellspacing='1' border='0' class='tableBorder' align=center>
	<tr>
	  <th width="100%" height=25 class='tableHeaderText'>生成所有</th>
	
	<tr><td height="400" valign="top"  class='forumRow'><br>
	    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" class="TitleHighlight3"></td>
          </tr>
          <tr>
            <td height="100"><div align="center">
			<%
call index_to_html()

'生成栏目
sql="select [id],ppid,ClassType from [category]  order by [time] desc"
set rs_create=server.createobject("adodb.recordset")
rs_create.open(sql),cn,1,1
do while not rs_create.eof
a_id=rs_create("id")

select case rs_create("ppid") 
case 1 
sql_id=" cid='"&rs_create("id")&" '"
case 2 
sql_id=" pid='"&rs_create("id")&" '"
case 3
sql_id=" ppid='"&rs_create("id")&" '"
end select
 
select case  rs_create("ClassType")
case 1
call blog_class_list_to_html(a_id,sql_id)
case 2
call blank_index_to_html(a_id)
end select

rs_create.movenext
loop
rs_create.close
set rs_create=nothing

'生成博客列表
call blog_index_to_html()

'生成相册列表
call album_index_to_html()

'生成留言列表
call post_index_to_html()

'生成搜索
call search_index_to_asp()

'生成资讯文章 start
sql="select [id] from [article] order by [time] desc"
set rs_create=server.createobject("adodb.recordset")
rs_create.open(sql),cn,1,1
do while not rs_create.eof 
a_id=rs_create("id")
call article_to_html(a_id)
rs_create.movenext
loop
rs_create.close
set rs_create=nothing
'生成资讯文章 end

'生成相册文章 start
sql="select [id],[name],[memo],backmusic from [web_ad_position] order by [time] desc"
set rs_create=server.createobject("adodb.recordset")
rs_create.open(sql),cn,1,1
do while not rs_create.eof 
a_id=rs_create("id")
a_name=rs_create("name")
a_memo=rs_create("memo")
a_music=rs_create("backmusic")
call album_content_to_html(a_id,a_name,a_memo,a_music)
rs_create.movenext
loop
rs_create.close
set rs_create=nothing
'生成相册文章 end

response.Write "<script language='javascript'>alert('更新成功！');history.go(-1);</script>"
			%></div></td>
          </tr>
        </table>
	    </td>
	</tr>
	</table>


<%
Call DbconnEnd()
 %>