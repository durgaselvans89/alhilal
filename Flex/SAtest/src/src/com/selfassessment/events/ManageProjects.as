package src.com.selfassessment.events
{
	import flash.events.Event;
	
	public class ManageProjects extends Event
	{
		public static const manageProjects_select:String = "ManageProjects";
		  // Define a public variable to hold the state of the enable property.
        public var isEnabled:Boolean;
		
		public function ManageProjects(type:String, isEnabled:Boolean=false){
			super(type);
			this.isEnabled = isEnabled;
			
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new ManageProjects(type, isEnabled);
        }

	}
}