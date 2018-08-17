<?php

interface TeamConstants{

	const INSERT_TEAM_DETAILS = "insert into team(TeamName, TeamLeader, LocationID, Location) values(?,?,?,?);";
	
	const SELECT_USER_ROLE_ID_VALUE = "select roleID from usermaster where username = ?;";
	
	const CHECK_TEAM_NAME = "select Count(TeamName) from team where TeamName = ? ;";
	
	//const SELECT_CRITERIA_PART_ID = "SELECT CriterionPartID from teamcriterionpart where TeamID = ?";
	
	const SELECT_TEAMACTIVITY = "SELECT e.ActivityID, e.Milestone, e.Activity, u.username,u.SurName, e.Duedate, s.Status, e.LocationID, e.Location FROM exeteamactivities e, status s,usermaster u where s.StatusID = e.StatusID and e.accountability = u.userid and e.LocationID=?;";

//		const SELECT_TEAMACTIVITY = "SELECT e.ActivityID FROM exeteamactivities e, status s where s.StatusID = e.StatusID; ";

	const SELECT_USER_NAME = "select UserID,UserName from usermaster where RoleId <= 5 order by UserName;";

	const DELETE_TEAM_ID = "delete from teamcriterionpart where TeamID = ?;";
	
	//const SELECT_USER_NAME = "select UserID,UserName from usermaster where RoleId = 5";
	
	const CREATE_TEAM_NAME = "insert into team (teamname, teamleader) select ?, userid from usermaster where username = ?";
	
	//const SELECT_TEAM_DETAILS = "select t.teamid, t.teamname, u.username, tm.teammember from usermaster u, team t left join teammember tm on t.teamid = tm.teamid where t.teamid = u.userid and t.teamleader = tm.teamid";
	
	const SELECT_CRITERIA_SHORT_PART = "select c.criterionpartshortdescription from criterionpart c,teamcriterionpart t where c.criterionpartid = t.criterionpartid and t.teamid = ?";
	
	//const SELECT_ROLE_USERLIST = "SELECT u.username FROM usermaster u, roles r where r.roleID = u.userID and r.roleID < 4;";
	
	const SELECT_ROLE_USERLIST = "SELECT u.username,u.SurName,u.UserID FROM usermaster u Where u.RoleID < 5;";
	
	//const CREATE_PROJECT_PLAN = "insert into exeteamactivities(Milestone, Activity, Accountability, Duedate, StatusID) values(?,?,?,?,?);";
	
//	const SELECT_STATUS_VALUES = "select status from status where statusID = ? ;";
	
	const CREATE_PROJECT_PLAN = "insert into exeteamactivities(Milestone, Activity, Accountability, Duedate, StatusID, LocationID, Location) values (?,?,?,?,?,?,?);";
 
	const SELECT_STATUS_VALUES = "select statusID from status where status = ? ;";
 
	const SELECT_USERNAME = "SELECT UserID FROM usermaster where username = ?;";
	
	//const UPDATE_PROJECT_PLAN = "update exeteamactivities set Milestone = ?, Activity = ?, Accountability = ?, Duedate = ?, StatusID = ? where Milestone like ? ";
	const UPDATE_PROJECT_PLAN = "update exeteamactivities set Milestone = ?, Activity = ?, Accountability = ?, Duedate = ?, StatusID = ? where ActivityID = ? ";
	
	const DELETE_PROJECT_PLAN = "delete from exeteamactivities where activityID = ? ;";
	
	
	
	//const SELECT_TEAM_DETAILS = "select t.TeamID, t.TeamName,u.username from usermaster u,team t where u.UserID = t.TeamLeader;";
	
	//const SELECT_CRITERIA_PART = "select c.CriterionPartShortDescription from criterionpart c, teamcriterionpart t where c.CriterionPartID = t.CriterionPartID and t.TeamID = ? ;";
	
	const SELECT_CRITERIA_PART = "select c.CriterionPartShortDescription from criterionpart c, teamcriterionpart t where c.CriterionPartID = t.CriterionPartID and t.TeamID = ? ORDER BY c.CriterionPartShortDescription;";
	
	const CRITERIA_PART_LIST = "SELECT CriterionPartID,CriterionPartShortDescription, CriterionPartDefinition FROM criterionpart ORDER BY CriterionPartID;";
	
	const CRITERIA_UNIQUE_PART_LIST = "SELECT CriterionPartID,CriterionPartShortDescription, CriterionPartDefinition FROM criterionpart where CriterionPartID not in (Select distinct CriterionPartID from teamcriterionpart) ORDER BY 1;";
		
	const INSERT_TEAM_CRITERIA_PART_ID = "insert into teamcriterionpart(TeamID,CriterionPartID,Remarks) values(?,?,?);";
	
	 //const SELECT_CRITERIA_PART_ID = "select c.CriterionPartID, c.CriterionPartShortDescription,c.CriterionPartDefinition FROM teamcriterionpart t, criterionpart c where t.CriterionPartID = c.CriterionPartID and c.CriteriaID < 6 order by c.CriterionPartID ;";
	 
	 //const SELECT_CRITERIA_PART_ID = "select distinct(c.CriterionPartID), c.CriterionPartShortDescription,c.CriterionPartDefinition FROM teamcriterionpart t,criterionpart c where t.CriterionPartID = c.CriterionPartID;";
	 
	 //const SELECT_CRITERIA_PART_ID = "select distinct(c.CriterionPartID), c.CriterionPartShortDescription,c.CriterionPartDefinition FROM teamcriterionpart t,criterionpart c where t.CriterionPartID = c.CriterionPartID order by t.CriterionPartID;";
	 
	 const SELECT_CRITERIA_PART_ID = "select distinct(c.CriterionPartID), c.CriterionPartShortDescription,c.CriterionPartDefinition,c.MaxPoints FROM criterionpart c order by c.CriterionPartID;";
	 
	//const SELECT_TEAM_NAME = "SELECT distinct TeamID, TeamName FROM team where TeamName like ?;";
	
	const SELECT_TEAM_NAME = "SELECT TeamID, TeamName FROM team where locationID=?;";
	
	
	
	//const SELECT_TEAM_MEMBER_DETAILS = "SELECT u.userID, t.TeamID, t.TeamName, u.userName, u.SurName, u.Designation, u.LoginName, r.RoleName FROM team t, teammember tm, usermaster u, roles r where t.teamid = tm.teamid and tm.userid = u.userid and r.roleID = u.roleID and t.TeamName like ?;";
	
	const SELECT_TEAM_MEMBER_DETAILS = "SELECT u.userID, t.TeamID, t.TeamName, u.userName, u.SurName, u.Designation, u.LoginName, r.RoleName FROM team t, teammember tm, usermaster u, roles r where t.teamid = tm.teamid and tm.userid = u.userid and r.roleID = u.roleID and t.TeamID=?;";
	
	 //const UNSELECT_TEAM_MEMBERS = "SELECT u.userID, u.userName,  u.SurName, u.designation, r.RoleName FROM roles r, usermaster u where u.roleid >5 and  r.RoleID = u.RoleID and u.userName not in (SELECT u.userName FROM team t, teammember tm, usermaster u where t.teamid = tm.teamid and tm.userid = u.userid and t.TeamName like ?);";
	 
	 const UNSELECT_TEAM_MEMBERS = "SELECT u.userID, u.userName, u.SurName, u.designation, r.RoleName,u.LocationID, u.Location FROM usermaster u INNER JOIN roles r ON r.RoleID=u.RoleID WHERE u.RoleID>5 AND u.UserID NOT IN(SELECT UserID FROM teammember) AND u.LocationID=?";
	 
	 const INSERT_TEAM_MEMBERS = "insert into teammember(TeamID, UserID, Remarks) values(?,?,?);";
	 
	 //const UPDATE_TEAM_DETAILS_UNDER_USER_MASTER = "UPDATE usermaster SET TeamID=? Where UserID=?;";
	 
	 const SELECT_TEAM_DETAILS_INFO = "SELECT t.teamID, t.teamName, tm.userID, u.userName FROM team t, teammember tm, usermaster u where t.teamID = tm.teamID and tm.userID = u.userID and t.teamName like ?  and u.userName like ? ;";
	 
	 //const SELECT_SUB_TEAMASSESSMENT = "select EnablerAssessmentID, CriterionPartID, ApproachTitle, ApproachDescription, Score, Status, missing from enablerassessment where CriterionPartID = ? ;";
	 
	const SELECT_All_TEAM_DETAILS = "select t.TeamID, t.TeamName, u.username,t.LocationID,t.Location,u.SurName from usermaster u,team t where u.UserID = t.TeamLeader and t.LocationID=?;";
	
