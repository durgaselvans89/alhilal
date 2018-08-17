package src.com.selfassessment.model
{
	[RemoteClass(alias="com.VO.StrengthDO")]
    [Bindable]
    
	public class StrengthDO
	{
		public var strengthID:int;
		public var criterionPartID:int;
		public var approachID:int;
		public var type:String;
		public var strength:String;
		public var deleteVisible:Boolean;
		public var Index:int;
		
		public function StrengthDO()
		{
		}
		protected static var _instance:StrengthDO;
		
		public static function getInstance():StrengthDO {
                if(_instance == null) {
                        _instance = new StrengthDO();
                }
                return _instance;
        }
        

	}
}