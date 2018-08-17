package src.com.selfassessment.controller
{
	import mx.controls.Alert;
	import mx.managers.CursorManager;
	import mx.rpc.events.FaultEvent;
	import mx.rpc.events.ResultEvent;
	import mx.rpc.remoting.RemoteObject;
	
	import src.com.selfassessment.model.ChannelDO;
	import src.com.selfassessment.model.MeetingDO;
	
	public class MeetingController
	{
		[Bindable]
		public var remoteobject:RemoteObject;
		
		public function MeetingController(){
		}
		
		public function createMeeting(meetingdo:MeetingDO,callback:Function):void{
			
			remoteobject = new RemoteObject();
        	remoteobject.destination = "SAService";
        	remoteobject.source = "SAMeeting";
        	CursorManager.setBusyCursor();
        	
			var listener:Function = function(event:ResultEvent):void{
	            remoteobject.removeEventListener(ResultEvent.RESULT, listener);
	        	CursorManager.removeBusyCursor();
	        	//Alert.show(event.result.toString());
				callback(event.result as Number);
         	}
			remoteobject.insertMeetingDtls.addEventListener("result", listener);
    	    remoteobject.addEventListener("fault", faultListener);
			remoteobject.channelSet = ChannelDO.getInstance().setSessionChannel();
            remoteobject.insertMeetingDtls(meetingdo);
		}
		public function insertAgendaDtls(agendaArr:Array,callback:Function):void{
			
			remoteobject = new RemoteObject();
        	remoteobject.destination = "SAService";
        	remoteobject.source = "SAMeeting";
        	CursorManager.setBusyCursor();
        	
			var listener:Function = function(event:ResultEvent):void{
	            remoteobject.removeEventListener(ResultEvent.RESULT, listener);
	        	CursorManager.removeBusyCursor();
	        	//Alert.show(event.result.toString());
				callback(event.result as Number);
         	}
			remoteobject.insertAgendaDtls.addEventListener("result", listener);
    	    remoteobject.addEventListener("fault", faultListener);
			remoteobject.channelSet = ChannelDO.getInstance().setSessionChannel();
            remoteobject.insertAgendaDtls(agendaArr);
		}
		
		public function updateAgendaDtls(agendaArr:Array,callback:Function):void{
			
			remoteobject = new RemoteObject();
        	remoteobject.destination = "SAService";
        	remoteobject.source = "SAMeeting";
        	CursorManager.setBusyCursor();
        	
			var listener:Function = function(event:ResultEvent):void{
	            remoteobject.removeEventListener(ResultEvent.RESULT, listener);
	        	CursorManager.removeBusyCursor();
	        	//Alert.show(event.result.toString());
				callback(event.result as Number);
         	}
			remoteobject.updateAgendaDtls.addEventListener("result", listener);
    	    remoteobject.addEventListener("fault", faultListener);
			remoteobject.channelSet = ChannelDO.getInstance().setSessionChannel();
            remoteobject.updateAgendaDtls(agendaArr);
		}
		
		public function getUsersList(callback:Function):void{
   			remoteobject = new RemoteObject();
	         remoteobject.destination = "SAService";
	         remoteobject.source = "SAMeeting";
	         CursorManager.setBusyCursor();
	         var resultArray:Array = new Array();
	  		 var listener:Function = function(event:ResultEvent):void{
	             	remoteobject.removeEventListener(ResultEvent.RESULT, listener);
	             	
	          		CursorManager.removeBusyCursor();
	          		resultArray = event.result as Array;
	    			callback(resultArray);
          	}
	   		remoteobject.getUsersList.addEventListener("result", listener);
	        remoteobject.addEventListener("fault", faultListener);
	   		remoteobject.channelSet = ChannelDO.getInstance().setSessionChannel();
           remoteobject.getUsersList();
	  	}
	  	public function insertMeetingParticipants(participantsArr:Array,callback:Function):void{
			
			remoteobject = new RemoteObject();
        	remoteobject.destination = "SAService";
        	remoteobject.source = "SAMeeting";
        	CursorManager.setBusyCursor();
        	
			var listener:Function = function(event:ResultEvent):void{
	            remoteobject.removeEventListener(ResultEvent.RESULT, listener);
	        	CursorManager.removeBusyCursor();
	        	//Alert.show(event.result.toString());
				callback(event.result as Number);
         	}
			remoteobject.insertMeetingParticipants.addEventListener("result", listener);
    	    remoteobject.addEventListener("fault", faultListener);
			remoteobject.channelSet = ChannelDO.getInstance().setSessionChannel();
            remoteobject.insertMeetingParticipants(participantsArr);
		}
		public function searchMeetingDtls(fromDate:String,toDate:String,chkValue:String,callback:Function):void{
   			remoteobject = new RemoteObject();
	         remoteobject.destination = "SAService";
	         remoteobject.source = "SAMeeting";
	         CursorManager.setBusyCursor();
	         var resultArray:Array = new Array();
	  		 var listener:Function = function(event:ResultEvent):void{
	             	remoteobject.removeEventListener(ResultEvent.RESULT, listener);
	          		CursorManager.removeBusyCursor();
	          		resultArray = event.result as Array;
	    			callback(resultArray);
          	}
	   		remoteobject.searchMeetingDtls.addEventListener("result", listener);
	        remoteobject.addEventListener("fault", faultListener);
	   		remoteobject.channelSet = ChannelDO.getInstance().setSessionChannel();
           remoteobject.searchMeetingDtls(fromDate,toDate,chkValue);
	  	}
	  	public function searchAgendaDtls(meetingID:int,callback:Function):void{
   			remoteobject = new RemoteObject();
	         remoteobject.destination = "SAService";
	         remoteobject.source = "SAMeeting";
	         CursorManager.setBusyCursor();
	         var resultArray:Array = new Array();
	  		 var listener:Function = function(event:ResultEvent):void{
	             	remoteobject.removeEventListener(ResultEvent.RESULT, listener);
	          		CursorManager.removeBusyCursor();
	          		resultArray = event.result as Array;
	    			callback(resultArray);
          	}
	   		remoteobject.searchAgendaDtls.addEventListener("result", listener);
	        remoteobject.addEventListener("fault", faultListener);
	   		remoteobject.channelSet = ChannelDO.getInstance().setSessionChannel();
            remoteobject.searchAgendaDtls(meetingID);
	  	}
	  	
	  	public function updateMeetingCompletedStatus(meetingID:int,callback:Function):void{
   			 remoteobject = new RemoteObject();
	         remoteobject.destination = "SAService";
	         remoteobject.source = "SAMeeting";
	         CursorManager.setBusyCursor();
	         var result:Number = new Number();
	         
	  		 var listener:Function = function(event:ResultEvent):void{
	             	remoteobject.removeEventListener(ResultEvent.RESULT, listener);
	          		CursorManager.removeBusyCursor();
	          		//Alert.show(event.result.toString());
			
	          		result = event.result as Number;
	    			callback(result);
          	}
          	
	   		remoteobject.updateMeetingCompletedStatus.addEventListener("result", listener);
	        remoteobject.addEventListener("fault", faultListener);
	   		remoteobject.channelSet = ChannelDO.getInstance().setSessionChannel();
            remoteobject.updateMeetingCompletedStatus(meetingID);
	  	}
	  	
	  	public function updateMeetingStatus(meetingArr:Array,callback:Function):void{
   			remoteobject = new RemoteObject();
	         remoteobject.destination = "SAService";
	         remoteobject.source = "SAMeeting";
	         CursorManager.setBusyCursor();
	         var resultArray:Array = new Array();
	  		 var listener:Function = function(event:ResultEvent):void{
	             	remoteobject.removeEventListener(ResultEvent.RESULT, listener);
	          		CursorManager.removeBusyCursor();
	          		//Alert.show(event.result.toString());
	          		callback(event.result as Number);
          	}
	   		remoteobject.updateMeetingStatus.addEventListener("result", listener);
	        remoteobject.addEventListener("fault", faultListener);
	   		remoteobject.channelSet = ChannelDO.getInstance().setSessionChannel();
           remoteobject.updateMeetingStatus(meetingArr);
	  	}
	  	public function selectPoints(meetingID:int,agendaID:int,callback:Function):void{
   			remoteobject = new RemoteObject();
	         remoteobject.destination = "SAService";
	         remoteobject.source = "SAMeeting";
	         CursorManager.setBusyCursor();
	         var resultArray:Array = new Array();
	  		 var listener:Function = function(event:ResultEvent):void{
	             	remoteobject.removeEventListener(ResultEvent.RESULT, listener);
	          		CursorManager.removeBusyCursor();
	          		resultArray = event.result as Array;
	    			callback(resultArray);
          	}
	   		remoteobject.selectPoints.addEventListener("result", listener);
	        remoteobject.addEventListener("fault", faultListener);
	   		remoteobject.channelSet = ChannelDO.getInstance().setSessionChannel();
           remoteobject.selectPoints(meetingID,agendaID);
	  	}
	  	public function insertAgendaPoints(pointsArr:Array,callback:Function):void{
			
			remoteobject = new RemoteObject();
        	remoteobject.destination = "SAService";
        	remoteobject.source = "SAMeeting";
        	CursorManager.setBusyCursor();
        	
			var listener:Function = function(event:ResultEvent):void{
	            remoteobject.removeEventListener(ResultEvent.RESULT, listener);
	        	CursorManager.removeBusyCursor();
	        	//Alert.show(event.result.toString());
				callback(event.result as Number);
         	}
			remoteobject.insertAgendaPoints.addEventListener("result", listener);
    	    remoteobject.addEventListener("fault", faultListener);
			remoteobject.channelSet = ChannelDO.getInstance().setSessionChannel();
            remoteobject.insertAgendaPoints(pointsArr);
		}
		public function selectInvitedParticipants(meetingID:int,callback:Function):void{
			
			remoteobject = new RemoteObject();
        	remoteobject.destination = "SAService";
        	remoteobject.source = "SAMeeting";
        	CursorManager.setBusyCursor();
        	
			var listener:Function = function(event:ResultEvent):void{
	            remoteobject.removeEventListener(ResultEvent.RESULT, listener);
	        	CursorManager.removeBusyCursor();
	        	callback(event.result as Array);
         	}
			remoteobject.selectInvitedParticipants.addEventListener("result", listener);
    	    remoteobject.addEventListener("fault", faultListener);
			remoteobject.channelSet = ChannelDO.getInstance().setSessionChannel();
            remoteobject.selectInvitedParticipants(meetingID);
		}
		public function faultListener(event:FaultEvent):void {
			Alert.show(event.fault.faultString);
			CursorManager.removeAllCursors();
		}
	}
}