	const SELECT_TEAM_DETAILS = "select t.TeamID, t.TeamName, u.username,t.LocationID, t.Location,u.SurName from usermaster u,team t where u.UserID = t.TeamLeader and t.TeamName like ? and t.TeamLeader=? and t.LocationID=?;";
	
	const SELECT_ALL_TEAM_LEADERS = "select u.UserID,u.UserName,u.SurName From usermaster u where UserID IN(select distinct TeamLeader From team) and u.LocationID=? order by u.UserName;";

	const DELETE_TEAM_MEMBERS = "delete from teammember where TeamID = ? and UserID = ?;";
	 
	 //const UPDATE_TEAM_DETAILS = "update team set TeamLeader = ? where TeamLeader = ? and TeamID = ? ;";
	 
	 const UPDATE_TEAM_DETAILS = "update team set TeamLeader = ?,TeamName=?, LocationID=?, Location=? where TeamID = ? ;";
	 
	 const REMOVE_TEAM_NAME = "update team set TeamLeader = 0 where TeamID = ? and TeamLeader = ?;";
	 
	 const DELETE_CRITERIA_CONSTANTS = "delete from teamcriterionpart where TeamID = ? and CriterionPartID = ? ;";
	 
	 //const SELECT_CRITERIA_ID = "SELECT CriterionPartID FROM criterionpart where CriterionPartShortDescription = ?;";
	 
	 
	 
	
	 //const INSERT_SUB_TEAMASSESSMENT = "insert into enablerassessment(EnablerAssessmentID, CriterionPartID, ApproachTitle, ApproachDescription, ExamplesOfApproach, Deployment, ExamplesOfDeployment, AssessmentAndReview, ExamplesOfAssessmentReview, SourceOfInformation, SoundRational, Integrated, Implemented, Systematic, Measurement, Learning, Improvement, Strength, AreaForImprovement, TeamType, Score, SystemGeneratedScore, Presented, DirectRelavanceToDelivering, RelevanceToThisCriterionPart, ApproachToLink, Status, EnablerDocument, missing) values(?,?,?,'','','','','','','','','','','','','','','','','',0,'','','','','',0,'',?);";
	
	// const SELECT_MAX_ENABLER_ID = "select max(EnablerAssessmentID) from enablerassessment;";

	// const INSERT_EXE_TEAM_ENABLER_ASSESSMENT = "insert into exeteamenablerassessment(ExeTeamEnablerAsementID,EnablerAssessmentID,CriterionPartID, ApproachTitle,ApproachDescription,ExamplesOfApproach,Deployment,ExamplesOfDeployment,AssessmentAndReview, ExamplesOfAssessmentReview,SourceOfInformation,SoundRational,Integrated,Implemented,Systematic, Measurement,Learning,Improvement,Strength,AreaForImprovement,TeamType,Score,SystemGeneratedScore, Presented,DirectRelavanceToDelivering,RelevanceToThisCriterionPart,ApproachToLink,EnablerDocument) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
	 
	// const UPDATE_EXE_TEAM_ENABLER_ASSESSMENT = "update exeteamenablerassessment set EnablerAssessmentID,CriterionPartID = ?, ApproachTitle = ?,ApproachDescription = ?,ExamplesOfApproach = ?,Deployment = ?,ExamplesOfDeployment = ?,AssessmentAndReview = ?, ExamplesOfAssessmentReview = ?,SourceOfInformation = ?,SoundRational = ?,Integrated = ?,Implemented = ?,Systematic = ?, Measurement = ?,Learning = ?,Improvement = ?,Strength = ?,AreaForImprovement = ?,TeamType = ?,Score = ?,SystemGeneratedScore = ?, Presented = ?,DirectRelavanceToDelivering = ?,RelevanceToThisCriterionPart = ?,ApproachToLink = ?,EnablerDocument = ? where ExeTeamEnablerAsementID = ?;";

	//Enabler assessment	
	
	const INSERT_ENABLER_ASSESSMENT = "insert into enablerassessment(DummyEnablerID,CriterionPartID,ApproachTitle,ApproachDescription, ExamplesOfApproach,Deployment,ExamplesOfDeployment,AssessmentAndReview,ExamplesOfAssessmentReview, SourceOfInformation,SoundRational,Integrated,Implemented,Systematic,Measurement,Learning,Improvement,Strength,AreaForImprovement,TeamType,Score,SystemGeneratedScore,Presented,DirectRelavanceToDelivering, RelevanceToThisCriterionPart,ApproachToLink,Status,EnablerDocument,missing,LocationID,Location) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
 
	const UPDATE_ENABLER_ASSESSMENT = "update enablerassessment set CriterionPartID = ?,ApproachTitle = ? ,ApproachDescription = ?, ExamplesOfApproach = ?,Deployment = ?,ExamplesOfDeployment = ?,AssessmentAndReview = ?,ExamplesOfAssessmentReview = ?, SourceOfInformation = ?,SoundRational = ?,Integrated = ?,Implemented = ?,Systematic = ?,Measurement = ?,Learning = ?,Improvement = ?, Strength = ?,AreaForImprovement = ?,TeamType = ?,Score = ?,SystemGeneratedScore = ?,Presented = ?,DirectRelavanceToDelivering = ?, RelevanceToThisCriterionPart = ?,ApproachToLink = ?,Status = ?,EnablerDocument = ?,missing = ? where EnablerAssessmentID = ?;";
	 
	 
	const SELECT_MAX_DUMMY_ENABLER_ID = "select max(DummyEnablerID) from enablerassessment where CriterionPartID like ?;";
	
	const SELECT_ENABLER_ID="SELECT EnablerAssessmentID FROM enablerassessment WHERE CriterionPartID like ? and DummyEnablerID=?;";
	
	const SELECT_SUB_TEAMASSESSMENT = "select DummyEnablerID,EnablerAssessmentID,e.CriterionPartID,ApproachTitle,ApproachDescription,CriterionPartShortDescription,ExamplesOfApproach,Deployment,ExamplesOfDeployment,AssessmentAndReview,ExamplesOfAssessmentReview,SourceOfInformation,SoundRational,Integrated,Implemented,Systematic,Measurement,Learning,Improvement,Strength,AreaForImprovement,TeamType,Score,SystemGeneratedScore,Presented,DirectRelavanceToDelivering, RelevanceToThisCriterionPart,ApproachToLink,Status,EnablerDocument,missing,LocationID,Location from enablerassessment e INNER JOIN criterionpart c ON c.CriterionPartID=e.CriterionPartID where e.CriterionPartID = ? and e.LocationID=? order by EnablerAssessmentID;";

	
	//ExeTeamAssessment
	
	const INSERT_EXE_TEAM_ENABLER_ASSESSMENT = "insert into exeteamenablerassessment(ExeTeamEnablerAsementID,EnablerAssessmentID,CriterionPartID, ApproachTitle,ApproachDescription,ExamplesOfApproach,Deployment,ExamplesOfDeployment,AssessmentAndReview, ExamplesOfAssessmentReview,SourceOfInformation,SoundRational,Integrated,Implemented,Systematic, Measurement,Learning,Improvement,Strength,AreaForImprovement,TeamType,Score,SystemGeneratedScore, Presented,DirectRelavanceToDelivering,RelevanceToThisCriterionPart,ApproachToLink,EnablerDocument,LocationID,Location) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
 
	const UPDATE_EXE_TEAM_ENABLER_ASSESSMENT = "update exeteamenablerassessment set EnablerAssessmentID=?,CriterionPartID = ?, ApproachTitle = ?,ApproachDescription = ?,ExamplesOfApproach = ?,Deployment = ?,ExamplesOfDeployment = ?,AssessmentAndReview = ?, ExamplesOfAssessmentReview = ?,SourceOfInformation = ?,SoundRational = ?,Integrated = ?,Implemented = ?,Systematic = ?, Measurement = ?,Learning = ?,Improvement = ?,Strength = ?,AreaForImprovement = ?,TeamType = ?,Score = ?,SystemGeneratedScore = ?, Presented = ?,DirectRelavanceToDelivering = ?,RelevanceToThisCriterionPart = ?,ApproachToLink = ?,EnablerDocument = ? where ApproachTitle = ?;";



	 //ExecutiveTeamAssessment 
	 
	 
	 const SELECT_MAX_EXE_TEAM_ENABLER_ID = "select max(ExeTeamEnablerAsementID) from exeteamenablerassessment;";
	 
	 const INSERT_ENABLER_DOCUMENT = "insert into enablerdocument(EnablerAssessmentID, EnablerDocumentID,EnablerDocument,EnablerDocumentDesc) values(?,?,?,?);";

