package src.com.selfassessment.model
{
	public class ResultAssessmentDO
	{
		[RemoteClass(alias="com.VO.ResultAssessmentDO")]
		[Bindable]
		public var resultassessmentid:int;
		public var criteriaPartDesc:String;
		public var criteriaID:String;
		public var result_name:String;
		public var resultsegments:String;
		public var sourceofinformation:String;
		public var scope:String;
		public var segmentation:String;
		public var trends:String;
		public var targets:String;
		public var comparisons:String;
		public var causes:String;
		public var strength:String;
		public var areasforimprovement:String;
		public var score:Number;
		public var teamtype:String;
		public var systemgeneratedscore:String;
		public var directrelavancetodelivering:String;
		public var relevancetothiscriterionpart:String;
		public var presented:String;
		public var resultstolink:String;
		public var resultdocument:String;
		public var missing:String;
		public var average:Number;
		public var flag:Boolean;
		public var otherapproachlinkto:String;
		public var exeComments:String;
		public var subTeamComments:String;
		public var integrity:String;
		public var type:String;
		public var locationID:int;
		public var location:String;		
		public var owner:String;
		public var strengthLen:int;
		public var afiLen:int;
		public var dummyResultID:int;
		public var enabled:Boolean;
		public var relevance:int;
		public var performance:int;
		
		protected static var _instance:ResultAssessmentDO;
		
		public function getInstance():ResultAssessmentDO {
			if(_instance == null){
				_instance = new ResultAssessmentDO
			}
			return _instance;
		}
		public function ResultAssessmentDO(){}

	}
}