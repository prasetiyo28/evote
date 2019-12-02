<?php

class crud
{
	private $db;
	
	function __construct($con)
	{
		$this->db = $con;
	}


	public function login($username,$password){

		try {
			$query = $this->db->prepare("SELECT nim FROM pemilih WHERE (nim=:username OR email=:username) AND enc_password=:password and terhapus=0 ");
			$query->bindParam("username", $username, PDO::PARAM_STR);
			$enc_password = md5($password);
			$query->bindParam("password", $enc_password, PDO::PARAM_STR);
			$query->execute();
			if ($query->rowCount() > 0) {
				$result = $query->fetch(PDO::FETCH_OBJ);
                //return true;
				$query2 = $this->db->prepare("INSERT INTO log_activity(user, activity) VALUES (:username,'Login')");
				$query2->bindParam("username", $username, PDO::PARAM_STR);
				$query2->execute();

				return $result->nim;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			exit($e->getMessage());
		}		
	}

	public function login_admin($username,$password){

		try {
			$query = $this->db->prepare("SELECT user FROM admin WHERE user=:username AND password=:password");
			$query->bindParam("username", $username, PDO::PARAM_STR);
			$enc_password = md5($password);
			$query->bindParam("password", $enc_password, PDO::PARAM_STR);
			$query->execute();
			if ($query->rowCount() > 0) {
				$result = $query->fetch(PDO::FETCH_OBJ);
				$query2 = $this->db->prepare("INSERT INTO log_activity(user, activity) VALUES (:username,'Login')");
				$query2->bindParam("username", $username, PDO::PARAM_STR);
				$query2->execute();

                //return true;
				return $result->user;
			} else {
				return false;
			}
		} catch (PDOException $e) {
			exit($e->getMessage());
		}		
	}

	public function logout($username){

		try {
			$query = $this->db->prepare("INSERT INTO log_activity(user, activity) VALUES (:username,'Logout')");
			$query->bindParam("username", $username, PDO::PARAM_STR);
			$query->execute();

			return true;
	} catch (PDOException $e) {
		exit($e->getMessage());
	}		
}


public function acakangkahuruf($panjang)
{
	$karakter= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
	$string = '';
	for ($i = 0; $i < $panjang; $i++) {
		$pos = rand(0, strlen($karakter)-1);
		$string .= $karakter{$pos};
	}
	return $string;
}	
public function buat($nim,$nama,$kelas,$prodi,$email,$admin)
{
	$password = $this->acakangkahuruf(8);
	$enc = md5($password);
	try
	{
		$stmt = $this->db->prepare("INSERT INTO pemilih VALUES(:nim,:nama,:kelas,:prodi,:password,:enc,:email,'0','0',CURRENT_TIMESTAMP,'')");
		$stmt->bindparam(":nim",$nim);
		$stmt->bindparam(":nama",$nama);
		$stmt->bindparam(":kelas",$kelas);
		$stmt->bindparam(":prodi",$prodi);
		$stmt->bindparam(":email",$email);
		$stmt->bindparam(":password",$password);
		$stmt->bindparam(":enc",$enc);
		$stmt->execute();


		$act = $admin . " menambahkan data pemilih dengan nim " . $nim;
		$query2 = $this->db->prepare("INSERT INTO log_activity(user, activity) VALUES (:username,:act)");
				$query2->bindParam("username", $admin, PDO::PARAM_STR);
				$query2->bindParam("act", $act, PDO::PARAM_STR);
				$query2->execute();

		return true;


	}
	catch(PDOException $e)
	{
		echo $e->getMessage();	
		return false;
	}

}

public function getID($id)
{
	$stmt = $this->db->prepare("SELECT * FROM pemilih WHERE nim=:id");
	$stmt->execute(array(":id"=>$id));
	$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
	return $editRow;
}

public function update($nim,$nama,$kelas,$prodi,$email)
{
	try
	{
		$stmt=$this->db->prepare("UPDATE pemilih SET nama=:nama, 
			email=:email , kelas=:kelas , prodi=:prodi 
			WHERE nim=:nim ");
		$stmt->bindparam(":nim",$nim);
		$stmt->bindparam(":nama",$nama);
		$stmt->bindparam(":kelas",$kelas);
		$stmt->bindparam(":prodi",$prodi);
		$stmt->bindparam(":email",$email);
		$stmt->execute();

		return true;	
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();	
		return false;
	}
}

public function hapus($id)
{


	$stmt = $this->db->prepare(
		"UPDATE pemilih set terhapus = '1' WHERE nim=:id"
		);
	$stmt->bindParam(":id",$id);
	$stmt->execute();
	return $stmt;

	return true;

}

public function hitungpemilih()
{
	$stmt = $this->db->prepare("SELECT * FROM pemilih where terhapus = 0 ");
	$stmt->execute();
	$pemilih=$stmt->rowCount();
	return $pemilih;
}	
public function hitungsudah()
{
	$stmt = $this->db->prepare("SELECT * FROM pemilih where status='1' and terhapus=0 ");
	$stmt->execute();
	$sudah=$stmt->rowCount();
	return $sudah;
}	

public function hitungbelum()
{
	$stmt = $this->db->prepare("SELECT * FROM pemilih where status='0' and terhapus = 0 ");
	$stmt->execute();
	$belum=$stmt->rowCount();
	return $belum;
}

public function lihatdata($query)
{
	$stmt = $this->db->prepare($query);
	$stmt->execute();
	$no = 1;
	if($stmt->rowCount()>0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>

			<tr> 

				<th scope="row"><?php echo $no; ?></th> 
				<td><?php echo($row['nim']); ?></td> 
				<td><?php echo($row['nama']); ?></td> 
				<td><?php echo($row['kelas']); ?></td> 
				<td><?php echo($row['prodi']); ?></td> 
				<td><?php echo($row['email']); ?></td> 
				<td><?php if ($row['status'] == 0) {
					echo '<a class="label label-default">Belum Memilih</a>';
				}else{
					echo '<a class="label label-success">Sudah Memilih</a>';
				}

				?></td>

				<td>
					<p>
						<a class="label label-danger" href="hapus.php?id=<?php echo $row['nim']; ?>"><span class="glyphicon glyphicon-trash"></span>hapus</a>
						<a class="label label-warning" href="edit_pemilih.php?id=<?php echo $row['nim']; ?>"><span class="glyphicon glyphicon-pencil"></span>Edit</a>
					</p>
				</td> 
			</tr> 

			<?php

			$no++;
		}
	}
	else
	{
		?>
		<tr>
			<td>Data tidak ditemukan...</td>
		</tr>
		<?php
	}

}

public function lihatdatasudah($query)
{
	$stmt = $this->db->prepare($query);
	$stmt->execute();
	$no = 1;
	if($stmt->rowCount()>0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>

			<tr> 

				<th scope="row"><?php echo $no; ?></th> 
				<td><?php echo($row['nim']); ?></td> 
				<td><?php echo($row['nama']); ?></td> 
				<td><?php echo($row['kelas']); ?></td> 
				<td><?php echo($row['prodi']); ?></td> 
				<td><?php if ($row['status'] == 0) {
					echo '<a class="label label-default">Belum Memilih</a>';
				}else{
					echo '<a class="label label-success">Sudah Memilih</a>';
				}

				?></td>
			</tr> 

			<?php

			$no++;
		}
	}
	else
	{
		?>
		<tr>
			<td colspan="6" align="center">Data tidak ditemukan...</td>
		</tr>
		<?php
	}

}

public function lihatdatabelum($query)
{
	$stmt = $this->db->prepare($query);
	$stmt->execute();
	$no = 1;
	if($stmt->rowCount()>0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>

			<tr> 

				<th scope="row"><?php echo $no; ?></th> 
				<td><?php echo($row['nim']); ?></td> 
				<td><?php echo($row['nama']); ?></td> 
				<td><?php echo($row['kelas']); ?></td> 
				<td><?php echo($row['prodi']); ?></td> 
				<td><?php if ($row['status'] == 0) {
					echo '<a class="label label-default">Belum Memilih</a>';
				}else{
					echo '<a class="label label-success">Sudah Memilih</a>';
				}

				?></td> 
			</tr> 

			<?php

			$no++;
		}
	}
	else
	{
		?>
		<tr>
			<td colspan="6" align="center">Data tidak ditemukan...</td>
		</tr>
		<?php
	}

}

