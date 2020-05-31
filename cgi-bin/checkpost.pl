#!/soft/script/bin/perl
read(STDIN,$temp,$ENV{'CONTENT_LENGTH'});
@pairs=split(/&/,$temp);

foreach $item(@pairs)
 {
  ($key,$content)=split(/=/,$item,2);
  $content=~tr/+/ /;
  $content=~s/%(..)/pack("c",hex($1))/ge;
  $fields{$key}=$content;

  #determine whether do move of delete the file
  $test = substr $key, 0, 4;
  if($test eq 'post'){
     $action = $fields{$key};
  }
   else{
     if($action eq 'keep'){
        @args = ("mv", "$fields{$key}", "../log/.");
        system(@args) == 0
           or die "system @args failed: $?";
        $action = "";
     }

     if($action eq 'lose'){
        @args = ("rm", "-f", "$fields{$key}");
        system(@args) == 0
           or die "system @args failed: $?";
        $action = "";
     }

     if($action eq ''){
        #does nothing with the file
     }
  }
 }                                       


#url page to load
$gourl = "http://web.utk.edu/~speak/newposts/newposts.php";
print "Location: $gourl\n\n"; 
