// Check web browser type
function checkWebBrowserType() {
    
    // Opera 8.0+
    var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
    
    // Firefox 1.0+
    var isFirefox = typeof InstallTrigger !== 'undefined';
    
    // Safari 3.0+ "[object HTMLElementConstructor]" 
    var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { 
            return p.toString() === "[object SafariRemoteNotification]"; 
        })(!window['safari'] || safari.pushNotification);
        
    // Internet Explorer 6-11
    var isIE = /*@cc_on!@*/false || !!document.documentMode;
    
    // Edge 20+
    var isEdge = !isIE && !!window.StyleMedia;
    
    // Chrome 1 - 71
    var isChrome = !!window.chrome && (!!window.chrome.webstore || !!window.chrome.runtime);
    
    // Blink engine detection
    var isBlink = (isChrome || isOpera) && !!window.CSS;
    
    // Detect web browser
    var output;
    if (isOpera === true) {
        output = 'isOpera';
    } else if (isFirefox === true) {
            output = 'isFirefox';
        } else if (isSafari === true) {
                output = 'isSafari';
            } else if (isIE === true) {
                    output = 'isIE';
                } else if (isEdge === true) {
                        output = 'isEdge';
                    } else if (isChrome === true) {
                            output = 'isChrome';
                        } else if (isBlink === true) {
                                output = 'isBlink';
                            };
    
    // Disabling the website for IE because of misspropper elemnts display
    if (output === 'isIE') {
        var message = "Sorry, IE is not supported! Instead, you may use  Microsoft Edge, Google Chrome, Opera or Firefox.";
        document.body.innerHTML = message;
    };          
};

// Get the total height
function getTotalVerticalMargin(elemId) {
    
    var elem = document.getElementById(elemId);
    
    var elemMarginTop = window.getComputedStyle(elem, null).getPropertyValue("margin-top");    
    elemMarginTop = Number(elemMarginTop.replace(/px/gi, ""));     
    
    var elemMarginBottom = window.getComputedStyle(elem, null).getPropertyValue("margin-bottom");    
    elemMarginBottom = Number(elemMarginBottom.replace(/px/gi, ""));    
    
    var totalElemVerticalMargin = elemMarginTop + elemMarginBottom;
    console.log("totalElemVerticalMargin for " + elemId + ": " + totalElemVerticalMargin);
    
    return totalElemVerticalMargin;
};

// Automaticaly calculate and set the body height in a wat to cover all the browser view
function setBodyHeight() {   
    
    var body = document.body,
    html = document.documentElement;

    var bodyHeight = Math.min( body.scrollHeight, body.offsetHeight, 
                       html.clientHeight, html.scrollHeight, html.offsetHeight );    
    
    var windowHeight = window.innerHeight;        
    
    var headerHeight = document.getElementById("header").offsetHeight;    
    
    var navigationHeight = document.getElementById("navigation").offsetHeight;    
    
    var footerHeight = document.getElementById("footer").offsetHeight;      
    
    var minWrapperHeight = windowHeight 
            - (headerHeight + getTotalVerticalMargin("header"))
            - (navigationHeight + getTotalVerticalMargin("navigation"))
            - (footerHeight + getTotalVerticalMargin("footer"));    
    
    if (bodyHeight < windowHeight) {
        document.getElementById("wrapper").style.height = minWrapperHeight + "px";
    };
};

// Call php code to get and show the files in folders
function listAllDocuments(screen, sessionName) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            // To disable animation when page number changed disable next row
            $("#pageHolder").css('display', 'none');
            document.getElementById("pageHolder").innerHTML = xmlhttp.responseText; 
            // To disable animation when page number changed disable next row
            $("#pageHolder").fadeIn(300);            
        };
    };
    
    xmlhttp.open("GET", "subPageGenerator_2.php?" + sessionName + "=" + screen, true);
    xmlhttp.send();
};