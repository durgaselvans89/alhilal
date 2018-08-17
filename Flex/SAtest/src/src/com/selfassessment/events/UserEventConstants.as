package src.com.selfassessment.events
{
	import flash.events.Event;
	
	public class UserEventConstants extends Event{
		
		public static const create_new:String = "Createnew";
        
        // Define a public variable to hold the state of the enable property.
        public var isEnabled:Boolean;
		
		public function UserEventConstants(type:String, isEnabled:Boolean=false){
			super(type);
			this.isEnabled = isEnabled;
		}

		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new UserEventConstants(type, isEnabled);
        }
	}
}