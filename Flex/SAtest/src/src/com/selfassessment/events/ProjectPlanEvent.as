package src.com.selfassessment.events{
	
	import flash.events.Event;
	
	public class ProjectPlanEvent extends Event{
		
		public static const plan_select:String = "ProjectPlan";
		
		public var isEnabled:Boolean;
		
		public function ProjectPlanEvent(type:String, isEnabled:Boolean=false){
			super(type);
			this.isEnabled = isEnabled;
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new ProjectPlanEvent(type, isEnabled);
        }
	}
}