public function paging($query,$records_per_page)
{
	$starting_position=0;
	if(isset($_GET["page_no"]))
	{
		$starting_position=($_GET["page_no"]-1)*$records_per_page;
	}
	$query2=$query." limit $starting_position,$records_per_page";
	return $query2;
}

public function paginglink($query,$records_per_page)
{

	$self = $_SERVER['PHP_SELF'];

	$stmt = $this->db->prepare($query);
	$stmt->execute();

	$total_no_of_records = $stmt->rowCount();

	if($total_no_of_records > 0)
	{
		?><ul class="pagination"><?php
		$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
		$current_page=1;
		if(isset($_GET["page_no"]))
		{
			$current_page=$_GET["page_no"];
		}
		if($current_page!=1)
		{
			$previous =$current_page-1;
			echo "<li><a href='".$self."?page_no=1'>First</a></li>";
			echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
		}
		for($i=1;$i<=$total_no_of_pages;$i++)
		{
			if($i==$current_page)
			{
				echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
			}
			else
			{
				echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
			}
		}
		if($current_page!=$total_no_of_pages)
		{
			$next=$current_page+1;
			echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
			echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
		}
		?></ul><?php
	}
}

/* paging */


/*---------------------Data Calon---------------------------*/

public function lihatdatacalon($query)
{
	$stmt = $this->db->prepare($query);
	$stmt->execute();
	$no = 1;
	if($stmt->rowCount()>0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>

			<tr> 

				<th scope="row"><?php echo $no; ?></th> 
				<td><?php echo($row['id']); ?></td> 
				<td><?php echo($row['nama_ketua']); ?></td> 
				<td><?php echo($row['prodi_ketua']); ?></td> 
				<td><?php echo($row['angkatan_ketua']); ?></td> 
				<td><?php echo($row['nama_wakil']); ?></td> 
				<td><?php echo ($row['prodi_wakil']); ?></td>
				<td><?php echo ($row['angkatan_wakil']); ?></td>
				<td><?php echo ($row['visi']); ?></td>
				<td><?php echo ($row['misi']); ?></td>
				<td><?php echo ($row['slogan']); ?></td>
				<td><img style="width: 50%" src="img/calon/<?php echo ($row['foto']); ?>"></td>

				<td>
					<p>
						<a class="label label-danger" href="data_calon.php?delete_id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-trash"></span>hapus</a>
						<a class="label label-warning" href="edit_calon.php?id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-pencil"></span>Edit</a>
					</p>
				</td> 
			</tr> 
			<?php

			$no++;
		}
	}
	else
	{
		?>
		<tr>
			<td colspan="10" align="center">Data tidak ditemukan...</td>
		</tr>
		<?php
	}

}


