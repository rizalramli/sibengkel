<div class="data-table-list">
    <div class="basic-tb-hd">
        <h2>Form Penggajian</h2>
        <br>
        <?php
       if(isset($_POST['gaji_karyawan']))
       {
        $kode_pegawai = $_POST['kode_pegawai'];
        $A1  = 31;
        $A2  = 1;
        $B1  = 150;
        $B2  = 1;
        $C1  = 5000000;
        $C2  = 2000000;
        $C1_ribuan = format_ribuan($C1);
        $C2_ribuan = format_ribuan($C2);
        $X  = $_POST['lama_kerja'];
        $Y  = $_POST['lama_lembur'];
        echo"<table width='100%' class='table'>
        <tr>
         <td><b>VARIABEL</b></td>
         <td width='10%'  align='center'><b>MAX</b></td>
         <td width='10%'  align='center'><b>MIN</b></td>
        </tr>
        <tr>
         <td>Lama Kerja</td>
         <td align='center'>$A1 Hari</td>
         <td align='center'>$A2 Hari</td>
        </tr>
        <tr>
         <td NoWrap>Jam Lembur</td>
         <td align='center'>$B1 Jam</td>
         <td align='center'>$B2 Jam</td>
        </tr>
        <tr>
         <td NoWrap>Gaji</td>
         <td align='center'>Rp $C1_ribuan</td>
         <td align='center'>Rp $C2_ribuan</td>
        </tr>
        <tr>
         <td>Nilai x Lama Kerja</td>
         <td colspan='2' align='center'>$X Hari</td>
        </tr>
        <tr>
         <td>Nilai y Jam Lembur</td>
         <td colspan='2' align='center'>$Y Jam</td>
        </tr>
       </table>
       
       <br>
    
       <table width='100%' class='table'>
        <tr><td Colspan='7'><b>Lama Kerja</b> : terkecil dan terbesar</td></tr>
        <tr>
         <td width='30%' NoWrap>
          Lama Kerja naik ($X Hari)
         </td>
         <td align='center'>=</td>
         <td NoWrap align='center'>
          x - Min <hr> Max - Min
         </td>
         <td align='center'>=</td>
         <td NoWrap align='center'>
          $X - $A2 <hr> $A1 - $A2
         </td>
         <td align='center'>=</td>
         <td>"; 
          
          $naik=round(($X - $A2) /($A1 - $A2),3);
         echo "$naik</td>
        </tr>
    
        <tr>
         <td>
          Lama Kerja turun ($X Hari)
         </td>
         <td width='5%' align='center'>=</td>
         <td NoWrap width='20%' align='center'>
          Max - x <hr> Max - Min
         </td>
         <td width='5%' align='center'>=</td>
         <td NoWrap width='20%' align='center'>
          $A1 - $X <hr> $A1 - $A2
         </td>
         <td width='5%' align='center'>=</td>
         <td>";
         
          $turun1=round(($A1 - $X) /($A1 - $A2),3);
         echo "$turun1</td>
        </tr>
    
       <tr><td Colspan='7'><br><b>Jam Lembur</b> : sedikit dan banyak</td></tr>
       <tr>
        <td NoWrap>
         Jam Lembur banyak ($Y Jam)
        </td>
        <td align='center'>=</td>
        <td NoWrap align='center'>
         y - Min <hr> Max - Min
        </td>
        <td align='center'>=</td>
        <td NoWrap align='center'>
         $Y - $B2 <hr> $B1 - $B2
        </td>
        <td align='center'>=</td>
        <td>"; 
         $banyak = round(($Y - $B2) /($B1 - $B2),3);
        echo "$banyak</td>
       </tr>
       <tr>
        <td NoWrap>
         Jam Lembur sedikit ($Y Jam)
        </td>
        <td align='center'>=</td>
        <td NoWrap align='center'>
         Max - y <hr> Max - Min
        </td>
        <td align='center'>=</td>
        <td NoWrap align='center'>
         $B1 - $Y <hr> $B1 - $B2
        </td>
        <td align='center'>=</td>
        <td>"; 
        
         $sedikit = round(($B1 - $Y) /($B1 - $B2),3);
        echo "$sedikit</td>
       </tr>
      </table>
    
      <br> 
      <table width='100%' class='table'>
    
       <tr>
        <td width='5%'>&nbsp;</td>
       
        <td width='10%' NoWrap>
         predikat1
        </td>
        <td width='5%' align='center'>=</td>
        <td>
         Lama Kerja turun ($X Hari) 
         
         Jam Lembur banyak ($Y Jam)
        </td>
       </tr>
       <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align='center'>=</td>
        <td>
         Min ( $turun1 , $banyak )
        </td>
       </tr>
       <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align='center'>=</td>
        <td>"; $P1 = Min($turun1,$banyak); echo "$P1</td>
       </tr>
       
       
      </table>
    
      <br>
    
      <table width='100%' class='table'>
       <tr>
        <td width='5%'>&nbsp;</td>
      
        <td width='10%' NoWrap>
         predikat2
        </td>
        <td width='5%' align='center'>=</td>
        <td>
         Lama Kerja Turun ($X Hari) 
         
         Jam Lembur sedikit ($Y Jam)
        </td>
       </tr>
       <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align='center'>=</td>
        <td>
         Min ( $turun1 , $sedikit )
        </td>
       </tr>
       <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align='center'>=</td>
        <td>"; $P2 = Min($turun1,$sedikit); echo "$P2</td>
       </tr>
       
      </table
      <br>
    
      <table width='100%' class='table'>
       <tr>
        <td width='5%'>&nbsp;</td>
      
        <td width='10%' NoWrap>
         predikat3
        </td>
        <td width='5%' align='center'>=</td>
        <td>
         Lama Kerja naik ($X Hari) 
         
         Jam Lembur banyak ($Y Jam)
        </td>
       </tr>
       <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align='center'>=</td>
        <td>
         Min ( $naik , $banyak )
        </td>
       </tr>
       <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align='center'>=</td>
        <td>"; $P3 = Min($naik,$banyak); echo "$P3</td>
       </tr>
      
      </table>
    
      <br>
    
      <table width='100%' class='table'>
       <tr>
        <td width='5%'>&nbsp;</td>
       
        <td width='10%' NoWrap>
         predikat4
        </td>
        <td width='5%' align='center'>=</td>
        <td>
         Jam Lembur naik ($X Hari) 
         
         Jam Lembur Sedikit ($Y Jam)
        </td>
       </tr>
       <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align='center'>=</td>
        <td>
         Min ( $naik , $sedikit )
        </td>
       </tr>
       <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align='center'>=</td>
        <td>"; $P4 = Min($naik,$sedikit); echo "$P4</td>
       </tr>
      </table>
     <br>
     <table width='100%' class='table'>
       <tr>
        <td>Nilai keanggotaan Terkecil</td>
        <td>=</td>
        <td>"; $MIN = Min($P1,$P2,$P3,$P4); echo "$MIN</td>
       </tr>
     
       <tr>
        <td>Nilai keanggotaan Terbesar </td>
        
        <td>=</td>
        <td>"; $MAX = MAX($P1,$P2,$P3,$P4); echo "$MAX</td>
       </tr>
       <tr>
        <td>Nilai a1 </td>
        
        <td>=</td>
        <td>"; $a1 = ( $C2 + ( $MIN * ( $C1 - $C2 ))); echo "$a1</td>
       </tr>
       <tr>
        <td>Nilai a2 </td>
        
        <td>=</td>
        <td>"; $a2 = ( $C2 + ( $MAX * ( $C1 - $C2 ))); echo "$a2</td>
       </tr>
     
        <tr>
          <td >Moment 1 </td>
          <td>=</td>
         <td>"; $M1 = ($MIN/2*($a1*$a1)) ; echo " $M1</td>
         
        </tr>
         <tr>
          <td >Moment 2 </td>
          <td>=</td>
          
       <td>"; 
       $Ma=(($a2*$a2*$a2)/(3*($C1 - $C2)));
       $Mb=(($a2*$a2)*($C2)/(2*($C1 - $C2)));
       $Mc = ($Ma-$Mb) ;
       $Md=(($a1*$a1*$a1)/(3*($C1 - $C2)));
       $Me=(($a1*$a1)*($C2)/(2*($C1 - $C2)));
       $Mf = ($Md-$Me) ;
       $M2 = ($Mc-$Mf) ; echo " $M2
       </td>
              
        </tr>
        <tr>
          <td >Moment 3 </td>
          <td>=</td>
         <td>"; $M3 = (($MAX/2*($C1*$C1)) - ($MAX/2*($a2*$a2))); echo " $M3</td>
         
        </tr>
        <table width='100%' class='table'>
        <tr>
           <td>Luas 1<td>
           <td>=</td>
           <td>"; $L1 = (($MIN)* ($a1)) ; echo "$L1</td></tr>
           <tr>
           <td>Luas 2<td>
           <td>=</td> 
       <td>";
       $La=(($A1-$X)/($A1-$A2));
       $Lb=(($B1-$Y)/($B1-$B2));
       $Lc = ($La+$Lb);
       $Ld=($a2-$a1);
       $Le=($Lc*$Ld);
       $Lf = ($Le/2) ;
       $L2 = $Lf; echo " $L2</td>
       </tr>
       <tr>
           <td>Luas 3<td>
           <td>=</td>
           <td>";$L3 = (($MAX*($C1)) - ($MAX*($a2))); echo " $L3</td></tr>
        </tr>
        </table>
        <br>
        <table width='100%' class='table'>
        <tr>
        <td>Nilai Z<td>
           <td>=</td>
        <td>";
        $Z1 = (($M1+$M2+$M3));
        $Z2 = (($L1+$L2+$L3));
        $Z3 = ($Z1/$Z2); echo " $Z3</td></tr>
        </table>
        
        <br>
    </table>
     </table>";
     $tanggal_penggajian = date('Y-m-d');
     $total_gaji = (int) $Z3;
        $query = mysqli_query($koneksi,"INSERT INTO detail_penggajian (kode_detail_penggajian,kode_pegawai,lama_kerja,lama_lembur,total_gaji,tanggal_penggajian) VALUES (NULL,'$kode_pegawai','$X','$Y','$total_gaji','$tanggal_penggajian')"); 
      //   if($query)
      //   {
      //       echo "<script>window.location = 'admin.php?halaman=v_penggajian'</script>";
      //   }
       }
       else 
       {
            $kode_mekanik = $_POST['kode_mekanik'];
            $A1  = 31;
            $A2  = 1;
            $B1  = 150;
            $B2  = 1;
            $C1  = 5000000;
            $C2  = 2000000;
            $C1_ribuan = format_ribuan($C1);
            $C2_ribuan = format_ribuan($C2);
            $X  = $_POST['lama_kerja2'];
            $Y  = $_POST['lama_lembur2'];
            echo"<table width='100%' class='table'>
            <tr>
            <td><b>VARIABEL</b></td>
            <td width='10%'  align='center'><b>MAX</b></td>
            <td width='10%'  align='center'><b>MIN</b></td>
            </tr>
            <tr>
            <td>Lama Kerja</td>
            <td align='center'>$A1 Hari</td>
            <td align='center'>$A2 Hari</td>
            </tr>
            <tr>
            <td NoWrap>Jam Lembur</td>
            <td align='center'>$B1 Jam</td>
            <td align='center'>$B2 Jam</td>
            </tr>
            <tr>
            <td NoWrap>Gaji</td>
            <td align='center'>Rp $C1_ribuan</td>
            <td align='center'>Rp $C2_ribuan</td>
            </tr>
            <tr>
            <td>Nilai x Lama Kerja</td>
            <td colspan='2' align='center'>$X Hari</td>
            </tr>
            <tr>
            <td>Nilai y Jam Lembur</td>
            <td colspan='2' align='center'>$Y Jam</td>
            </tr>
         </table>
         
         <br>
      
         <table width='100%' class='table'>
            <tr><td Colspan='7'><b>Lama Kerja</b> : terkecil dan terbesar</td></tr>
            <tr>
            <td width='30%' NoWrap>
            Lama Kerja naik ($X Hari)
            </td>
            <td align='center'>=</td>
            <td NoWrap align='center'>
            x - Min <hr> Max - Min
            </td>
            <td align='center'>=</td>
            <td NoWrap align='center'>
            $X - $A2 <hr> $A1 - $A2
            </td>
            <td align='center'>=</td>
            <td>"; 
            
            $naik=round(($X - $A2) /($A1 - $A2),3);
            echo "$naik</td>
            </tr>
      
            <tr>
            <td>
            Lama Kerja turun ($X Hari)
            </td>
            <td width='5%' align='center'>=</td>
            <td NoWrap width='20%' align='center'>
            Max - x <hr> Max - Min
            </td>
            <td width='5%' align='center'>=</td>
            <td NoWrap width='20%' align='center'>
            $A1 - $X <hr> $A1 - $A2
            </td>
            <td width='5%' align='center'>=</td>
            <td>";
            
            $turun1=round(($A1 - $X) /($A1 - $A2),3);
            echo "$turun1</td>
            </tr>
      
         <tr><td Colspan='7'><br><b>Jam Lembur</b> : sedikit dan banyak</td></tr>
         <tr>
            <td NoWrap>
            Jam Lembur banyak ($Y Jam)
            </td>
            <td align='center'>=</td>
            <td NoWrap align='center'>
            y - Min <hr> Max - Min
            </td>
            <td align='center'>=</td>
            <td NoWrap align='center'>
            $Y - $B2 <hr> $B1 - $B2
            </td>
            <td align='center'>=</td>
            <td>"; 
            $banyak = round(($Y - $B2) /($B1 - $B2),3);
            echo "$banyak</td>
         </tr>
         <tr>
            <td NoWrap>
            Jam Lembur sedikit ($Y Jam)
            </td>
            <td align='center'>=</td>
            <td NoWrap align='center'>
            Max - y <hr> Max - Min
            </td>
            <td align='center'>=</td>
            <td NoWrap align='center'>
            $B1 - $Y <hr> $B1 - $B2
            </td>
            <td align='center'>=</td>
            <td>"; 
            
            $sedikit = round(($B1 - $Y) /($B1 - $B2),3);
            echo "$sedikit</td>
         </tr>
         </table>
      
         <br> 
         <table width='100%' class='table'>
      
         <tr>
            <td width='5%'>&nbsp;</td>
         
            <td width='10%' NoWrap>
            predikat1
            </td>
            <td width='5%' align='center'>=</td>
            <td>
            Lama Kerja turun ($X Hari) 
            
            Jam Lembur banyak ($Y Jam)
            </td>
         </tr>
         <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align='center'>=</td>
            <td>
            Min ( $turun1 , $banyak )
            </td>
         </tr>
         <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align='center'>=</td>
            <td>"; $P1 = Min($turun1,$banyak); echo "$P1</td>
         </tr>
         
         
         </table>
      
         <br>
      
         <table width='100%' class='table'>
         <tr>
            <td width='5%'>&nbsp;</td>
         
            <td width='10%' NoWrap>
            predikat2
            </td>
            <td width='5%' align='center'>=</td>
            <td>
            Lama Kerja Turun ($X Hari) 
            
            Jam Lembur sedikit ($Y Jam)
            </td>
         </tr>
         <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align='center'>=</td>
            <td>
            Min ( $turun1 , $sedikit )
            </td>
         </tr>
         <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align='center'>=</td>
            <td>"; $P2 = Min($turun1,$sedikit); echo "$P2</td>
         </tr>
         
         </table
         <br>
      
         <table width='100%' class='table'>
         <tr>
            <td width='5%'>&nbsp;</td>
         
            <td width='10%' NoWrap>
            predikat3
            </td>
            <td width='5%' align='center'>=</td>
            <td>
            Lama Kerja naik ($X Hari) 
            
            Jam Lembur banyak ($Y Jam)
            </td>
         </tr>
         <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align='center'>=</td>
            <td>
            Min ( $naik , $banyak )
            </td>
         </tr>
         <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align='center'>=</td>
            <td>"; $P3 = Min($naik,$banyak); echo "$P3</td>
         </tr>
         
         </table>
      
         <br>
      
         <table width='100%' class='table'>
         <tr>
            <td width='5%'>&nbsp;</td>
         
            <td width='10%' NoWrap>
            predikat4
            </td>
            <td width='5%' align='center'>=</td>
            <td>
            Jam Lembur naik ($X Hari) 
            
            Jam Lembur Sedikit ($Y Jam)
            </td>
         </tr>
         <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align='center'>=</td>
            <td>
            Min ( $naik , $sedikit )
            </td>
         </tr>
         <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td align='center'>=</td>
            <td>"; $P4 = Min($naik,$sedikit); echo "$P4</td>
         </tr>
         </table>
         <br>
         <table width='100%' class='table'>
         <tr>
            <td>Nilai keanggotaan Terkecil</td>
            <td>=</td>
            <td>"; $MIN = Min($P1,$P2,$P3,$P4); echo "$MIN</td>
         </tr>
         
         <tr>
            <td>Nilai keanggotaan Terbesar </td>
            
            <td>=</td>
            <td>"; $MAX = MAX($P1,$P2,$P3,$P4); echo "$MAX</td>
         </tr>
         <tr>
            <td>Nilai a1 </td>
            
            <td>=</td>
            <td>"; $a1 = ( $C2 + ( $MIN * ( $C1 - $C2 ))); echo "$a1</td>
         </tr>
         <tr>
            <td>Nilai a2 </td>
            
            <td>=</td>
            <td>"; $a2 = ( $C2 + ( $MAX * ( $C1 - $C2 ))); echo "$a2</td>
         </tr>
         
            <tr>
            <td >Moment 1 </td>
            <td>=</td>
            <td>"; $M1 = ($MIN/2*($a1*$a1)) ; echo " $M1</td>
            
            </tr>
            <tr>
            <td >Moment 2 </td>
            <td>=</td>
            
         <td>"; 
         $Ma=(($a2*$a2*$a2)/(3*($C1 - $C2)));
         $Mb=(($a2*$a2)*($C2)/(2*($C1 - $C2)));
         $Mc = ($Ma-$Mb) ;
         $Md=(($a1*$a1*$a1)/(3*($C1 - $C2)));
         $Me=(($a1*$a1)*($C2)/(2*($C1 - $C2)));
         $Mf = ($Md-$Me) ;
         $M2 = ($Mc-$Mf) ; echo " $M2
         </td>
                  
            </tr>
            <tr>
            <td >Moment 3 </td>
            <td>=</td>
            <td>"; $M3 = (($MAX/2*($C1*$C1)) - ($MAX/2*($a2*$a2))); echo " $M3</td>
            
            </tr>
            <table width='100%' class='table'>
            <tr>
               <td>Luas 1<td>
               <td>=</td>
               <td>"; $L1 = (($MIN)* ($a1)) ; echo "$L1</td></tr>
               <tr>
               <td>Luas 2<td>
               <td>=</td> 
         <td>";
         $La=(($A1-$X)/($A1-$A2));
         $Lb=(($B1-$Y)/($B1-$B2));
         $Lc = ($La+$Lb);
         $Ld=($a2-$a1);
         $Le=($Lc*$Ld);
         $Lf = ($Le/2) ;
         $L2 = $Lf; echo " $L2</td>
         </tr>
         <tr>
               <td>Luas 3<td>
               <td>=</td>
               <td>";$L3 = (($MAX*($C1)) - ($MAX*($a2))); echo " $L3</td></tr>
            </tr>
            </table>
            <br>
            <table width='100%' class='table'>
            <tr>
            <td>Nilai Z<td>
               <td>=</td>
            <td>";
            $Z1 = (($M1+$M2+$M3));
            $Z2 = (($L1+$L2+$L3));
            $Z3 = ($Z1/$Z2); echo " $Z3</td></tr>
            </table>
            
            <br>
      </table>
         </table>";
         $tanggal_penggajian = date('Y-m-d');
         $total_gaji = (int) $Z3;
            $query = mysqli_query($koneksi,"INSERT INTO detail_penggajian_m (kode_detail_pm,kode_mekanik,lama_kerja,lama_lembur,total_gaji,tanggal_penggajian) VALUES (NULL,'$kode_mekanik','$X','$Y','$total_gaji','$tanggal_penggajian')"); 
         //   if($query)
         //   {
         //       echo "<script>window.location = 'admin.php?halaman=v_penggajian'</script>";
         //   }
       }
      
       ?>
       <h4>Total Gaji : <?php echo format_ribuan($total_gaji) ?></h4>
       <a href="?halaman=add_penggajian" class="btn btn-primary">Lakukan Penggajian Lagi</a>
    </div>
</div>