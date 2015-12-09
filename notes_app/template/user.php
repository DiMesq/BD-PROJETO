<div id="deletePageModal" class="modal fade" role="dialog">
    <div class="modal-dialog small-modal-width">
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
<div id="addPageModal" class="modal fade" role="dialog">
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
<div id="addTypeModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header font-black">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Type</h4>
        </div>
        <div class="modal-body">
        	<form class="form-inline" id="addType" action="index.php" method="POST">
        		<div class="form-group">
        			<div class="col-xs-8">
						<input type="text" class="form-control" id="typename" name="typename" placeholder="Type Name"/>
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
	<div class="row row-content" id="pages">
        <div class="col-xs-10 col-sm-7">
            <h2>Your Pages</h2>
            <div class="table-responsive">
		        <table class="table table-striped">
		        	<thead>
		            <tr>
		                <th>Name</th>
		                <th><button data-toggle="modal" data-target="#addPageModal" class="btn btn-success center-block">New</button></th>
		            </tr>
		            </thead>
		            <tbody>
		            <?php foreach ($pages as $page): ?>
			            <tr>
			                <td><a href="page.php?page=<?=$page["pagecounter"]?>" class="link-font"><?=htmlentities($page['nome'], ENT_QUOTES, 'ISO-8859-1')?></a></td>
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
		                <th>Name</th>
		                <th><button data-toggle="modal" data-target="#addTypeModal" class="btn btn-success center-block">New</button></th>
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