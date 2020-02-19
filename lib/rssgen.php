<?php
  class rssGenesis {
    var $rss_header = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>\r\n\r\n<!DOCTYPE rss PUBLIC \"-//Netscape Communications//DTD RSS 0.91//EN\" \"http://my.netscape.com/publish/formats/rss-0.91.dtd\">\r\n\r\n<rss version=\"0.91\">\r\n";
    
    var $rss_channel = "<channel>\r\n\r\n  <title>{channel_Title}</title>\r\n  <link>{channel_Link}</link>\r\n  <description>{channel_Description}</description>\r\n  <language>{channel_Language}</language>\r\n  <copyright>{channel_Copyright}</copyright>\r\n  <managingEditor>{channel_ManagingEditor}</managingEditor>\r\n  <webMaster>{channel_WebMaster}</webMaster>\r\n  <rating>{channel_Rating}</rating>\r\n  <pubDate>{channel_PubDate}</pubDate>\r\n  <lastBuildDate>{channel_LastBuildDate}</lastBuildDate>\r\n  <docs>{channel_Docs}</docs>\r\n  <skipDays>{channel_SkipDays}</skipDays>\r\n  <skipHours>{channel_SkipHours}</skipHours>\r\n\r\n";
    
    var $rss_image = "  <image>\r\n    <title>{image_Title}</title>\r\n    <url>{image_Source}</url>\r\n    <link>{image_Link}</link>\r\n    <width>{image_Width}</width>\r\n    <height>{image_Height}</height>\r\n    <description>{image_Description}</description>\r\n  </image>\r\n\r\n";
    
    var $rss_item = "  <item>\r\n    <title>{item_Title}</title>\r\n    <link>{item_Link}</link>\r\n    <description>{item_Description}</description>\r\n  </item>\r\n\r\n";
    
    var $rss_input = "  <textinput>\r\n    <title>{input_Title}</title>\r\n    <description>{input_Description}</description>\r\n    <name>{input_Name}</name>\r\n    <link>{input_Link}</link>\r\n  </textinput>\r\n\r\n";
    
    var $rss_footer = "</channel>\r\n</rss>";
    var $rss_feed = null;
    var $channel_data = null;
    var $image_data = null;
    var $item_data = Array();
    var $input_data = null;
    
    function setChannel ($title = "", $link = "", $description = "", $language = "", $copyright = "", $managingEditor = "", $webMaster = "", $rating = "", $pubDate = "", $lastBuildDate = "", $docs = "", $skipDays = "", $skipHours = "") {
      
      // Copies the original template to channel sections //
      $this->channel_data = $this->rss_channel;
      $title = ($title == null) ? "" : $title;
      $link = ($link == null) ? "" : $link;
      $description = ($description == null) ? "" : $description;
      $language = ($language == null) ? "" : $language;
      $copyright = ($copyright == null) ? "" : $copyright;
      $managingEditor = ($managingEditor == null) ? "" : $managingEditor;
      $webMaster = ($webMaster == null) ? "" : $webMaster;
      $rating = ($rating == null) ? "" : $rating;
      $pubDate = ($pubDate == null) ? "" : $pubDate;
      $lastBuildDate = ($lastBuildDate == null) ? "" : $lastBuildDate;
      $docs = ($docs == null) ? "" : $docs;
      $skipDays = ($skipDays == null) ? "" : $skipDays;
      $skipHours = ($skipHours == null) ? "" : $skipHours;
      $title = stripslashes (htmlspecialchars (trim ($title), ENT_QUOTES));
      $title = (empty ($title)) ? "RSS 0.91 Feed - CDRMail v2.51" : $title;
      
      // Link parser // Checks absolutes URIs
      if (!preg_match ("(^(ht|f)tp://)", $link)) :
        $link = "http://www.cdrmail.com/cdrmail2/";
      
      endif;
      
      // Description parser // Convertes quotes and strips backslashes!
      $description = stripslashes (htmlspecialchars (trim ($description), ENT_QUOTES));
      
      // Description parser // Empty descriptions not allowed
      $description = (empty ($description)) ? "A basic and simple RSS Feed!" : $description;
      
      // Language parser // Only [-A-Za-z]
      if ((preg_match ("([^-A-Za-z])", $language)) or (empty ($language))) :
      
        $language = "en-us";
      
      endif;
      
      // Copyright parser // Optional data
      if (empty ($copyright)) :
      
        $this->channel_data = preg_replace("/\r\n  <copyright>{channel_Copyright}<\/copyright>/", "", $this->channel_data);
        
      endif;
      
      // Managing Editor parser // Optional data
      if (empty ($managingEditor)) :
      
        $this->channel_data = preg_replace("/\r\n  <managingEditor>{channel_ManagingEditor}<\/managingEditor>/", "", $this->channel_data);
      
      endif;
      
      // WebMaster parser // Optional data
      if (empty ($webMaster)) :
      
        $this->channel_data = preg_replace("/\r\n  <webMaster>{channel_WebMaster}<\/webMaster>/", "", $this->channel_data);
      
      endif;
      
      // Rating parser // Optional data
      if (empty ($rating)) :
      
        $this->channel_data = preg_replace("/\r\n  <rating>{channel_Rating}<\/rating>/", "", $this->channel_data);
      
      endif;
      
      // PubDate parser // If is set to auto, autogenerates it
      if ($pubDate == "auto") :
      
        $pubDate = date ("r");
      
      endif;
      
      // PubDate parser // Optional data
      if (empty ($pubDate)) :
      
        $this->channel_data = preg_replace("/\r\n  <pubDate>{channel_PubDate}<\/pubDate>/", "", $this->channel_data);
      
      endif;
      
      // Last Build Date parser // If is set to auto, autogenerates it
      if ($lastBuildDate == "auto") :
      
        $lastBuildDate = date ("r");
      
      endif;
      
      // Last Build Date parser // Optional data
      if (empty ($lastBuildDate)) :
      
        $this->channel_data = preg_replace("/\r\n  <lastBuildDate>{channel_LastBuildDate}<\/lastBuildDate>/", "", $this->channel_data);
      
      endif;
      
      // Docs parser // Checks absolutes URIs
      if (!preg_match ("(^(ht|f)tp://)", $docs)) :
      
        $docs = "http://www.cdrmail2.com/cdrmail2/";
      
      endif;
      
      // Skip Days parser // Generate data
      if (!empty ($skipDays)) :
      
        // Starts the complete Skip Days storage variable //
        $skipDaysComplete = "\r\n";
        
        // Explodes the string to get all skipped days //
        $skipDays = explode ("|", $skipDays);
        
        // For each element given //
        foreach ($skipDays as $days) :
        
          // Inserts data to skipped day //
          $skipDaysComplete .= "    <day>$days</day>\r\n";
          
        endforeach;
        
        // Overwrites the given Skip Days variable //
        $skipDays = $skipDaysComplete .= "  ";
        
      endif;
      
      // Skip Days parser // Optional data
      if (empty ($skipDays)) :
      
        $this->channel_data = preg_replace("/\r\n  <skipDays>{channel_SkipDays}<\/skipDays>/", "", $this->channel_data);
      
      endif;
      
      // Skip Hours parser // Generate data
      if (!empty ($skipHours)) :
      
        // Starts the complete Skip Hours storage variable //
        $skipHoursComplete = "\r\n";
        
        // Explodes the string to get all skipped hours //
        $skipHours = explode ("|", $skipHours);
        
        // For each element given //
        foreach ($skipHours as $hours) :
        
          // Inserts data to skipped hour //
          $skipHoursComplete .= "    <hour>$hours</hour>\r\n";
          
        endforeach;
        
        // Overwrites the given Skip Hours variable //
        $skipHours = $skipHoursComplete .= "  ";
        
      endif;
      
      // Skip Hours parser // Optional data
      if (empty ($skipHours)) :
      
        $this->channel_data = preg_replace("/\r\n  <skipHours>{channel_SkipHours}<\/skipHours>/", "", $this->channel_data);
      
      endif;
      
      // Inserts channel title // Replaces {channel_Title}
      $this->channel_data = preg_replace("/{channel_Title}/", $title, $this->channel_data);
      
      // Inserts channel link // Replaces {channel_Link}
      $this->channel_data = preg_replace("/{channel_Link}/", $link, $this->channel_data);
      
      // Inserts channel language // Replaces {channel_Language}
      $this->channel_data = preg_replace("/{channel_Language}/", $language, $this->channel_data);
      
      // Inserts channel description // Replaces {channel_Description}
      $this->channel_data = preg_replace("/{channel_Description}/", $description, $this->channel_data);
      
      // Inserts channel copyright // Replaces {channel_Copyright}
      $this->channel_data = preg_replace("/{channel_Copyright}/", $copyright, $this->channel_data);
      
      // Inserts channel managingEditor // Replaces {channel_ManagingEditor}
      $this->channel_data = preg_replace("/{channel_ManagingEditor}/", $managingEditor, $this->channel_data);
      
      // Inserts channel webMaster // Replaces {channel_WebMaster}
      $this->channel_data = preg_replace("/{channel_WebMaster}/", $webMaster, $this->channel_data);
      
      // Inserts channel rating // Replaces {channel_Rating}
      $this->channel_data = preg_replace("/{channel_Rating}/", $rating, $this->channel_data);
      
      // Inserts channel pubDate // Replaces {channel_PubDate}
      $this->channel_data = preg_replace("/{channel_PubDate}/", $pubDate, $this->channel_data);
      
      // Inserts channel lastBuildDate // Replaces {channel_LastBuildDate}
      $this->channel_data = preg_replace("/{channel_LastBuildDate}/", $lastBuildDate, $this->channel_data);
      
      // Inserts channel docs // Replaces {channel_Docs}
      $this->channel_data = preg_replace("/{channel_Docs}/", $docs, $this->channel_data);
      
      // Inserts channel skipDays // Replaces {channel_SkipDays}
      $this->channel_data = preg_replace("/{channel_SkipDays}/", $skipDays, $this->channel_data);
      
      // Inserts channel skipHours // Replaces {channel_SkipHours}
      $this->channel_data = preg_replace("/{channel_SkipHours}/", $skipHours, $this->channel_data);
      
    }
    
    // Creates image data handler //
    function setImage ($title = "", $src = "", $link = "", $width = "", $height = "", $description = "") {
      
      // Null values become empty values // Start
      $title = ($title == null) ? "" : $title;
      $src = ($src == null) ? "" : $src;
      $link = ($link == null) ? "" : $link;
      $width = ($width == null) ? "" : $width;
      $height = ($height == null) ? "" : $height;
      $description = ($description == null) ? "" : $description;
      // Null values become empty values // End
      
      // Title parser // Convertes quotes and strips backslashes!
      $title = stripslashes (htmlspecialchars (trim ($title), ENT_QUOTES));
      
      // Title parser // Empty titles not allowed
      $title = (empty ($title)) ? "Simple Software RSS Feed" : $title;
      
      // Source parser // Checks absolutes URIs
      if (!preg_match ("(^(ht|f)tp://)", $src)) :
      
        $src = "http://www.cdrmail.com/cdrmail2/img/smlogo.png";
      
      endif;
      
      // Link parser // Checks absolutes URIs
      if (!preg_match ("(^(ht|f)tp://)", $link)) :
      
        $link = "http://www.cdrmail.com/cdrmail2/";
      
      endif;
      
      // Image dimensions parser // Sets dimensions if auto generation is needed
      if (($width == "auto") and ($height == "auto")) :
      
        $dimensions = @getimagesize ($src);
        
        $width = $dimensions[0];
        
        $height = $dimensions[1];
      
      endif;
      
      // Image dimensions parser // Checks integer values
      $width = (is_int ($width)) ? $width : "";
      $height = (is_int ($height)) ? $height : "";
      
      // Description parser // Convertes quotes and strips backslashes!
      $description = stripslashes (htmlspecialchars (trim ($description), ENT_QUOTES));
      
      // Description parser // Empty descriptions not allowed
      $description = (empty ($description)) ? "Powered by: RSS Genesis!" : $description;
      
      // Inserts image title // Replaces {image_Title}
      $this->image_data = preg_replace("/{image_Title}/", $title, $this->rss_image);
      
      // Inserts image source // Replaces {image_Source}
      $this->image_data = preg_replace("/{image_Source}/", $src, $this->image_data);
      
      // Inserts image link // Replaces {image_Link}
      $this->image_data = preg_replace("/{image_Link}/", $link, $this->image_data);
      
      // Inserts image width // Replaces {image_Width}
      $this->image_data = preg_replace("/{image_Width}/", "$width", $this->image_data);
      
      // Inserts image height // Replaces {image_Height}
      $this->image_data = preg_replace("/{image_Height}/", "$height", $this->image_data);
      
      // Inserts image description // Replaces {image_Description}
      $this->image_data = preg_replace("/{image_Description}/", $description, $this->image_data);
      
    }
    
    // Creates item data handler //
    function addItem ($title, $link, $description) {
      
      // Null values become empty values // Start
      $title = ($title == null) ? "" : $title;
      $link = ($link == null) ? "" : $link;
      $description = ($description == null) ? "" : $description;
      // Null values become empty values // End
      
      // Title parser // Convertes quotes and strips backslashes!
      $title = stripslashes (htmlspecialchars (trim ($title), ENT_QUOTES));
      
      // Title parser // Empty titles not allowed
      if (empty ($title)) :
      
        die ("<font face=\"verdana\" size=\"2\">Error code: <strong>001</strong> - Item's element title is mandatory! - <a href=\"http://rssgenesis.sourceforge.net/index.html#ec001\" target=\"_blank\">Documentation</a></font>");
      
      endif;
      
      // Link parser // Checks absolutes URIs
      if (!preg_match ("(^(ht|f)tp://)", $link)) :
      
        die ("<font face=\"verdana\" size=\"2\">Error code: <strong>002</strong> - Item's element link is mandatory! - <a href=\"http://rssgenesis.sourceforge.net/index.html#ec002\" target=\"_blank\">Documentation</a></font>");
      
      endif;
      
      // Description parser // Convertes quotes and strips backslashes!
      $description = stripslashes (htmlspecialchars (trim ($description), ENT_QUOTES));
      
      // Inserts item title // Replaces {item_Title}
      $temp = preg_replace("/{item_Title}/", $title, $this->rss_item);
      
      // Inserts item link // Replaces {item_Link}
      $temp = preg_replace("/{item_Link}/", $link, $temp);
      
      // Inserts item description // Replaces {item_Description}
      $temp = preg_replace("/{item_Description}/", $description, $temp);
      
      // Stores the new added item
      $this->item_data[] = $temp;
      
      // Unsets temporary variable
      unset ($temp);
      
    }
    
    // Creates input data handler //
    function setInput ($title = "", $description = "", $name = "", $link = "") {
      
      // Null values become empty values // Start
      $title = ($title == null) ? "" : $title;
      $description = ($description == null) ? "" : $description;
      $name = ($name == null) ? "" : $name;
      $link = ($link == null) ? "" : $link;
      // Null values become empty values // End
      
      // Title parser // Convertes quotes and strips backslashes!
      $title = stripslashes (htmlspecialchars (trim ($title), ENT_QUOTES));
      
      // Title parser // Empty titles not allowed
      $title = (empty ($title)) ? "Go!" : $title;
      
      // Description parser // Convertes quotes and strips backslashes!
      $description = stripslashes (htmlspecialchars (trim ($description), ENT_QUOTES));
      
      // Description parser // Empty descriptions not allowed
      $description = (empty ($description)) ? "Search:" : $description;
      
      // Name parser // Convertes quotes and strips backslashes!
      $name = stripslashes (htmlspecialchars (trim ($name), ENT_QUOTES));
      
      // Name parser // Empty names not allowed
      $name = (empty ($name)) ? "q" : $name;
      
      // Link parser // Checks absolutes URIs
      if (!preg_match ("(^(ht|f)tp://)", $link)) :
      
        $link = "http://www.google.com/search";
      
      endif;
      
      // Inserts input title // Replaces {input_Title}
      $this->input_data = preg_replace("/{input_Title}/", $title, $this->rss_input);
      
      // Inserts input description // Replaces {input_Description}
      $this->input_data = preg_replace("/{input_Description}/", $description, $this->input_data);
      
      // Inserts input name // Replaces {input_Name}
      $this->input_data = preg_replace("/{input_Name}/", $name, $this->input_data);
      
      // Inserts input link // Replaces {input_Link}
      $this->input_data = preg_replace("/{input_Link}/", $link, $this->input_data);
      
    }
    
    // Creates function to organize the data on feed //
    function organizeData() {
      
      // Concentrates all stored data in one variable to feed the new RSS feed //
      $this->rss_feed .= $this->rss_header;
      $this->rss_feed .= $this->channel_data;
      $this->rss_feed .= $this->image_data;
      $this->rss_feed .= $this->input_data;
      
      // Storing all itens //
      foreach ($this->item_data as $item) :
      
        $this->rss_feed .= $item;
      
      endforeach;
      
      // Storage continuation //
      $this->rss_feed .= $this->rss_footer;
      
    }
    
    // Creates function to generate the RSS Feed //
    function createFile ($name = "my.rss") {
      
      // Calls the function to organize data before the file creation //
      $this->organizeData();
      
      // Creates the new file //
      $file = @fopen ($name, "w");
      
      // Checks if creation was successful //
      if (!$file) :
      
        die ("<font face=\"verdana\" size=\"2\">Critical Error: <strong>Unable to create: $name</strong></font>");
        
      endif;
      
      // Inserts contents //
      fwrite ($file, $this->rss_feed);
      
      // Ends file creation //
      fclose ($file);
      
      // XML RSS header //
      header ("Content-type: application/rss+xml");
      
      // Display RSS file //
      echo file_get_contents ($name);
      
    }
    
  }

?>
