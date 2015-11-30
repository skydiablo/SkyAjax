/*

 RequestObject = {
    url:"",
    type:"POST|GET|...",
    data:*,
    ajaxSettings:{}
 }

 ResponseObjectPackage = {
    c: [ //Array of ResponseObject's
        {
            i:"identity", //the Responsehandler to be invoked
            d:"data" // will passed as second parameter to 'i'
        }
    ]
}

 */


function is_array(variable) { 
    return typeof(variable) == "object" && (variable instanceof Array);
}

function function_exists(fName, pObj) {
    if(!pObj) pObj = window;
    return (typeof pObj[fName] == 'function') ? true : false;
}

SkyAjaxRequestObject = function(){
    this.url = "";
    this.type = "POST";
    this.data = [],
    this.ajaxSettings = {}
}

SkyAjax = {
    
    storage : {
        responseHandler: {
            Alert : function(text) {
                alert(text);        
            },
    
            Eval : function(src) {
                eval(src);
            },
    
            Assign : function(data) {
                jQuery(data.query).html(data.value);
            },
            
            Redirect : function(uri) {
                window.location = uri;
            }
            
        },
        requestHandler : {
            sendForm : function(selector){
                SkyAjax.storage.requestHandler.post(
                    jQuery(selector).attr("action"),
                    jQuery(selector).serializeArray(),
                    jQuery(selector).attr("methode")
                    );
            },

            getURL : function(selector){
                SkyAjax.storage.requestHandler.get(jQuery(selector).attr("href"));
            },
            
            /**
             * sendet daten und entscheidet selbst ob per GET oder POST
             * uri : URL an welche gesendet werden soll
             * parameter : optional, parameter für ein POST
             * methode : optional, kann mittels POST ein post erzwungen werden auch ohne parameter
             */
            send : function(uri, parameter, methode) {
                if(parameter || methode == 'POST') {
                    SkyAjax.storage.requestHandler.post(uri, parameter, methode);
                } else {
                    SkyAjax.storage.requestHandler.get(uri);
                }
            },
            
            /**
             * uri : post URL
             * parameter : array/object von parametern
             * methode : optional, um den POST per GET durchzuführen
             */
            post : function(uri, parameter, methode) {
                var RequestObject = new SkyAjaxRequestObject();
                RequestObject.url = uri;
                RequestObject.type = methode ? methode : 'POST';
                RequestObject.data = parameter;
                SkyAjax.invokeRequest(RequestObject);
            },
            
            /**
             * uri : URL die aufgerufen werden soll
             */
            get : function(uri){
                var RequestObject = new SkyAjaxRequestObject();
                RequestObject.url = uri;
                RequestObject.type = "GET";
                SkyAjax.invokeRequest(RequestObject);
            }
        }
    },

    invokeRequest : function(requestObject){
        if(function_exists('onSend',SkyAjax.events)) {
            SkyAjax.events.onSend(requestObject);
        }
        
        
        var ajaxSettings = requestObject.ajaxSettings;

        ajaxSettings.url = requestObject.url;
        ajaxSettings.type = requestObject.type;
        ajaxSettings.data = requestObject.data;
        ajaxSettings.success = function(data, textStatus, jqXHR){

            SkyAjax.events.XHRResponse(data);
            
            if(function_exists('onReceive',SkyAjax.events)) {
                SkyAjax.events.onReceive(data);
            }
        }
        ajaxSettings.dataType = "json";

        jQuery.ajax(ajaxSettings);
    },
    events : {
        XHRResponse: function(responseObjectPackage){
            if(is_array(responseObjectPackage.c)){
                for(var i = 0; i < responseObjectPackage.c.length; i++){
                    SkyAjax.invokeResponseHandler(responseObjectPackage.c[i]);
                }
            }
        },
        
        onSend: null,
        onReceive: null
    },

    hasResponseHandler : function(identifier){
        return (SkyAjax.storage.responseHandler.hasOwnProperty(identifier));
    },

    addResponseHandler : function(identifier, responseHandler){
        this.storage.responseHandler[identifier] = responseHandler;
    },

    getResponseHandler : function(identifier){
        if(this.hasResponseHandler(identifier)){
            return SkyAjax.storage.responseHandler[identifier];
        } else {
            return false;
        }
    },

    removeResponseHandler : function(identifier){
        if(this.hasResponseHandler(identifier)){
            delete SkyAjax.storage.responseHandler[identifier];
        }
    },

    invokeResponseHandler : function(responseObject){
        var responseHandler = SkyAjax.getResponseHandler(responseObject.i);
        if(responseHandler != false){
            return responseHandler(responseObject.d);
        }
        return false;
    }

}
