$('#active').change(function(){
	if ($('#active').val() == 'no'){
		$('.current-activities').hide();
	} else {
		$('.current-activities').show();		
	}
});
(function( $ ) {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .attr("placeholder","Start typing your sport")
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            tooltipClass: "ui-state-highlight"
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Show All Sports" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .mousedown(function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .click(function() {
            input.focus();
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
        // Selected an item, nothing to do
        if ( ui.item ) {
        	console.log(this.input[0].value);
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.data( "ui-autocomplete" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
  })( jQuery );
$(function() {
	$('.timepicker').timepicker();
	$('#js-JoinTeam').ajaxForm({
		target: '#js-TeamMessages'
	});
    $( ".datepicker" ).datepicker();
    $( "#sportsbox" ).combobox();
    $( "#teamssbox" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#sportsbox" ).toggle();
      $( "#teamsbox" ).toggle();
    });
    $('.js-positionSelect').change(function(){
    	val = $(this).val();
    	$( ".js-stats" ).load( "sports/getStatsForPosition/" + val );   
    });
    $( ".js-wallPostAdd" ).submit(function( event ) {
    	event.preventDefault();
    	data = $('.js-wallPostAdd').serialize();
    	$.ajax({
    		url: "/teams/addWallPost",
    		type:'POST',
    		data:data})
    		.done(function( data ) {
    			$('.js-wallPostAdd, textarea').val('');
    			$('.js-teamWall').html(data);
    		}) 
    		.fail(function() {
    			alert( "error" );
    		});    	
    });
    $( ".js-eventWallPostAdd" ).submit(function( event ) {
    	event.preventDefault();
    	data = $('.js-eventWallPostAdd').serialize();
    	$.ajax({
    		url: "/event/addWallPost",
    		type:'POST',
    		data:data})
    		.done(function( data ) {
    			$('.js-eventWallPostAdd, textarea').val('');
    			$('.js-eventWall').html(data);
    		}) 
    		.fail(function() {
    			alert( "error" );
    		});    	
    });
    $( ".js-InviteFriend" ).submit(function( event ) {
    	event.preventDefault();
    	data = $('.js-InviteFriend').serialize();
    	$.ajax({
    		url: "/signin/invite",
    		type:'POST',
    		data:data})
    		.done(function( data ) {
    			$('#inviteFriendDialog, input').val('');
    			$('#inviteFriendDialog').dialog('close');
    			if (data === 'OK'){
    				alert('Email request sent');
    			} else {
    				alert('Email request failed');    				
    			}
    		}) 
    		.fail(function() {
    			alert( "error" );
    		});    	
    });
    
    $('.js-InviteFriends').bind('click',function(){
		$('#inviteDialog').dialog({
		      modal: true
		    });
    });
    $('.js-emailFriend').bind('click',function(){
    	event.preventDefault();
    	$('#inviteFriendDialog').dialog({
  	      modal: true
  	    });
    });
    $('.js-terms').bind('click',function(){
    	$('.terms').show();
    	$('html, body').animate({
            scrollTop: $('.terms').offset().top
        }, 500);
    	return false;
    });
});
function getMembers(team){
	$.ajax({
		url: "/teams/getTeamMembers/" + team ,
		type:'POST'})
		.done(function( data ) {
			$(".js-Members").html(data);
		}) 
		.fail(function() {
			alert( "error" );
	});    		
}
function acceptMember(team,member){
	event.preventDefault();
	$.ajax({
		url: "/teams/acceptMember/" + team + "/" + member,
		type:'POST'})
		.done(function( data ) {
			$(".js-MemberRequests").html(data);
			getMembers();
		}) 
		.fail(function() {
			alert( "error" );
	});    	
}
function declineMember(team,member){
	event.preventDefault();
	$.ajax({
		url: "/teams/declineMember/" + team + "/" + member,
		type:'POST'})
		.done(function( data ) {
			$(".js-MemberRequests").html(data);
		}) 
		.fail(function() {
			alert( "error" );
	});    	
}
function deletePost(team,id){
	if (confirm("Are you sure?")){
		event.preventDefault();
		$.ajax({
			url: "/teams/deleteWallPost/" + team + "/" + id,
			type:'POST'})
			.done(function( data ) {
				$(".js-teamWall").html(data);
			}) 
			.fail(function() {
				alert( "error" );
		});
	}
}
function deleteEventPost(eventId,id){
	if (confirm("Are you sure?")){
		event.preventDefault();
		$.ajax({
			url: "/event/deleteWallPost/" + eventId + "/" + id,
			type:'POST'})
			.done(function( data ) {
				$(".js-eventWall").html(data);
			}) 
			.fail(function() {
				alert( "error" );
		});
	}
}
function deleteEvent(team,event){
	if (confirm("Are you sure?")){
		$.ajax({
			url: "/teams/deleteEvent/" + event + '/'+ team,
			type:'POST'})
			.done(function( data ) {
				$('.js-Events').html(data);
			}) 
			.fail(function() {
				alert( "error" );
		});    					
	}
}
function markNotificationRead(notification){
	event.preventDefault();
	$.ajax({
		url: "/athlete/markNotificationRead/" + notification,
		type:'POST'})
		.done(function( data ) {
			$(".js-Notifications").html(data);
		}) 
		.fail(function() {
			alert( "error" );
	});    			
}
function attendEvent(eventId,user){
	event.preventDefault();
	$.ajax({
		url: "/event/attendEvent/" + eventId + '/' + user,
		type:'POST'})
		.done(function( data ) {
			$(".js-attending").html(data);
			alert("Attendance added!");
		}) 
		.fail(function() {
			alert( "error" );
	});    				
}
function removeAttendee(eventId,user){
	event.preventDefault();
	$.ajax({
		url: "/event/removeAttendee/" + eventId + '/' + user,
		type:'POST'})
		.done(function( data ) {
			$(".js-attending").html(data);
		}) 
		.fail(function() {
			alert( "error" );
	});    					
}
function getTeamWall($team){
	event.preventDefault();
	$.ajax({
		url: "/teams/getWall/" + team ,
		type:'POST'})
		.done(function( data ) {
			$(".js-teamWall").html(data);
		}) 
		.fail(function() {
			alert( "error" );
	});    		
}
function showInviteForm(){
	$('#inviteDialog').dialog({
	      modal: true
	    });
}
function sendInvites(eventId){
	event.preventDefault();
	data = $('#js-Invitations').serialize();
	$.ajax({
		url: "/event/sendInvites/" + eventId,
		data:data,		
		type:'POST'
		})
		.done(function( data ) {
			$('#inviteDialog').dialog("close");
			$("#inviteDialog").html(data);
		}) 
		.fail(function() {
			alert( "error" );
	});    		
}
function sendTeamInvites(teamId){
	event.preventDefault();
	data = $('#js-Invitations').serialize();
	$.ajax({
		url: "/teams/sendInvites/" + teamId,
		data:data,		
		type:'POST'
		})
		.done(function( data ) {
			$('#inviteDialog').dialog("close");
			$("#inviteDialog").html(data);
		}) 
		.fail(function() {
			alert( "error" );
	});    		
}
