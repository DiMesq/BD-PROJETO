<div id="enterFieldsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header font-black">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Note - enter the Note's name and the Fields' values</h4>
        </div>
        <div class="modal-body font-black">
            <form class="form-horizontal" id="enterFields" action="insert_note.php" method="POST">
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <input type="text" class="form-control" id="regname" name="regname" placeholder="Note Name">
                    </div>
                </div>
                <?php foreach ($fields as $key => $field): ?>
                    <div class="form-group">
                        <label for=<?=$key?> class="col-sm-2 control-label"><?=htmlentities($field["nome"], ENT_QUOTES, 'ISO-8859-1')?></label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name=<?=$key?> placeholder="Field Value">
                        </div>
                    </div>
                <?php endforeach; ?>
                <input type="hidden" id="typeid" name="typeid" value=<?=$typeid?>>
                <input type="hidden" id="pageid" name="pageid" value=<?=$pageid?>>
                <div class="form-group">
                    <div class="col-xs-10 col-xs-offset-2">
                        <button type="submit" class="btn btn-success">Submit</button>
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
            <h4 class="modal-title">Specify the Type of your new Note</h4>
        </div>
        <div class="modal-body">
            <form class="form-inline" id="addNote" action="page.php" method="POST">
                <div class="form-group">
                    <div class="col-xs-10">
                        <input type="text" class="form-control" id="typename" name="typename" placeholder="Type Name"/>
                    </div>
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
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (count($notes) < 1): ?>
                    <div class="col-xs-10 col-offset-2">
                        <h2> No notes! Add one in the green button above!</h2>
                    </div>
                <?php endif; ?>
            </div>
        </div>
         <div class="col-xs-12 col-sm-3">
            <p style="padding:20px;"></p>
        </div>
    </div>
</div>
<script type="text/javascript">
    var showmodal = "<?php echo $showmodal; ?>";
    var pageid = "<?php echo $pageid; ?>";
</script>
<script type="text/javascript" src="js/page.js"></script>