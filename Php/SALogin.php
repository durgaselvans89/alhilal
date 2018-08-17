<?php

require_once ('com/DBConnection/dbConnection.php');
require_once ('com/DAOConstants/LoginConstants.php');
require_once ('com/DAOConstants/MasterConstants.php');
require_once ('com/VO/SessionDO.php');
require_once ('com/VO/RoleDO.php');
require_once ('com/VO/StatusDO.php');
require_once ('com/VO/LocationDO.php');
require_once ('Mail_SA.php');

class SALogin{

/*
 
	public function validateAPPLogin($username, $password){

	  try{
	  
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   $result = $connection->prepare(LoginConstants::Validate_Login);
	   $result->bind_param("ss",$username,$password);
	   $result->execute();
	   $result->bind_result($userid, $username, $surname, $loginname, $designation, $telphoneno, $mobileno, $email, $roleid, $teamid, $password);
	   $logindo = new SessionDO();
	   
	   while($result->fetch()){
		$logindo->userid = $userid; 
		$logindo->username = $username;
		$logindo->surname = $surname;
		$logindo->loginname = $loginname;
		$logindo->designation = $designation;
		$logindo->telphoneno = $telphoneno;
		$logindo->mobileno = $mobileno;
		$logindo->email = $email;
		$logindo->roleid = $roleid;
		$logindo->teamid = $teamid;
		$logindo->password = $password;
	   }
	 
	   $result->close();
	   $connection->close();
	  }
	  catch(Exception $exception){
	   die($exception);
	  }
	  return $logindo;
	 
	 }
	 
	 */
	 
	 
/*	 
	public function validateAPPLogin($username, $password){

		try{
			
			$username = trim($username);
			$password = trim($password);
			
			if($username != null && $password != null){
			
				$database = new dbConnection();
				$connection = $database->getConnection();
				$result = $connection->prepare(LoginConstants::Validate_Login);
				$result->bind_param("ss",$username,$password);
				 
				$result->execute();
				$result->bind_result($userid, $username, $surname, $loginname, $designation, $telphoneno, $mobileno, $Email, $roleid,$rolename, $teamid, $password);
				$logindo = new SessionDO();
				
				$salogin = new SALogin();
				while($result->fetch()){
					
					$logindo->userid = $userid;
					
					if($logindo->userid != null){
					
						$logindo->username = $username;
						$logindo->surname = $surname;
						$logindo->loginname = $loginname;
						$logindo->designation = $designation;
						$logindo->telphoneno = $telphoneno;
						$logindo->mobileno = $mobileno;
						$logindo->email = $Email;
						$logindo->roleid = $roleid;
						$ligindo->$rolename=$rolename;
						$logindo->teamid = $teamid;
						$logindo->password = $password;
						$logindo->criteriapart = $salogin->getCriteriaPartID($username); 
					}
					else{
						$logindo = null;
					}
				}
		
				$result->close();
				$connection->close();
			}
			else{
				$logindo = null;
			}
		}
		catch(Exception $exception){
			die($exception);
		}
		return $logindo;
	}
	*/
	
