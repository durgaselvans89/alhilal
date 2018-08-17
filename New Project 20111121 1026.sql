-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.51b-community-nt


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema sa
--

CREATE DATABASE IF NOT EXISTS sa;
USE sa;

--
-- Definition of table `agendadetails`
--

DROP TABLE IF EXISTS `agendadetails`;
CREATE TABLE `agendadetails` (
  `agendaid` int(10) unsigned NOT NULL auto_increment,
  `meetingid` int(10) unsigned default NULL,
  `discussionpoints` text,
  `percentage` int(10) unsigned default NULL,
  `duration` int(10) unsigned default NULL,
  PRIMARY KEY  (`agendaid`)
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `agendadetails`
--

/*!40000 ALTER TABLE `agendadetails` DISABLE KEYS */;
INSERT INTO `agendadetails` (`agendaid`,`meetingid`,`discussionpoints`,`percentage`,`duration`) VALUES 
 (88,23,'dfgdfg',0,5),
 (89,24,'dfgdfg',0,20),
 (90,25,'fghfgh',0,15),
 (91,26,'fghfgh',0,20),
 (92,27,'fghfgh',0,20);
/*!40000 ALTER TABLE `agendadetails` ENABLE KEYS */;


--
-- Definition of table `agendapointsdetails`
--

DROP TABLE IF EXISTS `agendapointsdetails`;
CREATE TABLE `agendapointsdetails` (
  `meetingid` int(10) unsigned default NULL,
  `agendaid` int(10) unsigned default NULL,
  `pointsid` int(10) unsigned NOT NULL auto_increment,
  `deliverables` text,
  `expiredate` datetime default NULL,
  `completiondate` datetime default NULL,
  `status` varchar(50) default NULL,
  `responsibility` int(10) unsigned default NULL,
  PRIMARY KEY  (`pointsid`)
) ENGINE=MyISAM AUTO_INCREMENT=262 DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `agendapointsdetails`
--

/*!40000 ALTER TABLE `agendapointsdetails` DISABLE KEYS */;
/*!40000 ALTER TABLE `agendapointsdetails` ENABLE KEYS */;


--
-- Definition of table `approachlinkage`
--

DROP TABLE IF EXISTS `approachlinkage`;
CREATE TABLE `approachlinkage` (
  `EnablerAssessmentID` tinyint(4) NOT NULL,
  `EnablerLinkageID` tinyint(4) NOT NULL,
  `DescriptionofLinkage` varchar(2000) NOT NULL,
  `CriterionPartID` tinyint(4) NOT NULL,
  `LinkageCriterionPartID` tinyint(4) NOT NULL,
  `ApproachToLink` varchar(10) NOT NULL,
  `DummyID` varchar(45) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `approachlinkage`
--

/*!40000 ALTER TABLE `approachlinkage` DISABLE KEYS */;
INSERT INTO `approachlinkage` (`EnablerAssessmentID`,`EnablerLinkageID`,`DescriptionofLinkage`,`CriterionPartID`,`LinkageCriterionPartID`,`ApproachToLink`,`DummyID`) VALUES 
 (63,68,'',1,1,'1a(4)','1'),
 (67,63,'',1,1,'1a(1)','3'),
 (64,63,'',1,1,'1a(1)','2'),
 (63,65,'',1,2,'1b(1)','1'),
 (63,64,'',1,1,'1a(2)','1'),
 (63,67,'',1,1,'1a(3)','1');
/*!40000 ALTER TABLE `approachlinkage` ENABLE KEYS */;


--
-- Definition of table `areaforimprovement`
--

DROP TABLE IF EXISTS `areaforimprovement`;
CREATE TABLE `areaforimprovement` (
  `AFIID` int(10) unsigned NOT NULL auto_increment,
  `ApproachID` int(10) unsigned default NULL,
  `CriterionPartID` int(10) unsigned default NULL,
  `Type` varchar(45) default NULL,
  `AFI` varchar(1000) default NULL,
  PRIMARY KEY  (`AFIID`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `areaforimprovement`
--

/*!40000 ALTER TABLE `areaforimprovement` DISABLE KEYS */;
INSERT INTO `areaforimprovement` (`AFIID`,`ApproachID`,`CriterionPartID`,`Type`,`AFI`) VALUES 
 (4,65,2,'Enabler','A4'),
 (5,65,2,'Enabler','A5'),
 (6,65,2,'Enabler','A6'),
 (13,64,1,'Enabler','dfgdf gdf gdf'),
 (14,64,1,'Enabler',' gdfgdfgdfg dfg df'),
 (15,64,1,'Enabler','d fgdfgd'),
 (22,71,4,'Enabler','ghfghfg'),
 (23,71,4,'Enabler','fghfg hfghfg hfghrtwerw'),
 (24,71,4,'Enabler','werwerwer'),
 (31,63,1,'Enabler','A1'),
 (32,63,1,'Enabler','A2'),
 (33,63,1,'Enabler','A3'),
 (34,5,25,'Result','fgh'),
 (35,5,25,'Result','fghfgh'),
 (36,5,25,'Result','fghg');
/*!40000 ALTER TABLE `areaforimprovement` ENABLE KEYS */;


--
-- Definition of table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `ApproachID` int(10) unsigned default NULL,
  `CriteriaID` int(10) unsigned default NULL,
  `UserID` int(10) unsigned default NULL,
  `RoleID` int(10) unsigned default NULL,
  `Comments` text,
  `CommentID` int(10) unsigned NOT NULL auto_increment,
  `ApproachToLink` varchar(45) default NULL,
  `SubteamActions` text,
  PRIMARY KEY  (`CommentID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=cp1256 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `comments`
--

/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`ApproachID`,`CriteriaID`,`UserID`,`RoleID`,`Comments`,`CommentID`,`ApproachToLink`,`SubteamActions`) VALUES 
 (63,1,3,1,'dfgdfgdfg',1,'1a(1)',''),
 (64,1,3,1,'dfgdfgdfg',2,'1a(2)',''),
 (67,1,3,1,'fghfg fghfgh fgh fghf gh',3,'1a(3)',''),
 (68,1,3,1,'fgh hfghfg hfg hfg hfghfghfgh',4,'1a(4)',''),
 (5,25,3,1,'dfgdfgd',5,'6a(1)',''),
 (8,25,3,1,'dfgdfg',6,'6a(4)',''),
 (10,26,3,1,'dfgdfgd\ndfg\ndf\ngd\nfg\ndfg\n',7,'6b(1)','');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;


--
-- Definition of table `criteria`
--

DROP TABLE IF EXISTS `criteria`;
CREATE TABLE `criteria` (
  `CriteriaID` tinyint(4) NOT NULL,
  `CriteriaShortDescription` varchar(50) NOT NULL,
  `Weightage` tinyint(4) NOT NULL,
  `PointsAwarded` int(10) unsigned NOT NULL default '0',
  `CriteriaDefinition` varchar(500) NOT NULL,
  `Factor` float NOT NULL,
  `DisplayOrder` tinyint(4) NOT NULL,
  `EFQMPartID` tinyint(4) NOT NULL,
  PRIMARY KEY  (`CriteriaID`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `criteria`
--

/*!40000 ALTER TABLE `criteria` DISABLE KEYS */;
INSERT INTO `criteria` (`CriteriaID`,`CriteriaShortDescription`,`Weightage`,`PointsAwarded`,`CriteriaDefinition`,`Factor`,`DisplayOrder`,`EFQMPartID`) VALUES 
 (1,'Leadership',10,100,'Excellent leaders develop and facilitate the achievement of the mission and \r\n		vision. They develop organisational values and systems required for sustainable success and implement these \r\n		via their actions and behaviors. During periods of change they retain a constancy of purpose. Where enquired, \r\n		such leaders are able to change the direction of the organisation and inspire others to follow.',1,1,1),
 (2,'Strategy',10,100,'Excellent organisations implement their mission and vision by developing\r\n		stakeholder focused strategy that takes account of the market and sector in which it operates. Policies, \r\n		plans, objectives and processes are developed and deployed to deliver the strategy.',1,2,1),
 (3,'People',10,100,'Excellent organisations design, manage and improve processes in order to fully\r\n		satisfy and generate increasing value for customers and other stakeholders.',1,3,1),
 (4,'Partnerships and Resources',10,100,'Excellent organisations plan and manage external partnerships, suppliers and internal resources in order to support policy and strategy and the effective operation of processes. During planning, whilst managing partnerships and resources they balance the current and future\r\n		needs of the organisation, the community and the environment.',1,4,1),
 (5,'Processes, Products & Services',10,100,'Excellent organisations design, manage and improve processes in order to fully\r\n		satisfy and generate increasing value for customers and other stakeholders.',1,5,1),
 (6,'Customer Results',15,100,'Excellent organisations comprehensively measure and achieve outstanding\r\n		results with respect to their customers.',1.5,6,2),
 (7,'People Results',10,150,'Excellent organisations comprehensively measure and achieve outstanding\r\n		results with respect to their people.',1,7,2),
 (8,'Society Results',10,100,'The definition of society under this criteria means all those who are or believe they are affected by the organisation, other than its people, customers and partners.',1,8,2),
 (9,'Key Results',15,150,'Excellent organisations comprehensively measure and achieve outstanding results with respect to the key elements of their policy and strategy.',1.5,9,2);
/*!40000 ALTER TABLE `criteria` ENABLE KEYS */;


--
-- Definition of table `criterionpart`
--

DROP TABLE IF EXISTS `criterionpart`;
CREATE TABLE `criterionpart` (
  `CriterionPartID` tinyint(4) NOT NULL,
  `CriterionPartShortDescription` varchar(50) NOT NULL,
  `CriterionPartDefinition` varchar(500) NOT NULL,
  `CriteriaID` tinyint(4) NOT NULL,
  `MaxPoints` float NOT NULL,
  `SubTeamScore` float default NULL,
  `ExeTeamScore` float default NULL,
  `CPFactor` float default NULL,
  `SubTeamAvgScore` float default NULL,
  `ExeTeamAvgScore` float default NULL,
  `ExeComments` varchar(1000) default NULL,
  PRIMARY KEY  (`CriterionPartID`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `criterionpart`
--

/*!40000 ALTER TABLE `criterionpart` DISABLE KEYS */;
INSERT INTO `criterionpart` (`CriterionPartID`,`CriterionPartShortDescription`,`CriterionPartDefinition`,`CriteriaID`,`MaxPoints`,`SubTeamScore`,`ExeTeamScore`,`CPFactor`,`SubTeamAvgScore`,`ExeTeamAvgScore`,`ExeComments`) VALUES 
 (1,'1a','Leaders develop the mission, vision, values and ethics and act as role models.',1,20,45,45,1,32.5,32.5,NULL),
 (2,'1b','Leaders define, monitor, review and drive the improvement of the organisation\'s management system and performance.',1,20,50,50,1,0,0,NULL),
 (3,'1c','Leaders engage with external stakeholders.',1,20,NULL,NULL,1,NULL,NULL,NULL),
 (4,'1d','Leaders reinforce a culture of excellence with the organisation\'s people.',1,20,NULL,NULL,1,NULL,NULL,NULL),
 (5,'1e','Leaders ensure that the organisation is flexible and manages change effectively.',1,20,NULL,NULL,1,NULL,NULL,NULL),
 (6,'2a','Strategy is based on understanding the needs and expectations of both stakeholders and the external environment.',2,25,NULL,NULL,1,NULL,NULL,NULL),
 (7,'2b','Strategy is based on understanding internal performance and capabilities.',2,25,NULL,NULL,1,NULL,NULL,NULL),
 (8,'2c','Strategy and supporting policies are developed, reviewed and updated.',2,25,NULL,NULL,1,NULL,NULL,NULL),
 (9,'2d','Strategy and supporting policies are communicated, implemented and monitored.',2,25,NULL,NULL,1,NULL,NULL,NULL),
 (10,'3a','People plans support the organisation\'s strategy.',3,20,NULL,NULL,1,NULL,NULL,NULL),
 (11,'3b','People\'s knowledge and capabilities are developed.',3,20,NULL,NULL,1,NULL,NULL,NULL),
 (12,'3c','People are aligned, involved and empowered.',3,20,NULL,NULL,1,NULL,NULL,NULL),
 (14,'3e','People are rewarded, recognised and cared for.',3,20,NULL,NULL,1,NULL,NULL,NULL),
 (15,'4a','Partners and suppliers are managed for sustainable benefit.',4,20,NULL,NULL,1,NULL,NULL,NULL),
 (16,'4b','Finances are managed to secure sustained success.',4,20,NULL,NULL,1,NULL,NULL,NULL),
 (17,'4c','Buildings,equipment, materials and natural resources are managed in a sustainable way.',4,20,NULL,NULL,1,NULL,NULL,NULL),
 (18,'4d','Technology is managed to support the delivery of strategy.',4,20,NULL,NULL,1,NULL,NULL,NULL),
 (19,'4e','Information and knowledge are managed to support effective decision making and to build the organisation’s capability.',4,20,NULL,NULL,1,NULL,NULL,NULL),
 (20,'5a','Processes are designed and managed to optimise stakeholder value.',5,20,NULL,NULL,1,NULL,NULL,NULL),
 (21,'5b','Products and Services are developed to create optimum value for customers.',5,20,NULL,NULL,1,NULL,NULL,NULL),
 (22,'5c','Products and Services are effectively promoted and marketed.',5,20,NULL,NULL,1,NULL,NULL,NULL),
 (23,'5d','Products and Services are produced, delivered and managed.',5,20,NULL,NULL,1,NULL,NULL,NULL),
 (24,'5e','Customer relationships are managed and enhanced.',5,20,67,67,1,0,0,NULL),
 (25,'6a','Customer\'s Perceptions',6,75,10,10,0.75,30,30,NULL),
 (26,'6b','Customer\'s Performance Indicators',6,25,80,80,0.25,90,90,NULL),
 (27,'7a','People\'s Perceptions',7,117.5,NULL,NULL,0.75,NULL,NULL,NULL),
 (28,'7b','People\'s Performance Indicator',7,32.5,NULL,NULL,0.25,NULL,NULL,NULL),
 (29,'8a','Society Perceptions',8,50,NULL,NULL,0.5,NULL,NULL,NULL),
 (30,'8b','Society Performance Indicators',8,50,NULL,NULL,0.5,NULL,NULL,NULL),
 (31,'9a','Key Strategic Outcomes',9,75,NULL,NULL,0.5,NULL,NULL,NULL),
 (32,'9b','Key Performance Indicators',9,75,NULL,NULL,0.5,NULL,NULL,NULL),
 (13,'3d','People communicate effectively throughout the organisation.',3,20,NULL,NULL,1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `criterionpart` ENABLE KEYS */;


--
-- Definition of table `criterionpartlinkage`
--

DROP TABLE IF EXISTS `criterionpartlinkage`;
CREATE TABLE `criterionpartlinkage` (
  `CriterionPartID` tinyint(4) NOT NULL,
  `CriterionPartLinkageID` tinyint(4) NOT NULL,
  `EnablerAssessmentID` tinyint(4) NOT NULL,
  `DescriptionofLinkage` varchar(2000) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `criterionpartlinkage`
--

/*!40000 ALTER TABLE `criterionpartlinkage` DISABLE KEYS */;
/*!40000 ALTER TABLE `criterionpartlinkage` ENABLE KEYS */;


--
-- Definition of table `criteronpartscore`
--

DROP TABLE IF EXISTS `criteronpartscore`;
CREATE TABLE `criteronpartscore` (
  `CriterionPartID` int(10) unsigned default '0',
  `CriterionPartShortDescription` varchar(5) default NULL,
  `CriteriaID` int(10) unsigned default NULL,
  `MaxPoints` float default NULL,
  `SubTeamScore` float default NULL,
  `ExeTeamScore` float default NULL,
  `CPFactor` int(10) unsigned default NULL,
  `SubTeamAvgScore` float default NULL,
  `ExeTeamAvgScore` float default NULL,
  `AssessmentID` int(10) unsigned default NULL,
  `LocationID` int(10) unsigned default NULL,
  `DummySubTeamScore` float default NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `criteronpartscore`
--

/*!40000 ALTER TABLE `criteronpartscore` DISABLE KEYS */;
INSERT INTO `criteronpartscore` (`CriterionPartID`,`CriterionPartShortDescription`,`CriteriaID`,`MaxPoints`,`SubTeamScore`,`ExeTeamScore`,`CPFactor`,`SubTeamAvgScore`,`ExeTeamAvgScore`,`AssessmentID`,`LocationID`,`DummySubTeamScore`) VALUES 
 (1,'1a',1,20,20,20,1,15,15,NULL,1,NULL),
 (2,'1b',1,20,NULL,NULL,1,NULL,NULL,NULL,1,NULL),
 (25,'6a',6,75,20,20,1,12,12,NULL,1,15),
 (26,'6b',6,25,45,45,0,35,35,NULL,1,11.25),
 (4,'1d',1,20,NULL,NULL,1,NULL,NULL,NULL,1,NULL),
 (27,'7a',7,112.5,NULL,NULL,1,NULL,NULL,NULL,1,NULL),
 (28,'7b',7,37.5,NULL,NULL,0,NULL,NULL,NULL,1,NULL);
/*!40000 ALTER TABLE `criteronpartscore` ENABLE KEYS */;


--
-- Definition of table `dummytab`
--

DROP TABLE IF EXISTS `dummytab`;
CREATE TABLE `dummytab` (
  `f1` varchar(50) NOT NULL,
  PRIMARY KEY  (`f1`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dummytab`
--

/*!40000 ALTER TABLE `dummytab` DISABLE KEYS */;
INSERT INTO `dummytab` (`f1`) VALUES 
 ('0001'),
 ('0002'),
 ('0003');
/*!40000 ALTER TABLE `dummytab` ENABLE KEYS */;


--
-- Definition of table `efqm`
--

DROP TABLE IF EXISTS `efqm`;
CREATE TABLE `efqm` (
  `EFQMPartID` tinyint(4) NOT NULL,
  `EFQMPart` varchar(10) NOT NULL,
  PRIMARY KEY  (`EFQMPartID`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `efqm`
--

/*!40000 ALTER TABLE `efqm` DISABLE KEYS */;
INSERT INTO `efqm` (`EFQMPartID`,`EFQMPart`) VALUES 
 (1,'Enablers'),
 (2,'Results');
/*!40000 ALTER TABLE `efqm` ENABLE KEYS */;


--
-- Definition of table `enablerassessment`
--

DROP TABLE IF EXISTS `enablerassessment`;
CREATE TABLE `enablerassessment` (
  `EnablerAssessmentID` tinyint(4) NOT NULL auto_increment,
  `CriterionPartID` varchar(50) NOT NULL,
  `ApproachTitle` varchar(150) NOT NULL,
  `ApproachDescription` varchar(1000) NOT NULL,
  `ExamplesOfApproach` varchar(1000) default NULL,
  `Deployment` varchar(2000) default NULL,
  `ExamplesOfDeployment` varchar(2000) default NULL,
  `AssessmentAndReview` varchar(2000) default NULL,
  `ExamplesOfAssessmentReview` varchar(2000) default NULL,
  `SourceOfInformation` varchar(500) default NULL,
  `SoundRational` varchar(50) default NULL,
  `Integrated` varchar(50) default NULL,
  `Implemented` varchar(50) default NULL,
  `Systematic` varchar(50) default NULL,
  `Measurement` varchar(50) default NULL,
  `Learning` varchar(50) default NULL,
  `Improvement` varchar(50) default NULL,
  `Strength` varchar(3500) default NULL,
  `AreaForImprovement` varchar(3500) default NULL,
  `TeamType` varchar(1) default NULL,
  `Score` float default NULL,
  `SystemGeneratedScore` varchar(50) default NULL,
  `Presented` varchar(20) default NULL,
  `DirectRelavanceToDelivering` varchar(20) default NULL,
  `RelevanceToThisCriterionPart` varchar(20) default NULL,
  `ApproachToLink` varchar(10) default NULL,
  `Status` tinyint(4) default NULL,
  `EnablerDocument` varchar(50) default NULL,
  `missing` varchar(50) default NULL,
  `LocationID` int(11) default NULL,
  `Location` varchar(45) default NULL,
  `StrengthLen` int(11) default '0',
  `AFILen` int(11) default '0',
  `DummyEnablerID` int(11) default NULL,
  PRIMARY KEY  (`EnablerAssessmentID`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `enablerassessment`
--

/*!40000 ALTER TABLE `enablerassessment` DISABLE KEYS */;
INSERT INTO `enablerassessment` (`EnablerAssessmentID`,`CriterionPartID`,`ApproachTitle`,`ApproachDescription`,`ExamplesOfApproach`,`Deployment`,`ExamplesOfDeployment`,`AssessmentAndReview`,`ExamplesOfAssessmentReview`,`SourceOfInformation`,`SoundRational`,`Integrated`,`Implemented`,`Systematic`,`Measurement`,`Learning`,`Improvement`,`Strength`,`AreaForImprovement`,`TeamType`,`Score`,`SystemGeneratedScore`,`Presented`,`DirectRelavanceToDelivering`,`RelevanceToThisCriterionPart`,`ApproachToLink`,`Status`,`EnablerDocument`,`missing`,`LocationID`,`Location`,`StrengthLen`,`AFILen`,`DummyEnablerID`) VALUES 
 (63,'1','New Approach I','','','','','','','fghfghfghfghfgh','ClrE','E','E','E','SE','E','CompE','S1:@@:S2:@@:S3','A1:@@:A2:@@:A3','0',60,'','','Medium','Medium','',0,'','0',1,'Dr Lway',3,3,1),
 (64,'1','New Approach II','','','','','','','fghfghfgh','NE','NE','NE','NE','NE','NE','NE','dfgdfg:@@:dfgdf:@@:dfgdfg','dfgdf gdf gdf:@@: gdfgdfgdfg dfg df:@@:d fgdfgd','0',0,'','','Medium','Medium','',0,'','0',1,'Dr Lway',3,3,2),
 (65,'2','Approach V','','','','','','','','NE','NE','NE','NE','NE','NE','NE','S4:@@:S5:@@:S6','A4:@@:A5:@@:A6','0',0,'','','Medium','Medium','',0,'','0',1,'Dr Lway',3,3,1),
 (66,'2','Appraoch VI','','','','','','','','','','','','','','','','','0',0,'','','','','Link',0,'','0',1,'Dr Lway',0,0,2),
 (67,'1','dfsdfsdf','','','','','','','','','','','','','','','','','0',0,'','','','','Link',0,'','0',1,'Dr Lway',0,0,3),
 (68,'1','sdfsdf','','','','','','','','','','','','','','','','','0',0,'','','','','Link',0,'','1',1,'Dr Lway',0,0,4),
 (69,'2','sdfsdfsdf','','','','','','','','','','','','','','','','','0',0,'','','','','Link',0,'','1',1,'Dr Lway',0,0,3),
 (70,'2','sdfsdfsdfsdf sdf sdf','','','','','','','','','','','','','','','','','0',0,'','','','','Link',0,'','1',1,'Dr Lway',0,0,4),
 (71,'4','dfdfg','','','','','','','','NE','NE','NE','NE','NE','NE','NE','ghfgh:@@:fghfgh:@@:hfgh','ghfghfg:@@:fghfg hfghfg hfghrtwerw:@@:werwerwer','0',0,'','','Medium','Medium','',0,'','0',1,'Dr Lway',3,3,1),
 (72,'4','frgdfgdfg','','','','','','','','','','','','','','','','','0',0,'','','','','Link',0,'','0',1,'Dr Lway',0,0,2);
/*!40000 ALTER TABLE `enablerassessment` ENABLE KEYS */;


--
-- Definition of table `enablerdocument`
--

DROP TABLE IF EXISTS `enablerdocument`;
CREATE TABLE `enablerdocument` (
  `EnablerAssessmentID` varchar(50) default NULL,
  `EnablerDocumentID` int(11) NOT NULL,
  `EnablerDocument` varchar(50) default NULL,
  `EnablerDocumentDesc` varchar(500) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `enablerdocument`
--

/*!40000 ALTER TABLE `enablerdocument` DISABLE KEYS */;
INSERT INTO `enablerdocument` (`EnablerAssessmentID`,`EnablerDocumentID`,`EnablerDocument`,`EnablerDocumentDesc`) VALUES 
 ('63',1,'Hints.txt','ghjghjghj'),
 ('71',4,'Flex Hints.txt','lkl;kl;'),
 ('63',3,'updated in DB.txt','hjkhjk'),
 ('63',5,'help_icon.png','fghfgh');
/*!40000 ALTER TABLE `enablerdocument` ENABLE KEYS */;


--
-- Definition of table `executiveteam`
--

DROP TABLE IF EXISTS `executiveteam`;
CREATE TABLE `executiveteam` (
  `ExeTeamID` tinyint(4) default '0',
  `UserID` int(11) default NULL,
  `RoleID` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `executiveteam`
--

/*!40000 ALTER TABLE `executiveteam` DISABLE KEYS */;
INSERT INTO `executiveteam` (`ExeTeamID`,`UserID`,`RoleID`) VALUES 
 (0,51,5),
 (0,52,5),
 (0,19,5),
 (0,18,5),
 (0,16,5),
 (0,3,1),
 (0,12,5),
 (0,40,5),
 (0,55,5),
 (0,55,5),
 (0,55,5),
 (0,55,5),
 (0,55,5),
 (0,55,5),
 (0,55,5),
 (0,57,5),
 (0,59,5);
/*!40000 ALTER TABLE `executiveteam` ENABLE KEYS */;


--
-- Definition of table `exeteamactivities`
--

DROP TABLE IF EXISTS `exeteamactivities`;
CREATE TABLE `exeteamactivities` (
  `ActivityID` int(11) NOT NULL,
  `Milestone` varchar(255) NOT NULL,
  `Activity` varchar(255) default NULL,
  `Accountability` int(11) default NULL,
  `Duedate` datetime NOT NULL,
  `StatusID` tinyint(4) NOT NULL,
  `LocationID` int(11) default NULL,
  `Location` varchar(50) default NULL,
  PRIMARY KEY  (`ActivityID`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `exeteamactivities`
--

/*!40000 ALTER TABLE `exeteamactivities` DISABLE KEYS */;
/*!40000 ALTER TABLE `exeteamactivities` ENABLE KEYS */;


--
-- Definition of table `exeteamenablerassessment`
--

DROP TABLE IF EXISTS `exeteamenablerassessment`;
CREATE TABLE `exeteamenablerassessment` (
  `ExeTeamEnablerAsementID` int(4) NOT NULL auto_increment,
  `EnablerAssessmentID` int(4) NOT NULL,
  `CriterionPartID` varchar(50) NOT NULL,
  `ApproachTitle` varchar(150) NOT NULL,
  `ApproachDescription` varchar(1000) NOT NULL,
  `ExamplesOfApproach` varchar(1000) default NULL,
  `Deployment` varchar(2000) default NULL,
  `ExamplesOfDeployment` varchar(2000) default NULL,
  `AssessmentAndReview` varchar(2000) default NULL,
  `ExamplesOfAssessmentReview` varchar(2000) default NULL,
  `SourceOfInformation` varchar(500) default NULL,
  `SoundRational` varchar(50) default NULL,
  `Integrated` varchar(50) default NULL,
  `Implemented` varchar(50) default NULL,
  `Systematic` varchar(50) default NULL,
  `Measurement` varchar(50) default NULL,
  `Learning` varchar(50) default NULL,
  `Improvement` varchar(50) default NULL,
  `Strength` varchar(1000) default NULL,
  `AreaForImprovement` varchar(1000) default NULL,
  `TeamType` varchar(1) default NULL,
  `Score` float default NULL,
  `SystemGeneratedScore` varchar(50) default NULL,
  `Presented` varchar(20) default NULL,
  `DirectRelavanceToDelivering` varchar(20) default NULL,
  `RelevanceToThisCriterionPart` varchar(20) default NULL,
  `ApproachToLink` varchar(50) default NULL,
  `EnablerDocument` varchar(50) default NULL,
  `LocationID` int(11) default NULL,
  `Location` varchar(50) default NULL,
  PRIMARY KEY  (`ExeTeamEnablerAsementID`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `exeteamenablerassessment`
--

/*!40000 ALTER TABLE `exeteamenablerassessment` DISABLE KEYS */;
INSERT INTO `exeteamenablerassessment` (`ExeTeamEnablerAsementID`,`EnablerAssessmentID`,`CriterionPartID`,`ApproachTitle`,`ApproachDescription`,`ExamplesOfApproach`,`Deployment`,`ExamplesOfDeployment`,`AssessmentAndReview`,`ExamplesOfAssessmentReview`,`SourceOfInformation`,`SoundRational`,`Integrated`,`Implemented`,`Systematic`,`Measurement`,`Learning`,`Improvement`,`Strength`,`AreaForImprovement`,`TeamType`,`Score`,`SystemGeneratedScore`,`Presented`,`DirectRelavanceToDelivering`,`RelevanceToThisCriterionPart`,`ApproachToLink`,`EnablerDocument`,`LocationID`,`Location`) VALUES 
 (1,30,'1','New Approach','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (2,31,'1','New Approach 2','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (3,32,'2','New Approach','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (4,33,'1','Approach 1','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (5,34,'1','Approach 2','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (6,35,'2','Approach 3','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (7,36,'2','Approach 4','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (12,41,'1','fgdfgdfgdfg','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (13,42,'1','hjkhjkhjk','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (10,39,'2','Approach 3','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (11,40,'2','Appraoch 3','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (14,43,'1','ghfghfgh','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (15,44,'1','gfhfghfghfgh fghfgh dgh','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (16,45,'1','gfhfghfgh','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (17,46,'1','gfhfghfgh','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (21,50,'1','fghfghfg','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (22,51,'1','fghfgh','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (20,49,'1','fghfghfgh','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (23,52,'1','hgjghj','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (24,53,'1','yuiuiyui','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (25,54,'1','dfgdfg','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (26,55,'1','dgghfg','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (27,56,'1','ghjghj','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (28,57,'1','gfhfghfgh','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (32,61,'1','dfgdfgdfg','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (34,63,'1','New Approach I','','','','','','','fghfghfghfghfgh','ClrE','E','E','E','SE','E','CompE',NULL,NULL,'0',60,'','','Medium','Medium','','',1,'Dr Lway'),
 (31,60,'1','dfgdfgdfg','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (33,62,'1','dfgdfgdfg','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (35,64,'1','New Approach II','','','','','','','fghfghfgh','NE','NE','NE','NE','NE','NE','NE',NULL,NULL,'0',0,'','','Medium','Medium','','',1,'Dr Lway'),
 (36,65,'2','Approach V','','','','','','','','NE','NE','NE','NE','NE','NE','NE',NULL,NULL,'0',0,'','','Medium','Medium','','',1,'Dr Lway'),
 (37,66,'2','Appraoch VI','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (38,67,'1','dfsdfsdf','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (39,68,'1','sdfsdf','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (40,69,'2','sdfsdfsdf','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (41,70,'2','sdfsdfsdfsdf sdf sdf','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway'),
 (42,71,'4','dfdfg','','','','','','','','NE','NE','NE','NE','NE','NE','NE',NULL,NULL,'0',0,'','','Medium','Medium','','',1,'Dr Lway'),
 (43,72,'4','frgdfgdfg','','','','','','','','','','','','','','','','','0',0,'','','','','Link','',1,'Dr Lway');
/*!40000 ALTER TABLE `exeteamenablerassessment` ENABLE KEYS */;


--
-- Definition of table `exeteamenablercomments`
--

DROP TABLE IF EXISTS `exeteamenablercomments`;
CREATE TABLE `exeteamenablercomments` (
  `EnablerAssessmentID` tinyint(4) NOT NULL,
  `CommentID` tinyint(4) NOT NULL,
  `CriterionPartID` tinyint(4) NOT NULL,
  `CommentsOfExeTeam` varchar(750) default NULL,
  `SubTeamActions` varchar(750) default NULL,
  `ApproachToLink` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `exeteamenablercomments`
--

/*!40000 ALTER TABLE `exeteamenablercomments` DISABLE KEYS */;
/*!40000 ALTER TABLE `exeteamenablercomments` ENABLE KEYS */;


--
-- Definition of table `exeteamresultassessment`
--

DROP TABLE IF EXISTS `exeteamresultassessment`;
CREATE TABLE `exeteamresultassessment` (
  `ExeResultAssessmentID` int(4) NOT NULL,
  `ResultAssessmentID` int(4) NOT NULL,
  `CriterionPartID` varchar(50) NOT NULL,
  `Result` varchar(500) NOT NULL,
  `ResultSegments` varchar(300) default NULL,
  `SourceOfInformation` varchar(500) default NULL,
  `Scope` varchar(50) default NULL,
  `Segmentation` varchar(50) default NULL,
  `Trends` varchar(50) default NULL,
  `Targets` varchar(50) default NULL,
  `Comparisons` varchar(50) default NULL,
  `Causes` varchar(50) default NULL,
  `Strength` varchar(1000) default NULL,
  `AreasForImprovement` varchar(1000) default NULL,
  `Score` float default NULL,
  `TeamType` varchar(1) default NULL,
  `SystemGeneratedScore` varchar(50) default NULL,
  `DirectRelavanceToDelivering` varchar(20) default NULL,
  `RelevanceToThisCriterionPart` varchar(20) default NULL,
  `Presented` varchar(20) default NULL,
  `ResultsToLink` varchar(20) default NULL,
  `ResultDocument` varchar(50) default NULL,
  `LocationID` int(11) default NULL,
  `Location` varchar(50) default NULL,
  PRIMARY KEY  (`ExeResultAssessmentID`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `exeteamresultassessment`
--

/*!40000 ALTER TABLE `exeteamresultassessment` DISABLE KEYS */;
INSERT INTO `exeteamresultassessment` (`ExeResultAssessmentID`,`ResultAssessmentID`,`CriterionPartID`,`Result`,`ResultSegments`,`SourceOfInformation`,`Scope`,`Segmentation`,`Trends`,`Targets`,`Comparisons`,`Causes`,`Strength`,`AreasForImprovement`,`Score`,`TeamType`,`SystemGeneratedScore`,`DirectRelavanceToDelivering`,`RelevanceToThisCriterionPart`,`Presented`,`ResultsToLink`,`ResultDocument`,`LocationID`,`Location`) VALUES 
 (1,0,'25','Approach 5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','Link',NULL,1,'Dr Lway'),
 (6,6,'25','New Approach IV','','','Zero','1/2','3/4','3/4','3/4','3/4','','',55,'','1/2','','','0','Link','0',1,'Dr Lway'),
 (5,5,'25','New Appraoch III','','','1/4','1/2','1/2','3/4','1/4','1/2','','',60,'','1/2','Low','Low','0','Link','0',1,'Dr Lway'),
 (4,4,'25','jghjghjghj',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','Link',NULL,1,'Dr Lway'),
 (7,7,'25','New Approach VII',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','Link',NULL,1,'Dr Lway'),
 (8,8,'25','sdasdsad',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','Link',NULL,1,'Dr Lway'),
 (9,9,'25','sdfsdfsdf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','Link',NULL,1,'Dr Lway'),
 (10,10,'26','uhhjkhj','','','1/2','1/2','1/4','1/2','3/4','Zero','','',35,'','1/4','','','0','Link','0',1,'Dr Lway'),
 (11,11,'27','fghfghfg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','Link',NULL,1,'Dr Lway'),
 (12,12,'28','fghfghf hfg fgh fgh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','Link',NULL,1,'Dr Lway');
/*!40000 ALTER TABLE `exeteamresultassessment` ENABLE KEYS */;


--
-- Definition of table `exeteamresultscomments`
--

DROP TABLE IF EXISTS `exeteamresultscomments`;
CREATE TABLE `exeteamresultscomments` (
  `ResultAssessmentID` tinyint(4) NOT NULL,
  `CommentID` tinyint(4) NOT NULL,
  `CriterionPartID` tinyint(4) NOT NULL,
  `CommentsOfExeTeam` varchar(750) default NULL,
  `SubTeamActions` varchar(750) default NULL,
  `ResultsToLink` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `exeteamresultscomments`
--

/*!40000 ALTER TABLE `exeteamresultscomments` DISABLE KEYS */;
/*!40000 ALTER TABLE `exeteamresultscomments` ENABLE KEYS */;


--
-- Definition of table `guidancepoint`
--

DROP TABLE IF EXISTS `guidancepoint`;
CREATE TABLE `guidancepoint` (
  `GuidancePointID` int(10) unsigned NOT NULL auto_increment,
  `GuidancePointDescription` text,
  `CriterionPartID` tinyint(4) NOT NULL,
  PRIMARY KEY  (`GuidancePointID`)
) ENGINE=MyISAM AUTO_INCREMENT=204 DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `guidancepoint`
--

/*!40000 ALTER TABLE `guidancepoint` DISABLE KEYS */;
INSERT INTO `guidancepoint` (`GuidancePointID`,`GuidancePointDescription`,`CriterionPartID`) VALUES 
 (1,'Set and communicate a clear direction and strategic focus; they unite their people in sharing and achieving the organisation\'s core purpose and objectives.',1),
 (2,'Secure the future of the organisation by defining and communicating a core purpose that provides the basis for their overall Vision, values, ethics and corporate behaviour.',1),
 (3,'Champion the organisation\'s values and are role models for integrity, social responsibility and ethical behaviour, both internally and externally.',1),
 (4,'Foster organisational development through shared values, accountability, ethics and a culture of trust and openness.',1),
 (5,'Ensure their people act with integrity and adopt the highest standards of ethical behaviour.',1),
 (6,'Develop a shared leadership culture for the organisation and review and improve the effectiveness of personal leadership behaviours.',1),
 (9,'Use a balanced set of results to review their progress, providing a view of long and short term priorities for the key stakeholders, with clearly defined “cause and effect” relationships.',2),
 (10,'Develop and improve the organisation’s management system, including evaluating the set of results in order to improve future performance and provide sustainable benefits to stakeholders.',2),
 (11,'Base decisions on factually reliable information and use all available knowledge to interpret current and predicted performance of the relevant processes.',2),
 (12,'Are transparent and accountable to stakeholders and society at large for their performance and actively support the desire to go beyond regulatory compliance.',2),
 (13,'Deliver high levels of stakeholder confidence by ensuring risks are identified and appropriately managed across all their processes.',2),
 (14,'Understand and develop the underlying capabilities of the organisation.',2),
 (16,'Know who their different external stakeholder groups are and develop approaches to understand, anticipate and respond to their different needs and expectations.',3),
 (17,'Establish approaches to engage partners, customers and society in generating ideas and innovation.',3),
 (18,'Use innovation to enhance their organisation’s reputation and image and attract new customers, partners and talent.',3),
 (19,'Identify strategic and operational partnerships based on organisational and strategic needs, complementary strengths and capabilities.',3),
 (20,'Ensure transparency of reporting to key stakeholders, including appropriate governance bodies, in line with their expectations.',3),
 (23,'Inspire people and create a culture of involvement, ownership, empowerment, entrepreneurship, improvement and accountability, at all levels.',4),
 (24,'Promote a culture which supports the generation and development of new ideas and new ways of thinking to encourage innovation and organisational development.',4),
 (25,'Ensure that their people can contribute to their own, and the organisation’s ongoing success by realising their full potential in a spirit of true partnership.',4),
 (26,'Support people throughout the organisation to achieve their plans, objectives and targets, recognising efforts in a timely and appropriate manner.',4),
 (27,'Promote and encourage equal opportunities and diversity.',4),
 (29,'Understand the internal and external drivers of organisational change.',5),
 (30,'Demonstrate their ability to make sound and timely decisions, based on available information, previous experience and consideration of the impact of their decisions.',5),
 (31,'Are flexible; they review, adapt and realign the direction of their organisation when necessary, inspiring trust at all times.',5),
 (32,'Involve and seek commitment of all relevant stakeholders for their contribution to the sustainable success of the organisation and any changes necessary to ensure this success.',5),
 (33,'Demonstrate their ability to maintain sustainable advantage through their capability to learn quickly and respond rapidly with new ways of working.',5),
 (34,'Allocate resources to provide for long-range needs rather than just short-term profitability and, where relevant, become and remain competitive.',5),
 (35,'Gather stakeholders’ needs and expectations for input to the development and review of their strategy and supporting policies, remaining constantly alert to any\r\nchanges.\r\n',6),
 (38,'Identify, understand and anticipate developments within the organization’s external environment. Identify, analyze and understand external indicators, such as economic, market and\r\nsocietal trends, which may affect the organization.\r\n',6),
 (39,'Understand and anticipate the long and short term impact of changes to relevant political, legal, regulatory and compliance requirements.\r\n',6),
 (40,'Identify, understand and anticipate opportunities and threats,based on feedback from stakeholders and other external information and analyses.\r\n',6),
 (41,'Analyse operational performance trends, core competencies and outcomes to understand current and potential organisational capabilities.',7),
 (42,'Analyse data and information regarding existing and potential partners’ core competencies and capabilities to understand how they complement the organisation’s capabilities.',7),
 (43,'Analyse data and information to determine the impact of new technologies and business models on the performance of the organisation.',7),
 (44,'Compare their performance with relevant benchmarks to understand their relative strengths and weaknesses.',7),
 (197,'Communicate strategy and supporting policies with stakeholders, in an appropriate way.',9),
 (50,'Create and maintain a clear strategy and supporting policies to achieve the mission and vision of the organisation.',8),
 (51,'Identify and understand the Key Results required to achieve the mission and evaluate progress towards the vision and strategic goals.',8),
 (52,'Use core competencies to generate benefit for all stakeholders, including the wider society.',8),
 (53,'Adopt effective mechanisms to understand future scenarios and manage strategic risks.',8),
 (54,'Understand the key business drivers: they balance the needs of the organisation and its stakeholders in planning for the achievement of present and future objectives.',8),
 (55,'Ensure economic, societal and ecological sustainability.',8),
 (60,'Define the required outcomes and related performance indicators and establish targets based on comparisons of their performance with other organisations and the Mission and Vision.',9),
 (61,'Deploy strategy and supporting policies in a systematic manner to achieve the desired set of results, balancing short and long term objectives.',9),
 (62,'Maintain and align an organisational structure and a framework of key processes to deliver their strategy in a way that adds real value for their stakeholders, achieving the optimum balance of efficiency and effectiveness.',9),
 (63,'Align individual and team objectives with the organisation’s strategic goals and ensure they are empowered to maximise their contribution.',9),
 (64,'Have clearly defined the people performance levels required to achieve the strategic goals.',10),
 (65,'Align people plans with their strategy, the organisational structure, new technologies and key processes.',10),
 (66,'Involve employees, and their representatives, in developing and reviewing the people strategy, policies and plans, adopting creative and innovative approaches when appropriate.',10),
 (67,'Manage recruitment, career development, mobility and succession planning, supported by appropriate policies, to ensure fairness and equal opportunities.',10),
 (68,'Use people surveys and other forms of employee feedback to improve people strategies, policies and plans.',10),
 (71,'Understand the skills and competencies required to achieve the Mission, Vision and strategic goals.',11),
 (72,'Ensure training and development plans help people match the skills and future capability needs of the organisation.',11),
 (73,'Align individual and team objectives with the organisation’s targets, reviewing and updating them in a timely manner.',11),
 (74,'Appraise and help people improve their performance to improve and maintain their mobility and employability.',11),
 (75,'Ensure their people have the necessary tools, competencies, information and empowerment to be able to maximise their contribution.',11),
 (199,'Involve their people in continually reviewing, improving and optimising the effectiveness and efficiency of their processes.',12),
 (80,'Ensure their people, at the individual and team level, are fully aligned with the organisation’s mission, vision and strategic goals.',12),
 (81,'Create a culture where people’s dedication, skills, talents and creativity are developed and valued.',12),
 (82,'Encourage their people to be the creators and ambassadors of the organisation’s ongoing success.',12),
 (83,'Ensure that people have an open mindset and use creativity and innovation to respond quickly to challenges they face.',12),
 (84,'Create a culture of entrepreneurship to enable innovation across all aspects of the organisation.',12),
 (85,'Understand the communication needs and expectations of their people.',13),
 (86,'Develop communications strategy, policies, plans and channels based on communications needs and expectations.',13),
 (87,'Communicate a clear direction and strategic focus ensuring their people understand the organisation’s mission, vision, values and objectives.',13),
 (88,'Ensure that their people understand and can demonstrate their contribution to the organisation’s ongoing success.',13),
 (89,'Align remuneration, benefits, redeployment, redundancy and other terms of employment with strategy and policies and, to promote and sustain the involvement and empowerment of their people.',14),
 (90,'Adopt approaches that ensure a responsible work / life balance for their people.',14),
 (91,'Ensure and embrace the diversity of their people.',14),
 (92,'Ensure a safe and healthy working environment for their people.',14),
 (93,'Encourage their people, along with other stakeholders, to participate in activities that contribute to wider society.',14),
 (94,'Promote a culture of mutual support, recognition and care between individuals and between teams.',14),
 (95,'Segment and differentiate partners and suppliers, in line with the organisation’s strategy, and adopt appropriate policies and processes for effectively managing them.',15),
 (96,'Build a sustainable relationship with partners and suppliers based on mutual trust, respect and openness.',15),
 (97,'Establish extensive networks to enable them to identify potential partnership opportunities.',15),
 (98,'Understand partnerships include working together for long-term, sustainable value enhancement. They know what their core purpose is and seek partners to enhance their capabilities and ability to generate stakeholder value.',15),
 (99,'Develop partnerships that systematically enable the delivery of enhanced value to their respective stakeholders through competencies, synergies and seamless processes.',15),
 (100,'Work together with partners to achieve mutual benefit, supporting one another with expertise, resources and knowledge to achieve shared goals.',15),
 (101,'Creating synergy in working together to improve processes and add value to the customer / supplier chain.',15),
 (102,'Develop and implement financial strategies, policies and processes to support the overall strategy of the organisation.',16),
 (103,'Design the financial planning, control, reporting and review processes to optimise the efficient and effective use of resources.',16),
 (104,'Establish and implement financial governance processes, tailored to all appropriate levels in the organisation.',16),
 (105,'Evaluate, select and validate investment in, and divestment of, both tangible and non tangible assets, taking into account their long term economic, societal and ecological effects.',16),
 (106,'Deliver high levels of stakeholder confidence by ensuring financial risks are identified and appropriately managed.',16),
 (107,'Ensure alignment between the delivery of long term goals and short term financial planning cycles.',16),
 (109,'Develop and implement a strategy and supporting policies for managing buildings, equipment and materials that supports the organisation’s overall strategy.',17),
 (112,'Optimise the use and effectively manage the lifecycle and physical security of their tangible assets, including buildings, equipment and materials.',17),
 (113,'Demonstrate they actively manage the impact of their operations on public health, safety and the environment.',17),
 (114,'Measure and manage any adverse effects of the organisation’s operations on the community and their people.',17),
 (115,'Adopt and implement appropriate policies and approaches to minimise their local and global environmental impact, including setting challenging goals for meeting and exceeding legal standards and requirements.',17),
 (119,'Develop a strategy and supporting policies for managing the technology portfolio that supports the organisation’s overall strategy.',18),
 (120,'Use technology, including IT-enabled processes, to support and improve the effective operation of the organisation.',18),
 (121,'Manage their technology portfolio, including optimising the use of existing technology as well as replacing their out-dated technology.',18),
 (122,'Involve their people and other relevant stakeholders in the development and deployment of new technologies to maximise the benefits generated.',18),
 (123,'Identify and evaluate alternative and emerging technologies in the light of their impact on organisational performance and capabilities and the environment.',18),
 (124,'Use technology to support innovation and creativity.',18),
 (126,'Ensure that their leaders are provided with accurate and sufficient information to support them in effective and timely decision making, enabling them to effectively predict the future performance of the organisation.',19),
 (127,'Transform data into information and, where relevant, into knowledge that can be shared and effectively used.',19),
 (128,'Provide and monitor access to relevant information and knowledge for their people and external users, whilst ensuring both security and the organisation’s intellectual property is protected.',19),
 (129,'Establish and manage networks to identify opportunities for innovation from signals within the internal and external environment.',19),
 (130,'Use innovation in a way that goes well beyond technical change and reveals new ways of offering value to customers, new ways of working and new ways of building on partnerships, resources and competencies.',19),
 (131,'Use data and information on the current performance and capabilities of processes to identify opportunities for, and generate, innovation.',19),
 (135,'Analyse, categorise and prioritise their end to end processes as part of the overall management system and adopt appropriate approaches to effectively manage and improve them, including those processes that extend beyond the boundaries of the organisation.',20),
 (136,'Clearly define process ownership and their role and responsibility in developing, maintaining and improving the framework of key processes.',20),
 (137,'Develop meaningful process performance indicators and outcome measures, clearly linked to the strategic goals.',20),
 (138,'Turn new ideas into reality through innovation-enabling processes that fit the nature and importance of the changes they will make.',20),
 (139,'Assess the impact and the added value of innovations and improvements to processes.',20),
 (141,'Strive to innovate and create value for their customers.',21),
 (142,'Use market research, customer surveys and other forms of feedback to anticipate and identify improvements aimed at enhancing the product and service portfolio.',21),
 (143,'Involve their people, customers, partners and suppliers in the development of new and innovative products, services and experiences for both existing and new customer groups.',21),
 (144,'Understand and anticipate the impact and potential of new technologies on products and services.',21),
 (145,'Use creativity to design and develop new and innovative products and services together with customers, partners or other stakeholders.',21),
 (146,'Take into account any impact of the product and service lifecycle on economic, societal and ecological sustainability.',21),
 (150,'Clearly define their value propositions, ensuring sustainability by balancing the needs of all relevant stakeholders.',22),
 (151,'Define the business model in terms of core capabilities, processes, partners and value proposition.',22),
 (152,'Implement the business model and value proposition\r\nby defining their “unique selling points”, market positioning, target customer groups and distribution channels.',22),
 (153,'Develop marketing strategies to effectively promote their products and services to target customers and user groups.',22),
 (154,'Effectively market their product and service portfolio to existing and potential customers.',22),
 (155,'Ensure that they have the capability to fulfill their promises.',22),
 (156,'Produce and deliver products and services to meet, or exceed, customer needs and expectations, in line with the offered value proposition.',23),
 (157,'Ensure their people have the necessary tools, competencies, information and empowerment to be able to maximise the customer experience.',23),
 (158,'Manage products and services throughout their entire lifecycle, including reusing and recycling where appropriate, considering any impact on public health, safety and the environment.',23),
 (159,'Compare their product and service delivery performance with relevant benchmarks and understand their strengths in order to maximise the value generated for customers.',23),
 (160,'Know who their different customer groups are and respond to, and anticipate, their different needs and expectations.',24),
 (161,'Determine and meet customers’ day-to-day and long-term contact requirements.',24),
 (162,'Build and maintain a dialogue with all their customers, based on openness, transparency and trust.',24),
 (163,'Continually monitor and review the experiences and perceptions of customers and respond quickly and effectively to any feedback.',24),
 (164,'Advise customers on the responsible use of products and services.',24),
 (168,'These are the customers’ perceptions of the organisation. They may be obtained from a number of sources, including customer surveys, focus groups, vendor ratings, compliments and complaints.',25),
 (169,'These perceptions should give a clear understanding of the effectiveness, from the customer’s perspective, of the deployment and execution of the organisation’s customer strategy and supporting policies and processes.',25),
 (170,'Depending on the purpose of the organisation, measures may focus on:\r\nReputation and image\r\nProduct and service value\r\nProduct and service delivery\r\nCustomer service, relationship and support\r\nCustomer loyalty and engagement\r\n',25),
 (172,'These are the internal measures used by the organisation in order to monitor, understand, predict and improve the performance of the organisation and to predict their impact on the perceptions of its external customers.',26),
 (173,'These indicators should give a clear understanding of the efficiency and effectiveness of the deployment and execution of the organisation’s customer strategy and supporting policies and processes.',26),
 (174,'Depending on the purpose of the organisation, measures may focus on:\r\n  Products and services delivery \r\n  Customer service, relationships and support\r\n  Complaints and compliments \r\n  External recognition',26),
 (176,'These are the people’s perception of the organisation. They may be obtained from a number of sources, including surveys, focus groups, interviews and structured appraisals.',27),
 (177,'These perceptions should give a clear understanding of the effectiveness, from the people’s perspective, of the deployment and execution of the organisation’s people strategy and supporting policies and processes.',27),
 (202,'Depending on the purpose of the organisation, measures may focus on:\r\n  Satisfaction, involvement and engagement \r\n  Pride and fulfilment\r\n  Leadership and management\r\n  Target setting, competency and performance management\r\n  Competency, training and career development\r\n  Effective communications\r\n  Working conditions',27),
 (178,'These are the internal measures used by the organisation in order to monitor, understand, predict and improve the performance of the organisation’s people and to predict their impact on perceptions.',28),
 (179,'These indicators should give a clear understanding of the efficiency and effectiveness of the deployment and execution of the organisation’s human resources strategy and supporting policies and processes.',28),
 (203,'Depending on the purpose of the organisation, measures may focus on:\r\n Involvement and engagement\r\n Target setting, competency and performance management\r\n Leadership performance\r\n Training and career development\r\n Internal communications',28),
 (182,'This is society’s perception of the organisation. This may be obtained from a number of sources, including surveys, reports, press articles, public meetings, NGOs, public representatives and governmental authorities.',29),
 (183,'These perceptions should give a clear understanding of the effectiveness, from society’s perspective of the deployment and execution of the organisation’s societal and environmental strategy and supporting policies and processes.',29),
 (184,'Depending on the purpose of the organisation, measures may focus on: \r\n Environmental impact \r\n Image and reputation\r\n Societal impact \r\n Workplace impact\r\n Awards and media coverage',29),
 (187,'These are the internal measures used by the organisation in order to monitor, understand, predict and improve the performance of the organisation and to predict the impact on the perceptions of society.',30),
 (188,'These indicators should give a clear understanding of the effectiveness and efficiency of the approaches adopted to manage the organisation’s societal and environmental responsibilities.',30),
 (189,'Depending on the purpose of the organisation, measures may focus on:\r\n Environmental performance\r\n Regulatory and governance compliance\r\n Societal performance H Health and safety performance \r\n Responsible sourcing and procurement performance',30),
 (192,'These are the key financial and non-financial outcomes which demonstrate the success of the organisation’s deployment of their strategy. The set of measures and relevant targets will be defined and agreed with key stakeholders.',31),
 (193,'Depending on the purpose of the organisation, measures may focus on:\r\n Financial outcomes \r\n Performance against budget\r\n Volume of key products or services delivered\r\n Key process outcomes',31),
 (194,'These are the key financial and non-financial indicators that are used to measure the organisation’s operational performance. They help monitor, understand, predict and improve the organisation’s likely key performance outcomes.',32),
 (195,'Depending on the purpose of the organisation, measures may focus on: \r\n Financial performance indicators \r\n Project costs\r\n Key process performance indicators\r\n Partner and supplier performance\r\n Technology, information and knowledge',32),
 (198,'Set clear goals and objectives for innovation and refine their strategy in line with innovation achievements.',9),
 (200,'Enable and encourage the sharing of information, knowledge and best practices, achieving a dialogue throughout the organisation.',13),
 (201,'Involve their people, customers, partners and suppliers in optimising the effectiveness and efficiency of their value chain.',23);
/*!40000 ALTER TABLE `guidancepoint` ENABLE KEYS */;


--
-- Definition of table `linkagesformembers`
--

DROP TABLE IF EXISTS `linkagesformembers`;
CREATE TABLE `linkagesformembers` (
  `SubteamID` tinyint(4) NOT NULL,
  `MemberLinkages` varchar(1000) NOT NULL,
  PRIMARY KEY  (`SubteamID`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `linkagesformembers`
--

/*!40000 ALTER TABLE `linkagesformembers` DISABLE KEYS */;
/*!40000 ALTER TABLE `linkagesformembers` ENABLE KEYS */;


--
-- Definition of table `linkagesforreport`
--

DROP TABLE IF EXISTS `linkagesforreport`;
CREATE TABLE `linkagesforreport` (
  `CriterionPartID` tinyint(4) NOT NULL,
  `EnablerAssessmentID` tinyint(4) NOT NULL,
  `Linkages` varchar(200) default NULL,
  `OtherCriteriaLinkingTo` varchar(200) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `linkagesforreport`
--

/*!40000 ALTER TABLE `linkagesforreport` DISABLE KEYS */;
/*!40000 ALTER TABLE `linkagesforreport` ENABLE KEYS */;


--
-- Definition of table `linkagesforresult`
--

DROP TABLE IF EXISTS `linkagesforresult`;
CREATE TABLE `linkagesforresult` (
  `CriterionPartID` tinyint(4) NOT NULL,
  `ResultAssessmentID` tinyint(4) NOT NULL,
  `Linkages` varchar(200) NOT NULL,
  `OtherCriteriaLinkingTo` varchar(200) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `linkagesforresult`
--

/*!40000 ALTER TABLE `linkagesforresult` DISABLE KEYS */;
/*!40000 ALTER TABLE `linkagesforresult` ENABLE KEYS */;


--
-- Definition of table `linkagesforsubteam`
--

DROP TABLE IF EXISTS `linkagesforsubteam`;
CREATE TABLE `linkagesforsubteam` (
  `SubteamID` tinyint(4) NOT NULL,
  `Linkages` varchar(200) NOT NULL,
  PRIMARY KEY  (`SubteamID`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `linkagesforsubteam`
--

/*!40000 ALTER TABLE `linkagesforsubteam` DISABLE KEYS */;
/*!40000 ALTER TABLE `linkagesforsubteam` ENABLE KEYS */;


--
-- Definition of table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE `location` (
  `LocationID` int(11) NOT NULL auto_increment,
  `Location` varchar(50) NOT NULL,
  PRIMARY KEY  (`LocationID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `location`
--

/*!40000 ALTER TABLE `location` DISABLE KEYS */;
INSERT INTO `location` (`LocationID`,`Location`) VALUES 
 (1,'Dr Lway'),
 (2,'Dubai'),
 (3,'Abu Dhabi'),
 (4,'Al Ain'),
 (5,'Ajman'),
 (6,'Ras Al Khaima');
/*!40000 ALTER TABLE `location` ENABLE KEYS */;


--
-- Definition of table `meetingdetails`
--

DROP TABLE IF EXISTS `meetingdetails`;
CREATE TABLE `meetingdetails` (
  `meetingID` int(10) unsigned NOT NULL auto_increment,
  `purpose` varchar(50) default NULL,
  `responsibility` int(10) unsigned default NULL,
  `venue` varchar(50) default NULL,
  `endingDate` datetime default NULL,
  `description` varchar(1000) default NULL,
  `duration` bigint(20) unsigned default NULL,
  `startingDate` datetime default NULL,
  `status` varchar(50) default NULL,
  `createdAt` datetime default NULL,
  `createdBy` int(10) unsigned default NULL,
  `participants` varchar(1000) default NULL,
  PRIMARY KEY  USING BTREE (`meetingID`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `meetingdetails`
--

/*!40000 ALTER TABLE `meetingdetails` DISABLE KEYS */;
INSERT INTO `meetingdetails` (`meetingID`,`purpose`,`responsibility`,`venue`,`endingDate`,`description`,`duration`,`startingDate`,`status`,`createdAt`,`createdBy`,`participants`) VALUES 
 (23,'New Meeting',NULL,'gfhfghfg','2011-11-29 11:03:00',NULL,5,NULL,'Open','2011-10-04 00:00:00',3,'Lway Nackasha\rJohn James\rNausheen Shamsher\rAsim Shaikh'),
 (24,'fdgdfg',NULL,'dfgdfgd','2011-11-21 11:08:00',NULL,20,NULL,'Open','2011-10-04 00:00:00',3,'Genga Rajan\rLway Nackasha\rMazhar Khan\rNausheen Shamsher'),
 (25,'fghfgh',NULL,'fghfgh','2011-11-28 11:11:00',NULL,15,NULL,'Open','2011-10-04 00:00:00',3,'John James\rAbdullah Mohammed\rNausheen Shamsher\rAsim Shaikh'),
 (26,'fhgfgh',NULL,'fghfghfgh','2011-11-21 11:41:00',NULL,20,NULL,'Open','2011-10-04 00:00:00',3,'David Lund\rJohn James\rNausheen Shamsher\rAsim Shaikh'),
 (27,'sadasdasdasdasdas',NULL,'fghfghfghdasdasdasdasdasd','2011-11-21 11:41:00',NULL,20,NULL,'Open','2011-10-04 00:00:00',3,'David Lund\rJohn James\rNausheen Shamsher\rAsim Shaikh');
/*!40000 ALTER TABLE `meetingdetails` ENABLE KEYS */;


--
-- Definition of table `meetingparticipants`
--

DROP TABLE IF EXISTS `meetingparticipants`;
CREATE TABLE `meetingparticipants` (
  `meetingid` int(10) unsigned default NULL,
  `participantsid` int(10) unsigned default NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `meetingparticipants`
--

/*!40000 ALTER TABLE `meetingparticipants` DISABLE KEYS */;
INSERT INTO `meetingparticipants` (`meetingid`,`participantsid`) VALUES 
 (23,3),
 (24,12),
 (25,11),
 (26,18),
 (27,18),
 (27,11),
 (27,37),
 (27,32);
/*!40000 ALTER TABLE `meetingparticipants` ENABLE KEYS */;


--
-- Definition of table `picklist`
--

DROP TABLE IF EXISTS `picklist`;
CREATE TABLE `picklist` (
  `PickListID` tinyint(4) NOT NULL,
  `PickListDescription` varchar(50) NOT NULL,
  PRIMARY KEY  (`PickListID`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `picklist`
--

/*!40000 ALTER TABLE `picklist` DISABLE KEYS */;
INSERT INTO `picklist` (`PickListID`,`PickListDescription`) VALUES 
 (1,'SVIPriority'),
 (2,'Evidence'),
 (3,'Implementation'),
 (4,'Significance of approach'),
 (5,'Strategic relevance');
/*!40000 ALTER TABLE `picklist` ENABLE KEYS */;


--
-- Definition of table `picklistitem`
--

DROP TABLE IF EXISTS `picklistitem`;
CREATE TABLE `picklistitem` (
  `PickListItemID` tinyint(4) NOT NULL,
  `PickListItemDescription` varchar(255) NOT NULL,
  `PickListID` tinyint(4) NOT NULL,
  `PickListShortDescription` varchar(50) NOT NULL,
  `ScoreValue` float default NULL,
  PRIMARY KEY  (`PickListItemID`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `picklistitem`
--

/*!40000 ALTER TABLE `picklistitem` DISABLE KEYS */;
INSERT INTO `picklistitem` (`PickListItemID`,`PickListItemDescription`,`PickListID`,`PickListShortDescription`,`ScoreValue`) VALUES 
 (0,'Any',1,'L',NULL),
 (1,'Low',1,'L',NULL),
 (2,'Medium',1,'M',NULL),
 (3,'High',1,'H',NULL),
 (4,'Any',2,'Dummy',0),
 (5,'No evidence presented(score 10%+/-5)',2,'NE',10),
 (6,'Limited or some evidence(score 25%+/-10)',2,'LE',25),
 (7,'There is evidence presented(score 50%+/-10)',2,'E',50),
 (9,'Comprehensive evidence presented(score 95%+/-5)',2,'CompE',95),
 (10,'Any',3,'Dummy',0),
 (11,'No or poor implementation(score 5%+/-5)',3,'Zero',5),
 (12,'1/4 of the relevant areas(score 25%+/-10)',3,'1/4',25),
 (13,'1/2 of the relevant areas(score 50%+/-10)',3,'1/2',50),
 (14,'3/4 of the relevant areas(score 75%+/-10)',3,'3/4',75),
 (15,'All of the relevant areas(score 95%+/-5)',3,'All',95),
 (16,'None',4,'None',0),
 (17,'High',4,'H',0.5),
 (18,'Low',4,'L',0.15),
 (19,'Medium',4,'M',0.35),
 (20,'None',5,'None',0),
 (21,'High',5,'H',1.2),
 (22,'Low',5,'L',0.8),
 (23,'Medium',5,'M',0),
 (24,'Missing',5,'Missing',0),
 (25,'None',6,'None',0),
 (26,'High',6,'H',1),
 (27,'Low',6,'L',0.5),
 (28,'Medium',6,'M',0.5),
 (29,'Missing',6,'Missing',0),
 (8,'Clear evidence presented(score 75%+/-10)',2,'ClrE',75);
/*!40000 ALTER TABLE `picklistitem` ENABLE KEYS */;


--
-- Definition of table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE `project` (
  `ProjectID` tinyint(4) NOT NULL,
  `ProjectName` varchar(50) NOT NULL,
  PRIMARY KEY  (`ProjectID`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `project`
--

/*!40000 ALTER TABLE `project` DISABLE KEYS */;
/*!40000 ALTER TABLE `project` ENABLE KEYS */;


--
-- Definition of table `projectapproachdetails`
--

DROP TABLE IF EXISTS `projectapproachdetails`;
CREATE TABLE `projectapproachdetails` (
  `ProjectID` int(10) unsigned default NULL,
  `ProjApproachLinkID` int(10) unsigned NOT NULL auto_increment,
  `CriteriaID` int(10) unsigned default NULL,
  `ApproachID` int(10) unsigned default NULL,
  `ApproachTitle` varchar(45) default NULL,
  `Type` varchar(45) default NULL,
  `StrengthID` int(11) default NULL,
  `AFIID` int(10) unsigned default NULL,
  `DummyApproachID` varchar(20) default NULL,
  `Title` varchar(1000) default NULL,
  PRIMARY KEY  (`ProjApproachLinkID`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=cp1256 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `projectapproachdetails`
--

/*!40000 ALTER TABLE `projectapproachdetails` DISABLE KEYS */;
INSERT INTO `projectapproachdetails` (`ProjectID`,`ProjApproachLinkID`,`CriteriaID`,`ApproachID`,`ApproachTitle`,`Type`,`StrengthID`,`AFIID`,`DummyApproachID`,`Title`) VALUES 
 (5,14,2,65,' Approach V','AFI',0,6,'1b (1) ','A6'),
 (5,15,2,65,' Approach V','Strength',5,0,'1b (1) ','S5'),
 (5,16,2,65,' Approach V','AFI',0,4,'1b (1) ','A4'),
 (5,17,1,63,' New Approach I','Strength',11,0,'1a (1) ','S2'),
 (6,18,1,64,' New Approach II','AFI',0,13,'1a (2) ','dfgdf gdf gdf'),
 (6,19,1,64,' New Approach II','Strength',14,0,'1a (2) ','dfgdf'),
 (0,20,1,64,' New Approach II','Strength',13,0,'1a (2) ','dfgdfg'),
 (0,21,1,64,' New Approach II','Strength',15,0,'1a (2) ','dfgdfg'),
 (7,22,1,63,' New Approach I','Strength',33,0,'1a (1) ','S3'),
 (0,23,25,5,' New Appraoch III','AFI',0,34,'6a (1) ','fgh'),
 (0,24,25,5,' New Appraoch III','AFI',0,35,'6a (1) ','fghfgh'),
 (0,25,4,71,' dfdfg','Strength',24,0,'1d (1) ','hfgh'),
 (0,26,4,71,' dfdfg','Strength',23,0,'1d (1) ','fghfgh'),
 (16,27,4,71,' dfdfg','Strength',22,0,'1d (1) ','ghfgh'),
 (0,28,25,5,' New Appraoch III','Strength',34,0,'6a (1) ','gfhfgh'),
 (0,29,4,71,' dfdfg','AFI',0,24,'1d (1) ','werwerwer'),
 (0,30,25,5,' New Appraoch III','Strength',36,0,'6a (1) ','fgh'),
 (0,31,25,5,' New Appraoch III','Strength',36,0,'6a (1) ','fgh'),
 (0,32,2,65,' Approach V','Strength',6,0,'1b (1) ','S6'),
 (0,33,2,65,' Approach V','Strength',4,0,'1b (1) ','S4'),
 (0,34,1,63,' New Approach I','Strength',31,0,'1a (1) ','S1');
/*!40000 ALTER TABLE `projectapproachdetails` ENABLE KEYS */;


--
-- Definition of table `projectcharter`
--

DROP TABLE IF EXISTS `projectcharter`;
CREATE TABLE `projectcharter` (
  `ProjectCharterID` tinyint(4) NOT NULL,
  `Purpose` varchar(200) default NULL,
  `Scope` varchar(200) default NULL,
  `Objective` varchar(200) default NULL,
  `Company` varchar(50) default NULL,
  `PolicyStatement` varchar(2000) default NULL,
  `TotalNoOfEmployees` int(11) default NULL,
  `ReasonsForUndertaking` varchar(500) default NULL,
  `Stakeholders` varchar(500) default NULL,
  PRIMARY KEY  (`ProjectCharterID`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `projectcharter`
--

/*!40000 ALTER TABLE `projectcharter` DISABLE KEYS */;
/*!40000 ALTER TABLE `projectcharter` ENABLE KEYS */;


--
-- Definition of table `projectcharterrisk`
--

DROP TABLE IF EXISTS `projectcharterrisk`;
CREATE TABLE `projectcharterrisk` (
  `ProjCharterRiskID` tinyint(4) NOT NULL,
  `ProjectCharterID` tinyint(4) NOT NULL,
  `RisksOutlined` varchar(100) NOT NULL,
  `Actiontoreduce` varchar(100) default NULL,
  PRIMARY KEY  (`ProjCharterRiskID`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `projectcharterrisk`
--

/*!40000 ALTER TABLE `projectcharterrisk` DISABLE KEYS */;
/*!40000 ALTER TABLE `projectcharterrisk` ENABLE KEYS */;


--
-- Definition of table `projectdetails`
--

DROP TABLE IF EXISTS `projectdetails`;
CREATE TABLE `projectdetails` (
  `ProjectID` int(10) unsigned NOT NULL auto_increment,
  `Title` varchar(50) default NULL,
  `Responsibility` int(10) unsigned default NULL,
  `StartDate` varchar(45) default NULL,
  `EndDate` varchar(45) default NULL,
  `Description` varchar(250) default NULL,
  `OrgStrategy` int(10) unsigned default NULL,
  `CriterionPart` int(10) unsigned default NULL,
  `Implementation` int(10) unsigned default NULL,
  `Status` varchar(45) default NULL,
  `Priority` int(10) unsigned default NULL,
  `TeamName` varchar(50) NOT NULL,
  `Score` int(11) NOT NULL,
  `expectedBenefits` varchar(1000) NOT NULL,
  `requiredResources` varchar(1000) NOT NULL,
  PRIMARY KEY  (`ProjectID`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `projectdetails`
--

/*!40000 ALTER TABLE `projectdetails` DISABLE KEYS */;
INSERT INTO `projectdetails` (`ProjectID`,`Title`,`Responsibility`,`StartDate`,`EndDate`,`Description`,`OrgStrategy`,`CriterionPart`,`Implementation`,`Status`,`Priority`,`TeamName`,`Score`,`expectedBenefits`,`requiredResources`) VALUES 
 (5,'ProjectI',52,'2011-10-24','2011-10-31','hgjghjghj',50,25,25,'Waiting for approval',34,'',0,'',''),
 (6,'fgdfg',16,'2011-11-14','2011-11-20','dfgdfgdfgd',50,25,25,'Waiting for approval',34,'',0,'dfgdfgdf','gdfgdfg'),
 (7,'vbnvbnv',16,'2011-11-27','2011-11-30','vbnvbnvbnvb',50,25,25,'Waiting for approval',34,'',0,'',''),
 (8,'dfgfgh',16,'2011-11-21','2011-11-29','fghfghfgh',50,25,25,'Waiting for approval',NULL,'',0,'fghfg','hfghfgh'),
 (9,'ghfghfgh',16,'2011-11-16','2011-11-20','gfhfgh',50,25,25,'Waiting for approval',NULL,'',0,'',''),
 (10,'ghfgh',16,'2011-11-28','2011-12-15','ghghghj',50,25,25,'Waiting for approval',NULL,'',0,'',''),
 (11,'delete',16,'2011-11-23','2011-11-27','fgdfg',50,25,25,'Waiting for approval',NULL,'',0,'',''),
 (12,'delete 2',16,'2011-11-16','2011-11-30','fsdfsdf',50,25,25,'Waiting for approval',NULL,'',0,'',''),
 (13,'fghfg',16,'2011-11-28','2011-11-30','fghfgh',50,25,25,'Waiting for approval',NULL,'',0,'',''),
 (14,'fdgdfg',16,'2011-11-27','2011-11-28','dfgdfg',50,25,25,'Waiting for approval',NULL,'',0,'',''),
 (15,'dsfsd',16,'2011-11-28','2011-12-22','sdfsdfsdf',50,25,25,'Waiting for approval',NULL,'',0,'',''),
 (16,'fgd',16,'2011-11-27','2011-11-30','dfg',50,25,25,'Waiting for approval',NULL,'',0,'',''),
 (17,'Testing',16,'2011-11-29','2011-12-22','xdvxcv',50,25,25,'Waiting for approval',NULL,'',0,'','');
/*!40000 ALTER TABLE `projectdetails` ENABLE KEYS */;


--
-- Definition of table `projectprioritysetting`
--

DROP TABLE IF EXISTS `projectprioritysetting`;
CREATE TABLE `projectprioritysetting` (
  `orgstrategy` int(10) unsigned NOT NULL default '0',
  `easeofimp` int(10) unsigned NOT NULL default '0',
  `criterianparts` int(10) unsigned NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `projectprioritysetting`
--

/*!40000 ALTER TABLE `projectprioritysetting` DISABLE KEYS */;
INSERT INTO `projectprioritysetting` (`orgstrategy`,`easeofimp`,`criterianparts`) VALUES 
 (35,30,35);
/*!40000 ALTER TABLE `projectprioritysetting` ENABLE KEYS */;


--
-- Definition of table `projectprogressreport`
--

DROP TABLE IF EXISTS `projectprogressreport`;
CREATE TABLE `projectprogressreport` (
  `ProjectID` int(10) unsigned default NULL,
  `ProgressID` int(10) unsigned NOT NULL auto_increment,
  `ProgressReport` text,
  `UserID` int(10) unsigned default NULL,
  `RoleID` int(10) unsigned default NULL,
  `CreatedAt` varchar(45) default NULL,
  PRIMARY KEY  (`ProgressID`)
) ENGINE=InnoDB DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `projectprogressreport`
--

/*!40000 ALTER TABLE `projectprogressreport` DISABLE KEYS */;
/*!40000 ALTER TABLE `projectprogressreport` ENABLE KEYS */;


--
-- Definition of table `projectteammember`
--

DROP TABLE IF EXISTS `projectteammember`;
CREATE TABLE `projectteammember` (
  `ProjectID` int(10) unsigned default NULL,
  `UserID` int(10) unsigned default NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `projectteammember`
--

/*!40000 ALTER TABLE `projectteammember` DISABLE KEYS */;
/*!40000 ALTER TABLE `projectteammember` ENABLE KEYS */;


--
-- Definition of table `resultassessment`
--

DROP TABLE IF EXISTS `resultassessment`;
CREATE TABLE `resultassessment` (
  `ResultAssessmentID` int(4) NOT NULL auto_increment,
  `CriterionPartID` varchar(50) NOT NULL,
  `Result` varchar(500) NOT NULL,
  `ResultSegments` varchar(300) default NULL,
  `SourceOfInformation` varchar(500) default NULL,
  `Scope` varchar(50) default NULL,
  `Segmentation` varchar(50) default NULL,
  `Trends` varchar(50) default NULL,
  `Targets` varchar(50) default NULL,
  `Comparisons` varchar(50) default NULL,
  `Causes` varchar(50) default NULL,
  `Strength` varchar(1000) default NULL,
  `AreasForImprovement` varchar(1000) default NULL,
  `Score` float default NULL,
  `TeamType` varchar(1) default NULL,
  `SystemGeneratedScore` varchar(50) default NULL,
  `DirectRelavanceToDelivering` varchar(20) default NULL,
  `RelevanceToThisCriterionPart` varchar(20) default NULL,
  `Presented` varchar(20) default NULL,
  `ResultsToLink` varchar(50) default NULL,
  `ResultDocument` varchar(50) default NULL,
  `Integrity` varchar(50) default NULL,
  `LocationID` int(11) default NULL,
  `Location` varchar(50) NOT NULL,
  `StrengthLen` int(11) default '0',
  `AFILen` int(11) default '0',
  `DummyResultID` int(11) default NULL,
  PRIMARY KEY  (`ResultAssessmentID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `resultassessment`
--

/*!40000 ALTER TABLE `resultassessment` DISABLE KEYS */;
INSERT INTO `resultassessment` (`ResultAssessmentID`,`CriterionPartID`,`Result`,`ResultSegments`,`SourceOfInformation`,`Scope`,`Segmentation`,`Trends`,`Targets`,`Comparisons`,`Causes`,`Strength`,`AreasForImprovement`,`Score`,`TeamType`,`SystemGeneratedScore`,`DirectRelavanceToDelivering`,`RelevanceToThisCriterionPart`,`Presented`,`ResultsToLink`,`ResultDocument`,`Integrity`,`LocationID`,`Location`,`StrengthLen`,`AFILen`,`DummyResultID`) VALUES 
 (5,'25','New Appraoch III','','','1/4','1/2','1/2','3/4','1/4','1/2','gfhfgh:@@:fghfg:@@:fgh','fgh:@@:fghfgh:@@:fghg',60,'','1/2','Low','Low','0','Link','0','1/2',1,'Dr Lway',3,3,1),
 (6,'25','New Approach IV','','','Zero','1/2','3/4','3/4','3/4','3/4','','',55,'','1/2','','','0','Link','0','1/2',1,'Dr Lway',0,0,2),
 (7,'25','New Approach VII',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','Link',NULL,NULL,1,'Dr Lway',0,0,3),
 (8,'25','sdasdsad',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','Link',NULL,NULL,1,'Dr Lway',0,0,4),
 (9,'25','sdfsdfsdf',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1','Link',NULL,NULL,1,'Dr Lway',0,0,5),
 (10,'26','uhhjkhj','','','1/2','1/2','1/4','1/2','3/4','Zero','','',35,'','1/4','','','0','Link','0','3/4',1,'Dr Lway',0,0,1),
 (11,'27','fghfghfg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','Link',NULL,NULL,1,'Dr Lway',0,0,1),
 (12,'28','fghfghf hfg fgh fgh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'0','Link',NULL,NULL,1,'Dr Lway',0,0,1);
/*!40000 ALTER TABLE `resultassessment` ENABLE KEYS */;


--
-- Definition of table `resultdocument`
--

DROP TABLE IF EXISTS `resultdocument`;
CREATE TABLE `resultdocument` (
  `ResultAssessmentID` varchar(50) default NULL,
  `ResultDocumentID` int(11) NOT NULL,
  `ResultDocument` varchar(50) default NULL,
  `ResultDocumentDesc` varchar(500) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `resultdocument`
--

/*!40000 ALTER TABLE `resultdocument` DISABLE KEYS */;
INSERT INTO `resultdocument` (`ResultAssessmentID`,`ResultDocumentID`,`ResultDocument`,`ResultDocumentDesc`) VALUES 
 ('5',3,'sample1.txt','fhgdfgh'),
 ('8',1,'print.txt','asdasd'),
 ('5',2,'sample.txt','vdfg');
/*!40000 ALTER TABLE `resultdocument` ENABLE KEYS */;


--
-- Definition of table `resultlinkages`
--

DROP TABLE IF EXISTS `resultlinkages`;
CREATE TABLE `resultlinkages` (
  `ResultAssessmentID` tinyint(4) NOT NULL,
  `ResultLinkagesID` tinyint(4) NOT NULL,
  `DescriptionOfLinkage` varchar(2000) NOT NULL,
  `CriterionPartID` tinyint(4) NOT NULL,
  `LinkageCriterionPartID` tinyint(4) NOT NULL,
  `ResultToLink` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `resultlinkages`
--

/*!40000 ALTER TABLE `resultlinkages` DISABLE KEYS */;
/*!40000 ALTER TABLE `resultlinkages` ENABLE KEYS */;


--
-- Definition of table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `RoleID` int(4) NOT NULL,
  `RoleName` varchar(50) NOT NULL,
  `RoleType` varchar(5) NOT NULL,
  `RoleTypeDescription` varchar(50) default NULL,
  `DisplayOrder` int(11) default NULL,
  PRIMARY KEY  (`RoleID`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `roles`
--

/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`RoleID`,`RoleName`,`RoleType`,`RoleTypeDescription`,`DisplayOrder`) VALUES 
 (1,'Project Sponsor','E','Executive Team',1),
 (2,'Deputy Project Sponsor','E','Executive Team',2),
 (3,'Project Lead Coordinator','E','Executive Team',3),
 (4,'Deputy Project Lead Coordinator','E','Executive Team',4),
 (5,'Sub-team Leader','SL','Sub-team Leader',5),
 (16,'Team Member','NE','Team Member',16),
 (15,'Facilitator','NE','Sub-team',15),
 (17,'Sub-Team Member','NE','Sub-Team',17),
 (18,'Project Sponsor & Lead Coordinator','NE','Executive Team',18),
 (19,'Financial Executive','NE','Executive Member',19);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


--
-- Definition of table `roletype`
--

DROP TABLE IF EXISTS `roletype`;
CREATE TABLE `roletype` (
  `RoleType` varchar(5) NOT NULL,
  `RoleTypeDescription` varchar(50) NOT NULL,
  PRIMARY KEY  (`RoleType`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `roletype`
--

/*!40000 ALTER TABLE `roletype` DISABLE KEYS */;
INSERT INTO `roletype` (`RoleType`,`RoleTypeDescription`) VALUES 
 ('E','Senior Executive Team'),
 ('SL','Executive Team'),
 ('NE','Non-Executive');
/*!40000 ALTER TABLE `roletype` ENABLE KEYS */;


--
-- Definition of table `roletypescreen`
--

DROP TABLE IF EXISTS `roletypescreen`;
CREATE TABLE `roletypescreen` (
  `RoleType` varchar(5) NOT NULL,
  `ScreenID` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `roletypescreen`
--

/*!40000 ALTER TABLE `roletypescreen` DISABLE KEYS */;
/*!40000 ALTER TABLE `roletypescreen` ENABLE KEYS */;


--
-- Definition of table `screen`
--

DROP TABLE IF EXISTS `screen`;
CREATE TABLE `screen` (
  `ScreenID` tinyint(4) NOT NULL,
  `Screen` varchar(50) NOT NULL,
  PRIMARY KEY  (`ScreenID`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `screen`
--

/*!40000 ALTER TABLE `screen` DISABLE KEYS */;
/*!40000 ALTER TABLE `screen` ENABLE KEYS */;


--
-- Definition of table `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `StatusID` int(4) NOT NULL auto_increment,
  `Status` varchar(20) NOT NULL,
  PRIMARY KEY  (`StatusID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `status`
--

/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` (`StatusID`,`Status`) VALUES 
 (1,'Yet to start'),
 (2,'In progress'),
 (3,'Completed');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;


--
-- Definition of table `strength`
--

DROP TABLE IF EXISTS `strength`;
CREATE TABLE `strength` (
  `StrengthID` int(10) unsigned NOT NULL auto_increment,
  `CriterionPartID` int(10) unsigned default NULL,
  `ApproachID` int(10) unsigned default NULL,
  `Type` varchar(45) default NULL,
  `Strength` varchar(1000) default NULL,
  PRIMARY KEY  USING BTREE (`StrengthID`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `strength`
--

/*!40000 ALTER TABLE `strength` DISABLE KEYS */;
INSERT INTO `strength` (`StrengthID`,`CriterionPartID`,`ApproachID`,`Type`,`Strength`) VALUES 
 (4,2,65,'Enabler','S4'),
 (5,2,65,'Enabler','S5'),
 (6,2,65,'Enabler','S6'),
 (13,1,64,'Enabler','dfgdfg'),
 (14,1,64,'Enabler','dfgdf'),
 (15,1,64,'Enabler','dfgdfg'),
 (22,4,71,'Enabler','ghfgh'),
 (23,4,71,'Enabler','fghfgh'),
 (24,4,71,'Enabler','hfgh'),
 (31,1,63,'Enabler','S1'),
 (32,1,63,'Enabler','S2'),
 (33,1,63,'Enabler','S3'),
 (34,25,5,'Result','gfhfgh'),
 (35,25,5,'Result','fghfg'),
 (36,25,5,'Result','fgh');
/*!40000 ALTER TABLE `strength` ENABLE KEYS */;


--
-- Definition of table `subteamactivity`
--

DROP TABLE IF EXISTS `subteamactivity`;
CREATE TABLE `subteamactivity` (
  `ActivityID` int(11) NOT NULL,
  `SubteamID` tinyint(4) NOT NULL,
  `Milestone` varchar(255) NOT NULL,
  `Activity` varchar(255) default NULL,
  `Accountability` int(11) default NULL,
  `DueDate` datetime NOT NULL,
  `StatusID` tinyint(4) NOT NULL,
  PRIMARY KEY  (`ActivityID`)
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `subteamactivity`
--

/*!40000 ALTER TABLE `subteamactivity` DISABLE KEYS */;
/*!40000 ALTER TABLE `subteamactivity` ENABLE KEYS */;


--
-- Definition of table `tbl_project_document`
--

DROP TABLE IF EXISTS `tbl_project_document`;
CREATE TABLE `tbl_project_document` (
  `project_document_name` varchar(25) NOT NULL,
  `project_name` varchar(50) NOT NULL,
  `project_id` int(10) unsigned NOT NULL auto_increment,
  `project_desc` varchar(100) NOT NULL,
  PRIMARY KEY  (`project_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `tbl_project_document`
--

/*!40000 ALTER TABLE `tbl_project_document` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_project_document` ENABLE KEYS */;


--
-- Definition of table `team`
--

DROP TABLE IF EXISTS `team`;
CREATE TABLE `team` (
  `TeamID` tinyint(4) NOT NULL auto_increment,
  `TeamName` varchar(50) default NULL,
  `TeamLeader` tinyint(4) unsigned default NULL,
  `LocationID` int(11) default NULL,
  `Location` varchar(50) default NULL,
  PRIMARY KEY  (`TeamID`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `team`
--

/*!40000 ALTER TABLE `team` DISABLE KEYS */;
INSERT INTO `team` (`TeamID`,`TeamName`,`TeamLeader`,`LocationID`,`Location`) VALUES 
 (1,'Assessment1',3,1,'Dr Lway'),
 (3,'HR Team',18,1,'Dr Lway'),
 (4,'Strategy team',43,1,'Dr Lway'),
 (5,'Customer Results Team',45,1,'Dr Lway'),
 (6,'SYNA',19,1,'Dr Lway'),
 (14,'Sales Team',16,1,'Dr Lway'),
 (9,'Finance Team',11,1,'Dr Lway'),
 (15,'New team',3,1,'Dr Lway'),
 (11,'Service Quality',40,1,'Dr Lway'),
 (13,'Training',16,1,'Dr Lway'),
 (16,'Test Team',16,1,'Dr Lway'),
 (17,'Testing SA',60,1,'Dr Lway');
/*!40000 ALTER TABLE `team` ENABLE KEYS */;


--
-- Definition of table `teamcriterionpart`
--

DROP TABLE IF EXISTS `teamcriterionpart`;
CREATE TABLE `teamcriterionpart` (
  `TeamID` tinyint(4) NOT NULL,
  `CriterionPartID` tinyint(4) NOT NULL,
  `Remarks` varchar(2000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `teamcriterionpart`
--

/*!40000 ALTER TABLE `teamcriterionpart` DISABLE KEYS */;
INSERT INTO `teamcriterionpart` (`TeamID`,`CriterionPartID`,`Remarks`) VALUES 
 (15,26,''),
 (17,28,''),
 (17,27,''),
 (1,11,''),
 (1,10,''),
 (11,29,''),
 (11,30,''),
 (13,19,''),
 (13,18,''),
 (13,17,''),
 (13,16,''),
 (15,25,''),
 (15,2,''),
 (15,1,''),
 (17,5,''),
 (17,4,'');
/*!40000 ALTER TABLE `teamcriterionpart` ENABLE KEYS */;


--
-- Definition of table `teammember`
--

DROP TABLE IF EXISTS `teammember`;
CREATE TABLE `teammember` (
  `TeamID` tinyint(4) unsigned NOT NULL,
  `Remarks` varchar(45) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `teammember`
--

/*!40000 ALTER TABLE `teammember` DISABLE KEYS */;
INSERT INTO `teammember` (`TeamID`,`Remarks`,`UserID`) VALUES 
 (1,'',1),
 (1,'',2),
 (0,'',13),
 (0,'',14),
 (0,'',15),
 (0,'',19),
 (1,'',33),
 (1,'',42),
 (2,'',49),
 (5,'',38),
 (3,'',48),
 (1,'',50),
 (11,'',46),
 (1,'',44),
 (1,'',43),
 (1,'',44),
 (1,'',53);
/*!40000 ALTER TABLE `teammember` ENABLE KEYS */;


--
-- Definition of table `usermaster`
--

DROP TABLE IF EXISTS `usermaster`;
CREATE TABLE `usermaster` (
  `UserID` int(11) NOT NULL auto_increment,
  `UserName` varchar(50) NOT NULL,
  `LoginName` varchar(50) default NULL,
  `Designation` varchar(50) default NULL,
  `TelPhoneNo` varchar(50) default NULL,
  `MobileNo` varchar(50) default NULL,
  `EMail` varchar(50) default NULL,
  `RoleID` int(10) unsigned NOT NULL default '0',
  `TeamID` int(10) unsigned default NULL,
  `Password` varchar(45) default NULL,
  `SurName` varchar(25) default NULL,
  `LocationID` int(11) default NULL,
  `Location` varchar(50) default NULL,
  `cityName` varchar(50) NOT NULL,
  `RoleType` varchar(10) default NULL,
  PRIMARY KEY  (`UserID`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `usermaster`
--

/*!40000 ALTER TABLE `usermaster` DISABLE KEYS */;
INSERT INTO `usermaster` (`UserID`,`UserName`,`LoginName`,`Designation`,`TelPhoneNo`,`MobileNo`,`EMail`,`RoleID`,`TeamID`,`Password`,`SurName`,`LocationID`,`Location`,`cityName`,`RoleType`) VALUES 
 (16,'Abdullah','lway123','HR Manager','1234567844','05012346789','lway@eiim.ae',5,NULL,'sa1234*','Mohammed',1,'Dr Lway','Dubai','E'),
 (11,'John','james','Design director','03243234332','93442432432','johnjames@synad.com',16,NULL,'sa1234*','James',1,'Dr Lway','Dubai',NULL),
 (3,'Lway','drlway','Managing Director','21211111','9877665001','lway@watani.in',1,NULL,'sa1234*','Nackasha',1,'Dr Lway','Dubai',NULL),
 (12,'Genga','genga','Project Manager','012343212312','921313123123','gengarajan@gmail.com',5,0,'sa1234*','Rajan',1,'Dr Lway','Dubai',NULL),
 (13,'anand','anand','Project Manager','234324234','912321322','anand@synad.com',6,0,'sa1234*','ethiraj',1,'Dr Lway','Dubai',NULL),
 (14,'hakim','hakim','Creative Writer','023432432','912312322','hakim@synad.com',7,0,'sa1234*','hakim',1,'Dr Lway','Dubai',NULL),
 (18,'David','david','CSR Engineer','001234566677','0027363535332','lwayn@eim.ae',5,NULL,'sa1234*','Lund',1,'Dr Lway','Dubai',NULL),
 (19,'Abu','Abu','Team Member','9292992','2334','abu@syna.com',5,0,'sa1234*','Salem',1,'Dr Lway','Dubai',NULL),
 (32,'Asim','asimshaikh','HR Manager','0097165483091','00971558178152','asimshaikh@gmail.com',15,1,'sa1234*','Shaikh',1,'Dr Lway','Dubai',NULL),
 (37,'Nausheen','Nausheen','Manager','0097412626512','33333443434','lwayn@eim.ae',16,NULL,'nausheen*','Shamsher',1,'Dr Lway','Dubai',NULL),
 (33,'Mazhar','Mazhar','Team Member','111111111111111','111111111111111','11@co.in',17,1,'mazharkhan','Khan',1,'Dr Lway','Dubai',NULL),
 (42,'Gladys','gladys','Team Member','0506789073','0506789073','gladys@gmail.com',17,1,'gladys','John',1,'Dr Lway','Al Ain',NULL),
 (40,'Kelvin','Kelvin','Manager','0506322122','0506322122','kelvin@gmail.com',5,NULL,'kelvin','D\'souza',1,'Dr Lway','Dubai',NULL),
 (53,'Henry','Henryfall','Manager','890532156','971561015439','henry@yahoo.co.uk',19,1,'henry123','Fall',1,'Dr Lway','Dubai',NULL),
 (38,'Ana','Ana John','Member','009823788569','009823788569','ana@gmail.com',16,5,'anajohn','John',1,'Dr Lway','Ajman',NULL),
 (39,'Rauf','rauf','Team member','0506234332','0506234332','rauf@gmail.com',15,1,'raufa','Ahmad',1,'Dr Lway','Abu Dhabi',NULL),
 (43,'Joy','joymukherjee','HR Manager','0506342212','0506342212','joy@gmail.com',18,0,'joymukherjee','Mukherjee',1,'Dr Lway','Ras Al Khaimah',NULL),
 (44,'Abid','Abid','Finance Assistant','0507890098','0507890098','abid@gmail.com',15,0,'abidkhan','Khan',1,'Dr Lway','Sharjah',NULL),
 (45,'Rochelle','Rochelle','Quality Manager','0567890008','0567890008','rochelle@gmail.com',19,0,'Rochelle','Fernandes',1,'Dr Lway','Abu Dhabi',NULL),
 (46,'Karuna','Karuna','Quality Manager','05099876543','05099876543','karuna@gmail.com',15,11,'karuna','Luthar',1,'Dr Lway','Sharjah',NULL),
 (52,'adam','adamjill','Manager','67686879','9962595911','adam@yahoo.com',5,0,'adam123','jill',1,'Dr Lway','Dubai',NULL),
 (48,'Aruna','ankemaruna','Engineer','042834499','971569834213','ankemaruna@gmail.com',16,3,'aruna123','Ankem',1,'Dr Lway','Dubai',NULL),
 (49,'arun','arunjame','manager','09876590422','98766440092','aruna@synadevelopment.com',15,2,'abc123','jame',1,'Dr Lway','Dubai',NULL),
 (50,'Adam','dubai','Project Co-ordinator','042836478','97656678900','john@gmail.com',15,1,'dubai','Johnson',1,'Dr Lway','Dubai',NULL),
 (51,'Arun','ankemaruna123','Manager','0561015439','0561015439','aruna@synadevelopment.com',5,0,'aruna123','Anke',1,'Dr Lway','Dubai',NULL),
 (60,'Priya','priya','AAAAAAAAAAA','3423423423','423423423','priya@hakunamatata.in',5,17,'priya','Soman',1,'Dr Lway','Chennai','NE');
/*!40000 ALTER TABLE `usermaster` ENABLE KEYS */;


--
-- Definition of table `userroleteam`
--

DROP TABLE IF EXISTS `userroleteam`;
CREATE TABLE `userroleteam` (
  `UserRoleTeamID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `RoleID` tinyint(4) NOT NULL,
  `TeamID` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `userroleteam`
--

/*!40000 ALTER TABLE `userroleteam` DISABLE KEYS */;
/*!40000 ALTER TABLE `userroleteam` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
