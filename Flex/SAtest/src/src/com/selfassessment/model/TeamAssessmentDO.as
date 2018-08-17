package src.com.selfassessment.model
{
	public class TeamAssessmentDO
	{
		[RemoteClass(alias="com.VO.TeamAssessmentDO")]
		[Bindable]
		
		public var activityID:int;
		public var milestone:String;
		public var activity:String;
		public var accountability:String;
		public var duedate:String;
		public var status:String;
		public var locationID:int;
		public var location:String;
		
		protected static var _instance:TeamAssessmentDO;
		
		public function getInstance():TeamAssessmentDO {
			if(_instance == null){
				_instance = new TeamAssessmentDO
			}
			return _instance;
		}
		
		public function TeamAssessmentDO(){
		}

	}
}