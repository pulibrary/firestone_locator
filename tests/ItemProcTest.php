<?php
include_once(__DIR__ .'/../includes/item_proc.php');
include_once(__DIR__ .'/../includes/db_functions.php');
class ItemProdTest extends \PHPUnit\Framework\TestCase {


  protected function setUp() {
    $this->item_proc = new ItemProc();
  }

  function testF11553618() {
    $id = "11553618";
    $loc = "f";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'11553618');
    $this->assertEquals($item->location,'B-12-B');
    $this->assertEquals($item->fl,'B');
    $this->assertEquals($item->lc,'f');
    $this->assertEquals($item->callnum,'HD.0060.B8843.2020');
    $this->assertEquals($item->call_display,'HD60 .B8843 2020');
    $this->assertEquals($item->image,'B-12-B=HA1244.S-HD77.SWF');
    $this->assertEquals($item->legend,'legend.PNG');
    $this->assertNull($item->ref);
    $this->assertNull($item->site);
    $this->assertEquals($item->charged,'false');
    $this->assertEquals($item->status,'<b>Item status:</b> Not Charged');
    $this->assertEquals($item->subject,'Economics');
    $this->assertNull($item->message);
    $this->assertEquals($item->floorDB,'f_B');
    $this->assertEquals($item->start_x,'340');
    $this->assertEquals($item->start_y,'300');
    $this->assertEquals($item->end_x,'460');
    $this->assertEquals($item->end_y,'480');
    $this->assertEquals($item->shift_x,'70');
    $this->assertEquals($item->shift_y,'4');
    $this->assertEquals($item->scale_x,'0.96');
    $this->assertEquals($item->scale_y,'0.96');
    $this->assertEquals($item->tmp_location,'');
    $this->assertNull($item->external);
    $this->assertNull($item->branch);
    $this->assertEquals($item->designated,true);
  }

  function testF1661451() {
    $id = "1661451";
    $loc = "f";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'1661451');
    $this->assertEquals($item->location,'1-10-F');
    $this->assertEquals($item->fl,'1');
    $this->assertEquals($item->lc,'f');
    $this->assertEquals($item->callnum,'30108.261');
    $this->assertEquals($item->call_display,'30108.261');
    $this->assertEquals($item->image,'new-circ-desk.SWF');
    $this->assertEquals($item->legend,'legend.PNG');
    $this->assertNull($item->ref);
    $this->assertNull($item->site);
    $this->assertEquals($item->charged,'false');
    $this->assertEquals($item->status,'<b>Item status:</b> Not Charged,Lost--Library Applied');
    $this->assertEquals($item->subject,'Items awaiting reclassification');
    $this->assertEquals($item->message,'Use the online trace request or ask at the Circulation/Reserve Desk to request items in (F) with call numbers from 0100 through 9999.');
    $this->assertEquals($item->floorDB,'f_1');
    $this->assertEquals($item->start_x,'290');
    $this->assertEquals($item->start_y,'260');
    $this->assertEquals($item->end_x,'380');
    $this->assertEquals($item->end_y,'270');
    $this->assertEquals($item->shift_x,'1');
    $this->assertEquals($item->shift_y,'1');
    $this->assertEquals($item->scale_x,'1.08');
    $this->assertEquals($item->scale_y,'1.08');
    $this->assertEquals($item->tmp_location,'');
    $this->assertNull($item->external);
    $this->assertNull($item->branch);
    $this->assertEquals($item->designated,true);
  }

  function testRESC943304() {
    $id = "943304";
    $loc = "resc";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'943304');
    $this->assertEquals($item->location,'1-10-F');
    $this->assertEquals($item->fl,'1');
    $this->assertEquals($item->lc,'f');
    #$this->assertEquals($item->callnum,'DC.00334.D37.1985');
    $this->assertEquals($item->call_display,'DC33.4 .D37 1985');
    $this->assertEquals($item->image,'new-circ-desk.SWF');
    $this->assertEquals($item->legend,'legend.PNG');
    $this->assertNull($item->ref);
    $this->assertNull($item->site);
    $this->assertEquals($item->charged,'false');
    #$this->assertEquals($item->status,'<b>Item status:</b> Not Charged');
    $this->assertEquals($item->subject,'Firestone 3 Hour Reserve (RES). Firestone Circulation Desk');
    $this->assertNull($item->message);
    $this->assertEquals($item->floorDB,'f_1');
    $this->assertEquals($item->start_x,'290');
    $this->assertEquals($item->start_y,'260');
    $this->assertEquals($item->end_x,'380');
    $this->assertEquals($item->end_y,'270');
    $this->assertEquals($item->shift_x,'1');
    $this->assertEquals($item->shift_y,'1');
    $this->assertEquals($item->scale_x,'1.08');
    $this->assertEquals($item->scale_y,'1.08');
    $this->assertEquals($item->tmp_location,'');
    $this->assertNull($item->external);
    $this->assertNull($item->branch);
    $this->assertEquals($item->designated,true);
  }

  function testRESC9573790() {
    $id = "9573790";
    $loc = "resc";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'9573790');
    $this->assertEquals($item->location,'1-10-F');
    $this->assertEquals($item->fl,'1');
    $this->assertEquals($item->lc,'f');
    #$this->assertEquals($item->callnum,'HD.728796.U6.D47--2016');
    $this->assertEquals($item->call_display,'HD7287.96.U6 D47 2016');
    $this->assertEquals($item->image,'new-circ-desk.SWF');
    $this->assertEquals($item->legend,'legend.PNG');
    $this->assertNull($item->ref);
    $this->assertNull($item->site);
    $this->assertEquals($item->charged,'false');
    #$this->assertEquals($item->status,'<b>Item status:</b> Not Charged');
    $this->assertEquals($item->subject,'Firestone 3 Hour Reserve (RES). Firestone Circulation Desk');
    $this->assertNull($item->message);
    $this->assertEquals($item->floorDB,'f_1');
    $this->assertEquals($item->start_x,'290');
    $this->assertEquals($item->start_y,'260');
    $this->assertEquals($item->end_x,'380');
    $this->assertEquals($item->end_y,'270');
    $this->assertEquals($item->shift_x,'1');
    $this->assertEquals($item->shift_y,'1');
    $this->assertEquals($item->scale_x,'1.08');
    $this->assertEquals($item->scale_y,'1.08');
    $this->assertEquals($item->tmp_location,'');
    $this->assertNull($item->external);
    $this->assertNull($item->branch);
    $this->assertEquals($item->designated,true);
  }

  function testRESC10926564() {
    $id = "10926564";
    $loc = "resc";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'10926564');
    $this->assertEquals($item->location,'1-10-F');
    $this->assertEquals($item->fl,'1');
    $this->assertEquals($item->lc,'f');
    #$this->assertEquals($item->callnum,'HD.728796.U6.D47--2016');
    $this->assertEquals($item->call_display,'D21 .W94 2018');
    $this->assertEquals($item->image,'new-circ-desk.SWF');
    $this->assertEquals($item->legend,'legend.PNG');
    $this->assertNull($item->ref);
    $this->assertNull($item->site);
    $this->assertEquals($item->charged,'false');
    #$this->assertEquals($item->status,'<b>Item status:</b> Not Charged');
    $this->assertEquals($item->subject,'Firestone 3 Hour Reserve (RES). Firestone Circulation Desk');
    $this->assertNull($item->message);
    $this->assertEquals($item->floorDB,'f_1');
    $this->assertEquals($item->start_x,'290');
    $this->assertEquals($item->start_y,'260');
    $this->assertEquals($item->end_x,'380');
    $this->assertEquals($item->end_y,'270');
    $this->assertEquals($item->shift_x,'1');
    $this->assertEquals($item->shift_y,'1');
    $this->assertEquals($item->scale_x,'1.08');
    $this->assertEquals($item->scale_y,'1.08');
    $this->assertEquals($item->tmp_location,'');
    $this->assertNull($item->external);
    $this->assertNull($item->branch);
    $this->assertEquals($item->designated,true);
  }
}