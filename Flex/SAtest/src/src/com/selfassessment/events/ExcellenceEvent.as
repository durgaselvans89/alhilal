package src.com.selfassessment.events
{
	import flash.events.Event;
	
	public class ExcellenceEvent extends Event {
		
		public static const excellence_select:String = "Excellence";
        public static const executive_select:String = "Executive";
        
        // Define a public variable to hold the state of the enable property.
        public var isEnabled:Boolean;
		
		public function ExcellenceEvent(type:String, isEnabled:Boolean=false){
			super(type);
			this.isEnabled = isEnabled;
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new ExcellenceEvent(type, isEnabled);
        }

	}
}