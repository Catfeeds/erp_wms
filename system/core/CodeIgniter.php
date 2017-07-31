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
 * System Initialization File
 *
 * Loads the base classes and executes the request.
 *
 * @package		CodeIgniter
 * @subpackage	CodeIgniter
 * @category	Front-controller
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/
 */

/**
 * 一、定义版本号
 * CodeIgniter Version
 *
 * @var	string
 *
 */

	define('CI_VERSION', '3.0.6');
/*
 * ------------------------------------------------------
 * 二、加载常量
 * 根据定义的环境，加载对应的环境目录下的常量，如果与系统常量冲突，最终以系统常量为准，所以环境常量无法覆盖系统常量。
 * 这样做主要为了快速设置特定环境下的特定常量。
 *  Load the framework constants
 * ------------------------------------------------------
 */
	if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/constants.php'))
	{
		require_once(APPPATH.'config/'.ENVIRONMENT.'/constants.php');
	}


	require_once(APPPATH.'config/constants.php');

/*
 * ------------------------------------------------------
 * 三、加载全局函数库
 *  Load the global functions
 * ------------------------------------------------------
 */
	require_once(BASEPATH.'core/Common.php');


/*
 * ------------------------------------------------------
 * 四、如果低于php5.4版本,将进行全局变量安全处理
 * 知识点：
 * 1、PHP变量解析顺序：ini_get('variables_order'),同时也声明了接受哪种类型发送过来的变量
 * 当程序中使用了$_REQUEST接受变量，设置顺序EGPCS(Environment,GET,POST,Cookie,Server)就很重要，注意是从右向左覆盖。
 * php 配置文件给出了配置提示
 *  //Default Value: "EGPCS";
 *  //Development Value: "GPCS";
 *  //Production Value: "GPCS";
 * 2、PHP5.4废除了register_globals,magic_quotes以及安全模式。因此这一段是专门针对PHP5.4之前版本的。
 * 3、当开启了register_globals,这就意味着EGPCS中的变量可以直接用变量名访问,
 * 这些全局变量是存储在$GLOBALS数组中的，这是个隐患，虽然5.4及之后消除了，
 * 但考虑兼容以前，需要手工清除这些全局变量。
 * 那么挑选了最重要的需要特别保护的一些变量名，也就是$_protected数组的值。
 * 凡是EGPCS中涉及到变量名称在$_protected数组中的，一律清空。
 * Security procedures
 * ------------------------------------------------------
 */

if ( ! is_php('5.4'))
{
	ini_set('magic_quotes_runtime', 0);

	if ((bool) ini_get('register_globals'))
	{
		$_protected = array(
			'_SERVER',
			'_GET',
			'_POST',
			'_FILES',
			'_REQUEST',
			'_SESSION',
			'_ENV',
			'_COOKIE',
			'GLOBALS',
			'HTTP_RAW_POST_DATA',
			'system_path',
			'application_folder',
			'view_folder',
			'_protected',
			'_registered'
		);

		$_registered = ini_get('variables_order');
		foreach (array('E' => '_ENV', 'G' => '_GET', 'P' => '_POST', 'C' => '_COOKIE', 'S' => '_SERVER') as $key => $superglobal)
		{
			if (strpos($_registered, $key) === FALSE)
			{
				continue;
			}

			foreach (array_keys($$superglobal) as $var)
			{
				if (isset($GLOBALS[$var]) && ! in_array($var, $_protected, TRUE))
				{
					$GLOBALS[$var] = NULL;
				}
			}
		}
	}
}


/*
 * ------------------------------------------------------
 * 五、自定义错误、异常和程序完成的函数
 * 知识点：
 * 1、设置错误处理：set_error_handler()。
 * 处理函数原型：function _error_handler($severity,$message,$filepath,$line)
 * 程序本身原因或手工触发trigger('A custom error has been triggered');
 * 2、设置异常处理：set_exception_handler()
 * 处理函数原型：function _exception_handler($exception).
 * 当用户抛出异常时触发throw new Exception('Exception occurred');
 * 3、千万不要被shutdown迷惑：register_shutdown_function()
 * 可以这样理解调用条件：当页面被用户强制停止时、当程序代码运行超时时、当php代码执行完成时。
 *  Define a custom error handler so we can log PHP errors
 * ------------------------------------------------------
 */
	set_error_handler('_error_handler');
	set_exception_handler('_exception_handler');
	register_shutdown_function('_shutdown_handler');
