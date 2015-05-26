<div class="panel col-md-12 col-xs-12 col-sm-12 col-no-padding">
	<div class="col-md-12 col-xs-12 col-sm-12 panel-title-side-conversation text-center">
		Your Conversations <?php if($sidebar_conversation_total>0):?>
			<span id="total-unread-sidebar" class="badge"><?php echo $sidebar_conversation_total;?></span>
		<?php endif;?>
		<a href='<?php echo base_url();?>index.php/user/createconversation' class='pull-right' title="New Conversation">
            <button class='btn button-secondary' style="padding-top:8px;">
                <i class='fa fa-plus fa-lg'></i>
            </button>
        </a>
	</div>
	<div class="col-md-12 col-xs-12 col-sm-12 col-no-padding">
		<ul class="conversation-list-group">
			<?php if(empty($sidebar_conversation_entries)):?>
				<div class="col-md-12 col-xs-12 col-sm-12 text-center"> No Conversation</div>
			<?php endif;?>
			{sidebar_conversation_entries}
			<a href="<?php echo base_url();?>index.php/user/message/{sidebar_conversation_id}">
				<li class="conversation-list-item col-md-12 col-sm-12 col-xs-12" data-idconversation="{sidebar_conversation_id}" data-countmessage="{sidebar_conversation_unread}">
					<div class="col-md-2 col-sm-2 col-xs-2 col-no-padding">
						<img class="img-responsive img-rounded img-conversation" src="<?php echo base_url();?>{sidebar_conversation_sender_photo}">
					</div>
					<div class="col-md-10 col-sm-10 col-xs-10 col-no-padding conversation-details">
						<div class="col-md-12 col-xs-12 col-sm-12 col-no-padding">
							<div class="col-md-8 col-xs-8 col-sm-8 users-conversation col-no-padding-right" style="font-weight:bold">
								<div class="col-md-7 col-xs-7 col-sm-7 subject_conversation col-no-padding" title="{sidebar_conversation_subject}">
									{sidebar_conversation_subject}
								</div>
								<div class="col-md-5 col-xs-5 col-sm-5 col-no-padding" style="font-size:11px">
									{sidebar_conversation_participants}
								</div>
							</div>
							<div class="conversation-submit col-md-4 col-xs-4 col-sm-4 time-conversation col-no-padding text-right">
								<span data-livestamp="{sidebar_conversation_submit}"></span>
							</div>
						</div>
						<div class="conversation-last-message col-md-12 col-xs-12 col-sm-12 col-no-padding-right title-conversation">
							{sidebar_conversation_last_message}
						</div>
					</div>
				</li>
			</a>
			{/sidebar_conversation_entries}
		</ul>
	</div>
</div>
