package src.com.selfassessment.events
{
	import flash.events.Event;
	
	public class ActionProjects extends Event
	{
		public static const actionProjects_select:String = "ActionProjects";
		  // Define a public variable to hold the state of the enable property.
        public var isEnabled:Boolean;
		
		public function ActionProjects(type:String, isEnabled:Boolean=false){
			super(type);
			this.isEnabled = isEnabled;
			
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new ActionProjects(type, isEnabled);
        }

	}
}