	 const SELECT_CRITERIA_ID = "SELECT CriterionPartID FROM criterionpart where CriterionPartShortDescription = ?;";


	 //ResultAssessment

	 //const INSERT_RESULT_ASSESSMENT = "insert into resultassessment(resultassessmentid,criterionpartid,result,resultsegments,sourceofinformation,scope,segmentation,trends,targets,comparisons,causes,strength,areasforimprovement,score,teamtype,systemgeneratedscore,directrelavancetodelivering,relevancetothiscriterionpart,presented,resultstolink,resultdocument) value(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
	 
//	 const INSERT_RESULT_ASSESSMENT = "insert into resultassessment(resultassessmentid,criterionpartid,result,resultsegments,sourceofinformation,scope,segmentation,trends,targets,comparisons,causes,strength,areasforimprovement,score,teamtype,systemgeneratedscore,directrelavancetodelivering,relevancetothiscriterionpart,presented,resultstolink,resultdocument) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
	 
	 //const INSERT_RESULT_ASSESSMENT = "insert into resultassessment(ResultAssessmentID,CriterionPartID) values(?,?);";
	 
	 const INSERT_RESULT_ASSESSMENT = "insert into resultassessment(DummyResultID,CriterionPartID,Result,Presented,resultstolink,LocationID,Location) values(?,?,?,?,?,?,?);";
	 
	 //const UPDATE_RESULT_ASSESSMENT = "update resultassessment set result = ?,resultsegments = ?,sourceofinformation = ?,scope = ?,segmentation = ?,trends = ?,targets = ?,comparisons = ?,causes = ?,strength = ?,areasforimprovement = ?,score = ?,teamtype = ?,systemgeneratedscore = ?,directrelavancetodelivering = ?,relevancetothiscriterionpart = ?,presented = ?,resultstolink = ?,resultdocument = ? where criterionpartid = ?";
	 
	 //const UPDATE_RESULT_ASSESSMENT = "update resultassessment set CriterionPartID = ?,Result = ?,ResultSegments = ?,SourceOfInformation = ?,Scope = ?,Segmentation = ?,Trends = ?,Targets = ?,Comparisons = ?,Causes = ?,Strength = ?,AreasForImprovement = ?,Score = ?,TeamType = ?,SystemGeneratedScore = ?,DirectRelavanceToDelivering = ?,RelevanceToThisCriterionPart = ?,Presented = ?,ResultsToLink = ?,ResultDocument = ? where ResultAssessmentID = ?";
	 
	const UPDATE_RESULT_ASSESSMENT = "update resultassessment set CriterionPartID = ?,Result = ?,ResultSegments = ?,SourceOfInformation = ?, Scope = ?, Segmentation = ?,Integrity = ?, Trends = ?, Targets = ?, Comparisons = ?, Causes = ?, Strength = ?, AreasForImprovement = ?, Score = ?, TeamType = ?, SystemGeneratedScore = ?,DirectRelavanceToDelivering = ?, RelevanceToThisCriterionPart = ?, Presented = ?,ResultsToLink = ?, ResultDocument = ? where ResultAssessmentID = ?;";

	 const SELECT_RESULT_ASSESSMENT_ID = "SELECT ResultAssessmentID FROM resultassessment where CriterionPartID like ? and DummyResultID=?;";
	 
	 const SELECT_DUMMY_RESULT_ASSESSMENT_ID = "SELECT max(DummyResultID) FROM resultassessment Where CriterionPartID like ?;";
	 //const SELECT_RESULT_ASSESSMENT = "select criterionpartid,result,resultsegments,sourceofinformation,scope,segmentation,trends,targets,comparisons,causes,strength,areasforimprovement,score,teamtype,systemgeneratedscore,directrelavancetodelivering,relevancetothiscriterionpart,presented,resultstolink,resultdocument from resultassessment where criterionpartid = ?; ";
	 
	 const SELECT_RESULT_ASSESSMENT = "select DummyResultID,ResultAssessmentID, r.CriterionPartID,Result,ResultSegments,CriterionPartShortDescription, SourceOfInformation,Scope,Segmentation,Integrity,Trends,Targets,Comparisons,Causes,Strength,AreasForImprovement,Score,TeamType,SystemGeneratedScore,DirectRelavanceToDelivering,RelevanceToThisCriterionPart,Presented,ResultsToLink,ResultDocument,r.LocationID, r.Location from resultassessment r INNER JOIN criterionpart c on c.CriterionPartID=r.CriterionPartID where r.CriterionPartID = ? and r.LocationID=? order by ResultAssessmentID;";
	 
 
 
 
 
	 //EnablerDocument
	 
	 
//	 const INSERT_ENABLER_DOCUMENT_INFO = "insert into enablerdocument(EnablerAssessmentID, enablerdocumentid, enablerdocument, enablerdocumentdesc) values(?,?,?,?);";
	 
//	 const UPDATE_ENABLER_DOCUMENT = "update enablerdocument set resultdocumentid = ?,resultdocument = ?,resultdocumentdesc = ? where EnablerAssessmentID = ?";
	 
//	 const SELECT_ENABLER_DOCUMENT_ID = "select max(EnablerAssessmentID) from enablerdocument; ";
	 
 
 
	 //ResultDocument
	 
	 
	 //const INSERT_RESULT_DOCUMENT = "insert into resultdocument(resultassessmentid,resultdocumentid,resultdocument,resultdocumentdesc) values(?,?,?,?);";
	 
	 const UPDATE_RESULT_DOCUMENT = "update resultdocument set resultdocumentid = ?,resultdocument = ?,resultdocumentdesc = ? where resultassessmentid = ?";
	 
	// const SELECT_RESULT_DOCUMENT_ID = "select max(resultassessmentid) from resultdocument; ";
	 
	 const UPDATE_CRITERIAN_PARTID_SCORE = "update criteronpartscore set SubTeamScore = ? , ExeTeamScore = ?,  SubTeamAvgScore = ?, ExeTeamAvgScore = ? where CriterionPartShortDescription = ? AND LocationID=?;";
		 
	const DELETE_EXE_ENABLER_ASSESSMENT_ID = "delete FROM exeteamenablerassessment where EnablerAssessmentID = ?;";
	
	const DELETE_RESULT_ASSESSMENT_ID = "delete from resultassessment where ResultAssessmentID = ?;";
	
	const DELETE_EXE_RESULT_ASSESSMENT_ID = "delete from exeteamresultassessment where ResultAssessmentID = ?;";

	const DELETE_ENABLER_ASSESSMENT_ID = "delete from enablerassessment where EnablerAssessmentID = ?;";
	
	//const INSERT_EXE_TEAM_RESULT_ASSESSMENT = "insert into exeteamresultassessment(ExeResultAssessmentID,ResultAssessmentID,CriterionPartID,Result,Presented,ResultsToLink) values (?,?,?,?,?,?);";
	
	const INSERT_EXE_TEAM_RESULT_ASSESSMENT = "insert into exeteamresultassessment(ExeResultAssessmentID,ResultAssessmentID,CriterionPartID,Result,Presented,ResultsToLink,LocationID,Location) values (?,?,?,?,?,?,?,?);";
	
	const SELECT_EXE_TEAM_RESULT_ASSESSMENT = "select max(ExeResultAssessmentID) from exeteamresultassessment;";
	
	//const UPDATE_EXE_TEAM_RESULT_ASSESSMENT = "update exeteamresultassessment set CriterionPartID = ?, Result = ?, ResultSegments = ?, SourceOfInformation = ?, Scope = ?, Segmentation = ?, Trends = ?, Targets = ?, Comparisons = ?, Causes = ?, Strength = ?, AreasForImprovement = ? , Score = ?, TeamType = ?, SystemGeneratedScore = ?, DirectRelavanceToDelivering  = ?,RelevanceToThisCriterionPart = ?, Presented = ?, ResultsToLink = ?, ResultDocument = ? where ResultAssessmentID = ?;"
	
//	const UPDATE_EXE_TEAM_RESULT_ASSESSMENT = "update exeteamresultassessment set CriterionPartID = ?, Result = ?, ResultSegments = ?, SourceOfInformation = ?, Scope = ?, Segmentation = ?, Trends = ?, Targets = ?, Comparisons = ?, Causes = ?, Strength = ?, AreasForImprovement = ? , TeamType = ?, Score = ?, SystemGeneratedScore = ?, DirectRelavanceToDelivering  = ?,RelevanceToThisCriterionPart = ?, Presented = ?, ResultsToLink = ?, ResultDocument = ? where ResultAssessmentID = ?;";
	//const UPDATE_EXE_TEAM_RESULT_ASSESSMENT = "update exeteamresultassessment set CriterionPartID = ?, Result = ?, ResultSegments = ?, SourceOfInformation = ?, Scope = ?, Segmentation = ?, Trends = ?, Targets = ?, Comparisons = ?, Causes = ?, Strength = ?, AreasForImprovement = ? , TeamType = ?, Score = ?, SystemGeneratedScore = ?, DirectRelavanceToDelivering  = ?,RelevanceToThisCriterionPart = ?, Presented = ?, ResultsToLink = ?, ResultDocument = ? where ResultAssessmentID = ?;";
	
