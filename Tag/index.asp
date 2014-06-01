<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=7">
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<!-- #include file="../inc/conn.asp" -->
<!-- #include file="../inc/web_config.asp" -->
<!-- #include file="../inc/html_clear.asp" -->
<%
search_q=request.querystring("q")
%>
<title>搜索：<%=search_q%> - wish博客</title>
<link href="/css/Reminiscent/style.css" rel="stylesheet" type="text/css" media="screen" />
<script  language="javascript" src="/js/slidealbum.js"></script>
</head>
<body>
<%
keywords=split(search_q," ")
c=ubound(keywords)
for i=0 to c
if i=0 then
search_sql1=search_sql1&"where  ( [title] like '%"&keywords(i)&"%'"
keywords_all=keywords(i)
else
search_sql1=search_sql1&" or   [title] like '%"&keywords(i)&"%'"
keywords_all=keywords_all&"+"&keywords(i)
end if
next

s_sql="select [title],[content],[file_path],[time] from [article] "&search_sql1&" )  and view_yes=1 order by [time] desc"
%>
    <div id="main">
        <div id="corner1">&nbsp;</div>
        <div id="corner2">&nbsp;</div>
        <div id="header"><div id="header2">
	<div class="top">
	<h1><a href="/" title="wish博客">wish博客</a></h1>
	<p>属于我自己的一片天地，我可以随意打造...</p>
	</div>
	                <div id="menu">
<ul><li><a href='/' >首 页</a></li> <li><a href='/blog/' >博 客</a></li> <li><a href='/album/' >相 册</a></li> <li><a href='/Category/About' >关 于</a></li> </ul>
                </div>
                <div id="search">
                   <form method="get" action="/Tag/index.asp">
				<fieldset>
				<input type="text" name="q" id="search-text" size="15" onBlur="if(this.value=='') this.value='<%=search_q%>';" 
onfocus="if(this.value=='<%=search_q%>') this.value='';" value="<%=search_q%>" /><input type="submit" id="search-submit" value="搜 寻" />
				</fieldset>
			</form>
                </div>
        </div></div>        
        <div id="middle"><div id="middle2">
                <div id="content">
			<div class="Web_Position">您现在的位置: <a href="/">首页</a> > <a href='/Tag/'>搜索</a></div>
		<div class="clearfix"></div>		
<!--search content start-->
<div id="search_content" class="clearfix">

<%
if search_q<>"" then 

set rs=server.createobject("adodb.recordset")
rs.open(s_sql),cn,1,1
%>

<%'=============分页定义开始，要放在数据库打开之后
if err.number<>0 then '错误处理
response.write "数据库操作失败：" & err.description
err.clear
else
if not (rs.eof and rs.bof) then '检测记录集是否为空
r=cint(rs.RecordCount) '记录总数
rowcount = 10 '设置每一页的数据记录数，可根据实际自定义
rs.pagesize = rowcount '分页记录集每页显示记录数
maxpagecount=rs.pagecount '分页页数
page=request.querystring("page")
  if page="" then
  page=1
  end if
rs.absolutepage = page 
rcount1=0
pagestart=page-5
pageend=page+5
if pagestart<1 then
pagestart=1
end if
if pageend>maxpagecount then
pageend=maxpagecount
end if
rcount=rs.RecordCount
'=============分页定义结束%>

<!--position start-->
<div class="searchtip">您正在搜寻“<span class="FontRed"><%=search_q%></span>”,找到相关信息 <span class="font_brown"><%=rcount%></span> 条</div>
<!--position end-->
<!--list start-->
<div class="result_list">
<div class="gray">提示：用空格隔开多个搜寻关键词可获取更理想结果，如“李毅 足球”。</div>
<dl>

<%'===========循环体开始
do while not rs.eof and rowcount%>
<%
title1=left(rs("title"),30)
for i=0 to c
title1=Replace(title1, keywords(i), "<span class='FontRed'>" & keywords(i)& "</span>")
next

content1=left(Clearhtml(rs("content")),110)
for i=0 to c
content1=Replace(content1,keywords(i), "<span class='FontRed'>" & keywords(i)& "</span>")
next
%>
<dt ><a href='<%="/"&Article_FolderName&"/"&rs("file_path")%>' target='_blank' title='<%=rs("title")%>'><%=title1%></a></dt>
<dd><%=content1%>...</dd>
<dd class="font12 arial font_green line"><a href='<%="/"&Article_FolderName&"/"&rs("file_path")%>' target='_blank'><span class="font_green"><%=web_url&Article_FolderName&"/"&rs("file_path")%></span></a><%=year(rs("time"))%>-<%=month(rs("time"))%>-<%=day(rs("time"))%></dd>
<%
rowcount=rowcount-1 
rs.movenext
loop
 '===========循环体结束%>

</dl>
</div>
<!--list end-->

<!--page start-->
<div class="result_page clearfix">
<!--#include file="../inc/page_list.asp"-->
</div>
<!--page end-->

<%
else
response.write "<div class='search_welcome'>很抱歉,没有找到与 <span class='FontRed'>"&search_q&"</span> 相关的信息！<p >提示：用空格隔开多个搜寻关键词可获取更理想结果，如“足球 李毅”。</p></div>"
end if
end if
end if%>
</div>
<!--search content end-->	
		<div style="clear: both;">&nbsp;</div>
		</div>
                <div id="sidebar">
			<ul>		
				
				<li>
					<h2>博客分类</h2>
<ul><li><a href='/Category/Internet/'>互联网</a> (0) <a href='/rss/Feed.asp?CatID=136' target='_blank'><img src='/images/rss_icon.gif'></a></li><li><a href='/Category/Favorite/'>个人收藏</a> (0) <a href='/rss/Feed.asp?CatID=138' target='_blank'><img src='/images/rss_icon.gif'></a></li><li><a href='/Category/Diary/'>个人日记</a> (0) <a href='/rss/Feed.asp?CatID=137' target='_blank'><img src='/images/rss_icon.gif'></a></li><li><a href='/Category/News/'>行业资讯</a> (0) <a href='/rss/Feed.asp?CatID=133' target='_blank'><img src='/images/rss_icon.gif'></a></li><li><a href='/Category/Codes/'>编程开发</a> (0) <a href='/rss/Feed.asp?CatID=135' target='_blank'><img src='/images/rss_icon.gif'></a></li></ul>
				</li>
				<li>
					<h2>热门文章</h2>
暂无信息。
				</li>
				<li>
					<h2>友情链接</h2>
<div class="FriendLink">$web_link$</div>
				</li>
			</ul>
		</div>                       
        </div></div>
        <div id="footer">
<div class="footer_txt"><span style="float:left">wish5115@github.io</span>
<a style="float:right" href="/adminCool">管理</a>
</div>
	</div>
    </div>
</body>
</html>

