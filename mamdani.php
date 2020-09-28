
    <html>
    <head>
    <title>**Mamdani**</title>
    </head>
    <body>
     
     <h3>Mamdani</h3> 
      <?php
       
      
      if(isset($_POST['gaji_karyawan']))
      {
       $A1  = 31;
       $A2  = 1;
       $B1  = 20;
       $B2  = 5;
       $C1  = 5000000;
       $C2  = 2000000;
       $X  = $_POST['lama_kerja'];
       $Y  = $_POST['lama_lembur'];
       echo"<table width='100%' border='1' style='border-collapse:collapse; border-color:#CCCCFF;'>
       <tr align='center'>
        <td>VARIABEL</td>
        <td width='10%'>MAX</td>
        <td width='10%'>MIN</td>
       </tr>
       <tr>
        <td>Permintaan</td>
        <td align='center'>$A1</td>
        <td align='center'>$A2</td>
       </tr>
       <tr>
        <td NoWrap>Persediaan</td>
        <td align='center'>$B1</td>
        <td align='center'>$B2</td>
       </tr>
       <tr>
        <td NoWrap>Produksi</td>
        <td align='center'>$C1</td>
        <td align='center'>$C2</td>
       </tr>
       <tr>
        <td>Nilai x permintaan</td>
        <td colspan='2' align='center'>$X</td>
       </tr>
       <tr>
        <td>Nilai y persediaan</td>
        <td colspan='2' align='center'>$Y</td>
       </tr>
      </table>
      
      <br>
   
      <table width='100%' border='0' style='border-collapse:collapse;'>
       <tr><td Colspan='7'><b>Permintaan</b> :terkecil dan terbesar</td></tr>
       <tr>
        <td width='30%' NoWrap>
         Permintaan naik[$X]
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
         Permintaan turun[$X]
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
   
      <tr><td Colspan='7'><br><b>Persediaan</b> : sedikit dan banyak</td></tr>
      <tr>
       <td NoWrap>
        Persediaan banyak[$Y]
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
        Persediaan sedikit[$Y]
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
     <table width='98%' border='0'>
   
      <tr>
       <td width='5%'>&nbsp;</td>
      
       <td width='10%' NoWrap>
        predikat1
       </td>
       <td width='5%' align='center'>=</td>
       <td>
        Permintaan turun[$X] 
        
        Persediaan banyak[$Y]
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
   
     <table width='98%' border='0'>
      <tr>
       <td width='5%'>&nbsp;</td>
     
       <td width='10%' NoWrap>
        predikat2
       </td>
       <td width='5%' align='center'>=</td>
       <td>
        Permintaan Turun[$X] 
        
        Persediaan sedikit[$Y]
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
   
     <table width='98%' border='0'>
      <tr>
       <td width='5%'>&nbsp;</td>
     
       <td width='10%' NoWrap>
        predikat3
       </td>
       <td width='5%' align='center'>=</td>
       <td>
        Permintaan naik[$X] 
        
        Persediaan banyak[$Y]
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
   
     <table width='98%' border='0'>
      <tr>
       <td width='5%'>&nbsp;</td>
      
       <td width='10%' NoWrap>
        predikat4
       </td>
       <td width='5%' align='center'>=</td>
       <td>
        Persediaan naik[$X] 
        
        Persediaan Sedikit[$Y]
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
    <table>
      <tr>
      <td>
      </td>
       
       <td>Nilai keanggotaan Terkecil &nbsp;</td>
       <td>&nbsp;</td>
       <td>=</td>
       <td>"; $MIN = Min($P1,$P2,$P3,$P4); echo "$MIN</td>
      </tr>
    
      <tr>
       <td>Nilai keanggotaan Terbesar </td>
       <td>&nbsp;</td>
       
       <td>=</td>
       <td>"; $MAX = MAX($P1,$P2,$P3,$P4); echo "$MAX</td>
      </tr>
      <tr>
       <td>Nilai a1 </td>
       <td>&nbsp;</td>
       
       <td>=</td>
       <td>"; $a1 = ( $C2 + ( $MIN * ( $C1 - $C2 ))); echo "$a1</td>
      </tr>
      <tr>
       <td>Nilai a2 </td>
       <td>&nbsp;</td>
       
       <td>=</td>
       <td>"; $a2 = ( $C2 + ( $MAX * ( $C1 - $C2 ))); echo "$a2</td>
      </tr>
    
        <tr>
           <td>Nilai A1 </td>
          <td>&nbsp;</td>
          <td>Moment 1 = <td>
          
          <td>"; $M1 = ($MIN/2*($a1*$a1)) ; echo " $M1</td>
          
        </tr>
        <tr>
         <td>Nilai A2 </td>
         <td>&nbsp;</td>
         <td >Moment 2 = </td>
        
         <td>"; $Ma=(($a2*$a2*$a2)/(3*($C1 - $C2)));echo " </td>
         <td>"; $Mb=(($a2*$a2)*($C2)/(2*($C1 - $C2)));echo " </td>
         <td>"; $Mc = ($Ma-$Mb) ; echo " </td>

        <td>"; $Md=(($a1*$a1*$a1)/(3*($C1 - $C2)));echo " </td>
         <td>"; $Me=(($a1*$a1)*($C2)/(2*($C1 - $C2)));echo " </td>
         <td>"; $Mf = ($Md-$Me) ; echo " </td>
         
      <td>"; $M2 = ($Mc-$Mf) ; echo " $M2</td>
             
       </tr>
       <tr>
         <td >Nilai A3 </td>
         <td>&nbsp;</td>
         <td >Moment 3 = </td>
         <td>&nbsp;</td>
        <td>"; $M3 = (($MAX/2*($C1*$C1)) - ($MAX/2*($a2*$a2))); echo " $M3</td>
        
       </tr>
       <table>
       <tr>
          <td>Luas 1 = <td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>"; $L1 = (($MIN)* ($a1)) ; echo "$L1</td></tr>
          <tr>
          <td>Luas 2 = <td>
          <td>&nbsp;</td>
         <td>"; $La=(($A1-$X)/($A1-$A2));echo "</td>
         <td>"; $Lb=(($B1-$Y)/($B1-$B2));echo " </td>
         <td>"; $Lc = ($La+$Lb) ; echo "</td>

        <td>"; $Ld=($a2-$a1);echo " </td>
         <td>"; $Le=($Lc*$Ld);echo "  </td>
         <td>"; $Lf = ($Le/2) ; echo " </td>

      <td>"; $L2 = $Lf; echo " $L2</td>
      </tr>
      <tr>
          <td>Luas 3 = <td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>";$L3 = (($MAX*($C1)) - ($MAX*($a2))); echo " $L3</td></tr>
       </tr>
       </table>
       <br>
       <table>
       <td>";$Z1 = (($M1+$M2+$M3)); echo " $Z1</td></tr>
       <td>";$Z2 = (($L1+$L2+$L3)); echo " $Z2</td></tr>
       <td>Z total = <td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
       <td>";$Z3 = ($Z1/$Z2); echo " $Z3</td></tr>
       </table>
       
       <br>
   </table>
    </table>";

      }
      else 
      {
         $A1  = 31;
         $A2  = 1;
         $B1  = 20;
         $B2  = 5;
         $C1  = 5000000;
         $C2  = 2000000;
         $X  = $_POST['lama_kerja'];
         $Y  = $_POST['lama_lembur'];
         echo"<table width='100%' border='1' style='border-collapse:collapse; border-color:#CCCCFF;'>
         <tr align='center'>
          <td>VARIABEL</td>
          <td width='10%'>MAX</td>
          <td width='10%'>MIN</td>
         </tr>
         <tr>
          <td>Permintaan</td>
          <td align='center'>$A1</td>
          <td align='center'>$A2</td>
         </tr>
         <tr>
          <td NoWrap>Persediaan</td>
          <td align='center'>$B1</td>
          <td align='center'>$B2</td>
         </tr>
         <tr>
          <td NoWrap>Produksi</td>
          <td align='center'>$C1</td>
          <td align='center'>$C2</td>
         </tr>
         <tr>
          <td>Nilai x permintaan</td>
          <td colspan='2' align='center'>$X</td>
         </tr>
         <tr>
          <td>Nilai y persediaan</td>
          <td colspan='2' align='center'>$Y</td>
         </tr>
        </table>
        
        <br>
     
        <table width='100%' border='0' style='border-collapse:collapse;'>
         <tr><td Colspan='7'><b>Permintaan</b> :terkecil dan terbesar</td></tr>
         <tr>
          <td width='30%' NoWrap>
           Permintaan naik[$X]
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
           Permintaan turun[$X]
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
     
        <tr><td Colspan='7'><br><b>Persediaan</b> : sedikit dan banyak</td></tr>
        <tr>
         <td NoWrap>
          Persediaan banyak[$Y]
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
          Persediaan sedikit[$Y]
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
       <table width='98%' border='0'>
     
        <tr>
         <td width='5%'>&nbsp;</td>
        
         <td width='10%' NoWrap>
          predikat1
         </td>
         <td width='5%' align='center'>=</td>
         <td>
          Permintaan turun[$X] 
          
          Persediaan banyak[$Y]
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
     
       <table width='98%' border='0'>
        <tr>
         <td width='5%'>&nbsp;</td>
       
         <td width='10%' NoWrap>
          predikat2
         </td>
         <td width='5%' align='center'>=</td>
         <td>
          Permintaan Turun[$X] 
          
          Persediaan sedikit[$Y]
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
     
       <table width='98%' border='0'>
        <tr>
         <td width='5%'>&nbsp;</td>
       
         <td width='10%' NoWrap>
          predikat3
         </td>
         <td width='5%' align='center'>=</td>
         <td>
          Permintaan naik[$X] 
          
          Persediaan banyak[$Y]
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
     
       <table width='98%' border='0'>
        <tr>
         <td width='5%'>&nbsp;</td>
        
         <td width='10%' NoWrap>
          predikat4
         </td>
         <td width='5%' align='center'>=</td>
         <td>
          Persediaan naik[$X] 
          
          Persediaan Sedikit[$Y]
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
      <table>
        <tr>
        <td>
        </td>
         
         <td>Nilai keanggotaan Terkecil &nbsp;</td>
         <td>&nbsp;</td>
         <td>=</td>
         <td>"; $MIN = Min($P1,$P2,$P3,$P4); echo "$MIN</td>
        </tr>
      
        <tr>
         <td>Nilai keanggotaan Terbesar </td>
         <td>&nbsp;</td>
         
         <td>=</td>
         <td>"; $MAX = MAX($P1,$P2,$P3,$P4); echo "$MAX</td>
        </tr>
        <tr>
         <td>Nilai a1 </td>
         <td>&nbsp;</td>
         
         <td>=</td>
         <td>"; $a1 = ( $C2 + ( $MIN * ( $C1 - $C2 ))); echo "$a1</td>
        </tr>
        <tr>
         <td>Nilai a2 </td>
         <td>&nbsp;</td>
         
         <td>=</td>
         <td>"; $a2 = ( $C2 + ( $MAX * ( $C1 - $C2 ))); echo "$a2</td>
        </tr>
      
          <tr>
             <td>Nilai A1 </td>
            <td>&nbsp;</td>
            <td>Moment 1 = <td>
            
            <td>"; $M1 = ($MIN/2*($a1*$a1)) ; echo " $M1</td>
            
          </tr>
          <tr>
           <td>Nilai A2 </td>
           <td>&nbsp;</td>
           <td >Moment 2 = </td>
          
           <td>"; $Ma=(($a2*$a2*$a2)/(3*($C1 - $C2)));echo " </td>
           <td>"; $Mb=(($a2*$a2)*($C2)/(2*($C1 - $C2)));echo " </td>
           <td>"; $Mc = ($Ma-$Mb) ; echo " </td>
  
          <td>"; $Md=(($a1*$a1*$a1)/(3*($C1 - $C2)));echo " </td>
           <td>"; $Me=(($a1*$a1)*($C2)/(2*($C1 - $C2)));echo " </td>
           <td>"; $Mf = ($Md-$Me) ; echo " </td>
           
        <td>"; $M2 = ($Mc-$Mf) ; echo " $M2</td>
               
         </tr>
         <tr>
           <td >Nilai A3 </td>
           <td>&nbsp;</td>
           <td >Moment 3 = </td>
           <td>&nbsp;</td>
          <td>"; $M3 = (($MAX/2*($C1*$C1)) - ($MAX/2*($a2*$a2))); echo " $M3</td>
          
         </tr>
         <table>
         <tr>
            <td>Luas 1 = <td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>"; $L1 = (($MIN)* ($a1)) ; echo "$L1</td></tr>
            <tr>
            <td>Luas 2 = <td>
            <td>&nbsp;</td>
           <td>"; $La=(($A1-$X)/($A1-$A2));echo "</td>
           <td>"; $Lb=(($B1-$Y)/($B1-$B2));echo " </td>
           <td>"; $Lc = ($La+$Lb) ; echo "</td>
  
          <td>"; $Ld=($a2-$a1);echo " </td>
           <td>"; $Le=($Lc*$Ld);echo "  </td>
           <td>"; $Lf = ($Le/2) ; echo " </td>
  
        <td>"; $L2 = $Lf; echo " $L2</td>
        </tr>
        <tr>
            <td>Luas 3 = <td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>";$L3 = (($MAX*($C1)) - ($MAX*($a2))); echo " $L3</td></tr>
         </tr>
         </table>
         <br>
         <table>
         <td>";$Z1 = (($M1+$M2+$M3)); echo " $Z1</td></tr>
         <td>";$Z2 = (($L1+$L2+$L3)); echo " $Z2</td></tr>
         <td>Z total = <td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
         <td>";$Z3 = ($Z1/$Z2); echo " $Z3</td></tr>
         </table>
         
         <br>
     </table>
      </table>";

      }
     
      ?> 
     
    </body>
    </html>
