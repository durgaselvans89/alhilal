<?php

header('content-type:text/html; charset=utf-8');
//require_once('class.phpmailer.php');
require_once ('com/DBConnection/dbConnection.php');
require_once ('com/DAOConstants/CustomerConstants.php');
require_once ('com/VO/CustomerDO.php');
require_once ('com/DAOConstants/TeamConstants.php');
require_once ('com/DAOConstants/MasterConstants.php');
require_once ('Mail_SA.php');

class SACustomers{


	 public function AddCustomer(CustomerDO $customerDO){

		try{
		   $sacustomers=new SACustomers();
		   $status = 0;
		   $cnt_userID = 0;
		   $cnt_mailID = 0; 
		   $cnt_roleID = 0;
		   $username = $customerDO->username;
		   $surname = $customerDO->surname;
		   $loginname = $customerDO->loginname;
		   $password = $sacustomers->generatePassword();
		   //$password = $customerDO->password;
		   $designation = $customerDO->designation;
		   $phoneno = $customerDO->phoneno;
		   $mobileno = $customerDO->mobileno;
		   $emailid = $customerDO->emailid;
		   $roleid = $customerDO->roleid;
		   $locationID = $customerDO->locationID;
		   $location = $customerDO->location;
		   $cityName=$customerDO->cityName;
		   $roletype=$customerDO->roletype;
		   $teamid = 0;
		   $rowInserted = 0;
		   
		   $mail=new Mail_SA();
		   $database = new dbConnection();
		   $connection = $database->getConnection();
		   mysql_query("set names utf8");
		   if($roleid<5){
				
			   $result = $connection->prepare(TeamConstants::TO_CHECK_EXE_ROLE_EXISTS_ADD);
			   $result->bind_param("i",$roleid);
			   $result->execute();
			   $result->bind_result($cntRoleID);
			   while($result->fetch()){
					$cnt_roleID = $cntRoleID;
			   }
			   $result->close();
			   
			   $result = $connection->prepare(TeamConstants::CHK_USERNAME_SURNAME_EXISTS);
			   $result->bind_param("ss",$username,$surname);
			   $result->execute();
			   $result->bind_result($cntUserSurName);
			   while($result->fetch()){
					$cnt_surname = $cntUserSurName;
			   }
			   $result->close();
				if($cnt_surname==0){
					if($cnt_roleID==0){
						$result = $connection->prepare(TeamConstants::TO_CHECK_USER_EXISTS);
					   $result->bind_param("s",$emailid);
					   
					   $result->execute();
					   $result->bind_result($cntEmailID);
					   while($result->fetch()){
							$cnt_mailID = $cntEmailID;
					   }
					   $result->close();
					   
					   if($cnt_mailID == 0){
							$result = $connection->prepare(TeamConstants::TO_CHECK_LOGINNAME_EXISTS);
							$result->bind_param("s",$loginname);
							$result->execute();
							$result->bind_result($cntuserID);
							while($result->fetch()){
								$cnt_userID = $cntuserID;
							}
							$result->close();
							
							if($cnt_userID == 0){
								
								$result = $connection->prepare(CustomerConstants::INSERT_CUSTOMER_VALUE);
								
								$result->bind_param("ssssssssiiisss",$username,$surname,$loginname,$password,$designation,$phoneno,$mobileno,$emailid,$roleid,$teamid,$locationID,$location,$cityName,$roletype);
								
								$result->execute();
								$rowInserted = $result->affected_rows;
								$result->close();
								$saCust=new SACustomers();
								$saCust->insertExecutiveDefaultMem();
								//$saCust->sendMail($emailid,'Self Assessment','Your password is '.$password);
								
								//$content='Your Account has been created successfully on Excellence Builder application.\r\nKindly note your account information below:\r\nUsername : '.$loginname.'\r\nPassword : '.$password.'\r\nWe would advice you to please change your password once you log in to your account.\r\nRegards Excellence Builder Team';
								$content='<html><head><title></title></head><body>Your Account has been created successfully on Excellence Builder application.<br/>Kindly note your account information below:<br/><b>Username : </b>'.$loginname.'<br/><b>Password : </b>'.$password.'<br/>We would advice you to please change your password once you log in to your account.<br/>Regards Excellence Builder Team</body></html>';
							
								$mailSending=$mail->sendMail($emailid,'Self Assessment',$content);
								
								$status=$rowInserted;
								
							}
							else{
								$status=3;
							}
						}
						else{
							$status=2;
						}
				   }
				   else{
						$status=4;
				   }
			   }
			   else{
					$status=5;
			   }
		   }
		   else{
				if($cnt_mailID == 0){
					$result = $connection->prepare(TeamConstants::TO_CHECK_LOGINNAME_EXISTS);
					$result->bind_param("s",$loginname);
					$result->execute();
					$result->bind_result($cntuserID);
					while($result->fetch()){
						$cnt_userID = $cntuserID;
					}
					$result->close();
					
					$result = $connection->prepare(TeamConstants::CHK_USERNAME_SURNAME_EXISTS);
				   $result->bind_param("ss",$username,$surname);
				   $result->execute();
				   $result->bind_result($cntUserSurName);
				   while($result->fetch()){
						$cnt_surname = $cntUserSurName;
				   }
				   $result->close();
					if($cnt_surname==0){
						if($cnt_userID == 0){
							
							$result = $connection->prepare(CustomerConstants::INSERT_CUSTOMER_VALUE);
							$result->bind_param("ssssssssiiisss",$username,$surname,$loginname,$password,$designation,$phoneno,$mobileno,$emailid,$roleid,$teamid,$locationID,$location,$cityName,$roletype);
							//return $username.'-'.$surname.'-'.$loginname.'-'.$password.'-'.$designation.'-'.$phoneno.'-'.$mobileno.'-'.$emailid.'-'.$roleid.'-'.$teamid.'-'.$locationID.'-'.$location.'-'.$cityName;
							$result->execute();
							$rowInserted = $result->affected_rows;
							$result->close();
							//$content='Your Account has been created successfully on Excellence Builder application.\r\nKindly note your account information below:\r\nUsername : '.$loginname.'\r\nPassword : '.$password.'\r\nWe would advice you to please change your password once you log in to your account.\r\nRegards Excellence Builder Team';
							$content='<html><head><title></title></head><body>Your Account has been created successfully on Excellence Builder application.<br/>Kindly note your account information below:<br/><b>Username : </b>'.$loginname.'<br/><b>Password : </b>'.$password.'<br/>We would advice you to please change your password once you log in to your account.<br/>Regards Excellence Builder Team</body></html>';
							$mailSending=$mail->sendMail($emailid,'Self Assessment',$content);
							//return $mailSending;
							$status=$rowInserted;
							if($status==1 && $roleid==5){
								$result = $connection->prepare(CustomerConstants::GET_USER_ID_ADDED_RECENTLY);
								$result->execute();
								$NewUserID=0;
								$result->bind_result($userID);
								while($result->fetch()){
									$NewUserID=$userID;
								}
								$result->close();
								//return $NewUserID;
								if($NewUserID!=0){
									$result = $connection->prepare(MasterConstants::INSERT_EXE_ROLES);
									$result->bind_param("ii",$roleid,$NewUserID);
									$result->execute();
									$rowInsertedExe = $result->affected_rows;
									$result->close();
								}
							}
						}
						else{
							$status=3;
						}
					}
					else{
						$status=5;
					}
				}
				else{
					$status=2;
				}
		   }
		   
			$connection->close();
		}
		catch(Exception $exception){
		   throw ($exception);
		}
		return $status;   
	}
	public function searchPwd($emailID){
		//return 'xfsdf';
		$status=0;
		try{
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(CustomerConstants::SEARCH_PASSWORD);
			$result->bind_param("s",$emailID);
			$result->execute();
			$result->bind_result($pwd);
			while($result->fetch()){
				$password=$pwd;
				$status=1;
			}
			if($status==1){
				$mail=new Mail_SA();
				$content='<html><head><title></title></head><body>Your password is: <b>'.$password.'<b/></body></html>';
				$mailSending=$mail->sendMail($emailID,'Self Assessment',$content);
			}
			$result->close();
		}
		catch(Exception $exception){
			die($exception);
		}
		$connection->close();
		return $status;
	}
	public function sendMail($emailIDArray, $subject, $emailcontent){
		
		$strmail = "";	
		try{
			$to = $emailIDArray;
			$subject = $subject;
			$message = $emailcontent;
			$from = "lwayn@eim.ae";

			$headers1 = "MIME-Version: 1.0\r\n";
			$headers1 .= "Content-type: text/html; charset=iso-8859-1\r\n";

			$headers1 .= "To: ".$to."\r\n";
			$headers1 .= "From: ".$from."\r\n";

			mail($to, $subject, $message, $headers1);
			$strmail = "Your message has been sent !";
		}
		catch(Exception $exception){
			die($exception);
		}
		return $strmail;
	}
	public function insertExecutiveDefaultMem(){
		try{
			$database = new dbConnection();
			$connection = $database->getConnection();
			$result = $connection->prepare(CustomerConstants::DELETE_DEFAULT_EXE_MEM);
			$result->execute();
			$rowInserted = $result->affected_rows;
			$result->close();
			$result = $connection->prepare(CustomerConstants::INSERT_DEFAULT_EXE_MEM);
			$result->execute();
			$rowInserted = $result->affected_rows;
			$result->close();
		}
		catch(Exception $exception){
			throw($exception);
		}
	}
	
	
	public function SearchCustomers($Name, $designation, $Roleid){
 
			if($Name != "")
				$Name = '%'.$Name.'%'; 
			else 
				$Name = '%';

		  

		  try{

			  $database = new dbConnection();
		   $connection = $database->getConnection();
			if($designation=='All'  && $Roleid==0){
				$result = $connection->prepare(CustomerConstants::SEARCH_USER_DETAILS_DESIG_AND_ROLE_ALL);
				$result->bind_param("ss",$Name,$Name);
			}
			else if($designation=='All'  && $Roleid!=0){
				$result = $connection->prepare(CustomerConstants::SEARCH_USER_DETAILS_DESIG_ALL);
				$result->bind_param("ssi",$Name,$Name,$Roleid);
			}
			else if($designation!='All'  && $Roleid==0){
				$result = $connection->prepare(CustomerConstants::SEARCH_USER_DETAILS_ROLE_ALL);
				$result->bind_param("sss",$Name,$Name,$designation);
			}
			else{
			   $result = $connection->prepare(CustomerConstants::SEARCH_USER_DETAILS);
			   $result->bind_param("sssi",$Name,$Name,$designation, $Roleid);
		   }
		   $result->execute();
		   
		   $result->bind_result($Sruserid, $SrName, $SrsurName, $SrDesignation,$roleID,$roleName, $SrTeamid,$telPhoneNo,$EMail, $mobileNo, $loginName, $password, $locationID, $location,$cityName);

		   $User_array = array();
		   
		   while($result->fetch()){
			
			$searchdo = new CustomerDO(); 
			
			$searchdo->userid = $Sruserid;
			$searchdo->username = $SrName;
			$searchdo->name = $SrName.' '.$SrsurName;
			$searchdo->surname = $SrsurName;
			$searchdo->designation = $SrDesignation;
			$searchdo->roleid = $roleID;
			$searchdo->rolename = $roleName;
			$searchdo->teamid = $SrTeamid;
			$searchdo->telphoneno = $telPhoneNo;
			$searchdo->mobileno = $mobileNo;
			$searchdo->loginname = $loginName;
			$searchdo->password = $password;
			$searchdo->emailid = $EMail;
			$searchdo->locationID = $locationID;
			$searchdo->location = $location;
			$searchdo->cityName = $cityName;
			$User_array[] = $searchdo;
			unset($searchdo);
		   }
		   $result->close();
		   $connection->close(); 
		  } 
		  catch(Exception $exception){
		   throw ($exception);
		  }
		  return $User_array; 
		}
 
