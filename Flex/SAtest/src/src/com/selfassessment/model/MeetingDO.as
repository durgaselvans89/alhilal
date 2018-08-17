package src.com.selfassessment.model{
	
	[RemoteClass(alias="com.VO.MeetingDO")]
    [Bindable]
    
	public class MeetingDO{

		protected static var _instance:MeetingDO;
		
		  public var meetingname:String;
		  public var meetingvenue:String;
		  public var meetingdatetime:String;
		  public var meetingduration:int;
		  public var meetingdesc:String;
		  public var meetingparticipationid:int;
		  public var meetingid:int;
		  public var agendaid:int;
		  public var discussionPoints:String;
		  public var duration:int;
 		  public var meetingstatus:String;
 		  public var meetingparticipantsname:String	;
		  public var createdAt:String;
		  public var createdBy:int;
		  public var participants:String;
		  public var sno:int;
		  public var percentage:int;
		  
		  
		  
	 	public var deliverables:String;
		public var responsibility:int;
		public var expiredate:String;
		public var completiondate:String;
		public var status:String;
		public var pointsid:int;
		public var responsename:String;
		
		
		public var organiser:String;
		public function MeetingDO(){
		}

		public function getInstance():MeetingDO{
			if(_instance == null){
				_instance = new MeetingDO
			}
			return _instance;
		}
	}
}

