<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Logging Class
 * 日志记录类，只要用于记录CI框架信息的一些操作日志(错误日志、调试日志、信息日志等等)。
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Logging
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/errors.html
 */
class CI_Log {

	/**
	 * Path to save log files 日志存放路径
	 *
	 * @var string
	 */
	protected $_log_path;

	/**
	 * File permissions  写入的日志文件权限，即rw-r--r--
	 *
	 * @var	int
	 */
	protected $_file_permissions = 0644;

	/**
	 * Level of logging  允许写入日志的阈值，默认为1
	 * 					 0 =Disables logging ,Error logging Turned off
	 * 					 1 =Error Messages(including php errors)
	 * 					 2 =Debug Messages
	 * 					 3 =informational Messages
	 * 					 4 =All Messages
	 *
	 * @var int
	 */
	protected $_threshold = 1;

	/**
	 * Array of threshold levels to log  也是允许写日志的阈值，但与$_threshold有些不同
	 * 									 比如设置配置文件$config['log_threshold'] =3,这个值会读到$_threshold属性中，那么写日志允许的level可以是1、2、3
	 * 									 可是如果设置$config['log_threshold'] = array(3),那么系统会把这个3读到$_threshold_array数组中，写日志level为3，其他的1和2 不允许
	 *
	 *
	 * @var array
	 */
	protected $_threshold_array = array();

	/**
	 * Format of timestamp for log files 日志的时间格式 ，由$config['log_date_format'] 决定。默认'Y-m-d H:i:s'。主要作用于$data->format的参数
	 *
	 * @var string
	 */
	protected $_date_fmt = 'Y-m-d H:i:s';

	/**
	 * Filename extension  日志文件的扩展名
	 *
	 * @var	string
	 */
	protected $_file_ext;

	/**
	 * Whether or not the logger can write to the log files  标记字段。标记是否有权限写日志
	 *
	 * @var bool
	 */
	protected $_enabled = TRUE;

	/**
	 * Predefined logging levels  预定义的level级别数组
	 *
	 * @var array
	 */
	protected $_levels = array('ERROR' => 1, 'DEBUG' => 2, 'INFO' => 3, 'ALL' => 4);

