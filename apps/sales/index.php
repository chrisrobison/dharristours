<?php
   require_once("../../lib/boss_class.php");
   $boss = new boss();
   $util = $boss->utility;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html>
   <head>
      <title>GSC: Gene Bank Order Administation</title>
      <script language='Javascript' type='text/javascript' src='lib/gscadmin.js'> </script>
      <script language='Javascript' type='text/javascript' src='lib/ui.js'> </script>
      <link rel='stylesheet' type='text/css' href='lib/gscadmin.css' />
   </head>
   <body onload='init();'>
         <div id='navbar'>
            &nbsp;
            <div id='modeButtons'>
               <div id='newBtn' class='modeButton' onclick="doNew()" onmousedown="doPush('newBtn')" onmouseup="doRelease('newBtn')">New</div>
               <div id='saveBtn' class='modeButton' onclick="doSave()" onmousedown="doPush('saveBtn')" onmouseup="doRelease('saveBtn')">Save</div>
               <div id='modeEdit' class='modeButton' onclick="changeMode('Edit')">Edit</div>
               <br />
               <div id='modeList' class='modeButton' onclick="toggleGrid()">List</div>
               <br />
               <div id='modeSearch' class='modeButton' onclick="changeMode('Search')">Search</div>
               <div id='modeBrowse' class='modeSelected' onclick="changeMode('Browse')">Browse</div>
            </div>
         </div>
      <div id='grid' onscroll="checkResults()">
         <table id='gridTable' border='0' cellpadding='2' cellspacing='0' width='100%'>
            <thead>
               <tr>
                  <th class='gridHead'>ID</th>
                  <th class='gridHead'>Service</th>
                  <th class='gridHead'>Status</th>
                  <th class='gridHead'>Client</th>
                  <th class='gridHead'>Vet</th>
                  <th class='gridHead'>Pet</th>
                  <th class='gridHead'>Payment</th>
               </tr>
            </thead>
            <tbody id='gridBody'>
            </tbody>
         </table>
      </div>
      <div id='frameBorder' onclick="toggleGrid(event, 'frameBorder');"><span id='frameHandle'></span></div>
<!-- Toolbar -->
      <div id='toolbar'>
            <div id='pagetime'>&nbsp;</div>
            <div id='rolodex'>
               <span style='display:none;' id='rolodexImage' onclick="browseRecord(event)">&nbsp;</span>
               <span style='display:none;' id='rolodexTab'>&nbsp;</span>
               <div id='resultCount'>&nbsp;</div>
               <form name='navForm' id='navForm' onsubmit="return gotoRecord(document.navForm.jumpID.value, 1);"><input disabled='true' type='text' size='2' id='jumpID' name='jumpID' onchange="return gotoRecord(this.value, 1);" /></form>
            </div>

         <input type='button' id='NewButton' value='New' onclick='doNew()' class='toolbarButton' />
         <!-- <input type='button' id='DeleteButton' value='Delete' onclick='doRemove()' class='toolbarButton' /> -->
         <input type='button' id='SaveButton' value='Save' onclick='doSave()' class='toolbarButton' disabled='disabled' />
         <input type='button' id='EditButton' value='Edit' onclick="changeMode('Edit')" class='toolbarButton' />
         <input type='button' id='SearchButton' value='Search' onclick="changeMode('Search')" class='toolbarButton' />
      </div> 
