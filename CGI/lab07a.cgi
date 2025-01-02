#!/usr/bin/perl -wT
use CGI ':standard';
use CGI::Carp qw(warningsToBrowser fatalsToBrowser);
print "Content-type: text/html\n\n";

print "<!DOCTYPE html>";
print "<html><head><title>Lab07a</title>";
print "<link href='https://fonts.googleapis.com/css2?family=Sour+Gummy&display=swap' rel='stylesheet'>";
print "<style>";
print ".sour-gummy {";
print " font-family: 'Sour Gummy', sans-serif;";
print " font-optical-sizing: auto;";
print " font-weight: 400;";
print " font-style: normal;";
print "}";
print "div {font-size: 100px; color: Green;text-align:center}";
print "</style>";
print "</head>";
print "<body>";
print "<div class='sour-gummy'>This is my first Perl program.</div>";
print "</body></html>";