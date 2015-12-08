<div class="container">
	<div class="row row-content">
        <div class="col-xs-12 col-sm-9">
            <h2>Your Pages</h2>
            <div class="table-responsive">
		        <table class="table table-striped">
		        	<thead>
		            <tr>
		                <th>Nome</th>
		            </tr>
		            </thead>
		            <tbody>
		            <?php foreach ($pages as $page): ?>
			            <tr>
			                <td><?=$page['nome']?></td>
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
