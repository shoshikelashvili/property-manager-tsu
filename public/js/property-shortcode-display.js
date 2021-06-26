function redirect()
{
    // var url = window.location.href.split('?')[0];
    // var new_url = url + '?page=' + clicked_id;
    var url_string = window.location.href;
    var url = new URL(url_string);
    var page = url.searchParams.get("property_page");
    if(page == null)
    {
        var new_url = window.location.href + '?property_page=2';
        console.log(new_url);
        window.location.href = new_url;
    }
    else{
        var new_page = Number(page) + 1;
        var new_url = window.location.href.split('?')[0];
        var new_url = new_url + '?property_page=' + new_page;
        console.log(new_url);
        window.location.href = new_url;
    }
}