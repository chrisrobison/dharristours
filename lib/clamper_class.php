<?php
/**
 * utility class
 *
 **/
class Clamper {

   function Clamper() {

   }
	
	function ClampValuesUnique($Local, $LocalID, $Remote, $FieldsArray = null, $ValuesArray = null, $UpdateArray = null, $updateOnNewOnly = false) {
	   //This function uses the Clamp table to associate a record in the $Remote table with a record in the 
		//$Local table, and update the values in the $Remote table with $UpdateArray.  It assumes that there
		//should only be one link between the two tables with the specified condition.  If a $Remote record is already
		//clamped to the $Local record, the clamped record will be updated; otherwise, a new record will be inserted into
		//the remote table and then clamped.
		//If $RemoteID is null, 0, or an empty string, any existing Clamp record for the relationship will be
		//deleted		
	   $obj = new boss();
		$obj->db->addResource("Clamp");
		$obj->db->addResource($Remote);
		//get RemoteID and ClampID, if there is already a clamped record
		$clampedArray = $this->findClampedRecord($Local, $LocalID, $Remote, $FieldsArray, $ValuesArray);
		$RemoteID = $clampedArray['RemoteID'];
		$ClampID = $clampedArray['ClampID'];
		if ($RemoteID) {
		   //there is already a clamped record; use it
			if (!$updateOnNewOnly) {
			   $obj->db->{$Remote}->update($RemoteID, $UpdateArray); 
			}
		} else {
			$RemoteID = $obj->db->{$Remote}->add($UpdateArray);
			$ClampID = $obj->db->Clamp->add(array("Remote"=>$Remote, "RemoteID"=>$RemoteID, "Local"=>$Local, "LocalID"=>$LocalID));
		}		
		return $RemoteID;	   
	}
	
	function ClampTwoRecordsUnique($Local, $LocalID, $Remote, $RemoteID, $FieldsArray = null, $ValuesArray = null) {
	   //This function uses the Clamp table to associate two records in different tables.  It assumes that there
		//should only be one link between the two tables with the specified condition.  Both records
		//are assumed to already exist.  If there is already a record in the Clamp table with the same
		//Local, Remote, and LocalID fields, it will be updated to use the new RemoteID.
		//If $RemoteID is null, 0, or an empty string, any existing Clamp record for the relationship will be
		//deleted
		$obj = new boss();
		$obj->addResource("Clamp");
		//get ClampID and old RemoteID
		$clampedArray = $this->findClampedRecord($Local, $LocalID, $Remote, $FieldsArray, $ValuesArray);
		$OldRemoteID = $clampedArray['RemoteID'];
		$ClampID = $clampedArray['ClampID'];
		if ($ClampID && !$RemoteID) {
		   //delete the Clamp record to break the relationship
			$obj->db->Clamp->remove($ClampID);
		} else if ($ClampID) {
		   //there is already a record in the Clamp table for this relationship
		   if ($RemoteID == $OldRemoteID) {
			   //records are already linked; do nothing
			} else {
			   $obj->db->Clamp->update($ClampID, array("RemoteID"=>$RemoteID));
			}
		} else if ($RemoteID) {
		   //no Clamp record exists for this relationship; create one
			$ClampID = $obj->db->Clamp->add(array("Remote"=>$Remote, "RemoteID"=>$RemoteID, "Local"=>$Local, "LocalID"=>$LocalID));
		}		
		return $ClampID;	   
	}
	
	//condition has not been tested
	function findClampedRecord($Local, $LocalID, $Remote, $FieldsArray = null, $ValuesArray = null) {
	   $obj = new boss();
		//create the conditional statement
		$conditional = "";
		if ((count($FieldsArray) > 0) && (count($FieldsArray) == count($ValuesArray))) {
		   $conditional .= "(";
		   for ($i = 0; $i < count($FieldsArray); $i++) {
			   if ($i > 0) $conditional .= " and ";
			   $conditional .= "(" . $FieldsArray[$i] . " = \"" . mysql_escape_string($ValuesArray[$i]) . "\")";
			}
			$conditional .= ")";
		}
		//get the Clamp records that match to records specified by the $condition.
		//the matching Clamp record will contain a record in its $Remote property
		$obj->db->addResource('Clamp');
		$obj->db->Clamp->linkResource($Remote, "RemoteID", $Remote.'ID', $conditional);
		$obj->db->Clamp->getlist("Remote='$Remote' and LocalID='$LocalID' and Local='$Local'");
		//if ($Remote == "Surgery") echo "count: " . count($obj->db->Clamp->Clamp) . "<br>";
		//echo "Remote='$Remote' and LocalID='$LocalID' and Local='$Local' and $conditional<br>";
		$ClampID = "";
		$OldRemoteID = "";
		if (count($obj->db->Clamp->Clamp) > 0) {
		   foreach($obj->db->Clamp->Clamp as $key=>$ClampRec) {
		      //if ($Remote == "Surgery") echo "count2: " . count($ClampRec->{$Remote}) . "<br>";
			   if (count($ClampRec->{$Remote}) > 0)  {
				   $OldRemoteID = $ClampRec->RemoteID;
				   $ClampID = $ClampRec->ClampID;
				}
			}
		}
		return array("ClampID"=>$ClampID, "RemoteID"=>$OldRemoteID);
	}
}
?>