/*
 * ------------------------------------------------------
 * 六、如果index.php有硬编码的话，重新设置子类前缀
 *  Set the subclass_prefix
 * ------------------------------------------------------
 *
 * Normally the "subclass_prefix" is set in the config file.
 * The subclass prefix allows CI to know if a core class is
 * being extended via a library in the local application
 * "libraries" folder. Since CI allows config items to be
 * overridden via data set in the main index.php file,
 * before proceeding we need to know if a subclass_prefix
 * override exists. If so, we will set this value now,
 * before any classes are loaded
 * Note: Since the config file data is cached it doesn't
 * hurt to load it here.
 */
	if ( ! empty($assign_to_config['subclass_prefix']))
	{
		get_config(array('subclass_prefix' => $assign_to_config['subclass_prefix']));
	}


/*
 * ------------------------------------------------------
 * 七、加载composer（单独开篇）
 *  Should we use a Composer autoloader?
 * ------------------------------------------------------
 */
	if ($composer_autoload = config_item('composer_autoload'))
	{
		if ($composer_autoload === TRUE)
		{
			file_exists(APPPATH.'vendor/autoload.php')
				? require_once(APPPATH.'vendor/autoload.php')
				: log_message('error', '$config[\'composer_autoload\'] is set to TRUE but '.APPPATH.'vendor/autoload.php was not found.');
		}
		elseif (file_exists($composer_autoload))
		{
			require_once($composer_autoload);
		}
		else
		{
			log_message('error', 'Could not find the specified $config[\'composer_autoload\'] path: '.$composer_autoload);
		}
	}

/*
 * ------------------------------------------------------
 * 八、基准时间记录
 *  Start the timer... tick tock tick tock...
 * ------------------------------------------------------
 */
	$BM =& load_class('Benchmark', 'core');
	$BM->mark('total_execution_time_start');
	$BM->mark('loading_time:_base_classes_start');

/**
 * 九、加载核心类并实例化：这些都是核心类core里的文件
 *
 */

/*
 * ------------------------------------------------------
 *  钩子类
 *  Instantiate the hooks class
 * ------------------------------------------------------
 */
	$EXT =& load_class('Hooks', 'core');

/*
 * ------------------------------------------------------
 *  Is there a "pre_system" hook?
 * ------------------------------------------------------
 */
	$EXT->call_hook('pre_system');

/*
 * ------------------------------------------------------
 * 	配置类
 *  Instantiate the config class
 * ------------------------------------------------------
 *
 * Note: It is important that Config is loaded first as
 * most other classes depend on it either directly or by
 * depending on another class that uses it.
 *
 */
	$CFG =& load_class('Config', 'core');

	// Do we have any manually set config items in the index.php file?
	if (isset($assign_to_config) && is_array($assign_to_config))
	{
		foreach ($assign_to_config as $key => $value)
		{
			$CFG->set_item($key, $value);
		}
	}

/*
 * ------------------------------------------------------
 *
 * Important charset-related stuff
 * ------------------------------------------------------
 *
 * Configure mbstring and/or iconv if they are enabled
 * and set MB_ENABLED and ICONV_ENABLED constants, so
 * that we don't repeatedly do extension_loaded() or
 * function_exists() calls.
 *
 * Note: UTF-8 class depends on this. It used to be done
 * in it's constructor, but it's _not_ class-specific.
 *
 */
	$charset = strtoupper(config_item('charset'));
	ini_set('default_charset', $charset);

	if (extension_loaded('mbstring'))
	{
		define('MB_ENABLED', TRUE);
		// mbstring.internal_encoding is deprecated starting with PHP 5.6
		// and it's usage triggers E_DEPRECATED messages.
		@ini_set('mbstring.internal_encoding', $charset);
		// This is required for mb_convert_encoding() to strip invalid characters.
		// That's utilized by CI_Utf8, but it's also done for consistency with iconv.
		mb_substitute_character('none');
	}
	else
	{
		define('MB_ENABLED', FALSE);
	}

	// There's an ICONV_IMPL constant, but the PHP manual says that using
	// iconv's predefined constants is "strongly discouraged".
	if (extension_loaded('iconv'))
	{
		define('ICONV_ENABLED', TRUE);
		// iconv.internal_encoding is deprecated starting with PHP 5.6
		// and it's usage triggers E_DEPRECATED messages.
		@ini_set('iconv.internal_encoding', $charset);
	}
	else
	{
		define('ICONV_ENABLED', FALSE);
	}

	if (is_php('5.6'))
	{
		ini_set('php.internal_encoding', $charset);
	}

/*
 * ------------------------------------------------------
 *  Load compatibility features
 * ------------------------------------------------------
 */

	require_once(BASEPATH.'core/compat/mbstring.php');
	require_once(BASEPATH.'core/compat/hash.php');
	require_once(BASEPATH.'core/compat/password.php');
	require_once(BASEPATH.'core/compat/standard.php');

/*
 * ------------------------------------------------------
 *  Instantiate the UTF-8 class
 * ------------------------------------------------------
 */
	$UNI =& load_class('Utf8', 'core');

/*
 * ------------------------------------------------------
 *  Instantiate the URI class
 * ------------------------------------------------------
 */
	$URI =& load_class('URI', 'core');

