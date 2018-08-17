<?php

interface LoginConstants{

	const Validate_Login = "SELECT u.UserID, u.UserName, u.surname, u.LoginName, u.Designation, u.TelPhoneNo, u.MobileNo, u.Email, u.RoleID, r.RoleName, u.TeamID, u.Password,u.LocationID,u.Location,u.cityName FROM usermaster u INNER JOIN roles r ON r.RoleID = u.RoleID where u.LoginName = ? and u.Password = ? ;";

	//const SELECT_CRITERIA_PARTID = "SELECT c.CriterionPartShortDescription FROM usermaster u, teammember t, teamcriterionpart tm, criterionpart c where u.UserID = t.UserID and t.teamID = tm.teamID and tm.CriterionPartID = c.CriterionPartID and u.username = ? ;";
		
	const SELECT_CRITERIA_PARTID_TEAM_MEM="SELECT c.CriterionPartShortDescription FROM usermaster u, teammember t, teamcriterionpart tm, criterionpart c where u.UserID = t.UserID and t.teamID = tm.teamID and tm.CriterionPartID = c.CriterionPartID and u.UserID =? order by tm.CriterionPartID;";
	
	const SELECT_CRITERIA_PARTID_TEAM_LEADER = "SELECT distinct(c.CriterionPartShortDescription) FROM usermaster u, team t, teamcriterionpart tm, criterionpart c where u.UserID = t.TeamLeader and tm.TeamID=t.TeamID and tm.CriterionPartID = c.CriterionPartID and u.UserID = ? order by tm.CriterionPartID;";
}
?>