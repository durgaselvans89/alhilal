<?php

require_once ('com/DBConnection/dbConnection.php');
require_once ('com/DAOConstants/MeetingConstants.php');
require_once ('com/VO/MeetingDO.php');
require_once ('com/VO/CustomerDO.php');
require_once ('Mail_SA.php');

class SAMeeting{
	
	/* 
	Description : To create the meeting. Meeting id is autoincrement.
	Paramenter  : MeetingDO (Meeting VO)
	*/
	
	public function insertMeetingDtls(MeetingDO $meetingdo){
		$rowInserted = "";
		
		try{
			
			$database = new dbConnection();
		    $connection = $database->getConnection();
			
			$meetingname = $meetingdo->meetingname;
			$meetingvenue = $meetingdo->meetingvenue;
			$meetingdatetime = $meetingdo->meetingdatetime;
			$createdAt = $meetingdo->createdAt;
			$createdBy = $meetingdo->createdBy;
			$participants = $meetingdo->participants;
			
			$meetingduration = 0;
			
			$result = $connection->prepare(MeetingConstants::INSERT_MEETING_DETAILS);
			$result->bind_param("sssisis",$meetingname,$meetingvenue,$meetingdatetime,$meetingduration,$createdAt,$createdBy,$participants);
			$result->execute();
			$rowInserted = $result->affected_rows;
			$result->close();
			
			$result = $connection->prepare(MeetingConstants::SELECT_MAX_MEETING_ID);
			$result->execute();
			$result->bind_result($meetingid);
			$meetingID=0;
			while($result->fetch()){
				$meetingID=$meetingid;
			}
			$result->close();
			
			$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $meetingID;
	}
	/* 
	Description : To insert the details of Meeting agenda
	Paramenter  : AgendaDO (Agenda VO)
	*/
	
	public function insertAgendaDtls($agendaArr){
		
		$rowInserted = 0;
		$database = new dbConnection();
		$connection = $database->getConnection();
		$duration=0;
		$ID=0;
		try{
		$agendaDo=new MeetingDO();
		$agendaDo=$agendaArr[1];
		$meetingid = $agendaDo->meetingid;
		
		$result = $connection->prepare(MeetingConstants::DELETE_AGENDA);
		$result->bind_param("i",$meetingid);
		$result->execute();
		$result->close();
		
		
			for($i=0;$i<count($agendaArr);$i++){
				$agendaDo=new MeetingDO();
				
				$agendaDo=$agendaArr[$i];
				$meetingid = $agendaDo->meetingid;
				$agendapoints = $agendaDo->discussionPoints;
				$agendaduration = $agendaDo->duration;
				$duration = $duration + $agendaduration;
				$ID = $meetingid;
				
				//return $meetingid."->".$agendapoints."->".$agendaduration;
				$result = $connection->prepare(MeetingConstants::INSERT_AGENDA_POINTS);
				
				$result->bind_param("isi",$meetingid,$agendapoints,$agendaduration);
				
				$result->execute();
				$rowInserted = $result->affected_rows;
				$result->close();
			}
			$saMeeting=new SAMeeting();
			$rowInserted = $saMeeting->updateMeetingDuration($ID,$duration);
			$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $rowInserted;
	}
	
	
	public function updateAgendaDtls($agendaArr){
		
		$rowInserted = 0;
		$database = new dbConnection();
		$connection = $database->getConnection();
		$duration=0;
		$ID=0;
		try{
			//$agendaDo=new MeetingDO();
			//$agendaDo=$agendaArr[1];
		
			for($i=0;$i<count($agendaArr);$i++){
				$agendaDo=new MeetingDO();
				
				$agendaDo=$agendaArr[$i];
				$meetingid = $agendaDo->meetingid;
				$agendaid = $agendaDo->agendaid;
		
				$agendapoints = $agendaDo->discussionPoints;
				$agendaduration = $agendaDo->duration;
				$duration = $duration + $agendaduration;
				$ID = $meetingid;
				//return $meetingid."->".$agendapoints."->".$agendaduration ."->".$agendaid;
				if ($agendaid != null && $agendaid != "" ){
				
					$result = $connection->prepare(MeetingConstants::UPDATE_AGENDA_POINTS);
					$result->bind_param("isii",$agendaduration, $agendapoints, $meetingid, $agendaid);
				}
				else {
					$result = $connection->prepare(MeetingConstants::INSERT_AGENDA_POINTS);
					$result->bind_param("isi",$meetingid,$agendapoints,$agendaduration);
				}
				$result->execute();
				$rowInserted = $result->affected_rows;
				$result->close();
				
			}
			$saMeeting=new SAMeeting();
			$rowInserted = $saMeeting->updateMeetingDuration($ID,$duration);
			$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $rowInserted;
	}
	
	
	public function updateMeetingDuration($meetingID,$duration){
		
		$rowInserted = 0;
		$database = new dbConnection();
		$connection = $database->getConnection();
		
		try{
			$result = $connection->prepare(MeetingConstants::UPDATE_MEETING_DURATION);
			$result->bind_param("ii",$duration,$meetingID);
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
	
	public function getUsersList(){
		try{
			$customerarray = array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			//Select Executive Team Member
			$result = $connection->prepare(MeetingConstants::SELECT_EXE_USER_LIST);
			$result->execute();
			$result->bind_result($userid,$roleID, $username, $surname, $email,$teamName,$roleName,$roleType);
		   //return "balaji";
			while($result->fetch()){
				$customerdo = new CustomerDO();
				$customerdo->userid = $userid;
				$customerdo->name = $username." ".$surname;
				$customerdo->emailid = $email;
				$customerdo->teamname = $teamName;
				$customerdo->rolename = $roleName;
				$customerdo->roletype = 'E';
				$customerdo->roleid = $roleID;
				$customerarray[] = $customerdo;
				unset($customerdo);
			}
			$result->close();
			//Non Executive Team Member
			$result = $connection->prepare(MeetingConstants::SELECT_NON_EXE_USER_LIST);
			$result->execute();
			$result->bind_result($userid,$roleID, $username, $surname, $email,$teamName,$roleName,$roleType);
		   //return "balaji";
			while($result->fetch()){
				$customerdo = new CustomerDO();
				$customerdo->userid = $userid;
				$customerdo->name = $username." ".$surname;
				$customerdo->emailid = $email;
				$customerdo->teamname = $teamName;
				$customerdo->rolename = $roleName;
				$customerdo->roletype = $roleType;
				$customerdo->roleid = $roleID;
				$customerarray[] = $customerdo;
				unset($customerdo);
			}
			$result->close();
			$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $customerarray;
	}
	
	
	public function insertMeetingParticipants($partcipantsArr){
		$rowInserted = "";
		
		try{
			
			$database = new dbConnection();
		    $connection = $database->getConnection();
			
			for($i=0;$i<count($partcipantsArr);$i++){
				$meetingDO = new MeetingDO();
				$meetingDO = $partcipantsArr[$i];
				$meetingid = $meetingDO->meetingid;
				$meetingparticipationid = $meetingDO->meetingparticipationid;
				$meetingparticipationemailid = $meetingDO->status;
				$meetingname = $meetingDO->meetingname;
				$meetingvenue  = $meetingDO->meetingvenue;
				$meetingdatetime = $meetingDO->meetingdatetime;
				$organiser = $meetingDO->responsename;
				
				
				/*if (mail($to, $subject, $body)) {
					echo("<p>Message successfully sent!</p>");
				} else {
					echo("<p>Message delivery failed...</p>");
				}*/
				
			
				$result = $connection->prepare(MeetingConstants::INSERT_INVITE_PARTICIPANTS);
				$result->bind_param("ii",$meetingid,$meetingparticipationid);
				$result->execute();
				$rowInserted = $result->affected_rows;
				if($rowInserted==1){
					$to = $meetingparticipationemailid;
					$subject = 'Invited to participate in meeting';
					$body = "<html><head><title></title></head><body>"."You have been invited for meeting.<br/>Please find the meeting details below:<br/>Date:".$meetingdatetime."<br/>Venue:".$meetingvenue."<br/>Organiser:".$organiser."</body></html>";
					$mail=new Mail_SA();
					$mailSending=$mail->sendMail($to,$subject,$body);
				}
				$result->close();
			}
			$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $meetingID;
	}
	
	/* 
	Description : To search the details of the meeting
	Paramenter  : Fromdate and To date
	*/
	
	public function searchMeetingDtls($fromdate, $todate, $checkValue){
 
		$meetingArrayValue = array();
  
		try{
  
		$database = new dbConnection();
		$connection = $database->getConnection();
   
		if($checkValue == "true"){
			$result = $connection->prepare(MeetingConstants::SELECT_MEETING_DETAILS_COMPLETED);
			$result->bind_param("ss",$fromdate,$todate);
		}
		else{
			$result = $connection->prepare(MeetingConstants::SELECT_MEETING_DETAILS_NOT_COMPLETED);
			$result->bind_param("ss",$fromdate,$todate);    
		}
		$result->execute();
		$result->bind_result($meeting_id, $meeting_name, $meeting_responsibility, $meeting_venue, $meeting_startingdate, $meeting_endingdate, $meeting_desc, $meeting_duration, $meeting_status, $meeting_CreatedAt, $meeting_CreatedBy, $meeting_participantsid,$username,$surname);
		$i=1;
		while($result->fetch()){
			$meetingdo = new MeetingDO();
			$meetingdo->sno = $i;
			$meetingdo->meetingid = $meeting_id;
			$meetingdo->meetingname = $meeting_name;
			//$meetingdo->meetingresponsibility = $meeting_responsibility;
			$meetingdo->meetingvenue = $meeting_venue;
			//$meetingdo->meetingstartingdate = $meeting_startingdate;
			;
			$meetingdo->meetingdatetime =  date('d-m-Y H:i',strtotime( $meeting_endingdate ) );
			//$meetingdo->meetingdesc = $meeting_desc;
			$meetingdo->meetingduration = $meeting_duration;
			$meetingdo->meetingstatus = $meeting_status;
			$meetingdo->createdAt = $meeting_CreatedAt;
			$meetingdo->createdBy = $meeting_CreatedBy;
			$meetingdo->participants = $meeting_participantsid;
			$meetingdo->organiser = $username.' '.$surname;
			
			$meetingArrayValue[] = $meetingdo;
			$i++;
			unset($meetingdo);
		}
		$result->close();
		$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $meetingArrayValue;
	}
	
	public function updateMeetingStatus($meetinArr){
		try{
			$rowInserted = 0;
			$database = new dbConnection();
			$connection = $database->getConnection();
			for($i=0;$i<count($meetinArr);$i++){
				$meetingDO =  new MeetingDO();
				$meetingDO = $meetinArr[$i];
				$meetingid = $meetingDO->meetingid;
				$meetingstatus = $meetingDO->meetingstatus;
				//return $meetingid.",".$meetingstatus;
				$result = $connection->prepare(MeetingConstants::UPDATE_MEETING_STATUS);
				$result->bind_param("si",$meetingstatus,$meetingid);
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
	/* 
	Description : To update the meeting based on the meeting id
	Paramenter  : MeetingDO (Meeting VO)
	*/
	/*
	public function updateMeetingDtls(MeetingDO $meetingdo){
	
		try{
		
			$dbconnection = new DBConnection();
			$connection = $database->getConnection();
			
			$meetingid = $meetingdo->meeting_id;
			$meetingname = $meetingdo->meeting_name;
			$meetingdesc = $meetingdo->meeting_desc;
			$meetingvenue = $meetingdo->meeting_venue;
			$meetingdatetime = $meetingdo->meeting_date_time;
			$meetingduration = $meetingdo->meeting_duration;
			$meetingparticipantsid = $meetingdo->meeting_participants_id;
			
			//return $meetingid."->".$meetingname."->".$meetingdesc."->".$meetingvenue."->".$meetingdatetime."->".$meetingduration."->".$meetingparticipantsid;
			
			$result = $connection->prepare(MeetingConstants::UPDATE_MEETING_DETAILS);
			$result->bind_param();
			$rowUpdated = $result->execute();
			$result->close();
			$connection->close();
			
		}
		catch(Exception $exception){
			die($exception);
		}
		return $rowUpdated;
	}*/
	
	
	
	/* 
	Description : To delete the meeting based on the meetingid
	Paramenter  : meetingid
	*/
	/*
	public function deleteMeetingDtls($meetingid){
		$rowDeleted = "";
		try{
			$dbconnection = new DBConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(MeetingConstants::DELETE_MEETING_DETAILS);
			$result->bind_param("i", $meetingid);
			$rowDeleted = $result->execute();
			$result->close();
			$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $rowDeleted;
	}*/
	
	
	
	/* 
	Description : To get the details of Meeting agenda
	Paramenter  : agendaid
	*/
	
	public function searchAgendaDtls($meetingid){
	
		try{
		
			$agendaArrayList = array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(MeetingConstants::SELECT_AGENDA_POINTS_DETAILS);
			$result->bind_param("i",$meetingid);
			$result->execute();
			$result->bind_result($agenda_id,$meeting_id,$discussion_Points,$percentage,$duration);
			$i=1;
			while($result->fetch()){
			
				$meetingdo = new MeetingDO();
				$meetingdo->sno=$i;
				$meetingdo->agendaid = $agenda_id; 
				$meetingdo->meetingid = $meeting_id;
				$meetingdo->discussionPoints = $discussion_Points;
				$meetingdo->percentage = $percentage;
				$meetingdo->duration = $duration;
				$agendaArrayList[] = $meetingdo;
				$i++;
				unset($meetingdo);
			}
			$result->close();
			$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $agendaArrayList;
	}
	
	/* 
	Description : To get the details of Meeting agenda
	Paramenter  : agendaid
	*/
	
	public function updateMeetingCompletedStatus($meetingid){
	
		try{
		
			$agendaArrayList = array();
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(MeetingConstants::UPDATE_MEETING_COMPLETION_STATUS);
			$result->bind_param("i",$meetingid);
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
	
	public function insertAgendaPoints($pointsarr){
	
		try{
			
			$database = new dbConnection();
		    $connection = $database->getConnection();
			$rowInserted = 0;
			
			$meetingDO = new MeetingDO();
			$meetingDO = $pointsarr[0];
			$meetingid = $meetingDO->meetingid;
			$agendaid = $meetingDO->agendaid;
			
			//return $meetingid.' -> '.$agendaid;
			$result = $connection->prepare(MeetingConstants::DELETE_AGENDA_POINTS);
			$result->bind_param("ii",$meetingid,$agendaid);
			$result->execute();
			$result->close();
			$completedCnt=0;
			
			for($i = 0; $i < count($pointsarr);$i++){
				$meetingDO = new MeetingDO();
				$meetingDO = $pointsarr[$i];
				$meetingid = $meetingDO->meetingid;
				$agendaid = $meetingDO->agendaid;
				$deliverables = $meetingDO->deliverables;
				$expiredate = $meetingDO->expiredate;
				$completiondate = $meetingDO->completiondate;
				$status = $meetingDO->status;
				
				if($status=='Closed'){
					$completedCnt++;
				}
				
				else if($status==''){
					$status = 'Open';
				}
				//return $status;
				$responsibility = $meetingDO->responsibility;
				//return $meetingid.' - '.$agendaid.' - '.$deliverables.' - '.$responsibility.' - '.$expiredate.' - '.$completiondate.' - '.$status;
				$result = $connection->prepare(MeetingConstants::INSERT_POINTS_OF_AGENDA);
				$result->bind_param("iisssss",$meetingid,$agendaid,$deliverables,$responsibility,$expiredate,$completiondate,$status);
				$result->execute();
				$rowInserted = $result->affected_rows;
				$result->close();
			}
			
			$connection->close();
			$saMeeting = new SAMeeting();
			$rowUpdated = $saMeeting -> updateAgendaPercentage($agendaid,count($pointsarr),$completedCnt);
		}
		catch(Exception $exception){
			die($exception);
		}
		return $rowInserted;
	}
	public function updateAgendaPercentage($agendaid, $noOfpts, $cmpltdCnt){
	
		try{
		
			$pointsArray = array();
			
			$database = new dbConnection();
			$connection = $database->getConnection();
			$percentage = intval(($cmpltdCnt / $noOfpts) * 100);
			
			$result = $connection->prepare(MeetingConstants::UPDATE_AGENDA_PERCENTAGE);
			$result->bind_param("ii",$percentage, $agendaid);
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
	
	public function selectPoints($meetingid, $agendaid){
	
		try{
		
			$pointsArray = array();
			
			$database = new dbConnection();
			$connection = $database->getConnection();
			
			$result = $connection->prepare(MeetingConstants::SELECT_AGENDA_POINTS);
			$result->bind_param("ii",$meetingid, $agendaid);
			$result->execute();
			$result->bind_result($meetingid, $agendaid,$pointsid ,$deliverables, $responsibility, $expiredate, $completiondate, $status ,$username ,$surname);
			$i=1;
			while($result->fetch()){
				$meetingdo = new MeetingDO();
				$meetingdo->sno=$i;
				$meetingdo->meetingid = $meetingid;
				$meetingdo->agendaid = $agendaid;
				$meetingdo->pointsid = $pointsid;
				$meetingdo->deliverables = $deliverables;
				$meetingdo->responsename = $username. ' ' .$surname;
				$meetingdo->responsibility = $responsibility;
				
				if ($expiredate != null ){
					$meetingdo->expiredate = date('d-m-Y',strtotime( $expiredate ) );
				}else {
					$meetingdo->expiredate = null;
				}
				
				if ($completiondate != null  ){
					$meetingdo->completiondate = date('d-m-Y',strtotime( $completiondate ) );
				}else {
					$meetingdo->completiondate = null;
				}
				
				$meetingdo->status = $status;
				$pointsArray[] = $meetingdo;
				$i++;
				unset($meetingdo);
			}
			$result->close();
			$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $pointsArray;
	}
	
	public function selectInvitedParticipants($meetingid){
	
		try{
		
			$userArray = array();
			
			$database = new dbConnection();
			$connection = $database->getConnection();
			
			$result = $connection->prepare(MeetingConstants::SELECT_INVITED_PARTICIPANTS);
			$result->bind_param("i",$meetingid);
			$result->execute();
			
			$result->bind_result($userID,$userName,$surName,$roleID,$teamID,$teamname,$roleName);
			$i=1;
			while($result->fetch()){
				$customerDo=new CustomerDO();
				$customerDo->userid=$userID;
				$customerDo->username=$userName.' '.$surName;
				$customerDo->roleid=$roleID;
				$customerDo->teamid=$teamID;
				$customerDo->teamname=$teamname;
				$customerDo->rolename=$roleName;
				$userArray[] = $customerDo;
				unset($customerDo);
			}
			$result->close();
			$connection->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		return $userArray;
	}
	
}

?>