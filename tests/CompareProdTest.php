<?php
include_once(__DIR__ .'/../includes/item_proc.php');
include_once(__DIR__ .'/../includes/db_functions.php');
class CompareProdTest extends \PHPUnit\Framework\TestCase {


  protected function setUp() {
    $this->link_array = [ 
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=10156470&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=3208891&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=6405872&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=5363354&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=3662733&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=9907671&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=10075850&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=8963255&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=9999515&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=537887&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=692873&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=9557249&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=10877331&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=803119&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=5401151&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=967771&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=266435&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=3851517&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=456505&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=901068&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=2321121&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=238368&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=9685697&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=2188285&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=1340318&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=1340318&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=807216&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=530600&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=7930539&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=resc&id=943304&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=resc&id=9573790&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=resc&id=10926564&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=fac&id=10926564&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=docsm&id=4212937&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=flm&id=3604693&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=flm&id=3301714&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=flmb&id=8228891&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=flm&id=3374066&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=flm&id=3300349&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=flm&id=10220863&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=flm&id=10215679&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=zeis&id=3377689&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=docs&id=7083761&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=nec&id=7112892&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=docs&id=7992731&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=pres&id=5966271&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=sh&id=59777&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=spc&id=124580&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=clas&id=1332077&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=se&id=372728&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=clas&id=372728&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=clas&id=735613&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=clas&id=988455&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=rsne&id=2839769&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=pres&id=6063165&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=resc&id=1087546&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=resc&id=209470&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=resc&id=1028818&embed=true'];

    // production is current pointing to the wrong location
    // 'http://firestone-book-locater.lndo.site/index.php?loc=resc&id=4830941&embed=true',
    // 'http://firestone-book-locater.lndo.site/index.php?loc=resc&id=6095425&embed=true',

  }

  function testLinks() {
    $copies = count($this->link_array);
    for ($i = 0; $i < $copies; $i++) {
      $url = $this->link_array[$i];
      $prod_url = str_replace('http://firestone-book-locater.lndo.site','https://locator-prod.princeton.edu', $url);
      var_dump($url);
      var_dump($prod_url);
      $prod_data = file_get_contents($prod_url);
      $local_data = file_get_contents($url);
      $lc_field_prod =  $this->get_field($prod_data, '"lc"');
      $lc_field_local =  $this->get_field($local_data, '"lc"');
      $this->assertEquals($lc_field_prod,$lc_field_local);
      $location_field_prod =  $this->get_field($prod_data, '"location"');
      $location_field_local =  $this->get_field($local_data, '"location"');
      $this->assertEquals($location_field_prod,$location_field_local);
      $fl_field_prod =  $this->get_field($prod_data, '"fl"');
      $fl_field_local =  $this->get_field($local_data, '"fl"');
      $this->assertEquals($fl_field_prod,$fl_field_local);
      $image_field_prod =  $this->get_field($prod_data, '"image"');
      $image_field_local =  $this->get_field($local_data, '"image"');
      $this->assertEquals($image_field_prod,$image_field_local);
      $flordb_field_prod =  $this->get_field($prod_data, '"floorDB"');
      $flordb_field_local =  $this->get_field($local_data, '"floorDB"');
      $this->assertEquals($flordb_field_prod,$flordb_field_local);
      $grid_field_prod =  $this->get_field($prod_data, '"grid"');
      $grid_field_local =  $this->get_field($local_data, '"grid"');
      $this->assertEquals($grid_field_prod,$grid_field_local);
    }
  }

  function get_field($data, $field){
    $pos = strpos($data, $field);
    $after_field = substr($data,$pos);
    $pos_end = strpos($after_field,'",');
    return substr($after_field,0,$pos_end+1);
  }

}