package com.selfassessment.events{
	
	import flash.events.Event;
	
	public class SubTeamEvent extends Event {
	
		public static const subteam_select:String = "kumar";
		
		public var isEnabled:Boolean;
		
		public function SubTeamEvent(type:String, isEnabled:Boolean=false) {
			super(type);
			this.isEnabled = isEnabled;
		}
			
		// Override the inherited clone() method. 
	    override public function clone():Event {
	        return new SubTeamEvent(type, isEnabled);
	    }
	}
}
