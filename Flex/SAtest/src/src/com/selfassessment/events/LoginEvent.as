package src.com.selfassessment.events{
	
	import flash.events.Event;
	
	public class LoginEvent extends Event{
		
		public static const sign_select:String="signin";
		
		public var isEnabled:Boolean;
		
		public function LoginEvent(type:String, isEnabled:Boolean=false){
			super(type);
			this.isEnabled = isEnabled;  
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new LoginEvent(type, isEnabled);
        }

	}
}