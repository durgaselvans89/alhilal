package src.com.selfassessment.events
{
	import flash.events.Event;
	public class ProcessDescription extends Event
	{
		public static const processDescription_select:String = "ProcessDescription";
		
		public var isEnabled:Boolean;
		
		public function ProcessDescription(type:String, isEnabled:Boolean=false){
			super(type);
			this.isEnabled = isEnabled;
			
		}
		
		override public function clone():Event {
            return new ProcessDescription(type, isEnabled);
        }
		
	}
}