<!-- End Toolbar -->
      <div id='detail'>
      <div id='content'>
         <form name='PurchaseForm' action='cmd.php' method='post' target='transport' onchange="doChange('Purchase')">
            <input type='hidden' name='Resource' value='Purchase'/>
            <input type='hidden' name='ID'/>
            <input type='hidden' name='ContactID'/>
            <input type='hidden' name='VetID'/>
            <input type='hidden' name='AnimalID'/>
            <input type='hidden' name='CCID'/>
            <input type='hidden' name='SearchResource'/>
            <input type='hidden' name='browse'/>
            <input type='hidden' name='x'/>
            <div id='PurchaseTitle' class='purchaseSection'>
               <div class='sectionID'>Purchase ID: <input type='text' id='PurchaseID' name='Purchase[search][PurchaseID]' class='orderView' style='width: 6em;'></div>
               <a href="javascript:void(null);" class='atoggle' onclick="toggle('Purchase');"><img src='img/arrow_open.png' border='0' id='PurchaseArrow'></a> Purchase <span class='overview' id='PurchaseOverview'> </span>
            </div>
             <div id='PurchaseSection'>
               <table id='order' class='orderTable'>
                  <tr>
                     <td class='orderField'>Date:</td>
                     <td class='orderValue'>
                        <span id='dispDate' style='position:relative;'></span>
                        <input type='hidden' name='Purchase[<?php print $current->PurchaseID; ?>][Created]' id='Purchase_Created' class='orderView'>
                     </td>
                     <td> </td>
                     <td>
                        <span class='check'><input type='checkbox' id='ActiveClient' name='Purchase[<?php print $current->PurchaseID; ?>][Contact][<?php print $current->Contact[0]->ContactID; ?>][Active]' value='1'/>Active</span>
                     </td>
                  </tr>
                  <tr>
                     <td class='orderField'>Reference #:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][ReferenceNumber]' id='Purchase_ReferenceNumber' class='orderView'></td>
                     <td class='orderField'>Status:</td>
                     <td class='orderValue'>
                        <input type='hidden' name='Purchase[<?php print $current->PurchaseID; ?>][Status]' id='Purchase_Status'/>
                        <select name='Purchase[<?php print $current->PurchaseID; ?>][StatusItemID]' id='Purchase_StatusItemID' onchange="updateStatus(this.options[this.selectedIndex].text)" style='width: 20em;font-family:Optima;'><option value=''>-- Select Status --</option>
                        <?php print $boss->utility->makeListOptions('PurchaseStatus', ''); ?>
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td class='orderField'>Biopsy Date:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][BiopsyDate]' id='Purchase_BiopsyDate'class='orderView'></td>
                     <td class='orderField'>Service:</td>
                     <td class='orderValue'>
                        <input type='hidden' name='Purchase[<?php print $current->PurchaseID; ?>][ServiceType]' id='Purchase_Service'/>
                        <select onchange="updateService(this.options[this.selectedIndex].value)" name='Purchase[<?php print $current->PurchaseID; ?>][ServiceID]' id='Purchase_ServiceID' style='width: 20em;font-family:Optima;'><option value=''>-- Select Service --</option>
                        <?php print $boss->utility->makeListOptions('Services', ''); ?>
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td class='orderField'>FedEx Vet:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][FedExVet]' id='Purchase_FedExVet' class='orderView'></td>
                     <td class='orderField'>FedEx GSC:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][FedExGSC]' id='Purchase_FedExGSC' class='orderView'></td>
                  </tr>
                  <tr>
                     <td class='orderField'>Price:</td>
                     <td class='orderValue'>
                        <input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Amount]' id='Purchase_Amount' onchange="updateTotal()" class='orderView' style='width:6em;'/> 
                        <span class='orderField'>Shipping:</span>
                        <input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Shipping]' id='Purchase_Shipping' onchange="updateTotal()" class='orderView' style='width: 6em;'/>
                     </td>
                     <td class='orderField'>Total:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Total]' id='Purchase_Total' class='orderView' style='width: 6em;'></td>
                  </tr>
               </table>
            </div>
         <!-- Contact Section -->
            <div id='ContactTitle' class='purchaseSection'>
               <div class='sectionID'>Contact ID: <input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Contact][<?php print $current->Contact[0]->ContactID; ?>][ContactID]' id='Purchase_Contact_0_ContactID' class='orderView' style='width: 6em;'></div>
               <a href="javascript:void(null);" class='atoggle' onclick="toggle('Contact');"><img src='img/arrow_open.png' border='0' id='ContactArrow'></a> Pet Owner <span class='overview' id='Purchase_Contact_0Overview'> </span>
            </div>
            <div id='ContactSection'>
               <table class='orderTable'>
                  <tr>
                     <td class='orderField'>First Name:</td>
                     <td class='orderValue'>
                        <input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Contact][<?php print $current->Contact[0]->ContactID; ?>][FirstName]' 
                           id='Purchase_Contact_0_FirstName' onchange="updateContact(document.getElementById('Purchase_Contact_0_LastName').value, this.value, 'Contact')" 
                           class='orderView'>
                     </td>
                     <td class='orderField'>Last Name:</td>
                     <td class='orderValue'>
                        <input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Contact][<?php print $current->Contact[0]->ContactID; ?>][LastName]' 
                           id='Purchase_Contact_0_LastName' onchange="updateContact(this.value, document.getElementById('Purchase_Contact_0_FirstName').value, 'Contact')" 
                           class='orderView'/>
                        <input type='hidden' name='Purchase[<?php print $current->PurchaseID; ?>][Contact][<?php print $current->Contact[0]->ContactID; ?>][Contact]' 
                           id='Purchase_Contact_0_Contact' value='<?php print $current->Contact[0]->Contact; ?>'/>
                     </td>
                  </tr>
                  <tr>
                     <td class='orderField'>Address:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Contact][<?php print $current->Contact[0]->ContactID; ?>][Address][<?php print $current->Contact[0]->Address[0]->AddressID; ?>][Address1]' id='Purchase_Contact_0_Address_0_Address1' class='orderView'></td>
                     <td class='orderField'>Address 2:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Contact][<?php print $current->Contact[0]->ContactID; ?>][Address][<?php print $current->Contact[0]->Address[0]->AddressID; ?>][Address2]' id='Purchase_Contact_0_Address_0_Address2' class='orderView'></td>
                  </tr>
                  <tr>
                     <td class='orderField'>City:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Contact][<?php print $current->Contact[0]->ContactID; ?>][Address][<?php print $current->Contact[0]->Address[0]->AddressID; ?>][City]' id='Purchase_Contact_0_Address_0_City' class='orderView'></td>
                     <td class='orderField'>State:</td>
                     <td class='orderValue'>
                        <select name='Purchase[<?php print $current->PurchaseID; ?>][Contact][<?php print $current->Contact[0]->ContactID; ?>][Address][<?php print $current->Contact[0]->Address[0]->AddressID; ?>][State]' id='Purchase_Contact_0_Address_0_State' style='width:10em;font-family:Optima;'><option value=''>-- State --</option>
                        <?php print $boss->utility->makeListOptions('State', ''); ?>
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td class='orderField'>Postal Code:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Contact][<?php print $current->Contact[0]->ContactID; ?>][Address][<?php print $current->Contact[0]->Address[0]->AddressID; ?>][PostalCode]' id='Purchase_Contact_0_Address_0_PostalCode' class='orderView'></td>
                     <td class='orderField'>Country:</td>
                     <td class='orderValue'>
                        <select name='Purchase[<?php print $current->PurchaseID; ?>][Contact][<?php print $current->Contact[0]->ContactID; ?>][Address][<?php print $current->Contact[0]->Address[0]->AddressID; ?>][Country]' id='Purchase_Contact_0_Address_0_Country' style='width:20em;font-family:Optima;'><option value=''>-- Country --</option>
                        <?php print $boss->utility->makeListOptions('Country', ''); ?>
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td class='orderField'>Phone:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Contact][<?php print $current->Contact[0]->ContactID; ?>][Phone][<?php print $current->Contact[0]->Phone[0]->PhoneID; ?>][Phone]' id='Purchase_Contact_0_Phone_0_Phone' class='orderView'></td>
                     <td class='orderField'>Phone 2:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Contact][<?php print $current->Contact[0]->ContactID; ?>][Phone][<?php print $current->Contact[0]->Phone[1]->PhoneID; ?>][Phone]' id='Purchase_Contact_0_Phone_1_Phone' class='orderView'></td>
                  </tr>
                  <tr>
                     <td class='orderField'>Fax:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Contact][<?php print $current->Contact[0]->ContactID; ?>][Phone][<?php print $current->Contact[0]->Phone[2]->PhoneID; ?>][Phone]' id='Purchase_Contact_0_Phone_2_Phone' class='orderView'></td>
                     <td class='orderField'>Email:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Contact][<?php print $current->Contact[0]->ContactID; ?>][Email]' id='Purchase_Contact_0_Email' class='orderView'></td>
                  </tr>
                  <tr>
                     <td class='orderField'>Login ID:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Contact][<?php print $current->Contact[0]->ContactID; ?>][LoginID]' id='Purchase_Contact_0_LoginID' class='orderView'></td>
                     <td class='orderField'>Password:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Contact][<?php print $current->Contact[0]->ContactID; ?>][LoginPass]' id='Purchase_Contact_0_LoginPass' class='orderView'></td>
                  </tr>
                  <tr>
                     <td class='orderField'>Comments:</td>
                     <td colspan='3' class='orderValue'><textarea name='Purchase[<?php print $current->PurchaseID; ?>][Contact][<?php print $current->Contact[0]->ContactID; ?>][Notes]' id='Purchase_Contact_0_Notes' rows='5' cols='65' class='orderComments'><?php print $current->Contact[0]->Notes; ?></textarea></td>
                  </tr>
               </table>
            </div>
            <!-- Vet Section -->
            <div id='VetTitle' class='purchaseSection'>
               <div class='sectionID'>Vet ID: <input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Vet][<?php print $current->Vet[0]->VetID; ?>][VetID]' id='Purchase_Vet_0_VetID' class='orderView' style='width:6em;'></div>
               <a href="javascript:void(null);" class='atoggle' onclick="toggle('Vet');"><img src='img/arrow_open.png' border='0' id='VetArrow'></a> Veterinarian <span class='overview' id='Purchase_Vet_0Overview'> </span>
            </div>
            <div id='VetSection'>
               <table class='orderTable'>
                   <tr>
                     <td class='orderField'>First Name:</td>
                     <td class='orderValue'>
                        <input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Vet][<?php print $current->Vet[0]->VetID; ?>][FirstName]' 
                           id='Purchase_Vet_0_FirstName' onchange="updateName(document.getElementById('Purchase_Vet_0_LastName').value, this.value, 'Vet')" 
                           class='orderView'>
                     </td>
                     <td class='orderField'>Last Name:</td>
                     <td class='orderValue'>
                        <input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Vet][<?php print $current->Vet[0]->VetID; ?>][LastName]' 
                           id='Purchase_Vet_0_LastName' onchange="updateName(this.value, document.getElementById('Purchase_Vet_0_FirstName').value, 'Vet')" 
                           class='orderView'/>
                        <input type='hidden' name='Purchase[<?php print $current->PurchaseID; ?>][Vet][<?php print $current->Vet[0]->VetID; ?>][Vet]' 
                           id='Purchase_Vet_0_Vet' value='<?php print $current->Vet[0]->Vet; ?>'/>
                     </td>
                  </tr>
                  <tr>
                     <td class='orderField'>Clinic Name:</td>
                     <td colspan='3' class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Vet][<?php print $current->Vet[0]->VetID; ?>][Clinic]' id='Purchase_Vet_0_Clinic' class='orderView' style='width:55em;'></td>
                  </tr>
                  <tr>
                     <td class='orderField'>Address:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Vet][<?php print $current->Vet[0]->VetID; ?>][Address1]' id='Purchase_Vet_0_Address_0_Address1' class='orderView'></td>
                     <td class='orderField'>Address 2:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Vet][<?php print $current->Vet[0]->VetID; ?>][Address2]' id='Purchase_Vet_0_Address_0_Address2' class='orderView'></td>
                  </tr>
                  <tr>
                     <td class='orderField'>City:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Vet][<?php print $current->Vet[0]->VetID; ?>][Address][<?php print $current->Vet[0]->Address[0]->AddressID; ?>][City]' id='Purchase_Vet_0_Address_0_City' class='orderView'></td>
                     <td class='orderField'>State:</td>
                     <td class='orderValue'>
                        <select name='Purchase[<?php print $current->PurchaseID; ?>][Vet][<?php print $current->Vet[0]->VetID; ?>][Address][<?php print $current->Vet[0]->Address[0]->AddressID; ?>][State]' id='Purchase_Vet_0_Address_0_State' style='width:10em;font-family:Optima;'><option value=''>-- State --</option>
                        <?php print $boss->utility->makeListOptions('State', ''); ?>
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td class='orderField'>Postal Code:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Vet][<?php print $current->Vet[0]->VetID; ?>][Address][<?php print $current->Vet[0]->Address[0]->AddressID; ?>][PostalCode]' id='Purchase_Vet_0_Address_0_PostalCode' class='orderView'></td>
                     <td class='orderField'>Country:</td>
                     <td class='orderValue'>
                        <select name='Purchase[<?php print $current->PurchaseID; ?>][Vet][<?php print $current->Vet[0]->VetID; ?>][Address][<?php print $current->Vet[0]->Address[0]->AddressID; ?>][Country]' id='Purchase_Vet_0_Address_0_Country' style='width:20em;font-family:Optima;'><option value=''>-- Country --</option>
                        <?php print $boss->utility->makeListOptions('Country', ''); ?>
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td class='orderField'>Phone:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Vet][<?php print $current->Vet[0]->VetID; ?>][Phone][<?php print $current->Vet[0]->Phone[0]->PhoneID; ?>][Phone]' id='Purchase_Vet_0_Phone_0_Phone' class='orderView'></td>
                     <td class='orderField'>Phone 2:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Vet][<?php print $current->Vet[0]->VetID; ?>][Phone][<?php print $current->Vet[0]->Phone[1]->PhoneID; ?>][Phone]' id='Purchase_Vet_0_Phone_1_Phone' class='orderView'></td>
                  </tr>
                  <tr>
                     <td class='orderField'>Fax:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Vet][<?php print $current->Vet[0]->VetID; ?>][Phone][<?php print $current->Vet[0]->Phone[2]->PhoneID; ?>][Phone]' id='Purchase_Vet_0_Phone_2_Phone' class='orderView'></td>
                     <td class='orderField'>Email:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Vet][<?php print $current->Vet[0]->VetID; ?>][Email]' id='Purchase_Vet_0_Email' class='orderView'></td>
                  </tr>
                  <tr>
                     <td class='orderField'>Login ID:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Vet][<?php print $current->Vet[0]->VetID; ?>][Login_ID]' id='Purchase_Vet_0_LoginID' class='orderView'></td>
                     <td class='orderField'>Password:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Vet][<?php print $current->Vet[0]->VetID; ?>][Passwd]' id='Purchase_Vet_0_Passwd' class='orderView'></td>
                  </tr>
                  <tr>
                     <td class='orderField'>Comments:</td>
                     <td colspan='3' class='orderValue'><textarea name='Purchase[<?php print $current->PurchaseID; ?>][Vet][<?php print $current->Vet[0]->VetID; ?>][Notes]' id='Purchase_Vet_0_Notes' rows='5' cols='80' class='orderComments'><?php print $current->Vet[0]->Comments; ?></textarea></td>
                  </tr>
               </table>
            </div>
         <!-- End Vet Section -->
         <!-- Animal Section -->
            <div id='AnimalTitle' class='purchaseSection'>
               <div class='sectionID'>Pet ID: <input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Animal][<?php print $current->Animal[0]->AnimalID; ?>][AnimalID]' id='Purchase_Animal_0_AnimalID' class='orderView' style='width: 6em;'></div>
               <a href="javascript:void(null);" class='atoggle' onclick="toggle('Animal');"><img src='img/arrow_open.png' border='0' id='AnimalArrow'></a> Pet Information <span class='overview' id='Purchase_Animal_0Overview'> </span>
            </div>
            <div id='AnimalSection'>
               <table class='orderTable'>
                  <tr>
                     <td class='orderField'>Name:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Animal][<?php print $current->Animal[0]->AnimalID; ?>][Name]' id='Purchase_Animal_0_Name' class='orderView'></td>
                     <td class='orderField'>Species:</td>
                     <td class='orderValue'>
                        <select name='Purchase[<?php print $current->PurchaseID; ?>][Animal][<?php print $current->Animal[0]->AnimalID; ?>][Species]' id='Purchase_Animal_0_Species' style='width:20em;font-family:Optima;'><option value=''>-- Species --</option>
                        <?php print $boss->utility->makeListOptions('Species', ''); ?>
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td class='orderField'>Breed:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Animal][<?php print $current->Animal[0]->AnimalID; ?>][Breed]' id='Purchase_Animal_0_Breed' class='orderView'></td>
                     <td class='orderField'>Sex:</td>
                     <td class='orderValue'>
                        <select name='Purchase[<?php print $current->PurchaseID; ?>][Animal][<?php print $current->Animal[0]->AnimalID; ?>][Sex]' id='Purchase_Animal_0_Sex' style='width:20em;font-family:Optima;'><option value=''>-- Sex --</option>
                        <?php print $boss->utility->makeListOptions('Sex', ''); ?>
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td class='orderField'>Age:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][Animal][<?php print $current->Animal[0]->AnimalID; ?>][Age]' id='Purchase_Animal_0_Age' class='orderView'></td>
                     <td class='orderField'>Health:</td>
                     <td class='orderValue'>
                        <select name='Purchase[<?php print $current->PurchaseID; ?>][Animal][<?php print $current->Animal[0]->AnimalID; ?>][Health]' id='Purchase_Animal_0_Health' style='width:20em;font-family:Optima;'><option value=''>-- Health --</option>
                        <?php print $boss->utility->makeListOptions('Health', ''); ?>
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td class='orderField'>Comments:</td>
                     <td colspan='3' class='orderValue'><textarea id='Purchase_Animal_0_Notes' name='Purchase[<?php print $current->PurchaseID; ?>][Animal][<?php print $current->Animal[0]->AnimalID; ?>][Notes]' rows='5' cols='80' class='orderComments'><?php print $current->Animal[0]->Notes; ?></textarea></td>
                  </tr>
               </table>
            </div>
         <!-- End Animal Section -->
         <!-- CC Section -->
            <div id='CCTitle' class='purchaseSection'>
               <div class='sectionID'><div id='ccspin'><img id='spinner' src='/img/spinner.gif'/></div><img id='ccimg' src='/img/cc_unknown.png'/><input name='ccbtn' id='ccbtn' type='button' value='Authorize Payment' onclick='doAuth();' class='modeButton'/></div>
               <a href="javascript:void(null);" class='atoggle' onclick="toggle('CC');"><img src='img/arrow_open.png' border='0' id='CCArrow'></a>Credit Card <span class='overview' id='CCOverview'> </span>
            </div>
            <div id='CCSection'>
               <table class='orderTable'>
                  <tr>
                     <td class='orderField'>Name on Card:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][CC][<?php print $current->CC[0]->CCID; ?>][Name]' id='Purchase_CC_0_Name' class='orderView'></td>
                     <td class='orderField'>Card Type:</td>
                     <td class='orderValue'><select name='Purchase[<?php print $current->PurchaseID; ?>][CC][<?php print $current->CC[0]->CCID; ?>][CardType]' id='Purchase_CC_0_CardType' style='width: 10em;font-family:Optima;'><option value=''>-- Select Card --</option>
                           <?php
                              print $util->makeListOptions('Card Types', $current->CC[0]->CardType);
                           ?>
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td class='orderField'>Card Number:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][CC][<?php print $current->CC[0]->CCID; ?>][CC]' id='Purchase_CC_0_CC' class='orderView'></td>
                     <td class='orderField'>Expiration:</td>
                     <td class='orderValue'>
                        <select name='Purchase[<?php print $current->PurchaseID; ?>][CC][<?php print $current->CC[0]->CCID; ?>][ExpirationMonth]' id='Purchase_CC_0_ExpirationMonth' class='orderView' style='width:8em;'>
                           <option value=''>-- Month --</option>
                           <?php print $boss->utility->makeListOptions('CCMonths'); ?>
                        </select>
                        <select name='Purchase[<?php print $current->PurchaseID; ?>][CC][<?php print $current->CC[0]->CCID; ?>][ExpirationYear]' id='Purchase_CC_0_ExpirationYear' class='orderView' style='width:5em;'>
                           <option value=''>-- Year --</option>
                           <?php print $boss->utility->makeListOptions('CCYears'); ?>
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td class='orderField'>Auth Response:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][AuthResponse]' id='Purchase_AuthResponse' class='orderView'></td>
                     <td class='orderField'>Auth Code:</td>
                     <td class='orderValue'><input type='text' name='Purchase[<?php print $current->PurchaseID; ?>][AuthCode]' id='Purchase_AuthCode' class='orderView'></td>
                </table>
            </div>
         </div>
         <div id='gscstat'>
            <!-- <span class='check'><input type='checkbox' id='ActiveClient' name='Purchase[<?php print $current->PurchaseID; ?>][Contact][<?php print $current->Contact[0]->ContactID; ?>][Active]' value='1'/>Active</span> -->
            <span class='check'><input type='checkbox' id='ClientContract' name='Purchase[<?php print $current->PurchaseID; ?>][ClientContract]' value='1'/>Client Contract</span>
            <span class='check'><input type='checkbox' id='VetContract' name='Purchase[<?php print $current->PurchaseID; ?>][VetContract]' value='1'/>Vet Contract</span></div>
         <div id='samples'>
            <table class='samtbl' id='samplesTbl' style='background-image:url("/img/paper.gif"); background-repeat:repeat;'>
               <thead>
                  <tr>
                     <th class='samhd'>ID</th>
                     <th class='samhd'>Banked</th>
                     <th class='samhd'>Cell Count</th>
                     <th class='samhd'>Passage</th>
                     <th class='samhd'>Tissue Type</th>
                  </tr>
               </thead>
               <tbody class='samtbl' id='sampleTable'>
                  <?php 
                     for ($i=0; $i<35; $i++) {
                  ?>
                  <tr>
                     <td class='samrow'>&nbsp;</td>
                     <td class='samrow'>&nbsp;</td>
                     <td class='samrow'>&nbsp;</td>
                     <td class='samrow'>&nbsp;</td>
                     <td class='samrow'>&nbsp;</td>
                  </tr>
                  <?php 
                     }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
      </form>
      </div>
      <div id='transporter'> <iframe name='transport' id='transport' border='0'> </iframe> </div>
      <div id='debug'>&nbsp;</div>
   </body>
</html>

