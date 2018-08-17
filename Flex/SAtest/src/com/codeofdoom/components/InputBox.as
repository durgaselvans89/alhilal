package com.codeofdoom.components
{
	import com.google.maps.overlays.Marker;
	
	import mx.containers.HBox;
	import mx.containers.VBox;
	import mx.controls.Button;
	import mx.controls.Label;
	import mx.controls.Text;
	import mx.controls.TextArea;

	public class InputBox extends VBox
	{
		public var textBox:TextArea;
		public var marker:Marker;
		public var markerData:MarkerData;
		public var button:Button;
		public var customerlbl:Label;
		public var customertxt:Text;
		public var cusotmerHbox:HBox;
		
		public function InputBox(){
			
			width=200;
			height=70;
			customerlbl = new Label();
			customerlbl.text = "Customer Code : ";
			customerlbl.styleName = "GoogleLbl";
			customertxt = new Text();
			cusotmerHbox = new HBox();
			cusotmerHbox.addChild(customerlbl);
			cusotmerHbox.addChild(customertxt);
			textBox = new TextArea();
			textBox.styleName = "txtArea";
			textBox.height = 45;
			textBox.editable=false;
			textBox.mouseChildren = false;
			addChild(cusotmerHbox);
			addChild(textBox);			
			
		}
		
	}
}