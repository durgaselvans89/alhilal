package src.com.selfassessment.events
{
	import flash.events.Event;
	
	public class MeetingSet extends Event{

		  // Define a public variable to hold the state of the enable property.
		public static const meetingset_select:String = "MeetingSet";
        public var isEnabled:Boolean;
		
		public function MeetingSet(type:String, isEnabled:Boolean = false){
			super(type);
			this.isEnabled = isEnabled;
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new MeetingSet(type, isEnabled);
        }

	}
}