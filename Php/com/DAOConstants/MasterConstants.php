<?php

interface MasterConstants{

//const Select_Role = "SELECT RoleID, RoleName, RoleType, RoleTypeDescription FROM roles;";

//const Select_Role = "SELECT RoleID, RoleName, RoleType, RoleTypeDescription FROM roles;";

//const Select_Sub_Team_Roles  = "SELECT RoleID, RoleName, RoleType, RoleTypeDescription FROM roles where RoleID > 5;";



const SELECT_STATUS = "SELECT StatusID, Status FROM status order by StatusID;";
 
 //const INSERT_STATUS = "insert into status(StatusID,Status) values(?,?);"; 
 
 const INSERT_STATUS = "insert into status(Status) values(?);"; 
 
 const SELECT_MAX_STATUS = "select max(StatusID) from status;";
 
 const DELETE_STATUS = "delete from status where StatusID = ?;";
 
 
 const Select_Role = "SELECT RoleID, RoleName, RoleType, RoleTypeDescription, DisplayOrder FROM roles;";

 const INSERT_ROLE_DETAILS = "insert into roles(RoleID, RoleName, RoleType, RoleTypeDescription, DisplayOrder) values(?,?,?,?,?);";
 
 const DELETE_ROLE_DETAILS = "delete from roles where RoleID = ?;";

 const SELECT_MAX_ROLE = "SELECT max(RoleID) FROM roles;";
 
 const INSERT_LOCATION = "insert into location(Location) values (?);";
 
 const CHK_LOCATION_EXISTS = "select count(LocationID) from location where Location=?;";
 
 const SELECT_LOCATION = "select LocationID,Location from location;";
 
const CHK_LOCATION_EXISTS_FOR_DELETION="Select count(LocationID) from usermaster where LocationID=?;";

const DELETE_LOCATION="Delete from location where LocationID=?;";
// const CHK_ROLE_EXISTS="select count(RoleID) from roles where RoleName=?;";

const CHK_STATUS_EXISTS = "select count(StatusID) from status where UPPER(Status)=?;";

const SELECT_DESIGNATION="select distinct Designation from usermaster;";

const SELECT_EXE_ROLES="Select RoleID,UserID from executiveteam;";

const DELETE_EXE_ROLE="Delete from executiveteam Where RoleID>=5 And UserID=?";
	
const INSERT_EXE_ROLES="INSERT INTO executiveteam(RoleID,UserID) VALUES (?,?);";

const CHK_EXE_ROLES_EXISTS = "Select Count(UserID) from executiveteam where UserID=?;";

const DELETE_SELECTED_EXE_ROLE = "Delete from executiveteam where UserID=?;";

const CHK_ROLE_EXISTS_FOR_USER = "Select count(UserID) from usermaster where RoleID=?;";

const SELECT_ROLE_EXISTS = "Select count(UPPER(RoleName)) from roles Where UPPER(RoleName)=?";

const SELECT_STATUS_EXISTS_UNDER_ACT = "Select count(ActivityID) from exeteamactivities where StatusID=?;";

const SELECT_ROLE_TYPE="SELECT RoleType,RoleTypeDescription FROM roletype r;";
}
?>