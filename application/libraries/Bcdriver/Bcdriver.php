<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bcdriver extends CI_Driver_Library {

    public $valid_drivers;
    public $CI;
    public $url;
	public $authkey;
	public $loggingCalls = true;

    function __construct() {
    	//this is standard basecamp code to load in the rest of the drivers
        $this->CI =& get_instance();
        $this->CI->config->load('basecamp');
        $this->valid_drivers = $this->CI->config->item('classes');       
    }
    
	//if you don't run this first, nothing will work
	function startAPI($url, $authkey) {
		$this->url = $url;
		$this->authkey = $authkey;
	}

		
	function call($path) {
		$session = curl_init();
		$username = $this->authkey;
		$password = 'X';
		$url = $this->url . $path;
		
		curl_setopt($session, CURLOPT_URL, $url);
		curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($session, CURLOPT_HTTPGET, 1);
		curl_setopt($session, CURLOPT_HEADER, false);
		curl_setopt($session, CURLOPT_HTTPHEADER, array('Accept: application/xml', 'Content-Type: application/xml'));
		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($session, CURLOPT_USERPWD, $username . ':' . $password);
		curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($session, CURLOPT_TIMEOUT, 300);
		
		$response = curl_exec($session);
		
		$httpCode = curl_getinfo($session, CURLINFO_HTTP_CODE);
		
		if ($httpCode == 404) {
			die('Basecamp object does not exist');
		}
		
		if ($response === false) {
			return null;
		} else {
			return new SimpleXMLElement($response);
		}
	}
	
	
	function getAccount() {
		return $this->call('account.xml');
	}
	
	
	function getProjectById($id) {
		return new BasecampProject($this, $id);
	}
	
	
	function getProjects() {	
		$projects_xml = $this->call('projects.xml');
		$projects = array();
		$i = 0;
		
		foreach ($projects_xml->project as $project_xml) {
			$projects[] = $project_xml;		
		}
		
		return $projects;
	}
	
	
	function getToDoListsForCurrentUser($personId) {
		$lists_xml = $this->call('todo_lists.xml?responsible_party=' . $personId . '&filter=all');
		$lists = array();
		
		foreach ($lists_xml->{'todo-list'} as $list_xml) {
			$lists[] = $list_xml;
		}
		
		return $lists;
	}
	
	
	function getToDoListsByProjectId($projectId, $filter = "all") {
		$lists_xml = $this->call('/projects/' . $projectId . '/todo_lists.xml?filter=' . $filter);
		$lists = array();
		
		foreach ($lists_xml->{'todo-list'} as $list_xml) {
			$lists[] = $list_xml;
		}
		
		return $lists;
	}
	
	
	function getAllToDoItemsInList($toDoListID) {		
		$items_xml = $this->call('todo_lists/' . $toDoListID . '/todo_items.xml');
		$items = array();
		
		foreach ($items_xml->{'todo-item'} as $item_xml) {
			$items[] = $item_xml;
		}
		
		return $items;
	}
	
	
	function getCurrentPerson() {
		return new BasecampPerson($this, $this->call('me.xml'));
	}
	
	
	function getPersonById($id) {
		return new BasecampPerson($this, $id);
	}
	
	
	function getPeople() {
		$people_xml = $this->call('people.xml');
		$people = array();
		foreach ($people_xml->person as $person_xml) {
			$people[] = $person_xml;
		}
		return $people;
	}
	
	
	function getCompanies() {
		$companies_xml = $this->call('companies.xml');
		$companies = array();
		
		foreach ($companies_xml->company as $company_xml) {
			$companies[] = $company_xml;
		}
		
		return $companies;
	}
	
	
	function getCompanyById($id) {
		return new BasecampCompany($this, $id);
	}
	
	
	function getCategoryById($id) {
		return new BasecampCategory($this, $id);
	}
    
}