	public function UpdateCustomers(CustomerDO $UpcustomerDO){
 
	  try{
			$status=0;
			$cnt_mailID = 0;
			$cnt_userID = 0;
			$cnt_roleID = 0;
			
			$Upusername = $UpcustomerDO->username;
			$Upsurname = $UpcustomerDO->surname;
			$Updesignation = $UpcustomerDO->designation;
			$Upphoneno = $UpcustomerDO->phoneno; 
			$Upmobileno = $UpcustomerDO->mobileno;
			$Upemailid = $UpcustomerDO->emailid;
			$Uproleid = $UpcustomerDO->roleid;
			$Upteamid = $UpcustomerDO->teamid;
			$Upuserid = $UpcustomerDO->userid;
		    $UploginName = $UpcustomerDO->loginname;
			$password = $UpcustomerDO->password;
			$UpLocationID=$UpcustomerDO->locationID;
			
			$UpLocation=$UpcustomerDO->location;
			$upcityName=$UpcustomerDO->cityName;
			//return $UpLocationID . 'ghfhg' . $UpLocation;
			$database = new dbConnection();
			$connection = $database->getConnection();
			
			$result = $connection->prepare(TeamConstants::GET_ROLED_FOR_SELECTED_USER);
		    $result->bind_param("i",$Upuserid);
		    $result->execute();
		    $result->bind_result($roleID);
		    while($result->fetch()){
				$oldRoleID = $roleID;
		    }
		    $result->close();
			
			//return $oldRoleID;
		    if($Uproleid<5){
			   $result = $connection->prepare(TeamConstants::TO_CHECK_EXE_ROLE_EXISTS);
			   $result->bind_param("ii",$Uproleid,$Upuserid);
			   $result->execute();
			   $result->bind_result($cntRoleID);
			   while($result->fetch()){
					$cnt_roleID = $cntRoleID;
			   }
			   $result->close();
			   
			   $result = $connection->prepare(TeamConstants::CHK_USERNAME_SURNAME_EXISTS_UPDATE);
			   $result->bind_param("ssi",$Upusername,$Upsurname,$Upuserid);
			   $result->execute();
			   $result->bind_result($cntSurnameExists);
			   while($result->fetch()){
					$cnt_surname = $cntSurnameExists;
			   }
			   $result->close();
				if($cnt_surname==0){
				   if($cnt_roleID==0){
						$result = $connection->prepare(TeamConstants::TO_CHECK_USER_EXISTS_UPDATE);
						$result->bind_param("si",$Upemailid,$Upuserid);
						$result->execute();
						$result->bind_result($cntEmailID);
						while($result->fetch()){
							$cnt_mailID = $cntEmailID;
						}
						$result->close();
						if($cnt_mailID==0){
							$result = $connection->prepare(TeamConstants::TO_CHECK_LOGINNAME_EXISTS_UPDATE);
							$result->bind_param("si",$UploginName,$Upuserid);
							$result->execute();
							$result->bind_result($cntuserID);
							while($result->fetch()){
								$cnt_userID = $cntuserID;
							}
							$result->close();
							
							if($cnt_userID == 0){
						
								$result = $connection->prepare(CustomerConstants::UPDATE_USER_DETAILS);
								$result->bind_param("sssssssiissi",$UploginName,$Upusername, $Upsurname, $Updesignation, $Upphoneno, $Upmobileno, $Upemailid, $Uproleid, $UpLocationID, $UpLocation,$upcityName,$Upuserid);
								$result->execute();
								$rowUpdated = $result->affected_rows;
								$result->close();
								$status=1;
							}
							else{
								$status=3;
							}
							
						}
						else{
							$status=2;
						}
					}
					else{
						$status=4;
					}
				}
				else{
					$status = 5;
				}
			}
			else{
				$result = $connection->prepare(TeamConstants::TO_CHECK_USER_EXISTS_UPDATE);
				$result->bind_param("si",$Upemailid,$Upuserid);
				$result->execute();
				$result->bind_result($cntEmailID);
				while($result->fetch()){
					$cnt_mailID = $cntEmailID;
				}
				$result->close();
				$result = $connection->prepare(TeamConstants::CHK_USERNAME_SURNAME_EXISTS_UPDATE);
			   $result->bind_param("ssi",$Upusername,$Upsurname,$Upuserid);
			   $result->execute();
			   $result->bind_result($cntSurnameExists);
			   while($result->fetch()){
					$cnt_surname = $cntSurnameExists;
			   }
			   $result->close();
				if($cnt_surname==0){
					if($cnt_mailID==0){
						$result = $connection->prepare(TeamConstants::TO_CHECK_LOGINNAME_EXISTS_UPDATE);
						$result->bind_param("si",$UploginName,$Upuserid);
						$result->execute();
						$result->bind_result($cntuserID);
						while($result->fetch()){
							$cnt_userID = $cntuserID;
						}
						$result->close();
						
						if($cnt_userID == 0){
					
							$result = $connection->prepare(CustomerConstants::UPDATE_USER_DETAILS);
							$result->bind_param("sssssssiissi",$UploginName,$Upusername, $Upsurname, $Updesignation, $Upphoneno, $Upmobileno, $Upemailid, $Uproleid, $UpLocationID, $UpLocation,$upcityName,$Upuserid);
							$result->execute();
							$rowUpdated = $result->affected_rows;
							$result->close();
							$status=1;
							if($oldRoleID!=$Uproleid && $Uproleid==5 && $status==1 && $oldRoleID>5){
								$result = $connection->prepare(MasterConstants::INSERT_EXE_ROLES);
								$result->bind_param("ii",$Uproleid,$Upuserid);
								$result->execute();
								$rowInsertedExe = $result->affected_rows;
								$result->close();
							}
						}
						else{
							$status=3;
						}
						
					}
					else{
						$status=2;
					}
				}
				else{
					$status = 5;
				}
			}
			if($status==1){
				$result = $connection->prepare(CustomerConstants::UPDATE_TEAM_LOCATION);
				$result->bind_param("isi",$UpLocationID,$UpLocation,$Upuserid);
				$result->execute();
				$rowUpdated = $result->affected_rows;
				$result->close();
				$saCust=new SACustomers();
				$saCust->insertExecutiveDefaultMem();
				$saCust->UpdateAccountPassword($Upuserid ,$password);
			}
		    $connection->close();
	   
	    }
		catch(Exception $exception){
			die ($exception);
		}
		return $status; 
	}
	 
	 
	public function UpdateAccountPassword($userid, $password){
	
		if (( $userid !=null) && ( $password !=null)){
			try{
				$database = new dbConnection();
				$connection = $database->getConnection();
								
				$result = $connection->prepare(CustomerConstants::UPDATE_PASSWORD);
				$result->bind_param("si",$password, $userid);
				$result->execute();
				
				$Upstatus = $result->affected_rows;
			}	
			catch(Exception $exception){
				throw ($exception);
			}
		}
		else {
			$Upstatus = 0;
		}	
		return $Upstatus;	
	
	}
	
	
	public function GetExecutiveTeam(){
 
	  try{

		$database = new dbConnection();
	   $connection = $database->getConnection();
		   
	   $result = $connection->prepare(CustomerConstants::EXECUTIVE_TEAM);
	   $result->execute();
	   $result->bind_result($userID,$SrName, $SrsurName, $Srdesignation, $roleID, $SrRoleName, $locationID, $location, $loginName);

	   $Team_array = array();
	   
	   $i = 1;
	   
	   while($result->fetch()){
	   $executivedo = new CustomerDO();

	   $executivedo->sno = $i; 
	   $executivedo->userid = $userID;
	   $executivedo->username = $SrName . ' ' . $SrsurName;
	   $executivedo->surname = $SrsurName;
	   $executivedo->designation = $Srdesignation;
	   $executivedo->roleid = $roleID;
	   $executivedo->rolename = $SrRoleName;
	   $executivedo->locationID = $locationID;
	   $executivedo->location = $location;
	   $executivedo->loginname = $loginName;
	   $Team_array[] = $executivedo;
	   unset($executivedo);
	   $i++;
	   }
	  } 
	  catch(Exception $exception){
	   throw ($exception);
	  }
	  return $Team_array; 
	 
	 }
	 
