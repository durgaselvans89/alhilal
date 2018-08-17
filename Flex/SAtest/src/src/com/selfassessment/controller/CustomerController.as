    package src.com.selfassessment.controller
{
	import mx.collections.ArrayCollection;
	import mx.controls.Alert;
	import mx.managers.CursorManager;
	import mx.rpc.events.FaultEvent;
	import mx.rpc.events.ResultEvent;
	import mx.rpc.remoting.RemoteObject;
	
	import src.com.selfassessment.model.ChannelDO;
	import src.com.selfassessment.model.CustomerDO;
	
	public class CustomerController
	{
		
		[Bindable]
		public var CustomerRO:RemoteObject;
		
		public function CustomerController()
		{
		}
		
		public function createUser(customerDetails: CustomerDO, callback: Function ):void
		{
			
			CustomerRO = new RemoteObject();
        	CustomerRO.destination = "SAService";
        	CustomerRO.source="SACustomers";
        	CursorManager.setBusyCursor();
            /* Listener function declared for waiting for function result */
			var listener : Function = function(event : ResultEvent) : void {
	            CustomerRO.removeEventListener(ResultEvent.RESULT, listener);
	            //Alert.show(event.result.toString());
	            
	        	CursorManager.removeBusyCursor();
				callback(event.result as Number);
         	}
			
			/* Adding Events */
			CustomerRO.AddCustomer.addEventListener("result", listener);
    	    CustomerRO.addEventListener("fault", faultListener);
			CustomerRO.channelSet = ChannelDO.getInstance().setSessionChannel();
            
            /*Doing actual function call */ 	
            CustomerRO.AddCustomer(customerDetails);
             	
        }
		
		public function GetSrchResults(userName:String, Designation: String, Role: int, Srchcallback: Function):void {
		
			CustomerRO = new RemoteObject();
        	CustomerRO.destination = "SAService";
        	CustomerRO.source="SACustomers";
        	CursorManager.setBusyCursor();
           	
        	var srchResultsArray:ArrayCollection;
        	
        	var Srchlistener : Function = function(event : ResultEvent): void{
            
            CustomerRO.removeEventListener(ResultEvent.RESULT, Srchlistener);
	            srchResultsArray = new ArrayCollection( event.result as Array);
	           	CursorManager.removeBusyCursor();
	           	Srchcallback(event.result as Array);
         	}
         	
         	/* Adding Events */
			CustomerRO.SearchCustomers.addEventListener("result", Srchlistener);
    	    CustomerRO.addEventListener("fault", faultListener);
			CustomerRO.channelSet = ChannelDO.getInstance().setSessionChannel();    	    
    	    
            
        	/*Doing actual function call */ 	
            CustomerRO.SearchCustomers(userName,Designation,Role);
        	
		}
		
		public function GetExeTeam(Execallback: Function):void {
		
			CustomerRO = new RemoteObject();
        	CustomerRO.destination = "SAService";
        	CustomerRO.source="SACustomers";
        	CursorManager.setBusyCursor();
           	
        	var exeTeamArray:ArrayCollection;
        	
        	var Teamlistener : Function = function(event : ResultEvent): void{
            
           	CustomerRO.removeEventListener(ResultEvent.RESULT, Teamlistener);
	            exeTeamArray = new ArrayCollection( event.result as Array);
	           	CursorManager.removeBusyCursor();
	           	Execallback(event.result as Array);
         	}
         	
         	/* Adding Events */
			CustomerRO.GetExecutiveTeam.addEventListener("result", Teamlistener);
    	    CustomerRO.addEventListener("fault", faultListener);
			CustomerRO.channelSet = ChannelDO.getInstance().setSessionChannel();
			    	 
    	 	/*Doing actual function call */ 	
            CustomerRO.GetExecutiveTeam();
        	
		}
		
		public function deleteUser(UserID:int,RoleID:int,delcallback: Function):void {
		
			CustomerRO = new RemoteObject();
        	CustomerRO.destination = "SAService";
        	CustomerRO.source="SACustomers";
        	CursorManager.setBusyCursor();
          
            var Dellistener : Function = function(event : ResultEvent): void{
            
            CustomerRO.removeEventListener(ResultEvent.RESULT, Dellistener);
            		//Alert.show("sdfd "+event.result.toString());
	           	var status:int = event.result as int;
	           
	           	CursorManager.removeBusyCursor();
	           	delcallback(status);
	       	}
         	
         	/* Adding Events */
			CustomerRO.deleteCustomer.addEventListener("result", Dellistener);
    	    CustomerRO.addEventListener("fault", faultListener);
			CustomerRO.channelSet = ChannelDO.getInstance().setSessionChannel();
			    	 
    	 	/*Doing actual function call */ 	
            CustomerRO.deleteCustomer(UserID,RoleID);
        	
		}

		
		public function Getuserdetails(Username:String, usrdetailscallback: Function):void {
		
			CustomerRO = new RemoteObject();
        	CustomerRO.destination = "SAService";
        	CustomerRO.source="SACustomers";
        	CursorManager.setBusyCursor();
           	
        	var CustomerDetails:CustomerDO = new CustomerDO;
        	
        	var usrdetailslistener : Function = function(event : ResultEvent): void{
            
            CustomerRO.removeEventListener(ResultEvent.RESULT, usrdetailslistener);
	            CustomerDetails = event.result.valueOf();
	           	CursorManager.removeBusyCursor();
	           	usrdetailscallback(CustomerDetails);
         	}
         	
         	/* Adding Events */
			CustomerRO.GetCusDetails.addEventListener("result", usrdetailslistener);
    	    CustomerRO.addEventListener("fault", faultListener);
			CustomerRO.channelSet = ChannelDO.getInstance().setSessionChannel();
			    	 
    	 	/*Doing actual function call */ 	
            CustomerRO.GetCusDetails(Username);
        	
		}
		
		public function Updateusers(customerDetails: CustomerDO, callback: Function ):void
		{
			
			CustomerRO = new RemoteObject();
        	CustomerRO.destination = "SAService";
        	CustomerRO.source="SACustomers";
        	CursorManager.setBusyCursor();
            /* Listener function declared for waiting for function result */
			var Updatelistener : Function = function(event : ResultEvent) : void {
            
	            CustomerRO.removeEventListener(ResultEvent.RESULT, Updatelistener);
	        	
	        	var status:String = event.result.valueOf();
	        	CursorManager.removeBusyCursor();
	        	//Alert.show(event.result.toString());
				callback(parseInt(status));
         	}
			
			/* Adding Events */
			CustomerRO.UpdateCustomers.addEventListener("result", Updatelistener);
    	    CustomerRO.addEventListener("fault", faultListener);
            CustomerRO.channelSet = ChannelDO.getInstance().setSessionChannel();
            
            /*Doing actual function call */ 	
            CustomerRO.UpdateCustomers(customerDetails);
            
        }
		public function searchPwd(emailID:String, callback: Function):void {
			CustomerRO = new RemoteObject();
        	CustomerRO.destination = "SAService";
        	CustomerRO.source="SACustomers";
        	CursorManager.setBusyCursor();
            var usrdetailslistener : Function = function(event : ResultEvent): void{
            	CustomerRO.removeEventListener(ResultEvent.RESULT, usrdetailslistener);
            	CursorManager.removeBusyCursor();
	           	callback(event.result.toString());
         	}
         	/* Adding Events */
			CustomerRO.searchPwd.addEventListener("result", usrdetailslistener);
    	    CustomerRO.addEventListener("fault", faultListener);
			CustomerRO.channelSet = ChannelDO.getInstance().setSessionChannel();
			/*Doing actual function call */ 	
            CustomerRO.searchPwd(emailID);
           
        	
		}
		private function faultListener(event:FaultEvent):void {
				//Alert.show(event.fault.faultString);
				Alert.show("Connection failed.Try again");
				CursorManager.removeAllCursors();
		}
				

	}
}