jQuery(document).ready(function() {

    document.getElementById('pro-image').addEventListener('change', readImage, false);
    
    jQuery( ".preview-images-zone" ).sortable();
    
    jQuery(document).on('click', '.image-cancel', function() {
        console.log('test image cancel');
        let no = jQuery(this).data('no');
        console.log('number is', no)
        jQuery(".preview-image.preview-show-"+no).remove();

        //Remove values from input when images get deleted
        var hidden = document.getElementById('image-hidden-field');
        var currentObj = JSON.parse(hidden.getAttribute('value'));

        console.log('current object before removal', currentObj);
        currentObj = currentObj.filter(function( obj ) {
            return parseInt(obj.num) !== parseInt(no);
        })
        hidden.setAttribute('value', JSON.stringify(currentObj))
        var testObj = JSON.parse(hidden.getAttribute('value'));
        console.log('new image attributes', testObj);
    });
});

function toDataUrl(url, callback) {
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        var reader = new FileReader();
        reader.onloadend = function() {
            callback(reader.result);
        }
        reader.readAsDataURL(xhr.response);
    };
    xhr.open('GET', url);
    xhr.responseType = 'blob';
    xhr.send();
}

jQuery(window).ready(function() {
    console.log('window ready');
    var hidden = document.getElementById('image-hidden-field');
    
    jQuery( ".existing-image" ).each(function( index, element ) {
        toDataUrl(element.getAttribute('src'), function(myBase64) {
            var currentObj = JSON.parse(hidden.getAttribute('value'));
            // console.log(myBase64.split(',')[1]); // myBase64 is the base64 string
            myBase64 = myBase64.split(',')[1];
            if(currentObj == null)
            {
                hidden.setAttribute('value', JSON.stringify([{base64: myBase64, title: 'title', num: element.getAttribute('data-unique'), custom_image: 1}]))
            }
            else{
                var obj = {base64: myBase64, title:'title', num: element.getAttribute('data-unique'), custom_image: 1};
                currentObj.push(obj);
                hidden.setAttribute('value', JSON.stringify(currentObj))
            }
        });
        });
});


var num = 4;
function readImage() {
    if (window.File && window.FileList && window.FileReader) {
        var hidden = document.getElementById('image-hidden-field');
        var files = event.target.files; //FileList object
        var output = jQuery(".preview-images-zone");

        for (let i = 0; i < files.length; i++) {
            var file = files[i];
            if (!file.type.match('image')) continue;
            
            var picReader = new FileReader();
            
            picReader.addEventListener('load', function (event) {
                var picFile = event.target;
                console.log('file data',file);
                var html =  '<div class="preview-image preview-show-' + num + '">' +
                            '<div class="image-cancel" data-no="' + num + '">x</div>' +
                            '<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result + '"></div>' +
                            '</div>';

                output.append(html);
                num = num + 1;

                var currentObj = JSON.parse(hidden.getAttribute('value'));
                

                //If current data is empty fill it manually
                if(currentObj == null)
                {
                    var base64parsed = picFile.result.split(',')[1];
                    hidden.setAttribute('value', JSON.stringify([{base64: base64parsed, title: file.name, num: num-1, custom_image: 1}]))
                }
                else{
                    var base64parsed = picFile.result.split(',')[1];
                    var obj = {base64: base64parsed, title:file.name, num: num-1, custom_image: 1};
                    currentObj.push(obj);
                    hidden.setAttribute('value', JSON.stringify(currentObj))
                }
                
                console.log('currentObj is', currentObj);
                // hidden.setAttribute('value', JSON.stringify())

                //Remove placeholder after first upload
                jQuery("[class='preview-image preview-show-1 placeholder ui-sortable-handle']").hide();
                console.log('picFile',picFile);

            });
            picReader.readAsDataURL(file);

        }
        jQuery("#pro-image").val('');
    } else {
        console.log('Browser not support');
    }
}

