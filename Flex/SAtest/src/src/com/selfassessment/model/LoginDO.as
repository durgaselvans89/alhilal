package src.com.selfassessment.model{
	
	[RemoteClass(alias="com.VO.SessionDO")]
    [Bindable]
	
	public class LoginDO {
		
		public var userid:String;
		public var username:String;
		public var roleid:String;
		
		public var surname:String;
		  public var loginname:String;
		  public var designation:String;
		  public var rolename:String;
		  public var telphoneno:String;
		  public var mobileno:String;
		  public var email:String;
		  public var emailid:String;
		  public var teamid:String;
		  public var password:String;
		  public var criteriapart:String;
		 public var locationID:int;
		 public var location:String;
		 public var flag:Boolean;
		 public var cityName:String;
		protected static var _instance:LoginDO;
		
		public function LoginDO(){}
		
		 public static function getInstance():LoginDO {
                if(_instance == null) {
                        _instance = new LoginDO();
                }
                return _instance;
        }
	}
}