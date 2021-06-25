function redirect(clicked_id)
{
    var url = window.location.href.split('?')[0];
    var new_url = url + '?page=' + clicked_id;
    console.log(new_url);
    window.location.href = new_url;
}


function redirect_to_propertyedit(){
    var url = window.location.href.split('?')[0];
    url = url.slice(0,-10);
    console.log(url);
    var new_url = url + '/edit.php?post_type=property';
    console.log(new_url);
    window.location.href = new_url;
}