<?php  
	
	function translate_priority($number_priority) {
		$priority = "";
		switch ($number_priority) {
			case 1:
				$priority = "Low";
				break;
			case 3:
				$priority = "Normal";
				break;
			case 5:
				$priority = "High";
				break;
			default:
				$priority = "";
				break;
		}
		return $priority;
	}

	function date_to_db($date) {
		if ($date == "") {
			return "";
		}

		$parts = explode('-', $date);

		if (count($parts) != 3) {
			return $date;
		}

		$date_db = DateTime::createFromFormat("d-m-Y", $date);
		return $date_db->format("Y-m-d");
	}

	function date_to_form($date) {
		if ($date == "" OR $date == "0000-00-00" OR $date == "--") {
			return "";
		}

		$parts = explode('-', $date);

		if (count($parts) != 3) {
			return $date;
		}

		$date_db = DateTime::createFromFormat("Y-m-d", $date);
		return $date_db->format("d-m-Y");
	}

	function translate_complete($bool) {
		switch ($bool) {
			case 'true':
				return "Yes";
				break;

			default:
				return "No";
				break;
		}
	}

	function theres_post() {
		if (count($_POST) > 0) {
			return true;
		}

		return false;
	}

	function validate_date($date) {
		$pattern = '/^[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}$/';

		$result = preg_match($pattern, $date);
		
		if ($result == 0) {
			return false;
		}

		$parts = explode('-', $date);
		$day = $parts[0];
		$month = $parts[1];
		$year = $parts[2];

		$result = checkdate($month, $day, $year);

		return $result;
	}

	function validate_attach($file) {
		$pattern = '/^.+(\.pdf|\.zip)$/';
		$result = preg_match($pattern, $file['name']);

		if ($result == 0) {
			return false;
		}

		move_uploaded_file($file['tmp_name'], "attachments/{$file['name']}");

		return true;
	}

?>