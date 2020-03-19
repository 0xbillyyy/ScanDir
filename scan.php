<?php
error_reporting(0);
system("clear");
/*

This tool has been made a long time with the python version, but I made a php version
Source->ICWR-TECH

*/
echo "
--------------------------------------------------------

Dir & Sensitive File Scanner (PHP Version)

--------------------------------------------------------
\n";
$list=file_get_contents("list.txt");
$user_agent=file_get_contents("user-agents.txt");
$exp_list=explode("\n",$list);
$exp_user=explode("\n",$user_agent);
echo "Target? (Use http, https or not) -> ";
$website=trim(fgets(STDIN));
if($website==true){
foreach($exp_list as $asu){
    $target=$website."/".$asu;
    $ch = curl_init($target);
    curl_setopt($ch,CURLOPT_USERAGENT,$exp_user[rand(0,999)]);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $ex = curl_exec($ch);
    $kode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    if($kode==200){
	echo "[+] ".$target." => ".$kode."\n";
    }else{
	echo "[-] ".$target." => ".$kode."\n";
	continue;
    }
	if($kode==200){
		echo "Dir ditemukan lanjut?(enter untuk lanjut || ketik n untuk keluar) ";
		$lanjut=trim(fgets(STDIN));
		if($lanjut==false){
			continue;
		}else{
			exit;
		}
	}else{
		exit;
	}
}
}else{
	echo "Masukan target!\n";
	exit;
}
?>
