<?php

$LOCAL_ROOT         = "/home/alfredoes/public_html";
$LOCAL_REPO_NAME    = "public_html";
$LOCAL_REPO         = "{$LOCAL_ROOT}/{$LOCAL_REPO_NAME}";
$REMOTE_REPO        = "git@github.com:EstacionaPA/site.git";
$BRANCH             = "master";

if ( $_POST['payload'] ) {

  if( file_exists($LOCAL_REPO) ) {
   
    shell_exec("cd {$LOCAL_REPO} && git pull");

    die("done " . mktime());
  } else {
    
    shell_exec("cd {$LOCAL_ROOT} && git clone {$REMOTE_REPO}");
    
    die("done " . mktime());
  }
}

?>
