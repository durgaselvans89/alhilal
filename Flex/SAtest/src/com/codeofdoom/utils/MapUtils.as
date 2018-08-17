package com.codeofdoom.utils
{
	import com.codeofdoom.components.MarkerData;
	
	import mx.collections.ArrayCollection;
	import mx.controls.Alert;
	
	public class MapUtils
	{
		public static function getMarkerDataByLatAndLng(lat:Number,lng:Number,arr:ArrayCollection):String{
			
			for each (var o:Object in arr){
				var md:MarkerData = o["markerData"];
				if (md.lat == lat && md.lng == lng){
					var resultStr:String=md.name;
					return resultStr;
				}
			}
			return null;
		}
		
		

	}
}