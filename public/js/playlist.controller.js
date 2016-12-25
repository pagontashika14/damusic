var DaMusic = DaMusic || {};
DaMusic.Controller = DaMusic.Controller || {};

(function (Controller) {
    Controller.Playlist = function () {
        
    }

    Controller.Playlist.prototype.getPlaylistInfo = function (code, callback) {
        var self = this;
        $.ajax({
            url: '/api/playlist/get?code=' + code,
            dataType: 'json',
            success: function (data) {
                self.audio = data.audio;
                self.initEvent();
                self.setPlaylistNameLabel(data.name);
                self.setUserNameLabel(data.user.name);
                // self.setTypeLabel();
                // self.setNationLabel();
                // self.setComposerLabel();
                // self.setUserUpload();
                // self.setLyricPage();
                self.setPlaylistPlayer();
                self.loadlistHint();
                // self.setlistViewsLabel();
                // self.setLikeBtn();
            },
            error: function (data) {
                console.log(data);
            }
        });

    }

    Controller.Playlist.prototype.initEvent = function() {
        $('#btn-like').click(this.like.bind(this));
    }

    Controller.Playlist.prototype.like = function() {
        // $.ajax({
        //     url: ''
        // });
    }

    Controller.Playlist.prototype.setLikeBtn = function() {
        
    }

    Controller.Playlist.prototype.setPlaylistNameLabel = function (e) {
        $('#playlist-name').html(e);
    }

    Controller.Playlist.prototype.setUserNameLabel = function (e) {
        $('#user-name').html(e);
    }

    Controller.Playlist.prototype.setTypeLabel = function () {
        var href = '/type/list-list/';
        $('#list-type').html('');
        $('#list-type').append('<a href=' + href + this.types[0].id + '>' + this.types[0].name + '</a>');
        for (var i = 1, len = this.types.length; i < len; i++) {
            var type = this.types[i];
            $('#list-type').append('<span> , </span>');
            $('#list-type').append('<a href=' + href + type.id + '>' + type.name + '</a>');
        }
    }

    Controller.Playlist.prototype.setNationLabel = function () {
        $('#list-nation').html(this.nation.name);
    }

    Controller.Playlist.prototype.setComposerLabel = function () {
        $('#list-composer').html(this.composer.stage_name);
    }

    Controller.Playlist.prototype.setUserUpload = function () {
        $('#list-user-upload').html(this.user.name);
    }

    Controller.Playlist.prototype.setLyricPage = function () {
        var self = this;
        $('#list-lyric').slimScroll({
            height: '300px'
        });
        $('#list-lyric-page').pagination({
            dataSource: self.lyrics,
            pageSize: 1,
            callback: function (data, pagination) {
                // template method of yourself
                var userUpload = data[0].user_name;
                var dtLyric = data[0].lyric.trim();
                var lyric;
                if (dtLyric) {
                    lyric = dtLyric.replace(/\n/g, "<br />") + '<br><br>';
                    $('#list-lyric').slimScroll({
                        height: '300px'
                    });
                } else {
                    lyric = '<span style="font-style: italic;">Hiện chưa có lời bài hát cho ca khúc này.</span>';
                    $('#list-lyric').slimScroll({
                        height: '50px'
                    });
                }
                $('#list-lyric-user').html(userUpload);
                $('#list-lyric').html(lyric);
            }
        });
    }

    Controller.Playlist.prototype.setPlaylistPlayer = function () {
        var self = this;
        this.list = new DatAudioPlayer({
            divId: 'audio-player',
            skin: 'skin-single-medium',
            hasRepeat: true,
            hasPlaylist: true,
        });
        let source = _.map(self.audio,e => {
            return {
                code: e.code,
                name: e.name,
                links: e.links,
                singers: e.singers
            }
        })
        this.list.loadSource(source);
        this.list.addEvent('onstart',function(e){
            $.ajax({
                url: '/api/audio/add_view/'+e.audio.code,
            });
        });
        this.list.addEvent('onend',function(e){
            if(self.listToNext && $('#auto-next')[0].checked) {
                e.player.isLoop = false;
                window.location.href = "/play-audio/"+self.listToNext;
            }
        });
        this.list.start();
    }

    Controller.Playlist.prototype.setlistViewsLabel = function() {
        $('#list_views').html(this.views);
    }

    Controller.Playlist.prototype.loadlistHint = function (code) {
        var self = this;
        $.ajax({
            url: '/api/audio/random?limit=10',
            dataType: 'json',
            success: function (data) {
                self.setlistHint(data);
            },
            error: function (data) {
                console.log('error on load hint');
                console.log(data);
            }
        });
    }

    Controller.Playlist.prototype.setlistHint = function (data) {
        let self = this;
        self.listToNext = data[0] ? data[0].code : undefined;
        let divContainer = $('#hint-container');
        data.forEach(e => {
            let divHint = self.initDivHint(e.code, e.singers[0].image, e.name, e.singers);
            divContainer.append(divHint);
        });
    }

    Controller.Playlist.prototype.initDivHint = function (code, img, name, singers) {
        let imgLink = img ? img.name : "/api/image/index/124794cb4fbbca1a578d2d474998096a";
        let link = '/play-audio/' + code;
        let divHint = $('<div class="audio-hint-element"></div>');
        let aTag = $('<a href="' + link + '" class=""></a>');
        let divImg = $('<div class="image-fill-container image"></div>');
        let image = $('<img class="wide w3-hover-shadow" src="' + imgLink + '" />');
        let divName = $('<div class="hint-name"></div>');
        let hName = $('<div>' + name + '</div>');
        let divSingers = $('<div class="hint-singers"></div>');
        divSingers.append('<a href="/singer/' + singers[0].id + '">' + singers[0].stage_name + '</a>');
        for (let i = 1, len = singers.length; i < len; i++) {
            divSingers.append('<a href="/singer/' + singers[i].id + '">, ' + singers[i].stage_name + '</a>');
        }
        divName.append(hName);
        divName.append(divSingers);
        divImg.append(image);
        aTag.append(divImg);
        aTag.append(divName);
        divHint.append(aTag);

        return divHint;
    }

})(DaMusic.Controller)