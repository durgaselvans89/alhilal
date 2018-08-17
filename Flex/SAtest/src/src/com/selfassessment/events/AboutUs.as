package src.com.selfassessment.events
{
	import flash.events.Event;
	public class AboutUs extends Event
	{
		public static const aboutUs_select:String = "AboutUs";
		
		public var isEnabled:Boolean;
		
		public function AboutUs(type:String, isEnabled:Boolean=false){
			super(type);
			this.isEnabled = isEnabled;
			
		}
		override public function clone():Event {
            return new AboutUs(type, isEnabled);
        }
		
	}
}