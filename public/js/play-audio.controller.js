var DaMusic = DaMusic || {};
DaMusic.Controller = DaMusic.Controller || {};

(function (Controller) {
    Controller.PlayAudio = function () {
        
    }

    Controller.PlayAudio.prototype.getAudioInfo = function (code, callback) {
        var self = this;
        $.ajax({
            url: '/api/audio/index/' + code,
            dataType: 'json',
            success: function (data) {
                self.code = data.code;
                self.id = data.id;
                self.links = _.sortBy(data.links, e => e.bit_rate);
                self.name = data.name;
                self.lyrics = _.map(data.lyrics, e => { return { lyric: e.lyric, user_name: e.user.name } });
                self.nation = data.nation;
                self.composer = data.composer[0];
                self.singers = data.singers;
                self.types = data.types;
                self.user = data.user;
                self.views = data.views_count;
                self.initEvent();
                self.setAudioNameLabel();
                self.setSingersNameLabel();
                self.setTypeLabel();
                self.setNationLabel();
                self.setComposerLabel();
                self.setUserUpload();
                self.setLyricPage();
                self.setAudioPlayer();
                self.loadAudioHint(self.code);
                self.setAudioViewsLabel();
                self.setLikeBtn();
            },
            error: function (data) {
                console.log(data);
            }
        });

    }

    Controller.PlayAudio.prototype.initEvent = function() {
        $('#btn-like').click(this.like.bind(this));
    }

    Controller.PlayAudio.prototype.like = function() {
        // $.ajax({
        //     url: ''
        // });
    }

    Controller.PlayAudio.prototype.setLikeBtn = function() {
        $.ajax({
            url: ''
        });
    }

    Controller.PlayAudio.prototype.setAudioNameLabel = function () {
        $('#audio-name').html(this.name);
    }

    Controller.PlayAudio.prototype.setSingersNameLabel = function () {
        var href = '/singer/';
        $('#singers-name').html('');
        $('#singers-name').append('<a href=' + href + this.singers[0].id + '>' + this.singers[0].stage_name + '</a>');
        for (var i = 1, len = this.singers.length; i < len; i++) {
            var singer = this.singers[i];
            $('#singers-name').append('<span> , </span>');
            $('#singers-name').append('<a href=' + href + singer.id + '>' + singer.stage_name + '</a>');
        }
    }

    Controller.PlayAudio.prototype.setTypeLabel = function () {
        var href = '/type/list-audio/';
        $('#audio-type').html('');
        $('#audio-type').append('<a href=' + href + this.types[0].id + '>' + this.types[0].name + '</a>');
        for (var i = 1, len = this.types.length; i < len; i++) {
            var type = this.types[i];
            $('#audio-type').append('<span> , </span>');
            $('#audio-type').append('<a href=' + href + type.id + '>' + type.name + '</a>');
        }
    }

    Controller.PlayAudio.prototype.setNationLabel = function () {
        $('#audio-nation').html(this.nation.name);
    }

    Controller.PlayAudio.prototype.setComposerLabel = function () {
        $('#audio-composer').html(this.composer.stage_name);
    }

    Controller.PlayAudio.prototype.setUserUpload = function () {
        $('#audio-user-upload').html(this.user.name);
    }

    Controller.PlayAudio.prototype.setLyricPage = function () {
        var self = this;
        $('#audio-lyric').slimScroll({
            height: '300px'
        });
        $('#audio-lyric-page').pagination({
            dataSource: self.lyrics,
            pageSize: 1,
            callback: function (data, pagination) {
                // template method of yourself
                var userUpload = data[0].user_name;
                var dtLyric = data[0].lyric.trim();
                var lyric;
                if (dtLyric) {
                    lyric = dtLyric.replace(/\n/g, "<br />") + '<br><br>';
                    $('#audio-lyric').slimScroll({
                        height: '300px'
                    });
                } else {
                    lyric = '<span style="font-style: italic;">Hiện chưa có lời bài hát cho ca khúc này.</span>';
                    $('#audio-lyric').slimScroll({
                        height: '50px'
                    });
                }
                $('#audio-lyric-user').html(userUpload);
                $('#audio-lyric').html(lyric);
            }
        });
    }

    Controller.PlayAudio.prototype.setAudioPlayer = function () {
        var self = this;
        this.audio = new DatAudioPlayer({
            divId: 'audio-player',
            skin: 'skin-single-medium',
            hasRepeat: true
        });
        this.audio.loadSource([
            {
                code: self.code,
                name: self.name,
                links: self.links,
                composer: self.composer
            }
        ]);
        this.audio.addEvent('onstart',function(e){
            $.ajax({
                url: '/api/audio/add_view/'+e.audio.code,
            });
        });
        this.audio.addEvent('onend',function(e){
            if(self.audioToNext && $('#auto-next')[0].checked) {
                window.location.href = "/play-audio/"+self.audioToNext;
            }
        });
        this.audio.start();
    }

    Controller.PlayAudio.prototype.setAudioViewsLabel = function() {
        $('#audio_views').html(this.views);
    }

    Controller.PlayAudio.prototype.loadAudioHint = function (code) {
        var self = this;
        $.ajax({
            url: '/api/audio/random?limit=10&code=' + code,
            dataType: 'json',
            success: function (data) {
                self.setAudioHint(data);
            },
            error: function (data) {
                console.log('error on load hint');
                console.log(data);
            }
        });
    }

    Controller.PlayAudio.prototype.setAudioHint = function (data) {
        let self = this;
        self.audioToNext = data[0] ? data[0].code : undefined;
        let divContainer = $('#hint-container');
        data.forEach(e => {
            let divHint = self.initDivHint(e.code, e.singers[0].image, e.name, e.singers);
            divContainer.append(divHint);
        });
    }

    Controller.PlayAudio.prototype.initDivHint = function (code, img, name, singers) {
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