/*
 * ------------------------------------------------------
 *  Instantiate the routing class and set the routing
 * ------------------------------------------------------
 */
	$RTR =& load_class('Router', 'core', isset($routing) ? $routing : NULL);

/*
 * ------------------------------------------------------
 *  Instantiate the output class
 * ------------------------------------------------------
 */
	$OUT =& load_class('Output', 'core');

/*
 * ------------------------------------------------------
 *	Is there a valid cache file? If so, we're done...
 *  是否有缓存
 * ------------------------------------------------------
 */
	if ($EXT->call_hook('cache_override') === FALSE && $OUT->_display_cache($CFG, $URI) === TRUE)
	{
		exit;
	}

/*
 * -----------------------------------------------------
 * Load the security class for xss and csrf support
 * -----------------------------------------------------
 */
	$SEC =& load_class('Security', 'core');

/*
 * ------------------------------------------------------
 *  Load the Input class and sanitize globals
 * ------------------------------------------------------
 */
	$IN	=& load_class('Input', 'core');

/*
 * ------------------------------------------------------
 *  Load the Language class
 * ------------------------------------------------------
 */
	$LANG =& load_class('Lang', 'core');

/*
 * ------------------------------------------------------
 * 十一、加载Controller类：
 *  实例化控制器，安全性验证、实际处理请求。
 *  Load the app controller and local controller
 * 　 能够走到这里，说明之前的缓存是没有命中的（实际上，任何页面都是应该先走到这一步，
 *   然后才会有设置缓存，之后的访问检查缓存才会命中）。
 *   这一步会require Controller基类和扩展的Controller类（如果有的话）及实际的应用程序控制器类：
 * ------------------------------------------------------
 *
 */
	// Load the base controller class
    // 引入Controller 基类
	require_once BASEPATH.'core/Controller.php';

	/**
	 * Reference to the CI_Controller method.
	 *
	 * Returns current CI instance object
	 *
	 * @return CI_Controller
	 */
	function &get_instance()
	{
		return CI_Controller::get_instance();
	}
	//引入扩展的Controller类
	if (file_exists(APPPATH.'core/'.$CFG->config['subclass_prefix'].'Controller.php'))
	{
		require_once APPPATH.'core/'.$CFG->config['subclass_prefix'].'Controller.php';
	}
	
	//---------
	// Set a mark point for benchmarking
	$BM->mark('loading_time:_base_classes_end');

