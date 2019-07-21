<?php
  // Simple page redirect
  function redirect($page){
    header('location: '.URLROOT.'/'.$page);
  }

  function getPostLink($post_link){
    $post_link = preg_replace("/(https?:\/\/)([\w]+.)([\w\.]+)/", "<a href='$0' target='_blank'>$0</a>", $post_link);
    $post_link = preg_replace("/#([\w]+)/", "<a href='".URLROOT."/hashtag/$1'>$0</a>", $post_link);
    $post_link = preg_replace("/@([\w]+)/", "<a href='".URLROOT."/profile?username=$1'>$0</a>", $post_link);
    return $post_link;
  }
