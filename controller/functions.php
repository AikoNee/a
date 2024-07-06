<?php

   function getCurrentMilliseconds(){
   $ms =  (int) floor(microtime(true));
   $randomINT = rand(10000, 99999);
   return $ms + $randomINT;
   }


   function expiredSessionTime($sessionStartTime){
    $threshold = 1800; // 30 minutes in seconds
    $currentTime = time();
    $startTime = $sessionStartTime;
    if( ($currentTime - $startTime ) > $threshold ) {
        return true;
    }else {
        return false;
    }
   }
   
