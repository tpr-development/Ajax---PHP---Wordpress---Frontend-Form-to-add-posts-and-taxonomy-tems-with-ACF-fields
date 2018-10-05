$(document).ready(function(){
  // Sidenav initialization
   $('.sidenav').sidenav({
     edge: 'right'
   });
   // Modal initialization
   $('.modal').modal();
   $('.js-example-basic-single').select2();
   // Select initialization
   $('select.singleSelect').formSelect();
   // Accordion initilization
   $('.collapsible').collapsible();


   // Ajax call for homepage filter
   $('.collapsible-body select').on('change', function(){
     const id = $(this).attr('id');

     let vertical = $('#selectVerticalFilter').val();
     let client = $('#selectClientFilter').val();
     let vendor = $('#selectVendorFilter').val();
     let status = $('#selectStatusFilter').val();
     console.log('Vertical: '+vertical+' Client: '+client+' Vendor: '+vendor+' Status: '+status);
     const url = 'http://purchase.the-practice.net/filter-posts.php';
     $.ajax({
       url: url,
       data: { 'vertical': vertical, 'client': client, 'vendor': vendor, 'status': status },
       type: 'POST',
       beforeSend:function(xhr){

       },
       error: function(err){
		     console.log(err.responseText);
 			 },
       success:function(data){
         $('.prList tbody').html(data);
         // console.log(data);
       }
     });
     return false;
   });
   // Repeater fields
   let q=1;
   $('#addNew').on('click', function(){
     let temp = '<div class="row orderDetails">'+
       '<div class="input-field col m6 s12">'+
         '<textarea id="description'+q+'" class="description materialize-textarea"></textarea>'+
         '<label for="description'+q+'">Description of Order</label>'+
       '</div>'+
       '<div class="input-field col m2 s12">'+
         '<input id="quantity'+q+'" type="text" class="quantity validate">'+
         '<label for="quantity'+q+'">Quantity</label><span class="helper-text" data-error="wrong" data-success="right">Only number</span>'+
       '</div>'+
       '<div class="input-field col m2 s12">'+
         '<input id="rate'+q+'" type="text" class="rate validate">'+
         '<label for="rate'+q+'">Rate</label><span class="helper-text" data-error="wrong" data-success="right">Only number</span>'+
       '</div>'+
       '<div class="input-field col m2 s12">'+
         '<input id="Total'+q+'" type="text" class="total validate">'+
         '<label for="Total'+q+'">Total</label><span class="helper-text" data-error="wrong" data-success="right">Only number</span>'+
       '</div>'+
     '</div>';
     q++;
     $('.orderDetails').last().after(temp);

   });
 });
 // Create a Post Form submit
 jQuery(function($){
   $('#postSubmit').submit(function(evt){
     evt.preventDefault();
     let form = $('#postSubmit');
     let url = form.attr('action');
     let title = $('#title').val();
     let content = $('#textarea1').val();
     let vendor = $('#vendor option:selected').val();
     let vertical = $('#vertical option:selected').val();
     let client = $('#client option:selected').val();
     let user = $('#user option:selected').val();
     let billable = $('#billType option:selected').val();
     let duration = $('#duration').val();
     let subject = 'New PR has been generated > ';
     let body = "<html><body><h3>"+title+"</h3><table width='100%' cellspacing='5'><tr><td style='padding:5px;'>Description</td><td style='padding:5px;'>"+content+"</td></tr><tr><td style='padding:5px;'>vendor</td><td style='padding:5px;'>"+vendor+"</td></tr>";
     // Order details repeater field
     var arrayOrderDescription = JSON.stringify( $('.description').map(function() { return this.value; }).get() );
     var arrayOrderQuantity = JSON.stringify( $('.quantity').map(function() { return this.value; }).get() );
     var arrayOrderRate = JSON.stringify( $('.rate').map(function() { return this.value; }).get() );
     var arrayOrderTotal = JSON.stringify( $('.total').map(function() { return this.value; }).get() );
     $.ajax({
       url: url,
       data: {'title': title, 'content': content, 'vendor': vendor, 'vertical': vertical, 'client': client, 'userID': user, 'billType': billable, 'duration': duration, 'orderDescription': arrayOrderDescription, 'orderQuantity': arrayOrderQuantity, 'orderRate': arrayOrderRate, 'orderTotal': arrayOrderTotal },
       type: 'POST',
       beforeSend:function(xhr){
         form.find('button').text('Processing...'); // changing the button label
       },
       error: function(err){
		     console.log(err.responseText);
 			 },
       success:function(data){
         form.find('button').text('Submit');
         form[0].reset();
         $('#newPRLink').attr('href', data);
         $('.successMessage').show();
         // Prepare email components
         subject = subject + title;
         body = body + "<tr><td style='padding:5px;'>To Approve click here</td><td style='padding:5px;'>"+data+"</td></tr></table></body></html>";
         // Call email function which is defined at the bottom of the file
         send_email(subject, body, user);
       }
     });
     return false;
   });
   // Create a vendor
   $('#vendorSubmit').submit(function(e){
     e.preventDefault();
     let url = $('#vendorSubmit').attr('action');
     let term_name = $('#term_name').val();
     let term_description = $('#textarea1').val();
     let bank_ac_name = $('#bank_ac_name').val();
     let bank_name = $('#bank_name').val();
     let ac_number = $('#ac_number').val();
     let ifsc = $('#ifsc').val();
     let vendor_email = $('#vendor_email').val();
     let vendor_mobile = $('#vendor_mobile').val();
     $.ajax({
       url: url,
       data: { 'term_name': term_name, 'term_description': term_description, 'bank_ac_name': bank_ac_name, 'bank_name': bank_name, 'ac_number': ac_number, 'ifsc': ifsc, 'vendor_email': vendor_email, 'vendor_mobile': vendor_mobile },
       type: 'POST',
       beforeSend:function(xhr){
         $('#vendorSubmit').find('button').text('Processing...'); // changing the button label
       },
       error: function(err){
		     console.log(err.responseText);
 			 },
       success:function(data){
         $('#vendorSubmit').find('button').text('Submit');
         $('#vendorSubmit')[0].reset();
         console.log(data);
       }
     });
     return false;
   });
 });



