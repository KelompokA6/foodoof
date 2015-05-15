<div class="panel col-no-padding">
	<div class="panel-body">
        <h3 class="page-header-title text-capitalize"> Broadcast Message </h3>
        <?php
        echo $this->session->flashdata('alert-admin');
        ?>
        <form id="send-email-form" class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>index.php/admin/sendmail/1"> 
            <div class="form-group">
                <label for="subject" class="col-md-2 col-xs-2 col-md-2 control-label">Subject</label>
                <div class="col-md-10 col-xs-10 col-md-10">
                    <input type="text" class="form-control" name="subject" placeholder="Subject Conversation" required>
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-md-2 col-xs-2 col-md-2 control-label">Message</label>
                <div id="message-email" class="col-md-10 col-xs-10 col-md-10" style="margin-top: 10px;">
                    <textarea class="form-control textarea" row="4" name="message"></textarea>
                </div>
            </div>
            <div class="form-group">                                        
                <div class="col-md-offset-3 col-md-6 text-center">
                    <button type="submit" class="btn button-primary btn-lg"><i class="icon-hand-right"></i> &nbsp Send &nbsp</button> 
                </div>
            </div>
        </form>
	</div>
</div>