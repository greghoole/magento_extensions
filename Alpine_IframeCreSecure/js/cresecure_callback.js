// CRE Callback Functions
function completeCREPayment( param )
{ 
  alert(param);
  var checkoutType = $('checkoutType').getValue();
  switch(checkoutType){
	case '1':
	  review.save();
	  break;
	case '2':
      document.forms["review"].submit();
      break;
    case '3':
    default:
      break;
  }
}

function cancelCREPayment()
{
  location.href = '/checkout/cart/'; 
}

function startCREPayment()
{
  var mask = new Element('div',{id:'mask'});
  mask.addClassName('mask');
  $(document.body).insert({'top':mask});

  var image_container = new Element('div',{id:'mask_image_container'});
  image_container.addClassName('mask_image_container');
  $('mask').insert({'top':image_container});

  var loading_container = new Element('div',{id:'loading_container'});
  var loading_image = new Element('img',{id:'loading_image',src:'/skin/frontend/default/default/images/opc-ajax-loader.gif'});
  var loading_text = new Element('p',{id:'loading_p'});
  loading_text.addClassName('mask_loading_text');
  loading_text.update('Processing payment...');

  $('mask_image_container').insert({'top':loading_container});
  $('loading_container').insert({'top':loading_text});      
  $('loading_p').insert({'top':loading_image});
}

function whatCVV2()
{
  $('cvv_info').setStyle({display:'block'});
  setTimeout('hideCVV2()',5000);
}

function hideCVV2()
{
  $('cvv_info').setStyle({display:'none'});
}

function creHandleDetailErrors( errorCode, gatewayCode, gatewayMessage )
{    
  var cre_messages = new Array();
  cre_messages[100] = 'Merchant Identifier was not present or not valid.';
  cre_messages[110] = 'Session Identifier was not present.';
  cre_messages[200] = 'The name field was blank.';
  cre_messages[500] = 'The address one field was required but left blank.';
  cre_messages[510] = 'The city field was required but left blank.';
  cre_messages[520] = 'The state field was required but left blank.';
  cre_messages[530] = 'The zip field was required but left blank.';
  cre_messages[540] = '';
  cre_messages[300] = 'The amount was not specified or an invalid value was entered.';
  cre_messages[310] = 'The credit card number was missing or invalid.';
  cre_messages[320] = 'No credit card type was entered.';
  cre_messages[330] = 'The expiration month was blank.';
  cre_messages[340] = 'The expiration year was blank.';
  cre_messages[350] = 'The CVV2 field was submitted, but the value does not match the card.';
  cre_messages[360] = 'The card was declined by the processor.';
  cre_messages[370] = 'The expiration date is invalid.';
  cre_messages[400] = 'The tracer value does not match.';

  CreSecure.clearErrors();
  
  var errorMessage = '<ul class="messages" id="cresecure_errors"><li class="error-msg"><ul>';

  var errorCodes = errorCode.split('|');
  
  errorCodes.each(function(e){
    if(e != ''){
      if(cre_messages[e] != ''){
        errorMessage += '<li>' + cre_messages[e] + '</li>';
      }
      else {
    	errorMessage += '<li>An error has occurred</li>';
      }
    }
  });
  errorMessage += '</ul></li></ul>';
  Element.insert($('crePaymentFrame_holder'),{top:errorMessage});

  $('mask').remove();
}