	public function validateAPPLogin($username, $password){

		try{
			
			$criteriapartid = "";
			$username = trim($username);
			$password = trim($password);
			
			if($username != null && $password != null){
			
				$database = new dbConnection();
				$connection = $database->getConnection();
				//return $connection;
				$result = $connection->prepare(LoginConstants::Validate_Login);
				$result->bind_param("ss",$username,$password);
				//return 'working';
				$result->execute();
				
//				u.UserID, u.UserName, u.surname, u.LoginName, u.Designation, u.TelPhoneNo, u.MobileNo, u.Email, u.RoleID, r.RoleName, u.TeamID, u.Password
				
				
				$result->bind_result($userid, $username, $surname, $loginname, $designation, $telphoneno, $mobileno, $EMail, $roleid, $roleName, $teamid, $password, $locationID, $location,$cityName);
				$logindo = new SessionDO();
				
				$salogin = new SALogin();
				while($result->fetch()){
					
					$logindo->userid = $userid;
					
					
					if($logindo->userid != null){
					
						$logindo->username = $username;
						$logindo->surname = $surname;
						$logindo->loginname = $loginname;
						$logindo->designation = $designation;
						$logindo->telphoneno = $telphoneno;
						$logindo->mobileno = $mobileno;
						$logindo->email = $EMail;
						$logindo->roleid = $roleid;
						$logindo->rolename = $roleName;
						$logindo->teamid = $teamid;
						$logindo->password = $password;
						$logindo->locationID = $locationID;
						$logindo->location = $location;
						$logindo->cityName = $cityName;
						$criteriapartid = $salogin->getCriteriaPartID($roleid,$userid);
						
						if($criteriapartid != ""){
							$logindo->criteriapart = $criteriapartid;
						}
						else{
							$logindo->criteriapart = "";
						}
					}
					else{
						$logindo = null;
					}
				}
		
				$result->close();
				$connection->close();
			}
			else{
				$logindo = null;
			}
		}
		catch(Exception $exception){
			die($exception);
		}
		return $logindo;
	}
	