	const UPDATE_EXE_TEAM_RESULT_ASSESSMENT = "update exeteamresultassessment set CriterionPartID = ?, Result = ?, ResultSegments = ?, SourceOfInformation = ?, Scope = ?, Segmentation = ?, Trends = ?, Targets = ?, Comparisons = ?, Causes = ?, Strength = ?, AreasForImprovement = ? , TeamType = ?, Score = ?, SystemGeneratedScore = ?, DirectRelavanceToDelivering  = ?,RelevanceToThisCriterionPart = ?, Presented = ?, ResultsToLink = ?, ResultDocument = ? where ResultAssessmentID = ?;";
	
	
	
	const INSERT_ENABLER_DOCUMENT_INFO = "insert into enablerdocument(EnablerDocumentID, EnablerDocument, EnablerDocumentDesc) values(?,?,?);";
	
	//const SELECT_ENABLER_DOCUMENT = "select EnablerDocumentID, EnablerAssessmentID,EnablerDocument,EnablerDocumentDesc from enablerdocument;";
 
	const SELECT_ENABLER_DOCUMENT_ID = "select max(EnablerDocumentID) from enablerdocument;";
 
	const DELETE_ENABLER_DOCUMENT_ID = "delete from enablerdocument where EnablerDocumentID = ?;";
	 
	const INSERT_RESULT_DOCUMENT = "insert into resultdocument(ResultDocumentID,ResultDocument,ResultDocumentDesc) values(?,?,?);";
 
	const SELECT_RESULT_DOCUMENT = "select ResultAssessmentID,ResultDocumentID,ResultDocument,ResultDocumentDesc from resultdocument where ResultAssessmentID = ?;";
	
	const SELECT_NULL_RESULT_DOCUMENT = "select ResultAssessmentID,ResultDocumentID,ResultDocument,ResultDocumentDesc from resultdocument where ResultAssessmentID IS NULL OR ResultAssessmentID='';;";
 
	const SELECT_RESULT_DOCUMENT_ID = "select max(ResultDocumentID) from resultdocument; ";

	const DELETE_RESULT_DOCUMENT_ID = "delete from resultdocument where ResultDocumentID = ?;";
 
	const SELECT_ENABLER_DOCUMENT = "select EnablerDocumentID, EnablerAssessmentID,EnablerDocument,EnablerDocumentDesc from enablerdocument where EnablerAssessmentID = ?;";
	
	const SELECT_NULL_ENABLER_DOCUMENT = "select EnablerDocumentID, EnablerAssessmentID,EnablerDocument,EnablerDocumentDesc from enablerdocument where EnablerAssessmentID IS NULL  OR EnablerAssessmentID='';";
	
	const SELECT_CRITERIA_PARTID_TEAM_MEMBER="Select c.CriterionPartShortDescription from criterionpart c INNER JOIN teamcriterionpart tc ON c.CriterionPartID=tc.CriterionPartID Where tc.TeamID IN (SELECT TeamID From teammember Where UserID=?) order by c.CriterionPartID;";
	
	const SELECT_CRITERIA_PARTID_TEAM="Select c.CriterionPartShortDescription from criterionpart c INNER JOIN teamcriterionpart tc ON c.CriterionPartID=tc.CriterionPartID Where tc.TeamID IN (SELECT TeamID From team Where teamleader=?) order by c.CriterionPartID;";
	

    const SELECT_CRITERIA_PARTID_EXECUTIVETEAM="Select c.CriterionPartShortDescription from criterionpart c order by c.CriterionPartID;";
	

	//const SELECT_APPROACH_TO_LINK="Select e.EnablerAssessmentID,e.CriterionPartID,c.CriterionPartShortDescription, e.ApproachTitle,a.DescriptionofLinkage from enablerassessment e left outer join approachlinkage a on  e.EnablerAssessmentID = a.EnablerLinkageID inner join criterionpart c on c.CriterionPartID =e.CriterionPartID where e.EnablerAssessmentID != ?;";
	
	//const SELECT_APPROACH_TO_LINK="Select e.EnablerAssessmentID,e.CriterionPartID,c.CriterionPartShortDescription, e.ApproachTitle,a.DescriptionofLinkage from enablerassessment e left outer join approachlinkage a on  e.EnablerAssessmentID = a.EnablerLinkageID AND a.EnablerAssessmentID=? inner join criterionpart c on c.CriterionPartID =e.CriterionPartID where e.EnablerAssessmentID != ?;";
	
	//const SELECT_APPROACH_TO_LINK="(Select e.EnablerAssessmentID,e.CriterionPartID,c.CriterionPartShortDescription,e.ApproachTitle,a.DescriptionofLinkage from enablerassessment e left outer join approachlinkage a on  e.EnablerAssessmentID = a.EnablerLinkageID AND a.EnablerAssessmentID=? inner join criterionpart c on c.CriterionPartID =e.CriterionPartID where e.EnablerAssessmentID != ?) UNION ALL (Select e.ResultAssessmentID as EnablerAssessmentID,e.CriterionPartID,c.CriterionPartShortDescription,e.Result,a.DescriptionofLinkage from resultassessment e left outer join approachlinkage a on  e.ResultAssessmentID = a.EnablerLinkageID AND a.EnablerAssessmentID=? inner join criterionpart c on c.CriterionPartID =e.CriterionPartID where e.ResultAssessmentID != ?);";
	//const SELECT_APPROACH_TO_LINK_ENABLER="(Select e.EnablerAssessmentID,e.CriterionPartID,c.CriterionPartShortDescription,e.ApproachTitle,a.DescriptionofLinkage from enablerassessment e left outer join approachlinkage a on e.EnablerAssessmentID = a.EnablerLinkageID AND a.EnablerAssessmentID != ? inner join criterionpart c on c.CriterionPartID = e.CriterionPartID and e.EnablerAssessmentID != ?) union all (Select e.ResultAssessmentID as EnablerAssessmentID,e.CriterionPartID,c.CriterionPartShortDescription,e.Result, a.DescriptionofLinkage from resultassessment e left outer join approachlinkage a on  e.ResultAssessmentID = a.EnablerLinkageID AND a.EnablerAssessmentID = ? inner join criterionpart c on c.CriterionPartID = e.CriterionPartID);";
	
	const SELECT_APPROACH_TO_LINK_ENABLER="Select e.DummyEnablerID as DummyEnablerID,e.EnablerAssessmentID,e.CriterionPartID as CriterionPartID,c.CriterionPartShortDescription,e.ApproachTitle,a.DescriptionofLinkage from enablerassessment e left outer join approachlinkage a on  e.EnablerAssessmentID = a.EnablerLinkageID AND a.EnablerAssessmentID=? inner join criterionpart c on c.CriterionPartID =e.CriterionPartID where e.EnablerAssessmentID != ? UNION ALL Select e.DummyResultID as DummyEnablerID,e.ResultAssessmentID as EnablerAssessmentID,e.CriterionPartID as CriterionPartID, c.CriterionPartShortDescription,e.Result,a.DescriptionofLinkage from resultassessment e left outer join approachlinkage a on  e.ResultAssessmentID = a.EnablerLinkageID AND a.EnablerAssessmentID=? inner join criterionpart c on c.CriterionPartID =e.CriterionPartID order by CriterionPartID,DummyEnablerID;";
	
	//const SELECT_APPROACH_TO_LINK_RESULT="(Select e.EnablerAssessmentID,e.CriterionPartID,c.CriterionPartShortDescription,e.ApproachTitle,a.DescriptionofLinkage from enablerassessment e left outer join approachlinkage a on e.EnablerAssessmentID = a.EnablerLinkageID AND a.EnablerAssessmentID != ? inner join criterionpart c on c.CriterionPartID = e.CriterionPartID) union all (Select e.ResultAssessmentID as EnablerAssessmentID,e.CriterionPartID,c.CriterionPartShortDescription,e.Result, a.DescriptionofLinkage from resultassessment e left outer join approachlinkage a on  e.ResultAssessmentID = a.EnablerLinkageID AND a.EnablerAssessmentID = ? inner join criterionpart c on c.CriterionPartID = e.CriterionPartID and e.ResultAssessmentID != ?);";
	
