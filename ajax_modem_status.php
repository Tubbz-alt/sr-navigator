<?
// ===================================================================
// Sim Roulette -> AJAX
// License: GPL v3 (http://www.gnu.org/licenses/gpl.html)
// Copyright (c) 2016-2020 Xzero Systems, http://sim-roulette.com
// Author: Nikita Zabelin
// ===================================================================

include("_func.php");

$s=onlineTable((int)$_GET['device']);
if (!$numb=$s[1])
{
	echo 'hide#-#'.$id.'#-#';
	exit();
}
$s=$s[0];

$answer=$number='';
$id=$_GET['id'];
if ($result = mysqli_query($db, 'SELECT * FROM `sms_incoming` WHERE `number` IN ('.implode(',',$numb).') AND `id`>='.(int)$id.' ORDER BY `id` LIMIT 1')) 
{
	if ($row = mysqli_fetch_assoc($result))
	{
		$number='+'.$row['number'];
		$txt=$row['txt'];
		$txt=preg_replace('!([0-9]{4,20})!','<span class="note">$1</span>',$txt);
		$time=$row['time'];
		$sender=$row['sender'];
		mysqli_query($db, 'UPDATE `sms_incoming` SET `readed`=1 WHERE `id`='.$row['id']); 
		$id=$row['id']+1;
	}
}
if (!$_GET['txt'])
{
	$answer=onlineView($numb);
	$id=$answer[1];
	$answer=$answer[0];
}
elseif ($number)
{
	$txt=preg_replace('!([0-9]{4,20})!','<span class="note" onclick="copy(\'$1\');soundClick();">$1</span>',$txt);
	$answer='<div class="term_answer_item"><div class="answer_left answer_head" style="width: 100px;">'.date('H:i:s d.m',$time).'</div><div class="answer_head">'.$sender.'</div><div class="answer_left" style="width: 100px; margin-bottom: 10px;">'.$number.'</div><div>'.$txt.'</div></div>';
	$sound='#-#1';
}

echo $s.'#-#'.$id.'#-#'.$answer.$sound;
?>
