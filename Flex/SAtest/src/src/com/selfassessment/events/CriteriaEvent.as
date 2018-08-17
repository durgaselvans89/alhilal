package src.com.selfassessment.events
{
	import flash.events.Event;
	
	public class CriteriaEvent extends Event{
		
		public static const criteriaevent_select:String = "657565776";
		
		public var isEnabled:Boolean;
		
		public function CriteriaEvent(type:String, isEnabled:Boolean=false){
			super(type);
			this.isEnabled = isEnabled;
		}
		
		override public function clone():Event {
            return new ExcellenceEvent(type, isEnabled);
        }
	}
}