	public function getCriteriaPartID($roleID,$userID){
		
		try{
			$strvalue = "";
			$database = new dbConnection();
			$connection = $database->getConnection();
			if($roleID<=5){
				$result = $connection->prepare(LoginConstants::SELECT_CRITERIA_PARTID_TEAM_LEADER);
				$result->bind_param("i",$userID);
			}
			else{
				$result = $connection->prepare(LoginConstants::SELECT_CRITERIA_PARTID_TEAM_MEM);
				$result->bind_param("i",$userID);
			}
			$result->execute();
			$result->bind_result($CriterionPartShortDescription);
			while($result->fetch()){
				if($strvalue == ""){
					$strvalue = $CriterionPartShortDescription;
				}
				else{
					$strvalue = $strvalue.",".$CriterionPartShortDescription;
				}
			}
			$result->close();
			$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $strvalue;		
	}
	
	 
	 
	 

	
		public function getRoleDetails(){

			try{
				$database = new dbConnection();
				$connection = $database->getConnection();
				
				$result = $connection->prepare(MasterConstants::Select_Role);
				//return 123;
				$result->execute();
				
				$result->bind_result($roleid, $rolename, $roletype, $roletypedescription, $displayorder);
				
				$role[] = new RoleDO();
				$i  = 0;
				
				while($result->fetch()){
				
					$role[$i]->roleid = $roleid; 
					$role[$i]->rolename  = $rolename;
					$role[$i]->roletype = $roletype;
					$role[$i]->roletypedesc = $roletypedescription;
					$role[$i]->displayorder = $displayorder;
					$role[$i]->flag=false;
					$i = $i + 1;
				}
		
				$result->close();
				$connection->close();
			}
			catch(Exception $exception){
				die($exception);
			}
			return $role;
		
		}
		
			/*
		public function insertRole($RoleName, $RoleType, $RoleTypeDescription){
		   
			try{
			
				$roleid = "";
				$rowInserted = 0;
				$database = new dbConnection();
				$connection = $database->getConnection();
				$result = $connection->prepare(MasterConstants::SELECT_MAX_ROLE);
				$result->execute();
				$result->bind_result($RoleID);
				while($result->fetch()){
				 $roleid = $RoleID;
				}
				$result->close();
				
				if($roleid == 0){
					$roleid = 1;
				}
				else{
					$roleid = $roleid + 1;
				}
			
			if($roleid != ""){
			$DisplayOrder = $roleid;
			 $result = $connection->prepare(MasterConstants::INSERT_ROLE_DETAILS);
			 $result->bind_param("isssi",$roleid,$RoleName, $RoleType, $RoleTypeDescription, $DisplayOrder);    
			 $result->execute();
			 $rowInserted = $result->affected_rows;
			 $result->close();
			}
			
			$connection->close();
		   }
		   catch(Exception $exception){
			die($exception);
		   }
		   return $rowInserted;
		}
		  */


		public function insertRole($RoleNameValue, $RoleTypeValue, $RoleTypeDescriptionValue){
			
			try{
				
				$flag = 0;
				
				$rolearray = array();
				$roleid = "";
				$rowInserted = 0;
				$DisplayOrder = 0;
				
				$database = new dbConnection();
				$connection = $database->getConnection();
				
				$result = $connection->prepare(MasterConstants::SELECT_MAX_ROLE);
				$result->execute();
				$result->bind_result($RoleID);
				while($result->fetch()){
					$roleid = $RoleID;
				}
				$result->close();
				
				if($roleid == 0){
					$roleid = 1;
				}
				else{
					$roleid = $roleid + 1;
				}
				
				$result = $connection->prepare(MasterConstants::SELECT_ROLE_EXISTS);
				$result->bind_param("s",strtoupper($RoleNameValue));
				
				$result->execute();
				$result->bind_result($cntRole);
				while($result->fetch()){
					$flag = $cntRole;
				}
				$result->close();
				
				/*
				
				$result->bind_result($RoleID,$RoleName, $RoleType, $RoleTypeDescription,$DisplayOrder);
				while($result->fetch()){
					$roledo = new RoleDO();
					$roledo->roleid = $RoleID;
					$roledo->rolename = $RoleName;
					$roledo->roletype = $RoleType;
					$roledo->roletypedesc = $RoleTypeDescription;
					$roledo->displayorder = $DisplayOrder;
					$rolearray[] = $roledo;
					unset($roledo);
				}
				$result->close();
				
				for($i = 0; $i < count($rolearray); $i++){
					$roledo = new RoleDO();
					$roledo = $rolearray[$i];
					
					if(strtoupper($roledo->rolename) == strtoupper($RoleNameValue)){
						$flag = 1;
					}
				}
				
				*/
				
				if($flag == 0){
				
					$DisplayOrder = $roleid;
					$result = $connection->prepare(MasterConstants::INSERT_ROLE_DETAILS);
					$result->bind_param("isssi",$roleid,$RoleNameValue,$RoleTypeValue,$RoleTypeDescriptionValue,$DisplayOrder);				
					$result->execute();
					$rowInserted = $result->affected_rows;
					$result->close();
				}
				$connection->close(); 
			}
			catch(Exception $exception){
				die($exception);
			}
			return $rowInserted;
		}
		  
		  
		  public function deleteRole($RoleID){
		   
		   try{
			
			$database = new dbConnection();
			$connection = $database->getConnection();
			$countUserID = 0;
			
			$result = $connection->prepare(MasterConstants::CHK_ROLE_EXISTS_FOR_USER);
			$result->bind_param("i",$RoleID);
			$result->execute();
			$result->bind_result($cntUsrID);
			while($result->fetch()){
				$countUserID = $cntUsrID;
			}
			if($countUserID==0){
				$result = $connection->prepare(MasterConstants::DELETE_ROLE_DETAILS);
				$result->bind_param("i",$RoleID);
				$result->execute();
				$rowDeleted = $result->affected_rows;
				$status = 1;
			}
			else{
				$status = 0;
			}
			$result->close();
			$connection->close();
			
		   }
		   catch(Exception $exception){
			die($exception);
		   }
		   return $status;
		  }
		
		
	
	/*
		public function getSubTeamRoleDetails(){

		  try{
		   // Database Connection   
		   
		   $database = new dbConnection();
		   $connection = $database->getConnection();
		   
		   $result = $connection->prepare(MasterConstants::Select_Sub_Team_Roles);
		   $result->execute();
		   
		   $result->bind_result($roleid, $rolename, $roletype, $roletypedescription);
		   
		   $role[] = new RoleDO();
		   $i  = 0;
		   
		   while($result->fetch()){
		   
			$role[$i]->roleid = $roleid; 
			$role[$i]->rolename  = $rolename;
			$role[$i]->roletype = $roletype;
			$role[$i]->roletypedesc = $roletypedescription;
			$i = $i + 1;
		   }
		 
		   $result->close();
		   $connection->close();
		  }
		  catch(Exception $exception){
		   die($exception);
		  }
		  return $role;
		  }
  */
	  
	  
	  public function getStatusDetails(){

	   try{
		
			$statusarray = array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(MasterConstants::SELECT_STATUS);
			$result->execute();
			$result->bind_result($StatusID, $Status);
			
			while($result->fetch()){
			 
			 $statusdo = new StatusDO();
			 $statusdo->StatusID = $StatusID;
			 $statusdo->Status = $Status;
			 $statusarray[] = $statusdo;
			 unset($statusdo);
			}
			
			$result->close();
			$connection->close();
	   }
	   catch(Exception $exception){
		die($exception);
	   }
	   
	   return $statusarray;
	  }
	  
	  
/*		public function insertStatus($Status){
		   
		   try{
			
			$statusid = "";
			$rowInserted = 0;
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(MasterConstants::SELECT_MAX_STATUS);
			$result->execute();
			$result->bind_result($StatusID);
			while($result->fetch()){
			 $statusid = $StatusID;
			}
			$result->close();
			
			if($statusid == 0){
			 $statusid = 1;
			}
			else{
			 $statusid = $statusid + 1;
			}
			
			if($statusid != ""){
			
			 $result = $connection->prepare(MasterConstants::INSERT_STATUS);
			 $result->bind_param("is",$statusid,$Status);    
			 $result->execute();
			 $rowInserted = $result->affected_rows;
			 $result->close();
			}
			
			$connection->close();
		   }
		   catch(Exception $exception){
			die($exception);
		   }
		   return $rowInserted;
		  } 
		  
		  
		  public function insertStatus($Status_Value){
			
			try{
				
				$flag = 0;
				$statusid = "";
				$rowInserted = 0;
				$statusarray = array();
				$database = new dbConnection();
				$connection = $database->getConnection();
				$result = $connection->prepare(MasterConstants::SELECT_MAX_STATUS);
				$result->execute();
				$result->bind_result($StatusID);
				while($result->fetch()){
					$statusid = $StatusID;
				}
				$result->close();
				
				if($statusid == 0){
					$statusid = 1;
				}
				else{
					$statusid = $statusid + 1;
				}
				
				$result = $connection->prepare(MasterConstants::SELECT_STATUS);
				$result->execute();
				$result->bind_result($StatusID, $Status);
				while($result->fetch()){
					$statusdo = new StatusDO();
					$statusdo->StatusID = $StatusID;
					$statusdo->Status = $Status;
					$statusarray[] = $statusdo;
					unset($statusdo);
				}
				$result->close();
				
				for($i = 0; $i < count($statusarray); $i++){
					$statusdo = new StatusDO();
					$statusdo = $statusarray[$i];
					if($Status_Value == $statusdo->Status){
						$flag = 1;	
					}
				}
				
				if($flag == 0){
				
					$result = $connection->prepare(MasterConstants::INSERT_STATUS);
					$result->bind_param("is",$statusid,$Status_Value);				
					$result->execute();
					$rowInserted = $result->affected_rows;
					$result->close();
				}
				
				$connection->close();
			}
			catch(Exception $exception){
				die($exception);
			}
			return $rowInserted;
		}
		*/
		 
		 public function insertStatus($Status_Value){
			
			try{
				
				$rowInserted = 0;
				$countStatus = 0;
				$database = new dbConnection();
				$connection = $database->getConnection();
				
				$result = $connection->prepare(MasterConstants::CHK_STATUS_EXISTS);
				$result->bind_param("s",strtoupper($Status_Value));				
				$result->execute();
				$result->bind_result($cntStatus);
				while($result->fetch()){
					$countStatus = $cntStatus;
				}
				$result->close();
				if($countStatus==0){
					$result = $connection->prepare(MasterConstants::INSERT_STATUS);
					$result->bind_param("s",$Status_Value);				
					$result->execute();
					$rowInserted = $result->affected_rows;
					$result->close();
				}
				$connection->close();
			}
			catch(Exception $exception){
				die($exception);
			}
			return $rowInserted;
		}
		  
		  
		 public function deleteStatus($StatusID){
		   
		   try{
			
			$database = new dbConnection();
			$cntStatusExists = 0;
			$connection = $database->getConnection();
			$result = $connection->prepare(MasterConstants::SELECT_STATUS_EXISTS_UNDER_ACT);
			$result->bind_param("i",$StatusID);
			$result->execute();
			$result->bind_result($cntActivity);
			while($result->fetch()){
				$cntStatusExists = $cntActivity;
			}
			$result->close();
			if($cntStatusExists==0){
				$result = $connection->prepare(MasterConstants::DELETE_STATUS);
				$result->bind_param("i",$StatusID);
				$result->execute();
				$rowDeleted = $result->affected_rows;
				$result->close();
			}
			
			$connection->close();
			
		   }
		   catch(Exception $exception){
			die($exception);
		   }
		   return $rowDeleted;
		  }
	  
	public function insertLocation($location){
			
		try{
			
			$rowInserted = 0;
			$database = new dbConnection();
			$connection = $database->getConnection();
			$countOfLocation = 0;
			
			$result = $connection->prepare(MasterConstants::CHK_LOCATION_EXISTS);
			$result->bind_param("s",$location);				
			$result->execute();
			$result->bind_result($cntLocation);
			while($result->fetch()){
				$countOfLocation = $cntLocation;
			}
			$result->close();
			if($countOfLocation==0){
				$result = $connection->prepare(MasterConstants::INSERT_LOCATION);
				$result->bind_param("s",$location);				
				$result->execute();
				$rowInserted = $result->affected_rows;
				$result->close();
			}
			$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $rowInserted;
	}
	
	public function selectLocationDetails(){
			
		try{
			
			$locationArray= array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			
			$result = $connection->prepare(MasterConstants::SELECT_LOCATION);
			$result->execute();
			$result->bind_result($locationID,$location);
			while($result->fetch()){
				$locationdo = new LocationDO();
				$locationdo->LocationID = $locationID;
				$locationdo->Location = $location;
				$locationArray[] = $locationdo;
				unset($locationdo);
			}
			$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $locationArray;
	}
	public function deleteLocation($locationID){
		   
		   try{
			$rowDeleted = 0;
			$cntLocationID = 0;
			$database = new dbConnection();
			
			$connection = $database->getConnection();
			$result = $connection->prepare(MasterConstants::CHK_LOCATION_EXISTS_FOR_DELETION);
			$result->bind_param("i",$locationID);
			$result->execute();
			$result->bind_result($countLocationID);
			while($result->fetch()){
				$cntLocationID = $countLocationID;
			}
			$result->close();
			if($cntLocationID==0){
				$connection = $database->getConnection();
				$result = $connection->prepare(MasterConstants::DELETE_LOCATION);
				$result->bind_param("i",$locationID);
				$result->execute();
				$rowDeleted = $result->affected_rows;
				$result->close();
			}
			$connection->close();
			
		   }
		   catch(Exception $exception){
			die($exception);
		   }
		   return $rowDeleted;
	}
	public function getDesignationList(){
		try{
			$designationArr=array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(MasterConstants::SELECT_DESIGNATION);
			$result->execute();
			$result->bind_result($designation);
			while($result->fetch()){
				$logindo = new SessionDO();
				$logindo->designation = $designation;
				$designationArr[]=$logindo;
			}
			$result->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $designationArr;
	}
	public function getExeRoles(){
		try{
			$exeRoleArr=array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(MasterConstants::SELECT_EXE_ROLES);
			$result->execute();
			$result->bind_result($roleID,$userID);
			while($result->fetch()){
				$logindo = new SessionDO();
				$logindo->roleid = $roleID;
				$logindo->userid = $userID;
				if($roleID==1 || $roleID==2 || $roleID==3 || $roleID==4){
					$logindo->flag = true;
				}
				else{
					$logindo->flag = false;
				}
				$exeRoleArr[]=$logindo;
			}
			$result->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $exeRoleArr;
	}
	
	public function insertExeRoles($roleArr){
		try{
			$database = new dbConnection();
			$connection = $database->getConnection();
			
			for($i = 0; $i < count($roleArr); $i++){
				
				$teamDO = new TeamDO();
				$teamDO = $roleArr[$i];
				$roleID = $teamDO->roleID;
				$userid = $teamDO->userid;
				$result = $connection->prepare(MasterConstants::INSERT_EXE_ROLES);
				$result->bind_param("ii",$roleID,$userid);
				$result->execute();
				$rowInserted = $result->affected_rows;
				$result->close();
				
				
			}
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $rowInserted;
	} 
	public function deleteExeRoles($roleArr){
		try{
			$database = new dbConnection();
			$connection = $database->getConnection();
			/*
			$result = $connection->prepare(MasterConstants::DELETE_EXE_ROLE);
			$result->execute();
			$rowDeleted = $result->affected_rows;
			$result->close();*/
			for($i = 0; $i < count($roleArr); $i++){
				
				$teamDO = new TeamDO();
				$teamDO = $roleArr[$i];
				$roleID = $teamDO->roleID;
				$userid = $teamDO->userid;
				$result = $connection->prepare(MasterConstants::DELETE_EXE_ROLE);
				$result->bind_param("i",$userid);
				$result->execute();
				$rowDeleted = $result->affected_rows;
				$result->close();
				
				
			}
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $rowDeleted;
	} 
	public function chkExeRoleExists($UserID){
		try{
			$cntUserID = 0;
			$database=new dbConnection();
			$connection=$database->getConnection();
			$result = $connection->prepare(MasterConstants::CHK_EXE_ROLES_EXISTS);
			$result->bind_param("i",$UserID);
			$result->execute();
			$result->bind_result($countUserID);
			while($result->fetch()){
				$cntUserID = $countUserID;
			}
			$result->close();
		}
		catch(Exception $exception){
			throw($exception);
		}
		return $cntUserID;
	}
	public  function deleteSelectedExeRole($UserID){
		try{
			$cntUserID = 0;
			$database=new dbConnection();
			$connection=$database->getConnection();
			$result = $connection->prepare(MasterConstants::DELETE_SELECTED_EXE_ROLE);
			$result->bind_param("i",$UserID);
			$result->execute();
			$rowDeleted = $result->affected_rows;
			$result->close();
		}
		catch(Exception $exception){
			throw($exception);
		}
		return $cntUserID;
	}
	public function selectRoleType(){
		try{
			$roleTypeArr=array();
			$database=new dbConnection();
			$connection=$database->getConnection();
			$result = $connection->prepare(MasterConstants::SELECT_ROLE_TYPE);
			$result->execute();
			$result->bind_result($roleType,$roleTypeDesc);
			while($result->fetch()){
				$roleDO = new RoleDO();
				$roleDO->roletype=$roleType;
				$roleDO->roletypedesc=$roleTypeDesc;
				$roleTypeArr[]=$roleDO;
			}
			$result->close();
		}
		catch(Exception $exception){
			throw($exception);
		}
		return $roleTypeArr;
	}
	/*public function sendMail($to,$subject,$msg){
		try{
			$mail=new Mail_SA();
			$result=$mail->sendMail($to,$subject,$msg);
		}
		catch(Exception $exception){
			throw($exception);
		}
		return $result;
	}*/
	
}	
?>