package com.codeofdoom.components
{
	import com.google.maps.overlays.Marker;
	
	public class MarkerData
	{
		public var lat:Number;
		public var lng:Number;
		public var name:String;
		public var marker:Marker;
		
		public function MarkerData(lat:Number,lng:Number,name:String)
		{
			this.lat=lat;
			this.lng=lng;
			this.name=name;
		}

	}
}