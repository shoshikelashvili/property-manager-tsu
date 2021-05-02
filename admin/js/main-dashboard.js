function redirect(clicked_id)
{
    var url = window.location.href.split('?')[0];
    var new_url = url + '?page=' + clicked_id;
    console.log(new_url);
    window.location.href = new_url;
}