	const SELECT_APPROACH_TO_LINK_RESULT="Select e.DummyEnablerID as DummyID,e.EnablerAssessmentID,e.CriterionPartID as CriterionPartID,c.CriterionPartShortDescription,e.ApproachTitle,a.DescriptionofLinkage from enablerassessment e left outer join approachlinkage a on  e.EnablerAssessmentID = a.EnablerLinkageID AND a.EnablerAssessmentID=? inner join criterionpart c on c.CriterionPartID =e.CriterionPartID UNION ALL Select e.DummyResultID as DummyID,e.ResultAssessmentID as EnablerAssessmentID,e.CriterionPartID as CriterionPartID,c.CriterionPartShortDescription,e.Result,a.DescriptionofLinkage from resultassessment e left outer join approachlinkage a on  e.ResultAssessmentID = a.EnablerLinkageID AND a.EnablerAssessmentID=? inner join criterionpart c on c.CriterionPartID =e.CriterionPartID where e.ResultAssessmentID != ? order by CriterionPartID,DummyID;";
	
	const DELETE_LINK_ALREADY_EXISTS = "Delete from approachlinkage where EnablerAssessmentID = ? and CriterionPartID=?;";
	
	const INSERT_LINK_CRITERIA = "insert into approachlinkage(EnablerAssessmentID,EnablerLinkageID,DescriptionofLinkage,CriterionPartID,LinkageCriterionPartID,ApproachToLink,DummyID) values(?,?,?,?,?,?,?);";
	
	const SELECT_ENABLER_LINK_TO_APPROACH="Select ApproachToLink From approachlinkage where EnablerAssessmentID=? AND CriterionPartID=?";
	
	const SELECT_OTHER_ENABLER_LINK_TO_APPROACH="Select distinct DummyID,CriterionPartShortDescription,EnablerAssessmentID From approachlinkage a INNER JOIN criterionpart c ON c.CriterionPartID=a.CriterionPartID where EnablerLinkageID=? AND LinkageCriterionPartID=?;";
	
	const SELECT_ALL_SUB_TEAMASSESSMENT = "select DummyEnablerID,EnablerAssessmentID,e.CriterionPartID,ApproachTitle,ApproachDescription,CriterionPartShortDescription,ExamplesOfApproach,Deployment,ExamplesOfDeployment,AssessmentAndReview,ExamplesOfAssessmentReview,SourceOfInformation,SoundRational,Integrated,Implemented,Systematic,Measurement,Learning,Improvement,Strength,AreaForImprovement,TeamType,Score,SystemGeneratedScore,Presented,DirectRelavanceToDelivering, RelevanceToThisCriterionPart,ApproachToLink,Status,EnablerDocument,missing,LocationID,Location from enablerassessment e INNER JOIN criterionpart c ON c.CriterionPartID=e.CriterionPartID where e.CriterionPartID<25 and LocationID=? order By c.CriterionPartID,DummyEnablerID;";
	
	const SELECT_ALL_RESULT_ASSESSMENT = "select DummyResultID,ResultAssessmentID, r.CriterionPartID,Result,ResultSegments,CriterionPartShortDescription, SourceOfInformation,Scope,Segmentation,Trends,Targets,Comparisons,Causes,Strength,AreasForImprovement,Score,TeamType,SystemGeneratedScore,DirectRelavanceToDelivering,RelevanceToThisCriterionPart,Presented,ResultsToLink,ResultDocument,LocationID,Location from resultassessment r INNER JOIN criterionpart c on c.CriterionPartID=r.CriterionPartID where r.CriterionPartID >24 and LocationID=?;";
	
	const GET_ENABLER_COMMENTS="Select  CommentsOfExeTeam,SubTeamActions from exeteamenablercomments where EnablerAssessmentID=? AND CriterionPartID=?;";
	
	const GET_RESULT_COMMENTS="Select  CommentsOfExeTeam,SubTeamActions from exeteamresultscomments where ResultAssessmentID=? AND CriterionPartID=?;";
	
	//const INSERT_ENABLER_COMMENTS="insert into exeteamenablercomments(EnablerAssessmentID,CommentID,CriterionPartID,CommentsOfExeTeam,SubTeamActions,ApproachToLink) values(?,?,?,?,?,?);";
	
	const DELETE_ENABLER_COMMENTS="Delete from exeteamenablercomments where EnablerAssessmentID=? and CriterionPartID=?;";
	
	const INSERT_RESULT_COMMENTS="insert into exeteamresultscomments(ResultAssessmentID,CommentID,CriterionPartID,CommentsOfExeTeam,SubTeamActions,ResultsToLink) values(?,?,?,?,?,?);";
	
	const DELETE_RESULT_COMMENTS="Delete from exeteamresultscomments where ResultAssessmentID=? and CriterionPartID=?;";
	
	const GET_ENABLER_SCORE_POINTS="SELECT CriterionPartShortDescription,SubteamScore,ExeTeamScore From criteronpartscore Where CriterionPartID<=24 and LocationID=? order by CriterionPartID;";
	
	const GET_RESULT_SCORE_POINTS="SELECT CriterionPartShortDescription,SubteamScore,ExeTeamScore From criteronpartscore Where CriterionPartID>24 and LocationID=? order by CriterionPartID;";
	
//	const GET_ENABLER_TOTAL_POINTS="Select CriteriaShortDescription,PointsAwarded,Factor,avg(cp.SubTeamScore) from criteria c inner join criterionpart cp on cp.CriteriaID=c.CriteriaID where c.CriteriaID<=5 group by c.CriteriaID;";

	const GET_ENABLER_TOTAL_POINTS = "Select CriteriaShortDescription,PointsAwarded,Factor,c.CriteriaID,SUM(cp.SubTeamScore)  from criteria c left outer join criteronpartscore cp on cp.CriteriaID=c.CriteriaID and cp.LocationID=? where c.CriteriaID<=5 group by c.CriteriaID;";
	
	const GET_RESULT_TOTAL_POINTS="Select CriteriaShortDescription,PointsAwarded,Factor,c.CriteriaID,sum(cp.DummySubTeamScore),cp.CriterionPartID from criteria c left outer join criteronpartscore cp on cp.CriteriaID=c.CriteriaID and cp.LocationID=? where c.CriteriaID>5 group by c.CriteriaID;";
	
//	const GET_ENABLER_FEEDBACK_SCORE="select distinct (EnablerAssessmentID),c.CriterionPartShortDescription,Strength,AreaForImprovement,P1.ScoreValue as SoundRational,P2.ScoreValue as Integrated,P3.ScoreValue as Implemented,P4.ScoreValue as Systematic,P5.ScoreValue as Measurement,P6.ScoreValue as Learning,P7.ScoreValue as Improvement from enablerassessment e left outer join picklistitem P1 on P1.PickListShortDescription=e.SoundRational left outer join picklistitem P2 on P2.PickListShortDescription=e.Integrated left outer join picklistitem P3 on P3.PickListShortDescription=e.Implemented left outer join picklistitem P4 on P4.PickListShortDescription=e.Systematic left outer join picklistitem P5 on P5.PickListShortDescription=e.Measurement left outer join picklistitem P6 on P6.PickListShortDescription=e.Learning left outer join picklistitem P7 on P7.PickListShortDescription=e.Improvement inner join criterionpart c on c.CriterionPartID=e.CriterionPartID;";
	
	const GET_ENABLER_FEEDBACK_SCORE="select distinct DummyEnablerID,EnablerAssessmentID,c.CriterionPartShortDescription,ApproachTitle,Strength,AreaForImprovement,P1.ScoreValue as SoundRational,P2.ScoreValue as Integrated,P3.ScoreValue as Implemented,P4.ScoreValue as Systematic,P5.ScoreValue as Measurement,P6.ScoreValue as Learning,P7.ScoreValue as Improvement from enablerassessment e left outer join picklistitem P1 on e.SoundRational=P1.PickListShortDescription left outer join picklistitem P2 on e.Integrated=P2.PickListShortDescription left outer join picklistitem P3 on e.Implemented=P3.PickListShortDescription left outer join picklistitem P4 on e.Systematic=P4.PickListShortDescription left outer join picklistitem P5 on e.Measurement=P5.PickListShortDescription left outer join picklistitem P6 on e.Learning=P6.PickListShortDescription left outer join picklistitem P7 on e.Improvement=P7.PickListShortDescription inner join criterionpart c on c.CriterionPartID=e.CriterionPartID where LocationID=?;";
	
