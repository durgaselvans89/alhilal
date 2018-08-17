package src.com.selfassessment.events{
	
	import flash.events.Event;
	
	public class GuideLinesEvent extends Event{
		
		public static const guide_select:String = "Guidance";
		
		public var isEnabled:Boolean;
		
		public function GuideLinesEvent(type:String, isEnabled:Boolean=false){
			super(type);
			this.isEnabled = isEnabled;
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new GuideLinesEvent(type, isEnabled);
        }

	}
}