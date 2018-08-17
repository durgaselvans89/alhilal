// ActionScript file
package src.com.selfassessment.events
{
	import flash.events.Event;
	
	public class ReportEvent extends Event {
		
		public static const report_select:String = "Report";
		
		public static const help_select:String = "Help";
		
		public static const projects_select:String = "ImprovementProjects";
		
		public static const meeting_select:String = "Meeting";
        
        public static const gettingstarted_select:String = "GettingStarted";
        
        public static const admin_select:String = "Admin";
        
        // Define a public variable to hold the state of the enable property.
        public var isEnabled:Boolean;
		
		public function ReportEvent(type:String, isEnabled:Boolean=false){
			super(type);
			this.isEnabled = isEnabled;
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new ReportEvent(type, isEnabled);
        }

	}
}