package src.com.selfassessment.view.assets
{
   import flash.display.Graphics;
   //import mx.skins.ProgrammicSkin;
   import flash.display.GradientType;
   import mx.containers.Canvas;
   import mx.skins.ProgrammaticSkin;
    
	
	public class GradientContainer extends ProgrammaticSkin
	{
		public function GradientContainer()
		{
			super();
		}
		
		 override protected function updateDisplayList(w:Number, h:Number):void {
         //make a short ref to this.graphics
         var g:Graphics = graphics;

         //border settings
         var borderThickness:Number = getStyle("borderThickness");
         var borderColor:uint = getStyle("borderColor");
         var cornerRadius:int = getStyle("cornerRadius");

         //background gradient settings
         var gradientColors:Array = getStyle("backgroundGradientColors");
         var gradientAlphas:Array = getStyle("backgroundGradientAlphas");
         var gradientRotation:Number = getStyle("backgroundGradientRotation");

         //clear drawing settings
         g.clear();

         //prepare the matrix used to draw the gradient
       //  var matrix:Matrix = new Matrix();
         //matrix.createGradientBox(unscaledWidth, unscaledHeight, gradientRotation);

         //set line & fill style
         g.lineStyle(borderThickness, borderColor);
         //g.beginGradientFill("linear", gradientColors, gradientAlphas,[0,255], gradientMatrix);

         //draw
         g.drawRoundRect(0,0,w,h,cornerRadius,cornerRadius);

         //roundup
         g.endFill();
      }

	}
}