public function buatcalon($ketua,$prodi_ketua,$angkatan_ketua,$wakil,$prodi_wakil,$angkatan_wakil,$visi,$misi,$slogan,$file_tmp,$nama)
{

	try
	{

		$stmt = $this->db->prepare("INSERT INTO calon VALUES('',:ketua,:prodi_ketua,:wakil,:prodi_wakil,:angkatan_ketua,:angkatan_wakil,:visi,:misi,:slogan,:nama)");
		$stmt->bindparam(":ketua",$ketua);
		$stmt->bindparam(":prodi_ketua",$prodi_ketua);
		$stmt->bindparam(":angkatan_ketua",$angkatan_ketua);
		$stmt->bindparam(":wakil",$wakil);
		$stmt->bindparam(":prodi_wakil",$prodi_wakil);
		$stmt->bindparam(":angkatan_wakil",$angkatan_wakil);
		$stmt->bindparam(":visi",$visi);
		$stmt->bindparam(":misi",$misi);
		$stmt->bindparam(":slogan",$slogan);
		$stmt->bindparam(":nama",$nama);
		$stmt->execute();
		move_uploaded_file($file_tmp, 'img/calon/'.$nama);
		return true;
	}

	catch(PDOException $e)
	{
		echo $e->getMessage();	
		return false;
	}

}

public function hapuscalon($id)
{

	$stmt_select = $this->db->prepare("SELECT foto FROM calon WHERE id=:id");
	$stmt_select->execute(array(":id"=>$id));
	$img=$stmt_select->fetch(PDO::FETCH_ASSOC);
	unlink("user_images/".$img['foto']);

	$stmt = $this->db->prepare(
		"DELETE FROM calon WHERE id=:id"
		);
	$stmt->bindParam(":id",$id);
	$stmt->execute();
	return $stmt;

	return true;

}

public function getIDCalon($id)
{
	$stmt = $this->db->prepare("SELECT * FROM calon WHERE id=:id");
	$stmt->execute(array(":id"=>$id));
	$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
	return $editRow;
}

