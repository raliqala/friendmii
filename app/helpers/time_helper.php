<?php

//<link rel="stylesheet" href="<?php echo URLROOT; phptag/css/style.css">
 //date_default_timezone_set('Africa/Johannesburg');
 //echo friendmii_time_ago('2019-04-21 04:56:19.000');
 //date_default_timezone_get();
 date_default_timezone_set('America/New_York');
//  function get_time_ago($timestamp)
//  {
//       $time_ago = strtotime($timestamp);
//       $current_time = time();
//       $time_difference = $current_time - $time_ago;
//       $seconds = $time_difference;
//       $minutes      = round($seconds / 60 );           // value 60 is seconds
//       $hours           = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec
//       $days          = round($seconds / 86400);          //86400 = 24 * 60 * 60;
//       $weeks          = round($seconds / 604800);          // 7*24*60*60;
//       $months          = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60
//       $years          = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60
//       if($seconds <= 60)
//       {
//      return "Just Now";
//    }
//       else if($minutes <=60)
//       {
//      if($minutes==1)
//            {
//        return "one minute ago";
//      }
//      else
//            {
//        return "$minutes minutes ago";
//      }
//    }
//       else if($hours <=24)
//       {
//      if($hours==1)
//            {
//        return "an hour ago";
//      }
//            else
//            {
//        return "$hours hours ago";
//      }
//    }
//       else if($days <= 7)
//       {
//      if($days==1)
//            {
//        return "yesterday";
//      }
//            else
//            {
//        return "$days days ago";
//      }
//    }
//       else if($weeks <= 4.3) //4.3 == 52/12
//       {
//      if($weeks==1)
//            {
//        return "a week ago";
//      }
//            else
//            {
//        return "$weeks weeks ago";
//      }
//    }
//        else if($months <=12)
//       {
//      if($months==1)
//            {
//        return "a month ago";
//      }
//            else
//            {
//        return "$months months ago";
//      }
//    }
//       else
//       {
//      if($years==1)
//            {
//        return "one year ago";
//      }
//            else
//            {
//        return "$years years ago";
//      }
//    }
//  }

function get_time_ago($time)
{

    $time_difference = time() - strtotime($time);

    if( $time_difference < 1 ) { return 'just now'; }
    $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $time_difference / $secs;

        if( $d >= 1 )
        {
            $t = round( $d );
            return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}
// function get_time_ago($date) {
//     $timestamp = strtotime($date);	
    
//     $strTime = array("second", "minute", "hour", "day", "month", "year");
//     $length = array("60","60","24","30","12","10");

//     $currentTime = time();
//     if($currentTime >= $timestamp) {
//          $diff     = time()- $timestamp;
//          for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
//          $diff = $diff / $length[$i];
//          }

//          $diff = round($diff);
//          return $diff . " " . $strTime[$i] . "(s) ago ";
//     }
//  }

 ?>
