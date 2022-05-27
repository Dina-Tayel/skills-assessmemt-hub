<?php 

$path =__DIR__ . "/public/uploads/exams" ;
$start=1;
$end=80;
$ext='png';
for($i=$start+1 ; $i <=$end ; $i++)
{
    copy("$path/1.$ext" , "$path/$i.$ext");
    echo " image $i.$ext generated successfully <br> ";
}