	 /*
	public function deleteCustomer($userID){
  
	  try{
	   
	   $database = new dbConnection();
	   $connection = $database->getConnection();
	   $result = $connection->prepare(CustomerConstants::DELETE_CUSTOMER);
	   $result->bind_param("i",$userID);
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
	*/
	
	public function deleteCustomer($userID,$roleID){
  
	try{
	   
		   $database = new dbConnection();
		   $userid = "";
		   $teamid = "";
		   $countcriteriaid = "";
		   $teamresultid = "";
		   $cntProjRespons=0;
		   $cntProjTeamMem=0;
		   $connection = $database->getConnection();
		   
		    if($roleID>5){
				$result = $connection->prepare(CustomerConstants::GET_TEAM_ID_TEAM_MEMBER);
				$result->bind_param("i",$userID);
			}
			else{
				$result = $connection->prepare(CustomerConstants::GET_TEAM_ID_TEAM_LEADER);
				$result->bind_param("i",$userID);
			}
			
			$result->execute();
			$result->bind_result($teamID);
			
			while($result->fetch()){
				$teamid = $teamID;
			}
			$result->close();
			
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
					//return 'test '.$countcriteriaid;
					$cntActivityID = 0;
					
					$result = $connection->prepare(CustomerConstants::CHK_USER_RESP_UNDER_PLAN);
				    $result->bind_param("i",$userID);
				    $result->execute();
				    $result->bind_result($countActivityID);
					while($result->fetch()){
						$cntActivityID = $countActivityID;
					}
				    $result->close();
					
					$result = $connection->prepare(CustomerConstants::SELECT_USER_EXISTS_PROJ);
				    $result->bind_param("i",$userID);
				    $result->execute();
				    $result->bind_result($countProjResp);
					while($result->fetch()){
						$cntProjRespons = $countProjResp;
					}
				    $result->close();
					
					
					$result = $connection->prepare(CustomerConstants::CHK_USER_EXISTS_UNDER_PROJ_TEAM_MEM);
				    $result->bind_param("i",$userID);
				    $result->execute();
				    $result->bind_result($countProjTeamMem);
					while($result->fetch()){
						$cntProjTeamMem = $countProjTeamMem;
					}
				    $result->close();
					
					
					if($cntActivityID==0 && cntProjRespons==0 && $cntProjTeamMem==0){
						if($roleID>5){
						   $result = $connection->prepare(CustomerConstants::DELETE_TEAM_MEMBER);
						   $result->bind_param("i",$userID);
						   $result->execute();
						   $rowUpdated = $result->affected_rows;
						   $result->close();
						}
						else{
						
							$result = $connection->prepare(CustomerConstants::DELETE_TEAM_LEADER);
							$result->bind_param("i",$userID);
							$result->execute();
							$rowUpdated = $result->affected_rows;
							$result->close();
							
							$result = $connection->prepare(CustomerConstants::DELETE_TEAM_MEMBER_LIST);
							$result->bind_param("i",$teamid);
							$result->execute();
							$rowUpdated = $result->affected_rows;
							$result->close();
							$result = $connection->prepare(CustomerConstants::DELETE_CUSTOMER);
							$result->bind_param("i",$userID);
							$result->execute();
							$rowUpdated = $result->affected_rows;
							$result->close();
						}
					}
					else{
						$rowUpdated = 2;
					}
					
				}
				else{
					$rowUpdated = 0;
				}
			   
			}
			else{
					$result = $connection->prepare(CustomerConstants::SELECT_USER_EXISTS_PROJ);
				    $result->bind_param("i",$userID);
				    $result->execute();
				    $result->bind_result($countProjResp);
					while($result->fetch()){
						$cntProjRespons = $countProjResp;
					}
				    $result->close();
					
					$result = $connection->prepare(CustomerConstants::CHK_USER_EXISTS_UNDER_PROJ_TEAM_MEM);
				    $result->bind_param("i",$userID);
				    $result->execute();
				    $result->bind_result($countProjTeamMem);
					while($result->fetch()){
						$cntProjTeamMem = $countProjTeamMem;
					}
				    $result->close();
					
					
					if($cntProjRespons==0 && $cntProjTeamMem==0){
						$connection = $database->getConnection();
						$result = $connection->prepare(CustomerConstants::DELETE_CUSTOMER);
						$result->bind_param("i",$userID);
						$result->execute();
						$rowUpdated = $result->affected_rows;
						$result->close();
						$connection->close();
					}
					else{
						$rowUpdated=0;
					}
					
			}
	   
