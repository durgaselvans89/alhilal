package src.com.selfassessment.model{
	
	[RemoteClass(alias="com.VO.PriorityDO")]
    [Bindable]
	
	public class PriorityDO {
		
		public var value1:int;
		public var value2:int;
		public var value3:int;
		
		protected static var _instance:PriorityDO;
		
		public function PriorityDO(){}
		
		 public static function getInstance():PriorityDO {
                if(_instance == null) {
                        _instance = new PriorityDO();
                }
                return _instance;
        }
	}
}