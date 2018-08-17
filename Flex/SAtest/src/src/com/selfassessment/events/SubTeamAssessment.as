package src.com.selfassessment.events{
	
	import flash.events.Event;
	
	public class SubTeamAssessment extends Event{
		
		public static const subteam:String = "SubTeam";
		
		public static const executiveTeam:String = "ExecutiveTeamReview";
		
		public static const projecplan:String = "ProjectPlan";
		
        
        // Define a public variable to hold the state of the enable property.
        public var isEnabled:Boolean;
		
		public function SubTeamAssessment(type:String, isEnabled:Boolean=false){
			super(type);
			this.isEnabled = isEnabled;
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new SubTeamAssessment(type, isEnabled);
        }


	}
}
