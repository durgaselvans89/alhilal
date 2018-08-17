package src.com.selfassessment.model
{
	public class ResultDocumentDO
	{
		[RemoteClass(alias="com.VO.ResultDocumentDO")]
		[Bindable]
		public var resultassessmentid:String;
		public var resultdocumentid:int;
		public var resultdocument:String;
		public var resultdocumentdesc:String;
		
		
		protected static var _instance:ResultDocumentDO;
		
		public function getInstance():ResultDocumentDO {
			if(_instance == null){
				_instance = new ResultDocumentDO
			}
			return _instance;
		}
		
		public function ResultDocumentDO(){	}

	}
}