package src.com.selfassessment.events{
	
	import flash.events.Event;
	
	public class ProjectReportEvent extends Event{
		
		public static const guide_select:String = "ProjectReport";
		
		
		public var isEnabled:Boolean;
		
		public function ProjectReportEvent(type:String, isEnabled:Boolean = false){
			super(type);
			this.isEnabled = isEnabled;
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new ProjectReportEvent(type, isEnabled);
        }

	}
}
