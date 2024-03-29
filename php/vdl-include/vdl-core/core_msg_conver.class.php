<?php
/*	Vidali, Social Network Open Source.
This file is part of Vidali.

Vidali is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Vidali is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Foobar.  If not, see <http://www.gnu.org/licenses/>.*/

class CORE_MSG_CONVER extends CORE_MAIN{

	public function __construct (){
		parent::__construct();
	}

	public function get_messages($id_conver){
		$connection = parent::connect();
		$query = "SELECT *
					FROM vdl_msg_conver
					WHERE vdl_msg_conver.conver_ref LIKE $id_conver
					ORDER BY vdl_msg_conver.date_published";
		$data=$connection->query($query);
		$arresult=array();
		while ($row = $data->fetch_array()) {
			array_push($arresult,$row);
		}
		return $arresult;
	}
	
	public function set_messages($id_conver,$id_user,$date,$text){
		$connection = parent::connect();
		$query = "INSERT INTO `vdl_msg_conver` (`conver_ref`, `user_ref`, `date_published`, `text`) 
					VALUES ('$id_conver', '$id_user', '$date', '$text')";
		$data=$connection->query($query);
		if (!$data) {
			$message  = 'Invalid query: ' . mysql_error() . "\n";
			$message = $message . ' Whole query: ' . $query;
			die($message);
			return false;
		}
		return true;
	}
	
}

?>