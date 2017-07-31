<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2017-02-27 16:58:32 --> Severity: Parsing Error --> syntax error, unexpected T_VARIABLE D:\phpstudy\WWW\erp_wms\application\controllers\admin\Filing.php 69
ERROR - 2017-02-27 16:58:52 --> Severity: Warning --> Missing argument 1 for tab_m(), called in D:\phpstudy\WWW\erp_wms\application\models\Base_Filing_model.php on line 53 and defined D:\phpstudy\WWW\erp_wms\application\helpers\basefunction_helper.php 227
ERROR - 2017-02-27 16:58:52 --> Query error: file: D:\phpstudy\WWW\erp_wms\application\models\Base_Filing_model.php line: 55---Table 'zjh_product.dferp_stockas' doesn't exist - Invalid query: SELECT `a`.*, `b`.`name_par`, `b`.`price_par`, `b`.`status_par`
FROM `dferp_stockAS` `a`
JOIN `dferp_` ON `AS``b`
ORDER BY `id` DESC
 LIMIT 15
ERROR - 2017-02-27 16:58:52 --> Severity: Error --> Call to a member function result_array() on a non-object D:\phpstudy\WWW\erp_wms\application\models\Base_Filing_model.php 56
ERROR - 2017-02-27 16:59:19 --> Query error: file: D:\phpstudy\WWW\erp_wms\application\models\Base_Filing_model.php line: 54---Table 'zjh_product.dferp_stockas' doesn't exist - Invalid query: SELECT `a`.*, `b`.`name_par`, `b`.`price_par`, `b`.`status_par`
FROM `dferp_stockAS` `a`
ORDER BY `id` DESC
 LIMIT 15
ERROR - 2017-02-27 16:59:19 --> Severity: Error --> Call to a member function result_array() on a non-object D:\phpstudy\WWW\erp_wms\application\models\Base_Filing_model.php 55
ERROR - 2017-02-27 17:27:03 --> Severity: Parsing Error --> syntax error, unexpected T_FOREACH D:\phpstudy\WWW\erp_wms\application\controllers\admin\Filing.php 28
ERROR - 2017-02-27 17:27:44 --> Query error: file: D:\phpstudy\WWW\erp_wms\application\models\Base_Filing_model.php line: 22---Unknown column 'customs_type' in 'where clause' - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `dferp_stock`
WHERE `customs_type` = '2'
ERROR - 2017-02-27 17:27:44 --> Severity: Error --> Call to a member function num_rows() on a non-object D:\phpstudy\WWW\erp_wms\system\database\DB_query_builder.php 1412
ERROR - 2017-02-27 17:28:37 --> Query error: file: D:\phpstudy\WWW\erp_wms\application\models\Base_Filing_model.php line: 22---Unknown column 'customs_type' in 'where clause' - Invalid query: SELECT COUNT(*) AS `numrows`
FROM `dferp_stock`
WHERE `customs_type` = '1'
ERROR - 2017-02-27 17:28:37 --> Severity: Error --> Call to a member function num_rows() on a non-object D:\phpstudy\WWW\erp_wms\system\database\DB_query_builder.php 1412
