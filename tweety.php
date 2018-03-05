<?php
/*
   Yangon Ethical Hacker Group's DDoS Shield Beta 1.02
   Proof of Concept and modified by br0 AKA TweetyCoaster(Myanmar, http://www.yehg.org)
       0.9/Add remote IP to Warning messages modified by SaturnGod
       (Myanmar, http://www.mysteryzillion.com, http://edu.mysteryzillion.com)
       30-July-2008(Wednesday)
       1.01/Added mailing system on 31-July-2008(Thursday) by TweetyCoaster
       1.02/Added cross icon and seconds of at mail subject 
            on 31-July-2008(Thursday) by TweetyCoaster   
   Based on a PHP script written by an unkown programmer(who we forgot name).
   Special thanks to him/her.
================= How To Setup ============================
   ------------------------------------------------------------
   Copy this file and folder to same folder of ur index.php.
   Add following line to ur index.php, after symbol "<?php" 
   include("tweety.php");
   O.K. Now .... Ready to prevent .... !! good luck guys.... !! :-)
   ------------------------------------------------------------
*/

  // INITIALIZATIONS:

  //   Set Value as ur choice but read first comment beside of values !!!!
  //   I set it up my choice now !!!
  //     Fixed:
  $crlf=chr(13).chr(10);
  $itime=3;  // minimum number of seconds between one-visitor visits
  $imaxvisit=10;  // maximum visits in $itime x $imaxvisits seconds
  $ipenalty=($itime * $imaxvisit);  // minutes for waitting
  $iplogdir="./Tweetylogs/";
  $iplogfile="AttackersIPs.Log";
  
  // Time
  $today = date("Y-m-j,G");
  $min = date("i");
  $sec = date("s");
  $r = substr(date("i"),0,1);
  $m =  substr(date("i"),1,1);
  $minute = 0;
  
  // Set ur admin's email address and others as u like
  $to      = 'tweetycoaster@gmail.com';   //ur admin's email address
  $headers = 'From: Little Lady Baby@yehg.net' . "\r\n" .   //  change as ur wish 	   
    		 'X-Mailer: yehg.net DDoS Attack Shield';
  $subject = "Warning of Possible DoS Attack @ $today:$min:$sec";
  

  //     Warning Messages:
  $message1='<font color="red">Temporarily under heavy traffic or some like as DoS attack !!!</font><br>';
  $message2='Please wait ... ';
  $message3=' seconds or try again after some minutes from now.<br>';
  $message4='<font color="blue">Protected by TweetyCoaster Little Lady Baby DDoS Shield !!!</font><br>If you are a human, change IP or using freedom, ultra surf etc.<br>We temporarily banned IP <b>'.$_SERVER["REMOTE_ADDR"].' </b>from DoS attack.';
  $message5=' Your site got attacking or bot like visiting from IP address: '.$_SERVER["REMOTE_ADDR"];
  $message6='<br><img src="./Tweetylogs/cross.gif" alt="" border="0">'; 
//---------------------- End of Initialization ---------------------------------------  

  //     Get file time:
  $ipfile=substr(md5($_SERVER["REMOTE_ADDR"]),-3);  // -3 means 4096 possible files
  $oldtime=0;
  if (file_exists($iplogdir.$ipfile)) $oldtime=filemtime($iplogdir.$ipfile);

  //     Update times:
  $time=time();
  if ($oldtime<$time) $oldtime=$time;
  $newtime=$oldtime+$itime;

  //     Check human or bot:
  if ($newtime>=$time+$itime*$imaxvisit)
  {
    //     To block visitor:
    touch($iplogdir.$ipfile,$time+$itime*($imaxvisit-1)+$ipenalty);
    header("HTTP/1.0 503 Service Temporarily Unavailable");
    header("Connection: close");
    header("Content-Type: text/html");
    echo '<html><head><title>Overload Warning by Little Lady Baby DDoS Shield beta 1.02!!!</title></head><body><p align="center"><strong>'
          .$message1.'</strong>'.$br;
    echo $message2.$ipenalty.$message3.$message4.$message6.'</p></body></html>'.$crlf;
   //     Mailing Warning Message to Site Admin
     {
	@mail($to, $subject, $message5, $headers);	
     }
    //     logging:
    $fp=@fopen($iplogdir.$iplogfile,"a");
    if ($fp!==FALSE)
    {
      $useragent='<unknown user agent>';
      if (isset($_SERVER["HTTP_USER_AGENT"])) $useragent=$_SERVER["HTTP_USER_AGENT"];
      @fputs($fp,$_SERVER["REMOTE_ADDR"].' on '.date("D, d M Y, H:i:s").' as '.$useragent.$crlf);
    }
    @fclose($fp);
    exit();

  }

  //     Modify file time:
  touch($iplogdir.$ipfile,$newtime);

?>