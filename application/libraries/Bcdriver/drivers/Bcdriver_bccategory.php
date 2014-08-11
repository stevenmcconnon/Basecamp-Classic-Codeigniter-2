<?php
//done
class Bcdriver_bccategory extends CI_Driver {
	
	function getCategory($categoryId) {
		return $this->call('categories/' . $categoryId . '.xml');
	}
	
	//todo: getCategories(), createCategory(), updateCategory(), destroyCategory()
}