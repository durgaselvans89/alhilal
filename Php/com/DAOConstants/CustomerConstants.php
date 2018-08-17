<?php

interface CustomerConstants{

	

	//const SEARCH_USER_DETAILS = "select u.Userid, u.UserName, u.SurName, u.Designation, r.Rolename, ifnull(t.teamname,'Not Assigned') as teamname from roles r, usermaster u  left join team t on u.teamid = t.teamid where r.roleid = u.roleid and (u.UserName like ? or u.designation like ?) and u.roleid = ?;";
	
	//Const UPDATE_USER_DETAILS = "Update usermaster set UserName = ?, Surname = ?, Designation = ?, TelPhoneNo = ?, MobileNo = ?, Email = ?, RoleId = ?, TeamID = ? where UserID = ?;"; 
	
	const UPDATE_PASSWORD = "Update usermaster set Password = ? where UserID = ?;";
	
	//const EXECUTIVE_TEAM = "Select a.UserName, a.SurName, a.designation, b.roleName from usermaster a, roles b ,executiveteam e Where a.roleid = b.roleid and a.roleid = e.RoleID order by b.roleid, UserName;";
	
	//const EXECUTIVE_TEAM = "Select a.UserName, a.SurName, a.designation, b.roleName, a.LocationID, a.Location  from usermaster a, roles b Where a.roleid = b.roleid and a.roleid < 5 order by b.roleid, UserName;";
	
	const EXECUTIVE_TEAM = "Select a.UserID, a.UserName, a.SurName, a.designation,a.RoleID, b.roleName, a.LocationID, a.Location ,a.LoginName from usermaster a, roles b ,executiveteam e Where a.roleid = b.roleid and (a.UserID = e.UserID) order by b.roleid, UserName;";
	
	const GET_CUSTOMERDETAILS = "Select a.UserName, a.SurName, a.designation, a.roleid, a.TelPhoneNo, a.MobileNo, a.Email, a.LoginName from usermaster a Where a.username = ?;";
	
	
	
	
	
	const INSERT_CUSTOMER_VALUE = "insert into usermaster(UserName, SurName, LoginName, Password, Designation, TelPhoneNo, MobileNo, EMail, RoleID, TeamID, LocationID, Location,CityName,RoleType) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
	
	
	
	const UPDATE_USER_DETAILS = "Update usermaster set LoginName=?, UserName = ?, Surname = ?, Designation = ?, TelPhoneNo = ?, MobileNo = ?, Email = ?, RoleId = ?, LocationID=?, Location=? ,cityName=? where UserID = ?;";
	
	//const DELETE_CUSTOMER = "delete FROM usermaster where UserID = ?;";
	
	
	
	const DELETE_CUSTOMER="Delete from usermaster where UserID=?;";
	const DELETE_TEAM_LEADER="Delete from team where TeamLeader=?;";
	const DELETE_TEAM="Delete from team  where TeamID=?;";
	const DELETE_TEAM_MEMBER="Delete from teammember Where UserID=?;";
	const GET_TEAM_ID_TEAM_MEMBER="select TeamID from teammember Where UserID=?;";
	const GET_TEAM_ID_TEAM_LEADER="select TeamID from team Where TeamLeader=?;";
	const GET_CRITERION_PART_TEAM_MEMBER="select Count(CriterionPartID),TeamID from teamcriterionpart Where TeamID=? Group By TeamID;";
	const DELETE_TEAM_MEMBER_LIST="Delete from teammember where TeamID=?;";
	
	const SEARCH_USER_DETAILS = "select u.Userid, u.UserName, u.SurName, u.Designation, u.RoleID, r.Rolename, ifnull(t.teamname,'Not Assigned') as teamname, u.TelPhoneNo,u.EMail, u.MobileNo, u.LoginName, u.Password, u.LocationID, u.Location,u.cityName from roles r, usermaster u left join team t on u.teamid = t.teamid where r.RoleID = u.RoleID and ((u.UserName like ? or u.Surname like ?) and u.Designation=? ) and r.RoleID = ? order by u.UserName;;";
	
	const SEARCH_USER_DETAILS_DESIG_ALL = "select u.Userid, u.UserName, u.SurName, u.Designation, u.RoleID, r.Rolename, ifnull(t.teamname,'Not Assigned') as teamname, u.TelPhoneNo,u.EMail, u.MobileNo, u.LoginName, u.Password, u.LocationID, u.Location,u.cityName from roles r, usermaster u left join team t on u.teamid = t.teamid where r.RoleID = u.RoleID and (u.UserName like ? or u.Surname like ?) and r.RoleID = ? order by u.UserName;";
	
	const SEARCH_USER_DETAILS_ROLE_ALL = "select u.Userid, u.UserName, u.SurName, u.Designation, u.RoleID, r.Rolename, ifnull(t.teamname,'Not Assigned') as teamname, u.TelPhoneNo,u.EMail, u.MobileNo, u.LoginName, u.Password, u.LocationID, u.Location,u.cityName from roles r, usermaster u left join team t on u.teamid = t.teamid where r.RoleID = u.RoleID and ((u.UserName like ? or u.Surname like ?) and u.Designation like ? ) order by u.UserName;;";
	
	const SEARCH_USER_DETAILS_DESIG_AND_ROLE_ALL = "select u.Userid, u.UserName, u.SurName, u.Designation, u.RoleID, r.Rolename, ifnull(t.teamname,'Not Assigned') as teamname, u.TelPhoneNo,u.EMail, u.MobileNo, u.LoginName, u.Password, u.LocationID, u.Location,u.cityName from roles r, usermaster u left join team t on u.teamid = t.teamid where r.RoleID = u.RoleID and (u.UserName like ? or u.Surname like ?)order by u.UserName;";
	
	const DELETE_DEFAULT_EXE_MEM = "Delete from executiveteam where RoleID<5;";
	
	const INSERT_DEFAULT_EXE_MEM = "insert into executiveteam(UserID,RoleID)Select UserID,RoleID from usermaster Where RoleID<5;";
	
	const UPDATE_TEAM_LOCATION = "update team set LocationID=?,Location=? where TeamLeader=?;";
	
	const CHK_USER_RESP_UNDER_PLAN = "Select count(ActivityID) from exeteamactivities where Accountability=?;";
	
	const GET_USER_ID_ADDED_RECENTLY = "SELECT UserID FROM usermaster Order by UserID desc LIMIT 1;";
	
	const SELECT_USER_EXISTS_PROJ = "select count(Responsibility) from projectdetails where Responsibility=?;";
	
	const CHK_USER_EXISTS_UNDER_PROJ_TEAM_MEM = "select count(UserID) from projectteammember where UserID=?;";
	
	const SEARCH_PASSWORD="select Password from usermaster where EMail=?;";
}
?>