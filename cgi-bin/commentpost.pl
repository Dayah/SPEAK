#!/soft/script/bin/perl
read(STDIN,$temp,$ENV{'CONTENT_LENGTH'});
@pairs=split(/&/,$temp);
foreach $item(@pairs)
 {
  ($key,$content)=split(/=/,$item,2);
  $content=~tr/+/ /;
  $content=~s/%(..)/pack("c",hex($1))/ge;
  $fields{$key}=$content;
 }                                       


#thanks page to load
$thanksurl = "http://web.utk.edu/~speak/thanks.html";

#date commanc
$date_command = "/usr/bin/date";

#get the date and time
$date = `$date_command +"%A, %B %d, %Y at %T"`;
chop($date);

#get time
$logtime = time();

#file to write to
$tmp = "../newposts/posts/$logtime-$$";

open(LOG, ">>$tmp");

print LOG "$fields{name}\n";
print LOG "$fields{group}\n";
print LOG "$ENV{REMOTE_HOST}\n";
print LOG "$date\n";
print LOG "$fields{commenttext}";

close(LOG);

print "Location: $thanksurl\n\n"; 
