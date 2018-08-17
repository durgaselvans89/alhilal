package src.com.selfassessment.model
{
	[RemoteClass(alias="com.VO.TeamDO")]
	[Bindable]
	
	public class TeamDO
	{
		public var teamid:int;
		public var criteriaid:int;
		public var teamname:String;
		public var teamowner:String;
		 public var userid:int;
		 public var userName:String;
		  public var surName:String;
		  public var loginName:String;
		  public var designation:String;
		  public var roleID:int;
		  public var roleName:String;
		  public var criterionpartid:String;
		  public var teamleadername:String;
		  public var locationID:int;
		  public var location:String;
		  public var comments:String;
		  public var criteriapartid:String;
		  public var flag:Boolean;
		
		protected static var _instance:TeamDO;
		
		public function getInstance():TeamDO{
			if(_instance == null){
				_instance = new TeamDO
			}
			return _instance;
		}
		
		public function TeamDO(){}
	}
}