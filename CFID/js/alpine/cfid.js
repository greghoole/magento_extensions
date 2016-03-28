var CFID = {
    init: function(){
      if($('cfid-login')){
        Event.observe('cfid-login','click',function(){
          var url = CFID.loginUrl;
          url = url + '?client_id=' + CFID.clientId;
          url = url + '&response_type=code';
          url = url + '&redirect_uri=' + CFID.redirectUrl;
          url = url + '&state=login_request';
          window.open(url,'CFID','width=500,height=500');
        });
      }
      $$('a').each(function(item){
        var href = item.readAttribute('href');
        if(href.indexOf('customer/account/edit') != -1){
          Event.observe(item,'click',function(event){
            Event.stop(event);
            var url = CFID.accountUrl;
            if(url != ''){
              window.open(url,'CFID','width=500,height=500');
            }
          });
        }
      });
    },
    clientId: '',
    baseUrl: '',
    loginUrl: '',
    redirectUrl: '',
    accountUrl: ''
};

Event.observe(window,'load',function(){
  CFID.init();
});