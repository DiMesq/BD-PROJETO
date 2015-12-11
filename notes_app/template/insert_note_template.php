<div id="enterFieldsModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header font-black">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Note</h4>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" id="addNote" action="page.php" method="POST">
                <?php foreach ($fields as $key => $field): ?>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input type="text" class="form-control" name=<?=$key?> placeholder="Note Name">
                        </div>
                    </div>
                <?php endforeach; ?>
                <input type="hidden" id="typeid" name="typeid" value=<?=$typeid?>>
                <input type="hidden" id="nfields" name="nfields" value=<?=$key?>>
                <div class="form-group">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div> 
    </div>
    </div>
</div>