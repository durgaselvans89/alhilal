package src.com.selfassessment.model
{
	
	
	[RemoteClass(alias="com.VO.RoleDO")]
    [Bindable]
	
	public class RoleDO
	{
		
		public var roleid:int;
		public var rolename:String;
		public var roletype:String;
		public var roletypedesc:String;
		public var displayorder:int;
		public var flag:Boolean;
		
		protected static var _instance:RoleDO;
		
		public static function getInstance():RoleDO {
                if(_instance == null) {
                        _instance = new RoleDO();
                }
                return _instance;
        }
        
		public function RoleDO(){}

	}
}