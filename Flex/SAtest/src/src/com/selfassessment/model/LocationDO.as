package src.com.selfassessment.model
{
	public class LocationDO
	{
		[RemoteClass(alias="com.VO.LocationDO")]
		[Bindable]
		public var locationID:int;
		public var location:String;
		
		protected static var _instance:LocationDO;
		
		
		public static function getInstance():LocationDO {
                if(_instance == null) {
                        _instance = new LocationDO();
                }
                return _instance;
        }
        
        
		public function LocationDO()
		{
		}

	}
	
	
}
