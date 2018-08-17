// ActionScript file
package src.com.selfassessment.events{
	
	import flash.events.Event;
	
	public class ScrollReportEvent extends Event{
		
		public static const guide_select:String = "ScoreReport";
		
		public var isEnabled:Boolean;
		
		public function ScrollReportEvent(type:String, isEnabled:Boolean=false){
			super(type);
			this.isEnabled = isEnabled;
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new ScrollReportEvent(type, isEnabled);
        }
	}
}

