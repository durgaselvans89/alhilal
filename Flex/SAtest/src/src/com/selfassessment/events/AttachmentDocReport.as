package src.com.selfassessment.events
{
	import flash.events.Event;
	
	public class AttachmentDocReport extends Event 
	{
		public static const attachDocReport:String = "AttachDocumentReport";
		
        
        // Define a public variable to hold the state of the enable property.
        public var isEnabled:Boolean;
		
		public function AttachmentDocReport(type:String, isEnabled:Boolean=false){
			super(type);
			this.isEnabled = isEnabled;
		}
		
		 // Override the inherited clone() method. 
        override public function clone():Event {
            return new AttachmentDocReport(type, isEnabled);
        }

	}
}