public function updateCalon($id,$ketua,$prodi_ketua,$angkatan_ketua,$wakil,$prodi_wakil,$angkatan_wakil,$visi,$misi,$slogan,$foto)
{
	try
	{
		$stmt=$this->db->prepare("UPDATE calon SET nama_ketua=:ketua,
			prodi_ketua=:prodi_ketua,
			nama_wakil=:wakil,
			prodi_wakil=:prodi_wakil,
			angkatan_ketua=:angkatan_ketua,
			angkatan_wakil=:angkatan_wakil,
			visi=:visi,
			misi=:misi,
			slogan=:slogan,
			foto=:foto 
			WHERE id=:id ");
		$stmt->bindparam(":id",$id);
		$stmt->bindparam(":ketua",$ketua);
		$stmt->bindparam(":prodi_ketua",$prodi_ketua);
		$stmt->bindparam(":angkatan_ketua",$angkatan_ketua);
		$stmt->bindparam(":wakil",$wakil);
		$stmt->bindparam(":prodi_wakil",$prodi_wakil);
		$stmt->bindparam(":angkatan_wakil",$angkatan_wakil);
		$stmt->bindparam(":visi",$visi);
		$stmt->bindparam(":misi",$misi);
		$stmt->bindparam(":slogan",$slogan);
		$stmt->bindparam(":foto",$foto);
		$stmt->execute();

		return true;	
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();	
		return false;
	}
}

/*-----------------------Detail Calon-------------------------*/

public function lihatdatadetailcalon($query)
{
	$stmt = $this->db->prepare($query);
	$stmt->execute();
	$no = 1;
	if($stmt->rowCount()>0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>

			<tr> 

				<th scope="row"><?php echo $no; ?></th> 
				<td><?php echo($row['id']); ?></td> 
				<td><?php echo($row['visi']); ?></td> 
				<td><?php echo($row['misi']); ?></td> 
				<td><?php echo($row['slogan']); ?></td> 
				<td><img style="width: 50%" src="img/calon/<?php echo ($row['pamflet']); ?>"></td>

				<td>
					<p>
						<a class="label label-danger" href="data_calon.php?delete_id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-trash"></span>hapus</a>
						<a class="label label-warning" href="edit_calon.php?id=<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-pencil"></span>Edit</a>
					</p>
				</td> 
			</tr> 
			<?php

			$no++;
		}
	}
	else
	{
		?>
		<tr>
			<td colspan="10" align="center">Data tidak ditemukan...</td>
		</tr>
		<?php
	}

}

/*----------------------pemilihan.php--------------------------*/
public function lihatpemilihan($query)
{
	$stmt = $this->db->prepare($query);
	$stmt->execute();
	$no = 1;
	if($stmt->rowCount()>0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>


			<div class="col-lg-4">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 align="center"><?php echo $no; ?></h3>
					</div>

					<div class="panel-body">
						<center><img src="img/calon/<?php echo $row['foto']; ?>" width="50%" class="thumbnail"></center>
						<h4 align="center"><?php echo $row['slogan']; ?></h4>
						<p>Calon Ketua &nbsp;: <?php echo $row['nama_ketua']; ?> <br> Prodi Ketua &nbsp; : <?php echo $row['prodi_ketua']; ?><br>Angkatan &nbsp;&nbsp;&nbsp;  : <?php echo $row['angkatan_ketua']; ?><br><br>
							Calon Wakil &nbsp; : <?php echo $row['nama_wakil']; ?> <br> Prodi Wakil &nbsp; : <?php echo $row['prodi_wakil']; ?> <br>Angkatan&nbsp;&nbsp;&nbsp;  : <?php echo $row['angkatan_wakil']; ?>

						</p>
						<h4 align="center">Visi</h4>
						<p><?php echo $row['visi']; ?></p>
						<h4 align="center">Misi</h4>
						<p><?php echo $row['misi']; ?></p>
					</div>

					<div class="panel-footer">
						<center><a href="pemilihan.php?pilih_id=<?php echo $row['id']; ?>" class="btn btn-primary animated infinite tada">Pilih</a></center>
					</div>
				</div>
			</div>
			<?php

			$no++;
		}
	}
	else
	{
		?>
		<tr>
			<td colspan="10" align="center">Data tidak ditemukan...</td>
		</tr>
		<?php
	}

}

