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
                self.setAudioNameLabel();
                self.setSingersNameLabel();
                self.setTypeLabel();
                self.setNationLabel();
                self.setComposerLabel();
                self.setUserUpload();
                self.setLyricPage();
                self.setAudioPlayer();
                self.loadAudioHint(self.code);
            },
            error: function (data) {
                console.log(data);
            }
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
                var lyric = data[0].lyric.replace(/\n/g, "<br />") + '<br><br>';
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
            },
            // {
            //     code: 'self.code',
            //     name: 'self.name',
            //     links: [
            //         {
            //             bit_rate: 128,
            //             name:'/audio/a4b5a18b731bee5f6a0479f5d87ee334'
            //         },
            //         {
            //             bit_rate: 320,
            //             name:'/audio/8f877b54186efc012b2fff6e2cfaabe8'
            //         }
            //     ],
            //     composer: 'self.composer'
            // },
        ]);
        this.audio.start();
    }

    Controller.PlayAudio.prototype.loadAudioHint = function(code) {
         $.ajax({
            url: '/api/audio/random?limit=10&code=' + code,
            dataType: 'json',
            success: function (data) {
                console.log(data);
            },
            error: function (data) {
                console.log('error on load hint');
                console.log(data);
            }
        });
    }

})(DaMusic.Controller)