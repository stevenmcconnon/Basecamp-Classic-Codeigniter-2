<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bcdriver_bcproject extends CI_Driver {	
	
	function getMessages($project_id) {
		$messages_xml = $this->call('projects/' . $project_id . '/posts/archive.xml');
		$messages = array();
		
		foreach ($messages_xml->post as $message_xml) {
			$messages[] = $message_xml;
		}
		
		return $messages;
	}
	
	
	function getToDoLists($project_id, $filter = "all") {
		//filter can be all, pending, or finished
		
		$lists_xml = $this->call('projects/' . $project_id . '/todo_lists.xml?filter=' . $filter);
		$lists = array();
		
		foreach ($lists_xml->{'todo-list'} as $list_xml) {
			$lists[] = $list_xml;
		}
		
		return $lists;
	}
	
	
	function getPeople($project_id) {
		$people_xml = $this->call('projects/' . $project_id . '/people.xml');
		$people = array();
		
		foreach ($people_xml->person as $person_xml) {
			$people[] = $person_xml;
		}
		
		return $people;
	}
	
	
	function getCompanies($project_id) {
		$companies_xml = $this->call('projects/' . $project_id . '/companies.xml');
		$companies = array();
		
		foreach ($companies_xml->company as $company_xml) {
			$companies[] = $company_xml;
		}
		
		return $companies;
	}
	
	
	function getCategories($project_id, $type = BasecampCategory::Any) {
		if ($type == BasecampCategory::Any) {
			$categories_xml = $this->call('projects/' . $project_id . '/categories.xml');
		} else {
			$categories_xml = $this->call('projects/' . $project_id . '/categories.xml?type=' . $type);
		}
		
		$categories = array();
		
		foreach ($categories_xml->category as $category_xml) {
			$categories[] = $category_xml;
		}
		
		return $categories;
	}
	
	
	function getTimeTrackEntries($project_id) {
		$entries_xml = $this->call('projects/' . $project_id . '/time_entries.xml');
		$entries = array();
		
		foreach ($entries_xml->{'time-entry'} as $entry_xml) {
			$entries[] = $entry_xml;
		}
		
		return $entries;
	}
	
}