	// --------------------------------------------------------------------

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		$config =& get_config();
		//赋值给$this->_log_path;如果没有配置，则使用APPPATH.'logs/'
		$this->_log_path = ($config['log_path'] !== '') ? $config['log_path'] : APPPATH.'logs/';
		//赋值给$this->_file_ext,如果没有配置，则使用php
		$this->_file_ext = (isset($config['log_file_extension']) && $config['log_file_extension'] !== '')
			? ltrim($config['log_file_extension'], '.') : 'php';
		//如果不在存在日志目录，则创建文件目录
		file_exists($this->_log_path) OR mkdir($this->_log_path, 0755, TRUE);
		// 如果日志路径不是文件  或者不可写，就把日志类标记为 没有权限写日志
		if ( ! is_dir($this->_log_path) OR ! is_really_writable($this->_log_path))
		{
			$this->_enabled = FALSE;
		}
		//如果日志阈值为数字，则赋值给$this->_threshold
		//如果日志阈值为数组，则赋值给$this->_threshold_arr
		if (is_numeric($config['log_threshold']))
		{
			$this->_threshold = (int) $config['log_threshold'];
		}
		elseif (is_array($config['log_threshold']))
		{
			$this->_threshold = 0;
			$this->_threshold_array = array_flip($config['log_threshold']);
		}
		//日志的日期格式，赋值给$this->_date_fmt
		if ( ! empty($config['log_date_format']))
		{
			$this->_date_fmt = $config['log_date_format'];
		}
		//日志的写入权限 ,赋值给$this->_file_permissions
		if ( ! empty($config['log_file_permissions']) && is_int($config['log_file_permissions']))
		{
			$this->_file_permissions = $config['log_file_permissions'];
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Write Log File
	 * 写入日志
	 * 该方法以下几种方法不写：
	 * 1、目录没有写权限时。$this->_enabled == FALSE时
	 * 2、阈值与log记录等级不匹配时
	 * $_threshold 和 $_threshold_array 都是允许写日志的阈值，但两者之间有些不同。
	 * 比如设置配置文件$config['log_threshold'] = 3,这个值会读取到$_threshold 中，那么写日志允许level可以是1、2、3
	 * 可是如果设置$config['log_threshold'] = array(3),那么系统会将值读取到$_threshold_array数组中，写日志level只允许3，其他的1和2 不允许
	 * 3、文件打开失败时
	 * 如果以上条件都不满足，那么该方法就计算得到日志文件名，计算文件内容，最后写入，并更改文件权限为$this->_file_permissions
	 * 对于新创建并且后缀为php的文件。系统首先在前面加上"<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>\n\n"
	 * Generally this function will be called using the global log_message() function
	 *
	 * @param	string	$level 	The error level: 'error', 'debug' or 'info'
	 * @param	string	$msg 	The error message
	 * @return	bool
	 */
	public function write_log($level, $msg)
	{
		if ($this->_enabled === FALSE)
		{
			return FALSE;
		}

		$level = strtoupper($level);
		//写日志的level级别大于阀值设置值，同时level级别也不能匹配阀值数组中设置的值，返回FALSE退出
		if (( ! isset($this->_levels[$level]) OR ($this->_levels[$level] > $this->_threshold))
			&& ! isset($this->_threshold_array[$this->_levels[$level]]))
		{
			return FALSE;
		}
		//设置文件全路径及名称
		$filepath = $this->_log_path.'log-'.date('Y-m-d').'.'.$this->_file_ext;
		$message = '';
		//新创建并且后缀为php的文件，系统首先在前面加上
        //"<?php defined('BASEPATH') OR exit('No direct script access allowed');\n\n"
		if ( ! file_exists($filepath))
		{
			$newfile = TRUE;
			// Only add protection to php files
			if ($this->_file_ext === 'php')
			{
				$message .= "<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>\n\n";
			}
		}
		//无法打开文件，返回FALSE退出 
		if ( ! $fp = @fopen($filepath, 'ab'))
		{
			return FALSE;
		}

		flock($fp, LOCK_EX);

		// Instantiating DateTime with microseconds appended to initial date is needed for proper support of this format
		//实例化时间  
		if (strpos($this->_date_fmt, 'u') !== FALSE)
		{
			$microtime_full = microtime(TRUE);
			$microtime_short = sprintf("%06d", ($microtime_full - floor($microtime_full)) * 1000000);
			$date = new DateTime(date('Y-m-d H:i:s.'.$microtime_short, $microtime_full));
			$date = $date->format($this->_date_fmt);
		}
		else
		{
			$date = date($this->_date_fmt);
		}

		$message .= $this->_format_line($level, $date, $msg);

		for ($written = 0, $length = strlen($message); $written < $length; $written += $result)
		{
			if (($result = fwrite($fp, substr($message, $written))) === FALSE)
			{
				break;
			}
		}

		flock($fp, LOCK_UN);
		fclose($fp);

		if (isset($newfile) && $newfile === TRUE)
		{
			chmod($filepath, $this->_file_permissions);
		}

		return is_int($result);
	}

	// --------------------------------------------------------------------

	/**
	 * Format the log line.
	 * 格式化输出日志信息行
	 * This is for extensibility of log formatting
	 * If you want to change the log format, extend the CI_Log class and override this method
	 *
	 * @param	string	$level 	The error level
	 * @param	string	$date 	Formatted date string
	 * @param	string	$msg 	The log message
	 * @return	string	Formatted log line with a new line character '\n' at the end
	 */
	protected function _format_line($level, $date, $message)
	{
		return $level.' - '.$date.' --> '.$message."\n";
	}
}
