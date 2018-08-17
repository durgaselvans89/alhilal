package src.com.selfassessment.model
{
	[RemoteClass(alias="com.VO.AFIDO")]
    [Bindable]
	
	public class AFIDO
	{
		public var afiID:int;
		public var criterionPartID:int;
		public var approachID:int;
		public var type:String;
		public var afi:String;
		public var deleteVisible:Boolean;
		public var Index:int;
		
		public function AFIDO()
		{
		}
		protected static var _instance:AFIDO;
		
		public static function getInstance():AFIDO {
                if(_instance == null) {
                        _instance = new AFIDO();
                }
                return _instance;
        }

	}
}