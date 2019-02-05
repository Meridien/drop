<?php

$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator( dirname(__FILE__) . DIRECTORY_SEPARATOR . "drop" ));

$files = array(); 

foreach ($rii as $file) {

    if ($file->isDir()){ 
        continue;
    }

    $files[] = $file; 

}

$first_filename = "";
foreach($files as $file){
    
    $file_string = $file->getPathname();
    $file_string = str_replace('\\',"/",$file_string);
    $file_string = str_replace('/',DIRECTORY_SEPARATOR,$file_string);
    $file_string = str_replace(DIRECTORY_SEPARATOR,"/",$file_string);
    $file_string = str_replace($_SERVER["DOCUMENT_ROOT"],"",$file_string);
    
    if(strlen($file_string)>3){
        if($first_filename==""){$first_filename=$file_string;}
            echo "<a href=\"dl.php?dl=" . $file->getFilename() . "\" />Download: " . $file->getFilename() . " ("  . round($file->getSize()/1000000, 1) . " Mb)</a><br/>"; }
}

$n_files = count($files);

?>
<style type="text/css">
    * {
        text-align: center;
        font-family: sans-serif;
    }

    a {
        display: block;
        padding: 20px;
        font-weight: bold;
        font-size: 3em;
        border: 2px solid;
        background: #bbb;
        text-decoration: none;
        color: #fff;
    }

</style>