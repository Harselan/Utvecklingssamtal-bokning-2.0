$( document ).ready( function(){

    $(".drop-btn").click( function(){
        $(".nav").fadeToggle( 300 );
    } );
    $( window ).resize( function() {

        if ( $( document ).width() > 1031 )
        {
            $(".nav").css( "display", "block" );
        }
        else
        {
            $(".nav").css( "display", "none" );
        }

    } );

} );
