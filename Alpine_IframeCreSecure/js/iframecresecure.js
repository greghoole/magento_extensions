CreSecure = {
  init: function(checkoutType,orderAmount) {
	
	CreSecure.cresecureApiUrl = $('cresecureApiUrl').value;
	CreSecure.cresecureApiKey = $('cresecureApiKey').value;
	CreSecure.sessionId = $('cresecureid').value; 
	
    var optionalZipcodes = $('optionalZipcodes').value;
    CreSecure.optionalZipcodes = optionalZipcodes.split(',');
    CreSecure.checkoutType = checkoutType;
    CreSecure.orderAmount = orderAmount;
    // CreSecure.getUpdatedAmount();

    // hide checkout button
    var buttons = $$('button.btn-checkout');
    buttons.each(function(elem){
      elem.hide();
    });

  },
  cresecureApiUrl: '',
  cresecureApiKey: '',
  sessionId: '',
  optionalZipcodes: null,
  checkoutType: null,
  orderAmount: 0,
  loadIFrame: function() {
	
    var doLoad = false;

    var collectAddress = 1;
    var stateRequired = false;
    var zipRequired = true;
    var ship_stateRequired = false;
    var ship_zipRequired = true;

    var firstname = $('billing:firstname').value;
    var lastname = $('billing:lastname').value;
    var address = $('billing:street1').value;
    var address2 = $('billing:street2').value;
    var city = $('billing:city').value;
    var country_id = $('billing:country_id').value;
    var state = null;
    if(countryRegions[country_id] == undefined){
      state = $('billing:region').value;
    }
    else {
      state = $('billing:region_id').value;
      stateRequired = true;
    }
    var zip = $('billing:postcode').value;
    if(CreSecure.optionalZipcodes.indexOf(country_id) != -1){
      zipRequired = false;
    }

    if(firstname != '' && lastname != '' && address != '' && city != '' && country_id != '' && $('crePaymentFrame_holder')){
      if(stateRequired && (state == null || state == '')){
        doLoad = false;
      }
      else if(zipRequired && (zip == null || zip == '')){
        doLoad = false;
      }
      else {
	    if($('billing:email') != undefined){
          if(CreSecure.validateEmail($('billing:email').value) && $('billing:telephone').value != ''){
            doLoad = true;
            CreSecure.clearErrors();
          }
        }
        else {  // user logged in - field not available
          doLoad = true;
        }
      }
    }

    if(!$('billing:use_for_shipping_yes').checked && doLoad){
      doLoad = false;

      // need to confirm we have shipping data too
      var ship_firstname = $('shipping:firstname').value;
      var ship_lastname = $('shipping:lastname').value;
      var ship_address = $('shipping:street1').value;
      var ship_address2 = $('shipping:street2').value;
      var ship_city = $('shipping:city').value;
      var ship_country_id = $('shipping:country_id').value;
      var ship_state = null;
      if(countryRegions[ship_country_id] == undefined){
        ship_state = $('shipping:region').value;
      }
      else {
        ship_state = $('shipping:region_id').value;
        ship_stateRequired = true;
      }
      var ship_zip = $('shipping:postcode').value;
      if(CreSecure.optionalZipcodes.indexOf(ship_country_id) != -1){
        ship_zipRequired = false;
      }

      // validate
      if(ship_firstname != '' && ship_lastname != '' && ship_address != '' && ship_city != '' && ship_country_id != '' && $('crePaymentFrame_holder')){
        if(ship_stateRequired && (ship_state == null || ship_state == '')){
          doLoad = false;
        }
        else if(ship_zipRequired && (ship_zip == null || ship_zip == '')){
          doLoad = false;
        }
        else {
          if($('shipping:telephone').value != ''){
            doLoad = true;
            CreSecure.clearErrors();
          }
        }
      }
    }

    if(doLoad){
      var selectedState = null;
      var username = $('billing:firstname').value + ' ' + $('billing:lastname').value;

      if(countryRegions[country_id] == undefined){
        selectedState = $('billing:region').value;
      }
      else if(state != '') {
        selectedState = countryRegions[country_id][escape(state)]['code'];
      }

      if(country_id != 'US'){
        collectAddress = 2;
      }

      var iframeURL = CreSecure.cresecureApiUrl + "?name=" + escape(username) + 
        "&action=buildForm" + 
        "&merchPass=" + CreSecure.cresecureApiKey +
        "&allowed_types=Visa%7CMasterCard%7CAmerican Express%7CDiscover" +
        "&sessionId=" + CreSecure.sessionId + 
        "&amount=" + escape(CreSecure.orderAmount) + 
        "&formType=1" + 
        "&collectAddress=" + collectAddress +
        "&city=" + escape(city) + 
        "&state=" + selectedState + 
        "&province=" + selectedState +
        "&address=" + escape(address) + 
        "&address2=" + escape(address2) + 
        "&zip=" + escape(zip) + 
        "&postal_code=" + escape(zip) + 
        "&country=" + escape(country_id) + 
        "&callback_url=" + $('baseUrl').value + "skin/frontend/base/default/js/callback.html.php";

      var iframeHtml = '<iframe src="' + iframeURL + '" frameborder="0" style="width:400px; height:400px; border:0;">Loading...</iframe>';
      //$('payment_form_iframecresecure').show();
      $('crePaymentFrame_holder').update(iframeHtml);

      // CreSecure.setShipMethodObservers();
    }
    else if($('crePaymentFrame_holder')){
      //$('payment_form_iframecresecure').show();
      if(!$('billing:use_for_shipping_yes').checked){
        $('crePaymentFrame_holder').update('<p>Please complete your billing and shipping information</p>');
      }
      else {
        $('crePaymentFrame_holder').update('<p>Please complete your billing information</p>');
      }
    }
  },
  loadIFrameMultipleAddress: function() {
	
    var creData = $('cresecure_data').value;
    this.creSecureData = creData.evalJSON(true);

    var doLoad = false;

    var collectAddress = 1;

    doLoad = true;

    if(doLoad){

      if(this.creSecureData.country != 'US'){
        collectAddress = 2;
      }

	  var iframeURL = CreSecure.cresecureApiUrl + "?name=" + escape(this.creSecureData.name) + 
        "&action=buildForm" + 
        "&merchPass=" + CreSecure.cresecureApiKey +
        "&allowed_types=Visa%7CMasterCard%7CAmerican Express%7CDiscover" +
        "&sessionId=" + CreSecure.sessionId + 
        "&amount=" + escape(CreSecure.orderAmount) + 
        "&formType=1" + 
        "&collectAddress=" + collectAddress +
        "&city=" + escape(this.creSecureData.city) + 
        "&state=" + this.creSecureData.region + 
        "&province=" + this.creSecureData.region +
        "&address=" + escape(this.creSecureData.street1) + 
        "&address2=" + escape(this.creSecureData.street2) + 
        "&zip=" + escape(this.creSecureData.postal_code) + 
        "&postal_code=" + escape(this.creSecureData.postal_code) + 
        "&country=" + escape(this.creSecureData.country) + 
        "&callback_url=" + $('baseUrl').value + "skin/frontend/base/default/js/callback.html.php";

      var iframeHtml = '<iframe src="' + iframeURL + '" frameborder="0" style="width:400px; height:400px; border:0;">Loading...</iframe>';
      $('crePaymentFrame_holder').update(iframeHtml);
    }
    else if($('crePaymentFrame_holder')){
      $('crePaymentFrame_holder').update('<p>Please complete your billing information</p>');
    }
  },
  checkZipRequirement: function()
  {
    var country_id = $('billing:country_id').value;

    if(CreSecure.optionalZipcodes.indexOf(country_id) != -1){
      jQuery('label[for="billing:postcode"]').html('Zip Code');
    }    
    else {
      jQuery('label[for="billing:postcode"]').html('Zip Code <span class="required">*</span>');
    }
  },
  getUpdatedAmount: function()
  {
    var url = $('baseUrl').value + 'iframecresecure/ajax/amount/';
    new Ajax.Request(url, {
      method: 'GET',
      onComplete: function(transport) {
        if(transport.status == 200) {
          var result = transport.responseText.evalJSON();
          if(result.success) {
            CreSecure.orderAmount = result.amount;
            // loadIFrame();
          }
        }
      }
    });
  },
  clearErrors: function() {
    if($('cresecure_errors') != undefined){
      Element.remove('cresecure_errors');
    }
  },
  validateEmail: function(email) 
  { 
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    var result = email.match(re);
    if(!result){
      CreSecure.clearErrors();

      var errorMessage = '<ul class="messages" id="cresecure_errors"><li class="error-msg"><ul>';
      errorMessage += '<li>Please enter a valid email address</li>';
      errorMessage += '</ul></li></ul>';

      Element.insert($('crePaymentFrame_holder'),{top:errorMessage});
      return false;
    }
    return true; 
  }
};