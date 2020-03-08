<?php
$rep = 1;
$sze = 1;
$lst = "files/";

$f=$_GET["f"];
if(file_exists($f)){
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.basename($f));
$fp=fopen($f,"r");
while(feof($fp)===false){
print fread($fp,1024);
}
exit;
}

$drc=dir($lst);
print("<OL>");
        while($fl=$drc->read()) {
        $lfl = $lst."/".$fl;
        $din = pathinfo($lfl);
        if(is_dir($lfl) && ($fl!=".." && $fl!=".")){
        print("<LI>".$din["basename"]."<FONT size='-1'> (ディレクトリ)</FONT></LI>");
        } else if($fl!=".." && $fl!=".") {
        print("<LI>");
                print("<a href=download.php?f=".urlencode($lst."/".$fl).">".$fl."</a>");
                if($rep == 1 || $sze == 1) print("<FONT size='-1'> (");
                        if($rep == 1) echo date("m/d",filemtime($lfl));
                        if($rep == 1 && $sze == 1) print(", ");
                        if($sze == 1) echo round(filesize($lfl)/1024)."KB";
                        if($rep == 1 || $sze == 1) print(")</FONT> ");
                print("</LI>");
        }
        }
        print("</OL>");
$drc->close();
?>

