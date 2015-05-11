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
			<li class="conversation-list-item col-md-12 col-sm-12 col-xs-12" data-countmessage="{sidebar_conversation_unread}">
				<div class="col-md-3 col-sm-3 col-xs-3 col-no-padding">
					<img class="img-responsive img-rounded img-conversation" src="<?php echo base_url();?>{sidebar_conversation_sender_photo}">
				</div>
				<div class="col-md-9 col-sm-9 col-xs-9 col-no-padding conversation-details">
					<div class="col-md-12 col-xs-12 col-sm-12 col-no-padding">
						<div class="col-md-8 col-xs-8 col-sm-8 users-conversation col-no-padding-right">
							{sidebar_conversation_members_name}
						</div>
						<div class="col-md-4 col-xs-4 col-sm-4 time-conversation col-no-padding text-right">
							<span data-livestamp="{sidebar_conversation_submit}"></span>
						</div>
					</div>
					<div class="col-md-12 col-xs-12 col-sm-12 col-no-padding-right title-conversation">
						{sidebar_conversation_last_message}
					</div>
				</div>
			</li>
			{/sidebar_conversation_entries}
		</ul>
	</div>
</div>
