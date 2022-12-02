<?php
include_once(__DIR__ .'/../includes/item_proc.php');
include_once(__DIR__ .'/../includes/db_functions.php');
class CompareProdTest extends \PHPUnit\Framework\TestCase {


  protected function setUp(): void {
    $this->link_array = [ 
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=99101564703506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=9932088913506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=9964058723506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=9953633543506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=9936627333506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=9999076713506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=99100758503506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=9989632553506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=9999995153506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=995378873506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=996928733506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=9995572493506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=99108773313506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=998031193506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=9954011513506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=999677713506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=992664353506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=9938515173506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=994565053506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=999010683506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=9923211213506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=992383683506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=9996856973506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=9921882853506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=9913403183506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=9913403183506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=998072163506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=995306003506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=f&id=9979305393506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=resc&id=999433043506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=resc&id=9995737903506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=resc&id=99109265643506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=fac&id=99109265643506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=docsm&id=9942129373506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=flm&id=9936046933506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=flm&id=9933017143506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=flmb&id=9982288913506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=flm&id=9933740663506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=flm&id=9933003493506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=flm&id=99102208633506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=flm&id=99102156793506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=zeis&id=9933776893506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=docs&id=9970837613506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=nec&id=9971128923506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=docs&id=9979927313506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=pres&id=9959662713506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=sh&id=99597773506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=spc&id=991245803506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=clas&id=9913320773506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=se&id=993727283506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=clas&id=993727283506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=clas&id=997356133506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=clas&id=999884553506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=rsne&id=9928397693506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=pres&id=9960631653506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=resc&id=9910875463506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=resc&id=992094703506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=resc&id=9910288183506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=resc&id=9948309413506421&embed=true',
    'http://firestone-book-locater.lndo.site/index.php?loc=resc&id=9960954253506421&embed=true',
    ];
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