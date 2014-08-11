<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bcdriver_bctodolist extends CI_Driver {

	function getList($listId) {
		return $this->call('todo_lists/' . $listId . '.xml');	
	}
	
	
	function getItems($listId) {
		$items_xml = $this->call('todo_lists/' . $listId . '/todo_items.xml');
		
		$items = array();
		
		foreach ($items_xml->{'todo-item'} as $item_xml) {
			$items[] = $item_xml;
		}
		
		return $items;
	}
	
	//lots of todos here, check the doc: https://github.com/basecamp/basecamp-classic-api/blob/master/sections/todo_list_items.md
	
	/*these are also todo:
function getProject()
	{
		return new BasecampProject($this->api, $this->projectId);
	}
	
	function getMilestone()
	{
		return new BasecampMilestone($this->api, $this->milestoneId);
	}
*/
	
}