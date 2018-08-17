package src.com.selfassessment.controller{
	
	import mx.controls.Alert;
	import mx.managers.CursorManager;
	import mx.rpc.events.FaultEvent;
	import mx.rpc.events.ResultEvent;
	import mx.rpc.remoting.RemoteObject;
	
	import src.com.selfassessment.events.*;
	import src.com.selfassessment.model.ChannelDO;
	import src.com.selfassessment.model.EnablerAssessmentDO;
	import src.com.selfassessment.model.EnablerDocumentDO;
	import src.com.selfassessment.model.PriorityDO;
	import src.com.selfassessment.model.ProjectDo;
	import src.com.selfassessment.model.ResultAssessmentDO;
	import src.com.selfassessment.model.ResultDocumentDO;
	import src.com.selfassessment.model.TeamAssessmentDO;
	import src.com.selfassessment.model.TeamDO;
	
	public class TeamController{
		
		[Bindable]
		public var CriteriaDO:RemoteObject;
		
		[Bindable]
		public var criteriaArray:Array = new Array();
		
		[Bindable]
		public var GuidanceDO:RemoteObject;
		
		[Bindable]
		public var RemoteObj:RemoteObject;
		
		[Bindable]
		public var Usernamearray:RemoteObject;
		
		[Bindable]
		public var teamObject:RemoteObject;

		[Bindable]
		public var teamdtlsObject:RemoteObject;
				
		
		public function TeamController(){
		}
		
		public function GetcriteriaList(callback: Function):void{
			
			CriteriaDO = new RemoteObject();
			var criteriaArray:Array = new Array();
			
			CriteriaDO.destination = "SAService";
			CriteriaDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				CriteriaDO.removeEventListener(ResultEvent.RESULT, listener);
	            criteriaArray = event.result as Array;
	            CursorManager.removeBusyCursor();
	            callback(criteriaArray);
			}
			
			/* Adding Events */
			CriteriaDO.getCriteriaID.addEventListener("result", listener);
    	    CriteriaDO.addEventListener("fault", faultListener);
            CriteriaDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            /*Doing actual function call */ 	
            CriteriaDO.getCriteriaID();
		}
		
		public function getGuidance(txtvalue:int,callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			var criteriaArray:Array = new Array();
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            criteriaArray = event.result as Array;
	            CursorManager.removeBusyCursor();
				callback(criteriaArray);
				
         	}
			
			/* Adding Events */
			GuidanceDO.getGuidance.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            
            /*Doing actual function call */ 	
            GuidanceDO.getGuidance(txtvalue);
			
		}
		
		public function getTeamAssessmentList(locationID:int,callback:Function):void{
			
			RemoteObj = new RemoteObject();
			
			var criteriaArray:Array = new Array();
			
			RemoteObj.destination = "SAService";
			RemoteObj.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
	            RemoteObj.removeEventListener(ResultEvent.RESULT, listener);
	            criteriaArray = event.result as Array;
				/* for(var i:int = 0; i < criteriaArray.length; i++){
					Alert.show("criteriaArray "+criteriaArray[i]["duedate"].toString());
				} */
				CursorManager.removeBusyCursor();
				callback(criteriaArray);
         	}
			
			RemoteObj.getSubTeamAssessmentList.addEventListener("result", listener);
    	    RemoteObj.addEventListener("fault", faultListener);
            RemoteObj.channelSet = ChannelDO.getInstance().setSessionChannel();
            RemoteObj.getSubTeamAssessmentList(locationID);
		}
		
		public function getTeamLeaderList(locationID:int,callback:Function):void{
			
			Usernamearray = new RemoteObject();
			
			var unamarray:Array = new Array();
			
			Usernamearray.destination = "SAService";
			Usernamearray.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				Usernamearray.removeEventListener(ResultEvent.RESULT,listener);
				unamarray = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(unamarray);
			}
			
			Usernamearray.getTeamLeaderList.addEventListener("result", listener);
    	    Usernamearray.addEventListener("fault", faultListener);
            Usernamearray.channelSet = ChannelDO.getInstance().setSessionChannel();
            
            Usernamearray.getTeamLeaderList(locationID);
		}
		
		public function getUserName(locationID:int,callback:Function):void{
			
			Usernamearray = new RemoteObject();
			
			var unamarray:Array = new Array();
			
			Usernamearray.destination = "SAService";
			Usernamearray.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				Usernamearray.removeEventListener(ResultEvent.RESULT,listener);
				unamarray = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(unamarray);
			}
			
			Usernamearray.getTeamLeaderListRegLocation.addEventListener("result", listener);
    	    Usernamearray.addEventListener("fault", faultListener);
            Usernamearray.channelSet = ChannelDO.getInstance().setSessionChannel();
            
            Usernamearray.getTeamLeaderListRegLocation(locationID);
		}
		public function createTeam(teamname:TeamDO,callback:Function):void{
			
			teamObject = new RemoteObject();
			
			var teamarray:Array = new Array();
			
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			teamObject.CreateTeam.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.CreateTeam(teamname);
		}
		
		
		public function getTeamdtls(teamName:String, userID:int,locationID:int,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var teamdltarray:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				teamdltarray = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(teamdltarray);
			}
			
			teamdtlsObject.getTeamDetails.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.getTeamDetails(teamName, userID ,locationID);
			
		}
		
		public function getRoleUserList(locationID:int,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var teamdltarray:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				teamdltarray = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(teamdltarray);
			}
			
			teamdtlsObject.getRoleDetails.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.getRoleDetails(locationID);
			
		}
		
		public function createProjectPlan(TeamName:TeamAssessmentDO,callback:Function):void{
			RemoteObj = new RemoteObject();
			
			var teamdltarray:Array = new Array();
			
			RemoteObj.destination = "SAService";
			RemoteObj.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				RemoteObj.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			
			RemoteObj.createProjectPlan.addEventListener("result",listener);
			RemoteObj.addEventListener("fault",faultListener);
			RemoteObj.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			RemoteObj.createProjectPlan(TeamName);
		}
		
		public function updateProjectPlan(TeamName:TeamAssessmentDO,callback:Function):void{
			RemoteObj = new RemoteObject();
			
			var teamdltarray:Array = new Array();
			
			RemoteObj.destination = "SAService";
			RemoteObj.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				RemoteObj.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			
			RemoteObj.updateProjectPlan.addEventListener("result",listener);
			RemoteObj.addEventListener("fault",faultListener);
			RemoteObj.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			RemoteObj.updateProjectPlan(TeamName);
		}
		
		public function deleteProjectPlan(activityID:Number,callback:Function):void{
			
			teamObject = new RemoteObject();
			
			var teamarray:Array = new Array();
			
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			teamObject.deleteProjectPlan.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.deleteProjectPlan(activityID);
		}
		
		public function createSubTeamAssessment(TeamName:EnablerAssessmentDO,callback:Function):void{
			RemoteObj = new RemoteObject();
			
			var teamdltarray:Array = new Array();
			
			RemoteObj.destination = "SAService";
			RemoteObj.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				RemoteObj.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			
			RemoteObj.insertEnablerAssessment.addEventListener("result",listener);
			RemoteObj.addEventListener("fault",faultListener);
			RemoteObj.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			RemoteObj.insertEnablerAssessment(TeamName);
		}
		
		public function updateEnablerAssessment(TeamName:EnablerAssessmentDO,callback:Function):void{
			RemoteObj = new RemoteObject();
			
			var teamdltarray:Array = new Array();
			
			RemoteObj.destination = "SAService";
			RemoteObj.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				RemoteObj.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			
			RemoteObj.updateEnablerAssessment.addEventListener("result",listener);
			RemoteObj.addEventListener("fault",faultListener);
			RemoteObj.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			RemoteObj.updateEnablerAssessment(TeamName);
		}
		
		
		public function updateResultAssessment(TeamName:ResultAssessmentDO,callback:Function):void{
			RemoteObj = new RemoteObject();
			
			var teamdltarray:Array = new Array();
			
			RemoteObj.destination = "SAService";
			RemoteObj.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				RemoteObj.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			
			RemoteObj.updateResultAssessment.addEventListener("result",listener);
			RemoteObj.addEventListener("fault",faultListener);
			RemoteObj.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			RemoteObj.updateResultAssessment(TeamName);
		}
		
		
		public function insertResultAssessment(TeamName:ResultAssessmentDO,callback:Function):void{
			RemoteObj = new RemoteObject();
			
			var teamdltarray:Array = new Array();
			
			RemoteObj.destination = "SAService";
			RemoteObj.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				RemoteObj.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			
			RemoteObj.insertResultAssessment.addEventListener("result",listener);
			RemoteObj.addEventListener("fault",faultListener);
			RemoteObj.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			RemoteObj.insertResultAssessment(TeamName);
		}
		
		public function getCriterialPartList(callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var teamdltarray:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				teamdltarray = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(teamdltarray);
			}
			
			teamdtlsObject.getCriterialPartList.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.getCriterialPartList();
			
		}
		
		public function getuniqueCriterialPartList(callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var teamdltarray:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				teamdltarray = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(teamdltarray);
			}
			
			teamdtlsObject.getuniqueCriterialPartList.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.getuniqueCriterialPartList();
			
		}
				
		
		
		public function assignPartID(permarr:Array,teamid:int,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var teamdltarray:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			
			teamdtlsObject.assignPartID.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.assignPartID(permarr,teamid);
			
		}
		
		
		public function selectTeamName(locationID:int,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var teamdltarray:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				teamdltarray = event.result as Array;
				CursorManager.removeBusyCursor();
				//Alert.show(event.result.toString());
				callback(teamdltarray);
			}
			
			teamdtlsObject.selectTeamName.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.selectTeamName(locationID);
			
		}
		
		public function selectTeamMember(teamID:int,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var teamdltarray:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				teamdltarray = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(teamdltarray);
			}
			
			teamdtlsObject.selectTeamMember.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.selectTeamMember(teamID);
			
		}
		
		public function unselectTeamMemeber(teamName:String,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var teamdltarray:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				teamdltarray = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(teamdltarray);
			}
			
			teamdtlsObject.unselectTeamMemeber.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.unselectTeamMemeber(teamName);
			
		}
		
		public function assignTeamMembers(permarr:Array,callback:Function):void{
			
			RemoteObj = new RemoteObject();
			var teamdltarray:Array = new Array();
			
			RemoteObj.destination = "SAService";
			RemoteObj.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				RemoteObj.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			
			RemoteObj.assignTeamMember.addEventListener("result",listener);
			RemoteObj.addEventListener("fault",faultListener);
			RemoteObj.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			RemoteObj.assignTeamMember(permarr);
			
		}
		
		public function searchTeamName(teamname:String,teamleader:String, callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var teamdltarray:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				teamdltarray = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(teamdltarray);
			}
			
			teamdtlsObject.searchTeamName.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.searchTeamName(teamname, teamleader);
			
		}
		
		public function selectSubAssessment(locationID:int,CriterionPartID:String,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var teamdltarray:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				//CursorManager.removeBusyCursor();
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				teamdltarray = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(teamdltarray);
			}
			
			teamdtlsObject.selectSubAssessment.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.selectSubAssessment(locationID,CriterionPartID);
			
		}
		
	 	public function getLinkageCriteria(EnablerID:int,CriteriaID:int,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var criteriaToLink:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				criteriaToLink = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(criteriaToLink);
			}
			
			teamdtlsObject.getLinkageCriteria.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.getLinkageCriteria(EnablerID,CriteriaID);
			
		} 
		
			
		public function removeTeamMemeber(permarr:Array,callback:Function):void{
			
			RemoteObj = new RemoteObject();
			var teamdltarray:Array = new Array();
			
			RemoteObj.destination = "SAService";
			RemoteObj.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				RemoteObj.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			
			RemoteObj.removeTeamMemeber.addEventListener("result",listener);
			RemoteObj.addEventListener("fault",faultListener);
			RemoteObj.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			RemoteObj.removeTeamMemeber(permarr);
			
		}
		
		public function UpdateTeam(teamname:TeamDO,callback:Function):void{
			
			teamObject = new RemoteObject();
			
			var teamarray:Array = new Array();
			
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			teamObject.UpdateTeam.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.UpdateTeam(teamname);
		}
		
		public function removeTeam(teamid:int,callback:Function):void{
			
			teamObject = new RemoteObject();
			
			var teamarray:Array = new Array();
			
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			teamObject.removeTeam.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.removeTeam(teamid);
		}
		
		public function removeCriteria(teamarray:Array, callback:Function):void{
			
			teamObject = new RemoteObject();
			
			var teamarray:Array = new Array();
			
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			teamObject.removeCriteria.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.removeCriteria(teamarray);
		}
		
		public function selectResultAssessment(locationID:int,CriterionPartID:String,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var teamdltarray:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				teamdltarray = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(teamdltarray);
			}
			
			teamdtlsObject.selectResultAssessment.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.selectResultAssessment(locationID,CriterionPartID);
			
		}
		
		public function updateCriteriaPartScore(locationID:int,subteamscore:Number,subteamavgscore:Number,criteriaShortDesc:String, criteriaID:int,callback:Function):void{
			
			teamObject = new RemoteObject();
			
			var teamarray:Array = new Array();
			
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
				
			}
			teamObject.updateCriteriaPartScore.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.updateCriteriaPartScore(locationID,subteamscore, subteamavgscore, criteriaShortDesc,criteriaID);
		}
		
		public function deleteResultAssessment(resultID:int,criteriaID:int,dummyResultID:int, callback:Function):void{
			
			teamObject = new RemoteObject();
			
			var teamarray:Array = new Array();
			
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			teamObject.deleteResultAssessment.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.deleteResultAssessment(resultID,criteriaID,dummyResultID);
		}
		
		public function deleteEnablerAssessment(enablerID:int,criterionID:int,dummyEnablerID:int, callback:Function):void{
			
			teamObject = new RemoteObject();
			
			var teamarray:Array = new Array();
			
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				Alert.show(event.result.toString());
				callback(event.result as Number);
			}
			teamObject.deleteEnablerAssessment.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.deleteEnablerAssessment(enablerID,criterionID,dummyEnablerID);
		}
		
		public function insertEnablerDocument(teamname:EnablerDocumentDO,callback:Function):void{
			
			teamObject = new RemoteObject();
			
			var teamarray:Array = new Array();
			
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				//Alert.show(event.result.toString());
				callback(event.result as Number);
			}
			teamObject.insertEnablerDocument.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.insertEnablerDocument(teamname);
		}
		
		public function selectEnablerDocument(CriterionPartID:String,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var teamdltarray:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				teamdltarray = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(teamdltarray);
			}
			
			teamdtlsObject.selectEnablerDocument.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.selectEnablerDocument(CriterionPartID);
			
		}
		
		public function deleteEnablerDocument(enablerID:int, callback:Function):void{
			
			teamObject = new RemoteObject();
			
			var teamarray:Array = new Array();
			
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			teamObject.deleteEnablerDocument.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.deleteEnablerDocument(enablerID);
		}
		
		
		public function insertResultDocument(teamname:ResultDocumentDO,callback:Function):void{
			
			teamObject = new RemoteObject();
			
			var teamarray:Array = new Array();
			
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			teamObject.insertResultDocument.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.insertResultDocument(teamname);
		}
		
		public function selectResultDocument(CriterionPartID:String,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			var teamdltarray:Array = new Array();
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				teamdltarray = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(teamdltarray);
			}
			
			teamdtlsObject.selectResultDocument.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.selectResultDocument(CriterionPartID);
			
		}
		
		public function getProjectDocuments(projectName:String,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			var teamdltarray:Array = new Array();
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				teamdltarray =  event.result as Array;
				//Alert.show(teamdltarray[0].toString());
				callback(teamdltarray);
			}
			
			teamdtlsObject.getProjectDocuments.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.getProjectDocuments(projectName);
		}
		
		
		public function deleteResultDocument(enablerID:int, callback:Function):void{
			
			teamObject = new RemoteObject();
			
			var teamarray:Array = new Array();
			
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			teamObject.deleteResultDocument.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.deleteResultDocument(enablerID);
		}
		
		public function getStatusDetails(callback: Function):void{
			
			
			GuidanceDO = new RemoteObject();
			
			var criteriaArray:Array = new Array();
			
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SALogin";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            criteriaArray = event.result as Array;
	            CursorManager.removeBusyCursor();
				callback(criteriaArray);
				
         	}
			
			/* Adding Events */
			GuidanceDO.getStatusDetails.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            
            /*Doing actual function call */ 	
            GuidanceDO.getStatusDetails();
			
		}
		
		public function insertStatus(Status:String,callback: Function):void{
			
			
			GuidanceDO = new RemoteObject();
			
			var criteriaArray:Array = new Array();
			
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SALogin";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            CursorManager.removeBusyCursor();
				callback(event.result as Number);
				
         	}
			
			/* Adding Events */
			GuidanceDO.insertStatus.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            
            /*Doing actual function call */ 	
            GuidanceDO.insertStatus(Status);
			
		}
		
		
		public function deleteStatus(Status:int,callback: Function):void{
			
			
			GuidanceDO = new RemoteObject();
			
			var criteriaArray:Array = new Array();
			
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SALogin";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            CursorManager.removeBusyCursor();
				callback(event.result as Number);
				
         	}
			
			/* Adding Events */
			GuidanceDO.deleteStatus.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            
            /*Doing actual function call */ 	
            GuidanceDO.deleteStatus(Status);
			
		}
		
		 public function getCriteriaList(userID:int,roleID:int,callback: Function):void{
			
			
			GuidanceDO = new RemoteObject();
			
			var criteriaArray:String;
			
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            //Alert.show(event.result.toString());
	            criteriaArray = event.result as String;
	            CursorManager.removeBusyCursor();
				callback(criteriaArray);
				
         	}
			GuidanceDO.getCriteriaList.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.getCriteriaList(userID,roleID);
			
		} 
		
		 public function addCriteriaLinkage(criteriaLink:Array,callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			
			//var criteriaArray:String;
			
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            CursorManager.removeBusyCursor();
	            callback(event.result as Number);
			}
			GuidanceDO.AddCriteriaLinkage.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.AddCriteriaLinkage(criteriaLink);
		} 
		
		public function faultListener(event:FaultEvent):void {
			Alert.show(event.fault.faultString);
			//Alert.show("Connection failed.Try again");
			CursorManager.removeAllCursors();
		}
		public function selectAllSubAssessment(locationID:int,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var enablerApproachDetails:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				enablerApproachDetails = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(enablerApproachDetails);
			}
			
			teamdtlsObject.selectAllSubAssessment.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.selectAllSubAssessment(locationID);
			
		}
		public function selectAllResultAssessment(locationID:int,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var resultApproachDetails:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				resultApproachDetails = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(resultApproachDetails);
			}
			
			teamdtlsObject.selectAllResultAssessment.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.selectAllResultAssessment(locationID);
			
		}
		public function getAssessmentComments(EnablerID:int,CriteriaID:int,Type:String,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var comments:String;
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				comments = event.result as String;
				CursorManager.removeBusyCursor();
				callback(comments);
			}
			
			teamdtlsObject.getAssessmentComments.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.getAssessmentComments(EnablerID,CriteriaID,Type);
			
		} 
		 /* public function AddComments(assessmentComments:EnablerAssessmentDO,callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			
			//var criteriaArray:String;
			
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            //Alert.show(event.result.toString());
	            callback(event.result as Number);
			}
			GuidanceDO.AddComments.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.AddComments(assessmentComments);
		}  */
		public function getAssessmentScorePoints(locationID:int,type:String,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var assessmentScorePoints:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				assessmentScorePoints = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(assessmentScorePoints);
			}
			
			teamdtlsObject.getAssessmentScorePoints.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.getAssessmentScorePoints(locationID,type);
			
		}
		public function getAssessmentTotalPoints(locationID:int,type:String,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var assessmentTotalPoints:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				assessmentTotalPoints = event.result as Array;
				CursorManager.removeBusyCursor();
				
				callback(assessmentTotalPoints);
			}
			
			teamdtlsObject.getAssessmentTotalPoints.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.getAssessmentTotalPoints(locationID,type);
			
		}
		public function getEnablerFeedbackScore(locationID:int,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var enablerFeedback:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				enablerFeedback = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(enablerFeedback);
			}
			
			teamdtlsObject.getEnablerFeedbackScore.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.getEnablerFeedbackScore(locationID);
			
		}
		 public function getResultFeedbackScore(locationID:int,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var resultFeedback:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				resultFeedback = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(resultFeedback);
			}
			
			teamdtlsObject.getResultFeedbackScore.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.getResultFeedbackScore(locationID);
			
		} 
		public function addEnablerDocument(teamname:EnablerDocumentDO,callback:Function):void{
			
			teamObject = new RemoteObject();
			
			var teamarray:Array = new Array();
			
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			teamObject.addEnablerDocument.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.addEnablerDocument(teamname);
		}
		public function addResultDocument(teamname:ResultDocumentDO,callback:Function):void{
			
			teamObject = new RemoteObject();
			
			var teamarray:Array = new Array();
			
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			teamObject.addResultDocument.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.addResultDocument(teamname);
		}
		public function getRootPath(callback:Function):void{
			
			teamObject = new RemoteObject();
			
			var rootPath:String;
			
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				rootPath=event.result as String;
				CursorManager.removeBusyCursor();
				callback(rootPath);
			}
			teamObject.getRootPath.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.getRootPath();
		}
		
		public function getCriteriaForActionPlan(userID:int,roleID:int,callback: Function):void{
			
			
			GuidanceDO = new RemoteObject();
			
			var criteriaArray:Array;
			
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            criteriaArray = event.result as Array;
	            CursorManager.removeBusyCursor();
				callback(criteriaArray);
				
         	}
			GuidanceDO.getCriteriaForActionPlan.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.getCriteriaForActionPlan(userID,roleID);
			
		} 
		
		
		public function deleteLocation(locationID:int,callback: Function):void{
			
			
			GuidanceDO = new RemoteObject();
			
			var criteriaArray:Array = new Array();
			
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SALogin";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            CursorManager.removeBusyCursor();
				callback(event.result as Number);
				
         	}
			
			/* Adding Events */
			GuidanceDO.deleteLocation.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            
            /*Doing actual function call */ 	
            GuidanceDO.deleteLocation(locationID);
			
		}
		
		public function viewScore(criteriaID:int,locationID:int,callback:Function):void{
			
			teamObject = new RemoteObject();
			
			var teamarray:Array = new Array();
			
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			//CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				//CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			teamObject.viewScore.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.viewScore(criteriaID,locationID);
		}
		 public function insertExeRoles(exeRoleArr:Array,callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			
			//var criteriaArray:String;
			
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SALogin";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            CursorManager.removeBusyCursor();
	            callback(event.result as Number);
			}
			GuidanceDO.insertExeRoles.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.insertExeRoles(exeRoleArr);
		} 
			public function unselectExecutiveMemeber(locationID:int,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var teamdltarray:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				teamdltarray = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(teamdltarray);
			}
			
			teamdtlsObject.unselectExecutiveMemeber.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.unselectExecutiveMemeber(locationID);
			
		}
		public function deleteExeRoles(exeRoleArr:Array,callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			
			//var criteriaArray:String;
			
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SALogin";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            CursorManager.removeBusyCursor();
	            callback(event.result as Number);
			}
			GuidanceDO.deleteExeRoles.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.deleteExeRoles(exeRoleArr);
		} 
		public function chkExeRoleExists(userID:int,callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			
			//var criteriaArray:String;
			
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SALogin";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            CursorManager.removeBusyCursor();
	            callback(event.result as Number);
			}
			GuidanceDO.chkExeRoleExists.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.chkExeRoleExists(userID);
		} 
		
		public function deleteSelectedExeRole(userID:int,callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			
			//var criteriaArray:String;
			
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SALogin";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            //Alert.show(event.result.toString());
	            callback(event.result as Number);
	            CursorManager.removeBusyCursor();
			}
			GuidanceDO.deleteSelectedExeRole.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.deleteSelectedExeRole(userID);
		} 
		
		public function AddComments(approachID:int,criteriaID:int,userID:int,roleID:int,comments:String,approachToLink:String,subTeamActions,callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			
			//var criteriaArray:String;
			
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            //Alert.show(event.result.toString());
	            callback(event.result as Number);
	            CursorManager.removeBusyCursor();
			}
			GuidanceDO.AddComments.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.AddComments(approachID,criteriaID,userID,roleID,comments,approachToLink,subTeamActions);
		} 
		
		public function viewExeComments(approachID:String,callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            callback(event.result as Array);
	            CursorManager.removeBusyCursor();
			}
			GuidanceDO.viewExeComments.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.viewExeComments(approachID);
		} 
		
		public function AddProject(projectDO:ProjectDo,callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	             callback(event.result as Number);
	            // Alert.show(event.result.toString());
	             CursorManager.removeBusyCursor();
			}
			GuidanceDO.AddProjectDetails.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.AddProjectDetails(projectDO);
		} 
		
		public function SelectResponsibilityPersons(callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            callback(event.result as Array);
	             CursorManager.removeBusyCursor();
			}
			GuidanceDO.SelectResponsibilityPersons.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.SelectResponsibilityPersons();
		} 
		public function AddProjectApproachLinkDetails(projectApproachArr:Array,callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            callback(event.result as Number);
	             CursorManager.removeBusyCursor();
			}
			GuidanceDO.AddProjectApproachLinkDetails.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.AddProjectApproachLinkDetails(projectApproachArr);
		}
		public function SelectAllProjects(callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            callback(event.result as Array);
	            CursorManager.removeBusyCursor();
			}
			GuidanceDO.SelectAllProjects.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.SelectAllProjects();
		} 
		public function UpdateProjectStatus(projectArr:Array,callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            callback(event.result as Number);
	            CursorManager.removeBusyCursor();
			}
			GuidanceDO.UpdateProjectStatus.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.UpdateProjectStatus(projectArr);
		} 
		
		public function UpdateProjectDetails(projectDo:ProjectDo,callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	           // Alert.show(event.result.toString());
	           CursorManager.removeBusyCursor();
	            callback(event.result as Number);
	            
			}
			GuidanceDO.UpdateProjectDetails.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.UpdateProjectDetails(projectDo);
		}
		
		public function updateprojectsPriority(value1:int, value2:int, value3:int, callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
				GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	           	CursorManager.removeBusyCursor();
	            callback(event.result as Number);
	            
			}
			GuidanceDO.updateprojectsPriority.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.updateprojectsPriority(value1, value2, value3 );
		}
		
		public function selectprojectsPriority(callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
				GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	           	CursorManager.removeBusyCursor();
	            callback(event.result as PriorityDO);
	            
			}
			GuidanceDO.selectprojectsPriority.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.selectprojectsPriority();
		} 
		public function SelectProjectProgressDetails(projectID:int,callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            callback(event.result as Array);
	            CursorManager.removeBusyCursor();
			}
			GuidanceDO.SelectProjectProgressDetails.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.SelectProjectProgressDetails(projectID);
		} 
		public function deleteProjectDetails(projectID:int,callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	            callback(event.result as Number);
	            CursorManager.removeBusyCursor();
			}
			GuidanceDO.projectDeletion.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.projectDeletion(projectID);
		} 
		public function selectProjectTeamMember(projectID:int,callback:Function):void{
			
			teamdtlsObject = new RemoteObject();
			
			var teamdltarray:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			
			var listener:Function = function(event:ResultEvent):void{
				
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				teamdltarray = event.result as Array;
				callback(teamdltarray);
			}
			
			teamdtlsObject.selectProjectTeamMember.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamdtlsObject.selectProjectTeamMember(projectID);
			
		}
		
		public function updateProjectTeamMembers(projectArr:Array,projectID:int,teamName:String,callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	           // Alert.show(event.result.toString());
	            callback(event.result as Number);
	            CursorManager.removeBusyCursor();
			}
			GuidanceDO.updateProjectTeamMembers.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.updateProjectTeamMembers(projectArr,projectID,teamName);
		} 
		public function selectProjectTeamNameList(callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	           // Alert.show(event.result.toString());
	            callback(event.result as Array);
	            CursorManager.removeBusyCursor();
			}
			GuidanceDO.selectProjectTeamNameList.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.selectProjectTeamNameList();
		} 
		public function SearchProjects(projectName:String,priority:String,callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	           //Alert.show(event.result.toString());
	            callback(event.result as Array);
	            CursorManager.removeBusyCursor();
			}
			GuidanceDO.SearchProjects.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.SearchProjects(projectName,priority);
		}
		
		public function SearchProjectReports(title:String,status:String,callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	           //Alert.show(event.result.toString());
	            callback(event.result as Array);
	            CursorManager.removeBusyCursor();
			}
			GuidanceDO.SearchProjectReports.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.SearchProjectReports(title,status);
		}
		 
		public function chkProjRespExists(userID:int,callback: Function):void{
			
			GuidanceDO = new RemoteObject();
			GuidanceDO.destination = "SAService";
			GuidanceDO.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener : Function = function(event:ResultEvent):void {
				
	            GuidanceDO.removeEventListener(ResultEvent.RESULT, listener);
	           // Alert.show(event.result.toString());
	            callback(event.result as Number);
	            CursorManager.removeBusyCursor();
			}
			GuidanceDO.chkProjRespExists.addEventListener("result", listener);
    	    GuidanceDO.addEventListener("fault", faultListener);
            GuidanceDO.channelSet = ChannelDO.getInstance().setSessionChannel();
            GuidanceDO.chkProjRespExists(userID);
		} 
		public function SelectProjectApproachLinkDetails(callback:Function):void{
			teamdtlsObject = new RemoteObject();
			var teamdltarray:Array = new Array();
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			var listener:Function = function(event:ResultEvent):void{
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				//Alert.show(event.result.toString())
				teamdltarray = event.result as Array;
				callback(teamdltarray);
			}
			teamdtlsObject.SelectProjectApproachLinkDetails.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			teamdtlsObject.SelectProjectApproachLinkDetails();
		}
		public function SelectAttachedDocReport(word:String,callback:Function):void{
			teamdtlsObject = new RemoteObject();
			var teamdltarray:Array = new Array();
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				//Alert.show(event.result.toString());
				teamdltarray = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(teamdltarray);
			}
			teamdtlsObject.SelectAttachedDocReport.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			teamdtlsObject.SelectAttachedDocReport(word);
		}
		public function SelectSourceOfInformation(word:String,callback:Function):void{
			teamdtlsObject = new RemoteObject();
			var teamdltarray:Array = new Array();
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				//Alert.show(event.result.toString())
				teamdltarray = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(teamdltarray);
			}
			teamdtlsObject.SelectSourceOfInformation.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			teamdtlsObject.SelectSourceOfInformation(word);
		}
		public function SelectAllApproaches(locationID,callback:Function):void{
			teamdtlsObject = new RemoteObject();
			var teamdltarray:Array = new Array();
			
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				teamdltarray = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(teamdltarray);
			}
			
			teamdtlsObject.SelectAllApproaches.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			teamdtlsObject.SelectAllApproaches(locationID);
			
		}
		
		public function insertProjectDocument(projectName:String,fileName:String,fileDesc:String,callback:Function):void{
			
			teamObject = new RemoteObject();
			
			//var teamarray:Array = new Array();
			
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				
				callback(event.result as Number);
			}
			teamObject.insertProjectDocument.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.insertProjectDocument(projectName,fileName,fileDesc);
		}
		
		public function deleteProjectDocument(projectID:String,callback:Function):void{
			
			teamObject = new RemoteObject();
			
			//var teamarray:Array = new Array();
			
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				
				callback(event.result as Number);
			}
			teamObject.deleteProjectDocument.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.deleteProjectDocument(projectID);
		}
		
		public function selectStrength(approachID:int,type:String,callback:Function):void{
			
			teamObject = new RemoteObject();
			
				
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				//Alert.show(event.result.toString());
				callback(event.result as Array);
			}
			teamObject.selectStrength.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.selectStrength(approachID,type);
		}
		public function selectAFI(approachID:int,type:String,callback:Function):void{
			
			teamObject = new RemoteObject();
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				//Alert.show(event.result.toString());
				callback(event.result as Array);
			}
			teamObject.selectAFI.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			teamObject.selectAFI(approachID,type);
		}
		public function insertStrength(strengthArr:Array,approachID:int,type:String,callback:Function):void{
			teamObject = new RemoteObject();
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			teamObject.insertStrength.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.insertStrength(strengthArr,approachID,type);
		}
		public function insertAFI(afiArr:Array,approachID:int,type:String,callback:Function):void{
			teamObject = new RemoteObject();
			teamObject.destination = "SAService";
			teamObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				teamObject.removeEventListener(ResultEvent.RESULT, listener);
				CursorManager.removeBusyCursor();
				callback(event.result as Number);
			}
			teamObject.insertAFI.addEventListener("result",listener);
			teamObject.addEventListener("fault",faultListener);
			teamObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			teamObject.insertAFI(afiArr,approachID,type);
		}
		public function selectMissingApproaches(callback:Function):void{
			teamdtlsObject = new RemoteObject();
			var assessmentArr:Array = new Array();
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				//Alert.show(event.result.toString())
				assessmentArr = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(assessmentArr);
			}
			teamdtlsObject.selectMissingApproaches.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			teamdtlsObject.selectMissingApproaches();
		}
		public function getProjectApproachDetails(projectID:int,callback:Function):void{
			teamdtlsObject = new RemoteObject();
			var projectApproachArr:Array = new Array();
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				//Alert.show(event.result.toString())
				projectApproachArr = event.result as Array;
				CursorManager.removeBusyCursor();
				callback(projectApproachArr);
			}
			teamdtlsObject.getProjectApproachDetails.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			teamdtlsObject.getProjectApproachDetails(projectID);
		}
		public function sendRequestProgressMail(fromMailID:String,responsibility:int,message:String,callback:Function):void{
			teamdtlsObject = new RemoteObject();
			var projectApproachArr:Array = new Array();
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				//Alert.show(event.result.toString())
				CursorManager.removeBusyCursor();
				callback(event.result.toString());
			}
			teamdtlsObject.sendRequestProgressMail.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			teamdtlsObject.sendRequestProgressMail(fromMailID,responsibility,message);
		}
		public function viewOverAllComments(criteriaID:int,callback:Function):void{
			teamdtlsObject = new RemoteObject();
			var projectApproachArr:Array = new Array();
			teamdtlsObject.destination = "SAService";
			teamdtlsObject.source = "SATeam";
			CursorManager.setBusyCursor();
			var listener:Function = function(event:ResultEvent):void{
				teamdtlsObject.removeEventListener(ResultEvent.RESULT, listener);
				var commentsArr:Array=event.result as Array;
				CursorManager.removeBusyCursor();
				callback(commentsArr);
			}
			teamdtlsObject.viewOverAllComments.addEventListener("result",listener);
			teamdtlsObject.addEventListener("fault",faultListener);
			teamdtlsObject.channelSet = ChannelDO.getInstance().setSessionChannel();
			teamdtlsObject.viewOverAllComments(criteriaID);
		}
	}
}