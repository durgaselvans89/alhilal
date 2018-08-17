package src.com.selfassessment.events
{
	public class DataGridBean
	{
		public var sno:int;
		public var tleader:String;
		public var criteria:String;
		public var tmember:String;
		public var deletes:String; 
		
		public function DataGridBean(sno:int, teamleader:String, criteria:String, teammember:String, deletes:String){
			this.sno = sno;
			this.tleader = teamleader;
			this.criteria = criteria;
			this.tmember = teammember;
			this.deletes = deletes;
		}
	}
}