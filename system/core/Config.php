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
 * Config Class
 *	Config类作为配置管理类,有以下几个主要功能：
 * 	1、加载配置文件
 *  2、获取配置项值
 * 	3、设置配置项（临时）
 * 	4、url处理，不明白为什么放在这里
 *
 *  CI默认有一个主要的配置文件application/config/config.php。所有配置项都放在$config数组中。
 *  可以往这个文件中添加自己的配置项,也可以创建自己的自定义配置文件并保存在配置目录下,但必须保证配置文件数组名都叫$config。
 *  如：$config['auth_key']="1jcsxdl_ms";
 *
 * 	配置目录下其他配置信息,如routes.php,memcache.php,database.php并不能由Config.php类管理。他们都是在需要的地方手工写一串代码加载，如
 * 	if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/routes.php'))
 *	{
 *		include(APPPATH.'config/'.ENVIRONMENT.'/routes.php');
 *	}
 *  一、加载配置文件。有两种方式：
 * 	1、手工方式：$this->config->load('filename');
 * 	(1)、参数$file配置文件的名称,无需.php扩展名。当没有参数时，默认加载文件为config.php
 * 	代码是这样实现的：$file=($file==='')?'config':str_replace('.php',$file);
 * 	(2)、参数$use_sections将第二个参数设置为TRUE,这样每个配置文件中的配置会被存储到以该配置文件名为索引的数组中去,如：
 *  $this->config->load('blog_setting',TRUE);//$this->config['blog_setting']=$config;
 *  取的时候就要这样取了$site_name=$this->config->item('site_name','blog_setting');
 *  if($uses_sections===TRUE)
 *  {
 *		$this->config[$file]=isset($this->config[$file])?array_merge($this->config[$file],$config):$config;
 *  }
 *  可以从源码中看出使用了$file名作主键$this->config[$file]=..$config;
 *
 * 	(3)、参数$fail_gracefully用于抑制错误，当配置文件不存在时，不会报错。
 * 	 否则，将有两种可能触发错误函数show_error
 * 	 一种是加载到的配置文件里没有叫$config的数组
 * 	 if(!isset($config) OR !is_array($config))
 * 	 {
		if($gracefully===TRUE)
 * 		{
			return FALSE;
 * 		}
 *   }
 *   一种是到最后,没有加载到任何文件
 * 	 show_error("The configuration file".$file.".php does not exists");
 *  (4)、代码中 $this->is_loaded是一个数组,用当前上下文加载过的文件路径做数组元素。load文件过程中如果路径存在,则说明已经加载该配置文件,
 *   就不重复加载了。
 *
 *
 * This class contains functions that enable config files to be managed
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Config {

	/**
	 * List of all loaded config values
	 * //Config类所有配置项都储存在$config的数组中，item()方法取值也是从这里取
	 * @var	array
	 */
	public $config = array();

	/**
	 * List of all loaded config files
	 * //is_loaded也是个数组,用当前上下文加载过的文件路径做数组元素。load文件过程中如果路径存在，则说明已加载该配置文件，就不重复加载了。
	 *
	 * @var	array
	 */
	public $is_loaded =	array();

	/**
	 * List of paths to search when trying to load a config file.
	 * //默认array(APPPATH)。默认文件存放路径.程序循环加载。
	 * @used-by	CI_Loader
	 * @var		array
	 */
	public $_config_paths =	array(APPPATH);

	// --------------------------------------------------------------------

	/**
	 * Class constructor
	 * 构造函数
	 * 1、构造函数首先利用common.php中的的公共函数get_config()将配置项加载至类属性$this->config数组。
	 * 2、第二步设置正确的base_url,并将它放置到$this->config数组中供调用。
	 * config.php中有一项$config['base_url']='http://www.example.com/';
	 * 如果该值不存在，系统就会通过$_SERVER['SERVER_ADDR']和$_SERVER['SCRIPT_NAME']来构造正确的$config['base_url']
	 * Sets the $config data from the primary config.php file as a class variable.
	 *
	 * @return	void
	 */
	public function __construct()
	{
		$this->config =& get_config();

		// Set the base_url automatically if none was provided
		if (empty($this->config['base_url']))
		{
			if (isset($_SERVER['SERVER_ADDR']))
			{
				if (strpos($_SERVER['SERVER_ADDR'], ':') !== FALSE)
				{
					$server_addr = '['.$_SERVER['SERVER_ADDR'].']';
				}
				else
				{
					$server_addr = $_SERVER['SERVER_ADDR'];
				}

				$base_url = (is_https() ? 'https' : 'http').'://'.$server_addr
					.substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], basename($_SERVER['SCRIPT_FILENAME'])));
			}
			else
			{
				$base_url = 'http://localhost/';
			}

			$this->set_item('base_url', $base_url);
		}

		log_message('info', 'Config Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Load Config File
	 * //加载配置文件
	 * @param	string	$file			Configuration file name
	 * @param	bool	$use_sections		Whether configuration values should be loaded into their own section
	 * @param	bool	$fail_gracefully	Whether to just return FALSE or display an error message
	 * @return	bool	TRUE if the file was loaded correctly or FALSE on failure
	 */
	public function load($file = '', $use_sections = FALSE, $fail_gracefully = FALSE)
	{
		//当没有参数时,默认加载文件为config.php
		//删除文件名中的".php"部分
		$file = ($file === '') ? 'config' : str_replace('.php', '', $file);
		$loaded = FALSE;

		//这一层循环是设置存放路径,其定义在public $_config_path=array(APPPATH);
		foreach ($this->_config_paths as $path)
		{
			//这层循环用于设置当前文件和环境ENVIRONMENT下的文件两重路径
			foreach (array($file, ENVIRONMENT.DIRECTORY_SEPARATOR.$file) as $location)
			{
				//组合成文件路径
				$file_path = $path.'config/'.$location.'.php';
				//判断$this->is_loaded，如果加载过，直接返回TRUE
				if (in_array($file_path, $this->is_loaded, TRUE))
				{
					return TRUE;
				}
				//如果文件不存在，跳入下一个循环
				if ( ! file_exists($file_path))
				{
					continue;
				}
				//如果文件存在，则会执行到这里，加载进来
				include($file_path);
				//如果文件中没有定义$config数组，则产生报错，根据$fail_gracefully来判断是否做出错提示
				if ( ! isset($config) OR ! is_array($config))
				{
					if ($fail_gracefully === TRUE)
					{
						return FALSE;
					}

					show_error('Your '.$file_path.' file does not appear to contain a valid configuration array.');
				}
				//正常加载到定义的$config数组后
				if ($use_sections === TRUE)
				{
					$this->config[$file] = isset($this->config[$file])
						? array_merge($this->config[$file], $config)
						: $config;
				}
				else
				{
					$this->config = array_merge($this->config, $config);
				}
				//将配置文件路径放入$this->is_loaded数组，表明已经加载。
				$this->is_loaded[] = $file_path;
				$config = NULL;
				$loaded = TRUE;
				log_message('debug', 'Config file loaded: '.$file_path);
			}
		}
		//如果循环完都找不到文件，则$loaded为FALSE,找到了则为TRUE
		if ($loaded === TRUE)
		{
			return TRUE;
		}
		elseif ($fail_gracefully === TRUE)
		{
			return FALSE;
		}

		show_error('The configuration file '.$file.'.php does not exist.');
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch a config file item
	 * //获取配置项
	 * @param	string	$item	Config item name
	 * @param	string	$index	Index name
	 * @return	string|null	The configuration item or NULL if the item doesn't exist
	 *
	 * 假如在load时设置了第二个参数
	 * $this->config->load('weixin_auth',TRUE);
	 * 要获取weixin_auth.php中的配置项"token_key"怎么办？
	 * 可以$token_key=$this->config->item("token_key","weixin_auth"),
	 * 也可以$weixin_auth_config=$this->config->item("weixin_auth");
	 * $token_key=$weixin_auth_config['token_key'];
	 *
	 */
	public function item($item, $index = '')
	{
		if ($index == '')
		{
			return isset($this->config[$item]) ? $this->config[$item] : NULL;
		}

		return isset($this->config[$index], $this->config[$index][$item]) ? $this->config[$index][$item] : NULL;
	}

	// --------------------------------------------------------------------

	/**
	 * Fetch a config file item with slash appended (if not empty)
	 *	获取配置项，并在后面加"/"
	 * @param	string		$item	Config item name
	 * @return	string|null	The configuration item or NULL if the item doesn't exist
	 */
	public function slash_item($item)
	{
		if ( ! isset($this->config[$item]))
		{
			return NULL;
		}
		elseif (trim($this->config[$item]) === '')
		{
			return '';
		}

		return rtrim($this->config[$item], '/').'/';
	}

	// --------------------------------------------------------------------

	/**
	 * Site URL
	 *
	 * Returns base_url . index_page [. uri_string]
	 *
	 * @uses	CI_Config::_uri_string()
	 *
	 * @param	string|string[]	$uri	URI string or an array of segments
	 * @param	string	$protocol
	 * @return	string
	 */
	public function site_url($uri = '', $protocol = NULL)
	{
		$base_url = $this->slash_item('base_url');

		if (isset($protocol))
		{
			// For protocol-relative links
			if ($protocol === '')
			{	
				$base_url = substr($base_url, strpos($base_url, '//'));
			}
			else
			{
				$base_url = $protocol.substr($base_url, strpos($base_url, '://'));
			}
		}

		if (empty($uri))
		{
			return $base_url.$this->item('index_page');
		}

		$uri = $this->_uri_string($uri);

		if ($this->item('enable_query_strings') === FALSE)
		{
			$suffix = isset($this->config['url_suffix']) ? $this->config['url_suffix'] : '';

			if ($suffix !== '')
			{
				if (($offset = strpos($uri, '?')) !== FALSE)
				{
					$uri = substr($uri, 0, $offset).$suffix.substr($uri, $offset);
				}
				else
				{
					$uri .= $suffix;
				}
			}

			return $base_url.$this->slash_item('index_page').$uri;
		}
		elseif (strpos($uri, '?') === FALSE)
		{
			$uri = '?'.$uri;
		}

		return $base_url.$this->item('index_page').$uri;
	}

	// -------------------------------------------------------------

	/**
	 * Base URL
	 *
	 * Returns base_url [. uri_string]
	 *
	 * @uses	CI_Config::_uri_string()
	 *
	 * @param	string|string[]	$uri	URI string or an array of segments
	 * @param	string	$protocol
	 * @return	string
	 */
	public function base_url($uri = '', $protocol = NULL)
	{
		$base_url = $this->slash_item('base_url');

		if (isset($protocol))
		{
			// For protocol-relative links
			if ($protocol === '')
			{
				$base_url = substr($base_url, strpos($base_url, '//'));
			}
			else
			{
				$base_url = $protocol.substr($base_url, strpos($base_url, '://'));
			}
		}

		return $base_url.ltrim($this->_uri_string($uri), '/');
	}

	// -------------------------------------------------------------

	/**
	 * Build URI string
	 *
	 * @used-by	CI_Config::site_url()
	 * @used-by	CI_Config::base_url()
	 *
	 * @param	string|string[]	$uri	URI string or an array of segments
	 * @return	string
	 */
	protected function _uri_string($uri)
	{
		if ($this->item('enable_query_strings') === FALSE)
		{
			if (is_array($uri))
			{
				$uri = implode('/', $uri);
			}
			return trim($uri, '/');
		}
		elseif (is_array($uri))
		{
			return http_build_query($uri);
		}

		return $uri;
	}

	// --------------------------------------------------------------------

	/**
	 * System URL
	 *
	 * @deprecated	3.0.0	Encourages insecure practices
	 * @return	string
	 */
	public function system_url()
	{
		$x = explode('/', preg_replace('|/*(.+?)/*$|', '\\1', BASEPATH));
		return $this->slash_item('base_url').end($x).'/';
	}

	// --------------------------------------------------------------------

	/**
	 * Set a config file item
	 * 设置配置项
	 * 这个是临时的,就是通过函数访问并写入$this->config数组
	 * @param	string	$item	Config item key
	 * @param	string	$value	Config item value
	 * @return	void
	 */
	public function set_item($item, $value)
	{
		$this->config[$item] = $value;
	}

}
