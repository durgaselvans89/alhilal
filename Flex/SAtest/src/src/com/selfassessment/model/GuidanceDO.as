package src.com.selfassessment.model
{
	public class GuidanceDO{
		
		public var guidancedesc:String;
		
		protected static var _instance:GuidanceDO;
		
		public function getInstance():GuidanceDO{
			if(_instance == null){
				_instance = new GuidanceDO
			}
			return _instance;
		}
		
		public function GuidanceDO(){}

	}
}