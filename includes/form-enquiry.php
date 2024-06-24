<div id="success_message" class="alert alert-success" style="display:none"></div>

<!-- Form for sending an enquiry about a car -->
<form id="enquiry">
<!-- Display the title of the car -->
    <h2>Send an enquiry about <?php the_title();?></h2>

<!-- Hidden input to store the car's registration value -->
<input type="hidden" name="registration" value="<?php the_field('registration');?>">


<!-- Form group for the first and last name -->
    <div class="form-group row">
    
            <div class="col-lg-6">
                    <input type="text" name="First Name" placeholder="First Name"  class="form-control" required>
            </div>
    
            <div class="col-lg-6">
                    <input type="text" name="lname" placeholder="Last Name" class="form-control" required>
            </div>
    
    </div>


<!-- Form group for the email and phone number -->
    <div class="form-group row">
    
            <div class="col-lg-6">
                    <input type="email" name="email" placeholder="Email Address"  class="form-control" required>
            </div>
    
            <div class="col-lg-6">
                    <input type="tel" name="phone" placeholder="Phone" class="form-control" required>
            </div>
    
    </div>


<!-- Form group for the enquiry message -->
    <div class="form-group">
    
            <textarea name="enquiry" class="form-control" placeholder="Your Enquiry" required></textarea>
    </div>


<!-- Submit button -->
    <div class="form-group">
           <button type="submit" class="btn btn-success btn-block">Send your enquiry</button>
    </div>

</form>


<!-- JavaScript to handle form submission using jQuery -->
<script>


(function($){
 // When the form is submitted

    $('#enquiry').submit( function(event){


        event.preventDefault();
        // Set the AJAX endpoint URL
        var endpoint = '<?php echo admin_url('admin-ajax.php');?>';
        // Serialize the form data
        var form = $('#enquiry').serialize();
        // Create a new FormData object
        var formdata = new FormData;
        // Append action, nonce, and form data to the FormData object
        formdata.append('action','enquiry');
        formdata.append('nonce', '<?php echo wp_create_nonce('ajax-nonce');?>');
        formdata.append('enquiry', form);

        
        // Perform the AJAX request
        $.ajax(endpoint, {

            type:'POST',
            data:formdata,
            processData: false,
            contentType: false,
  
            // On success
            success: function(res){

                    $('#enquiry').fadeOut(200);

                    $('#success_message').text('Thanks for your enquiry').show();

                    $('#enquiry').trigger('reset');

                    $('#enquiry').fadeIn(500);



            },

            // On error
            error: function(err)
            {
                // Display an error alert with the error message
                alert(err.responseJSON.data);

            }


        })

    })



})(jQuery)


</script>
