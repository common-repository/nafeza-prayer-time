var media_uploader = null;

function open_media_uploader_image()
{
    media_uploader = wp.media({
        frame:    "post", 
        state:    "insert", 
        multiple: false
    });

    media_uploader.on("insert", function(){
        var json = media_uploader.state().get("selection").first().toJSON();

        var image_url = json.url;
        var image_caption = json.caption;
        var image_title = json.title;
        $("#nafeza_prayer_time_setting_notification_icon").val(image_url);
        $('#nafeza_prayer_time_icon_img').attr('src',image_url);
    });

    media_uploader.open();
}
$("#upload-icon").click(function (){
    open_media_uploader_image();
});
$("#delete-icon").click(function (){
    $("#nafeza_prayer_time_setting_notification_icon").val('');
    $('#nafeza_prayer_time_icon_img').attr('src','https://ps.w.org/nafeza-prayer-time/assets/icon-128x128.png');
});
