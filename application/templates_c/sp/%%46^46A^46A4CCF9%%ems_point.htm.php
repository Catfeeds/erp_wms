<?php /* Smarty version 2.6.20, created on 2017-01-05 14:05:43
         compiled from D:%5Cphpstudy%5CWWW%5Cerp_wms%5Capplication%5Ctemplates/sp/ems_point.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>订单打印</title>
</head>
<style>
.next { page-break-after: always; }
.tableall td{ height:20px; line-height:20px; border-top: 1px solid #000; padding-left:10px;}
.tableall .rtd{border-right: 1px solid #000;}
.tableall{border-collapse: separate;border-spacing: 2px;border-color: gray; width:550px;} 
.tableall .ymd{ margin-left:26px;}
.tableall .fl{ float:left; font-size:2.5em; display:block;}
.tableall .name{ width:100px; display:block; float:left;}
.tableall .name1{ width:140px; display:block; float:left;}
.tableall .h40{ height:44px; line-height:22px; vertical-align:text-top;}
.tableall .numweight div{ text-align:left;}
.tableall .numweight div .c2{ width:80px; display:block; float:right;}
.tableall .numweight div .c1{ width:140px; display:block; float:right;}
.tableall .fm{ font-size:1.3em;font-weight:bold; }
</style>
<!--
宽度 104mm 378px;
高度 60mm  220px;
高度 90mm  
-->
<body style="margin:0px;  font-size:12pt; font-family:'微软雅黑'; font-weight:bold; line-height:1.1em; ">
<?php $_from = $this->_tpl_vars['re']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['v']):
?>
<div style="overflow:hidden; height:800px; width:550px;">
    <table class="tableall">
        <tr>
            <td colspan="2" style="height:80px; line-height:80px; width:280px; font-size:1.5em; padding-left:10px;">  <img  style="margin-left:10px; float:right;"   src="/lib/barcode128.php?text=<?php echo $this->_tpl_vars['v']['logistics_no']; ?>
"><span class="fl"> SPS </span></td>
        </tr>
       <tr>
           <td class="rtd"   style="width:280px;" >时间：<?php echo $this->_tpl_vars['time']; ?>
   </td>
           <td class="rtd fm" rowspan="3"> <?php echo $this->_tpl_vars['v']['province']; ?>
 <?php echo $this->_tpl_vars['v']['city']; ?>
</td>
       </tr>
       <tr>
           <td class="rtd"  >寄件信息:邮政报关部,028-85885850</td>
       </tr>
       <tr>
           <td class="rtd" > 寄件地址:成都市双流航空港黄河中路一段149号 </td>
       </tr>
       <tr>
           <td class="rtd" colspan="2">收件信息:<?php echo $this->_tpl_vars['v']['consignee']; ?>
,<?php echo $this->_tpl_vars['v']['consignee_mobile']; ?>
 </td>
       </tr>
        <tr>
           <td class="rtd" colspan="2">收货地址:<?php echo $this->_tpl_vars['v']['provice']; ?>
 <?php echo $this->_tpl_vars['v']['city']; ?>
 <?php echo $this->_tpl_vars['v']['area']; ?>
<?php echo $this->_tpl_vars['v']['consignee_address']; ?>
</td>
       </tr>
       <tr>
           <td class="rtd" >付款方式:  </td>
           <td class="rtd" >收件人/代收人:   </td>
       </tr>
       <tr>
           <td class="rtd" > 计费重量(KG):  </td>
           <td class="rtd" ><span>签收时间:</span><span class="ymd">年</span><span class="ymd">月</span><span class="ymd">日</span><span class="ymd">时</span> </td>
       </tr>
       <tr>
           <td class="rtd h40" >保价金:   </td>
           <td class="rtd h40" >快件人送达收货人地址,经济件人收件人允许的代收人签字,视为到达</td>
       </tr>
        <tr>
           <td class="rtd" align="center"><img  height="40" src="/lib/barcode128.php?text=<?php echo $this->_tpl_vars['v']['logistics_no']; ?>
"/> </td>
           <td class="rtd h40 numweight" ><div> <span class="c1">重量:<?php echo $this->_tpl_vars['v']['total_weight']/1000; ?>
(KG)</span> <span class="c2">件数：<?php echo $this->_tpl_vars['v']['total_num']; ?>
</span></div></td>
       </tr>
       <tr>
           <td class="rtd" colspan="2" style="height:120px; " valign="top" >配送信息:<?php echo $this->_tpl_vars['v']['con']; ?>
 </td>
       </tr>
        <tr>
           <td class="rtd" colspan="2" ><img style="margin-left:10px;"   src="/lib/barcode128.php?text=<?php echo $this->_tpl_vars['v']['logistics_no']; ?>
"></td>
       </tr>
        <tr>
           <td class="rtd h40" >寄件：寄件信息:邮政报关部,028-85885850 <br />寄件地址:成都市双流航空港黄河中路一段149号</td>
           <td class="rtd h40" >收件: <?php echo $this->_tpl_vars['v']['consignee']; ?>
,<?php echo $this->_tpl_vars['v']['consignee_mobile']; ?>
 <br />收件地址：<?php echo $this->_tpl_vars['v']['consignee_address']; ?>
</td>
       </tr>
        <tr > 
           <td  class="rtd" style="vertical-align:top;"  >备注:</td>
           <td class="rtd h40" ></td>
       </tr>
    </table>
 </div>   
<div class="next"></div>
<?php endforeach; endif; unset($_from); ?>

</body>
</html>