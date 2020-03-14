<div class='tableGroup'>
   <div class='boxHeading'> BidRequest ID: <?php print $current->BidRequestID; ?></div>
   <div class='fieldcontainer'>
      <span class='fieldcolumn fieldfloater'>
         <div class='contentField'><span class='fieldLabel'>Pickup Location</span><input type='text' name='BidRequest[<?php print $current->BidRequestID; ?>][PickupLocation]' id='PickupLocation' value='<?php print $current->PickupLocation; ?>' size='27' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Activity</span><input type='text' name='BidRequest[<?php print $current->BidRequestID; ?>][Activity]' id='Activity' value='<?php print $current->Activity; ?>' size='19' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Drop Off Location</span><input type='text' name='BidRequest[<?php print $current->BidRequestID; ?>][DropOffLocation]' id='DropOffLocation' value='<?php print $current->DropOffLocation; ?>' size='40' class='boxValue' /></div>

         <div class='contentField'><span class='fieldLabel'>Drop Off Address</span><input type='text' name='BidRequest[<?php print $current->BidRequestID; ?>][DropOffAddress]' id='DropOffAddress' value='<?php print $current->DropOffAddress; ?>' size='50' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Weekday</span><input type='text' name='BidRequest[<?php print $current->BidRequestID; ?>][Weekday]' id='Weekday' value='<?php print $current->Weekday; ?>' size='10' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>DATE</span><input type='text' name='BidRequest[<?php print $current->BidRequestID; ?>][DATE]' id='DATE' value='<?php print $current->DATE; ?>' size='11' class='boxValue' /></div>
      </span>
      <span class='fieldcolumn'>
         <div class='contentField'><span class='fieldLabel'>Pickup Time</span><input type='text' name='BidRequest[<?php print $current->BidRequestID; ?>][PickupTime]' id='PickupTime' value='<?php print $current->PickupTime; ?>' size='9' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Board Time</span><input type='text' name='BidRequest[<?php print $current->BidRequestID; ?>][BoardTime]' id='BoardTime' value='<?php print $current->BoardTime; ?>' size='9' class='boxValue' /></div>

         <div class='contentField'><span class='fieldLabel'>Return Time</span><input type='text' name='BidRequest[<?php print $current->BidRequestID; ?>][ReturnTime]' id='ReturnTime' value='<?php print $current->ReturnTime; ?>' size='9' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Trip Type</span><input type='text' name='BidRequest[<?php print $current->BidRequestID; ?>][TripType]' id='TripType' value='<?php print $current->TripType; ?>' size='13' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Passengers</span><input type='password' name='BidRequest[<?php print $current->BidRequestID; ?>][Passengers]' id='Passengers' value='<?php print $current->Passengers; ?>' size='2' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>Quote Amount</span><input type='text' name='BidRequest[<?php print $current->BidRequestID; ?>][QuoteAmount]' id='QuoteAmount' value='<?php print $current->QuoteAmount; ?>' size='2' class='boxValue' /></div>
         <div class='contentField'><span class='fieldLabel'>NOTES</span><input type='text' name='BidRequest[<?php print $current->BidRequestID; ?>][NOTES]' id='NOTES' value='<?php print $current->NOTES; ?>' size='2' class='boxValue' /></div>
      </span>

   </div>
</div>
