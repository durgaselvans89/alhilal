<?php
/*
require_once ('com/DBConnection/dbConnection.php');

require_once ('com/DAOConstants/TeamConstants.php');
require_once ('com/DAOConstants/CriteriaConstants.php');

require_once('com/VO/TeamDO.php');
require_once('com/VO/TeamDetailDO.php');
require_once('com/VO/TeamAssessmentDO.php');
require_once('com/VO/CriteriaDO.php');
require_once('com/VO/ExeteamenablerassessmentDO.php');
require_once('com/VO/EnablerAssessmentDO.php');
require_once('com/VO/CustomerDO.php');
require_once('com/VO/CriteriaPartDO.php');

require_once('com/VO/ResultAssessmentDO.php');
require_once('com/VO/ResultDocumentDO.php');
require_once('com/VO/EnablerDocumentDO.php');*/


//require_once('class.phpmailer.php');
require_once ('com/DBConnection/dbConnection.php');
require_once ('com/DAOConstants/TeamConstants.php');
require_once ('com/DAOConstants/CriteriaConstants.php');
require_once ('com/VO/TeamDO.php');

require_once ('com/VO/PriorityDO.php');
require_once ('com/VO/TeamAssessmentDO.php');
require_once ('com/VO/EnablerAssessmentDO.php');
require_once ('com/VO/CriteriaDO.php');
require_once ('com/VO/TeamDetailDO.php');
require_once ('com/VO/CriteriaPartDO.php');
require_once ('com/VO/ResultAssessmentDO.php');
require_once ('com/VO/ResultDocumentDO.php');
require_once ('com/VO/EnablerDocumentDO.php');
require_once('com/VO/ExeteamenablerassessmentDO.php');
require_once('com/VO/CustomerDO.php');
require_once ('com/DAOConstants/CustomerConstants.php');
require_once ('com/VO/CommentsDO.php');
require_once ('com/VO/ProjectDetailsDO.php');
require_once ('com/VO/StrengthDO.php');
require_once ('com/VO/AFIDO.php');
require_once ('Mail_SA.php');

class SATeam{
/*
	 public function CreateTeam(TeamDO $inteamdo){
   
		  $teamname = $inteamdo->teamname;
		  $teamowner = $inteamdo->teamowner;
		  
		  try{
		   $rowInserted = 0;
		   $count = 0;
		   $teamNamearray = array();
		   $roleid = "";
		   $database = new dbConnection();
		   $connection = $database->getConnection();
		   $result = $connection->prepare(TeamConstants::SELECT_USER_ROLE_ID_VALUE);
		   $result->bind_param("s",$teamowner);
		   $result->execute();
		   $result->bind_result($roleID);
		   while($result->fetch()){
			$roleid = $roleID;
		   }
		   $result->close();
		   
		   $result = $connection->prepare(TeamConstants::CHECK_TEAM_NAME);
		   $result->bind_param("s",$teamname);
		   $result->execute();
		   $result->bind_result($TeamName);
		   while($result->fetch()){
			$teamNamearray[] = $TeamName; 
		   }
		   $result->close();
		   
		   if(count($teamNamearray) == 0){
			$result = $connection->prepare(TeamConstants::INSERT_TEAM_DETAILS);
			$result->bind_param("si",$teamname, $roleid);
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
	public function CreateTeam(TeamDO $inteamdo){
   
		  $teamname = $inteamdo->teamname;
		  $teamowner = intval($inteamdo->teamowner);
		  $locationID = intval($inteamdo->locationID);
		  $location = $inteamdo->location;
		  try{
		   $rowInserted = 0;
		   $count = 0;
		   $cntTeamName = 0;
		   $teamNamearray = array();
		   $roleid = "";
		   $database = new dbConnection();
		   $connection = $database->getConnection();
		   $result = $connection->prepare(TeamConstants::CHECK_TEAM_NAME);
		   $result->bind_param("s",$teamname);
		   $result->execute();
		   $result->bind_result($cntTeam);
		   while($result->fetch()){
			$cntTeamName = $cntTeam; 
		   }
		   $result->close();
		   
		   if($cntTeamName == 0){
				$result = $connection->prepare(TeamConstants::INSERT_TEAM_DETAILS);
				$result->bind_param("siis",$teamname, $teamowner, $locationID, $location);
				$result->execute();
				$rowInserted = $result->affected_rows;
				$result->close();
				if($rowInserted!=0){
					$result = $connection->prepare(TeamConstants::GET_TEAM_ID);
					$result->bind_param("s",$teamname);
					$result->execute();
					$result->bind_result($teamID);
					while($result->fetch()){
						$TeamID = $teamID;
					}
					$result->close();
					if($TeamID!=0){
						$result = $connection->prepare(TeamConstants::UPDATE_TEAM_USER);
						$result->bind_param("ii",$TeamID, $teamowner);
						$result->execute();
						$rowUpdated = $result->affected_rows;
						$result->close();
					}
				}
		   }
		   $connection->close();
		  }
		  catch(Exception $exception){
		   die($exception);
		  }
		  return $rowInserted;
		 }
	public function getCriteriaID(){
  
			  try{
			   
			   $criteriaidarray = array();
			   $criteriadesc = array();
			   $guidancearray = array();
			   $database = new dbConnection();
			   $connection = $database->getConnection();
			   $result = $connection->prepare(TeamConstants::SELECT_CRITERIA_PART_ID);
						$result->execute();
						$result->bind_result($criterionPartID, $criterionPartShortDescription,$criterionPartDefinition,$maxPoints);
			   while($result->fetch()){
				
				$criteriado = new CriteriaDO();
				$criteriado->criterionid = $criterionPartID;
				$criteriado->criteriashortpartid = $criterionPartShortDescription;
				$criteriado->criteriadesc = $criterionPartDefinition;
				$criteriado->maxPoints = $maxPoints;
				 $criteriaidarray[] = $criteriado;
				 unset($criteriado);
			   }
						$result->close();
					 $connection->close();
			  }
			  
			  catch(Exception $exception){
			   die($exception);
			  }
			  return $criteriaidarray;
			 }
			 
			 
	public function getCriteriaDesc($criteriaid){
		
		try{
			
			$criteriadesc = array();
			
			$database = new dbConnection();
			
			$connection = $database->getConnection();
			
			$result = $connection->prepare(CriteriaConstants::SELECT_CRITERIA_DESC);
			
        	$result->bind_param("i",$criteriaid);
        	
        	$result->execute();
        	
        	$result->bind_result($CriterionPartID,$criterionpartshortdescription, $CriterionPartDefinition);
			
			$criteriado = new CriteriaDO();
			
			while($result->fetch()){
				
				$criteriado->criterionid = $CriterionPartID;
				
				$criteriado->criteriashortpartid = $criterionpartshortdescription;
				
				$criteriado->criteriadesc = $CriterionPartDefinition;
				
			}
			
			$result->close();
			$connection->close();
			
		}
		catch(Exception $exception){
			die($exception);
		}
		
		return $criteriado;
	}
	
	
	public function getGuidance($criteriaid){
		
		try{
						
			$guidancearray = array();
			
			$database = new dbConnection();
			
			$connection = $database->getConnection();
			
			$result = $connection->prepare(CriteriaConstants::SELECT_GUIDANCE);
			
        	$result->bind_param("i",$criteriaid);
        	
        	$result->execute();
        	
        	$result->bind_result($GuidancePointDescription);
			
			while($result->fetch()){
				
				$guidancearray[] = $GuidancePointDescription;
				
			}
			$result->close();
			$connection->close();
			
		}
		catch(Exception $exception){
			die($exception);
		}
		
		
		return $guidancearray;
		
	}

	
	
	public function getSubTeamAssessmentList($locID){
		
		try{
			
			$tempdate = "";
			$datearray = array();
			$subteamassessment = array();
			//$locatID=intval($locID);
        	
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(TeamConstants::SELECT_TEAMACTIVITY);
			$result->bind_param("i",$locID);
			//return 'dfsd';
			$result->execute();
        	$result->bind_result($activityID, $milestone, $activity, $username,$surname, $duedate, $status, $locationID, $location);
			while($result->fetch()){
				
				$teamassessmentdo = new TeamAssessmentDO();
				$teamassessmentdo->activityID = $activityID;
				
				$teamassessmentdo->milestone = $milestone;
				$teamassessmentdo->activity = $activity;
				$teamassessmentdo->accountability = $username.' '.$surname;
				
				//$datearray = explode(" ",$duedate);
				//$teamassessmentdo->duedate = date('d-m-Y',strtotime($datearray[0])).$datearray[1]; //date('d-m-Y',strtotime($duedate));
				
				$tempdate = date('d-m-Y',strtotime($duedate));
				$teamassessmentdo->duedate = $tempdate;
				$teamassessmentdo->status = $status;
				$teamassessmentdo->locationID = $locationID;
				$teamassessmentdo->location = $location;
				$subteamassessment[] = $teamassessmentdo;
				unset($teamassessmentdo);
			}
			$result->close();
			$connection->close();
			
		}
		catch(Exception $exception){
			die($exception);
		}
	
		return $subteamassessment;
	}
	
	
	
	public function getUserName(){
		
		try{
			
			$usernamearray = array();
			
			$database = new dbConnection();
			
			$connection = $database->getConnection();
			
			$result = $connection->prepare(TeamConstants::SELECT_USER_NAME);
			
        	$result->execute();
        	
        	$result->bind_result($UserID,$UserName);
        	
			while($result->fetch()){
				$customerdO = new CustomerDO();
				$customerdO->userid = $UserID;
				
				$customerdO->username = $UserName;
				$usernamearray[] = $customerdO;
				
			}
			$result->close();
			$connection->close();
			
		}
		catch(Exception $exception){
			die($exception);
		}
		
		return $usernamearray;
		
	}
	
	public function getTeamLeaderList($locationID){
		
		try{
			
			$usernamearray = array();
			
			$database = new dbConnection();
			
			$connection = $database->getConnection();
			
			$result = $connection->prepare(TeamConstants::SELECT_ALL_TEAM_LEADERS);
			$result->bind_param("i",$locationID);
        	$result->execute();
        	
        	$result->bind_result($UserID,$UserName,$surName);
        	
			while($result->fetch()){
				$customerdO = new CustomerDO();
				$customerdO->userid = $UserID;
				
				$customerdO->username = $UserName . ' ' . $surName;
				$usernamearray[] = $customerdO;
				
			}
			$result->close();
			$connection->close();
			
		}
		catch(Exception $exception){
			die($exception);
		}
		
		return $usernamearray;
		
	}
	
	
	public function createTeamName($teamname,$teamleader){
		
		try{
			
			$database = new dbConnection();
			
			$connection = $database->getConnection();
			
			$result = $connection->prepare(TeamConstants::CREATE_TEAM_NAME);
			
			$result->bind_param("ss",$teamname,$teamleader);

        	$result->execute();

        	$rowInserted = $result->affected_rows;
			
		}
		catch(Exception $exception){
			die($exception);
		}
		
		return $rowInserted;
	}

	
	public function getTeamDetails($teamName, $userID, $locationID){
  
	  try{
	  
		if($username != 'All'){
	   
		   if($username != null){
			$username = '%'.$username.'%';
		   }
		   else{
			$username = '%';
		   }
		   
		   if($teamName != null){
			$teamName = '%'.$teamName.'%';
		   }
		   else{
			$teamName = '%';
		   }
		}
		
       $userarray = array();		
	   $teamid = "";
	   $criteriaid = "";
	   $criteriaarray = array();
	   $teamarray = array();
	   $teamdetailsarray = array();
	   $newteamarray = array();
	   
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   if($userID == 0 && $teamName == '%'){
			$result = $connection->prepare(TeamConstants::SELECT_All_TEAM_DETAILS);
			$result->bind_param("i", $locationID);
	   }
	   else if($userID == 0 && $teamName != '%'){
			$result = $connection->prepare(TeamConstants::SELECT_TEAM_DETAILS_REG_TEAM_NAME);
			$result->bind_param("si", $teamName, $locationID);
	   }
	   else{
			$result = $connection->prepare(TeamConstants::SELECT_TEAM_DETAILS);
			$result->bind_param("sii", $teamName, $userID, $locationID);
	   }
	   $result->execute();
	   $result->bind_result($teamID, $teamName, $username, $locationID, $location, $surName);
	   
	   while($result->fetch()){
		/*
		$teamdetaildo = new TeamDetailDO();
		
		$teamdetaildo->teamid = $teamID;
		$sateam = new SATeam();
		$criteriaid = $sateam->getCriterialList($teamdetaildo->teamid);
		$teamdetaildo->criterionpartid = $criteriaid!=null ?  $criteriaid : 'Assign';
		$teamdetaildo->teamname = $teamName;
		$teamdetaildo->teamleadername = $username;
		$teamdetaildo->locationID = $locationID;
		$teamdetaildo->location = $location;
		$teamdetailsarray[] = $teamdetaildo;
		unset($teamdetaildo);*/
		
		$teamdetaildo = new TeamDO();
		
