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

  function testF994986() {
    $id = "994986";
    $loc = "f";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'994986');
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
    $this->assertEquals($item->status,'<b>Item status:</b> Not Charged');
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

  function testEx2289437() {
    $id = "2289437";
    $loc = "ex";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'2289437');
    $this->assertEquals($item->location,'C-8-H');
    $this->assertEquals($item->fl,'C');
    $this->assertEquals($item->lc,'f');
    $this->assertEquals($item->callnum,'PR6066.I53 P6 1971');
    $this->assertEquals($item->call_display,'PR6066.I53 P6 1971');
    $this->assertEquals($item->image,'C-8-H=RBSC.SWF');
    $this->assertEquals($item->legend,'legend.PNG');
    $this->assertNull($item->ref);
    $this->assertNull($item->site);
    $this->assertNull($item->charged);
    $this->assertEquals($item->status,'');
    $this->assertEquals($item->subject,'Rare Books (Ex)');
    $this->assertEquals($item->message,'This item should be requested from the catalog record and must be consulted in Rare Books and Special Collections (C-8-H Firestone Library).');
    $this->assertEquals($item->floorDB,'f_C');
    $this->assertEquals($item->start_x,'330');
    $this->assertEquals($item->start_y,'370');
    $this->assertEquals($item->end_x,'310');
    $this->assertEquals($item->end_y,'320');
    $this->assertEquals($item->shift_x,'12');
    $this->assertEquals($item->shift_y,'12');
    $this->assertEquals($item->scale_x,'1.02');
    $this->assertEquals($item->scale_y,'1.02');
    $this->assertEquals($item->tmp_location,'');
    $this->assertNull($item->external);
    $this->assertNull($item->branch);
    $this->assertEquals($item->designated,true);
  }

  // Missing item with richardson call number should map to the front desk
  function testF2289437() {
    $id = "2289437";
    $loc = "f";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'2289437');
    $this->assertEquals($item->location,'1-10-F');
    $this->assertEquals($item->fl,'1');
    $this->assertEquals($item->lc,'f');
    $this->assertEquals($item->callnum,'3891.5.1971.2');
    $this->assertEquals($item->call_display,'3891.5.1971.2');
    $this->assertEquals($item->image,'new-circ-desk.SWF');
    $this->assertEquals($item->legend,'legend.PNG');
    $this->assertNull($item->ref);
    $this->assertNull($item->site);
    $this->assertEquals($item->charged,'false');
    $this->assertEquals($item->status,'<b>Item status:</b> Not Charged,Missing');
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

  function testF1459952() {
    $id = "1459952";
    $loc = "f";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'1459952');
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
    $this->assertEquals($item->status,'<b>Item status:</b> Not Charged');
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
  function testF2268255() {
    $id = "2268255";
    $loc = "f";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'2268255');
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
    $this->assertEquals($item->status,'<b>Item status:</b> Not Charged');
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

  function testF1927472() {
    $id = "1927472";
    $loc = "f";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'1927472');
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
    $this->assertEquals($item->status,'<b>Item status:</b> Not Charged,Missing');
    $this->assertEquals($item->subject,'Economics. Sociology');
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

  function testF736487() {
    $id = "736487";
    $loc = "f";
    $item = $this->item_proc->get_item("", $loc, $id);
    $this->assertEquals($item->id,'736487');
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
    $this->assertEquals($item->status,'<b>Item status:</b> Not Charged');
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

  // missing copy should go to the non missing location
  function testF1273320() {
    $id = "1273320";
    $loc = "f";
    $item = $this->item_proc->get_item("", $loc, $id);

    $this->assertEquals($item->id,'1273320');
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
    $this->assertEquals($item->status,'<b>Item status:</b> Not Charged');
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
}