	//const GET_RESULT_FEEDBACK_SCORE="select r.ResultAssessmentID,c.CriterionPartShortDescription,r.Result,r.Strength,r.AreasForImprovement, P1.ScoreValue AS Relevance,P2.ScoreValue AS Segmentation,P3.ScoreValue AS Trends,P4.ScoreValue AS argets,P5.ScoreValue AS Comparisons,P6.ScoreValue AS Causes,Score FROM resultassessment r LEFT OUTER JOIN  picklistitem P1 ON r.Scope= P1.PickListShortDescription LEFT OUTER JOIN  picklistitem P2 ON r.Segmentation=P2.PickListShortDescription LEFT OUTER JOIN picklistitem P3 ON r.Trends=P3.PickListShortDescription LEFT OUTER JOIN picklistitem P4 ON r.Targets=P4.PickListShortDescription;";
	
	const GET_RESULT_FEEDBACK_SCORE="select r.DummyResultID,r.ResultAssessmentID,c.CriterionPartShortDescription,r.Result,r.Strength,r.AreasForImprovement,P1.ScoreValue AS Relevance,P2.ScoreValue AS Segmentation,P3.ScoreValue AS Trends,P4.ScoreValue AS Targets,P5.ScoreValue AS Comparisons,P6.ScoreValue AS Causes,P7.ScoreValue as Integrity,Score FROM resultassessment r LEFT OUTER JOIN  picklistitem P1 ON r.Scope= P1.PickListShortDescription LEFT OUTER JOIN  picklistitem P2 ON r.Segmentation=P2.PickListShortDescription LEFT OUTER JOIN picklistitem P3 ON r.Trends=P3.PickListShortDescription LEFT OUTER JOIN picklistitem P4 ON r.Targets=P4.PickListShortDescription LEFT OUTER JOIN picklistitem P5 ON r.Comparisons=P5.PickListShortDescription LEFT OUTER JOIN picklistitem P6 ON r.Causes=P6.PickListShortDescription LEFT OUTER JOIN picklistitem P7 ON r.Integrity=P7.PickListShortDescription inner join criterionpart c on c.CriterionPartID=r.CriterionPartID where LocationID=?;";

//	Result,Strength,AreasForImprovement,P1.ScoreValue AS Relevance,P2.ScoreValue AS Segmentation,P3.ScoreValue AS Trends,P4.ScoreValue AS Targets,P5.ScoreValue AS Comparisons,P6.ScoreValue AS Causes 

	const CHECK_APPROACH_EXISTS_FOR_DELETION="select count(EnablerLinkageID) from approachlinkage where EnablerLinkageID=? and LinkageCriterionPartID=?;";
	
	const DELETE_LINKAGE_APPROACH="DELETE FROM approachlinkage where EnablerAssessmentID=? AND CriterionPartID=?;";
	
	const UPDATE_DOCUMENT_ENABLER_ID="Update enablerdocument set EnablerAssessmentID=? where EnablerAssessmentID IS NULL  OR EnablerAssessmentID='';";
	
	const UPDATE_DOCUMENT_RESULT_ID="Update resultdocument set ResultAssessmentID=? where ResultAssessmentID IS NULL OR ResultAssessmentID='';;";
	
	const INSERT_RESULT_DOCUMENT_INFO = "insert into resultdocument(ResultAssessmentID,ResultDocumentID,ResultDocument,ResultDocumentDesc) values(?,?,?,?);";
	
	const DELETE_ALL_ENABLER_DOCUMENT="Delete from enablerdocument where EnablerAssessmentID=?;";
	
	const DELETE_ALL_RESULT_DOCUMENT="Delete from resultdocument where ResultAssessmentID=?;";
	
	const DELETE_ALL_NULL_ENABLER_DOCS="Delete from enablerdocument where EnablerAssessmentID IS Null OR EnablerAssessmentID='';";
	
	const DELETE_ALL_NULL_RESULT_DOCS="Delete from resultdocument where ResultAssessmentID IS Null OR ResultAssessmentID='';";

	const SELECT_ENABLER_DOCUMENT_NAME="Select EnablerDocument from enablerdocument where EnablerDocumentID=?;";
	
	const SELECT_RESULT_DOCUMENT_NAME="Select ResultDocument from resultdocument where ResultDocumentID=?;";
	
	const TO_CHECK_LOGINNAME_EXISTS = "SELECT count(UserID) FROM usermaster where LoginName = ?;";
	
	const TO_CHECK_USER_EXISTS = "SELECT count(EMail) as cntEmail FROM usermaster Where Email=?;";
	
	const TO_CHECK_LOGINNAME_EXISTS_UPDATE = "SELECT count(UserID) FROM usermaster where LoginName = ? and UserID!=?;";
	
	const TO_CHECK_USER_EXISTS_UPDATE = "SELECT count(EMail) as cntEmail FROM usermaster Where Email=? and UserID!=?;";
	
	const SELECT_CRITERIA_PARTID_TEAM_MEMBER_ACTION_PLAN="Select distinct(c.CriterionPartID), c.CriterionPartShortDescription,c.CriterionPartDefinition from criterionpart c INNER JOIN teamcriterionpart tc ON c.CriterionPartID=tc.CriterionPartID Where tc.TeamID IN (SELECT TeamID From teammember Where UserID=?) ORDER BY c.CriterionPartID;";
	
	const SELECT_CRITERIA_PARTID_TEAM_ACTION_PLAN="Select distinct(c.CriterionPartID), c.CriterionPartShortDescription,c.CriterionPartDefinition from criterionpart c INNER JOIN teamcriterionpart tc ON c.CriterionPartID=tc.CriterionPartID Where tc.TeamID IN (SELECT TeamID From team Where teamleader=?) ORDER BY c.CriterionPartID;";
	
	const CHK_PROJ_PLAN_EXISTS="select count(Milestone) from exeteamactivities where Milestone=? and Activity=?;";
	
	const CHK_PROJ_PLAN_EXISTS_WHILE_UPDATE="select count(Milestone) from exeteamactivities where Milestone=? and Activity=? and ActivityID!=?;";
	
	const SELECT_TEAM_LEADER_REG_LOC = "select UserID,UserName,SurName from usermaster where RoleId <= 5 and LocationID=? order by UserName;";
	
	const SELECT_LOCATION_FOR_TEAM = "select LocationID from team Where TeamName=?;";
	
	const SELECT_USERS_FOR_RESP = "SELECT u.username,u.SurName,u.UserID FROM usermaster u,executiveteam e Where u.UserID=e.UserID and u.LocationID=?;";
	
	const SELECT_CRITERION_DETAILS = "SELECT CriterionPartShortDescription,CriteriaID,MaxPoints,CPFactor FROM criterionpart where CriterionPartID=?;";
	
	const CHK_CRITERION_PART_SCORE = "select count(CriterionPartID) from criteronpartscore where CriterionPartID=? And LocationID=?;";
	
	const INSERT_CRITERION_PART_SCORE = "insert into criteronpartscore(CriterionPartID,CriterionPartShortDescription,CriteriaID,MaxPoints,CPFactor,LocationID) values (?,?,?,?,?,?)";
	
	const SELECT_CRITERIA_SUB_TEAM_SCORE = "SELECT SubTeamScore FROM criteronpartscore where CriterionPartID=? and LocationID=?;";
	
	const TO_CHECK_EXE_ROLE_EXISTS = "select count(RoleID) from usermaster where RoleID=? and UserID!=?;";
	
	const TO_CHECK_EXE_ROLE_EXISTS_ADD = "select count(RoleID) from usermaster where RoleID=?;";
	
	const UNSELECT_EXECUTIVE_MEMBERS = "SELECT u.userID, u.userName, u.SurName, u.designation,u.RoleID, r.RoleName,u.LocationID,u.Location from usermaster u,roles r Where u.RoleID=r.RoleID And u.userID not in(Select UserID from executiveteam) And u.RoleID<=5;";
	
	const UNSELECT_EXECUTIVE_MEMBERS_REG_LOCATION = "SELECT u.userID, u.userName, u.SurName, u.designation,u.RoleID, r.RoleName,u.LocationID,u.Location from usermaster u,roles r Where u.RoleID=r.RoleID And u.userID not in(Select UserID from executiveteam) And u.RoleID<=5 And u.LocationID=?;";
	
	const GET_TEAM_ID = "Select TeamID from team Where TeamName=?";
	
	const UPDATE_TEAM_USER = "Update usermaster set TeamID=? Where UserID=?;";
	
	const UPDATE_TEAM_USER_AS_NULL = "Update usermaster set TeamID=0 Where TeamID=?;";
	
	const INSERT_ENABLER_COMMENTS = "insert into comments(ApproachID,CriteriaID,UserID,RoleID,Comments,ApproachToLink,SubteamActions) Values (?,?,?,?,?,?,?);";
	
