package src.com.selfassessment.view.assets
{
	import flash.display.GradientType;
    import mx.containers.Canvas;
    
	
	public class GradientBox extends Canvas
	{
		private var _colors:Array; // maximum of 16 entries
        private var _alphas:Array; // maximum of 16 entries
        private var _angle:Number; // degrees, 0-360
        private var _corners:Array; // topLeft, topRight, bottomLeft, bottomRight
		
		public function GradientBox()
		{
			 super();
            
            // default values
            _colors= null;
            _alphas= null;
            _angle= 0;
            _corners= null;
		}
	     
	     ///////////////////////////////////
        // Public properties
        
        public function set colors(value:Array):void      { _colors = value; invalidateDisplayList(); }
        public function get colors():Array      {     return _colors; }
        
        public function set gradAlphas(value:Array):void      { _alphas = value; invalidateDisplayList(); }
        public function get gradAlphas():Array      {     return _alphas; }
        
        public function set corners(value:Array):void      { _corners = value; invalidateDisplayList(); }
        public function get corners():Array      {     return _corners; }
        
        public function set angle(value:Number):void      { _angle = value; invalidateDisplayList(); }
        public function get angle():Number      {     return _angle; }
        
        
        ///////////////////////////////
        // overrides
        
        override protected function updateDisplayList(w:Number, h:Number):void
        {
            super.updateDisplayList(w, h);
            
            var fillColors:Array = _colors? _colors : [0xffffff];
            var fillAlphas:Array = [];
            var arRatios:Array= [];
            
            for (var i:int=0; i < fillColors.length; i++) {
                fillAlphas[i]= _alphas? _alphas[i] : Number(1.0);
                arRatios[i]= Math.floor(255*(i/(fillColors.length-1)));
            }
            
            var cRad:Number = getStyle("cornerRadius") as Number; // 0 if not defined
            var arCorners:Object = _corners? {tl:_corners[0], tr:_corners[1], bl:_corners[2], br:_corners[3]} : cRad;
            
            // Use UIComponent::drawRoundRect to draw into the skin
            //
                            
            drawRoundRect(0, 0, w, h, arCorners, 
                            fillColors, fillAlphas, _angle, 
                            GradientType.LINEAR, arRatios );    
        }
        
        
    }
}