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
 * Exceptions Class
 * 异常处理类
 * 使用CI框架，我们通常使用以下三个函数处理错误
 * 1、show_error('消息',[, int $status_code = 500])
 * 2、show_404('页面', [, 'log_error'])
 * 3、log_message('级别' ,'消息')，有以下三种错误信息：
 * 错误类型消息。这种是真正的错误。例如PHP错误或用户错误
 * 调试类型消息。这种是用来调试的信息。例如,你可以将这个初始化记录下来。然后用于调试
 * 信息类型消息。这是种最低优先级别的消息。它只是简单的提供了关于运行的一些消息。CI不会自动产生任何信息类型的消息，但是你可以在程序里使用它
 *
 *
 *
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Exceptions
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/libraries/exceptions.html
 */
class CI_Exceptions {

	/**
	 * Nesting level of the output buffering mechanism
	 * 嵌套的输出缓冲处理程序的级别;如果输出缓冲区不起作用,返回零
	 *
	 * @var	int
	 */
	public $ob_level;

	/**
	 * List of available error levels
	 * PHP 错误级别
	 * @var	array
	 */
	public $levels = array(
		E_ERROR			=>	'Error',//致命错误
		E_WARNING		=>	'Warning',//非致命运行错误
		E_PARSE			=>	'Parsing Error',//编译错误
		E_NOTICE		=>	'Notice',//notice错误
		E_CORE_ERROR		=>	'Core Error',//PHP启动时致命错误
		E_CORE_WARNING		=>	'Core Warning',//PHP启动时非致命错误
		E_COMPILE_ERROR		=>	'Compile Error',//致命的编译错误
		E_COMPILE_WARNING	=>	'Compile Warning',//非致命的编译错误
		E_USER_ERROR		=>	'User Error',//致命的用户生成错误
		E_USER_WARNING		=>	'User Warning',//非致命的用户生成警告
		E_USER_NOTICE		=>	'User Notice',//用户生成的通知
		E_STRICT		=>	'Runtime Notice'//Run-time通知，提高代码稳定可靠性
	);

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		$this->ob_level = ob_get_level();
		// Note: Do not log messages from this constructor.
	}

	// --------------------------------------------------------------------

	/**
	 * Exception Logger
	 *
	 * Logs PHP generated error messages
	 *
	 * @param	int	$severity	Log level
	 * @param	string	$message	Error message
	 * @param	string	$filepath	File path
	 * @param	int	$line		Line number
	 * @return	void
	 */
	public function log_exception($severity, $message, $filepath, $line)
	{
		$severity = isset($this->levels[$severity]) ? $this->levels[$severity] : $severity;
		log_message('error', 'Severity: '.$severity.' --> '.$message.' '.$filepath.' '.$line);
	}

	// --------------------------------------------------------------------

	/**
	 * 404 Error Handler
	 *
	 * @uses	CI_Exceptions::show_error()
	 *
	 * @param	string	$page		Page URI
	 * @param 	bool	$log_error	Whether to log the error
	 * @return	void
	 */
	
	public function show_404($page = '', $log_error = TRUE)
	{
		if (is_cli())
		{//如果是cli运行模式的话
			$heading = 'Not Found';
			$message = 'The controller/method pair you requested was not found.';
		}
		else
		{
			$heading = '404 Page Not Found';
			$message = 'The page you requested was not found.';
		}

		// By default we log this, but allow a dev to skip it
		//默认是记录日志的，但是允许设备可以略过
		if ($log_error)
		{
			log_message('error', $heading.': '.$page);
		}

		echo $this->show_error($heading, $message, 'error_404', 404);
		exit(4); // EXIT_UNKNOWN_FILE
	}

	// --------------------------------------------------------------------

	/**
	 * General Error Page
	 * 有意思的触发错误，如找不到控制器等
	 * Takes an error message as input (either as a string or an array)
	 * and displays it using the specified template.
	 *
	 * @param	string		$heading	Page heading
	 * @param	string|string[]	$message	Error message
	 * @param	string		$template	Template name
	 * @param 	int		$status_code	(default: 500)
	 *
	 * @return	string	Error page output
	 */
	/**
	 * 先解释一下show_php_error,show_error,和show_404之间的关系和区别。
	 * show_php_error()是代码本身的一些错误，例如变量未定义之类的，
	 * 平时我们调试的时候经常见到的一些错误，是不小心写错代码而导致的。
	 * show_error()是有意识触发的错误，不是代码写错，
	 * 而是代码不当，或者用户操作不当，比如找不到控制器，指定方法之类的，
	 * CI就show一个错误出来，当然开发者也可以调用此方法响应一个错误信息，
	 * 某种程度上类似于catch到一个exception之后的处理，然后根据exception发出不同的提示信息。
	 * show_404()是show_error()中的一种特殊情况，就是请求不存在的情况，响应一个404错误。
	 */
	public function show_error($heading, $message, $template = 'error_general', $status_code = 500)
	{
		//错误模板
		$templates_path = config_item('error_views_path');
		if (empty($templates_path))
		{
			//如果没有配置，就去视图目录下查找
			$templates_path = VIEWPATH.'errors'.DIRECTORY_SEPARATOR;
		}
		//如果是cli运行模式
		//默认是500，内部服务错误。是指由于程序代码写得不恰当而引起的，因此向浏览器回应一个内部错误。
		if (is_cli())
		{
			//message 判断是否数组
			$message = "\t".(is_array($message) ? implode("\n\t", $message) : $message);
			//模板选择
			$template = 'cli'.DIRECTORY_SEPARATOR.$template;
		}
		else
		{
			//响应一个http头
			set_status_header($status_code);
			//
			$message = '<p>'.(is_array($message) ? implode('</p><p>', $message) : $message).'</p>';

			$template = 'html'.DIRECTORY_SEPARATOR.$template;
		}
		/**
		 * 缓冲机制是有嵌套级别的
		 * 这个if判断是说发生错误的缓冲级别和Exception被加载【刚开始】的缓冲级别相差1以上
		 * 看core/Loader.php中的_ci_load() CI在加载view的时候先ob_start(),然后由output处理输出，
		 * 因此，如果是在视图文件发生错误，则就会出现缓冲级别相差1的情况，此时先把输出的内容给flush出来，然后再把错误信息输出。
		 */
		if (ob_get_level() > $this->ob_level + 1)
		{
			ob_end_flush();
		}
		//输出缓冲内容
		ob_start();
		//错误模板信息，位于应用目录下errors/下
		include($templates_path.$template.'.php');
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}

	// --------------------------------------------------------------------

	public function show_exception($exception)
	{
		$templates_path = config_item('error_views_path');
		if (empty($templates_path))
		{
			$templates_path = VIEWPATH.'errors'.DIRECTORY_SEPARATOR;
		}

		$message = $exception->getMessage();
		if (empty($message))
		{
			$message = '(null)';
		}

		if (is_cli())
		{
			$templates_path .= 'cli'.DIRECTORY_SEPARATOR;
		}
		else
		{
			set_status_header(500);
			$templates_path .= 'html'.DIRECTORY_SEPARATOR;
		}

		if (ob_get_level() > $this->ob_level + 1)
		{
			ob_end_flush();
		}

		ob_start();
		include($templates_path.'error_exception.php');
		$buffer = ob_get_contents();
		ob_end_clean();
		echo $buffer;
	}

	// --------------------------------------------------------------------

	/**
	 * Native PHP error handler
	 * php代码错误
	 * @param	int	$severity	Error level
	 * @param	string	$message	Error message
	 * @param	string	$filepath	File path
	 * @param	int	$line		Line number
	 * @return	string	Error page output
	 */
	public function show_php_error($severity, $message, $filepath, $line)
	{
		$templates_path = config_item('error_views_path');
		if (empty($templates_path))
		{
			$templates_path = VIEWPATH.'errors'.DIRECTORY_SEPARATOR;
		}

		$severity = isset($this->levels[$severity]) ? $this->levels[$severity] : $severity;

		// For safety reasons we don't show the full file path in non-CLI requests
		if ( ! is_cli())
		{
			$filepath = str_replace('\\', '/', $filepath);
			if (FALSE !== strpos($filepath, '/'))
			{
				$x = explode('/', $filepath);
				$filepath = $x[count($x)-2].'/'.end($x);
			}

			$template = 'html'.DIRECTORY_SEPARATOR.'error_php';
		}
		else
		{
			$template = 'cli'.DIRECTORY_SEPARATOR.'error_php';
		}
		//如果还没看过core/Loader.php，下面这个判断可能让人有点迷惑。
		//ob_get_level()是取得当前缓冲机制的嵌套级别。（缓冲是可以一层嵌一层的。）
		//右边的$this->ob_level是在__construct()里面同样通过ob_get_level()被赋值的。
		//也就是说，有可能出现：Exception组件被加载时（也就是应用刚开始运行时）的缓冲级别
		//（其实也就是程序最开始的时候的缓冲级别，那时候是还没有ob_start()过的），
		//与发生错误的时候的缓冲级别相差1。
		//在控制器执行$this->load->view("xxx");的时候，实质，Loader引入并执行这个视图文件的时候，
		//是先把缓冲打开，即先ob_start()，所有输出放到缓冲区（详见：core/Loader.php中的_ci_load()）,
		//然后再由Output处理输出。因此，如果是在视图文件发生错误，则就会出现缓冲级别相差1的情况，
		//此时先把输出的内容给flush出来，然后再把错误信息输出。  
		if (ob_get_level() > $this->ob_level + 1)
		{
			ob_end_flush();
		}
		ob_start();
		include($templates_path.$template.'.php');
		$buffer = ob_get_contents();
		ob_end_clean();
		echo $buffer;
	}

}