	const SELECT_EXE_COMMENTS = "select c.ApproachID,c.CriteriaID,u.UserName,u.SurName,r.RoleName,c.UserID,c.RoleID,c.Comments,c.CommentID,c.ApproachToLink,c.SubteamActions from comments c,usermaster u,roles r where u.UserID=c.UserID and r.RoleID=c.RoleID and c.ApproachToLink=?;";
	
	const INSERT_PROJECT_DETAILS = "insert into projectdetails(Title,Responsibility,StartDate,EndDate,Description,OrgStrategy,CriterionPart,Implementation,Status,Score, expectedBenefits, requiredResources) values(?,?,?,?,?,?,?,?,?,?,?,?);";
	
	const SELECT_RESPONSIBILITY_PERSON = "Select u.userID,username,surname from usermaster u,executiveteam e where u.userID=e.UserID order by username;";
	
	const SELECT_PROJECT_ID = "select ProjectID from projectdetails order by ProjectID desc LIMIT 1;";
	
	const INSERT_PROJECT_APPROACH_LINK_DETAILS = "insert into projectapproachdetails(ProjectID,CriteriaID,ApproachID,ApproachTitle,Type,StrengthID,AFIID,DummyApproachID,Title) values (?,?,?,?,?,?,?,?,?);";
	
	const SELECT_ALL_PROJECTS = "Select ProjectID,Title,Responsibility,StartDate,EndDate,Description,OrgStrategy,CriterionPart,Implementation,Status,Priority,u.UserName,u.SurName,TeamName from projectdetails,usermaster u where u.UserID=Responsibility order by ProjectID,Priority;";
	
	const UPDATE_PROJECT_STATUS = "Update projectdetails set Status=? Where ProjectID=?;";
	
	const UPDATE_PROJECTS_PRIORITY = "Update projectprioritysetting set orgstrategy=?  , criterianparts = ? , easeofimp=?;";
	
	const SELECT_PROJECTS_PRIORITY = " Select orgstrategy,   criterianparts, easeofimp from projectprioritysetting ; ";
	
	const UPDATE_PROJECT_DETAILS = "Update projectdetails set Title=?,Responsibility=?,StartDate=?,EndDate=?,Description=?,OrgStrategy=?,CriterionPart=?,Implementation=?,score=?, Priority = ?, requiredResources = ?, expectedBenefits = ?  where ProjectID=?;";
	
	const INSERT_PROJECT_PROGRESS_DETAILS = "insert into projectprogressreport(ProjectID,ProgressReport,UserID,CreatedAt) values (?,?,?,?);";
	
	const SELECT_PROJECT_PROGRESS_DETAILS = "Select ProjectID,ProgressID,ProgressReport,p.UserID,CreatedAt,u.UserName,u.SurName,r.RoleName from projectprogressreport p,usermaster u,roles r where u.UserID=p.UserID and u.RoleID=r.RoleID and ProjectID=?;";
	
	const GET_ROLED_FOR_SELECTED_USER = "Select roleID from usermaster where UserID=?;";
	
	const DELETE_PROJECT_DETAILS = "Delete from projectdetails where ProjectID=?";
	
	const DELETE_PROJECT_PROGRESS_REPORT_DETAILS = "Delete from projectprogressreport where ProjectID=?";
	
	const DELETE_PROJECT_APPROACH_DETAILS = "Delete from projectapproachdetails where ProjectID=?";
	
	const CHK_PROJ_TITLE_EXISTS = "select count(Title) from projectdetails where Title=?;";
	
	const CHK_PROJ_TITLE_EXISTS_UPDATE = "select count(Title) from projectdetails where Title=? and ProjectID!=?;";
	
	const SELECT_PROJECT_TEAM_MEMBERS = "SELECT u.userID, u.userName, u.SurName, u.designation, r.RoleName,u.LocationID, u.Location,p.ProjectID FROM usermaster u LEFT OUTER JOIN projectteammember p ON p.UserID=u.userID AND p.ProjectID=? INNER JOIN roles r ON r.RoleID=u.RoleID WHERE u.UserID NOT IN(Select Responsibility from projectdetails) and u.LocationID=?;";
	
	const SELECT_LOCATION_FOR_PROJ_RESP = "select LocationID from usermaster where UserID IN(Select Responsibility from projectdetails Where ProjectID=?);";
	
	const INSERT_PROJECT_TEAM_MEMBERS = "insert into projectteammember(ProjectID,UserID) values (?,?);";
	
	const DELETE_PROJECT_TEAM_MEMBERS = "Delete from projectteammember where ProjectID=?;";
	
	const UPDATE_PROJECT_TEAM_NAME_ONLY = "Update projectdetails set TeamName=? where ProjectID=?;";
	
	const CHK_PROJECT_TEAM_NAME_EXISTS = "Select count(TeamName) from projectdetails where TeamName=? and ProjectID!=?;";
	
	const SELECT_ALL_PROJECT_TEAM_NAME = "select distinct TeamName from projectdetails where TeamName!=''";
	
	const SEARCH_PROJECT_DETAILS_REG_TNAME_PRIORITY = "Select ProjectID,Title,Responsibility,StartDate,EndDate,Description,OrgStrategy,CriterionPart,Implementation,Status,Priority,u.UserName,u.SurName,TeamName, requiredResources, expectedBenefits from projectdetails p,usermaster u where u.UserID=Responsibility and p.TeamName like ? and priority like ?  order by Priority desc;";
	
	const SEARCH_PROJECT_DETAILS_REG_PNAME_PRIORITY = "Select ProjectID,Title,Responsibility,StartDate,EndDate,Description,OrgStrategy,CriterionPart,Implementation,Status,Priority,u.UserName,u.SurName,TeamName, requiredResources, expectedBenefits from projectdetails p,usermaster u where u.UserID=Responsibility and p.Title like ? and priority like ?  order by Priority desc;";
	
	const SEARCH_PROJECT_REPORTS_DETAILS = "Select ProjectID,Title,Responsibility,StartDate,EndDate,Description,OrgStrategy,CriterionPart,Implementation,Status,Priority,u.UserName,u.SurName,TeamName from projectdetails p,usermaster u where u.UserID=Responsibility and p.Title like ? and Status like ?  order by Title desc;";
	
	const SEARCH_PROJECT_DETAILS_REG_PRIORITY = "Select ProjectID,Title,Responsibility,StartDate,EndDate,Description,OrgStrategy,CriterionPart,Implementation,Status,Priority,u.UserName,u.SurName,TeamName, requiredResources, expectedBenefits from projectdetails p,usermaster u where u.UserID=Responsibility and priority like ?  order by Priority desc;";
	
	const SEARCH_PROJECT_DETAILS_REG_TNAME = "Select ProjectID,Title,Responsibility,StartDate,EndDate,Description,OrgStrategy,CriterionPart,Implementation,Status,Priority,u.UserName,u.SurName,TeamName, requiredResources, expectedBenefits from projectdetails p,usermaster u where u.UserID=Responsibility and p.TeamName like ?  order by Priority desc;";
	
	const SEARCH_PROJECT_DETAILS_REG_PNAME = "Select ProjectID,Title,Responsibility,StartDate,EndDate,Description,OrgStrategy,CriterionPart,Implementation,Status,Priority,u.UserName,u.SurName,TeamName, requiredResources, expectedBenefits from projectdetails p,usermaster u where u.UserID=Responsibility and p.Title like ?  order by Priority desc;";
	
	const SEARCH_PROJECT_DETAILS_LIST = "Select ProjectID,Title,Responsibility,StartDate,EndDate,Description,OrgStrategy,CriterionPart,Implementation,Status,Priority,u.UserName,u.SurName,TeamName, requiredResources, expectedBenefits from projectdetails p,usermaster u where u.UserID=Responsibility order by Priority desc;";
	
	const CHK_PROJECT_RESP_EXISTS = "select count(Responsibility) from projectdetails where Responsibility=?;";
	
	const GET_SUM_OF_SCORE = "select SUM(Score) from projectdetails";
	
	const UPDATE_IND_PROJECTS_PRIORITY = "update projectdetails set Priority = ((OrgStrategy * ? ) + (CriterionPart * ?) + (Implementation * ?));";
	
	const CHK_PROJECT_RESP_EXISTS_UPDATE = "select count(Responsibility) from projectdetails where Responsibility=? and ProjectID!=?;";
	
	const UPDATE_PROJECT_PRIORITY_DETAILS = "update projectdetails set Priority=round((score/?)*100);";
	
	const SELECT_TEAM_DETAILS_REG_TEAM_NAME = "select t.TeamID, t.TeamName, u.username,t.LocationID,t.Location,u.SurName from usermaster u,team t where u.UserID = t.TeamLeader and t.TeamName like ? and t.LocationID=?;";
	
