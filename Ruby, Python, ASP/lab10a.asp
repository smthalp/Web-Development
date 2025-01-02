<%
Dim bgc
bgc = Request.QueryString("colour")
If bgc = "" Then
		bgc = "white"
End If

Dim visited
visited = Request.Cookies("Visited")

If visited = "" Then
	visited = "Visiting this page for the first time."
Else
	visited = "Last visit was on: " & visited
End If

Response.Cookies("Visited") = Now()
Response.Cookies("Visited").Expires = DateAdd("d", 30, Now())
%>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Lab10a</title>
</head>
<body style ="background-color: <%= bgc %>;text-align:center;font-size:4em;">
<p> Hello, </p>
<p> to change the background colour use: ?colour=(colour).
<p> <%= visited %> (in server's time)</p>



</html>