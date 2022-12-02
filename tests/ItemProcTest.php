<?php
include_once(__DIR__ .'/../includes/item_proc.php');
include_once(__DIR__ .'/../includes/db_functions.php');
class ItemProdTest extends \PHPUnit\Framework\TestCase {


  protected function setUp() {
    $this->item_proc = new ItemProc();
  }

  function testF99115536183506421() {
    $id = "99115536183506421";
    $loc = "f";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'99115536183506421');
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

  function testF9916614513506421() {
    $id = "9916614513506421";
    $loc = "f";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'9916614513506421');
    $this->assertEquals($item->location,'1-10-F');
    $this->assertEquals($item->fl,'1');
    $this->assertEquals($item->lc,'f');
    $this->assertEquals($item->callnum,'30108.261');
    $this->assertEquals($item->call_display,'30108.261');
    $this->assertEquals($item->image,'new-circ-desk.SWF');
    $this->assertEquals($item->legend,'legend.PNG');
    $this->assertNull($item->ref);
    $this->assertNull($item->site);
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

  function testRESC999433043506421() {
    $id = "999433043506421";
    $loc = "resc";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'999433043506421');
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

  function testRESC9995737903506421() {
    $id = "9995737903506421";
    $loc = "resc";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'9995737903506421');
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

  function testRESC99109265643506421() {
    $id = "99109265643506421";
    $loc = "resc";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'99109265643506421');
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

