<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data extends CI_Model
{
	public function login($username, $password)
	{
		$data = $this->db->query("select * from signin where userid='" . $username . "' and pass='" . $password . "'");
		$this->db->close();
		return $data->result();
	}
	public function kategori()
	{
		$data = $this->db->query("select * from kategori");
		$this->db->close();
		return $data->result();
	}
	public function subkategori()
	{
		$data = $this->db->query("select s.*,k.nama as kategori from subkategori s
		join kategori k on k.id=s.idkategori order by kategori,s.nama");
		$this->db->close();
		return $data->result();
	}
	public function subkategoribykategori($idkategori)
	{
		$data = $this->db->query("select s.*,k.nama as kategori from subkategori s
		join kategori k on k.id=s.idkategori
		where s.idkategori='" . $idkategori . "'
		order by kategori,s.nama");
		$this->db->close();
		return $data->result();
	}
	public function cabang()
	{
		$data = $this->db->query("select * from cabang");
		$this->db->close();
		return $data->result();
	}
	public function cabangbyuserid($userid)
	{
		$data = $this->db->query("select * from cabang where userid='" . $userid . "'");
		$this->db->close();
		return $data->result();
	}
	public function cabangbyproduk($idproduk)
	{
		$data = $this->db->query("select distinct c.* from cabang c
		join stokcabang s on c.id=s.idcabang
		where s.idproduk='" . $idproduk . "'");
		$this->db->close();
		return $data->result();
	}
	public function pelanggan()
	{
		$data = $this->db->query("select * from pelanggan");
		$this->db->close();
		return $data->result();
	}
	public function pelangganbyuserid($userid)
	{
		$data = $this->db->query("select * from pelanggan where userid='" . $userid . "'");
		$this->db->close();
		return $data->result();
	}
	public function kategoribyproduk()
	{
		$data = $this->db->query("select distinct idkategori,kategori from produk where st='1' and thumbnail<>''");
		$this->db->close();
		return $data->result();
	}
	public function kategoribyprodukbyuserid($userid)
	{
		$data = $this->db->query("select distinct p.idkategori,p.kategori from produk p
		join stokcabang s on p.id=s.idproduk
		join cabang c on s.idcabang=c.id
		where p.st='1' and p.thumbnail<>'' and c.userid='" . $userid . "'");
		$this->db->close();
		return $data->result();
	}
	public function kategoribyprodukexceptbyuserid($userid)
	{
		// $data=$this->db->query("select distinct p.idkategori,p.kategori from produk p
		// join stokcabang s on p.id=s.idproduk
		// join cabang c on s.idcabang=c.id
		// where p.st='1' and p.thumbnail<>'' 
		// and p.id not in(select p.id from produk p
		// join stokcabang s on p.id=s.idproduk
		// join cabang c on s.idcabang=c.id where c.userid='".$userid."')");
		$data = $this->db->query("select distinct p.idkategori,p.kategori from produk p
		where p.st='1' and p.thumbnail<>'' 
		and p.id not in(select p.id from produk p
		join stokcabang s on p.id=s.idproduk
		join cabang c on s.idcabang=c.id where c.userid='" . $userid . "')");
		// $data=$this->db->query("select distinct p.idkategori,p.kategori from produk p
		// where p.st='1' and p.thumbnail<>''");
		$this->db->close();
		return $data->result();
	}

	public function subkategoribyproduk($id)
	{
		$data = $this->db->query("select distinct idkategori,kategori,idsubkategori,subkategori from produk where idkategori='" . $id . "' and thumbnail<>'' and st='1'");
		$this->db->close();
		return $data->result();
	}
	public function produkbykategori($id)
	{
		$data = $this->db->query("select * from produk where idkategori='" . $id . "' and thumbnail<>'' and st='1' limit 0,5");
		$this->db->close();
		return $data->result();
	}
	public function produkbykategoriall($id)
	{
		$data = $this->db->query("select * from produk where idkategori='" . $id . "' and thumbnail<>'' and st='1'");
		$this->db->close();
		return $data->result();
	}
	public function produkbysearch($txt)
	{
		$data = $this->db->query("select * from produk where judul like '%" . $txt . "%' and thumbnail<>'' and st='1'");
		$this->db->close();
		return $data->result();
	}
	public function gambarlainbyid($id)
	{
		$data = $this->db->query("select id,id,thumbnail as images from produk  where id='" . $id . "'
		union all
		select * from gambarlain where idproduk='" . $id . "'
		");
		$this->db->close();
		return $data->result();
	}
	public function produkbykategoriallbycabang($id, $idcabang)
	{
		$data = $this->db->query("select p.* from produk p
		join stokcabang c on p.id=c.idproduk
		where p.idkategori='" . $id . "' and p.thumbnail<>'' and p.st='1'
		and c.idcabang='" . $idcabang . "'");
		$this->db->close();
		return $data->result();
	}
	public function produkbykategoriallbyuserid($id, $userid)
	{
		$data = $this->db->query("select p.* from produk p
		join stokcabang s on p.id=s.idproduk
		join cabang c on s.idcabang=c.id
		where p.idkategori='" . $id . "' and p.thumbnail<>'' and p.st='1'
		and c.userid='" . $userid . "'");
		$this->db->close();
		return $data->result();
	}
	public function produkbykategoriexceptbyuserid($id, $userid)
	{
		$data = $this->db->query("select p.* from produk p 	where p.idkategori='" . $id . "' and p.thumbnail<>'' and p.st='1'
		and id not in (select s.idproduk from stokcabang s join cabang c on c.id=s.idcabang where c.userid='" . $userid . "') ");
		$this->db->close();
		return $data->result();
	}
	public function produkbysubkategori($id, $idsub)
	{
		$data = $this->db->query("select * from produk where idkategori='" . $id . "' and idsubkategori='" . $idsub . "'  and st='1' limit 0,5");
		$this->db->close();
		return $data->result();
	}
	public function produkbysubkategoriall($id, $idsub)
	{
		$data = $this->db->query("select * from produk where idkategori='" . $id . "' and idsubkategori='" . $idsub . "'  and st='1'");
		$this->db->close();
		return $data->result();
	}
	public function produkbysubkategoriallbycabang($id, $idsub, $idcabang)
	{
		$data = $this->db->query("select p.* from produk p
		join stokcabang c on p.id=c.idproduk
		where p.idkategori='" . $id . "' and p.idsubkategori='" . $idsub . "' and p.thumbnail<>'' and p.st='1'
		and c.idcabang='" . $idcabang . "'");
		$this->db->close();
		return $data->result();
	}
	public function produkfavorite($userid)
	{
		$data = $this->db->query("select p.* from produk p
		join favorite f on p.id=f.idproduk where f.userid='" . $userid . "'");
		$this->db->close();
		return $data->result();
	}
	public function carousel()
	{
		$data = $this->db->query("select c.*,p.judul as judul2,p.harga as harga2,p.thumbnail as thumbnail2,p.deskripsi 
		from carousel c 
		join produk p on p.id=c.idproduk
		where c.st='1' and c.thumbnail<>''");
		$this->db->close();
		return $data->result();
	}
	public function transaksi()
	{
		$data = $this->db->query("select t.nota,concat(if(dayofmonth(t.tanggal)<10,concat(0,dayofmonth(t.tanggal)),dayofmonth(t.tanggal)),'/',month(t.tanggal),'/',year(t.tanggal)) as tanggal,p.nama,c.nama as cabang,
		sum(t.harga*t.jumlah)as subtotal,t.st,t.flag,d.keterangan,p.telp,p.email,c.telp as telpcabang,c.email as emailcabang,
		concat(year(t.tanggal),month(t.tanggal),if(dayofmonth(t.tanggal)<10,concat(0,dayofmonth(t.tanggal)),dayofmonth(t.tanggal))) as tgl
		from penjualan t
		join pelanggan p on p.userid=t.userid
		join cabang c on c.id=t.idcabang
		join (select nota, group_concat(judul separator ', ') as keterangan from penjualan group by nota) as d on t.nota=d.nota
		group by nota order by tgl desc");
		$this->db->close();
		return $data->result();
	}
	public function transaksibyuserid($userid)
	{
		$data = $this->db->query("select t.nota,concat(if(dayofmonth(t.tanggal)<10,concat(0,dayofmonth(t.tanggal)),dayofmonth(t.tanggal)),'/',month(t.tanggal),'/',year(t.tanggal)) as tanggal,p.nama,c.nama as cabang,
		sum(t.harga*t.jumlah)as subtotal,t.st,t.flag,d.keterangan,p.telp,p.email,c.telp as telpcabang,c.email as emailcabang,
		concat(year(t.tanggal),month(t.tanggal),if(dayofmonth(t.tanggal)<10,concat(0,dayofmonth(t.tanggal)),dayofmonth(t.tanggal))) as tgl
		from penjualan t
		join pelanggan p on p.userid=t.userid
		join cabang c on c.id=t.idcabang
		join (select nota, group_concat(judul separator ', ') as keterangan from penjualan group by nota) as d on t.nota=d.nota
		where p.userid='" . $userid . "'
		group by nota order by tgl desc");
		$this->db->close();
		return $data->result();
	}
	public function transaksibycabang($userid)
	{
		$data = $this->db->query("select t.nota,concat(if(dayofmonth(t.tanggal)<10,concat(0,dayofmonth(t.tanggal)),dayofmonth(t.tanggal)),'/',month(t.tanggal),'/',year(t.tanggal)) as tanggal,p.nama,c.nama as cabang,
		sum(t.harga*t.jumlah)as subtotal,t.st,t.flag,d.keterangan,p.telp,p.email,c.telp as telpcabang,c.email as emailcabang,
		concat(year(t.tanggal),month(t.tanggal),if(dayofmonth(t.tanggal)<10,concat(0,dayofmonth(t.tanggal)),dayofmonth(t.tanggal))) as tgl
		from penjualan t
		join pelanggan p on p.userid=t.userid
		join cabang c on c.id=t.idcabang
		join (select nota, group_concat(judul separator ', ') as keterangan from penjualan group by nota) as d on t.nota=d.nota
		where c.userid='" . $userid . "'
		group by nota order by tgl desc");
		$this->db->close();
		return $data->result();
	}
	public function cekst()
	{
		$data = $this->db->query("select count(*)jml from (
		select c.userid,p.nota from 
		penjualan p
		join 
		cabang c on c.id=p.idcabang
		where p.st<>'1'
		group by p.nota
		)as vx");
		$this->db->close();
		return $data->result();
	}
	public function cekstbyuserid($userid)
	{
		$data = $this->db->query("select count(*)jml from notifikasi where useridto='" . $userid . "' group by useridto");
		$this->db->close();
		return $data->result();
	}
	public function notifikasibyuserid($userid)
	{
		$data = $this->db->query("select * from notifikasi where useridto='" . $userid . "'");
		$this->db->close();
		return $data->result();
	}
	public function cekstbyuseridcabang($userid)
	{
		$data = $this->db->query("select userid,count(*)jml from (
		select c.userid,p.nota from 
		penjualan p
		join 
		cabang c on c.id=p.idcabang
		where p.st<>'1'
		group by p.nota
		)as vx where userid='" . $userid . "'		
		group by userid");
		$this->db->close();
		return $data->result();
	}
	public function transaksibynota($nota)
	{
		$data = $this->db->query("select * from penjualan	where nota='" . $nota . "'");
		$this->db->close();
		return $data->result();
	}
}
