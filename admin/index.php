<?php
    require_once('includes/header.php');
?>
           <!-- Dashboard icons -->
        <div class="container_12">
            <div class="grid_7">
            	<a href="" class="dashboard-module">
                	<img src="img/Crystal_Clear_write.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/Crystal_Clear_write.gif" width="64" height="64" alt="edit" />
                	<span>New article</span>
                </a>
                
                <a href="" class="dashboard-module">
                	<img src="img/Crystal_Clear_file.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/Crystal_Clear_file.gif" width="64" height="64" alt="edit" />
                	<span>Upload file</span>
                </a>
                
                <a href="" class="dashboard-module">
                	<img src="img/Crystal_Clear_files.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/Crystal_Clear_files.gif" width="64" height="64" alt="edit" />
                	<span>Articles</span>
                </a>
                
                <a href="" class="dashboard-module">
                	<img src="img/Crystal_Clear_calendar.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/Crystal_Clear_calendar.gif" width="64" height="64" alt="edit" />
                	<span>Calendar</span>
                </a>
                
                <a href="" class="dashboard-module">
                	<img src="img/Crystal_Clear_user.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/Crystal_Clear_user.gif" width="64" height="64" alt="edit" />
                	<span>My profile</span>
                </a>
                
                <a href="" class="dashboard-module">
                	<img src="img/Crystal_Clear_stats.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/Crystal_Clear_stats.gif" width="64" height="64" alt="edit" />
                	<span>Stats</span>
                </a>
                
                <a href="" class="dashboard-module">
                	<img src="img/Crystal_Clear_settings.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/Crystal_Clear_settings.gif" width="64" height="64" alt="edit" />
                	<span>Settings</span>
                </a>
                <div style="clear: both"></div>
            </div> <!-- End .grid_7 -->
            
            <!-- Account overview -->
            <div class="grid_5">
                <div class="module">
                        <h2><span>Account overview</span></h2>
                        
                        <div class="module-body">
                        
                        	<p>
                                <strong>User: </strong>User X<br />
                                <strong>Your last visit was on: </strong>20 January 2010,<br />
                                <strong>From IP: </strong>000.000.00.00
                            </p>
                        
                             <div>
                                 <div class="indicator">
                                     <div style="width: 23%;"></div><!-- change the width value (23%) to dynamically control your indicator -->
                                 </div>
                                 <p>Your storage space: 23 MB out of 100MB</p>
                             </div>
                             
                             <div>
                                 <div class="indicator">
                                     <div style="width: 100%;"></div><!-- change the width value (100%) to dynamically control your indicator -->
                                 </div>
                                 <p>Your bandwidth (January): 1 GB out of 1 GB</p>
                             </div>
                             
                        	<p>
                                Need to switch to a bigger plan?<br />
                                <a href="">click here</a><br />
                            </p>

                        </div>
                </div>
                <div style="clear:both;"></div>
            </div> <!-- End .grid_5 -->
            
            <div style="clear:both;"></div>
            
            
            
            <div class="grid_12">
                
                <!-- Notification boxes -->
                <span class="notification n-success">Success notification.</span>
                
                <span class="notification n-information">Information notification.</span>
                
                <span class="notification n-attention">Attention notification.</span>
                
                <span class="notification n-error">Error notification.</span>
                
                
                <div class="bottom-spacing">
                
                    <!-- Button -->
                    <div class="float-right">
                        <a href="" class="button">
                        	<span>New Article <img src="img/plus-small.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/plus-small.gif" width="12" height="9" alt="New article" /></span>
                        </a>
                    </div>
                    
                    <!-- Table records filtering -->
                    Filter: 
                    <select class="input-short">
                    	<option value="1" selected="selected">Select filter</option>
                        <option value="2">Created last week</option>
                        <option value="3">Created last month</option>
                        <option value="4">Edited last week</option>
                        <option value="5">Edited last month</option>
                    </select>
                    
                </div>
                
                
                <!-- Example table -->
                <div class="module">
                	<h2><span>Sample table</span></h2>
                    
                    <div class="module-table-body">
                    	<form action="">
                        <table id="myTable" class="tablesorter">
                        	<thead>
                                <tr>
                                    <th style="width:5%">#</th>
                                    <th style="width:20%">Title</th>
                                    <th style="width:21%">Author</th>
                                    <th style="width:13%">Category</th>
                                    <th style="width:13%">Pages</th>
                                    <th style="width:13%">Price</th>
                                    <th style="width:15%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="align-center">1</td>
                                    <td><a href="">Don Quixote</a></td>
                                    <td>Cervantes</td>
                                    <td>adventure</td>
                                    <td>992</td>
                                    <td>$11.55</td>
                                    <td>
                                    	<input type="checkbox" />
                                        <a href=""><img src="img/tick-circle.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/tick-circle.gif" width="16" height="16" alt="published" /></a>
                                        <a href=""><img src="img/pencil.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/pencil.gif" width="16" height="16" alt="edit" /></a>
                                        <a href=""><img src="img/balloon.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/balloon.gif" width="16" height="16" alt="comments" /></a>
                                        <a href=""><img src="img/bin.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/bin.gif" width="16" height="16" alt="delete" /></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-center">2</td>
                                    <td><a href="">Lord Jim</a></td>
                                    <td>Joseph Conrad</td>
                                    <td>thriller</td>
                                    <td>400</td>
                                    <td>$6.95</td>
                                    <td>
                                    	<input type="checkbox" />
                                        <a href=""><img src="img/minus-circle.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/minus-circle.gif" width="16" height="16" alt="not published" /></a>
                                        <a href=""><img src="img/pencil.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/pencil.gif" width="16" height="16" alt="edit" /></a>
                                        <a href=""><img src="img/balloon.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/balloon.gif" width="16" height="16" alt="comments" /></a>
                                        <a href=""><img src="img/bin.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/bin.gif" width="16" height="16" alt="delete" /></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-center">3</td>
                                    <td><a href="">Inferno</a></td>
                                    <td>Dante</td>
                                    <td>drama</td>
                                    <td>528</td>
                                    <td>$8.76</td>
                                    <td>
                                    	<input type="checkbox" />
                                        <a href=""><img src="img/minus-circle.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/minus-circle.gif" width="16" height="16" alt="not published" /></a>
                                        <a href=""><img src="img/pencil.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/pencil.gif" width="16" height="16" alt="edit" /></a>
                                        <a href=""><img src="img/balloon.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/balloon.gif" width="16" height="16" alt="comments" /></a>
                                        <a href=""><img src="img/bin.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/bin.gif" width="16" height="16" alt="delete" /></a>
                                    </td>
                                </tr>
                                 <tr>
                                    <td class="align-center">3</td>
                                    <td><a href="">Inferno</a></td>
                                    <td>Dante</td>
                                    <td>drama</td>
                                    <td>528</td>
                                    <td>$8.76</td>
                                    <td>
                                        <input type="checkbox" />
                                        <a href=""><img src="img/minus-circle.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/minus-circle.gif" width="16" height="16" alt="not published" /></a>
                                        <a href=""><img src="img/pencil.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/pencil.gif" width="16" height="16" alt="edit" /></a>
                                        <a href=""><img src="img/balloon.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/balloon.gif" width="16" height="16" alt="comments" /></a>
                                        <a href=""><img src="img/bin.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/bin.gif" width="16" height="16" alt="delete" /></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-center">3</td>
                                    <td><a href="">Inferno</a></td>
                                    <td>Dante</td>
                                    <td>drama</td>
                                    <td>528</td>
                                    <td>$8.76</td>
                                    <td>
                                        <input type="checkbox" />
                                        <a href=""><img src="img/minus-circle.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/minus-circle.gif" width="16" height="16" alt="not published" /></a>
                                        <a href=""><img src="img/pencil.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/pencil.gif" width="16" height="16" alt="edit" /></a>
                                        <a href=""><img src="img/balloon.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/balloon.gif" width="16" height="16" alt="comments" /></a>
                                        <a href=""><img src="img/bin.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/bin.gif" width="16" height="16" alt="delete" /></a>
                                    </td>
                                </tr>
                                 <tr>
                                    <td class="align-center">3</td>
                                    <td><a href="">Inferno</a></td>
                                    <td>Dante</td>
                                    <td>drama</td>
                                    <td>528</td>
                                    <td>$8.76</td>
                                    <td>
                                        <input type="checkbox" />
                                        <a href=""><img src="img/minus-circle.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/minus-circle.gif" width="16" height="16" alt="not published" /></a>
                                        <a href=""><img src="img/pencil.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/pencil.gif" width="16" height="16" alt="edit" /></a>
                                        <a href=""><img src="img/balloon.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/balloon.gif" width="16" height="16" alt="comments" /></a>
                                        <a href=""><img src="img/bin.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/bin.gif" width="16" height="16" alt="delete" /></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-center">3</td>
                                    <td><a href="">Inferno</a></td>
                                    <td>Dante</td>
                                    <td>drama</td>
                                    <td>528</td>
                                    <td>$8.76</td>
                                    <td>
                                        <input type="checkbox" />
                                        <a href=""><img src="img/minus-circle.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/minus-circle.gif" width="16" height="16" alt="not published" /></a>
                                        <a href=""><img src="img/pencil.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/pencil.gif" width="16" height="16" alt="edit" /></a>
                                        <a href=""><img src="img/balloon.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/balloon.gif" width="16" height="16" alt="comments" /></a>
                                        <a href=""><img src="img/bin.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/bin.gif" width="16" height="16" alt="delete" /></a>
                                    </td>
                                </tr>
                                 <tr>
                                    <td class="align-center">3</td>
                                    <td><a href="">Inferno</a></td>
                                    <td>Dante</td>
                                    <td>drama</td>
                                    <td>528</td>
                                    <td>$8.76</td>
                                    <td>
                                        <input type="checkbox" />
                                        <a href=""><img src="img/minus-circle.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/minus-circle.gif" width="16" height="16" alt="not published" /></a>
                                        <a href=""><img src="img/pencil.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/pencil.gif" width="16" height="16" alt="edit" /></a>
                                        <a href=""><img src="img/balloon.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/balloon.gif" width="16" height="16" alt="comments" /></a>
                                        <a href=""><img src="img/bin.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/bin.gif" width="16" height="16" alt="delete" /></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-center">3</td>
                                    <td><a href="">Inferno</a></td>
                                    <td>Dante</td>
                                    <td>drama</td>
                                    <td>528</td>
                                    <td>$8.76</td>
                                    <td>
                                        <input type="checkbox" />
                                        <a href=""><img src="img/minus-circle.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/minus-circle.gif" width="16" height="16" alt="not published" /></a>
                                        <a href=""><img src="img/pencil.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/pencil.gif" width="16" height="16" alt="edit" /></a>
                                        <a href=""><img src="img/balloon.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/balloon.gif" width="16" height="16" alt="comments" /></a>
                                        <a href=""><img src="img/bin.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/bin.gif" width="16" height="16" alt="delete" /></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="align-center">3</td>
                                    <td><a href="">Inferno</a></td>
                                    <td>Dante</td>
                                    <td>drama</td>
                                    <td>528</td>
                                    <td>$8.76</td>
                                    <td>
                                        <input type="checkbox" />
                                        <a href=""><img src="img/minus-circle.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/minus-circle.gif" width="16" height="16" alt="not published" /></a>
                                        <a href=""><img src="img/pencil.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/pencil.gif" width="16" height="16" alt="edit" /></a>
                                        <a href=""><img src="img/balloon.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/balloon.gif" width="16" height="16" alt="comments" /></a>
                                        <a href=""><img src="img/bin.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/bin.gif" width="16" height="16" alt="delete" /></a>
                                    </td>
                                </tr>
                                 <tr>
                                    <td class="align-center">3</td>
                                    <td><a href="">Inferno</a></td>
                                    <td>Dante</td>
                                    <td>drama</td>
                                    <td>528</td>
                                    <td>$8.76</td>
                                    <td>
                                        <input type="checkbox" />
                                        <a href=""><img src="img/minus-circle.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/minus-circle.gif" width="16" height="16" alt="not published" /></a>
                                        <a href=""><img src="img/pencil.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/pencil.gif" width="16" height="16" alt="edit" /></a>
                                        <a href=""><img src="img/balloon.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/balloon.gif" width="16" height="16" alt="comments" /></a>
                                        <a href=""><img src="img/bin.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/bin.gif" width="16" height="16" alt="delete" /></a>
                                    </td>
                                </tr>
                                 <tr>
                                    <td class="align-center">3</td>
                                    <td><a href="">Inferno</a></td>
                                    <td>Dante</td>
                                    <td>drama</td>
                                    <td>528</td>
                                    <td>$8.76</td>
                                    <td>
                                        <input type="checkbox" />
                                        <a href=""><img src="img/minus-circle.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/minus-circle.gif" width="16" height="16" alt="not published" /></a>
                                        <a href=""><img src="img/pencil.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/pencil.gif" width="16" height="16" alt="edit" /></a>
                                        <a href=""><img src="img/balloon.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/balloon.gif" width="16" height="16" alt="comments" /></a>
                                        <a href=""><img src="img/bin.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/bin.gif" width="16" height="16" alt="delete" /></a>
                                    </td>
                                </tr>
                                 <tr>
                                    <td class="align-center">3</td>
                                    <td><a href="">Inferno</a></td>
                                    <td>Dante</td>
                                    <td>drama</td>
                                    <td>528</td>
                                    <td>$8.76</td>
                                    <td>
                                        <input type="checkbox" />
                                        <a href=""><img src="img/minus-circle.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/minus-circle.gif" width="16" height="16" alt="not published" /></a>
                                        <a href=""><img src="img/pencil.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/pencil.gif" width="16" height="16" alt="edit" /></a>
                                        <a href=""><img src="img/balloon.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/balloon.gif" width="16" height="16" alt="comments" /></a>
                                        <a href=""><img src="img/bin.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/bin.gif" width="16" height="16" alt="delete" /></a>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                        </form>
                        <div class="pager" id="pager">
                            <form action="">
                                <div>
                                <img class="first" src="img/arrow-stop-180.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/arrow-stop-180.gif" alt="first"/>
                                <img class="prev" src="img/arrow-180.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/arrow-180.gif" alt="prev"/> 
                                <input type="text" class="pagedisplay input-short align-center"/>
                                <img class="next" src="img/arrow.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/arrow.gif" alt="next"/>
                                <img class="last" src="img/arrow-stop.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/arrow-stop.gif" alt="last"/> 
                                <select class="pagesize input-short align-center">
                                    <option value="10" selected="selected">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                </select>
                                </div>
                            </form>
                        </div>
                        <div class="table-apply">
                            <form action="">
                            <div>
                            <span>Apply action to selected:</span> 
                            <select class="input-medium">
                                <option value="1" selected="selected">Select action</option>
                                <option value="2">Publish</option>
                                <option value="3">Unpublish</option>
                                <option value="4">Delete</option>
                            </select>
                            </div>
                            </form>
                        </div>
                        <div style="clear: both"></div>
                     </div> <!-- End .module-table-body -->
                </div> <!-- End .module -->
                
                
                     <div class="pagination">           
                		<a href="" class="button"><span><img src="img/arrow-stop-180-small.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/arrow-stop-180-small.gif" height="9" width="12" alt="First" /> First</span></a> 
                        <a href="" class="button"><span><img src="img/arrow-180-small.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/arrow-180-small.gif" height="9" width="12" alt="Previous" /> Prev</span></a>
                        <div class="numbers">
                            <span>Page:</span> 
                            <a href="">1</a> 
                            <span>|</span> 
                            <a href="">2</a> 
                            <span>|</span> 
                            <span class="current">3</span> 
                            <span>|</span> 
                            <a href="">4</a> 
                            <span>|</span> 
                            <a href="">5</a> 
                            <span>|</span> 
                            <a href="">6</a> 
                            <span>|</span> 
                            <a href="">7</a> 
                            <span>|</span> 
                            <span>...</span> 
                            <span>|</span> 
                            <a href="">99</a>
                        </div> 
                        <a href="" class="button"><span>Next <img src="img/arrow-000-small.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/arrow-000-small.gif" height="9" width="12" alt="Next" /></span></a> 
                        <a href="" class="button last"><span>Last <img src="img/arrow-stop-000-small.gif" tppabs="http://www.xooom.pl/work/magicadmin/images/arrow-stop-000-small.gif" height="9" width="12" alt="Last" /></span></a>
                        <div style="clear: both;"></div> 
                     </div>
                
                

                
			</div> <!-- End .grid_12 -->
                
            <!-- Categories list -->
            <div class="grid_6">
                
                <div class="module">
                     <h2><span>Categories</span></h2>
                        
                     <div class="module-body">
                         <a href="" class="removable">images</a><br />
                         <a href="" class="removable">video</a><br />
                         <a href="" class="removable">audio</a><br />
                         <a href="" class="removable">documents</a><br />
                         <a href="" class="removable">apps</a><br />
                         <a href="" class="removable">others</a>
                         
                         <form action="">
                            <fieldset>
                                <input type="text" class="input-medium" />&nbsp;&nbsp;<input class="submit-green" type="submit" value="Add category" />
                            </fieldset>
                         </form>
                     </div>
                </div> <!-- module -->
                <div style="clear:both;"></div>
			</div> <!-- End .grid_6 -->
            
            <!-- To-do list -->
            <div class="grid_6">
            
                <div class="module">
                     <h2><span>To-do list</span></h2>
                        
                     <div class="module-body">
                         <a href="" class="checkable">check articles for spelling</a><br />
                         <a href="" class="checkable">remove old articles</a><br />
                         <a href="" class="checkable">switch to a bigger plan</a><br />
                         <a href="" class="removable completed">write an article</a><br />
                         <a href="" class="removable completed">do maintanance stuff</a><br />

                         
                         <form action="">
                            <fieldset>
                                <input type="text" class="input-medium" />&nbsp;&nbsp;<input class="submit-green" type="submit" value="Add item" />
                            </fieldset>
                         </form>
                     </div>
                </div> <!-- module -->
                <div style="clear:both;"></div>
            
            </div> <!-- End .grid_6 -->
            <div style="clear:both;"></div>
            
            <!-- Form elements -->    
            <div class="grid_12">
            
                <div class="module">
                     <h2><span>Form</span></h2>
                        
                     <div class="module-body">
                        <form action="">
                        
                            <div>
                                <span class="notification n-success">Success notification.</span>
                            </div>
                            
                            <p>
                                <label>Short textfield</label>
                                <input type="text" class="input-short" />
                                <span class="notification-input ni-correct">This is correct, thanks!</span>
                            </p>
                            
                            <p>
                                <label>Medium textfield</label>
                                <input type="text" class="input-medium" />
                                <span class="notification-input ni-error">Sorry, try again.</span>
                            </p>
                            
                            
                            <p>
                                <label>Long textfield</label>
                                <input type="text" class="input-long" /><span class="notification-input ni-error">Sorry, try again.</span>
                            </p>
                            
                            <p>
                                <label>Short select input</label>
                                <select class="input-short">
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                    <option value="4">Option 4</option>
                                </select>
                            </p>
                            
                            <p>
                                <label>Medium select input</label>
                                <select class="input-medium">
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                    <option value="4">Option 4</option>
                                </select>
                            </p>
                            
                            <p>
                                <label>Long select input</label>
                                <select class="input-long">
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                    <option value="4">Option 4</option>
                                </select>
                            </p>
                            
                            <p>
                                <label>Short text area</label>
                                <textarea rows="7" cols="90" class="input-short"></textarea>
                            </p>
                            
                            <p>
                                <label>Medium text area</label>
                                <textarea rows="7" cols="90" class="input-medium"></textarea>
                            </p>
                            
                            
                            <p>
                                <label>Long text area</label>
                                <textarea rows="7" cols="90" class="input-long"></textarea>
                            </p>
                                
                            <fieldset>
                                <legend>Checkboxes</legend>
                                <ul>
                                    <li><label><input type="checkbox" name="a" checked="checked" id="cb1" /> checkbox 1</label></li>
                                    <li><label><input type="checkbox" name="b" id="cb2" />  checkbox 2</label></li>
                                </ul>
                            </fieldset>
                            
                            <fieldset>
                                <legend>Radio buttons</legend>
                                <ul>
                                    <li><label><input type="radio" name="c" checked="checked" /> radio button 1</label></li>
                                    <li><label><input type="radio" name="c" /> radio button 2</label></li>
                                </ul>
                            </fieldset>
                            
                            <fieldset>
                                <label>Textarea with WYSIWYG</label>
                                <textarea id="wysiwyg" rows="11" cols="90" name="desc">    </textarea> 
                            </fieldset>
                            
                            <fieldset>
                                <input class="submit-green" type="submit" value="Submit" /> 
                                <input class="submit-gray" type="submit" value="Cancel" />
                            </fieldset>
                        </form>
                     </div> <!-- End .module-body -->

                </div>  <!-- End .module -->
        		<div style="clear:both;"></div>
            </div> <!-- End .grid_12 -->
                
            <!-- Settings-->
            <div class="grid_6">
                <div class="module">
                     <h2><span>Settings</span></h2>
                        
                     <div class="module-body">
                        <p class="notification n-attention"><strong>Running out of space?</strong><br />Just contact us and switch to a bigger plan</p>
                        
                         <div>
                             <div class="indicator">
                                 <div style="width: 23%;"><!-- change the width value (23%) to dynamically control your indicator -->
                                  </div>
                             </div>
                             <p>Your storage space: 23 MB out of 100MB</p>
                         </div>
                         
                         <div>
                             <div class="indicator">
                                 <div style="width: 100%;"><!-- change the width value (100%) to dynamically control your indicator -->
                                  </div>
                             </div>
                             <p>Your bandwidth (January): 1 GB out of 1 GB</p>
                         </div>
                         
                     </div> <!-- End .module-body -->
                </div> <!-- End .module -->
            </div> <!-- End .grid_6 -->
                
            <!-- Password -->
            <div class="grid_6">
                <div class="module">
                     <h2><span>Password</span></h2>
                        
                     <div class="module-body">
                        <form action="">
                            <p>
                                <label>Type in new password</label>
                                <input class="input-medium password" type="password" />
                            </p>
                            <p>
                                <label>Repeat password</label>
                                <input type="password" class="input-medium" />
                            </p>
                            <fieldset>
                                <input class="submit-green" type="submit" value="Submit" /> 
                                <input class="submit-gray" type="submit" value="Cancel" />
                            </fieldset>
                        </form>
                        
                     </div> <!-- End .module-body -->
                </div> <!-- End .module -->
                <div style="clear:both;"></div>
            </div> <!-- End .grid_6 -->
            <div style="clear:both;"></div>
            
			<div class="grid_3">
				<h1>Heading 1</h1>
                <h2>Heading 2</h2>
                <h3>Heading 3</h3>
				<h4>Heading 4</h4>
                <h5>Heading 5</h5>
                <h6>Heading 6</h6>
            </div> <!-- End .grid_3 -->
            
            
            <div class="grid_3">
            	<p>Unordered list:</p>
                <ul class="bullets">
                	<li>UL Element 1</li>
                    <li>UL Element 2</li>
                    <li>UL Element 3</li>
                    <li>UL Element 4</li>
                    <li>UL Element 5</li>
                </ul>
            	<p>Ordered list:</p>
                <ol>
                	<li>OL Element 1</li>
                    <li>OL Element 2</li>
                    <li>OL Element 3</li>
                    <li>OL Element 4</li>
                    <li>OL Element 5</li>
                </ol>
            </div> <!-- End .grid_3 -->
            
            <div class="grid_6">
            	<p>Paragraph text:</p>
            
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vel nibh sit amet metus lacinia hendrerit. Nullam tempus sem ut quam luctus rhoncus. Nullam vitae justo ligula, nec sollicitudin mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam ut mauris quis sapien adipiscing porttitor vitae at mauris. Fusce imperdiet placerat nunc tincidunt varius. Quisque tempus, nibh ac tempus faucibus, elit lorem aliquam mauris, facilisis ornare nisl sapien eu mi. Vivamus ac tempor nulla. Fusce ac lectus sapien. Aliquam commodo urna nec leo tincidunt non ultrices augue consequat. Curabitur justo risus, placerat eu auctor et, scelerisque vitae velit. Mauris venenatis nisl ut elit congue in euismod libero ultrices. Duis tincidunt sagittis velit, in auctor elit molestie sit amet.</p> 
                
                <p>Vivamus tellus magna, malesuada ac cursus sed, facilisis non ligula. Nam porta ullamcorper nibh id sagittis. Mauris risus nisi, dictum eget feugiat in, egestas in diam. Nulla dictum pharetra bibendum. Morbi turpis sapien, dignissim congue dignissim in, laoreet non felis. Sed elit turpis, interdum cursus vulputate ut, consectetur eget odio. Morbi dolor velit, volutpat auctor aliquet id, auctor sit amet neque. Curabitur id quam sit amet est sagittis posuere. Sed a nunc eros, hendrerit pulvinar felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eget felis eget neque tristique scelerisque sed et magna.</p> 
                
            </div> <!-- End .grid_6 -->

            
            <div style="clear:both;"></div>
        </div> <!-- End .container_12 -->
		
<?php
    require_once('includes/footer.php');
?>