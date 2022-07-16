$(document).ready(function() {
    
    $("#target").click(function(e) {
        let menu_items = $(".menu-container > .menu-item").length;
        let left = 0;
        if($(".menu-container > .menu-item:nth-child(2)").css("left") == "0px") {
            for(let i = 2; i <= menu_items + 1; i++) {
                left += $("#target").width() + 5;
                $(`.menu-container > .menu-item:nth-child(${i})`).animate({
                    "left":left + "px"
                });
            }
        } else {
            for(let i = menu_items + 1; i > 0; i--) {
                left = 0;
                $(`.menu-container > .menu-item:nth-child(${i})`).animate({
                    "left":left + "px"
                });
            }
        }
        console.clear();
        console.log(e.target);
    });
    
    
});