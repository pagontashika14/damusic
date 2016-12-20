var DaMusic = DaMusic || {};
DaMusic.Controller = DaMusic.Controller || {};

(function (Controller) {
    Controller.Search = function () {
        var self = this;
        self.initEvent();
        if(SEARCH_TEXT) {
            $('#input-search').val(SEARCH_TEXT);
            self.search(SEARCH_TEXT);
        }
    }

    Controller.Search.prototype.initEvent = function () {
        let lazySearch = _.debounce(this.search.bind(this), 200);
        $('#input-search').keyup(function () {
            let text = $('#input-search').val();
            lazySearch(text);
        });
    }

    Controller.Search.prototype.search = function (text) {
        var self = this;
        $.ajax({
            url: 'api/audio/search?text=' + text,
            success: function (data) {
                self.addSearchAudioResult(data.data);
            },
            error: function (data) {
                console.log('--error--');
                console.log(data);
            }
        });
        $.ajax({
            url: 'api/singer/searchfull?text=' + text,
            success: function (data) {
                self.addSearchSingerResult(data.data);
            },
            error: function (data) {
                console.log('--error--');
                console.log(data);
            }
        });
    }

    Controller.Search.prototype.addSearchAudioResult = function (data) {
        var self = this;
        $('#search-audio-container').html('');
        for (let i = 0, len = data.length; i < len; i++) {
            let dt = data[i];
            let div = self.getDivAudio('/play-audio/' + dt.code, dt.singers[0].image, dt.name, dt.singers);
            $('#search-audio-container').append(div);
        }
    }

    Controller.Search.prototype.addSearchSingerResult = function (data) {
        var self = this;
        $('#search-singer-container').html('');
        for (let i = 0, len = data.length; i < len; i++) {
            let dt = data[i];
            let div = self.getDivAudio('/singer/' + dt.id, dt.image, dt.stage_name);
            $('#search-singer-container').append(div);
        }
    }

    Controller.Search.prototype.getDivAudio = function (link, img, name, singers = undefined) {
        let imgLink = img ? img.name : "/api/image/index/124794cb4fbbca1a578d2d474998096a";
        let divHint = $('<div class="audio-hint-element"></div>');
        let aTag = $('<a href="' + link + '" class=""></a>');
        let divImg = $('<div class="image-fill-container image"></div>');
        let image = $('<img class="wide w3-hover-shadow" src="' + imgLink + '" />');
        let divName = $('<div class="hint-name"></div>');
        let hName = $('<div>' + name + '</div>');
        divName.append(hName);
        if (singers) {
            let divSingers = $('<div class="hint-singers"></div>');
            divSingers.append('<a href="/singer/' + singers[0].id + '">' + singers[0].stage_name + '</a>');
            for (let i = 1, len = singers.length; i < len; i++) {
                divSingers.append('<a href="/singer/' + singers[i].id + '">, ' + singers[i].stage_name + '</a>');
            }
            divName.append(divSingers);
        }
        divImg.append(image);
        aTag.append(divImg);
        aTag.append(divName);
        divHint.append(aTag);

        return divHint;
    }

})(DaMusic.Controller)