// Approve Form for Vertical Leads
$(document).on('submit','form#approveForm',function(evt1){
  evt1.preventDefault();
  let form1 = $('form#approveForm');
  let approve_url = form1.attr('action');
  let post_id = $('#post_id').val();
  let current_user = $('#current_user').val();
  let author_id = $('#author_id').val();
  let subject = 'New PR has been published and approved by '+current_user;
  let approve = '';
  if ( $( '#checkApprove' ).is( ":checked" ) ){
    approve = 'Approved';
  } else if($( '#checkDisApprove' ).is( ":checked" )){
    approve = 'Disapproved';
  }
  let receiverID = 4; // Finance head user id
  if(approve == 'Approved'){
    $.ajax({
      url: approve_url,
      data: { 'approve': 'Approved', 'post_id': post_id },
      type: 'POST',
      beforeSend:function(xhr){
        form1.find('button').text('Processing...'); // changing the button label
      },
      error: function(err){
        console.log(err.responseText);
      },
      success:function(data){
        form1.find('button').text('Update');
        $('#checkApprove').attr('disabled', 'disable');
        $('.approveSubmit').hide();
        $('.approveSuccessMessage').show();
        let body = "<html><body>To update the PR go to "+data+"</body></html>";
        // Call email function which has been define at the bottom of the page
        send_email(subject, body, receiverID);
      }
    });
  } else {
    $.ajax({
      url: 'http://purchase.the-practice.net/delete-post.php',
      data: { 'post_id': post_id },
      type: 'POST',
      beforeSend:function(xhr){
        form1.find('button').text('Processing...'); // changing the button label
      },
      error: function(err){
        console.log(err.responseText);
      },
      success:function(data){
        subject = 'Your PR has been disapproved by '+ current_user;
        body = 'The PR has been deleted. You have to generate the PR again';
        send_email(subject, body, author_id);
        window.location.replace("http://purchase.the-practice.net");
      }
    });
  }
});
// PO file upload function
let attachment_id = 0;
$(document).on('click', '#uploadFile', function(evt3){
  evt3.preventDefault();
  let poURL = 'http://purchase.the-practice.net/upload-po.php';
  let file = $('#sortpicture').prop('files')[0];
  let form_data = new FormData();
  form_data.append('file', file);
  $.ajax({
      url: poURL,
      type: 'post',
      contentType: false,
      processData: false,
      dataType: 'json',
      data: form_data, // { action: 'md_support_save', 'file': file, 'po_number': po_number, 'post_id': post_id},
      beforeSend: function(xhr){
        $('#uploadFile').text('Uploading..').attr('disabled', 'disable');
      },
      success: function (data) {
        attachment_id = data;
        console.log(attachment_id);
        $('#uploadFile').text('Uploaded');
      },
      error: function (err) {
        console.log(err.responseText);
      }
  });
});
// PO and Po number update function
$(document).on('submit','form#uploadPO',function(evt2){
  evt2.preventDefault();
  let form3 = $('form#uploadPO');
  let poURL = form3.attr('action');

  let po_number = $('#po_number').val();
  let post_id = $('#post_id_1').val();
  if(attachment_id == 0){
    $('#noEmpty').show();
  } else {
    $.ajax({
        url: poURL,
        type: 'post',
        data: { 'attachment_id': attachment_id, 'po_number': po_number, 'post_id': post_id },
        beforeSend: function(xhr){
          $('.uploadPOSubmit').find('button').text('Updating..').attr('disabled','disable');
        },
        success: function (data) {
          var poResult = $.parseJSON(data);
          $('.uploadPOSubmit').find('button').text('Update').removeAttr('disabled');
          $('#uploadFile').text('Upload').removeAttr('disabled');
          if($('.po_status').find('.poList').length !== 0){
            $('.poList tbody tr:last-of-type').after('<tr><td><a href="'+poResult[0]+'" target="_blank">'+poResult[0]+'</a></td><td>'+poResult[1]+'</td></tr>');
          } else {
            $('.po_status span.nill').hide();
            $('.po_status h5').after('<table><thead><tr><td>Purchase Order</td><td>Purchase Order Number</td></tr></thead><tbody><tr><td><a href="'+poResult[0]+'" target="_blank">'+poResult[0]+'</a></td><td>'+poResult[1]+'</td></tr></tbody></table>');
          }
          $('form#uploadPO')[0].reset();
        },
        error: function (err) {
          console.log(err.responseText);
        }

    });
  }
});
// Update payment section form
$(document).on('submit', 'form#paymentSubmit', function(evt4){
  evt4.preventDefault();
  let url = $('form#paymentSubmit').attr('action');
  let amount = $('#paidToVendor').val();
  let status = 'Open';
  let post_id = $('#post_id_2').val();
  if($('#status').is(':checked'))
    status = 'Closed';

  $.ajax({
      url: url,
      type: 'post',
      data: { 'amount': amount, 'status': status, 'post_id': post_id },
      success: function (data) {
        var result = $.parseJSON(data);
        if(result[1] == 'Closed'){ // If bill is closed show only table
          $('#paid-result').html('<table>\
          <thead>\
              <tr>\
                <td>Amount Paid to the Vendor</td>\
                <td>Bill Status</td>\
              </tr>\
            </thead>\
            <tbody>\
              <tr>\
                <td>'+result[0]+'</td>\
                <td>'+result[1]+'</td>\
              </tr>\
            </tbody>\
          </table>');
          $('#paymentSubmit').hide();
          $('#uploadPO').hide();
          let sub = 'Approved: "'+result[3]+'"';
          let body = 'The PR has been closed by the finance.'
          send_email(sub, body, result[2]);
          send_email(sub, body, result[4]);
        } else { // show
          $('#paid-result').html('<table>\
          <thead>\
              <tr>\
                <td>Amount Paid to the Vendor</td>\
                <td>Bill Status</td>\
              </tr>\
            </thead>\
            <tbody>\
              <tr>\
                <td>'+result[0]+'</td>\
                <td>'+result[1]+'</td>\
              </tr>\
            </tbody>\
          </table>');
        }

      },
      error: function (err) {
        console.log(err.responseText);
      }

  });

});
// Upload vendor bill
$(document).on('submit', 'form#uploadBill', function(evt6){
  evt6.preventDefault();
  let poURL = 'http://purchase.the-practice.net/upload-po.php';
  let file = $('#sortbill').prop('files')[0];
  let form_data = new FormData();
  let post_id = $('#post_id_5').val();
  form_data.append('file', file);
  $.ajax({
      url: poURL,
      type: 'post',
      contentType: false,
      processData: false,
      dataType: 'json',
      data: form_data, // { action: 'md_support_save', 'file': file, 'po_number': po_number, 'post_id': post_id},
      beforeSend: function(xhr){
        $('#uploadBillButton').text('Uploading..').attr('disabled', 'disable');
      },
      success: function (data) {
        attachment_id = data;
        $.ajax({
          url: 'http://purchase.the-practice.net/upload-bill.php',
          type: 'post',
          data: {'attachment_id': attachment_id, 'post_id': post_id},
          success: function(data2){
            $('#uploadBillButton').text('Uploaded');
            $('#uploadBill').hide();
            $('.vendor-bill h5').after('<div class="billResult"><table><tr><td>Vendor Bill</td><td><a href="'+data2+'" target="_blank">'+data2+'</a></td></tr></table></div>');
          },
          error: function(err1){
            console.log(err1.responseText);
          }
        });
      },
      error: function (err) {
        console.log(err.responseText);
      }
  });
});
// Send Email function
function send_email(subject, body, receiverID){
  $.ajax({
    url: 'http://purchase.the-practice.net/send-email.php',
    type: 'POST',
    data: {'subject': subject, 'body': body, 'receiverId': receiverID },
    error: function(err1){
      console.log(err1.responseText);
    },
    success: function(data){
      console.log(data);
    }
  });
}
