<div id="deleteNoteModal" class="modal fade" role="dialog">
    <div class="modal-dialog small-modal-width">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header font-black">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Are you sure?</h4>
        </div>
        <div class="modal-body">
        	<form class="form-inline" id="deleteNote" action="page.php" method="POST">
		        <div class="form-group">
		          	<div class="col-sm-5 col-sm-offset-2">
		            	<button type="submit" class="btn btn-danger">YES</button>
		          	</div>
		        </div>
		    </form>
        </div> 
    </div>
    </div>
</div>
<div id="addNoteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header font-black">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Page</h4>
        </div>
        <div class="modal-body">
            <form class="form-inline" id="addPage" action="index.php" method="POST">
                <div class="form-group">
                    <div class="col-xs-8">
                        <input type="text" class="form-control" id="pagename" name="pagename" placeholder="Page Name"/>
                    </div>
                    <div class="col-xs-2"></div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div> 
    </div>
    </div>
</div>
<div id="editFieldModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header font-black">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Page</h4>
        </div>
        <div class="modal-body">
            <form class="form-inline" id="editField"
                    <div class="col-xs-8">
                        <input type="text" class="form-control" id="pagename" name="pagename" placeholder="Page Name"/>
                    </div>
                    <div class="col-xs-2"></div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div> 
    </div>
    </div>
</div>
<div class="container">
    <div class="row row-content" id="notes">
        <div class="col-xs-12 col-sm-9">
            <h2>Your Notes</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Note Name</th>
                        <th>Type Name</th>
                        <th>Fields</th>
                        <th><button data-toggle="modal" data-target="#addNoteModal" class="btn btn-success center-block">New</button></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($notes as $key => $note): ?>
                        <tr>
                            <td><?=htmlentities($note['rnome'], ENT_QUOTES, 'ISO-8859-1')?></td>
                            <td><?=htmlentities($note['tnome'], ENT_QUOTES, 'ISO-8859-1')?></td>
                            <td>
                                <div class="table-responsive">
                                    <table class="table dark-table">
                                        <thead>
                                        <tr>
                                            <th>Field Name</th>
                                            <th>Value</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($note["fields"] as $key => $field): ?>
                                            <tr>
                                                <td><?=htmlentities($field['cnome'], ENT_QUOTES, 'ISO-8859-1')?></td>
                                                <td><?=htmlentities($field['valor'], ENT_QUOTES, 'ISO-8859-1')?></td>
                                                <td><button data-toggle="modal" data-target="#editFieldModal" class="btn btn-primary btn-sm center-block" id=<?=$field['campocnt']?>>Edit</button></td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                            <td><button data-toggle="modal" data-target="#deleteNoteModal" class="btn btn-danger btn-sm center-block" id=<?=$note['regcounter']?>>Delete</button></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
         <div class="col-xs-12 col-sm-3">
            <p style="padding:20px;"></p>
        </div>
    </div>
</div>