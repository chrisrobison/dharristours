<div id='updates'>
   <h1>Recent Updates &amp; Bugfixes</h1>
   <hr/>
   <h2>Updates for July 22, 2011</h2>
   <ul>
      <li><strong>Registered Product Domains:</strong> We have registered a number of new domains to facilitate our efforts to build focused landing pages.  They are as follows:
         <ul>
            <li>mysimp.co</li>
            <li>softwareissimple.com</li>
            <li>simplespreadsheet.com</li>
            <li>helpdeskmadesimple.com</li>
            <li>hrissimple.com</li>
            <li>timeclockmadesimple.com</li>
            <li>docsharemadesimple.com</li>
            <li>simplesf.co</li>
            <li>simplesoftware.com</li>
            <li>dbissimple.com</li>
            <li>databasemadesimple.com</li>
            <li>leadsaresimple.com</li>
         </ul>
      </li>
      <li><strong>Updated Filemanager:</strong> Edits and versioning now work correctly in all environments.</li>
   </ul>
   <hr/>
   <h2>Updates for June 27, 2011</h2>
   <ul>
      <li><b><a href='/grid/' target='_blank'>Data Grid</a></b>: Many updates here: 
         <ul>
            <li><strong>Main Grid Sorting:</strong> Fixed main table sorting issue due to the token for 'ASC' and 'DESC' being quoted in the SQL statement and throwing an error.</li>
            <li><strong>Persistant Column Settings:</strong> Fixed persistant column settings for the main grid so columns picked for viewing are retained the next time you load the same grid.</li>
            <li><strong>Related Data:</strong> Changed the related data code to output standard HTML tables instead of using jqGrid.  It now only displays the first 5 non-system columns for related data.  Plans are to continue down the path of having those tables use jqGrid but for now, this works much better for printing and getting things out the door.</li>
            <li><strong>Related Data:</strong> Deleting the relationship works properly now.  The Clamp records for both directions are removed on the server while the client gracefully removes the associated row.  Neat!</li>
         </ul>
      <li><b><a href='/apps/files/' target='_blank'>File Manager</a></b>: Editing of files is now possible directly in the browser using the new editarea tool.  Still need to handle some upload bugs.</li>
      <li><b><a href='/apps/dbtool/' target='_blank'>DB Tool</a></b>: There have been problems with the "Keep It Simple" functionality so I have removed it for now.  You can only keep it simple.</li>
   </ul>
   <hr/>
   <h2>Updates for June 18, 2011</h2>
   <ul>
      <li><b><a href='/apps/files/' target='_blank'>File Manager</a></b>: Updated to allow editing of file content <u>in the browser</u>. Allows editing of any html, php or any plain text file using an advanced, browser-based, code editor with syntax highlighting, undo, and almost everything else a code editor needs.  All files and edits are managed using version control making all previous revisions of a file are available for referencing or rolling back changes made to a file.  I've been using it to edit all my files tonight and it is working great (a lot better than I expected).</li>
      <li><b><a href='/clients/admin/dashboard.php' target='_blank'>Dashboard</a></b>: Updated the Simple Admin application dashboard to rollup non-urgent content and include this new "Updates" file.</li>
      <li><b><a href='http://simpsf.com/site/?signup=1' target='_blank'>Simple Account Signup</a></b>: The signup process has been updated to add a new Employee record at the same time the Login record is created upon new application setup.  This should significantly reduce the time needed for initial setup of timeclock related apps and help make the sales process over the telephone a bit more fluid.</li>
   </ul>
</div>
