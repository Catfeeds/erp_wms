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
 * Router Class
 *
 * Parses URIs and determines routing
 * CI框架Router路由类将URI映射到对应的控制器及方法，Router类大量代码处理的是自定义路由，该类要支撑以下几个功能点：
 * ① 自定义路由规则
 * 在 application/config/routes.php 文件中的 $route 的数组，利用它可以设置路由规则。
 * 在路由规则中可以使用通配符或正则表达式。
 * 使用通配符:$route['product/:num'] = 'catalog/product_lookup';
 * 使用正则:$route['products/([a-z]+)/(\d+)'] = '$1/id_$2';匹配只含有数字的一段。
 * (:any) 匹配含有任意字符的一段。（除了 '/' 字符，因为它是段与段之间的分隔符）。
 * 通配符实际上是正则表达式的别名，:any 会被转换为 [^/]+ ， :num 会被转换为 [0-9]+ 。
 * $key = str_replace(array(':any', ':num'), array('[^/]+', '[0-9]+'), $key);
 *
 * ② 支持回调函数
 * 在路由规则中使用回调函数来处理逆向引用。 例如:
 * $route['products/([a-zA-Z]+)/edit/(\d+)'] = function ($product_type, $id)
 *												{
 *													return 'catalog/product_edit/' . strtolower($product_type) . '/' . $id;
 *												};
 * ③ 支持使用HTTP动词
 * 在路由数组后面再加一个键，键名为 HTTP 动词。可以使用标准的 HTTP 动词（GET、PUT、POST、DELETE、PATCH），也可以使用自定义的动词 （例如：PURGE），不区分大小写。例如：
 * //发送 PUT 请求到 "products" 这个 URI 时，将会调用 Product::insert() 方法
 *
 * $route['products']['put'] = 'product/insert';
 *
 *	//发送 DELETE 请求到第一段为 "products" ，第二段为数字这个 URL时，将会调用 Product::delete() 方法，并将数字作为第一个参数。
 *	$route['products/(:num)']['DELETE'] = 'product/delete/$1';
 *
 * CI在CodeIgniter.php中实例化路由时，就完成了解析，得到请求的控制器名及方法名了。
 * $RTR =& load_class("Router', 'core', isset($routing) ? $routing : NULL);所以核心入口是__construct()。
 *
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/routing.html
 */
class CI_Router {

	/**
	 * CI_Config class object
	 * CI配置类对象
	 * @var	object
	 */
	public $config;

	/**
	 * List of routes
	 * 路由列表
	 * @var	array
	 */
	public $routes =	array();

	/**
	 * Current class name
	 * 当前请求的类名
	 * @var	string
	 */
	public $class =		'';

	/**
	 * Current method name
	 * 当前请求的方法名 ,默认为为index方法
	 * @var	string
	 */
	public $method =	'index';

	/**
	 * Sub-directory that contains the requested controller class
	 *
	 * @var	string
	 */
	public $directory;

	/**
	 * Default controller (and method if specific)
	 * 默认控制器
	 * @var	string
	 */
	public $default_controller;

	/**
	 * Translate URI dashes
	 *
	 * Determines whether dashes in controller & method segments
	 * should be automatically replaced by underscores.
	 *
	 * @var	bool
	 */
	public $translate_uri_dashes = FALSE;

	/**
	 * Enable query strings flag
	 *
	 * Determines whether to use GET parameters or segment URIs
	 *
	 * @var	bool
	 */
	public $enable_query_strings = FALSE;

	// --------------------------------------------------------------------

	/**
	 * Class constructor
	 *
	 * Runs the route mapping function.
	 *
	 * @param	array	$routing
	 * @return	void
	 */
	public function __construct($routing = NULL)
	{
		//加载类内部的类
		$this->config =& load_class('Config', 'core');
		$this->uri =& load_class('URI', 'core');

		//确认是否开启querystirng模式，如果这个模式开启,那就用index.php?c=mall&a=list这样去访问控制器和方法了
		$this->enable_query_strings = ( ! is_cli() && $this->config->item('enable_query_strings') === TRUE);

		// If a directory override is configured, it has to be set before any dynamic routing logic
		//如果在index.php里指定控制器目录，那么在动态路由之前都将这个设置作为控制器的目录
		//通俗的说就是路由器在找控制器和方法时，会在“contrlloer/设置的目录/”下找
		//而且这个设置会覆盖URI(三段)的目录
		is_array($routing) && isset($routing['directory']) && $this->set_directory($routing['directory']);

		//核心：解析URI到$this->directory、$this->class、$this->method
		$this->_set_routing();

		// Set any routing overrides that may exist in the main index file
		//如果在index.php中设置了控制器和方法，则覆盖
		//比如服务器维护时，设置一个方法用来显示“维护中”的静态页面，就可以让任何URI的请求都进入到该个方法中显示静态页面
		//我在想：应该把上面的$this->_set_routing();放到这个else块中就完美了
		if (is_array($routing))
		{
			empty($routing['controller']) OR $this->set_class($routing['controller']);
			empty($routing['function'])   OR $this->set_method($routing['function']);
		}

		log_message('info', 'Router Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Set route mapping
	 * 核心解析函数
	 * Determines what should be served based on the URI request,
	 * as well as any "routes" that have been set in the routing config file.
	 *
	 * @return	void
	 */
	protected function _set_routing()
	{
		// Load the routes.php file. It would be great if we could
		// skip this for enable_query_strings = TRUE, but then
		// default_controller would be empty ...
		//加载路由配置文件routes.php
		if (file_exists(APPPATH.'config/routes.php'))
		{
			include(APPPATH.'config/routes.php');
		}

		//如果有环境对应的配置文件，则加载并覆盖原配置文件routes.php
		if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/routes.php'))
		{
			include(APPPATH.'config/'.ENVIRONMENT.'/routes.php');
		}

		// Validate & get reserved routes
		//读取默认控制器设置$route['default_controller']
		//读取$route['translate_uri_dashes']。如果设置为TRUE，则可将URI中的破折号-转换成类名的下划线_
		//如my-controller/index    -> my_controller/index
		//读取所有自定义路由策略赋值给$this->routes
		if (isset($route) && is_array($route))
		{
			isset($route['default_controller']) && $this->default_controller = $route['default_controller'];
			isset($route['translate_uri_dashes']) && $this->translate_uri_dashes = $route['translate_uri_dashes'];
			unset($route['default_controller'], $route['translate_uri_dashes']);
			$this->routes = $route;
		}

		// Are query strings enabled in the config file? Normally CI doesn't utilize query strings
		// since URI segments are more search-engine friendly, but they can optionally be used.
		// If this feature is enabled, we will gather the directory/class/method a little differently
		//在querystring模式下获取directory/class/method
		//index.php?d=admin&c=mall&m=list
		//$config['controller_trigger'] = 'c';//控制器变量
		//$config['function_trigger'] = 'm';//方法变量
		//$config['directory_trigger'] = 'd';//目录变量
		if ($this->enable_query_strings)
		{
			// If the directory is set at this time, it means an override exists, so skip the checks
			//获取$this->directory。配置文件中的'directory_trigger'代表在$_GET中用什么变量名作为传递directory的键值
        	//同样的还有设置控制器的传递参数键名controller_trigger，方法的传递参数键名function_trigger
			if ( ! isset($this->directory))
			{
				$_d = $this->config->item('directory_trigger');
				$_d = isset($_GET[$_d]) ? trim($_GET[$_d], " \t\n\r\0\x0B/") : '';

				if ($_d !== '')
				{
					//filter_uri是验证uri的组成字符是否在白名单(配置文件中permitted_uri_chars设置)中
					$this->uri->filter_uri($_d);
					$this->set_directory($_d);
				}
			}

			$_c = trim($this->config->item('controller_trigger'));
			//获取控制器和方法,并设置$this->uri->rsegments
			if ( ! empty($_GET[$_c]))
			{
				$this->uri->filter_uri($_GET[$_c]);
				$this->set_class($_GET[$_c]);

				$_f = trim($this->config->item('function_trigger'));
				if ( ! empty($_GET[$_f]))
				{
					$this->uri->filter_uri($_GET[$_f]);
					$this->set_method($_GET[$_f]);
				}

				$this->uri->rsegments = array(
					1 => $this->class,
					2 => $this->method
				);
			}
			else
			{
				//方法没有可以允许，如果控制器都没有，就调用默认控制器和方法代替了
				$this->_set_default_controller();
			}

			// Routing rules don't apply to query strings and we don't need to detect
			// directories, so we're done here
			return;
		}

		// Is there anything to parse?
		// 非querystring模式的程序可以走到这里
		if ($this->uri->uri_string !== '')
		{
			//解析自定义路由规则，并调用_set_request函数设置目录、控制器、方法
			$this->_parse_routes();
		}
		else
		{
			//uri_string为空，一般情况下就是域名后面没有任何字符，调用默认控制器
			$this->_set_default_controller();
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Set request route
	 *
	 * Takes an array of URI segments as input and sets the class/method
	 * to be called.
	 *
	 * @used-by	CI_Router::_parse_routes()
	 * @param	array	$segments	URI segments
	 * @return	void
	 */
	/**
	 * 看，这里有调用Router::_validate_request();而Router::_validate_request()的作用是检测寻找出一个
	 * 正确存在的路由，并确定它，确定后的值分别放到Rouer::$class这些属性里面。所以使到这个_set_request()也有
	 * 这种确定路由的功能。
	 *
	 * 注：
	 * $segments=$this->_validate_request($segments); 等式右边，括号里面的这个$segments，也就是调用
	 * _set_request()时传入来的这个参数，它有这样的特点：
	 * 1）如果这时_set_request()是在Router::_set_default_controller()中调用的话，那个这个$segments是永远不会为
	 *  空数组，嗯，绝对不会。
	 *
	 * 而左边这个$segments的值，经过下面这行代码后，要么为空数组array(),要么为确定路由后的段数组。
	 * 为空数组的原因是，$this->_validate_request();里面没有找到当前目录的默认控制器。此时，右边的
	 * $segments要么为空，要么只指定了目录但默认控制器不存在。
	 */
	protected function _set_request($segments = array())
	{
		//从$segments中提取Directory信息，设置$this->directory
		$segments = $this->_validate_request($segments);
		// If we don't have any segments left - try the default controller;
		// WARNING: Directories get shifted out of the segments array!
		//如果$segments在目录被提取走后，没有剩下任何东西，那么就用默认路由
		if (empty($segments))
		{
			//所以如果上面返回了空数组，就会进到这里。
			//这里居然又调回了_set_default_controller()! 坑爹吧！
			$this->_set_default_controller();
			return;
			/**
			 * 我曾经想过，下面这里会不会死循环：
			 * 假如，我在配置文件里面的默认控制器设为welcome，然后controllers/下没有welcome.php,但controllers/下有
			 * welcome/有这个目录（里面没东西），然后通过http://localhost/CI/来访问默认控制器，那会怎样呢？
			 * 首先，它会进入_set_routing();然后发现$this->uri->uri_string为空，进入_set_default_controller();
			 * 然后发现在_set_default_controller里，发现$this->default_controller不为FALSE，（＠＠＠＠），然后再
			 * 进入这_set_request()里面，再进入_validate_request()里面，会不会_validate_request里返回空数组？因为
			 * 指定了目录，没有指定控制器，访问默认的，又不存在，然后返回空数组，返回空数组后，最终就会走来你正在看的这个位置，
			 * 然后这个位置再调用_set_default_controller();然后死循环了。。。
			 *
			 * 答案是不会的。
			 * 原因在于：
			 * 我们回到上面解译那个（＠＠＠＠）的地方，在这里，发现$this->default_controller不为FALSE后，它会进入这个else
			 * 里面
			 * else
			 * {
			 *  $this->set_class($this->default_controller);   ..............1
			 *  $this->set_method('index');                 ...................2
			 *  $this->_set_request(array($this->default_controller, 'index'));  ..........3
			 * }
			 *
			 * 然后第3行，传入_set_request($segments)中的那个$segments其实是
			 * array('welcome','index')，重点在于那个小小的'index'!!!!!!!
			 * 这样一来，我们进入_validate_request()的时候，我们实质并没有“指定目录但没有指定控制器，访问默认控制器”，
			 * 而是“指定了一个welcome的目录，和一个叫index的控制器！！”，所以才不会死循环。
			 * 如果你试着把第3行那个'index'去掉，那么，一定会死循环！！！！！！！！不信试试！CI太牛逼了，居然这样做。汗。。
			 * 当然，‘index’还有一个作用，就是设置默认方法啦。
			 */
		}
		//如果允许路径中破折号存在，也就是路径中破折号'-'映到至类名的下划线 '_'
		if ($this->translate_uri_dashes === TRUE)
		{
			$segments[0] = str_replace('-', '_', $segments[0]);
			if (isset($segments[1]))
			{
				$segments[1] = str_replace('-', '_', $segments[1]);
			}
		}
		//设置控制器类
		$this->set_class($segments[0]);
		if (isset($segments[1]))
		{
			//设置控制器类方法
			$this->set_method($segments[1]);
		}
		else
		{
			//如果不存在方法片段，则默认方法名为index
			$segments[1] = 'index';
		}

		//这里要说一下，现在是在ROUTER里面为URI赋值，URI里面的这个URI::$rsegments是经过处理，并确定路由后，实质调用的路由的段信息。
		//而URI::$segments （前面少了个r），则是原来没处理前的那个，即直接由网址上面得出来的那个。
		//将整个数组元素往后推一格，保持和没有shift掉目录时的数组原素存放序列一致，
		//如array ( 0 => 'news', 1 => 'view', 2 => 'crm', )经过这两行后变成array ( 1 => 'news', 2 => 'view', 3 => 'crm', )
		//不过要是多级目录的话，这样推有什么用呢？
		array_unshift($segments, NULL);
		unset($segments[0]);
		$this->uri->rsegments = $segments;
	}

	// --------------------------------------------------------------------

	/**
	 * Set default controller
	 * 设置默认控制器
	 * @return	void
	 */
	protected function _set_default_controller()
	{
		//在Router::_set_routing()函数里面有一个操作，是从配置文件里面读取默认控制器名

		if (empty($this->default_controller))
		{
			//如果没有默认的话，就报错，结束程序。
			//实质上，这个_set_default_controller()仅仅是在uri没有指定控制器，要求访问默认控制器的时候才
			//被调用，所以如果连默认控制器都没有，那么可以果断报错。
			show_error('Unable to determine what should be displayed. A default route has not been specified in the routing file.');
		}

		// Is the method being specified?
		//如果有，下面我们就来把默认的控制器设置为当前要找的路由。
		//这里只是分“有指定默认方法”和“没有指定”两种情况而已。不过要弄点下面那个$this->_set_request($x);
		//CI这几个函数也许写得很妙，但是让人看得纠结。
		if (sscanf($this->default_controller, '%[^/]/%s', $class, $method) !== 2)
		{
			$method = 'index';
		}

		if ( ! file_exists(APPPATH.'controllers/'.$this->directory.ucfirst($class).'.php'))
		{
			// This will trigger 404 later
			return;
		}

		$this->set_class($class);
		$this->set_method($method);

		// Assign routed segments, index starting from 1
		$this->uri->rsegments = array(
			1 => $class,
			2 => $method
		);

		log_message('debug', 'No URI present. Default controller set.');
	}

	// --------------------------------------------------------------------

	/**
	 * Validate request
	 *
	 * Attempts validate the URI request and determine the controller path.
	 *
	 * @used-by	CI_Router::_set_request()
	 * @param	array	$segments	URI segments
	 * @return	mixed	URI segments
	 */
	protected function _validate_request($segments)
	{
		//支持多级目录
		$c = count($segments);
		$directory_override = isset($this->directory);

		// Loop through our segments and return as soon as a controller
		// is found or when such a directory doesn't exist
		while ($c-- > 0)
		{
			$test = $this->directory
				.ucfirst($this->translate_uri_dashes === TRUE ? str_replace('-', '_', $segments[0]) : $segments[0]);
			//如果直接在controllers这个目录下找到与第一段相应的控制器名，那就说明找到了控制器，确定路由，返回。
			if ( ! file_exists(APPPATH.'controllers/'.$test.'.php')
				&& $directory_override === FALSE
				&& is_dir(APPPATH.'controllers/'.$this->directory.$segments[0])
			)
			{
				//如果的确是目录，那么就可以确定路由的目录部分了。
				$this->set_directory(array_shift($segments), TRUE);
				continue;
			}
			//如果上面没有找到，再看看这个“第一段”是不是一个目录，因为CI是允许控制器放在自定义的目录下的。
			return $segments;
		}

		// This means that all segments were actually directories
		return $segments;
	}

	// --------------------------------------------------------------------

	/**
	 * Parse Routes
	 *
	 * Matches any routes that may exist in the config/routes.php file
	 * against the URI to determine if the class/method need to be remapped.
	 *
	 * @return	void
	 */
	protected function _parse_routes()
	{
		//知道_set_request()是干嘛的之后，下面的条理就比较清晰了。
		// Turn the segment array into a URI string
		$uri = implode('/', $this->uri->segments);

		// Get HTTP verb
		$http_verb = isset($_SERVER['REQUEST_METHOD']) ? strtolower($_SERVER['REQUEST_METHOD']) : 'cli';
		//CI有路由重定向的功能，重定向的规则和实现就是在这里。
		// Loop through the route array looking for wildcards
		foreach ($this->routes as $key => $val)
		{
			// Check if route format is using HTTP verbs
			if (is_array($val))
			{
				$val = array_change_key_case($val, CASE_LOWER);
				if (isset($val[$http_verb]))
				{
					$val = $val[$http_verb];
				}
				else
				{
					continue;
				}
			}

			// Convert wildcards to RegEx
			//将通配符表达式
			$key = str_replace(array(':any', ':num'), array('[^/]+', '[0-9]+'), $key);

			// Does the RegEx match?
			//利用回调过程反向引用
			if (preg_match('#^'.$key.'$#', $uri, $matches))
			{
				// Are we using callbacks to process back-references?
				if ( ! is_string($val) && is_callable($val))
				{
					// Remove the original string from the matches array.
					array_shift($matches);

					// Execute the callback using the values in matches as its parameters.
					$val = call_user_func_array($val, $matches);
				}
				// Are we using the default routing method for back-references?
				elseif (strpos($val, '$') !== FALSE && strpos($key, '(') !== FALSE)
				{
					$val = preg_replace('#^'.$key.'$#', $val, $uri);
				}

				$this->_set_request(explode('/', $val));
				return;
			}
		}

		// If we got this far it means we didn't encounter a
		// matching route so we'll set the site default route
		$this->_set_request(array_values($this->uri->segments));
	}

	// --------------------------------------------------------------------

	/**
	 * Set class name
	 *
	 * @param	string	$class	Class name
	 * @return	void
	 */
	public function set_class($class)
	{
		$this->class = str_replace(array('/', '.'), '', $class);
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch the current class
	 *
	 * @deprecated	3.0.0	Read the 'class' property instead
	 * @return	string
	 */
	public function fetch_class()
	{
		return $this->class;
	}

	// --------------------------------------------------------------------

	/**
	 * Set method name
	 *
	 * @param	string	$method	Method name
	 * @return	void
	 */
	public function set_method($method)
	{
		$this->method = $method;
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch the current method
	 *
	 * @deprecated	3.0.0	Read the 'method' property instead
	 * @return	string
	 */
	public function fetch_method()
	{
		return $this->method;
	}

	// --------------------------------------------------------------------

	/**
	 * Set directory name
	 *
	 * @param	string	$dir	Directory name
	 * @param	bool	$append	Whether we're appending rather than setting the full value 我们是否追加，而不是设置完整的值
	 * @return	void
	 */
	public function set_directory($dir, $append = FALSE)
	{
		if ($append !== TRUE OR empty($this->directory))
		{
			$this->directory = str_replace('.', '', trim($dir, '/')).'/';
		}
		else
		{
			$this->directory .= str_replace('.', '', trim($dir, '/')).'/';
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch directory
	 *
	 * Feches the sub-directory (if any) that contains the requested
	 * controller class.
	 *
	 * @deprecated	3.0.0	Read the 'directory' property instead
	 * @return	string
	 */
	public function fetch_directory()
	{
		return $this->directory;
	}

}
