<!--#include file="../inc/access.asp"  -->
<!-- #include file="inc/functions.asp" -->
<!-- #include file="../inc/x_to_html/article_to_html.asp" -->
	<%
Call header()
%>


	<table cellpadding='3' cellspacing='1' border='0' class='tableBorder' align=center>
	<tr>
	  <th width="100%" height=25 class='tableHeaderText'>审核评论</th>
	
	<tr><td height="400" valign="top"  class='forumRow'><br>
	    <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td height="25" bgcolor="#B1CFF8"><div align="center"></div></td>
          </tr>
          <tr>
            <td height="100">
			<%page=request.querystring("page")
			act=request.querystring("act")
			keywords=request.querystring("keywords")
			article_id=cint(request.querystring("id"))
			set rs=server.createobject("adodb.recordset")
sql="select id,view_yes,article_id from web_article_comment where id="&article_id&""
rs.open(sql),cn,1,3
if rs("view_yes")=0 then
rs("view_yes")=1
else
rs("view_yes")=0
end if
rs.update
article_id=rs("article_id")
rs.close
set rs=nothing

'文章文件夹获取
set rs_1=server.createobject("adodb.recordset")
sql="select FolderName from web_Models_type where [id]=9"
rs_1.open(sql),cn,1,1
if not rs_1.eof then
if rs_1("FolderName")<>"" then
Article_FolderName1="/"&rs_1("FolderName")
end if
end if
rs_1.close
set rs_1=nothing

'生成评论
set rs_create=server.createobject("adodb.recordset")
sql="select [id],[title],[file_path] from [article] where id="&article_id
rs_create.open(sql),cn,1,3
if not rs_create.eof then
a_id=rs_create("id")
a_title=rs_create("title")
a_link=Article_FolderName1&"/"&rs_create("file_path")
call article_to_html(a_id)
end if
rs_create.close
set rs_create=nothing

response.Write "<script language='javascript'>alert('修改成功！');location.href='comment_list.asp?page="&page&"&act="&act&"&keywords="&keywords&"';</script>"
			%></td>
          </tr>
        </table>
	    </td>
	</tr>
	</table>


<%
Call DbconnEnd()
 %>