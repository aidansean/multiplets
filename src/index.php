<?php
$title = 'Multiplets' ;
include($_SERVER['FILE_PREFIX'] . '/_core/preamble.php') ;

$m_t = (isset($_GET['m_t'])) ? $_GET['m_t'] : 60 ;
$m_p = (isset($_GET['m_p'])) ? $_GET['m_p'] : 45 ;
$b_t = (isset($_GET['b_t'])) ? $_GET['b_t'] : 72 ;
$b_p = (isset($_GET['b_p'])) ? $_GET['b_p'] : 45 ;
$m_t = round($m_t,4) ;
$m_p = round($m_p,4) ;
$b_t = round($b_t,4) ;
$b_p = round($b_p,4) ;

?>
  <p class="notice">You need a browser which is capable of displaying scalable vector graphics to view this page properly.</p>

  <p>When writing my thesis I decided that I needed some way to display the mesons and baryons in an attractive way.  So I wrote these scripts.  The different axes show quantum numbers.  \(I\) is the isospin of the particle, \(Y\) is the hypercharge of the particle, and \(C\) is the charm of the particle.  This choice of coordinates allows us to represent four numbers in three dimensions.</p>
  
  <div class="right">
  <h3>Mesons</h3>
    <div class="blurb">
      <p>The \(SU(4)\) flavour group of mesons can be displayed in an elegant multiplet.  This svg file shows one of the arrangements.  You can rotate the multiplet to see it from a different angle.</p>
      <form action="index.php" method="GET">
        <table class="centered">
          <tr><th>\(\theta\) (Polar angle):</th><td><input class="narrow" type="text" name="m_t" value="<?php echo $m_t ;?>"/></td></tr>
          <tr><th>\(\phi\) (Azimuthal angle):</th><td><input class="narrow" type="text" name="m_p" value="<?php echo $m_p ;?>"/></td></tr>
          <tr><th><input type="hidden" name="b_t" value="<?php echo $b_t ;?>"/><input type="hidden" name="b_p" value="<?php echo $b_p ;?>"/></th><td><input type="submit" value="Change view"/></td></tr>
        </table>
      </form>
      <div class="center"><object type="image/svg+xml" data="mesons.php?<?php echo 'theta=' , $m_t , '&amp;phi=' , $m_p ?>" name="Mesons" width="550px" height="700px" ></object></div>
    </div>
  </div>
  
  <div class="right">
    <h3>Baryons</h3>
    <div class="blurb">
      <p>The baryons are not as well known as the mesons, so only some of the states appear in this multiplet.  The baryonic structure is not quite as rich as the mesonic structure.</p>
      <form action="index.php" method="GET">
        <table class="centered">
          <tr><th>\(\theta\) (Polar angle):</th><td><input class="narrow" type="text" name="b_t" value="<?php echo $b_t ;?>"/></td></tr>
          <tr><th>\(\phi\) (Azimuthal angle):</th><td><input class="narrow" type="text" name="b_p" value="<?php echo $b_p ;?>"/></td></tr>
          <tr><th><input type="hidden" name="m_t" value="<?php echo $m_t ;?>"/><input type="hidden" name="m_p" value="<?php echo $m_p ;?>"/></th><td><input type="submit" value="Change view"/></td></tr>
        </table>
      </form>
      <div class="center"><object type="image/svg+xml" data="baryons.php?<?php echo 'theta=' , $b_t , '&amp;phi=' , $b_p ?>" name="Baryons" width="550px" height="700px" ></object></div>
      <h4>The light baryon octet and decuplet</h4>
      <div class="center"><object type="image/svg+xml" data="baryon_octet.php" name="Baryons" width="400px" height="400px" ></object></div>
      <div class="center"><object type="image/svg+xml" data="baryon_decuplet.php" name="Baryons" width="500px" height="500px" ></object></div>
    </div>
  </div>
    
<?php foot() ; ?>
