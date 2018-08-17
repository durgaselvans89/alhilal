package src.com.selfassessment.events{
	
	import flash.events.Event;
	
	public class LinkageReportEvent extends Event{
		
		public static const guide_select:String = "LinkageReport";
		
		public var isEnabled:Boolean;
		
		public function LinkageReportEvent(type:String, isEnabled:Boolean = false){
			super(type);
			this.isEnabled = isEnabled;
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new LinkageReportEvent(type, isEnabled);
        }

	}
}
