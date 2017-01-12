var DaMusic = DaMusic || {};
DaMusic.Controller = DaMusic.Controller || {};

(function (Controller) {
    Controller.User = function () {
        this.getUser();
    }

    Controller.User.prototype.getUser = function () {
        var self = this;
        $.ajax({
            url: '/api/user?no_redirect=true',
            success: function (data) {
                if (data) {
                    self.setEmail(data.email);
                    self.setName(data.name);
                    self.setRole(data.roles[0].display_name);
                    self.loadPlaylist();
                } else {
                    window.location.href = "/login?current_link=/user";
                }
            },
            error: function (error) {
                console.log('--error--');
                console.log(error);
            }
        });
    }

    Controller.User.prototype.setEmail = function (e) {
        $('#user-email').html(e);
    }

    Controller.User.prototype.setName = function (e) {
        $('#user-name').html(e);
    }

    Controller.User.prototype.setRole = function (e) {
        $('#user-role').html(e);
    }

    Controller.User.prototype.loadPlaylist = function () {
        var self = this;
        $.ajax({
            url: '/api/playlist/getPlaylistByUser',
            dataType: 'json',
            success: function (data) {
                self.setPlaylist(data,'playlist-container');
            },
            error: function (data) {
                console.log('error on load hint');
                console.log(data);
            }
        });
    }

    Controller.User.prototype.setPlaylist = function (data,divId) {
        let self = this;
        let divContainer = $('#'+divId);
        data.forEach(e => {
            let divHint = self.initDivPlaylist(e.code, e.image, e.name);
            divContainer.append(divHint);
        });
    }

    Controller.User.prototype.initDivPlaylist = function (code, img, name) {
        let imgLink = img ? img.name : "/img/icon2.png";
        let link = '/playlist?code=' + code;
        let divHint = $('<div class="audio-top-element"></div>');
        let aTag = $('<a href="' + link + '" class=""></a>');
        let divImg = $('<div class="image-fill-container image"></div>');
        let image = $('<img class="wide w3-hover-shadow" src="' + imgLink + '" />');
        let divName = $('<div class="top-name"></div>');
        let hName = $('<div>' + name + '</div>');
        divName.append(hName);
        divImg.append(image);
        aTag.append(divImg);
        aTag.append(divName);
        divHint.append(aTag);

        return divHint;
    }

})(DaMusic.Controller);