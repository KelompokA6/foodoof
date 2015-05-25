<div class="panel col-no-padding">
	<div class="panel-body">
	  <h3 class="page-header-title text-capitalize"> Create New Conversation </h3>
	  <form id="create-conv-form" class="form-horizontal" role="form" method="post" action="<?php echo base_url();?>index.php/user/addconversation">
        <div class="form-group">
            <label for="to" class="col-md-2 col-xs-2 col-md-2 control-label">To</label>
            <div class="col-md-10 col-xs-10 col-md-10">
                <input id="users-conversation" type="text" class="form-control" name="users" placeholder="User Name">
            </div>
        </div> 
        <div class="form-group">
            <label for="subject" class="col-md-2 col-xs-2 col-md-2 control-label">Subject</label>
            <div class="col-md-10 col-xs-10 col-md-10">
                <input type="text" class="form-control" name="subject" placeholder="Subject Conversation">
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-md-2 col-xs-2 col-md-2 control-label">Message</label>
            <div class="col-md-10 col-xs-10 col-md-10">
                <textarea id="enter-message" class="form-control" row="4" name="message" placeholder="Your Message" required></textarea>
            </div>
        </div>
        <div class="form-group">                                        
            <div class="col-md-offset-3 col-md-6 text-center">
                <button id="btn-signup" type="submit" class="btn button-primary btn-lg"><i class="icon-hand-right"></i> &nbsp Send &nbsp</button> 
            </div>
        </div>
        </form>
	</div>
</div>