package src.com.selfassessment.events
{
	import flash.events.Event;
	
	public class MeetingView extends Event{

		  // Define a public variable to hold the state of the enable property.
		public static const meetingview_select:String = "MeetingView";
        public var isEnabled:Boolean;
		
		public function MeetingView(type:String, isEnabled:Boolean = false){
			super(type);
			this.isEnabled = isEnabled;
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new MeetingView(type, isEnabled);
        }

	}
}