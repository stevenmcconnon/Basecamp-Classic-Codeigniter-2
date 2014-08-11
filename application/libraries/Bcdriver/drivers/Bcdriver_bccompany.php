<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//done
class Bcdriver_bccompany extends CI_Driver
{
	
	//todo: getAllCompanies(), getCompanies($projectId), getSingleCompany($companyId)
	
	function getPeople($companyId) {
		$people_xml = $this->call('companies/' . $companyId . '/people.xml');
		
		$people = array();
		
		foreach ($people_xml->person as $person_xml)
		{
			$people[] = $person_xml;
		}
		
		return people;
	}
}