<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Breadcrumb Class
 *
 * This class manages the breadcrumb object
 *
 * @package		Breadcrumb
 * @version		1.0
 * @author 		Richard Davey <info@richarddavey.com>
 * @copyright 	Copyright (c) 2011, Richard Davey
 * @link		https://github.com/richarddavey/codeigniter-breadcrumb
 */
class Breadcrumb {
	private $breadcrumbs	= array();
	private $_divider 		= '';
	private $_tag_open 		= '<ol class="breadcrumb">';
	private $_tag_close 	= '</ol>';
	public $_set_home 		= true;
	
	public function __construct($params = array())
	{
		if (count($params) > 0)
		{
			$this->initialize($params);
		}
	}

	private function initialize($params = array())
	{
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->{'_' . $key}))
				{
					$this->{'_' . $key} = $val;
				}
			}
		}
	}
		
	function append_crumb($title, $href=null, $class=null)
	{
		if (!$title) return;
		$this->breadcrumbs[] = array('title' => $title, 'href' => $href, 'class' => $class);
	}
	
	function prepend_crumb($title, $href, $class=null)
	{
		if (!$title OR !$href) return;
		array_unshift($this->breadcrumbs, array('title' => $title, 'href' => $href, 'class' => $class));
	}
	
	function output()
	{
		if ($this->breadcrumbs) {
			$output = $this->_tag_open;
			if($this->_set_home) {
				array_unshift($this->breadcrumbs, $this->_set_home);
			}
			foreach($this->breadcrumbs as $key => $crumb) {
				//if ($key) $output .= $this->_divider;
				$class = isset($crumb['class']) ? ' class="'.$crumb['class'].'"' : null;
				if(sizeof($this->breadcrumbs) == 1) {
					$output .= '<li'.$class.'><a href="' . base_url().ltrim($crumb['href'],'/') . '">' . $crumb['title'] . '</a></li>';
				} elseif(end(array_keys($this->breadcrumbs)) == $key) {
					$output .= '<li class="active">' . $crumb['title'] . '</li>';
				} else {
					$output .= '<li'.$class.'><a href="' . base_url().ltrim($crumb['href'],'/') . '">' . $crumb['title'] . '</a></li>';
				}
			}
			return $output . $this->_tag_close . PHP_EOL;
		}
		return '';
	}

}