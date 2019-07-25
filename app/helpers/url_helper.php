<?php
  // Simple page redirect
  function redirect($page){
    header('location: '.URLROOT.'/'.$page);
  }

  // function getPostLink($post_link){
  //   $post_link = preg_replace("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/", "<a href='$0' target='_blank'>$0</a>", $post_link);
  //   //$post_link = preg_replace("/(https?:\/\/)([\w]+.)([\w\.]+)/", "<a href='$0' target='_blank'>$0</a>", $post_link);
  //   $post_link = preg_replace("/#([\w]+)/", "<a href='".URLROOT."/hashtag/$1'>$0</a>", $post_link);
  //   $post_link = preg_replace("/@([\w]+)/", "<a href='".URLROOT."/profile?username=$1'>$0</a>", $post_link);
  //   return $post_link;
  // }

function getPostLink($post_link){
  $post_link = preg_replace(array('/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:\'".,<>?«»“”‘’]))/',
  '/(^|[^a-z0-9_])@([a-z0-9_]+)/i', '/(^|[^a-z0-9_])#([a-z0-9_]+)/i'), array('<a href="$1" target="_blank">$1</a>', '$1<a href="profile?u=$2">@$2</a>', '<b>$1</b><a href="hashtag?tag=$2">#$2</a>'), $post_link);
  return $post_link;
}