		$teamdetaildo->teamid = $teamID;
		$sateam = new SATeam();
		$criteriaid = $sateam->getCriterialList($teamdetaildo->teamid);
		$teamdetaildo->criterionpartid = $criteriaid!=null ?  $criteriaid : 'Assign';
		$teamdetaildo->teamname = $teamName;
		$teamdetaildo->teamleadername = $username.' ' .  $surName;
		$teamdetaildo->locationID = $locationID;
		$teamdetaildo->location = $location;
		$teamdetailsarray[] = $teamdetaildo;
		unset($teamdetaildo);
		
	   }
	   $result->close();
	   $connection->close();
	  }
	  
	  catch(Exception $exception){
	   die($exception);
	  }
	  
	  return $teamdetailsarray;    
	}
	 
	
	public function getuniqueCriterialPartList(){
	  try{
	   
	   $criteriaarray = array();
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   $result = $connection->prepare(TeamConstants::CRITERIA_UNIQUE_PART_LIST);
	   $result->execute();
	   $result->bind_result($criterionPartID,$criterionPartShortDescription, $criterionPartDefinition);
	   while($result->fetch()){
		$criterialpardo = new CriteriaPartDO();
		$criterialpardo->criterionPartID = $criterionPartID;
		$criterialpardo->criterionPartShortDescription = $criterionPartShortDescription;
		$criterialpardo->criterionPartDefinition = $criterionPartDefinition;
		$criteriaarray[] = $criterialpardo; 
		unset($criterialpardo);
	   }
	   $result->close();
	   $connection->close();
	  }
	  catch(Excepttion $exception){
	   die($exception);
	  }
	  return $criteriaarray;
	 }
 
	public function getCriterialPartList(){
	  try{
	   
	   $criteriaarray = array();
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   $result = $connection->prepare(TeamConstants::CRITERIA_PART_LIST);
	   $result->execute();
	   $result->bind_result($criterionPartID,$criterionPartShortDescription, $criterionPartDefinition);
	   while($result->fetch()){
		$criterialpardo = new CriteriaPartDO();
		$criterialpardo->criterionPartID = $criterionPartID;
		$criterialpardo->criterionPartShortDescription = $criterionPartShortDescription;
		$criterialpardo->criterionPartDefinition = $criterionPartDefinition;
		$criteriaarray[] = $criterialpardo; 
		unset($criterialpardo);
	   }
	   $result->close();
	   $connection->close();
	  }
	  catch(Excepttion $exception){
	   die($exception);
	  }
	  return $criteriaarray;
	 }

	 public function getCriterialList($teamid){
	  
	  try{
	   $criteriaid = "";
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   $result = $connection->prepare(TeamConstants::SELECT_CRITERIA_PART);
	   $result->bind_param("i",$teamid);
	   $result->execute();
	   $result->bind_result($criterionPartShortDescription);
	   while($result->fetch()){
		$criteriaarray[] = $criterionPartShortDescription;
	   }
	   $result->close();
	   
	   if(count($criteriaarray) != 0){
		for($i = 0; $i < count($criteriaarray); $i++){
		 if($criteriaid == "")
		  $criteriaid = $criteriaarray[$i];
		 else
		  $criteriaid = $criteriaid.",".$criteriaarray[$i];
		}
	   }
	   $result->close();
	   $connection->close();
	  }
	  catch(Exception $exception){
	   die($exception);
	  }
	  return $criteriaid;   
	 }
 
 
 
 
	public function getCriteriaName($teamid){
		
		try{
			
			$criteria = "";
			
			$criteriapart = array();
			
			$database = new dbConnection();
			
			$connection = $database->getConnection();
			
			$result = $connection->prepare(TeamConstants::SELECT_CRITERIA_SHORT_PART);
			
			$result->bind_param("i",$teamid);
			
			$result->execute();
			
			$result->bind_result($criterionpartshortdescription);

			while($result->fetch()){
			
				$criteriapart[] = $criterionpartshortdescription; 
			}
			
			$result->close();
			
			$connection->close();

			
			for($i = 0; $i < count($criteriapart); $i++){
				if($criteria != ""){
					$criteria = $criteria .",".$criteriapart[$i]; 
				}
				else{
					$criteria = $criteriapart[$i];
				}
			}
		}
		catch(Exception $exception){
			die($exception);
		}
		
		return $criteria;
	}
	
	public function getRoleDetails($locationID){
		
		try{
			
			$userarray = array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(TeamConstants::SELECT_USERS_FOR_RESP);
			$result->bind_param("i",$locationID);
			$result->execute();
			$result->bind_result($username,$surname,$UserID);
			while($result->fetch()){
				$customerDO = new CustomerDO();
				$customerDO->userid = $UserID;
				$customerDO->username = $username. ' '.$surname;
				$userarray[] = $customerDO;
				//$userarray[] = $username;
			}
			$result->close();
			$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $userarray;
	}
	
	public function createProjectPlan(TeamAssessmentDO $teamassessmentdo){
  
	  try{
	   
		   $statusID = "";
		   $username = "";
		   $countMileStone=0;
		   $rowInserted = 0;
		   $milestone = $teamassessmentdo->milestone;
		   $activities = $teamassessmentdo->activity;
		   $reponsibility = $teamassessmentdo->accountability;
		   $duedate = $teamassessmentdo->duedate;
		   $status = $teamassessmentdo->status;
		   $locationID = intval($teamassessmentdo->locationID);
		   $location = $teamassessmentdo->location; 
		   
		   $database = new dbConnection();
		   $connection = $database->getConnection();
		   
		   $result = $connection->prepare(TeamConstants::SELECT_STATUS_VALUES);
		   $result->bind_param("s",$status);
		   $result->execute();
		   $result->bind_result($statusId);
		   while($result->fetch()){
				$statusID = $statusId;
		   }
		   $result->close();
		   
		   $connection = $database->getConnection();
		   $result = $connection->prepare(TeamConstants::CHK_PROJ_PLAN_EXISTS);
		   $result->bind_param("ss",$milestone, $activities);
		   $result->execute();
		   $result->bind_result($cntMileStone);
		   while($result->fetch()){
				$countMileStone = $cntMileStone;
		   }
		   $result->close();
		   if($countMileStone==0){
			   $result = $connection->prepare(TeamConstants::CREATE_PROJECT_PLAN);
			   $result->bind_param("ssisiis",$milestone, $activities, $reponsibility, $duedate, $statusID, $locationID, $location);
			   $result->execute();
			   $rowInserted = $result->affected_rows;
			   $result->close();
			   $connection->close();  
			}
	  }
	  catch(Exception $exception){
	   die($exception);
	  }
	  return $rowInserted;
	 }
	/*
	  public function updateProjectPlan(TeamAssessmentDO $teamassessmentdo){
  
		  try{
				$countMile=0;
				$rowInserted=0;
				$statusID="";
				$milestone = $teamassessmentdo->milestone;
				$activities = $teamassessmentdo->activity;
				$reponsibility = $teamassessmentdo->accountability;
				$duedate = $teamassessmentdo->duedate;
				$status = $teamassessmentdo->status;
				$activityID = $teamassessmentdo->activityID;
				$database = new dbConnection();
				$connection = $database->getConnection();
			   
				$result = $connection->prepare(TeamConstants::SELECT_STATUS_VALUES);
				$result->bind_param("s",$status);
				$result->execute();
				$result->bind_result($statusId);
				while($result->fetch()){
					$statusID = $statusId;
				`}
				$result->close();
				
			   $result = $connection->prepare(TeamConstants::UPDATE_PROJECT_PLAN);
			   $result->bind_param("ssisii",$milestone, $activities, $reponsibility, $duedate, $statusID, $activityID);
			   $result->execute();
			   $rowInserted = $result->affected_rows;
			   $result->close();
			   $connection->close();
				
		  }
		  catch(Exception $exception){
				die($exception);
		  }
		  return $rowInserted;
		 }
	 */
	 public function updateProjectPlan(TeamAssessmentDO $teamassessmentdo){
  
		  try{
			$countMile=0;
			$rowInserted=0;
			$milestone = $teamassessmentdo->milestone;
			$activities = $teamassessmentdo->activity;
			$reponsibility = $teamassessmentdo->accountability;
			$duedate = $teamassessmentdo->duedate;
			$status = $teamassessmentdo->status;
			$activityID = $teamassessmentdo->activityID;
			$database = new dbConnection();
			$connection = $database->getConnection();
		   
			$result = $connection->prepare(TeamConstants::SELECT_STATUS_VALUES);
			$result->bind_param("s",$status);
			$result->execute();
			$result->bind_result($statusId);
			while($result->fetch()){
				$statusID = $statusId;
			}
			$result->close();
		   
			$connection = $database->getConnection();
			$result = $connection->prepare(TeamConstants::CHK_PROJ_PLAN_EXISTS_WHILE_UPDATE);
			$result->bind_param("ssi",$milestone, $activities, $activityID);
			$result->execute();
			$result->bind_result($cntMileStone);
			while($result->fetch()){
				$countMileStone = $cntMileStone;
			}
			$result->close();
			if($countMileStone==0){
				$result = $connection->prepare(TeamConstants::UPDATE_PROJECT_PLAN);
				$result->bind_param("ssisii",$milestone, $activities, $reponsibility, $duedate, $statusID, $activityID);
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
	 
	 public function deleteProjectPlan($activityID){
	  
	  try{
	   
	  
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   $result = $connection->prepare(TeamConstants::DELETE_PROJECT_PLAN);
	   $result->bind_param("i",$activityID);
	   $result->execute();
	   $rowDeleted = $result->affected_rows;
	   $result->close();
	   $connection->close();
	   
	  }
	  catch(Exception $exception){
	   die($exception);
	  }
	  return $rowDeleted;
	 }
	 
	
	
	public function assignPartID($teamarray,$teamid){
  
		try{
	   
		   $database = new dbConnection();
		   $connection = $database->getConnection();
		   //$rowDeleted = 1;
		   //return  count($teamarray);;
		  
			$result = $connection->prepare(TeamConstants::DELETE_TEAM_ID);
			$result->bind_param("i",$teamid);
			$result->execute();
			$rowDeleted = $result->affected_rows;
			$result->close();
			

			
		   for($i = 0; $i < count($teamarray); $i++){
				
				$teamdo = new TeamDO();
				$teamdo = $teamarray[$i];
				$teamid = $teamdo->teamid;
				$criteriapartid = $teamdo->criteriaid;
				$remarks = "";
				
				
				$result = $connection->prepare(TeamConstants::INSERT_TEAM_CRITERIA_PART_ID);
				$result->bind_param("iis",$teamid, $criteriapartid,$remarks);
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
	 
	 
	public function selectTeamName($locationID){
	  
	  try{
	   
		
	   
	   $teamarray = array();
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   $result = $connection->prepare(TeamConstants::SELECT_TEAM_NAME);
	   $result->bind_param("i",$locationID);
	   $result->execute();
	   $result->bind_result($teamID, $teamName);
	   while($result->fetch()){
		$teamdo = new TeamDO();
		$teamdo->teamid = $teamID;
		$teamdo->teamname = $teamName;
		$teamarray[] = $teamdo;
	   }
	   $result->close();
	   $connection->close();   
	  }
	  catch(Exception $exception){
	   die($exception);
	  }
	  return $teamarray;
	  
	 }
	 
 
	 public function selectTeamMember($teamID){
	  
	  try{

	   
	   $teamarray = array();
	   $teamowner="";
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   $result = $connection->prepare(TeamConstants::SELECT_TEAM_MEMBER_DETAILS);
	   $result->bind_param("i",$teamID);
	   $result->execute();
	   $result->bind_result($userID, $teamID, $teamName, $userName, $surName, $designation, $loginName, $roleName);
	   $i=0;
	   while($result->fetch()){
	   $i++;
		$teamdo = new TeamDO();
		$teamdo->userid = $userID;
		$teamdo->teamid = $teamID;
		$teamdo->teamname = $teamName;
		$teamdo->userName = $userName;
		$teamdo->surName = $surName;
		$teamdo->designation = $designation;
		$teamdo->loginName = $loginName;
		$teamdo->roleName = $roleName;
		if($teamowner==""){
			$sateam=new SATeam();
			$teamowner=$sateam->selectTeamOwner($teamID);
		}
		$teamdo->teamowner=$teamowner;
		$teamarray[] = $teamdo;
	   }
	   if($i==0){
		if($teamowner==""){
			$sateam=new SATeam();
			$teamdo = new TeamDO();
			$teamdo->userid = '0';
			$teamdo->teamid = '0';
			$teamowner=$sateam->selectTeamOwner($teamID);
			$teamdo->teamowner=$teamowner;
			$teamarray[] = $teamdo;
		}
	   }
	   $result->close();
	   $connection->close();
	  }
	  catch(Exception $exception){
	   die($exception);
	  }
	  return $teamarray;
	 }
	 public function selectTeamOwner($teamID){
		try{
			$teamarray = array();
			$teamowner="";
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(TeamConstants::SELECT_TEAM_OWNER);
			$result->bind_param("i",$teamID);
			$result->execute();
			$result->bind_result($userID, $userName, $surName);
			while($result->fetch()){
				$teamOwner=$userName.' '.$surName;
			}
			$result->close();
			$connection->close();
	   }
	   catch(Exception $exception){
			die($exception);
	   }
	   return $teamOwner;
	}
	 /*
	 public function unselectTeamMemeber($teamID){
  
	  try{
	   
	   if($teamID != null){
		$teamID = '%'.$teamID.'%';
	   }
	   else{
		$teamID = '%';
	   }
	   
	   $teamarray = array();
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   $result = $connection->prepare(TeamConstants::UNSELECT_TEAM_MEMBERS);
	   $result->bind_param("i",$teamID);
	   $result->execute();
	   $result->bind_result($userID, $userName, $surName,$designation,$roleName);
	   while($result->fetch()){
		$teamdo = new TeamDO();
		$teamdo->userid = $userID;
		$teamdo->userName = $userName;
		$teamdo->surName = $surName;
		$teamdo->designation = $designation;
		$teamdo->roleName = $roleName;
		$teamarray[] = $teamdo;
	   }
	   $result->close();
	   $connection->close();
	  }
	  catch(Exception $exception){
	   die($exception);
	  }
	  return $teamarray;
	 }
	 */
	 public function unselectTeamMemeber($teamName){
  
	  try{
	   $teamarray = array();
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   
	   $result = $connection->prepare(TeamConstants::SELECT_LOCATION_FOR_TEAM);
	   $result->bind_param("s",$teamName);
	   $result->execute();
	   $result->bind_result($locID);
	   while($result->fetch()){
			$locationID=$locID;
	   }
	  
	   $result = $connection->prepare(TeamConstants::UNSELECT_TEAM_MEMBERS);
	   $result->bind_param("i",$locationID);
	   $result->execute();
	   $result->bind_result($userID, $userName, $surName,$designation,$roleName,$locationID, $location);
	   while($result->fetch()){
		$teamdo = new TeamDO();
		$teamdo->userid = $userID;
		$teamdo->userName = $userName;
		$teamdo->surName = $surName;
		$teamdo->designation = $designation;
		$teamdo->roleName = $roleName;
		$teamdo->locationID = $locationID;
		$teamdo->location = $location;
		$teamarray[] = $teamdo;
	   }
	   $result->close();
	   $connection->close();
	  }
	  catch(Exception $exception){
	   die($exception);
	  }
	  return $teamarray;
	 }
	public function assignTeamMember($teamarray){
  
	  try{
	   
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	  // return "test ".count($teamarray);
	   for($i = 0; $i < count($teamarray); $i++){
		
			$teamdo = new TeamDO();
			$teamdo = $teamarray[$i];
			$remarks = '';
			$teamID = $teamdo->teamid;
			$userID = $teamdo->userid;
			 
			$result = $connection->prepare(TeamConstants::INSERT_TEAM_MEMBERS);
			$result->bind_param("iis",$teamID, $userID, $remarks);
			$result->execute();
			$rowInserted = $result->affected_rows;
			$result->close();
			if($rowInserted!=0){
				$result = $connection->prepare(TeamConstants::UPDATE_TEAM_USER);
				$result->bind_param("ii",$teamID, $userID);
				$result->execute();
				//$rowUpdated = $result->affected_rows;
				$result->close();
			}
		
	   }
	   
	   $connection->close();
	  }
	  catch(Exception $exception){
	   die($exception);
	  }
	  return $rowInserted;
	 }
	 
	public function searchTeamName($teamname, $teamleader){
  
	  try{
	   
	   if($teamname != null)
		$teamname = '%'.$teamname.'%';
	   else
		$teamname = '%';
	   
	   if($teamleader != null)
		$teamleader = '%'.$teamleader.'%';
	   else
		$teamleader = '%'; 
	   
	   $teamarray = array();
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   $result = $connection->prepare(TeamConstants::SELECT_TEAM_DETAILS_INFO);
	   $result->bind_param("ss",$teamname,$teamleader);
	   $result->execute();
	   
	   $result->bind_result($teamID, $teamName, $userID, $userName);
	   while($result->fetch()){
		$teamdo = new TeamDO();
		$teamdo->teamid = $teamID;
		$teamdo->teamname = $teamName;
		$teamdo->userid = $userID;
		$teamdo->userName = $userName;
		$teamarray[] = $teamdo;
		unset($teamdo);
	   }
	   $result->close();
	   $connection->close();
	  }
	  catch(Exception $exception){
	   die($exception);
	  }
	  return $teamarray;
	 }
	 
	 /*
	public function selectSubAssessment($CriterionPartID){
  
	  try{
	   
	   $teamarray = array();
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   $result = $connection->prepare(TeamConstants::SELECT_SUB_TEAMASSESSMENT);
	   $result->bind_param("s",$CriterionPartID);
	   $result->execute();
	   $result->bind_result($enablerID, $criterionPartID, $approachTitle, $approachDescription, $score, $status, $missing);
	   while($result->fetch()){
		$enablerassessmendo = new EnablerAssessmentDO();
		$enablerassessmendo->enablerID = $enablerID;
		$enablerassessmendo->criteriaID = $criterionPartID;
		$enablerassessmendo->approachTitle = $approachTitle;
		$enablerassessmendo->approachdesc = $approachDescription;
		$enablerassessmendo->score = $score;
		$enablerassessmendo->status = $status;
		
		if($missing == 1){
		 $enablerassessmendo->missing = 'Yes';
		}else{
		 $enablerassessmendo->missing = 'No';
		}
		//$enablerassessmendo->missing = $missing;
		
		$subteamarray[] = $enablerassessmendo;
		unset($enablerassessmendo);
	   }
	   $result->close();
	   $connection->close();
	  }
	  catch(Exception $exception){
	   die($exception);
	  }
	  return $subteamarray;
	 }*/
	 
	public function selectSubAssessment($locationID,$criteriaID){
  
		  try{
		   
		   $subteamarray = array();
		   $sateam1 = new SATeam();
		   $recordsDeleted=$sateam1->deleteAllNullEnablerDocuments();
		   $database = new dbConnection();
		   $connection = $database->getConnection();
		   $result = $connection->prepare(TeamConstants::SELECT_SUB_TEAMASSESSMENT);
		   $result->bind_param("si",$criteriaID,$locationID);
		   $result->execute();
		   $result->bind_result($dummyEnablerID,$enablerID,$criterionPartID,$approachTitle, $approachDescription,$CriterionPartShortDescription,$exampleofapproach, $deployment,$examplesofdeployment,$assessmentandreview,$examplesofassessmentreview, $sourceofinformation,$soundrational,$integrated, $implemented,$systematic, $measurement,$learning,$improvement,$strength,$areaforimprovement,$teamtype,$score,$systemgeneratedscore,$presented,$directrelavancetodelivering, $relevancetothiscriterionpart,$approachtolink,$status, $enablerdocument,$missing,$locationID,$location);
		   $average_Result = 0;
		   $owner="";
		   while($result->fetch()){
			
			$enablerassessmendo = new EnablerAssessmentDO();
			
			
			$enablerassessmendo->enablerID = $enablerID;
			$enablerassessmendo->dummyEnablerID = $dummyEnablerID;
			
			$enablerassessmendo->criteriaID = $CriterionPartShortDescription . '(' . $dummyEnablerID . ')';
			$sateam = new SATeam();
			
			$enablerApproachLinkTo=$sateam->getEnablerLinkToApproach($enablerID,$criterionPartID);
			$enablerassessmendo->approachtolink=$enablerApproachLinkTo!=null ? $enablerApproachLinkTo : "Link";
			
			$otherApproachLinkTo=$sateam->getOtherEnablerLinkToApproach($enablerID,$criterionPartID);
			$enablerassessmendo->otherapproachlinkto=$otherApproachLinkTo!=null ? $otherApproachLinkTo : "None";
			
			$enablerassessmendo->approachTitle = $approachTitle;
			$enablerassessmendo->approachdesc = $approachDescription;
			$enablerassessmendo->exampleofapproach = $exampleofapproach;
			$enablerassessmendo->deployment = $deployment;
			$enablerassessmendo->examplesofdeployment = $examplesofdeployment;
			$enablerassessmendo->assessmentandreview = $assessmentandreview;
			$enablerassessmendo->examplesofassessmentreview = $examplesofassessmentreview;
			$enablerassessmendo->sourceofinformation = $sourceofinformation;
			$enablerassessmendo->soundrational = $soundrational;
			$enablerassessmendo->integrated = $integrated;
			$enablerassessmendo->implemented = $implemented;
			$enablerassessmendo->systematic = $systematic;
			$enablerassessmendo->measurement = $measurement;
			$enablerassessmendo->learning = $learning;
			$enablerassessmendo->improvement = $improvement;
			$enablerassessmendo->strength = $strength;
			$enablerassessmendo->areaforimprovement = $areaforimprovement;
			$enablerassessmendo->teamtype = $teamtype;
			$enablerassessmendo->score = $score;
			$enablerassessmendo->systemgeneratedscore = $systemgeneratedscore;
			$enablerassessmendo->presented = $presented;
			$enablerassessmendo->directrelavancetodelivering = $directrelavancetodelivering;
			$enablerassessmendo->relevancetothiscriterionpart = $relevancetothiscriterionpart;
			$enablerassessmendo->type = "";
			$enablerassessmendo->status = $status;
			$enablerassessmendo->enablerdocument = $enablerdocument;
			$enablerassessmendo->enablerdocument = $enablerdocument;
			
			if($owner==""){
				$sateam=new SATeam();
				$owner = $sateam->SelectCriteriaOwner($criteriaID);
			}
			$enablerassessmendo->owner = $owner;
			
			if($missing == 1){
			 $enablerassessmendo->missing = 'Yes';
			}else{
			 $enablerassessmendo->missing = 'No';
			}
			
			
			if($average_Result==0){
			  $average_Result = $enablerassessmendo->score;
			 }
			 else{
				$average_Result = $average_Result+$enablerassessmendo->score;
			 }
		    $enablerassessmendo->average = $average_Result;
			$enablerassessmendo->locationID = $locationID;
			$enablerassessmendo->location = $location;
			$subteamarray[] = $enablerassessmendo;
			unset($enablerassessmendo);
		  }
		   
		   $result->close();
		   $connection->close();
		  }
		  catch(Exception $exception){
		   die($exception);
		  }
		  return $subteamarray;
	}
	 
	 public function removeTeamMemeber($teamarray){
  
	  try{
	   
	   
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   
	   for($i = 0; $i < count($teamarray); $i++){
		
		$teamdo = new TeamDO();
		$teamdo = $teamarray[$i];
		
		$teamID = $teamdo->teamid;
		$userID = $teamdo->userid;
		//return $teamID."sdf".$userID;
		$result = $connection->prepare(TeamConstants::DELETE_TEAM_MEMBERS);
		$result->bind_param("ii",$teamID, $userID);
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
	 /*
	 public function UpdateTeam(TeamDO $inteamdo){
   
	  $teamid = $inteamdo->teamid; 
	  $oldteamowner = $inteamdo->teamowner;
	  $newteamowner = $inteamdo->userName;
	  $olduserid = "";
	  $newuserid = "";
	 
	  try{
	   
	   $useridarray = array();
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   
	   $result = $connection->prepare(TeamConstants::SELECT_USERNAME);
	   $result->bind_param("s",$oldteamowner);
	   $result->execute();
	   $result->bind_result($userID);
	   while($result->fetch()){
		$olduserid = $userID; 
	   }
	   $result->close();
	  
	   $result = $connection->prepare(TeamConstants::SELECT_USERNAME);
	   $result->bind_param("s",$newteamowner);
	   $result->execute();
	   $result->bind_result($userID);
	   while($result->fetch()){
		$newuserid = $userID; 
	   }
	   $result->close();
	   
	   $result = $connection->prepare(TeamConstants::UPDATE_TEAM_DETAILS);
	   $result->bind_param("iii",$newuserid, $olduserid, $teamid);
	   $result->execute();
	   $rowUpdated = $result->affected_rows;
	   $result->close();
	   // return $teamid."oldteamowner".$oldteamowner."newteamowner".$newteamowner;
	   $connection->close();
	  }
	  catch(Exception $exception){
	   die($exception);
	  }
	  return $rowUpdated;
	 }
	 */
	  public function UpdateTeam(TeamDO $inteamdo){
   
	  $teamid = $inteamdo->teamid; 
	  $newteamowner = intval($inteamdo->teamowner);
	  $teamname=$inteamdo->teamname;
	  $locationID=intval($inteamdo->locationID); 
	  $location=$inteamdo->location; 
	  /*
	  $newteamowner = $inteamdo->userName;
	  $olduserid = "";
	  $newuserid = "";
	  */
	 
	  try{
	   
	   $useridarray = array();
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   
	   $result = $connection->prepare(TeamConstants::UPDATE_TEAM_DETAILS);
	   $result->bind_param("isisi",$newteamowner,$teamname, $locationID, $location, $teamid);
	   $result->execute();
	   $rowUpdated = $result->affected_rows;
	   $result->close();
	   // return $teamid."oldteamowner".$oldteamowner."newteamowner".$newteamowner;
	   $connection->close();
	  }
	  catch(Exception $exception){
	   die($exception);
	  }
	  return $rowUpdated;
	 }
	 /*
	public function removeTeam($teamid, $teamleader){
  
		  try{
		   
		   $userid = "";
		   $database = new dbConnection();
		   $connection = $database->getConnection();
		   $result = $connection->prepare(TeamConstants::SELECT_USERNAME);
		   $result->bind_param("s",$teamleader);
		   $result->execute();
		   $result->bind_result($userID);
		   while($result->fetch()){
			$userid = $userID; 
		   }
		   $result->close();
		  
		   $result = $connection->prepare(TeamConstants::REMOVE_TEAM_NAME);
		   $result->bind_param("ii",$teamid, $userid);
		   $result->execute();
		   $rowDeleted = $result->affected_rows;
		   $result->close();
		   $connection->close();   
		  }
		  catch(Exception $exception){
		   die($exception);
		  }
		  return $rowDeleted;
	}
	
	*/
	public function removeTeam($teamid){
		try{
		  $database = new dbConnection();
		    $countcriteriaid = "";
		   $teamresultid = "";
		   
		   $connection = $database->getConnection();
		   
		    
			if($teamid != ''){
			
				$result = $connection->prepare(CustomerConstants::GET_CRITERION_PART_TEAM_MEMBER);
				$result->bind_param("i",$teamid);
				$result->execute();
				$result->bind_result($countCriteriaID,$teamResultID);
				while($result->fetch()){
					$countcriteriaid = $countCriteriaID;
					$teamresultid = $teamResultID;
				}
				$result->close();
				
				if($countcriteriaid == 0){
					$result = $connection->prepare(CustomerConstants::DELETE_TEAM_MEMBER_LIST);
					$result->bind_param("i",$teamid);
					$result->execute();
					$rowUpdated = $result->affected_rows;
					$result->close();
					$result = $connection->prepare(CustomerConstants::DELETE_TEAM);
					$result->bind_param("i",$teamid);
					$result->execute();
					$rowUpdated = $result->affected_rows;
					$result->close();
					$result = $connection->prepare(TeamConstants::UPDATE_TEAM_USER_AS_NULL);
					$result->bind_param("i",$teamid);
					$result->execute();
					$rowModified = $result->affected_rows;
					$result->close();
						
				}
			}
			else{
				$rowUpdated = 0;
			}
			   
			
		   $connection->close();
	   }
	  catch(Exception $exception){
	   die($exception);
	  }
	  return $rowUpdated;
	}
	
	/*public function createSubTeamAssessment(EnablerAssessmentDO $enabledassessmentdo){
  
	  try{
	   $enablerID = $enabledassessmentdo->enablerID;
	   $criterionPartID = $enabledassessmentdo->criteriaID;
	   $approachTitle = $enabledassessmentdo->approachTitle;
	   $missing = $enabledassessmentdo->missing;
	  
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   $result = $connection->prepare(TeamConstants::INSERT_SUB_TEAMASSESSMENT);
	   $result->bind_param("isss",$enablerID,$criterionPartID,$approachTitle,$missing);
	   $result->execute();
	   $rowInserted = $result->affected_rows;
	   $result->close();
	   $connection->close();
	  }
	  catch(Exception $exception){
	   die($exception);
	  }
	  
	  return $rowInserted;
	 } */
	 
		
		 public function insertEnablerAssessment(EnablerAssessmentDO $enablerdo){
  
			  try{
			   
			   $criteriaid = $enablerdo->criteriaID;
			   $critID = intval($enablerdo->criteriaID);
			   $approachtitle = $enablerdo->approachTitle;
			   $locationID = $enablerdo->locationID;
			   $location = $enablerdo->location;
			   $approachdescription = '';
			   $examplesofapproach = '';
			   $deployment = '';
			   $examplesofdeployment = '';
			   $assessmentandreview = '';
			   $examplesofassessmentReview = '';
			   $sourceofinformation = '';
			   $soundrational = '';
			   $integrated = '';
			   $implemented = '';
			   $systematic = '';
			   $measurement = '';
			   $learning = '';
			   $improvement = '';
			   $strength = '';
			   $areaforimprovement = '';
			   $teamtype = '';
			   $score = 0.0;
			   $systemgeneratedscore = '';
			   $presented = '';   
			   $directrelavancetodelivering = '';
			   $relevancetothiscriterionpart = '';
			   $approachtolink = 'Link';
			   $status = '';
			   $enablerdocument = '';
			   $missing = $enablerdo->missing;
			   
			   $database = new dbConnection();
			   $connection = $database->getConnection();
			   
			   $enablerassessmentid = 0;
			   
			   $result = $connection->prepare(TeamConstants::SELECT_MAX_DUMMY_ENABLER_ID);
			   $result->bind_param("s",$critID);
			   $result->execute();
			   $result->bind_result($dummyenablerid);
			   while($result->fetch()){
					$dummyenablerassessmentid = $dummyenablerid;
			   }
			   $result->close();
			   
			  // return $criteriaid.$approachtitle.$missing;
			   
			   
			   if($dummyenablerassessmentid == 0){
					$dummyenablerassessmentid = 1;
			   }
			   else{
				$dummyenablerassessmentid = $dummyenablerassessmentid + 1; 
			   }
			   
			   $result = $connection->prepare(TeamConstants::INSERT_ENABLER_ASSESSMENT);
			   $result->bind_param("issssssssssssssssssdssssssissis",$dummyenablerassessmentid,$criteriaid,$approachtitle,$approachdescription, $examplesofapproach, $deployment,$examplesofdeployment, $assessmentandreview,$examplesofassessmentReview,$sourceofinformation,$soundrational,$integrated,$implemented,$systematic,$measurement, $learning,$improvement,$strength,$areaforimprovement,$teamtype,$score, $systemgeneratedscore,$presented,$directrelavancetodelivering, $relevancetothiscriterionpart,$approachtolink,$status, $enablerdocument,$missing,$locationID,$location);
			   $result->execute();
			   $rowInserted = $result->affected_rows;
			   $result->close();
			   
			   
			   if($rowInserted == 1){
				
					$exeteamenablerasementid = 0;
					
					$result = $connection->prepare(TeamConstants::SELECT_ENABLER_ID);
					$result->bind_param("si",$critID,$dummyenablerassessmentid);
					$result->execute();
					$result->bind_result($enablerid);
				    while($result->fetch()){
						$enablerassessmentid = $enablerid;
				    }
					$result->close();
					
					
					$result = $connection->prepare(TeamConstants::UPDATE_DOCUMENT_ENABLER_ID);
					$result->bind_param("i",$enablerassessmentid);
					$result->execute();
					$rowInserted = $result->affected_rows;
					$result->close();
					
					$result = $connection->prepare(TeamConstants::SELECT_MAX_EXE_TEAM_ENABLER_ID);
					$result->execute();
					$result->bind_result($enablerid);
					while($result->fetch()){
					 $exeteamenablerasementid = $enablerid;
					}
					$result->close();
					
					if($exeteamenablerasementid == 0){
					 $exeteamenablerasementid = 1;
					}
					else{
					 $exeteamenablerasementid = $exeteamenablerasementid + 1;
					}
					
					$result = $connection->prepare(TeamConstants::INSERT_EXE_TEAM_ENABLER_ASSESSMENT);
					$result->bind_param("iisssssssssssssssssssdssssssis",$exeteamenablerasementid,$enablerassessmentid,$criteriaid,$approachtitle,$approachdescription, $examplesofapproach, $deployment,$examplesofdeployment, $assessmentandreview,$examplesofassessmentReview,$sourceofinformation,$soundrational,$integrated,$implemented,$systematic,$measurement, $learning,$improvement,$strength,$areaforimprovement,$teamtype,$score, $systemgeneratedscore,$presented,$directrelavancetodelivering, $relevancetothiscriterionpart,$approachtolink,$enablerdocument,$locationID,$location);
					$result->execute();
					$rowInserted  = $result->affected_rows;
					$result->close();
				   
				    
				    $result = $connection->prepare(TeamConstants::SELECT_CRITERION_DETAILS);
					$result->bind_param("i",$critID);
					$result->execute();
					$result->bind_result($CriterionPartShortDescription,$CriterionID,$MaxPoints,$CPFactor);
					while($result->fetch()){
						$critPartShortDesc = $CriterionPartShortDescription;
						$criteria = $CriterionID;
						$maxpts = $MaxPoints;
						$cpfact = $CPFactor;
					}
					$result->close();
					$countCriteriScore = 0;
					$result = $connection->prepare(TeamConstants::CHK_CRITERION_PART_SCORE);
					$result->bind_param("ii",$critID,$locationID);
					$result->execute();
					$result->bind_result($cntCriterionID);
					while($result->fetch()){
						$countCriteriScore = $cntCriterionID;
					}
					$result->close();
					
					
					
					if($critPartShortDesc !=null && $critPartShortDesc != '' && $countCriteriScore==0){
						
						$result = $connection->prepare(TeamConstants::INSERT_CRITERION_PART_SCORE);
						$result->bind_param("isiddi",$critID,$critPartShortDesc,$criteria,$maxpts,$cpfact,$locationID);
						//return $critID.' - '.$critPartShortDesc.' - '.$criteria.' - '.$maxpts.' - '.$cpfact.' - '.$locationID;
						$result->execute();
						$rowIns  = $result->affected_rows;
						$result->close();
					}
				}
				$connection->close();
			  }
			  catch(Exception $exception){
			   die($exception);
			  }
			  return $rowInserted;
			 }
			 
			 
		public function updateEnablerAssessment(EnablerAssessmentDO $enablerdo){
  
		  try{
		  $rowInserted=0;
		   $enablerid = $enablerdo->enablerID;
		   $criteriaid = $enablerdo->criteriaID;
		   $approachtitle = $enablerdo->approachTitle;
		   $approachdescription = $enablerdo->approachdesc;
		   $examplesofapproach = '';
		   $deployment = $enablerdo->deployment;
		   $examplesofdeployment = '';
		   $assessmentandreview = $enablerdo->assessmentandreview;
		   $examplesofassessmentReview = '';
		   $sourceofinformation = $enablerdo->sourceofinformation;
		   $soundrational = $enablerdo->soundrational;
		   $integrated = $enablerdo->integrated;
		   $implemented = $enablerdo->implemented;
		   $systematic = $enablerdo->systematic;
		   $measurement = $enablerdo->measurement;
		   $learning = $enablerdo->learning;
		   $improvement = $enablerdo->improvement;
		   $strength = $enablerdo->strength;
		   $areaforimprovement = $enablerdo->areaforimprovement;
		   $teamtype = '';
		   $score = $enablerdo->score;
		   $systemgeneratedscore = $enablerdo->systemgeneratedscore;
		   $presented = '';   
		   $directrelavancetodelivering = $enablerdo->directrelavancetodelivering;
		   $relevancetothiscriterionpart = $enablerdo->relevancetothiscriterionpart;
		   $approachtolink = '';
		   $status = 0;
		   $enablerdocument = '';
		   $missing = $enablerdo->missing;
		   
		   $database = new dbConnection();
		   $connection = $database->getConnection();
		   
		   $enablerassessmentid = 0;
		   
		   $result = $connection->prepare(TeamConstants::UPDATE_ENABLER_ASSESSMENT);
		   $result->bind_param("ssssssssssssssssssdsssssssssi",$criteriaid,$approachtitle,$approachdescription, $examplesofapproach, $deployment,$examplesofdeployment, $assessmentandreview,$examplesofassessmentReview,$sourceofinformation,$soundrational,$integrated,$implemented,$systematic,$measurement, $learning,$improvement,$strength,$areaforimprovement,$teamtype,$score, $systemgeneratedscore,$presented,$directrelavancetodelivering, $relevancetothiscriterionpart,$approachtolink,$status, $enablerdocument,$missing,$enablerid);
		   $result->execute();
		   $rowInserted = $result->affected_rows;
		   $result->close();
		   
		   if($rowInserted == 1){
			$exeteamenablerasementid = 2;
			$result = $connection->prepare(TeamConstants::UPDATE_EXE_TEAM_ENABLER_ASSESSMENT);
			$result->bind_param("isssssssssssssssssssdsssssss",$enablerid,$criteriaid,$approachtitle,$approachdescription, $examplesofapproach, $deployment,$examplesofdeployment, $assessmentandreview,$examplesofassessmentReview,$sourceofinformation,$soundrational,$integrated,$implemented,$systematic,$measurement, $learning,$improvement,$strength,$areaforimprovement,$teamtype,$score, $systemgeneratedscore,$presented,$directrelavancetodelivering, $relevancetothiscriterionpart,$approachtolink,$enablerdocument,$approachtitle);
			$result->execute();
			$rowInserted  = $result->affected_rows;
			$result->close();
		   }
		   $connection->close();
		  }
		  catch(Exception $exception){
		   die($exception);
		  }
		  return $rowInserted;
		 }
		 
		 
		 
		 //Result Assessment
		 
		  public function insertResultAssessment(ResultAssessmentDO $resultassessmentdo){
  
			  try{
			  
		   $criteriaid = $resultassessmentdo->criteriaID;
		   $critID = intval($resultassessmentdo->criteriaID);
		   $locationID=$resultassessmentdo->locationID;
		   $location=$resultassessmentdo->location;
		   //return $criteriaid;
		   $result_Name = $resultassessmentdo->result_name;
		   $presented = $resultassessmentdo->presented;
		   $resultstolink = "Link";
		   
			   $database = new dbConnection();
			   $connection = $database->getConnection();
			   $result = $connection->prepare(TeamConstants::SELECT_DUMMY_RESULT_ASSESSMENT_ID);
			   $result->bind_param("s",$critID);
			   $result->execute();
			   $result->bind_result($dummyresultassessmentid);
			   while($result->fetch()){
				$dummyresultid = $dummyresultassessmentid;
			   }
			   $result->close();
			   
			   if($dummyresultid == 0){
				$dummyresultid = 1;
			   }
			   else{
				$dummyresultid = $dummyresultid + 1;
			   }
			   
			   $result->close();
			   $result = $connection->prepare(TeamConstants::INSERT_RESULT_ASSESSMENT);
			   $result->bind_param("issssis",$dummyresultid, $criteriaid,$result_Name,$presented,$resultstolink,$locationID,$location);
			   $result->execute();
			   $rowInserted = $result->affected_rows;
			   $result->close();
			   
				   

			   if($rowInserted == 1){
				
				$result = $connection->prepare(TeamConstants::SELECT_RESULT_ASSESSMENT_ID);
				$result->bind_param("si",$critID,$dummyresultid);
			   $result->execute();
			   $result->bind_result($resultassessmentid);
			   while($result->fetch()){
					$resultid = $resultassessmentid;
			   }
			   $result->close();
				
			   
			    $result = $connection->prepare(TeamConstants::UPDATE_DOCUMENT_RESULT_ID);
			    $result->bind_param("i",$resultid);
			    $result->execute();
			    $rowInserted = $result->affected_rows;
			    $result->close();

			   $result = $connection->prepare(TeamConstants::SELECT_EXE_TEAM_RESULT_ASSESSMENT);
			   $result->execute();
			   $result->bind_result($resultassessmentid);
			   while($result->fetch()){
				$exeteamresultAssessmentID = $resultassessmentid;
			   }
			   $result->close();
			   
			   if($exeteamresultAssessmentID == 0){
				$exeteamresultAssessmentID = 1;
			   }
			   else{
				$exeteamresultAssessmentID = $exeteamresultAssessmentID + 1;
			   }
			   
			   $result = $connection->prepare(TeamConstants::INSERT_EXE_TEAM_RESULT_ASSESSMENT);
			   $result->bind_param("iissssis",$exeteamresultAssessmentID,$resultid,$criteriaid,$result_Name,$presented,$resultstolink,$locationID,$location);
			   $result->execute();
			   $rowInserted = $result->affected_rows;
			   $result->close();
			   
			   
			   
			   $result = $connection->prepare(TeamConstants::SELECT_CRITERION_DETAILS);
					$result->bind_param("i",$critID);
					$result->execute();
					$result->bind_result($CriterionPartShortDescription,$CriterionID,$MaxPoints,$CPFactor);
					while($result->fetch()){
						$critPartShortDesc = $CriterionPartShortDescription;
						$criteria = $CriterionID;
						$maxpts = $MaxPoints;
						$cpfact = $CPFactor;
					}
					$result->close();
					$countCriteriScore = 0;
					$result = $connection->prepare(TeamConstants::CHK_CRITERION_PART_SCORE);
					$result->bind_param("ii",$critID,$locationID);
					$result->execute();
					$result->bind_result($cntCriterionID);
					while($result->fetch()){
						$countCriteriScore = $cntCriterionID;
					}
					$result->close();
					
					
					
					if($critPartShortDesc !=null && $critPartShortDesc != '' && $countCriteriScore==0){
						$result = $connection->prepare(TeamConstants::INSERT_CRITERION_PART_SCORE);
						$result->bind_param("isiddi",$critID,$critPartShortDesc,$criteria,$maxpts,$cpfact,$locationID);
						$result->execute();
						$rowInserted  = $result->affected_rows;
						$result->close();
					}
			  }
			  
			   
			   $connection->close();
	  }
	  catch(Exception $exception){
	   die($exception);
	  }
	  return $rowInserted;
	 }
				 
	public function selectResultAssessment($locationID,$criterionpartid){
  
	   try{
		
		$teamarray = array();
		$sateam1 = new SATeam();
	    $recordsDeleted=$sateam1->deleteAllNullResultDocuments();
		$database = new dbConnection();
		$connection = $database->getConnection();
		$result = $connection->prepare(TeamConstants::SELECT_RESULT_ASSESSMENT);
		$result->bind_param("si",$criterionpartid,$locationID);
		$result->execute();
		
		$result->bind_result($dummyResultID,$ResultAssessmentID,$CriterionPartID,$Result,$ResultSegments,$criterionPartShortDescription,$SourceOfInformation,$Scope,$Segmentation,$Integrity,$Trends,$Targets,$Comparisons,$Causes,$Strength,$AreasForImprovement,$Score,$TeamType,$SystemGeneratedScore,$DirectRelavanceToDelivering,$RelevanceToThisCriterionPart,$Presented,$ResultsToLink,$ResultDocument,$locationID,$location);
		$average_Result= 0;
		$owner="";
		while($result->fetch()){
		 
		 $resultassessmendo = new ResultAssessmentDO();
		 
		 $resultassessmendo->resultassessmentid = $ResultAssessmentID;
		 $resultassessmendo->dummyResultID = $dummyResultID;
		 $resultassessmendo->criteriaID = $criterionPartShortDescription . '(' . $dummyResultID . ')';
		 
		 $sateam = new SATeam();
			
		$resultApproachLinkTo=$sateam->getEnablerLinkToApproach($ResultAssessmentID,$CriterionPartID);
		$resultassessmendo->approachtolink=$resultApproachLinkTo!=null ? $resultApproachLinkTo : "Link";
		
		$otherApproachLinkTo=$sateam->getOtherEnablerLinkToApproach($ResultAssessmentID,$CriterionPartID);
		$resultassessmendo->otherapproachlinkto=$otherApproachLinkTo!=null ? $otherApproachLinkTo : "None";
		
		 $resultassessmendo->approachTitle = $Result;
		 $resultassessmendo->result_name = $Result;
		 $resultassessmendo->resultsegments = $ResultSegments;
		 $resultassessmendo->sourceofinformation = $SourceOfInformation;
		 $resultassessmendo->scope = $Scope;
		 $resultassessmendo->segmentation = $Segmentation;
		 $resultassessmendo->integrity = $Integrity;
		 $resultassessmendo->trends = $Trends;
		 $resultassessmendo->targets = $Targets;
		 $resultassessmendo->comparisons = $Comparisons;
		 $resultassessmendo->causes = $Causes;
		 $resultassessmendo->strength = $Strength;
		 $resultassessmendo->areasforimprovement = $AreasForImprovement;
		 $resultassessmendo->score = $Score;
		 $resultassessmendo->teamtype = $TeamType;
		 $resultassessmendo->systemgeneratedscore = $SystemGeneratedScore;
		 $resultassessmendo->directrelavancetodelivering = $DirectRelavanceToDelivering;
		 $resultassessmendo->relevancetothiscriterionpart = $RelevanceToThisCriterionPart;
		 $resultassessmendo->flag=false;
		 $resultassessmendo->type="";
		 //$resultassessmendo->otherapproachlinkto="None";
		 if($Presented == 1){
		  $resultassessmendo->presented = 'Yes';
		 }else{
		  $resultassessmendo->presented = 'No';
		 }
		 $resultassessmendo->missing =  $resultassessmendo->presented;
		 //$resultassessmendo->approachTitle = $resultassessmendo->result_name;
		
		 $resultassessmendo->resultstolink = $ResultsToLink;
		 $resultassessmendo->resultdocument = $ResultDocument;
		// $resultassessmendo->approachtolink = $resultassessmendo->resultstolink;
		 
		 
		 if($average_Result==0){
		  $average_Result = $resultassessmendo->score;
		 }
		 else{
			$average_Result = $average_Result+$resultassessmendo->score;
		 }
		 $resultassessmendo->average = $average_Result;
		 $resultassessmendo->locationID = $locationID;
		 $resultassessmendo->location = $location;
		 if($owner==""){
			$sateam=new SATeam();
			$owner = $sateam->SelectCriteriaOwner($criterionpartid);
		}
		$resultassessmendo->owner = $owner;
		 $teamarray[] = $resultassessmendo;
		 unset($resultassessmendo);
		}
		
		$result->close();
		$connection->close();
	   }
	   catch(Exception $exception){
		die($exception);
	   }
	   return $teamarray;
	  }
		 
	  public function updateResultAssessment(ResultAssessmentDO $resultassessmentdo){

	  try{
	   
	   $CriterionPartID = $resultassessmentdo->criteriaID;
	   $Result = $resultassessmentdo->result_name;
	   $ResultAssessmentID = $resultassessmentdo->resultassessmentid;
	   $ResultSegments = $resultassessmentdo->resultsegments;
	   $SourceOfInformation = $resultassessmentdo->sourceofinformation;
	   $Scope = $resultassessmentdo->scope;
	   $Segmentation = $resultassessmentdo->segmentation;
	   $integrity=$resultassessmentdo->integrity;
	   $Trends = $resultassessmentdo->trends;
	   $Targets = $resultassessmentdo->targets;
	   $Comparisons = $resultassessmentdo->comparisons;
	   $Causes = $resultassessmentdo->causes;
	   $Strength = $resultassessmentdo->strength;
	   $AreasForImprovement = $resultassessmentdo->areasforimprovement;
	   $Score = $resultassessmentdo->score;
	   $TeamType = $resultassessmentdo->teamtype;
	   $SystemGeneratedScore = $resultassessmentdo->systemgeneratedscore;
	   $DirectRelavanceToDelivering = $resultassessmentdo->directrelavancetodelivering;
	   $RelevanceToThisCriterionPart = $resultassessmentdo->relevancetothiscriterionpart;
	   $Presented = $resultassessmentdo->presented;
	   $ResultsToLink = 'Link';
	   $ResultDocument = '0';
	   //return $CriterionPartID.$Result.$ResultSegments.$SourceOfInformation.$Scope.$Segmentation.$Trends.$Targets.$Comparisons.$Causes.$Strength.$AreasForImprovement.$Score.$TeamType.$SystemGeneratedScore.$DirectRelavanceToDelivering.$RelevanceToThisCriterionPart.$Presented.$ResultsToLink.$ResultDocument.$ResultAssessmentID;
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   $result = $connection->prepare(TeamConstants::UPDATE_RESULT_ASSESSMENT);
	   $result->bind_param("sssssssssssssdsssssssi",$CriterionPartID,$Result,$ResultSegments,$SourceOfInformation,$Scope,$Segmentation,$integrity,$Trends,$Targets,$Comparisons,$Causes,$Strength,$AreasForImprovement,$Score,$TeamType,$SystemGeneratedScore, $DirectRelavanceToDelivering,$RelevanceToThisCriterionPart,$Presented,$ResultsToLink,$ResultDocument,$ResultAssessmentID);
	   $result->execute();
	   $rowUpdated = $result->affected_rows;
	   $result->close();
	   
	   if($rowUpdated == 1){

		$result = $connection->prepare(TeamConstants::UPDATE_EXE_TEAM_RESULT_ASSESSMENT);
		$result->bind_param("sssssssssssssdssssssi",$CriterionPartID,$Result,$ResultSegments,$SourceOfInformation,$Scope,$Segmentation,$Trends,$Targets,$Comparisons,$Causes,$Strength,$AreasForImprovement,$TeamType,$Score,$SystemGeneratedScore, $DirectRelavanceToDelivering,$RelevanceToThisCriterionPart,$Presented,$ResultsToLink,$ResultDocument,$ResultAssessmentID);
		$result->execute();
		$rowUpdatedValue = $result->affected_rows;
		$result->close();
	   }
	   $connection->close();
	   
	   
	  }
	  catch(Exception $exception){
	   die($exception);
	  }
	  return $rowUpdated;
	 }
		 
		/*public function insertEnablerDocument(EnablerDocumentDO $enablerdocumentdo){
  
		  try{
		   
		   $enablerassessmentid = 0;
		   $enablerassessmentid = $enablerdocumentdo->enablerassessmentid;
		   $enablerdocumentid = $enablerdocumentdo->enablerdocumentid;
		   $enablerdocument = $enablerdocumentdo->enablerdocument;
		   $enablerdocumentdesc = $enablerdocumentdo->enablerdocumentdesc;
		   
		   $database = new dbConnection();
		   $connection = $database->getConnection();
		   $result = $connection->prepare(TeamConstants::SELECT_ENABLER_DOCUMENT_ID);
		   $result->execute();
		   $result->bind_result($enablerid);
		   while($result->fetch()){
			$enablerassessmentid = $enablerid;
		   }
		   $result->close();
		   
		   if($enablerassessmentid == 0){
			$enablerassessmentid = 1;
		   }
		   else{
			$enablerassessmentid = $enablerassessmentid + 1;
		   }
		   
		   $result = $connection->prepare(TeamConstants::INSERT_ENABLER_DOCUMENT_INFO);
		   $result->bind_param("iiss",$enablerassessmentid,$enablerdocumentid,$enablerdocument,$enablerdocumentdesc);
		   $result->execute();
		   $rowInserted = $result->affected_rows;
		   $result->close();
		   
		  }
		  catch(Exception $exception){
		   die($exception);
		  }
		 }*/
		 
 
 /*
 
		 public function insertResultDocument(ResultDocumentDO $resultdocumentdo){
		  
		  try{
		   
		   $resultassessmentid = 0;
		   $resultassessmentid = $resultdocumentdo->resultassessmentid;
		   $resultdocumentid = $resultdocumentdo->resultdocumentid;
		   $resultdocument = $resultdocumentdo->resultdocument;
		   $resultdocumentdesc = $resultdocumentdo->resultdocumentdesc;
		   
		   $database = new dbConnection();
		   $connection = $database->getConnection();
		   $result = $connection->prepare(TeamConstants::SELECT_RESULT_DOCUMENT_ID);
		   $result->execute();
		   $result->bind_result($enablerid);
		   while($result->fetch()){
			$resultassessmentid = $enablerid;
		   }
		   $result->close();
		   
		   if($resultassessmentid == 0){
			$resultassessmentid = 1;
		   }
		   else{
			$resultassessmentid = $resultassessmentid + 1;
		   }
		   
		   $result = $connection->prepare(TeamConstants::INSERT_RESULT_DOCUMENT);
		   $result->bind_param("iiss",$resultassessmentid,$resultdocumentid,$resultdocument,$resultdocumentdesc);
		   $result->execute();
		   $rowInserted = $result->affected_rows;
		   $result->close();
		   
		  }
		  catch(Exception $exception){
		   die($exception);
		  }
		 }*/
		
	public function updateCriteriaPartScore($locationID,$subteamscore, $subteamavgscore,$criteriaShortDesc, $criteripartID){
		  try{
			   $exeteamscore = $subteamscore;
			   $exeteamavgscore =  $subteamavgscore;
			   $database = new dbConnection();
			   $connection = $database->getConnection();
			   //return intval($subteamscore);
			  
			  if($criteripartID>24){
				if($criteripartID==25 || $criteripartID==27 ){
					$dummyScore=intval($subteamscore)*0.75;
					//return($dummyScore);
				}
				else if($criteripartID==26 || $criteripartID==28 ){
					$dummyScore=intval($subteamscore)*0.25;
				}
				else if($criteripartID==29 || $criteripartID==30 || $criteripartID==31 || $criteripartID==32){
					$dummyScore=intval($subteamscore)*0.5;
				}
				
				$result = $connection->prepare(TeamConstants::UPDATE_CRITERIAN_PARTID_SCORE_RESULT);
				$result->bind_param("dddddsi",$subteamscore, $exeteamscore, $subteamavgscore, $exeteamavgscore,$dummyScore,$criteriaShortDesc,$locationID);
			  }
			  else{
					$result = $connection->prepare(TeamConstants::UPDATE_CRITERIAN_PARTID_SCORE);
					$result->bind_param("ddddsi",$subteamscore, $exeteamscore, $subteamavgscore, $exeteamavgscore,$criteriaShortDesc,$locationID);
				}
			   
			   $result->execute();
			   $rowUpdated = $result->affected_rows;
			   $result->close();
			   $connection->close();
			  }
		  catch(Exception $exception){
		   die($exception);
		  }
		  return $rowUpdated;
	 }
		 
		 
		 public function deleteResultAssessment($resultID,$criterionID,$dummyResultID){
		  try{
		   
			   $database = new dbConnection();
			   $connection = $database->getConnection();
			   $countEnabler=0;
			   $result = $connection->prepare(TeamConstants::CHECK_APPROACH_EXISTS_FOR_DELETION);
			   $result->bind_param("ii",$resultID,$criterionID);
			   $result->execute();
			   $result->bind_result($countExists);
				while($result->fetch()){
					$countEnabler=$countExists;
				}
			   $result->close();
			   if($countEnabler==0){
			   
					$saTeam=new SATeam();
					$resultDocumetsDetail=array();
					$fileDeleted="";
					$resultDocumetsDetail=$saTeam->selectResultDocument(strval($resultID));
					for($i = 0;$i < count($resultDocumetsDetail); $i++){
						$sateamToDelete=new SATeam();
						$resultdocumentdo = new ResultDocumentDO();
						$resultdocumentdo = $resultDocumetsDetail[$i];
						$fileDeleted=$sateamToDelete->removeFile($_SERVER['DOCUMENT_ROOT']."/Document/Result/" . $resultdocumentdo->resultdocument);
					}
					 
					$result = $connection->prepare(TeamConstants::DELETE_ALL_RESULT_DOCUMENT);
					$result->bind_param("s",strval($resultID));
					$result->execute();
					$rowDeleted = $result->affected_rows;
				    $result->close();
					 
					$result = $connection->prepare(TeamConstants::DELETE_LINKAGE_APPROACH);
					$result->bind_param("ii",$resultID,$criterionID);
					$result->execute();
					$rowDeleted = $result->affected_rows;
				    $result->close();
					
				   $result = $connection->prepare(TeamConstants::DELETE_RESULT_ASSESSMENT_ID);
				   $result->bind_param("i",$resultID);
				   $result->execute();
				   $rowDeleted = $result->affected_rows;
				   $result->close();
				   
				   if($rowDeleted == 1){
						$result = $connection->prepare(TeamConstants::SELECT_RESULT_ID_TO_UPDATE);
						$result->bind_param("is",$dummyResultID,$criterionID);
						$result->execute();
						$result->bind_result($resultAssessmentID);
						while($result->fetch()){
							$rowUpdated=$saTeam->updateDummyResultID($resultAssessmentID);
						}
						
						$result = $connection->prepare(TeamConstants::DELETE_EXE_RESULT_ASSESSMENT_ID);
						$result->bind_param("i",$resultID);
						$result->execute();
						$rowDeleted = $result->affected_rows;
						$result->close();
					
				   }
				   
				   $connection->close();
			 }
			 else{
				$rowDeleted = 0;
			}
		  }
		  catch(Exception $exception){
		   die($exception);
		  }
		  return $rowDeleted;
		 }
		 public function updateDummyResultID($resultAssessmentID){
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(TeamConstants::UPDATE_DUMMY_RESULT_ID);
			$result->bind_param("i",$resultAssessmentID);
			$result->execute();
			$rowupdated = $result->affected_rows;
			$result->close();
		}
		 

	public function deleteEnablerAssessment($enablerID,$criterionID,$dummyenablerID){
  
	  try{
	  // return $enablerID;
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   $countEnabler=0;
	   $result = $connection->prepare(TeamConstants::CHECK_APPROACH_EXISTS_FOR_DELETION);
	   $result->bind_param("ii",$enablerID,$criterionID);
	   $result->execute();
	   $result->bind_result($countExists);
		while($result->fetch()){
			$countEnabler=$countExists;
		}
	   $result->close();
		
	   if($countEnabler==0){
			
			$tempenablerID = strval($enablerID);
			
			$saTeam=new SATeam();
			$enablerDocumetsDetail=array();
			$fileDeleted="";
			$enablerDocumetsDetail=$saTeam->selectEnablerDocument($tempenablerID);
			for($i = 0;$i < count($enablerDocumetsDetail); $i++){
				$sateamToDelete=new SATeam();
				$enablerdocumentdo = new EnablerDocumentDO();
				$enablerdocumentdo = $enablerDocumetsDetail[$i];
				$fileDeleted=$sateamToDelete->removeFile($_SERVER['DOCUMENT_ROOT']."/Document/Enabler/" . $enablerdocumentdo->enablerdocument);
			}
	   
			
			$result = $connection->prepare(TeamConstants::DELETE_ALL_ENABLER_DOCUMENT);
			$result->bind_param("s",$tempenablerID);
			$result->execute();
			$rowDeleted = $result->affected_rows;
			$result->close();
			
			/*
			$tempenablerID = strval($enablerID);
			$result = $connection->prepare(TeamConstants::DELETE_ALL_ENABLER_DOCUMENT);
			$result->bind_param("s",$tempenablerID);
			$result->execute();
			$rowDeleted = $result->affected_rows;
		    $result->close();*/
			
			$result = $connection->prepare(TeamConstants::DELETE_LINKAGE_APPROACH);
			$result->bind_param("ii",$enablerID,$criterionID);
			$result->execute();
			$rowDeleted = $result->affected_rows;
		    $result->close();
	   
		   $result = $connection->prepare(TeamConstants::DELETE_ENABLER_ASSESSMENT_ID);
		   $result->bind_param("i",$enablerID);
		   $result->execute();
		   $rowDeleted = $result->affected_rows;
		   $result->close();
		  if($rowDeleted == 1){
				$result = $connection->prepare(TeamConstants::SELECT_ENABLER_ID_TO_UPDATE);
				$result->bind_param("is",$dummyenablerID,$criterionID);
				$result->execute();
				$result->bind_result($enablerAssessmentID);
				//return 'value - '.enablerAssessmentID;
				while($result->fetch()){
					$rowUpdated=$saTeam->updateDummyEnablerID($enablerAssessmentID);
				}
				$result->close();
				$result = $connection->prepare(TeamConstants::DELETE_EXE_ENABLER_ASSESSMENT_ID);
				$result->bind_param("i",$enablerID);
				$result->execute();
				$rowDeleted = $result->affected_rows;
				$result->close();
		   }
		   
		   $connection->close();
	  }
	  else{
		$rowDeleted = 0;
	  }
	  }
	  catch(Exception $exception){
	   die($exception);
	  }
	  
	  return $rowDeleted;
	 }
	 public function updateDummyEnablerID($enablerAssessmentID){
		$database = new dbConnection();
		$connection = $database->getConnection();
		$result = $connection->prepare(TeamConstants::UPDATE_DUMMY_ENABLER_ID);
		$result->bind_param("i",$enablerAssessmentID);
		$result->execute();
		$rowupdated = $result->affected_rows;
		$result->close();
	}
	 
	  public function insertEnablerDocument(EnablerDocumentDO $enablerdocumentdo){
  
		  try{
		   
		   $enablerassessmentid = $enablerdocumentdo->enablerassessmentid;
		   $enablerdocumentid = "";
		   $enablerdocument = $enablerdocumentdo->enablerdocument;
		   $enablerdocumentdesc = $enablerdocumentdo->enablerdocumentdesc;
		   
		   $database = new dbConnection();
		   $connection = $database->getConnection();
		   $cnt=0;
			$result = $connection->prepare(TeamConstants::CHK_FILE_EXISTS_ENABLER_EMPTY);
		   $result->bind_param("s",$enablerdocument);
		   $result->execute();
		   $result->bind_result($enabler_cnt);
		   while($result->fetch()){
			$cnt = $enabler_cnt;
		   }
		   $result->close();
		   if($cnt==0){
			   $result = $connection->prepare(TeamConstants::SELECT_ENABLER_DOCUMENT_ID);
			   $result->execute();
			   $result->bind_result($enablerid);
			   while($result->fetch()){
				$enablerdocumentid = $enablerid;
			   }
			   $result->close();
			   
			   if($enablerdocumentid == 0){
				$enablerdocumentid = 1;
			   }
			   else{
				$enablerdocumentid = $enablerdocumentid + 1;
			   }
			   
			   $result = $connection->prepare(TeamConstants::INSERT_ENABLER_DOCUMENT_INFO);
			   $result->bind_param("iss",$enablerdocumentid,$enablerdocument,$enablerdocumentdesc);
			   $result->execute();
			   $rowInserted = $result->affected_rows;
			   $result->close();
			   $connection->close();
			}
		  }
		  
		  catch(Exception $exception){
		   die($exception);
		  }
		  return $rowInserted;
		}
		 
		 
 
		 public function selectEnablerDocument($EnablerAssessmentID){
  
			  try{
			   
			   $enablerarray = array();
			   $database = new dbConnection();
			   $connection = $database->getConnection();
			   if($EnablerAssessmentID=="0"){
					$result = $connection->prepare(TeamConstants::SELECT_NULL_ENABLER_DOCUMENT);
			   }
			   else{
				   $result = $connection->prepare(TeamConstants::SELECT_ENABLER_DOCUMENT);
				   $result->bind_param("s",$EnablerAssessmentID);
			   }
			   $result->execute();
			   $result->bind_result($EnablerDocumentID, $EnablerAssessmentID,$EnablerDocument,$EnablerDocumentDesc);
			   while($result->fetch()){
				
				$enablerdocumentdo = new EnablerDocumentDO();
				$enablerdocumentdo->enablerdocumentid = $EnablerDocumentID;
				$enablerdocumentdo->enablerassessmentid = $EnablerAssessmentID;
				$enablerdocumentdo->enablerdocument = $EnablerDocument;
				$enablerdocumentdo->enablerdocumentdesc = $EnablerDocumentDesc;
				$enablerarray[] = $enablerdocumentdo;
				unset($enablerdocumentdo);
			   }
			   $result->close();
			   $connection->close();
			  }
			  catch(Exception $exception){
			   die($exception);
			  }
			  return $enablerarray;
			 }
		 
	public function deleteEnablerDocument($EnablerDocumentID){

		try{
		   
			$database = new dbConnection();
			$connection = $database->getConnection();
			
			$enablerDocumentName ="";
			$result = $connection->prepare(TeamConstants::SELECT_ENABLER_DOCUMENT_NAME);
			$result->bind_param("i",$EnablerDocumentID);
		    $result->execute();
		    $result->bind_result($EnablerDocument);
		    while($result->fetch()){
				$enablerDocumentName = $EnablerDocument;
		    }
		    $result->close();
			$sateamToDelete=new SATeam();
			$fileDeleted=$sateamToDelete->removeFile($_SERVER['DOCUMENT_ROOT']."/Document/Enabler/" . $enablerDocumentName);
			
			$result = $connection->prepare(TeamConstants::DELETE_ENABLER_DOCUMENT_ID);
			$result->bind_param("i",$EnablerDocumentID);
			$result->execute();
			$rowDeleted = $result->affected_rows;
			$result->close();
			$connection->close();   
		}
		catch(Exception $exception){
			die($exception);
		}
		 return $rowDeleted;
	}
		 
	public function insertResultDocument(ResultDocumentDO $resultdocumentdo){
  
	  try{
	   
	   $resultassessmentid = $resultdocumentdo->resultassessmentid;
	   $resultdocument = $resultdocumentdo->resultdocument;
	   $resultdocumentdesc = $resultdocumentdo->resultdocumentdesc;
	   
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   
	   $cnt=0;
	   $result = $connection->prepare(TeamConstants::CHK_FILE_EXISTS_RESULT_EMPTY);
	   $result->bind_param("s",$resultdocument);
	   $result->execute();
	   $result->bind_result($result_cnt);
	   while($result->fetch()){
		$cnt = $result_cnt;
	   }
	   $result->close();

	   if($cnt==0){
		   $result = $connection->prepare(TeamConstants::SELECT_RESULT_DOCUMENT_ID);
		   $result->execute();
		   $result->bind_result($ResultDocumentID);
		   while($result->fetch()){
			$resultdocumentid = $ResultDocumentID;
		   }
		   $result->close();
		   
		   if($resultdocumentid == 0){
			$resultdocumentid = 1;
		   }
		   else{
			$resultdocumentid = $resultdocumentid + 1;
		   }
		   //return $resultassessmentid.$resultdocumentid.$resultdocument.$resultdocumentdesc;
		   $result = $connection->prepare(TeamConstants::INSERT_RESULT_DOCUMENT);
		   $result->bind_param("iss",$resultdocumentid,$resultdocument,$resultdocumentdesc);
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
 
 
  
 public function selectResultDocument($ResultAssessmentID){
  
  try{
   
   $enablerarray = array();
   $database = new dbConnection();
   $connection = $database->getConnection();
   if($ResultAssessmentID=="0"){
		$result = $connection->prepare(TeamConstants::SELECT_NULL_RESULT_DOCUMENT);
   }
   else{
	   $result = $connection->prepare(TeamConstants::SELECT_RESULT_DOCUMENT);
	   $result->bind_param("s",$ResultAssessmentID);
   }
   $result->execute();
   $result->bind_result($ResultAssessmentID, $ResultDocumentID, $ResultDocument, $ResultDocumentDesc);
   while($result->fetch()){
    $resultdocumentdo = new ResultDocumentDO();
    $resultdocumentdo->resultassessmentid = $ResultAssessmentID;
    $resultdocumentdo->resultdocumentid = $ResultDocumentID;
    $resultdocumentdo->resultdocument = $ResultDocument;
    $resultdocumentdo->resultdocumentdesc = $ResultDocumentDesc;
    $enablerarray[] = $resultdocumentdo;
    unset($resultdocumentdo);
   }
   $result->close();
   $connection->close();
  }
  catch(Exception $exception){
   die($exception);
  }
  return $enablerarray;
 }
 
 
 public function deleteResultDocument($ResultDocumentID){
  
  try{
   
   $database = new dbConnection();
   $connection = $database->getConnection();
   
   $resultDocumentName ="";
	$result = $connection->prepare(TeamConstants::SELECT_RESULT_DOCUMENT_NAME);
	$result->bind_param("i",$ResultDocumentID);
	$result->execute();
	$result->bind_result($ResultDocument);
	while($result->fetch()){
		$resultDocumentName = $ResultDocument;
	}
	$result->close();
	$sateamToDelete=new SATeam();
	$fileDeleted=$sateamToDelete->removeFile($_SERVER['DOCUMENT_ROOT']."/Document/Result/" . $resultDocumentName);
   
   $result = $connection->prepare(TeamConstants::DELETE_RESULT_DOCUMENT_ID);
   $result->bind_param("i",$ResultDocumentID);
   $result->execute();
   $rowDeleted = $result->affected_rows;
   $result->close();
   $connection->close();   
  }
  catch(Exception $exception){
   die($exception);
  }
  return $rowDeleted;
  
 }

	public function getCriteriaList($userID,$roleID){
		
		try{
			$strvalue = "";
			$database = new dbConnection();
			$connection = $database->getConnection();
			if($roleID>5){
				$result = $connection->prepare(TeamConstants::SELECT_CRITERIA_PARTID_TEAM_MEMBER);
			}
			else{
				$result = $connection->prepare(TeamConstants::SELECT_CRITERIA_PARTID_TEAM);
			}
			/*else if($roleID==5){
				$result = $connection->prepare(TeamConstants::CHK_EXECUTIVE);
				$result->bind_param("i",$userID);
				$result->execute();
				$result->bind_result($count);
				while($result->fetch()){
					$isExe=$count;
					if($isExe==1){
						$result = $connection->prepare(TeamConstants::SELECT_CRITERIA_PARTID_EXECUTIVETEAM);
					}
					else{
						$result = $connection->prepare(TeamConstants::SELECT_CRITERIA_PARTID_TEAM);
					}
				}
			}
			else{
				$result = $connection->prepare(TeamConstants::SELECT_CRITERIA_PARTID_EXECUTIVETEAM);
			}*/
			$result->bind_param("i",$userID);
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


	
	
	public function getLinkageCriteria($enablerID,$criteriaID){
  
	  try{
	   
	    $linkageArray = array();
	    $database = new dbConnection();
	    $connection = $database->getConnection();
		if($criteriaID<25){
			$result = $connection->prepare(TeamConstants::SELECT_APPROACH_TO_LINK_ENABLER);
			$result->bind_param("iii",$enablerID,$enablerID,$enablerID);
		}
		else{
			$result = $connection->prepare(TeamConstants::SELECT_APPROACH_TO_LINK_RESULT);
			$result->bind_param("iii",$enablerID,$enablerID,$enablerID);
		}
	    $result->execute();
	    $result->bind_result($dummyID,$enablerAssessmentID,$criterionPartID,$criterionPartShortDescription,$approachTitle,$descriptionofLinkage);
	    while($result->fetch()){
			$enablerassessmendo = new EnablerAssessmentDO();
			$enablerassessmendo->enablerID = $enablerAssessmentID;
			$enablerassessmendo->criteriaID = $criterionPartID;
			$enablerassessmendo->criteriaShortDesc = $criterionPartShortDescription . '(' . $dummyID . ')';
			$enablerassessmendo->approachTitle = $approachTitle;
			$enablerassessmendo->flag = false;
			$enablerassessmendo->enabled = false;
			$enablerassessmendo->descriptionofLinkage = $descriptionofLinkage!=null ? $descriptionofLinkage : "";
			$linkageArray[] = $enablerassessmendo;
			unset($enablerassessmendo);
		}
		$result->close();
		$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
	     return $linkageArray;
	}

	
	//***************************************


	public function AddCriteriaLinkage($criteriaLink){
  
	  try{
	  
			$enablerID = $criteriaLink[0]["enablerID"];
			$criteriaID=$criteriaLink[0]["criterialID"];
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(TeamConstants::DELETE_LINK_ALREADY_EXISTS);
			$result->bind_param("ii",$enablerID,$criteriaID);
			$result->execute();
			$rowDeleted = $result->affected_rows;
			$result->close();
			
			for($i = 0; $i < count($criteriaLink); $i++){
			
				$enablerID = $criteriaLink[$i]["enablerID"];
				$enablerLinkID = $criteriaLink[$i]["enablerLinkID"];
				$DescriptionOfLinkage = $criteriaLink[$i]["DescriptionOfLinkage"];
				$criterialID = $criteriaLink[$i]["criterialID"];
				$criteriaLinkID = $criteriaLink[$i]["criteriaLinkID"];
				$criteriaShortDescription = $criteriaLink[$i]["criteriaShortDescription"];
				$flag = $criteriaLink[$i]["flag"];
				$dummy=$criteriaLink[$i]["dummyEnablerID"];
				if($flag !=0){
					$result = $connection->prepare(TeamConstants::INSERT_LINK_CRITERIA);
					$result->bind_param("iisiiss",$enablerID,$enablerLinkID,$DescriptionOfLinkage,$criterialID,$criteriaLinkID,$criteriaShortDescription,$dummy);
					$result->execute();
					$rowInserted = $result->affected_rows;
					$result->close();
				} 
			}
			
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $rowInserted;
	}
	public function getEnablerLinkToApproach($enablerID,$criteriaID){
		  
		  try{
		   $criteriaLinked = "";
		   $database = new dbConnection();
		   $connection = $database->getConnection();
		   $result = $connection->prepare(TeamConstants::SELECT_ENABLER_LINK_TO_APPROACH);
		   $result->bind_param("ii",$enablerID,$criteriaID);
		   $result->execute();
		   $result->bind_result($approachToLink);
		   while($result->fetch()){
			$approachLink[] = $approachToLink;
		   }
		   $result->close();
		   
		   if(count($approachLink) != 0){
			for($i = 0; $i < count($approachLink); $i++){
			 if($criteriaLinked == "")
			  $criteriaLinked = $approachLink[$i];
			 else
			  $criteriaLinked = $criteriaLinked.",".$approachLink[$i];
			}
		   }
		   $result->close();
		   $connection->close();
		  }
		  catch(Exception $exception){
		   die($exception);
		  }
		  return $criteriaLinked;   
		 }
	
	public function getOtherEnablerLinkToApproach($enablerID,$criteriaID){
		  
		  
		  try{
		   $$othercriteriaLinked = "";
		   $database = new dbConnection();
		   $connection = $database->getConnection();
		   $result = $connection->prepare(TeamConstants::SELECT_OTHER_ENABLER_LINK_TO_APPROACH);
		   $result->bind_param("ii",$enablerID,$criteriaID);
		   $result->execute();
		   $result->bind_result($dummyID,$criterionPartShortDescription,$enablerAssessmentID);
		   while($result->fetch()){
			
			$otherApproachLink[] = $criterionPartShortDescription . '(' . $dummyID . ')';
		   }
		   $result->close();
		   
		   if(count($otherApproachLink) != 0){
			for($i = 0; $i < count($otherApproachLink); $i++){
			 if($$othercriteriaLinked == "")
			  $$othercriteriaLinked = $otherApproachLink[$i];
			 else
			  $$othercriteriaLinked = $$othercriteriaLinked.", ".$otherApproachLink[$i];
			}
		   }
		   $result->close();
		   $connection->close();
		  }
		  catch(Exception $exception){
		   die($exception);
		  }
		  return $$othercriteriaLinked;   
		 }
	
	
	public function selectAllSubAssessment($locationID){
  
		  try{
		   
		   $teamarray = array();
		   $database = new dbConnection();
		   $connection = $database->getConnection();
		   $result = $connection->prepare(TeamConstants::SELECT_ALL_SUB_TEAMASSESSMENT);
		   $result->bind_param("i",$locationID);
		   $result->execute();
		   $result->bind_result($dummyEnablerID,$enablerID,$criterionPartID,$approachTitle, $approachDescription,$CriterionPartShortDescription,$exampleofapproach, $deployment,$examplesofdeployment,$assessmentandreview,$examplesofassessmentreview, $sourceofinformation,$soundrational,$integrated, $implemented,$systematic, $measurement,$learning,$improvement,$strength,$areaforimprovement,$teamtype,$score,$systemgeneratedscore,$presented,$directrelavancetodelivering, $relevancetothiscriterionpart,$approachtolink,$status, $enablerdocument,$missing,$locationID,$location);
		   $average_Result = 0;
		   while($result->fetch()){
			
			$enablerassessmendo = new EnablerAssessmentDO();
			
			
			$enablerassessmendo->enablerID = $enablerID;
			$enablerassessmendo->dummyEnablerID = $dummyEnablerID;
			$enablerassessmendo->criteriaID = $CriterionPartShortDescription . '(' . $dummyEnablerID . ')';
			$sateam = new SATeam();
			
			$enablerApproachLinkTo=$sateam->getEnablerLinkToApproach($enablerID,$criterionPartID);
			$enablerassessmendo->approachtolink=$enablerApproachLinkTo!=null ? $enablerApproachLinkTo : "Not assigned";
			
			$otherApproachLinkTo=$sateam->getOtherEnablerLinkToApproach($enablerID,$criterionPartID);
			$enablerassessmendo->otherapproachlinkto=$otherApproachLinkTo!=null ? $otherApproachLinkTo : "Not assigned";
			
			$enablerassessmendo->approachTitle = $approachTitle;
			$enablerassessmendo->approachdesc = $approachDescription;
			$enablerassessmendo->exampleofapproach = $exampleofapproach;
			$enablerassessmendo->deployment = $deployment;
			$enablerassessmendo->examplesofdeployment = $examplesofdeployment;
			$enablerassessmendo->assessmentandreview = $assessmentandreview;
			$enablerassessmendo->examplesofassessmentreview = $examplesofassessmentreview;
			$enablerassessmendo->sourceofinformation = $sourceofinformation;
			$enablerassessmendo->soundrational = $soundrational;
			$enablerassessmendo->integrated = $integrated;
			$enablerassessmendo->implemented = $implemented;
			$enablerassessmendo->systematic = $systematic;
			$enablerassessmendo->measurement = $measurement;
			$enablerassessmendo->learning = $learning;
			$enablerassessmendo->improvement = $improvement;
			$enablerassessmendo->strength = $strength;
			$enablerassessmendo->areaforimprovement = $areaforimprovement;
			$enablerassessmendo->teamtype = $teamtype;
			$enablerassessmendo->score = $score;
			$enablerassessmendo->systemgeneratedscore = $systemgeneratedscore;
			$enablerassessmendo->presented = $presented;
			$enablerassessmendo->directrelavancetodelivering = $directrelavancetodelivering;
			$enablerassessmendo->relevancetothiscriterionpart = $relevancetothiscriterionpart;
			
			$enablerassessmendo->status = $status;
			$enablerassessmendo->enablerdocument = $enablerdocument;
			
			$sateam=new SATeam();
			$owner = $sateam->SelectCriteriaOwner($criterionPartID);
			$ownerArr=explode("-",$owner);
			$enablerassessmendo->owner=$ownerArr[1];
			
			if($missing == 1){
			 $enablerassessmendo->missing = 'Yes';
			}else{
			 $enablerassessmendo->missing = 'No';
			}
			
			
		if($average_Result==0){
		  $average_Result = $enablerassessmendo->score;
		 }
		 else{
			$average_Result = $average_Result+$enablerassessmendo->score;
		 }
		 $enablerassessmendo->average = $average_Result;
		 $enablerassessmendo->locationID = $locationID;
		$enablerassessmendo->location = $location;
			$subteamarray[] = $enablerassessmendo;
			unset($enablerassessmendo);
		   }
		   
		   $result->close();
		   $connection->close();
		  }
		  catch(Exception $exception){
		   die($exception);
		  }
		  return $subteamarray;
	}
	public function selectAllResultAssessment($locationID){
  
	   try{
		
		$teamarray = array();
		$database = new dbConnection();
		$connection = $database->getConnection();
		$result = $connection->prepare(TeamConstants::SELECT_ALL_RESULT_ASSESSMENT);
		$result->bind_param("i",$locationID);
		$result->execute();
		
		$result->bind_result($dummyResultID,$ResultAssessmentID,$CriterionPartID,$Result,$ResultSegments,$criterionPartShortDescription,$SourceOfInformation,$Scope,$Segmentation,$Trends,$Targets,$Comparisons,$Causes,$Strength,$AreasForImprovement,$Score,$TeamType,$SystemGeneratedScore,$DirectRelavanceToDelivering,$RelevanceToThisCriterionPart,$Presented,$ResultsToLink,$ResultDocument,$locationID,$location);
		$average_Result= 0;
		while($result->fetch()){
		 
		 $resultassessmendo = new ResultAssessmentDO();
		 
		 $resultassessmendo->resultassessmentid = $ResultAssessmentID;
		 $resultassessmendo->dummyResultID = $dummyResultID;
		 $resultassessmendo->criteriaID = $criterionPartShortDescription . '(' . $dummyResultID . ')';
		 
		 $sateam = new SATeam();
			
		$resultApproachLinkTo=$sateam->getEnablerLinkToApproach($ResultAssessmentID,$CriterionPartID);
		$resultassessmendo->approachtolink=$resultApproachLinkTo!=null ? $resultApproachLinkTo : "Not assigned";
		
		$otherApproachLinkTo=$sateam->getOtherEnablerLinkToApproach($ResultAssessmentID,$CriterionPartID);
		$resultassessmendo->otherapproachlinkto=$otherApproachLinkTo!=null ? $otherApproachLinkTo : "Not assigned";
		
		 $resultassessmendo->result_name = $Result;
		 $resultassessmendo->resultsegments = $ResultSegments;
		 $resultassessmendo->sourceofinformation = $SourceOfInformation;
		 $resultassessmendo->scope = $Scope;
		 $resultassessmendo->segmentation = $Segmentation;
		 $resultassessmendo->trends = $Trends;
		 $resultassessmendo->targets = $Targets;
		 $resultassessmendo->comparisons = $Comparisons;
		 $resultassessmendo->causes = $Causes;
		 $resultassessmendo->strength = $Strength;
		 $resultassessmendo->areasforimprovement = $AreasForImprovement;
		 $resultassessmendo->score = $Score;
		 $resultassessmendo->teamtype = $TeamType;
		 $resultassessmendo->systemgeneratedscore = $SystemGeneratedScore;
		 $resultassessmendo->directrelavancetodelivering = $DirectRelavanceToDelivering;
		 $resultassessmendo->relevancetothiscriterionpart = $RelevanceToThisCriterionPart;
		 $resultassessmendo->flag=false;
		 //$resultassessmendo->otherapproachlinkto="None";
		 if($Presented == 1){
		  $resultassessmendo->presented = 'Yes';
		 }else{
		  $resultassessmendo->presented = 'No';
		 }
		 $resultassessmendo->missing =  $resultassessmendo->presented;
		 //$resultassessmendo->approachTitle = $resultassessmendo->result_name;
		
		 $resultassessmendo->resultstolink = $ResultsToLink;
		 $resultassessmendo->resultdocument = $ResultDocument;
		// $resultassessmendo->approachtolink = $resultassessmendo->resultstolink;
		 $sateam=new SATeam();
		$owner = $sateam->SelectCriteriaOwner($CriterionPartID);
		$ownerArr=explode("-",$owner);
		$resultassessmendo->owner=$ownerArr[1];
		 
		 if($average_Result==0){
		  $average_Result = $resultassessmendo->score;
		 }
		 else{
			$average_Result = $average_Result+$resultassessmendo->score;
		 }
		 $resultassessmendo->average = $average_Result;
		  $resultassessmendo->locationID = $locationID;
		$resultassessmendo->location = $location;
		 $teamarray[] = $resultassessmendo;
		 unset($resultassessmendo);
		}
		
		$result->close();
		$connection->close();
	   }
	   catch(Exception $exception){
		die($exception);
	   }
	   return $teamarray;
	  }
	
	public function getAssessmentComments($enablerID,$criteriaID,$type){
		try{
			
				$comments="";
				$database = new dbConnection();
				$connection = $database->getConnection();
				if($type=="Enabler"){
					$result = $connection->prepare(TeamConstants::GET_ENABLER_COMMENTS);
				}
				else{
					$result = $connection->prepare(TeamConstants::GET_RESULT_COMMENTS);
				}
				$result->bind_param("ii",$enablerID,$criteriaID);
				$result->execute();
				$result->bind_result($CommentsOfExeTeam,$SubTeamActions);
				while($result->fetch()){
					$comments= 	$CommentsOfExeTeam ."," .$SubTeamActions;
				}
				$result->close();
				$connection->close();
		   }
		   catch(Exception $exception){
				die($exception);
			}
	   return $comments;
	}
	/*
	public function AddComments(EnablerAssessmentDO $comments ){
  
	  try{
	  
			$database = new dbConnection();
			$connection = $database->getConnection();
			for($i = 0; $i < count($comments); $i++){
			
				$enablerID = $comments->enablerID;
				$criterialID = $comments->criterialID;
				$approachtolink = $comments->approachtolink;
				$exeComments = $comments->exeComments;
				$subTeamComments = $comments->subTeamComments;
				$type=$comments->approachTitle;
				if($type=="Enabler"){
					$result = $connection->prepare(TeamConstants::DELETE_ENABLER_COMMENTS);
					$result->bind_param("ii",$enablerID,$criterialID);
					$result->execute();
					$rowDeleted = $result->affected_rows;
					$result->close();
					$result = $connection->prepare(TeamConstants::INSERT_ENABLER_COMMENTS);
					$result->bind_param("iiisss",$enablerID,$enablerID,$criterialID,$exeComments,$subTeamComments,$approachtolink);
				}
				else{
					$result = $connection->prepare(TeamConstants::DELETE_RESULT_COMMENTS);
					$result->bind_param("ii",$enablerID,$criterialID);
					$result->execute();
					$rowDeleted = $result->affected_rows;
					$result->close();
					$result = $connection->prepare(TeamConstants::INSERT_RESULT_COMMENTS);
					$result->bind_param("iiisss",$enablerID,$enablerID,$criterialID,$exeComments,$subTeamComments,$approachtolink);
				}
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
	}*/
	public function getAssessmentScorePoints($locationID,$type){
  
	  try{
	   
	    $scoreArray = array();
	    $database = new dbConnection();
	    $connection = $database->getConnection();
		if($type=="Enabler"){
			$result = $connection->prepare(TeamConstants::GET_ENABLER_SCORE_POINTS);
		}
		else{
			$result = $connection->prepare(TeamConstants::GET_RESULT_SCORE_POINTS);
		}
		$result->bind_param("i",$locationID);
	    $result->execute();
	    $result->bind_result($criterionPartShortDescription,$SubteamScore,$ExeTeamScore);
	    while($result->fetch()){
			$criteriaDO = new CriteriaDO();
			$criteriaDO->criteriaShortPartDesc = $criterionPartShortDescription;
			$criteriaDO->subTeamScore = $SubteamScore!=null ? $SubteamScore : '0';
			$criteriaDO->exeTeamScore = $ExeTeamScore!=null ? $ExeTeamScore : '0';
			$scoreArray[] = $criteriaDO;
			unset($criteriaDO);
		}
		$result->close();
		$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
	     return $scoreArray;
	}
	public function getAssessmentTotalPoints($locationID,$type){
  
	  try{
		$tempfactor = "";
	    $totalPoints = array();
	    $database = new dbConnection();
	    $connection = $database->getConnection();
		if($type=="Enabler"){
			$result = $connection->prepare(TeamConstants::GET_ENABLER_TOTAL_POINTS);
			$result->bind_param("i",$locationID);
			$result->execute();
			$result->bind_result($criteriaShortDescription,$pointsAwarded,$factor,$criteria,$subTeamScore);
			while($result->fetch()){
				$criteriaDO = new CriteriaDO();
				$criteriaDO->criteriaShortPartDesc = $criteriaShortDescription;
				if($subTeamScore != null){
					if($criteria==1 || $criteria==3 || $criteria==4 || $criteria==5){
						$criteriaDO->subTeamScore =intval($subTeamScore)/5;
					}
					else if($criteria==2){
						$criteriaDO->subTeamScore =intval($subTeamScore)/4;
					}
					else if($criteria==6 || $criteria==7 || $criteria==8 || $criteria==9){
						$criteriaDO->subTeamScore =intval($subTeamScore)/2;
					}
				}
				else{
					$criteriaDO->subTeamScore = '0';
				}
				$criteriaDO->pointsAwarded = ($pointsAwarded != null) ? $pointsAwarded : '0';
				$criteriaDO->factor = number_format($factor,1);
				$criteriaDO->overallPoints=$criteriaDO->subTeamScore * $criteriaDO->factor;
				
				$totalPoints[] = $criteriaDO;
				unset($criteriaDO);
			}
			
			$result->close();
		}
		else{
			$result = $connection->prepare(TeamConstants::GET_RESULT_TOTAL_POINTS);
			$result->bind_param("i",$locationID);
			$result->execute();
			$result->bind_result($criteriaShortDescription,$pointsAwarded,$factor,$criteria,$subTeamScore,$criterionPartID);
			while($result->fetch()){
				$criteriaDO = new CriteriaDO();
				$criteriaDO->criteriaShortPartDesc = $criteriaShortDescription;
				if($subTeamScore != null){
					$criteriaDO->subTeamScore =intval($subTeamScore);
				}
				else{
					$criteriaDO->subTeamScore = '0';
				}
				$criteriaDO->pointsAwarded = ($pointsAwarded != null) ? $pointsAwarded : '0';
				$criteriaDO->factor = number_format($factor,1);
				$criteriaDO->overallPoints=$criteriaDO->subTeamScore * $criteriaDO->factor;
				
				$totalPoints[] = $criteriaDO;
				unset($criteriaDO);
			}
			
			$result->close();
		}
		
		$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		  return $totalPoints;
	}
	
	public function getEnablerFeedbackScore($locationID){
  
	  try{
		
	    $totalPoints = array();
	    $database = new dbConnection();
	    $connection = $database->getConnection();
		$result = $connection->prepare(TeamConstants::GET_ENABLER_FEEDBACK_SCORE);
		$result->bind_param("i",$locationID);
		$result->execute();
				
		$result->bind_result($dummyEnablerID,$enablerAssessmentID,$criterionPartShortDescription,$approachTitle,$strength,$areaForImprovement,$soundRational,$integrated, $implemented,$systematic,$measurement,$learning,$improvement);
	    while($result->fetch()){
			$enablerAssessmentDO = new EnablerAssessmentDO();
			$enablerAssessmentDO->criteriaShortDesc = $criterionPartShortDescription.'('.$dummyEnablerID.')';
			$enablerAssessmentDO->approachTitle = $approachTitle;
			$enablerAssessmentDO->strength = ($strength != null) ? $strength : "None";
			$enablerAssessmentDO->areaforimprovement =$areaForImprovement!=null ? $areaForImprovement : "None";
			$enablerAssessmentDO->approachdesc=round(intval($soundRational + $integrated)/2);
			$enablerAssessmentDO->deployment=round(intval($implemented + $systematic)/2);
			$enablerAssessmentDO->assessmentandreview=round(intval($measurement + $learning + $improvement)/3);
			$enablerAssessmentDO->score=round(intval($enablerAssessmentDO->approachdesc+$enablerAssessmentDO->deployment+$enablerAssessmentDO->assessmentandreview)/3);
			$totalPoints[] = $enablerAssessmentDO;
			unset($enablerAssessmentDO);
		}
		
		$result->close();
		$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $totalPoints;
	}
	
	
	public function getResultFeedbackScore($locationID){
  
	  try{
			$strvalue = "";
			$temparray = array();
			$resultFeedbackPoints = "";
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(TeamConstants::GET_RESULT_FEEDBACK_SCORE);
			$result->bind_param("i",$locationID);
			$result->execute();
			
			$result->bind_result($dummyResultID,$resultAssessmentID,$criterionPartShortDescription,$Result,$strength,$areasForImprovement,$relevance,$segmentation,$trends,$targets,$comparisons,$causes,$integrity,$score);
			
			while($result->fetch()){
				$resultassessmentDO = new ResultAssessmentDO();
				$resultassessmentDO->criteriaPartDesc = $criterionPartShortDescription.'('.$dummyResultID.')';
				$resultassessmentDO->result_name = $Result;
				$resultassessmentDO->strength = ($strength != null) ? $strength : "None";
				$resultassessmentDO->areasforimprovement =$areasForImprovement!=null ? $areasForImprovement : "None";
				$resultassessmentDO->scope=$relevance!=null ? $relevance : '0';
				$resultassessmentDO->segmentation=$segmentation!=null ? $segmentation : '0';
				$resultassessmentDO->trends=$trends!=null ? $trends : '0';
				$resultassessmentDO->targets=$targets!=null ? $targets : '0';
				$resultassessmentDO->comparisons=$comparisons!=null ? $comparisons : '0';
				$resultassessmentDO->causes=$causes!=null ? $causes : '0';
				$resultassessmentDO->score=$score!=null ? $score : '0';
				$resultassessmentDO->integrity=$integrity!=null ? $integrity : '0';
				$resultassessmentDO->relevance=round(intval($resultassessmentDO->scope+$resultassessmentDO->segmentation+$resultassessmentDO->integrity)/3);
				$resultassessmentDO->performance=round(intval($resultassessmentDO->trends+$resultassessmentDO->targets+$resultassessmentDO->comparisons+$resultassessmentDO->causes)/4);
				
				$resultFeedbackPoints[] = $resultassessmentDO;
			}
			$result->close();
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $resultFeedbackPoints;
		
	}
	public function addEnablerDocument(EnablerDocumentDO $enablerdocumentdo){
  
	  try{
	   
		   $enablerassessmentid = $enablerdocumentdo->enablerassessmentid;
		   $enablerdocumentid = "";
		   $enablerdocument = $enablerdocumentdo->enablerdocument;
		   $enablerdocumentdesc = $enablerdocumentdo->enablerdocumentdesc;
		   
		   $database = new dbConnection();
		   $connection = $database->getConnection();
		   
		   $cnt = 0;
		   $result = $connection->prepare(TeamConstants::CHK_FILE_EXISTS_ENABLER);
		   $result->bind_param("ss",$enablerassessmentid,$enablerdocument);
		   $result->execute();
		   $result->bind_result($enabler_cnt);
		   while($result->fetch()){
			$cnt = $enabler_cnt;
		   }
		   $result->close();
		   if($cnt==0){
				$result = $connection->prepare(TeamConstants::SELECT_ENABLER_DOCUMENT_ID);
			   $result->execute();
			   $result->bind_result($enablerid);
			   while($result->fetch()){
				$enablerdocumentid = $enablerid;
			   }
			   $result->close();
			   
			   if($enablerdocumentid == 0){
				$enablerdocumentid = 1;
			   }
			   else{
				$enablerdocumentid = $enablerdocumentid + 1;
			   }
			   
			   $result = $connection->prepare(TeamConstants::INSERT_ENABLER_DOCUMENT);
			   $result->bind_param("siss",$enablerassessmentid,$enablerdocumentid,$enablerdocument,$enablerdocumentdesc);
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
	public function addResultDocument(ResultDocumentDO $resultdocumentdo){
  
	  try{
	   
	   $resultassessmentid = $resultdocumentdo->resultassessmentid;
	   $resultdocument = $resultdocumentdo->resultdocument;
	   $resultdocumentdesc = $resultdocumentdo->resultdocumentdesc;
	   
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   
	   $cnt=0;
	   $result = $connection->prepare(TeamConstants::CHK_FILE_EXISTS_RESULT);
	   $result->bind_param("ss",$resultassessmentid,$resultdocument);
	   $result->execute();
	   $result->bind_result($result_cnt);
	   while($result->fetch()){
		$cnt = $result_cnt;
	   }
	   $result->close();

	   if($cnt==0){
		   $result = $connection->prepare(TeamConstants::SELECT_RESULT_DOCUMENT_ID);
		   $result->execute();
		   $result->bind_result($ResultDocumentID);
		   while($result->fetch()){
				$resultdocumentid = $ResultDocumentID;
		   }
		   $result->close();
		   
		   if($resultdocumentid == 0){
			$resultdocumentid = 1;
		   }
		   else{
			$resultdocumentid = $resultdocumentid + 1;
		   }
		   //return $resultassessmentid.$resultdocumentid.$resultdocument.$resultdocumentdesc;
		   $result = $connection->prepare(TeamConstants::INSERT_RESULT_DOCUMENT_INFO);
		   $result->bind_param("siss",$resultassessmentid,$resultdocumentid,$resultdocument,$resultdocumentdesc);
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
	public function deleteAllNullEnablerDocuments(){
		try{
		   
			$database = new dbConnection();
			$connection = $database->getConnection();
			
			$saTeam=new SATeam();
			$enablerDocumetsDetail=array();
			$fileDeleted="";
			$enablerDocumetsDetail=$saTeam->selectEnablerDocument("0");
			for($i = 0;$i < count($enablerDocumetsDetail); $i++){
				$sateamToDelete=new SATeam();
				$enablerdocumentdo = new EnablerDocumentDO();
				$enablerdocumentdo = $enablerDocumetsDetail[$i];
				$fileDeleted=$sateamToDelete->removeFile($_SERVER['DOCUMENT_ROOT']."/Document/Enabler/" . $enablerdocumentdo->enablerdocument);
			}
			
			$result = $connection->prepare(TeamConstants::DELETE_ALL_NULL_ENABLER_DOCS);
			$result->execute();
			$rowDeleted = $result->affected_rows;
			$result->close();
			
			$connection->close();   
		}
		catch(Exception $exception){
			die($exception);
		}
		 return $rowDeleted;
	}
	
	public function deleteAllNullResultDocuments(){
		try{
		   
			$database = new dbConnection();
			$connection = $database->getConnection();
			
			$saTeam=new SATeam();
			$resultDocumetsDetail=array();
			$fileDeleted="";
			$resultDocumetsDetail=$saTeam->selectResultDocument("0");
			for($i = 0;$i < count($resultDocumetsDetail); $i++){
				$sateamToDelete=new SATeam();
				$resultdocumentdo = new ResultDocumentDO();
				$resultdocumentdo = $resultDocumetsDetail[$i];
				$fileDeleted=$sateamToDelete->removeFile($_SERVER['DOCUMENT_ROOT']."/Document/Result/" . $resultdocumentdo->resultdocument);
				//return $_SERVER['DOCUMENT_ROOT']."/Document/Result/" . $resultdocumentdo->resultdocument;
			}
			
			
			$result = $connection->prepare(TeamConstants::DELETE_ALL_NULL_RESULT_DOCS);
			$result->execute();
			$rowDeleted = $result->affected_rows;
			$result->close();
			$connection->close();   
		}
		catch(Exception $exception){
			die($exception);
		}
		 return $rowDeleted;
	}
	public function removeFile($fileName){
		$fileToRemove = $fileName;
		if (file_exists($fileToRemove)) {
		  if (@unlink($fileToRemove) === true) {
			  return "File removed successfully";
		   }
		   else {
			 return "File cannot be removed,try again";
		   }
		} 
		else {
		   return "File doesn't exists";
		}
	}
	public function getRootPath(){
		return $_SERVER['DOCUMENT_ROOT'];
	}
	
	public function getCriteriaForActionPlan($userID,$roleID){
		
		try{
			 $criteriaResult = array();
		  
			$database = new dbConnection();
			$connection = $database->getConnection();
			if($roleID>5){
				$result = $connection->prepare(TeamConstants::SELECT_CRITERIA_PARTID_TEAM_MEMBER_ACTION_PLAN);
			}
			else{
				$result = $connection->prepare(TeamConstants::SELECT_CRITERIA_PARTID_TEAM_ACTION_PLAN);
			}
			$result->bind_param("i",$userID);
			$result->execute();
			$result->bind_result($criterionPartID, $criterionPartShortDescription,$criterionPartDefinition);
			
		   while($result->fetch()){
				
				$criteriado = new CriteriaDO();
				$criteriado->criterionid = $criterionPartID;
				$criteriado->criteriashortpartid = $criterionPartShortDescription;
				$criteriado->criteriadesc = $criterionPartDefinition;
				//return $criteriado->criterionid.' - '. $criteriado->criteriashortpartid.' - '.$criteriado->criteriadesc;
				$criteriaResult[] = $criteriado;
				unset($criteriado);
		   }
			$result->close();
			$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $criteriaResult;		
	}
	public function getTeamLeaderListRegLocation($locationID){
		
		try{
			
			$usernamearray = array();
			
			$database = new dbConnection();
			
			$connection = $database->getConnection();
			
			$result = $connection->prepare(TeamConstants::SELECT_TEAM_LEADER_REG_LOC);
			$result->bind_param("i",$locationID);
        	$result->execute();
        	
        	$result->bind_result($UserID,$UserName,$surName);
        	
			while($result->fetch()){
				$customerdO = new CustomerDO();
				$customerdO->userid = $UserID;
				
				$customerdO->username = $UserName . ' ' . $surName;
				$usernamearray[] = $customerdO;
				
			}
			$result->close();
			$connection->close();
			
		}
		catch(Exception $exception){
			die($exception);
		}
		
		return $usernamearray;
		
	}
	
	
	public function selectprojectsPriority(){
		
		try{
			
			$usernamearray = array();
			
			$database = new dbConnection();
			
			$connection = $database->getConnection();
			$priorityDO = new PriorityDO();
				
			$result = $connection->prepare(TeamConstants::SELECT_PROJECTS_PRIORITY);
			$result->execute();
        	$result->bind_result($value1,$value2,$value3);
        	
			while($result->fetch()){
				$priorityDO->value1 = $value1;
				$priorityDO->value2 = $value2;
				$priorityDO->value3 = $value3;
				
			}
			
			$result->close();
			$connection->close();
			
		}
		catch(Exception $exception){
			die($exception);
		}
		
		return $priorityDO;
		
	}
	
	
	public function updateprojectsPriority($value1, $value2, $value3){
		
		try{
			
			$database = new dbConnection();
			
			$connection = $database->getConnection();
			$count=0;
			$result = $connection->prepare(TeamConstants::SELECT_PROJECTS_PRIORITY);
			$result->execute();
			$result->bind_result($v1,$v2,$v2);
			while($result->fetch()){
				$count=1;
			}
			if($count==1)
				$result = $connection->prepare(TeamConstants::UPDATE_PROJECTS_PRIORITY);
			else
				$result = $connection->prepare(TeamConstants::INSERT_PROJECTS_PRIORITY);
			
			$result->bind_param("iii",$value1,$value2, $value3 );
        	$result->execute();
			$result->close();
			
			$value1 = ($value1 * 0.01);
			$value2 = ($value2 * 0.01);
			$value3 = ($value3 * 0.01);
			
			$result = $connection->prepare(TeamConstants::UPDATE_IND_PROJECTS_PRIORITY);
			$result->bind_param("ddd",$value1,$value2, $value3 );
        	$result->execute();
			
			$upstatus = $result->affected_rows;
			$result->close();
			$connection->close();
			
		}
		catch(Exception $exception){
			die($exception);
		}
		
		return $upstatus;
		
	}
	
 /*
 $connection = $database->getConnection();
				$result = $connection->prepare(TeamConstants::CHK_PROJ_PLAN_EXISTS_WHILE_UPDATE);
				$result->bind_param("ssi",$milestone, $activities, $activityID);
				$result->execute();
				$result->bind_result($cntMileStone);
				while($result->fetch()){
					$countMileStone = $cntMileStone;
				}
				$result->close();
				if($countMileStone==0){
 */
	public function viewScore($criteriaID,$locationID){
		
		try{
			
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(TeamConstants::SELECT_CRITERIA_SUB_TEAM_SCORE);
			$result->bind_param("ii",$criteriaID,$locationID);
			$result->execute();
			$result->bind_result($score);
			while($result->fetch()){
				$SubTeamScore = $score;
			}
			$connection->close();
			
		}
		catch(Exception $exception){
			die($exception);
		}
		
		return $SubTeamScore;
		
	}
	public function unselectExecutiveMemeber($locationID){
  
	  try{
		$teamarray = array();
		$database = new dbConnection();
		$connection = $database->getConnection();
		if($locationID==0){
			$result = $connection->prepare(TeamConstants::UNSELECT_EXECUTIVE_MEMBERS);
		}
		else{
			$result = $connection->prepare(TeamConstants::UNSELECT_EXECUTIVE_MEMBERS_REG_LOCATION);
		   $result->bind_param("i",$locationID);
	   }
	   $result->execute();
	   $result->bind_result($userID, $userName, $surName,$designation,$roleID,$roleName,$locationID, $location);
	   while($result->fetch()){
		$teamdo = new TeamDO();
		$teamdo->userid = $userID;
		$teamdo->userName = $userName . ' '. $surName;
		$teamdo->surName = $surName;
		$teamdo->designation = $designation;
		$teamdo->roleID = $roleID;
		$teamdo->roleName = $roleName;
		$teamdo->locationID = $locationID;
		$teamdo->location = $location;
		$teamarray[] = $teamdo;
	   }
	   $result->close();
	   $connection->close();
	  }
	  catch(Exception $exception){
	   die($exception);
	  }
	  return $teamarray;
	 }
	 
	 public function AddComments($approachID,$criteriaID,$userID,$roleID,$comments,$approachToLink,$subTeamActions){
		try{
			//return $approachID.' , '.$criteriaID.' , '.$userID.' , '.$roleID.' , '.$comments.' , '.$approachToLink.' , '.$subTeamActions;
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(TeamConstants::INSERT_ENABLER_COMMENTS);
			//return $approachID.' - '.$criteriaID.' - '.$userID.' - '.$roleID.' - '.$comments.' - '.$approachToLink;
			$result->bind_param("iiiisss",$approachID,$criteriaID,$userID,$roleID,$comments,$approachToLink,$subTeamActions);
			$result->execute();
			$rowInserted = $result->affected_rows;
			$result->close();
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $rowInserted;
	}
	public function viewExeComments($approachLink){
		try{
			$commentsArray= array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(TeamConstants::SELECT_EXE_COMMENTS);
			$result->bind_param("s",$approachLink);
			$result->execute();
			$result->bind_result($approachID,$criteriaID,$userName,$surName,$roleName,$userID,$roleID,$comments,$commentID,$approachToLink,$subTeamActions);
			$i=1;
			while($result->fetch()){
				
				$commentsDo = new CommentsDO();
				$commentsDo->sno=$i;
				$commentsDo->approachID=$approachID;
				$commentsDo->criteriaID=$criteriaID;
				$commentsDo->userName=$userName . ' ' . $surName. ' (' . $roleName . ')';
				$commentsDo->roleName=$roleName;
				$commentsDo->roleID=$roleID;
				$commentsDo->userID=$userID;
				$commentsDo->comments=$comments;
				$commentsDo->commentID=$commentID;
				$commentsDo->approachToLink=$approachToLink;
				$commentsDo->subTeamActions=$subTeamActions;
				$commentsArray[]=$commentsDo;
				$i=$i+1;
				unset($commentsDo);
				
			}
			$result->close();
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $commentsArray;
	}
	public function viewOverAllComments($criteria){
		try{
			$commentsArray= array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			if($criteria<25){
				$result = $connection->prepare(TeamConstants::SELECT_OVER_ALL_ENABLER_COMMENTS);
			}else{
				$result = $connection->prepare(TeamConstants::SELECT_OVER_ALL_RESULT_COMMENTS);
			}
			$result->bind_param("i",$criteria);
			$result->execute();
			$result->bind_result($approachTitle,$approachToLink,$comments,$criteriaID,$subteamActions,$approachID);
			$i=1;
			while($result->fetch()){
				
				$commentsDo = new CommentsDO();
				$commentsDo->sno=$i;
				$commentsDo->approachID=$approachID;
				$commentsDo->criteriaID=$criteriaID;
				$commentsDo->comments=$comments;
				$commentsDo->approachToLink=$approachToLink;
				$commentsDo->subTeamActions=$subTeamActions;
				$commentsDo->approachTitle=$approachTitle;
				$commentsArray[]=$commentsDo;
				$i=$i+1;
				unset($commentsDo);
				
			}
			$result->close();
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $commentsArray;
	}
	/*
	 public function AddProjectDetails(ProjectDetailsDO $projectDo){
		try{
			$database = new dbConnection();
			$connection = $database->getConnection();
			$countProjTitle=0;
			$projectID=0;
			
			$result = $connection->prepare(TeamConstants::CHK_PROJ_TITLE_EXISTS);
			$result->bind_param("s",$projectDo->projectTitle);
			$result->execute();
			$result->bind_result($cntProjTitle);
			while($result->fetch()){
				$countProjTitle=$cntProjTitle;
			}
			$countResp=0;
			
			
			if($countProjTitle==0){
				$result = $connection->prepare(TeamConstants::CHK_PROJECT_RESP_EXISTS);
				$result->bind_param("i",$projectDo->responsibility);
				$result->execute();
				$result->bind_result($cntProjResp);
				while($result->fetch()){
					$countResp=$cntProjResp;
				}
				if($countResp==0){
					$scoreSum=0;
					$result = $connection->prepare(TeamConstants::GET_SUM_OF_SCORE);
					$result->execute();
					$result->bind_result($sumScore);
					while($result->fetch()){
						$scoreSum=$sumScore;
					}
					$title=$projectDo->projectTitle;
					$responsibility=$projectDo->responsibility;
					$startDate=$projectDo->startDate;
					$endDate=$projectDo->endDate;
					$description=$projectDo->description;
					$orgStrategy=$projectDo->orgStrategy;
					$criterionPart=$projectDo->criterionPart;
					$implementation=$projectDo->implementation;
					$status=$projectDo->status;
					$score=$projectDo->score;
					$scoreSum=$scoreSum+$score;
					$priority=($score/$scoreSum)*100;
					
					$result = $connection->prepare(TeamConstants::INSERT_PROJECT_DETAILS);
					$result->bind_param("sisssiiisii",$title,$responsibility,$startDate,$endDate,$description,$orgStrategy,$criterionPart,$implementation,$status,$priority,$score);
					$result->execute();
					$rowInserted = $result->affected_rows;
					$result->close();
					if($rowInserted!=0){
						$result = $connection->prepare(TeamConstants::SELECT_PROJECT_ID);
						$result->execute();
						$result->bind_result($projID);
						while($result->fetch()){
							$projectID = $projID;
						}
						$result->close();
					}
				}
				else{
					$projectID=-1;
				}
			
			}
			else{
				$projectID=0;
			}
			
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $projectID;
	}*/
	public function SelectResponsibilityPersons(){
		try{
			$resposibilityArr= array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(TeamConstants::SELECT_RESPONSIBILITY_PERSON);
			$result->execute();
			$result->bind_result($userID,$userName,$surName);
			$i=1;
			while($result->fetch()){
				
				$commentsDo = new CommentsDO();
				$commentsDo->userName=$userName . ' ' . $surName;
				$commentsDo->userID=$userID;
				$resposibilityArr[]=$commentsDo;
				unset($commentsDo);
				
			}
			$result->close();
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $resposibilityArr;
	}
	 public function AddProjectApproachLinkDetails($projectApproachArr){
		try{
			$database = new dbConnection();
			$connection = $database->getConnection();
			//return count($projectApproachArr);
			for($i=0;$i<count($projectApproachArr);$i++){
			
				$projectDo=new ProjectDetailsDO();
				$projectDo = $projectApproachArr[$i];
				
				$projectID=$projectDo->projectID;
				$criteriaID=$projectDo->criteriaID;
				$dummyID=$projectDo->DummyApproachID;
				$approachID=$projectDo->approachID;
				$approachTitle=$projectDo->approachTitle;
				$type=$projectDo->type;
				$title=$projectDo->title;
				$strengthID=$projectDo->strengthID;
				$afiID=$projectDo->afiID;
				//return $projectID.' - '.$criteriaID.' - '.$approachID.' - '.$approachTitle.' - '.$type;
				$result = $connection->prepare(TeamConstants::INSERT_PROJECT_APPROACH_LINK_DETAILS);
				$result->bind_param("iiissiiss",$projectID,$criteriaID,$approachID,$approachTitle,$type,$strengthID,$afiID,$dummyID,$title);
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
	public function SelectAllProjects(){
		try{
			$projectArr= array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(TeamConstants::SELECT_ALL_PROJECTS);
			$result->execute();
			$result->bind_result($projectID,$title,$responsibility,$startDate,$endDate,$description,$orgStrategy,$criterionPart,$implementation,$status,$priority,$userName,$surName,$teamName);
			while($result->fetch()){
				$projectDo=new ProjectDetailsDO();
				$projectDo->projectID=$projectID;
				$projectDo->projectTitle=$title;
				$projectDo->responsibility=$responsibility;
				$projectDo->startDate=date('d-m-Y',strtotime($startDate));
				$projectDo->endDate=date('d-m-Y',strtotime($endDate));
				$projectDo->description=$description;
				$projectDo->orgStrategy=$orgStrategy;
				$projectDo->criterionPart=$criterionPart;
				$projectDo->implementation=$implementation;
				$projectDo->status=$status;
				$projectDo->priority=$priority;
				$projectDo->name=$userName. ' ' .$surName;
				$projectDo->teamName=$teamName;
				$projectArr[]=$projectDo;
				unset($projectDo);
			}
			$result->close();
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $projectArr;
	}
	public function UpdateProjectStatus($projectArr){
		try{
			$database = new dbConnection();
			$connection = $database->getConnection();
			for($i=0;$i<count($projectArr);$i++){
				$projectDo=new ProjectDetailsDO();
				$projectDo=$projectArr[$i];
				$status=$projectDo->status;
				$projectID=$projectDo->projectID;
				$result = $connection->prepare(TeamConstants::UPDATE_PROJECT_STATUS);
				$result->bind_param("si",$status,$projectID);
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
	public function UpdateProjectDetails(ProjectDetailsDO $projectDo){
		try{
			$database = new dbConnection();
			$connection = $database->getConnection();
			$countProjTitle=0;
				
			$result = $connection->prepare(TeamConstants::CHK_PROJ_TITLE_EXISTS_UPDATE);
			$result->bind_param("si",$projectDo->projectTitle,$projectDo->projectID);
			$result->execute();
			$result->bind_result($cntProjTitle);
			while($result->fetch()){
				$countProjTitle=$cntProjTitle;
			}
			if($countProjTitle==0){
				$countResp=0;
				/*$result = $connection->prepare(TeamConstants::CHK_PROJECT_RESP_EXISTS_UPDATE);
				$result->bind_param("ii",$projectDo->responsibility,$projectDo->projectID);
				$result->execute();
				$result->bind_result($cntProjResp);
				while($result->fetch()){
					$countResp=$cntProjResp;
				}
				$result->close();*/
				
				$result = $connection->prepare(TeamConstants::SELECT_PROJECTS_PRIORITY);
				$result->execute();
				$result->bind_result($value1,$value2,$value3);
				while($result->fetch()){
					$priorityvalue1 = $value1;
					$priorityvalue2 = $value2;
					$priorityvalue3 = $value3;
				}
				$result->close();
				
				$priorityvalue1 = $priorityvalue1 / 100;
				$priorityvalue2 = $priorityvalue2 / 100;
				$priorityvalue3 = $priorityvalue3 / 100;
				
				if($countResp==0){
					$projectID=$projectDo->projectID;
					$title=$projectDo->projectTitle;
					$responsibility=$projectDo->responsibility;
					$startDate=$projectDo->startDate;
					$endDate=$projectDo->endDate;
					$description=$projectDo->description;
					$expectedBenefits=$projectDo->expectedBenefits;
					$requiredResources=$projectDo->requiredResources;
					
					$orgStrategy=$projectDo->orgStrategy;
					$criterionPart=$projectDo->criterionPart;
					$implementation=$projectDo->implementation;
					$priority = (($orgStrategy * $priorityvalue1) + ($criterionPart * $priorityvalue2) +( $implementation * $priorityvalue3)) ;
					$progressReport=$projectDo->progressReport;
					$userID=$projectDo->userID;
					$createdAt=$projectDo->createdAt;
					$score=$projectDo->score;
					
					//return $priority ."-->".$orgStrategy."-->". $priorityvalue1 ."-->". $criterionPart ."-->". $priorityvalue2 ."-->". $implementation ."-->". $priorityvalue3;
					
					$result = $connection->prepare(TeamConstants::UPDATE_PROJECT_DETAILS);
					$result->bind_param("sisssiiiisssi",$title,$responsibility,$startDate,$endDate,$description,$orgStrategy,$criterionPart,$implementation,$score,$priority,$requiredResources,$expectedBenefits,$projectID);
					$result->execute();
					$rowUpdated = $result->affected_rows;
					$result->close();
					if($progressReport!=''){
						$result = $connection->prepare(TeamConstants::INSERT_PROJECT_PROGRESS_DETAILS);
						$result->bind_param("isis",$projectID,$progressReport,$userID,$createdAt);
						$result->execute();
						$rowUpdated = $result->affected_rows;
						$result->close();
					}
					//$sateam = new SATeam();
					//$sateam->updateProjectTeamScore();
				}
				else{
					$rowUpdated=-2;
				}
			}
			else{
				$rowUpdated = -1;
			}
			
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $rowUpdated;
	}
	public function SelectProjectProgressDetails($projectID){
		try{
			$projectArr= array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(TeamConstants::SELECT_PROJECT_PROGRESS_DETAILS);
			$result->bind_param("i",$projectID);
			$result->execute();
			$result->bind_result($projectID,$progressID,$progressReport,$userID,$createdAt,$userName,$surName,$roleName);
			while($result->fetch()){
				$projectDo=new ProjectDetailsDO();
				$projectDo->projectID=$projectID;
				$projectDo->progressReport=$progressReport;
				$projectDo->userID=$userID;
				$projectDo->createdAt=date('d-m-Y',strtotime($createdAt));
				$projectDo->name=$userName . ' ' . $surName. ' (' . $roleName . ')';
				$projectDo->roleName=$roleName;
				$projectArr[]=$projectDo;
				unset($projectDo);
			}
			$result->close();
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $projectArr;
	}
	
	
	public function projectDeletion($projectID){
		try{
			$database = new dbConnection();
			$connection = $database->getConnection();
			
			$result = $connection->prepare(TeamConstants::DELETE_PROJECT_APPROACH_DETAILS);
			$result->bind_param("i",$projectID);
			$result->execute();
			$rowDeleted = $result->affected_rows;
			$result->close();
			
			$result = $connection->prepare(TeamConstants::DELETE_PROJECT_PROGRESS_REPORT_DETAILS);
			$result->bind_param("i",$projectID);
			$result->execute();
			$rowDeleted = $result->affected_rows;
			$result->close();
			
			$result = $connection->prepare(TeamConstants::DELETE_PROJECT_DETAILS);
			$result->bind_param("i",$projectID);
			$result->execute();
			$rowDeleted = $result->affected_rows;
			$result->close();
			
			$sateam = new SATeam();
			$sateam->updateProjectTeamScore();
			
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $rowDeleted;
	}
	
	 public function selectProjectTeamMember($projectID){
  
	  try{
	   $teamarray = array();
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   
	   $result = $connection->prepare(TeamConstants::SELECT_LOCATION_FOR_PROJ_RESP);
	   $result->bind_param("i",$projectID);
	   $result->execute();
	   $result->bind_result($locID);
	   while($result->fetch()){
			$locationID=$locID;
	   }
	  
	   $result = $connection->prepare(TeamConstants::SELECT_PROJECT_TEAM_MEMBERS);
	   $result->bind_param("ii",$projectID,$locationID);
	   $result->execute();
	   $result->bind_result($userID, $userName, $surName,$designation,$roleName,$locationID, $location,$projectID);
	   while($result->fetch()){
		$teamdo = new TeamDO();
		$teamdo->userid = $userID;
		$teamdo->userName = $userName;
		$teamdo->surName = $surName;
		$teamdo->designation = $designation;
		$teamdo->roleName = $roleName;
		$teamdo->locationID = $locationID;
		$teamdo->location = $location;
		if($projectID!=null){
			$teamdo->flag = true;
		}
		else{
			$teamdo->flag = false;
		}
		$teamarray[] = $teamdo;
	   }
	   $result->close();
	   $connection->close();
	  }
	  catch(Exception $exception){
	   die($exception);
	  }
	  return $teamarray;
	 }
	 public function updateProjectTeamMembers($proj_Array,$projID,$team){
		try{
			$database = new dbConnection();
			$connection = $database->getConnection();
			$rowInserted =0;
			$countTeamName=0;
			
			$result = $connection->prepare(TeamConstants::CHK_PROJECT_TEAM_NAME_EXISTS);
			$result->bind_param("si",$team,$projID);
			$result->execute();
			$result->bind_result($cntTeamName);
			while($result->fetch()){
				$countTeamName=$cntTeamName;
			}
			$result->close();
			if($countTeamName==0){
				$result = $connection->prepare(TeamConstants::UPDATE_PROJECT_TEAM_NAME_ONLY);
				$result->bind_param("si",$team,$projID);
				$result->execute();
				$rowInserted = $result->affected_rows;
				$result->close();
				
				$result = $connection->prepare(TeamConstants::DELETE_PROJECT_TEAM_MEMBERS);
				$result->bind_param("i",$projID);
				$result->execute();
				$rowDeleted = $result->affected_rows;
				$result->close();
				
				for($i=0;$i<count($proj_Array);$i++){
					$projectDo=new ProjectDetailsDO();
					$projectDo=$proj_Array[$i];
					$UserID=$projectDo->userID;
					//return 	$UserID;	
					$result = $connection->prepare(TeamConstants::INSERT_PROJECT_TEAM_MEMBERS);
					$result->bind_param("ii",$projID,$UserID);
					$result->execute();
					$rowInserted = $result->affected_rows;
					$result->close();

				}
			}
			else{
				$rowInserted=0;
			}
			
			
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $rowInserted;
	}
	public function selectProjectTeamNameList(){
		try{
			$projectArr= array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(TeamConstants::SELECT_ALL_PROJECT_TEAM_NAME);
			$result->execute();
			$result->bind_result($teamname);
			while($result->fetch()){
				$projectDo=new ProjectDetailsDO();
				$projectDo->teamName=$teamname;
				$projectArr[]=$projectDo;
				unset($projectDo);
			}
			$result->close();
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $projectArr;
	}
	public function SearchProjects($projName,$priority){
		try{
			$projectArr= array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			
			
			if($priority=='0'){
				$priority ='';
			}
			else{
				$priority=$priority;
			}
			
			
			if($priority==''){
			
				if ($projName == '')
					$projName = '%';
				else {
					$projName='%'.$projName.'%';
				}
				$result = $connection->prepare(TeamConstants::SEARCH_PROJECT_DETAILS_REG_PNAME);
				$result->bind_param("s",$projName);
			}
			else{
				$priority=$priority.'%';
				
				if ($projName == '')
					$projName = '%';
				else {
					$projName='%'.$projName.'%';
				}
				
				$result = $connection->prepare(TeamConstants::SEARCH_PROJECT_DETAILS_REG_PNAME_PRIORITY);
				$result->bind_param("ss",$projName,$priority);
			}
			
			
			
			/*
			if($teamName=='All' && $priority!=''){
				$priority=$priority.'%';
				$result = $connection->prepare(TeamConstants::SEARCH_PROJECT_DETAILS_REG_PRIORITY);
				$result->bind_param("s",$priority);
			}
			else if($priority=='' and $teamName!='All'){
				$teamName='%'.$teamName.'%';
				$result = $connection->prepare(TeamConstants::SEARCH_PROJECT_DETAILS_REG_TNAME);
				$result->bind_param("s",$teamName);
			}
			else if($priority=='' and $teamName=='All'){
			
				//return 123123;
				$result = $connection->prepare(TeamConstants::SEARCH_PROJECT_DETAILS_LIST);
			}
			else{
				$priority=$priority.'%';
				$teamName='%'.$teamName.'%';
				$result = $connection->prepare(TeamConstants::SEARCH_PROJECT_DETAILS_REG_TNAME_PRIORITY);
				$result->bind_param("ss",$teamName,$priority);
			}
			*/
			$result->execute();
			$result->bind_result($projectID,$title,$responsibility,$startDate,$endDate,$description,$orgStrategy,$criterionPart,$implementation,$status,$priority,$userName,$surName,$teamName, $requiredResources, $expectedBenefits);
			while($result->fetch()){
				$projectDo=new ProjectDetailsDO();
				$projectDo->projectID=$projectID;
				$projectDo->projectTitle=$title;
				$projectDo->responsibility=$responsibility;
				$projectDo->startDate=date('d-m-Y',strtotime($startDate));
				$projectDo->endDate=date('d-m-Y',strtotime($endDate));
				$projectDo->description=$description;
				$projectDo->orgStrategy=$orgStrategy;
				$projectDo->criterionPart=$criterionPart;
				$projectDo->implementation=$implementation;
				$projectDo->status=$status;
				$projectDo->priority=$priority;
				$projectDo->name=$userName. ' ' .$surName;
				$projectDo->expectedBenefits=$expectedBenefits;
				$projectDo->requiredResources=$requiredResources;
				
				if($teamName=='')
					$projectDo->teamName='Not assigned';
				else
					$projectDo->teamName=$teamName;
				$projectArr[]=$projectDo;
				unset($projectDo);
			}
			$result->close();
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $projectArr;
	}
	
	
	public function SearchProjectReports($projectName,$Status){
		try{
		
			$projectArr= array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			
			if ($projectName != null || $projectName != "") {
				$projectName='%'.$projectName.'%';
			}
			else {
				$projectName='%';
			}
			
			if ($Status != null || $Status != "") {
				$Status='%'.$Status.'%';
			}
			else {
				$Status='%';
			}
				
			$result = $connection->prepare(TeamConstants::SEARCH_PROJECT_REPORTS_DETAILS);
			$result->bind_param("ss",$projectName,$Status);
			
			$result->execute();
			$result->bind_result($projectID,$title,$responsibility,$startDate,$endDate,$description,$orgStrategy,$criterionPart,$implementation,$status,$priority,$userName,$surName,$teamName);
			while($result->fetch()){
				$projectDo=new ProjectDetailsDO();
				$projectDo->projectID=$projectID;
				$projectDo->projectTitle=$title;
				$projectDo->responsibility=$responsibility;
				$projectDo->startDate=date('d-m-Y',strtotime($startDate));
				$projectDo->endDate=date('d-m-Y',strtotime($endDate));
				$projectDo->description=$description;
				$projectDo->orgStrategy=$orgStrategy;
				$projectDo->criterionPart=$criterionPart;
				$projectDo->implementation=$implementation;
				$projectDo->status=$status;
				$projectDo->priority=$priority;
				$projectDo->name=$userName. ' ' .$surName;
				
				if($teamName=='')
					$projectDo->teamName='Not assigned';
				else
					$projectDo->teamName=$teamName;
				$projectArr[]=$projectDo;
				unset($projectDo);
			}
			$result->close();
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $projectArr;
	}
	
	public function AddProjectDetails(ProjectDetailsDO $projectDo){
		try{
			$database = new dbConnection();
			$connection = $database->getConnection();
			$countProjTitle=0;
			$projectID=0;
			
			$result = $connection->prepare(TeamConstants::CHK_PROJ_TITLE_EXISTS);
			$result->bind_param("s",$projectDo->projectTitle);
			$result->execute();
			$result->bind_result($cntProjTitle);
			while($result->fetch()){
				$countProjTitle=$cntProjTitle;
			}
			$countResp=0;
			
			
			if($countProjTitle==0){
				
				/*$result = $connection->prepare(TeamConstants::CHK_PROJECT_RESP_EXISTS);
				$result->bind_param("i",$projectDo->responsibility);
				$result->execute();
				$result->bind_result($cntProjResp);
				while($result->fetch()){
					$countResp=$cntProjResp;
				}*/
				if($countResp==0){
					$title=$projectDo->projectTitle;
					$responsibility=$projectDo->responsibility;
					$startDate=$projectDo->startDate;
					$endDate=$projectDo->endDate;
					$description=$projectDo->description;
					$orgStrategy=$projectDo->orgStrategy;
					$criterionPart=$projectDo->criterionPart;
					$implementation=$projectDo->implementation;
					$expectedBenefits = $projectDo->expectedBenefits;
					$requiredResources = $projectDo->requiredResources;
					$status=$projectDo->status;
					$score=$projectDo->score;
					
					$result = $connection->prepare(TeamConstants::INSERT_PROJECT_DETAILS);
					$result->bind_param("sisssiiisiss",$title,$responsibility,$startDate,$endDate,$description,$orgStrategy,$criterionPart,$implementation,$status,$score, $expectedBenefits, $requiredResources);
					$result->execute();
					$rowInserted = $result->affected_rows;
					$result->close();
					if($rowInserted!=0){
						$result = $connection->prepare(TeamConstants::SELECT_PROJECT_ID);
						$result->execute();
						$result->bind_result($projID);
						while($result->fetch()){
							$projectID = $projID;
						}
						$result->close();
						$sateam=new SATeam();
						$toEmail=$sateam->fetchMailID($responsibility);
						$mail=new Mail_SA();
						$content="<html><head><title></title></head><body>You have been assigned the responsibility for <b>'".$title."'</b> improvement project. Please find details below:<br/><b>Expected Start Date</b>:".$startDate."<br/><b>Expected End Date</b>:".$endDate."<br/>Please log in to excellence builder to view the complete details of the improvement project.<br/>Kindly request to enter the timely progress of the project once the project is approved.</body></html>";
						$mail->sendMail($toEmail,"Excellence builder - Improvement project Assigned",$content);
					}
					$sateam = new SATeam();
					$sateam->updateProjectTeamScore();
				}
				else{
					$projectID=-1;
				}
			
			}
			else{
				$projectID=0;
			}
			
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $projectID;
	}
	public function sendRequestProgressMail($fromMailID,$responsibility,$msg){
		$sateam=new SATeam();
		$toEmail=$sateam->fetchMailID($responsibility);
		$mail=new Mail_SA();
		$status=$mail->sendMailFrom($fromMailID,$toEmail,"Request progress",$msg);
		return $status;
		//return $fromMailID.' - '.$toEmail.' - '.$msg;
	}
	public function fetchMailID($userID){
		$emailID="";
		$database = new dbConnection();
		$connection = $database->getConnection();
		$result = $connection->prepare(TeamConstants::SELECT_E_MAIL_ID);
		$result->bind_param("i",$userID);
		$result->execute();
		$result->bind_result($mailID);
		while($result->fetch()){
			$emailID=$mailID;
		}
		$result->close();
		$connection->close();
		return $emailID;
	}
    public function updateProjectTeamScore(){
		try{
			$projectArr= array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			$scoreSum=0;
			$result = $connection->prepare(TeamConstants::GET_SUM_OF_SCORE);
			$result->execute();
			$result->bind_result($sumScore);
			while($result->fetch()){
				$scoreSum=$sumScore;
			}
			$result = $connection->prepare(TeamConstants::UPDATE_PROJECT_PRIORITY_DETAILS);
			$result->bind_param("i",$scoreSum);
			$result->execute();
			$rowInserted = $result->affected_rows;
			$result->close();
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $scoreSum;
	}
	
	public function chkProjRespExists($userID){
		try{
			$projectArr= array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			$countResp=0;
			$result = $connection->prepare(TeamConstants::CHK_PROJECT_RESP_EXISTS);
			$result->bind_param('i',$userID);
			$result->execute();
			$result->bind_result($cntResp);
			while($result->fetch()){
				$countResp=$cntResp;
			}
			$result->close();
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $countResp;
	}
	
	
	public function SelectProjectApproachLinkDetails($criteriaID){
		try{
			$temparray = array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(TeamConstants::SELECT_PROJECT_APPROACH_LINK_DETAILS);
			//$result->bind_param("i",$criteriaID);
			$result->execute();
			$result->bind_result($projectID,$criteriaID,$approachID,$approachTitle,$type,$strengthID,$afiID);
			//return count($projectApproachArr);
			while($result->fetch()){
			
				$projectDo=new ProjectDetailsDO();
				$projectDo->projectID=$projectID;
				$projectDo->criteriaID=$criteriaID;
				$projectDo->approachID=$approachID;
				$projectDo->approachTitle=$approachTitle;
				$projectDo->type=$type;
				$projectDo->strengthID=$strengthID;
				$projectDo->afiID=$afiID;
				$temparray[]=$projectDo;
				unset($projectDo);
			}
			$result->close();
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $temparray;
	}
	public function SelectAttachedDocReport($name){
		try{
			$temparray = array();
			if($name==""){
				$name = '%';
			}
			else{
				$name = '%' . $name . '%';
			}
			
			
			//$result = $connection->prepare(TeamConstants::SELECT_REPORT_DOCUMENT);
			$query = "select e.ApproachTitle,e.DummyEnablerID as DummyID,e.CriterionPartID,CriterionPartShortDescription,CriteriaID,";
			$query = $query . " doc.EnablerAssessmentID,EnablerDocumentID,doc.EnablerDocument,EnablerDocumentDesc,'Enabler' as type from enablerdocument doc,enablerassessment e inner join criterionpart c ON c.CriterionPartID = e.CriterionPartID ";
			$query = $query . " where doc.EnablerDocument like '". $name ."' and doc.EnablerAssessmentID=e.EnablerAssessmentID union all select r.Result,r.DummyResultID as DummyID,r.CriterionPartID,CriterionPartShortDescription,CriteriaID, doc.ResultAssessmentID,ResultDocumentID,doc.ResultDocument,ResultDocumentDesc,'Result' as type from resultdocument doc,resultassessment r inner join criterionpart c ON c.CriterionPartID = r.CriterionPartID ";
			$query = $query . " where doc.ResultDocument like '". $name ."' and doc.ResultAssessmentID=r.ResultAssessmentID union all select P.Title,0 as DummyID,P.ProjectID, P.Title, P.Description, pdoc.project_name, pdoc.project_id, pdoc.project_document_name, pdoc.project_desc,'Project' as type from projectdetails P, tbl_project_document pdoc where pdoc.project_name = P.ProjectID and pdoc.project_document_name like '". $name ."';";
			//return $query;
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare($query);
			$result->execute ();
			$result->bind_result($title,$dummyID,$criterionPartID,$criterionPartShortDescription,$criteriaID,$enablerAssessmentID,$enablerDocumentID,$enablerDocument,$enablerDocumentDesc,$type);
			while($result->fetch()){
				$enablerDocDo = new EnablerDocumentDO();
				$enablerDocDo->title=$title;
				$enablerDocDo->enablerassessmentid = $enablerAssessmentID;
				$enablerDocDo->enablerdocumentid = $enablerDocumentID;
				$enablerDocDo->enablerdocument = $enablerDocument;
				$enablerDocDo->enablerdocumentdesc = $enablerDocumentDesc;
				$enablerDocDo->criterionPartID = $criterionPartID;
				if($type=='Project')
					$enablerDocDo->criterionPartShortDescription = $criterionPartShortDescription;
				else
				$enablerDocDo->criterionPartShortDescription = $criterionPartShortDescription.'('.$dummyID.')';
				$enablerDocDo->criteriaID = $criteriaID;
				$enablerDocDo->type = $type;
				
				$temparray[]=$enablerDocDo;
				unset($enablerDocDo);
			}
			$result->close();
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $temparray;
	}
	public function SelectSourceOfInformation($word){
		try{
			$temparray = array();
			if($word=="" ){
				$word = '%';
			}
			else{
				$word = '%' . $word . '%';
			}
			
			
			$query = "select e.DummyEnablerID as DummyID,e.CriterionPartID,CriterionPartShortDescription,CriteriaID,";
			$query = $query . " e.EnablerAssessmentID,SourceOfInformation,'Enabler' as type,e.ApproachTitle as Title";
			$query = $query . " from enablerassessment e ";
			$query = $query . " inner join criterionpart c ON c.CriterionPartID = e.CriterionPartID ";
			$query = $query . " where SourceOfInformation like '". $word ."'  and SourceOfInformation!=''";
			$query = $query . " union all select r.DummyResultID as DummyID,r.CriterionPartID,CriterionPartShortDescription,CriteriaID,";
			$query = $query . " r.ResultAssessmentID,SourceOfInformation,'Result' as type,r.Result as Title";
			$query = $query . " from resultassessment r ";
			$query = $query . " inner join criterionpart c ON c.CriterionPartID = r.CriterionPartID";
			$query = $query . " where SourceOfInformation like '". $word ."'  and SourceOfInformation!='';";
			
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare($query);
			$result->execute ();
			
			$result->bind_result($dummyID,$criterionPartID,$criterionPartShortDescription,$criteriaID,$enablerAssessmentID,$source,$type,$title);
			while($result->fetch()){
				$enablerDocDo = new EnablerDocumentDO();
				$enablerDocDo->enablerassessmentid = $enablerAssessmentID;
				$enablerDocDo->criterionPartID = $criterionPartID;
				$enablerDocDo->criterionPartShortDescription = $criterionPartShortDescription .'('.$dummyID.')';
				$enablerDocDo->criteriaID = $criteriaID;
				$enablerDocDo->type = $type;
				$enablerDocDo->source = $source;
				$enablerDocDo->title = $title;
				$temparray[]=$enablerDocDo;
				unset($enablerDocDo);
			}
			$result->close();
			$connection->close();
	    }
	    catch(Exception $exception){
	       die($exception);
	    }
		return $temparray;
	}
	public function SelectAllApproaches($locationID){
		try{
		   
		   $subteamarray = array();
		   
		   $database = new dbConnection();
		   $connection = $database->getConnection();
		   $result = $connection->prepare(TeamConstants::SELECT_ALL_APPROACH_DETAILS);
		   $result->bind_param("ii",$locationID,$locationID);
		   $result->execute();
		   $result->bind_result($dummyID,$enablerID,$criterionPartID,$CriterionPartShortDescription,$approachTitle,$strength,$areaforimprovement,$StrengthLen,$AFILen);
		   
		   while($result->fetch()){
			
			$enablerassessmendo = new EnablerAssessmentDO();
			
			
			$enablerassessmendo->enablerID = $enablerID;
			$enablerassessmendo->criteriaID = $criterionPartID;
			$enablerassessmendo->dummyEnablerID = $dummyID;
			
			$enablerassessmendo->CriterionPartShortDescription = $CriterionPartShortDescription . '(' . $dummyID . ')';
			
			
			$enablerassessmendo->criteriaShortDesc = $CriterionPartShortDescription;
			$enablerassessmendo->approachTitle = $approachTitle;
			
			$enablerassessmendo->strength = $strength;
			$enablerassessmendo->areaforimprovement = $areaforimprovement;
			
			$enablerassessmendo->strengthLen = $StrengthLen;
			$enablerassessmendo->afiLen = $AFILen;
			
			$subteamarray[] = $enablerassessmendo;
			unset($enablerassessmendo);
		   }
		   
		   $result->close();
		   $connection->close();
		  }
		  catch(Exception $exception){
		   die($exception);
		  }
		  return $subteamarray;
	}
	public function SelectCriteriaOwner($criteriaID){
		try{
		   
		   $owner="";
		   
		   $database = new dbConnection();
		   $connection = $database->getConnection();
		   $result = $connection->prepare(TeamConstants::SELECT_CRITERIA_OWNER);
		   $result->bind_param("i",$criteriaID);
		   $result->execute();
		   $result->bind_result($teamID,$teamName,$teamLeader,$userName,$surName);
		   while($result->fetch()){
				if($owner==""){
					$owner = $teamName. ' - ' .$userName.' '.$surName;
					
				}
				else{
					$owner = $owner.' , '.$teamName. ' - ' .$userName.' '.$surName;
				}
				
		   }
		   
		   $result->close();
		   $connection->close();
		  }
		  catch(Exception $exception){
		   die($exception);
		  }
		  return $owner;
	} 
	
	public function insertProjectDocument($project_name,$file_name,$file_desc){
  
		try{
			   
			$database = new dbConnection();
			$connection = $database->getConnection();	
			$cnt=0;
			$result = $connection->prepare(TeamConstants::CHK_FILE_EXISTS_PROJ);
			$result->bind_param("ss",$project_name,$file_name);
			$result->execute();
			$result->bind_result($proj_cnt);
			while($result->fetch()){
				$cnt=$proj_cnt;
			}
			if($cnt==0){
				$result = $connection->prepare(TeamConstants::INSERT_PROJECT_DOCUMENT_INFO);
				$result->bind_param("sss",$project_name,$file_name,$file_desc);
				$result->execute();
				$rowInserted = $result->affected_rows;
				$result->close();
			}
			
			$connection->close();
			
		}catch(Exception $exception){		
			die($exception);
		}
		return $rowInserted;
	}
	/*
	public function getProjectDocuments($project_name){
		try{		   
		   $project_Arr = array();
		   $count = 0;
		   $database = new dbConnection();
		   $connection = $database->getConnection();
		   $result = $connection->prepare(TeamConstants::GET_PROJECT_DOCUMENTS);
		   $result->bind_param("s",$project_name);
		   $result->execute();
		   $result->bind_result($file_name,$file_desc, $projectname, $project_id);
		   while($result->fetch()){
				$project_Arr[$count]['projectdocument'] = $file_name;
				$project_Arr[$count]['projectdocumentdesc'] = $file_desc;
				$project_Arr[$count]['projectid'] = $project_id;
				
				$resultdocumentdo = new ResultDocumentDO();
				$resultdocumentdo->resultassessmentid = $projectname;
				$resultdocumentdo->resultdocumentid = $project_id;
				$resultdocumentdo->resultdocument = $file_name;
				$resultdocumentdo->resultdocumentdesc = $file_desc;
				$project_Arr[] = $resultdocumentdo;
				$count++;
				unset($resultdocumentdo);
		   }		   
		   $result->close();
		   $connection->close();
		  }
		  catch(Exception $exception){
		   die($exception);
		  }
		  return $project_Arr;
	}
	*/
	public function getProjectDocuments($project_name){
  
	try{
   
	$projectArr = array();
	
	$count = 0;
	$database = new dbConnection();
	$connection = $database->getConnection();
	$result = $connection->prepare(TeamConstants::GET_PROJECT_DOCUMENTS);
	$result->bind_param("s",$project_name);
	$result->execute();
	$result->bind_result($file_name,$file_desc, $projectname, $project_id);
		   
	while($result->fetch()){
		$resultdocumentdo = new ResultDocumentDO();
		$resultdocumentdo->resultassessmentid = $projectname;
		$resultdocumentdo->resultdocumentid = $project_id;
		$resultdocumentdo->resultdocument = $file_name;
		$resultdocumentdo->resultdocumentdesc = $file_desc;
		$projectArr[] = $resultdocumentdo;
		//$count++;
		unset($resultdocumentdo);
		
	}
	
	$result->close();
	$connection->close();
  }
  catch(Exception $exception){
   die($exception);
  }
  return $projectArr;
 }
	
	
	public function deleteProjectDocument($project_id){
  
		try{
			   
			$database = new dbConnection();
			$connection = $database->getConnection();				   
			$result = $connection->prepare(TeamConstants::DELETE_PROJECT_DOCUMENT);
			$result->bind_param("s",$project_id);
			$result->execute();
			$rowDeleted = $result->affected_rows;
			$result->close();
			$connection->close();
			
		}catch(Exception $exception){		
			die($exception);
		}
		return $rowDeleted;
	}
	public function selectStrength($approachID,$type){
		try{
		//return $approachID.' - '.$type;
			$strengthArr = array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			if($approachID==0){
				$result = $connection->prepare(TeamConstants::SELECT_STRENGTH_ALL);
			}
			else{
				$result = $connection->prepare(TeamConstants::SELECT_STRENGTH);
				$result->bind_param("is",$approachID,$type);
			}
			
			$result->execute();
			$result->bind_result($strengthID,$criterionPartID,$approachID,$type,$strength);
			$i=1;
			while($result->fetch()){
				$strengthDO = new StrengthDO();
				$strengthDO->strengthID = $strengthID;
				$strengthDO->criterionPartID = $criterionPartID;
				$strengthDO->approachID = $approachID;
				$strengthDO->type = $type;
				$strengthDO->strength = $strength;
				$strengthDO->deleteVisible = true;
				$strengthDO->Index = $i;
				$i++;
				$strengthArr[] = $strengthDO;
				unset($strengthDO);
				
			}
			
			$result->close();
			$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $strengthArr;
	}
	public function selectAFI($approachID,$type){
		//return 'Calling';
		try{
	   
			$afiArr = array();
			
			$database = new dbConnection();
			$connection = $database->getConnection();
			if($approachID==0){
				$result = $connection->prepare(TeamConstants::SELECT_AFI_ALL);
			}
			else{
				$result = $connection->prepare(TeamConstants::SELECT_AFI);
				$result->bind_param("is",$approachID,$type);
			}
			
			$result->execute();
			$result->execute();
			$result->bind_result($afiID,$criterionPartID,$appID,$typeAFI,$afi);
			$i=1;
			while($result->fetch()){
				$afiDO = new AFIDO();
				$afiDO->afiID = $afiID;
				$afiDO->criterionPartID = $criterionPartID;
				$afiDO->approachID = $appID;
				$afiDO->type = $typeAFI;
				$afiDO->afi = $afi;
				$afiDO->Index = $i;
				$i++;
				$bool=true;
				$afiDO->deleteVisible = $bool;
				$afiArr[] = $afiDO;
				//return $afiDO->afiID.' - '. $afiDO->afi;
				unset($afiDO);
				
			}
			
			$result->close();
			$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $afiArr;
	}
	public function insertStrength($approachStrengthArr,$appID,$approachType){
		try{
			$database = new dbConnection();
			$connection = $database->getConnection();
			$wholeStrength="";
			$result = $connection->prepare(TeamConstants::DELETE_STRENGTH);
			$result->bind_param("is",$appID,$approachType);
			$result->execute();
			
			for($i=0;$i<count($approachStrengthArr);$i++){
				$strengthDO = new StrengthDO();
				$strengthDO = $approachStrengthArr[$i];
				$criterionPartID = $strengthDO->criterionPartID;
				$approachID = $strengthDO->approachID;
				$type = $strengthDO->type;
				$strength = $strengthDO->strength;
				if($wholeStrength==""){
					$wholeStrength = $strength;
				}
				else{
					$wholeStrength = $wholeStrength.':@@:'.$strength;
				}
				$result = $connection->prepare(TeamConstants::INSERT_STRENGTH);
				$result->bind_param("iiss",$criterionPartID,$approachID,$type,$strength);
				$result->execute();
				$rowInserted = $result->affected_rows;
				$result->close();
				
			}
			if($approachType=='Enabler'){
				$result = $connection->prepare(TeamConstants::UPDATE_ENABLER_STRENGTH);
			}
			else{
				$result = $connection->prepare(TeamConstants::UPDATE_RESULT_STRENGTH);
			}
			$result->bind_param("sii",$wholeStrength,count($approachStrengthArr),$appID);
			$result->execute();
			$result->close();
			$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $rowInserted;
	}
	
	public function insertAFI($approachAFIArr,$appID,$approachType){
		try{
			$database = new dbConnection();
			$connection = $database->getConnection();
			$wholeAFI="";
			$result = $connection->prepare(TeamConstants::DELETE_AFI);
			$result->bind_param("is",$appID,$approachType);
			$result->execute();
			
			for($i=0;$i<count($approachAFIArr);$i++){
				$afiDO = new AFIDO();
				$afiDO = $approachAFIArr[$i];
				$criterionPartID = $afiDO->criterionPartID;
				$approachID = $afiDO->approachID;
				$type = $afiDO->type;
				$afi = $afiDO->afi;
				if($wholeAFI==""){
					$wholeAFI = $afi;
				}
				else{
					$wholeAFI = $wholeAFI.':@@:'.$afi;
				}
				$result = $connection->prepare(TeamConstants::INSERT_AFI);
				$result->bind_param("iiss",$criterionPartID,$approachID,$type,$afi);
				$result->execute();
				$rowInserted = $result->affected_rows;
				$result->close();
				
			}
			if($approachType=='Enabler'){
				$result = $connection->prepare(TeamConstants::UPDATE_ENABLER_AFI);
			}
			else{
				$result = $connection->prepare(TeamConstants::UPDATE_RESULT_AFI);
			}
			$result->bind_param("sii",$wholeAFI,count($approachAFIArr),$appID);
			$result->execute();
			$result->close();
			$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $rowInserted;
	}
	public function selectMissingApproaches(){
		try{
			$approachesArr = array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(TeamConstants::SELECT_MISSING_APPROACHES);
			$result->execute();
			$result->bind_result($dummyID,$assessmentID,$criterionPartID,$title,$type,$CriterionPartShortDescription);
			while($result->fetch()){
				$assessmentDO = new EnablerAssessmentDO();
				$assessmentDO->enablerID = $assessmentID;
				$assessmentDO->criteriaID = $criterionPartID;
				$assessmentDO->approachTitle = $title;
				$assessmentDO->type = $type;
				$assessmentDO->criteriaShortDesc = $CriterionPartShortDescription .'('.$dummyID.')';
				$approachesArr[] = $assessmentDO;
				unset($assessmentDO);
				
			}
			
			$result->close();
			$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $approachesArr;
	}
	public function getProjectApproachDetails($projectID){
		try{
			$projectApproach = array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(TeamConstants::SELECT_PROJECT_APPROACH_DETAILS);
			$result->bind_param('i',$projectID);
			$result->execute();
			$result->bind_result($dummyID,$type,$apptitle,$title);
			while($result->fetch()){
				$projectDo=new ProjectDetailsDO();
				$projectDo->DummyApproachID=$dummyID;
				$projectDo->approachTitle=$apptitle;
				$projectDo->type=$type;
				$projectDo->title=$title;
				$projectApproach[] = $projectDo;
				unset($projectDo);
				
			}
			
			$result->close();
			$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $projectApproach;
	}
}	
?>