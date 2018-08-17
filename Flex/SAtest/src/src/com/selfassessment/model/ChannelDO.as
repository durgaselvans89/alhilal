package src.com.selfassessment.model {
	
	import mx.controls.Alert;
	import mx.messaging.ChannelSet;
	import mx.messaging.channels.AMFChannel;
	
	[Bindable]
	
	public class ChannelDO{
		
		protected static var _instance:ChannelDO;
		
		public static function getInstance():ChannelDO {
	        if(_instance == null) {
	                _instance = new ChannelDO();
	        }
	        return _instance;
        }
		
		public function ChannelDO(){}
		
		public function setSessionChannel():ChannelSet {
			
			var channelSet:ChannelSet = new ChannelSet();
			var amfChannel:AMFChannel = new AMFChannel("my-amf-weborb", "http://localhost:8080/weborb/weborb.php");
			//var amfChannel:AMFChannel = new AMFChannel("my-amf-weborb", "http://www.excellencebuilder.co.uk/weborb/weborb.php");
			
			//Alert.show(amfChannel.toString());
			
			channelSet.addChannel(amfChannel);
			//Alert.show(channelSet.connected.toString());
			return channelSet;
			
		}


	}
}