public function pilih($id,$user_id)
{


	$stmt = $this->db->prepare(
		"INSERT INTO hasil VALUES ('',:user_id,:id,CURRENT_TIMESTAMP)"
		);
	$stmt->bindParam(":id",$id);
	$stmt->bindParam(":user_id",$user_id);
	$stmt->execute();

	$stmt2 = $this->db->prepare(
		"UPDATE pemilih set status = '1' where nim = :user_id "
		);
	$stmt2->bindParam(":user_id",$user_id);
	$stmt2->execute();
	return $stmt;

	return true;

}

public function cekpilih($user_id)
{
	$stmt = $this->db->prepare("SELECT * FROM pemilih WHERE nim=:user_id ");
	$stmt->bindParam(":user_id",$user_id);
	$stmt->execute();
	$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
	return $editRow;
}

/*-----------------Quick Count--------------------*/

public function hitungsuara($id)
{
	$stmt = $this->db->prepare("SELECT * FROM hasil where id_grup = :id ");
	$stmt->bindParam(":id",$id);
	$stmt->execute();
	$hasil=$stmt->rowCount();
	return $hasil;
}

public function ambilnama($id)
{
	$stmt = $this->db->prepare("SELECT * FROM calon WHERE id=:id ");
	$stmt->bindParam(":id",$id);
	$stmt->execute();
	$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
	
	$nama = $editRow['nama_ketua'] ." - ". $editRow['nama_wakil'];

	return $nama;
}

public function total()
{
	$stmt = $this->db->prepare("SELECT * FROM hasil");
	$stmt->execute();
	$total=$stmt->rowCount();
	return $total;
}

//----------------------Password-----------------------------//
public function update_password($pass , $id)
{


	$stmt = $this->db->prepare(
		"UPDATE pemilih set enc_password = :pass , update_at = CURRENT_TIMESTAMP WHERE nim=:id"
		);
	$stmt->bindParam(":id",$id);
	$stmt->bindParam(":pass",$pass);
	$stmt->execute();
	return $stmt;

	return true;

}

public function ambilemail($email)
{
	$stmt = $this->db->prepare("SELECT email FROM pemilih WHERE email=:email ");
	$stmt->bindParam(":email",$email);
	$stmt->execute();
	$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
	return $editRow;
}

//-----------------------jadwal------------------

public function ambiltanggal()
{
	$stmt = $this->db->prepare("SELECT * FROM utility ");
	$stmt->execute();
	$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
	return $editRow;
}

public function update_tanggal($mulai , $selesai)
{


	$stmt = $this->db->prepare(
		"UPDATE utility set mulai = :mulai , selesai=:selesai"
		);
	$stmt->bindParam(":mulai",$mulai);
	$stmt->bindParam(":selesai",$selesai);
	$stmt->execute();
	return $stmt;

	return true;

}

//---------------------------Quickcount-----------------------
public function lihatsementara()
{
	$query = "SELECT COUNT(*) as hasil , c.nama_ketua as 'ketua' , c.nama_wakil as 'wakil' FROM hasil h join calon c on h.id_grup = c.id where c.terhapus = 0 GROUP by h.id_grup";
	$stmt = $this->db->prepare($query);
	$stmt->execute();
	$no = 1;
	if($stmt->rowCount()>0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>

			{ y: <?php echo($row['hasil']); ?>, name: "<?php echo($row['ketua']); ?> - <?php echo($row['wakil']); ?>", exploded: true }, 

			<?php

			$no++;
		}
	}
	else
	{
		?>
		<tr>
			<td>Data tidak ditemukan...</td>
		</tr>
		<?php
	}

}

public function lihatsementarafooter()
{
	$query = "SELECT COUNT(*) as hasil , c.nama_ketua as 'ketua' , c.nama_wakil as 'wakil' FROM hasil h join calon c on h.id_grup = c.id where c.terhapus = 0 GROUP by h.id_grup";
	$stmt = $this->db->prepare($query);
	$stmt->execute();
	$no = 1;
	if($stmt->rowCount()>0)
	{
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>
			No Urut.<?php echo $no; ?> : <?php echo($row['hasil']); ?> suara &nbsp;&nbsp;&nbsp; 
			<?php

			$no++;
		}
	}
	else
	{
		?>
		<tr>
			<td>Data tidak ditemukan...</td>
		</tr>
		<?php
	}

}

	


}