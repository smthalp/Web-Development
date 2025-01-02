#!/usr/bin/perl -wT 
use CGI 'standard'; 
use CGI::Carp qw(warningsToBrowser fatalsToBrowser); 
use File::Basename; 
$CGI::POST_MAX = 1024 * 5000; 

my $safe_filename_characters = "a-zA-Z0-9_.-"; 
my $upload_dir = "../upload"; 
my $query = new CGI; 
my $filename = $query->param("picture"); 
if ( !$filename ) { print $query->header(-type => "text/html", -charset => "UTF-8"); print "There was a problem uploading your picture (try a smaller file)."; exit; } 
my ( $name, $path, $extension ) = fileparse ( $filename, '\..*' ); 
$filename = $name . $extension; 
$filename =~ tr/ /_/; 
$filename =~ s/[^$safe_filename_characters]//g; 

if ( $filename =~ /^([$safe_filename_characters]+)$/ ) { $filename = $1; } else { die "Filename contains invalid characters"; } 
my $upload_filehandle = $query->upload("picture"); 

open (UPLOADFILE, ">$upload_dir/$filename") or die "$!"; binmode UPLOADFILE; 
while ( <$upload_filehandle> ) { print UPLOADFILE; } 
close UPLOADFILE; 

print $query->header(-type => "text/html", -charset => "UTF-8");


$first = $query->param('first');
$last = $query->param('last');
$street = $query->param('street');
$postalcode = $query->param('postal');
$province = $query->param('province');
$phone = $query->param('number');
$email = $query->param('email');


print"<!DOCTYPE html>";
print"<html lang='en'>";
print <<HEAD;
<head><title>Lab07b Form Validation</title>
<style>
body {
            font-family: 'Chewy', cursive;
            background-color: #96869c;
            color: #333;
            text-align: center;
            padding-top: 50px;
        }
        p { font-size: 25px; }
        p.subparagraph { font-size: 20px; }
        div { text-align: center; }
        p.error{color:#5a0808;}
        button {
            font-family: 'Chewy', cursive;
            font-size: 20px;
            padding: 10px 25px;
            background-color: #5a4b6a;
            color: #fff;
            text-decoration: none;
			border-radius: 10px;
            transition: background-color 0.3s ease, transform 0.2s ease;
			margin-top:50px;			
        }
        button:hover {
            background-color: #7e679a;
            transform: scale(1.05);
        }
        button:active {
            background-color: #4c3b55;
        }
		a {color:black;}
        img {
            margin-top: 20px;
            border-radius: 10px;
            max-width: 300px;
            max-height: 300px;
        }
		h1 {font-size:40px;}
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chewy&display=swap" rel="stylesheet">

</head>
HEAD


print"<body><p>";
print"<h1>Form Results</h1>";
print"<p>Welcome, $first $last !</p>";
print"<p>Street: $street </p>";
if ($postalcode =~/^[A-Z]\d[A-Z] \d[A-Z]\d$/){
	print"<p>Postal Code: $postalcode</p>";
}
else{
print"<p class='error'>You have entered an invalid postal code, please try again</p>";
}
if ($province eq ""){print"<p>Province not entered</p>";} else {print"<p>Province: $province</p>";}

if ($phone =~ /^\d{10}$/) {print"<p>Phone Number: $phone</p>";} else {print"<p class='error'>You have entered an invalid phone number, please try again</p>";}

if ($email =~ /^[\w\.-]+@[\w\.-]+\.\w{2,}$/) {
    print "<p>Email: $email</p>";
} else {
    print "<p class='error'>You have entered an invalid email address, please try again</p>";
}


print"<div><img src='/~slopapa/upload/$filename' alt='Uploaded Image'></div>";
print"<button><a href='../LAB7/lab07b.html' class='link'>Go Back To Form</a></button>";
print"</body></html>";