<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//done
class Bcdriver_bcperson extends CI_Driver {
	//api doc: https://github.com/basecamp/basecamp-classic-api/blob/master/sections/people.md
	//todo: getAllPeople(), getProjectPeople(), getCompanyPeople()
	
	function getPerson($personId) {	
		return $this->call('people/' . $personId . '.xml');
	}
}