<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class App
	{
		private $CI;
		public function __construct()
		{
			$this->CI =& get_instance();
			$this->appZipCode='';
			$this->appGoogleMapKey='';
			$this->TempleteIDForOTP='';
			$this->TempleteIDForSMS='';
		}
		function SendSMS($mobile,$msg,$DLT_TE_ID)
		{
			// $mobile='91'.$mobile;
			$msg=urlencode($msg);
			$sender="DIGICO";
			$authkey='316846AIn4LVLh7ibW6090030bP1';
			$route='1';
			$url="https://api.msg91.com/api/sendhttp.php?authkey=".$authkey."&sender=".$sender."&mobiles=".$mobile."&route=".$route."&message=".$msg."&DLT_TE_ID=".$DLT_TE_ID."";
			$res=file_get_contents($url);
			if($res)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function humanTiming ($time)
		{
			$time = time() - $time; 
			$time = ($time<1)? 1 : $time;
			$tokens = array (
			31536000 => 'year',
			2592000 => 'month',
			604800 => 'week',
			86400 => 'day',
			3600 => 'hour',
			60 => 'minute',
			1 => 'second'
			);
			foreach ($tokens as $unit => $text) {
				if ($time < $unit) continue;
				$numberOfUnits = floor($time / $unit);
				return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'').' ago';
			}
		}
        
		public function calculateDistance($shipping_zip_code)
		{
			$pick_up_point_zip_code = $this->appZipCode;
			$shipping_zip_code = $shipping_zip_code;
			$pick_up_lat_lng = $this->getLatLng($pick_up_point_zip_code);
			$shipping_lat_lng = $this->getLatLng($shipping_zip_code);
			$unit = 'km';
			$theta = ($pick_up_lat_lng->longitude)-($shipping_lat_lng->longitude);
			$dist = sin(deg2rad((double)$pick_up_lat_lng->latitude)) * sin(deg2rad((double)$shipping_lat_lng->latitude)) + cos(deg2rad((double)$pick_up_lat_lng->latitude)) * cos(deg2rad((double)$shipping_lat_lng->latitude)) * cos(deg2rad((double)$theta));
			$dist = acos($dist);
			$dist = rad2deg($dist);
			$distance = round($dist * 60 * 1.1515 * 1.609344);
			$response = (object) [
                'latitude' => $shipping_lat_lng->latitude,
                'longitude' => $shipping_lat_lng->longitude,
                'address' => $shipping_lat_lng->address,
                'pincode' => $shipping_zip_code,
                'distance' => $distance
			];
			return $response;
		}
		public function getLatLng($zip_code)
		{
			$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$zip_code."&sensor=false&key=".$this->appGoogleMapKey."";
			$curl=curl_init($url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, '');
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_TIMEOUT, 30);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			$json=curl_exec($curl);
			$decode=json_decode($json, true);
			$response = (object) [
                'latitude' => $decode['results'][0]['geometry']['location']['lat'],
                'longitude' => $decode['results'][0]['geometry']['location']['lng'],
                'address' => $decode['results'][0]['formatted_address']
			];
			return $response;
		}
		function hidemobile($mobile)
		{
			if(strlen($mobile)==10)
			{
				$mob1=substr($mobile,0,2);
				$mob2=substr($mobile,6);
				$mob3=$mob1."XXXX".$mob2;
				return $mob3;
			}
			else
			{
				return $mobile;
			}
		}
		function send_notification_multiple($message, $title, $alltokendata)
		{
			$API_ACCESS_KEY='AAAA4zg-DRE:APA91bHR23JbpLNYkG2RwlCI4-EcdedXScnn9QvXxqGHsK5aB9oxEnV5FM6K2ztIvxHQO08YpjXvIE_-QS-2sCa1uS2TIB9P93_G7tJ4s-xkQz9CbeKBHpu7zxv_tqSS6ys4GHqSBn8p';
			$msg = array(
			'body'   => $message,
			'title'   => $title
			);
			define('API_ACCESS_KEY', $API_ACCESS_KEY);
			$fields = array(
			'registration_ids' => $alltokendata,
			'notification' => $msg
			);
			$headers = array(
			'Authorization: key=' . API_ACCESS_KEY,
			'Content-Type: application/json'
			);
			#Send Reponse To FireBase Server	
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
			$result = curl_exec($ch);
			curl_close($ch);
			sleep(1);
			return $result;
		}
		function send_notification_single($message, $title, $token)
		{
			$API_ACCESS_KEY='AAAA4zg-DRE:APA91bHR23JbpLNYkG2RwlCI4-EcdedXScnn9QvXxqGHsK5aB9oxEnV5FM6K2ztIvxHQO08YpjXvIE_-QS-2sCa1uS2TIB9P93_G7tJ4s-xkQz9CbeKBHpu7zxv_tqSS6ys4GHqSBn8p';
			$msg = array(
			'body'   => $message,
			'title'   => $title
			);
			define('API_ACCESS_KEY', $API_ACCESS_KEY);
			$fields = array(
			'to' => $token,
			'notification' => $msg
			);
			$headers = array(
			'Authorization: key=' . API_ACCESS_KEY,
			'Content-Type: application/json'
			);
			#Send Reponse To FireBase Server	
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
			$result = curl_exec($ch);
			curl_close($ch);
			sleep(1);
			return $result;
		}
		

	}			