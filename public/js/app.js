(function() {
    if (localStorage['api_token']) {
        var token = localStorage['api_token'];
        $.ajax({
            url: '/api/user?no_redirect=true',
            data: { api_token: token },
            success: function(data) {
                if(data.status == false) {
                    $('#navbar-user').attr('href','/login?current_link='+window.location.pathname)
                    return;
                };
                sessionStorage['user_id'] = data.id;
                sessionStorage['user_name'] = data.name;
                $('#navbar-user').attr('href', '/logout');
                $('#navbar-user').attr('title', 'Logout');
                $('#navbar-username').html(data.name);
            },
            error: function(error) {
            }
        });
    }

    function searchDeActive() {
        $('#audio-search-bar').removeClass('active');
        $('#audio-search-input').val('');
        $('#audio-search-input').blur();
		dim(false);
    }

    function searchActive() {
        $('#audio-search-bar').addClass('active');
        $('#audio-search-input').focus();
		dim(true);
    }

    function searchClick() {
        if ($('#audio-search-bar').hasClass('active')) {
            searchDeActive();
        } else {
            searchActive();
        }
    }

    function dim(bool) {
        if (typeof bool == 'undefined') bool = true; // so you can shorten dim(true) to dim()
        document.getElementById('dimmer').style.display = (bool ? 'block' : 'none');
    }

    $('#icon-search').click(searchClick);

    $(document).mouseup(function(e) {
        var container = $("#audio-search-bar");

        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            if ($('#audio-search-bar').hasClass('active')) {
                searchDeActive();
            }
        }
    });

    function doc_keyUp(e) {
        // this would test for whichever key is 40 and the ctrl key at the same time
        if (e.keyCode == 27) {
            // call your function to do the thing
            searchDeActive();
            return;
        }

        if (e.altKey && e.keyCode == 83) {
            // call your function to do the thing
            searchClick();
        }
    }
    // register the handler 
    document.addEventListener('keydown', doc_keyUp, false);

    function viewSearch() {
        window.location.href = '/search?text=' + $('#audio-search-input').val();
    }

    $('#icon-go').click(function(){
        viewSearch();
    });

    $('#audio-search-input').keyup(function(e){
        if (e.keyCode == 13) {
            viewSearch();
        }
    })
})();
