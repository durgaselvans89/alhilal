package src.com.selfassessment.controller {
	
	import mx.rpc.events.ResultEvent;
	import mx.rpc.remoting.RemoteObject;
	import src.com.selfassessment.events.*;
	import mx.controls.Alert;
	import src.com.selfassessment.model.ChannelDO;
	
	public class GuidanceController{
		
		[Bindable]
		public var CriteriaDO:RemoteObject;
		
		public function GuidanceController(){
		}
		
		public function setCriteriaValue(txt:String):void{
			Alert.show("Hello");
		}
		
/*		
		
		public function GetcriteriaList(teamid:int,callback: Function):void{
			
			CriteriaDO = new RemoteObject();
			
			var criteriaArray:Array = new Array();
			
			CriteriaDO.destination = "SAService";
			CriteriaDO.source = "SATeam";
			
			var listener : Function = function(event:ResultEvent):void {
				
	            CriteriaDO.removeEventListener(ResultEvent.RESULT, listener);
	            criteriaArray = event.result as Array;
				callback(criteriaArray);
				
         	}
			

			CriteriaDO.getCriteriaID.addEventListener("result", listener);
    	    CriteriaDO.addEventListener("fault", faultListener);
            
 	
            CriteriaDO.getCriteriaID(teamid);
			
		}
*/
		

	}
}