#!/usr/bin/ruby -wT
require 'cgi'

cgi = CGI.new

city = cgi['city'].capitalize
province = cgi['province'].capitalize if cgi.has_key?('province')
country = cgi['country'].capitalize
url = cgi['url']

puts "Content-type: text/html\n\n"

puts <<HTML
<html lang="en">
<head>
<title>Lab 10p</title>

<style>
div {font-family: 'Comic Sans MS', cursive, sans-serif;}
body {background-color: #f0f8ff;}
</style>
</head>
<body>
<div style="text-align:center; color: #d32f2f;background-color:#4caf50; font-size:3em;">
HTML

if !province.empty?
  puts "#{city}, #{province}, #{country}"
else
  puts "#{city}, #{country}"
end

puts <<HTML
</div>
<div style="text-align:center;">
<img src="#{url}" style="width: 100%; height: auto; border: 10px red;">
</div>
</body>
</html>
HTML