(function () {
    if (localStorage['api_token']) {
        var token = localStorage['api_token'];
        $.ajax({
            url: '/api/user?no_redirect=true',
            data: { api_token: token },
            success: function (data) {
                if (!data) {
                    $('#navbar-user').attr('href', '/login?current_link=' + window.location.pathname)
                    return;
                };
                if (data.roles[0].order <= 2) {
                    $('.role-mode').show();
                }
                $('.user-mode').show();
                sessionStorage['user_id'] = data.id;
                sessionStorage['user_name'] = data.name;
                $('#navbar-user').attr('href', '/logout');
                $('#navbar-user').attr('title', 'Logout');
                $('#navbar-username').html(data.name);
            },
            error: function (error) {
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

    $(document).mouseup(function (e) {
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

    $('#icon-go').click(function () {
        viewSearch();
    });

    $('#audio-search-input').keyup(function (e) {
        if (e.keyCode == 13) {
            viewSearch();
        }
    })
})();


var DaMusic = DaMusic || {};
DaMusic.Controller = DaMusic.Controller || {};

(function (Controller) {
    Controller.App = function () {
        this.isSetup = false;
        this.isSetupType = false;
    }

    Controller.App.prototype.checkRole = function () {

    }

    Controller.App.prototype.setupNation = function () {
        $("#csm-nation").select2({
            ajax: {
                url: '/api/nation/search',
                processResults: function (data, params) {
                    var results = [];
                    data.forEach(function (e) {
                        results.push({ id: e.id, text: e.name });
                    });
                    return {
                        results: results,
                    };
                },
                cache: true
            },
            placeholder: 'Chọn quốc gia',
        });
    }

    Controller.App.prototype.searchSinger = function () {
        $.ajax({
            url: 'api/singer/search?length=1&search=' + $('#csm-stage-name').val(),
            success: function (data) {
                if(data.length == 0) return;
                let text = data[0].text;
                $('#csm-sample').val(text);
            },
            error: function (data) {
                console.log('--error--');
                console.log(data);
            }
        });
    }

    Controller.App.prototype.setUpSample = function () {
        var self = this;
        let lazySearch = _.debounce(this.searchSinger.bind(this), 200);
        $('#csm-stage-name').keyup(function () {
            lazySearch();
        });
    }

    Controller.App.prototype.setupImage = function () {
        $("#csm-image").change(function(){
            let text = $("#csm-image :selected").text();
            $('#csm-image-view').attr('src',text);
        });
        $("#csm-image").select2({
            ajax: {
                url: '/api/image/search',
                processResults: function (data, params) {
                    var results = [];
                    data.forEach(function (e) {
                        results.push({ id: e.id, text: e.name });
                    });
                    return {
                        results: results,
                    };
                },
                cache: true,
            },
            placeholder: 'Chọn ảnh',
        });
    }

    Controller.App.prototype.showSingerModal = function () {
        if (!this.isSetup) {
            this.isSetup = true;
            this.setupNation();
            this.setUpSample();
            this.setupImage();
        }
        $('#csm-stage-name').val('');
        $('#csm-name').val('');
        $('#csm-sample').val('');
        $('#csm-birthday').val('');
        $('#csm-nation').select2("val", "");
        $('#csm-description').val('');
        $('#csm-image').select2("val", "");
        $('#create-singer-modal').modal('toggle');
    }

    Controller.App.prototype.showImageModal = function () {
        $('#create-image-modal').modal('toggle');
    }

    Controller.App.prototype.showTypeModal = function () {
        if (!this.isSetupType) {
            this.isSetupType = true;
            this.setUpTypeSample();
        }
        $('#create-type-modal').modal('toggle');
    }

    Controller.App.prototype.isSetupType = function() {

    }

    Controller.App.prototype.createSinger = function () {
        let stageName = $('#csm-stage-name').val();
        let name = $('#csm-name').val();
        let birthday = $('#csm-birthday').val();
        let description = $('#csm-description').val();
        let nation = $('#csm-nation').val();
        let imageId = $("#csm-image").val();

        let data = {};
        if (!(stageName && nation)) return;
        data.stage_name = stageName;
        data.nation_id = nation;
        if (name) {
            data.name = name;
        }
        if (birthday) {
            data.birthday = birthday;
        }
        if (description) {
            data.description = description;
        }
        if(imageId) {
            data.image_id = imageId;
        }
        $.ajax({
            url: '/api/singer/insert',
            method: 'POST',
            data: data,
            success: function (data) {
                $.notify("Tạo mới nghệ sỹ thành công", {
                    globalPosition: 'bottom left',
                    className: 'success',
                });
                $('#create-singer-modal').modal('toggle');
            },
            error: function (data) {
                console.log('--error--');
                console.log(data);
            }
        })
    }

    Controller.App.prototype.createImage = function () {
        let image = $('#image-file')[0].files[0];
        var data = new FormData();
        data.append('image', image);
        $.ajax({
            url: '/api/image/upload',
            method: 'POST',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                sessionStorage['image_link_id'] = data.id;
                $.notify("Upload ảnh thành công", {
                    globalPosition: 'bottom left',
                    className: 'success',
                });
            },
            error: function (data) {
                console.log('--error--');
                console.log(data);
            }
        })
    }

    Controller.App.prototype.searchType = function () {
        $.ajax({
            url: 'api/type/searchFull?length=1&search=' + $('#ctm-name').val(),
            success: function (data) {
                $('#ctm-sample').val(data[0].text);
            },
            error: function (data) {
                console.log('--error--');
                console.log(data);
            }
        });
    }

    Controller.App.prototype.setUpTypeSample = function () {
        var self = this;
        let lazySearch = _.debounce(this.searchType.bind(this), 200);
        $('#ctm-name').keyup(function () {
            lazySearch();
        });
    }

    Controller.App.prototype.createType = function () {
        let type = $('#ctm-name').val();
        if(!type) return;
        $.ajax({
            url: '/api/type/insert',
            method: 'POST',
            data: {name: type},
            success: function(data) {
                $.notify("Thêm thể loại thành công", {
                    globalPosition: 'bottom left',
                    className: 'success',
                });
            },
            error: function(data) {
                console.log('--error--');
                console.log(data);
            }
        });
    }

    Controller.App.prototype.showPlaylistModal = function () {
        $('#cpm-name').val('');
        $('#create-playlist-modal').modal('toggle');
    }

    Controller.App.prototype.createPlaylist = function() {
        let name = $('#cpm-name').val();
        if(!name) return;
        $.ajax({
            url: '/api/playlist/insert',
            method: 'POST',
            data: {
                name: name
            },
            success: function(data) {
                $.notify("Thêm playlist thành công", {
                    globalPosition: 'bottom left',
                    className: 'success',
                });
                $('#create-playlist-modal').modal('toggle');
            },
            error: function(data) {
                console.log('--error--');
                console.log(data);
            }
        });
    }

})(DaMusic.Controller)