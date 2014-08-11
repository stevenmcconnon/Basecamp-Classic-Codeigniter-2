<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bcdriver_bctodolistitem extends CI_Driver {


	function getItem($itemId) {
		return $this->call('todo_items/' . $itemId . '.xml');
	}
	
	
	function getToDoComments($toDoId) {
		$comments_xml = $this->call('todo_items/' . $toDoId . '/comments.xml');
		$comments = array();
		
		foreach ($comments_xml->comment as $comment_xml) {
			$comments[] = $comment_xml;
		}
		
		return $comments;
	}
	
	
	/*
	todo: these functions here:
function getList() {
		return new BasecampToDoList($this->api, $this->listId);
	}
	
	function getCreator() {
		return new BasecampPerson($this->api, $this->creatorId);
	}
	
	
	function getCompleter() {
		return new BasecampPerson($this->api, $this->completerId);
	}
	
	function getResponsibleParty() {
		if ($this->xml == null) $this->upgrade();
		if (!isset($this->xml->{'responsible-party-id'})) return null;
		switch($this->responsiblePartyType)
		{
			case 'Person':
				return new BasecampPerson($this->api, $this->responsiblePartyId);
			case 'Company':
				return new BasecampCompany($this->api, $this->responsiblePartyId);
		}
		$trace = debug_backtrace();
		trigger_error(
				'Unexpected responsible-party-type: ' . $this->responsiblePartyType .
				' in ' . $trace[0]['file'] .
				' on line ' . $trace[0]['line'],
				E_USER_NOTICE);
		return null;
	}
*/
}