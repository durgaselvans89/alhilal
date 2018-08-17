package src.com.selfassessment.events
{
	
	import flash.events.Event;
	import mx.controls.*;
	import src.com.selfassessment.events.*;
	import src.com.selfassessment.view.*;
	
	public class EventCriteriaConstants extends Event{
		
		// Define static constant.
        public static const user_select:String = "User";
        
        public static const subteam_select:String = "SubTeam";
        
        public static const executive_select:String = "ExecutiveTeam";
        
        public static const help_criteria_select:String = "Criteria";
        
        public static const help_abtSA_select:String = "AboutSelfAssessment";
        
        public static const help_abtus_select:String = "AboutUS";
        
        public static const help_Proces_select:String = "ProcessDescription";
        
        public static const help_FC_select:String = "RelationshipFC";
            
        // Define a public variable to hold the state of the enable property.
        public var isEnabled:Boolean;
		
		public function EventCriteriaConstants(type:String, isEnabled:Boolean=false){
			super(type);
			this.isEnabled = isEnabled;
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new EventCriteriaConstants(type, isEnabled);
        }
	
	}
}