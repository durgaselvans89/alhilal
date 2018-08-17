package src.com.selfassessment.controller
{
	
	import mx.core.UIComponent;
	
	import src.com.selfassessment.model.LoginDO;
	import src.com.selfassessment.model.RoleDO;
	
	public class Components extends UIComponent
	{
	 	/** Reference to singleton instance of this class. */
        private static var _instance:Components;
    	
		[Bindable]
        public var session:LoginDO = new LoginDO();
        
        [Bindable]
        public var roleMaster:RoleDO = new RoleDO();
        
        [Bindable]
        public var roleValues:Array = new Array;
        
        public function Components(){}
        
        public static function get instance():Components{
        	
    		if(_instance == null) {
                    _instance = new Components();
            }
            return _instance;
        }
	}
}