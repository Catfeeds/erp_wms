<?php
/******默认1分钟执行一次配置计划任务********/
/*****配置在linux 计划任务中*****/
if(@function_exists('date_default_timezone_set'))
	@date_default_timezone_set('Asia/Shanghai');
$ts=date("s")*1; //秒 
$ti=date("i")*1; //分
$tH=date("H")*1; //小时



//include('spopenapi.php/')