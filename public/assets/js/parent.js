let globalContainer = {};
globalContainer.isLoggedOut = false;
globalContainer.ajaxUrlPrefix = '../src/ajax';
globalContainer.jQueryToolsUrl = globalContainer.ajaxUrlPrefix + '/jQueryTools.php';

$.ajaxSetup({
    url: globalContainer.jQueryToolsUrl,
    method: 'POST',
    dataType: 'json',
    contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
});