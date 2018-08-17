package src.com.selfassessment.controller{
	
	import mx.controls.Alert;
	import mx.managers.CursorManager;
	import mx.rpc.events.FaultEvent;
	import mx.rpc.events.ResultEvent;
	import mx.rpc.remoting.RemoteObject;
	import mx.utils.ArrayUtil;
	
	import src.com.selfassessment.model.ChannelDO;
		
	
	public class Controller{
		
		[Bindable]
		public var LoginRO:RemoteObject = new RemoteObject();
		        
		public function Controller(){}
		
		public function validateLogin( userName:String, password: String, callback: Function ):void
		{
			LoginRO.destination = "SAService";
        	LoginRO.source="SALogin";
        	
			LoginRO.channelSet = ChannelDO.getInstance().setSessionChannel();
        	
			var listener : Function = function(event : ResultEvent) : void {
            
	            LoginRO.removeEventListener(ResultEvent.RESULT, listener);    
	          	//Alert.show(event.result.toString());
	          	Components.instance.session = LoginRO.validateAPPLogin.lastResult.valueOf();
	          //	Alert.show("Function Called");
				callback();
         	}
			//Alert.show(ChannelDO.getInstance().setSessionChannel().toString());
			LoginRO.validateAPPLogin.addEventListener("result", listener);
    	    LoginRO.addEventListener("fault", faultListener);
            
            LoginRO.validateAPPLogin(userName,password);
		}
		
		public function GetRoleDetails(callback: Function):void{
			
			LoginRO.destination = "SAService";
        	LoginRO.source="SALogin";
        	CursorManager.setBusyCursor();
           	           	
			var resultListener : Function = function(event:ResultEvent) : void {
		    
	            Components.instance.roleValues = ArrayUtil.toArray(event.result) ;
	          	callback(event.result as Array);
         	}
			  
			LoginRO.getRoleDetails.addEventListener("result", resultListener);
    	    LoginRO.addEventListener("fault", faultListener);
			LoginRO.channelSet = ChannelDO.getInstance().setSessionChannel();
			
            LoginRO.getRoleDetails();
        }
        
        
        public function insertRole(RoleName:String, RoleType:String, RoleTypeDescription:String,callback: Function):void{
			
			LoginRO.destination = "SAService";
        	LoginRO.source="SALogin";
        	CursorManager.setBusyCursor();
           	
           	
			var resultListener : Function = function(event:ResultEvent) : void {
		    
	            Components.instance.roleValues = ArrayUtil.toArray(event.result) ;
	            //Alert.show(event.result.toString());
	          	callback(event.result as Number);
         	}
			
			LoginRO.insertRole.addEventListener("result", resultListener);
    	    LoginRO.addEventListener("fault", faultListener);
			LoginRO.channelSet = ChannelDO.getInstance().setSessionChannel();
			
            LoginRO.insertRole(RoleName, RoleType, RoleTypeDescription);
        }
        
        public function deleteRole(Roleid:int,callback: Function):void{
			
			LoginRO.destination = "SAService";
        	LoginRO.source="SALogin";
        	CursorManager.setBusyCursor();
           	
           	
			var resultListener : Function = function(event:ResultEvent) : void {
		    
	            Components.instance.roleValues = ArrayUtil.toArray(event.result) ;
	            //Alert.show(event.result.toString());
	          	callback(event.result as Number);
         	}
			
			LoginRO.deleteRole.addEventListener("result", resultListener);
    	    LoginRO.addEventListener("fault", faultListener);
			LoginRO.channelSet = ChannelDO.getInstance().setSessionChannel();
			
            LoginRO.deleteRole(Roleid);
        }
        
         public function insertLocationDetails(Location:String,callback: Function):void{
			
			LoginRO.destination = "SAService";
        	LoginRO.source="SALogin";
        	CursorManager.setBusyCursor();
           	
           	
			var resultListener : Function = function(event:ResultEvent) : void {
		    
	            Components.instance.roleValues = ArrayUtil.toArray(event.result) ;
	            callback(event.result as Number);
         	}
			
			LoginRO.insertLocation.addEventListener("result", resultListener);
    	    LoginRO.addEventListener("fault", faultListener);
			LoginRO.channelSet = ChannelDO.getInstance().setSessionChannel();
			
            LoginRO.insertLocation(Location);
        }
        
        
		public function GetLocationDetails(callback: Function):void{
			
			LoginRO.destination = "SAService";
        	LoginRO.source="SALogin";
        	CursorManager.setBusyCursor();
           	           	
			var resultListener : Function = function(event:ResultEvent) : void {
		    
	            Components.instance.roleValues = ArrayUtil.toArray(event.result) ;
	          	callback(event.result as Array);
         	}
			  
			LoginRO.selectLocationDetails.addEventListener("result", resultListener);
    	    LoginRO.addEventListener("fault", faultListener);
			LoginRO.channelSet = ChannelDO.getInstance().setSessionChannel();
			
            LoginRO.selectLocationDetails();
        }
   

/*   
   		public function customerDetails(callback:Function):void {
			
			LoginRO.destination = "SAService";
			LoginRO.source = "HHTRoute";
			
			LoginRO.channelSet = ChannelDO.getInstance().setSessionChannel();
			
			var listener : Function = function(event : ResultEvent):void {
            
	            LoginRO.removeEventListener(ResultEvent.RESULT, listener);    
				callback(ArrayUtil.toArray(event.result));
         	}
         	
			LoginRO.Treedata.addEventListener("result", listener);
    	    LoginRO.addEventListener("fault", faultListener);
            
            LoginRO.Treedata();
		} */
		public function getDesignationList(callback: Function):void{
			
			LoginRO.destination = "SAService";
        	LoginRO.source="SALogin";
        	CursorManager.setBusyCursor();
           	           	
			var resultListener : Function = function(event:ResultEvent) : void {
		    
	            callback(event.result as Array);
         	}
			  
			LoginRO.getDesignationList.addEventListener("result", resultListener);
    	    LoginRO.addEventListener("fault", faultListener);
			LoginRO.channelSet = ChannelDO.getInstance().setSessionChannel();
			
            LoginRO.getDesignationList();
        }
        public function getExeRoles(callback: Function):void{
			
			LoginRO.destination = "SAService";
        	LoginRO.source="SALogin";
        	CursorManager.setBusyCursor();
           	           	
			var resultListener : Function = function(event:ResultEvent) : void {
		    
	           callback(event.result as Array);
         	}
			  
			LoginRO.getExeRoles.addEventListener("result", resultListener);
    	    LoginRO.addEventListener("fault", faultListener);
			LoginRO.channelSet = ChannelDO.getInstance().setSessionChannel();
			
            LoginRO.getExeRoles();
        }
		private function faultListener(event:FaultEvent):void {
				//Alert.show(event.message.toString());
				Alert.show("Connection failed.Try again");
				CursorManager.removeAllCursors();
		}
		public function selectRoleType(callback: Function):void{
			
			LoginRO.destination = "SAService";
        	LoginRO.source="SALogin";
        	CursorManager.setBusyCursor();
           	           	
			var resultListener : Function = function(event:ResultEvent) : void {
		    	CursorManager.removeAllCursors();
	            callback(event.result as Array);
         	}
			  
			LoginRO.selectRoleType.addEventListener("result", resultListener);
    	    LoginRO.addEventListener("fault", faultListener);
			LoginRO.channelSet = ChannelDO.getInstance().setSessionChannel();
			
            LoginRO.selectRoleType();
        }
		protected function handleComplete():void
        {
            dispatchEvent(new Event(Event.COMPLETE));
        }
   
		
	}
}