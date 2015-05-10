#!/usr/bin/perl
#
#script to parse mail.log from postfix
# and send information to a .csv file.
# Information is sender, recipient, date,
# size and status of message.
#
use strict;
use warnings;
 
#my $maillog = "/var/log/mail.log";
#my $csvfile = "logmail.csv";

my @months = qw( Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec );
my @days = qw(Sun Mon Tue Wed Thu Fri Sat Sun);

(my $sec,my $min,my $hour,my $mday,my $mon,my $year,my $wday,my $yday,my $isdst) = localtime();
#my $time_max = "$months[$mon]  $mday $hour:$min:$sec\n";
#my $time_min = "$months[$mon]  $mday $hour:$min-5:$sec\n";
my $datestr = "$year-$mon-$mday";
my $maillog = "/var/log/mail.log";
my $csvfile = "logmail.$datestr.csv";
print "$datestr\n";
print localtime();
# Open maillog.
open(LOG, $maillog);
my @mailentries = <LOG>;
close(LOG);
#print @mailentries;

# Define some global variables.
my (%from, %size, %to, %relay, %status, $postscsv);
 
foreach (@mailentries) {
  # Next if the row does not contain a mailadress.
  next if ($_ !~ /[\w\-\_\.]+\@[\w\-\_\.]+\.[a-z]+/);
 
  # Collect data from log.
  $_ =~ m/(\w+\s\s\d+\s\d+\:\d+\:\d+)\s.+\[[0-9]+\]\:\s([\w]+)\:(\s(from\=\<(.+)\>\,\ssize\=([0-9]+),)|(\sto\=\<([\w\-\_\.]+\@[\w\-\_\.]+\.[a-z]+)\>.+relay\=([\w\d\.]+).+status\=(.+\))))/gi;
  # Assign variables, $mailid is identifier for mail, therefor it can be used as key in hash.
  # All posts are assigned to a hash with the $mailid as key.
  my ($date, $rid)  = ($1, $2);
  #print $date;
  $relay{$rid} = $9 if($9);
  ($from{$rid}, $size{$rid})    = ($5, $6) if ($5 && $6);
  ($to{$rid}, $status{$rid})    = ($8, $10) if ($8 && $10);
  my @cmp;
  my $dstr;
  if($date){
  @cmp = split(':', $date);
  $dstr = "$months[$mon]  $mday $hour";
  }
  #print @cmp[0];
  #print "\n";  
  #Formated csv-string, this is global!
  #if( $date && ($dstr eq $cmp[0]) && ($cmp[1]>($min-5)) ){
  $postscsv .= "$from{$rid},$to{$rid},$relay{$rid},$date,$size{$rid},$status{$rid}\n"
  if ( $date && $rid && exists($from{$rid}) && exists($size{$rid}) && exists($to{$rid}) && exists($status{$rid}) && exists($relay{$rid}) );
  #print $postscsv;
  #}
}
 
# Write to $csvfile.
open(CSV, "> $csvfile");
print CSV $postscsv;
close(CSV);
