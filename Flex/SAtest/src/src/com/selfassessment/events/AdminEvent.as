package src.com.selfassessment.events {
	
	import flash.events.Event;
	 
	public class AdminEvent extends Event{
		
		public static const admin_select:String = "Admin";
        
        // Define a public variable to hold the state of the enable property.
        public var isEnabled:Boolean;
		
		public function AdminEvent(type:String, isEnabled:Boolean=false){
			super(type);
			this.isEnabled = isEnabled;
			
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new AdminEvent(type, isEnabled);
        }

	}
}