//...............................................................................
	// (function ( $ ) {
	// 	var arrglobal = [];
	// 	var x=0;

 // 		 $.fn.textpicker1 = function() {
 //          	var pos = this.position();

	// 		if($(".wrapper").length == 0)
 //    	{
 //    		 this.after('<div class="wrapper"></div>');
	// 		$(".wrapper").append('<input type="text" id="enter2">')
	// 		.append('<input type="button" id="done" value="done">');
 //    	}
 //    	else{
 //       		//alert(thistxtid);
 //    	}
	// 		var wid = this.outerWidth();
	// 		$(".wrapper").css('width',''+wid+'');

	// 		this.on("focus",function(){
	// 		$(".wrapper").css('background','grey');
	// 		$(".wrapper").css('display','block');
	// 		$(".wrapper").css('width',''+wid+'');
	// 		$("#enter2").css('width',''+wid+'');
	// 		$(".wrapper").css({top: pos.bottom, left: pos.left	});
	// 		});
	// 		arrglobal = this[0].id;
	// 		x++;
	// 		var thistxt = this;
	// 		$(document).mouseup(function (e)
	// 		{
	// 		    var container1 = $(thistxt);
	// 		    var container2 = $(".wrapper");
	// 		    var container3 = $("#enter2");

	// 		    if (!container1.is(e.target) && !container2.is(e.target) && !container3.is(e.target)) // ... nor a descendant of the container
	// 		    {
	// 				//$(".wrapper").attr('style', 'display:none');
	// 		    }
	// 		});
	// 		abc();
	// 		var tbox = this;
	// 		$("#done").on("click",function(){
	// 			var text1 = $("#enter2").val();
	// 			$(tbox).val(text1);
	// 			$(".wrapper").css('display','none');
	// 		});

 //    };

 //    function abc(){
 //    	//alert("abc");
 //    }


	// }( jQuery ));




//..................................................................................
var arrayglobal = [];
var z=0;
var focusglob = "";



(function ( $ ) {

 $.widget( "custom.textpicker2", {

    options: {
        color: "grey"
    },

    _create: function() {
    	var color = this.options.color;
    	var thiselement = this.element;
    	var thiselementid = thiselement[0].id;

    	arrayglobal[z] = thiselementid;
    	z++;
    	var pos = thiselement.position();

    	if($(".wrapper").length == 0)
    	{
    		this.element.after('<div class="wrapper" id="unique"></div>');
			$(".wrapper").append('<input type="text" id="enter2">')
			.append('<input type="button" id="done" value="done">');
    	}

		var wid = this.element.outerWidth();

		this.element.on("focus",function(){
		$(".wrapper").css('background',''+color+'');
		$(".wrapper").css('display','block');
		$(".wrapper").css('width',''+wid+'');
		$(".wrapper").css({top: pos.bottom, left: pos.left	});
		$("#enter2").css('width',''+wid+'');
		 focusglob = thiselement;
		});
	},

  	color: function( value ) {
 		alert("colr")
        if ( value === undefined ) {
            return this.options.value;
        }
        var color = this.options.value ;
        colsole.log(color);

        $(".wrapper").css('background',''+this.options.color+'');
    },
 });


	$(document).on("click","#done",function(){

		var text1 = $("#enter2").val();


		focusglob.val(text1);

		$("#enter2").val("");
		// $(".wrapper").css('display','none');
	});


 	$(document).mouseup(function (e)
	{
		var container1 = $(".wrapper");
		var container2 = $("#enter2");
		var count = true;
		for(var i=0;i<arrayglobal.length;i++)
		{
			if($("#"+arrayglobal[i]).is(e.target))
			{
				count=false;
			}
		}
		if (count && !container1.is(e.target) && !container2.is(e.target) )
		    {
				$(".wrapper").attr('style', 'display:none');
		    }

	});

}( jQuery ));



//...........................................................................................
  // $( function() {
  //   // the widget definition, where "custom" is the namespace,
  //   // "colorize" the widget name
  //   $.widget( "custom.colorize", {
  //     // default options
  //     options: {
  //       red: 255,
  //       green: 0,
  //       blue: 0,

  //       // Callbacks
  //       change: null,
  //       random: null
  //     },

  //     // The constructor
  //     _create: function() {
  //       this.element
  //         // add a class for theming
  //         .addClass( "custom-colorize" );

  //       this.changer = $( "<button>", {
  //         text: "change",
  //         "class": "custom-colorize-changer"
  //       })
  //       .appendTo( this.element )
  //       .button();

  //       // Bind click events on the changer button to the random method
  //       this._on( this.changer, {
  //         // _on won't call random when widget is disabled
  //         click: "random"
  //       });
  //       this._refresh();
  //     },

  //     // Called when created, and later when changing options
  //     _refresh: function() {
  //       this.element.css( "background-color", "rgb(" +
  //         this.options.red +"," +
  //         this.options.green + "," +
  //         this.options.blue + ")"
  //       );

  //       // Trigger a callback/event
  //       this._trigger( "change" );
  //     },

  //     // A public method to change the color to a random value
  //     // can be called directly via .colorize( "random" )
  //     random: function( event ) {
  //       var colors = {
  //         red: Math.floor( Math.random() * 256 ),
  //         green: Math.floor( Math.random() * 256 ),
  //         blue: Math.floor( Math.random() * 256 )
  //       };

  //       // Trigger an event, check if it's canceled
  //       if ( this._trigger( "random", event, colors ) !== false ) {
  //         this.option( colors );
  //       }
  //     },

  //     // Events bound via _on are removed automatically
  //     // revert other modifications here
  //     _destroy: function() {
  //       // remove generated elements
  //       this.changer.remove();

  //       this.element
  //         .removeClass( "custom-colorize" )
  //         .enableSelection()
  //         .css( "background-color", "transparent" );
  //     },

  //     // _setOptions is called with a hash of all options that are changing
  //     // always refresh when changing options
  //     _setOptions: function() {
  //       // _super and _superApply handle keeping the right this-context
  //       this._superApply( arguments );
  //       this._refresh();
  //     },

  //     // _setOption is called for each individual option that is changing
  //     _setOption: function( key, value ) {
  //       // prevent invalid color values
  //       if ( /red|green|blue/.test(key) && (value < 0 || value > 255) ) {
  //         return;
  //       }
  //       this._super( key, value );
  //     }
  //   });

  //   // Initialize with default options
  //   $( "#my-widget1" ).colorize();

  //   // Initialize with two customized options
  //   $( "#my-widget2" ).colorize({
  //     red: 60,
  //     blue: 60
  //   });

  //   // Initialize with custom green value
  //   // and a random callback to allow only colors with enough green
  //   $( "#my-widget3" ).colorize( {
  //     green: 128,
  //     random: function( event, ui ) {
  //       return ui.green > 128;
  //     }
  //   });

  //   // Click to toggle enabled/disabled
  //   $( "#disable" ).on( "click", function() {
  //     // use the custom selector created for each widget to find all instances
  //     // all instances are toggled together, so we can check the state from the first
  //     if ( $( ":custom-colorize" ).colorize( "option", "disabled" ) ) {
  //       $( ":custom-colorize" ).colorize( "enable" );
  //     } else {
  //       $( ":custom-colorize" ).colorize( "disable" );
  //     }
  //   });

  //   // Click to set options after initialization
  //   $( "#green" ).on( "click", function() {
  //     $( ":custom-colorize" ).colorize( "option", {
  //       red: 64,
  //       green: 250,
  //       blue: 8
  //     });
  //   });
  // } );
