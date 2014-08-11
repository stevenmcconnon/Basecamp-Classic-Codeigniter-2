<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

error_reporting(-1);
ini_set('display_errors', 'On');

class Basecamp extends CI_Controller {

	public function index()
	{
		//load in our configs
		$this->config->load('basecamp');
		
		//load in the basecamp driver
		$this->load->driver('bcdriver');		
		
		//let's start the API
		$this->bcdriver->startApi($this->config->item('basecamp_url'), $this->config->item('basecamp_authkey'));
		
		//this is how you get all projects
		//$this->bcdriver->getProjects()
		
		//this is how you would get info about a person with their ID
		//$this->bdcriver->beperson->getPerson($personId);
		
		//prints out all the projects, for example
		die(var_dump( $this->bcdriver->getProjects() ));
		
	}	
	
	
	
}
