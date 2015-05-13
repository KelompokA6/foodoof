<div class="panel col-no-padding">
	<div class="panel-body">
        <?php echo $this->session->flashdata('alert-notification');?>
    	<h4 class="page-header-title text-capitalize text-center"> 
            <span style="line-height:34px">{conversation_subject}</span>
            <a href='<?php echo base_url();?>index.php/user/newConversation' class='pull-right'>
                <button class='btn button-primary'>
                    <i class='fa fa-plus fa-lg'></i>
                    New Conversation
                </button>
            </a>
        </h4>
        <h5 class="page-header-title text-capitalize border-solid-bottom">
            {conversation_member_entries}
            <a href="<?php echo base_url();?>index.php/user/timeline/{conversation_member_id}">{conversation_member_name}</a>
            {/conversation_member_entries}
        </h5>
        <ul class="message-list-group">
            {conversation_message_entries}
            <li class="clearfix col-md-12 col-xs-12 col-sm-12 message-list-item">
                <div class="col-md-1 col-sm-1 col-xs-1 col-no-padding">
                    <img class="img-responsive img-rounded img-message" src="<?php echo base_url();?>{conversation_message_user_photo}">
                </div>
                <div class="col-md-11 col-sm-11 col-xs-11 col-no-padding message-details">
                    <div class="col-md-12 col-xs-12 col-sm-12 col-no-padding">
                        <div class="col-md-9 col-xs-9 col-sm-9 users-message col-no-padding-right">
                            <a href="<?php echo base_url();?>index.php/user/timeline/{conversation_message_user_id}">{conversation_message_user_name}</a>
                        </div>
                        <div class="col-md-3 col-xs-3 col-sm-3 time-message col-no-padding text-right">
                            <span data-livestamp="{conversation_message_submit}"></span>
                        </div>
                    </div>
                    <div class="col-md-12 col-xs-12 col-sm-12 col-no-padding-right message-value">
                        {conversation_message_description}
                    </div>
                </div>
            </li>
            {/conversation_message_entries}
        </ul>
           <form class="form-horizontal" action="<?php echo base_url();?>index.php/user/addMessage" role="form" method="post" enctype="multipart/form-data">
            <div class="col-md-12 col-xs-12 col-no-padding-right form-group">
                <div class="col-md-10 col-xs-9 col-no-padding">
                    <textarea class="form-control" name="message" placeholder="Write Your Message In Here ..."></textarea>
                </div>
                <div class="col-md-2 col-xs-3 col-no-padding-right" style="position:absolute; right:0; bottom:0">
                    <button type="submit" class="btn button-primary col-md-12 col-xs-12">Send</button>
                </div>
            </div>
        </form>
	</div>
</div>