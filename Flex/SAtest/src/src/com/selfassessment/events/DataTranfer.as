package src.com.selfassessment.events{
	import mx.utils.StringUtil;
	
	
	public class DataTranfer
	{
		public var tmemeber:String;
			
		public function DataTranfer(){
		}
		
		public function getTmember():String{
			return this.tmemeber;
		}
		
		public function setTmember(teammember:String):void{
			this.tmemeber = teammember;		
		}
	}
}