  function testF999949863506421() {
    $id = "999949863506421";
    $loc = "f";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'999949863506421');
    $this->assertEquals($item->location,'B13-M');
    $this->assertEquals($item->fl,'B');
    $this->assertEquals($item->lc,'f');
    $this->assertEquals($item->callnum,'PR.4030.1939');
    $this->assertEquals($item->call_display,'PR4030 1939');
    $this->assertEquals($item->image,'B-9-M=PR4073.B-PR1.SWF');
    $this->assertEquals($item->legend,'legend.PNG');
    $this->assertNull($item->ref);
    $this->assertNull($item->site);
    $this->assertEquals($item->charged,'false');
    $this->assertEquals($item->subject,'Language and literature');
    $this->assertNull($item->message);
    $this->assertEquals($item->floorDB,'f_B');
    $this->assertEquals($item->start_x,'340');
    $this->assertEquals($item->start_y,'300');
    $this->assertEquals($item->end_x,'470');
    $this->assertEquals($item->end_y,'140');
    $this->assertEquals($item->shift_x,'70');
    $this->assertEquals($item->shift_y,'4');
    $this->assertEquals($item->scale_x,'0.96');
    $this->assertEquals($item->scale_y,'0.96');
    $this->assertEquals($item->tmp_location,'');
    $this->assertNull($item->external);
    $this->assertNull($item->branch);
    $this->assertEquals($item->designated,true);
  }

  // Missing item with richardson call number should map to the front desk
  function testF9922894373506421() {
    $id = "9922894373506421";
    $loc = "f";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'9922894373506421');
    $this->assertEquals($item->location,'1-10-F');
    $this->assertEquals($item->fl,'1');
    $this->assertEquals($item->lc,'f');
    $this->assertEquals($item->callnum,'3891.5.1971.2');
    $this->assertEquals($item->call_display,'3891.5.1971.2');
    $this->assertEquals($item->image,'new-circ-desk.SWF');
    $this->assertEquals($item->legend,'legend.PNG');
    $this->assertNull($item->ref);
    $this->assertNull($item->site);
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

  function testF9914599523506421() {
    $id = "9914599523506421";
    $loc = "f";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'9914599523506421');
    $this->assertEquals($item->location,'B-9-L');
    $this->assertEquals($item->fl,'B');
    $this->assertEquals($item->lc,'f');
    $this->assertEquals($item->callnum,'PR.4382.Q4.1935.B');
    $this->assertEquals($item->call_display,'PR4382 .Q4 1935b');
    $this->assertEquals($item->image,'B-9-L=PR4037.B-PR9680.SWF');
    $this->assertEquals($item->legend,'legend.PNG');
    $this->assertNull($item->ref);
    $this->assertNull($item->site);
    $this->assertEquals($item->charged,'false');
    $this->assertEquals($item->subject,'Language and literature');
    $this->assertNull($item->message);
    $this->assertEquals($item->floorDB,'f_B');
    $this->assertEquals($item->start_x,'340');
    $this->assertEquals($item->start_y,'300');
    $this->assertEquals($item->end_x,'380');
    $this->assertEquals($item->end_y,'170');
    $this->assertEquals($item->shift_x,'70');
    $this->assertEquals($item->shift_y,'4');
    $this->assertEquals($item->scale_x,'0.96');
    $this->assertEquals($item->scale_y,'0.96');
    $this->assertEquals($item->tmp_location,'');
    $this->assertNull($item->external);
    $this->assertNull($item->branch);
    $this->assertEquals($item->designated,true);
  }

  // Missing item should map to where the other copy is
  function testF9922682553506421() {
    $id = "9922682553506421";
    $loc = "f";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'9922682553506421');
    $this->assertEquals($item->location,'B-9-L');
    $this->assertEquals($item->fl,'B');
    $this->assertEquals($item->lc,'f');
    $this->assertEquals($item->callnum,'PR.4382.N5.1880');
    $this->assertEquals($item->call_display,'PR4382 .N5 1880');
    $this->assertEquals($item->image,'B-9-L=PR4037.B-PR9680.SWF');
    $this->assertEquals($item->legend,'legend.PNG');
    $this->assertNull($item->ref);
    $this->assertNull($item->site);
    $this->assertEquals($item->charged,'false');
    $this->assertNull($item->message);
    $this->assertEquals($item->floorDB,'f_B');
    $this->assertEquals($item->start_x,'340');
    $this->assertEquals($item->start_y,'300');
    $this->assertEquals($item->end_x,'380');
    $this->assertEquals($item->end_y,'170');
    $this->assertEquals($item->shift_x,'70');
    $this->assertEquals($item->shift_y,'4');
    $this->assertEquals($item->scale_x,'0.96');
    $this->assertEquals($item->scale_y,'0.96');
    $this->assertEquals($item->tmp_location,'');
    $this->assertNull($item->external);
    $this->assertNull($item->branch);
    $this->assertEquals($item->designated,true);
  }

  function testF9919274723506421() {
    $id = "9919274723506421";
    $loc = "f";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'9919274723506421');
    $this->assertEquals($item->location,'B-1-B');
    $this->assertEquals($item->fl,'B');
    $this->assertEquals($item->lc,'f');
    $this->assertEquals($item->callnum,'HM.0001.S93--NO0015');
    $this->assertEquals($item->call_display,'HM1 .S93 no.15');
    $this->assertEquals($item->image,'B-1-B=HJ1026-HV6432.V.SWF');
    $this->assertEquals($item->legend,'legend.PNG');
    $this->assertNull($item->ref);
    $this->assertNull($item->site);
    $this->assertEquals($item->charged,'false');
    $this->assertNull($item->message);
    $this->assertEquals($item->floorDB,'F_B');
    $this->assertEquals($item->start_x,'340');
    $this->assertEquals($item->start_y,'300');
    $this->assertEquals($item->end_x,'160');
    $this->assertEquals($item->end_y,'470');
    $this->assertEquals($item->shift_x,'70');
    $this->assertEquals($item->shift_y,'4');
    $this->assertEquals($item->scale_x,'0.96');
    $this->assertEquals($item->scale_y,'0.96');
    $this->assertEquals($item->tmp_location,'');
    $this->assertNull($item->external);
    $this->assertNull($item->branch);
    $this->assertEquals($item->designated,true);
  }

  function testF997364873506421() {
    $id = "997364873506421";
    $loc = "f";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'997364873506421');
    $this->assertEquals($item->location,'C-14-N');
    $this->assertEquals($item->fl,'C');
    $this->assertEquals($item->lc,'f');
    $this->assertEquals($item->callnum,'U.0240.G833.1989');
    $this->assertEquals($item->call_display,'U240 .G833 1989');
    $this->assertEquals($item->image,'C-14-N=U.SWF');
    $this->assertEquals($item->legend,'legend.PNG');
    $this->assertNull($item->ref);
    $this->assertNull($item->site);
    $this->assertEquals($item->charged,'false');
    $this->assertNull($item->message);
    $this->assertEquals($item->floorDB,'f_C');
    $this->assertEquals($item->start_x,'330');
    $this->assertEquals($item->start_y,'370');
    $this->assertEquals($item->end_x,'500');
    $this->assertEquals($item->end_y,'100');
    $this->assertEquals($item->shift_x,'12');
    $this->assertEquals($item->shift_y,'12');
    $this->assertEquals($item->scale_x,'1.02');
    $this->assertEquals($item->scale_y,'1.02');
    $this->assertEquals($item->tmp_location,'');
    $this->assertNull($item->external);
    $this->assertNull($item->branch);
    $this->assertEquals($item->designated,true);
  }

  // missing copy should go to the non missing location
  function testF9912733203506421() {
    $id = "9912733203506421";
    $loc = "f";
    $item = $this->item_proc->get_item("", $loc, $id);

    $this->assertEquals($item->id,'9912733203506421');
    $this->assertEquals($item->location,'C-14-N');
    $this->assertEquals($item->fl,'C');
    $this->assertEquals($item->lc,'f');
    $this->assertEquals($item->callnum,'U.0240.G848.1961');
    $this->assertEquals($item->call_display,'U240 .G848 1961');
    $this->assertEquals($item->image,'C-14-N=U.SWF');
    $this->assertEquals($item->legend,'legend.PNG');
    $this->assertNull($item->ref);
    $this->assertNull($item->site);
    $this->assertEquals($item->charged,'false');
    $this->assertEquals($item->subject,'Military Science');
    $this->assertNull($item->message);
    $this->assertEquals($item->floorDB,'f_C');
    $this->assertEquals($item->start_x,'330');
    $this->assertEquals($item->start_y,'370');
    $this->assertEquals($item->end_x,'500');
    $this->assertEquals($item->end_y,'100');
    $this->assertEquals($item->shift_x,'12');
    $this->assertEquals($item->shift_y,'12');
    $this->assertEquals($item->scale_x,'1.02');
    $this->assertEquals($item->scale_y,'1.02');
    $this->assertEquals($item->tmp_location,'');
    $this->assertNull($item->external);
    $this->assertNull($item->branch);
    $this->assertEquals($item->designated,true);
  }

  // A suppressed item
  function testF991213623506421() {
    $id = "991213623506421";
    $loc = "f";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'991213623506421');
    $this->assertEquals($item->location,'B-17-N');
    $this->assertEquals($item->fl,'B');
    $this->assertEquals($item->lc,'f');
    $this->assertEquals($item->callnum,'PQ.4001.S73');
    $this->assertEquals($item->call_display,'PQ4001 .S73');
    $this->assertEquals($item->image,'B-17-N=PQxxxx-PQ4876.R386.SWF');
    $this->assertEquals($item->legend,'legend.PNG');
    $this->assertNull($item->ref);
    $this->assertNull($item->site);
    $this->assertEquals($item->charged,'false');
    $this->assertEquals($item->status,'');
    $this->assertEquals($item->subject,'Language and literature');
    $this->assertNull($item->message);
    $this->assertEquals($item->floorDB,'f_B');
    $this->assertEquals($item->start_x,'340');
    $this->assertEquals($item->start_y,'300');
    $this->assertEquals($item->end_x,'540');
    $this->assertEquals($item->end_y,'100');
    $this->assertEquals($item->shift_x,'70');
    $this->assertEquals($item->shift_y,'4');
    $this->assertEquals($item->scale_x,'0.96');
    $this->assertEquals($item->scale_y,'0.96');
    $this->assertEquals($item->tmp_location,'');
    $this->assertNull($item->external);
    $this->assertNull($item->branch);
    $this->assertEquals($item->designated,true);
  } 
}