<div id="deletePageModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header font-black">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Are you sure?</h4>
        </div>
        <div class="modal-body">
        	<form class="form-inline" id="deletePage" action="index.php" method="POST">
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
<div id="deleteTypeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header font-black">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Are you sure?</h4>
        </div>
        <div class="modal-body">
        	<form class="form-inline" id="deleteType" action="index.php" method="POST">
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
<div class="container">
	<div class="row row-content" id="pages">
        <div class="col-xs-10 col-sm-7">
            <h2>Your Pages</h2>
            <div class="table-responsive">
		        <table class="table table-striped">
		        	<thead>
		            <tr>
		                <th>Nome</th>
		                <th>&nbsp;</th>
		            </tr>
		            </thead>
		            <tbody>
		            <?php foreach ($pages as $page): ?>
			            <tr>
			                <td><?=htmlentities($page['nome'], ENT_QUOTES, 'ISO-8859-1')?></td>
			                <td><button data-toggle="modal" data-target="#deletePageModal" class="btn btn-danger btn-sm center-block" id=<?=$page['pagecounter']?>>Delete</button></td>
			            </tr>
			        <?php endforeach; ?>
		            </tbody>
		        </table>
		    </div>
        </div>
         <div class="col-xs-2 col-sm-5">
            <p style="padding:20px;"></p>
        </div>
    </div>
</div>
<div class="container">
	<div class="row row-content" id="types">
        <div class="col-xs-10 col-sm-7">
            <h2>Your Types</h2>
            <div class="table-responsive">
		        <table class="table table-striped">
		        	<thead>
		            <tr>
		                <th>Nome</th>
		                <th>&nbsp;</th>
		            </tr>
		            </thead>
		            <tbody>
		            <?php foreach ($types as $type): ?>
			            <tr>
			                <td><?=htmlentities($type['nome'], ENT_QUOTES, 'ISO-8859-1')?></td>
			                <td><button data-toggle="modal" data-target="#deleteTypeModal" class="btn btn-danger btn-sm center-block" id=<?=$type['typecnt']?>>Delete</button></td>
			            </tr>
			        <?php endforeach; ?>
		            </tbody>
		        </table>
		    </div>
        </div>
         <div class="col-xs-2 col-sm-5">
            <p style="padding:20px;"></p>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/user.js"></script>