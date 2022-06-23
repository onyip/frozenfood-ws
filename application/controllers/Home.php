<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . 'core/Core_Controller.php';

class Home extends Core_Controller {
	public function __construct(){
		parent::__construct();				
		$config['useragent'] = 'CodeIgniter';
		$config['protocol'] = 'smtp';
		//$config['mailpath'] = '/usr/sbin/sendmail';
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_user'] = '@gmail.com';
		$config['smtp_pass'] = '';
		$config['smtp_port'] = 465; 
		$config['smtp_timeout'] = 5;
		$config['wordwrap'] = TRUE;
		$config['wrapchars'] = 76;
		$config['mailtype'] = 'html';
		$config['charset'] = 'utf-8';
		$config['validate'] = FALSE;
		$config['priority'] = 3;
		$config['crlf'] = "\r\n";
		$config['newline'] = "\r\n";
		$config['bcc_batch_mode'] = FALSE;
		$config['bcc_batch_size'] = 200;	
	}
	public function index()	{	
		echo "Web Services";
	}
	public function pages($judul=''){	
		header("Access-Control-Allow-Origin: *");
		if($judul=="login"){					
			$sData = array();	
			$status = "OK";
			$sData = array(
				"response_status"=>$status,
				"response_message"=>'',
				"data"=>array()
			);
			$username=$this->input->get('username');
			$password=$this->input->get('password');
			$token=$this->input->get('token');
			$data=$this->data->login($username,$password);
			if($data){				
				$this->db->query("update signin set token='".$token."' where userid='".$username."'");
				foreach($data as $rs){
					$arr_row=array();
					$arr_row['username'] = $rs->userid;
					$arr_row['nama'] = $rs->nama;
					$arr_row['email'] = $rs->email."";
					$arr_row['level'] = $rs->level."";
					$arr_row['foto'] = $rs->foto."";
					if($rs->level=="2"){
						$datax=$this->data->cabangbyuserid($username);
						if($datax){	
							foreach($datax as $rsx){
								$arr_row['alamat'] = $rsx->alamat."";
								$arr_row['kota'] = $rsx->kota."";
								$arr_row['telp'] = $rsx->telp."";
							}
						}						
					}else if($rs->level=="3"){
						$datax=$this->data->pelangganbyuserid($username);
						if($datax){	
							foreach($datax as $rsx){
								$arr_row['alamat'] = $rsx->alamat."";
								$arr_row['kota'] = $rsx->kota."";
								$arr_row['telp'] = $rsx->telp."";
							}
						}
					}							
					$sData['data'][] = $arr_row;	
				}	
			}else{
				$sData['response_status']= "Error";		
				$sData['response_message']= "Password Salah";		
			}	
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="kategoribyproduk"){						
			$sData = array();
			$data=$this->data->kategoribyproduk();
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->idkategori;
				$arr_row['nama'] = $rs->kategori."";
				$sData[] = $arr_row;	
			}
			// for($i=1;$i<500;$i++){
				// $arr_row=array();
				// $arr_row['id'] = $i;
				// $arr_row['nama'] = "Data ke ".$i;
				// $sData[] = $arr_row;					
			// }
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="kategoribyprodukexceptbyuserid"){						
			$sData = array();
			$data=$this->data->kategoribyprodukexceptbyuserid($this->input->get('userid'));
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->idkategori;
				$arr_row['nama'] = $rs->kategori."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="kategoribyprodukbyuserid"){						
			$sData = array();
			$data=$this->data->kategoribyprodukbyuserid($this->input->get('userid'));
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->idkategori;
				$arr_row['nama'] = $rs->kategori."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="kategori"){						
			$sData = array();
			$data=$this->data->kategori();
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->id;
				$arr_row['nama'] = $rs->nama."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="subkategori"){						
			$sData = array();
			$data=$this->data->subkategori();
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->id;
				$arr_row['idkategori'] = (int)$rs->idkategori;
				$arr_row['nama'] = $rs->nama."";
				$arr_row['kategori'] = $rs->kategori."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="cabang"){						
			$sData = array();
			// $arr_row=array();
			// $arr_row['id'] = 0;
			// $arr_row['nama'] = "";
			// $arr_row['alamat'] = "";
			// $arr_row['kota'] = "";
			// $arr_row['propinsi'] = "";
			// $arr_row['kodepos'] = "";
			// $arr_row['telp'] = "";
			// $arr_row['email'] = "";
			// $sData[] = $arr_row;	
			$data=$this->data->cabang();
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->id;
				$arr_row['nama'] = $rs->nama."";
				$arr_row['alamat'] = $rs->alamat."";
				$arr_row['kota'] = $rs->kota."";
				$arr_row['propinsi'] = $rs->propinsi."";
				$arr_row['kodepos'] = $rs->kodepos."";
				$arr_row['telp'] = $rs->telp."";
				$arr_row['email'] = $rs->email."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="cabangbyproduk"){						
			$sData = array();
			$data=$this->data->cabangbyproduk($this->input->get('idproduk'));
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->id;
				$arr_row['nama'] = $rs->nama."";
				$arr_row['alamat'] = $rs->alamat."";
				$arr_row['kota'] = $rs->kota."";
				$arr_row['propinsi'] = $rs->propinsi."";
				$arr_row['kodepos'] = $rs->kodepos."";
				$arr_row['telp'] = $rs->telp."";
				$arr_row['email'] = $rs->email."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="pelanggan"){						
			$sData = array();
			$data=$this->data->pelanggan();
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->id;
				$arr_row['nama'] = $rs->nama."";
				$arr_row['alamat'] = $rs->alamat."";
				$arr_row['kota'] = $rs->kota."";
				$arr_row['propinsi'] = $rs->propinsi."";
				$arr_row['kodepos'] = $rs->kodepos."";
				$arr_row['telp'] = $rs->telp."";
				$arr_row['email'] = $rs->email."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="subkategoribykategori"){						
			$sData = array();
			$data=$this->data->subkategoribykategori($this->input->get('idkategori'));
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->id;
				$arr_row['idkategori'] = (int)$rs->idkategori;
				$arr_row['nama'] = $rs->nama."";
				$arr_row['kategori'] = $rs->kategori."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="subkategoribyproduk"){						
			$sData = array();
			$data=$this->data->subkategoribyproduk($this->input->get('id'));
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->idsubkategori;
				$arr_row['idkategori'] = (int)$rs->idkategori;
				$arr_row['nama'] = $rs->subkategori."";
				$arr_row['kategori'] = $rs->kategori."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="produkbykategori"){						
			$sData = array();
			$data=$this->data->produkbykategori($this->input->get('id'));
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->id;
				$arr_row['idkategori'] = (int)$rs->idkategori;
				$arr_row['judul'] = $rs->judul."";
				$arr_row['harga'] = "Rp. ".$this->rp($rs->harga)."";
				$arr_row['hargax'] = $rs->harga."";
				$arr_row['deskripsi'] = $rs->deskripsi."";
				$arr_row['thumbnail'] = $rs->thumbnail."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="produkbysearch"){						
			$sData = array();
			$data=$this->data->produkbysearch($this->input->get('txt'));
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->id;
				$arr_row['idkategori'] = (int)$rs->idkategori;
				$arr_row['judul'] = $rs->judul."";
				$arr_row['harga'] = "Rp. ".$this->rp($rs->harga)."";
				$arr_row['hargax'] = $rs->harga."";
				$arr_row['deskripsi'] = $rs->deskripsi."";
				$arr_row['thumbnail'] = $rs->thumbnail."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="produkbykategoriall"){						
			$sData = array();
			$data=$this->data->produkbykategoriall($this->input->get('id'));
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->id;
				$arr_row['idkategori'] = (int)$rs->idkategori;
				$arr_row['judul'] = $rs->judul."";
				$arr_row['harga'] = "Rp. ".$this->rp($rs->harga)."";
				$arr_row['hargax'] = $rs->harga."";
				$arr_row['deskripsi'] = $rs->deskripsi."";
				$arr_row['thumbnail'] = $rs->thumbnail."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="produkbykategoriallbycabang"){						
			$sData = array();
			$data=$this->data->produkbykategoriallbycabang($this->input->get('id'),$this->input->get('idcabang'));
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->id;
				$arr_row['idkategori'] = (int)$rs->idkategori;
				$arr_row['judul'] = $rs->judul."";
				$arr_row['harga'] = "Rp. ".$this->rp($rs->harga)."";
				$arr_row['hargax'] = $rs->harga."";
				$arr_row['deskripsi'] = $rs->deskripsi."";
				$arr_row['thumbnail'] = $rs->thumbnail."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="produkbykategoriallbyuserid"){						
			$sData = array();
			$data=$this->data->produkbykategoriallbyuserid($this->input->get('id'),$this->input->get('userid'));
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->id;
				$arr_row['idkategori'] = (int)$rs->idkategori;
				$arr_row['judul'] = $rs->judul."";
				$arr_row['harga'] = "Rp. ".$this->rp($rs->harga)."";
				$arr_row['hargax'] = $rs->harga."";
				$arr_row['deskripsi'] = $rs->deskripsi."";
				$arr_row['thumbnail'] = $rs->thumbnail."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="produkbykategoriexceptbyuserid"){						
			$sData = array();
			$data=$this->data->produkbykategoriexceptbyuserid($this->input->get('id'),$this->input->get('userid'));
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->id;
				$arr_row['idkategori'] = (int)$rs->idkategori;
				$arr_row['judul'] = $rs->judul."";
				$arr_row['harga'] = "Rp. ".$this->rp($rs->harga)."";
				$arr_row['hargax'] = $rs->harga."";
				$arr_row['deskripsi'] = $rs->deskripsi."";
				$arr_row['thumbnail'] = $rs->thumbnail."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="produkbysubkategori"){						
			$sData = array();
			$data=$this->data->produkbysubkategori($this->input->get('id'),$this->input->get('idsub'));
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->id;
				$arr_row['idkategori'] = (int)$rs->idkategori;
				$arr_row['judul'] = $rs->judul."";
				$arr_row['harga'] = "Rp. ".$this->rp($rs->harga)."";
				$arr_row['hargax'] = $rs->harga."";
				$arr_row['deskripsi'] = $rs->deskripsi."";
				$arr_row['thumbnail'] = $rs->thumbnail."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="produkbysubkategoriall"){						
			$sData = array();
			$data=$this->data->produkbysubkategoriall($this->input->get('id'),$this->input->get('idsub'));
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->id;
				$arr_row['idkategori'] = (int)$rs->idkategori;
				$arr_row['judul'] = $rs->judul."";
				$arr_row['harga'] = "Rp. ".$this->rp($rs->harga)."";
				$arr_row['hargax'] = $rs->harga."";
				$arr_row['deskripsi'] = $rs->deskripsi."";
				$arr_row['thumbnail'] = $rs->thumbnail."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="produkbysubkategoriallbycabang"){						
			$sData = array();
			$data=$this->data->produkbysubkategoriallbycabang($this->input->get('id'),$this->input->get('idsub'),$this->input->get('idcabang'));
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->id;
				$arr_row['idkategori'] = (int)$rs->idkategori;
				$arr_row['judul'] = $rs->judul."";
				$arr_row['harga'] = "Rp. ".$this->rp($rs->harga)."";
				$arr_row['hargax'] = $rs->harga."";
				$arr_row['deskripsi'] = $rs->deskripsi."";
				$arr_row['thumbnail'] = $rs->thumbnail."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="produkfavorite"){						
			$sData = array();
			$data=$this->data->produkfavorite($this->input->get('userid'));
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->id;
				$arr_row['idkategori'] = (int)$rs->idkategori;
				$arr_row['judul'] = $rs->judul."";
				$arr_row['harga'] = "Rp. ".$this->rp($rs->harga)."";
				$arr_row['hargax'] = $rs->harga."";
				$arr_row['deskripsi'] = $rs->deskripsi."";
				$arr_row['thumbnail'] = $rs->thumbnail."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="postfavorite"){			
			$userid=$this->input->post('userid');			
			$idproduk=$this->input->post('idproduk');	
			$this->db->query("delete from favorite where userid='".$userid."' and idproduk='".$idproduk."'");
			
			$this->db->query("insert into favorite(userid,idproduk) values('".$userid."','".$idproduk."')");
				
			echo "OK";
		}else if($judul=="removefavorite"){			
			$userid=$this->input->get('userid');			
			$idproduk=$this->input->get('idproduk');	
			
			$this->db->query("delete from favorite where userid='".$userid."' and idproduk='".$idproduk."'");
				
			echo "OK";
		}else if($judul=="klikbayar"){			
			$query = $this->db->query("select jual from conter");
			$row = $query->result();
			$nota = $this->genNota($row[0]->jual,"J");
			$query = $this->db->query("update conter set jual=jual+1");
			
			$total=0;
			$keterangan="";
			$userid="";
			$idcabang="";
			$token="";
			$email="";
			$nama="";
			//$keranjang=json_decode($this->input->post('body'));	
			$listkeranjang=json_decode($this->input->post('listkeranjang'));
			foreach ($listkeranjang as $key => $rs) { 
				//echo $rs->id." ".$rs->idproduk." ".$rs->judul." ".$rs->harga." ".$rs->hargax." ".$rs->thumbnail." ".$rs->jumlah." ".$rs->userid."<br>\n";
				
				$this->db->query("insert into penjualan(nota,tanggal,idproduk,judul,harga,jumlah,thumbnail,userid,idcabang) 
				values('".$nota."','".date("Y-m-d H:i:s")."','".$rs->idproduk."','".$rs->judul."','".$rs->hargax."','".$rs->jumlah."',
				'".$rs->thumbnail."','".$rs->userid."','".$rs->idcabang."')");
				
				$total+=$rs->hargax*$rs->jumlah;
				$keterangan.=$rs->judul." @".$this->rp($rs->hargax)." x ".$this->rp($rs->jumlah)." = Rp.".$this->rp($rs->hargax*$rs->jumlah)."<br>";
				$userid=$rs->userid;
				$idcabang=$rs->idcabang;
			}				
			echo "OK";
			
			//$keterangan=substr($keterangan,0,strlen($keterangan)-2); 			
			// echo $nota." ".$userid." ".$idcabang." | ".$keterangan." | ".$total."\n<br>";
			
			$data=$this->db->query("select nama from pelanggan where userid='".$userid."'")->result();
			foreach($data as $rs){
				$nama=$rs->nama;
			}			
			
			// $data=$this->db->query("select s.token,s.email from signin s 
				// join cabang c on c.userid=s.userid 
				// where c.id='".$idcabang."'")->result();
			// foreach($data as $rs){
				// $token=$rs->token;
				// $email=$rs->email;
			// }		
			
			// $title = "Transaksi dari ".$nama.", Nota: ".$nota;
			// $message = $keterangan."Total = Rp.".$this->rp($total);	
			// $body=str_replace("<br>","\n",$message);			
			// $fields = array(
				// 'to'  => $token,
				// // 'data' => array(
					// // 'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
					// // 'status' => 'done'
				// // ),
				// 'priority' => 'high',
				// 'notification' => array(
					// 'body' => $body,
					// 'title' => $title,
					// 'sound' => 'default',
					// 'badge' => '1'
				// )
			// );
			// $this->sendPushNotification($fields);				
			// echo $title." ".$message." to: ".$token;
			
			// $this->load->library('email');	
			// if($email==''){}else{
				// /*send email*/
				// $messagex="<!DOCTYPE html><html><head><meta charset='utf-8' /><title>$title</title><meta name='viewport' content='width=device-width, initial-scale=1.0' /></head><body>";
				// $messagex.="Detail Item :<br>".$message."<br/><br/>";
				// $messagex.="</body></html>";

				// //$this->email->from('akuncocjaya01@gmail.com',$title);
				// $this->email->from('akuncocjaya01@gmail.com');
				// $this->email->to($email);
				// $this->email->subject($title);
				// $this->email->set_mailtype("html");
				// $this->email->message($messagex);
				// $this->email->send();
			// }	
		}else if($judul=="carousel"){						
			$sData = array();
			$data=$this->data->carousel();
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->id;
				$arr_row['judul'] = $rs->judul."";
				$arr_row['thumbnail'] = $rs->thumbnail."";
				$arr_row['idproduk'] = (int)$rs->idproduk;
				$arr_row['judul2'] = $rs->judul2."";
				$arr_row['harga2'] = "Rp. ".$this->rp($rs->harga2)."";
				$arr_row['harga2x'] = $rs->harga2."";
				$arr_row['deskripsi'] = $rs->deskripsi."";
				$arr_row['thumbnail2'] = $rs->thumbnail2."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);
		}else if($judul=="postkategori"){			
			$nama=$this->input->post('nama');						
			$data=$this->db->query("select * from kategori where nama='".$nama."'")->result();
			if($data){}else{			
				$this->db->query("insert into kategori(nama) values('".$nama."')");		
				echo "OK";			
			}			
		}else if($judul=="postsubkategori"){			
			$idkategori=$this->input->post('idkategori');			
			$nama=$this->input->post('nama');						
			$data=$this->db->query("select * from subkategori where idkategori='".$idkategori."' and nama='".$nama."'")->result();
			if($data){}else{			
				$this->db->query("insert into subkategori(idkategori,nama) values('".$idkategori."','".$nama."')");				
				echo "OK";		
			}				
		}else if($judul=="daftar"){			
			$email=$this->input->post('email');	
			$nama=ucwords($this->input->post('nama'));	
			$alamat=ucwords($this->input->post('alamat'));
			$kota=ucwords($this->input->post('kota'));	
			$propinsi=ucwords($this->input->post('propinsi'));
			$telp=$this->input->post('telp');
			$token=$this->input->post('token');
			
			$this->load->library('email');			
			
			$data=$this->db->query("select * from signin where userid='".$email."' or email='".$email."'")->result();
			if($data){
				echo "Email sudah terdaftar";				
			}else{			
				$data2=$this->db->query("select * from pelanggan where userid='".$email."'")->result();
				if($data2){
					echo "User sudah terdaftar";	
				}else{
					$this->db->query("insert into signin(userid,pass,nama,level,email,token) values('".$email."','".$telp."','".$nama."','3','".$email."','".$token."')");
					$this->db->query("insert into pelanggan(userid,nama,alamat,kota,propinsi,telp,email) 
					values('".$email."','".$nama."','".$alamat."','".$kota."','".$propinsi."','".$telp."','".$email."')");	
					
					/*send email*/
					$message="<!DOCTYPE html><html><head><meta charset='utf-8' /><title>Informasi Akun</title><meta name='viewport' content='width=device-width, initial-scale=1.0' /></head><body>";
					$message.="Detail Akun : <br/>Nama : ".$nama."<br/>";
					$message.="Username : ".$email."<br/> Password : ".$telp."<br/><br/>";
					$message.="</body></html>";

					$this->email->from('akuncocjaya01@gmail.com');
					$this->email->to($email);
					$this->email->subject('Informasi Akun');
					$this->email->set_mailtype("html");
					$this->email->message($message);
					$this->email->send();
					echo "OK|Terima kasih, Userid dan Password anda telah kami kirim ke : ".$email;						
				}				
			}			
			
		}else if($judul=="postcabang"){			
			$userid=$this->input->post('userid');	
			$password=$this->input->post('password');
			$nama=ucwords($this->input->post('nama'));	
			$alamat=$this->input->post('alamat');
			$kota=ucwords($this->input->post('kota'));	
			$propinsi="";	
			$telp=$this->input->post('telp');
			$email="";					
			$data=$this->db->query("select * from signin where userid='".$userid."'")->result();
			if($data){
				echo "UserID sudah terdaftar";				
			}else{			
				$data2=$this->db->query("select * from cabang where nama='".$nama."'")->result();
				if($data2){
					echo "Cabang sudah terdaftar";	
				}else{
					$this->db->query("insert into signin(userid,pass,nama,level) values('".$userid."','".$password."','".$nama."','2')");
					$this->db->query("insert into cabang(userid,nama,alamat,kota,propinsi,telp,email) 
					values('".$userid."','".$nama."','".$alamat."','".$kota."','".$propinsi."','".$telp."','".$email."')");			
					echo "OK";	
				}				
			}		
		}else if($judul=="hapuskategori"){			
			$id=$this->input->get('id');						
			$this->db->query("delete from kategori where id='".$id."'");	
			echo "OK";		
		}else if($judul=="hapussubkategori"){			
			$id=$this->input->get('id');						
			$this->db->query("delete from subkategori where id='".$id."'");	
			echo "OK";		
		}else if($judul=="hapuscabang"){			
			$id=$this->input->get('id');						
			$data=$this->db->query("select * from cabang where id='".$id."'")->result();
			if($data){
				$this->db->query("delete from signin where userid='".$data[0]->userid."'");	
				$this->db->query("delete from cabang where id='".$id."'");	
			}
			echo "OK";			
		}else if($judul=="hapuspelanggan"){			
			$id=$this->input->get('id');											
			$data=$this->db->query("select * from pelanggan where id='".$id."'")->result();
			if($data){
				$this->db->query("delete from signin where userid='".$data[0]->userid."'");	
				$this->db->query("delete from pelanggan where id='".$id."'");	
			}	
			echo "OK";		
		}else if($judul=="hapusprodukcabangbyid"){			
			$idproduk=$this->input->get('idproduk');						
			$userid=$this->input->get('userid');					
			$data=$this->db->query("select * from cabang where userid='".$userid."'")->result();
			if($data){
				$this->db->query("delete from stokcabang where idcabang='".$data[0]->id."' and idproduk='".$idproduk."'");	
			}
			echo "OK";				
		}else if($judul=="hapuscarouselbyid"){			
			$id=$this->input->get('id');					
			$data=$this->db->query("select * from carousel where id='".$id."'")->result();
			if($data){
				$this->db->query("delete from carousel where id='".$data[0]->id."'");	
			}
			echo "OK";		
		}else if($judul=="tambahprodukcabangbyid"){			
			$idproduk=$this->input->get('idproduk');						
			$userid=$this->input->get('userid');					
			$data=$this->db->query("select * from cabang where userid='".$userid."'")->result();
			if($data){
				$this->db->query("insert into stokcabang (idcabang,idproduk) values('".$data[0]->id."','".$idproduk."')");	
			}
			echo "OK";			
		}else if($judul=="tambahcarouselbyid"){			
			$idproduk=$this->input->post('idproduk');	
			$judul=$this->input->post('judul');						
			$dir = "dist/carousel";
			if (!is_dir($dir)) { @mkdir($dir, 0777, true); $dir = "dist/carousel"; }
			
			$data=$this->db->query("select * from produk where id='".$idproduk."'")->result();
			if($data){					
				if($_FILES["image_file"]["name"]==""){
				}else{ 			
					$namafileasli = basename($_FILES["image_file"]["name"]);
					$path_parts = pathinfo($_FILES["image_file"]["name"]);
					if($path_parts==""){}else{
						$extension = $path_parts['extension'];
					}
					$namafile = $_FILES["image_file"]["name"];
					$uploadfile = $dir."/".$namafile;
					if (move_uploaded_file($_FILES['image_file']['tmp_name'], $uploadfile)) {
						$pesan="Upload berhasil";
						$this->db->query("insert into carousel (idproduk,judul,thumbnail,st) values('".$data[0]->id."','".$judul."','/dist/carousel/".$_FILES["image_file"]["name"]."','1')");
					} else {
						$pesan="Upload gagal";
					}
				}				
			}
			echo "OK";		
		}else if($judul=="postproduk"){				
			$idsubkategori=$this->input->post('idsubkategori');	
			$judul=$this->input->post('judul');			
			$deskripsi=$this->input->post('deskripsi');		
			$harga=$this->input->post('harga');	
			
			$idkategori="";
			$kategori="";
			$subkategori="";
			$datakategori=$this->db->query("select s.*,k.nama as kat from subkategori s
			join kategori k on k.id=s.idkategori
			where s.id='".$idsubkategori."'")->result();
			if($datakategori){
				$idkategori=$datakategori[0]->idkategori;
				$kategori=$datakategori[0]->kat;
				$subkategori=$datakategori[0]->nama;

			}						
			$dir = "dist/images";
			if (!is_dir($dir)) { @mkdir($dir, 0777, true); $dir = "dist/images"; }
				
			$data=$this->db->query("select * from produk where judul='".$judul."' and harga='".$harga."'")->result();
			if($data){}else{			
				$this->db->query("insert into produk(idkategori,idsubkategori,kategori,subkategori,judul,deskripsi,harga) 
				values('".$idkategori."','".$idsubkategori."','".$kategori."','".$subkategori."','".$judul."','".$deskripsi."','".$harga."')");		
				$insert_id = $this->db->insert_id();		
				
				if($_FILES["image_file"]["name"]==""){
				}else{ 			
					$namafileasli = basename($_FILES["image_file"]["name"]);
					$path_parts = pathinfo($_FILES["image_file"]["name"]);
					if($path_parts==""){}else{
						$extension = $path_parts['extension'];
					}
					$namafile = $_FILES["image_file"]["name"];
					$uploadfile = $dir."/".$namafile;
					if (move_uploaded_file($_FILES['image_file']['tmp_name'], $uploadfile)) {
						$pesan="Upload berhasil";
						$this->db->query("update produk set thumbnail='/dist/images/".$_FILES["image_file"]["name"]."'	where id=".$insert_id."");	
					} else {
						$pesan="Upload gagal";
					}
				}			
			}	
			echo "OK";			
		}else if($judul=="postimages"){			
			$idsubkategori=$this->input->post('idsubkategori');	
			$judul=$this->input->post('judul');			
			$deskripsi=$this->input->post('deskripsi');		
			$harga=$this->input->post('harga');				
			$attachment=$this->input->post('attachment');			
			
			$idkategori="";
			$kategori="";
			$subkategori="";
			$datakategori=$this->db->query("select s.*,k.nama as kat from subkategori s
			join kategori k on k.id=s.idkategori
			where s.id='".$idsubkategori."'")->result();
			if($datakategori){
				$idkategori=$datakategori[0]->idkategori;
				$kategori=$datakategori[0]->kat;
				$subkategori=$datakategori[0]->nama;

			}						
			$pesan="";
			
			$dir = "dist/images";
			if (!is_dir($dir)) { @mkdir($dir, 0777, true); $dir = "dist/images"; }
				
			$data=$this->db->query("select * from produk where judul='".$judul."' and harga='".$harga."'")->result();
			if($data){}else{			
				$this->db->query("insert into produk(idkategori,idsubkategori,kategori,subkategori,judul,deskripsi,harga) 
				values('".$idkategori."','".$idsubkategori."','".$kategori."','".$subkategori."','".$judul."','".$deskripsi."','".$harga."')");		
				$insert_id = $this->db->insert_id();
				
				if($attachment=="1"){
					$array = explode('.', $_FILES['file']['name']);
					$extension = end($array);
					$namafile = $judul.".".date("YmdHis").".".$extension;
					$uploadfile = $dir."/".$namafile;
				
					if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
						$pesan="Upload berhasil"; 
						$this->db->query("update produk set thumbnail='/dist/images/".$namafile."' where id=".$insert_id."");
					}else{
						$pesan="Upload gagal";                
					}	
				}else{
					$uploadfile="";
				}
					
			}	
			if($pesan==""){
				echo "OK";
			}else{
				echo $pesan;
			}
		}else if($judul=="transaksi"){						
			$sData = array();
			$data=$this->data->transaksi();
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['nota'] = $rs->nota."";
				$arr_row['tanggal'] = $rs->tanggal."";
				$arr_row['nama'] = $rs->nama."";
				$arr_row['cabang'] = $rs->cabang."";
				$arr_row['keterangan'] = $rs->keterangan."";
				$arr_row['subtotal'] = $rs->subtotal."";
				$arr_row['subtotalrp'] = "Rp. ".$this->rp($rs->subtotal)."";
				$arr_row['telp'] = $rs->telp."";
				$arr_row['email'] = $rs->email."";
				$arr_row['telpcabang'] = $rs->telpcabang."";
				$arr_row['emailcabang'] = $rs->emailcabang."";
				$arr_row['flag'] = $rs->flag."";
				$arr_row['st'] = $rs->st."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);		
		}else if($judul=="transaksibyuserid"){						
			$sData = array();
			$data=$this->data->transaksibyuserid($this->input->get('userid'));
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['nota'] = $rs->nota."";
				$arr_row['tanggal'] = $rs->tanggal."";
				$arr_row['nama'] = $rs->nama."";
				$arr_row['cabang'] = $rs->cabang."";
				$arr_row['keterangan'] = $rs->keterangan."";
				$arr_row['subtotal'] = $rs->subtotal."";
				$arr_row['subtotalrp'] = "Rp. ".$this->rp($rs->subtotal)."";
				$arr_row['telp'] = $rs->telp."";
				$arr_row['email'] = $rs->email."";
				$arr_row['telpcabang'] = $rs->telpcabang."";
				$arr_row['emailcabang'] = $rs->emailcabang."";
				$arr_row['flag'] = $rs->flag."";
				$arr_row['st'] = $rs->st."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);				
		}else if($judul=="transaksibycabang"){						
			$sData = array();
			$data=$this->data->transaksibycabang($this->input->get('userid'));
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['nota'] = $rs->nota."";
				$arr_row['tanggal'] = $rs->tanggal."";
				$arr_row['nama'] = $rs->nama."";
				$arr_row['cabang'] = $rs->cabang."";
				$arr_row['keterangan'] = $rs->keterangan."";
				$arr_row['subtotal'] = $rs->subtotal."";
				$arr_row['subtotalrp'] = "Rp. ".$this->rp($rs->subtotal)."";
				$arr_row['telp'] = $rs->telp."";
				$arr_row['email'] = $rs->email."";
				$arr_row['telpcabang'] = $rs->telpcabang."";
				$arr_row['emailcabang'] = $rs->emailcabang."";
				$arr_row['flag'] = $rs->flag."";
				$arr_row['st'] = $rs->st."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);		
		}else if($judul=="transaksibynota"){						
			$sData = array();
			$data=$this->data->transaksibynota($this->input->get('nota'));
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->id;
				$arr_row['nota'] = $rs->nota."";
				$arr_row['tanggal'] = $rs->tanggal."";
				$arr_row['idproduk'] = (int)$rs->idproduk;
				$arr_row['judul'] = $rs->judul."";
				$arr_row['harga'] = $rs->harga."";
				$arr_row['hargax'] = "Rp. ".$this->rp($rs->harga)."";
				$arr_row['jumlah'] = $rs->jumlah."";
				$arr_row['subtotal'] = ($rs->harga*$rs->jumlah)."";
				$arr_row['subtotalrp'] = "Rp. ".$this->rp($rs->harga*$rs->jumlah)."";
				$arr_row['thumbnail'] = $rs->thumbnail."";
				$arr_row['userid'] = $rs->userid."";
				$arr_row['idcabang'] = (int)$rs->idcabang;
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);		
		}else if($judul=="updatest"){			
			$nota=$this->input->get('nota');						
			$this->db->query("update penjualan set st='1' where nota='".$nota."'");		
			echo "OK";				
		}else if($judul=="updateflag"){			
			$nota=$this->input->get('nota');		
			$flag=$this->input->get('flag');					
			$this->db->query("update penjualan set flag='".$flag."' where nota='".$nota."'");		
			echo "OK";
			
			$total=0;
			$keterangan="";
			$token="";
			$email="";
			$nama="";
			$userid="";
			$useridto="";
			$data=$this->db->query("select j.*,s.token,s.email,p.nama,c.userid as useridcabang 
				from signin s 
				join penjualan j on j.userid=s.userid 
				join pelanggan p on p.userid=s.userid
				join cabang c on c.id=j.idcabang 
				where j.nota='".$nota."'")->result();
			foreach($data as $rs){
				$token=$rs->token;
				$email=$rs->email;	
				$nama=$rs->nama;	
				$userid=$rs->useridcabang;	
				$useridto=$rs->userid;	
				$total+=$rs->harga*$rs->jumlah;
				$keterangan.=$rs->judul." @".$this->rp($rs->harga)." x ".$this->rp($rs->jumlah)." = Rp.".$this->rp($rs->harga*$rs->jumlah)."<br>";
			}		
			$title = "Telah ".ucwords($flag)." transaksi atas ".$nama.", Nota: ".$nota;
			$message = $keterangan."Total = Rp.".$this->rp($total)."<br>Status ".ucwords($flag);
			
			$this->db->query("insert into notifikasi(tanggal,userid,useridto,judul,keterangan,flag)
				values('".date("Y-m-d H:i:s")."','".$userid."','".$useridto."','".$title."','".$message."','".$flag."')");				
			
			$body=str_replace("<br>","\n",$message);			
			$fields = array(
				'to'  => $token,
				// 'data' => array(
					// 'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
					// 'status' => 'done'
				// ),
				'priority' => 'high',
				'notification' => array(
					'body' => $body,
					'title' => $title,
					'sound' => 'default',
					'badge' => '1'
				)
			);
			$this->sendPushNotification($fields);	
			
			$this->load->library('email');	
			if($email==''){}else{
				/*send email*/
				$messagex="<!DOCTYPE html><html><head><meta charset='utf-8' /><title>$title</title><meta name='viewport' content='width=device-width, initial-scale=1.0' /></head><body>";
				$messagex.="Detail Item :<br>".$message."<br/><br/>";
				$messagex.="</body></html>";

				//$this->email->from('akuncocjaya01@gmail.com',$title);
				$this->email->from('akuncocjaya01@gmail.com');
				$this->email->to($email);
				$this->email->subject($title);
				$this->email->set_mailtype("html");
				$this->email->message($messagex);
				$this->email->send();
			}	
		}else if($judul=="updatenotif"){			
			$id=$this->input->get('id');						
			$this->db->query("update notifikasi set st='1' where id='".$id."'");		
			echo "OK";		
		}else if($judul=="cekprodukbycabang"){				
			$data=$this->db->query("select * from stokcabang where idproduk='".$this->input->get('idproduk')."' and idcabang='".$this->input->get('idcabang')."'")->result();
			if($data){
				echo "OK";
			}							
		}else if($judul=="notifikasibyuserid"){						
			$sData = array();
			$data=$this->data->notifikasibyuserid($this->input->get('userid'));
			foreach($data as $rs){
				$arr_row=array();
				$arr_row['id'] = (int)$rs->id;
				$arr_row['tanggal'] = $this->formatTanggalKeluar3($rs->tanggal,"-")."";
				$arr_row['userid'] = $rs->userid."";
				$arr_row['useridto'] = $rs->useridto."";
				$arr_row['judul'] = $rs->judul."";
				$arr_row['keterangan'] = $rs->keterangan."";
				$arr_row['flag'] = $rs->flag."";
				$arr_row['st'] = $rs->st."";
				$sData[] = $arr_row;	
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);					
		}else if($judul=="gambarlainbyid"){						
			$sData = array();
			$data=$this->data->gambarlainbyid($this->input->get('id'));
			if(count($data)>1){
				foreach($data as $rs){
					$arr_row=array();
					$arr_row['id'] = (int)$rs->id;
					$arr_row['images'] = $rs->images."";
					$sData[] = $arr_row;	
				}
			}
			header('Content-Type: application/json');
			echo json_encode($sData, JSON_PRETTY_PRINT);		
		}else if($judul=="postprofiladmin"){			
			$userid=$this->input->post('userid');	
			$password=$this->input->post('password');
			$nama=ucwords($this->input->post('nama'));	
			$email=$this->input->post('email');
			
			if($password==""){
				$this->db->query("update signin set nama='".$nama."',email='".$email."' where userid='".$userid."' ");				
			}else{
				$this->db->query("update signin set nama='".$nama."',email='".$email."',pass='".$password."' where userid='".$userid."' ");
			}		
			echo "OK";		
		}else if($judul=="postprofilcabang"){			
			$userid=$this->input->post('userid');	
			$password=$this->input->post('password');
			$nama=ucwords($this->input->post('nama'));	
			$email=$this->input->post('email');
			$alamat=$this->input->post('alamat');
			$kota=$this->input->post('kota');
			$telp=$this->input->post('telp');
			
			if($password==""){
				$this->db->query("update signin set nama='".$nama."',email='".$email."' where userid='".$userid."' ");				
			}else{
				$this->db->query("update signin set nama='".$nama."',email='".$email."',pass='".$password."' where userid='".$userid."' ");
			}		
			$this->db->query("update cabang set nama='".$nama."',email='".$email."',alamat='".$alamat."',kota='".$kota."',telp='".$telp."' where userid='".$userid."' ");	
			echo "OK";		
		}else if($judul=="postprofilpelanggan"){			
			$userid=$this->input->post('userid');	
			$password=$this->input->post('password');
			$nama=ucwords($this->input->post('nama'));	
			$email=$this->input->post('email');
			$alamat=$this->input->post('alamat');
			$kota=$this->input->post('kota');
			$telp=$this->input->post('telp');
			
			if($password==""){
				$this->db->query("update signin set nama='".$nama."',email='".$email."' where userid='".$userid."' ");				
			}else{
				$this->db->query("update signin set nama='".$nama."',email='".$email."',pass='".$password."' where userid='".$userid."' ");
			}		
			$this->db->query("update pelanggan set nama='".$nama."',email='".$email."',alamat='".$alamat."',kota='".$kota."',telp='".$telp."' where userid='".$userid."' ");	
			echo "OK";	
		}else if($judul=="lupapassword"){
			$email=$this->input->post('email');
			$this->load->library('email');
			if($email==''){}else{
				$data=$this->db->query("select userid,pass,nama from signin where email='".$email."' limit 0,1")->result();
				foreach($data as $rs){
					/*send email*/
					$message="<!DOCTYPE html><html><head><meta charset='utf-8' /><title>Lupa Password</title><meta name='viewport' content='width=device-width, initial-scale=1.0' /></head><body>";
					$message.="Detail Akun : <br/>Nama : ".$rs->nama."<br/>";
					$message.="Username : ".$rs->userid."<br/> Password : ".$rs->pass."<br/><br/>";
					$message.="</body></html>";

					$this->email->from('akuncocjaya01@gmail.com');
					$this->email->to($email);
					$this->email->subject('Lupa Password');
					$this->email->set_mailtype("html");
					$this->email->message($message);
					$this->email->send();
					echo "OK|Terima kasih, Userid dan Password anda telah kami kirim ke : ".$email;
				}
			}
		}else if($judul=="cekst"){
			$data=$this->data->cekst();
			echo "OK|";
			if($data){
				foreach($data as $rs){
					echo $rs->jml;
				}
			}else{
				echo "0";
			}
		}else if($judul=="cekstbyuserid"){
			$userid=$this->input->post('userid');
			$data=$this->data->cekstbyuserid($this->input->get('userid'));
			echo "OK|";
			if($data){
				foreach($data as $rs){
					echo $rs->jml;
				}
			}else{
				echo "0";
			}
		}else if($judul=="cekstbyuseridcabang"){
			$userid=$this->input->post('userid');
			$data=$this->data->cekstbyuseridcabang($this->input->get('userid'));
			echo "OK|";
			if($data){
				foreach($data as $rs){
					echo $rs->jml;
				}
			}else{
				echo "0";
			}
		}else if($judul=="tessendemail"){
			$email=$this->input->get('email');
			$this->load->library('email');
			/*send email*/
			$message="<!DOCTYPE html><html><head><meta charset='utf-8' /><title>Akun Toko Rahman</title><meta name='viewport' content='width=device-width, initial-scale=1.0' /></head><body>";
			$message.="Tes Kirim Email<br/>";
			$message.="</body></html>";

			$this->email->from('akuncocjaya01@gmail.com');
			$this->email->to($email);
			$this->email->subject('Tes Kirim Email');
			$this->email->set_mailtype("html");
			$this->email->message($message);
			$this->email->send();
			echo "Tes Kirim Email ke : ".$email;
		}else if($judul=="tessendfcm"){
			$token=$this->input->get('token');
			$title = "TestJudul";
			$message = "Test Keterangan";	
			// $token = "eHyejBncOAs:APA91bG_EjljGgdY6C0TvlhrakY2d2EZqzf48n6SR3EzHm28oS8YPdkV5-cJKFGhxX1c4-oaCNBMZ81AEEQsIUbfh7mo_fiOb0SR4-8idoul0zb7bu5jwACNSn9-fshuxVTyQn9tHU97";		
			$fields = array(
				'to' => $token,
				'data' => array(
					'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
					'status' => 'done'
				),
				'priority' => 'high',
				'notification' => array(
					'body' => $message,
					'title' => $title,
					'sound' => 'default',
					'badge' => '1',
					'icon' => 'icon'
				)
			);
			$this->sendPushNotification($fields);	
		}else if($judul=="generatestok"){
			// $data=$this->db->query("select * from produk")->result();
			// foreach($data as $rs){
				// $data2=$this->db->query("select * from cabang")->result();
				// foreach($data2 as $rs2){		
					// $this->db->query("insert into stokcabang(idcabang,idproduk) 
					// values('".$rs2->id."','".$rs->id."')");						
				// }
			// }
		}			
	}
}