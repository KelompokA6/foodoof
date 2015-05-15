<div class="panel col-md-12 col-xs-12 col-sm-12 col-no-padding">
	<div class="col-md-12 col-xs-12 col-sm-12 col-no-padding">
		<ul class="nav nav-tabs" role="tablist">
		  <li id="conversation-personal" role="presentation" class="active col-md-6 col-no-padding"><a href="#">Personal <span class="badge">{sidebar_conversation_unread_personal}</span></a></li>
		  <li id="conversation-group" role="presentation" class="col-md-6 col-no-padding"><a href="#">Group <span class="badge">{sidebar_conversation_unread_group}</span></a></li>
		</ul>
	</div>
	<div class="col-md-12 col-xs-12 col-sm-12 input-group" style="padding:5px;">
		<input type="search" class="form-control" aria-label="...">
		<div class="input-group-btn">
			<button class="btn button-secondary button-group-normal"><i class="fa fa-search"></i></button>
		</div>
	</div>
	<div class="col-md-12 col-xs-12 col-sm-12 col-no-padding">
		<ul class="conversation-list-group">
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
