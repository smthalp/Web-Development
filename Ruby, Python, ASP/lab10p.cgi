#!/usr/bin/python
import os
from platform import python_version
import cgi 


print "Content-type:text/html\n\n"

form = cgi.FieldStorage()
city = form.getvalue('city').upper()
province = form.getvalue('province')
country = form.getvalue('country').upper()
url = form.getvalue('url')

print '''
<html lang="en">
<head>
<title>Lab 10p</title>
<style>
div {font-family: 'Comic Sans MS', cursive, sans-serif;}
body {background-color: #f0f8ff;}
</style>
</head>
<body>
<div style="text-align:center; color:#d32f2f;background-color:#4caf50; font-size:3em;">
'''
if province:
    print "%s, %s, %s" % (city, province.upper(), country)
else:
    print "%s, %s" % (city, country)

print "</div>"
print '<div style="text-align:center;">'
print '<img src="{}" style="width: 80%; height: auto;border: 10px red;">'.format(url)
print '</div>'
print '''
</body>
</html>
'''