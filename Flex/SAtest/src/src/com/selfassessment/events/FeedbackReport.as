// ActionScript file
package src.com.selfassessment.events
{
	import flash.events.Event;
	
	public class FeedbackReport extends Event {
		
		public static const excellence_select:String = "FeedbackReport";
        
        // Define a public variable to hold the state of the enable property.
        public var isEnabled:Boolean;
		
		public function FeedbackReport(type:String, isEnabled:Boolean=false){
			super(type);
			this.isEnabled = isEnabled;
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new FeedbackReport(type, isEnabled);
        }

	}
}

