// ActionScript file

package src.com.selfassessment.events
{
	import flash.events.Event;
	
	public class SummaryReport extends Event {
		
		public static const excellence_select:String = "SummaryReport";
		//public static const attachDocReport:String = "AttachDocumentReport";
		//public static const sourceReport:String = "SourceReport";
        
        // Define a public variable to hold the state of the enable property.
        public var isEnabled:Boolean;
		
		public function SummaryReport(type:String, isEnabled:Boolean=false){
			super(type);
			this.isEnabled = isEnabled;
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new SummaryReport(type, isEnabled);
        }
	}
}


