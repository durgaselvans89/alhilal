package src.com.selfassessment.model
{
	import mx.events.IndexChangedEvent;
	
	[RemoteClass(alias="com.VO.CommentsDO")]
    [Bindable]
	public class CommentsDO
	{
		
		public var sno:int;
		public var approachID:int;
		public var criteriaID:int;
		public var userName:String;
		public var roleName:String;
		public var roleID:int;
		public var userID:int;
		public var comments:String;
		public var commentID:int;
		public var approachToLink:String;
		public var subTeamActions:String;
		public var approachTitle:String;
		
		protected static var _instance:CommentsDO;
		
		public static function getInstance():CommentsDO {
                if(_instance == null) {
                        _instance = new CommentsDO();
                }
                return _instance;
        }
		public function CommentsDO(){}

	}
}