/*
 * ------------------------------------------------------
 * 十二、路由判断
 * CI认为下面这几种情况认为是404，如果找不到就调用show_404()函数
 * (1)、请求的class不存在：!class_exists($class)
 * (2)、请求私有方法：！$method[0]==='_'
 * (3)、请求基类方法：method_exists('CI_Controller', $method)
 * (4)、请求的方法不存在：! in_array(strtolower($method), array_map('strtolower', get_class_methods($class)), TRUE)
 *
 * 如果你的控制器中包含一个名为 _remap()的方法，那么不管你的URI中包含什么，它总会被忽略掉。这个方法会废除掉由URI片段来决定哪个方法被调用的规则
 * 允许你重新定义调用方法的规则（方法的路由规则）。这个会有什么用处呢？其实用处有两个 ：
 * 1、改变URL，隐藏方法，比如你的应用中，原来的URL方法是：
 * http://xxx.com/mall/display_successful_message
 * 现在想改变显示的方法名为：
 * http://xxx.com/mall/successful
 * 但显示虽然是successful，但实际上是调用存在的display_successful_message
 * 方法，这就要用到_remap方法了。
 * 2 还可以借这个函数做简单的函数方法控制，比如：
 * public function _remap($method, $params = array()){
 * 			$user_type = $_SESSION['user_type'];
 * 			$access_control = $this->validate_access($user_type,$method);
 * 			if ($access_control){
 *    			$this->$method();
 * 			}
 * 			else{
 *     			$this->show_message();
 *  		}
 *
 * }
 *  Sanity checks
 *  安全监测
 * ------------------------------------------------------
 *
 *  The Router class has already validated the request,
 *  路由类已经验证了请求，留给我们3个选项：
 *  leaving us with 3 options here:
 *
 *	1) an empty class name, if we reached the default
 *	   controller, but it didn't exist;
 *	2) a query string which doesn't go through a
 *	   file_exists() check
 *	3) a regular request for a non-existing page
 *
 *  We handle all of these as a 404 error.
 *
 *  Furthermore, none of the methods in the app controller
 *  or the loader class can be called via the URI, nor can
 *  controller methods that begin with an underscore.
 */
	//是否开启404,默认不开启
	$e404 = FALSE;
	//获取类名
	$class = ucfirst($RTR->class);
	//获取方法名
	$method = $RTR->method;

	if (empty($class) OR ! file_exists(APPPATH.'controllers/'.$RTR->directory.$class.'.php'))
	{
		//如果没有找到类名 或者 该类名控制器文件找不到  开启404错误
		$e404 = TRUE;
	}
	else
	{
		//引入该类名控制器
		require_once(APPPATH.'controllers/'.$RTR->directory.$class.'.php');
		if ( ! class_exists($class, FALSE) OR $method[0] === '_' OR method_exists('CI_Controller', $method))
		{//如果该类找不到  或者  方法为私有方法_  或者 方法存在与基础控制器中  开启404错误
			$e404 = TRUE;
		}
		elseif (method_exists($class, '_remap'))
		{
			// 检查_remap。
			//_remap这个东西类似于CI的rewrite，可以将你的请求定位到其他的位置。这个方法是应该定义在你的应用程序控制器的：
			//如果有_remap方法   方法名为 _remap
			$params = array($method, array_slice($URI->rsegments, 2));
			$method = '_remap';
		}
		// WARNING: It appears that there are issues with is_callable() even in PHP 5.2!
		// Furthermore, there are bug reports and feature/change requests related to it
		// that make it unreliable to use in this context. Please, DO NOT change this
		// work-around until a better alternative is available.
		elseif ( ! in_array(strtolower($method), array_map('strtolower', get_class_methods($class)), TRUE))
		{//请求的方法不存在
			$e404 = TRUE;
		}
		
	}
	//十三、404处理
	if ($e404)
	{//如果404为TRUE
		if ( ! empty($RTR->routes['404_override']))
		{//如果在application/config/routes.php配置文件中设置了$route['404_override']，就按设置加载404页面

			if (sscanf($RTR->routes['404_override'], '%[^/]/%s', $error_class, $error_method) !== 2)
			{
				$error_method = 'index';
			}

			$error_class = ucfirst($error_class);

			if ( ! class_exists($error_class, FALSE))
			{
				if (file_exists(APPPATH.'controllers/'.$RTR->directory.$error_class.'.php'))
				{
					require_once(APPPATH.'controllers/'.$RTR->directory.$error_class.'.php');
					$e404 = ! class_exists($error_class, FALSE);
				}
				// Were we in a directory? If so, check for a global override
				elseif ( ! empty($RTR->directory) && file_exists(APPPATH.'controllers/'.$error_class.'.php'))
				{
					require_once(APPPATH.'controllers/'.$error_class.'.php');
					if (($e404 = ! class_exists($error_class, FALSE)) === FALSE)
					{
						$RTR->directory = '';
					}
				}
			}
			else
			{
				$e404 = FALSE;
			}
		}

		// Did we reset the $e404 flag? If so, set the rsegments, starting from index 1
		if ( ! $e404)
		{
			$class = $error_class;
			$method = $error_method;

			$URI->rsegments = array(
				1 => $class,
				2 => $method
			);
		}
		else
		{

			show_404($RTR->directory.$class.'/'.$method);
		}
	}

	if ($method !== '_remap')
	{
		$params = array_slice($URI->rsegments, 2);
	}

/*
 * ------------------------------------------------------
 *  Is there a "pre_controller" hook?
 * ------------------------------------------------------
 */
	$EXT->call_hook('pre_controller');

/*
 * ------------------------------------------------------
 * 十四、解析请求的类，并调用请求的方法
 *  Instantiate the requested controller
 * ------------------------------------------------------
 */
	// Mark a start point so we can benchmark the controller
	$BM->mark('controller_execution_time_( '.$class.' / '.$method.' )_start');

	$CI = new $class();

/*
 * ------------------------------------------------------
 *  Is there a "post_controller_constructor" hook?
 * ------------------------------------------------------
 */
	$EXT->call_hook('post_controller_constructor');

/*
 * ------------------------------------------------------
 * 调用请求方法
 * call_user_func_array 调用回调函数，
 * 并把一个数组参数作为回调函数的参数，call_user_func_array 函数和 call_user_func 很相似，
 * 只是 使 用了数组 的传递参数形式，让参数的结构更清晰。
 *  Call the requested method
 * ------------------------------------------------------
 */
	call_user_func_array(array(&$CI, $method), $params);

	// Mark a benchmark end point
	$BM->mark('controller_execution_time_( '.$class.' / '.$method.' )_end');

/*
 * ------------------------------------------------------
 *  Is there a "post_controller" hook?
 * ------------------------------------------------------
 */
	$EXT->call_hook('post_controller');

/*
 * ------------------------------------------------------
 *  Send the final rendered output to the browser
 * ------------------------------------------------------
 */
	if ($EXT->call_hook('display_override') === FALSE)
	{
		$OUT->_display();
	}

/*
 * ------------------------------------------------------
 *  Is there a "post_system" hook?
 * ------------------------------------------------------
 */
	$EXT->call_hook('post_system');
