
<?php
	// This file is the place to store all basic functions

	//function to decryption
function decrypt($string)
{
	$newstring = "";
	for ($i=0;$i<strlen($string);$i++)
	{
		  $ascii = ord($string[$i]);
				if($ascii >= 65 && $ascii <= 90) { //uppercase bound
				  $newstring .= chr(($ascii - 15 -65 + 26) % 26 + 65); //reset back to 'A' 
				} 
				else if($ascii >= 97 && $ascii <= 122) { //lowercase bound
				  $newstring .= chr(($ascii - 15 -97 + 26) % 26 + 97); //reset back to 'a'
				}
			 	else if($ascii >= 48 && $ascii <= 57) { //lowercase bound
				  $newstring .= chr(($ascii - 5 -48 + 10) % 10 + 48);
				} 
				else {
				  $newstring .= chr($ascii);
				}
		
	}
	return $newstring;
}
//function to encryption.
function encrypt($string)
{
	$newstring = "";
	for ($i=0;$i<strlen($string);$i++)
	{

		  $ascii = ord($string[$i]);
				if($ascii >= 65 && $ascii <= 90) { //uppercase bound
				  $newstring .= chr(($ascii + 15 -65) % 26 + 65); //reset back to 'A' 
				} 
				else if($ascii >= 97 && $ascii <= 122) { //lowercase bound
				  $newstring .= chr(($ascii + 15 -97) % 26 + 97); //reset back to 'a' 
				} 
				else if($ascii >= 48 && $ascii <= 57) { //lowercase bound
				  $newstring .= chr(($ascii + 5 -48) % 10 + 48); //reset back to 'a' 
				} 
				else {
				  $newstring .= chr($ascii);
				}
		
	}
	return $newstring;
}

	

function day()
{
	$txt="";
	for($i=1;$i<32;$i++)
		 $txt .='<option value="'.$i.'">'.$i.'</option>';
		echo $txt;
	}

function caste()
{
	$txt="";
	$castes = array('Kamma','Kapu','Mudiraju','Brahmin','Padmasali','Mala','Madiga','Vysya','Reddy','Gowda','Rajaka','Muslim','Yadava','Yerukala','Sugali','Agnikula Kshatriya','Jangam','BudagaJangam','Devangula','Boyilu');
		 foreach($castes as $c)
		 $txt .='<option if (isset($caste) && $caste=="'.$c.'") echo "selected";>'.$c.'</option>';
		echo $txt;
	}
	
function religion()
{
	$txt="";
	$religions = array('Hindu','Christian','Muslim','Jain');
		 foreach($religions as $r)
		 $txt .='<option if (isset($religion) && $religion=="'.$r.'") echo "selected";>'.$r.'</option>';
		echo $txt;
	}
	
	
function month()
{
	$txt="";
	for($i=1;$i<13;$i++)
		 $txt .='<option value="'.$i.'">'.$i.'</option>';
		echo $txt;
	}
	
