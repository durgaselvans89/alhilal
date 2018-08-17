package src.com.selfassessment.model
{
	import mx.events.IndexChangedEvent;
	
	public class EnablerAssessmentDO
	{
		[RemoteClass(alias="com.VO.EnablerAssessmentDO")]
		[Bindable]
		
		public var enablerID:int;
		public var enablerLinkID:int;
		public var criteriaID:String;
		public var criterialID:int;
		public var criteriaLinkID:int;
		public var approachTitle:String;
		public var missing:String;
		public var approachdesc:String;
		public var exampleofapproach:String;
		public var deployment:String;
		public var examplesofdeployment:String;
		public var assessmentandreview:String;
		public var examplesofassessmentreview:String;
		public var sourceofinformation:String;
		public var soundrational:String;
		public var integrated:String;
		public var implemented:String;
		public var systematic:String;
		public var measurement:String;
		public var learning:String;
		public var improvement:String;
		public var strength:String;
		public var areaforimprovement:String;
		public var teamtype:String;
		public var score:Number;
		public var systemgeneratedscore:String;
		public var presented:String;
		public var directrelavancetodelivering:String;
		public var relevancetothiscriterionpart:String;
		public var approachtolink:String;
		public var status:String;
		public var enablerdocument:String;
		public var average:Number;
		public var criteriaShortDescription:String;
		public var DescriptionOfLinkage:String;
		public var flag:Boolean;
		public var otherapproachlinkto:String;
		public var exeComments:String;
		public var subTeamComments:String;
		public var type:String;
		public var locationID:int;
		public var location:String;	
		public var owner:String;
		public var strengthLen:int;
		public var afiLen:int;
		public var dummyEnablerID:int;
		public var linkedDummyID:int;
		public var enabled:Boolean;
		
		protected static var _instance:EnablerAssessmentDO;
		
		public function getInstance():EnablerAssessmentDO {
			if(_instance == null){
				_instance = new EnablerAssessmentDO();
			}
			return _instance;
		}
		public function EnablerAssessmentDO(){}

	}
}