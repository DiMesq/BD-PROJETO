<div id="deleteFieldModal" class="modal fade" role="dialog">
    <div class="modal-dialog small-modal-width">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header font-black">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Are you sure?</h4>
        </div>
        <div class="modal-body">
        	<form class="form-inline" id="deleteField" action="type.php" method="POST">
		        <div class="form-group">
		          	<div class="col-sm-5 col-sm-offset-2">
		            	<button type="submit" class="btn btn-danger">YES</button>
		          	</div>
		        </div>
                <input type="hidden" name="typeid" value=<?=$typeid?>>
		    </form>
        </div> 
    </div>
    </div>
</div>
<div id="addFieldModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header font-black">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Specify the new Field name</h4>
        </div>
        <div class="modal-body">
            <form class="form-inline" id="addField" action="type.php" method="POST">
                <div class="form-group">
                    <div class="col-xs-10">
                        <input type="text" class="form-control" id="fieldname" name="fieldname" placeholder="Field Name"/>
                    </div>
                </div>
                <input type="hidden" id="typeid" name="typeid" value=<?=$typeid?>>
                <div class="form-group">
                        <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div> 
    </div>
    </div>
</div>
<div class="container">
    <div class="row row-content" id="fields">
        <div class="col-xs-12 col-sm-9">
            <h2>Fields For the <?=$tname?> Type</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Field Name</th>
                        <th><button data-toggle="modal" data-target="#addFieldModal" class="btn btn-success center-block">New</button></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($fields as $key => $field): ?>
                        <tr>
                            <td><?=htmlentities($field['nome'], ENT_QUOTES, 'ISO-8859-1')?></td>
                            <td><button data-toggle="modal" data-target="#deleteFieldModal" class="btn btn-danger btn-sm center-block" id=<?=$field['campocnt']?>>Delete</button></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (count($fields) < 1): ?>
                    <div class="col-xs-10 col-offset-2">
                        <h2> No fields! Add one in the green button above!</h2>
                    </div>
                <?php endif; ?>
            </div>
        </div>
         <div class="col-xs-12 col-sm-3">
            <p style="padding:20px;"></p>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/type.js"></script>