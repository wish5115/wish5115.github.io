<!--#include file="../inc/access.asp"  -->
<!-- #include file="inc/functions.asp" -->
<!-- #include file="../inc/x_to_html/article_to_html.asp" -->
	<%
Call header()
%>


	<table cellpadding='3' cellspacing='1' border='0' class='tableBorder' align=center>
	<tr>
	  <th width="100%" height=25 class='tableHeaderText'>删除评论</th>
	
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
			
if request("action")="AllDel" then
Num=request.form("Selectitem").count 
if Num=0 then 
response.Write "<script language='javascript'>alert('请选择要删除的数据！');location.href='Comment_list.asp?page="&page&"&act="&act&"&keywords="&keywords&"';</script>"
Response.End 
end if 
Selectitem=request.Form("Selectitem") 
article_id=split(Selectitem,",")
c=ubound(article_id)
for i=0 to c		
			set rs=server.createobject("adodb.recordset")
sql="select article_id from web_article_comment where id="&cint(article_id(i))&""
rs.open(sql),cn,1,3
a_id=rs("article_id")
rs.delete
rs.close
set rs=nothing

'文章生成1
set rs_create=server.createobject("adodb.recordset")
sql="select [id],[title],[file_path] from [article] where [id]="&a_id&""
rs_create.open(sql),cn,1,1
if not rs_create.eof then
a_id=rs_create("id")
a_title=rs_create("title")
a_link=Article_FolderName1&"/"&rs_create("file_path")

end if
rs_create.close
set rs_create=nothing

next

else
			article_id=cint(request.querystring("id"))
			set rs=server.createobject("adodb.recordset")
sql="select id,article_id from web_article_comment where id="&article_id&""
rs.open(sql),cn,1,3
a_id=rs("article_id")
rs.delete
rs.close
set rs=nothing

'文章评论数减1，文章生成
set rs=server.createobject("adodb.recordset")
sql="select [comment] from [article] where [id]="&a_id&""
rs.open(sql),cn,1,3
if not rs.eof then
rs("comment")=rs("comment")-1
rs.update
end if
rs.close
set rs=nothing

'生成评论
set rs_create=server.createobject("adodb.recordset")
sql="select [id],[title],[file_path] from [article] where  [id]="&a_id&""
rs_create.open(sql),cn,1,1
if not rs_create.eof then
a_id=rs_create("id")
a_title=rs_create("title")
a_link=Article_FolderName1&"/"&rs_create("file_path")
call article_to_html(a_id)
end if
rs_create.close
set rs_create=nothing


end if
%>
<%
response.Write "<script language='javascript'>alert('删除成功！');location.href='comment_list.asp?page="&page&"&act="&act&"&keywords="&keywords&"';</script>"
			%></td>
          </tr>
        </table>
	    </td>
	</tr>
	</table>


<%
Call DbconnEnd()
 %>