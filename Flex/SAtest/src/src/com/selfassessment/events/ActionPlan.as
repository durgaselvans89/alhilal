package src.com.selfassessment.events
{
	import flash.events.Event;
	
	public class ActionPlan extends Event
	{
		public static const actionPlan_select:String = "ActionPlan";
		  // Define a public variable to hold the state of the enable property.
        public var isEnabled:Boolean;
		
		public function ActionPlan(type:String, isEnabled:Boolean=false){
			super(type);
			this.isEnabled = isEnabled;
			
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new ActionPlan(type, isEnabled);
        }
	}
}