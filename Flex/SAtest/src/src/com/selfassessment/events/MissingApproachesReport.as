package src.com.selfassessment.events
{
	import flash.events.Event;
	public class MissingApproachesReport extends Event
	{
		public static const missing_approaches_report="MissingApproachesReport";
		
		public var isEnabled:Boolean;
		
		public function MissingApproachesReport(type:String, isEnabled:Boolean = false){
			super(type);
			this.isEnabled = isEnabled;
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new MissingApproachesReport(type, isEnabled);
        }

	}
}