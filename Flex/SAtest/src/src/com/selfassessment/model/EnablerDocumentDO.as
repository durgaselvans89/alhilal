package src.com.selfassessment.model
{
	import mx.events.IndexChangedEvent;
	
	public class EnablerDocumentDO
	{
		[RemoteClass(alias="com.VO.EnablerDocumentDO")]
		[Bindable]
		public var enablerassessmentid:String;
		public var enablerdocumentid:int;
		public var enablerdocument:String;
		public var enablerdocumentdesc:String;
		public var criterionPartID:String;
		public var criterionPartShortDescription:String;
		public var criteriaID:String;
		public var type:String;
		public var source:String;
		public var title:String;
		
		protected static var _instance:EnablerDocumentDO;
		
		public function getInstance():EnablerDocumentDO {
			if(_instance == null){
				_instance = new EnablerDocumentDO
			}
			return _instance;
		}
		
		public function EnablerDocumentDO()	{}

	}
}