$(document).ready(function(){
  // Sidenav initialization
   $('.sidenav').sidenav({
     edge: 'right'
   });
   // Modal initialization
   $('.modal').modal();
   // Select initialization
   $('select').formSelect();
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
     let ac_number = $('#ac_number').val();
     let ifsc = $('#ifsc').val();
     let vendor_email = $('#vendor_email').val();
     let vendor_mobile = $('#vendor_mobile').val();
     $.ajax({
       url: url,
       data: { 'term_name': term_name, 'term_description': term_description, 'bank_ac_name': bank_ac_name, 'ac_number': ac_number, 'ifsc': ifsc, 'vendor_email': vendor_email, 'vendor_mobile': vendor_mobile },
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
      $('.approveStatus').after('<div class="successMessage">Thank you for approving. Email has been sent to <a href="" id="newPRLink">Finance Team</a></div>');
    }
  });
});
// PO file upload function
$(document).on('submit','form#uploadPO',function(evt2){
  evt2.preventDefault();
  let form3 = $('form#uploadPO');
  let poURL = form3.attr('action');
  let file = $('#sortpicture').prop('files')[0];
  let po_number = $('#po_number').val();
  let post_id = $('#post_id_').val();

  $.ajax({
      url: poURL,
      type: 'post',
      contentType: false,
      processData: false,
      data: { action: 'md_support_save', 'file': file, 'po_number': po_number, 'post_id': post_id},
      success: function (data) {
          console.log(data);
      },
      error: function (err) {
       console.log(err.responseText);
      }

  });
});
