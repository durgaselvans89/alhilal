package src.com.selfassessment.events
{
	import flash.events.Event;
	
	public class SourceInformationReport extends Event
	{
		public static const sourceReport:String = "SourceReport";
		
		public var isEnabled:Boolean;
		
		public function SourceInformationReport(type:String, isEnabled:Boolean=false){
			super(type);
			this.isEnabled = isEnabled;
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new SourceInformationReport(type, isEnabled);
        }
	}
}