		   $connection->close();
	   }
	  catch(Exception $exception){
	   die($exception);
	  }
	  return $rowUpdated;
	}
	public function generatePassword(){
		$possible="0521487369azqsxwdcvfergbhtnjymkuiploALSKZMXNDJFHCBVPOQWEIUTY";
		$length=7;
		$maxLength=strlen($possible);
		$i=0;
		while($i<$length){
			$char = substr($possible ,mt_rand(0,$maxLength-1),1);
			if(!strstr($password,$char)){
				$password .= $char;
				$i++;
			}
		}
		return $password;
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
	
	/*
	public function updateLocationRegUser($userid,$locationID,$location){
		try{
			$database = new dbConnection();
			$connection = $database->getConnection();
			//Update the team
			$result = $connection->prepare(CustomerConstants::UPDATE_TEAM_LOCATION);
			$result->bind_param("isi",$locationID,$location,$userid);
			$result->execute();
			$rowUpdated = $result->affected_rows;
			$result->close();
			//Update the enablerassessment
			$result = $connection->prepare(CustomerConstants::UPDATE_ENABLER_ASSESSMENT_LOCATION);
			$result->bind_param("isi",$locationID,$location,$userid);
			$result->execute();
			$rowUpdated = $result->affected_rows;
			$result->close();
			//Update the exeteamactivities
			$result = $connection->prepare(CustomerConstants::UPDATE_EXE_TEAM_ACT_LOCATION);
			$result->bind_param("isi",$locationID,$location,$userid);
			$result->execute();
			$rowUpdated = $result->affected_rows;
			$result->close();
			//Update the exeteamenablerassessment
			$result = $connection->prepare(CustomerConstants::UPDATE_EXE_TEAM_ENABLER_ASSESS_LOCATION);
			$result->bind_param("isi",$locationID,$location,$userid);
			$result->execute();
			$rowUpdated = $result->affected_rows;
			$result->close();
			//Update the criteronpartscore
			$result = $connection->prepare(CustomerConstants::UPDATE_CRITERION_SCORE_LOCATION);
			$result->bind_param("isi",$locationID,$location,$userid);
			$result->execute();
			$rowUpdated = $result->affected_rows;
			$result->close();
			//Update the exeteamresultassessment
			$result = $connection->prepare(CustomerConstants::UPDATE_EXE_TEAM_RESULT_ASSESS_LOCATION);
			$result->bind_param("isi",$locationID,$location,$userid);
			$result->execute();
			$rowUpdated = $result->affected_rows;
			$result->close();
			//Update the resultassessment
			$result = $connection->prepare(CustomerConstants::UPDATE_RESULT_ASSESS_LOCATION);
			$result->bind_param("isi",$locationID,$location,$userid);
			$result->execute();
			$rowUpdated = $result->affected_rows;
			$result->close();
			
		}
		catch(Exception $exception){
			throw($exception);
		}
	}
	*/
	
}	
?>