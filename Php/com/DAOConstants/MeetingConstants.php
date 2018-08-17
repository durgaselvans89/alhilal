<?php

interface MeetingConstants{

	const INSERT_MEETING_DETAILS = "insert into meetingdetails(purpose, venue, endingDate, duration ,createdAt , createdBy,participants,status) values(?,?,?,?,?,?,?,'Open');";
	
	const SELECT_MAX_MEETING_ID = "select max(meetingID) from meetingdetails;";
	
	const INSERT_INVITE_PARTICIPANTS = "insert into meetingparticipants(meetingid,participantsid) values (?,?);";
	
	const UPDATE_MEETING_DURATION = "update meetingdetails set duration=? where meetingid=?;";
	
	//const UPDATE_MEETING_DETAILS = "update meeting_details set meeting_name = ? , meeting_desc = ?, meeting_venue = ?, meeting_date_time = ?, meeting_duration = ?, meeting_participants_id = ? where meeting_id = ?";
	
	const SELECT_MEETING_DETAILS_NOT_COMPLETED = "select meetingID, purpose, responsibility, venue, startingDate, endingDate, description, duration, status, createdAt, createdBy, participants,u.UserName,u.SurName from meetingdetails INNER JOIN usermaster u ON u.UserID=createdBy where date(endingDate) >= ? and date(endingDate) <= ? and status != 'Completed' order by endingDate;";
	
	const SELECT_MEETING_DETAILS_COMPLETED = "select meetingID, purpose, responsibility, venue, startingDate, endingDate, description, duration, status, createdAt, createdBy, participants,u.UserName,u.SurName from meetingdetails INNER JOIN usermaster u ON u.UserID=createdBy where date(endingDate) >= ? and date(endingDate) <= ? order by endingDate;";
	
	//const DELETE_MEETING_DETAILS = "delete meeting_id from meeting_details where meeting_id = ? ";

	const INSERT_AGENDA_POINTS = "insert into agendadetails(meetingid, discussionpoints, percentage,duration) values (?,?,0,?);";
	
	const UPDATE_AGENDA_POINTS = "update agendadetails set duration = ?, discussionpoints = ? where meetingid = ? and agendaid = ?;";
		
	const SELECT_AGENDA_POINTS_DETAILS = "select agendaid, meetingid, discussionpoints, percentage, duration from agendadetails where meetingid = ?";
	
	//const SELECT_USER_LIST = "select userid, u.RoleID,username, SurName, Email,ifnull(t.TeamName,'Not Assigned') as teamname ,RoleName,r.RoleType from roles r, usermaster u left outer join team t on t.TeamID=u.userid where r.RoleID=u.RoleID;";
	
	const UPDATE_MEETING_STATUS = "update meetingdetails set status=? where meetingid=?;";
	
	const UPDATE_MEETING_COMPLETION_STATUS = "update meetingdetails set status='Closed' where meetingid=?;";
	
	const INSERT_POINTS_OF_AGENDA = "insert into agendapointsdetails(meetingid,agendaid,deliverables,responsibility,expiredate,completiondate,status) values(?,?,?,?,?,?,?);";
 
	const SELECT_AGENDA_POINTS = "select meetingid, agendaid, pointsid, deliverables, responsibility, expiredate, completiondate, status,UserName,SurName from agendapointsdetails left join usermaster u on responsibility = u.UserID where meetingid = ? and agendaid = ? ;";
	
	const DELETE_AGENDA = "Delete from agendadetails where meetingid=?;";
	
	const DELETE_AGENDA_POINTS = "Delete from agendapointsdetails where meetingid=? and agendaid=?;";
	
	const UPDATE_AGENDA_PERCENTAGE = "Update agendadetails set percentage=? where agendaid=?";
	
	const SELECT_INVITED_PARTICIPANTS ="select u.UserID,UserName,SurName,u.RoleID,u.TeamID,ifnull(t.teamname,'Not Assigned') as teamname,r.RoleName from roles r,usermaster u left join team t on u.teamid = t.teamid  where u.RoleID=r.RoleID and u.UserID in(select participantsid from meetingparticipants where meetingid=?);";
	
	const SELECT_NON_EXE_USER_LIST ="select userid, u.RoleID,username, SurName, Email,ifnull(t.TeamName,'Not Assigned') as teamname ,RoleName,r.RoleType from roles r, usermaster u left outer join team t on t.TeamID=u.userid where r.RoleID=u.RoleID and u.userID NOT IN (Select UserID from executiveteam);";
	
	const SELECT_EXE_USER_LIST ="select userid, u.RoleID,username, SurName, Email,ifnull(t.TeamName,'Not Assigned') as teamname ,RoleName,r.RoleType from roles r, usermaster u left outer join team t on t.TeamID=u.userid where r.RoleID=u.RoleID and u.userID IN (Select UserID from executiveteam);";
	
}

?>