	const SELECT_PROJECT_APPROACH_LINK_DETAILS = "SELECT ProjectID,CriteriaID,ApproachID,ApproachTitle,Type,StrengthID,AFIID FROM projectapproachdetails order by CriteriaID;";
	
	const SELECT_REPORT_DOCUMENT = "select e.CriterionPartID,CriterionPartShortDescription,CriteriaID,doc.EnablerAssessmentID,EnablerDocumentID,doc.EnablerDocument,EnablerDocumentDesc,'Enabler' as type from enablerdocument doc,enablerassessment e inner join criterionpart c ON c.CriterionPartID = e.CriterionPartID where doc.EnablerDocument like ? and doc.EnablerAssessmentID=e.EnablerAssessmentID union all select r.CriterionPartID,CriterionPartShortDescription,CriteriaID, doc.ResultAssessmentID,ResultDocumentID,doc.ResultDocument,ResultDocumentDesc,'Result' as type from resultdocument doc,resultassessment r inner join criterionpart c ON c.CriterionPartID = r.CriterionPartID where doc.ResultDocument like ? and doc.ResultAssessmentID=r.ResultAssessmentID;";
	
	const CHK_USERNAME_SURNAME_EXISTS ="select count(userID) from usermaster where UserName=? and SurName=?;";
	
	const CHK_USERNAME_SURNAME_EXISTS_UPDATE = "select count(userID) from usermaster where UserName=? and SurName=? and UserID!=?;";
	
	const SELECT_ALL_APPROACH_DETAILS = "select DummyEnablerID as DummyID,EnablerAssessmentID as ApproachID,e.CriterionPartID,CriterionPartShortDescription,ApproachTitle as Title,Strength,AreaForImprovement,StrengthLen,AFILen from enablerassessment e,criterionpart c where e.CriterionPartID=c.CriterionPartID and LocationID=? UNION ALL select DummyResultID as DummyID,ResultAssessmentID as ApproachID,r.CriterionPartID,CriterionPartShortDescription,Result as Title,Strength,AreasForImprovement,StrengthLen,AFILen from resultassessment r,criterionpart c where r.CriterionPartID=c.CriterionPartID and LocationID=?;";
	
	const SELECT_CRITERIA_OWNER ="Select t.TeamID,TeamName,TeamLeader,u.UserName,u.SurName from team t,usermaster u where t.TeamID IN(Select TeamID from teamcriterionpart where CriterionPartID=?) and u.UserID=t.TeamLeader;";
	
	const INSERT_PROJECT_DOCUMENT_INFO ="insert into tbl_project_document(project_name,project_document_name,project_desc) values(?,?,?);";
	
	const GET_PROJECT_DOCUMENTS ="SELECT project_document_name,project_desc, project_name, project_id FROM tbl_project_document where project_name = ?;";
	
	const DELETE_PROJECT_DOCUMENT = "delete from tbl_project_document where project_id = ?;";
	
	const SELECT_STRENGTH="Select StrengthID,CriterionPartID,ApproachID,Type,Strength from strength where ApproachID = ? and Type like ?;";
	
	const SELECT_AFI="Select AFIID,CriterionPartID,ApproachID,Type,AFI from areaforimprovement  where ApproachID = ? and Type like ?;";
	
	const INSERT_STRENGTH="Insert into strength(CriterionPartID,ApproachID,Type,Strength)values(?,?,?,?);";
	
	const DELETE_STRENGTH="Delete from strength where ApproachID=? and Type like ?;";
	
	const INSERT_AFI="Insert into areaforimprovement(CriterionPartID,ApproachID,Type,AFI) values (?,?,?,?);";
	
	const DELETE_AFI="Delete from areaforimprovement where ApproachID=? and Type like ?;";
	
	const CHK_FILE_EXISTS_ENABLER_EMPTY="Select count(EnablerDocumentID) from enablerdocument where EnablerAssessmentID IS NULL and EnablerDocument like ?;";
	
	const CHK_FILE_EXISTS_RESULT_EMPTY="Select count(ResultDocumentID) from resultdocument where ResultAssessmentID IS NULL and ResultDocument like ?;";
	
	const CHK_FILE_EXISTS_PROJ="Select Count(project_id) from tbl_project_document where project_name like ? and project_document_name like ?;";
	
	const CHK_FILE_EXISTS_ENABLER="Select count(EnablerDocumentID) from enablerdocument where EnablerAssessmentID like ? and EnablerDocument like ?;";
	
	const CHK_FILE_EXISTS_RESULT="Select count(ResultDocumentID) from resultdocument where ResultAssessmentID like ? and ResultDocument like ?;";
	
	const UPDATE_ENABLER_STRENGTH="UPDATE enablerassessment set Strength=?,StrengthLen=? where EnablerAssessmentID=?;";
	
	const UPDATE_RESULT_STRENGTH="UPDATE resultassessment set Strength=?,StrengthLen=? where ResultAssessmentID=?;";
	
	const UPDATE_ENABLER_AFI="UPDATE enablerassessment set AreaForImprovement=?,AFILen=? where EnablerAssessmentID=?;";
	
	const UPDATE_RESULT_AFI="UPDATE resultassessment set AreasForImprovement=?,AFILen=? where ResultAssessmentID=?;";
	
	const SELECT_STRENGTH_ALL="Select StrengthID,CriterionPartID,ApproachID,Type,Strength from strength  order by CriterionPartID;";
	
	const SELECT_AFI_ALL="Select AFIID,CriterionPartID,ApproachID,Type,AFI from areaforimprovement  order by CriterionPartID;";
	
	const SELECT_MISSING_APPROACHES="Select e.DummyEnablerID as DummyID,e.EnablerAssessmentID as assessmentID,e.CriterionPartID,e.ApproachTitle as Title,'Enabler' as Type,c.CriterionPartShortDescription from enablerassessment e,criterionpart c where missing=1 and e.CriterionPartID=c.CriterionPartID Union all Select r.DummyResultID as DummyID,r.ResultAssessmentID as assessmentID,r.CriterionPartID,r.Result as Title,'Result' as Type,c.CriterionPartShortDescription from resultassessment r,criterionpart c where Presented=1 and r.CriterionPartID=c.CriterionPartID;";
	
	const SELECT_TEAM_OWNER="Select TeamLeader,u.userName, u.SurName FROM team t,usermaster u where t.TeamLeader = u.userid and t.TeamID=?;";
	
	const CHK_EXECUTIVE="SELECT 1 as Col FROM executiveteam WHERE UserID=?;";
	
	const SELECT_ENABLER_ID_TO_UPDATE="Select EnablerAssessmentID from enablerassessment where DummyEnablerID>? and CriterionPartID like ?;";
	
	const UPDATE_DUMMY_ENABLER_ID="Update enablerassessment set DummyEnablerID=DummyEnablerID-1 where EnablerAssessmentID=?;";
	
	
	const SELECT_RESULT_ID_TO_UPDATE="Select ResultAssessmentID from resultassessment where DummyResultID>? and CriterionPartID like ?;";
	
	const UPDATE_DUMMY_RESULT_ID="Update resultassessment set DummyResultID=DummyResultID-1 where ResultAssessmentID=?;";
	
	const SELECT_PROJECT_APPROACH_DETAILS="select DummyApproachID,Type,ApproachTitle,title from projectapproachdetails where ProjectID=?;";
	
	const UPDATE_CRITERIAN_PARTID_SCORE_RESULT = "update criteronpartscore set SubTeamScore = ? , ExeTeamScore = ?,  SubTeamAvgScore = ?, ExeTeamAvgScore = ? ,DummySubTeamScore=? where CriterionPartShortDescription = ? AND LocationID=?;";
	
	const INSERT_PROJECTS_PRIORITY = "insert into projectprioritysetting(orgstrategy,criterianparts,easeofimp)values(?,?,?);";
	
	const SELECT_E_MAIL_ID="SELECT EMail FROM usermaster WHERE UserID=?;";
	
	const SELECT_OVER_ALL_ENABLER_COMMENTS="select ApproachTitle,c.ApproachToLink,Comments,CriteriaID,SubteamActions,c.ApproachID from comments c,enablerassessment e where e.EnablerAssessmentID=c.ApproachID and CriteriaID=?;";
	
	const SELECT_OVER_ALL_RESULT_COMMENTS="select Result,c.ApproachToLink,Comments,CriteriaID,SubteamActions,c.ApproachID from comments c,resultassessment r where r.ResultAssessmentID=c.ApproachID and CriteriaID=?;";
	
	}
?>