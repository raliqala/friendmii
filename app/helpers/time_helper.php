<?php

//<link rel="stylesheet" href="<?php echo URLROOT; phptag/css/style.css">
 //date_default_timezone_set('Africa/Johannesburg');
 //echo friendmii_time_ago('2019-04-21 04:56:19.000');
 //date_default_timezone_get();
 date_default_timezone_set('America/New_York');


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
            return '' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
        }
    }
}


function likesOrLike($dataMod){
  $like_count = $dataMod;
  if ($like_count == 0) {
    return '' . $like_count . ' ' . 'Likes';
  }else if($like_count == 1){
    return '' . $like_count . ' ' . 'Like';
  }else {
    return '' . $like_count . ' ' . 'Likes';
  }
}





 ?>
