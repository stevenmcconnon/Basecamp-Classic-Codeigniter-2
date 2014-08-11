<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//done
class Bcdriver_bcmessage extends CI_Driver {
	//api doc: https://github.com/basecamp/basecamp-classic-api/blob/master/sections/comments.md
	//todo: getComment(), newComment(), createComment(), editComment(), updateComment(), destroyComment()

	function getPostComments($postId) {
		$comments_xml = $this->call('posts/' . $postId . '/comments.xml');
		$comments = array();
		
		foreach ($comments_xml->comment as $comment_xml) {
			$comments[] = $comment_xml;
		}
		
		return $comments;
	}
	
	function getMilestoneComments($milestoneId) {
		$comments_xml = $this->call('milestones/' . $milestoneId . '/comments.xml');
		$comments = array();
		
		foreach ($comments_xml->comment as $comment_xml) {
			$comments[] = $comment_xml;
		}
		
		return $comments;
	}
		
}