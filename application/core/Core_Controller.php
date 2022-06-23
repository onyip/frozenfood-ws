<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Core_Controller extends CI_Controller{
	var $agent;
	var $meta;
	var $release;
	function __construct(){
		parent::__construct();
		/*load library,untuk deteksi browser*/
		$this->load->library('user_agent');
		$this->agent = $this->agent->agent_string();
		$this->release=$this->release();
		$this->load->model("data");
		$this->load->library('session');
		date_default_timezone_set('Asia/Jakarta');
	}
	
	function release(){
		//return "dev";
		return "pages";
	}
	
	function bulan($b){
		if ($b=="1") return "Januari";
		if ($b=="2") return "Februari";
		if ($b=="3") return "Maret";
		if ($b=="4") return "April";
		if ($b=="5") return "Mei";
		if ($b=="6") return "Juni";
		if ($b=="7") return "Juli";
		if ($b=="8") return "Agustus";
		if ($b=="9") return "September";
		if ($b=="10") return "Oktober";
		if ($b=="11") return "November";
		if ($b=="12") return "Desember";
	}
	function sendPushNotification($fields = array()){		
		$API_ACCESS_KEY = 'AAAAUnrPSr0:APA91bGFv-H8M5Lky7bFLWymy52FB5hnm3pFlR0aYmLG5i0BTx_F83QJoGOivttEGj30P3B_UH2_Y2VKZJwiukQkPkRh9JEtApWTlK-2D7LVHw_VyRGCXeyh68AzS-QuMwFmWpTCe_7e';
		$headers = array(
			'Authorization: key=' . $API_ACCESS_KEY,
			'Content-Type: application/json'
		);		
		
		$url='https://fcm.googleapis.com/fcm/send';
		$session = curl_init();
		curl_setopt($session,CURLOPT_URL, $url);
		curl_setopt($session,CURLOPT_POST, true);		
		curl_setopt($session, CURLOPT_VERBOSE, true);				
		curl_setopt($session,CURLOPT_HTTPHEADER, $headers);
		curl_setopt($session,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($session,CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($session,CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($session);
		curl_close($session);
		return $result;
	}
	
	function genNota($n,$kode){
		$has="";
		$lbr=strlen($n);
		for($i=1;$i<=4-$lbr;$i++){
			$has=$has."0";
		}
		return date("y").date("m").date("d")."/".$has.$n.$kode;
	}
	
	function getJam($txt,$deli){
		if(trim($txt)==""){
			return "";
		}else{
			$jam=explode($deli,$txt);
			if(intval($jam[0])>0 && intval($jam[0])<9){
				return "0".$jam[0];
			}else{
				return $jam[0];
			}
		}
	}	
	
	function getMenit($txt,$deli){
		if(trim($txt)==""){
			return "";
		}else{
			$jam=explode($deli,$txt);
			if(intval($jam[1])>0 && intval($jam[1])<9){
				return "0".$jam[1];
			}else{
				return $jam[1];
			}
		}
	}
	
	function getTgl($txt){
		$tgl=explode("-",$txt);
		if(count($tgl)==3){
			return (int)$tgl[2];
		}else{
			return "0";
		}
	}
	
	function formatTanggalGetTglInt($txt,$deli){
		$tgl=explode($deli,$txt);
		if(count($tgl)==3){
			return (int)$tgl[2];
		}else{
			return "0";
		}
	}
	
	function formatTanggalGetBlnInt($txt,$deli){
		$tgl=explode($deli,$txt);
		if(count($tgl)==3){
			return (int)$tgl[1];
		}else{
			return "0";
		}
	}
	
	function formatTanggalGetThnInt($txt,$deli){
		$tgl=explode($deli,$txt);
		if(count($tgl)==3){
			return (int)$tgl[0];
		}else{
			return "0";
		}
	}
	
	function formatTanggalGetTgl($txt,$deli){
		$tgl=explode($deli,$txt);
		if(count($tgl)==3){
			return $tgl[0];
		}else{
			return "";
		}
	}
	
	function formatTanggalGetBln($txt,$deli){
		$tgl=explode($deli,$txt);
		if(count($tgl)==3){
			return $tgl[1];
		}else{
			return "";
		}
	}
	
	function formatTanggalGetThn($txt,$deli){
		$tgl=explode($deli,$txt);
		if(count($tgl)==3){
			return $tgl[2];
		}else{
			return "";
		}
	}
	
	function formatTanggalMasuk($txt,$deli){
		$tgl=explode($deli,$txt);
		if(count($tgl)==3){
			return $tgl[2]."-".$tgl[1]."-".$tgl[0];
		}else{
			return "0000-00-00";
		}
	}
	function formatTanggalMasukJam($txt,$deli){
		$tanggal=explode(" ",$txt);
		if(count($tanggal)==2){
			$tgl=explode($deli,$tanggal[0]);
			if(count($tgl)==3){
				return $tgl[2]."-".$tgl[1]."-".$tgl[0]." ".$tanggal[1];
			}else{
				return "0000-00-00 ".$tanggal[1];
			}
			
		}else{
			return "0000-00-00 00:00";
		}
		
	}
	function formatTanggalMasukJam2($txt,$deli){
		$tanggal=explode(" ",$txt);
		if(count($tanggal)==2){
			$tgl=explode($deli,$tanggal[0]);
			if(count($tgl)==3){
				return $tgl[2]."-".$tgl[1]."-".$tgl[0];
			}else{
				return "0000-00-00 ";
			}
			
		}else{
			return "0000-00-00";
		}
		
	}
	
	function formatTanggalMasukKhusus($txt,$deli){
		$tgl=explode($deli,$txt);
		if(count($tgl)==3){
			return "20".$tgl[2]."-".$tgl[0]."-".$tgl[1];
		}else{
			return "0000-00-00";
		}
	}
	function formatTanggalBalik($txt,$deli){
		$tgl=explode($deli,$txt);
		if(count($tgl)==3){
			return $tgl[1]."/".$tgl[0]."/".$tgl[2];
		}else{
			return "00/00/0000";
		}
	}
	
	function formatTanggalKeluar($txt,$deli){
		$tgl=explode($deli,$txt);
		if(count($tgl)==3){
			return $tgl[2]."/".$tgl[1]."/".$tgl[0];
		}else{
			return "00/00/0000";
		}
	}
	
	function formatTanggalKeluar2($txt,$deli){
		$tglx=explode(" ",$txt);
		$tgl=explode($deli,$tglx[0]);
		if(count($tgl)==3){
			return $tgl[2]."/".$tgl[1]."/".$tgl[0]." ".$tglx[1];
		}else{
			return "0000/00/00";
		}
	}	
	function formatTanggalKeluar3($txt,$deli){
		$tglx=explode(" ",$txt);
		$tgl=explode($deli,$tglx[0]);
		if(count($tgl)==3){
			return $tgl[2]."/".$tgl[1]."/".$tgl[0];
		}else{
			return "0000/00/00";
		}
	}	
	function rp($rp){
		$a=$rp;
		$b=explode(".",$a);
		$rp=$b[0];
		if(count($b)>1){
			$koma=$b[1];
		}else{
			$koma="";
		}
		$rupiah="";
		$p=strlen($rp);
		while($p>3){$rupiah=".".substr($rp,-3).$rupiah;
			$l=strlen($rp)-3;
			$rp=substr($rp,0,$l);
			$p=strlen($rp);
		}
		if($koma==""||$koma==0||$koma==00){
			$rupiah=$rp.$rupiah;
		}else{
			$rupiah=$rp.$rupiah.",".$koma;
		}
		if($rupiah==0||$rupiah=="0,00") $rupiah="";
		return $rupiah;
	}
	function terbilang($x){
		$abil=array("","Satu","Dua","Tiga","Empat","Lima","Enam","Tujuh","Delapan","Sembilan","Sepuluh","Sebelas");
		if($x<12) return " ".$abil[$x];
		elseif($x<20)return $this->terbilang($x-10)." Belas";
		elseif($x<100)return $this->terbilang($x/10)." Puluh".$this->terbilang($x%10);
		elseif($x<200)return " Seratus".$this->terbilang($x-100);
		elseif($x<1000)return $this->terbilang($x/100)." Ratus".$this->terbilang($x%100);
		elseif($x<2000)return " Seribu".$this->terbilang($x-1000);
		elseif($x<1000000)return $this->terbilang($x/1000)." Ribu".$this->terbilang($x%1000);
		elseif($x<1000000000)return $this->terbilang($x/1000000)." Juta".$this->terbilang($x%1000000);
	}
	/*fungsi string contain on list*/
	function search_pages($string,$find){
  		foreach($find as $v){
    		if(strpos($v,$string) === 0)  return true;
  		}
  		return false;
	}
}