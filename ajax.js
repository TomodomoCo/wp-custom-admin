
    $.ajax({

          type: "POST",

          url: "<?php echo home_url(); ?>/endorse-counter/",

          data: { do: "count" }

        })

          .done(function( text ) {

            count = text;

            $('.count').html(count);

          }

          );

          