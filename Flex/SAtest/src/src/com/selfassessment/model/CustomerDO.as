package src.com.selfassessment.model
{
	import mx.messaging.channels.StreamingAMFChannel;
	
	
	
	[RemoteClass(alias="com.VO.CustomerDO")]
    [Bindable]
	
	public class CustomerDO
	{
		
		public var sno:int;
		public var userid:String;
		public var username:String;
		public var surname:String;
		public var loginname:String;
		public var password:String;
		public var designation:String;
		public var phoneno:String;
		public var mobileno:String;
		public var emailid:String;
		public var roleid:String;
		public var rolename:String;
		public var teamid:String;
		public var teamname:String;
		public var telphoneno:String;
		public var name:String;
		public var locationID:int;
		public var location:String;
		public var cityName:String;
		public var roletype:String;
		
		protected static var _instance:CustomerDO;
		
		public function CustomerDO(){}
		
		 public static function getInstance():CustomerDO {
                if(_instance == null) {
                        _instance = new CustomerDO();
                }
                return _instance;
        }

	}
} 