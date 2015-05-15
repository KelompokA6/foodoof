<div class="panel col-no-padding">
	<div class="panel-body">
        <?php echo $this->session->flashdata('alert-notification');?>
        <div id="conversation-summary" data-idconversation="{conversation_id}" class="col-md-12 col-sm-12 col-xs-12 page-header-title">
            <h5 class="subject-conversation text-capitalize text-center col-md-9 col-sm-9 col-xs-9 col-no-padding" style="line-height:34px;"> 
                <span>{conversation_subject}</span>
                <?php if(sizeof($conversation_member_entries) > 2):?>
                <span role="button" title='Others' data-toggle="popover-x" data-target="#other_user" data-placement="bottom"><?php echo sizeof($conversation_member_entries)-2;?> Others</span>
                <div id="other_user" class="popover popover-default">
                    <div class="arrow"></div>
                    <div class="popover-content">
                        <ul class="list-group other-user-list-group">
                            <?php foreach ($conversation_member_entries as $conversation_member_entry) {?>  
                            <a href="<?php echo base_url();?>index.php/user/timeline/<?php echo $conversation_member_entry["conversation_member_id"];?>">                        
                                <li class="other-user-list-group-item col-md-12 col-xs-12 col-sm-12 border-solid-bottom">
                                    <img src="<?php echo base_url().$conversation_member_entry["conversation_member_photo"];?>" class="other-user-photo">
                                    <span class="other-user-name"><?php echo $conversation_member_entry["conversation_member_name"];?></span>
                                </li>
                            </a>
                            <?php }?>
                        </ul>  
                    </div>
                </div>
                <?php endif;?>
            </h5>
            <a href='<?php echo base_url();?>index.php/user/createconversation' class='col-md-3 col-sm-3 col-xs-3 col-no-padding text-right'>
                <button class='btn button-primary'>
                    <i class='fa fa-plus fa-lg'></i>
                    New Conversation
                </button>
            </a>
        </div>
        <ul class="message-list-group">
            {conversation_message_entries}
            <li class="clearfix conversation_message_entries col-md-12 col-xs-12 col-sm-12 message-list-item">
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
           <form class="form-horizontal" action="<?php echo base_url();?>index.php/user/addmessage/{conversation_id}" role="form" method="post" enctype="multipart/form-data">
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