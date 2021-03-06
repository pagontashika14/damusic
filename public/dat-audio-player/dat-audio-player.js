(function (Controller) {
    Controller.DatAudioPlayer = function (options) {
        this.myEvent = {};
        this.divContainer = $('#' + options.divId);
        if (options.skin) {
            this.loadSkin(options.skin);
        }
        this.isLoadPlaylist = options.hasPlaylist;
        this.initMode();
        this.loadAudioControl();
        this.initEvent();
        if (options.hasRepeat) {
            this.initRepeat();
        }
    }

    Controller.DatAudioPlayer.prototype.addEvent = function (name, fun, isStop = false) {
        if (!this.myEvent[name]) {
            this.myEvent[name] = [];
        }
        this.myEvent[name].push(fun);
    }

    Controller.DatAudioPlayer.prototype.emitEvent = function (name, data) {
        if (!this.myEvent[name]) return;
        for (let i = 0, len = this.myEvent[name].length; i < len; i++) {
            this.myEvent[name][i](data);
        }
    }

    Controller.DatAudioPlayer.prototype.initMode = function () {
        this.sortMode = ['esc', 'one', 'random'];
        this.currentSortMode = 0;
        this.isLoop = true;
        this.maxQuality = 128;
        this.isEditTimeLine = false;
    }

    Controller.DatAudioPlayer.prototype.initEvent = function () {
        this.btnPlay.click(this.btnPlayClick.bind(this));
        this.divTimeline.mousedown(this.divTimelineMouseDown.bind(this));
        this.divTimeline.mouseup(this.divTimelineMouseUp.bind(this));
        this.slider.update({
            onFinish: this.onSliderUpdate.bind(this)
        });
        this.btnNext.click(this.next.bind(this));
        this.initVolume();
        this.btnQuality.click(this.changeQuality.bind(this));
    }

    Controller.DatAudioPlayer.prototype.initVolume = function () {
        var self = this;
        let id = uniqueId();
        this.btnVolume.attr('data-tooltip-content', '#' + id);
        let divVolumeContentTemplate = $('<div class="tooltip_templates"></div>');
        let divVolumeContent = $('<span id="' + id + '"></span>');
        let divVolumeContainer = $('<div style="width:120px;height:50px;margin-top:-30px;"></div>');
        let slider = $('<input type="text" name="example" value="" />');
        divVolumeContainer.append(slider);
        divVolumeContent.append(divVolumeContainer);
        divVolumeContentTemplate.append(divVolumeContent);
        this.divContent.append(divVolumeContentTemplate);
        $(slider).ionRangeSlider({
            min: 0,
            max: 100,
            from: 100,
            hide_min_max: true,
            hide_from_to: false,
            grid: false,
            prettify: function (num) {
                return num + ' %';
            },
            onChange: self.onChangeVolume.bind(self)
        });
        this.btnVolume.tooltipster({
            animation: 'fade',
            delay: 80,
            theme: 'tooltipster-punk',
            trigger: 'click',
            interactive: 'true',
            side: ['left', 'top', 'bottom', 'right']
        });
        this.volumeSlider = slider.data("ionRangeSlider");
    }

    Controller.DatAudioPlayer.prototype.initRepeat = function () {
        this.btnRepeat = $('<i class="dat-btn-single-medium fa fa-refresh w3-display-middle" aria-hidden="true"></i>');
        this.divRepeat.append(this.btnRepeat);
        this.btnRepeat.click(this.btnRepeatClick.bind(this));
    }

    Controller.DatAudioPlayer.prototype.btnRepeatClick = function () {
        let listClass = ['fa-refresh', 'fa-undo', 'fa-random'];
        let oldSortMode = this.currentSortMode;
        if (this.currentSortMode == this.sortMode.length - 1) {
            this.currentSortMode = 0;
        } else {
            this.currentSortMode += 1;
        }
        this.btnRepeat.addClass(listClass[this.currentSortMode]).removeClass(listClass[oldSortMode]);
        this.source = this.getSource();
    }

    Controller.DatAudioPlayer.prototype.onChangeVolume = function (data) {
        this.setVolume(data.from);
    }

    Controller.DatAudioPlayer.prototype.setVolume = function (data) {
        this.divAudio.volume = data / 100;
    }

    Controller.DatAudioPlayer.prototype.divTimelineMouseDown = function () {
        this.isEditTimeLine = true;
    }

    Controller.DatAudioPlayer.prototype.divTimelineMouseUp = function () {
        this.isEditTimeLine = false;
    }

    Controller.DatAudioPlayer.prototype.onSliderUpdate = function (data) {
        this.divAudio.currentTime = data.from;
        this.isEditTimeLine = false;
    }

    Controller.DatAudioPlayer.prototype.loadSkin = function (skinName) {
        let stringHtml = '';
        switch (skinName) {
            case 'skin-single-medium':
                stringHtml = this.getSkinSingerMedium();
                break;
        }
        this.divContainer.append(stringHtml);
    }

    Controller.DatAudioPlayer.prototype.getSkinSingerMedium = function () {
        this.divContent = $('<div class="dat-content-singer-medium w3-display-container"></div>');
        let divOpacity = $('<div class="dat-opacity-singer-medium"></div>');
        this.divContent.append(divOpacity);
        let bar = $('<div class="dat-bar-singer-medium w3-display-bottommiddle"></div>');
        divOpacity.append(bar);
        let divTitle = $('<div class="dat-title-singer-medium w3-display-topmiddle w3-display-container"></div>');
        divOpacity.append(divTitle);
        let title = $('<div class="w3-display-middle dat-text-title-single-medium w3-text-shadow">Ca khúc: </div>');
        this.audioTitle = $('<span>Chưa có</span>');
        title.append(this.audioTitle);
        divTitle.append(title);
        this.divTimeline = $('<div class="dat-timeline-single-medium"></div>');
        slider = $('<input type="text" name="example_name" value="" />');
        this.divTimeline.append(slider);
        $(slider).ionRangeSlider({
            min: 0,
            max: 100,
            prettify: function (num) {
                return 'Đang tính';
            }
        });
        this.slider = slider.data("ionRangeSlider");
        bar.append(this.divTimeline);
        divControl = $('<div class="dat-control-single-medium w3-display-container"></div>');
        bar.append(divControl);
        let divPlay = $('<div></div>');
        divPlay.addClass('dat-play-single-medium w3-display-container inline');
        divControl.append(divPlay);
        this.btnPlay = $('<i class="dat-btn-single-medium fa fa-play w3-display-middle" aria-hidden="true"></i>');
        divPlay.append(this.btnPlay);
        let divNext = $('<div></div>');
        divNext.addClass('dat-play-single-medium w3-display-container inline');
        divControl.append(divNext);
        this.btnNext = $('<i class="dat-btn-single-medium fa fa-step-forward w3-display-middle" aria-hidden="true"></i>');
        divNext.append(this.btnNext);
        let divLeft = $('<div class="dat-left-single-medium inline w3-display-right"></div>');
        divControl.append(divLeft);
        let divQuality = $('<div class="dat-quality-single-medium inline w3-display-container"></div>');
        divLeft.append(divQuality);
        this.btnQuality = $('<button class="dat-btn-quality-single-medium w3-btn w3-border w3-border-white w3-round-large w3-display-middle"></button>');
        this.labelQuality = $('<span>128</span>');
        this.btnQuality.append(this.labelQuality);
        this.btnQuality.append(' kbps');
        divQuality.append(this.btnQuality);
        let divVolume = $('<div class="dat-play-single-medium inline w3-display-container"></div>');
        divLeft.append(divVolume);
        this.btnVolume = $('<i class="dat-btn-single-medium fa fa-volume-down w3-display-middle" aria-hidden="true"></i>');
        divVolume.append(this.btnVolume);
        this.divRepeat = $('<div class="dat-play-single-medium inline w3-display-container"></div>');
        divLeft.append(this.divRepeat);


        this.setBtnPlayToPausing = function () {
            if (this.btnPlay.hasClass('fa-play')) {
                this.btnPlay.addClass('fa-pause').removeClass('fa-play');
            }
        }.bind(this);

        this.setBtnPlayToPlaying = function () {
            if (!this.btnPlay.hasClass('fa-play')) {
                this.btnPlay.addClass('fa-play').removeClass('fa-pause');
            }
        }.bind(this);
        this.divContentContainer = $('<div class="audio-player-content-container"></div>');
        this.divContentContainer.append(this.divContent);
        return this.divContentContainer;
    }

    Controller.DatAudioPlayer.prototype.test = function () {
        console.log('say hello');
    }

    Controller.DatAudioPlayer.prototype.loadAudioControl = function () {
        try {
            let audio = $('<audio id="aaa" style="display:none;"></audio>');
            this.divAudio = audio[0];
            this.divContent.append(audio);
            this.divAudio.onloadedmetadata = this.loadedAudio.bind(this);
            this.divAudio.ontimeupdate = this.onAudioTimeUpdate.bind(this);
            this.divAudio.onended = this.onAudioEnded.bind(this);
        } catch (e) {

        }
    }

    Controller.DatAudioPlayer.prototype.loadedAudio = function () {
        this.initSlider();
    }

    Controller.DatAudioPlayer.prototype.getAudioIndex = function (code) {
        for (let i = 0, len = this.source.length; i < len; i++) {
            if (this.source[i].code == code) {
                return i;
            }
        }
        return 0;
    }

    Controller.DatAudioPlayer.prototype.onAudioEnded = function () {
        var self = this;
        let audio = this.getCurrentAudio();
        let index = this.getAudioIndex(audio.code);
        let link = this.getLink(audio.links);
        if (index == this.source.length - 1) {
            this.emitEvent('onend', {
                player: self,
                audio: audio,
                currentLink: link.name
            });
            
        }
        let next = this.getNextAudio();
        if (next != undefined) {
            this.next();
        } else {
            this.stop();
        }
    }

    Controller.DatAudioPlayer.prototype.onAudioTimeUpdate = function () {
        if (!this.isEditTimeLine) {
            this.updateSlider();
        }
    }

    Controller.DatAudioPlayer.prototype.loadSource = function (source) {
        // source = [{code:'', name:'', links=[{bitRate:'', link:''}], singer:''}]
        this.baseSource = source;
        this.source = this.getSource();
        if(this.isLoadPlaylist) {
            this.loadPlaylist();
        }
    }

    Controller.DatAudioPlayer.prototype.loadPlaylist = function() {
        var self = this;
        this.divPlaylist = $('<div class="audio-player-playlist"></div>');
        this.divContentContainer.append(this.divPlaylist);
        for(let i=0,len=this.baseSource.length;i<len;i++){
            let item = this.getPlaylistItem(i,this.baseSource[i]);
            this.divPlaylist.append(item);
        }

        this.addEvent('onstart',function(e){
            self.highlightItem(e.audio.code);
        })
    }

    Controller.DatAudioPlayer.prototype.getPlaylistItem = function(id,audio) {
        var self = this;
        let item = $('<div id="playlist-'+audio.code+'" class="audio-player-playlist-item"></div>');
        let row = $('<div class="w3-row"></div>');
        item.append(row);
        let divId = $('<div class="w3-col m1"></div>');
        let playid = $('<div class="playlist-item center">'+id+'</div>');
        divId.append(playid);
        let divName = $('<div class="w3-col m6"></div>');
        let name = $('<div class="playlist-item">'+audio.name+'</div>');
        divName.append(name);
        let singerText = audio.singers[0].stage_name;
        for(let i=1,len=audio.singers.length;i<len;i++) {
            singerText += ', ' + audio.singers[i].stage_name;
        }
        let divSinger = $('<div class="w3-col m4" style="overflow:hidden"></div>');
        let singer = $('<div class="playlist-item">'+singerText+'</div>');
        divSinger.append(singer);
        let divForward = $('<div class="w3-col m1"></div>');
        let forward = $('<div class="playlist-item center"><i class="fa fa-arrow-right" aria-hidden="true"></i></div>');
        divForward.append(forward);
        divForward.click(function(e){
            e.stopPropagation();
            window.location.href = '/play-audio/' + audio.code;
        });
        
        row.append(divId);
        row.append(divName);
        row.append(divSinger);
        row.append(divForward);
        item.click(function() {
            self.currentAudio = audio.code;
            self.source = self.getSource();
            self.start()
        });
        return item;
    }

    Controller.DatAudioPlayer.prototype.highlightItem = function(code) {
        $('.audio-player-playlist-item').removeClass('highlight-item');
        $('#playlist-'+code).addClass('highlight-item');
    }

    Controller.DatAudioPlayer.prototype.getSource = function () {
        switch (this.sortMode[this.currentSortMode]) {
            case 'esc':
                return this.baseSource;
            case 'one':
                if (this.currentAudio == undefined) {
                    // this.currentAudio = 0;
                    return [this.baseSource[0]];
                } else {
                    let rs = [this.getCurrentAudio()];
                    return rs;
                }
            case 'random':
                let data = _.shuffle(this.baseSource);
                return data;
        }
    }

    Controller.DatAudioPlayer.prototype.getCurrentAudio = function () {
        var self = this;
        return _.find(this.baseSource, e => e.code == self.currentAudio);
    }

    Controller.DatAudioPlayer.prototype.getNextAudio = function () {
        if (this.currentAudio == undefined && this.source.length > 0) {
            return this.source[0].code;
        }
        for (let i = 0, len = this.source.length; i < len; i++) {
            if (this.source[i].code == this.currentAudio) {
                if (i == this.source.length - 1) {
                    return this.isLoop ? this.source[0].code : undefined;
                } else {
                    return this.source[i + 1].code;
                }
            }
        }
        return undefined;
    }

    Controller.DatAudioPlayer.prototype.getLink = function (links) {
        var link;
        for (let len = links.length, i = len - 1; i >= 0; i--) {
            if (links[i].bit_rate <= this.maxQuality) {
                link = links[i];
                this.currentQuality = i;
                break;
            }
        }
        return link ? link : links[0];
    }

    Controller.DatAudioPlayer.prototype.play = function () {
        this.divAudio.play();
        this.updateBtnPlay();
    }

    Controller.DatAudioPlayer.prototype.pause = function () {
        this.divAudio.pause();
        this.updateBtnPlay();
    }

    Controller.DatAudioPlayer.prototype.stop = function () {
        this.currentAudio = this.source[0].code;
        this.start(false);
    }

    Controller.DatAudioPlayer.prototype.start = function (andPlay = true) {
        if (this.currentAudio == undefined) {
            this.currentAudio = this.getNextAudio();
        }
        let audio = this.getCurrentAudio();
        if(!audio) {
            return;
        }
        let link = this.getLink(audio.links);
        this.setLabelQuality(link.bit_rate);
        this.divAudio.src = link.name;
        if (andPlay) {
            this.divAudio.load();
            this.play();
        } else {
            this.updateSlider(0);
        }
        this.updateBtnPlay();
        this.updateAudioTitle(audio.name);
        this.onStart(audio);

        this.emitEvent('onstart', {
            audio: audio,
            currentLink: link.name
        });
    }

    Controller.DatAudioPlayer.prototype.updateAudioTitle = function (title) {
        this.audioTitle.html(title);
    }

    Controller.DatAudioPlayer.prototype.changeQuality = function () {
        let audio = this.getCurrentAudio();
        if(!audio) {
            return;
        }
        let links = audio.links;
        if (links.length <= 1) return;
        if (this.currentQuality == links.length - 1) {
            this.currentQuality = 0;
        } else {
            this.currentQuality += 1;
        }
        let bit_rate = links[this.currentQuality].bit_rate;
        this.maxQuality = bit_rate;
        this.setLabelQuality(bit_rate);
        this.divAudio.src = links[this.currentQuality].name;
        this.divAudio.load();
        this.play();
    }

    Controller.DatAudioPlayer.prototype.onStart = function (data) {
        // console.log('not overloading onStart');
    }

    Controller.DatAudioPlayer.prototype.next = function () {
        let audio = this.getCurrentAudio();
        if(!audio) {
            return;
        }
        let link = this.getLink(audio.links);
        this.emitEvent('onnext', {
            audio: audio,
            currentLink: link.name
        });
        this.currentAudio = this.getNextAudio();
        this.start();
    }

    Controller.DatAudioPlayer.prototype.convertTimeNumberToString = function (timeNumber) {
        let string = timeNumber + '';
        if (timeNumber < 10) {
            string = '0' + string;
        }
        return string;
    }

    Controller.DatAudioPlayer.prototype.convertSecondsToTime = function (seconds) {
        var Nts = this.convertTimeNumberToString;
        var duration = parseInt(seconds);
        if (duration != NaN) {
            if (duration < 60) {
                return '0:' + Nts(duration);
            }
            else if (duration < 3600) {
                return parseInt(duration / 60) + ':' + Nts(duration % 60);
            }
            else {
                var h = duration / 3600 >> 0;
                var m = duration % 3600 / 60 >> 0;
                var s = duration % 3600 % 60;
                return h + ':' + Nts(m) + ':' + Nts(s);
            }
        }
        else {
            return 'NaN';
        }
    }

    Controller.DatAudioPlayer.prototype.initSlider = function () {
        var self = this;
        let min = 0;
        let max = this.divAudio.duration;
        this.slider.update({
            min: min,
            max: max,
            prettify: function (num) {
                return self.convertSecondsToTime(num);
            }
        });
    }

    Controller.DatAudioPlayer.prototype.updateSlider = function (value = undefined) {
        var self = this;
        var currentSeconds = this.divAudio.currentTime;
        this.slider.update({
            from: value ? value : currentSeconds
        });
    }

    Controller.DatAudioPlayer.prototype.updateBtnPlay = function () {
        if (this.divAudio.paused) {
            this.setBtnPlayToPlaying();
        } else {
            this.setBtnPlayToPausing();
        }
    }

    Controller.DatAudioPlayer.prototype.setLabelQuality = function (quality) {
        this.labelQuality.html(quality);
    }

    Controller.DatAudioPlayer.prototype.setBtnPlayToPausing = function () {
        console.log('function \'setBtnPlayToPausing\' is undefined');
    }

    Controller.DatAudioPlayer.prototype.setBtnPlayToPlaying = function () {
        console.log('function \'setBtnPlayToPlaying\' is undefined');
    }

    Controller.DatAudioPlayer.prototype.btnPlayClick = function () {
        if(this.source.length == 0) {
            return;
        }
        if (this.divAudio.paused) {
            this.play();
        } else {
            this.pause();
        }
    }

    Controller.DatAudioPlayer.prototype.btnVolumeClick = function () {
        console.log('dasdasaaaa');
    }
})(window);