function year()
{
	$txt="";
	for($i=1960;$i<2050;$i++)
		 $txt .='<option value="'.$i.'">'.$i.'</option>';
		echo $txt;

	}	
	
	
	function ts($val){
		settype($val,"string");
		return $val;
		}
	
	function mysql_prep( $value ) {
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
		if( $new_enough_php ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysql_real_escape_string( $value );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
	}

	function redirect_to( $location = NULL ) {
		if ($location != NULL) {
			header("Location: {$location}");
			exit;
		}
	}

	function confirm_query($result_set) {
		if (!$result_set) {
			die("Database query failed: " . mysql_error());
		}
	}
	
	
	
	function notnull($value){
		if($value != "" ||$value != NULL){
			 return true;
			}
			else return false;
		}
	function validateMobile($value){
		if(strlen($value)<10)
		{
		return false;
		}
		else return true;
	}
	
 /*	function get_all_subjects($public = true) {
		global $connection;
		$query = "SELECT * 
				FROM subjects ";
		if ($public) {
			$query .= "WHERE visible = 1 ";
		}
		$query .= "ORDER BY position ASC";
		$subject_set = mysql_query($query, $connection);
		confirm_query($subject_set);
		return $subject_set;
	}
	
	function get_pages_for_subject($subject_id, $public = true) {
		global $connection;
		$query = "SELECT * 
				FROM pages ";
		$query .= "WHERE subject_id = {$subject_id} ";
		if ($public) {
			$query .= "AND visible = 1 ";
		}
		$query .= "ORDER BY position ASC";
		$page_set = mysql_query($query, $connection);
		confirm_query($page_set);
		return $page_set;
	}
	
	function get_subject_by_id($subject_id) {
		global $connection;
		$query = "SELECT * ";
		$query .= "FROM subjects ";
		$query .= "WHERE id=" . $subject_id ." ";
		$query .= "LIMIT 1";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		// REMEMBER:
		// if no rows are returned, fetch_array will return false
		if ($subject = mysql_fetch_array($result_set)) {
			return $subject;
		} else {
			return NULL;
		}
	}

	function get_page_by_id($page_id) {
		global $connection;
		$query = "SELECT * ";
		$query .= "FROM pages ";
		$query .= "WHERE id=" . $page_id ." ";
		$query .= "LIMIT 1";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		// REMEMBER:
		// if no rows are returned, fetch_array will return false
		if ($page = mysql_fetch_array($result_set)) {
			return $page;
		} else {
			return NULL;
		}
	}
	
	function get_default_page($subject_id) {
		// Get all visible pages
		$page_set = get_pages_for_subject($subject_id, true);
		if ($first_page = mysql_fetch_array($page_set)) {
			return $first_page;
		} else {
			return NULL;
		}
	}
	
	function find_selected_page() {
		global $sel_subject;
		global $sel_page;
		if (isset($_GET['subj'])) {
			$sel_subject = get_subject_by_id($_GET['subj']);
			$sel_page = get_default_page($sel_subject['id']);
		} elseif (isset($_GET['page'])) {
			$sel_subject = NULL;
			$sel_page = get_page_by_id($_GET['page']);
		} else {
			$sel_subject = NULL;
			$sel_page = NULL;
		}
	}

	function navigation($sel_subject, $sel_page, $public = false) {
		$output = "<ul class=\"subjects\">";
		$subject_set = get_all_subjects($public);
		while ($subject = mysql_fetch_array($subject_set)) {
			$output .= "<li";
			if ($subject["id"] == $sel_subject['id']) { $output .= " class=\"selected\""; }
			$output .= "><a href=\"edit_subject.php?subj=" . urlencode($subject["id"]) . 
				"\">{$subject["menu_name"]}</a></li>";
			$page_set = get_pages_for_subject($subject["id"], $public);
			$output .= "<ul class=\"pages\">";
			while ($page = mysql_fetch_array($page_set)) {
				$output .= "<li";
				if ($page["id"] == $sel_page['id']) { $output .= " class=\"selected\""; }
				$output .= "><a href=\"content.php?page=" . urlencode($page["id"]) .
					"\">{$page["menu_name"]}</a></li>";
			}
			$output .= "</ul>";
		}
		$output .= "</ul>";
		return $output;
	}

	function public_navigation($sel_subject, $sel_page, $public = true) {
		$output = "<ul class=\"subjects\">";
		$subject_set = get_all_subjects($public);
		while ($subject = mysql_fetch_array($subject_set)) {
			$output .= "<li";
			if ($subject["id"] == $sel_subject['id']) { $output .= " class=\"selected\""; }
			$output .= "><a href=\"index.php?subj=" . urlencode($subject["id"]) . 
				"\">{$subject["menu_name"]}</a></li>";
			if ($subject["id"] == $sel_subject['id']) {	
				$page_set = get_pages_for_subject($subject["id"], $public);
				$output .= "<ul class=\"pages\">";
				while ($page = mysql_fetch_array($page_set)) {
					$output .= "<li";
					if ($page["id"] == $sel_page['id']) { $output .= " class=\"selected\""; }
					$output .= "><a href=\"index.php?page=" . urlencode($page["id"]) .
						"\">{$page["menu_name"]}</a></li>";
				}
				$output .= "</ul>";
			}
		}
		$output .= "</ul>";
		return $output;
	}
<?php */
function getClearedNull($v){
	return $v == ""? "%%" : $v;
}
?>