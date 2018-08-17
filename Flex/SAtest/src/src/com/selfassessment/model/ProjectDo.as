package src.com.selfassessment.model
{
	[RemoteClass(alias="com.VO.ProjectDetailsDO")]
    [Bindable]
    
	public class ProjectDo
	{
		public var projectID:int;
		public var projectTitle:String;
		public var responsibility:int;
		public var startDate:String;
		public var endDate:String;
		public var description:String;
		public var expectedBenefits:String;
		public var requiredResources:String;
		
		public var orgStrategy:int;
		public var criterionPart:int;
		public var implementation:int;
		public var status:String;
		public var type:String;
	    public var criteriaID:int;
	    public var approachID:int;
	    public var approachTitle:String;
	    public var progressReport:String;
	    public var priority:int;
	    public var name:String;
		public var roleID:int;
		public var roleName:String;
		public var userID:int;
		public var createdAt:String;
		public var teamName:String;
		public var score:int;
		public var strengthID:int;
		public var afiID:int;
		public var DummyApproachID:String;
		public var title:String;
		
		protected static var _instance:ProjectDo;
		
		public static function getInstance():ProjectDo {
                if(_instance == null) {
                        _instance = new ProjectDo();
                }
                return _instance;
        }
		public function ProjectDo(){}
		

	}
}